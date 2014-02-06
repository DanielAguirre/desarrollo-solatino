<?php

use Illuminate\Database\Migrations\Migration;

class CreateReservacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservaciones',function($table){
			$table->bigincrements("id_reservacion");			
			$table->integer("id_destino");
			$table->string("destino");
			$table->integer("id_hotel");
			$table->string("hotel");
			$table->integer("id_plan");
			$table->string("plan");
			$table->integer("id_bloqueo");
			$table->string("nombre",100);
			$table->date("fecha_ingreso",12);
			$table->date("fecha_salida",12);
			$table->integer("noches");
			$table->integer("cuartos");
			$table->double("cargo");
			$table->string("concepto");
			$table->boolean("comisionable");
			$table->double("totalCliente");
			$table->double("comision");
			$table->double("totalSolatino");
			$table->date("fecha_Limite_Pago_Publica",12);
			$table->string("hora_Limite_Pago_Publica",12);
			$table->date("fecha_Limite_Pago_Interna",12);
			$table->string("hora_Limite_Pago_Interna",12);
			$table->integer("id_agencia");
			$table->integer("id_solicitada");
			$table->string("clave", 100);
			$table->text("observaciones");
			$table->integer("estatus");
			$table->integer("id_tipo");
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}