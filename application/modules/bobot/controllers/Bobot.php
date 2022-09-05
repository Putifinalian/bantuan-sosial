<?php defined("BASEPATH") or exit("No direct script access allowed");

class Bobot extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Bobot_model');
    }

    public function index()
    {
    }

    public function run_edas()
    {
        return $this->json($this->store_penerima("BANSOS0001", "CTGR0001", "ALGOR0001"));
    }

    public function update_bobot_kriteria_bansos()
    {
        $id_bansos = $this->input->post("id_bansos");
        $bobot_ = $this->input->post("bobot");
        $bobot_ = json_decode($bobot_);

        for ($index = 0; $index < count($bobot_); $index++) {
            $bobot = $bobot_[$index];
            $check = $this->db->query("SELECT * FROM kriteria_bansos WHERE id_bansos='$id_bansos' AND id_kriteria='$bobot->id_kriteria'")->row_object();

            if ($check) {
                $this->db->query("UPDATE `kriteria_bansos` SET `nilai_bobot`='$bobot->bobot' WHERE id_bansos='$id_bansos' AND id_kriteria='$bobot->id_kriteria'");
            }
        }

        return $this->json([
            "id_bansos" => $id_bansos,
            "bobot" => $bobot_,
            "count" => count($bobot_),
        ]);

    }


    public function update_rasio_kriteria()
    {
        $id_bansos = $this->input->post("id_bansos");
        $nilai_ = $this->input->post("nilai");
        $nilai_ = json_decode($nilai_);

        for ($index = 0; $index < count($nilai_); $index++) {
            $nilai = $nilai_[$index];
            $check = $this->db->query("SELECT * FROM rasio_kriteria WHERE id_kriteria_1='$nilai->baris' AND id_kriteria_2='$nilai->kolom' AND id_bansos='$id_bansos'")->row_object();

            if ($check) {
                $this->db->query("UPDATE `rasio_kriteria` SET `rasio`='$nilai->nilai' WHERE id_kriteria_1='$nilai->baris' AND id_kriteria_2='$nilai->kolom' AND id_bansos='$id_bansos'");
            } else {
                $this->db->query("INSERT INTO `rasio_kriteria`(`id_kriteria_1`, `id_kriteria_2`, `rasio`, `id_bansos`) VALUES ('$nilai->baris','$nilai->kolom','$nilai->nilai','$id_bansos')");
            }
        }

        return $this->json([
            "id_bansos" => $id_bansos,
            "nilai" => $nilai_,
            "count" => count($nilai_),
        ]);
    }

    // Store penerima_bansos to table run with 
    public function store_penerima($id_bansos, $id_kategori_bansos, $id_algoritma)
    {
        $data_penerima_bansoss = $this->db->query("SELECT * FROM data_penerima_bansos")->result_object();

        // store data
        $sql_store = "INSERT INTO `run_edas`(`id_penerima_bansos`, `id_bansos`, `id_kategori_bansos`, `id_algoritma`) VALUES ";

        $sql_store_arr = [];
        for ($i = 0; $i < count($data_penerima_bansoss); $i++) {
            $id_penerima_bansos = $data_penerima_bansoss[$i]->id_penerima_bansos;
            array_push($sql_store_arr, "('$id_penerima_bansos', '$id_bansos', '$id_kategori_bansos', '$id_algoritma')");
        }
        $sql_store .= join(", ", $sql_store_arr);
        return $this->db->query($sql_store);
    }

    public function view_pembobotan($id_bansos)
    {

        $bansos = $this->db->query("SELECT * FROM bansos WHERE id_bansos='$id_bansos' LIMIT 1")->row_object();
        $data['bansos'] = $bansos;

        $kriterias = $this->db->query("SELECT *, bansos.id_bansos AS id_bansos FROM bansos JOIN kriteria_bansos on (bansos.id_bansos=kriteria_bansos.id_bansos) JOIN kriteria on (kriteria.id_kriteria=kriteria_bansos.id_kriteria) LEFT JOIN rasio_kriteria ON (rasio_kriteria.id_bansos=bansos.id_bansos) WHERE bansos.id_bansos='$id_bansos'  GROUP BY kriteria.id_kriteria")->result_object();

        $data['kriterias'] = $kriterias;
        
        $rasio_kriteria = $this->db->query("SELECT * FROM rasio_kriteria WHERE id_bansos='$id_bansos'")->result_object();
        $data['rasio_kriteria'] = $rasio_kriteria;

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('bobot', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("include/footer");
    }

    public function json($data)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
}
