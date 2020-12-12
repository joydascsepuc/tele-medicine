<?php

class Model_advice extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAdviceData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM advice WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM advice ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAdviceDataForTable()
	{
		
		$sql = "SELECT * FROM advice WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getAdviceResultArray($id)
	{
			$sql = "SELECT * FROM advice WHERE id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('advice', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('advice', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('advice', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('advice');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveAdvice()
	{
		$sql = "SELECT * FROM advice WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getAdviceForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM advice WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM advice ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}


	public function getAdviceNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM advice WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}
}
