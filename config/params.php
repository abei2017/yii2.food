<?php

return [
    'adminEmail' => 'admin@example.com',

    'publicPages'=>[
        'default/login',
        'default/logout',
        'default/error'
    ],

    'admin'=>[
        'topMenu'=>[
            ['label'=>'控制台','url'=>['/admin/default/index'],'icon'=>'fa-bandcamp'],
            ['label'=>'分类','url'=>['/admin/category/index'],'icon'=>'fa-bars'],
            ['label'=>'菜品','url'=>['/admin/dish/index'],'icon'=>'fa-database'],
            ['label'=>'订单','url'=>['/admin/order/index'],'icon'=>'fa-cart-arrow-down'],
            ['label'=>'会员','url'=>['/admin/user/index'],'icon'=>'fa-users'],
            ['label'=>'管理员','url'=>['/admin/administrator/index'],'icon'=>'fa-address-book-o'],
            ['label'=>'网站设置','url'=>['/admin/set/index'],'icon'=>'fa-th'],
        ]
    ],

    // 微信的配置
    'wx'=>[
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => true,
        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id'  => '#',         // AppID
        'secret'  => '#',     // AppSecret
        'token'   => '#',          // Token
        'aes_key' => '',                    // EncodingAESKey，安全模式下请一定要填写！！！
        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => '/tmp/easywechat.log',
        ],
        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/wechat/default-oauth.html',
        ],
        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id'        => '#',
            'key'                => '#',
            'cert_path'          => '', // XXX: 绝对路径！！！！
            'key_path'           => '',      // XXX: 绝对路径！！！！
        ],
        /**
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],
    ],
];
