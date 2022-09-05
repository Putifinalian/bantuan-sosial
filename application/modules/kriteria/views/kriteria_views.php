<?php
$bobot_matriks = array(
    '1'  => 1,
    '2'  => 2,
    '3'  => 3,
    '4'  => 4,
    '5'  => 5,
    '6'  => 6,
    '7'  => 7,
    '8'  => 8,
    '9'  => 9,
    '1/2'  => 0.5,
    '1/3'  => 0.33,
    '1/4'  => 0.25,
    '1/5'  => 0.2,
    '1/6'  => 0.16,
    '1/7'  => 0.14,
    '1/8'  => 0.125,
    '1/9'  => 0.011,
);

function dom_kriteria($val, $bobot_matriks)
{
    $res = "";
    foreach ($bobot_matriks as $key => $mk) {
        if ($mk == $val) $res = $key;
    }
    return $res;
}
?>

<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>

    <div class="container">
        <h1 class="text-center">Tabel Data Kriteria Bansos</h1>
        <p class="text-center">Anda dapat mengelola data kriteria bansos</p>
        <div class="form-group text-right">
            <button type="button" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary">Tambah</button>
        </div>
        <?= $this->session->flashdata('notif') ?>
        <?php $this->session->set_flashdata("notif", "") ?>
        <table class="table table-hover">
            <thead>
                <tr class="thead-dark">
                    <th>No</th>
                    <th>ID</th>
                    <th>Kriteria</th>
                    <th>Tipe</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($kriteria as $key => $result) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $result->id_kriteria ?></td>
                        <td><?= $result->nama_kriteria ?></td>
                        <td><?= $result->tipe_kriteria ?></td>
                        <td class="d-flex flex-wrap justify-content-end">
                            <a class='btn btn-warning mr-2' href="<?= base_url("kriteria/edit/$result->id_kriteria") ?>"> Ubah</a>
                            <form action="<?= base_url("kriteria"); ?>" method="post" class="d-inline-block confirm-delete">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="id_kriteria" value="<?= $result->id_kriteria ?>">
                                <button type="submit" class='btn btn-danger'>Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

    <!-- Form Tambah -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kriteria</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url('kriteria') ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label">Nama Kriteria</label>
                            <div class="">
                                <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Tipe Kriteria Bansos</label>
                            <div class="">
                                <!-- <input type="text" class="form-control" name="tipe_kriteria" placeholder="Masukkan Tipe Kriteria "> -->
                                <select class="form-control" name="tipe_kriteria">
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label text-capitalize">bansos</label>
                            <div class="">
                                <!-- <input type="text" class="form-control" name="tipe_kriteria" placeholder="Masukkan Tipe Kriteria "> -->
                                <select class="form-control" name="id_bansos">
                                    <?php foreach ($bansoss as $bansos) : ?>
                                        <option value="<?= $bansos->id_bansos ?>"><?= $bansos->nama_bansos ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-capitalize">kategori bansos</label>
                            <div class="">
                                <select class="form-control" name="id_kategori_bansos">
                                    <?php foreach ($kategori_bansoss as $kategori_bansos) : ?>
                                        <option value="<?= $kategori_bansos->id_kategori_bansos ?>"><?= $kategori_bansos->nama_kategori_bansos ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit"> Simpan&nbsp;</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
