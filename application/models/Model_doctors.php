<?php

class Model_doctors extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getDoctorData($doctorId = null)
	{
		if($doctorId) {
			$sql = "SELECT * FROM doctors WHERE id = ?";
			$query = $this->db->query($sql, array($doctorId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM doctors ORDER BY id ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDoctorbyUser($userID = null)
	{
		if($userID) {
			$sql = "SELECT * FROM doctors WHERE userID = ?";
			$query = $this->db->query($sql, array($userID));
			return $query->row_array();
		}
	}
	


	public function create($data = '')
	{

		if($data) {
			$create = $this->db->insert('doctors', $data);
			$create_id = $this->db->insert_id();
			return ($create == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('userID', $id);
			$update = $this->db->update('doctors', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('doctors');
		return ($delete == true) ? true : false;
	}



	public function toggleDoctorAvailablity($id, $avail)
	{
		if($id) {
			$this->db->where('userID', $id);
			$update = $this->db->update('doctors', array('available' => $avail ));
			return ($update == true) ? true : false;
		}
	}


	public function getDoctorFullDetails($userID)
	{
		$sql = "SELECT users.id AS id, users.name AS name, users.phone as phone, doctors.qualification AS qualification, doctors.speciality AS speciality, doctors.designation AS designation, doctors.signature_image AS signature_image FROM users JOIN doctors ON users.id = doctors.userID WHERE users.id = ?";
		$query = $this->db->query($sql, array($userID));
		return $query->row_array();
	}


	public function getAppontmentDataByDepartment($department='')
	{
		$currentDateTime = strtotime(date('Y-m-d'));
		if ($department) {
			$sql = "SELECT * FROM patientserial WHERE departmentID=? AND visited=? AND hidden=? AND datetime between ? AND ? ORDER BY id ASC";
			$query = $this->db->query($sql, array($department, 0, 0, $currentDateTime, $currentDateTime+86399));
			return $query->result_array();
		}

		$sql = "SELECT * FROM patientserial WHERE visited=? AND hidden=? AND datetime between ? AND ? ORDER BY id ASC";
			$query = $this->db->query($sql, array(0, 0, $currentDateTime, $currentDateTime+86399));
			return $query->result_array();
		
	}

	public function getAllAppontmentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM patientserial WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
			$sql = "SELECT * FROM patientserial ORDER BY id ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
	}



	public function appoinmentdetails($id)
	{
		$user_id = $this->session->userdata('id');
		$department_id = $this->session->userdata('department');
		$appointment = $this->getAllAppontmentData($id);

		$billString = 'P'.date('y').date('m').date('d');
		$this->db->select('*');
		$this->db->like('code', $billString);
		$query = $this->db->get('prescriptions');
		$regNoId= $query->num_rows();
		if ($regNoId == 0)
            {
                $regno = $billString.'0001';
            }
            else
            {
                if ($regNoId >= 1 && $regNoId < 9)
                {
                    $temp =$regNoId + 1;
                    $regno = $billString.'000'.(string)$temp;
                }
                else if ($regNoId >= 9 && $regNoId < 99)
                {
                    $temp = $regNoId + 1;
                    $regno =$billString.'00'.(string)$temp;
                }
				else if ($regNoId >= 99 && $regNoId < 999)
                {
                    $temp = $regNoId + 1;
                    $regno = $billString.'0'.(string)$temp;
                }
                else
                {
                    $regno = $billString.(string)($regNoId+1);
                }
            }
			$bill_no = $regno;
			$insert_id=$this->input->post('diseaseID');

			$data = array(
					'appointmentID' => $id,
					'code'          => $regno,
					'medicines'     => $this->input->post('medicine'),
					'complaint'     => $this->input->post('complaint'),
					'examination'   => $this->input->post('examination'),
					'investigation' => $this->input->post('investigation'),
					'diagnosis'     => $this->input->post('diagnosis'),
					'advice'        => $this->input->post('advice'),
					'dateTime'      => strtotime(date('Y-m-d h:i:s a')),
					'doctorID'      => $user_id,
	    	);

			$insert = $this->db->insert('prescriptions', $data);
			$visit_id = $this->db->insert_id();
			

		$this->db->where('id', $id);
		$this->db->update('patientserial', array('visited' => 1));
		
		return ($visit_id) ? $visit_id : false;
	}




	


}
