<?php 
include("db2.php"); 
include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $CONTACTO; ?></title>
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

$(document).ready(function(e) {
				$('#enviar_email').click( function(e) {
				
				$('#error').html('');
				
				if($('#email').val() == ''){
					$('#error').html("<?php echo $FALTA_EMAIL; ?>");
					$('#email').focus();
					return 0;
				}
				
				emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
			    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
			    if (!emailRegex.test($('#email').val())) {
			      $('#error').html("<?php echo $ERROR_FORMATO_EMAIL; ?>")
			      $('#email').focus();
			      return 0;
			    }
				
				if($('#empresa').val() == ''){
					$('#error').html("<?php echo $FALTA_EMPRESA; ?>");
					$('#empresa').focus();
					return 0;
				}
				
				if(!$('#con_generales').is(':checked')){
					$('#error').html("<?php echo $FALTA_CONDICIONES; ?>");
					$('#con_generales').focus();
					return 0;					
				}
				
				//codigo de enviar post al email.php
				$.post( "emailbook.php", {email:$('#email').val(), empresa:$('#empresa').val(), html: $('#texto2').html()+"<br><br>"+$('#observa').val() },
				 function(data) { 
				 alert(penviado); 
				 	$('#pedir').hide();
					$('#fondo_negro').hide();
				 });	
					
			});
});

</script>


</head>

<body>
<div id="head" style="background-image: url(img/slider/2.jpg);">

<?php 
$page=4;
include("inc/cabecera.php"); ?>


</div>


<div id="contenido" style="margin-top: -560px;">
	<div class="contenedor">
	


<div id="contacto"> 
	<div id="texto2"></div>

	<div class="contenedor cpedir">
	
	<div class="terminal">
	<?php echo $EMAIL; ?><br>
	<input type="text" name="email" id="email">
	</div>
	
	<div class="terminal">
	<?php echo $EMPRESA; ?><br>
	<input type="text" name="empresa" id="empresa">
	</div>		

<div style="height: 15px;"></div>
	<div class="terminal">
	<?php echo $TEXTO; ?><br>
	<textarea name="observa" id="observa"><?php echo $MAS_INFORMACION; ?></textarea>
	</div>
	<div style="height: 15px;"></div>
	<input type="checkbox" name="con_generales" id="con_generales"	><?php echo $CONDICIONES1; ?> <b><i><a href="CGV TP NOVA version 1 <?php echo strtoupper($lang); ?>.pdf" target="_blank" title="<?php echo $CONDICIONES2; ?>"><?php echo $CONDICIONES2; ?></a></i></b>.
<div style="height: 15px;"></div>
<div id="error" style="color: rgba(173,2,43,1); font-weight: bold;"></div>
<div style="height: 15px;"></div>
		<div class="terminal">
<input type="button" value="<?php echo $ENVIAR; ?>" id="enviar_email">
<div class="peque">
	<?php echo $SUS_DATOS; ?>
</div>
	</div>	
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
