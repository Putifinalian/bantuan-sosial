<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <div class="container">
        <h2 class="text-center">Perhitungan Metode EDAS</h2>
        <div class="form-group text-right">
        </div>
        <?= $this->session->flashdata('notif') ?>

        <?php
        $this->load->view('index_edas/_tablist');
        ?>
    </div>
</div>

<script src="<?php echo base_url('assets/js/calculateEDAS.js'); ?>"></script>


<script>
    let $calculateEDAS
    document.addEventListener('DOMContentLoaded', () => {

        $('#table_alternatif').DataTable({
            responsive: true,
        });

        let kriteria = {}
        JSON.parse(`<?= json_encode($id_kriteria_) ?>`).forEach(k => {
            kriteria[k.id_kriteria] = {
                tipe: k.tipe_kriteria,
                bobot: Number(k.nilai_bobot)
            }
        })

        $calculateEDAS = new calculateEDAS({
            matrik_keputusan: JSON.parse(`<?= json_encode($matrik_keputusan) ?>`),
            kriteria,
        })
        // Langkah 2 : Solusi Rata-Rata (AV)
        let solusi_av = [
            ["AVJ"],
            ["Total"]
        ]

        //  Insert average
        Object.keys($calculateEDAS.$solusi_av).forEach((key, i) => {
            solusi_av[0].push($calculateEDAS.$solusi_av[key].average)
        })
        //  Insert Total
        Object.keys($calculateEDAS.$solusi_av).forEach((key, i) => {
            solusi_av[1].push($calculateEDAS.$solusi_av[key].values.reduce((prev, next) => prev + next))
        })

        $('#table_solusi_rata_rata').DataTable({
            data: solusi_av,
            columns: [{
                    title: 'No'
                },
                ...$calculateEDAS.$id_kriteria.map(ik => {
                    return {
                        title: ik
                    }
                })
            ],
        });
        // END ============================

        // Langkah 3 : Menghitung Jarak Positif dan Negatif
        let jarak_positif_negatif = []
        let pda = renumber($calculateEDAS.toggle_column_row_object($calculateEDAS.$jarak_positif_negatif.pda))
        let nda = renumber($calculateEDAS.toggle_column_row_object($calculateEDAS.$jarak_positif_negatif.nda))

        Object.keys(pda).forEach((id_calon_penerima, index) => {
            let jpn = [id_calon_penerima, ...Object.values(pda[id_calon_penerima]), ...Object.values(nda[id_calon_penerima])]
            jarak_positif_negatif.push(jpn)
        });

        $('#table_jarak_positif_negatif').DataTable({
            data: jarak_positif_negatif,
        });
        // END ============================

        // Langkah 4: Menentukan jumlah Terbobot Positif dan Negatif (SP/SN)
        let jumlah_terbobot = []
        let sp = renumber($calculateEDAS.toggle_column_row_object($calculateEDAS.$jumlah_terbobot.sp))
        let sn = renumber($calculateEDAS.toggle_column_row_object($calculateEDAS.$jumlah_terbobot.sn))
        Object.keys(sp).forEach((id_calon_penerima, index) => {
            let jpn = [
                id_calon_penerima,
                ...Object.values(sp[id_calon_penerima]),
                numberConverter($calculateEDAS.$jumlah_terbobot.spi[id_calon_penerima]),
                ...Object.values(sn[id_calon_penerima]),
                numberConverter($calculateEDAS.$jumlah_terbobot.sni[id_calon_penerima])
            ]
            jumlah_terbobot.push(jpn)
        });
        $('#table_jumlah_terbobot').DataTable({
            data: jumlah_terbobot,
            columnDefs: [{
                "className": "table-primary",
                "targets": [-1, -2 - Object.keys(kriteria).length]
            }],
        });
        // END ============================


        // Langkah 5: Normalisasi Jumlah Terbobot (NSP/NSN)
        let normalisasi = []
        Object.keys($calculateEDAS.$normalisasi.nsn).forEach((id_calon_penerima, index) => {
            normalisasi.push([
                id_calon_penerima,
                $calculateEDAS.$normalisasi.nsp[id_calon_penerima],
                $calculateEDAS.$normalisasi.nsn[id_calon_penerima],
            ])
        })

        $('#table_normalisasi').DataTable({
            data: normalisasi,
        });
        // END ============================

        // Langkah 6: Menghitung Nilai AS dengan mengubah nilai V menjadi 0.1 - 0.9
        // Skor Penilaian (AS)
        let skor_penilaian = $calculateEDAS.$skor_penilaian

        // skor_penilaian = skor_penilaian.map(sp => {
        //     let data
        //     if (sp.sort_rank == skor_penilaian.length || sp.sort_rank == 1) {
        //         let className = "table-primary"
        //         if (sp.sort_rank == 1) className = "table-warning"

        //         if (sp.sort_rank == skor_penilaian.length) {
        //             document.querySelector("#pills-7 .id-calon-penerima").innerText = sp.id_alternatif
        //         }
        //         data = [sp.id_alternatif]
        //         Object.keys(sp).forEach(key => {
        //             if (!new RegExp(["rank", "alternatif"].join('|')).test(key)) {
        //                 data.push(numberConverter(sp[key], 6), sp[key + "_rank"])
        //             }
        //         })
        //     } else {
        //         data = [sp.id_alternatif]
        //         Object.keys(sp).forEach(key => {
        //             if (!new RegExp(["rank", "alternatif"].join('|')).test(key)) {
        //                 data.push(numberConverter(sp[key], 6), sp[key + "_rank"])
        //             }
        //         })
        //     }
        //     return data
        // })
        
        skor_penilaian = skor_penilaian.map(sp => {
            renderPils7(sp, skor_penilaian)

            let data = []
            Object.keys(sp).forEach(key => {
                if (!new RegExp(["rank", "alternatif"].join('|')).test(key)) {
                    data.push(
                        sp.id_alternatif,
                        numberConverter(sp[key], 6),
                        sp[key + "_rank"]
                    )
                }
            })
            return data
        })

        function renderPils7(sp, skor_penilaian) {
            if (sp.sort_rank == skor_penilaian.length) {
                document.querySelector("#pills-7 .id-calon-penerima").innerText = sp.id_alternatif
            }
        }

        $('#table_skor_penilaian').DataTable({
            createdRow: function(row, data, index) {
                if (data[2] == 100) {
                    row.querySelectorAll("td").forEach(el => {
                        el.classList.add("table-primary")
                    })
                }
                if (data[2] == 1) {
                    row.querySelectorAll("td").forEach(el => {
                        el.classList.add("table-warning")
                    })
                }
            },
            data: skor_penilaian,
        });
        // END ============================

        // document.querySelector("#pills-6-tab").click()
    }, false);


    function numberConverter(string_number, limit = 6) {
        if (typeof string_number != "number") return string_number
        return parseFloat(string_number.toFixed(limit));
    }

    function renumber(obj) {
        let new_obj = {}
        Object.keys(obj).forEach(key => {
            if (!new_obj[key]) new_obj[key] = {}

            Object.keys(obj[key]).forEach(k => {
                new_obj[key][k] = numberConverter(obj[key][k])
            })
        })
        return new_obj
    }
</script>
