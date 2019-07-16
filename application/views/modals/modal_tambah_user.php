<div class="col-md-offset-0 col-lg-8 col-md-10 col-md-offset-0 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data User</h3>
  <form id="form-tambah-user" method="POST">
        <!-- input id_user -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-qrcode"></i>
          </span>
          <input type="text" name="id_user" class="form-control" value="<?= $kodeunikuser; ?>" readonly>
        </div>
        <!-- input nama -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nama" name="nama" aria-describedby="sizing-addon2">
        </div>
        <!-- input username -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="sizing-addon2">
        </div>
        <!-- input password -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
          <input type="password" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2">
        </div>
        <!-- input foto -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-picture"></i>
          </span>
          <input type="text" class="form-control" placeholder="Foto" name="foto">
        </div>
        <!-- input email -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-globe"></i>
          </span>
          <input type="text" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2">
        </div>
        <!-- input posisi -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-briefcase"></i>
          </span>
          <select name="posisi" class="form-control select2"  aria-describedby="sizing-addon2" style="width: 100%">
            <?php
            foreach ($dataPosisi as $posisi) {
              ?>
              <option value="<?php echo $posisi->id_posisi; ?>">
                <?php echo $posisi->nama; ?>
              </option>
              <?php
            }
            ?>
          </select>
        </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>