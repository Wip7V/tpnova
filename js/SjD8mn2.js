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
var o_lat;
var o_long;
var d_lat;
var d_long;
var terminal_origen_final = 0;
var terminal_destino_final = 0;
var calculando = false;


//var fecha = New Date();


function calcula()
{
	if($("#torigen").val()*1 != 0) origen = $("#torigen").val()*1;
	if($("#tdestino").val()*1 != 0) destino = $("#tdestino").val()*1;
	resultados = new Array();
	
	console.log("------------------------------------------------------");
	
	dorigen = $('#dorigen').val();
	ddestino = $('#ddestino').val();
	
	//if($('#dorigen').val()!=''){origen=0;}
	//if($('#ddestino').val()!=''){destino=0;}
	if(origen == 0 && dorigen != '' && destino == 0 && ddestino != '') {TerminalCerca(); return 0;}
	if(origen == 0 && dorigen != '') {TerminalCercaOrigen(dorigen); return 0;}
	if(destino == 0 && ddestino != ''){TerminalCercaDestino(ddestino); return 0;}
	
	$('body').css("cursor",'inherit');
	$('input').css("cursor",'inherit');
	$('select').css("cursor",'inherit');
	calculando = false;
	$('#calcula').css("background",'#004b9c');
	
	$('#km0').removeClass('error');
	$('#km1').removeClass('error');
	
	if(origen == 0 && destino == 0 && dorigen == '' && ddestino == '' ) return 0;
	if(origen == 0 && dorigen == '') return 0;
	if(destino == 0 && ddestino == '') return 0;
	

	
	//document.getElementById('calcula').style.cursor = 'wait';
	
	/*$('body').css("cursor",'wait');
	$('input').css("cursor",'wait');
	$('select').css("cursor",'wait');*/
	
	$('html, body').animate({scrollTop:500}, 200);				
					

	
	tte=9999999999;
	precio=99999999999;
	rfinal=0;
	
	origenes = new Array();	
	if($('#dorigen').val()!='' && $("#torigen").val()*1 == 0){
		origenes = ArrayTerminalesCerca(o_lat,o_long);	
		//console.log('buscando terminales cerca origen');
	} else {
		origenes[origenes.length] = origen;
	}
	
	
	destinos = new Array();	
	if($('#ddestino').val()!='' && $("#tdestino").val()*1 == 0){
		destinos = ArrayTerminalesCerca(d_lat,d_long);
	} else {
		destinos[destinos.length] = destino;
	}
	
	
	for(var or in origenes)for(var de in destinos)//if(origen > 0 && destino > 0)
	{
		origen = origenes[or];
		destino = destinos[de];
		console.log("***");
		console.log("Buscando entre: " + terminales[origen]['nombre'] + " y " + terminales[destino]['nombre']);
		var intentos = 5;
		
		
		tcaminos=0;
		
		longitud=2;
		if(origen != destino){
			while(tcaminos<1 && intentos>0) //si no he encontrado ningun camino aumento la longitud en tramos a buscar hasta un maximo de 6
			{
				tramo(0,ruta);	
				longitud+=1;
				intentos--;
			}
		}
	}
	
	resultados.sort(sortFunction);
	/*
	//$("#torigen").val(terminal_origen_final);
	origen = terminal_origen_final;
	//$("#tdestino").val(terminal_destino_final);
	destino = terminal_destino_final;
	
	lterminales = "";
	
		html = "<style> .resultado{margin: 10px auto;background: #00b48e;width: 97%;text-align: center;} .resultado th{	background: #00b48e; padding: 5px; color:#fff;} .resultado td{ background: #fff; padding: 5px;} .resultado tfoot td{background: #00b48e; color:#fff; }</style>";
	html += "<table class='resultado'><thead><tr><th></th><th>"+pruta+"</th><th>"+pdatos+"</th></thead><tbody>";	
	

	if(dorigen != '' && origen > 0){
		if(terminales[origen]['latlong'] != ''){
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pde+": "+dorigen+"<br>"+pa+": "+terminales[origen]['dir']+"</td><td><div id='km0'></div></td></tr>";
			//if()
			distancias(dorigen,terminales[terminal_origen_final]['latlong'],'#km0');
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

	
	
	

	html += "<tr><td><img src='http://tpnova.com/img/tren.png'></td><td>" + pterminalorigen + " <b>" +terminales[origen]['nombre']+"</b> - "+ pterminaldestino+ " <b>" +terminales[destino]['nombre']+"</b><br>"+pcontenedor+": "+$("#contenedor option:selected").text()+". "+ptoneladas+": "+$("#tonelada option:selected").text()+".<br> "+mostrarFecha(tte)+"</td><td><din id='precio_tren'>" + pttestimado+": "+ tte + " "+pdias+". <br>"+pcoste+":  </div></td></tr>";
				$.getScript( "tramosjs.php?type="+consulta+"&tramos="+rutaAtramos(rfinal), function( data, textStatus, jqxhr ) {

				  precio += sumaBFlonlat(''+rutaAtramos(rfinal));
				 precio = Math.round(precio*100)/100;
				  $('#precio_tren').html($('#precio_tren').html()+ precio + "<img src='http://tpnova.com/img/euro.png'>");

				});
	}
	 

	if(ddestino != '' && destino > 0){
		if(terminales[destino]['latlong'] != ''){
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pde+": "+terminales[destino]['dir']+"<br>"+pa+": "+ddestino+" </td><td><div id='km1'></div></td></tr>";
			distancias(terminales[terminal_destino_final]['latlong'],ddestino,'#km1');
		} else {
			html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>Imposible calcular distancia.</td><td></td>";
		}
	}
	
	if(destino == -1){
		html += "<tr><td><img src='http://tpnova.com/img/camion.png'></td><td>"+pnoterminalcerca+"</td><td></td>";
		destino = 0;
	}
	
	html += "</tbody><tfoot><tr><td></td><td class='tpedir'> "+pmasinfo+" <span class=tcondiciones>"+pvcondiciones+"</span></td><td class='tpedir'><input type='button' id='bpedir' value='"+ppedir+"'></td></tr></tfoot></table>";*/
	
	
	html = "<style> .resultado{margin: 10px auto;background: #00b48e;width: 97%;text-align: center;} .resultado th{	background: #00b48e; padding: 5px; color:#fff;} .resultado td{ background: #fff; padding: 5px;} .resultado tfoot td{background: #00b48e; color:#fff; }</style>";
	html += "<table class='resultado'><thead><tr><th></th><th></th><th></th></thead><tbody>";	
		
	for(x=0; x<5; x++){
		if(resultados.length>=x)
		{
			origen = resultados[x]["origen"];
			destino = resultados[x]["destino"];
			precio = resultados[x]["precio"];
			tte = resultados[x]["tte"];
			html += "<tr><td><b>"+terminales[origen]['nombre']+"</b> - <b>"+terminales[destino]['nombre']+"</b></td>";
			
			html+= "<td>"+pttestimado+": "+ tte + " "+pdias+ " " +precio + "€</td><td> <input type='button' id='bpedir' value='"+ppedir+"' onclick='MostrarResultado("+x+");'></td></tr>";
		}
	}
	
	html+="</table>";


	$("#texto").html(html);

//$.post( "pedir.php",{ dorigen: dorigen, torigen: terminales[origen]['nombre'], ddestino: ddestino, tdestino: terminales[destino]['nombre']}, function(data) {console.log(data);});	

	$(".tcondiciones").mouseover(function(){$('#condiciones').show();});
	$(".tcondiciones").mouseout(function(){$('#condiciones').hide();});
	
				/*$('#bpedir').click( function(e) {
					
				$('#pedir').show();
				$('#fondo_negro').show();
				
				
				//$('#texto2').html($('#texto').html());
				
				$('#texto2 .tpedir').html('');
				});*/
	//console.log(rutaAtramos(rfinal));
	

	
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

	
	
	

	html += "<tr><td><img src='http://tpnova.com/img/tren.png'></td><td>" + pterminalorigen + " <b>" +terminales[origen]['nombre']+"</b> - "+ pterminaldestino+ " <b>" +terminales[destino]['nombre']+"</b><br>"+pcontenedor+": "+$("#contenedor option:selected").text()+". "+ptoneladas+": "+$("#tonelada option:selected").text()+".<br> "+mostrarFecha(tte)+"</td><td><din id='precio_tren'>" + pttestimado+": "+ tte + " "+pdias+". <br>"+pcoste+":  </div></td></tr>";
				$.getScript( "tramosjs.php?type="+consulta+"&tramos="+rutaAtramos(rfinal), function( data, textStatus, jqxhr ) {

				  precio += sumaBFlonlat(''+rutaAtramos(rfinal));
				 precio = Math.round(precio*100)/100;
				  $('#precio_tren').html($('#precio_tren').html()+ precio + "<img src='http://tpnova.com/img/euro.png'>");

				});
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
	
	html += "</tbody><tfoot><tr><td></td><td class='tpedir'> "+pmasinfo+" <span class=tcondiciones>"+pvcondiciones+"</span></td><td class='tpedir'><input type='button' id='bpedir' value='"+ppedir+"'></td></tr></tfoot></table>";
	
	$('#texto2').html(html);
}



function radians(degrees)
{
  var pi = Math.PI;
  return degrees * (pi/180);
}

function DistanciaLinealCoord(olat,olong,dlat,dlong){
	dist = 6371 * Math.acos(( 
                                Math.sin(radians(dlat)) * Math.sin(radians(olat)) 
                                + Math.cos(radians(dlong - olong)) * Math.cos(radians(dlat)) 
                                * Math.cos(radians(olat))
                                )
                   );
    return dist;
}

//comprueba que las distancias esten dentro de rango
/*
function compruebaDistancias(){

	if(origen > 0 && dorigen != ''){
		if(!$('#km0').hasClass('error')){
			if(terminales[origen]['radio'] < parseInt($('#km0').html())){
				$('#km0').addClass('error');
				$('#km0').html($('#km0').html()+ "<br><b>Demasiada distancia</b></br>");
			}
		}
	}

	if(destino > 0 && ddestino != ''){
		if(!$('#km1').hasClass('error')){
			if(terminales[destino]['radio'] < parseInt($('#km1').html())){
				$('#km1').addClass('error');
				$('#km1').html($('#km1').html()+ "<br><b>Demasiada distancia</b></br>");
			}	
		}
	}	

}*/

//funcion que recibe latitud y longitud y retorna el id de la terminal mas cercana dentro de rango
function tc(lat, lon){
	var id = -1;
	var dist = 900;
	
	for(var i in terminales){
		if(terminales[i]['latlong']!='')
		{
			tcoord = terminales[i]['latlong'].split(",");
			cdist = DistanciaLinealCoord(lat,lon,tcoord[0],tcoord[1]);
			////console.log(cdist + " dist con " + terminales[i]['nombre']);
			if(cdist < 400){
				if(cdist < dist){
					dist = cdist;
					id = i;
					if(dist < distanciaminimaterminal) return id;
					
					//preguntar si existe la posibilidad de un punto entre dos radios de terminales
					//return id;
				}
			}
		}
	}
	
	return id;
}

function ArrayTerminalesCerca(lat, lon){
	var id = -1;
	var dist = 900;
	var terminales_cerca = new Array();

	
	for(var i in terminales){
		if(terminales[i]['latlong']!='')
		{
			tcoord = terminales[i]['latlong'].split(",");
			cdist = DistanciaLinealCoord(lat,lon,tcoord[0],tcoord[1]);
			////console.log(cdist + " dist con " + terminales[i]['nombre']);
			if(cdist < 400){
				
				if(cdist<160){
					terminales_cerca[terminales_cerca.length] = i*1;
				}
				
				if(cdist < dist){
					dist = cdist;
					id = i;
				}
			}
		}
	}
	
	if(terminales_cerca.length==0) terminales_cerca[terminales_cerca.length] = id;
	
	return terminales_cerca;
}


function TerminalCerca(){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': $('#dorigen').val()}, function(results, status) {
    if (status == 'OK') {
    	o_lat = results[0].geometry.location.lat();
    	o_long = results[0].geometry.location.lng();
	    origen = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
	    //if(origen > 0) $('#torigen').val(origen);
    } else {
    	//$('#dorigen').val('');
    	}
});
	geocoder.geocode({ 'address': $('#ddestino').val()}, function(results, status) {
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



//le paso una direccion y me devuelve el id de la terminal mas cercana dentro de rango
function TerminalCercaOrigen(dir){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': dir}, function(results, status) {
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

function TerminalCercaDestino(dir){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({ 'address': dir}, function(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
		////console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng());
		d_lat = results[0].geometry.location.lat();
    	d_long = results[0].geometry.location.lng();
	    destino = tc(results[0].geometry.location.lat(),results[0].geometry.location.lng());
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

//recive un array de tramos devuelve la suma del campo deseado
function suma(tramos, valor)
{
	var total = 0;
		for(var i in tramos){
			total+=parseFloat(salto[tramos[i]][valor]);
		}
	return Math.round(total*100)/100;
}

//rellena selectorres con la lista de terminales
function CargaSelectTerm(ignora){
	html = '<option value=0 >'+pautomatico+'</option>';
	for(var i in terminales){
		//if(i != ignora && TerminaTramos(i))
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

//se paso un valor y lo busca dentro de una lista separada por comas
function enlista(valor, cadena){
	var lista = cadena.split(",");
	for(var i in lista){
			if(lista[i]==valor) return true;
		}
	return false;
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

//funcion recursiva que busca rutas entre los tramos
function tramo(pos,ruta){

if(pos==0) //'si es 0 es que empieza en Origen'
{
	var dir = caminos(origen,ruta);
}
else{
	////console.log(salto[pos]['origen']+ " - " + salto[pos]['destino'] );
	ruta+=","+salto[pos]['origen'];
	var dir = caminos(salto[pos]['destino'],ruta);
	
	
	
	if(salto[pos]['destino']==destino){	
		ruta+=","+salto[pos]['destino'];
		//console.log("Final: "+ruta);
		
		stte=suma(rutaAtramos(ruta),"tte");
		sprecio=suma(rutaAtramos(ruta),"precio");
		
		if(stte==tte && sprecio < precio){ //si encuentro una ruta mas rapida que la guardada
			tte = stte;
			precio = sprecio;
			rfinal = ruta;
			////console.log("Igual de rápida pero mas economica: TTE= " +tte+ " - " + precio + "€");
		}	
		lterminales = "";
			lrfinales =ruta.split(",");
			for(var i in lrfinales){
				if(terminales[lrfinales[i]] != null) lterminales+=terminales[lrfinales[i]]['nombre']+", ";
			}
		console.log("Posible ruta: " + lterminales + " TTE:" + stte+ " - " + sprecio + "€");
		
		//if(stte<tte){ //si encuentro una ruta mas rapida que la guardada
		if(sprecio < precio){ //si encuentro una ruta mas economica
			
			tte = stte;
			precio = sprecio;
			rfinal = ruta;
			terminal_origen_final = origen;
			terminal_destino_final = destino;
			////console.log("Opcion mas rápida: TTE= " +tte+ " - " + precio + "€");
		}		
		var pos = resultados.length;
		resultados[pos] = new Array();
		resultados[pos]["origen"] = origen;
		resultados[pos]["destino"] = destino;
		resultados[pos]["precio"] = sprecio;
		resultados[pos]["tte"] = tte;
		resultados[pos]["ruta"] = ruta;
		
		
		tcaminos++;//contador de caminos encontrados
	}	
}
	if(ruta.split(",").length < longitud){
		for(x in dir){
			tramo(dir[x],ruta);
		}
	}

}

function sumaBFlonlat(tramos)
{
	var result = 0;	
	tramos = tramos.split(",");

	for(var i in tramos){
		if(salto[tramos[i]]['bf']==1){
			if(terminales[salto[tramos[i]]['origen']]['latlong'] != '' && terminales[salto[tramos[i]]['destino']]['latlong'] != '')
			{
				latlong_origen = terminales[salto[tramos[i]]['origen']]['latlong'].split(",");
				latlong_destino = terminales[salto[tramos[i]]['destino']]['latlong'].split(",");
				tramo_distancia = DistanciaLinealCoord(latlong_origen[0],latlong_origen[1],latlong_destino[0],latlong_destino[1]);
				
				if(tramo_distancia<500) result += 100;
				if(tramo_distancia>=500 && tramo_distancia<1000) result += 150;
				if(tramo_distancia>1000) result += 200;
				console.log("Kilometros internacional:"+tramo_distancia);
				console.log("Precio BF internacional: "+result);
			}
		}
	}
	//console.log("BF total por distancias: "+result);
	
	return result;
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

function sortFunction(a, b) {
    if (a["precio"] === b["precio"]) {
        return 0;
    }
    else {
        return (a["precio"] < b["precio"]) ? -1 : 1;
    }
}