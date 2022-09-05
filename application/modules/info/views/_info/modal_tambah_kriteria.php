<div class="modal fade" id="modal-tambah-kriteria" tabindex="-1" aria-labelledby="modal-tambah-kriteria" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-kriteria">Tambah kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url("/info/$bansos->id_bansos"); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_bansos" value="<?= $bansos->id_bansos ?>">
                    <div class="form-group">
                        <label class="control-label">Kriteria Bansos</label>
                        <select class="form-control" name="id_kriteria">
                            <?php foreach ($kriterias as $key => $kriteria) : ?>
                                <option value="<?= $kriteria->id_kriteria ?>"><?= $kriteria->id_kriteria ?> - <?= $kriteria->nama_kriteria ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" name="tipe_kriteria">
                            <option value="Cost" selected>Cost</option>
                            <option value="Benefit">Benefit</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
