<?php
namespace App\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\core\DotEnv;

class MailerService
{
  private PHPMailer $mailer;

  public function __construct()
  {
    (new DotEnv(dirname(__DIR__) . '/.env'))->load();

    $this->mailer = new PHPMailer();
    $this->mailer->isSMTP();
    $this->mailer->Host = $_ENV['MAIL_HOST'];
    $this->mailer->Port = $_ENV['MAIL_PORT'];
    $this->mailer->setFrom($_ENV['MAIL_USER'], $_ENV['MAIL_NAME']);
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