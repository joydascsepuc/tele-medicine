<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		//$this->data['page_title'] = 'Patient';
	}

	public function dash(){

		$department = $this->session->userdata('department');
		$this->data['title'] = 'Doctors Home';

		$this->data['department'] = $this->model_department->getDepartmentData($department);
		//$appoinments = $this->model_doctors->getAppontmentDataByDepartment($department);
		$result = array();
	    $this->render_template('pages/doctor/dashboard' , $this->data);
	}



	public function toggleDoctorAvailablity()
	{
		$id = $this->session->userdata('id');
		$avail = $this->input->post('avail');
		$update = $this->model_doctors->toggleDoctorAvailablity($id, $avail);

		echo $update;
	}



	public function appoinmentdetails($id)
	{
		if ($id) {
			$this->form_validation->set_rules('medicine', 'Medicine Name', 'trim|required');
			if ($this->form_validation->run() == TRUE) {

				$this->saveNewComplaint($this->input->post('complaint'));
				$this->saveNewExamination($this->input->post('examination'));
				$this->saveNewDiagnosis($this->input->post('diagnosis'));
				$this->saveNewInvestigation($this->input->post('investigation'));
				$this->saveNewAdvice($this->input->post('advice'));
				$this->saveNewMedicine($this->input->post('medicine'));



        		$visit_id = $this->model_doctors->appoinmentdetails($id);

	        	if($visit_id) {
	        		$this->session->set_flashdata('success', 'Successfully created');
	        		redirect('dochome', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('docappoinmentdetails/'.$id, 'refresh');
	        	}
        	}
        	else{
				$this->data['title'] = 'Appointments';

        		$this->cart->destroy();
        		$this->db->where('id', $id);
				$this->db->update('patientserial', array('called' => 1));
        		$department = $this->session->userdata('department');
				$this->data['department'] = $this->model_department->getDepartmentData($department);
				$this->data['appoinments'] = $appoinments = $this->model_doctors->getAllAppontmentData($id);
				$this->data['patient']= $patient =  $this->model_patient->getPatientFullDetails($appoinments['pateintID']);
				$this->data['doctors'] = $this->model_doctors->getDoctorFullDetails($appoinments['doctorID']);
				$this->data['relationship'] =  $this->model_patient->getRelationshipData($patient['prelation']);
				$this->data['rank'] =  $this->model_patient->getRankData($patient['prank']);
				$this->data['category'] =  $this->model_patient->getCategoryData($patient['pcategory']);
			    $this->render_template('pages/doctor/appoinmentdetails' , $this->data);
        	}
		}
        
	}



	public function fetchAppointmentList()
	{
		$appointments = $this->model_doctors->getAppontmentDataByDepartment($this->session->userdata('department'));
		$department = $this->model_department->getDepartmentData($this->session->userdata('department'));
		$html = ''; 
		$currentDate = strtotime(date('Y-m-d'));
		$color= '#8ab7f2';
		foreach ($appointments as $key => $value) {
			$patient = $this->model_patient->getPatientFullDetails($value['pateintID']);
			$relationship =  $this->model_patient->getRelationshipData($patient['prelation']);
			$rank =  $this->model_patient->getRankData($patient['prank']);
			$category =  $this->model_patient->getCategoryData($patient['pcategory']);
			$string=$patient['navyID'].' - '.$category['name'].' - '.$rank['name'].' - '.$relationship['name'].'.&nbsp;&nbsp; Age -'.$patient['age'];

			if($value['visited'] == 0 && $value['called'] == 1){
				$color = '#edf25c';
			}

			$html.='<div style="border-bottom: solid; max-height: 100px; padding: 5px; overflow-y: hidden; overflow-x: hidden; background-color:'.$color.'; text-align: center; border-radius: 3px; vertical-align: middle;" class="mb-2 mt-1 ">
				<a href="'.base_url('docappoinmentdetails/'.$value['id']).'" style="color: black; text-decoration: none;">
				
					<div class="row">
						<div class="col-1">
							<i class="fas fa-user-injured fa-3x"></i>
						</div>
						<div class="col-8">
							<span class="text-center font-weight-bold" style="font-size:12pt;">'.$patient['name'].' - '.$string.'</span><br>
							<span class="text-center" style="overflow-y: hidden;">'.$value['complaintText'].'</span>
						</div>
						<div class="col-3">
							<span class="font-weight-bold">'.date('d/m/y h:i a', $value['datetime']).'</span>
						</div>
					</div>
				</a>
			</div>
				';
		}
		echo ($html);
	}










	public function fetchDiseaseForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_disease->getDiseaseForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-unstyled prothom" id="disID">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="prothom1" id="'.$value['id'].'">'.$value['name'].'</li>';
 		 }
 		 $html.= '</ul>';
 		 echo ($html);
		}
		else{
			$html= 'Nothing Found';

		}
		
	}

	public function fetchDisease()
	{
		$pID = $this->input->post('pID');
		$diseaseData = $this->model_disease->getDiseaseData($pID);

		$complaint_name = array();
		if ($diseaseData['complaint']!='') {
			$complaint_ids = explode(',',$diseaseData['complaint']);

			foreach ($complaint_ids as $k => $v) {
				$complaint_data = $this->model_complaint->getComplaintData($v);
				$complaint_name[] = $complaint_data['name'];
			}
			$complaint_name = implode(', ', $complaint_name);
		}
		else {
			$complaint_name='';
		}

		$examination_name = array();
		if ($diseaseData['examination']!='') {
			$examination_ids = explode(',',$diseaseData['examination']);

			foreach ($examination_ids as $k => $v) {
				$examination_data = $this->model_examination->getExaminationData($v);
				$examination_name[] = $examination_data['name'];
			}
			$examination_name = implode(', ', $examination_name);
		}
		else {
			$examination_name='';
		}

		$diagnosis_name = array();
		if ($diseaseData['diagnosis']!='') {
			$diagnosis_ids = explode(',',$diseaseData['diagnosis']);
			foreach ($diagnosis_ids as $k => $v) {
				$diagnosis_data = $this->model_diagnosis->getDiagnosisData($v);
				$diagnosis_name[] = $diagnosis_data['name'];
			}
			$diagnosis_name = implode(', ', $diagnosis_name);
		}
		else {
			$diagnosis_name='';
		}

		$investigation_name = array();
		if ($diseaseData['investigation']!='') {
			$investigation_ids = explode(',',$diseaseData['investigation']);

			foreach ($investigation_ids as $k => $v) {
				$investigation_data = $this->model_investigation->getInvestigationData($v);
				$investigation_name[] = $investigation_data['name'];
			}
			$investigation_name = implode(', ', $investigation_name);
		}
		else {
			$investigation_name='';
		}

		$Advice_name = array();
		if ($diseaseData['advice']!='') {
			$Advice_ids = explode(',',$diseaseData['advice']);

			foreach ($Advice_ids as $k => $v) {
				$Advice_data = $this->model_advice->getAdviceData($v);
				$Advice_name[] = $Advice_data['name'];
			}
			$Advice_name = implode(', ', $Advice_name);
		}
		else {
			$Advice_name='';
		};
		$result = array();
		$result['id'] = $diseaseData['id'];
		$result['name'] = $diseaseData['name'];
		$result['complaint'] = $complaint_name;
		$result['examination'] = $examination_name;
		$result['investigation'] = $investigation_name;
		$result['diagnosis'] = $diagnosis_name;
		$result['advice'] = $Advice_name;


		echo json_encode($result);
	}


	public function fetchDiseaseMedicine()
	{
		$this->cart->destroy();
		$cusID = $this->input->post('pID');
		$diseaseMedicine = $this->model_disease->getDiseaseMedicine($cusID);
		foreach ($diseaseMedicine as $key => $value) {
			$medicine = $this->model_medicine->getMedicineData($value['medicineID']);
			$data = array(
				'id'             => $value['medicineID'],
				'qty'            => 1,
				'price'          => 0,
				'instruction'    => $value['instruction'],
				'instruction2'   => $value['instruction2'],
				'instructionID'  => $value['instructionID'],
				'instructionID2' => $value['instructionID2'],
				'name'           => $medicine['name'],
				'day'            => $value['day'],
				'amount'         => $value['amount'],
			);
			$this->cart->insert($data);
		}
		echo json_encode(array('status' => 'ok',
			'data' => $this->cart->contents()
			)
		);
	}


	public function in_delete_item($rowid){
		if($this->cart->remove($rowid)) {
			echo $this->cart->total();
		}else{
			echo "false";
		}
	}

	public function in_edit_item($rowid){
		if($rowid) {
			$medicine = $this->cart->get_item($rowid);
			echo json_encode($medicine);
		}else{
			echo "false";
		}
	}


	public function raw_add_item(){
		$amount=0;
		$medicineID = $this->input->post('medicineID');
		$medicine = $this->input->post('medicine');
		$instruction = $this->input->post('instruction');
		$instruction2 = $this->input->post('instruction2');
		$instructionID = $this->input->post('instructionID');
		$instructionID2 = $this->input->post('instructionID2');
		$day = $this->input->post('day');
		$amount = $this->input->post('amount');
		// if ($this->input->post('instructionID')!='') {
		// 	$instructionID = $this->input->post('instructionID');
		// 	$ins=$this->model_medicine->getDosesData($instructionID);
		// 	$amount =  $ins['amount'] *$day;
		// }

		if($medicineID){
			$data = array(
				'id'          => $medicineID,
				'qty'         => 1,
				'price'       => 0,
				'instruction' => $instruction,
				'instruction2' => $instruction2,
				'instructionID' => $instructionID,
				'instructionID2' => $instructionID2,
				'name'        => $medicine,
				'day'         => $day,
				'amount'      => $amount,
			);
			$this->cart->insert($data);
			echo json_encode(array('status' => 'ok',
							'data' => $this->cart->contents()
						)
				);
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}





	public function saveNewComplaint($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_complaint->getComplaintNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_complaint->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}


	public function saveNewExamination($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_emination->getExminationNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_exmination->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}


	public function saveNewDiagnosis($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_diagnosis->getDiagnosisNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_diagnosis->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}


	public function saveNewInvestigation($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_investigation->getInvestigationNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_investigation->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}


	public function saveNewAdvice($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_advice->getAdviceNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_advice->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}


	public function saveNewMedicine($string)
	{
		$words = explode(",", $string);

		for($i=0; $i < count($words); $i++) {
			$check = $this->model_medicine->getMedicineNameSearch($words[$i]);
			if ($check==1) {
				continue;
			}
			else{
				$this->model_medicine->create(array('name' => $words[$i],'active' => 1 ));
			}
		}
		return true;
	}








}

/* End of file Doctor.php */
/* Location: ./application/controllers/Doctor.php */