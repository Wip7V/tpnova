<?php 
include("db2.php");
include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $TITULO_TERMINALES; ?></title>
<meta name="description" content="<?php echo $TITULO_INICIO; ?>" />
<meta name="keywords"  content="<?php echo $PALABRAS_CLAVE; ?>" />
<meta name="language" content="<?php echo $lang; ?>" />
<meta name="audience" content="All" />
<meta name="REVISIT" content="7 days" />
<meta name="Rating" content="General" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="ALL" />
<meta name="author" content="Alberto Lombarte ajlombarte@yahoo.es">

<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<link rel="stylesheet" type="text/css" href="css/estilo_nueva.css"  />
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<meta content="width=1200, initial-scale=1, user-scalable=yes" name="viewport">
  <script src="js/jquery-1.10.1.min.js"></script>
<script src="js/map.js"></script>
  
<script>

var consulta = 6;
terminales = new Array();
	<?php

$file = fopen ( "terminales.csv" , "r" );
	$cont=0;
	$pos=1;
while (( $data = fgetcsv ($file,1000,";")) !== FALSE ){
	

	if($data[1] !='' && $data[1] !='INC')
	{
	echo " terminales[$cont] = new Array();";
	echo " terminales[$cont]['nombre']='".utf8_encode($mysqli->real_escape_string($data[0]))."'; ";
	echo " terminales[$cont]['latlong']='".$data[4]."'; ";
	$datos = $data[1];
	if($data[5] != '') $datos.= "<br><u><a href='tel:+".$data[5]."'>+".$data[5]."</a></u>";	
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
	geocoder.geocode({ 'address': direccion+", eu",'region': 'EU'}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
		var darwin = new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng());
    	map.setCenter(darwin);
    	map.setZoom(11);
	    
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

<body>
<div id="head" style="background-image: url(img/slider/2.jpg);">

<?php 
$page=3;
include("inc/cabecera.php"); ?>


</div>


<div id="contenido" style="margin-top: -630px;">
	<div class="contenedor">
	
	<div class="tit">
<div id="mapa">
	mapa
</div>

<div class="terminal">
<input type="text" name="buscar" id="buscar" style="border: solid 1px #004b9c;"> <input type="button" value="<?php echo $BUSCAR; ?>" id="abuscar">
</div>


	</div>
	
</div>
</div>


<footer>
<?php include("inc/colabora.php"); ?>

<?php include("inc/npie.php"); ?>
</footer>

</body>
</html>
