<?php
$this->title = '';
?>

<div class="site-index">
    <div class="cart-box">

    </div>
    <div class="category-box" id="category-box">
        <?php foreach($cats as $cat):?>
        <ul>
            <li class="title"><?= $cat->name;?></li>
            <?php foreach($cat->children as $child):?>
            <li class="item _category" data-url="">
                <?= $child->name;?>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endforeach;?>
    </div>
    <div class="dish-box">

    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        resizeLayout();
    });

    $(window).resize(function() {
        resizeLayout();
    });

    function resizeLayout(){
        var h = $(window).innerHeight();
        $('#category-box').height(h-30);
    };

    seajs.use(['category'],function(category){
        category.dishes();
    });
</script>
