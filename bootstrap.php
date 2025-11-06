<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$root = __DIR__;

// Só tenta carregar o .env se ele existir
if (file_exists($root . '/.env')) {
    $dotenv = Dotenv::createImmutable($root);
    $dotenv->load();
}

require_once __DIR__ . '/config/database.php';