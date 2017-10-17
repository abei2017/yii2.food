<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;

class SiteController extends Controller {


    public function actionIndex() {
        return $this->render('index',[
            'cats'=>Category::find()->where(['fid'=>0])->all(),
        ]);
    }
}
