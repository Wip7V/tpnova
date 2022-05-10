<?php

require 'mail/class.phpmailer.php';

function PHPmail($email, $Subject, $Body)
{
$body = str_replace("€","&euro;",$Body);
$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->IsSendMail();
$mail->Host = 'mail.tpnova.com'; 
$mail->Port = 25; 						// Specify main and backup server
$mail->SMTPAuth = false;                               // Enable SMTP authentication
$mail->Username = 'noreply@tpnova.com';                            // SMTP username
$mail->Password = 'Ao8139404';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted /tsl
$mail->From = 'noreply@tpnova.com';
$mail->FromName = 'TPnova website';
//$mail->AddAddress('josh@example.net', 'Josh Adams');  // Add a recipient

$array = explode(",",$email);

foreach($array as $valor) $mail->AddAddress($valor);  
             // Name is optional
//$mail->AddReplyTo('info@example.com', 'Information');
//$mail->AddCC('cc@example.com');
//$mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = utf8_decode($Subject);
$mail->Body    = utf8_decode($Body);
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

	
}


?>