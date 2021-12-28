<?php
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=export_data_mahasiswa.xls" );
?>

<table border="1">
  <thead>
    <tr>
      <th>NIM</th>
      <th>Nama Mahasiswa</th>
      <th>Alamat Mahasiswa</th>
      <th>Jurusan</th>
      <th>No.telpon</th>
    </tr>
  </thead>
  <tbody>
    <!--looping data provinsi-->
    <?php foreach($data_mahasiswa as $mhs):?>

    <!--cetak data per baris-->
    <tr>
      <td><?php echo $mhs['nim'];?></td>
      <td><?php echo $mhs['nama_mhs'];?></td>
      <td><?php echo $mhs['alamat_mhs'];?></td>
      <td><?php echo $mhs['jurusan'];?></td>
      <td><?php echo $mhs['notelp_mhs'];?></td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
