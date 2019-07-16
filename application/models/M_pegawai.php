<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model {
	public function select_all_pegawai() {
		$sql = "SELECT * FROM pegawai";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT pegawai.id_pegawai AS id_pegawai, 
				pegawai.nip AS nip,  
				pegawai.nama AS nama,
				pegawai.tempat_lahir AS tempat_lahir,
				pegawai.tanggal_lahir AS tanggal_lahir,
				pegawai.jk AS jk,
				pegawai.kategori AS kategori,
				pegawai.alamat AS alamat,
				pegawai.telp AS telp, 
				pegawai.foto AS foto,
				pegawai.id_user AS id_user,
				user.id_user AS id_user,
				user.email AS email,
				user.username AS username,
				user.password AS password,
				pegawai.id_posisi,
				posisi.nama AS posisi
				FROM pegawai,  posisi, user
				WHERE pegawai.id_posisi = posisi.id_posisi AND pegawai.id_user = user.id_user";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id_pegawai) {
		$sql = "SELECT pegawai.id_pegawai AS id_pegawai, 
				pegawai.nip AS nip,  
				pegawai.nama AS nama,
				pegawai.tempat_lahir AS tempat_lahir,
				pegawai.tanggal_lahir AS tanggal_lahir,
				pegawai.jk AS jk,
				pegawai.kategori AS kategori,
				pegawai.alamat AS alamat,
				pegawai.telp AS telp, 
				pegawai.foto AS foto,
				pegawai.id_user AS id_user,
				user.id_user AS id_user,
				user.email AS email,
				user.username AS username,
				user.password AS password,
				pegawai.id_posisi,
				posisi.nama AS posisi
				FROM pegawai,  posisi, user
				WHERE pegawai.id_posisi = posisi.id_posisi AND pegawai.id_user = user.id_user AND pegawai.id_pegawai = '{$id_pegawai}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_posisi($id_posisi) {
		$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_posisi = {$id_posisi}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE `pegawai` SET 	`NIP`='".$data['nip']."',
										`nama`='".$data['nama']."',
										`tempat_lahir`='".$data['tempat_lahir']."',
										`tanggal_lahir`='".$data['tanggal_lahir']."',
										`jk`='".$data['jk']."',
										`kategori`='".$data['kategori']."',
										`alamat`='".$data['alamat']."',
										`telp`='".$data['telp']."',
										`foto`='".$data['foto']."',
										`id_posisi`='".$data['posisi']."' 
				WHERE `id_pegawai`='".$data['id_pegawai']."'";

		$sqlu = "UPDATE `user` SET 	`email`='".$data['email']."',
										`username`='".$data['username']."',
										`password`='".md5($data['password'])."',
										`id_posisi`='".$data['posisi']."',
										`nama`='".$data['nama']."',
										`foto`='".$data['foto']."'
				WHERE `id_user`='".$data['id_pegawai']."'";

		$this->db->query($sql);
		$this->db->query($sqlu);

		return $this->db->affected_rows();
	}

	public function delete($id_pegawai) {
		$sql = "DELETE FROM `pegawai` WHERE `pegawai`.`id_pegawai` = '{$id_pegawai}'";		
		$sqlu = "DELETE FROM `user` WHERE `user`.`id_user` = '{$id_pegawai}'";

		$this->db->query($sql);
		$this->db->query($sqlu);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO pegawai VALUES('" .$data['id_pegawai'] ."'
										,'" .$data['nip'] ."'
										,'" .$data['nama'] ."'
										,'" .$data['tempat_lahir'] ."'
										,'" .$data['tanggal_lahir'] ."'
										,'".$data['jk']."'
										,'".$data['kategori']."'
										,'".$data['alamat']."'
										,'".$data['telp']."'
										,'".$data['foto']."'
										,'".$data['posisi']."'
										,'".$data['id_user']."');";

		$sqlu = "INSERT INTO user VALUES('" .$data['id_user'] ."'
										,'" .$data['email'] ."'
										,'" .$data['username'] ."'
										,'" .md5($data['password'])."'
										,'" .$data['nama'] ."'
										,'".$data['posisi']."'
										,'".$data['foto']."');";
		$this->db->query($sqlu);
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pegawai', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function buat_kode_pegawai()   {
		$this->db->select('RIGHT(pegawai.id_pegawai,4) as kode', FALSE);
		$this->db->order_by('id_pegawai','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('pegawai');

		//cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}
		else {      
		//jika kode belum ada      
			$kode = 1;    
		}
		
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "P-1819-".$kodemax;    // hasilnya P-1819-0001 dst.
		return $kodejadi;  
	}

	public function buat_kode_user()   {
		$this->db->select('RIGHT(user.id_user,4) as kode', FALSE);
		$this->db->order_by('id_user','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('user');

		//cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}
		else {      
		//jika kode belum ada      
			$kode = 1;    
		}
		
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "U-1819-".$kodemax;    // hasilnya P-1819-0001 dst.
		return $kodejadi;  
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */