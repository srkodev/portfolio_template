<?php
namespace App\Controllers;

use App\Models\Project;
use App\Models\Content;
use App\Models\Competence;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FrontController
{
    public function home()
    {
        $aboutMe = Content::getText('about_me');
        $competences = Competence::all();
        $projects = Project::all();

        require __DIR__ . '/../Views/front/home.php';
    }

    public function projectDetail($id)
    {
        if (!$id) {
            die("ID projet manquant");
        }
        $project = Project::find($id);
        if (!$project) {
            die("Projet introuvable");
        }

        require __DIR__ . '/../Views/front/project_detail.php';
    }

    public function handleContactForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            $captchaResponse = $_POST['cf-turnstile-response'] ?? '';

            // Vérifier le CAPTCHA
            if (!$this->verifyCaptcha($captchaResponse)) {
                $error = "Échec de la validation du CAPTCHA.";
            } elseif (empty($name) || empty($email) || empty($message)) {
                $error = "Tous les champs sont obligatoires.";
            } else {
                // Envoyer l'email en utilisant la méthode sendEmail
                if ($this->sendEmail($name, $email, $message)) {
                    $success = "Votre message a été envoyé avec succès.";
                } else {
                    $error = "Une erreur est survenue lors de l'envoi.";
                }
            }

            // Recharger la page d'accueil avec les messages d'erreur ou de succès
            $aboutMe = Content::getText('about_me');
            $competences = Competence::all();
            $projects = Project::all();

            require __DIR__ . '/../Views/front/home.php';
        }
    }
    
    private function sendEmail($name, $email, $message)
    {
        $config = require __DIR__ . '/../../config/email.php';

        try {
            $mailer = new PHPMailer(true);

            // Configuration SMTP
            $mailer->isSMTP();
            $mailer->Host       = $config['host'];
            $mailer->SMTPAuth   = true;
            $mailer->Username   = $config['username'];
            $mailer->Password   = $config['password'];
            $mailer->SMTPSecure = $config['encryption'];
            $mailer->Port       = $config['port'];

            // Expéditeur et destinataire
            $mailer->setFrom($config['from_email'], $config['from_name']);
            $mailer->addAddress($config['to_email'], $config['to_name']);

            // Contenu de l'e-mail
            $mailer->isHTML(true);
            $mailer->Subject = "Nouveau message de $name";
            $mailer->Body    = "
                <p><strong>Nom :</strong> $name</p>
                <p><strong>Email :</strong> $email</p>
                <p><strong>Message :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
            ";

            $mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'e-mail : " . $e->getMessage());
            return false;
        }
    }

    private function verifyCaptcha($captchaResponse)
    {
        $secretKey = '0x4AAAAAAA8N83denFCtj5_kViMnzAro0oI'; // Remplacez par votre clé secrète
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://challenges.cloudflare.com/turnstile/v0/siteverify");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'secret' => $secretKey,
            'response' => $captchaResponse,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
        return $responseData['success'] ?? false;
    }
}
