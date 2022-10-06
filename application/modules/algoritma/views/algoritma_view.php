<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <div class="container">
        <h2 class="text-center">Pilih Algoritma</h2>
        <div class="form-group text-right">
        </div>
        <?= $this->session->flashdata('notif') ?>
        <table class="table table-hover">
            <thead>
                <tr class="thead-dark">
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Algoritma</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($algoritma as $key =>  $algo) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $algo->id_algoritma ?></td>
                        <td><?= $algo->nama_algoritma ?></td>
                        <td>
                            <div class="input-group mb-3">
                                <select class="form-control">
                                    <?php foreach ($bansos_ as $bansos) : ?>
                                        <option value="<?= $bansos->id_bansos ?>"><?= $bansos->nama_bansos ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-run-edas" type="button" id="button-addon2">RUN</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    async function fetc(url, option) {
        let result = await fetch(url, {
            ...option,
            method: "POST",
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: Object.entries(option.body).map(([k, v]) => {
                return k + '=' + v
            }).join('&'),
        })

        result = await result.text()
        try {
            result = JSON.parse(result)
        } catch (error) {}
        return result
    }
    on(".btn-run-edas", "click", async (e, _this) => {
        e.preventDefault()
        let el_parent = _this.parentElement.parentElement
        let el_select = el_parent.querySelector("select")

        let check_bobot = await fetc(`<?= base_url("algoritma/check_bobot") ?>`, {
            body: {
                id_bansos: el_select.value
            }
        })
        // console.log("check_bobot", check_bobot);

        let check_is_pass = []
        check_is_pass.push(
            check_bobot.kriteria_bansos.every(kb => {
                let n = parseFloat(kb.nilai_bobot)
                return typeof n == 'number' && !isNaN(n)
            })
        )

        if (check_is_pass[0] != true) {
            Swal.fire('Nilai bobot belum lengkap!')
            return false
        }

        // console.log("check_is_pass", check_is_pass);

        let every_check_is_pass = check_is_pass.every(e => e == true)
        if (every_check_is_pass) {
            window.location.href = `<?= base_url("edas") ?>/hitung/${el_select.value}`
        }else{
            
        }
    })
</script>
