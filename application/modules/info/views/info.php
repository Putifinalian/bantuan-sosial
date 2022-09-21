<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li> -->
        <li>
            <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
            <a class="btn btn-success btn-run-ahp" href="<?= base_url("pembobotan/$bansos->id_bansos") ?>">Hitung Bobot</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-kriteria">
                Tambah Kriteria
            </button>
            <?php endif ?>
        </li>
    </ol>
    <h2 class="page-header mb-3">Info Bantuan Sosial</h2>
    <div class="form-group mb-5">
        <div class="form-group">
            <label class="col-lg-2 col-sm-2 control-label">ID Bantuan Sosial</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="id_bansos" placeholder="Masukkan ID Bansos" disabled value="<?= $bansos->id_bansos ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-sm-2 control-label">Nama Bantuan Sosial</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="nama_bansos" placeholder="Masukkan Nama Bansos" disabled value="<?= $bansos->nama_bansos ?>">
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-lg-2 col-sm-2 control-label">Kategori Bansos</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="nama_bansos" placeholder="Masukkan Nama Bansos" disabled value="<?= $bansos->nama_kategori_bansos ?>">
            </div>
        </div> -->
    </div>
    <table class="table table table-hover mx-3">
        <thead>
            <tr class="thead-dark">
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Kriteria</th>
                <th scope="col">Tipe</th>
                <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
                <th scope="col">Bobot</th>
                <th scope="col"></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kriteria_bansoss as $key => $bk) : ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $bk->id_kriteria ?></td>
                    <td><?= $bk->nama_kriteria ?></td>
                    <td><?= $bk->tipe_kriteria ?></td>
                    
                    <?php if ($this->session->userdata('tipe_user') == "admin") : ?>
                    <td><?= $bk->nilai_bobot ?></td>
                    <td class="d-flex flex-wrap justify-content-end">
                        <form action="<?php echo base_url("/info/$bansos->id_bansos"); ?>" method="post" class="confirm-delete">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id_bansos" value="<?= $bk->id_bansos ?>">
                            <input type="hidden" name="id_kriteria" value="<?= $bk->id_kriteria ?>">
                            <button type="submit" class='btn btn-danger'>Hapus</button>
                        </form>
                    </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        on(".btn-run-ahp", "click", async (e, _this) => {
            e.preventDefault()

            let kriteria_bansos_count = <?= count($kriteria_bansoss) ?>
            
            if (kriteria_bansos_count <= 2) {
                Swal.fire('Kriteria paling sedikit 3 data, mohon tambah kriteria.')
                return false
            }

            window.location.href = _this.getAttribute("href")
        })
    })
</script>
