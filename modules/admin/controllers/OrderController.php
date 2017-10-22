<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/22
 * Time: 下午1:23
 */

namespace app\modules\admin\controllers;

use app\models\Order;
use app\models\OrderDish;
use yii\data\ActiveDataProvider;

class OrderController extends N8Base {

    public $cMenu = [
        'order'=>[
            'order-index'=>['label'=>'订单列表','url'=>['/admin/order/index']],
        ]
    ];

    /**
     * 订单列表
     * @author abei<abei@nai8.me>
     */
    public function actionIndex(){
        $query = Order::find();

        $query->orderBy(['created_at'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        $this->menus = $this->cMenu['order'];
        $this->initActiveMenu('order-index');

        return $this->render('index',[
            'dataProvider'=>$dataProvider
        ]);
    }
}