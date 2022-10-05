<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Kriteria extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_model');
        // $this->load->library('form_validation');
        middleware_check_user($this);
    }

    // public function index()
    // {
    //     if ($this->input->method() == "post") {
    //         $_method = $this->input->post('_method');
    //         if ($_method == "put" || $_method == "patch") {
    //             return $this->update();
    //         } else if ($_method == "delete") {
    //             return $this->delete();
    //         } else {
    //             return $this->store();
    //         }
    //     }

    //     return $this->view_criteria();
    // }

    public function update()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $id_kriteria_bansos = $this->input->post('id_kriteria_bansos');
        // $kriteria_bansos = $this->db->query("SELECT * FROM kriteria_bansos WHERE id_kriteria='$id_kriteria' LIMIT 1")->row_object();
        $data = array(
            'id_kriteria' => $this->input->post('id_kriteria'),
            'id_kriteria_bansos' => $this->input->post('id_kriteria_bansos'),
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'tipe_kriteria' => $this->input->post('tipe_kriteria'),
            'nilai_bobot' => $this->input->post('nilai_bobot'),
            'id_bansos' => $this->input->post('id_bansos'),
            'id_kategori_bansos' => $this->input->post('id_kategori_bansos'),
        );

        $this->Kriteria_model->update($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect("kriteria/edit/$id_kriteria");


    }

    public function delete()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $kriteria_bansos = $this->db->query("SELECT * FROM kriteria_bansos WHERE id_kriteria='$id_kriteria' LIMIT 1")->row_object();

        $this->db->query("DELETE FROM kriteria_bansos WHERE id_kriteria_bansos='$kriteria_bansos->id_kriteria_bansos' LIMIT 1");
        $this->db->query("DELETE FROM kriteria WHERE id_kriteria='$id_kriteria' LIMIT 1");

        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $id_kriteria Berhasil dihapus <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('kriteria');
    }

    public function store()
    {
        $data = array(
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'tipe_kriteria' => $this->input->post('tipe_kriteria'),
            'id_bansos' => $this->input->post('id_bansos'),
            'id_kategori_bansos' => $this->input->post('id_kategori_bansos'),
        );

        $this->Kriteria_model->add_criteria($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('kriteria/view_criteria');
    }

    public function index()
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

    public function edit($id_kriteria)
    {
        $kriteria = $this->db->query("SELECT * FROM kriteria JOIN kriteria_bansos ON kriteria.id_kriteria=kriteria_bansos.id_kriteria WHERE kriteria.id_kriteria='$id_kriteria'")->row_object();
        $data['kriteria'] = $kriteria;

        $bansoss = $this->db->query("SELECT * FROM bansos")->result_object();
        $data['bansoss'] = $bansoss;

        $kategori_bansoss = $this->db->query("SELECT * FROM kategori_bansos")->result_object();
        $data['kategori_bansoss'] = $kategori_bansoss;

        // return $this->json($kriteria);


        // var_dump($data['kriteria']);exit;
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('edit', $data);
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
