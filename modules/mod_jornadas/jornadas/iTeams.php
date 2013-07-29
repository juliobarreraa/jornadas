<?php
interface iTeams {
	/**
	 * Inicializa el equipo
	 * @param int $id
	 */
	function __construct($id);

	/**
	 * Devuelve el identificador del equipo
	 * @return [type]
	 */
	function getId();

	/**
	 * Devuelve el nombre del equipo
	 * @return [type]
	 */
	function getName();

	/**
	 * Configura el equipo
	 * @param int $id
	 */
	function setTeam($id);
}
?>