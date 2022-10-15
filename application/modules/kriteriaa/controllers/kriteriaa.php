<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class kriteriaa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('kriteriaa_model');
        $this->load->library('form_validation');
        middleware_check_user($this);
    }

    /**
     * This function is used to load page view
     * @return Void
     */
    public function index()
    {
        // if ($this->input->method() == "post") {
        //     $_method = $this->input->post('_method');
        //     if ($_method == "put" || $_method == "patch") {
        //         // return $this->update();
        //     } else if ($_method == "delete") {
        //         // return $this->delete();
        //     } else {

        //         // return $this->store();
        //     }
        // }

        return $this->view_criteria();
    }

    public function view_criteria()
    {
        $kriteria = $this->db->query("SELECT * from kriteria_bansos LEFT JOIN kriteria ON kriteria_bansos.id_kriteria = kriteria.id_kriteria GROUP BY kriteria.id_kriteria ORDER BY kriteria.id_kriteria ASC")->result_object();
        $data['kriteria'] = $kriteria;

        // return $this->json($kriteria);

        $bansoss = $this->db->query("SELECT * FROM bansos")->result_object();
        $data['bansoss'] = $bansoss;

        $kategori_bansoss = $this->db->query("SELECT * FROM kategori_bansos")->result_object();
        $data['kategori_bansoss'] = $kategori_bansoss;

        // var_dump($data['kriteria']);exit;
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('kriteria_views', $data);
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
