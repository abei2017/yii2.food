<script type="text/javascript">
    function jsApiCall() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?= $json ?>,
            function(res){
                if(res.err_msg === 'get_brand_wcpay_request:ok'){
                    window.location.href = "<?= Yii::$app->urlManager->createUrl(['/wechat/promotion/result','id'=>$o->id]);?>";
                }else if(res.err_msg === 'get_brand_wcpay_request:cancel'){
                    weui.alert('支付被取消');
                }else if(res.err_msg === 'get_brand_wcpay_request:fail'){
                    weui.alert('error');
                }
            }
        );
    }

    function callpay() {

        if (typeof WeixinJSBridge == "undefined"){

            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{

            jsApiCall();
        }
    }

    callpay();

</script>