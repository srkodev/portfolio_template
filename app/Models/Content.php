<?php
namespace App\Models;

use App\Models\DB;
use PDO;

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
        if ($imagePath) {
            $stmt = $pdo->prepare("UPDATE contents SET content_text = ?, content_image = ? WHERE content_key = ?");
            $stmt->execute([$text, $imagePath, $key]);
        } else {
            $stmt = $pdo->prepare("UPDATE contents SET content_text = ? WHERE content_key = ?");
            $stmt->execute([$text, $key]);
        }
    }
}
