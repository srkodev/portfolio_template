<?php
namespace App\Models;

use PDO;
use App\Models\DB;

class ProjectGallery
{
    public static function allByProject($project_id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE project_id = ? ORDER BY id DESC");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($project_id, $src, $alt)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("INSERT INTO project_gallery (project_id, src, alt) VALUES (?, ?, ?)");
        $stmt->execute([$project_id, $src, $alt]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $src, $alt)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("UPDATE project_gallery SET src = ?, alt = ? WHERE id = ?");
        $stmt->execute([$src, $alt, $id]);
    }

    public static function delete($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("DELETE FROM project_gallery WHERE id = ?");
        $stmt->execute([$id]);
    }
}
