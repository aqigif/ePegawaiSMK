
<div class="row" id="lihat-data-pegawai">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/img/<?php echo $dataPegawai->foto; ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $dataPegawai->nama; ?></h3>

        <p class="text-muted text-center"><?php echo '' ?></p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>ID</b> <a class="pull-right"><?php echo $dataPegawai->id_pegawai; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#profil" data-toggle="tab">Profil</a></li>
        <li><a href="#" data-toggle="tab">Keluarga</a></li>
        <li><a href="#" data-toggle="tab">Riwayat Pendidikan</a></li>
        <li><a href="#" data-toggle="tab">Riwayat Kepangkatan</a></li>
        <li><a href="#" data-toggle="tab">Riwayat Gaji Berkala</a></li>
        <li><a href="#password" data-toggle="tab">Ubah Password</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="profil">
          <form class="form-horizontal" action="<?php echo base_url('Profile/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputNip" class="col-sm-2 control-label">NIP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id= placeholder="NIP" name="nip" value="<?php echo $dataPegawai->nip; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputNama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?php echo $dataPegawai->nama; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputTempatLahir" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" value="<?php echo $dataPegawai->tempat_lahir; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputTanggalLahir" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  onfocus="(this.type='date')"  onblur="(this.type='text')" id="date"  placeholder="Tanggal Lahir" name="tanggal_lahir" value="<?php echo $dataPegawai->tanggal_lahir; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputJenisKelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <span class="input-group-addon">
                  <input type="radio" name="jk" value="L" id="laki" class="minimal" <?php if($dataPegawai->jk == 'L'){echo "checked='checked'";} ?>>
                  <label for="laki">Laki-laki</label>
                </span>
                <span class="input-group-addon">
                  <input type="radio" name="jk" value="P" id="perempuan" class="minimal" <?php if($dataPegawai->jk == 'P'){echo "checked='checked'";} ?>> 
                  <label for="perempuan">Perempuan</label>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputKategori" class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <span class="input-group-addon">
                  <input type="radio" name="kategori" value="PNS" id="pns" class="minimal" <?php if($dataPegawai->kategori == "PNS"){echo "checked='checked'";} ?>>
                  <label for="pns">PNS</label>
                </span>
                <span class="input-group-addon">
                  <input type="radio" name="kategori" value="Non PNS" id="non" class="minimal" <?php if($dataPegawai->kategori == "Non PNS"){echo "checked='checked'";} ?>> 
                  <label for="non">Non PNS</label>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea name="alamat" class="form-control"  aria-describedby="sizing-addon2" placeholder="Alamat"><?php echo $dataPegawai->alamat; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTelp" class="col-sm-2 control-label">No. Telepon</label>
              <div class="col-sm-10">
                  <input type="text" name="telp" class="form-control"  aria-describedby="sizing-addon2" placeholder="Telepon" value="<?php echo $dataPegawai->telp; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="foto">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                  <input type="text" name="email" class="form-control"  aria-describedby="sizing-addon2" placeholder="Telepon" value="<?php echo $dataPegawai->email; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPosisi" class="col-sm-2 control-label">Posisi</label>
              <div class="col-sm-10">
                <select name="posisi" class="form-control select2"  aria-describedby="sizing-addon2" style="width: 100%">
                  <?php
                    foreach ($dataPosisi as $posisi) {
                  ?>
                      <option value="<?php echo $posisi->id_posisi; ?>" <?php if($posisi->id_posisi == $dataPegawai->id_posisi){echo "selected='selected'";} ?>><?php echo $posisi->nama; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane" id="password">
          <form class="form-horizontal" action="<?php echo base_url('Pegawai/ubah_password') ?>" method="POST">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Lama" name="passLama">
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Baru" name="passBaru">
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="passKonf">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="msg" style="display:none;">
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
</div>