<?php

namespace app\modules\wechat\controllers;

use Yii;
use app\models\WechatPromotion;
use yii\base\Exception;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use app\models\Order as MOrder;
use app\models\OrderDish;

/**
 * Default controller for the `wechat` module
 */
class PromotionController extends WechatBase {

    public $enableCsrfValidation = false;

    public function actionWechat(){
        $this->oauth();

        $data = WechatPromotion::find()->where(['state'=>1])->all();

        return $this->render('wechat',[
            'data'=>$data
        ]);
    }

    public function actionBuy(){
        Yii::$app->response->format = 'json';
        try {
            $this->oauth();

            /**
             * 参数验证
             * 特惠model的验证
             * 库存的验证
             * 每单最大量限制的验证
             */
            //  微信端特惠商品记录ID
            $id = (int)Yii::$app->request->get('id',0);
            $quantity = (int)Yii::$app->request->get('quantity',0);

            if($id <= 0 OR $quantity <= 0){
                throw new Exception("参数错误");
            }

            $model = WechatPromotion::findOne($id);
            if($model == false){
                throw new Exception("参数错误");
            }

            if($model->state == 0){
                throw new Exception("此特惠当前已经下线，无法购买。");
            }

            if($model->number > 0 && ($model->number - $model->sold_number) < $quantity){
                throw new Exception("库存不够了");
            }

            if($model->max_number > 0 && $model->max_number < $quantity){
                throw new Exception("超出每单最大购买量。");
            }

            // order
            $o = new MOrder();
            $o->state = 'unpay';
            $o->created_at = time();
            $o->type = 'wx';
            $o->save();

            $m = new OrderDish();
            $m->order_id = $o->id;
            $m->dish_id = $model->dish_id;
            $m->quantity = $quantity;
            $m->created_at = time();
            $m->price = $model->dish->price;
            $m->money = $model->price*$quantity;
            $m->save();

            $o->money = $m->money;
            $o->quantity = $quantity;
            $o->pay_id = "wx-{$o->id}-{$id}-".rand(1000,9999);
            $o->update();

            $config = Yii::$app->params['wx'];
            $wxApp = new Application($config);
            $payment = $wxApp->payment;

            $totalFee = $o->money*100;
            $totalFee = 1;
            // pay
            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '微信端特惠 - '.$model->dish->title,
                'out_trade_no'     => $o->pay_id,
                'total_fee'        => $totalFee, // 单位：分
                'notify_url'       => Yii::$app->urlManager->createAbsoluteUrl(['/wechat/promotion/notify']), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $this->wxLogin->open_id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            ];

            $order = new Order($attributes);
            $result = $payment->prepare($order);
            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
                $prepayId = $result->prepay_id;
                $json = $payment->configForPayment($prepayId);

                $data = $this->renderPartial('_wxpay', ['json' => $json, 'o' => $o]);
                return ['done'=>true,'data'=>$data];
            }

        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }

    public function actionNotify(){
        $config = Yii::$app->params['wx'];
        $wxApp = new Application($config);
        $payment = $wxApp->payment;

        $response = $payment->handleNotify(function($notify, $successful){
            $order_arr = json_decode($notify,true);
            $out_trade_no = $order_arr['out_trade_no'];//订单号

            @list($type, $id,$wechatPromotionId, $_) = explode('-', $out_trade_no);

            $model = MOrder::findOne($id);
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
                $model->type_str = rand(10000000,99999999);

                $wechatPromotion = WechatPromotion::findOne($wechatPromotionId);
                $wechatPromotion->sold_number = $wechatPromotion->sold_number + $model->quantity;
                $wechatPromotion->update();

            } else {
                $model->state = 'fail';
            }

            $model->update();

            return true;
        });

        $response->send(); // Laravel 里请使用：return $response;
    }

    public function actionResult($id){
        $model = MOrder::findOne($id);
        echo $model->state;
    }
}
