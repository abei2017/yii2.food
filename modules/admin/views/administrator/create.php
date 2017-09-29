<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

    <?= $form->field($model,'adminname')->textInput();?>
    <?= $form->field($model,'password')->passwordInput();?>

    <div class="form-group">
        <button>提交</button>
    </div>

<?php ActiveForm::end();?>
