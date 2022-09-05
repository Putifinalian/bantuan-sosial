<div id="content" class="content">
    <!-- <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol> -->

    <div class="container">
        <div class="card">
            <div class="card-header">Edit Kriteria</div>
            <div class="card-body">
                <?php if (validation_errors() == true) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors() ?>
                    </div>
                <?php endif ?>

                <form method="post" action="<?= base_url("kriteria") ?>">
                    <input type="hidden" name="_method" value="put" />
                    <input type="hidden" name="id_kriteria" value="<?= $kriteria->id_kriteria ?>" />
                    <input type="hidden" name="id_kriteria_bansos"value="<?= $kriteria->id_kriteria_bansos ?>" />


                    <div class="form-group">
                        <label class="control-label">Nama Kriteria</label>
                        <div class="">
                            <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria" value="<?= $kriteria->nama_kriteria ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipe Kriteria Bansos</label>
                        <div class="">
                            <select class="form-control" name="tipe_kriteria">
                                <?php foreach (["Benefit", "Cost"] as $key => $tk) : ?>
                                    <option value="<?= $tk ?>" 
                                    <?= $tk == $kriteria->tipe_kriteria ? "selected" : "" ?>
                                    ><?= $tk ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label">Tipe Bansos</label>
                        <div class="">
                            <select class="form-control" name="id_bansos">
                                <?php foreach ($bansoss as $key => $bansos) : ?>
                                    <option value="<?= $bansos->id_bansos ?>"
                                    <?= $bansos->id_bansos == $kriteria->id_bansos ? "selected" : "" ?>
                                    ><?= $bansos->nama_bansos ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label text-capitalize">kategori bansos</label>
                        <div class="">
                            <select class="form-control" name="id_kategori_bansos">
                                <?php foreach ($kategori_bansoss as $key => $kb) : ?>
                                    <option value="<?= $kb->id_kategori_bansos ?>"
                                    <?= $kb->id_kategori_bansos == $kriteria->id_kategori_bansos ? "selected" : "" ?>
                                    ><?= $kb->nama_kategori_bansos ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


                    <a href="<?= base_url("kriteria") ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
