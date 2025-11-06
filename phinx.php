<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter'      => 'pgsql',
            'unix_socket'  => $_ENV['DB_SOCKET'] ?? '/run/postgresql',
            'name'         => $_ENV['DB_NAME_DEV']   ?? 'webservidor_dev',
            'user'         => $_ENV['DB_USER_DEV']   ?? 'postgres',
            'pass'         => $_ENV['DB_PASS_DEV']   ?? '',
            'port'         => 5432,
            'charset'      => 'utf8',
        ],
        'development' => [
            'adapter'      => 'pgsql',
            'unix_socket'  => $_ENV['DB_SOCKET'] ?? '/run/postgresql',
            'name'         => $_ENV['DB_NAME_MODEL']   ?? 'webservidor_model',
            'user'         => $_ENV['DB_USER_MODEL']   ?? 'postgres',
            'pass'         => $_ENV['DB_PASS_MODEL']   ?? '',
            'port'         => 5432,
            'charset'      => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
