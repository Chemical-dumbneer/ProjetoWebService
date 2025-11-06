<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            // Carrega variáveis do .env
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            $driver = $_ENV['DB_DRIVER'];
            $dbname = $_ENV['DB_NAME_DEV'];
            $user = $_ENV['DB_USER_DEV'];
            $pass = $_ENV['DB_PASS_DEV'];

            $socketPath = $_ENV['DB_SOCKET_PATH'];
            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];

            if ($socketPath) {
                // *** JEITO CORRETO PARA SOCKET NO PDO PGSQL ***
                $dsn = "$driver:host=$socketPath;dbname=$dbname";
            } else {
                // TCP
                $dsn = "$driver:host=$host;port=$port;dbname=$dbname";
            }

            self::$connection = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$connection;
    }
}