<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class kriteriaa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->model('home_model');
        // middleware_check_user($this);
    }

    /**
     * This function is used to load page view
     * @return Void
     */
    public function index()
    {
        echo "INDEX Kriteriaa";
        return ""; 
    }

    public function goreng()
    {
        echo "goreng Kriteriaa";
        return ""; 
    }
}
