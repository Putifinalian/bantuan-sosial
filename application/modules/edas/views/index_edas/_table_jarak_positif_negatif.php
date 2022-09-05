<div class="table-responsive">
    <table class="table table-hover mt-3 table-bordered compact" id="table_jarak_positif_negatif" class="display" style="width:100%">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle text-center table-dark">ID Calon Penerima</th>
                <th colspan="<?= count($id_kriteria_) ?>" class="text-center table-dark">PDA</th>
                <th colspan="<?= count($id_kriteria_) ?>" class="text-center table-dark">NDA</th>
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
