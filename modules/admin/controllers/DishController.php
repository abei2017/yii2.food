<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/12
 * Time: 下午5:49
 */

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Dish;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class DishController extends N8Base {

    public $cMenu = [
        'default'=>[
            'dish-index'=>['label'=>'菜品列表','url'=>['/admin/dish/index']],
            'dish-create'=>['label'=>'新建菜品','url'=>['/admin/dish/create']],
        ]
    ];

    /**
     *  菜品列表页
     * @author abei<abei@nai8.me>
     * @return string
     */
    public function actionIndex(){
        $query = Dish::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('dish-index');

        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionDeleteAll(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $ids = Yii::$app->request->post('selection');
            Dish::deleteAll(['in','id',$ids]);

            return ['done'=>true];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }

    /**
     * 新建菜品
     */
    public function actionCreate(){
        $model = new Dish();

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/dish/index']);
            }
        }

        $smalls = [];
        if($model->cat_id > 0){
            $smalls = ArrayHelper::map(Category::find()->where(['fid'=>$model->cat_id])->all(),'id','name');
        }


        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('dish-create');

        return $this->render('create',[
            'model'=>$model,
            'cats'=>ArrayHelper::map(Category::find()->where(['fid'=>0])->all(),'id','name'),
            'smalls'=>$smalls
        ]);
    }

    public function actionUpdate($id){
        $model = Dish::findOne($id);

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/dish/index']);
            }
        }

        $smalls = [];
        if($model->cat_id > 0){
            $smalls = ArrayHelper::map(Category::find()->where(['fid'=>$model->cat_id])->all(),'id','name');
        }


        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('dish-create');

        return $this->render('create',[
            'model'=>$model,
            'cats'=>ArrayHelper::map(Category::find()->where(['fid'=>0])->all(),'id','name'),
            'smalls'=>$smalls
        ]);
    }

    /**
     * 删除一个菜品
     * @param $id integer 菜品ID
     * @return array
     */
    public function actionDelete($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $model = Dish::findOne($id);
            $model->delete();

            return ['done'=>true];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}