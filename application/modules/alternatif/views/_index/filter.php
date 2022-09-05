<div class="card bg-transparent">
    <div class="card-body">
        <form class="d-flex flex-row w-100" action="<?php base_url("alternatif") ?>" method="get">
            <div class="flex-fill">

                <div class="form-group row">
                    <label for="id_bansos" class="col-form-label col-2">Nama Bansos</label>
                    <div class="col-4">
                        <select class="form-control" id="id_bansos" name="filter_id_bansos">
                            <?php foreach ($bansoss as $key => $bansos) : ?>
                                <option value="<?= $bansos->id_bansos ?>" 
                                <?= $this->input->get("filter_id_bansos") == $bansos->id_bansos ? "selected" : "" ?>
                                ><?= $bansos->nama_bansos ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_kategori_bansos" class="col-form-label col-2">Kategori Bansos</label>
                    <div class="col-4">
                        <select class="form-control" id="id_kategori_bansos" name="filter_id_kategori_bansos">
                            <?php foreach ($kategori_bansoss as $key => $kategori_bansos) : ?>
                                <option value="<?= $kategori_bansos->id_kategori_bansos ?>"
                                
                                <?= $this->input->get("filter_id_kategori_bansos") == $kategori_bansos->id_kategori_bansos ? "selected" : "" ?>

                                ><?= $kategori_bansos->nama_kategori_bansos ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary mt-auto">
                <svg style="width: 18px;"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Filter</button>
        </form>
    </div>
</div>
