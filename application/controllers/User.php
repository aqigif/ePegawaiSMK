<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_posisi');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataUser'] = $this->M_user->select_all();
		$data['dataPosisi'] = $this->M_posisi->select_all();

		$data['page'] = "user";
		$data['judul'] = "Data User";
		$data['deskripsi'] = "Manage Data User";

		$data['kodeunikuser'] = $this->M_user->buat_kode_user();
		$data['modal_tambah_user'] = show_my_modal('modals/modal_tambah_user', 'tambah-user', $data);

		$this->template->views('user/home', $data);
	}

	public function tampil() {
		$data['dataUser'] = $this->M_user->select_all();
		$this->load->view('user/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('id_user', 'ID user', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_user->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data user Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data user Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id_user = trim($_POST['id_user']);

		$data['datauser'] = $this->M_user->select_by_id($id_user);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_user', 'update-user', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_user->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data user Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data user Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_user = $_POST['id_user'];
		$result = $this->M_user->delete($id_user);

		if ($result > 0) {
			echo show_succ_msg('Data user Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data user Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_user->select_all_user();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID_user");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Email");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Username");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Password");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Foto");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Posisi");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_user);
		    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->email); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $value->username); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $value->password);   
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama);  
		    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->foto);    
		    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $value->id_posisi);
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data user.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data user.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_user->check_nama($value['A']);

						if ($check != 1) {
							$resultData[$index]['id_user'] = ucwords($value['A']);
							$resultData[$index]['email'] = $value['B'];
							$resultData[$index]['username'] = $value['C'];
							$resultData[$index]['password'] = $value['D'];
							$resultData[$index]['nama'] = $value['E'];
							$resultData[$index]['foto'] = $value['F'];
							$resultData[$index]['id_posisi'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_user->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data user Berhasil diimport ke database'));
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data user Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('user');
				}

			}
		}
	}
	public function lihat() {
		$id_user = trim($_POST['id_user']);

		$data['datauser'] = $this->M_user->select_by_id($id_user);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['userdata'] = $this->userdata;

		$data['page'] 			= "user";
		$data['judul'] 			= "Data user";
		$data['deskripsi'] 		= "Detail user";

		$this->template->views('user/detail', $data);
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */