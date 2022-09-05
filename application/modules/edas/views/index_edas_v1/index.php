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
        $this->load->view('index_edas_v1/_tablist');
        ?>
    </div>
</div>

<script src="<?php echo base_url('assets/js/calculateEDAS.v1.js'); ?>"></script>

<script>
    let $calculateEDAS = new calculateEDAS()

    // Langkah 2 : Solusi Rata-Rata (AV)
    let solusi_av = [
        [{
            className: "table-dark",
            value: "AVJ"
        }],
        [{
            className: "table-dark",
            value: "Total"
        }]
    ]

    //  Insert average
    Object.keys($calculateEDAS.$solusi_av).forEach((key, i) => {
        solusi_av[0].push($calculateEDAS.$solusi_av[key].average)
    })
    //  Insert Total
    Object.keys($calculateEDAS.$solusi_av).forEach((key, i) => {
        solusi_av[1].push($calculateEDAS.$solusi_av[key].values.reduce((prev, next) => prev + next))
    })

    document.querySelector("#pills-2").innerHTML = createTable({
        heads: ["No", ...$calculateEDAS.$id_kriteria],
        bodys: solusi_av,
    })
    // END ============================

    // Langkah 3 : Menghitung Jarak Positif dan Negatif
    let jarak_positif_negatif = []
    let pda = $calculateEDAS.toggle_column_row_object($calculateEDAS.$jarak_positif_negatif.pda)
    let nda = $calculateEDAS.toggle_column_row_object($calculateEDAS.$jarak_positif_negatif.nda)
    Object.keys(pda).forEach((id_calon_penerima, index) => {
        let jpn = [{
            className: "table-dark",
            value: id_calon_penerima
        }, ...Object.values(pda[id_calon_penerima]), ...Object.values(nda[id_calon_penerima])]
        jarak_positif_negatif.push(jpn)
    });
    document.querySelector("#pills-3 tbody").innerHTML = createTable({
        bodys: jarak_positif_negatif,
    })
    // END ============================

    // Langkah 4: Menentukan jumlah Terbobot Positif dan Negatif (SP/SN)
    let jumlah_terbobot = []
    let sp = $calculateEDAS.toggle_column_row_object($calculateEDAS.$jumlah_terbobot.sp)
    let sn = $calculateEDAS.toggle_column_row_object($calculateEDAS.$jumlah_terbobot.sn)
    Object.keys(sp).forEach((id_calon_penerima, index) => {
        let jpn = [{
                className: "table-dark",
                value: id_calon_penerima
            },
            ...Object.values(sp[id_calon_penerima]),
            {
                className: "table-primary",
                value: $calculateEDAS.$jumlah_terbobot.spi[id_calon_penerima]
            }, ...Object.values(sn[id_calon_penerima]),
            {
                className: "table-primary",
                value: $calculateEDAS.$jumlah_terbobot.sni[id_calon_penerima]
            }
        ]
        jumlah_terbobot.push(jpn)
    });
    document.querySelector("#pills-4 tbody").innerHTML = createTable({
        bodys: jumlah_terbobot,
    })
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
    document.querySelector("#pills-5").innerHTML = createTable({
        heads: ["ID Calon Penerima", "NSPi", "NSNi"],
        bodys: normalisasi
    })
    // END ============================

    // Langkah 6: Menghitung Nilai AS dengan mengubah nilai V menjadi 0.1 - 0.9
    // Skor Penilaian (AS)
    let skor_penilaian = $calculateEDAS.$skor_penilaian
    skor_penilaian = skor_penilaian.map(sp => {
        let data
        if (sp.sort_rank == skor_penilaian.length || sp.sort_rank == 1) {
            let className = "table-primary"
            if (sp.sort_rank == 1) className = "table-warning"

            if (sp.sort_rank == skor_penilaian.length) {
                document.querySelector("#pills-7 .id-calon-penerima").innerText = sp.id_alternatif
            }
            data = [{
                className: className,
                value: sp.id_alternatif
            }]
            Object.keys(sp).forEach(key => {
                if (!new RegExp(["rank", "alternatif"].join('|')).test(key)) {
                    data.push({
                        className: className,
                        value: sp[key]
                    }, {
                        className: className,
                        value: sp[key + "_rank"]
                    })
                }
            })
        } else {
            data = [{
                className: "table-dark",
                value: sp.id_alternatif
            }]
            Object.keys(sp).forEach(key => {
                if (!new RegExp(["rank", "alternatif"].join('|')).test(key)) {
                    data.push(sp[key], sp[key + "_rank"])
                }
            })
        }

        return data
    })
    document.querySelector("#pills-6 tbody").innerHTML = createTable({
        bodys: skor_penilaian
    })
    // END ============================


    function createTable({
        heads = [],
        bodys = [],
        footers = [],
    }) {
        let html = `<div class="table-responsive"><table class="table table-hover mt-3 table-bordered"><thead ><tr>`
        heads.forEach(head => {
            html += `<th scope="col" class="table-dark">${head}</th>`
        });

        html += `</tr></thead><tbody>`
        bodys.forEach(body => {
            html += `<tr>`
            body.forEach(content => {
                let className = ""
                let value = content
                if (typeof content == "object") {
                    value = content.value
                    className = content.className
                }

                html += `<th scope="col" class="${className}">${numberConverter(value)}</th>`
            });
            html += `</tr>`
        });

        html += `</tbody>`

        if (footers.length > 0) {
            html += `<thead class="thead-dark"><tr>`
            footers.forEach(footer => {
                html += `<th scope="col">${numberConverter(footer)}</th>`
            });
            html += `</tr></thead>`
        }
        html += `</table></div>`

        return html

    }

    function numberConverter(string_number) {
        if (typeof string_number != "number") return string_number
        return parseFloat(string_number.toFixed(6));
    }
</script>
