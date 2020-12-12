<?php

class Model_examination extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getExaminationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM examination WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM examination ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getExaminationDataForTable()
	{
		
		$sql = "SELECT * FROM examination WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getExaminationResultArray($id)
	{

			$sql = "SELECT * FROM examination WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('examination', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('examination', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('examination', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('examination');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveExamination()
	{
		$sql = "SELECT * FROM examination WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getExaminationForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM examination WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM examination ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}


	public function getExminationNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM examination WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}
}
