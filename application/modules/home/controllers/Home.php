
<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Home extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('home_model');
  }

  /**
     * This function is used to load page view
     * @return Void
     */
  public function index()
  {
    if($this->session->userdata('username')){
      if($this->session->userdata('tipe_user') == 'admin'){
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('home');
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("include/footer");
      }else{
        $flash_massage = 'Upsss!!!, Anda tidak mempunyai akses ke halaman yang anda tuju.';
        $this->session->set_flashdata('success', $flash_massage);
        redirect('home/user');
      }
    }else{
      $this->session->set_flashdata('success', 'Upsss!!!, Login dulu ya.');
      redirect();
    }
  }

  public function user()
  {
    if($this->session->userdata('username')){
      $this->load->view("include/head");
      $this->load->view("include/top-header");
      $this->load->view('home');
      $this->load->view("include/user/sidebar");
      $this->load->view("include/panel");
      $this->load->view("include/alert");
      $this->load->view("include/footer");
    }else{
      $this->session->set_flashdata('success', 'Upsss!!!, Login dulu ya.');
      redirect();
    }
    
	
  }
}
?>
