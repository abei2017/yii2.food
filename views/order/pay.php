<?php

?>
<script language="javascript" src="/js/LodopFuncs.js"></script>
<object  id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0>
    <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>

<div class="order-pay" id="order-pay">
    <?php if($model->state == 'pay'):?>
        支付成功，开始打印。。
    <?php else:?>
    <img src="<?= $qrcode->writeDataUri();?>" alt="">
    <?php endif;?>
</div>



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
    seajs.use('order',function(order){
        order.checkPay(<?= $model->id;?>);
    });
</script>