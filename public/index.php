<?php
session_start();

// Chargement manuel (ou via autoloader) :
require_once __DIR__ . '/../app/Models/DB.php';
require_once __DIR__ . '/../app/Models/Project.php';
require_once __DIR__ . '/../app/Models/Content.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Models/Competence.php';
require_once __DIR__ . '/../app/Models/ProjectGallery.php'; // Ajoute cette ligne

require_once __DIR__ . '/../app/Controllers/FrontController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\FrontController;
use App\Controllers\AdminController;

// Instanciation des contrôleurs
$frontController = new FrontController();
$adminController = new AdminController();

// Détermination de l'action via l'URL
$action = $_GET['action'] ?? 'home';

switch ($action) {
    // --- PARTIE "FRONT" ---
    case 'home':
        $frontController->home();
        break;

    case 'project_detail':
        $id = $_GET['id'] ?? null;
        $frontController->projectDetail($id);
        break;

    // --- PARTIE "ADMIN" ---
    case 'admin_login':
        $adminController->login();
        break;

    case 'admin_dashboard':
        $adminController->dashboard();
        break;

    case 'admin_logout':
        $adminController->logout();
        break;

    // Modifier un contenu (ex: about_me, competences TEXT)
    case 'admin_edit_content':
        $adminController->editContent();
        break;

    // Liste des projets
    case 'admin_projects_list':
        $adminController->projectsList();
        break;

    // Formulaire Add/Edit projet
    case 'admin_project_form':
        $adminController->projectForm();
        break;

    // Supprimer un projet
    case 'admin_project_delete':
        $adminController->projectDelete();
        break;

    // *** NOUVELLES ROUTES POUR LES COMPETENCES (cartes) ***
    case 'admin_competences_list':
        $adminController->competencesList();
        break;

    case 'admin_competence_form':
        $adminController->competenceForm();
        break;

    case 'admin_competence_delete':
        $adminController->competenceDelete();
        break;
        
    case 'admin_project_delete_gallery_image':
        $adminController->deleteGalleryImage();
        break;
    
    case 'handle_contact_form':
        $frontController->handleContactForm();
        break;

    default:
        // 404 ou redirection par défaut
        $frontController->home();
        break;
}
?>
