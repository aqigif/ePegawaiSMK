<?php
  foreach ($dataPegawai as $pegawai) {
    ?>
    <tr>
      <td style="min-width:230px;"> <img class="img-responsive" src="assets/img/<?php echo $pegawai->foto; ?>"> </td>
      <td><?php echo $pegawai->id_pegawai; ?></td>
      <td><?php echo $pegawai->nip; ?></td>
      <td><?php echo $pegawai->nama; ?></td>
      <td><?php echo $pegawai->telp; ?></td>
      <td><?php echo $pegawai->jk; ?></td>
      <td><?php echo $pegawai->posisi; ?></td>
      <td class="text-center" style="min-width:240px;"><!-- 
        <button class="btn btn-info lihat-dataPegawai" data-id="<?php echo $pegawai->id_pegawai; ?>"><i class="glyphicon glyphicon-info-sign"></i>Lihat</button> -->
        <button class="btn btn-warning update-dataPegawai" data-id="<?php echo $pegawai->id_pegawai; ?>"><i class="glyphicon glyphicon-repeat"></i>Update</button>
        <button class="btn btn-danger konfirmasiHapus-pegawai" data-id="<?php echo $pegawai->id_pegawai; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i>Hapus</button>
      </td>
    </tr>
    <?php
  }
?>