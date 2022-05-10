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

$file = fopen ( "datos.csv" , "r" );
	$sqli="";
	$cont=0;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

if($data[1] !='' && $data[1] !='INC')
{
	$cont++;
 
	$sql = "SELECT id, nombre FROM eterminales WHERE nombre like('%". utf8_encode($data[0]) ."%');";
	$result = $mysqli->query($sql) or print($mysqli->error);
	$linia=$result->fetch_array();
	//echo $cont." ".$sql ."<br>";
	$sql = "SELECT id, nombre FROM eterminales WHERE nombre like('%". utf8_encode($data[2]) ."%');";
	$result = $mysqli->query($sql) or print($mysqli->error);
	$linia2=$result->fetch_array();
	//echo $cont." ".$sql ."<br>";


	if($linia['id']>0)
	{
		//echo $data[0]. " = ".$linia['id']." ; ".$data[1]." = ".$linia2['id'];
		$sqli= "INSERT INTO tramos (origen, destino, tte, `20<8`, `20<16`, `20<22`) VALUES (".$linia['id'].",".$linia2['id'].",".$data[4].",'".str_replace(",",".", $data[6])."','".str_replace(",",".", $data[7])."','".str_replace(",",".", $data[8])."');";
		//$mysqli->query($sqli) or print($mysqli->error);

   		echo $sqli ."<br>";

	   	//echo "Origen: ". $data[0]." Destino:". $data[1] . " TTE:". $data[2] . " 20E:" . $data[3] . " 20F:".$data[4] ;
	    //echo "<br/>";
    }

}
}  
fclose ( $file );


?>
</body>
</html>
