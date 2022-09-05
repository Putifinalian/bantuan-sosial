<div id="content" class="content">
<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Dashboard</a></li>
	</ol>
	<div class="container">
		<h3 class="text-center">Perhitungan Metode AHP</h3>
		<div class="form-group text-right">
		</div>
		<?=$this->session->flashdata('notif')?>
		<table class="table table-striped table-bordered">
            <thead>
                <tr>
					<!-- <th>#</th> -->
                    <th>Criteria</th>
					<th>Normalisasi</th>
					<th>Lamda maks</th>
					<th>CI/Consistency Index</th>
					<th>CR/Consistency Ratio</th>
					<th>Keterangan</th>
				</tr>
            </thead>
			<tbody>
			<!-- Nilai Kriteria -->
					<tr> 
                        <td>
						<?php
		
							if (isset($_POST['baris'])) {
								$baris = $_POST['baris'];
								echo "<h2>$baris</h2>";
							}

							
							for($i=0; $i<=$baris;$i++){
								for($j=0; $j<=$baris; $j++){
									 if($i==$j){
									 	$matrik_kriteria[$i][$j] = 1;
									 } else {
										if($j<$i) {
											$matrik_kriteria[$i][$j] = 1/$matrik_kriteria[$j][$i];
										} else {
											$teks = 'select_'.$i.$j;
											if (isset($_POST[$teks])) {
												$select = $_POST[$teks];
												echo "<h5>$select</h5>";
												$matrik_kriteria[$i][$j] = $select;
											}
										}
									 }
								}
							}
							for($i=0; $i<=$baris; $i++){
								for($j=0; $j<=$baris; $j++){
									echo "--".$matrik_kriteria[$i][$j];									
								}
								echo"<br>";
							}
							for($j=0; $j<=$baris; $j++){
								$total_kriteria_awal= 0;
								for($i=0;$i<=$baris;$i++){
									$total_kriteria[$j]=$total_kriteria_awal + $matrik_kriteria[$i][$j];
									$total_kriteria_awal = $total_kriteria[$j];
								}
							}
							echo"<br><br>";
							for($j=0; $j<=$baris; $j++){
								echo "-".$total_kriteria[$j];
							}
							
							?>

						</td>

						<!-- Hitung Normalisasi Kriteria -->
						<td></td>

						<!-- Hitung Lamda Max -->
						<td></td>

						<!-- Hitung CI -->
						<td></td>

						<!-- Hitung CR , nilai RI(5) = 1.12-->
						<td></td>

						<!-- Keterangan -->
						<td>Nilai CR kurang atau sama dengan 0.1 yaitu $CR, maka hasil perhitungan dinyatakan benar</td>

					</tr>
			
            </tbody>
        </table>
		<!-- /*<?php
		/*if (isset($_POST['select_01'])) {
			$select = $_POST['select_01'];
			echo "<h4>$select</h4>";
		}
		if (isset($_POST['select_02'])) {
			$select = $_POST['select_02'];
			echo "<h4>$select</h4>";
		}*/
		if (isset($_POST['baris'])) {
			$baris = $_POST['baris'];
			echo "<h3>$baris</h3>";
		}


		for($i=0; $i<=$baris;$i++){
			for($j=$i+1; $j<=$baris; $j++){
				$teks = 'select_'.$i.$j;
				if (isset($_POST[$teks])) {
					$select = $_POST[$teks];
					echo "<h3>$select</h3>";
				}
			}
		}
		 
		?> -->
    </div>
</div>