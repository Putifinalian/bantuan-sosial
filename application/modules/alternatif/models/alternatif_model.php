<?php
require_once realpath(__DIR__ . '/../../../helpers/create_id.php');

class alternatif_model extends CI_Model
{
    public function all()
    {
        // $sql = "SELECT a.id_calon_penerima, a.nama_calon_penerima, a.alamat, a.no_HP, b.id_kriteria, b.data FROM alternatif AS a, data_penerima_bansos AS b WHERE a.id_calon_penerima=b.id_calon_penerima";
        $sql = "SELECT * FROM alternatif AS a, data_penerima_bansos AS b WHERE a.id_calon_penerima=b.id_calon_penerima";
        $filter_id_bansos = $this->input->get("filter_id_bansos");
        $filter_id_kategori_bansos = $this->input->get("filter_id_kategori_bansos");

        if ($filter_id_bansos && $filter_id_bansos != "") {
            $sql .= " AND b.id_bansos='$filter_id_bansos'";
        }
        if ($filter_id_bansos && $filter_id_bansos != "") {
            $sql .= " AND b.id_kategori_bansos='$filter_id_kategori_bansos'";
        }

        $data = $this->db->query($sql);
        return $data->result();
    }

    public function update($attributes)
    {
        extract($attributes);

        $kriterias = $this->db->query("SELECT * from kriteria_bansos LEFT JOIN kriteria ON kriteria_bansos.id_kriteria = kriteria.id_kriteria");
        $kriterias = $kriterias->result();

        // Insert alternatif
        $alternatif = array(
            'nama_calon_penerima' => $nama_calon_penerima,
            'alamat' => $alamat,
            'no_HP' => $no_HP,
        );

        $this->db->update('alternatif', $alternatif, ['id_calon_penerima' => $id_calon_penerima]);

        $data_penerima_bansoss = [];

        $inserted_kriteria = [];
        $this->db->delete("data_penerima_bansos", [
            'id_calon_penerima' => $id_calon_penerima,
        ]);
        foreach ($kriterias as $kriteria) {
            foreach ($attributes as $key => $value) {

                $kriteria_nama_kriteria = $this->snake($kriteria->nama_kriteria);
                $stack = "$kriteria_nama_kriteria-$key";

                if ($kriteria_nama_kriteria == $key && !in_array($stack, $inserted_kriteria)) {
                    array_push($inserted_kriteria, $stack);

                    $data_penerima_bansos = [
                        'data' => $value,
                        'id_bansos' => $id_bansos,
                        'id_kategori_bansos' => $id_kategori_bansos,
                        'id_users' => $this->session->userdata('id_users'),
                    ];
           

                    $id_penerima_bansos = CreateId::init($this->db, "ACC", "data_penerima_bansos", "id_penerima_bansos");
                    $data_penerima_bansos["id_penerima_bansos"] = $id_penerima_bansos;
                    $data_penerima_bansos["id_kriteria"] = $kriteria->id_kriteria;
                    $data_penerima_bansos["id_calon_penerima"] = $id_calon_penerima;
                    $result = $this->db->insert('data_penerima_bansos', $data_penerima_bansos);
                    $data_penerima_bansos["result"] = $result;

                    array_push($data_penerima_bansoss, $data_penerima_bansos);
                }
            }
        }

        return [
            "id_calon_penerima" => $id_calon_penerima,
            "alternatif" => $alternatif,
            "data_penerima_bansoss" => $data_penerima_bansoss,
        ];
    }

    public function store($attributes)
    {
        extract($attributes);

        $kriterias = $this->db->query("SELECT * from kriteria_bansos LEFT JOIN kriteria ON kriteria_bansos.id_kriteria = kriteria.id_kriteria");
        $kriterias = $kriterias->result();

        $id_calon_penerima = CreateId::init($this->db, "A", "alternatif", "id_calon_penerima");;

        // Insert alternatif
        $alternatif = array(
            'id_calon_penerima' => $id_calon_penerima,
            'nama_calon_penerima' => $nama_calon_penerima,
            'alamat' => $alamat,
            'no_HP' => $no_HP,
        );

        $this->db->insert('alternatif', $alternatif);

        $data_penerima_bansoss = [];

        $inserted_kriteria = [];
        foreach ($kriterias as $kriteria) {
            foreach ($attributes as $key => $value) {
                $kriteria_nama_kriteria = $this->snake($kriteria->nama_kriteria);
                $stack = "$kriteria_nama_kriteria-$key";
                if ($kriteria_nama_kriteria == $key && !in_array($stack, $inserted_kriteria)) {
                    array_push($inserted_kriteria, $stack);
                    $id_penerima_bansos = CreateId::init($this->db, "ACC", "data_penerima_bansos", "id_penerima_bansos");
                    $data_penerima_bansos = [
                        'id_penerima_bansos' => $id_penerima_bansos,
                        'data' => $value,
                        'id_kriteria' => $kriteria->id_kriteria,
                        'id_bansos' => $id_bansos,
                        'id_kategori_bansos' => $id_kategori_bansos,
                        'id_calon_penerima' => $id_calon_penerima,
                        'id_users' => $this->session->userdata('id_users'),
                    ];
                    $this->db->insert('data_penerima_bansos', $data_penerima_bansos);
                    array_push($data_penerima_bansoss, $data_penerima_bansos);
                }
            }
        }

        return [
            "alternatif" => $alternatif,
            "data_penerima_bansoss" => $data_penerima_bansoss,
        ];
    }

    function snake($string)
    {
        $pattern = '![A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+!';
        preg_match_all($pattern, $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ?
                strtolower($match) :
                lcfirst($match);
        }
        return implode('_', $ret);
    }
}

// Join 2 table
// SELECT * from data_penerima_bansos LEFT JOIN alternatif ON data_penerima_bansos.id_penerima_bansos = alternatif.id_calon_penerima
// SELECT * FROM data_penerima_bansos LEFT JOIN alternatif ON data_penerima_bansos.id_penerima_bansos = alternatif.id_calon_penerima 
//         WHERE data_penerima_bansos.id_bansos = 'BANSOS0001'
