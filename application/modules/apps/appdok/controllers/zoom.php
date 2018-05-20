<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Zoom extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}
	function index(){
		$data['komponen'] = $_POST['komponen'];
		$data['idd'] = $_POST['idd'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_edok->cek_dokumen($_POST['nip_baru'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('zoom',$data);
	}
	function satu(){
		$data['komponen'] = $_POST['komponen'];
		$data['idd'] = $_POST['idd'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_edok->cek_dokumen_satu($_POST['nip_baru'],$_POST['komponen'],$_POST['idd'],$_POST['hal']);
		$this->load->view('zoom_satu',$data);
	}

}
?>