<?php

namespace app\modules\wechat\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;

/**
 * Default controller for the `wechat` module
 */
class WechatBase extends Controller
{
    protected $wxLogin = false;

    public function oauth(){
        $config = Yii::$app->params['wx'];

        $url = Yii::$app->request->getUrl();
        $callback = Yii::$app->urlManager->createAbsoluteUrl(['/wechat/default/oauth','url'=>urlencode($url)]);

        $config['oauth']['callback'] = $callback;

        $app = new Application($config);
        $oauth = $app->oauth;

        $wxLoginId = Yii::$app->session->get('wx_login_user_id');
        if($wxLoginId == null){
            return $oauth->redirect()->send();
        }

        $this->wxLogin = User::findOne($wxLoginId);
    }
}
