<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>

    <div class="container">
        <h1 class="text-center">Tabel Data Bansos</h1>
        <p class="text-center">Anda dapat mengelola data bansos</p>
        <div class="form-group text-right">
            <button data-toggle="modal" data-target="#tambah-data" class="btn btn-primary">Tambah</button>
            <!-- <a class="btn btn-info" href="<?php echo base_url('Info'); ?>">Info</a> -->

        </div>
        <?= $this->session->flashdata('notif') ?>
        <table class="table table-hover">
            <thead>
                <tr class="thead-dark">
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Bantuan Sosial</th>
                    <th>Periode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bansos as $key => $bs) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $bs->id_bansos ?></td>
                        <td><?= $bs->nama_bansos ?></td>
                        <td><?= $bs->periode ?></td>
                        <td class="d-flex flex-wrap justify-content-end">
                            <a class='btn btn-info mr-2' href="<?php echo base_url("info/$bs->id_bansos"); ?>">Info</a>

                            <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
                                <a href='<?= base_url("bansos/edit/$bs->id_bansos") ?>' class='btn btn-warning mr-2'>Ubah</a>
                                <form action="<?php echo base_url("bansos"); ?>" method="post" class="d-inline-block confirm-delete">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="id_bansos" value="<?= $bs->id_bansos ?>">
                                    <button type="submit" class='btn btn-danger'>Hapus</button>
                                </form>
                            <?php endif ?>
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
                    <h4 class="modal-title">Tambah Data Bansos</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url('bansos/add_bansos') ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Nama Bantuan Sosial</label>
                            <div class="">
                                <input type="text" class="form-control" name="nama_bansos" placeholder="Masukkan Nama Bansos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Periode</label>
                            <div class="">
                                <input type="date" class="form-control" name="periode" placeholder="Masukkan Tanggal">
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
