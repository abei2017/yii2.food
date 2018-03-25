<?php
use yii\widgets\ActiveForm;
?>

<div class="add">
    <?php $form = ActiveForm::begin([

    ]);?>

    <?= $form->field($model,'name')->textInput();?>
    <?= $form->field($model,'quantity')->textInput();?>
    <?= $form->field($model,'price')->textInput();?>
    <?= $form->field($model,'begin_at')->textInput();?>
    <?= $form->field($model,'end_at')->textInput();?>

    <button type="submit">确定</button>

    <?php ActiveForm::end();?>
</div>
