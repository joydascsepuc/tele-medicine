<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['title'] = 'Advice';
		
	}

	public function index()
	{
		if(!in_array('viewNotice', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('pages/notices/index', $this->data);
	}

	public function fetchNoticeData()
	{
		$result = array('data' => array());

		$data = $this->model_notices->getNoticeData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			if(in_array('updateNotice', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
				if(in_array('deleteNotice', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$key+1,
				$value['title'],
				//$value['priority'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createNotice', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('notice', 'Notice name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		//$last=$this->model_department->getLastPriority();
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'title' => $this->input->post('notice'),
        		'active' => $this->input->post('active'),
        		//'priority' => $last['priority']+1,
        	);

        	$create = $this->model_notices->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the department information';
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function fetchNoticeDataById($id = null)
	{
		if($id) {
			$data = $this->model_notices->getNoticeData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		if(!in_array('updateNotice', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_notice', 'Notice name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'title' => $this->input->post('edit_notice'),
        			'active' => $this->input->post('edit_active'),
        			//'priority' => $this->input->post('edit_priority'),
	        	);

	        	$update = $this->model_notices->update($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the department information';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteNotice', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$notice_id = $this->input->post('notice_id');

		$response = array();
		if($notice_id) {
			$delete = $this->model_notices->remove($notice_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the department information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


}

/* End of file Notice.php */
/* Location: ./application/controllers/Notices.php */