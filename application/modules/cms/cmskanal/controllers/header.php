<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Header extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	public function index(){
		echo $_POST['posisi'];
	}
///////////////////////////////////////////////////////////////////
/////////////////////////////LOGO HANDLING ////////////////////
	function logo_upload(){
		$data['kanal'] = $this->m_kanal->inikanal($_POST['id_konten']);
		$header = $this->m_kanal->get_header_kanal($_POST['id_konten']);
		$data['logo'] = ($header->nama_item=="")?base_url().$this->m_kanal->getopsivalue('logo_app'):base_url().$header->nama_item;
		$data['id_kanal']=$_POST['id_konten'];
		$this->load->view('kanal/logo_upload',$data);
	}
	function ganti_gambar(){
		$this->m_kanal->simpan_logo_kanal($_POST['id_kanal'],$_POST['idd'],$_POST['path']);
		echo "sukses";
	}
}
?>