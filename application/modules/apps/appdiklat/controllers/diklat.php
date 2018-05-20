<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Diklat extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdiklat/m_diklat');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Penyelenggaraan Diklat Penjenjangan";
		$diklat = $this->m_diklat->get_diklat_struk();
		if(!empty($diklat)){
			$iddiklat = $this->session->userdata('iddiklat');
			if($iddiklat==""){
				$pilih = end($diklat);
				$this->session->set_userdata("id_diklat",$pilih->id_diklat_event);
			} else {
				$this->session->set_userdata("id_diklat",$iddiklat);
			}
			$this->session->set_userdata("iddiklat","");
			$id_diklat = $this->session->userdata('id_diklat');
			$data['id_diklat'] = $id_diklat;
			$data['diklat'] = $this->m_diklat->ini_diklat_struk($id_diklat);
			$peserta = $this->m_diklat->ini_diklat_struk_peserta($data['diklat']->id_diklat_event);

			$data['peserta'] = array();
		} else {
			$data['id_diklat'] = "xx";
		}
		$this->load->view('diklat/index',$data);
	}

}
?>