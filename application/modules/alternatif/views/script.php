<script>
    dom_kriteria()

    function dom_kriteria() {
        let kriteria_bansoss = JSON.parse(`<?= json_encode($kriteria_bansoss) ?>`)
        let data_penerima_bansos = JSON.parse(`<?= json_encode($data_penerima_bansos) ?>`)

        render(document.querySelector(`select[name="id_bansos"]`).value)
        document.querySelector(`select[name="id_bansos"]`).addEventListener("change", (e) => {
            render(e.target.value)
        })

        function render(id_bansos) {
            let html = ""
            kriteria_bansoss.forEach(kb => {
                if (id_bansos == kb.id_bansos) {
                    html += `<div class="form-group">
                            <label for="${snake(kb.nama_kriteria)}">${kb.nama_kriteria}</label>
                            <div class="input-group mb-3">
                                <input type="number" min="0" class="form-control" placeholder="${kb.nama_kriteria}" aria-describedby="basic-addon2" value="${get_data(kb.id_kriteria)}" name="${snake(kb.nama_kriteria)}">
                            </div>
                        </div>`
                }
            });
            document.querySelector(".wrapper-kriteria").innerHTML = html
        }

        function get_data(id_kriteria) {
            let result = null
            for (let index = 0; index < data_penerima_bansos.length; index++) {
                const dpb = data_penerima_bansos[index];
                if (dpb.id_kriteria == id_kriteria) result = dpb.data
            }
            return result == null ? "" : result
        }

        function snake(str) {
            return str
                .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                .map(x => x.toLowerCase())
                .join('_')
        }
    }
</script>
