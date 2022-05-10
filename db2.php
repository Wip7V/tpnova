<?php
$direccion = 'localhost'; //qtf749.tpnova.com
$usuario = 'root'; //qtf749

//$password = 'TpnovaDbPas1';
$password = 'root';
$base_datos = "tpnova"; //qtf749
$url = "../data/datos.csv";
$url = "datos.csv";
$email_booking = 'bookings@tpnova.com, eduard@tpnova.com';
$url_web = 'http://www.tpnova.com';

/*$db=mysql_connect($direccion, $usuario, $password);
mysql_select_db($base_datos, $db);
mysql_query("USE tpnova;");
mysql_query("set names 'utf8'");
//mysql_query("SET time_zone='+02:00'");*/

$mysqli = new mysqli($direccion, $usuario, $password, $base_datos);
if ($mysqli->connect_errno) {
 

    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    exit;
}


	function js_alert($string) //para poder hacer alert de javascript con ' comillas simples y dobles "
	{	
		print("alert('".mysql_real_escape_string($string)."');" );
	}

	function js_console_error($string)
	{
		echo "console.log(\"".mysql_real_escape_string($string)."\");";	
	}
?>