class calculateAHP {
    constructor() {
        const _this = this
        this.$table_data = null
        this.$perbandingan_kriteria = null
        this.$normalisasi_matrik = null
        this.$unkownCounter = null
        this.$check_consistency = null

        this.init()
    }

    init() {
        console.log("START calculate AHP");

        this.$table_data = this.get_table_data()
        console.log("$table_data", this.$table_data);

        // Langkah 1 : Matrik Perbandingan Kriteria
        this.$perbandingan_kriteria = this.perbandingan_kriteria()
        console.log("Langkah 1 : Matrik $perbandingan_kriteria = ", this.$perbandingan_kriteria);

        // Langkah 2: Normalisasi Matrik
        this.$normalisasi_matrik = this.normalisasi_matrik()
        console.log("Langkah 2: $normalisasi_matrik = ", this.$normalisasi_matrik);

        // Langkah 3: Hitung Bobot
        this.$hitung_bobot = this.hitung_bobot()
        console.log("Langkah 3: $hitung_bobot = ", this.$hitung_bobot);

        // Langkah 4: Hitung unkownCounter
        this.$unkownCounter = this.unkownCounter()
        console.log("Langkah 4: $unkownCounter = ", this.$unkownCounter);

        // Langkah 5: Check Consistency
        this.$check_consistency = this.check_consistency()
        console.log("Langkah 5: $check_consistency = ", this.$check_consistency);

        console.log("calculate AHP DONE");

    }

    check_consistency (){
        let lambda_maks = Object.values(this.$unkownCounter.weight).reduce((accumulator, curr) => accumulator + curr)
        
        let n_number = 5
        // let ci = (H88-A88)/(A88-1)
        let ci = (lambda_maks-n_number)/(n_number-1)
        let ri_number = 1.12
        let cr = ci/ri_number
        return {
            lambda_maks, ci, cr
        }
    }

    get_table_data() {
        const _this = this
        var data_saaty = {}
        let saaty_selects = document.querySelector(".table-perbandingan-saaty").querySelectorAll("select")

        for (let select_index = 0; select_index < saaty_selects.length; select_index++) {
            const select_el = saaty_selects[select_index];
            let from = select_el.getAttribute("data-from")
            let to = select_el.getAttribute("data-to")
            let value = select_el.value
            if (!data_saaty[to]) data_saaty[to] = []
            data_saaty[to].push(parseFloat(value))
        }

        return data_saaty
    }

    // Langkah 1 : Matrik Perbandingan Kriteria
    perbandingan_kriteria() {
        const _this = this
        let data_saaty_reduce = {}
        Object.keys(this.$table_data).forEach((key) => {
            data_saaty_reduce[key] = _this.$table_data[key].reduce((accumulator, curr) => accumulator + curr)
        })
        return data_saaty_reduce
    }

    // langkah 2: Normalisasi Matrik
    normalisasi_matrik() {
        const _this = this
        let column = {}
        Object.keys(_this.$perbandingan_kriteria).forEach(function (pk_key) {
            if (!column[pk_key]) column[pk_key] = []
        })
        Object.keys(_this.$table_data).forEach(function (table_data_key) {
            _this.$table_data[table_data_key].forEach(value => {
                column[table_data_key].push(value / _this.$perbandingan_kriteria[table_data_key])
            })
        });
        return { column, row: _this.column_to_row(column) }
    }

    // Langkah 3: Hitung Bobot
    hitung_bobot() {
        const _this = this
        let weight = {}
        let row = _this.$normalisasi_matrik.row

        Object.keys(row).forEach((row_id) => {
            weight[row_id] = row[row_id].reduce((accumulator, curr) => accumulator + curr) / Object.keys(row).length
        });

        return {
            weight
        }
    }

    unkownCounter() {
        const _this = this
        let column = {}
        let weight = {}
        Object.keys(_this.$hitung_bobot.weight).forEach((bobot_id, bobot_i) => {
            Object.keys(_this.$table_data).forEach((td_id, td_i) => {
                _this.$table_data[bobot_id].forEach((tr_v, tr_i) => {
                    if (!column[bobot_id]) column[bobot_id] = []
                    column[bobot_id][tr_i] = _this.$hitung_bobot.weight[bobot_id] * tr_v
                })
            })
        })

        let row = _this.column_to_row(column)

        Object.keys(row).forEach((row_id) => {
            weight[row_id] = row[row_id].reduce((accumulator, curr) => accumulator + curr)
        });

        return {
            column, row, weight
        }
    }

    column_to_row(column) {
        let row = {}
        Object.keys(column).forEach((column_id, column_index) => {
            if (!row[column_id]) row[column_id] = []
            Object.keys(column).forEach((row_id, row_index) => {
                row[column_id].push(column[row_id][column_index])
            })
        });

        return row
    }
}
