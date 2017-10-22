<?php
use yii\grid\GridView;
?>


<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        [
            'label'=>'菜品信息',
            'format'=>'raw',
            'value'=>function($model){

            }
        ]
    ],
]);?>