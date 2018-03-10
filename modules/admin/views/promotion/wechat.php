<?php
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin();?>
    <?= $form->field($model,'dish_id')->dropDownList($dishes);?>
    <?= $form->field($model,'price')->textInput();?>
    <?= $form->field($model,'number')->textInput();?>
    <?= $form->field($model,'state')->dropDownList([1=>'上架',0=>'下架']);?>
    <?= $form->field($model,'max_number')->textInput();?>
<div>
    <?= Html::submitButton("提交");?>
</div>
<?php ActiveForm::end();?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'attribute' => 'dish_id',
            'value' =>function($model){
                return $model->dish->title;
            }
        ],
        'price',
        'number',
        [
            'attribute' => 'state',
            'value' =>function($model){
                return $model->state == 1 ? '上架' : '下架';
            }
        ],
        'max_number',
        [
            'attribute' => 'created_at',
            'value'=>function($model){
                return date('Y-m-d H:i:s',$model->created_at);
            }
        ],
        [
            'attribute' => 'updated_at',
            'value'=>function($model){
                return date('Y-m-d H:i:s',$model->updated_at);
            }
        ],
        [
            'class' => ActionColumn::className(),
            'header'=>'操作',
            'headerOptions'=>['width'=>'120'],
            'template' => '{update-wechat}{delete-wechat}',
            'buttons'=>[
                'update-wechat'=>function($url, $model, $key){
                    return Html::a('编辑',$url);
                },
                'delete-wechat'=>function($url, $model, $key){
                    return Html::a('删除','javascript:;',['class'=>'_delete','data-url'=>$url]);
                },
            ]
        ]
    ]
]);?>

<script type="text/javascript">
    seajs.use('promotion',function(promotion){
        promotion.deleteWechat();
    });
</script>
