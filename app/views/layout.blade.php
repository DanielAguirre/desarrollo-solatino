<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Reservaciones</title>
	{{HTML::style('assets/css/vendor/normalize.css')}}
	{{HTML::style('assets/css/vendor/jquery-ui-1.10.4.custom.css')}}
		
 	{{HTML::style('assets/css/estilo.css')}}

	
</head>
<body>	
	@yield('content')
	<div id="overlay">
		<div>
			<p>contenido</p>
			<table border=1>
				<tr>
					<td>SGL</td>
					<td>DBL</td>
					<td>TPL</td>
					<td>CPL</td>
					<td>MNR</td>
					<td>MNRX</td>
					<td>Codigo</td>
					<td>JR</td>
					<td>Aplica</td>
					<td>Tipo Habitacion</td>
					<td>Vigencia</td>
					<td>Dias</td>
					<td>Promociones</td>
					<td>Dias de  Promociones</td>
					<td>Combina Promo</td>
					<td>Preventea</td>
					<td>tarifa de Grupo</td>
					<td>Observaciones Internas</td>
					<td>Publicable</td>
				</tr>
			</table>
			<input type="button" value="cerrar" id="cerrarModal">
		</div>

	</div>
	
	{{HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js')}}
	{{HTML::script('assets/js/vendor/jquery-ui-1.10.4.custom.min.js')}}	
	{{HTML::script('assets/js/vendor/underscore.js')}}
	{{HTML::script('assets/js/vendor/backbone.js')}}
	{{HTML::script('assets/js/vendor/bootstrap.min.js')}}
	{{HTML::script('assets/js/init.js')}}

	{{HTML::script('assets/js/models/hotel.js')}}
	{{HTML::script('assets/js/models/plan.js')}}
	{{HTML::script('assets/js/models/bloqueo.js')}}
	{{HTML::script('assets/js/models/agencia.js')}}

	{{HTML::script('assets/js/collections/destinos.js')}}
	{{HTML::script('assets/js/collections/hoteles.js')}}
	{{HTML::script('assets/js/collections/plan.js')}}
	{{HTML::script('assets/js/collections/bloqueo.js')}}
	{{HTML::script('assets/js/collections/agencias.js')}}
	{{HTML::script('assets/js/collections/contactosAgencia.js')}}
	{{HTML::script('assets/js/collections/tarifas.js')}}

	{{HTML::script('assets/js/views/app.js')}}
	{{HTML::script('assets/js/views/habitaciones.js')}}
	{{HTML::script('assets/js/views/formasPago.js')}}

	{{HTML::script('assets/js/main.js')}}

	<script type="text/template" id='hotelesTemplate'>
		<option value="<%=id_hotel%>"><%= nombre %></option>
	</script>
	<script type="text/template" id='personasTemplate'>
		<span>hab. <%=numero%></span>
		<select name="adultos<%=numero%>" class="adultostemplate" id="adultos<%=numero%>" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<select name="niños<%=numero%>" class="niñostemplate" id="niños<%=numero%>" data-habitacion="<%=numero %>">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select>
		<label for="" id="tipoHabitacion<%=numero%>">Sencilla</label>
	</script>
	<script type="text/template" id="edadesTemplate">	
		<select name="edades_<%=numero%>" id="edades">
			<option value="">-?-</option>
			<option value="1"> < 1</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="1">9</option>
			<option value="2">10</option>
			<option value="3">11</option>
			<option value="4">12</option>
			<option value="5">13</option>
			<option value="6">14</option>
			<option value="7">15</option>
			<option value="8">16</option>
			<option value="8">17</option>
		</select>
	</script>
	<script type="text/template" id="pago">
		<section class="datos">
			<input type="text" class="normal-text" name="monto" id="monto"  placeholder="Monto"  required >
			<input type="text" class="normal-text" name="comision" id="comision" placeholder="Comisión"  required >
			<input type="text" class="normal-text" name="toalSolatinoPago" id="totalSolatinoPago" placeholder="Total Solatino" required >
		</section>
	</script>
	<script type="text/template" id ="tcComisionAbierta">
		<section class="datos">
			<input type="text" name="numeroTrajeta" placeholder="Número de tarjeta">
			<input type="text" name="fechaVencimiento" placeholder="Fecha de Vencimiento">
			<input type="text" name="codigoSeguridad" placeholder="Codigo de seguridad">
		</section>	
	</script>
	<script type="text/template" id="pagoNumerado">
		<section class="datos">
			<input type="text" class="monto normal-text" name="monto<%=numero -1%>" placeholder="Monto" required id="monto<%=numero-1%>">
			<input type="text" class="normal-text" name="comision<%=numero -1%>" placeholder="Comisión" required id="comision<%=numero-1%>">
			<input type="text" class="normal-text" name="toalSolatinoPago<%=numero -1%>" placeholder="Total Solatino" required id="toalSolatinoPago<%=numero-1%>">
		</section>
	</script>
	<script type="text/template" id ="tcComisionAbiertaNumerado">
		<section class="datos">
			<input type="text" name="numeroTrajeta<%=numero -1%>" placeholder="Número de tarjeta">
			<input type="text" name="fechaVencimiento<%=numero -1%>" placeholder="Fecha de Vencimiento">
			<input type="text" name="codigoSeguridad<%=numero -1%>" placeholder="Codigo de seguridad">
		</section>	
	</script>
	<script type="text/template" id = "formaPagoTemplate">
		<section class="formapago">
			<label for="formaPago">Forma de Pago <%=numero+1%></label>
				<select name="formaPago<%=numero%>" id="formaPago<%=numero%>">
					<option value="">-- Elija una Opcion --</option>
					<option value="1">Depósito en Efectivo 12%</option>
					<option value="2">Depósito a tarjeta 15%</option>
					<option value="3">Efectivo 15%</option>
					<option value="4">Efectivo 16%</option>					
					<option value="8">Tarjeta de Crédito 10%</option>
					<option value="9">Transferencia o depósito con cheque 15%</option>
				</select>
		</section>
	</script>
	<script type="text/tempate" id="formAgencia">
		<div>
			<input type="text" placeholder="Nombre de la agencia">
			<input type="text" placeholder="Telefono">
			<input type="text" placeholder="Nombre del Contacto">
			<input type="text" placeholder="Email del Contacto">
		</div>
	</script>
	<script type="text/template" id="formAgente">
		<div>
			<input type="text" placeholder="Nombre">
			<input type="email" placeholder="Email">
		</div>
	</script>
	<script type="text/template" id="tablaTarifa">
		<tr>
			<td><%=tsencilla%></td>
			<td><%=tdoble%></td>
			<td><%=ttriple%></td>
			<td><%=tcuadruple%></td>
			<td><%=tmenor%></td>
			<td><%=tmenorxt%></td>
			<td><%=tjunior%></td>
			<td><%=aplica%></td>
			<td><%=codigo%></td>
			<td><%=tipohab%></td>
			<td><%=vigencia_inicio%> / <%=vigencia_fin%></td>
			<td><%=dias%></td>
			<td><%=promocion1%> / <%=promocion2%></td>
			
			<td><%=dias1%>/<%=dias2%></td>
			<td><secombina></td>
			<td><%=preventa%></td>
			<td><%=grupo%></td>
			<td><%=observacionesinternas%></td>
			<td><%=publicable%></td>
			
		</tr>
	</script>
</body>
</html>