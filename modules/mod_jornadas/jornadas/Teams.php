<?php
require_once dirname(__FILE__).'/iTeams.php';
require_once dirname(__FILE__).'/JornadasDB.php';

class Teams implements iTeams {
	/**
	 * Acceso DB tablas jornada
	 * @var JornadasDB
	 */
	private $jornadasDB;

	/**
	 * Identificador
	 * @var integer
	 */
	private $id;
	/**
	 * Nombre del equipo
	 * @var string
	 */
	private $name;

	/**
	 * Inicializa el equipo
	 * @param int $id
	 */
	function __construct($id) {
		$this->jornadasDB = new JornadasDB;
		$this->setTeam($id);
	}

	/**
	 * Devuelve el identificador del equipo
	 * @return [type]
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Devuelve el nombre del equipo
	 * @return [type]
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Devuelve la imagen asignada a un equipo
	 * @return string
	 */
	function getImage() {
		return $this->image;
	}

	/**
	 * Configura el equipo
	 * @param int $id
	 */
	function setTeam($id) {
		$team = $this->jornadasDB->getTeams($id);

		$this->id = $team[0]->id;
		$this->name = $team[0]->name;
		$this->image = $team[0]->image;
	}
}
?>