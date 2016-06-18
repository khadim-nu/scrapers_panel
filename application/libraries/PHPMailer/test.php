<?php 
require_once('class.phpmailer.php');

$mail = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 25; // or 587
$mail->IsHTML(true);
$mail->Username = "zeshan.hassan@incubasys.com";
$mail->Password = "norway4901";
$body='<h1>Body Head</h1>';

$mail->From = "info@mongoliabusinesscongress.com";

$mail->AddReplyTo("info@mongoliabusinesscongress.com","Mongolia Congress");

$address = "info@mongoliabusinesscongress.com";

$mail->AddAddress("khadim.raath@incubasys.com","Mongolia Congress");

$mail->Subject    = "PHPMailer Test Subject via mail(), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>
