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
    ]
];
