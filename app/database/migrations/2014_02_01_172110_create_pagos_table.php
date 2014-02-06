<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("pagos",function($table){

			$table->bigincrements("id_pago");
			$table->bigInteger("id_reservacion");
			$table->bigInteger("id_tipo");
			$table->date("fecha");
			$table->integer("cuenta_bancaria");
			$table->integer("id_forma_pago");
			$table->string("no_targeta");
			$table->string("fecha_vencimiento_t",4);
			$table->string("codigo_seguiridad_t",4);
			$table->string("folio_fecha");
			$table->double("monto");
			$table->double("comision");
			$table->double("total_solatino");


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