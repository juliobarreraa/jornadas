<?php
interface iJornada{
	/**
	 * Se inicia la instancia con una jornada precargada
	 * @param int $jornada_id
	 */
	function __construct($jornada_id = null);

	/**
	 * Devuelve el identificador de la jornada actual
	 * @return integer
	 */
	function getId();

	/**
	 * Configura una nueva jornada
	 * @param int $jornada_id
	 */
	function setJornada($jornada_id);

	/**
	 * Añade un par equipos
	 * @param TeamsScore $fteam Primer equipo
	 * @param TeamsScore $steam Equipo rival
	 */
	function addTeamsScore(TeamsScore $teamscore);

	/**
	 * Devuelve colección par equipos/score
	 * @return TeamsScore[]
	 */
	function getTeamsScore();

	/**
	 * Devuelve el nombre de la jornada actual
	 * @return string
	 */
	function getName();
}
?>