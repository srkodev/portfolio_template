<?php
namespace App\Models;

use PDO;
use PDOException;

class DB
{
    private static $pdo = null;

    public static function getPDO()
    {
        if (self::$pdo === null) {
            $host = 'localhost';
            $db   = 'portfolio_db';
            $user = 'portfolio_user';
            $pass = 'portfolio_user';

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            try {
                self::$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, $options);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
