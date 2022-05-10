<?php

include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $SERVICIOS; ?></title>
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
  
<script>



</script>


</head>

<body>
<div id="head">

<?php 
$page=2;
include("inc/cabecera.php");
?>


</div>


<div id="contenido" style="margin-top: -630px;">
	<div class="contenedor">
	
	<div class="tit">

<a name="conexion"></a>
<div style="padding: 20px; background: #00b48e; color:#ffffff; text-shadow: 1px 1px 5px #333; font-size: 22px">
	<?php echo $MULTIMODAL; ?>
	
</div>

<div style=" position: absolute; width: 1070px; height: 46px; background:#fff;"></div>
<iframe src="https://www.google.com/maps/d/embed?mid=184Am5iHZYOIhlh7nZbOpoAi3pjM&z=5" width="1000" height="600" style="margin:0 0 46px 0"></iframe>

<!--
<a name="consultoria"></a>
<div style="padding: 20px; background: #1e1e1e; color:#ffffff; text-shadow: 1px 1px 5px #333; font-size: 22px; margin: 0 0 20px 0;">
<?php echo $INTERMODAL; ?>

</div>

<div class="bloque" style="margin:8px 15px">
<img src="img/lang/analisis_<?php echo $lang; ?>.png" width="219" height="83">
</div>

<div class="bloque" style="margin:8px 15px">
<img src="img/lang/planificacion_<?php echo $lang; ?>.png" width="219" height="83">
</div>

<div class="bloque" style="margin:8px 15px">
<img src="img/lang/ejecucion_<?php echo $lang; ?>.png" width="219" height="83">
</div>

<div></div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $ESTUDIO_PERSONALIZADO; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $SELECCION_PERSONALIZADA; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $SOLUCION_A_MEDIDA; ?></span>
</div>
</div>

<div></div>

<div class="bloque" style="margin:8px 15px; background:#f1f1f1; ">
<div class="servtexto">
<span><?php echo $SUPPLY_CHAIN; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px; background:#f1f1f1;">
<div class="servtexto">
<span><?php echo $CONDICIONES_LOGISTICAS; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px; background:#f1f1f1;">
<div class="servtexto">
<span><b><?php echo $GESTION_PROYECTOS; ?></b></span>
</div>
</div>

<div></div>


<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $VALORACION_MERCANCIA; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $SELECCION_TRANPORTE; ?></span>
</div>
</div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto">
<span><?php echo $PRODUCCION_OPERATIVA; ?></span>
</div>
</div>

<div></div>

<div class="bloque" style="margin:8px 15px">
<img src="img/lang/valor_<?php echo $lang; ?>.png" width="219" height="151">
</div>

<div class="bloque" style="margin:8px 15px">
<div class="servtexto valor">
<span>
<ul>
<li><?php echo $MULTIMODALIDAD; ?></li>
<li><?php echo $EXPERTOS; ?></li>
<li><?php echo $CONTACTOS_SECTOR; ?></li>
<li><?php echo $SOLUCIONES_CUSTOMIZADAS; ?></li>
</ul>
</span>
</div>
</div>

<div style="margin-top: 80px">
	<img src="img/servicios.jpg" width="736" height="563">
</div>
-->

	</div>
	
</div>
</div>


<footer>
<?php include("inc/colabora.php"); ?>

<?php include("inc/npie.php"); ?>
</footer>

</body>
</html>
