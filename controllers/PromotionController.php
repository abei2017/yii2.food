<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/20
 * Time: 下午2:51
 */

namespace app\controllers;

use app\models\Order;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use app\models\OrderDish;

class PromotionController extends Controller {

    /**
     * 打印取餐码
     */
    public function actionCode(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format = 'json';
            try {
                $code = Yii::$app->request->post('code',null);
                if(empty($code)){
                    throw new Exception('取餐码不能为空');
                }

                // type_str = "code#19192912"
                $check = Order::find()
                    ->where(['type'=>'wx'])->andWhere("substring(`type_str`,1,8) = :code",[':code'=>$code])->one();
                if($check == false){
                    throw new Exception('取餐码不存在');
                }

                $codeArr = explode('#',$check->type_str);
                if(isset($codeArr[1])){
                    throw new Exception('取餐码已经被使用了');
                }

                $check->type_str = $check->type_str . "#" . time();
                $check->update();

                $dishes = OrderDish::find()->where(['order_id'=>$check->id])->all();
                $return = [];
                foreach($dishes as $dish){
                    $item = [
                        'title'=>$dish->dish->title,
                        'price'=>$dish->dish->price,
                        'quantity'=>$dish->quantity
                    ];

                    $return[] = $item;
                }

                return ['done'=>true,'dishes'=>$return];
            }catch(Exception $e){
                return ['done'=>false,'error'=>$e->getMessage()];
            }
        }
        return $this->render('code');
    }
}