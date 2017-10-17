<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/17
 * Time: 下午9:48
 */

namespace app\controllers;

use app\models\Dish;
use app\models\Order;
use app\models\OrderDish;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller {

    public function actionSubmit(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $quantityList = Yii::$app->request->post('quantity');
            if(empty($quantityList)){
                throw new Exception('您至少要选择一个菜品');
            }

            $model = new Order();
            $model->state = 'unpay';
            $model->created_at = time();
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

            $model->money = $moneyTotal;
            $model->quantity = $quantityTotal;
            $model->pay_id = "o-{$model->id}-".rand(1000,9999);
            $model->update();

            //todo 生成微信二维码

            return ['done'=>true];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}