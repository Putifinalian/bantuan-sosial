<div id="content" class="content">
<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Dashboard</a></li>
	</ol>
	<div class="container">
		<h2 class="text-center">Pilih Algoritma</h2>
		<div class="form-group text-right">
        <form action="<?php echo base_url('/ahp_bobot'); ?>" method="post">
    
		</div>
		<?=$this->session->flashdata('notif')?>
		<table class="table table-striped table-bordered">
            <thead>
                <tr>
					<th>No.</th>
                    <th>ID Kriteria Bansos</th>
                    <th>Nilai AHP</th>
					<th>ID Kriteria Bansos</th>
                </tr>
            </thead>
			<?php $no=0;
                  $i=0;
				foreach ($algoritma as $algo_baris) 
				{ 
                    $j=0;
                    foreach ($algoritma as $algo_kolom) 
                    {
                        $no++;
                    echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>$algo_baris->id_kriteria_bansos</td>";
                        if($i==$j) {
                            echo "<td>1</td>";
                            $ahp_nilai[$i][$j]=1;
                        } else {
                            if($j<$i){
                                echo "<td>X</td>";
                                $ahp_nilai[$i][$j]=0;
                            } else {
                                 echo "<td><select name='select_$i$j'>
                                 <option value='1' selected>1 - Sama Pentingnnya</option> 
                                 <option value='2'>2 - Sama hingga sedikit lebih penting</option>
                                 <option value='3'>3 - Sedikit lebih penting</option>
                                 <option value='4'>4 - Sedikit lebih hingga jelas lebih penting 1</option> 
                                 <option value='5'>5 - Jelas Lebih penting</option>
                                 <option value='6'>6 - Jelas hingga sangat jelas lebih penting</option>
                                 <option value='7'>7 - Sangat jelas lebih penting</option> 
                                 <option value='8'>8 - Sangat jelas hingga mutlak lebih penting</option>
                                 <option value='9'>9 - Mutlak lebih penting</option>
                                </select></td>";
                                $ahp_nilai[$i][$j] = 'select'.'_'.$i.'_'.$j;
                            

                            }
                        }
                        echo "<td>$algo_kolom->id_kriteria_bansos</td>";
                        				
                    echo "</tr>";
                    $kolom=$j;
                    $j++;
                    } 
                    $baris = $i;
                    $i++;
                    
                }?>
            <tbody>
				
            </tbody>
        </table>
        <?php
        
        for ($i=0; $i<=$baris; $i++) 
		{ 
            for ($j=0; $j <= $kolom; $j++) 
			{
                echo" ".$ahp_nilai[$i][$j];
            }
            echo "<br>";
        }
        
        echo "<input type='hidden' name='baris' value='$baris' />";
        ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>



</div>