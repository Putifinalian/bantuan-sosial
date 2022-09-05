<div class="table-responsive">
    <table class="table-matrik-keputusan table table-hover table-bordered cell-border" id="table_alternatif" class="display" style="width:100%">
        <thead>
            <tr>
                <th rowspan="3" class="align-middle text-center table-dark">No</th>
                <th rowspan="3" class="align-middle text-center table-dark">ID Calon Penerima</th>
                <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                    <th colspan="1" rowspan="1" class="align-middle text-center table-dark">
                        <?= $id_kriteria->id_kriteria ?>
                    </th>
                <?php endforeach ?>
            </tr>
            <tr>
                <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                    <th rowspan="1" class="text-center table-dark font-weight-light" style="font-size: 11px;">
                        <em><?= $id_kriteria->tipe_kriteria ?></em>
                    </th>
                <?php endforeach ?>
            </tr>
            <tr>
                <?php foreach ($id_kriteria_ as $key => $id_kriteria) : ?>
                    <th rowspan="1" class="text-center table-dark font-weight-light" style="font-size: 11px;">
                        <?= $id_kriteria->nilai_bobot ?>
                    </th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alternatif_ as $key => $alternatif) : ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td data-id_calon_penerima="<?= $alternatif["id_calon_penerima"] ?>"><?= $alternatif["id_calon_penerima"] ?></td>
                    <?php foreach ($alternatif["kriteria"] as $key_kriteria => $kriteria) :  ?>
                        <td data-id_kriteria="<?= $key_kriteria ?>"><?= $kriteria ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
