<?php

class Model_chat extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getReceiverChatHistory($receiver_id)
	{
		$sender_id = $this->session->userdata('id');

		$sql = "SELECT * FROM chat WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)";
		$query = $this->db->query($sql, array($sender_id, $receiver_id, $receiver_id, $sender_id));
		return $query->result_array();
	}

	public function SendTxtMessage($data = array())
	{
		if($data) {
			$create = $this->db->insert('chat', $data);
			return ($create == true) ? true : false;
		}
	}


	public function getUnseenMessagesByAppointment($docID, $appointID)
	{	
		$patID = $this->session->userdata('id');

		if($appointID) {
			$sql = "SELECT * FROM chat WHERE sender_id=? AND receiver_id=?  AND appointmentID=? AND seen =?";
			$query = $this->db->query($sql, array($docID, $patID, $appointID,0));
			return $query->num_rows();
		}
	}



	public function prescribe($id, $data = array())
	{	
		$insert = $this->db->insert('prescriptions', $data);
		$visit_id = $this->db->insert_id();
			
		$this->db->where('id', $id);
		$this->db->update('patientserial', array('visited' => 1));
		
		return ($visit_id) ? $visit_id : false;
	}

}