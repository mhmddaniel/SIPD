<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Anak extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_anak($_POST['idd']);
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_anak_'.$data['id_pegawai']);
		}else {
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_anak_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('anak/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_anak($_POST['idd']);
		$data['hapus'] = "ya";
		$data['token'] = sha1('data_edit_anak_'.$data['id_pegawai']);
		$this->load->view('anak/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_anak_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('anak/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_anak($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('anak/upload',$data);
	}

}
?>