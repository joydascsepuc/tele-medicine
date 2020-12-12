<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicines extends Admin_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['title'] = 'Medicine';
		// $this->load->model('model_medicine');
	}

	public function index()
	{
		if(!in_array('viewMedicine', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('pages/medicine/index', $this->data);
	}

	public function fetchMedicineData()
	{
		$result = array('data' => array());

		$data = $this->model_medicine->getMedicineData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
				if(in_array('updateMedicine', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
				if(in_array('deleteMedicine', $this->permission)) {
					$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$key+1,
				$value['name'],
				//$value['generic'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createMedicine', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('medicine_name', 'Medicine Details', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
				'name' => $this->input->post('medicine_name'),
        		//'generic' => $this->input->post('generic_name'),
        		'active' => $this->input->post('active'),
        	);

        	$create = $this->model_medicine->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
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

	public function fetchMedicineDataById($id = null)
	{
		if($id) {
			$data = $this->model_medicine->getMedicineData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		if(!in_array('updateMedicine', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_medicine_name', 'Medicine Details', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'name' => $this->input->post('edit_medicine_name'),
	        		//'generic' => $this->input->post('edit_generic_name'),
        			'active' => $this->input->post('edit_active'),
	        	);

	        	$update = $this->model_medicine->update($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';
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
		if(!in_array('deleteMedicine', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$medicine_id = $this->input->post('medicine_id');

		$response = array();
		if($medicine_id) {
			$delete = $this->model_medicine->remove($medicine_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}

/* End of file Medicines.php */
/* Location: ./application/controllers/Medicines.php */