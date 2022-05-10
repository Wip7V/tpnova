<?php 
include("db2.php");
include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="description" content="<?php echo $TITULO_INICIO; ?>" />
<meta name="keywords"  content="<?php echo $PALABRAS_CLAVE; ?>" />
<meta name="language" content="<?php echo $lang; ?>" />
<meta name="audience" content="All" />
<meta name="REVISIT" content="7 days" />
<meta name="Rating" content="General" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="ALL" />
<meta name="author" content="Alberto Lombarte ajlombarte@yahoo.es">


<link rel="stylesheet" type="text/css" href="css/estilo_nueva.css"  />

  <script src="js/jquery-1.10.1.min.js"></script>
<script src="js/map.js"></script>
  
<script>

var consulta = 6;
terminales = new Array();
	<?php

$file = fopen ( "contacto.csv" , "r" );
	$cont=0;
	$pos=1;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

	if($data[1] !='' && $data[1] !='INC')
	{
	echo " terminales[$cont] = new Array();";
	echo " terminales[$cont]['nombre']='".utf8_encode($mysqli->real_escape_string($data[0]))."'; ";
	echo " terminales[$cont]['latlong']='".$data[4]."'; ";
	$datos = $data[1];
	if($data[5] != '') $datos.= "<br><br><u>".$data[5]."</u>";	
	if($data[6] != '') $datos.= "<br><u><a href='mailto:".$data[6]."'>".$data[6]."</a></u>";	
	echo " terminales[$cont]['dir']='".utf8_encode($mysqli->real_escape_string($datos))."'; ";

	$cont++;
	}

$pos++;
}  
fclose ( $file );

		
?>




$(document).ready(function(e) {
	
var punts = 0;
var latlong = "";
var texto = "";
for(var i in terminales){
punts++;
latlong += terminales[i]['latlong']+",";
texto += "<b>" + terminales[i]['nombre'] + "</b><br>" + terminales[i]['dir'] +"#";
}

initialize(latlong,texto,"",punts);

			$('#abuscar').click( function(e) {
				ObtenerGeo($('#buscar').val());
				});	
			$('#buscar').keyup(function(e) {
				if(e.keyCode==13)ObtenerGeo($('#buscar').val());
            });

});

function ObtenerGeo(direccion){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': direccion}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
		var darwin = new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng());
    	map.setCenter(darwin);
    	map.setZoom(10);
	    
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        alert("Geocoding no tuvo éxito debido a: " + status);
    }
	});
}



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpewiv6CSxpjP6FBlg2EAqF7iz5pSyVxM"></script>


</head>

<body style="text-align: center !important; background: #fff;">

<div id="mapa" style="width: 780px; display: inline-block; vertical-align: top;">
	mapa
</div>
<div id="datos">
<?php	
	$file = fopen ( "contacto.csv" , "r" );
	$cont=0;
	$pos=1;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

	if($data[1] !='' && $data[1] !='INC')
	{

	echo "<div> <b>".utf8_encode($mysqli->real_escape_string($data[0]))."</b><br> ";
	$datos = $data[1];
	if($data[5] != '') $datos.= "<br><br><u>".$data[5]."</u>";	
	if($data[6] != '') $datos.= "<br><u><a href=mailto:".$data[6]." >".$data[6]."</a></u>";	
	echo " ".utf8_encode($mysqli->real_escape_string($datos))."</div>";

	$cont++;
	}

$pos++;
}  
fclose ( $file );
?>
</div>
<br>
<div class="terminal" >
<input type="text" name="buscar" id="buscar" style="border: solid 1px #004b9c;"> <input type="button" value="<?php echo $BUSCAR; ?>" id="abuscar">
</div>


	</div>
	
</div>
</div>



</body>
</html>
