<?php 
class Agencia extends Eloquent{
	protected $table = "agencias";

	public function getSaludo(){
		return "hola";
	}
}
?>