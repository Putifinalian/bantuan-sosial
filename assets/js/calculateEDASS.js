class calculateEDAS {
    constructor({
        matrik_keputusan,
        kriteria,
    }) {
      
        const _this = this
        this.$kriteria = kriteria
        this.$id_kriteria = Object.keys(kriteria)

        this.$table_selector = "table.table-matrik-keputusan"
        if (document.querySelector(this.$table_selector)) {
            let use_log = true

            if (use_log) console.log("START calculate EDAS");

            // Langkah 1 : Matriks Keputusan
            // this.$matrik_keputusan = this.matrik_keputusan()
            // console.table("$matrik_keputusan", this.$matrik_keputusan);
            this.$matrik_keputusan = matrik_keputusan
            if (use_log) console.table("$matrik_keputusan", this.$matrik_keputusan);
            // END ============================

            // Langkah 2 : Solusi Rata-Rata (AV)
            this.$solusi_av = this.solusi_av()
            if (use_log) console.log("$solusi_av", this.$solusi_av);
            // END ============================

            // Langkah 3 : Menghitung Jarak Positif dan Negatif
            this.$jarak_positif_negatif = this.jarak_positif_negatif()
            if (use_log) console.log("$jarak_positif_negatif", this.$jarak_positif_negatif);
            // END ============================

            // Langkah 4: Menentukan jumlah Terbobot Positif dan Negatif (SP/SN)
            this.$jumlah_terbobot = this.jumlah_terbobot()
            if (use_log) console.log("$jumlah_terbobot", this.$jumlah_terbobot);
            // END ============================


            // Langkah 5: Normalisasi Jumlah Terbobot (NSP/NSN)
            this.$normalisasi = this.normalisasi()
            if (use_log) console.log("$normalisasi", this.$normalisasi);
            // END ============================

            // Langkah 6: Menghitung Nilai AS dengan mengubah nilai V menjadi 0.1 - 0.9
            // Skor Penilaian (AS)
            this.$skor_penilaian = this.skor_penilaian()
            if (use_log) console.log("$skor_penilaian", this.$skor_penilaian);
            // END ============================

            if (use_log) console.log("calculate EDAS DONE");
        }
    }

    skor_penilaian() {
        const _this = this
        let v_number = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9]
        let row = {}
        Object.keys(_this.$normalisasi.nsp).forEach(id_alternatif => {
            if (!row[id_alternatif]) row[id_alternatif] = {}
            v_number.forEach(vn => {
                row[id_alternatif][vn + "_rank"] = null
                row[id_alternatif][vn] = vn * (_this.$normalisasi.nsp[id_alternatif] + _this.$normalisasi.nsn[id_alternatif])
            })
        })

        let sort = obj => Object.keys(obj).sort(function (a, b) { return obj[a] - obj[b] })
        let column = _this.toggle_column_row_object(row)
        Object.keys(column).forEach(vn => {
            if (!vn.includes("rank")) {
                sort(column[vn]).forEach((id_alternatif, index) => {
                    column[vn + "_rank"][id_alternatif] = index + 1
                })
            }
        })

        row = _this.toggle_column_row_object(column)
        Object.keys(row).forEach(id_alternatif => {
            let total_rank = 0
            Object.keys(row[id_alternatif]).forEach(vn => {
                if (vn.includes("_rank")) total_rank += row[id_alternatif][vn]
            })
            row[id_alternatif]["total_rank"] = total_rank
        })

        column = _this.toggle_column_row_object(row)
        if (!column["sort_rank"]) column["sort_rank"] = {}
        sort(column["total_rank"]).forEach((id_alternatif, index) => {
            column["sort_rank"][id_alternatif] = index + 1
        })

        row = _this.toggle_column_row_object(column)
        row = _this.obj_to_arr(row, "id_alternatif")
        row = row.sort((a, b) => {
            return a.id_alternatif - b.id_alternatif;
        });

        return row
    }

    obj_to_arr(obj, new_key) {
        let arr = []
        Object.keys(obj).forEach(key => {
            arr.push({ ...obj[key], [new_key]: key })
        })
        return arr
    }

    normalisasi() {
        const _this = this
        let nsp = {}, nsn = {}

        Object.keys(_this.$jumlah_terbobot.spi).forEach((id_alternatif) => {
            if (!nsp[id_alternatif]) nsp[id_alternatif] = null
            let spi = _this.$jumlah_terbobot.spi[id_alternatif]
            nsp[id_alternatif] = Number(spi) / Math.max(...Object.values(_this.$jumlah_terbobot.spi))
        })

        Object.keys(_this.$jumlah_terbobot.sni).forEach((id_alternatif) => {
            if (!nsn[id_alternatif]) nsn[id_alternatif] = null
            let sni = _this.$jumlah_terbobot.sni[id_alternatif]
            nsn[id_alternatif] = 1 - (Number(sni) / Math.max(...Object.values(_this.$jumlah_terbobot.sni)))
        })

        return { nsp, nsn }
    }

    jumlah_terbobot() {
        const _this = this
        let spi = {}, sni = {}
        let sp = {}
        let pda = _this.$jarak_positif_negatif.pda
        let nda = _this.$jarak_positif_negatif.nda
        Object.keys(pda).forEach((id_kriteria, kriteria_i) => {
            Object.keys(pda[id_kriteria]).forEach((id_alternatif, alternatif_i) => {
                if (!sp[id_kriteria]) sp[id_kriteria] = {}
                sp[id_kriteria][id_alternatif] = pda[id_kriteria][id_alternatif] * _this.$kriteria[id_kriteria].bobot
            })
        })

        let sp_row = _this.toggle_column_row_object(sp)
        Object.keys(sp_row).forEach((id_alternatif) => {
            if (!spi[id_alternatif]) spi[id_alternatif] = null
            spi[id_alternatif] = Object.values(sp_row[id_alternatif]).reduce((prev, next) => prev + next)
        })

        let sn = {}
        Object.keys(nda).forEach((id_kriteria, kriteria_i) => {
            Object.keys(nda[id_kriteria]).forEach((id_alternatif, alternatif_i) => {
                if (!sn[id_kriteria]) sn[id_kriteria] = {}
                sn[id_kriteria][id_alternatif] = nda[id_kriteria][id_alternatif] * _this.$kriteria[id_kriteria].bobot
            })
        })

        let sn_row = _this.toggle_column_row_object(sn)
        Object.keys(sn_row).forEach((id_alternatif) => {
            if (!sni[id_alternatif]) sni[id_alternatif] = null
            sni[id_alternatif] = Object.values(sn_row[id_alternatif]).reduce((prev, next) => prev + next)
        })

        return {
            sp, sn, spi, sni
        }
    }

    solusi_av() {
        const _this = this

        let kriteria_data = {}
        this.$matrik_keputusan.forEach((mk) => {
            Object.keys(mk).forEach((key, index) => {
                if (key != "id_calon_penerima") {
                    if (!kriteria_data[key]) kriteria_data[key] = {
                        values: [],
                        average: null
                    }
                    kriteria_data[key].values.push(Number(Object.values(mk)[index]))
                }
            })
        });

        const average = arr => arr.reduce((a, b) => a + b, 0) / arr.length;

        Object.keys(kriteria_data).forEach((id_kriteria, index) => {
            kriteria_data[id_kriteria].average = average(kriteria_data[id_kriteria].values)
        })

        return kriteria_data
    }

    jarak_positif_negatif() {
        const _this = this
        let pda_results = {}

        function pda_nda(av, x, direction = ">") {
            if (direction == ">") {
                return Math.max(0, (x - av)) / av
            } else {
                return Math.max(0, (av - x)) / av
            }
        }
        Object.keys(_this.$solusi_av).forEach((id_kriteria, index) => {
            let kriteria = _this.$solusi_av[id_kriteria]
            if (!pda_results[id_kriteria]) pda_results[id_kriteria] = {}

            kriteria.values.forEach((kriteria_value, index) => {
                let direction = ">"
                if (_this.$kriteria[id_kriteria].tipe.toLocaleLowerCase() == "cost") direction = "<"

                pda_results[id_kriteria][this.$matrik_keputusan[index].id_calon_penerima] = pda_nda(this.$solusi_av[id_kriteria].average, kriteria_value, direction)
            })
        })

        let nda_results = {}
        Object.keys(_this.$solusi_av).forEach((id_kriteria, index) => {
            let kriteria = _this.$solusi_av[id_kriteria]
            if (!nda_results[id_kriteria]) nda_results[id_kriteria] = {}

            kriteria.values.forEach((kriteria_value, index) => {
                let direction = "<"
                if (_this.$kriteria[id_kriteria].tipe.toLocaleLowerCase() == "cost") direction = ">"

                nda_results[id_kriteria][this.$matrik_keputusan[index].id_calon_penerima] = pda_nda(this.$solusi_av[id_kriteria].average, kriteria_value, direction)
            })
        })

        return {
            pda: pda_results,
            nda: nda_results,
        }
    }

    toggle_column_row_object(column) {
        let row = []
        if (typeof column == "object") {
            row = {}
            Object.keys(column).forEach((column_id, column_index) => {
                Object.keys(column[column_id]).forEach((row_id, row_index) => {
                    if (!row[row_id]) row[row_id] = {}
                    row[row_id][column_id] = column[column_id][row_id]
                })
            });
        }
        return row
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
