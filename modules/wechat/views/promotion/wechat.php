
<div class="wechat-items">
    <?php foreach($data as $item):?>
        <?php
            if($item->max_number == 0 && $item->number == 0){
                $max = -1;
            }else{
                $mins = [];

                if($item->max_number > 0){
                    $mins[] = $item->max_number;
                }

                if($item->number > 0){
                    if($item->number > $item->sold_number){
                        $mins[] = $item->number - $item->sold_number;
                    }else{
                        $mins[] = 0;
                    }
                }


                $max = empty($mins) ? 0 : min($mins);
            }
        ?>
    <div class="item">
        <div class="item-info">
            <div class="image">
                <img src="/static/<?= $item->dish->image;?>" alt="">
            </div>
            <div class="info">
                <h1>
                    <?= $item->dish->title;?>
                    <?php if($item->max_number > 0):?>
                    <span>(每单最多<?= $item->max_number;?>件)</span>
                    <?php endif;?>
                </h1>
                <div class="price">
                    <strong>￥<?= $item->price;?></strong>
                    <span>￥<?= $item->dish->price;?></span>
                </div>
            </div>
        </div>
        <div class="item-buy">
            <div class="quantity-box">
                <div class="down">
                    <button class="_dir" data-dir="down" data-id="<?= $item->id;?>">-</button>
                </div>
                <div class="ipt-box">
                    <input type="text" id="quantity-<?= $item->id;?>" value="1">
                </div>
                <div class="up">
                    <button class="_dir" data-dir="up" data-max-number="<?= $max;?>" data-id="<?= $item->id;?>">+</button>
                </div>
            </div>
            <?php if($item->number > 0):?>
            <div class="tip">
                还剩 <strong><?= $item->number - $item->sold_number;?></strong> 件
            </div>
            <?php endif;?>
            <div class="btn-box">
                <button class="weui-btn weui-btn_primary _buy" data-url="<?= \yii\helpers\Url::to(['/wechat/promotion/buy','id'=>$item->id]);?>" data-id="<?= $item->id;?>">抢购</button>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>

<div id="wxjs"></div>

<script type="text/javascript">
    seajs.use('promotion',function(promotion){
        promotion.buy();
        promotion.upDown();
    });
</script>