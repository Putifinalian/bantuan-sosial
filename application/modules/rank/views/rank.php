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
    <div>
        <?php $this->load->view("filter"); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered cell-border" id="table_penerima" class="display" style="width:100%">
            <thead>
                <tr class="table-filter-input">
                    <th class="align-middle text-center" data-label="Nomor">Nomor</th>
                    <th class="align-middle text-center" data-label="Nomor">Rank</th>
                    <th class="align-middle text-center" data-label="Nama">Nama</th>
                    <th class="align-middle text-center" data-label="ID">ID</th>
                    <th class="align-middle text-center" data-label="Bansos">Bansos</th>
                    <th class="align-middle text-center" data-label="Kategori Bansos">Kategori Bansos</th>
                    <th class="align-middle text-center" data-label="Kriteria">Kriteria</th>
                    <th class="align-middle text-center" data-label="Data">Data</th>
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
                    dpb.rank,
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
                // "dom": '<"dt-buttons"Bf><"clear">lirt',
                buttons: [
                    "colvis", 'copy', 'csv', 'excel', 'pdf', 'print'
                ],

                // "paging": true,
                // "autoWidth": true,
                // "buttons": [{
                //     text: 'Custom PDF',
                //     extend: 'pdfHtml5',
                //     filename: 'Report Data Penerima',
                //     orientation: 'landscape', //portrait
                //     pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                //     exportOptions: {
                //         columns: ':visible',
                //         search: 'applied',
                //         order: 'applied'
                //     },
                //     customize: function(doc) {
                //         //Remove the title created by datatTables
                //         doc.content.splice(0, 1);
                //         //Create a date string that we use in the footer. Format is dd-mm-yyyy
                //         var now = new Date();
                //         var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                //         // Logo converted to base64
                //         // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                //         // The above call should work, but not when called from codepen.io
                //         // So we use a online converter and paste the string in.
                //         // Done on http://codebeautify.org/image-to-base64-converter
                //         // It's a LONG string scroll down to see the rest of the code !!!
                //         let logo = '';
                //         // A documentation reference can be found at
                //         // https://github.com/bpampuch/pdfmake#getting-started
                //         // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                //         // or one number for equal spread
                //         // It's important to create enough space at the top for a header !!!
                //         doc.pageMargins = [20, 60, 20, 30];
                //         // Set the font size fot the entire document
                //         doc.defaultStyle.fontSize = 7;
                //         // Set the fontsize for the table header
                //         doc.styles.tableHeader.fontSize = 7;
                //         // Create a header object with 3 columns
                //         // Left side: Logo
                //         // Middle: brandname
                //         // Right side: A document title

                //         // doc['header'] = (function() {
                //         //     return {
                //         //         columns: [{
                //         //                 image: logo,
                //         //                 width: 24
                //         //             },
                //         //             {
                //         //                 alignment: 'left',
                //         //                 italics: true,
                //         //                 text: 'dataTables',
                //         //                 fontSize: 18,
                //         //                 margin: [10, 0]
                //         //             },
                //         //             {
                //         //                 alignment: 'right',
                //         //                 fontSize: 14,
                //         //                 text: 'Custom PDF export with dataTables'
                //         //             }
                //         //         ],
                //         //         margin: 20
                //         //     }
                //         // });
                //         // Create a footer object with 2 columns
                //         // Left side: report creation date
                //         // Right side: current page and total pages
                //         doc['footer'] = (function(page, pages) {
                //             return {
                //                 columns: [{
                //                         alignment: 'left',
                //                         text: ['Created on: ', {
                //                             text: jsDate.toString()
                //                         }]
                //                     },
                //                     {
                //                         alignment: 'right',
                //                         text: ['page ', {
                //                             text: page.toString()
                //                         }, ' of ', {
                //                             text: pages.toString()
                //                         }]
                //                     }
                //                 ],
                //                 margin: 20
                //             }
                //         });
                //         // Change dataTable layout (Table styling)
                //         // To use predefined layouts uncomment the line below and comment the custom lines below
                //         // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                //         var objLayout = {};
                //         objLayout['hLineWidth'] = function(i) {
                //             return .5;
                //         };
                //         objLayout['vLineWidth'] = function(i) {
                //             return .5;
                //         };
                //         objLayout['hLineColor'] = function(i) {
                //             return '#aaa';
                //         };
                //         objLayout['vLineColor'] = function(i) {
                //             return '#aaa';
                //         };
                //         objLayout['paddingLeft'] = function(i) {
                //             return 4;
                //         };
                //         objLayout['paddingRight'] = function(i) {
                //             return 4;
                //         };
                //         doc.content[0].layout = objLayout;

                //         console.log("doc.content", doc.content);
                        
                //     }
                // }],

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
                                let slug = headers[val].toLocaleLowerCase().split(" ").join("-")
                                console.log("slug", slug);
                                let select = $('<select class="form-control"><option value=""></option></select>')
                                    .appendTo($(`.wrapper-filter-${slug}`).empty())
                                    .on('change', function() {
                                        let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                        column.search(val ? val : "", true, false).draw();
                                    });
                                // let select = $('<select><option value=""></option></select>')
                                //     .appendTo($(`#table_penerima .table-filter-input th[data-label="${headers[val]}"]`).empty())
                                //     .on('change', function() {
                                //         let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                //         column.search(val ? val : "", true, false).draw();
                                //     });

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
