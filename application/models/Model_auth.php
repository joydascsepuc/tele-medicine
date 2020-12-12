<?php

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function check_user($phone)
	{
		if($phone) {
			$sql = 'SELECT * FROM users WHERE phone = ?';
			$query = $this->db->query($sql, array($phone));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}
		return false;
	}

	public function check_userMobile($name, $phone)
	{
		if($phone) {
			$sql = 'SELECT * FROM users WHERE name=? AND phone = ?';
			$query = $this->db->query($sql, array($name, $phone));
			return $query->row_array();
		}
	}

	public function getDoctorDetailsDataByMobile($phone) 
	{
		if($phone) {
			$sql = "SELECT * FROM users WHERE phone = ?";
			$query = $this->db->query($sql, array($phone));
			return $query->num_rows();
		}
	}

	public function getPatientDetailsDataByMobile($phone, $relation) 
	{
		if($phone) {
			$sql = "SELECT * FROM users JOIN patient ON users.id=patient.userID WHERE users.phone= ? AND patient.prelation=? ";
			$query = $this->db->query($sql, array($phone, $relation));
			return $query->num_rows();
		}
	}


	public function passwordReset($id)
	{
		$pass = substr(md5(uniqid(mt_rand(), true)), 0, 6);
		$hash = password_hash($pass, PASSWORD_DEFAULT);

		$this->db->where('id', $id);
		$update = $this->db->update('users', array('password' => $hash));
		return ($update == true) ? $pass : false;
	}

	/*
		This function checks if the email and password matches with the database
	*/
	public function login($phone, $password) {
		if($phone && $password) {
			$sql = "SELECT users.id AS id,  users.password AS password, users.name as name, users.phone AS phone, user_group.group_id AS groupID
			FROM users JOIN user_group ON users.id=user_group.user_id WHERE users.phone = ?";
			$query = $this->db->query($sql, array($phone));

			if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}
	}

	public function currentPassCheck($pass)
	{
		$user_id = $this->session->userdata('id');
		$sql = "SELECT * FROM users WHERE id = ?";
		$query = $this->db->query($sql, array($user_id));
		if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($pass, $result['password']);
				if($hash_password === true) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}

	}

	public function logindetails($data = array())
	{
		if($data) {
			$create = $this->db->insert('logindetails', $data);
			return ($create == true) ? true : false;
		}
	}

	public function logindetailsupdate($id, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('logindetails', $data);
			return ($update == true) ? true : false;
		}
	}

	public function doctorAvailableOn($id)
	{
		if($id) {
			$this->db->where('userID', $id);
			$update = $this->db->update('doctors', array('available' => 1 ));
			return ($update == true) ? true : false;
		}
	}

	public function doctorAvailableOff($id)
	{
		if($id) {
			$this->db->where('userID', $id);
			$update = $this->db->update('doctors', array('available' => 0 ));
			return ($update == true) ? true : false;
		}
	}

	public function registrationPatient($password)
	{
		$users = array(
			'password' => $password,
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('mobile'),		
		);
		$create = $this->db->insert('users', $users);
		$user_id = $this->db->insert_id();

		$group_data = array(
			'user_id' => $user_id,
			'group_id' => 4
		);
		$group_data = $this->db->insert('user_group', $group_data);

		$words = explode(" ", $this->input->post('name'));
		$acronym = "";
		foreach ($words as $w) {
			$acronym .= $w[0];
		}
		$patientID = strtoupper($acronym).strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 3));

		$details = array(
			'userID' => $user_id,
			'patientID' => $patientID,
			'navyID' => $this->input->post('navyID'),	
			'prank' => $this->input->post('rank'),		
			'pcategory' => $this->input->post('category'),		
			'prelation' => $this->input->post('relation'),		
			'gender' => $this->input->post('gender'),		
			'age' => $this->input->post('age'),		
			'email' => $this->input->post('email'),		
			'address' => $this->input->post('address'),
			'image' => '<p>You did not select a file to upload.</p>',
		);
		$this->db->insert('patient', $details);


		return ($create == true && $group_data = true) ? true : false;
	}



	public function registrationDoctor($password)
	{
		$users = array(
			'password' => $password,
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('mobile'),		
		);
		$create = $this->db->insert('users', $users);
		$user_id = $this->db->insert_id();

		$group_data = array(
			'user_id' => $user_id,
			'group_id' => 3
		);
		$group_data = $this->db->insert('user_group', $group_data);

		$details = array(
			'userID' => $user_id,
			'qualification' => $this->input->post('qualification'),
			'designation' => $this->input->post('designation'),
			'speciality' => $this->input->post('speciality'),		
			'available' => 0,		
			'image' => '<p>You did not select a file to upload.</p>',	
			'signature_image' => '<p>You did not select a file to upload.</p>',	
			'gender' => $this->input->post('gender'),		
			'age' => $this->input->post('age'),		
			'email' => $this->input->post('email'),		
			'address' => $this->input->post('address'),
			'emContact' => $this->input->post('emContact'),
		);
		$this->db->insert('doctors', $details);


		return ($create == true && $group_data = true) ? true : false;
	}



	public function updateUsers($id, $data = array())
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		return ($update == true) ? true : false;
	}

	public function updateDoctor($id, $data = array())
	{
		$this->db->where('userID', $id);
		$update = $this->db->update('doctors', $data);

		return ($update == true) ? true : false;

	}

	public function updatePatient($id, $data = array())
	{
		$this->db->where('userID', $id);
		$update = $this->db->update('patient', $data);

		return ($update == true) ? true : false;

	}




}
