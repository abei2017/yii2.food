<div class="wechat-items">
    <?php foreach($data as $item):?>
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
                    <button>-</button>
                </div>
                <div class="ipt-box">
                    <input type="text" value="1">
                </div>
                <div class="up">
                    <button>+</button>
                </div>
            </div>
            <div class="tip">
                还剩xxx件
            </div>
            <div class="btn-box">
                <button class="weui-btn weui-btn_primary">抢购</button>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>