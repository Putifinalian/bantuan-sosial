<?php defined("BASEPATH") or exit("No direct script access allowed");
require_once realpath(__DIR__ . '/../../../helpers/middleware.php');

class Edas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('EdasModel');
        middleware_check_user($this);
    }


    public function index()
    {
        $edas = $this->EdasModel->getAll();
        //   return $this->json($edas);
        $data['edas'] = $edas;

        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('edas_view');
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/footer");
        $this->load->view("include/alert");
    }

    public function index_edas($id_bansos)
    {
        $data['id_bansos'] = $id_bansos;

        // $edas = $this->EdasModel->getAll();
        // $data['edas'] = $edas;

        $alternatif_ = $this->db->query("SELECT * FROM alternatif AS a JOIN data_penerima_bansos AS pb ON a.id_calon_penerima=pb.id_calon_penerima WHERE pb.id_bansos='$id_bansos' ORDER BY pb.id_calon_penerima, pb.id_kriteria")->result_object();
        // return $this->json($alternatif_);

        $alternatif_restruct = [];
        $last_id_calon_penerima = null;
        $last_alternative_ = null;
        $index_alternative = null;
        foreach ($alternatif_ as $index => $alternatif) {
            if ($last_id_calon_penerima != $alternatif->id_calon_penerima) {
                $last_alternative_ = json_decode(json_encode($alternatif), true);
                $last_alternative_["kriteria"][$alternatif->id_kriteria] = $alternatif->data;
                array_push($alternatif_restruct, $last_alternative_);
                if ($index_alternative === null) $index_alternative = 0;
                else $index_alternative++;
            } else {
                $alternatif_restruct[$index_alternative]["kriteria"][$alternatif->id_kriteria] = $alternatif->data;
            }
            $last_id_calon_penerima = $alternatif->id_calon_penerima;
        }

        $data['alternatif_'] = $alternatif_restruct;
        // return $this->json($alternatif_restruct);

        $id_kriteria_ = $this->db->query("SELECT DISTINCT dpb.id_kriteria, dpb.id_bansos, kb.* FROM `data_penerima_bansos` AS dpb JOIN kriteria_bansos AS kb ON dpb.id_kriteria=kb.id_kriteria WHERE kb.nilai_bobot IS NOT NULL AND dpb.id_bansos='$id_bansos' AND kb.id_bansos='$id_bansos' GROUP BY dpb.id_kriteria")->result_object();
        $data['id_kriteria_'] = $id_kriteria_;

        // return $this->json([
        //     "count" => count($id_kriteria_),
        //     "data" => $id_kriteria_,
        // ]);

        $matrik_keputusan = [];
        foreach ($alternatif_restruct as $alternatif) {
            $result = [
                "id_calon_penerima" => $alternatif["id_calon_penerima"]
            ];

            foreach ($alternatif["kriteria"] as $key => $item) {
                $result[$key] = $item;
            }
            array_push($matrik_keputusan, $result);
        }
        $data["matrik_keputusan"] = $matrik_keputusan;
        // return $this->json([
        //     "count" => count($matrik_keputusan),
        //     "data" => $matrik_keputusan,
        // ]);


        $this->load->view("include/head");
        $this->load->view("include/top-header");
        $this->load->view('index_edas/index', $data);
        // $this->load->view('index_edas_v1/index', $data);
        $this->load->view("include/admin/sidebar");
        $this->load->view("include/panel");
        $this->load->view("include/footer");
        $this->load->view("include/alert");
    }

    public function json($data)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
}
