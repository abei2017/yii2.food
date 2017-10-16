<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/16
 * Time: 下午12:54
 */

namespace app\modules\admin\controllers;

use app\models\Log;
use Yii;
use yii\data\ActiveDataProvider;

class SetController extends N8Base {

    public $cMenu = [
        'set'=>[
            'set-index'=>['label'=>'日志','url'=>['/admin/set/index']],
        ]
    ];

    public function actionIndex(){
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query->orderBy(['log_time'=>SORT_DESC])
        ]);

        $this->menus = $this->cMenu['set'];
        $this->initActiveMenu('set-index');

        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }

}