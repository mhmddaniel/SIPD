<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ktp extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$data['id_pegawai']);
		
		if(empty($data['isi'])){
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_ktp_'.$data['id_pegawai']);
		}else{
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_ktp_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('pasfoto/ktp_form',$data);
	}
	
	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
			$sqlstrN="SELECT * FROM r_peg_alamat WHERE id_peg_alamat='".$_POST['idd']."'";
			$data['isi'] = $this->db->query($sqlstrN)->row();
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('ktp/upload',$data);
	}

}
?>