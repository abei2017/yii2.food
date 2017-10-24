<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AdminAsset;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) : Yii::$app->name; ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
        seajs.config({
            base: "/js/admin/modules/"
        })
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="top-menu">
        <ul>
            <?php foreach(Yii::$app->params['admin']['topMenu'] as $key=>$top):?>
            <li>
                <a href="<?= Url::to($top['url']);?>">
                    <?php if(isset($top['icon'])):?>
                    <i class="fa <?= $top['icon'];?>"></i>
                    <?php endif;?>
                    <?= $top['label'];?>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php if(isset($this->params['menus'])):?>
    <div class="sub-menu">
        <?= Menu::widget([
                'items'=>$this->params['menus']
        ]);?>
    </div>
    <?php endif;?>
    <?= Breadcrumbs::widget([
        'homeLink'=>['label'=>'控制台','url'=>['/admin']],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
