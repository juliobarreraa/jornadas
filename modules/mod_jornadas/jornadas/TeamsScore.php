<?php
require_once dirname(__FILE__).'/iTeamsScore.php';

class TeamsScore implements iTeamsScore {
	/**
	 * Equipo
	 * @var Teams
	 */
	protected $fteam;
	/**
	 * Equipo
	 * @var Teams
	 */
	protected $steam;
	/**
	 * Score del resultado del juego
	 * @var integer
	 */
	protected $fscore;
	/**
	 * Score del resultado del juego
	 * @var integer
	 */
	protected $sscore;

	/**
	 * Añade equipo
	 * @param string $team
	 * @param integer $score
	 */
	function __construct(array $teams, $scores) {
		list($this->fteam, $this->steam) = $teams;
		list($this->fscore, $this->sscore) = $scores;
	}

	/**
	 * Devuelve información sobre el equipo
	 * @return TeamsScore
	 */
	function getFteam() {
		return $this->fteam;
	}

	/**
	 * Devuelve información sobre el segundo equipo
	 * @return TeamsScore
	 */
	function getSteam() {
		return $this->steam;
	}

	/**
	 * Devuelve primer score
	 * @return integer
	 */
	function getFscore() {
		return $this->fscore;
	}

	/**
	 * Devuelve segundo score
	 * @return integer
	 */
	function getSscore() {
		return $this->sscore;
	}
}
?>