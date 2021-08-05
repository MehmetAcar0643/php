<?php
require_once("../../connect/DBController.php");
require_once("../../connect/İletisimController.php");
$iletisimcont = new İletisimController();
$iletisim = $iletisimcont->mail_ayar_getir();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $konu = $_POST['konu'];
    $mail_adres = $_POST['mail'];
    $mesaj = $_POST['mesaj'];

}
require '../../connect/Exception.php';
require '../../connect/PHPMailer.php';
require '../../connect/SMTP.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = $iletisim['smtp_host'];                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = $iletisim['smtp_mail'];                     // SMTP username
    $mail->Password = $iletisim['smtp_sifre'];                               // SMTP password
    $mail->SMTPSecure = $iletisim['smtp_secure'];         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($iletisim['smtp_mail'], $iletisim['smtp_gonderen']);
    $mail->addAddress($mail_adres);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $konu;
    $mail->Body = $mesaj;

    $mail->send();
    header("Location:mailler.php?mail-gonder=ok");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}