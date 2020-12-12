<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Slider';
		// $this->load->model('model_advice');
	}

	public function index()
	{
		if(!in_array('viewSlider', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('pages/slider/index', $this->data);
	}

	public function fetchSliderData()
	{
		$result = array('data' => array());

		$data = $this->model_slider->getSliderData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			if(in_array('updateSlider', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
				if(in_array('deleteSlider', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$key+1,
				$value['title'],
				$value['note'],
				//$value['priority'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	public function create()
	{
		if(!in_array('createSlider', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('title', 'Slider Title', 'trim|required');
		$this->form_validation->set_rules('note', 'Slider Note', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		$last=$this->model_department->getLastPriority();
        if ($this->form_validation->run() == TRUE) {
        	$upload_image = $this->upload_image();
        	$data = array(
        		'title' => $this->input->post('title'),
        		'note' => $this->input->post('note'),
        		'active' => $this->input->post('active'),
        		'image' => $upload_image,
        		//'priority' => $last['priority']+1,
        	);

        	$create = $this->model_slider->create($data);
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


	public function fetchSliderDataById($id = null)
	{
		if($id) {
			$data = $this->model_slider->getSliderData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		if(!in_array('updateSlider', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_title', 'Slider Title', 'trim|required');
			$this->form_validation->set_rules('edit_note', 'Slider Note', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {

	        	

	        	$data = array(
	        		'title' => $this->input->post('edit_title'),
	        		'note' => $this->input->post('edit_note'),
	        		'active' => $this->input->post('edit_active'),
        			//'priority' => $this->input->post('edit_priority'),
	        	);
	        	$update = $this->model_slider->update($id, $data);

	        	if($_FILES['edit_img']['size'] > 0) {
	                $upload_image = $this->upload_edit_image();
	                $upload_image = array('image' => $upload_image);

	                $this->model_slider->update($id, $upload_image);
           		 }
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
		if(!in_array('deleteSlider', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$slider_id = $this->input->post('slider_id');

		$response = array();
		if($slider_id) {
			$delete = $this->model_slider->remove($slider_id);
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



	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/slider';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '4000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload');
		$this->upload->initialize($config);
        if ( ! $this->upload->do_upload('img'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['img']['name']);
            $type = $type[count($type) - 1];
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;
        }
    }

    public function upload_edit_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/slider';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '4000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload');
		$this->upload->initialize($config);
        if ( ! $this->upload->do_upload('edit_img'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['edit_img']['name']);
            $type = $type[count($type) - 1];
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;
        }
    }


}

/* End of file Slider.php */
/* Location: ./application/controllers/Slider.php */