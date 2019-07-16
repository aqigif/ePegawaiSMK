<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model {
	public function update($data, $id_user) {
		$this->db->where("id_user", $id_user);
		$this->db->update("user", $data);

		return $this->db->affected_rows();
	}

	public function select($id_user = '') {
		if ($id_user != '') {
			$this->db->where('id_user', $id_user);
		}

		$data = $this->db->get('user');

		return $data->row();
	}
}

/* End of file M_profil.php */
/* Location: ./application/models/M_profil.php */