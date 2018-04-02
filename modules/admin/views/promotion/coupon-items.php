<?php
use yii\grid\GridView;
?>

<div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id:text:ID',
            'number:text:优惠券编号',
            [
                'label' => '是否使用',
                'format' => 'raw',
                'value' => function($model){
                    if(empty($model->used_at)){
                        return '-----';
                    }

                    return date('Y-m-d H:i:s',$model->used_at)."<br/>订单号：{$model->order_id}";
                }
            ],
            [
                'label' => '使用金额',
                'format' => 'text',
                'value' => function($model){
                    if(empty($model->used_money)){
                        return '-----';
                    }
                    return $model->used_money;
                }
            ]
        ]
    ]);?>
</div>
