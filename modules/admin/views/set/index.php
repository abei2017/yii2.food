<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
?>

<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
            'label'=>'编号',
            'headerOptions'=>['width'=>'60'],
            'attribute'=>'id',
        ],
        [
            'label'=>'级别',
            'headerOptions'=>['width'=>'60'],
            'attribute'=>'level',
        ],
        [
            'label'=>'分类',
            'headerOptions'=>['width'=>'120'],
            'attribute'=>'category',
        ],
        [
            'label'=>'记录时间',
            'headerOptions'=>['width'=>'150'],
            'attribute'=>'log_time',
            'value'=>function($model){
                return date('Y-m-d H:i:s',$model->log_time);
            }
        ],
        [
            'label'=>'内容',
            'format'=>'html',
            'value'=>function($model){
                return nl2br($model->message);
            }
        ],
    ],
]);?>