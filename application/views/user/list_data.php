<?php
  foreach ($dataUser as $user) {
    ?>
    <tr>
      <td style="min-width:230px;"> <img class="img-responsive" src="assets/img/<?php echo $user->foto; ?>"> </td>
      <td><?php echo $user->id_user; ?></td>
      <td><?php echo $user->email; ?></td>
      <td><?php echo $user->username; ?></td>
      <td><?php echo $user->password; ?></td>
      <td><?php echo $user->nama; ?></td>
      <td><?php echo $user->posisi; ?></td>
      <td class="text-center" style="min-width:240px;"><!-- 
        <button class="btn btn-info lihat-datauser" data-id="<?php echo $user->id_user; ?>"><i class="glyphicon glyphicon-info-sign"></i>Lihat</button> -->
        <button class="btn btn-warning update-dataUser" data-id="<?php echo $user->id_user; ?>"><i class="glyphicon glyphicon-repeat"></i>Update</button>
        <button class="btn btn-danger konfirmasiHapus-user" data-id="<?php echo $user->id_user; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i>Hapus</button>
      </td>
    </tr>
    <?php
  }
?>