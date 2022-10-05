<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Alternatif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // $this->load->model('alternatif_model');
        middleware_check_user($this);
    }

    public function index()
    {
        // if ($this->input->method() == "post") {
        //     $_method = $this->input->post('_method');
        //     if ($_method == "put" || $_method == "patch") {
        //         // jalankan fungsi update data
        //         return $this->update();
        //     } else if ($_method == "delete") {
        //         // jalankan fungsi delete data
        //         return $this->delete();
        //     } else {
        //         // jalankan fungsi insert data
        //         return $this->store();
        //     }
        // }

        return $this->lists();
    }

    // Method untuk menyimpan calon penerima baru
    public function store()
    {
        $post = [];
        foreach ($_POST as $key => $value) {
            $post[$key] = $this->input->post($key);
        }
        $result = $this->alternatif_model->store($post);
        // return $this->json($result);

        $nama_calon_penerima = $post['nama_calon_penerima'];
        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $nama_calon_penerima Berhasil ditambah <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('alternatif');
    }

    // Method untuk menyimpan editan calon penerima
    public function update()
    {
        $post = [];
        foreach ($_POST as $key => $value) {
            $post[$key] = $this->input->post($key);
        }

        $nama_calon_penerima = $post['nama_calon_penerima'];
        $id_calon_penerima = $post['id_calon_penerima'];

        $result = $this->alternatif_model->update($post);
        // return $this->json($result);

        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $nama_calon_penerima Berhasil diupdate <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        // redirect("alternatif/edit/$id_calon_penerima");
        redirect("alternatif");
    }
    // Method untuk hapus calon penerima baru
    public function delete()
    {
        // post method tapi ada input name=_method value=delete
        // $id_calon_penerima, $id_penerima_bansos
        $id_calon_penerima = $this->input->post("id_calon_penerima");

        // hapus penerima bansos
        $this->db->query("DELETE FROM data_penerima_bansos WHERE id_calon_penerima='$id_calon_penerima'");

        // hapus penerima bansos
        $this->db->query("DELETE FROM alternatif WHERE id_calon_penerima='$id_calon_penerima' LIMIT 1");

        $this->session->set_flashdata('notif', "<div class='alert alert-success' role='alert'> Data $id_calon_penerima Berhasil diubah <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('alternatif');
    }

    public function test()
    {
        return $this->json([
            "success" => true,
        ]);
    }

    public function lists()
    {
        // $alternatif = $this->alternatif_model->all();
        $sql = "SELECT * FROM alternatif AS a, data_penerima_bansos AS b WHERE a.id_calon_penerima=b.id_calon_penerima";
        $filter_id_bansos = $this->input->get("filter_id_bansos");
        $filter_id_kategori_bansos = $this->input->get("filter_id_kategori_bansos");

        if ($filter_id_bansos && $filter_id_bansos != "") {
            $sql .= " AND b.id_bansos='$filter_id_bansos'";
        }
        if ($filter_id_bansos && $filter_id_bansos != "") {
            $sql .= " AND b.id_kategori_bansos='$filter_id_kategori_bansos'";
        }

        $alternatif = $this->db->query($sql);
        $alternatif = $alternatif->result_object();

        $data['alternatif'] = $alternatif;

        $kriterias = $this->db->query("SELECT * from kriteria_bansos LEFT JOIN kriteria ON kriteria_bansos.id_kriteria = kriteria.id_kriteria")->result();
        $data['kriterias'] = $kriterias;

        $kategori_bansoss = $this->db->query("SELECT * from kategori_bansos")->result();
        $data['kategori_bansoss'] = $kategori_bansoss;

        $bansoss = $this->db->query("SELECT * from bansos")->result();
        $data['bansoss'] = $bansoss;

        $kriteria_bansoss = $this->db->query("SELECT * from kriteria_bansos JOIN kriteria ON kriteria.id_kriteria=kriteria_bansos.id_kriteria")->result();
        $data['kriteria_bansoss'] = $kriteria_bansoss;

        $data_penerima_bansos = [];
        $data["data_penerima_bansos"] = $data_penerima_bansos;


        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('index', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        $this->load->view("_index/modal_tambah_data");
        // $this->load->view("_index/script");
        $this->load->view("script");
        $this->load->view("include/footer");
    }

    public function edit($alternatif_id)
    {
        // echo $alternatif_id;
        $alternatif = $this->db->query("SELECT * from alternatif WHERE alternatif.id_calon_penerima='$alternatif_id' LIMIT 1")->row_object();
        $data["alternatif"] = $alternatif;

        $kategori_bansoss = $this->db->query("SELECT * from kategori_bansos")->result();
        $data['kategori_bansoss'] = $kategori_bansoss;

        $bansoss = $this->db->query("SELECT * from bansos")->result();
        $data['bansoss'] = $bansoss;

        $kriteria_bansoss = $this->db->query("SELECT * from kriteria_bansos JOIN kriteria ON kriteria.id_kriteria=kriteria_bansos.id_kriteria")->result();
        $data['kriteria_bansoss'] = $kriteria_bansoss;

        $data_penerima_bansos = $this->db->query("SELECT * from data_penerima_bansos JOIN kriteria ON kriteria.id_kriteria=data_penerima_bansos.id_kriteria WHERE id_calon_penerima='$alternatif->id_calon_penerima'")->result_object();
        $data["data_penerima_bansos"] = $data_penerima_bansos;

        // return $this->json($data_penerima_bansos);

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('edit', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/alert");
        // $this->load->view("_edit/script");
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
