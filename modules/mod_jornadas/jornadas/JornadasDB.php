<?php
require_once dirname(__FILE__).'/iJornadasDB.php';

class JornadasDB implements iJornadasDB {
	/**
	 * Base de datos conexión
	 * @var
	 */
	protected $db;

	public function __construct() {
		$this->db = JFactory::getDbo();
	}

	/**
	 * Devuelve listado de equipos
	 * @param int $team_id Si se pasa este parámetro se devuelve el equipo
	 * @return Teams
	 */
	function getJornadaTeams($jornada_id = null) {
		$where = null;

		if($jornada_id)
			//Si se filtra por jornada
			$where = ' jornada_id = ' . (int)$jornada_id;

		//Get query
		$query = $this->db->getQuery(true);
		$query->select('jt.team_first_id, jt.team_second_id, jt.team_first_score, jt.team_second_score')
			  ->from('#__jornada_teams jt');

		if($where)
			  $query->where($where);

		$this->db->setQuery((string)$query);

		return $this->db->loadObjectList();
	}

	/**
	 * Devuelve listado de equipos
	 * @param int $team_id Si se pasa este parámetro se devuelve el equipo
	 * @return
	 */
	function getTeams($team_id = null) {
		$where = null;

		if($team_id)
			//Si se filtra por equipo
			$where = ' id = ' . (int)$team_id;

		//Get query
		$query = $this->db->getQuery(true);
		$query->select('t.id, t.name, t.image')
			  ->from('#__teams t')
			  ->where($where);

		$this->db->setQuery((string)$query);

		return $this->db->loadObjectList();
	}

	/**
	 * Devuelve listado de Jornadas
	 * @param  int $jornada_id si se pasa devuelve la joranda con identificador $jornada_id
	 * @return Jornada
	 */
	function getJornadas($jornada_id = null) {
		$where = null;

		if($jornada_id)
			//Si la jornada se filtra
			$where = 'id = ' . (int)$jornada_id;

		//Get query
		$query = $this->db->getQuery(true);
		$query->select('j.id, j.name')
			  ->from('#__jornadas j')
			  ->where($where);

		$this->db->setQuery((string)$query);

		return $this->db->loadObjectList();
	}
}