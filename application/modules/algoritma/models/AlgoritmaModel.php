<?php
class AlgoritmaModel extends CI_Model {

    
	public function getAll()
	{
		$data = $this->db->query("SELECT * from algoritma");
		return $data->result();
	}
        
}