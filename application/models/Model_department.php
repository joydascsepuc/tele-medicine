<?php

class Model_department extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getDepartmentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM department WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM department ORDER BY priority ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDepartmentResultArray($id)
	{

			$sql = "SELECT * FROM department WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('department', $data);
			return ($create == true) ? true : false;
		}
	}

	// public function update($id = null, $data = array())
	// {
	// 	if($id && $data) {
	// 		$this->db->where('id', $id);
	// 		$update = $this->db->update('department', $data);
	// 		return ($update == true) ? true : false;
	// 	}
	// }


	public function update($id = null, $data = array())
	{

		$priority=$this->input->post('edit_priority');
		// $depID=$this->input->post('edit_department');
		$existPriority =  $this->getDepartmentData($id);
		$lastPriority = $this->getLastPriority();
		// if ($existPriority['departmentID']==$depID) {

			if ($priority != $existPriority['priority']) {
				if($priority<$existPriority['priority']){
					for ($i=$existPriority['priority']-1; $i >=$priority; $i--) {
						$this->db->where('priority', $i);
						// $this->db->where('departmentID', $depID);
						$update1 = $this->db->update('department', array('priority' => $i+1));
					}
				}
					elseif ($priority>$existPriority['priority']) {
						for ($i=$existPriority['priority']+1; $i <=$priority ; $i++) {
							$this->db->where('priority', $i);
							// $this->db->where('departmentID', $depID);
							$update1 = $this->db->update('department', array('priority' => $i-1));
						}
					}
				}
		
		$this->db->where('id', $id);
		$update = $this->db->update('department', $data);
		return ($update == true) ? true : false;
	}


	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('department');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveDepartment()
	{
		$sql = "SELECT * FROM department WHERE active = ? ORDER BY priority ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getLastPriority()
	{
		$sql = "SELECT * FROM department ORDER BY priority DESC";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getDepartmentPriority()
	{
		
			$sql = "SELECT * FROM department ORDER BY priority ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	}



	public function doctorOnline($deptID)
	{	
		$toDate = strtotime(date('Y-m-d'));

		$sql = "SELECT DISTINCT(logindetails.userid) AS id FROM logindetails LEFT JOIN doctors ON logindetails.userid=doctors.userID WHERE logindetails.department=? AND logindetails.outTime = ? AND logindetails.intime BETWEEN ? AND ? AND doctors.available = ?";
		$query = $this->db->query($sql, array($deptID, '', $toDate, $toDate+86399, 1));
		return $query->result_array();
	}



}
