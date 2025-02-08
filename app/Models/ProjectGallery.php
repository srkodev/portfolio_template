<?php
namespace App\Models;

use PDO;
use App\Models\DB;

class ProjectGallery
{
    /**
     * Récupère toutes les images de la galerie pour un projet spécifique.
     *
     * @param int $project_id
     * @return array
     */
    public static function allByProject($project_id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE project_id = ? ORDER BY id DESC");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve une image de galerie par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function find($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle entrée dans la galerie d'un projet.
     *
     * @param int $project_id
     * @param string $src
     * @param string $alt
     * @return int
     */
    public static function create($project_id, $src, $alt)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("INSERT INTO project_gallery (project_id, src, alt) VALUES (?, ?, ?)");
        $stmt->execute([$project_id, $src, $alt]);
        return $pdo->lastInsertId();
    }

    /**
     * Ajoute une image à la galerie d'un projet.
     *
     * @param int $project_id
     * @param string $src
     * @param string $alt
     * @return int
     */
    public static function addGalleryImage($project_id, $src, $alt)
    {
        return self::create($project_id, $src, $alt);
    }

    /**
     * Met à jour une image de la galerie.
     *
     * @param int $id
     * @param string $src
     * @param string $alt
     * @return void
     */
    public static function update($id, $src, $alt)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("UPDATE project_gallery SET src = ?, alt = ? WHERE id = ?");
        $stmt->execute([$src, $alt, $id]);
    }

    /**
     * Supprime une image de la galerie par son ID.
     *
     * @param int $id
     * @return void
     */
    public static function delete($id)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("DELETE FROM project_gallery WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
