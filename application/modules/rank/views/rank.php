<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <h1 class="text-center" class="page-header mb-3">Daftar Penerima Bansos</h1>
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
                <tr class="table-filter-input">
                    <th rowspan="2" class="align-middle text-center" data-label="Nomor">Nomor</th>
                    <th rowspan="2" class="align-middle text-center" data-label="Nama">Nama</th>
                    <th rowspan="2" class="align-middle text-center" data-label="ID">ID</th>
                    <th class="align-middle text-center" data-label="Bansos">Bansos</th>
                    <th class="align-middle text-center" data-label="Kategori Bansos">Kategori Bansos</th>
                    <th class="align-middle text-center" data-label="Kriteria">Kriteria</th>
                    <th rowspan="2" class="align-middle text-center" data-label="Data">Data</th>
                </tr>
                <tr>
                    <th class="align-middle text-center">
                        Bansos
                    </th>
                    <th class="align-middle text-center">
                        Kategori Bansos
                    </th>
                    <th class="align-middle text-center">
                        Kriteria
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        $(document).ready(function() {
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(val, index) {
                            let column = this;
                            let headers = []
                            let used_headers = [
                                'Bansos', 'Kategori Bansos', 'Kriteria'
                            ]
                            document.querySelectorAll("#table_penerima thead th").forEach(el => {
                                headers.push(el.innerText)
                            })

                            if (used_headers.includes(headers[val])) {
                                let select = $('<select><option value=""></option></select>')
                                    .appendTo($(`#table_penerima .table-filter-input th[data-label="${headers[val]}"]`).empty())
                                    .on('change', function() {
                                        let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                        column.search(val ? val : "", true, false).draw();
                                    });

                                column = column.data()
                                column = column.unique()
                                column = column.sort()
                                column.each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                            }

                        });
                },
            });


        });

    })
</script>
