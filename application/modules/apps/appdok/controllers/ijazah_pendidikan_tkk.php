<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ijazah_pendidikan_tkk extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['row'] = Modules::run("appbkpp/profile/ini_riwayat_pendidikan",$_POST['idd']);
		@$data['row']->tanggal_lulus = date("d-m-Y", strtotime($data['row']->tanggal_lulus));
		$this->load->view('ijazah_pendidikan_tkk/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['row'] = Modules::run("appbkpp/profile/ini_riwayat_pendidikan",$_POST['idd']);
		@$data['row']->tanggal_lulus = date("d-m-Y", strtotime($data['row']->tanggal_lulus));
		$data['hapus'] = "ya";
		$this->load->view('ijazah_pendidikan_tkk/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$this->load->view('ijazah_pendidikan_tkk/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_edok->ini_pendidikan($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('ijazah_pendidikan_tkk/upload',$data);
	}

}
?>