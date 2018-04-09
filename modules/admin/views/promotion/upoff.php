<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>


<div class="set">
    <?php $form = ActiveForm::begin([
        'id' => 'Form',
        'action' => 'javascript:;'
    ]);?>

    <div class="form-group">
        <label for="">是否激活</label>
        <?= Html::dropDownList('state',isset($conf['state']) ? $conf['state'] : 0,[1=>'激活',0=>'未激活']);?>
    </div>
    <div class="form-group">
        <label for="">订单金额</label>
        <?= Html::textInput('up_money',isset($conf['up_money']) ? $conf['up_money'] : 0);?>
    </div>
    <div class="form-group">
        <label for="">减掉金额</label>
        <?= Html::textInput('off_money',isset($conf['off_money']) ? $conf['off_money'] : 0);?>
    </div>
    <div class="form-group">
        <label for="">开始时间</label>
        <?= Html::textInput('begin_time',isset($conf['begin_time']) ? date('Y-m-d H:i:s',$conf['begin_time']) : date('Y-m-d H:i:s'));?>
    </div>
    <div class="form-group">
        <label for="">结束时间</label>
        <?= Html::textInput('end_time',isset($conf['end_time'])&&$conf['end_time']>0 ? date('Y-m-d H:i:s',$conf['end_time']) : 0);?>
    </div>
    <button type="button" id="_actBtn" data-url="<?= Url::to(['/admin/promotion/upoff']);?>">确定</button>

    <?php ActiveForm::end();?>
</div>

<script type="text/javascript">
    $('#_actBtn').click(function(){
        var url = $(this).attr('data-url');
        $.post(url,$('#Form').serializeArray(),function(d){
            if(d.done == true){
                window.location.reload();
            }else{
                alert(d.error);
            }
        },'json');
    });
</script>
