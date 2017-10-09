<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model,'name')->textInput();?>
<?= $form->field($model,'fid')->textInput();?>

<div class="form-group">
    <button>提交</button>
</div>

<?php ActiveForm::end();?>
