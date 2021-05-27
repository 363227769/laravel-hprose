<?php

return [
    'server' => [
        'tcp_uris' => [
            'tcp://0.0.0.0:1314',
        ],
        'routepath' => glob(base_path("rpc") . '/*.php')
    ],
    'client' => [
        'tcp_uris' => [
            'tcp://0.0.0.0:1314',
        ],
    ],
];