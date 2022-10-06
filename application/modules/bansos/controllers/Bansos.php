<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Bansos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BansosModel');
        middleware_check_user($this);
    }

    public function index()
    {
        if ($this->input->method() == "post") {
            $_method = $this->input->post('_method');
            if ($_method == "put" || $_method == "patch") {
                return $this->update();
            } else if ($_method == "delete") {
                return $this->delete();
            } else {
                // return $this->store();
            }
        }

        return $this->index_bansos();
    }

    public function update()
    {
        $id_bansos = $this->input->post('id_bansos', true);
        $nama_bansos = $this->input->post('nama_bansos', true);
        $periode = $this->input->post('periode', true);

        $this->db->query("UPDATE bansos SET nama_bansos='$nama_bansos', periode='$periode' WHERE id_bansos='$id_bansos'");

        // return $this->json([$id_bansos, $nama_bansos,$periode]);
        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $id_bansos Berhasil diubah <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('bansos');
    }

    public function delete()
    {
        $id_bansos = $this->input->post('id_bansos', true);
        $this->db->query("DELETE FROM bansos WHERE id_bansos='$id_bansos' LIMIT 1");
        // header('location:' . $_SERVER['HTTP_REFERER']);
        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $id_bansos Berhasil dihapus <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('bansos');
    }

    public function add_bansos()
    {

        $data = array(
            'id_bansos' => $this->input->post('id_bansos'),
            'nama_bansos' => $this->input->post('nama_bansos'),
            'periode' => $this->input->post('periode')
        );

        $this->BansosModel->add_bansos($data);
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('bansos');
    }

    public function edit($id_bansos)
    {
        $bansos = $this->db->query("SELECT * FROM bansos WHERE id_bansos='$id_bansos' LIMIT 1")->row_object();

        $data["bansos"] = $bansos;

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('edit', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("include/footer");
    }

    //     public function ubah() {
    //       $id_bansos = $this->input->post('id_bansos');
    //           $data = array(
    //             'id_bansos' => $this->input->post('id_bansos'),
    //             'nama_bansos' => $this->input->post('nama_bansos'),
    //             'periode' => $this->input->post('periode')
    //       );

    //       $this->BansosModel->ubah($data);
    //       $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    // redirect('bansos/view_bansos');
    //     }



    public function index_bansos()
    {
        $bansos = $this->BansosModel->getBansos();
        $data['bansos'] = $bansos;
        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('bansos', $data);
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
