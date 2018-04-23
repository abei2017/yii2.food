<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/20
 * Time: 下午2:51
 */

namespace app\controllers;

use app\models\AlipayNotify;
use app\models\CouponItem;
use app\models\OrderDish;
use app\models\OrderUpoff;
use app\models\User;
use Da\QrCode\Contracts\LabelInterface;
use Da\QrCode\Label;
use Yii;
use app\models\Order;
use yii\base\Exception;
use yii\web\Controller;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order as EOrder;

use Da\QrCode\QrCode;
use yii\web\Response;

use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\Config;
use Payment\Client\Notify;

class OrderController extends Controller {

    public $enableCsrfValidation = false;

    public function actionPay($id){
        $model = Order::findOne($id);
        if($model->state == 'pay'){
            return $this->render('pay',[
                'model'=>$model
            ]);
        }

        if($model->pay_type == 'wx'){
            //wx
            $config = Yii::$app->params['wx'];
            $wxApp = new Application($config);
            $payment = $wxApp->payment;

            $totalFee = 1;
            $attributes = [
                'trade_type'=>EOrder::NATIVE,
                'body'=>"自助下单",
                'detail'=>"订单编号#{$model->id}",
                'out_trade_no'=>$model->pay_id,
                'total_fee'=>$totalFee,
                'time_expire'=>date('YmdHis',time()+300),
                'notify_url'=>Yii::$app->urlManager->createAbsoluteUrl(['/order/notify'])// order-notify.html
            ];

            $o = new EOrder($attributes);
            $result = $payment->prepare($o);

            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                $prepayId = $result->prepay_id;
                $codeUrl = $result->code_url;

                $label = new Label("请用微信扫码支付",null,12,LabelInterface::ALIGN_CENTER,['t'=>-24,'b'=>10]);

                $qrcode = (new QrCode($codeUrl))
                    ->setMargin(50)->setSize(250)->setLabel($label);
                return $this->render('pay',[
                    'qrcode'=>$qrcode,
                    'model'=>$model
                ]);
            }else{
                Yii::error($result->return_msg.$result->err_code_des."，订单ID为{$model->id}",'order');
                echo $result->return_msg.$result->err_code_des;
            }
        }else{
            //alipay
            $payData = [
                'body'    => '自助下单',
                'subject'    => "订单编号#{$model->id}",
                'order_no'    => $model->pay_id,
                'timeout_express' => time() + 600,// 表示必须 600s 内付款
                'amount'    => '0.01',// 单位为元 ,最小为0.01
                'return_param' => '123123',
                'goods_type' => '1',// 0—虚拟类商品，1—实物类商品
                'store_id' => '',
                'operator_id' => '',
                'terminal_id' => '',// 终端设备号(门店号或收银设备ID) 默认值 web
            ];

            $config = Yii::$app->params['alipay'];

            try {
                $str = Charge::run(Config::ALI_CHANNEL_QR, $config, $payData);

                $label = new Label("请用支付宝扫码支付",null,12,LabelInterface::ALIGN_CENTER,['t'=>-24,'b'=>10]);
                $qrcode = (new QrCode($str))
                    ->setMargin(50)->setSize(250)->setLabel($label);
                return $this->render('pay',[
                    'qrcode'=>$qrcode,
                    'model'=>$model
                ]);
            } catch (PayException $e) {
                echo $e->errorMessage();
                exit;
            }

        }


    }

    public function actionNotify(){
        $config = Yii::$app->params['wx'];

        $wxApp = new Application($config);
        $payment = $wxApp->payment;
        $response = $payment->handleNotify(function($notify, $successful){
            $order_arr = json_decode($notify,true);
            $out_trade_no = $order_arr['out_trade_no'];//订单号

            @list($type, $id, $_) = explode('-', $out_trade_no);

            $model = Order::findOne($id);
            if($model == false){
                return 'Order not exist.';
            }

            if($model->paid_at > 0){
                return true;
            }

            if ($successful) {
                $model->state = 'pay';
                $model->paid_at = time();
                $model->transaction_id = $order_arr['transaction_id'];

                //
                $openId = $order_arr['openid'];
                $user = User::find()->where(['open_id'=>$openId])->one();
                if($user == false){
                    // new
                    $user = new User();
                    $user->open_id = $openId;
                    $user->created_at = time();
                    $user->save();
                }

                $model->user_id = $user->id;

            } else {
                $model->state = 'fail';
            }

            //  优惠
            if($model->preferential_money > 0){
                $couponItem = CouponItem::find()->where(['order_id'=>$model->id])->one();
                if($couponItem){
                    $couponItem->used_at = time();
                    $couponItem->update();
                }

                $upoff = OrderUpoff::find()->where(['order_id'=>$model->id])->one();
                if($upoff){
                    $upoff->ok_at = time();
                    $upoff->update();
                }
            }



            $model->update();

            return true;
        });
        return $response;
    }

    /**
     * 检测订单是否已经支付成功
     *
     * @param $id
     * @return array
     */
    public function actionCheck($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $model = Order::findOne($id);
            if(in_array($model->state,['unpay','close','fail'])){
                throw new Exception('订单未支付');
            }

            $dishes = OrderDish::find()->where(['order_id'=>$id])->all();
            $return = [];
            foreach($dishes as $dish){
                $item = [
                    'title'=>$dish->dish->title,
                    'price'=>$dish->dish->price,
                    'quantity'=>$dish->quantity
                ];

                $return[] = $item;
            }

            return ['done'=>true,'data'=>$model->id,'dishes'=>$return];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage(),'data'=>$model->id];
        }
    }

    public function actionAnotify(){
        try {
            $callback = new AlipayNotify();
            $config = Yii::$app->params['alipay'];
            $ret = Notify::run('ali_charge', $config, $callback);// 处理回调，内部进行了签名检查
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
    }
}