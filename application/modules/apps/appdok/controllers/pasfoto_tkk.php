<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pasfoto_tkk extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_pegawai');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$id_pegawai = $_POST['id_pegawai'];
		$item = $_POST['idd'];
		$this->$item($id_pegawai);
	}
	
	function biodata($id_peg){
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_master",$id_peg);
		$this->load->view('pasfoto_tkk/biodata_form',$data);
	}

	function alamat($id_peg){
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$id_peg);
		$this->load->view('pasfoto_tkk/alamat_form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['komponen'] = $_POST['komponen'];
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],0);
		$this->load->view('pasfoto_tkk/upload',$data);
	}

}
?>