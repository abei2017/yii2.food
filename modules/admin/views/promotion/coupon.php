<?php
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
?>

<div class="add">
    <?php $form = ActiveForm::begin([

    ]);?>

    <?= $form->field($model,'name')->textInput();?>
    <?= $form->field($model,'quantity')->textInput();?>
    <?= $form->field($model,'price')->textInput();?>
    <?= $form->field($model,'begin_at')->textInput()->hint("输入的格式为xxxx-xx-xx xx:xx:xx");?>
    <?= $form->field($model,'end_at')->textInput();?>

    <button type="submit">确定</button>

    <?php ActiveForm::end();?>
</div>

<div class="list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'quantity',
            'price',
            'begin_at:datetime:开始时间',
            [
                'attribute' => 'end_at',
                'format' => 'text',
                'value' => function($model){
                    if(empty($model->end_at)){
                        return '无限制';
                    }
                    return date("Y-m-d H:i:s",$model->end_at);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::className(),
                'header'=>'操作',
                'headerOptions'=>['width'=>'120'],
                'template' => '{update-coupon}{delete-coupon}',
                'buttons'=>[
                    'update-coupon'=>function($url, $model, $key){
                        return Html::a('编辑',$url);
                    },
                    'delete-coupon'=>function($url, $model, $key){
                        return Html::a('删除','javascript:;',['class'=>'_delete','data-url'=>$url]);
                    },
                ]
            ]
        ]
    ]);?>
</div>


<script type="text/javascript">
    seajs.use('promotion',function(promotion){
        promotion.deleteCoupon();
    });
</script>
