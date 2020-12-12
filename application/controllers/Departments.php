<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		// $this->data['page_title'] = 'Advice';
		$this->data['title'] = 'Departments';
		
		// $this->load->model('model_advice');
	}

	public function index()
	{
		if(!in_array('viewDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('pages/department/index', $this->data);
	}

	public function fetchDepartmentData()
	{
		$result = array('data' => array());

		$data = $this->model_department->getDepartmentData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			if(in_array('updateDepartment', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
				if(in_array('deleteDepartment', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$key+1,
				$value['name'],
				$value['priority'],
				$value['timing'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('department_name', 'Department name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		$last=$this->model_department->getLastPriority();
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('department_name'),
        		'active' => $this->input->post('active'),
        		'priority' => $last['priority']+1,
        		'timing' => $this->input->post('timing'),
        	);

        	$create = $this->model_department->create($data);
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

	public function fetchDepartmentDataById($id = null)
	{
		if($id) {
			$data = $this->model_department->getDepartmentData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		if(!in_array('updateDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_department_name', 'Department name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_department_name'),
        			'active' => $this->input->post('edit_active'),
        			'priority' => $this->input->post('edit_priority'),
        			'timing' => $this->input->post('edit_timing'),

	        	);

	        	$update = $this->model_department->update($id, $data);
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
		if(!in_array('deleteDepartment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$department_id = $this->input->post('department_id');

		$response = array();
		if($department_id) {
			$delete = $this->model_department->remove($department_id);
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



	public function getDepartmentPriority()
	{
		// $department_id = $this->input->post('department_id');
		$designations = $this->data['designation'] = $this->model_department->getDepartmentPriority();
		if(count($designations)>0)
		{
			$pro_select_box = '';
			foreach ($designations as $key => $value) {
				$pro_select_box .='<option value="'.$value['priority'].'">'. $value['priority'].'</option>';
			}
			echo json_encode($pro_select_box);
		}
		else{
			$pro_select_box = '';
			$pro_select_box .= '<option value="">None</option>';
			echo json_encode($pro_select_box);
		}
	}

}

/* End of file Departments.php */
/* Location: ./application/controllers/Departments.php */