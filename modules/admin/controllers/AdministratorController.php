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

    public $cMenu = [
        'admin'=>[
            'administrator-index'=>['label'=>'管理员列表','url'=>['/admin/administrator/index']],
            'administrator-create'=>['label'=>'新建管理员','url'=>['/admin/administrator/create']],
        ]
    ];

    /**
     * 列表
     * @return string
     */
    public function actionIndex(){

        $query = Administrator::find()->orderBy(['id'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->menus = $this->cMenu['admin'];
        $this->initActiveMenu('administrator-index');

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

    public function actionCreate(){
        $model = new Administrator();
        $model->scenario = 'create';

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if($model->save()){
                return $this->redirect(['/admin/administrator/index']);
            }
        }

        $this->menus = $this->cMenu['admin'];
        $this->initActiveMenu('administrator-create');

        return $this->render('create',[
            'model'=>$model
        ]);
    }

    public function actionUpdate($id){
        $model = Administrator::findOne($id);
        $model->scenario = 'update';

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());

            //password
            if(empty($model->password)){
                $model->password = $model->oldAttributes['password'];
            }else{
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }

            if($model->save()){
                return $this->redirect(['/admin/administrator/index']);
            }
        }

        $this->menus = $this->cMenu['admin'];
        $menu = ['label'=>'更新管理员','url'=>['/admin/administrator/update','id'=>$id]];
        $this->initActiveMenu('administrator-update',$menu);

        $model->password = '';
        return $this->render('create',[
            'model'=>$model
        ]);
    }
}