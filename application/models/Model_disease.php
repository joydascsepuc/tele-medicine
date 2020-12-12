<?php

class Model_disease extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('model_users');
		$this->load->library('cart');
	}

	/* get the product data */
	public function getDiseaseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM disease where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}


			$sql = "SELECT * FROM disease ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();

	}

	/* get the product data */


		public function getDiseaseMedicine($disease){

			$sql = "SELECT * FROM diseasemedicine  WHERE diseaseID= ?";
			$query = $this->db->query($sql, array($disease));
			return $query->result_array();

		}

		public function getPackagebyDisease($pro_id = null){
			if($pro_id) {
			$sql = "SELECT * FROM stock_insert  WHERE productId	 = ? AND remainQty <> ? ORDER BY date ASC";
			$query = $this->db->query($sql, array($pro_id, 0));
			return $query->row_array();
		}
		}

	public function getActiveDiseaseData()
	{
		$user_id = $this->session->userdata('id');

		if($user_id == 1) {
			$sql = "SELECT * FROM disease WHERE active = ? ORDER BY name ASC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM disease WHERE active = ? ORDER BY name ASC";
			$query = $this->db->query($sql, array(1));

			$data = array();
			foreach ($query->result_array() as $k => $v) {
				/* $store_ids = json_decode($v['store_id']);
				if(in_array($user_data['store_id'], $store_ids)) { */
					$data[] = $v;
				//}
			}

			return $data;
		}


	}


	public function getActiveDiseaseWithCategory()
	{

			$sql = "SELECT disease.id as product_id, disease.name as product_name,  disease.category_id as category_id, disease.availableQuantity AS availableQuantity, disease.reorderLevel AS reorderLevel,disease.wreckNumber AS wreckNumber,disease.price AS price,category.name as category_name, generic.name as generic_name
			FROM disease JOIN category ON disease.category_id=category.id JOIN generic ON disease.generic_id=generic.id WHERE disease.active= ? ORDER BY disease.name ASC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();

	}

	public function getActiveDiseaseWithSubCategory()
	{

			$sql = "SELECT disease.id as product_id, disease.name as product_name, disease.category_id as category_id, disease.availableQuantity AS availableQuantity, disease.reorderLevel AS reorderLevel,disease.price AS price, category.name as subCatName
			FROM disease JOIN category ON disease.subCat_ID=category.id WHERE disease.active= ? ORDER BY disease.name ASC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();

	}

	public function create()
		{

			$data = array(
				'name' => $this->input->post('disease_name'),
				'complaint' => ($this->input->post('complaintID')),
				'examination' => ($this->input->post('examinationID')),
				'investigation' => ($this->input->post('investigationID')),
				'diagnosis' => ($this->input->post('diagnosisID')),
				'advice' => ($this->input->post('adviceID')),
				'cause' => $this->input->post('cause'),
			);

			$insert = $this->db->insert('disease', $data);
			$insert_id = $this->db->insert_id();

			$carts =  $this->cart->contents();
			foreach($carts as $key => $cart){
				$in_data = array(
				'diseaseID' => $insert_id,
				'medicineID' => $cart['id'],
				'instruction' => $cart['instruction'],
				'instruction2' => $cart['instruction2'],
				'day' => $cart['day'],
				'amount' => $cart['amount'],
			);
			$this->db->insert('diseasemedicine', $in_data);
}
			return ($insert_id) ? true : false;

	}

	public function update($id)
	{
		if($id) {
			$data = array(
				'name' => $this->input->post('disease_name'),
				'complaint' => ($this->input->post('complaintID')),
				'examination' => ($this->input->post('examinationID')),
				'investigation' => ($this->input->post('investigationID')),
				'diagnosis' => ($this->input->post('diagnosisID')),
				'advice' => ($this->input->post('adviceID')),
				'cause' => $this->input->post('cause'),
			);

			$this->db->where('id', $id);
			$update = $this->db->update('disease', $data);

			$this->db->where('diseaseID', $id);
			$this->db->delete('diseasemedicine');

			$carts =  $this->cart->contents();
			foreach($carts as $key => $cart){
				$in_data = array(
				'diseaseID' => $id,
				'medicineID' => $cart['id'],
				'instruction' => $cart['instruction'],
				'instruction2' => $cart['instruction2'],
				'day' => $cart['day'],
				'amount' => $cart['amount'],
			);
			$this->db->insert('diseasemedicine', $in_data);
		}
			return ($update == true) ? true : false;
	}
}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('disease');

			$this->db->where('diseaseID', $id);
			$this->db->delete('diseasemedicine');
			return ($delete == true) ? true : false;
		}
	}



	public function countTotalDisease()
	{
		$sql = "SELECT * FROM disease";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getDiseaseForSearch($search='')
	{
		if($search)
		{
			$sql = "SELECT * FROM  disease WHERE name LIKE '$search%' ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}










}
