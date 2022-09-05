<script>
    document.querySelector("#modal-tambah-data form").addEventListener("submit", async (e) => {
        e.preventDefault()

        let data = {
            nama_calon_penerima: e.target.nama_calon_penerima.value,
            alamat: e.target.alamat.value,
            no_HP: e.target.no_HP.value,

            jumlah_rata_rata_pemasukan_bulanan: e.target.jumlah_rata_rata_pemasukan_bulanan.value,
            jumlah_anggota_keluarga: e.target.jumlah_anggota_keluarga.value,
            jumlah_rata_rata_pengeluaran_bulanan: e.target.jumlah_rata_rata_pengeluaran_bulanan.value,
            luas_lantai_perkapita: e.target.luas_lantai_perkapita.value,
            pembayaran_rata_rata_listrik_perbulan: e.target.pembayaran_rata_rata_listrik_perbulan.value,

            // jumlah_rata_rata_pemasukan_bulanan_kriteria: e.target.jumlah_rata_rata_pemasukan_bulanan_kriteria.value,
            // jumlah_anggota_keluarga_kriteria: e.target.jumlah_anggota_keluarga_kriteria.value,
            // jumlah_rata_rata_pengeluaran_bulanan_kriteria: e.target.jumlah_rata_rata_pengeluaran_bulanan_kriteria.value,
            // luas_lantai_perkapita_kriteria: e.target.luas_lantai_perkapita_kriteria.value,
            // pembayaran_rata_rata_listrik_perbulan_kriteria: e.target.pembayaran_rata_rata_listrik_perbulan_kriteria.value,

            kriteria_json: e.target.luas_lantai_perkapita_kriteria.value
        }

        // console.log("data", data)

        let _method = e.target?._method?.value ?? "POST"

        let result = await fetch(e.target.getAttribute("action"), {
            method: _method,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: Object.entries(data).map(([k, v]) => {
                return k + '=' + v
            }).join('&')
        })

        result = await result.text()
        try {
            result = JSON.parse(result)
            $('#modal-tambah-data').modal('hide')

            e.target.nama_calon_penerima.value = ""
            e.target.alamat.value = ""
            e.target.no_HP.value = ""

            e.target.jumlah_rata_rata_pemasukan_bulanan.value = ""
            e.target.jumlah_anggota_keluarga.value = ""
            e.target.jumlah_rata_rata_pengeluaran_bulanan.value = ""
            e.target.luas_lantai_perkapita.value = ""
            e.target.pembayaran_rata_rata_listrik_perbulan.value = ""

            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            }).fire({
                icon: 'success',
                title: 'Calon penerima ditambah'
            })
        } catch (error) {

        }
    })

    $('#modal-tambah-data').on('hidden.bs.modal', function(e) {
        // console.log("modal modal-tambah-data tutup");
    })
    $('#modal-tambah-data').on('show.bs.modal', function(e) {
        // console.log("modal modal-tambah-data show");
    })
</script>
