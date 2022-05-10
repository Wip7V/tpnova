<html>
<head>
	
</head>
<body style="font-family: verdana; font-size: 12px;">
<?php
include("db2.php");

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
		if($v[0] == $valor) return $n;
		if(strpos($v[0],$valor)) return $n;
		if(strpos($valor,$v[0])) return $n;
	}
	return -1;
}

/*
meter en array columna 0 y 2
ordenar alfabeticamente
quitar repetidos

*/


$terminales;
$terminalesdatos;
$pos=0;
//echo " console.log('Tramos: $tramos'); ";
//$tramos = substr($tramos,1, strlen($tramos));

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

$file = fopen ( "terminales.csv" , "r" );
	$cont2=0;
	
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

	if($data[1] !='' && $data[1] !='INC')
	{
	$terminalesdatos[$cont2][0] = $data[0];
	$terminalesdatos[$cont2][1] = $data[1];
	$terminalesdatos[$cont2][2] = $data[4];
	//$terminales[$cont] = trim($data[0]);

	$cont2++;
	$cont++;
	}


}  
fclose ( $file );

//echo " precio = parseFloat($precio); console.log('Precio de tramos: $precioTramos;'); console.log('BF en tramos: $bf'); ";
asort($terminales);
$terminales = array_unique($terminales);

foreach($terminales as $n => $v){
	$i = PosEnArray($terminalesdatos,$v);
	if($i > -1)
	{
		 echo "$pos '<b>$v</b>' ";
		 echo $terminalesdatos[$i][1] . "<br>";
	}
	else echo "$pos '<b>$v</b>' <br>";
	$pos++;
}

?>
</body>
</html>
