<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'https://cdn.bootcss.com/seajs/3.0.2/sea.js',
        'js/admin/jsmart.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $jsOptions = [
        'position'=>View::POS_HEAD
    ];
}
