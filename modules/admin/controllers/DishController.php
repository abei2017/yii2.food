<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/12
 * Time: 下午5:49
 */

namespace app\modules\admin\controllers;

use app\models\Dish;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
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

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('dish-create');

        return $this->render('create',[
            'model'=>$model
        ]);
    }
}