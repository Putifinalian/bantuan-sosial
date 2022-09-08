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
    <div class="table-responsive">
        <table class="table table-hover table-bordered cell-border" id="table_penerima" class="display" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Bansos</th>
                    <th scope="col">Kategori Bansos</th>
                    <th scope="col">Kriteria</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let data_penerima_bansoss = JSON.parse(`<?= json_encode($data_penerima_bansoss) ?>`)
        data_penerima_bansoss = data_penerima_bansoss.map((dpb, index) => {
            return [
                index + 1,
                dpb.id_calon_penerima,
                dpb.nama_calon_penerima,
                dpb.nama_bansos,
                dpb.nama_kategori_bansos,
                dpb.nama_kriteria,
                dpb.data,
            ]
        })
        $('#table_penerima').DataTable({
            data: data_penerima_bansoss,
        });
    })
</script>
