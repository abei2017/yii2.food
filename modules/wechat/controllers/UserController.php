<?php

namespace app\modules\wechat\controllers;

use app\models\Order;

/**
 * Default controller for the `wechat` module
 */
class UserController extends WechatBase
{
    public function actionOrders(){
        $this->oauth();

        $orders = Order::find()->where(['state'=>'pay','user_id'=>$this->wxLogin->id])->all();

        return $this->render('orders',[
            'orders'=>$orders
        ]);
    }

}
