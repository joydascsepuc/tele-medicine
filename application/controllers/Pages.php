<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		//$this->not_logged_in();

		
		// $this->load->model('model_advice');
	}

	public function home(){
		
		
		//$this->data['department'] = $this->model_department->getDepartmentData();
		
		if ($this->session->userdata('logged_in')) {
			$this->data['title'] = '';
			$this->data['notice'] = $this->model_notices->getActiveNotice();
			$this->data['slider'] = $this->model_slider->getActiveSlider();
			$this->render_template('pages/index', $this->data);
		}
		else{
			$this->data['title'] = '';
			$this->data['notice'] = $this->model_notices->getActiveNotice();
			$this->data['slider'] = $this->model_slider->getActiveSlider();
			
			$this->render_template('pages/index', $this->data);
		}
		

	}

	public function login()
	{
		$this->data['title'] = 'Login';

		// $licence = strtotime('2020-08-01');
		// $today = strtotime(date('Y-m-d'));
		$this->logged_in();

		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$user_exists = $this->model_auth->check_user($this->input->post('mobile'));
           	if($user_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('mobile'), $this->input->post('password'));
           		if($login) {

					$data = array(
						'userid' => $login['id'],
						'intime' => strtotime(date('Y-m-d h:i:s a')),
			        	'outTime' => '',
			        );

			        $create = $this->model_auth->logindetails($data);
					$details = $this->db->insert_id();

           			$logged_in_sess = array(
           				'id' 		=> $login['id'],
						'phone' 	=> $login['phone'],
						'group'		=> $login['groupID'],
						'department'=> 0,
						'detailsID' => $details,
						'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);

					if ($login['groupID']==3) {
						redirect('select', 'refresh');
					}
					elseif ($login['groupID']==4) {
						redirect('patienthome', 'refresh');
					}
					else {
						redirect('dashboard', 'refresh');
						// $this->render_template('pages/index');
					}
           		}
           		else {
					//$this->data['title'] = 'Login';
					$this->data['errors'] = 'Incorrect Mobile/Password Combination';#$this->getMac();
           			$this->render_template('pages/auth/login', $this->data);
           			// $this->load->view('login', $this->data);
           		}
           	}
           	else {
				//$this->data['title'] = 'Login';
           		$this->data['errors'] = 'Mobile Number does not exists';
           		$this->render_template('pages/auth/login', $this->data);
           		// $this->load->view('login', $this->data);
           	}
		
        }
        else {
            // false case
			//$this->data['title'] = 'Login';

           $this->render_template('pages/auth/login',$this->data );
        }
	}


	public function selection()
	{
		$this->data['title'] = 'Department Selection';

		$this->form_validation->set_rules('department', 'Department', 'required');

	      if ($this->form_validation->run() == TRUE) {
				$this->session->set_userdata('department', $this->input->post('department'));
				$id = $this->session->userdata('detailsID');
				$data = array(
					'department' => $this->input->post('department'),
				);
				$this->model_auth->logindetailsupdate($id, $data);
				$this->model_auth->doctorAvailableOn($this->session->userdata('id'));
				redirect('dochome', 'refresh');
	        }
	        else {
				$this->data['department'] = $this->model_department->getDepartmentData();
	            $this->render_template('pages/auth/selection', $this->data);
	        }
	}

	/*Extra Controller*/
	public function hp(){
		$this->render_template('pages/chat/homepage', $this->data);
	}

	public function chatpage(){
		$this->render_template('pages/chat/chatpage2', $this->data);
	}
	
	//End of extra controller


	public function registerType(){
		$this->data['title'] = 'Registration Type';
		
		$this->render_template('pages/auth/registerType', $this->data);

	}

	public function registrationDoctor(){
		$this->data['title'] = 'Register Doctor';
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[users.phone]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('navyID', 'Navy ID', 'trim|required');

      if ($this->form_validation->run() == TRUE) {
				//$email_exists = $this->model_auth->check_email($this->input->post('email'));
        $user_exists = $this->model_auth->check_user($this->input->post('mobile'));
           	if($user_exists==FALSE) {
					$password = $this->password_hash($this->input->post('password'));
		        	
					$create = $this->model_auth->registrationDoctor($password);
					
					if($create != false) {
						$this->data['success'] = 'Successfully Created.';
           				$this->render_template('pages/auth/login', $this->data);
		        	}
		        	else {
						$this->data['error'] = 'Error Occured.';
						
            			$this->render_template('pages/auth/registrationDoctor', $this->data);
		        	}
           	}
           	else {
           		$this->data['errors'] = 'Phone Number is already exists';
				
           		$this->render_template('pages/auth/registrationDoctor', $this->data);
           	}
        }
        else {
            $this->render_template('pages/auth/registrationDoctor', $this->data);
        }

	}

	public function registrationPatient(){
		$this->data['title'] = 'Register Patient';

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[users.phone]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('navyID', 'Navy ID', 'trim|required');

      if ($this->form_validation->run() == TRUE) {
				//$email_exists = $this->model_auth->check_email($this->input->post('email'));
        $user_exists = $this->model_auth->check_user($this->input->post('mobile'));
           	if($user_exists==FALSE) {
					$password = $this->password_hash($this->input->post('password'));
		        	
					$create = $this->model_auth->registrationPatient($password);
					
					if($create != false) {
						$this->data['success'] = 'Successfully Created.';
           				$this->render_template('pages/auth/login', $this->data);
		        	}
		        	else {
						$this->data['error'] = 'Error Occured.';
						$this->data['rank'] = $this->model_patient->getRankData();
						$this->data['relation'] = $this->model_patient->getRelationshipData();
						$this->data['category'] = $this->model_patient->getCategoryData();
            			$this->render_template('pages/auth/registrationPatient', $this->data);
		        	}
           	}
           	else {
           		$this->data['errors'] = 'Phone Number is already exists';
				$this->data['rank'] = $this->model_patient->getRankData();
				$this->data['relation'] = $this->model_patient->getRelationshipData();
				$this->data['category'] = $this->model_patient->getCategoryData();
           		$this->render_template('pages/auth/registrationPatient', $this->data);
           	}
        }
        else {
            $this->data['rank'] = $this->model_patient->getRankData();
			$this->data['relation'] = $this->model_patient->getRelationshipData();
			$this->data['category'] = $this->model_patient->getCategoryData();
            $this->render_template('pages/auth/registrationPatient', $this->data);
        }

	}


	public function forgot(){
		
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('navyID', 'Navy ID', 'trim|required');

      if ($this->form_validation->run() == TRUE) {
				//$email_exists = $this->model_auth->check_email($this->input->post('email'));
        $user_exists = $this->model_auth->check_userMobile($this->input->post('name'), $this->input->post('mobile'));
           	if(!empty($user_exists)) {
					//$password = $this->password_hash($this->input->post('password'));
		        	
					$password = $this->model_auth->passwordReset($user_exists['id']);
					
					if($password != false) {
						$this->data['success'] = 'Your Password is reset. Your New Password is<b>\' '.$password.'\'</b>';
           				$this->render_template('pages/auth/login', $this->data);
		        	}
		        	else {
						$this->data['error'] = 'Error Occured.';
            			$this->render_template('pages/auth/forgotPassword', $this->data);
		        	}
           	}
           	else {
           		$this->data['errors'] = 'Your Name & Phone Number isn\'t matched';
           		$this->render_template('pages/auth/forgotPassword', $this->data);
           	}
        }
        else {
            $this->render_template('pages/auth/forgotPassword');
        }

	}



	public function profile()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($user_id);
		$user_group = $this->model_users->getUserGroup($user_id);
		$this->data['title'] = 'Profile';
		
		if($user_id) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('prePass')) && empty($this->input->post('cpassword'))) {
		        	$user = $this->model_auth->updateUsers($user_id, array('name' => $this->input->post('name')));
		        	
		        	if ($user_group['id']==3) {
		        		if($_FILES['profileimage']['size'] > 0) {
					        $upload_image = $this->upload_image($this->input->post('name'));
					        $upload_image = array('image' => $upload_image);
					        $this->model_auth->updateDoctor($user_id, $upload_image);
					    }

					    if($_FILES['signatureimage']['size'] > 0) {
					        $upload_image = $this->upload_signature_image($this->input->post('name'));
					        $upload_image = array('signature_image' => $upload_image);
					        $this->model_auth->updateDoctor($user_id, $upload_image);
					    }

						$doctor = array(
							'qualification' => $this->input->post('qualification'),
							'designation' => $this->input->post('designation'),
							'address' => $this->input->post('address'),
							'speciality' => $this->input->post('speciality'),
							'gender' => $this->input->post('gender'),
							'age' => $this->input->post('age'),
							'email' => $this->input->post('email'),
							'emContact' => $this->input->post('emContact'),
						);
						$doctor = $this->model_auth->updateDoctor($user_id, $doctor);
					}

					if ($user_group['id']==4) {

						if($_FILES['profileimage']['size'] > 0) {
					        $upload_image = $this->upload_image($this->input->post('name'));
					        $upload_image = array('image' => $upload_image);
					        $this->model_auth->updatePatient($user_id, $upload_image);
					    }

						$patient = array(
							'navyID' => $this->input->post('navyID'),
							'address' => $this->input->post('address'),
							'pcategory' => $this->input->post('category'),
							'prank' => $this->input->post('rank'),
							'prelation' => $this->input->post('relation'),
							'gender' => $this->input->post('gender'),
							'age' => $this->input->post('age'),
							'email' => $this->input->post('email'),
						);
						$patient = $this->model_auth->updatePatient($user_id, $patient);
					}

						if($user == true) {
			        		// $this->data['success'] = 'Successfully Updated';
	        				$this->session->set_flashdata('success', 'Successfully Updated!!');

           					redirect('profile', 'refresh');
           				
			        	}
			        	else {
			        		// $this->data['errors'] = 'Error Occured';
	        				$this->session->set_flashdata('errors', 'Error occurred!!');

           					redirect('profile', 'refresh');
			        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
					$this->form_validation->set_rules('prePass', 'Current password', 'trim|required');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));
						$user = $this->model_auth->updateUsers($user_id, array('name' => $this->input->post('name'), 'password' => $password));
		        	
			        	if ($user_group['id']==3) {
			        		if($_FILES['profileimage']['size'] > 0) {
						        $upload_image = $this->upload_image($this->input->post('name'));
						        $upload_image = array('image' => $upload_image);
						        $this->model_auth->updateDoctor($user_id, $upload_image);
						    }

						    if($_FILES['signatureimage']['size'] > 0) {
						        $upload_image = $this->upload_signature_image($this->input->post('name'));
						        $upload_image = array('signature_image' => $upload_image);
						        $this->model_auth->updateDoctor($user_id, $upload_image);
						    }

							$doctor = array(
								'qualification' => $this->input->post('qualification'),
								'designation' => $this->input->post('designation'),
								'address' => $this->input->post('address'),
								'speciality' => $this->input->post('speciality'),
								'gender' => $this->input->post('gender'),
								'age' => $this->input->post('age'),
								'email' => $this->input->post('email'),
								'emContact' => $this->input->post('emContact'),
							);
							$doctor = $this->model_auth->updateDoctor($user_id, $doctor);
						}

						if ($user_group['id']==4) {

							if($_FILES['profileimage']['size'] > 0) {
						        $upload_image = $this->upload_image($this->input->post('name'));
						        $upload_image = array('image' => $upload_image);
						        $this->model_auth->updatePatient($user_id, $upload_image);
						    }

							$patient = array(
								'navyID' => $this->input->post('navyID'),
								'address' => $this->input->post('address'),
								'pcategory' => $this->input->post('category'),
								'prank' => $this->input->post('rank'),
								'prelation' => $this->input->post('relation'),
								'gender' => $this->input->post('gender'),
								'age' => $this->input->post('age'),
								'email' => $this->input->post('email'),
							);
							$patient = $this->model_auth->updatePatient($user_id, $patient);
						}

			        	if($user == true) {
			        		// $this->data['success'] = 'Successfully Updated';
	        				$this->session->set_flashdata('success', 'Successfully Updated!!');

           					redirect('profile', 'refresh');
           				
			        	}
			        	else {
			        		// $this->data['errors'] = 'Error Occured';
	        				$this->session->set_flashdata('errors', 'Error occurred!!');

           					redirect('profile', 'refresh');
			        	}
					}
			        else {
			            // false case
						$this->data['user_data'] = $user_data;
						$this->data['user_group'] = $user_group;

						if ($user_group['id']==3) {
							$this->data['userDetails'] = $this->model_doctors->getDoctorbyUser($user_id);
						}
						elseif ($user_group['id']==4) {
							$this->data['userDetails'] = $this->model_patient->getPatientDetails($user_id);
						}
						else{
							$this->data['userDetails'] = $this->model_patient->getUserDetails($user_id);
						}

						$this->data['rank'] = $this->model_patient->getRankData();
						$this->data['relation'] = $this->model_patient->getRelationshipData();
						$this->data['category'] = $this->model_patient->getCategoryData();


				        $this->render_template('pages/auth/profile', $this->data);
			        }

		        }
	        }
	        else {
	            // false case
	           	$this->data['user_data'] = $user_data;
				$this->data['user_group'] = $user_group;
						
				if ($user_group['id']==3) {
					$this->data['userDetails'] = $this->model_doctors->getDoctorbyUser($user_id);
				}
				elseif ($user_group['id']==4) {
					$this->data['userDetails'] = $this->model_patient->getPatientDetails($user_id);
				}else{
					$this->data['userDetails'] = '';
				}
				

				$this->data['rank'] = $this->model_patient->getRankData();
				$this->data['relation'] = $this->model_patient->getRelationshipData();
				$this->data['category'] = $this->model_patient->getCategoryData();
				$this->render_template('pages/auth/profile', $this->data); 		
	        }
		}
	}


	public function logout()
	{
		$id = $this->session->userdata('detailsID');
		$data = array(
			'outTime' => strtotime(date('Y-m-d h:i:s a')),
		);
		$this->model_auth->logindetailsupdate($id, $data);

		if ($this->session->userdata('group')==3) {
			$this->model_auth->doctorAvailableOff($this->session->userdata('id'));
			# code...
		}

		$this->session->sess_destroy();
		redirect('signin', 'refresh');
	}














	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}


	public function fetchDoctorPhone(){
		$details = $this->model_auth->getDoctorDetailsDataByMobile($this->input->post('mobile'));
		//$res = $this->model_users->getActiveUser($details['userId']);
		if($details==1){
			$data_arr = ['id' =>$details['id'],'name' =>$details['name']];
			echo json_encode(['status' => 1 ,'message' => '' , 'json_ar' => $data_arr ]);

		}else{

			echo json_encode(['status' => 0 ,'message' => '']);
		}
	}

	public function fetchPatientPhone(){
		$details = $this->model_auth->getPatientDetailsDataByMobile($this->input->post('mobile'),$this->input->post('relation'));
		//$res = $this->model_users->getActiveUser($details['userId']);
		if($details==1){
			$data_arr = ['id' =>$details['id'],'name' =>$details['name']];
			echo json_encode(['status' => 1 ,'message' => '' , 'json_ar' => $data_arr ]);
		}else{
			echo json_encode(['status' => 0 ,'message' => '']);
		}
	}



	public function currentPassCheck(){

		$details = $this->model_auth->currentPassCheck($this->input->post('prePass'));
		//$res = $this->model_users->getActiveUser($details['userId']);
		if($details){
			//$data_arr = ['id' =>$details['id'],'name' =>$details['name']];
			echo json_encode(['status' => 1 ,'message' => '']);

		}else{

			echo json_encode(['status' => 0 ,'message' => '']);
		}
	}



	public function upload_image($name)
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/user_image';
        $config['file_name'] =  'profileImage'.$name.uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '4000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload');
		$this->upload->initialize($config);
        if ( ! $this->upload->do_upload('profileimage'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['profileimage']['name']);
            $type = $type[count($type) - 1];
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;
        }
    }


		public function upload_signature_image($name)
	    {
	    	// assets/images/patient_image
	        $config2['upload_path'] = 'assets/images/signature_image';
	        $config2['file_name'] =  'signImage'.$name.uniqid();
	        $config2['allowed_types'] = 'gif|jpg|png';
	        $config2['max_size'] = '4000';

	        $this->load->library('upload');
					$this->upload->initialize($config2);
	        if ( ! $this->upload->do_upload('signatureimage'))
	        {
	            $error = $this->upload->display_errors();
	            return $error;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            $type = explode('.', $_FILES['signatureimage']['name']);
	            $type = $type[count($type) - 1];

	            $path = $config2['upload_path'].'/'.$config2['file_name'].'.'.$type;
	            return ($data == true) ? $path : false;
	        }
	    }


	    public function demo()
	    {
	    	$this->load->view('pages/demo');
	    }

	
}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */