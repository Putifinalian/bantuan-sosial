<?php
class EdasModel extends CI_Model {

    
	public function getAll()
	{
		$data = $this->db->query("SELECT * from data_penerima_bansos");
		return $data->result();
	}
        
}