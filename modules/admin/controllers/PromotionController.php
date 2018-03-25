<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/12
 * Time: 下午5:49
 */

namespace app\modules\admin\controllers;

use app\models\Coupon;
use app\models\Dish;
use app\models\WechatPromotion;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class PromotionController extends N8Base {

    public $cMenu = [
        'default'=>[
            'promotion-index'=>['label'=>'促销简报','url'=>['/admin/promotion/index']],
            'promotion-wechat'=>['label'=>'微信端特惠','url'=>['/admin/promotion/wechat']],
            'promotion-coupon'=>['label'=>'优惠券','url'=>['/admin/promotion/coupon']],
        ]
    ];

    public function actionIndex(){

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('promotion-index');

        return $this->render('index');
    }

    /**
     * 微信端特惠
     */
    public function actionWechat(){
        $model = new WechatPromotion();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/promotion/wechat']);
            }
        }

        $query = WechatPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->menus = $this->cMenu['default'];
        $this->initActiveMenu('promotion-wechat');

        return $this->render('wechat',[
            'dataProvider'=>$dataProvider,
            'model'=>$model,
            'dishes'=>ArrayHelper::map(Dish::find()->all(),'id','title')
        ]);
    }

    public function actionUpdateWechat($id){
        $model = WechatPromotion::findOne($id);

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['/admin/promotion/wechat']);
            }
        }

        $this->menus = $this->cMenu['default'];
        $menu = ['label'=>'更新微信特惠','url'=>['/admin/promotion/update-wechat','id'=>$id]];
        $this->initActiveMenu('promotion-update-wechat',$menu);

        return $this->render('update-wechat',[
            'model'=>$model,
            'dishes'=>ArrayHelper::map(Dish::find()->all(),'id','title')
        ]);
    }

    public function actionDeleteWechat($id){
        Yii::$app->response->format = 'json';
        try {
            $model = WechatPromotion::findOne($id);
            $model->delete();

            return ['done'=>true,'data'=>'删除成功'];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }


    public function actionCoupon(){
        $model = new Coupon();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());

            $model->begin_at = strtotime($model->begin_at);
            $model->end_at = empty($model->end_at) ? 0 : strtotime($model->end_at);

            if($model->save()){
                return $this->redirect(['/admin/promotion/coupon']);
            }
        }

        $query = Coupon::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('coupon',[
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionUpdateCoupon($id){
        $model = Coupon::findOne($id);

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());

            $model->begin_at = strtotime($model->begin_at);
            $model->end_at = empty($model->end_at) ? 0 : strtotime($model->end_at);

            if($model->save()){
                return $this->redirect(['/admin/promotion/coupon']);
            }
        }

        $model->begin_at = date('Y-m-d H:i:s',$model->begin_at);
        $model->end_at = empty($model->end_at) ? '' : date('Y-m-d H:i:s',$model->end_at);

        $this->menus = $this->cMenu['default'];
        $menu = ['label'=>'更新优惠券活动信息','url'=>['/admin/promotion/update-coupon','id'=>$id]];
        $this->initActiveMenu('promotion-update-coupon',$menu);

        return $this->render('update-coupon',[
            'model'=>$model,
        ]);
    }

    public function actionDeleteCoupon($id){
        Yii::$app->response->format = 'json';
        try {
            $model = Coupon::findOne($id);
            $model->delete();

            return ['done'=>true,'data'=>'删除成功'];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }


}