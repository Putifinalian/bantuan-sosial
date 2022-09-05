<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <h2 class="page-header mb-3">Daftar Penerima Bansos</h2>
    <br>

    <style>
        .table thead tr th {
            font-weight: 600;
            border-bottom: 1px solid #b8c1ca;
            background-color: #303952;
            color: white;
        }
    </style>
    <div class="">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Bansos</th>
                    <th scope="col">Kategori Bansos</th>
                    <th scope="col">Kriteria</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_penerima_bansoss as $key => $dpb) : ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $dpb->nama_calon_penerima ?></td>
                        <td><?= $dpb->nama_bansos ?></td>
                        <td><?= $dpb->nama_kategori_bansos ?></td>
                        <td><?= $dpb->nama_kriteria ?></td>
                        <td><?= $dpb->data ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>
