<?php
namespace App\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerService
{
  private PHPMailer $mailer;

  public function __construct()
  {
    $this->mailer = new PHPMailer();
    $this->mailer->isSMTP();
    $this->mailer->Host = 'mailhog';
    $this->mailer->Port = 1025;
    $this->mailer->setFrom('christopherdebray@outlook.fr', 'Christopher Debray');
  }

  public function sendEmail(string $target, string $subject, string $content)
  {
    try {
      $this->mailer->addAddress($target, null);
      $this->mailer->Subject = $subject;
      $this->mailer->Body = $content;
      $this->mailer->send();
    } catch (Exception $e) {
      echo $e->errorMessage();
    }
  }
}