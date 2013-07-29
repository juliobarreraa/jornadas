<?php
interface iTeamsScore {
	/**
	 * Añade equipo
	 * @param string $team
	 * @param integer $score
	 */
	function __construct(array $team, $score);


	/**
	 * Devuelve información sobre el equipo
	 * @return TeamsScore
	 */
	function getFteam();

	/**
	 * Devuelve información sobre el segundo equipo
	 * @return TeamsScore
	 */
	function getSteam();

	/**
	 * Devuelve primer score
	 * @return integer
	 */
	function getFscore();

	/**
	 * Devuelve segundo score
	 * @return integer
	 */
	function getSscore();
}
?>