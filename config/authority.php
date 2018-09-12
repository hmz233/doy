<?php
return [
    'menu' => [
        'A1' => [
            'icon' => '&#xe612;',
            'title' => '管理员',
            '_child' => [
                'A11' => [
                    'icon' => '&#xe621;',
                    'title' => '管理员列表',
                    'url' => 'managerList',
                    '_child' => [
                        'A111' => ['title' => '添加管理员', 'url' => 'managerAdd'],
                        'A112' => ['title' => '编辑管理员', 'url' => 'managerEdit'],
                        'A113' => ['title' => '删除管理员', 'url' => 'managerDel'],
                        'A114' => ['title' => '修改账户状态', 'url' => 'managerHandle'],
                    ]
                ],
                'A12' => [
                    'icon' => '&#xe621;',
                    'title' => '权限管理',
                    'url' => 'authorityList',
                    '_child' => [
                        'A121' => ['title' => '添加权限组', 'url' => 'authorityAdd'],
                        'A122' => ['title' => '编辑权限组', 'url' => 'authorityEdit'],
                        'A123' => ['title' => '删除权限组', 'url' => 'authorityDel'],
                        'A124' => ['title' => '访问授权', 'url' => 'authority'],
                    ]
                ],
            ]
        ],

    ]
];