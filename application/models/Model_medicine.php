<?php

class Model_medicine extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getMedicineData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM medicine WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM medicine ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDosesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM doses WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM doses ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInstructionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM instruction WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM instruction ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDaysData($id = null)
	{
		if($id) {
			$sql = "SELECT DISTINCT(day) FROM diseasemedicine WHERE day = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT DISTINCT(day) FROM diseasemedicine ORDER BY day DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAmountData($id = null)
	{
		if($id) {
			$sql = "SELECT DISTINCT(amount) FROM diseasemedicine WHERE amount = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT DISTINCT(amount) FROM diseasemedicine ORDER BY amount DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getMedicineResultArray($id)
	{

			$sql = "SELECT * FROM medicine WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('medicine', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('medicine', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('medicine', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('medicine');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveMedicine()
	{
		$sql = "SELECT * FROM medicine WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getMedicineForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM medicine WHERE name LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM medicine ORDER BY id";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}

	public function getDosesForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT * FROM doses WHERE doses LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM doses ORDER BY name ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}

	public function getInstructionForSearch($search='')
	{
		if($search)
		{
			$sql = "SELECT * FROM instruction WHERE instruction LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT * FROM instruction ORDER BY instruction ASC";
			 $query = $this->db->query($sql);
			 return $query->result_array();
		}
	}


	public function getDayForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT DISTINCT(day) FROM diseasemedicine WHERE day LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT DISTINCT(day) FROM diseasemedicine ORDER BY day ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}

	public function getAmountForSearch($search='')
	{
		if($search)
		{
	 		$sql = "SELECT DISTINCT(amount) FROM diseasemedicine WHERE amount LIKE '$search%'";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else
		{
			 $sql = "SELECT DISTINCT(amount) FROM diseasemedicine ORDER BY amount ASC";
			 $query = $this->db->query($sql);
 			 return $query->result_array();
		}
	}


	public function getMedicineNameSearch($name)
	{
		if($name)
		{
	 		$sql = "SELECT DISTINCT(name) FROM medicine WHERE name = ?";
			$query = $this->db->query($sql, array($name));
			return $query->num_rows();
		}
	}



}
