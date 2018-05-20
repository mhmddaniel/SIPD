<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Kgb extends MX_Controller {

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
		$data['isi'] = $this->m_profil->ini_kgb($_POST['idd']);
		@$data['isi']->tanggal_sk = date("d-m-Y", strtotime($data['isi']->tanggal_sk));
		@$data['isi']->gaji_lama = number_format(@$data['isi']->gaji_lama,2,","," ");
		@$data['isi']->gaji_baru = number_format(@$data['isi']->gaji_baru,2,","," ");
		@$data['isi']->tmt_gaji = date("d-m-Y", strtotime($data['isi']->tmt_gaji));
		$this->load->view('kgb/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = $this->m_profil->ini_kgb($_POST['idd']);
		$data['hapus'] = "ya";
		$this->load->view('kgb/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$this->load->view('kgb/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_kgb($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('kgb/upload',$data);
	}

}
?>