<div class="titulo"><?php echo $TITULO_WEB; ?></div>
<div id="franja">
	<div id="cabecera">
		<div class="lang" id="derechabab">	
		<a href="?lang=es" <?php if($lang=='es') echo "class='selected'"; ?>>ES</a>
		 | 
		<a href="?lang=en" <?php if($lang=='en') echo "class='selected'"; ?>>EN</a>
		 | 
		<a href="?lang=fr" <?php if($lang=='fr') echo "class='selected'"; ?>>FR</a></div>

		<img class="logo" src="img/logo.png" title="tpnova logo">
		<!--span class="datos">
		<a href="tel:+34932239063">+34 93 223 90 63</a> / <a href="mailto:bookings@tpnova.com">bookings@tpnova.com</a>
		</span-->
		<div class="subtitulo">Your Rail Partner</div>

		<div id="derechabab">
		<div class="menu">
			<a href="index.php" <?php if($page==1) echo "class='selected'"; ?>><?php echo $INICIO; ?></a>
			<a href="conexiones.php" <?php if($page==2) echo "class='selected'"; ?>><?php echo $SERVICIOS; ?></a>
			<a href="terminales.php" <?php if($page==3) echo "class='selected'"; ?>><?php echo $TERMINALES; ?></a>
			<a href="servicios.php" <?php if($page==5) echo "class='selected'"; ?>><?php echo $SOBRE_NOSOTROS; ?></a>
			<a href="contacto.php" <?php if($page==4) echo "class='selected'"; ?>><?php echo $CONTACTO; ?></a>
			
			
		</div>
		</div>
	</div>

	
</div>

