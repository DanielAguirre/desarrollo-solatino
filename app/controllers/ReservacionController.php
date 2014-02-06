<?php

class ReservacionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return "index";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$reservacion = new Reservacion;		
		$data = Input::all();
		$pago 				  = new Pago;
		$reservacion->id_destino                = $data["id_destino"];
		$reservacion->destino 					= $data["destino"];
		$reservacion->id_hotel                  = $data["id_hotel"];
		$reservacion->hotel 					= $data["hotel"];
		$reservacion->id_plan                   = $data["id_plan"];
		$reservacion->plan 						= $data["plan"];
		$reservacion->id_bloqueo                = $data["id_bloqueo"];
		$reservacion->nombre                    = $data["nombre"];
		$reservacion->fecha_ingreso             = $data["fecha_Ingreso"];
		$reservacion->fecha_salida              = $data["fecha_Salida"];
		$reservacion->noches                    = $data["noches"];
		$reservacion->cuartos                   = $data["cuartos"];
		$reservacion->cargo                     = $data["cargo"];
		$reservacion->concepto                  = $data["concepto"];
		$reservacion->totalCliente              = $data["totalCliente"];
		$reservacion->fecha_Limite_Pago_Publica = $data["fecha_Limite_Pago_Publica"];
		$reservacion->hora_Limite_Pago_Publica  = $data["hora_publica"].":".$data["minuto_publica"]." ".$data["meridiano_publica"];
		$reservacion->fecha_Limite_Pago_Interna = $data["fecha_Limite_Pago_Interna"];
		$reservacion->hora_Limite_Pago_Interna  = $data["hora_interna"].":".$data["minuto_interna"]." ".$data["meridiano_interna"];
		$reservacion->id_agencia                = $data["id_agencias"];
		$reservacion->id_solicitada             = $data["id_solicitada"];
		$reservacion->clave                     = $data["clave"];
		$reservacion->observaciones             = $data["oberservaciones"];
		$reservacion->estatus                   = 1;
		$reservacion->id_tipo					= 1;

		if(isset($data["comisionable"]))
		 	$reservacion->comisionable = 1;
		 else 
		 	$reservacion->comisionable = 0;

		$reservacion->save();

		$ultimoElemento = DB::select("SELECT MAX(id_reservacion) AS id FROM reservaciones");

		foreach ($ultimoElemento as $ultimoElemento)
			$id = $ultimoElemento->id;

		$pago->id_reservacion = $id;
		$pago->fecha		  = date("Y-m-d");
		$pago->id_forma_pago 	 = $data["formaPago"];
		$pago->monto 		 	 = $data["monto"];
		$pago->comision 	 	 = $data["comision"];
		$pago->total_solatino 	 = $data["toalSolatinoPago"];
		
		if($data["formaPago"]==6 || $data["formaPago"]==8 ){
				$pago->no_targeta			= $data["numeroTrajeta"];
				$pago->fecha_vencimiento_t  = $data["fechaVencimiento"];
				$pago->codigo_seguridad_t	= $data["codigoSeguridad"];
			}

		$pago->save();
			
		for ($i=0; $i < $data["formasPago"] && $data["formasPago"]>1; $i++) {		
			$pago 				  	 = new Pago;
			$pago->id_reservacion 	 = $id;
			$pago->fecha		  	 = date("Y-m-d");
			$pago->id_tipo			 = 1;
			$pago->id_forma_pago 	 = $data["formaPago".$i];
			$pago->monto 		 	 = $data["monto".$i];
			$pago->comision 	 	 = $data["comision".$i];
			$pago->total_solatino 	 = $data["toalSolatinoPago".$i];
			
			if($data["formaPago".$i]==6 || $data["formaPago".$i]==8 ){
				$pago->no_targeta			= $data["numeroTrajeta".$i];
				$pago->fecha_vencimiento_t  = $data["fechaVencimiento".$i];
				$pago->codigo_seguridad_t	= $data["codigoSeguridad".$i];				
			}
			
			$pago->save();
			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}