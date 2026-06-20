<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

class DB
{
    private static ?PDO $instance = null;

    public static function connect(): PDO
    {
        if (self::$instance === null) {
            // Step out of src/Core/ to find your cnf/ folder
            $config = require __DIR__ . '/../../cnf/config.php';
            
            $db = $config['db'];
            
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", $db['host'], $db['database'], $db['charset']);
            self::$instance = new PDO($dsn, $db['username'], $db['password'], $db['options']);
        }
        return self::$instance;
    }
}
