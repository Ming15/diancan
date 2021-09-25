<?php
return [
    'miniProgram' => [
        'app_id' => 'wxd3a0959f8e820d90',
        'secret' => '26645a7dd9cada03cc10c29b49b81a21',

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/wechat.log'),
        ]
    ]
];
