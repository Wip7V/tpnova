
<?php
include("db2.php");
set_time_limit(0);

$debug = false;
$valor = 7;
$tramos = "";
//$precio = 0;
//$bf = 0;
$precioTramos = 0;
$i;
$origen = 0;
$destino = 0;
$bookingfee = 36;
$salto = [];
$resultados = [];
$pos = 0;
$tterminales = [];

$intentos = 5;
$longitud = 2;
$tcaminos = 0;
$toneladas = 0;

//ob_start();
//var_dump($_GET);
//var_dump($_SESSION);'
//echo " console.log('".$mysqli->real_escape_string(strip_tags(ob_get_clean()))."'); ";

if(isset($_GET['type'])) $valor = $_GET['type'];
if(isset($_GET['db'])) $debug = true;


$coo_origen = "";
$coo_destino = "";


$coo_origen = explode(",",$_GET['o']);
$coo_destino = explode(",",$_GET['d']);
$origen = $_GET['to'];
$destino = $_GET['td'];
$toneladas = $_GET['toneladas'];


//if(isset($_GET['tramos'])) $tramos = $_GET['tramos'];
//echo " console.log('Tramos: $tramos'); ";
//echo " console.log('Valor: $valor'); ";
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
	//echo "console.log('Error con terminal: $valor');"; 
	return -1;
}

function PosEnArray2($array,$valor)
{
	foreach($array as $n => $v){
		if($v[0] == $valor) return $n;
		if(strpos($v[0],$valor)) return $n;
		if(strpos($valor,$v[0])) return $n;
	}
	return -1;
}

$terminales;
$terminalesdatos;
$pos=1;

$file = fopen ( $url , "r" );
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
	$i = PosEnArray2($terminalesdatos,$v);
	if($i > -1)
	{
		 //echo "$pos '<b>$v</b>' ";
		 //echo $terminalesdatos[$i][1] . "<br>";
		$tterminales[$pos] = [];
		$tterminales[$pos]['nombre']=utf8_encode($mysqli->real_escape_string($v));
		$tterminales[$pos]['latlong']=$terminalesdatos[$i][2];
		$tterminales[$pos]['dir']= $tterminales[$pos]['nombre']; //'".utf8_encode($mysqli->real_escape_string($terminalesdatos[$i][1]))."';
	}
	else 
	{
		//echo "$pos '<b>$v</b>' <br>";
		$tterminales[$pos] = [];
		$tterminales[$pos]['nombre']=utf8_encode($mysqli->real_escape_string($v));
		$tterminales[$pos]['latlong']='';
		$tterminales[$pos]['dir']='';
		
	}
	$pos++;
}

$pos = 1;
foreach($terminales as $n => $v){
	$terminales2[$pos] = $v;
	$pos++;
	}

function rellenaTramos(){
global $salto, $url, $terminales2, $valor, $tramos, $bookingfee;	

$file = fopen ( $url  , "r" );
	$sqli="";
	$cont=0;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

if($data[4] !='' && $data[4] !='TTE')
{
	
	$origen = PosEnArray($terminales2,trim($data[0]));
	$destino = PosEnArray($terminales2,trim($data[2]));

		if($data[$valor] != '')
		{
			$cont++;
			$salto[$cont] = [];
			
			$salto[$cont]['origen'] = $origen;
			$salto[$cont]['destino'] = $destino;
			$salto[$cont]['tte'] = floatval($data[4]);
			$salto[$cont]['precio'] = floatval(str_replace(",", ".",$data[$valor])); //intval($data[$valor]/10)
			$salto[$cont]['bf'] = floatval($data[$bookingfee]);
			if($data[$bookingfee]==''){
				$salto[$cont]['bfi'] = 1;
			}
			else
			{
				//if(enArray($tramos,$cont)) {$precio += $data[$bookingfee]; $bf+=  $data[$bookingfee];}
				
				$salto[$cont]['bfi'] = 0;
				
			}


			/*if(enArray($tramos,$cont)){ $precio += str_replace(",",".", $data[$valor]); $precioTramos += str_replace(",",".", $data[$valor]);}*/
		}
}
}  
fclose ( $file );
}

function ArrayTerminalesCerca($lat, $lon){ //devuelve lista de terminales cerca de una coordenada lat long- si no encuentra devuelve -1
	global $tterminales;
	$id = -1;
	$dist = 900;
	$terminales_cerca = [];
	//echo $lat." lat ".$lon." lon <br>";
	//echo "console.log('ArrayTerminalesCerca');";

	foreach($tterminales as $i => $v){	
		if($tterminales[$i]["latlong"]!='')
		{
			$tcoord =  explode(",",$tterminales[$i]["latlong"]);
			
			$cdist = DistanciaLinealCoord(floatval($lat),floatval($lon),floatval($tcoord[0]),floatval($tcoord[1]));
			
			if($cdist < 400){ //kimoetros maximos para encontrar 1 terminal
				//echo "console.log('".$cdist . " dist con " . $tterminales[$i]['nombre']."');";
				if($cdist<100){ //kimoetros del array
					$terminales_cerca[count($terminales_cerca)] = $i*1;
					echo "console.log('".round($cdist,2) . "km Distancia lineal con " . $tterminales[$i]['nombre']."');";
				}
				
				if($cdist < $dist){ //busca la mas cercana en 400km
					$dist = $cdist;
					$id = $i;
				}
			}
		}
	}
	
	
	
	if(count($terminales_cerca)==0) $terminales_cerca[0] = $id;
	
	return $terminales_cerca;
}

function DistanciaLinealCoord($olat,$olong,$dlat,$dlong){	//distancia linea en kilometros entre dos puntos lat y long
	$dist = 6371 * acos(
	sin(deg2rad($dlat)) * sin(deg2rad($olat)) 
	+ cos(deg2rad($dlong - $olong)) * cos(deg2rad($dlat)) * cos(deg2rad($olat)));
    return $dist;
}

//recive una lista separada por comas de terminales y la transforma a un array de tramos
function rutaAtramos($ruta){
	global $salto;
	$entrada = explode(",",$ruta);
	$dir = [];
	
	for($i=0;$i<count($entrada)-1;$i++){
		foreach($salto as $c => $v){
			if($entrada[$i]==$salto[$c]['origen'] && $entrada[$i+1]==$salto[$c]['destino']){
				$dir[count($dir)] = $c;
			}
		}
	}
	return $dir;
}

//se paso un valor y lo busca dentro de una lista separada por comas
function enlista($valor, $cadena){
	$lista = explode(",",$cadena);
	foreach($lista as $i => $v){
			if($v==$valor) return true;
		}
	return false;
}

//recive un origen y devuelve los destinos evitando volver por donde ya se ha caminado
function caminos($pos,$ruta){
	global $salto;
	$dir = [];
	foreach($salto as $punto => $v){
		if($pos==$salto[$punto]['origen']){
			if(!enlista($salto[$punto]['destino'],$ruta)){
				$dir[count($dir)]=$punto;
				}
		}
	}
	return $dir;
}

//suma los valores de un campo de un array. Devuelve negativo si encuentra algun valor a 0
function suma($tramos, $valor)
{
	global $salto;
	$total = 0;
	foreach($tramos as $i => $v){
			$total+=$salto[$v][$valor];
			if($salto[$v][$valor]==0 && $valor != "bf") $total = -500000;
			//echo "console.log('".$v." - ".$valor." - ".$total."');";
		}
	//return Math.round(total*100)/100;
	return $total;
}

//funcion recursiva que busca rutas entre los tramos
function tramo($pos,$ruta, $rtramos){
	global $salto, $origen, $destino, $resultados, $tterminales, $longitud, $tcaminos, $debug;
	//echo $pos.",";
if($pos==0) //'si es 0 es que empieza en Origen'
{
	$dir = caminos($origen,$ruta);
	//$ruta.=",".$salto[$pos]['origen'];
}
else{
	//echo $salto[$pos]['origen']. " - " . $salto[$pos]['destino']."<br>";
	
	$ruta.=",".$salto[$pos]['origen'];
	$dir = caminos($salto[$pos]['destino'],$ruta);
	$rtramos.=",".$pos;
	
	if($salto[$pos]['destino']==$destino){	
		$ruta.=",".$salto[$pos]['destino'];
		//echo "Final: ".$ruta);
		$rat = explode(",",substr($rtramos,1));
		
		$stte=suma($rat,"tte");
		$sprecio=suma($rat,"precio");
		$bf=suma($rat,"bf");
		$bfi = sumaBFlonlat($rat);
		$re = ReduccionEmisiones($rat);
			
		/*$lterminales = "";
		$lrfinales =explode(",",$ruta);
		foreach($lrfinales as $i => $v){
				if(isset($tterminales[$v])) $lterminales.=$tterminales[$v]["nombre"].", ";
			}*/
		//echo "console.log('Posible ruta: " . $lterminales . " TTE:" . $stte . " - " . $sprecio . "€ BF:" . $bf." BFI:". $bfi."');";
		//echo "console.log('".$rtramos."');";
		
		
		$rpos = count($resultados);
		$resultados[$rpos] = [];
		$resultados[$rpos]["origen"] = $origen;
		$resultados[$rpos]["destino"] = $destino;
		$resultados[$rpos]["precio"] = $sprecio;
		$resultados[$rpos]["tte"] = $stte;
		$resultados[$rpos]["ruta"] = $ruta;
		$resultados[$rpos]["bf"] = $bf;
		$resultados[$rpos]["bfi"] = $bfi;
		$resultados[$rpos]["re"] = $re;
		
		
		$tcaminos++;//contador de caminos encontrados
	}	
}
	if(count(explode(",",$ruta)) < $longitud){ //cantidad maxima de saltos para llegar al destino y evitar bucle infinito
		foreach($dir as $i => $v){
			tramo($v,$ruta,$rtramos);
		}
	}

}

function sumaBFlonlat($tramos) //calcula el coste de Bookinfee internacional
{
	global $salto, $tterminales;
	$result = 0;	
	//$tramos = explode(",", $tramos);

	foreach($tramos as $i => $v){

		if($salto[$v]['bfi']==1){

			if($tterminales[$salto[$v]['origen']]['latlong'] != '' && $tterminales[$salto[$v]['destino']]['latlong'] != '')
			{
				$latlong_origen = explode(",",$tterminales[$salto[$v]['origen']]['latlong']);
				$latlong_destino = explode(",",$tterminales[$salto[$v]['destino']]['latlong']);
				$tramo_distancia = DistanciaLinealCoord($latlong_origen[0],$latlong_origen[1],$latlong_destino[0],$latlong_destino[1]);
				
				if($tramo_distancia<500) $result += 100;
				if($tramo_distancia>=500 && $tramo_distancia<1000) $result += 150;
				if($tramo_distancia>1000) $result += 200;
				//echo "Kilometros internacional:".$tramo_distancia;
				//echo "Precio BF internacional: ".$result;
			}
		}
	}
	//console.log("BF total por distancias: "+result);
	
	return $result;
}

function ReduccionEmisiones($tramos) //Cuenta los kilometros lineales que realiza el tren para el calculo de contaminación
{
	global $salto, $tterminales, $toneladas;
	$result = 0;
	$kilometros = 0;
	

	//$tramos = explode(",", $tramos);

	foreach($tramos as $i => $v){

			if($tterminales[$salto[$v]['origen']]['latlong'] != '' && $tterminales[$salto[$v]['destino']]['latlong'] != '')
			{
				$latlong_origen = explode(",",$tterminales[$salto[$v]['origen']]['latlong']);
				$latlong_destino = explode(",",$tterminales[$salto[$v]['destino']]['latlong']);
				$kilometros += DistanciaLinealCoord($latlong_origen[0],$latlong_origen[1],$latlong_destino[0],$latlong_destino[1]);
			}
		
	}
	$ton = $toneladas * 8;
	//toneladas * kilometros * FactorConsumo * FactorEmision
	$camion = $ton * $kilometros * 0.07 * 2.41;
	$tren = $ton * $kilometros * 0.009 * 2.63;
	$result = (int)($camion - $tren);
	//$result = $ton;
	//console.log("BF total por distancias: "+result);
	
	return $result;
}

rellenaTramos();
//var_dump(ArrayTerminalesCerca(42.26550659999999 ,2.9581046000000697));

//var_dump(rutaAtramos("1,78"));//rutaAtramos("1,8,4")
//var_dump(caminos(18,""));
//var_dump($salto);
//echo DistanciaLinealCoord(41.1188827, 1.2444908999999598, 41.2854449, 1.249458900000036);

if($origen>0) $origenes[0]= $origen;
if($destino>0) $destinos[0] = $destino;

if($origen==0) $origenes = ArrayTerminalesCerca($coo_origen[0],$coo_origen[1]);
if($destino==0) $destinos = ArrayTerminalesCerca($coo_destino[0],$coo_destino[1]);


foreach($origenes as $or => $vor)foreach($destinos as $de => $vde){
//for(var or in origenes)for(var de in destinos)//if(origen > 0 && destino > 0)
//echo $vor." ".$vde."<br>";
		$origen = $vor;
		$destino = $vde;
				
		$tcaminos=0;
		$intentos = 5;
		$longitud=2;
//$origen = 1;
//$destino = 28;
	while($intentos > 0 && $tcaminos < 1){
		tramo(0,"","");
		$intentos--;
		$longitud++;	
	}

	if($intentos == 0){
		//echo "No hay ruta posible entre ".$tterminales[$origen]["nombre"]." y ".$tterminales[$destino]["nombre"]."<br>";
	}
}

$ordenres = [];
foreach($resultados as $i => $v){
	$ordenres[$i] = $v["tte"];
}

asort($ordenres);
//for($x=0; $x<5; $x++) echo 
//echo "<br><br>";
$x=0;
foreach($ordenres as $i => $v){
	
		$lterminales = "";
		
		if($debug){
		$lrfinales =explode(",",$resultados[$i]['ruta']);
		foreach($lrfinales as $p => $v){
				if(isset($tterminales[$v])) $lterminales.=$tterminales[$v]["nombre"].", ";
			}
		echo " console.log('Posible ruta: " . $lterminales . " TTE:" . $resultados[$i]['tte'] . " - " . $resultados[$i]['precio'] . "€ BF:" . $resultados[$i]['bf']." BFI:". $resultados[$i]['bfi']." RE:".$resultados[$i]['re']."'); ";}
		
		echo " resultados[$x] = new Array(); ";
		echo " resultados[$x]['origen']= ".$resultados[$i]['origen'].";";
		echo " resultados[$x]['destino']= ".$resultados[$i]['destino'].";";
		echo " resultados[$x]['tte']= ".$resultados[$i]['tte'].";";
		echo " resultados[$x]['ruta']= '".$resultados[$i]['ruta']."';";
		echo " resultados[$x]['precio']= ".($resultados[$i]['precio']+$resultados[$i]['bf']+$resultados[$i]['bfi']).";";
		echo " resultados[$x]['re']= '".$resultados[$i]['re']."';";
	$x++;
	if($x>=10) break; //maximo de resultados
}

echo "MostrarResultados();";
?>

	<?php
	//var_dump($tterminales);
	//var_dump(caminos(18,""));
	//echo $terminalesdatos[$origen][0];
	//var_dump($salto);
	//var_dump($origenes);
	//var_dump($destinos);
	//var_dump($resultados);
	//var_dump($ordenres);
	?>

