<?php
$asi_key = [];
for ($index = 1; $index <= 9; $index++) {
    array_push($asi_key, "0.$index", "Rank");
}
?>

<div class="table-responsive">
    <table class="table table-hover mt-3 table-bordered">
        <thead>
            <tr>

                <th rowspan="2" class="align-middle text-center table-dark">ID Calon Penerima</th>
                <th colspan="<?= count($asi_key) ?>" class="text-center  table-dark">ASi</th>
            </tr>
            <tr>
                <?php foreach ($asi_key as $key => $ak) : ?>
                    <th class="text-center table-dark">
                        <?= $ak ?>
                    </th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
