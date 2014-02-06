<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{	
	return View::make('reservaciones');
});

Route::get('agencias', function(){
	$query = Input::get('query');
	$agencias = DB::select("SELECT id_agencia, nombre
							FROM agencias
							WHERE nombre LIKE '%$query%'
							ORDER BY (nombre)
							");
	return $agencias;
});

Route::get('bloqueos',function(){
	$id=Input::get("id");
	$bloqueos = Bloqueo::where("numhabitaciones",">","0")->
						 where("id_hotel","=", $id)->
						 where("salida",">=","CURDATE()")->get();
	return Response::json($bloqueos);
});
Route::get("contactos", function(){
	$id = Input::get('id');	
	$contactos = ContactosAgencia::where("id_agencia","=", $id)->get();
	return Response::json($contactos);
});

Route::get("destinos", function(){
	$destinos = Destino::orderBy('nombre')->get();
	$destinos = DB::select("SELECT id_destino, nombre
							FROM destinos
							ORDER BY (nombre)
							");
	return Response::json($destinos);
});
Route::get("hoteles", function(){
	$id = Input::get('id');
	$hoteles = Hotel::where('id_destino','=', $id)->orderBy('nombre')->get();	
	return Response::json($hoteles);	
});

Route::get('planes',function(){
	$id = Input::get('id');
	$planes = Plan::where('id_hotel','=',$id)->orderBy('nombre')->get();
	return Response::json($planes);
});

Route::resource("reservacion","ReservacionController");
Route::resource("tarifas", "TarifasController");