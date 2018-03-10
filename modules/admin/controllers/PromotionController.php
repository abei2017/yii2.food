<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/12
 * Time: 下午5:49
 */

namespace app\modules\admin\controllers;

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
}