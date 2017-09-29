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
            'attribute'=>'id'
        ],
        'adminname',
        [
            'label'=>'生成时间',
            'format'=>'raw',
            'attribute'=>'created_at',
            'value'=>function($data){
                return "<b>".date('Y-m-d H:i:s',$data->created_at)."</b>";
            }
        ],
        [
            'class' => ActionColumn::className(),
            'header'=>'操作',
            'headerOptions'=>['width'=>'80'],
            'template' => '{view} {update} {delete}',
            'buttons'=>[
                'view'=>function($url, $model, $key){
                    return "<a href='{$url}'>详情</a>";
                },
                'update'=>function($url, $model, $key){
                    return "<a href='{$url}'>更新</a>";
                },
                'delete'=>function($url, $model, $key){
                    return "<a href='javascript:;' data-url='{$url}' class='_delete'>删除</a>";
                }
            ]
        ]
    ]
]);?>

<script type="text/javascript">
    seajs.use('administrator',function(administrator){
        administrator.delete();
    });
</script>
