<?php


class Users extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['title'] = 'Users';

	}

	public function index()
	{
		// if(!in_array('viewUser', $this->permission)) {
  //           redirect('dashboard', 'refresh');
  //       }
		$user_data = $this->model_users->getUserData();

		$result = array();
		foreach ($user_data as $k => $v) {

			$result[$k]['user_info'] = $v;

			$group = $this->model_users->getUserGroup($v['id']);
			$result[$k]['user_group'] = $group;
		}
		$this->data['user_data'] = $result;
		$this->render_template('pages/users/index', $this->data);
	}


	public function reset($id)
	{	
		if($id) {
			$reset = $this->model_users->passwordReset($id);
			$this->session->set_flashdata('success', 'Successfully Reset. New password is <b>'.$reset.'</b>');
			redirect('users', 'refresh');
		}


	}


	public function delete($id)
	{
		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully Removed');
		        		redirect('users', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('pages/users/delete/'.$id, 'refresh');
		        	}

			}
			else {
				$this->data['id'] = $id;
				$this->render_template('pages/users/delete', $this->data);
			}
		}
	}



	

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */