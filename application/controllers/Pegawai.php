<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pegawai');
		$this->load->model('M_posisi');
		$this->load->model('M_user');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataPegawai'] = $this->M_pegawai->select_all();
		$data['dataPosisi'] = $this->M_posisi->select_all();

		$data['page'] = "pegawai";
		$data['judul'] = "Data Pegawai";
		$data['deskripsi'] = "Manage Data Pegawai";

		$data['kodeunikpegawai'] = $this->M_pegawai->buat_kode_pegawai();
		$data['modal_tambah_pegawai'] = show_my_modal('modals/modal_tambah_pegawai', 'tambah-pegawai', $data);

		$this->template->views('pegawai/home', $data);
	}

	public function tampil() {
		$data['dataPegawai'] = $this->M_pegawai->select_all();
		$this->load->view('pegawai/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'trim|required');
		$this->form_validation->set_rules('id_user', 'ID User', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('telp', 'No. Telepon', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pegawai->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Pegawai Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id_pegawai = trim($_POST['id_pegawai']);

		$data['dataPegawai'] = $this->M_pegawai->select_by_id($id_pegawai);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_pegawai', 'update-pegawai', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('telp', 'No. Telepon', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pegawai->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_pegawai = $_POST['id_pegawai'];
		$result = $this->M_pegawai->delete($id_pegawai);

		if ($result > 0) {
			echo show_succ_msg('Data Pegawai Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Pegawai Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_pegawai->select_all_pegawai();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID_Pegawai");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "NIP");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Tempat Lahir");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Tanggal Lahir");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Jenis Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Kategori");
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Alamat");
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "No. Telepon");
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "Foto");
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "ID_user");
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, "ID_posisi");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_pegawai); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->NIP);  
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama);  
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->tempat_lahir); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->tanggal_lahir); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->jk); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->kategori); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->alamat);     
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('I'.$rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->foto); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->id_user);    
		    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $value->id_posisi);
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Pegawai.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Pegawai.xlsx', NULL);
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
						$check = $this->M_pegawai->check_nama($value['A']);

						if ($check != 1) {
							$resultData[$index]['id_pegawai'] = ucwords($value['A']);
							$resultData[$index]['NIP'] = $value['B'];
							$resultData[$index]['nama'] = $value['C'];
							$resultData[$index]['tempat_lahir'] = $value['D'];
							$resultData[$index]['tanggal_lahir'] = $value['E'];
							$resultData[$index]['jk'] = $value['F'];
							$resultData[$index]['kategori'] = $value['G'];
							$resultData[$index]['alamat'] = $value['H'];
							$resultData[$index]['telp'] = $value['I'];
							$resultData[$index]['foto'] = $value['J'];
							$resultData[$index]['id_user'] = $value['K'];
							$resultData[$index]['id_posisi'] = $value['L'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_pegawai->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Pegawai');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Pegawai');
				}

			}
		}
	}
	public function lihat() {
		$id_pegawai = trim($_POST['id_pegawai']);

		$data['dataPegawai'] = $this->M_pegawai->select_by_id($id_pegawai);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['userdata'] = $this->userdata;

		$data['page'] 			= "pegawai";
		$data['judul'] 			= "Data Pegawai";
		$data['deskripsi'] 		= "Detail Pegawai";

		$this->template->views('pegawai/detail', $data);
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */