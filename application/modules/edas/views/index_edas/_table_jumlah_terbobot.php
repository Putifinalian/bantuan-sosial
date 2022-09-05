<div class="table-responsive">
    <table class="table table-hover mt-3 table-bordered" id="table_jumlah_terbobot" class="display" style="width:100%">
        <thead >
            <tr>

                <th rowspan="2" class="align-middle text-center table-dark">ID Calon Penerima</th>
                <th colspan="<?= count($id_kriteria_) ?>" class="text-center  table-dark">SP</th>
                <th rowspan="2" class="text-center align-middle  table-primary">SPI</th>
                <th colspan="<?= count($id_kriteria_) ?>" class="text-center table-dark">SN</th>
                <th rowspan="2"  class="text-center align-middle table-primary">SNI</th>
            </tr>
            <tr>
                <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                    <th class="text-center table-dark">
                        <?= $id_kriteria->id_kriteria ?>
                    </th>
                <?php endforeach ?>
                <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                    <th class="text-center table-dark">
                        <?= $id_kriteria->id_kriteria ?>
                    </th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
