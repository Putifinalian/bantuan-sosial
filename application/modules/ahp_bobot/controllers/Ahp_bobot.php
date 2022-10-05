<?php defined("BASEPATH") OR exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Ahp_bobot extends CI_Controller 
{
    public function __construct() {
		parent::__construct();
		$this->load->model('Ahp_bobot_m');
        middleware_check_user($this);
    }

  
    public function index(){
      // $algoritma = $this->AlgoritmaModel->getAll();
      // $data['algoritma'] = $algoritma;
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        // $this->load->view('algoritma_view', $data);
        $this->load->view('ahp_bobot_v');
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/footer");
        $this->load->view("include/alert");
    }
   
    
}
