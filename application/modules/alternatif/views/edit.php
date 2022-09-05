<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
        <!-- <button type="button" class="btn btn-primary"> <i class="fa fa-plus"></i> Data Baru</button> -->
    </ol>

    <div class="container">
        <h1 class="text-center">Daftar Calon Penerima Bansos</h1>
        <p class="text-center">Anda dapat mengelola data calon penerima bansos</p>

        <div>
            <form action="<?php echo base_url("/alternatif"); ?>" method="post">
                <input type="hidden" name="_method" value="put" />
                <input type="hidden" name="_db" value="alternatif" />
                <input type="hidden" name="id_calon_penerima" value="<?= $alternatif->id_calon_penerima ?>" />

                <div class="d-flex flex-wrap justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                <div class="form-group">
                    <label for="nama_calon_penerima">Bansos</label>
                    <select class="form-control" id="id_bansos" name="id_bansos">
                        <?php foreach ($bansoss as $key => $bansos) : ?>
                            <option value="<?= $bansos->id_bansos ?>" <?= $data_penerima_bansos[0]->id_bansos == $bansos->id_bansos ? "selected" : "" ?>><?= $bansos->nama_bansos ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_calon_penerima">Kategori Bansos</label>
                    <select class="form-control" id="id_kategori_bansos" name="id_kategori_bansos">
                        <?php foreach ($kategori_bansoss as $key => $kategori_bansos) : ?>
                            <option value="<?= $kategori_bansos->id_kategori_bansos ?>" <?= $data_penerima_bansos[0]->id_kategori_bansos == $kategori_bansos->id_kategori_bansos ? "selected" : "" ?>><?= $kategori_bansos->nama_kategori_bansos ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_calon_penerima">Nama calon penerima</label>
                    <input type="text" id="nama_calon_penerima" class="form-control form-control-lg inverse-mode" name="nama_calon_penerima" placeholder="Nama calon penerima" value="<?= $alternatif->nama_calon_penerima ?>" />
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" class="form-control form-control-lg inverse-mode" name="alamat" placeholder="Alamat" value="<?= $alternatif->alamat ?>" />
                </div>
                <div class="form-group">
                    <label for="no_HP">No HP</label>
                    <input type="text" id="no_HP" class="form-control form-control-lg inverse-mode" name="no_HP" placeholder="No HP" value="<?= $alternatif->no_HP ?>" />
                </div>

                <div class="wrapper-kriteria"></div>
            </form>

            <?php $this->load->view("script"); ?>
        </div>
    </div>
</div>
