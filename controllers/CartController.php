<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/17
 * Time: 下午9:48
 */

namespace app\controllers;

use app\models\Conf;
use app\models\Coupon;
use app\models\CouponItem;
use app\models\Dish;
use app\models\Order;
use app\models\OrderDish;
use app\models\OrderUpoff;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller {

    public function actionSubmit(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $payType = Yii::$app->request->get('pay_type');
            $quantityList = Yii::$app->request->post('quantity');
            if(empty($quantityList)){
                throw new Exception('您至少要选择一个菜品');
            }

            $couponNumber = Yii::$app->request->post('coupon',null);
            if(!empty($couponNumber)){
                //  check
                $couponItem = CouponItem::find()->where(['number'=>$couponNumber])->one();
                if($couponItem == false){
                    throw new Exception('优惠券无效');
                }

                if($couponItem->used_at > 0){
                    throw new Exception("该优惠券已经被使用了");
                }

                $coupon = Coupon::findOne($couponItem->coupon_id);
                if($coupon->end_at > 0 && $coupon->end_at <= time()){
                    throw new Exception("已经过期了");
                }
            }

            $model = new Order();
            $model->state = 'unpay';
            $model->created_at = time();
            $model->pay_type = $payType;
            if($model->save() == false){
                throw new Exception('新建订单失败');
            }

            $moneyTotal = $quantityTotal = 0;
            foreach($quantityList as $key=>$val){

                $dish = Dish::findOne($key);

                $m = new OrderDish();
                $m->order_id = $model->id;
                $m->dish_id = $key;
                $m->quantity = $val;
                $m->created_at = time();
                $m->price = $dish->price;
                $m->money = $dish->price*$val;
                if($m->save() == false){
                    throw new Exception('新建订单失败');
                }

                $moneyTotal += $m->money;
                $quantityTotal += $val;
            }

            //  满减促销
            $upOffPreferentialMoney = 0;
            $upOffConf = Conf::readConf('up_off');
            if(isset($upOffConf['state']) && $upOffConf['state'] == 1
                && $upOffConf['begin_time'] < time() && ($upOffConf['end_time'] > time() || $upOffConf['end_time'] == 0)){
                $upOffNumber = intval(floor($moneyTotal / $upOffConf['up_money']));
                $upOffPreferentialMoney = $upOffNumber * $upOffConf['off_money'];


                //  满减
                if($upOffPreferentialMoney > 0){
                    $upOffModel = new OrderUpoff();
                    $upOffModel->order_id = $model->id;
                    $upOffModel->created_at = time();
                    $upOffModel->money = $upOffPreferentialMoney;
                    $upOffModel->info = Json::encode($upOffConf);
                    $upOffModel->save();
                }
            }


            //

            //  优惠券
            $couponPreferentialMoney = 0;
            if(!empty($couponNumber)){
                $couponPreferentialMoney = $coupon->price > ($moneyTotal - $upOffPreferentialMoney) ? ($moneyTotal - $upOffPreferentialMoney) : $coupon->price;
                $couponItem->order_id = $model->id;
                $couponItem->used_money = $couponPreferentialMoney;
                $couponItem->update();
            }

            $model->preferential_money = $couponPreferentialMoney + $upOffPreferentialMoney;
            $model->money = $moneyTotal - $couponPreferentialMoney - $upOffPreferentialMoney;

            if($model->money == 0){
                $model->paid_at = time();
                $model->state = 'pay';

                /**
                 *  在优惠直接可以支付的情况下
                 *  各优惠方式的逻辑处理
                 */
                //  优惠券
                if(!empty($couponNumber)){
                    $couponItem->used_at = time();
                    $couponItem->update();
                }

                if($upOffPreferentialMoney > 0){
                    $upOffModel->ok_at = time();
                    $upOffModel->update();
                }
            }

            $model->quantity = $quantityTotal;
            $model->pay_id = "o-{$model->id}-".rand(1000,9999);
            $model->update();

            return ['done'=>true,'data'=>Url::to(['/order/pay','id'=>$model->id])];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}