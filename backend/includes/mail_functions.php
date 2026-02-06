<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require __DIR__."../../../vendor/autoload.php";

function sendMail($to, $subject, $body) : bool
{
  $mail = new PHPMailer(true);

  try{
    
    $config = require __DIR__."/../config/mail.php";

    //Login mail
    $mail->SMTPAuth = true;
    $mail->isSMTP();
    $mail->Host = $config['host'];
    $mail->Port = $config['port'];
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->setFrom('no-reply@remotehost.es', 'RemoteHost');

    //Mail config
    $mail->addAddress($to);
    $mail->CharSet = 'utf8';
    $mail->Encoding = 'base64';
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    //Send mail
    $mail->send();

  return true;

  }catch(Exception $e) {
    error_log($mail->ErrorInfo);
    return false;
  }
}
?>