<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pasfoto extends MX_Controller {

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
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_master",$id_peg);
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_biodata_'.$data['id_pegawai']);
		} else {
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_biodata_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('pasfoto/biodata_form',$data);
	}

	function alamat($id_peg){
		$data['id_pegwai'] = $_POST['id_pegawai'];
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$id_peg);
		if(empty($data['isi'])){
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_alamat_'.$data['id_pegawai']);
		}else{
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_alamat_'.$data['id_alamat']);
		}
		$this->session-set_userdata('token_form',$data['token']);
		$this->load->view('pasfoto/alamat_form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['komponen'] = $_POST['komponen'];
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],0);
		$this->load->view('pasfoto/upload',$data);
	}

}
?>