<?php
require_once dirname(__FILE__).'/iJornada.php';
require_once dirname(__FILE__).'/JornadasDB.php';

class Jornada implements iJornada {
	/**
	 * Acceso DB tablas jornada
	 * @var JornadasDB
	 */
	private $jornadasDB;

	/**
	 * Identificador de la jornada
	 * @var integer
	 */
	private $id;
	/**
	 * Nombre de la jornada
	 * @var string
	 */
	private $name;

	/**
	 * Colección de equipo score
	 * @var TeamsScore
	 */
	private $teamsScore = array();

	/**
	 * Se inicia la instancia con una jornada precargada
	 * @param int $jornada_id
	 */
	function __construct($jornada_id = null) {
		$this->jornadasDB = new JornadasDB;
		if($jornada_id) {
			$this->setJornada($jornada_id);
		}

		return $this;
	}

	/**
	 * Devuelve el identificador de la jornada actual
	 * @return integer
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Devuelve el nombre de la jornada actual
	 * @return string
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Configura una nueva jornada
	 * @param int $jornada_id
	 */
	function setJornada($jornada_id) {
		require_once dirname(__FILE__).'/TeamsScore.php';
		require_once dirname(__FILE__).'/Teams.php';

		//Obtenemos la jornada_id
		$jornada = $this->jornadasDB->getJornadas($jornada_id);

		$this->id = $jornada[0]->id;
		$this->name = $jornada[0]->name;

		//Colección de equipos
		$teams = $this->jornadasDB->getJornadaTeams(null, $this->id);
		//Resultados?
		if($teams && count($teams)) {
			/** array $teams as integer $key => string $value */
			foreach($teams as $key => $value) {
				$fteam = new Teams($value->team_first_id);
				$steam = new Teams($value->team_second_id);

				$teamscore = new TeamsScore(array($fteam, $steam), array($value->team_first_score, $value->team_second_score));

				$this->addTeamsScore($teamscore);
			}
		}
	}

	/**
	 * Añade un par equipos
	 * @param TeamsScore $fteam Primer equipo
	 * @param TeamsScore $steam Equipo rival
	 */
	function addTeamsScore(TeamsScore $teamscore) {
		array_push($this->teamsScore, $teamscore);
	}

	/**
	 * Devuelve colección par equipos/score
	 * @return TeamsScore[]
	 */
	function getTeamsScore() {
		return $this->teamsScore;
	}
}
?>