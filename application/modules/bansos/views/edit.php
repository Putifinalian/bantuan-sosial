<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>

    <div class="container">
        <form class="form-horizontal" action="<?= base_url('bansos') ?>" method="post">
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
                <label class="control-label">ID Bansos</label>
                <div class="">
                    <input type="text" class="form-control" name="id_bansos" readonly value="<?= $bansos->id_bansos ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Nama Bantuan Sosial</label>
                <div class="">
                    <input type="text" class="form-control" name="nama_bansos" placeholder="Masukkan Nama Bansos" value="<?= $bansos->nama_bansos ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Periode</label>
                <div class="">
                    <input type="date" class="form-control" name="periode" placeholder="Masukkan Tanggal" value="<?= $bansos->periode ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit"> Simpan&nbsp;</button>
                <a class="btn btn-warning" href="<?= base_url("bansos") ?>" > Batal</a>
            </div>
        </form>
    </div>

</div>
