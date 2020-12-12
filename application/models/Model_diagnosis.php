<?php

class Model_diagnosis extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getDiagnosisData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM diagnosis WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM diagnosis ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDiagnosisDataForTable($id = null)
	{
		
		$sql = "SELECT * FROM diagnosis  WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getDiagnosisResultArray($id)
	{

			$sql = "SELECT * FROM diagnosis WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('diagnosis', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('diagnosis', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('diagnosis', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('diagnosis');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveDiagnosis()
	{
		$sql = "SELECT * FROM diagnosis WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getDiagnosisForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM diagnosis WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM diagnosis ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}


	public function getDiagnosisNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM diagnosis WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}
}
