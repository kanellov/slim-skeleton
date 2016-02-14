<?php

return [
    'modules' => [
        'module/app/init.php',
        'module/debug/init.php',
    ],
    'config_glob_path' => 'config/settings/{{,*.}global,{,*.}local}.php',
    'config_cache'     => 'data/cache/config.php',
];
