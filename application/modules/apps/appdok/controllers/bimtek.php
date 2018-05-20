<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Bimtek extends MX_Controller {

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
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['id_rumpun'] = 5;
		$data['induk'] = "Bimtek";
		$data['nama_form'] = "bimtek";
		$data['judul_form'] = "Bimbingan Teknis";
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['hapus'] = "ya";
		$data['id_rumpun'] = 5;
		$data['induk'] = "Bimtek";
		$data['nama_form'] = "bimtek";
		$data['judul_form'] = "Bimbingan Teknis";
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['id_rumpun'] = 5;
		$data['induk'] = "Bimtek";
		$data['nama_form'] = "bimtek";
		$data['judul_form'] = "Bimbingan Teknis";
		$this->load->view('sertifikat_diklat/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = "bimtek";
		$data['judul'] = "Bimbingan Teknis";
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$data['komponen'],$_POST['idd']);
		$this->load->view('sertifikat_diklat/upload',$data);
	}

}
?>