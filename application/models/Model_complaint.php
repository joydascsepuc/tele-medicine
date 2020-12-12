<?php

class Model_complaint extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getComplaintData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM complaint WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM complaint ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getComplaintDataForTable()
	{

		$sql = "SELECT * FROM complaint WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getComplaintResultArray($id)
	{

			$sql = "SELECT * FROM complaint WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('complaint', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('complaint', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('complaint', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('complaint');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveComplaint()
	{
		$sql = "SELECT * FROM complaint WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getComplaintForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM complaint WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM complaint ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}

	public function getComplaintNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM complaint WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}


}
