@extends ('layout')
@section('templates')
	<script type="text/template" id='hotelesTemplate'>
		<option value="<%=id_hotel%>"><%= nombre %></option>
	</script>
	<script type="text/template" id='personasTemplate'>
		<span>hab.1</span>
		<select name="adultos" id="adultos">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
		</select>
		<select name="niños" id="niños">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
		</select>
	</script>
	<script id="edadesTemplate">
		<select name="edades" id="edades">
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
@stop