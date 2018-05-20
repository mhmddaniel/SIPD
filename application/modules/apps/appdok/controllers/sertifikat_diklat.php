<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sertifikat_diklat extends MX_Controller {

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
		$data['id_rumpun'] = 2;
		$data['induk'] = "Diklat";
		$data['nama_form'] = "sertifikat_diklat";
		$data['judul_form'] = "Diklat Penjenjangan";
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['id_rumpun'] = 2;
		$data['induk'] = "Diklat";
		$data['nama_form'] = "sertifikat_diklat";
		$data['judul_form'] = "Diklat Penjenjangan";
		$data['hapus'] = "ya";
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['id_rumpun'] = 2;
		$data['induk'] = "Diklat";
		$data['nama_form'] = "sertifikat_diklat";
		$data['judul_form'] = "Diklat Penjenjangan";
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = "sertifikat_diklat";
		$data['judul'] = "Diklat Penjenjangan";
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$data['komponen'],$_POST['idd']);
		$this->load->view('sertifikat_diklat/upload',$data);
	}

}
?>