<?php

class Database
{
    public static $host;
    public static $dbname;
    public static $dbUsername;
    public static $dbPassword;

    public function __construct()
    {
        self::$host = "127.0.0.1";
        self::$dbname = "blog";
        self::$dbUsername = "root";
        self::$dbPassword = "";
    }

    public static function conn()
    {
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname;
            $pdo = new PDO($dsn, self::$dbUsername, self::$dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            exit('Database Connection Failed: ' . $e->getMessage());
        }
    }
}
