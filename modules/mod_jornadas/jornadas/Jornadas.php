<?php
require_once dirname(__FILE__).'/iJornadas.php';

class Jornadas implements iJornadas {
	/**
	 * Arreglo de Jornadas
	 * @var Jornadas
	 */
	private $jornadas = array();

	/**
	 * Añade a la colección de jornadas
	 * @param Jornada $jornada
	 */
	function add(Jornada $jornada) {
		//Se agrega el nuevo elemento
		array_push($this->jornadas, $jornada);

		return $this;
	}

	/**
	 * Elimina el elemento de la jornada con identificador $jornada_id
	 * @param  int    $jornada
	 * @return boolean true Si se elimino con éxito, false si no existe u ócurrio un error.
	 */
	function remove($jornada_id) {
		//Recorremos las jornadas
		foreach($this->jornadas as $key => $value) {
			if($value->id == $jornada_id) {
				//Eliminamos la jornada
				array_slice($this->jornadas, $key);
				break;
			}
		}
	}

	/**
	 * Devuelve el listado de jornadas
	 * @return array
	 */
	function getJornadas() {
		return $this->jornadas;
	}
}
?>