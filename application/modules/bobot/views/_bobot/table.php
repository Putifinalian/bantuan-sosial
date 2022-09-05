<?php $matriks = array(
    '1 - Sama pentingnya'  => 1,
    '2 - Sama hingga sedikit lebih penting'  => 2,
    '3 - Sedikit lebih penting'  => 3,
    '4 - Sedikit lebih hingga jelas lebih penting'  => 4,
    '5 - Jelas Lebih penting'  => 5,
    '6 - Jelas hingga sangat jelas lebih penting'  => 6,
    '7 - Sangat jelas lebih penting'  => 7,
    '8 - Sangat jelas hingga mutlak lebih penting'  => 8,
    '9 - Mutlak lebih penting'  => 9,
    '1/2 - satu bagi sama hingga sedikit lebih penting'  => 0.5,
    '1/3 - satu bagi sedikit lebih penting'  => 0.3333333333333333,
    '1/4 - satu bagi sedikit lebih hingga jelas lebih penting'  => 0.25,
    '1/5 - satu bagi jelas Lebih penting'  => 0.2,
    '1/6 - satu bagi jelas hingga sangat jelas lebih penting'  => 0.16666666666666666,
    '1/7 - satu bagi sangat jelas lebih penting'  => 0.14285714285714285,
    '1/8 - satu bagi sangat jelas hingga mutlak lebih penting'  => 0.125,
    '1/9 - satu bagi mutlak lebih penting'  => 0.1111111111111111,
);
?>
<?php $inserted_table = [] ?>
<div class="table-responsive">
    <table class="table table-striped table-perbandingan-saaty">
        <tbody>

            <?php
            function checkRasioKriteria($baris, $kolom, $matrik, $rasio_kriteria)
            {
                $rk = null;
                foreach ($rasio_kriteria as $rki) {
                    if ($rki->id_kriteria_1 == $baris->id_kriteria && $rki->id_kriteria_2 == $kolom->id_kriteria) {
                        $rk = $rki;
                    }
                }
                if(!$rk) return false;
                if (round(floatval($rk->rasio), 2) == round(floatval($matrik), 2)) return true;
                return false;
            }
            ?>
            <?php $nomor = 1 ?>
            <?php foreach ($kriterias as $key_baris => $baris) : ?>
                <?php foreach ($kriterias as $key_kolom => $kolom) : ?>

                    <?php
                    $setara = false;
                    if ($baris->id_kriteria == $kolom->id_kriteria) {
                        $setara = true;
                    } ?>

                    <?php array_push($inserted_table, "$baris->id_kriteria-$kolom->id_kriteria") ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= $baris->id_kriteria ?> - <?= $baris->nama_kriteria ?></td>
                        <td>
                            <select class="form-select" aria-label="Default select example" <?= $setara ? "disabled" : "" ?> data-from="<?= $baris->id_kriteria ?>" data-to="<?= $kolom->id_kriteria ?>">
                                <?php if ($setara) : ?>
                                    <option value="1" <?= $setara ? "selected" : "" ?>>1 - Sama pentingnya
                                    </option>
                                <?php else : ?>
                                    <?php foreach ($matriks as $key => $matrik) : ?>
                                        <option value="<?= $matrik ?>" <?= checkRasioKriteria($baris, $kolom, $matrik, $rasio_kriteria) ? "selected" : "" ?>><?= $key ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </td>
                        <td><?= $kolom->id_kriteria ?> - <?= $kolom->nama_kriteria ?></td>
                    </tr>

                    <?php $nomor++ ?>
                <?php endforeach ?>
            <?php endforeach ?>

        </tbody>
    </table>
</div>


<script>
    let select_els = document.querySelectorAll("select:not([disabled])")
    select_els.forEach((select_el, select_i) => {
        select_el.addEventListener("change", (event) => {
            let target = {
                value: event.target.value,
                from: event.target.getAttribute("data-from"),
                to: event.target.getAttribute("data-to"),
            }
            update_select(target)
            update_rasio_kriteria()
        })
    })

    // update_rasio_kriteria()

    async function update_rasio_kriteria() {
        // From itu baris
        // To itu kolom

        let nilai = get_all_select_data()
        nilai = nilai.map(n => {
            return {
                nilai: n.value,
                baris: n.from,
                kolom: n.to,
            }
        })
        let data = {
            id_bansos: "<?= $bansos->id_bansos ?>",
            nilai: JSON.stringify(nilai)
        }

        let body = Object.entries(data).map(([k, v]) => {
            return k + '=' + v
        }).join('&')

        // console.log("nilai", nilai);
        // console.log("data", data);
        // console.log("body", body);

        let result = await fetch(`<?= base_url("/bobot/update_rasio_kriteria") ?>`, {
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

        console.log("result", result);
    }

    function update_select({
        value,
        from,
        to
    }) {
        let el = document.querySelector(`[data-from="${to}"][data-to="${from}"]`)
        let hasil = (1 / parseFloat(value)).toFixed(3)
        el.querySelectorAll("option").forEach((option_el, option_i) => {
            option_el.removeAttribute("selected")
            if (parseFloat(option_el.getAttribute("value")).toFixed(3) == parseFloat(hasil)) {
                option_el.setAttribute("selected", true)
                console.log(`value = ${option_el.value}`)
            }
        })
        normalizeDisabledSelect()
    }

    normalizeDisabledSelect()

    function normalizeDisabledSelect() {
        document.querySelectorAll("select:is([disabled])").forEach((select_el, select_i) => {
            select_el.querySelectorAll("option").forEach((option_el, option_i) => {
                option_el.removeAttribute("selected")
                if (option_el.getAttribute("value") == 1) {
                    option_el.setAttribute("selected", true)
                    console.log(`value = ${option_el.value}`)
                }
            })
        })
    }

    function get_all_select_data() {
        let data = []
        document.querySelectorAll("select").forEach((select_el, select_i) => {
            data.push({
                value: select_el.value,
                from: select_el.getAttribute("data-from"),
                to: select_el.getAttribute("data-to")
            })
        })
        return data
    }
</script>
