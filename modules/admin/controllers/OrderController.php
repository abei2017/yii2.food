<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/22
 * Time: 下午1:23
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\Order;
use app\models\OrderDish;
use EasyWeChat\Foundation\Application;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Response;

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

    /**
     * 订单核查
     * @param $id
     */
    public function actionIspay($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $model = Order::findOne($id);

            //  todo
            $wxApp = new Application(Yii::$app->params['wx']);
            $payment = $wxApp->payment;
            $result = $payment->query($model->pay_id);
            if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS' && $result->trade_state == 'SUCCESS'){
                // update order
                $model->paid_at = time();
                $model->state = 'pay';
                $model->transaction_id = $result->transaction_id;
                $model->update();

                return ['done'=>true,'data'=>'订单更新成功'];
            }else{
                throw new Exception("通讯：{$result->return_msg}<br/>业务:{$result->err_code_des }<br/>交易状态：{$result->trade_state }");
            }

        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }

    }
}