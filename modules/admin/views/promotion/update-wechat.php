<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin();?>
<?= $form->field($model,'dish_id')->dropDownList($dishes);?>
<?= $form->field($model,'price')->textInput();?>
<?= $form->field($model,'number')->textInput();?>
<?= $form->field($model,'state')->dropDownList([1=>'上架',0=>'下架']);?>
<?= $form->field($model,'max_number')->textInput();?>
    <div>
        <?= Html::submitButton("提交");?>
    </div>
<?php ActiveForm::end();?>