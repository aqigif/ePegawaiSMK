<div class="col-md-offset-0 col-lg-12 col-md-12 col-md-offset-0 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Pegawai</h3>
  <form id="form-tambah-pegawai" method="POST">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xs-12">  
        <!-- input id_pegawai -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-qrcode"></i>
          </span>
          <input type="text" name="id_pegawai" class="form-control" value="<?= $kodeunikpegawai; ?>" readonly>
          <input type="hidden" name="id_user" class="form-control" value="<?= $kodeunikpegawai; ?>" hidden>
        </div>
        <!-- input NIP -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class=" glyphicon glyphicon-barcode"></i>
          </span>
          <input class="form-control" placeholder="NIP *opsional" name="nip" aria-describedby="sizing-addon2">
        </div>
        <!-- input nama -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Nama" name="nama" aria-describedby="sizing-addon2">
        </div>
        <!-- input tempat lahir -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon">
            <i class="glyphicon glyphicon-flag"></i>
          </span>
          <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" aria-describedby="sizing-addon2">
        </div>
        <!-- input tanggal lahir -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
          <input type="text" class="form-control" onfocus="(this.type='date')"  onblur="(this.type='text')" id="date" placeholder="Tanggal Lahir" name="tanggal_lahir" aria-describedby="sizing-addon2">
        </div>
        <!-- input jk -->
        <div class="input-group form-group" style="display: inline-block;">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tag"></i>
          </span>
          <span class="input-group-addon">
            <input type="radio" name="jk" value="L" id="laki" class="minimal">
            <label for="laki">Laki-laki</label>
          </span>
          <span class="input-group-addon">
            <input type="radio" name="jk" value="P" id="perempuan" class="minimal"> 
            <label for="perempuan">Perempuan</label>
          </span>
        </div> <br>
        <!-- input kategori -->
        <div class="input-group form-group" style="display: inline-block;">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-briefcase"></i>
          </span>
          <span class="input-group-addon">
            <input type="radio" name="kategori" value="PNS" id="pns" class="minimal">
            <label for="pns">PNS</label>
          </span>
            <span class="input-group-addon">
              <input type="radio" name="kategori" value="Non PNS" id="non" class="minimal"> 
              <label for="non">Non PNS</label>
            </span>
        </div>
        <!-- input alamat -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-home"></i>
          </span>
          <textarea name="alamat" class="form-control"  aria-describedby="sizing-addon2" placeholder="Alamat"></textarea>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xs-12">
        <!-- input telepon -->
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone-alt"></i>
          </span>
          <input type="text" name="telp" class="form-control"  aria-describedby="sizing-addon2" placeholder="Telepon">
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
      </div>
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