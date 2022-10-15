<?php
require_once realpath(__DIR__ . '/../../../helpers/create_id.php');
class kriteriaa_model extends CI_Model
{

    public function getAll()
    {
        $data = $this->db->query("SELECT * from kriteria_bansos LEFT JOIN kriteria ON kriteria_bansos.id_kriteria = kriteria.id_kriteria");
        return $data->result();
    }

    public function update($attributes)
    {
        extract($attributes);

        // Insert Kriteria
        $set_kriteria = [
            "nama_kriteria" => $nama_kriteria,
        ];
        $this->db->update("kriteria", $set_kriteria, ["id_kriteria" => $id_kriteria], 1);

        // Insert kriteria_bansos
        $kriteria_bansos = [
            "id_kriteria" => $id_kriteria,
            "tipe_kriteria" => $tipe_kriteria,
            "nilai_bobot" => $nilai_bobot,
            "id_bansos" => $id_bansos,
            "id_kategori_bansos" => $id_kategori_bansos,
        ];
        $this->db->update("kriteria_bansos", $kriteria_bansos, ["id_kriteria_bansos" => $id_kriteria_bansos]);

        return [
            "kriteria" => $kriteria,
            "kriteria_bansos" => $kriteria_bansos
        ];
    }

    public function add_criteria($attributes)
    {
        extract($attributes);

        // Insert Kriteria
        $kriteria = [
            "id_kriteria" => CreateId::init($this->db, "C", "kriteria"),
            "nama_kriteria" => $nama_kriteria,
        ];
        $this->db->insert("kriteria", $kriteria);

        // Insert kriteria_bansos
        $kriteria_bansos = [
            "id_kriteria_bansos" => CreateId::init($this->db, "CBS", "kriteria_bansos"),
            "id_kriteria" => $kriteria["id_kriteria"],
            "tipe_kriteria" => $tipe_kriteria,
            "id_bansos" => $id_bansos,
            "id_kategori_bansos" => $id_kategori_bansos,
        ];
        $this->db->insert("kriteria_bansos", $kriteria_bansos);

        return [
            "kriteria" => $kriteria,
            "kriteria_bansos" => $kriteria_bansos
        ];
    }
}
