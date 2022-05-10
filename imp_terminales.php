<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TPNOVA</title>


<script>


</script>

</head>

<body>
<?php
include("db2.php");

	$sql = "TRUNCATE TABLE eterminales;";
	$mysqli->query(utf8_encode($sql)) or print($mysqli->error);

$file = fopen ( "terminales.csv" , "r" );
	$sqli="";
	$cont=0;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	$cont++;

	$sql = "INSERT INTO eterminales (nombre) VALUES ('".$mysqli->real_escape_string($data[0])."');";
	$mysqli->query(utf8_encode($sql)) or print($mysqli->error);
   echo utf8_encode($sql."<br>");
}
fclose ( $file );


?>
</body>
</html>
