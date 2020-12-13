<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		//Using the base
		$this->not_logged_in();

		//$this->data['page_title'] = 'Patient';
	}

	public function index($appoinmentID){
		$this->data['appoinments'] = $appoinments = $this->model_doctors->getAllAppontmentData($appoinmentID);
		$this->data['department'] = $this->model_department->getDepartmentData($appoinments['departmentID']);
		if ($this->session->userdata('group')==4) {
			
			$this->data['receiver']=   $this->model_doctors->getDoctorFullDetails($appoinments['doctorID']);
		}
		elseif ($this->session->userdata('group')==3) {
			$this->data['receiver']=   $this->model_patient->getPatientFullDetails($appoinments['pateintID']);
		}
		$this->data['title'] = 'Chat';


		$this->render_template('pages/chat/chatpage' , $this->data);
	}


	public function fetchChatHistory($recvrID)
	{	
		$loggedINUser = $this->session->userdata('id');
		$html='';
		$chathistory = $this->model_chat->getReceiverChatHistory($recvrID);

		foreach ($chathistory as $key => $value) {
			$this->db->where('id', $value['id']);
			$this->db->update('chat', array('seen' => 1));

			if($value['sender_id'] == $recvrID){
				if($value['message'] != 'NULL'){
					$html.='<div class="block">
								<i class="fas fa-user-circle fa-2x"></i>
									<p>'.$value['message'].'</p>
									<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
								</div>';
				}
				else{
					$attachment_name = $value['attachment_name'];
					$file_ext = $value['file_ext'];
					$mime_type = explode('/',$value['mime_type']);
					$document_url = base_url().$value['attachment_path'];
							
					if($mime_type[0]=='image'){
						$html.= '<div class="block">
									<i class="fas fa-user-circle fa-2x"></i>
									<p><img  style="display: block;margin-left: auto;margin-right: auto;width: 50%;" src="'.$document_url.'" onClick="ViewAttachmentImage('."'".$document_url."'".','."'".$attachment_name."'".');" class="attachmentImgCls mt-2"></p>
									<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
								</div>';
					}
					else{
						$html.= '<div class="block">
									<i class="fas fa-user-circle fa-2x"></i>
									<h4>Attachments:</h4>
									<p class="ml-5">'.$attachment_name.'</p>
									<a download href="'.$document_url.'"><button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm btn-flat btnFileOpen ml-5">Open</button></a>
									<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
								</div>';
					}
				}
			}
			else{
				if($value['message'] != 'NULL'){
					$html.='<div class="block darker text-left">
								<i class="fas fa-user-circle fa-2x float-right"></i>
								<p class="ml-2">'.$value['message'].'</p>
								<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
							</div>';
				}
				else{
					$attachment_name = $value['attachment_name'];
					$file_ext = $value['file_ext'];
					$mime_type = explode('/',$value['mime_type']);
					$document_url = base_url().$value['attachment_path'];
					
					if($mime_type[0]=='image'){
						$html.='<div class="block darker text-left">
									<i class="fas fa-user-circle fa-2x float-right"></i>
									<p><img style="display: block;margin-left: auto;margin-right: auto;width: 50%;" src="'.$document_url.'" onClick="ViewAttachmentImage('."'".$document_url."'".','."'".$attachment_name."'".');" class="attachmentImgCls mt-2"></p>
									<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
								</div>';
					}
					else{
						$html.= '<div class="block darker text-left">
									<h4>Attachments:</h4>
									<p class="ml-5">'.$attachment_name.'</p>
									<a download href="'.$document_url.'"><button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm btn-flat btnFileOpen ml-5">Open</button></a>
									<span class="float-right">'.date('d/m/y h:i a', $value['message_date_time']).'</span>
							</div>';
					}
				}
			}
		}

		echo($html);
	}



	public function send_text_message(){
		$post = $this->input->post();
		$messageTxt='NULL';
		$attachment_name='';
		$file_ext='';
		$mime_type='';
		$path='';
		if(isset($post['type'])=='Attachment'){ 
		 	$AttachmentData = $this->ChatAttachmentUpload();
			//print_r($AttachmentData);
			$attachment_name = $AttachmentData['file_name'];
			$file_ext = $AttachmentData['file_ext'];
			$mime_type = $AttachmentData['file_type'];
			$path = 'assets/attachment/'.$AttachmentData['file_name'];
			 
		}else{
			$messageTxt = reduce_multiples($post['messageTxt'],' ');
		}	
		 
				$data=[
 					'sender_id' => $this->session->userdata['id'],
					'receiver_id' => $post['receiver_id'],
					'message' =>   $messageTxt,
					'attachment_name' => $attachment_name,
					'attachment_path' => $path,
					'file_ext' => $file_ext,
					'mime_type' => $mime_type,
					'message_date_time' => strtotime(date('Y-m-d h:i:s a')), //23 Jan 2:05 pm
					'ip_address' => $this->input->ip_address(),
					'appointmentID' => $post['appointID'],
				];
		  
 				$query = $this->model_chat->SendTxtMessage($data); 
 				$response='';
				if($query == true){
					$response = ['status' => 1 ,'message' => '' ];
				}else{
					$response = ['status' => 0 ,'message' => 'sorry we re having some technical problems. please try again !' 						];
				}
             
 		   echo json_encode($response);
	}


	public function ChatAttachmentUpload(){
		 
		
		$file_data='';
		if(isset($_FILES['attachmentfile']['name']) && !empty($_FILES['attachmentfile']['name'])){	
				$config['upload_path']          = 'assets/attachment';
				$config['allowed_types']        = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
        		
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('attachmentfile'))
				{
					echo json_encode(['status' => 0,
					'message' => '<span style="color:#900;">'.$this->upload->display_errors(). '<span>' ]);
					die;
				}
				else
				{
					$file_data = $this->upload->data();
					//$filePath = $file_data['file_name'];
					return $file_data;
				}
		    }
 		 
	}


	public function prescribe()
	{	
		$id=$this->input->post('id');
		$user_id = $this->session->userdata('id');
		$department_id = $this->session->userdata('department');


		$billString = 'P'.date('y').date('m').date('d');
		$this->db->select('*');
		$this->db->like('code', $billString);
		$query = $this->db->get('prescriptions');
		$regNoId= $query->num_rows();
		if ($regNoId == 0)
            {
                $regno = $billString.'0001';
            }
            else
            {
                if ($regNoId >= 1 && $regNoId < 9)
                {
                    $temp =$regNoId + 1;
                    $regno = $billString.'000'.(string)$temp;
                }
                else if ($regNoId >= 9 && $regNoId < 99)
                {
                    $temp = $regNoId + 1;
                    $regno =$billString.'00'.(string)$temp;
                }
				else if ($regNoId >= 99 && $regNoId < 999)
                {
                    $temp = $regNoId + 1;
                    $regno = $billString.'0'.(string)$temp;
                }
                else
                {
                    $regno = $billString.(string)($regNoId+1);
                }
            }
			$bill_no = $regno;
			//$insert_id=$this->input->post('diseaseID');

			$data = array(
				'appointmentID' => $id,
				'code'          => $regno,
				'medicines'     => $this->input->post('medicine'),
				'complaint'     => $this->input->post('complaint'),
				'examination'   => $this->input->post('examination'),
				'investigation' => $this->input->post('investigation'),
				'diagnosis'     => $this->input->post('diagnosis'),
				'advice'        => $this->input->post('advice'),
				'dateTime'      => strtotime(date('Y-m-d h:i:s a')),
				'doctorID'      => $user_id,
	    	);

		$prescribe = $this->model_chat->prescribe($id, $data);
		if($prescribe) {
        	$decision = $this->pdfPrescription($id);

        	if($decision == true){
					$response = ['status' => 1 ,'message' => '' ];
			}else{
				$response = ['status' => 0 ,'message' => 'sorry we re having some technical problems. please try again !' 						];
			}
             
        }
        else {
        	
        	$response = ['status' => 0 ,'message' => 'sorry we re having some technical problems. please try again !' 						];
        }

 		   echo json_encode($response);

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

							$html .='<div class="col-6">
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
				
				<div class="row">
					<div class="col-4"></div>

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
		
		$attachment_name = $patient['name'].$pres['code'].".pdf";
		$file_ext = 'pdf';
		$mime_type = 'application/pdf';
		$path = 'assets/attachment/'.$attachment_name;


		$output = $this->dompdf->output();
		file_put_contents($path , $output);


		$data=[
 				'sender_id' => $this->session->userdata['id'],
				'receiver_id' => $appointments['pateintID'],
				'message' =>   'NULL',
				'attachment_name' => $attachment_name,
				'attachment_path' => $path,
				'file_ext' => $file_ext,
				'mime_type' => $mime_type,
				'message_date_time' => strtotime(date('Y-m-d h:i:s a')), //23 Jan 2:05 pm
				'ip_address' => $this->input->ip_address(),
				'appointmentID' => $id,
			];
		  
 			$query = $this->model_chat->SendTxtMessage($data); 
 			return $query;
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