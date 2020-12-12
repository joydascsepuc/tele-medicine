<?php

class Model_patient extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getPatientData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM patient WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}


			$sql = "SELECT * FROM patient  ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('patient', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create2($data = array())
	{
		if($data) {
			$create = $this->db->insert('patient', $data);
			$id = $this->db->insert_id();
			return ($create == true) ? $id : 0;
		}
	}



	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('patient', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('patient');
			return ($delete == true) ? true : false;
		}
	}


	public function getPatientDetails($userID)
	{
		$sql = "SELECT * FROM patient WHERE userID = ?";
		$query = $this->db->query($sql, array($userID));
		return $query->row_array();
	}



	public function getPatientFullDetails($userID)
	{
		$sql = "SELECT users.id AS id, users.name AS name, users.phone as phone, patient.patientID AS patientID, patient.navyID AS navyID, patient.pcategory AS pcategory, patient.prank AS prank, patient.prelation as prelation, patient.age AS age,patient.gender AS gender, patient.image AS image FROM users JOIN patient ON users.id = patient.userID WHERE users.id = ?";
		$query = $this->db->query($sql, array($userID));
		return $query->row_array();
	}



	public function getPrescriptionByAppointment($appointID)
	{
		$sql = "SELECT * FROM prescriptions WHERE appointmentID =?";
		$query = $this->db->query($sql, array($appointID));
		return $query->row_array();
	}

	
	

	

	public function countTotalPatient()
		{
			$sql = "SELECT * FROM patient";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}

		public function getPateintIDForSearch1($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE patientID=?";
				$query = $this->db->query($sql, array($search));
				return $query->row_array();
			}
		}

		public function getPateintIDForSearch($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE patientID LIKE '$search%'";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		}

		public function getPateintNameForSearch($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE name LIKE '$search%'";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		}

		public function getNavyIDForSearch($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE navyID LIKE '$search%'";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		}

		public function getContactForSearch($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE contact LIKE '$search%'";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		}

		public function getPateintForSearch($search='')
		{
			if($search)
			{
		 		$sql = "SELECT * FROM  patient WHERE patientID LIKE '$search%' OR navyID LIKE '$search%' OR name LIKE '$search%'";
				$query = $this->db->query($sql);
				return $query->result_array();
			}
		}


		public function countVisit($department)
		{
			$currentDateTime = strtotime(date('Y-m-d'));
			$sql = "SELECT * FROM patientserial WHERE departmentID=? AND datetime between ? AND ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($department, $currentDateTime, $currentDateTime+86399));
			return $query->num_rows();
		}


		public function placeserial($docID, $deptID)
		{
			$id = $this->session->userdata('id');
			$regNoId= $this->countVisit($deptID);
		
			if ($regNoId == 0)
	            {
	                $regno = '0001';
	            }
	            else
	            {
	                if ($regNoId >= 1 && $regNoId < 9)
	                {
	                    $temp =$regNoId + 1;
	                    $regno = '000'.(string)$temp;
	                }
	                else if ($regNoId >= 9 && $regNoId < 99)
	                {
	                    $temp = $regNoId + 1;
	                    $regno ='00'.(string)$temp;
	                }
					else if ($regNoId >= 99 && $regNoId < 999)
	                {
	                    $temp = $regNoId + 1;
	                    $regno = '0'.(string)$temp;
	                }
	                else
	                {
	                    $regno = (string)($regNoId+1);
	                }
	            }
			$bill_no = $regno;

			$data = array(
				'pateintID' => $id,
				'serialcode' => $bill_no,
				'departmentID' => $deptID,
				'datetime' => strtotime(date('Y-m-d h:i:s a')),
				'complaintText' => $this->input->post('complaint'),
				'doctorID' => $docID,
			);

			$create = $this->db->insert('patientserial', $data);
			$visitiglist= $this->db->insert_id();
			return ($create == true) ? $bill_no : false;
		}






	public function getAppontmentDataByPatient($patID = null)
	{
		if($patID) {
			$sql = "SELECT * FROM patientserial WHERE pateintID = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($patID));
			return $query->result_array();
		}
			
	}



		public function getCategoryData($id = null)
		{
			if($id) {
				$sql = "SELECT * FROM patienttype WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM patienttype ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getCategoryResultArray($id)
		{

				$sql = "SELECT * FROM patienttype WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->result_array();

		}

		public function createCategory($data = array())
		{
			if($data) {
				$create = $this->db->insert('patienttype', $data);
				return ($create == true) ? true : false;
			}
		}

		public function updateCategory($id = null, $data = array())
		{
			if($id && $data) {
				$this->db->where('id', $id);
				$update = $this->db->update('patienttype', $data);
				return ($update == true) ? true : false;
			}
		}

		public function removeCategory($id = null)
		{
			if($id) {
				$this->db->where('id', $id);
				$delete = $this->db->delete('patienttype');
				return ($delete == true) ? true : false;
			}
		}

		public function getActiveCategory()
		{
			$sql = "SELECT * FROM patienttype WHERE active = ?";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}


		







		public function getRankData($id = null)
		{
			if($id) {
				$sql = "SELECT * FROM patientrank WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM patientrank ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getRankResultArray($id)
		{

				$sql = "SELECT * FROM patientrank WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->result_array();

		}

		public function createRank($data = array())
		{
			if($data) {
				$create = $this->db->insert('patientrank', $data);
				return ($create == true) ? true : false;
			}
		}

		public function updateRank($id = null, $data = array())
		{
			if($id && $data) {
				$this->db->where('id', $id);
				$update = $this->db->update('patientrank', $data);
				return ($update == true) ? true : false;
			}
		}

		public function removeRank($id = null)
		{
			if($id) {
				$this->db->where('id', $id);
				$delete = $this->db->delete('patientrank');
				return ($delete == true) ? true : false;
			}
		}

		public function getActiveRank()
		{
			$sql = "SELECT * FROM patientrank WHERE active = ?";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}














		public function getRelationshipData($id = null)
		{
			if($id) {
				$sql = "SELECT * FROM patientrelation WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM patientrelation ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getRelationshipResultArray($id)
		{

				$sql = "SELECT * FROM patientrelation WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->result_array();

		}

		public function createRelationship($data = array())
		{
			if($data) {
				$create = $this->db->insert('patientrelation', $data);
				return ($create == true) ? true : false;
			}
		}

		public function updateRelationship($id = null, $data = array())
		{
			if($id && $data) {
				$this->db->where('id', $id);
				$update = $this->db->update('patientrelation', $data);
				return ($update == true) ? true : false;
			}
		}

		public function removeRelationship($id = null)
		{
			if($id) {
				$this->db->where('id', $id);
				$delete = $this->db->delete('patientrelation');
				return ($delete == true) ? true : false;
			}
		}

		public function getActiveRelationship()
		{
			$sql = "SELECT * FROM patientrelation WHERE active = ?";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}


}
