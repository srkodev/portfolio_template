<?php
namespace App\Controllers;

use App\Models\Content;
use App\Models\Project;
use App\Models\User;
use App\Models\Competence;
use App\Models\ProjectGallery;
use App\Models\ProjectCompetence;

class AdminController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $pass     = $_POST['password'] ?? '';

            $user = User::findByUsername($username);
            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                header("Location: index.php?action=admin_dashboard");
                exit;
            } else {
                $error = "Identifiants incorrects.";
            }
        }
        require __DIR__ . '/../Views/admin/login.php';
    }

    public function dashboard()
    {
        $this->checkAdmin();
        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?action=home");
        exit;
    }

    public function editContent()
    {
        $this->checkAdmin();

        // Priorité à la clé transmise via POST, sinon GET
        $contentKey = $_POST['content_key'] ?? $_GET['key'] ?? null;
        if (!$contentKey) {
            die("Clé de contenu manquante.");
        }
        error_log("EditContent called with contentKey: " . $contentKey);

        // Récupérer le contenu existant depuis la BDD
        $currentContent = Content::getText($contentKey);
        error_log("Current content from DB: " . print_r($currentContent, true));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newText = $_POST['content_text'] ?? '';
            $imagePath = $currentContent['image'];

            error_log("POST data: " . print_r($_POST, true));
            error_log("FILES data: " . print_r($_FILES, true));

            if (!empty($_FILES['content_image']['name'])) {
                $uploadResult = $this->handleFileUpload($_FILES['content_image']);
                if ($uploadResult) {
                    $imagePath = $uploadResult;
                    error_log("Uploaded image path: " . $imagePath);
                } else {
                    error_log("Image upload failed.");
                }
            }

            try {
                Content::updateText($contentKey, $newText, $imagePath);
                error_log("Content updated successfully for key: " . $contentKey);
            } catch (\Exception $e) {
                error_log("Error updating content: " . $e->getMessage());
                die("Erreur lors de la mise à jour du contenu : " . $e->getMessage());
            }

            header("Location: index.php?action=admin_dashboard");
            exit;
        }

        require __DIR__ . '/../Views/admin/content_form.php';
    }

    // --- PROJETS ---
    public function projectsList()
    {
        $this->checkAdmin();
        $projects = Project::all();
        require __DIR__ . '/../Views/admin/projects_list.php';
    }

    public function projectForm()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;
        $editing = !empty($id);
        $message = '';

        // Récupérer toutes les compétences
        $allCompetences = Competence::all();

        if ($editing) {
            $project = Project::find($id);
            $gallery = ProjectGallery::allByProject($id);
            // Récupérer les IDs des compétences assignées au projet
            $projectCompetences = ProjectCompetence::getCompetenceIdsByProject($id);
        } else {
            $project = [
                'id' => null,
                'title' => '',
                'subtitle' => '',
                'description' => '',
                'techno' => '', // Ce champ n'est plus utilisé pour les compétences
                'presentation' => '',
                'image' => '',
                'link' => ''
            ];
            $gallery = [];
            $projectCompetences = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // --- Sécurité : Vérification de la taille des fichiers ---
            // Vérifier l'image principale
            if (!empty($_FILES['image']['name']) && $_FILES['image']['size'] > 8388608) {
                $message = "L'image principale dépasse la taille maximale autorisée de 8MB.";
                require __DIR__ . '/../Views/admin/project_form.php';
                exit;
            }
            // Vérifier chaque image de la galerie
            if (!empty($_FILES['gallery_images']['name'][0])) {
                foreach ($_FILES['gallery_images']['size'] as $size) {
                    if ($size > 8388608) {
                        $message = "Une des images de la galerie dépasse la taille maximale autorisée de 8MB.";
                        require __DIR__ . '/../Views/admin/project_form.php';
                        exit;
                    }
                }
            }
            // --- Fin vérifications ---

            $title = $_POST['title'] ?? '';
            $subtitle = $_POST['subtitle'] ?? '';
            $description = $_POST['description'] ?? '';
            // On ignore le champ 'techno' puisque les compétences sont gérées via la table pivot
            $techno = '';
            $presentation = $_POST['presentation'] ?? '';
            $link = $_POST['link'] ?? '';

            $imagePath = $project['image'];

            if (!empty($_FILES['image']['name'])) {
                $imagePath = $this->handleFileUpload($_FILES['image']);
            }

            if ($editing) {
                Project::update($id, $title, $subtitle, $description, $techno, $presentation, $imagePath, $link);
                $message = "Projet mis à jour avec succès.";
            } else {
                $id = Project::create($title, $subtitle, $description, $techno, $presentation, $imagePath, $link);
                $message = "Projet créé avec succès.";
            }

            // Suppression d'images
            if (!empty($_POST['delete_images'])) {
                $deletedImages = json_decode($_POST['delete_images'], true);
                if (is_array($deletedImages)) {
                    foreach ($deletedImages as $imageId) {
                        $image = ProjectGallery::find($imageId);
                        if ($image && $image['project_id'] == $id) {
                            $filePath = __DIR__ . '/../../public/' . $image['src'];
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                            ProjectGallery::delete($imageId);
                        }
                    }
                }
            }

            // Nouvelles images de la galerie
            if (!empty($_FILES['gallery_images']['name'][0])) {
                $this->handleGalleryUpload($id, $_FILES['gallery_images']);
            }

            // Synchronisation des compétences assignées via le modèle dédié
            // On décode ici la chaîne JSON envoyée depuis le champ caché
            $selectedCompetences = isset($_POST['competences']) ? json_decode($_POST['competences'], true) : [];
            if (!is_array($selectedCompetences)) {
                $selectedCompetences = [];
            }
            ProjectCompetence::sync($id, $selectedCompetences);

            // Recharger les données après modification
            $project = Project::find($id);
            $gallery = ProjectGallery::allByProject($id);
            $projectCompetences = ProjectCompetence::getCompetenceIdsByProject($id);
        }

        require __DIR__ . '/../Views/admin/project_form.php';
    }

    private function syncGallery($projectId, $existingGallery)
    {
        $currentGallery = ProjectGallery::allByProject($projectId);
        foreach ($currentGallery as $image) {
            if (!in_array($image['id'], $existingGallery)) {
                $filePath = __DIR__ . '/../../public/' . $image['src'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                ProjectGallery::delete($image['id']);
            }
        }
    }

    public function projectDelete()
    {
        $this->checkAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Project::delete($id);
        }
        header("Location: index.php?action=admin_projects_list");
        exit;
    }

    public function deleteGalleryImage()
    {
        $this->checkAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $image = ProjectGallery::find($id);
            if ($image) {
                $filePath = __DIR__ . '/../../public/' . $image['src'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                ProjectGallery::delete($id);
            }
        }
        $project_id = $image['project_id'] ?? null;
        header("Location: index.php?action=admin_project_form&id=" . $project_id);
        exit;
    }

    // --- COMPETENCES ---
    public function competencesList()
    {
        $this->checkAdmin();
        $allCompetences = Competence::all();
        require __DIR__ . '/../Views/admin/competences_list.php';
    }

    public function competenceForm()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;
        $editing = !empty($id);
        $message = '';

        if ($editing) {
            $competence = Competence::find($id);
        } else {
            $competence = ['id' => null, 'title' => '', 'description' => '', 'icon' => '', 'category' => ''];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $category = $_POST['category'] ?? '';
            $iconPath = $competence['icon'];

            if (!empty($_FILES['iconFile']['name'])) {
                $iconPath = $this->handleFileUpload($_FILES['iconFile'], 'image/svg+xml');
            }

            if ($editing) {
                Competence::update($id, $title, $description, $iconPath, $category);
                $message = "Compétence mise à jour avec succès.";
            } else {
                Competence::create($title, $description, $iconPath, $category);
                $message = "Compétence créée avec succès.";
            }
        }

        require __DIR__ . '/../Views/admin/competence_form.php';
    }

    public function competenceDelete()
    {
        $this->checkAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Competence::delete($id);
        }
        header("Location: index.php?action=admin_competences_list");
        exit;
    }

    private function checkAdmin()
    {
        if (empty($_SESSION['admin_logged_in'])) {
            header("Location: index.php?action=admin_login");
            exit;
        }
    }

    private function handleFileUpload($file, $allowedMimeType = null)
    {
        $targetDir = 'uploads/';
        $fileName = $this->cleanFileName(basename($file['name']));
        $uniqueName = uniqid() . '_' . $fileName;
        $targetFile = $targetDir . $uniqueName;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            throw new \Exception("finfo_open() a échoué.");
        }
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!$allowedMimeType || $mimeType === $allowedMimeType) {
            if (move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public/' . $targetFile)) {
                return $targetFile;
            }
        }
        return null;
    }

    private function cleanFileName($filename)
    {
        $filename = preg_replace('/[^A-Za-z0-9\.-]/', '_', $filename);
        $filename = preg_replace('/_+/', '_', $filename);
        $filename = trim($filename, '_');
        return $filename;
    }

    private function handleGalleryUpload($projectId, $files)
    {
        $uploadDir = 'uploads/gallery/';
        $baseDir = __DIR__ . '/../../public/' . $uploadDir;

        if (!file_exists($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $fileCount = count($files['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                // Vérification de la taille déjà effectuée côté contrôleur
                $tmpName = $files['tmp_name'][$i];
                $originalName = $files['name'][$i];
                $cleanFileName = $this->cleanFileName($originalName);
                $uniqueName = uniqid() . '_' . $cleanFileName;
                $filePath = $uploadDir . $uniqueName;
                $fullPath = $baseDir . $uniqueName;

                if (move_uploaded_file($tmpName, $fullPath)) {
                    $alt = pathinfo($originalName, PATHINFO_FILENAME);
                    ProjectGallery::create($projectId, $filePath, $alt);
                }
            }
        }
    }
}
