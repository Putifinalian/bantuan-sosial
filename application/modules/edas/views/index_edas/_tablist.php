<div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" data-content="#pills-tabContent">
        <li class="nav-item">
            <a class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">
                Matriks Keputusan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-2-tab" data-bs-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">
                Solusi rata-rata (AV)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-3-tab" data-bs-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">
                Jarak positif dan negatif (PDA/NDA)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-4-tab" data-bs-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false">
                Jumlah terbobot (SP/SN)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-5-tab" data-bs-toggle="pill" href="#pills-5" role="tab" aria-controls="pills-5" aria-selected="false">
                Normalisasi (NSP/NSN)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-6-tab" data-bs-toggle="pill" href="#pills-6" role="tab" aria-controls="pills-6" aria-selected="false">
                Skor Penilaian (AS) dan Perangkingan
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="pills-7-tab" data-bs-toggle="pill" href="#pills-7" role="tab" aria-controls="pills-7" aria-selected="false">
                Perankingan
            </a>
        </li> -->
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
            <?php
            $this->load->view('index_edas/_table_alternatif');
            ?>
        </div>
        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
            <table id="table_solusi_rata_rata" class="display cell-border" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center table-dark">No</th>
                        <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                            <th scope="col" class="text-center table-dark">
                                <?= $id_kriteria->id_kriteria ?>
                            </th>
                        <?php endforeach ?>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
            <?php
            $this->load->view('index_edas/_table_jarak_positif_negatif');
            ?>
        </div>
        <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
            <?php
            $this->load->view('index_edas/_table_jumlah_terbobot');
            ?>
        </div>
        <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">
            <table id="table_normalisasi" class="display cell-border" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center table-dark">ID Calon Penerima</th>
                        <th scope="col" class="text-center table-dark">NSPi</th>
                        <th scope="col" class="text-center table-dark">NSNi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-6" role="tabpanel" aria-labelledby="pills-6-tab">
            <?php
            $this->load->view('index_edas/_table_skor_penilaian');
            ?>
        </div>
        <div class="tab-pane fade" id="pills-7" role="tabpanel" aria-labelledby="pills-7-tab">

            <div class="container">
                <div class="bd-callout bd-callout-info">
                    <h4> <span class="badge badge-primary rounded id-calon-penerima"></span> merupakan alternatif terbaik karena menjadi peringkat pertama disetiap pengujian nilai v</h4>
                </div>
            </div>

        </div>
    </div>
</div>
