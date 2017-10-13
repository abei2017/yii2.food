<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action'=>'javascript:;','id'=>'Form']);?>

<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
            'class' => 'yii\grid\CheckboxColumn',
            'footerOptions'=>['colspan'=>7],
            'footer'=>Html::a('批量删除',null,['class'=>'_del_selected','data-url'=>Url::to(['/admin/dish/delete-all'])]),
        ],
        [
            'label'=>'编号',
            'headerOptions'=>['width'=>'60'],
            'attribute'=>'id',
            'footerOptions'=>['class'=>'hide']
        ],
        [
            'attribute'=>'title',
            'footerOptions'=>['class'=>'hide']
        ],
        [
            'attribute'=>'price',
            'footerOptions'=>['class'=>'hide']
        ],
        [
            'label'=>'所属分类',
            'attribute'=>'cat_id',
            'value'=>function($data){
                if($data->cat_id == 0){
                    return '---';
                }
                return $data->cat->name;
            },
            'footerOptions'=>['class'=>'hide']
        ],
        [
            'attribute'=>'updated_at',
            'value'=>function($data){
                return date('Y-m-d H:i:s',$data->updated_at);
            },
            'footerOptions'=>['class'=>'hide']
        ],
        [
            'class' => ActionColumn::className(),
            'header'=>'操作',
            'headerOptions'=>['width'=>'120'],
            'template' => '{update} {delete}',
            'buttons'=>[

                'update'=>function($url, $model, $key){
                    return "<a href='{$url}'>更新</a>";
                },
                'delete'=>function($url, $model, $key){
                    return "<a href='javascript:;' data-url='{$url}' class='_delete'>删除</a>";
                }
            ],
            'footerOptions'=>['class'=>'hide']
        ],
    ],
    'showFooter'=>true
]);?>

<?php ActiveForm::end();?>

<script type="text/javascript">
    seajs.use('dish',function(dish){
        dish.deleteAll();
    });
</script>


