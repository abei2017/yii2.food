<?php

namespace app\modules\wechat\controllers;

use app\models\User;
use Yii;
use EasyWeChat\Foundation\Application;

/**
 * Default controller for the `wechat` module
 */
class DefaultController extends WechatBase
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOauth(){
        $url = Yii::$app->request->get('url');
        $config = Yii::$app->params['wx'];

        $app = new Application($config);
        $oauth = $app->oauth;
        $user = $oauth->user();

        $check = User::find()->where(['open_id'=>$user->getId()])->one();
        if($check == false){
            $check = new User();
            $check->open_id = $user->getId();
            $check->created_at = time();
            $check->save();
        }

        Yii::$app->session->set('wx_login_user_id',$check->id);

        header('location:'.urldecode($url));
    }
}
