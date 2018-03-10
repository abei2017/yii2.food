<?php
$this->title = '我的消费记录';
?>

<div>
    <?php foreach($orders as $o):?>
        <div>
            <h1>
                #<?= $o->id;?>
                金额<?= $o->money;?>
                数量<?= $o->quantity;?>
            </h1>
            <ul>
                <?php foreach($o->dishes as $od):?>
                <li>
                    <span><?= $od->dish->title;?></span>
                    <span>
                        数量<?= $od->quantity;?>
                    </span>
                    <span>
                        价格:<?= $od->money;?>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endforeach;?>
</div>
