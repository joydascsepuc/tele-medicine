<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Disease extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->data['title'] = 'Diseases';

	}

    /*
    * It only redirects to the manage product page
    */
	public function index()
	{
		// if(!in_array('viewDisease', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$this->render_template('pages/disease/index', $this->data);
	}

	

	public function fetchGenericForSearch()
	{
		$search = $this->input->post('search');
		$disease = $this->model_generic->getGenericForSearch($search);
		$html= '<ul class="list-group prothom">';
		if (count($disease)>0) {
			foreach ($disease as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
 		 }
		}

		$html.= '</ul>';
		echo ($html);
	}

	public function fetchGeneric()
	{
		$genID = $this->input->post('genID');
		$gen = $this->model_generic->getGenericData($genID);
		echo json_encode($gen);
	}


    /*
    * It Fetches the disease data from the product table
    * this function is called from the datatable ajax function
    */
	public function fetchDiseaseData()
	{

		$result = array('data' => array());

		$data = $this->model_disease->getDiseaseData();

		foreach ($data as $key => $value) {
			// button
			$complaint_name = array();
			if ($value['complaint']!='') {
				$complaint_ids = explode(',',$value['complaint']);

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
			if ($value['examination']!='') {
				$examination_ids = explode(',',$value['examination']);

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
			if ($value['diagnosis']!='') {
				$diagnosis_ids = explode(',',$value['diagnosis']);
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
			if ($value['investigation']!='') {
				$investigation_ids = explode(',',$value['investigation']);

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
			if ($value['advice']!='') {
				$Advice_ids = explode(',',$value['advice']);

				foreach ($Advice_ids as $k => $v) {
						$Advice_data = $this->model_advice->getAdviceData($v);
						$Advice_name[] = $Advice_data['name'];
				}
				$Advice_name = implode(', ', $Advice_name);
			}
			else {
				$Advice_name='';
			}



            $buttons = '';
						if(in_array('updateDisease', $this->permission)) {
    			$buttons .= '<a href="'.base_url('editdisease/'.$value['id']).'" class="btn btn-default"><i class="far fa-edit"></i></a>';
				}
				if(in_array('deleteDisease', $this->permission)) {
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
				}

			$result['data'][$key] = array(

				$value['name'],
				$complaint_name,
				$examination_name,
				$diagnosis_name,
				$investigation_name,
				$Advice_name,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

    /*
    * view the product based on the store
    * the admin can view all the product information
    */
    public function viewproduct()
    {
        // if(!in_array('viewDisease', $this->permission)) {
        //     redirect('dashboard','refresh');
        // }

        $company_currency = $this->company_currency();
        // get all the category
        $category_data = $this->model_category->getChildCategoryData();

        $result = array();

        foreach ($category_data as $k => $v) {
            $result[$k]['category'] = $v;
            $result[$k]['disease'] = $this->model_disease->getDiseaseBySubCat($v['id']);
        }

        // based on the category get all the disease

        $html = '<!-- Main content -->
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <meta charset="utf-8">
                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                      <title>Disease List</title>
                      <!-- Tell the browser to be responsive to screen width -->
                      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                      <!-- Bootstrap 3.3.7 -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
                      <!-- Font Awesome -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
                      <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
                    </head>
                    <body>

                    <div class="wrapper">
                      <section class="invoice">

                        <div class="row">
                        ';
                            foreach ($result as $k => $v) {
                                $html .= '<div class="col-md-6">
                                    <div class="product-info">
                                        <div class="category-title">
                                            <h1>'.$v['category']['name'].'</h1>
                                        </div>';

                                        if(count($v['disease']) > 0) {
                                            foreach ($v['disease'] as $p_key => $p_value) {
                                                $html .= '<div class="product-detail">
                                                            <div class="product-name" style="display:inline-block;">
                                                                <h5>'.$p_value['name'].'</h5>
                                                            </div>
                                                            <div class="product-price" style="display:inline-block;float:right;">
                                                                <h5>'.$company_currency . ' '.$p_value['price'].'</h5>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                        else {
                                            $html .= 'N/A';
                                        }
                                    $html .='</div>

                                </div>';
                            }


                        $html .='
                        </div>
                      </section>
                      <!-- /.content -->
                    </div>
                </body>
            </html>';

                      echo $html;
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		// if(!in_array('createDisease', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		$this->form_validation->set_rules('disease_name', 'Disease name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
        	$create = $this->model_disease->create();
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('diseasehome', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('newdisease', 'refresh');
        	}
        }
        else {
           
			$this->cart->destroy();
			$this->data['diagnosis'] = $this->model_diagnosis->getActiveDiagnosis();
			$this->data['examination'] = $this->model_examination->getActiveExamination();
			$this->data['complaint'] = $this->model_complaint->getActiveComplaint();
			$this->data['investigation'] = $this->model_investigation->getActiveInvestigation();
			$this->data['advice'] = $this->model_advice->getActiveAdvice();
			$this->data['medicine'] = $this->model_medicine->getActiveMedicine();
            $this->render_template('pages/disease/create', $this->data);
        }
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */


    /*
    * If the validation is not valid, then it redirects to the edit product page
    * If the validation is successfully then it updates the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function edit($product_id=null)
	{
		// if(!in_array('updateDisease', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
        // if(!$product_id) {
        //     redirect('dashboard', 'refresh');
        // }

        if($product_id) {
            
	        $this->form_validation->set_rules('disease_name', 'Disease name', 'trim|required');

	        if ($this->form_validation->run() == TRUE) {
	            // true case

	            $update = $this->model_disease->update($product_id);
	            if($update == true) {
	                $this->session->set_flashdata('success', 'Successfully updated');
	                redirect('diseasehome', 'refresh');
	            }
	            else {
	                $this->session->set_flashdata('errors', 'Error occurred!!');
	                redirect('editdisease/'.$product_id, 'refresh');
	            }
	        }
	        else {
						$this->cart->destroy();
						$this->data['diagnosis'] = $this->model_diagnosis->getActiveDiagnosis();
						$this->data['examination'] = $this->model_examination->getActiveExamination();
						$this->data['complaint'] = $this->model_complaint->getActiveComplaint();
						$this->data['investigation'] = $this->model_investigation->getActiveInvestigation();
						$this->data['advice'] = $this->model_advice->getActiveAdvice();
						$this->data['medicine'] = $this->model_medicine->getActiveMedicine();
						$disease = $this->model_disease->getDiseaseData($product_id);
						$diseaseMedicine = $this->model_disease->getDiseaseMedicine($product_id);
	          			$this->data['disease'] = $disease;


						foreach ($diseaseMedicine as $key => $value) {
							$medicine = $this->model_medicine->getMedicineData($value['medicineID']);
							//$ins=$this->model_medicine->getDosesData($value['instruction']);

							$data = array(
								'id'          => $value['medicineID'],
								'qty'         => 1,
								'price'       => 0,
								'instruction' => $value['instruction'],
								'instruction2' => $value['instruction2'],
								'name'        => $medicine['name'],
								'day'         => $value['day'],
								'amount'      => $value['amount'],
							);
							$this->cart->insert($data);
						}
						$this->data['cart']=$this->cart->contents();

	          $this->render_template('pages/disease/edit', $this->data);
	        }
    	}
	}


    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        // if(!in_array('deleteDisease', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_disease->remove($product_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}


	public function getDiseaseValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_disease->getDiseaseData($product_id);
			echo json_encode($product_data);
		}
	}

	public function newComplaint()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('comp_name'),
						'active' => 1,
        	);

					if ($this->input->post('comp_id')!="" && $this->input->post('comp_name')!="") {
						$update = $this->model_complaint->update($this->input->post('comp_id'),$data);
					}
					elseif ($this->input->post('comp_id')=="" && $this->input->post('comp_name')!=""){
						$create = $this->model_complaint->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        				$response['id'] = $this->input->post('comp_id');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function newExamination()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('examination_name'),
						'active' => 1,
        	);

					if ($this->input->post('examination_id')!="" && $this->input->post('examination_name')!="") {
						$update = $this->model_examination->update($this->input->post('examination_id'),$data);
					}
					elseif ($this->input->post('examination_id')=="" && $this->input->post('examination_name')!="") {
						$create = $this->model_examination->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        		$response['id'] = $this->input->post('examination_id');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function newDiagnosis()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('diagnosis_name'),
						'active' => 1,
        	);

					if ($this->input->post('diagnosis_id')!="" && $this->input->post('diagnosis_name')!="") {
						$update = $this->model_diagnosis->update($this->input->post('diagnosis_id'),$data);
					}
					elseif ($this->input->post('diagnosis_id')=="" && $this->input->post('diagnosis_name')!="") {
						$create = $this->model_diagnosis->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        		$response['id'] = $this->input->post('diagnosis_id');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function newInvestigation()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('investigation_name'),
						'active' => 1,
        	);

					if ($this->input->post('investigation_id')!="" && $this->input->post('investigation_name')!="") {
						$update = $this->model_investigation->update($this->input->post('investigation_id'),$data);
					}
					elseif ($this->input->post('investigation_id')=="" && $this->input->post('investigation_name')!="") {
						$create = $this->model_investigation->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        		$response['id'] = $this->input->post('investigation_id');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function newAdvice()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('advice_name'),
						'description' => '',
						'active' => 1,
        	);

					if ($this->input->post('advice_id')!="" && $this->input->post('advice_name')!="") {
						$update = $this->model_advice->update($this->input->post('advice_id'),$data);
					}
					elseif ($this->input->post('advice_id')=="" && $this->input->post('advice_name')!="") {
						$create = $this->model_advice->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        		$response['id'] = $this->input->post('advice_id');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function newMedicine()
	{
		$response = array();
		$create=0;$update;
        	$data = array(
						'name' => $this->input->post('medicine'),
						//'pharmaMedi' => $this->input->post('pharmacyMed'),
						'active' => 1,
        	);

					if ($this->input->post('medicineID')!="" && $this->input->post('medicine')!="") {
						$update = $this->model_medicine->update($this->input->post('medicineID'),$data);
					}
					elseif ($this->input->post('medicineID')=="" && $this->input->post('medicine')!="") {
						$create = $this->model_medicine->create2($data);
					}

        	if($create !=0) {
        		$response['success'] = true;
        		$response['id'] = $create;
        	}
					elseif ($update==true) {
						$response['success'] = true;
        				$response['id'] = $this->input->post('medicineID');
					}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        echo json_encode($response);
	}

	public function fetchMedicineForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getMedicineForSearch($search);
		$result = array();
		if (count($products)>0) {
			$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				// $result[] = array("label"=>$value['name']);
 		 	}
			$html.= '</ul>';
			echo json_encode($html);
		}
		else{
			$html='Nothing Found';
		}
	}

	public function fetchMedicine()
	{
		$genID = $this->input->post('genID');
		$gen = $this->model_medicine->getMedicineData($genID);
		echo json_encode($gen);
	}
	public function fetchDoses()
	{
		$genID = $this->input->post('genID');

		$gen = $this->model_medicine->getDosesData($genID);
		echo json_encode($gen);
	}

	public function fetchInstructions()
	{
		$genID = $this->input->post('genID');

		$gen = $this->model_medicine->getInstructionData($genID);
		echo json_encode($gen);
	}

	public function fetchDays()
	{
		$genID = $this->input->post('genID');

		$gen = $this->model_medicine->getDaysData($genID);
		echo json_encode($gen);
	}

	public function fetchAmount()
	{
		$genID = $this->input->post('genID');

		$gen = $this->model_medicine->getAmountData($genID);
		echo json_encode($gen);
	}

	public function fetchComplaintForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_complaint->getComplaintForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-group prothom" id="com">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['id'].'">'.$value['name'].'</li>';
 		 }
		$html.= '</ul>';
		echo ($html);
 		 
		}

	}

	public function fetchDosesForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getDosesForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-group prothom" id="instruct">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['id'].'">'.$value['doses'].'</li>';
 		 }
		$html.= '</ul>';
		echo ($html);
		
		}

	}

	public function fetchInstructionForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getInstructionForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-group prothom" id="instruct2">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['id'].'">'.$value['instruction'].'</li>';
 		 }
		$html.= '</ul>';
		echo ($html);
		
		}

	}


	public function fetchDayForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getDayForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-group prothom" id="dayUL">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['day'].'">'.$value['day'].'</li>';
 		 }
		$html.= '</ul>';
		echo ($html);
		
		}

	}

	public function fetchAmountForSearch()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getAmountForSearch($search);
		if (count($products)>0) {
		$html= '<ul class="list-group prothom" id="amountUL">';

			foreach ($products as $key => $value) {
 		 		$html.= '<li class="list-group-item" id="'.$value['amount'].'">'.$value['amount'].'</li>';
 		 }
		$html.= '</ul>';
		echo ($html);
		
		}

	}


	public function fetchComplaintWithTable()
	{
		//$search = $this->input->post('search');
		$complaint = $this->model_complaint->getComplaintDataForTable();
		$html= '<table id="complaintTable" border="1">';
		if (count($complaint)>0) {
			foreach ($complaint as $key => $value) {
				if ($key%5==0) {
					$html.='<tr></tr>';
				}
				$html.='<td>
					<input name="complaintName" type="checkbox" id="'.$value['id'].'" value="'.$value["name"].'" ondblclick="complaintDblClick('.$value['id'].');" onclick="complaintClick('.$value['id'].');" />'.$value["name"].'
				</td>';
 		 }
		 $html.= '<tr class="notfound" style="display:none">
                             <td colspan="5">No record found</td>
                           </tr>
		 <table>';
		}


		echo ($html);
	}

	public function fetchExaminationWithTable()
	{
		//$search = $this->input->post('search');
		$complaint = $this->model_examination->getExaminationDataForTable();
		$html= '<table id="examinationTable" border="1">';
		if (count($complaint)>0) {
			foreach ($complaint as $key => $value) {
				if ($key%5==0) {
					$html.='<tr></tr>';
				}
				$html.='<td>
					<input name="examinationName" type="checkbox" id="'.$value['id'].'" value="'.$value["name"].'" onclick="examinationClick('.$value['id'].');" ondblclick="examinationDblClick('.$value['id'].');" />'.$value["name"].'
				</td>';
 		 }
		 $html.= '<tr class="notfound" style="display:none">
                             <td colspan="5">No record found</td>
                           </tr>
		 <table>';
		}
		echo ($html);
	}

	public function fetchDiagnosisWithTable()
	{
		//$search = $this->input->post('search');
		$complaint = $this->model_diagnosis->getDiagnosisDataForTable();
		$html= '<table id="diagnosisTable" border="1">';
		if (count($complaint)>0) {
			foreach ($complaint as $key => $value) {
				if ($key%5==0) {
					$html.='<tr></tr>';
				}
				$html.='<td>
					<input name="diagnosisName" type="checkbox" id="'.$value['id'].'" value="'.$value["name"].'" ondblclick="diagnosisDblClick('.$value['id'].');" onclick="diagnosisClick('.$value['id'].');"/>'.$value["name"].'
				</td>';
 		 }
		 $html.= '<tr class="notfound" style="display:none">
                             <td colspan="5">No record found</td>
                           </tr>
		 <table>';
		}
		echo ($html);
	}

	public function fetchInvestigationWithTable()
	{
		//$search = $this->input->post('search');
		$complaint = $this->model_investigation->getInvestigationDataForTable();
		$html= '<table id="investigationTable" border="1">';
		if (count($complaint)>0) {
			foreach ($complaint as $key => $value) {
				if ($key%5==0) {
					$html.='<tr></tr>';
				}
				$html.='<td>
					<input name="investigationName" type="checkbox" id="'.$value['id'].'" value="'.$value["name"].'" ondblclick="investigationDblClick('.$value['id'].');" onclick="investigationClick('.$value['id'].');" />'.$value["name"].'
				</td>';
 		 }
		 $html.= '<tr class="notfound" style="display:none">
                             <td colspan="5">No record found</td>
                           </tr>
		 <table>';
		}
		echo ($html);
	}

	public function fetchAdviceWithTable()
	{
		//$search = $this->input->post('search');
		$complaint = $this->model_advice->getAdviceDataForTable();
		$html= '<table id="adviceTable" border="1">';
		if (count($complaint)>0) {
			foreach ($complaint as $key => $value) {
				if ($key%5==0) {
					$html.='<tr></tr>';
				}
				$html.='<td>
					<input name="adviceName" type="checkbox" id="'.$value['id'].'" value="'.$value["name"].'" ondblclick="adviceDblClick('.$value['id'].');" onclick="adviceClick('.$value['id'].');" />'.$value["name"].'
				</td>';
 		 }
		 $html.= '<tr class="notfound" style="display:none">
                             <td colspan="5">No record found</td>
                           </tr>
		 <table>';
		}
		echo ($html);
	}

	public function fetchComplaint()
	{
		$genID = $this->input->post('id');
		$gen = $this->model_complaint->getComplaintData($genID);
		echo json_encode($gen);
	}

	public function fetchExamination()
	{
		$genID = $this->input->post('id');
		$gen = $this->model_examination->getExaminationData($genID);
		echo json_encode($gen);
	}

	public function fetchDiagnosis()
	{
		$genID = $this->input->post('id');
		$gen = $this->model_diagnosis->getDiagnosisData($genID);
		echo json_encode($gen);
	}

	public function fetchInvestigation()
	{
		$genID = $this->input->post('id');
		$gen = $this->model_investigation->getInvestigationData($genID);
		echo json_encode($gen);
	}

	public function fetchAdvice()
	{
		$genID = $this->input->post('id');
		$gen = $this->model_advice->getAdviceData($genID);
		echo json_encode($gen);
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




	public function fetchComplaintForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_complaint->getComplaintForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}


	public function fetchExaminationForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_examination->getExaminationForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}

	public function fetchInvestigationForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_investigation->getInvestigationForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}

	public function fetchDiagnosisForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_diagnosis->getDiagnosisForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}

	public function fetchAdviceForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_advice->getAdviceForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}


	public function fetchMedicineForAutocomplete()
	{
		$search = $this->input->post('search');
		$products = $this->model_medicine->getMedicineForSearch($search);
		$result = array();
		// if (count($products)>0) {
			//$html= '<ul class="list-group prothom" id="medi">';
			// $result[];
			foreach ($products as $key => $value) {
 		 		//$html.= '<li class="list-group-item" id="'.$value['id'].'" >'.$value['name'].'</li>';
				$result[] = array("label"=>$value['name']);
 		 	}
			//$html.= '</ul>';
			echo json_encode($result);
		// }
		// else{
		// 	$html='Nothing Found';
		// }
	}




}
