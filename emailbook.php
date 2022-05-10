<?php

include("db2.php");
include("mail.php");

$email_booking = '';//bookings@tpnova.com
$empresa='';
$html='';

if(isset($_POST['email'])) $email_booking .= $_POST['email'];
if(isset($_POST['empresa'])) $empresa .= $_POST['empresa'];
if(isset($_POST['html'])) $html .= $_POST['html'];

PHPmail($email_booking, "TPNOVA: $empresa" ,"<img src='http://localhost/tpnova/img/logo.png'><hr>".$html."<br>"."<br><b>$empresa:</b> <a href='mailto:$email_booking'>$email_booking</a>");

?>