<?php
interface iJornadasDB {
	/**
	 * Devuelve listado de equipos
	 * @param int $team_id Si se pasa este parámetro se devuelve el equipo
	 * @return Teams
	 */
	function getJornadaTeams($jornada_id = null);

	/**
	 * Devuelve listado de Jornadas
	 * @param  int $jornada_id si se pasa devuelve la joranda con identificador $jornada_id
	 * @return Jornada
	 */
	function getJornadas($jornada_id = null);

	/**
	 * Devuelve listado de equipos
	 * @param int $team_id Si se pasa este parámetro se devuelve el equipo
	 * @return
	 */
	function getTeams($team_id = null);
}
?>