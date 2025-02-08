<?php
namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mailer;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/email.php';
        $this->mailer = new PHPMailer(true);

        try {
            // Configuration SMTP
            $this->mailer->isSMTP();
            $this->mailer->Host = $config['host'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $config['username'];
            $this->mailer->Password = $config['password'];
            $this->mailer->SMTPSecure = $config['encryption'];
            $this->mailer->Port = $config['port'];

            // Expéditeur par défaut
            $this->mailer->setFrom($config['from_email'], $config['from_name']);
        } catch (Exception $e) {
            die("Erreur de configuration du mailer : " . $e->getMessage());
        }
    }

    public function send($toEmail, $toName, $subject, $body)
    {
        try {
            $this->mailer->addAddress($toEmail, $toName);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            die("Erreur d'envoi de l'e-mail : " . $e->getMessage());
        }
    }
}
