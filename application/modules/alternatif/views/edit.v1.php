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
            <div class="card mb-3 bg-transparent">
                <div class="card-body">
                    <form action="<?php echo base_url("/alternatif"); ?>" method="post">
                        <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="_db" value="alternatif" />
                        <div class="form-group m-b-20">
                            <label for="nama_calon_penerima">Nama calon penerima</label>
                            <input type="text" id="nama_calon_penerima" class="form-control form-control-lg inverse-mode" name="nama_calon_penerima" placeholder="Nama calon penerima"  value="<?= $alternatif->nama_calon_penerima ?>" />
                        </div>
                        <div class="form-group m-b-20">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" class="form-control form-control-lg inverse-mode" name="alamat" placeholder="Alamat"  value="<?= $alternatif->alamat ?>" />
                        </div>
                        <div class="form-group m-b-20">
                            <label for="no_HP">No HP</label>
                            <input type="text" id="no_HP" class="form-control form-control-lg inverse-mode" name="no_HP" placeholder="No HP"  value="<?= $alternatif->no_HP ?>" />
                        </div>
                        <button type="submit" class="btn btn-primary hide">Simpan</button>
                    </form>
                </div>
            </div>

            <?php foreach ($data_penerima_bansos as $key => $dpb) : ?>
                <div class="card mb-3 bg-transparent">
                    <div class="card-body">
                        <form action="<?php echo base_url("/alternatif"); ?>" method="post">
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" name="_db" value="alternatif" />
                            <div class="form-group m-b-20">
                                <label for="nama_calon_penerima"><?= $dpb->nama_kriteria ?></label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="<?= $dpb->nama_kriteria ?>" aria-describedby="basic-addon2" value="<?= $dpb->data ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary disabled" type="button">Update</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary hide">Simpan</button>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
