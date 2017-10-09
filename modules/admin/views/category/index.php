<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
?>

<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
            'label'=>'编号',
            'headerOptions'=>['width'=>'60'],
            'attribute'=>'id'
        ],
        'name',
        [
            'label'=>'生成时间',
            'format'=>'raw',
            'attribute'=>'created_at',
            'value'=>function($data){
                return "<b>".date('Y-m-d H:i:s',$data->created_at)."</b>";
            }
        ],
        [
            'label'=>'子分类',
            'format'=>'raw',
            'value'=>function($data){
                $str = "";

                foreach($data->children as $child){
                    $str .= "<strong>{$child->name}</strong>(<a href='".Url::to(['/admin/category/update','id'=>$child->id])."'>更新</a><a href='javascript:' class='_delete' data-url='".Url::to(['/admin/category/delete','id'=>$child->id])."'>删除</a>)";
                }

                return $str;
            }
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
            ]
        ]
    ]
]);?>

<script type="text/javascript">
    seajs.use('category',function(category){
        category.delete();
    });
</script>
