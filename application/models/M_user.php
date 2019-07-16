<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	public function select_all_user() {
		$sql = "SELECT * FROM user";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT user.id_user AS id_user,
				user.email AS email,
				user.username AS username,
				user.password AS password,
				user.nama AS nama,
				user.foto AS foto,
				user.id_posisi,
				posisi.nama AS posisi
				FROM user, posisi
				WHERE user.id_posisi = posisi.id_posisi";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id_user) {
		$sql = " SELECT user.id_user AS id_user,
				user.email AS email,
				user.username AS username,
				user.password AS password,
				user.nama AS nama,
				user.foto AS foto,
				user.id_posisi,
				posisi.nama AS posisi
				FROM user, posisi
				WHERE user.id_posisi = posisi.id_posisi AND user.id_user = '{$id_user}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_posisi($id_posisi) {
		$sql = "SELECT COUNT(*) AS jml FROM user WHERE id_posisi = {$id_posisi}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE `user` SET 	`email`='".$data['email']."',
										`username`='".$data['username']."',
										`password`='".md5($data['password'])."',
										`id_posisi`='".$data['posisi']."',
										`nama`='".$data['nama']."',
										`foto`='".$data['foto']."'
				WHERE `id_user`='".$data['id_user']."'";

		$this->db->query($sql);
		
		return $this->db->affected_rows();
	}

	public function delete($id_user) {
		$sql = "DELETE FROM `user` WHERE `user`.`id_user` = '{$id_user}'";

		$this->db->query($sql);
		
		return $this->db->affected_rows();
	}

	public function insert($data) {
		$id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO user VALUES('" .$data['id_user'] ."'
										,'" .$data['email'] ."'
										,'" .$data['username'] ."'
										,'" .md5($data['password'])."'
										,'" .$data['nama'] ."'
										,'".$data['posisi']."'
										,'".$data['foto']."');";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('user', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('user');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('user');

		return $data->num_rows();
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
		$kodejadi = "P-1819-".$kodemax;    // hasilnya P-1819-0001 dst.
		return $kodejadi;  
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */