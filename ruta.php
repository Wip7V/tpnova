<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TPNOVA</title>


<script>
var salto = new Array();

var origen = 10
var destino = 12;
var longitud = 2;

var tte = 9999999;
var precio = 0;

<?php
include("db.php");

		$pos=0;
		$sql="SELECT * FROM tramos";
		$result = $mysqli->query($sql) or print($mysqli->error);
		while($linia=$result->fetch_array()){
			echo "salto[".$linia['id']."] = new Array();
			";
			echo "salto[".$linia['id']."]['origen'] = ".$linia['origen']."
			";
			echo "salto[".$linia['id']."]['destino'] = ".$linia['destino']."
			";
			echo "salto[".$linia['id']."]['tte'] = ".$linia['tte']."
			";
			echo "salto[".$linia['id']."]['20E'] = ".$linia['20E']."
			";		
			$pos++;
		}

?>

var ruta = '';
var tcaminos = 0;
var rfinal = '';

function calcula()
{
	var intentos = 6;
	tte=9999999999;
	precio=99999999999;
	tcaminos=0;
	rfinal=0;
	longitud=4;
	
	while(tcaminos<1 && intentos>0) //si no e encontrado ningun camino aumento la longitud en tramos a buscar hasta un maximo de 6
	{
		tramo(0,ruta);	
		longitud+=1;
		intentos--;
	}
	console.log(tte + " dias por " + precio + "€" + "en la ruta: " + rfinal);
}

function tramo(pos,ruta){

if(pos==0)
{
	var dir = caminos(origen,ruta);
}
else{
	ruta+=","+salto[pos]['origen'];
	var dir = caminos(salto[pos]['destino'],ruta);
	
	if(salto[pos]['destino']==destino){	
		ruta+=","+salto[pos]['destino'];
		console.log("Final: "+ruta);
		
		stte=suma(rutaAtramos(ruta),"tte");
		sprecio=suma(rutaAtramos(ruta),"20E");
		
		if(stte==tte && sprecio < precio){ //si encuentro una ruta mas rapida que la guardada
			tte = stte;
			precio = sprecio;
			rfinal = ruta;
			console.log("Igual de rápida pero mas economica: TTE= " +tte+ " - " + precio + "€");
		}		
		
		if(stte<tte){ //si encuentro una ruta mas rapida que la guardada
			tte = stte;
			precio = sprecio;
			rfinal = ruta;
			console.log("Opcion mas rápida: TTE= " +tte+ " - " + precio + "€");
		}		
		
		tcaminos++;//contador de caminos encontrados
	}	
}
	if(ruta.split(",").length < longitud){
		for(x in dir){
			tramo(dir[x],ruta);
		}
	}

}

//recive un origen y devuelve los destinos evitando volver por donde ya se ha caminado
function caminos(pos,ruta){
	var dir = new Array();
	for(var punto in salto){
		if(pos==salto[punto]['origen']){
			if(!enlista(salto[punto]['destino'],ruta)){
				dir[dir.length]=punto;
				}
		}
	}
	return dir;
}

//se paso un valor y lo busca dentro de una lista separada por comas
function enlista(valor, cadena){
	var lista = cadena.split(",");
	for(var i in lista){
			if(lista[i]==valor) return true;
		}
	return false;
}

//recive una lista de terminales y la transforma a un array de tramos
function rutaAtramos(ruta){
	var entrada = ruta.split(",");
	var dir = new Array();
	
	for(i=0;i<entrada.length-1;i++){
		for(var c in salto){
			if(entrada[i]==salto[c]['origen'] && entrada[i+1]==salto[c]['destino']){
				dir[dir.length] = c;
			}
		}
	}
	return dir;
}

//recive un array de tramos devuelve la suma del campo deseado
function suma(tramos, valor)
{
	var total = 0;
		for(var i in tramos){
			total+=salto[tramos[i]][valor];
		}
	return total;
}


</script>

</head>

<body>

<script>
	
</script>

</body>
</html>
