<?php

namespace app\controllers;

use app\models\Conf;
use Yii;
use yii\web\Controller;
use app\models\Category;

class SiteController extends Controller {


    public function actionIndex() {
        return $this->render('index',[
            'cats'=>Category::find()->where(['fid'=>0])->all(),
        ]);
    }

    public function actionTest(){
        echo intval(floor(29.6/100));
    }
}
