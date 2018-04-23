<?php
namespace app\models;

use Payment\Notify\PayNotifyInterface;
use Payment\Config;
use app\models\Order;

class AlipayNotify implements PayNotifyInterface
{
    public function notifyProcess(array $data)
    {
        $payId = $data['out_trade_no'];
        @list($type, $id, $_) = explode('-', $payId);
        $model = Order::findOne($id);

        $model->state = 'pay';
        $model->paid_at = time();
        $model->transaction_id = $data['trade_no'];
        $model->update();

        return true;
    }
}