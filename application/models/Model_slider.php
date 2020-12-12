<?php

class Model_slider extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getSliderData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM slider WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM slider ORDER BY id ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('slider', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('slider', $data);
			return ($update == true) ? true : false;
		}
	}


	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('slider');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveSlider()
	{
		$sql = "SELECT * FROM slider WHERE active = ? ORDER BY id ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}



}
