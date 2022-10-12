<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Kriteria extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->json([
            "route" => "index"
        ]);
    }

    public function aa()
    {
        return $this->json([
            "route" => "aa"
        ]);
    }


    public function json($data)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
}
