var salto = new Array();
<?php
include("db2.php");


$valor = 7;
$tramos = "";
$precio = 0;
$bf = 0;
$precioTramos = 0;
$i;
$origen = 0;
$destino = 0;
$bookingfee = 36;

if(isset($_GET['type'])) $valor = $_GET['type'];
if(isset($_GET['tramos'])) $tramos = $_GET['tramos'];
echo " console.log('Tramos: $tramos'); ";
echo " console.log('Valor: $valor'); ";
//$tramos = substr($tramos,1, strlen($tramos));
//$tramos = split(",",$tramos);
$tramos = explode (",",$tramos);

function enArray($array,$valor)
{
	foreach($array as $n => $v){
		if($valor == $v) return true;
	}
	return false;
}

function PosEnArray($array,$valor)
{
	foreach($array as $n => $v){
		if($v == $valor) return $n;
		if(strpos($v,$valor)) return $n;
		if(strpos($valor,$v)) return $n;
	}
	echo "console.log('Error con terminal: $valor');"; 
	return -1;
}


$terminales;
$terminalesdatos;
$pos=0;



$file = fopen ( $url  , "r" );
	$cont=0;

while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

	if($data[4] !='' && $data[4] !='TTE')
	{
	$terminales[$cont] = trim($data[0]);
	$terminales[$cont+1] = trim($data[2]);
	$cont+=2;
	}


}  
fclose ( $file );

asort($terminales);
$terminales = array_unique($terminales);
$terminales2;
/*
foreach($terminales as $n => $v){
	$i = PosEnArray($terminalesdatos,$v);
	if($i > -1)
	{
		 echo "$pos '<b>$v</b>' ";
		 echo $terminalesdatos[$i][1] . "<br>";
	}
	else echo "$pos '<b>$v</b>' <br>";
	$pos++;
}*/
$pos = 1;
foreach($terminales as $n => $v){
	$terminales2[$pos] = $v;
	$pos++;
	}



$file = fopen ( $url  , "r" );
	$sqli="";
	$cont=0;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

if($data[4] !='' && $data[4] !='TTE')
{
	
 /*
	$sql = "SELECT id, nombre FROM eterminales WHERE nombre like('%". trim(utf8_encode($data[0])) ."%') ORDER BY latlong DESC;";
	$result = $mysqli->query($sql) or print($mysqli->error);
	$linia=$result->fetch_array();
	
	//echo $cont." ".$sql ."<br>";
	$sql = "SELECT id, nombre FROM eterminales WHERE nombre like('%". trim(utf8_encode($data[2])) ."%') ORDER BY latlong DESC;";
	$result = $mysqli->query($sql) or print($mysqli->error);
	$linia2=$result->fetch_array();
*/
	//echo $cont." ".$sql ."<br>";
	$origen = PosEnArray($terminales2,trim($data[0]));
	$destino = PosEnArray($terminales2,trim($data[2]));


		//echo $data[0]. " = ".$linia['id']." ; ".$data[1]." = ".$linia2['id'];
		//$sqli= "INSERT INTO tramos (origen, destino, tte, `20<8`, `20<16`, `20<22`) VALUES (".$linia['id'].",".$linia2['id'].",".$data[4].",'".str_replace(",",".", $data[6])."','".str_replace(",",".", $data[7])."','".str_replace(",",".", $data[8])."');";
		//$mysqli->query($sqli) or print($mysqli->error);
		if($data[$valor] != '')
		{
			$cont++;
			echo "salto[$cont] = new Array();
			";
			echo "salto[$cont]['origen'] = $origen;
			";
			echo "salto[$cont]['destino'] = $destino;
			";
			//echo "salto[$cont]['tte'] = ".$data[4].";			";
			//echo "salto[$cont]['precio'] = ".(intval($data[$valor])).";"; //intval($data[$valor]/10)
			
			/*if($data[$bookingfee]==''){
				echo "salto[$cont]['bf'] = 1;
				";
			}
			else
			{
				if(enArray($tramos,$cont)) {$precio += $data[$bookingfee]; $bf+=  $data[$bookingfee];}
				
				echo "salto[$cont]['bf'] = 0;
				";
			}*/
			//echo "salto[$cont]['precio'] = parseFloat('".str_replace(",",".", $data[$valor])."');";		
			//echo "salto[$cont]['precio'] = 0;";	

			//if(enArray($tramos,$cont)){ $precio += str_replace(",",".", $data[$valor]); $precioTramos += str_replace(",",".", $data[$valor]);}

   		
		}
	   	//echo "Origen: ". $data[0]." Destino:". $data[1] . " TTE:". $data[2] . " 20E:" . $data[3] . " 20F:".$data[4] ;
	    //echo "<br/>";
 

}
}  
fclose ( $file );
echo " precio = parseFloat($precio); console.log('Precio de tramos: $precioTramos;'); console.log('BF en tramos: $bf'); ";



?>
