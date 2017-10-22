<?php

?>

<div class="order-pay" id="order-pay">
    <img src="<?= $qrcode->writeDataUri();?>" alt="">
</div>

<script type="text/javascript">
    seajs.use('order',function(order){
        order.checkPay(<?= $model->id;?>);
    });
</script>