<?php
namespace App\Controllers;

use App\Models\Content;
use App\Models\Project;
use App\Models\User;
use App\Models\Competence;
use App\Models\ProjectGallery;

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
    
        $contentKey = $_GET['key'] ?? null;
    
        if (!$contentKey) {
            die("Clé de contenu manquante.");
        }
    
        // Récupérer le contenu existant depuis la BDD
        $currentContent = Content::getText($contentKey);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newText = $_POST['content_text'] ?? '';
            $imagePath = $currentContent['image']; // Conserver l'image existante par défaut
    
            // Gestion de l'upload d'image
            if (!empty($_FILES['content_image']['name'])) {
                $imagePath = $this->handleFileUpload($_FILES['content_image']);
            }
    
            // Mettre à jour le contenu
            Content::updateText($contentKey, $newText, $imagePath);
    
            header("Location: index.php?action=admin_dashboard");
            exit;
        }
    
        // Charger la vue avec les données existantes
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
    
        $id      = $_GET['id'] ?? null;
        $editing = !empty($id);
        $message = '';
    
        if ($editing) {
            $project = Project::find($id);
            $gallery = Project::getGallery($id);
        } else {
            $project = [
                'id'           => null,
                'title'        => '',
                'subtitle'     => '',
                'description'  => '',
                'techno'       => '',
                'presentation' => '',
                'image'        => ''
            ];
            $gallery = [];
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title        = $_POST['title'] ?? '';
            $subtitle     = $_POST['subtitle'] ?? '';
            $description  = $_POST['description'] ?? '';
            $techno       = $_POST['techno'] ?? '';
            $presentation = $_POST['presentation'] ?? '';
            $imagePath    = $project['image'];
    
            // Gestion de l'upload de l'image principale
            if (!empty($_FILES['image']['name'])) {
                $imagePath = $this->handleFileUpload($_FILES['image']);
            }
    
            // Mise à jour ou création
            if ($editing) {
                Project::update($id, $title, $subtitle, $description, $techno, $presentation, $imagePath);
                $message = "Projet mis à jour avec succès.";
            } else {
                $id = Project::create($title, $subtitle, $description, $techno, $presentation, $imagePath);
                $message = "Projet créé avec succès.";
            }
    
            // Gestion des images de la galerie
            if (isset($_FILES['gallery_images'])) {
                $this->handleGalleryUpload($id, $_FILES['gallery_images']);
            }
    
            // Recharge des données en cas d'édition
            if ($editing) {
                $project = Project::find($id);
                $gallery = Project::getGallery($id);
            }
        }
    
        require __DIR__ . '/../Views/admin/project_form.php';
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
        $competences = Competence::all();
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
            $competence = ['id' => null, 'title' => '', 'description' => '', 'icon' => ''];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $iconPath = $competence['icon'];

            if (!empty($_FILES['iconFile']['name'])) {
                $iconPath = $this->handleFileUpload($_FILES['iconFile'], 'image/svg+xml');
            }

            if ($editing) {
                Competence::update($id, $title, $description, $iconPath);
                $message = "Compétence mise à jour avec succès.";
            } else {
                Competence::create($title, $description, $iconPath);
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
        $fileName = basename($file['name']);
        $uniqueName = uniqid() . '_' . $fileName;
        $targetFile = $targetDir . $uniqueName;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!$allowedMimeType || $mimeType === $allowedMimeType) {
            if (move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public/' . $targetFile)) {
                return $targetFile;
            }
        }
        return null;
    }

    private function handleGalleryUpload($projectId, $files)
    {
        $count = count($files['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $files['name'][$i],
                    'tmp_name' => $files['tmp_name'][$i]
                ];
                $filePath = $this->handleFileUpload($file);
                if ($filePath) {
                    $alt = pathinfo($files['name'][$i], PATHINFO_FILENAME);
                    ProjectGallery::create($projectId, $filePath, $alt);
                }
            }
        }
    }
}
