<div id="content" class="content">
<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Dashboard</a></li>
	</ol>
	<div class="container">
		<h2 class="text-center">Perhitungan Metode EDAS</h2>
		<div class="form-group text-right">
		</div>
		<?=$this->session->flashdata('notif')?>
		<h5>Perhitungan EDAS tidak bisa dilakukan tanpa memilih algoritma, silahkan kembali ke <a href="<?php echo base_url('alternatif');?>">Data Calon Penerima</a> </h5>
		<!-- <table class="table table-hover">
            <thead>
                <tr class="thead-dark">
					<th>No.</th>
                    <th>ID</th>
                    <th>PDA</th>
					<th>NDA</th>
					<th>SP</th>
					<th>SN</th>
					<th>NSP</th>
					<th>NSN</th>
					<th>AS</th>
					<th>Rank</th>
				</tr>
            </thead>
            <tbody>
				
            </tbody>
        </table> -->
    </div>
</div>
