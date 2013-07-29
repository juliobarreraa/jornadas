<?php
interface iJornadas {
	/**
	 * Añade a la colección de jornadas
	 * @param Jornada $jornada
	 */
	function add(Jornada $jornada);

	/**
	 * Elimina el elemento de la jornada con identificador $jornada_id
	 * @param  int    $jornada
	 * @return boolean true Si se elimino con éxito, false si no existe u ócurrio un error.
	 */
	function remove($jornada_id);

	/**
	 * Devuelve el listado de jornadas
	 * @return array
	 */
	function getJornadas();
}
?>