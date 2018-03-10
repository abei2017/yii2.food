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
class WechatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/wechat/weui.min.css',
        'css/wechat/index.css',
    ];
    public $js = [
        'js/wechat/weui.min.js',
        'https://cdn.bootcss.com/seajs/3.0.2/sea.js',
    ];
    public $depends = [
    ];

    public $jsOptions = [
        'position'=>View::POS_HEAD
    ];
}
