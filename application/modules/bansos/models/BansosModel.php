<?php
require_once realpath(__DIR__ . '/../../../helpers/create_id.php');
class BansosModel extends CI_Model {

    public function getBansos()
	{
		$data = $this->db->query("SELECT * from bansos");
		return $data->result();
	}

	public function bansos(){
		$query = $this->db->bansos('bansos');
		return $query->result_array();
	}

	function add_bansos($attributes) {
        $attributes["id_bansos"] = CreateId::init($this->db, "BANSOS", "bansos");
		$this->db->insert('bansos', $attributes);
		return TRUE;
	}

    public function create_id($prefix = "BANSOS", $table = "bansos")
    {
        $last_id = strval($this->db->count_all($table) + 1);
        $new_id = $last_id;
        for ($i = 1; $i <= 6; $i++) {
            $new_id = "0$new_id";
            if (strlen($new_id) >= 4) break;
        }
        return $prefix . $new_id;
    }

	// function ubah($data){
	// 	$this->db->where('id_bansos',$id_bansos);
    // 	$this->db->update('bansos', $data);
    // 	return TRUE;
	// }

}
