<?php defined("BASEPATH") or exit("No direct script access allowed");

class Info extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('InfoModel');
        $this->load->model('kriteria_bansos');
    }

    public function index($id_bansos)
    {        
    

        $_method = $this->input->post('_method');
        if ($this->input->method() == "post") {
            if ($_method == "put" || $_method == "patch") {
                return $this->update();
            } else if ($_method == "delete") {
                return $this->delete();
            } else {
                return $this->tambah_bansos($id_bansos);
            }
        }

        return $this->lists($id_bansos);
    }

    public function tambah_bansos($id_bansos)
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $tipe_kriteria = $this->input->post('tipe_kriteria', true);
        // echo "tambah_bansos : $id_bansos - $id_kriteria";
        $result = $this->kriteria_bansos->tambah_kriteria_bansos([
            "id_bansos" => $id_bansos,
            "id_kriteria" => $id_kriteria,
            "tipe_kriteria" => $tipe_kriteria,
        ]);

        header('location:'.$_SERVER['HTTP_REFERER']);
        // return $this->json($result);
    }

    public function update()
    {
        # code...
    }

    public function delete()
    {
        $id_kriteria = $this->input->post('id_kriteria', true);
        $id_bansos = $this->input->post('id_bansos', true);

        $this->db->query("DELETE FROM kriteria_bansos WHERE id_bansos='$id_bansos' AND id_kriteria='$id_kriteria' LIMIT 1");
        
        header('location:'.$_SERVER['HTTP_REFERER']);
    }

    public function lists($id_bansos)
    {
        // $algoritma = $this->AlgoritmaModel->getAll();
        // $data['algoritma'] = $algoritma;
        $data["id_bansos"] = $id_bansos;

        $bansos = $this->db->query("SELECT kb.id_kategori_bansos AS id_kategori_bansos, kb.nama_kategori_bansos AS nama_kategori_bansos, b.id_bansos AS id_bansos, b.nama_bansos AS nama_bansos, b.periode AS periode  from bansos AS b LEFT JOIN kategori_bansos AS kb ON kb.id_bansos=b.id_bansos WHERE b.id_bansos='$id_bansos'")->row_object();
        $data["bansos"] = $bansos;

        // return $this->json($id_bansos);
        // return $this->json($bansos);
        
        $kriterias = $this->db->query("SELECT * from kriteria")->result_object();
        $data["kriterias"] = $kriterias;

        $kriteria_bansoss = $this->db->query("SELECT * from kriteria_bansos AS kb JOIN kriteria ON kriteria.id_kriteria=kb.id_kriteria WHERE kb.id_bansos='$id_bansos' ORDER BY kb.id_kriteria")->result_object();
        // return $this->json($kriteria_bansoss);

        $data["kriteria_bansoss"] = $kriteria_bansoss;

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('info', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("_info/modal_tambah_kriteria");
        $this->load->view("_info/script");
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
