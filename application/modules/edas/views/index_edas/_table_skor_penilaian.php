<?php
// $asi_key = [];
// for ($index = 1; $index <= 9; $index++) {
//     array_push($asi_key, "0.$index", "Rank");
// }

$asi_key = [];
for ($index = 1; $index <= 9; $index++) {
    array_push($asi_key, "ID", "0.$index", "Rank");
}
?>

<div class="table-responsive">
    <table class="table table-hover mt-3 table-bordered" id="table_skor_penilaian" class="display" style="width:100%">
        <thead>
            <tr>
                <!-- <th rowspan="2" class="align-middle text-center table-dark">ID Calon Penerima</th> -->
                <th colspan="<?= count($asi_key) ?>" class="text-center  table-dark">AS (Appraisal Score)</th>
            </tr>
            <tr class="main-head">
                <?php foreach ($asi_key as $key => $ak) : ?>
                    <th class="text-center table-dark" <?= substr($ak, 0, strlen("0.")) === "0." ? 'data-orderable="false"' : "" ?>  >
                        <?= $ak ?>
                    </th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
