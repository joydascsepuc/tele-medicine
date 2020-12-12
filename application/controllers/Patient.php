<?php

class Patient extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		
	}

	public function home()
	{
		// // if(!in_array('viewPatient', $this->permission)) {
		// // 	redirect('dashboard', 'refresh');
		// // }
		// $appointments = $this->model_patient->getAppontmentDataByPatient($this->session->userdata('id'));
		// $result = array();
		// foreach ($appointments as $key => $value) {
		// 		$result[$key]['apoint'] = $value; 
		// 		$result[$key]['doctor'] = $this->model_doctors->getDoctorFullDetails($value['doctorID']);
		// 		$result[$key]['department'] = $this->model_department->getDepartmentData($value['departmentID']);
		// 	}

		// $this->data['appoinments'] = $result;
		$this->data['title'] = 'Patient Home';
		$this->render_template('pages/patient/index', $this->data);
	}


	public function takeappointment()
	{
		// if(!in_array('viewPatient', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		$this->data['title'] = 'Appointments';

		$this->data['department'] = $this->model_department->getActiveDepartment();
		$this->render_template('pages/patient/takeappointment', $this->data);
	}

	public function prep()
	{
		$this->render_template('pages/patient/prep', $this->data);
	}


	public function doctorOnline($deptID)
	{
		// if(!in_array('viewPatient', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		$result = array();
		if ($deptID) {
			$onlineDoctor = $this->model_department->doctorOnline($deptID);
		$this->data['title'] = 'Online Doctors';

			foreach ($onlineDoctor as $key => $value) {
				$result[$key]['users'] = $this->model_users->getUserData($value['id']);
				$result[$key]['usersdetails'] = $this->model_doctors->getDoctorbyUser($value['id']);
			}
			$this->data['availableDoctor'] = $result;
			$this->data['department'] = $this->model_department->getDepartmentData($deptID);
			$this->render_template('pages/patient/onlinedoctor', $this->data);
		}
		
	}


	public function placeserial($docID, $deptID)
	{
		if ($docID && $deptID) {
		$this->form_validation->set_rules('complaint', 'Complaint', 'required');

	      if ($this->form_validation->run() == TRUE) {

				$placed = $this->model_patient->placeserial($docID, $deptID);
				if($placed != false) {
					$this->session->set_flashdata('success', 'Successfully Placed. Your Serial is '.$placed);
        			redirect('patienthome', 'refresh');
        		}
        		else {
	        		$this->session->set_flashdata('errors', 'Error Occurred!!');
	        		redirect('placeserial/'.$docID.'/'.$deptID, 'refresh');
	        	}
	        }
	        else {
				$this->data['title'] = 'Serial';

				$this->data['department'] = $this->model_department->getDepartmentData($deptID);
				$this->data['doctor'] = $this->model_users->getUserData($docID);
				$this->data['doctordetails'] = $this->model_doctors->getDoctorbyUser($docID);
				$this->render_template('pages/patient/placeserial', $this->data);
	        }
		}
	}


	public function appoinmentdetails($id)
	{
		if ($id) {
				$this->data['title'] = 'Appointments';
        		
				$this->data['appoinments'] = $appoinments = $this->model_doctors->getAllAppontmentData($id);
				$this->data['department'] = $this->model_department->getDepartmentData($appoinments['departmentID']);
				$this->data['prescription'] =$pres= $this->model_patient->getPrescriptionByAppointment($appoinments['id']);
				$this->data['doctor'] = $this->model_doctors->getDoctorFullDetails($appoinments['doctorID']);
				$this->data['unseen']= $this->model_chat->getUnseenMessagesByAppointment($appoinments['doctorID'], $appoinments['id']);
			    $this->render_template('pages/patient/appoinmentdetails',$this->data);
        	}
	}



	public function fetchAppointmentList()
	{
		$appointments = $this->model_patient->getAppontmentDataByPatient($this->session->userdata('id'));
		$html = ''; 
		$currentDate = strtotime(date('Y-m-d'));
		
		foreach ($appointments as $key => $value) {
			$color = ''; 
			$url ='';$code='';
			$doctor = $this->model_doctors->getDoctorFullDetails($value['doctorID']);
			$department = $this->model_department->getDepartmentData($value['departmentID']);
			if ($value['visited']==1 && $value['called']==1) {
				$color = '#89f49c';
				$code = 'Prescribed';
				$url ='<a href="'.base_url('patappoinmentdetails/'.$value['id']).'" style="color: black; text-decoration: none;">';

			}
			elseif ($value['visited']==0 && $value['called']==1) {
				if ($value['datetime'] >= $currentDate) {
					$code = $value['serialcode'];
					$color = '#8ab7f2';
					$url ='<a href="'.base_url('patappoinmentdetails/'.$value['id']).'" style="color: black; text-decoration: none;">';
				}
				else{
					$code = 'Consulted';
					$color = '#edf25c';
					$url ='<a href="'.base_url('patappoinmentdetails/'.$value['id']).'" style="color: black; text-decoration: none;">';
				}
			}
			else{
				if ($value['datetime'] >= $currentDate) {
					$code = $value['serialcode'];
					$color = '#f2a78a';
					$url ='<a onclick="alertFunction1()" href="#" style="color: black; text-decoration: none;">';
				}
				else{
					$color = 'none'; 
					$code = 'Missed';
					$url ='<a onclick="alertFunction2();" href="#" style="color: black; text-decoration: none;">';
				}
			}


			$html.='<div style="border-bottom: solid; max-height: 100px; padding: 5px; overflow-y: hidden; overflow-x: hidden; background-color: '.$color.'; text-align: center; border-radius: 3px;" class="mb-2 mt-1">
				';
			$html .= $url;
			$html .= '<div class="row">
						<div class="col-2">
							<i class="fas fa-user-circle fa-3x" style="vertical-align: middle;"></i>
						</div>
						<div class="col-6">
							<span class="font-weight-bold" style="font-size:18pt;">'.$department['name'].' -- '.$code.'</span>
						</div>
						<div class="col-4">
							<span class="font-weight-bold">'.date('d/m/y h:i a', $value['datetime']).'</span>
						</div>	
					</div>
				</a>
			</div>';
			

		}
		echo ($html);
	}
        

	public function pdfPrescription($id)
	{
		
		$appointments = $this->model_doctors->getAllAppontmentData($id);
		$pres= $this->model_patient->getPrescriptionByAppointment($appointments['id']);
		//$prescriptionMedicines= $this->model_patient->getPrescriptionMedicinesByAppointment($pres['id']);
		$department = $this->model_department->getDepartmentData($appointments['departmentID']);
		$doctor= $this->model_doctors->getDoctorFullDetails($appointments['doctorID']);
		$patient= $this->model_patient->getPatientFullDetails($appointments['pateintID']);
		$relationship =  $this->model_patient->getRelationshipData($patient['prelation']);
		$rank =  $this->model_patient->getRankData($patient['prank']);
		$category =  $this->model_patient->getCategoryData($patient['pcategory']);
		$company_info = $this->model_company->getCompanyData(1);

		$html = '<!-- Main content -->
		<!DOCTYPE html>
		<html>
		<style type="text/css">
			#hr1{
				border: 1px solid red;
			}

			#hr2{
				border: 1px solid black;
			}

			#vr{
				border: none;
				border-left: 1px solid hsla(200, 10%, 50%, 100);
				height: 100%;
				width: 1px;
			}
		</style>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Prescription Print</title>
			<!-- Tell the browser to be responsive to screen width -->
			<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<!-- Bootstrap 3.3.7 -->
			<link rel="stylesheet" href="'.base_url('assets/css/bootstrap.min.css').'">
			<link rel="stylesheet" href="'.base_url('assets/fontawsome/css/all.css').'">
			<link rel="stylesheet" href="'.base_url('assets/css/font.css').'">
			<link rel="stylesheet" href="'.base_url('assets/fontawsome/css/all.css').'">
			<link rel="stylesheet" href="'.base_url('assets/css/font.css').'">
			<link rel="stylesheet" href="'.base_url('assets/css/animate.css').'">
			<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">


			<script src="'.base_url('assets/js/jquery-3.3.1.min.js').'"></script>
			<script src="'.base_url('assets/js/bootstrap.min.js').'"></script>
			<script src="'.base_url('assets/js/bootstrap.bundle.min.js').'"></script>
			<script src="'.base_url('assets/js/bootstrap.bundle.min.js').'"></script>
		</head>

		<body >
			
			<div class="container">
				<div class="row">
					<div class="col-5">
						
					</div>
					<div class="col-7 text-center">
						<h5 class="text-uppercase font-weight-bold text-danger">'.$company_info['company_name'].'/h5>
						<h5 class="text-uppercase font-weight-bold text-danger">'.$company_info['address'].'</h5>
						<p class="font-weight-bold text-danger">'.$company_info['phone'].'</p>
						<!--<p class="font-weight-bold text-danger">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>-->
					</div>
				</div>
				<hr id="hr1">
				<div class="row">
					<div class="col-6">
						<div class="row">
							<div class="col-6">
								'.$this->Barcode($patient['patientID']).'<br>
								<p>Patient ID: </p>
								<p>Name: </p>
								<p>Navy Id: </p>
								<p>Category/Rank/Relation: </p>
							</div>

							<div class="col-6">
								<br><br>
								<p>'.$patient['patientID'].'</p>
								<p>'.$patient['name'].'</p>
								<p>'.$patient['navyID'].'</p>
								<p>'.$category['name'].'$nbsp;$nbsp;||$nbsp;$nbsp;'.$rank['name'].'$nbsp;$nbsp;||$nbsp;$nbsp;'.$relationship['name'].' </p>
								<p>Department: '.$department['name'].'</p>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="row">
							<div class="col-6">
								'.$this->Barcode($pres['code']).'<br>
								<p>Prescription Id:</p>
								<P>Visit Date & Time:</P>
								<p>Gender:</p>
								<p>Age:</p>
							</div>';
							$gender = ($patient['gender']==1) ? 'Male':'Female';

							$html .='
							<div class="col-6">
								<br><br>
								<p>'.$pres['code'].'</p>
								<p>'.date('d/m/y h:i a', $pres['dateTime']).'</p>
								<p>'.$gender.'</p>
								<p>'.$patient['age'].'</p>
							</div>
						</div>
					</div>
				</div>
				<hr id="hr2">
				<div class="row">
					<div class="col-6">
						<!-- First Part -->
						<p class="font-weight-bold">Cheif Complaint</p>
						<span>'.$pres['complaint'].'</span><br><br>
						
						<!-- 2nd Part -->
						<p class="font-weight-bold">Exmination Findings</p>
						<span>'.$pres['examination'].'</span><br><br>
						<!-- 3Rd Part -->
						<p class="font-weight-bold">Investigation</p>
						<span>'.$pres['investigation'].'</span><br><br>
						<!-- 4th Part -->
						<p class="font-weight-bold">Clinical Diagnosis</p>
						<span>'.$pres['diagnosis'].'</span><br><br>
						<!-- 5th Part -->
						<p class="font-weight-bold">Advice</p>
						<span>'.$pres['advice'].'</span><br><br>
					</div>
					<div class="col-1">
						<hr id="vr">
					</div>
					<div class="col-5">
						<span class="font-weight-bold">Rx:</span><br>
						<p class="ml-5">
							<span class="">'.$pres['advice'].'</span>
							<!--<span class="">1. NAPA EXTRA TAH.</span>
							<span class="font-weight-bold">1-0-1 Day after Meal -(Qty : 14)</span><br><br>
							<span class="">2. CAMERON.</span>
							<span class="font-weight-bold">1-1-1 Day before Meal -(Qty : 14)</span><br>-->
						</p>
					</div>
				</div>
			</div>
		</body>
		<footer class="page-footer text-center mt-5">
			<div class="footer-copyright text-center">©'.date('Y').' Copyright : SoftSource, Bangladesh. Mob: 01818105488</div>
		</footer>
	</html>';
	

		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		//$this->dompdf->output("".$patient['name'].$pres['code'].".pdf", "D");
		$this->dompdf->stream("".$patient['name'].$pres['code'].".pdf", array("Attachment"=>0));
	}



	public function Barcode($value)
	{
		require "vendor/autoload.php";
		//$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		// $code= $generator->getBarcode($value, $generator::TYPE_CODE_128);
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		return '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($value, $generator::TYPE_CODE_128)) . '">';

		// return $code;
	}


}
