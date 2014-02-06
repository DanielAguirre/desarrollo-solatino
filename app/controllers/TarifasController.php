<?php

class TarifasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tarifa     = new Tarifa;
		$id_hotel   = Input::get("id_hotel");
		$id_destino = Input::get("id_destino");
		$id_plan 	= Input::get("id_plan");
		$id_plam    = 0;
		$tarifas    = DB::select("SELECT * , DATE_FORMAT(vigencia_inicio, '%y-%m-%d')AS vigencia_inicio, DATE_FORMAT(vigencia_fin, '%y-%m-%d')AS vigencia_fin
								  FROM tarifas
								  WHERE id_plan = 0
								  ORDER BY vigencia_inicio ASC, promocion1 DESC, promocion2 DESC, tdoble ASC ");

		return Response::json($tarifas);
		// return $id_hotel;

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
		//
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