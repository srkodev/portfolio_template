<?php
namespace App\Models;

use App\Models\DB;
use PDO;
use PDOException;

class Content
{
    public static function getText($key)
    {
        $pdo = DB::getPDO();
        $stmt = $pdo->prepare("SELECT content_text AS text, content_image AS image FROM contents WHERE content_key = ?");
        $stmt->execute([$key]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['text' => '', 'image' => ''];
    }

    public static function updateText($key, $text, $imagePath = null)
    {
        $pdo = DB::getPDO();
        try {
            if ($imagePath) {
                $stmt = $pdo->prepare("UPDATE contents SET content_text = ?, content_image = ? WHERE content_key = ?");
                $stmt->execute([$text, $imagePath, $key]);
            } else {
                $stmt = $pdo->prepare("UPDATE contents SET content_text = ? WHERE content_key = ?");
                $stmt->execute([$text, $key]);
            }
            $affected = $stmt->rowCount();
            error_log("Content update: $affected row(s) affected for key: " . $key);
            
            // Si aucune ligne n'est affectée, vous pouvez décider d'insérer la ligne
            if ($affected === 0) {
                error_log("Aucune ligne mise à jour pour key: " . $key . ". Insertion de la ligne.");
                $stmt = $pdo->prepare("INSERT INTO contents (content_key, content_text, content_image) VALUES (?, ?, ?)");
                $stmt->execute([$key, $text, $imagePath]);
                error_log("Nouvelle ligne insérée pour key: " . $key);
            }
        } catch (PDOException $e) {
            error_log("PDOException in updateText: " . $e->getMessage());
            throw $e;
        }
    }
}
