<?php
class ahp_model extends CI_Model {

    
	public function getAll()
	{
		$data = $this->db->query("SELECT * from kriteria_bansos");
		return $data->result();
	}
        
}