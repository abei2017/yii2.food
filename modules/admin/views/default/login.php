<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php ActiveForm::begin([
    'action'=>'javascript:;',
    'id'=>'Form'
]);?>

<div>
    <?= Html::textInput('adminname')?>
</div>

<div>
    <?= Html::passwordInput('password');?>
</div>

<div>
    <button id="actLogin" data-url="<?= Url::to(['/admin/default/login']);?>">登录</button>
</div>

<?php ActiveForm::end();?>

<script type="text/javascript">
    $('#actLogin').click(function(){
        var url = $(this).attr('data-url');
        $.post(url,$('#Form').serializeArray(),function(d){
            if(d.done == true){
                window.location.href = '/index.php?r=admin';
            }else{
                alert(d.error);
            }
        },'json');
    });
</script>
