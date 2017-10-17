<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/17
 * Time: 下午1:05
 */

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Dish;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

class CategoryController extends Controller {

    public function actionDishes($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $dishes = Dish::find()->where(['small_cat_id'=>$id])->asArray()->all();

            return ['done'=>true,'data'=>$dishes];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}