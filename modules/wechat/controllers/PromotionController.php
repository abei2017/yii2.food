<?php

namespace app\modules\wechat\controllers;

use app\models\Order;
use app\models\WechatPromotion;

/**
 * Default controller for the `wechat` module
 */
class PromotionController extends WechatBase {

    public function actionWechat(){
        $this->oauth();

        $data = WechatPromotion::find()->where(['state'=>1])->all();

        return $this->render('wechat',[
            'data'=>$data
        ]);
    }
}
