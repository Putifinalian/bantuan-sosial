<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
        <!-- <button type="button" class="btn btn-primary"> <i class="fa fa-plus"></i> Data Baru</button> -->
    </ol>

    <div class="container">
        <h1 class="text-center">Daftar Calon Penerima Bansos</h1>
        <p class="text-center">Anda dapat mengelola data calon penerima bansos</p>
        <div class="form-group text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-data">
                Tambah
            </button>

            <a class="btn btn-info" href="<?php echo base_url('Algoritma'); ?>">Cek Penerima Bansos</a>
        </div>

        <div>
            <?php $this->load->view("_index/filter"); ?>
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="thead-dark">
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Kriteria</th>
                    <th>Data</th>
                    <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
                    <th></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alternatif as $key => $result) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $result->id_calon_penerima ?></td>
                        <td><?= $result->nama_calon_penerima ?></td>
                        <td><?= $result->alamat ?></td>
                        <td><?= $result->no_HP ?></td>
                        <td><?= $result->id_kriteria ?></td>
                        <td><?= $result->data ?></td>
                        <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
                            <td class="d-flex flex-wrap justify-content-end">
                                <a class='btn btn-warning mr-2' href="<?= base_url("alternatif/edit/$result->id_calon_penerima") ?>">Ubah</a>
                                <form action="<?= base_url("alternatif") ?>" method="post" class="d-inline-block confirm-delete">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="id_penerima_bansos" value="<?= $result->id_penerima_bansos ?>">
                                    <input type="hidden" name="id_calon_penerima" value="<?= $result->id_calon_penerima ?>">
                                    <button class='btn btn-danger' type="submit">Hapus</button>
                                </form>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
