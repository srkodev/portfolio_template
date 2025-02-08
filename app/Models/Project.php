<?php
namespace App\Models;

class Project
{
    public static function all()
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        $project = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($project) {
            $project['gallery'] = ProjectGallery::allByProject($id);
        }

        return $project;
    }

    public static function create($title, $subtitle, $description, $techno, $presentation, $imagePath)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO projects (title, subtitle, description, techno, presentation, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$title, $subtitle, $description, $techno, $presentation, $imagePath]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $title, $subtitle, $description, $techno, $presentation, $imagePath)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("
            UPDATE projects
            SET title = ?, subtitle = ?, description = ?, techno = ?, presentation = ?, image = ?
            WHERE id = ?
        ");
        $stmt->execute([$title, $subtitle, $description, $techno, $presentation, $imagePath, $id]);
    }    

    public static function delete($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function getGallery($projectId)
    {
        return ProjectGallery::allByProject($projectId);
    }
}
