<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="default-login">
    <?php ActiveForm::begin([
        'action'=>'javascript:;',
        'id'=>'Form'
    ]);?>
    <div class="form">
        <div class="form-group">
            <div class="control-label">登录名</div>
            <?= Html::textInput('adminname',null,['class'=>'form-control'])?>
        </div>

        <div class="form-group">
            <div class="control-label">密码</div>
            <?= Html::passwordInput('password',null,['class'=>'form-control']);?>
        </div>

        <div class="form-group form-button">
            <button id="actLogin" data-url="<?= Url::to(['/admin/default/login']);?>">登录</button>
        </div>
    </div>
    <?php ActiveForm::end();?>
</div>
<script type="text/javascript">
    seajs.use('administrator',function(administrator){
        administrator.login();
    });
</script>
