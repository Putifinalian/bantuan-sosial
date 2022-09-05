<div class="modal fade modal-create-penerima" id="modal-tambah-data" tabindex="-1" role="dialog" aria-labelledby="tambah-data-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-data-label">Tambah Penerima BANSOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url("/alternatif"); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_calon_penerima">Bansos</label>
                        <select class="form-control" id="id_bansos" name="id_bansos">
                            <?php foreach ($bansoss as $key => $bansos) : ?>
                                <option value="<?= $bansos->id_bansos ?>" <?= $this->input->get("id_bansos") == $bansos->id_bansos ? "selected" : "" ?>><?= $bansos->nama_bansos ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_calon_penerima">Kategori Bansos</label>
                        <select class="form-control" id="id_kategori_bansos" name="id_kategori_bansos">
                            <?php foreach ($kategori_bansoss as $key => $kategori_bansos) : ?>
                                <option value="<?= $kategori_bansos->id_kategori_bansos ?>" <?= $this->input->get("id_kategori_bansos") == $kategori_bansos->id_kategori_bansos ? "selected" : "" ?>><?= $kategori_bansos->nama_kategori_bansos ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_calon_penerima">Nama calon penerima</label>
                        <input type="text" id="nama_calon_penerima" class="form-control form-control-lg inverse-mode" name="nama_calon_penerima" placeholder="Nama calon penerima" required value="" />
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control form-control-lg inverse-mode" name="alamat" placeholder="Alamat" required value="" />
                    </div>
                    <div class="form-group">
                        <label for="no_HP">No HP</label>
                        <input type="text" id="no_HP" class="form-control form-control-lg inverse-mode" name="no_HP" placeholder="No HP" required value="" />
                    </div>

                    <div class="wrapper-kriteria"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
