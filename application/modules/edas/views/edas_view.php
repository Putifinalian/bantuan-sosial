<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <div class="container">
        <h2 class="text-center">Perhitungan Metode EDAS</h2>
        <div class="form-group text-right">
        </div>
        <div class="container p-3 my-3 bg-light">

            <h5>Tahapan-tahapan Algoritma Metode EDAS</h5>
            <ol>
                <li>Pembentukan Matrik Keputusan, kriteria sebagai kolom dan alternatif sebagai baris</li>
                <li>Menentukan Solusi Rata-rata (AV - <i>Average Solution</i>)</li>
                <li>Menentukan Jarak Positif dan Negatif sesuai jenis kriteria : <i>benefit & cost</i> (PDA - <i>Positive Distance Average</i> / NDA - <i>Negative Distance Average</i> )</li>
                <li>Menentukan Jumlah Terbobot (SP - <i>Solution Positive</i> / SN - <i>Solution Negative</i>)</li>
                <li>Normalisasi Nilai SP/SN (NSP - <i>Normalize Solution Positive</i> / NSN - <i>Normalize Solution Negative</i>)</li>
                <li>Menghitung Nilai Skor Penilaian (AS - <i>Apparisal Score</i>)</li>
                <li>Perangkingan, peringkat tertinggi adalah yang memiliki nilai AS paling tinggi.</li>
            </ol>
        </div>
        <h6>Untuk melakukan perhitungan metode EDAS, silahkan kembali ke
            <a href="<?php echo base_url('alternatif'); ?>">Data Calon Penerima</a>
            > Cek Penerima > Pilih Algoritma > Pilih Jenis Bantuan Sosial > RUN
        </h6>

    </div>
</div>
