<?php
namespace App\Models;

use PDO;

class Project
{
    public static function all() {
        $db = DB::getPDO();
        $stmt = $db->query("SELECT * FROM projects ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = DB::getPDO();
        $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $subtitle, $description, $techno, $presentation, $image, $link) {
        $db = DB::getPDO();
        $stmt = $db->prepare("INSERT INTO projects (title, subtitle, description, techno, presentation, image, link) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $subtitle, $description, $techno, $presentation, $image, $link]);
        return $db->lastInsertId();
    }

    public static function update($id, $title, $subtitle, $description, $techno, $presentation, $image, $link) {
        $db = DB::getPDO();
        $stmt = $db->prepare("UPDATE projects SET title = ?, subtitle = ?, description = ?, techno = ?, presentation = ?, image = ?, link = ? WHERE id = ?");
        $stmt->execute([$title, $subtitle, $description, $techno, $presentation, $image, $link, $id]);
    }

    public static function delete($id) {
        $db = DB::getPDO();
        $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
    }
}
