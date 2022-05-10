// JavaScript Document by Albert Lombarte ajlombarte@yahoo.es 2017

//var url = "main.php";

var evento = 'mousedown';
if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/android/i)) evento = 'touchend';


var salto = new Array();
var terminales = new Array();
var coordenadas = new Array();
var resultados = new Array();
var distanciaminimaterminal = 5; //si encuentra una terminal a menos de esta distancia que no busque mas
var html = "";
var origen = 0;
var destino = 0;
var longitud = 2;
var ruta = '';
var tcaminos = 0;
var rfinal = '';
var tte = 9999999;
var precio = 0;
var origenes = new Array();
var destinos = new Array();
var o_lat=0;
var o_long=0;
var d_lat=0;
var d_long=0;
var terminal_origen_final = 0;
var terminal_destino_final = 0;
var calculando = false;



//var fecha = New Date();


function calcula()
{
	resultados = new Array();
	
					$('body').css("cursor",'wait');
				$('input').css("cursor",'wait');
				$('select').css("cursor",'wait');
				
				$('#calcula').css("background",'#aaaaaa');
				console.log('calculando');
				calculando = true;
	//if($('#dorigen').val()!=''){origen=0;}
	//if($('#ddestino').val()!=''){destino=0;}
	
		//console.log("------------------------------------------------------");

	
	//if(dorigen != '' && ddestino != '') {Coordenadas(); return 0;}
	//if(dorigen != '') {CoordenadasOrigen(dorigen); return 0;}
	//if(ddestino != ''){CoordenadasDestino(ddestino); return 0;}
	
		//console.log("------------------------------------------------------");

	
	//document.getElementById('calcula').style.cursor = 'wait';
	
	/*$('body').css("cursor",'wait');
	$('input').css("cursor",'wait');
	$('select').css("cursor",'wait');*/
	
				

	//$.getScript( "calcular.php?type="+consulta+"&o="+o_lat+","+o_long+"&d="+d_lat+","+d_long+"&to="+origen+"&td="+destino+"&db=5", function( data, textStatus, jqxhr ) {});
	$.get( "calcular.php",{ type: consulta, o: o_lat+","+o_long, d: d_lat+","+d_long, to:origen, td: destino, db: 5, toneladas:$('#tonelada').val()}, function(data) { 
		$('body').css("cursor",'inherit');
	$('input').css("cursor",'inherit');
	$('select').css("cursor",'inherit');
	calculando = false;
	$('#calcula').css("background",'#004b9c');
	
	$('#km0').removeClass('error');
	$('#km1').removeClass('error');
	setTimeout(data,0);
	o_lat=0;
	o_long=0;
	d_lat=0;
	d_long=0;
	});	
	
}

function MostrarResultados(){
	$('html, body').animate({scrollTop:500}, 200);	
		html = "<style> .resultado{margin: 10px auto;background: #00b48e;width: 97%;text-align: center;} .resultado th{	background: #00b48e; padding: 5px; color:#fff;} .resultado td{ background: #fff; padding: 5px;} .resultado tfoot td{background: #00b48e; color:#fff; }</style>";
	html += "<table class='resultado'><thead><tr><th></th><th></th><th></th></thead><tbody>";	
	var z = 0;
	for(var x in resultados){
			origen = resultados[x]["origen"];
			destino = resultados[x]["destino"];
			precio = resultados[x]["precio"];
			tte = resultados[x]["tte"];
			re  =resultados[x]["re"];
			html += "<tr><td>"
			//if(dorigen!='') html+=dorigen + 
			html+="<b>"+terminales[origen]['nombre']+"</b> - <b>"+terminales[destino]['nombre']+"</b>"
			html+="</td>";
			//html+"<td>";
			if(precio<0) precio =aconsultar; else precio+="€";	
			if(tte<0) tte=aconsultar;			
			html+= "<td>"+pttestimado+": "+ tte + " "+pdias+ "<br>"+pcoste+":" +precio + "</td>";

			if(re>0) html+="<td>"+preduccioncontaminacion+":<br>"+re+" KgCo2<br></td>";
			html+="<td> <input type='button' id='bpedir' value='"+masdatos+"' onclick='MostrarResultado("+x+");'></td></tr>";	
			z++;
	}
	if(z==0) html+="<tr><td colspan='3'>"+pimposible+"</td></tr>";
	
	html+="</tbody><tfoot><tr><td></td><td></td><td><a href='https://ecotransit.org/calculation.fr.html' target='_blank'><input type='button' value='Ecotransit'></a></td><td></td></tfoot></table>";


	$("#texto").html(html);

//$.post( "pedir.php",{ dorigen: dorigen, torigen: terminales[origen]['nombre'], ddestino: ddestino, tdestino: terminales[destino]['nombre']}, function(data) {console.log(data);});	


}

function MostrarResultado(id){
	
						
				$('#pedir').show();
				$('#fondo_negro').show();
				
				
				//$('#texto2').html($('#texto').html());
				
				$('#texto2 .tpedir').html('');
		//$("#torigen").val(terminal_origen_final);
	
	origen = resultados[id]["origen"];
	//$("#tdestino").val(terminal_destino_final);
	destino = resultados[id]["destino"];
	rfinal = resultados[id]["ruta"];
	precio = resultados[id]["precio"];
	tte = resultados[id]["tte"];
	
	lterminales = "";
	
		html = "<style> .resultado{margin: 10px auto;background: #00b48e;width: 97%;text-align: center;} .resultado th{	background: #00b48e; padding: 5px; color:#fff;} .resultado td{ background: #fff; padding: 5px;} .resultado tfoot td{background: #00b48e; color:#fff; }</style>";
	html += "<table class='resultado'><thead><tr><th></th><th>"+pruta+"</th><th>"+pdatos+"</th></thead><tbody>";	
	

	if(dorigen != '' && origen > 0){
		if(terminales[origen]['latlong'] != ''){
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pde+": "+dorigen+"<br>"+pa+": "+terminales[origen]['dir']+"</td><td><div id='km0'></div></td></tr>";
			//if()
			distancias(dorigen,terminales[origen]['latlong'],'#km0');
		} else {
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pimposible+"</td><td></td>";
		}
	}

	if(origen == -1){
		html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pnoterminalcerca+"</td><td></td>";
		origen = 0;
	}
	
	if(rfinal == 0)
	{
		html += "<tr><td><img src='http://tpnova.com/img/tren.png'></td><td>"+pimposible+"</td><td></td></tr>";
	}
	else
	{
	
	lrfinales = rfinal.split(",");
	for(var i in lrfinales){
		if(terminales[lrfinales[i]] != null) lterminales+=terminales[lrfinales[i]]['nombre']+", ";
	}

	
	
	if(precio<0) precio =aconsultar; else precio+="<img src='http://tpnova.com/img/euro.png'>";	
	if(tte<0) tte=aconsultar;

	html += "<tr><td><img src='http://tpnova.com/img/tren.png'></td><td>" + pterminalorigen + " <b>" +terminales[origen]['nombre']+"</b><br> "+ pterminaldestino+ " <b>" +terminales[destino]['nombre']+"</b><br>"+pcontenedor+": "+$("#contenedor option:selected").text()+". "+ptoneladas+": "+$("#tonelada option:selected").text()+".<br> "+mostrarFecha(tte)+"</td><td><din id='precio_tren'>" + pttestimado+": "+ tte + " "+pdias+". <br>"+pcoste+":"+precio+"</div></td></tr>";
				/*$.getScript( "tramosjs.php?type="+consulta+"&tramos="+rutaAtramos(rfinal), function( data, textStatus, jqxhr ) {

				 // precio += sumaBFlonlat(''+rutaAtramos(rfinal));
				 //precio = Math.round(precio*100)/100;
				 // $('#precio_tren').html($('#precio_tren').html()+ precio + "<img src='http://tpnova.com/img/euro.png'>");

				});*/
	}
	 

	if(ddestino != '' && destino > 0){
		if(terminales[destino]['latlong'] != ''){
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pde+": "+terminales[destino]['dir']+"<br>"+pa+": "+ddestino+" </td><td><div id='km1'></div></td></tr>";
			distancias(terminales[destino]['latlong'],ddestino,'#km1');
		} else {
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>Imposible calcular distancia.</td><td></td>";
		}
	}
	
	if(destino == -1){
		html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pnoterminalcerca+"</td><td></td>";
		destino = 0;
	}
	
	html += "</tbody><tfoot><tr><td class='tpedir' colspan='3'> </span></td></tr></tfoot></table>"; //<td class='tpedir'></td><input type='button' id='bpedir' value='"+ppedir+"'><td></td>"+pmasinfo+" <span class=tcondiciones>"+pvcondiciones+"
	
	$('#texto2').html(html);
		$(".tcondiciones").mouseover(function(){$('#condiciones').show();});
	$(".tcondiciones").mouseout(function(){$('#condiciones').hide();});
}



//le paso una direccion y me devuelve el id de la terminal mas cercana dentro de rango
function CoordenadasOrigen(dir){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': dir+", eu",'region': 'EU'}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		////console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
		o_lat = results[0].geometry.location.lat();
    	o_long = results[0].geometry.location.lng();
	    //origen = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
	    //if(origen > 0) $('#torigen').val(origen);
	    calcula();
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        //alert("Geocoding no tuvo éxito debido a: " + status);
        //$('#dorigen').val('');
    }
});
}

function CoordenadasDestino(dir){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': dir+", eu",'region': 'EU'}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		////console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
		d_lat = results[0].geometry.location.lat();
    	d_long = results[0].geometry.location.lng();
	    //destino = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
	    //if(destino > 0) $('#tdestino').val(destino);
	    calcula();
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        //alert("Geocoding no tuvo éxito debido a: " + status);
        //$('#ddestino').val('');
    }
});
}



function Coordenadas(){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': $('#dorigen').val()+", eu",'region': 'EU'}, function(results, status) {
    if (status == 'OK') {
    	o_lat = results[0].geometry.location.lat();
    	o_long = results[0].geometry.location.lng();
	    //origen = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
	    //if(origen > 0) $('#torigen').val(origen);
    } else {
    	//$('#dorigen').val('');
    	}
});
	geocoder.geocode({ 'address': $('#ddestino').val()+", eu", 'region': 'EU'}, function(results, status) {
    if (status == 'OK') {
	    //destino = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
	    d_lat = results[0].geometry.location.lat();
    	d_long = results[0].geometry.location.lng();
	    //if(destino > 0) $('#tdestino').val(destino);
	    
	    calcula();
    } else {
    	//$('#ddestino').val('');
    	}
});
}




function distancias(origen,destino, capa){
/*var origin1 = new google.maps.LatLng(55.930385, -3.118425);
var origin2 = "Greenwich, England";
var destinationA = "Stockholm, Sweden";
var destinationB = new google.maps.LatLng(50.087692, 14.421150);*/

var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
  {
    origins: [origen],
    destinations: [destino],
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: false,
  }, function(response, status) {
  // See Parsing the Results for
  // the basics of a callback function.
   if (status == 'OK') {
	////console.log(status);
	////console.log(response);
  	////console.log(response.rows[0].elements[0].distance);
  	$(capa).html(response.rows[0].elements[0].distance.text + "<br>"+ppreciodeterminar);
  	//compruebaDistancias();
  	
  } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
       //return "Error en calculo de distancia: " + status;
       $(capa).html("Error en calculo de distancia: " + status);
    }
});
	
}


//rellena selectorres con la lista de terminales
function CargaSelectTerm(ignora){
	html = '<option value=0 >'+pautomatico+'</option>';
	for(var i in terminales){
		if(i != ignora && TerminaTramos(i))
		html+='<option value=' + i + " >"+terminales[i]['nombre']+'</option>';
	}
	return html;
}

//me dice si una terminal esta en la lista de tramos como origen o destino
function TerminaTramos(terminal){
	for(var i in salto){
		if(salto[i]['origen'] == terminal) return true;
		if(salto[i]['destino'] == terminal) return true;
		}
		return false;
}

function mostrarFecha(days){
    fecha=new Date($('#fecha').val());
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
 
    ////console.log("Fecha actual: "+day+"/"+month+"/"+year);
     
    tiempo=fecha.getTime();
    milisegundos=parseInt(days*24*60*60*1000);
    total=fecha.setTime(tiempo+milisegundos);
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
 
    return pfllegada+" "+day+"/"+month+"/"+year;
}
