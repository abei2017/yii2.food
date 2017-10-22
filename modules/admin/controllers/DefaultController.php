<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Administrator;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends N8Base
{
    public $cMenu = [
        'default'=>[
            'default-index'=>['label'=>'控制台','url'=>['/admin/default/index']],
        ]
    ];

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('default-index');

        return $this->render('index');
    }

    /**
     * 登录页面
     * @return string | json
     */
    public function actionLogin(){

        if(Yii::$app->request->isPost){
            try {
                $adminname = Yii::$app->request->post('adminname');
                $password = Yii::$app->request->post('password');

                if(empty($adminname) OR empty($password)){
                    throw new Exception('用户名和密码不能为空');
                }

                $check = Administrator::find()->where(['adminname'=>$adminname])->one();
                if($check == false){
                    throw new Exception('用户不存在');
                }

                if(Yii::$app->security->validatePassword($password,$check->password) == false){
                    throw new Exception('密码错误，请核实后填写。');
                }

                Yii::$app->admin->login($check);

                return Json::encode(['done'=>true,'data'=>Url::to(['/admin'])]);
            }catch(Exception $e){
                return Json::encode(['done'=>false,'error'=>$e->getMessage()]);
            }
        }

        return $this->render('login');
    }
}
