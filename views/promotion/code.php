<?php
use yii\widgets\ActiveForm;
$this->title = '输码打印小票';
?>

<script language="javascript" src="/js/LodopFuncs.js"></script>
<object  id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0>
    <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>

<?php
$form = ActiveForm::begin([
    'action' => 'javascript:;',
    'id' => 'Form'
]);
?>
<div class="promotion-code">
    <div class="input-box">
        <input type="text" name="code" maxlength="8" minlength="8">
    </div>
    <div class="btn-box">
        <button id="actBtn" data-url="<?= \yii\helpers\Url::to(['/promotion/code']);?>">验证并打印</button>
    </div>
</div>
<?php
ActiveForm::end();
?>


<script id="printTpl" type="text/x-jsmart-tmpl">
        <table style="width:100%;border-collapse:collapse;font-family:黑体;margin-bottom:20px;">
            {foreach $dishes as $key=>$dish}
            <tr style="height:60px;">
                <td style="font-size:24px;">
                    {$dish.title}
                </td>
            </tr>
            <tr>
                <td>
                    单价：{$dish.price}
                    /
                    数量：{$dish.quantity}
                </td>
            </tr>
            {/foreach}
        </table>
</script>

<script type="text/javascript">
    seajs.use('promotion',function(promotion){
        promotion.checkCodeThenPrint();
    });
</script>