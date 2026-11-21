<?php
final class Database {
    public static function conectar(): PDO {
        $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=biblioteca;charset=utf8mb4';
        
        return new PDO(
            $dsn, 
            getenv('DB_USER'), 
            getenv('DB_PASSWORD'), 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
}