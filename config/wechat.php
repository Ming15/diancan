<?php
return [
    'miniProgram' => [
        'app_id' => env('MINI_PROGRAM_APPID'),
        'secret' => env('MINI_PROGRAM_SECRET'),

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/wechat.log'),
        ]
    ]
];
