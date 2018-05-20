<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sk_pangkat extends MX_Controller {

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
		$data['row'] = $this->m_profil->ini_pangkat_riwayat($_POST['idd']);
		@$data['row']->tmt_golongan = date("d-m-Y", strtotime($data['row']->tmt_golongan));
		@$data['row']->sk_tanggal = date("d-m-Y", strtotime($data['row']->sk_tanggal));
		@$data['row']->bkn_tanggal = date("d-m-Y", strtotime($data['row']->bkn_tanggal));
		$this->load->view('sk_pangkat/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['row'] = $this->m_profil->ini_pangkat_riwayat($_POST['idd']);
		@$data['row']->tmt_golongan = date("d-m-Y", strtotime($data['row']->tmt_golongan));
		@$data['row']->sk_tanggal = date("d-m-Y", strtotime($data['row']->sk_tanggal));
		@$data['row']->bkn_tanggal = date("d-m-Y", strtotime($data['row']->bkn_tanggal));
		$data['hapus'] = "ya";
		$this->load->view('sk_pangkat/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$this->load->view('sk_pangkat/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_pangkat_riwayat($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('sk_pangkat/upload',$data);
	}

}
?>