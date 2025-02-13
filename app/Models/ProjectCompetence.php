<?php
namespace App\Models;

use PDO;

class ProjectCompetence
{
    // Synchronise (met à jour) les compétences associées à un projet
    public static function sync($projectId, $competenceIds)
    {
        $db = DB::getPDO();
        
        error_log("ProjectCompetence::sync called with projectId: $projectId and competenceIds: " . print_r($competenceIds, true));

        // Supprimer les associations existantes pour ce projet
        $stmt = $db->prepare("DELETE FROM project_competences WHERE project_id = ?");
        if (!$stmt->execute([$projectId])) {
            error_log("Erreur lors de la suppression des compétences existantes pour le projet $projectId : " . print_r($stmt->errorInfo(), true));
        } else {
            error_log("Suppression réussie des compétences existantes pour le projet $projectId");
        }

        // Convertir $competenceIds en tableau si nécessaire
        if (!is_array($competenceIds)) {
            error_log("competenceIds n'est pas un tableau, tentative de décodage JSON");
            $decoded = json_decode($competenceIds, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $competenceIds = $decoded;
                error_log("Décodage JSON réussi : " . print_r($competenceIds, true));
            } else {
                $competenceIds = [$competenceIds];
                error_log("Utilisation de competenceIds en tant que tableau : " . print_r($competenceIds, true));
            }
        }

        // Insérer les nouvelles associations (uniquement si $competenceIds n'est pas vide)
        if (!empty($competenceIds)) {
            $stmt = $db->prepare("INSERT INTO project_competences (project_id, competence_id) VALUES (?, ?)");
            foreach ($competenceIds as $compId) {
                // S'assurer que $compId est une valeur numérique avant d'insérer
                if (!is_numeric($compId)) {
                    error_log("Compétence ignorée (non numérique) : " . $compId);
                    continue;
                }
                if (!$stmt->execute([$projectId, $compId])) {
                    error_log("Erreur lors de l'insertion pour le projet $projectId, compétence $compId : " . print_r($stmt->errorInfo(), true));
                } else {
                    error_log("Insertion réussie pour le projet $projectId, compétence $compId");
                }
            }
        } else {
            error_log("Aucune compétence à insérer pour le projet $projectId.");
        }
    }

    // Récupère les IDs des compétences assignées à un projet
    public static function getCompetenceIdsByProject($projectId)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("SELECT competence_id FROM project_competences WHERE project_id = ?");
        $stmt->execute([$projectId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ids = [];
        foreach ($rows as $row) {
            $ids[] = $row['competence_id'];
        }
        error_log("getCompetenceIdsByProject for project $projectId: " . print_r($ids, true));
        return $ids;
    }

    // Récupère les compétences complètes assignées à un projet
    public static function getCompetencesByProject($projectId)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("SELECT c.* FROM competences c
                              INNER JOIN project_competences pc ON c.id = pc.competence_id
                              WHERE pc.project_id = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Récupère les IDs des projets associés à une compétence donnée
    public static function getProjectIdsByCompetence($competenceId)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("SELECT project_id FROM project_competences WHERE competence_id = ?");
        $stmt->execute([$competenceId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $projectIds = [];
        foreach ($rows as $row) {
            $projectIds[] = $row['project_id'];
        }
        return $projectIds;
    }
}
