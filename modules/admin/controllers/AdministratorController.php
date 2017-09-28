<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/9/28
 * Time: 下午9:52
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Administrator;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Response;

class AdministratorController extends N8Base {

    /**
     * 列表
     * @return string
     */
    public function actionIndex(){

        $query = Administrator::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionDelete($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            if($id == Yii::$app->admin->id){
                throw new Exception('不能删除自己');
            }

            $model = Administrator::findOne($id);
            $model->delete();

            return ['done'=>true];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}