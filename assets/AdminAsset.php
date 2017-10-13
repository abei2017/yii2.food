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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/webuploader/webuploader.css',
        'css/font-awesome-4.7.0/css/font-awesome.min.css',
        'css/admin/index.css',
    ];
    public $js = [
        'js/webuploader/webuploader.html5only.js',
        'https://cdn.bootcss.com/seajs/3.0.2/sea.js',
//        'js/artDialog/dialog.js',
        'js/admin/jsmart.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $jsOptions = [
        'position'=>View::POS_HEAD
    ];
}
