
<div id="buscador">
<div class="labbuscador"><?php echo $OBTENER_COTIZACION; ?></div>
<form>

<div class="terminal">
	<?php echo $CONTENEDOR; ?><br>
	<select class="opcion" name="contenedor" id="contenedor" >
		<option value="0">20</option>
		<option value="6">25</option>
		<option value="12">30</option>
		<option value="18">40</option>
		<option value="24">45</option>		
	</select>
</div>

<div class="terminal">
	<?php echo $DIRECCION_ORIGEN; ?><br>
	<input type="text" name="dorigen" id="dorigen">
</div>

<div class="reload">
	<img src="img/reload.png" width="50px" height="50px" id="reload">
</div>

<div class="terminal">
	<?php echo $DIRECCION_DESTINO; ?><br>
	<input type="text" name="ddestino" id="ddestino">
</div>	



<div class="terminal">
<?php echo $FECHA_SALIDA; ?><br>
<input type="text" value="" id="fecha" name="fecha" readonly >
</div>



<div style="height: 15px;"></div>


<div class="terminal">
	<?php echo $TONELADAS; ?><br>

	<select class="opcion" name="tonelada" id="tonelada">
		<option value="1"><?php echo $INFERIOR8; ?></option>
		<option value="2"><?php echo $ENTRE816; ?></option>
		<option value="3"><?php echo $ENTRE1622; ?></option>
		<option value="4"><?php echo $ENTRE2232; ?></option>
		<option value="5"><?php echo $MASDE32; ?></option>		
		<option value="0"><?php echo $VACIO; ?></option>	
	</select>
</div>

<div class="terminal">
	<?php echo $TERMINAL_ORIGEN; ?><br>
	<select name="torigen" id="torigen">
	<option value="0"><?php echo $AUTOMATICO; ?></option>

	</select>
</div>	
<div class="reload">
	
</div>
<div class="terminal">
	<?php echo $TERMINAL_DESTINO; ?><br>
	<select name="tdestino" id="tdestino">
	<option value="0"><?php echo $AUTOMATICO; ?></option>

	</select>
</div>

<div class="terminal">
<input type="button" value="<?php echo $CALCULAR; ?>" id="calcula">
</div>
<br>
	<br><span style="font-size: 12px"><?php echo $CONTACTO_REEFER; ?></span>
</form>

</div>

