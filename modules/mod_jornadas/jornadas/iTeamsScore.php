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
	function get();
}
?>