<?php

include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGISTICS RAIL SERVICES</title>
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
$page=5;
include("inc/cabecera.php");
?>

<div class="servicios_main" >
<div style="background: rgba(0,180,142,0.5);">
<a href="forwarding.php">
<span>RAIL<br> FORWARDING</span>
<img src="img/s1.jpg" width="250"/>
</a>
</div>

<div style="background: rgba(0,75,156,0.5);">
<a href="consulting.php">
<span>RAIL<br> CONSULTING</span>
<img src="img/s2.jpg" width="250">
</a>
</div>

<div style="background: rgba(255,1,62,0.5);">
<a href="operator.php">
<span>RAIL<br> OPERATOR AGENCY</span>
<img src="img/s3.jpg" width="250">
</a>
</div>

</div>

</div>
<div id="contenido" style="margin-top: -230px; min-height: 290px;">
	<div class="contenedor" style="text-align: center; padding: 60px 120px; font-size: 18px;">
	
	<table>
		<tr>
			<td><a href="https://www.transportuarios.com/" target="_blank"><img src="img/tp2.png"></a></td>
			<td><?php echo $LAEMPRESA; ?></td>
		</tr>
		
	</table>

	
</div>
</div>

<footer>
<?php include("inc/colabora.php"); ?>

<?php include("inc/npie.php"); ?>
</footer>

</body>
</html>
