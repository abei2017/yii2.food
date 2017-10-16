<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/16
 * Time: 下午12:54
 */

namespace app\modules\admin\controllers;

use Yii;

class SetController extends N8Base {

    public $cMenu = [
        'set'=>[
            'set-index'=>['label'=>'日志','url'=>['/admin/set/index']],
        ]
    ];

    public function actionIndex(){

    }

}