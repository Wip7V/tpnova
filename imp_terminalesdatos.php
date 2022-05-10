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

$file = fopen ( "terminalesdatos.csv" , "r" );
	$sqli="";
	$cont=0;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){

  
	$sql = "SELECT id FROM eterminales WHERE nombre like('". utf8_encode($data[0]) ."');";

	$result = $mysqli->query($sql) or print($mysqli->error);
	$linia=$result->fetch_array();
	

	if($linia['id']>0)
	{
		//echo $data[0]. " = ".$linia['id']." ; ".$data[1]." = ".$linia2['id'];
	$sql = "UPDATE eterminales SET dir = '".$mysqli->real_escape_string($data[1]." ".$data[2]. " ".$data[3])."', latlong = '".$data[4]."' WHERE id =".$linia['id'];
	$mysqli->query(utf8_encode($sql)) or print($mysqli->error);
   echo utf8_encode($sql." - ".utf8_encode($data[0])."<br>");
$cont++;

    } 
    else
    {
	$sql = "INSERT INTO eterminales (nombre,dir,latlong) VALUES ('".$data[0]."','".$mysqli->real_escape_string($data[1]." ".$data[2]. " ".$data[3])."','".$data[4]."')";
	$mysqli->query(utf8_encode($sql)) or print($mysqli->error);
	echo utf8_encode($sql."<br>");
	}

}
fclose ( $file );
echo $cont;

?>
</body>
</html>
