<?php

$direccion = 'localhost';
$usuario = 'root';

$password = '';
$base_datos = "tpnova";

$email_booking = 'bookings@tpnova.com, eduard@tpnova.com';
$url_web = 'http://www.tpnova.com';

$db=mysql_connect($direccion, $usuario, $password);
mysql_select_db($base_datos, $db);
mysql_query("USE tpnova;");
mysql_query("set names 'utf8'");
//mysql_query("SET time_zone='+02:00'");


	function js_alert($string) //para poder hacer alert de javascript con ' comillas simples y dobles "
	{	
		print("alert('".mysql_real_escape_string($string)."');" );
	}

	function js_console_error($string)
	{
		echo "console.log(\"".mysql_real_escape_string($string)."\");";	
	}
?>