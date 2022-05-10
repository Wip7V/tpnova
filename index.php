<?php 
include("db2.php");
include("lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $TITULO_INICIO; ?></title>
<meta name="language" content="<?php echo $lang; ?>" />
<meta name="description" content="<?php echo $TITULO_INICIO; ?>" />
<meta name="keywords"  content="<?php echo $PALABRAS_CLAVE; ?>" />
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
<link href="css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet">

  <script src="js/jquery-1.10.1.min.js"></script>

  <script src="js/web2.js"></script>
  <script src="js/jquery-ui-1.10.3.custom.min.js"></script>

<script>

var consulta = 7;
var pruta="<?php echo $RUTA; ?>";
var pdatos = "<?php echo $DATOS; ?>";
var pde = "<?php echo $DE; ?>";
var pa = "<?php echo $A; ?>";
var pimposible="<?php echo $IMPOSIBLE_RUTA; ?>";
var preduccioncontaminacion = "<?php echo $REDUCCION_CONTAMINACION; ?>";

var pnoterminalcerca = "<?php echo $NO_TERMINAL_CERCA; ?>";
var pmasinfo = "<?php echo $MAS_INFORMACION; ?>";
var ppedir = "<?php echo $PEDIR; ?>";
var pvcondiciones = "<?php echo $VER_CONDICIONES; ?>";
var pfllegada = "<?php echo $FECHA_LLEGADA; ?>";
var pcontenedor="<?php echo $CONTENEDOR; ?>";
var ptoneladas = "<?php echo $TONELADAS; ?>";
var pttestimado = "<?php echo $TRANSIT_TIME; ?>";
var pdias="<?php echo $DIAS; ?>";
var pcoste="<?php echo $COSTE; ?>";
var penviado ="<?php echo $ENVIADO; ?>";
var pautomatico = "<?php echo $AUTOMATICO; ?>";
var ppreciodeterminar = "<?php echo $PRECIO_A_DETERMINAR; ?>";
var pterminalorigen = "<?php echo $TORIGEN; ?>";
var pterminaldestino = "<?php echo $TDESTINO; ?>";
var masdatos = "<?php echo $OBTENER_COTIZACION; ?>";
var aconsultar = "<?php echo $ACONSULTAR; ?>";



	<?php
		/*$sql="SELECT * FROM eterminales";
		$result = $mysqli->query($sql) or print($mysqli->error);
		
		while($linia=$result->fetch_array()){
		//echo "<option value='".$linia['id']."'>".$linia['nombre']."</option>";
		echo " terminales[".$linia['id']."] = new Array();";
		echo " terminales[".$linia['id']."]['nombre']='".$mysqli->real_escape_string($linia['nombre'])."'; ";
		echo " terminales[".$linia['id']."]['latlong']='".$linia['latlong']."'; ";
		echo " terminales[".$linia['id']."]['transporte']='".$linia['transporte']."'; ";
		echo " terminales[".$linia['id']."]['dir']='".$mysqli->real_escape_string($linia['dir'])."'; ";
		echo " terminales[".$linia['id']."]['radio']=".$linia['radio'].";
		 ";
		}*/
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
$pos=1;
//echo " console.log('Tramos: $tramos'); ";
//$tramos = substr($tramos,1, strlen($tramos));


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
	$i = PosEnArray($terminalesdatos,$v);
	if($i > -1)
	{
		 //echo "$pos '<b>$v</b>' ";
		 //echo $terminalesdatos[$i][1] . "<br>";
		echo " terminales[$pos] = new Array();";
		echo " terminales[$pos]['nombre']='".utf8_encode($mysqli->real_escape_string($v))."'; ";
		echo " terminales[$pos]['latlong']='".$terminalesdatos[$i][2]."'; ";
		echo " terminales[$pos]['dir']= terminales[$pos]['nombre'];"; //'".utf8_encode($mysqli->real_escape_string($terminalesdatos[$i][1]))."';
	}
	else 
	{
		//echo "$pos '<b>$v</b>' <br>";
		echo " terminales[$pos] = new Array();";
		echo " terminales[$pos]['nombre']='".utf8_encode($mysqli->real_escape_string($v))."'; ";
		echo " terminales[$pos]['latlong']=''; ";
		echo " terminales[$pos]['dir']=''; ";
		
	}
	$pos++;
}
		?>




$(document).ready(function(e) {
	
	$('#pedir').hide();
	$('#fondo_negro').hide();
	$('#condiciones').hide();
	
	var fecha = new Date();

			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha").datepicker({firstDay: 1 });
			$( "#fecha" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$( "#fecha" ).val($.datepicker.formatDate('yy-mm-dd', new Date()));
	
			$('#calcula').click( function(e) {
				if(calculando) return 0;

				
				$('#texto2').html("");
				$('#texto').html("");
				//calcula();
				
				origen = $("#torigen").val()*1;
				destino = $("#tdestino").val()*1;
							
				dorigen = $('#dorigen').val();
				ddestino = $('#ddestino').val();
				
				//$.post( "pedir.php",{ dorigen: dorigen, torigen: terminales[origen]['nombre'], ddestino: ddestino, tdestino: terminales[destino]['nombre']}, function(data) {console.log(data);});
	
				if(origen == 0 && destino == 0 && dorigen == '' && ddestino == '' ) return 0;
				if(origen == 0 && dorigen == '') return 0;
				if(destino == 0 && ddestino == '') return 0;
				

				
				//TerminalCerca();
				//calcula();
				
				if(ddestino != '' && dorigen != '') {Coordenadas(); return 0;}
				if(dorigen != '') {CoordenadasOrigen(dorigen); return 0;}
				if(ddestino != ''){CoordenadasDestino(ddestino); return 0;}
				
				calcula();
				
				});
				
			$('#reload').click( function(e) {
				//$('#texto2').html("");
				ter_origen = $("#torigen").val();
				ter_destino = $("#tdestino").val();
				$("#torigen").val(ter_destino);
				$("#tdestino").val(ter_origen);
				
				dir_origen = $("#dorigen").val();
				dir_destino = $("#ddestino").val();
				$("#dorigen").val(dir_destino);
				$("#ddestino").val(dir_origen);
				
				//calcula();
				});
			
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
			
			$('#fondo_negro').click( function(e) {
				$('#pedir').hide();
				$('#fondo_negro').hide();
				});	
				
			$( "#dorigen" ).keypress(function( event ){
				$('#torigen').val(0);
			});
			
			$( "#ddestino" ).keypress(function( event ){
				$('#tdestino').val(0);
			});
			
			$("#dorigen").change(function() {
				$('#torigen').val(0);
			});
			
			$("#ddestino").change(function() {
				$('#tdestino').val(0);
			});
			
			$("#torigen").append($("#torigen option").remove().sort(function(a, b) {
			    var at = $(a).text(), bt = $(b).text();
			    return (at > bt)?1:((at < bt)?-1:0);
			}));
			
			$("#tdestino").append($("#tdestino option").remove().sort(function(a, b) {
			    var at = $(a).text(), bt = $(b).text();
			    return (at > bt)?1:((at < bt)?-1:0);
			}));
			
			$('#torigen').val(0);
			$('#tdestino').val(0);
			
			/*$('#torigen').change(function() {
 				$('#tdestino').html(CargaSelectTerm($('#torigen').val())); 
 				$("#tdestino").append($("#tdestino option").remove().sort(function(a, b) {
			    	var at = $(a).text(), bt = $(b).text();
			   	 return (at > bt)?1:((at < bt)?-1:0);
				}));
				$("#tdestino").val(0);
			});*/
			
			$('.opcion').change(function() {
 				//$('#tdestino').html(CargaSelectTerm($('#torigen').val())); 
 				consulta = parseInt($('#tonelada').val()) + parseInt($('#contenedor').val()) + 6;
 				//console.log(consulta)
 				$.getScript( "tramosjs.php?type="+consulta, function( data, textStatus, jqxhr ) {
				  //console.log( data ); // Data returned
				  console.log( textStatus ); // Success
				  //console.log( jqxhr.status ); // 200
				  //console.log( "Load was performed." );
				  	$('#torigen').html(CargaSelectTerm(0));
					$('#tdestino').html(CargaSelectTerm(0));
					$("#torigen").append($("#torigen option").remove().sort(function(a, b) {
					    var at = $(a).text(), bt = $(b).text();
					    return (at > bt)?1:((at < bt)?-1:0);
					}));
			
					$("#tdestino").append($("#tdestino option").remove().sort(function(a, b) {
					    var at = $(a).text(), bt = $(b).text();
					    return (at > bt)?1:((at < bt)?-1:0);
					}));
					
					$('#torigen').val(0);
					$('#tdestino').val(0);
					
				});
			});
			


			$.getScript( "tramosjs.php?type="+consulta, function( data, textStatus, jqxhr ) {
				  //console.log( data ); // Data returned
				  console.log( textStatus ); // Success
				  //console.log( jqxhr.status ); // 200
				  //console.log( "Load was performed." );
				  	$('#torigen').html(CargaSelectTerm(0));
					$('#tdestino').html(CargaSelectTerm(0));
					
				$("#torigen").append($("#torigen option").remove().sort(function(a, b) {
			    var at = $(a).text(), bt = $(b).text();
			    return (at > bt)?1:((at < bt)?-1:0);
				}));
			
			$("#tdestino").append($("#tdestino option").remove().sort(function(a, b) {
			    var at = $(a).text(), bt = $(b).text();
			    return (at > bt)?1:((at < bt)?-1:0);
			}));
						$('#torigen').val(0);
			$('#tdestino').val(0);
			
					
				});
});








function ObtenerGeo(direccion){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': direccion+", eu",'region': 'EU'}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
	    
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        alert("Geocoding error: " + status);
    }
	});
}






</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpewiv6CSxpjP6FBlg2EAqF7iz5pSyVxM"></script>


</head>

<body>
<div id="head">

<?php 
$page=1;
include("inc/cabecera.php");
?>

<?php include("inc/buscador.php"); ?>

</div>

<div id="fondo_negro"></div>

<div id="pedir"> 
	<div id="texto2"></div>
	<div class="contenedor cpedir">
		<div><?php echo $CONDICIONES_GENERALES; ?></div><br><br>
	
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
	<input type="checkbox" name="con_generales" id="con_generales"	><?php echo $CONDICIONES1; ?><b><i><a href="CGV TP NOVA version 1 <?php echo strtoupper($lang); ?>.pdf" target="_blank" title="<?php echo $CONDICIONES2; ?>"><?php echo $CONDICIONES2; ?></a></i></b>.
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





<div id="contenido">

	<div class="contenedor">

	<div class="tit">
	<div id="texto"></div>
	<div id="condiciones">
	<?php echo $CONDICIONES_GENERALES; ?>
</div>	

<div class="mdatos">
<table>
<tr>
<td width="100"> <img src="img/dot.png"> <?php echo $TEXTO1; ?></td>
<td width="100"> <img src="img/dot.png"> <?php echo $TEXTO2; ?></td>
<td width="100"> <img src="img/dot.png"> <?php echo $TEXTO3; ?></td>
<td width="100"> <img src="img/dot.png"> <?php echo $TEXTO4; ?></td>
</tr>
</table>
</div>

	<div style="margin: 30px 0 60px 0;">	
	
	

	
	
		<div class="bloque">
		<div class="verde">
		<div class="vtit"><?php echo $MULTIMODAL; ?></div>

			<img src="img/conexion.jpg" width="307" height="159" alt="<?php echo $MULTIMODAL; ?>">
		
		</div>
		</div>	

		

		<div class="bloque">
		<div class="negro" style="">
		<div class="vtit" style=""><?php echo $INTERMODAL; ?></div>

			<img src="img/consultoria.jpg" width="307" height="159" alt="<?php echo $INTERMODAL; ?>">
		
		</div>
		</div>	

	</div>		

			<div class="ntit" style="background: rgb(173,2,43);">
			<?php echo $VIDEO; ?>
			</div>
			<br>
		<iframe src="https://drive.google.com/file/d/0B6Xx_OSsf8P-UTBrTm1fR0Jwc28/preview" width="800" height="450"></iframe>


<div style="margin: 60px 0;" >	
			<div class="ntit" style="background: #1e1e1e; " >
			<?php echo strtoupper($CONTENEDOR); ?>
			</div><br>
			
<table  style="width: 800px; margin: 0 auto;" >
<tr>
<td width="200" >
		<img src='img/palet.png' width="128" height="128">
		<br><br>
		<b>STARDARD</b><br>
		1200 x 1000
		<br><br>
		<b>EURO</b><br>
		1200 x 800
</td>
<td width="200">

<div style=" display: inline-block; vertical-align: middle; margin: 10px;" ><img src='img/container.png' width="128" height="128"> </div>
<div style=" display: inline-block; vertical-align: middle; margin: 10px">
<b>20'</b><br> 5898 x 2352 x 2394<br><br>
<b>STANDARD</b> x 10<br>
<b>EURO</b> x 11<br>
</div>

</td>

	<td width="200">
	<div style=" display: inline-block; vertical-align: middle; margin: 10px;" ><img src='img/container.png' width="128" height="128"></div>
	<div style=" display: inline-block; vertical-align: middle; margin: 10px;" >
	<b>40'</b><br> 12031 x 2352 x 2394 <br><br>
	<b>STANDARD</b> x 21<br>
	<b>EURO</b> x 25<br>
	</div>
	</td>

</tr>


</table>
</div>

	</div>
	
</div>
</div>


<footer>
<?php include("inc/colabora.php"); ?>

<?php include("inc/npie.php"); ?>
</footer>


<!--div id="rip" style="position: fixed; top: 50px; border: solid 5px #000; border-radius: 2px; left:50%; margin-left: -400px; box-shadow: 0px 0px 40px #000">
	<img src="rip.jpg" width="800">
</div>

<script>
	
	setTimeout("ocultar();",20000)
	
	$(function(){
  $(window).scroll(function(){
    //var aTop = $('.ad').height();
    if($(this).scrollTop()>=20){
	ocultar();
    }
  	});
	});
	
	function ocultar(){
		$('#rip').hide(1000);
	}
</script -->
</body>
</html>
