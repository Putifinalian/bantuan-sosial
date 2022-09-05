<html>
<body>
<?php
$provinsi = array(
                  '1'  => 'Nanggro Aceh Darussalam',
                  '2'    => 'Sumatera Utara',
                  '3'   => 'Sumatera Barat',
                  '4'   => 'Riau',
                  '5'   => 'Kepulauan Riau',
                  '6'   => 'Jambi',
                );
?>
 
<h2>Disini Dropdown/ Combobox nya</h2>
<?php echo form_dropdown('provinsi', $provinsi);?>
</body>
</html>