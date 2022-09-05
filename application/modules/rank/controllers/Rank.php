<?php defined("BASEPATH") or exit("No direct script access allowed");

class Rank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RankModel');
    }

    public function index()
    {
        $data_penerima_bansoss = $this->db->query("SELECT * FROM `data_penerima_bansos` 
        JOIN `alternatif` ON data_penerima_bansos.id_calon_penerima=alternatif.id_calon_penerima JOIN `bansos` ON data_penerima_bansos.id_bansos=bansos.id_bansos 
        JOIN `kriteria` ON data_penerima_bansos.id_kriteria=kriteria.id_kriteria 
        JOIN `kategori_bansos` ON data_penerima_bansos.id_kategori_bansos=kategori_bansos.id_kategori_bansos ORDER BY `id_penerima_bansos` ASC")->result_object();

        // return $this->json($data_penerima_bansoss);

        $data["data_penerima_bansoss"] = $data_penerima_bansoss;
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('rank', $data);
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
