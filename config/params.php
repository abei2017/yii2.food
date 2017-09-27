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
            ['label'=>'控制台','url'=>['/admin/default/index']],
            ['label'=>'分类','url'=>['/admin/category/index']],
            ['label'=>'菜品','url'=>['/admin/dish/index']],
            ['label'=>'订单','url'=>['/admin/order/index']],
            ['label'=>'会员','url'=>['/admin/user/index']],
            ['label'=>'网站设置','url'=>['/admin/set/index']],
        ]
    ]
];
