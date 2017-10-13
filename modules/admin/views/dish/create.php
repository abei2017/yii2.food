<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<h1>新建菜品</h1>
<p>
    菜品头图尺寸比如为3:2。
</p>
<?php $form = ActiveForm::begin([
    'enableClientValidation'=>false,
    'enableClientScript'=>false
]);?>
    <?= $form->field($model,'title')->textInput();?>
    <?= $form->field($model,'price')->textInput();?>
    <?= $form->field($model,'cat_id')->dropDownList($cats,['prompt'=>'请选择一级分类','onchange'=>'
        $.getJSON("'.Url::to(['/admin/category/children']).'",{fid:$(this).val()},function(d){
            $("#small_cats").empty();
            $.each(d.data,function(key,val){
                $("#small_cats").append("<option value="+val.id+">"+val.name+"</option>");
            });
        })
    ']);?>
    <?= $form->field($model,'small_cat_id')->dropDownList($smalls,['prompt'=>'请选择二级分类','id'=>'small_cats']);?>
    <?= $form->field($model,'image')->textInput(['id'=>'image']);?>
    <div class="form-group">
        <a href="javascript:" class="picker" id="picker">
            <i class="fa fa-picture-o"></i>
        </a>
    </div>

    <div class="form-group">
        <button type="submit" class="button">提交</button>
    </div>
<?php ActiveForm::end();?>

<script type="text/javascript">
    seajs.use('init',function(init){
        init.upload('picker',"<?= Url::to(['/admin/uploader/simple']);?>",function(d){
            $('#image').attr('value',d.file_path);
        });
    });
</script>
