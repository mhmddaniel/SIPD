<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sertifikat_pengadaan extends MX_Controller {

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
		$data['id_rumpun'] = 10;
		$data['induk'] = "Sertifikat";
		$data['nama_form'] = "sertifikat_pengadaan";
		$data['judul_form'] = "Sertifikat Pengadaan";
		$this->load->view('sertifikat_diklat/form_pengadaan',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['hapus'] = "ya";
		$data['id_rumpun'] = 10;
		$data['induk'] = "Sertifikat";
		$data['nama_form'] = "sertifikat_pengadaan";
		$data['judul_form'] = "Sertifikat Pengadaan";
		$this->load->view('sertifikat_diklat/form_pengadaan',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['id_rumpun'] = 10;
		$data['induk'] = "Sertifikat";
		$data['nama_form'] = "sertifikat_pengadaan";
		$data['judul_form'] = "Sertifikat Pengadaan";
		$this->load->view('sertifikat_diklat/form_pengadaan',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = "sertifikat_pengadaan";
		$data['judul'] = "Sertifikat Pengadaan Barang dan Jasa";
		$data['isi'] = $this->m_profil->ini_sertifikat_diklat($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$data['komponen'],$_POST['idd']);
		$this->load->view('sertifikat_diklat/upload',$data);
	}

}
?>