<?php
namespace App\Models;

class User
{
    public static function findByUsername($username)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}
