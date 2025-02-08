<?php
namespace App\Models;

class Competence
{
    public static function all()
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->query("SELECT * FROM competences ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM competences WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($title, $description, $icon)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO competences (title, description, icon) 
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$title, $description, $icon]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $title, $description, $icon)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("
            UPDATE competences
            SET title = ?, description = ?, icon = ?
            WHERE id = ?
        ");
        $stmt->execute([$title, $description, $icon, $id]);
    }

    public static function delete($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("DELETE FROM competences WHERE id = ?");
        $stmt->execute([$id]);
    }
}
