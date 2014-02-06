@extends ('layout')
@section('content')	
	 {{Form::open(array('route' => 'reservacion.store', 'method' => 'POST'))}}
		<div>
			<label for="destio">Destinos</label>
			<input type="hidden" name="id_destino" id="destinoOculto">
				<input type="text" placeholder="Destino" name ="destino" id="destino" class="long-text" list="listdestinos" required>	
			<datalist id="listdestinos"></datalist>
			<label for="hotel" >Hotel</label>
				<input type="hidden" name="id_hotel" id="hotelOculto">
				<input type="text" placeholder ="Hotel"  name="hotel" list="listhoteles" class="long-text" id="hotel" required>
					<datalist id="listhoteles"></datalist>

			<label for="plan">Tipo de Plan </label>
				<input type="hidden" name="id_plan" id="planOculto">
				<input type="text" placeholder="Plan" name="plan" list="listPlan" id="plan" >
				<datalist id="listPlan">
				</datalist>

			<label for="bloqueo">Bloqueo</label>
			<select name="id_bloqueo" id="bloqueo">
				<option value="">-- Elija una Opcion --</option>
			</select>
			<p>
				<label for="nombre">Nombre </label>
					<input type="text" placeholder='Nombre' id='nombre' name ='nombre' class='long-text' required>
				<label for="fechaIngreso">Fecha Ingreso</label>
					<input type="date" id='fecha_Ingreso' name='fecha_Ingreso' required>
				<label for="fechaSalida">Fecha Salida</label>
					<input type="date" id='fecha_Salida' name='fecha_Salida' required>
				<label for="noches">Noches</label>
					<input type="text" name ='noches' id='noches' class="small-text" readonly placeholder='Noches'>
			</p>
		</div>
		<div>
			<div class='cuartos'>
				<input type="button" value="Tarifas" id="tarifas">
				<label for="cuartos">Cuartos</label>
				<input type="text" name='cuartos' placeholder='Cuartos' class='small-text' id="cuartos" value=1>
			</div>
			<div class='personas'>
				<label for="adultos">Adultos</label>
				<label for="niños">Niños</label>
				<label for=""> Habitacion</label>
				<span>hab.1</span>
					<select name="adultos1" class="adultos" id="adultos1">
						@for($i = 1; $i <= 5; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<select name="niños1" class="niños" id="niños1"  tada-habitacion=1>
						@for($i = 0; $i <= 3; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<!-- <select name="" id="" clas="long-text">
						<option value="1">Sencilla</option>
						<option value="2">Doble</option>
						<option value="3">Triple</option>
						<option value="4">Cuadruple</option>
						<option value="5">Quintuple</option>
					</select> -->
					<!-- <label for="" id="tipoHabitacion1"> Sencilla</label> -->
			</div>
			<section class="edades">
				<strong></strong>
			</section>
		</div>
		<div class="cargos">
			<section>
				<label for="cargo">Cargo</label>
					<input type="text" name="cargo", id="cargo" class="small-text" placeholder="Cargo">
			</section>
			<section class="conceptoCargo">
				<label for="concepto">Concepto de Cargo</label>
					<input type="text" name="concepto", id="concepto" class="extra-long-text" placeholder="Concepto de Cargo">
					<label for="comisionable">Comisionable</label>
						<input type="checkbox" name="comisionable" id="comisionable" >
			</section>
		</div>
		<div class="formaPago">
			<input type="hidden" name="formasPago" id="formaPagoOculta" value=1>
			<section class="totalCliente">
				<label for="totalCliente">Total Cliente</label>
					<input type="text" name="totalCliente" id="totalCliente" placeholder=$0.00>
				<input type="button" value="Agregar FP" id="FP">
			</section>
			<section class="formas">
				<div class="formapago1">
					<label for="formaPago">Forma de Pago 1</label>
						<select name="formaPago" id="formaPago">
							<option value="">-- Elija una Opcion --</option>
							<option value="1">Depósito en Efectivo 12%</option>
							<option value="2">Depósito a tarjeta 15%</option>
							<option value="3">Efectivo 15%</option>
							<option value="4">Efectivo 16%</option>
							<option value="5">Otra Forma de pago, comisión abierta</option>
							<option value="6">Otra Forma de pago TC, comisión abierta</option>
							<option value="7">No comisionable 0%</option>
							<option value="8">Tarjeta de Crédito 10%</option>
							<option value="9">Transferencia o depósito con cheque 15%</option>
						</select>
				</div>
			</section>
			<section class="totalSolatino">
				<label for="comision">Comisión:</label>
					<input type="text" name="comisionFinal" id="comisionFinal" placeholder="Comisión">
				<label for="totalSolationo">Total Solatino:</label>
					<input type="text" name="totalSolationo" id="totalSolationo" placeholder="Total Solationo">
			</section>
		</div>
		<div class="datosAgencia">
			<section>
				<label for="">Fecha Limite de Pago (Pública)</label>
					<input type="date" name="fecha_Limite_Pago_Publica" required>
				<label for="hora">Hora</label>
					<select name="hora_publica" id="hora">
						@for($i = 1; $i <= 12; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<span for="">:</span>
					<select name="minuto_publica" id="minuto">
						@for($i = 0; $i < 60; $i++)
							@if($i<10)
								<option value="{{$i}}">0{{$i}}</option>
							@else
								<option value="{{$i}}">{{$i}}</option>
							@endif	
						@endfor
					</select>
					<select name="meridiano_publica" id="">
						<option value="am">am</option>
						<option value="pm">pm</option>
					</select>
				<label for="">Fecha Limite de Pago (Interna)</label>
					<input type="date" name="fecha_Limite_Pago_Interna"required>
				<label for="hora_interna">Hora</label>
					<select name="hora_interna" id="hora">
						@for($i = 1; $i <= 12; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<span for="">:</span>
					<select name="minuto_interna" id="minuto">
						@for($i = 0; $i < 60; $i++)
							@if($i<10)
								<option value="{{$i}}">0{{$i}}</option>
							@else
								<option value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
					</select>
					<select name="meridiano_interna" id="">
						<option value="am">am</option>
						<option value="pm">pm</option>
					</select>
			</section>	
			<section>
				<div class="agencia">
					<label for="agencias">Agencia:</label>
					<input type="hidden" name="id_agencias" id="agenciasOculto">
						<input type="text" name="agencias" id="agencias" class="long-text" placeholder="Agencia" list="listAgencias" required>
						<datalist id="listAgencias"></datalist>
					<input type="button" value="Agregar Agencia" class="btn-sm" id="agregarAgencia">
				</div>	
				<div class="agente">
					<label for="solicitada">Solicitada Por:</label>
						<select name="id_solicitada" id="solicitada">
							<option value="">-- Elija una opcioón --</option>
						</select>
					<input type="button" value="Agregar Agente" class="btn-sm" id="agregarAgente">
				</div>
			</section>
			<section class="datos_hotel">
				<label for="clave">Clave Hotel:</label>
					<input type="text" name="clave" id="clave" class="long-text" placeholder="Clave del Hotel" required>
				<label for="oberservaciones">Oberservaciones</label>
					<textarea name="oberservaciones" id="oberservaciones" cols="70" rows="5"></textarea>
			</section>
			<section>
				<input type="submit" value="Guardar y Enviar" class="enviar">
				<input type="button" value="Guardar" class="enviar">
		</div>
	 {{ Form::close() }}
	 
@stop