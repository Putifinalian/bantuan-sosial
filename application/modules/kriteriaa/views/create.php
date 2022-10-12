<div class="container">
    <div class="card">
        <div class="card-header">Tambah Kriteria</div>
        <div class="card-body">
            <?php
            if (validation_errors() != false) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php
            }
            ?>
            <form method="post" action="<?= base_url(); ?>kriteria/save">
                <div class="form-group">
                    <label class="control-label">ID Kriteria</label>
                    <div class="">
                        <input type="text" class="form-control" name="id_kriteria" placeholder="Masukkan ID Kriteria">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">ID Kriteria Bansos</label>
                    <div class="">
                        <input type="text" class="form-control" name="id_kriteria_bansos" placeholder="Masukkan ID Kriteria Bansos">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Tipe Kriteria Bansos</label>
                    <div class="">
                        <select class="form-control" name="tipe_kriteria">
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
