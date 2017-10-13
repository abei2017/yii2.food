<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/9
 * Time: 下午12:12
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\Category;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class CategoryController extends N8Base {

    public $cMenu = [
        'default'=>[
            'category-index'=>['label'=>'分类列表','url'=>['/admin/category/index']],
            'category-create'=>['label'=>'新建分类','url'=>['/admin/category/create']],
        ]
    ];

    public function actionIndex(){
        $query = Category::find()->where(['fid'=>0]);

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('category-index');

        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionCreate(){
        $model = new Category();

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/category/index']);
            }
        }

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('category-create');

        return $this->render('create',[
            'model'=>$model
        ]);
    }

    public function actionUpdate($id){
        $model = Category::findOne($id);
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/category/index']);
            }
        }

        $this->menus = $this->cMenu['default'];
        $menu = ['label'=>'更新分类','url'=>['/admin/category/update','id'=>$id]];
        $this->initActiveMenu('category-update',$menu);

        return $this->render('create',[
            'model'=>$model
        ]);
    }

    public function actionDelete($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $model = Category::findOne($id);
            if($model->fid == 0){
                $check = Category::find()->where(['fid'=>$model->id])->count();
                if($check > 0){
                    throw new Exception('还有子分类，不允许删除。');
                }
            }
            $model->delete();

            return ['done'=>true];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }

    public function actionChildren($fid){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $children = Category::find()->where(['fid'=>$fid])->asArray()->all();

            return ['done'=>true,'data'=>$children];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}