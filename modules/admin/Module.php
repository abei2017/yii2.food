<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $route = "{$action->controller->id}/{$action->id}";

            $publicPages = [
                'default/login',
                'default/logout',
                'default/error'
            ];

            if(Yii::$app->admin->isGuest && in_array($route,$publicPages) == false){
                return Yii::$app->admin->loginRequired();
            }

            return true;
        }else{
            return false;
        }


    }
}
