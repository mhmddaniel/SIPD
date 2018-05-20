<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sertifikat_kursus extends MX_Controller {

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
		$data['isi'] = $this->m_profil->ini_sertifikat_kursus($_POST['idd']);
		$data['id_rumpun'] = 6;
		$data['nama_form'] = "sertifikat_kursus";
		$data['judul_form'] = "Kursus";
		$this->load->view('sertifikat_kursus/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_sertifikat_kursus($_POST['idd']);
		$data['hapus'] = "ya";
		$data['id_rumpun'] = 6;
		$data['nama_form'] = "sertifikat_kursus";
		$data['judul_form'] = "Kursus";
		$this->load->view('sertifikat_kursus/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['id_rumpun'] = 6;
		$data['nama_form'] = "sertifikat_kursus";
		$data['judul_form'] = "Kursus";
		$this->load->view('sertifikat_kursus/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_sertifikat_kursus($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('sertifikat_kursus/upload',$data);
	}

}
?>