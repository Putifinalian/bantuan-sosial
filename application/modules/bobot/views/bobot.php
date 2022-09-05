<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <h1 class="page-header mb-3">Tabel Pembobotan Kriteria</h1>



    <!-- <div class="bd-callout bd-callout-info">
        <p class="font-weight-bold h5">Catatan :</p>
        <div>
            <ul>
                <li>1 - Sama pentingnya</li>
                <li>2 - Sama hingga sedikit lebih penting</li>
                <li>3 - Sedikit lebih penting</li>
                <li>4 - Sedikit lebih hingga jelas lebih penting</li>
                <li>5 - Jelas Lebih penting</li>
                <li>6 - Jelas hingga sangat jelas lebih penting</li>
                <li>7 - Sangat jelas lebih penting</li>
                <li>8 - Sangat jelas hingga mutlak lebih penting</li>
                <li>9 - Mutlak lebih penting</li>
                <li>1/2 - satu bagi sama hingga sedikit lebih penting</li>
                <li>1/3 - satu bagi sedikit lebih penting</li>
                <li>1/4 - satu bagi sedikit lebih hingga jelas lebih penting</li>
                <li>1/5 - satu bagi jelas Lebih penting</li>
                <li>1/6 - satu bagi jelas hingga sangat jelas lebih penting</li>
                <li>1/7 - satu bagi sangat jelas lebih penting</li>
                <li>1/8 - satu bagi sangat jelas hingga mutlak lebih penting</li>
                <li>1/9 - satu bagi mutlak lebih penting</li>
            </ul>
        </div>
    </div> -->
    <div class="float-right">
        <!-- <button type="button" class="btn btn-primary mb-3 mr-2 hide gunakan-data-default">Gunakan Data Default</button> -->
        <button class="btn btn-primary btn-start-calculate-ahp mb-3" data-toggle="modal" data-target="#modal-bobot-result">Cek Konsistensi Bobot</button>
    </div>


    <?php $this->load->view('_bobot/table'); ?>
    <?php $this->load->view('_bobot/result'); ?>

</div>


<script src="<?php echo base_url('assets/js/calculateAHP.js'); ?>"></script>

<script>
    let $calculateAHP = new calculateAHP()
    $calculateAHP.init()

    if (document.querySelector(".gunakan-data-default")) {
        if (Object.keys($calculateAHP.$table_data).length == 5) {
            document.querySelector(".gunakan-data-default").classList.remove("hide")

            document.querySelector(".gunakan-data-default").addEventListener("click", () => {
                let static = [
                    1, 1, 1, 3, 9,
                    1, 1, 1, 3, 7,
                    1, 1, 1, 5, 7,
                    0.333, 0.333, 0.2, 1, 3,
                    0.111, 0.143, 0.143, 0.333, 1
                ]
                document.querySelectorAll("select").forEach((select_el, select_i) => {
                    select_el.querySelectorAll("option").forEach((option_el, option_i) => {
                        if (parseFloat(option_el.value).toFixed(3) == static[select_i].toFixed(3)) option_el.setAttribute("selected", true)
                    })
                })

            })
        }
    }



    async function update_bobot_kriteria_bansos(value) {
        value = Object.keys(value).map((key, index) => {
            return {
                id_kriteria: key,
                bobot: Object.values(value)[index],
            }
        })

        // console.log("value", value);

        let data = {
            id_bansos: "<?= $bansos->id_bansos ?>",
            bobot: JSON.stringify(value)
        }

        let body = Object.entries(data).map(([k, v]) => {
            return k + '=' + v
        }).join('&')

        // console.log("data", data);
        // console.log("body", body);

        let result = await fetch(`<?= base_url("/bobot/update_bobot_kriteria_bansos") ?>`, {
            method: "POST",
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body
        })
        result = await result.text()
        try {
            result = JSON.parse(result)
        } catch (error) {}
        // console.log("result", result);

        return true
    }

    document.querySelector(".btn-start-calculate-ahp").addEventListener("click", () => {
        $calculateAHP = new calculateAHP()
        $calculateAHP.init()

        if ($calculateAHP.$check_consistency.cr <= 0.1) {
            update_bobot_kriteria_bansos($calculateAHP.$hitung_bobot.weight)
        }

        // RENDER HTML: Langkah 1 : Matrik Perbandingan Kriteria 
        document.querySelector("#pills-1").innerHTML = createTable({
            heads: Object.keys($calculateAHP.$table_data),
            // bodys: Object.values($calculateAHP.$table_data),
            bodys: Object.values($calculateAHP.column_to_row(($calculateAHP.$table_data))),
            footers: Object.values($calculateAHP.$perbandingan_kriteria),
        })

        let value_key, value_nmr, value_unkown

        value_key = Object.keys($calculateAHP.$table_data)
        value_key.push("Bobot")
        value_key.unshift("Kriteria")

        value_nmr = Object.values($calculateAHP.$normalisasi_matrik.row)
        value_nmr.forEach((val, index) => {

            value_nmr[index].unshift(Object.keys($calculateAHP.$table_data)[index])

            value_nmr[index].push({
                value: Object.values($calculateAHP.$hitung_bobot.weight)[index],
                className: "table-dark"
            })
        })

        // RENDER HTML: Langkah 2 : Normalisasi Matrik  
        document.querySelector("#pills-2").innerHTML = createTable({
            heads: value_key,
            bodys: value_nmr,
            // footers: Object.values($calculateAHP.$hitung_bobot.weight),
        })

        value_unkown = Object.values($calculateAHP.$unkownCounter.row)
        value_unkown.forEach((val, index) => {
            value_unkown[index].push({
                value: Object.values($calculateAHP.$unkownCounter.weight)[index],
                className: "table-dark"
            })
        })

        value_key = Object.keys($calculateAHP.$table_data)
        value_key.push("Lamda Maks")

        // RENDER HTML: Langkah 3 : Hasil
        document.querySelector("#pills-3").innerHTML = createTable({
            heads: value_key,
            // bodys: Object.values($calculateAHP.$unkownCounter.row),
            bodys: value_unkown,
            // footers: Object.values($calculateAHP.$unkownCounter.weight),
        })


        let html_lm = createTable({
            heads: ["Lamda Maks", "CI", "CR"],
            // bodys: Object.values($calculateAHP.$unkownCounter.row),
            bodys: [
                [
                    $calculateAHP.$check_consistency.lambda_maks,
                    $calculateAHP.$check_consistency.ci,
                    $calculateAHP.$check_consistency.cr,
                ]
            ],
            // footers: Object.values($calculateAHP.$unkownCounter.weight),
        })

        let html_alert = (className, msg) => `
        <div class="alert alert-${className}" role="alert">
                ${msg}
       </div>
        `
        if ($calculateAHP.$check_consistency.cr <= 0.1) {
            html_lm += html_alert("success", `<p class="m-0">Perhitungan sudah BENAR</p>`)
            html_lm += `<a class="btn btn-primary" href="<?= base_url("info/$bansos->id_bansos") ?>">NEXT</a>`
        } else html_lm += html_alert("danger", "Perhitungan masih salah, silahkan input ulang tabel pembobotan kriteria")

        document.querySelector("#pills-4").innerHTML = html_lm

    })

    function createTable({
        heads = [],
        bodys = [],
        footers = [],
    }) {
        let html = `<div class="table-responsive"><table class="table table-hover mt-3"><thead class="thead-dark"><tr>`
        heads.forEach(head => {
            html += `<th scope="col">${head}</th>`
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

        html += `<thead class="thead-dark"><tr>`
        footers.forEach(footer => {
            html += `<th scope="col">${numberConverter(footer)}</th>`
        });
        html += `</tr></thead>`

        html += `</table></table>`

        return html

    }

    function numberConverter(string_number) {
        if (typeof string_number != "number") return string_number
        return parseFloat(string_number.toFixed(3));
    }
</script>
