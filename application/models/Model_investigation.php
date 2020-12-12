<?php

class Model_investigation extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getInvestigationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM investigation WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM investigation ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInvestigationDataForTable($id = null)
	{
		
		$sql = "SELECT * FROM investigation WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getInvestigationResultArray($id)
	{

			$sql = "SELECT * FROM investigation WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('investigation', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('investigation', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('investigation', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('investigation');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveInvestigation()
	{
		$sql = "SELECT * FROM investigation WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getInvestigationForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM investigation WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM investigation ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}



	public function getInvestigationNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM investigation WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}
}
