<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function register()
    {
        if($this->input->method() == "get") {
            $this->load->view('register');
        } else{
            $name = $this->input->post('name', true);
            $username = $this->input->post('username', true);
            $password = MD5($this->input->post('password', true));
            $role = $this->input->post('role', true);
            $result = $this->user_model->register($name, $username, $password, $role);
            if($result["status"]) {
                redirect('home');
            }else{
                $this->session->set_flashdata('error', $result["msg"]);
                redirect('');
            }
        }
    }

    
    public function proses()
    {
        $username = $this->input->post('username', true);
        $password = MD5($this->input->post('password', true));
        
        if($this->user_model->login_user($username, $password)) {
            redirect('home');
        }else{
            $this->session->set_flashdata('error', "USERNAME ATAU PASSWORD SALAH !!!");
            redirect('');
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('is_login');
        redirect('user');
    }


}
?>
