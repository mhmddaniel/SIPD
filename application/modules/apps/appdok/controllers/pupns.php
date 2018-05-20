<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pupns extends MX_Controller {

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
		$data['isi'] = $this->m_profil->get_pupns($_POST['id_pegawai']);
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_pupns_'.$data['id_pegawai']);
		}else{
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_pupns_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('pupns/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['isi'] = $this->m_profil->ini_pupns($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('pupns/upload',$data);
	}

}
?>