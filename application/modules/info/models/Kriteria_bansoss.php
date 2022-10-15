<?php
require_once realpath(__DIR__ . '/../../../helpers/create_id.php');

class Kriteria_bansos extends CI_Model
{
    function tambah_kriteria_bansos($attributes)
    { 
        $attributes["id_kriteria_bansos"] = CreateId::init($this->db, "CBS", "kriteria_bansos");
        extract($attributes);
        $result = $this->db->query("SELECT * FROM kriteria_bansos WHERE id_bansos='$id_bansos' AND id_kriteria='$id_kriteria' LIMIT 1")->row();

        if (!$result) {
            $this->db->insert('kriteria_bansos', $attributes);
            return $attributes;
        }
        return $result;
    }
}
