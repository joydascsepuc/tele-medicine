<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Groups extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->data['title'] = 'Groups';

		// $this->data['page_title'] = 'Advice';
		// $this->load->model('model_advice');
	}

	public function index()
	{
		if(!in_array('viewGroup', $this->permission)) {
            redirect('index', 'refresh');
        }

		$groups_data = $this->model_groups->getGroupData();
		$this->data['groups_data'] = $groups_data;
		$this->render_template('pages/groups/index', $this->data);
	}

	public function create()
	{
		if(!in_array('createGroup', $this->permission)) {
            redirect('index', 'refresh');
        }

		$this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
        	$data = array(
        		'group_name' => $this->input->post('group_name'),
        		'permission' => $permission
        	);

        	$create = $this->model_groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('groups', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('newgroups', 'refresh');
        	}
        }
        else {
            // false case
            $this->render_template('pages/groups/create', $this->data);
        }	

		
	}

	public function edit($id = null)
	{
		if(!in_array('updateGroup', $this->permission)) {
            redirect('index', 'refresh');
        }

		if($id) {

			$this->form_validation->set_rules('group_name', 'Group name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
	            $permission = serialize($this->input->post('permission'));
	            
	        	$data = array(
	        		'group_name' => $this->input->post('group_name'),
	        		'permission' => $permission
	        	);

	        	$update = $this->model_groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('groups', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('editgroups/'.$id, 'refresh');
	        	}
	        }
	        else {
	            // false case
	            $group_data = $this->model_groups->getGroupData($id);
				$this->data['group_data'] = $group_data;
				
				$this->render_template('pages/groups/edit', $this->data);	
	        }	
		}

		
	}

	public function delete($id){
		
		if(!in_array('deleteGroup', $this->permission)) {
            redirect('pages/index', 'refresh');
        }
        
		if($id) {
			if($this->input->post('confirm')) {

				$check = $this->model_groups->existInUserGroup($id);
				if($check == true) {
					$this->session->set_flashdata('error', 'Group exists in the users');
	        		redirect('groups', 'refresh');
				}
				else {
					$delete = $this->model_groups->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('groups', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('rmvgroups/'.$id, 'refresh');
		        	}
				}	
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('pages/groups/delete', $this->data);
			}	
		}
	}


}