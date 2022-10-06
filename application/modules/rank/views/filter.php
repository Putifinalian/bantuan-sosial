<div class="card bg-transparent">
    <div class="card-body">
        <form class="d-flex flex-row w-100" action="<?php base_url("alternatif") ?>" method="get">
            <div class="flex-fill">

                <div class="form-group row">
                    <label for="id_bansos" class="col-form-label col-2">Nama Bansos</label>
                    <div class="col-4 wrapper-filter-bansos">

                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_kategori_bansos" class="col-form-label col-2">Kategori Bansos</label>
                    <div class="col-4 wrapper-filter-kategori-bansos">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_kategori_bansos" class="col-form-label col-2">Kriteria Bansos</label>
                    <div class="col-4 wrapper-filter-kriteria">

                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary mt-auto">
                <svg style="width: 18px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Filter</button>
        </form>
    </div>
</div>
