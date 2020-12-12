<?php

class Model_notices extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getNoticeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM notices WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM notices ORDER BY id ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('notices', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('notices', $data);
			return ($update == true) ? true : false;
		}
	}


	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('notices');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveNotice()
	{
		$sql = "SELECT * FROM notices WHERE active = ? ORDER BY id ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}



}
