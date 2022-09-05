<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Algoritma extends CI_Controller 
{
    public function __construct() {
		parent::__construct();
		$this->load->model('AlgoritmaModel');
    }

  
    public function index(){
      $algoritma = $this->AlgoritmaModel->getAll();
      $data['algoritma'] = $algoritma;
      
      $bansos_ = $this->db->query("SELECT * FROM bansos")->result_object();
      $data['bansos_'] = $bansos_;

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('algoritma_view', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("include/footer");
    }

    public function check_bobot()
    {
        $id_bansos = $this->input->post('id_bansos', true);
        $data = [];

        $data["kriteria_bansos"] = $this->db->query("SELECT * FROM kriteria_bansos WHERE id_bansos='$id_bansos'")->result_object();

        return $this->json($data);
    }

    public function json($data)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
   
    
}
