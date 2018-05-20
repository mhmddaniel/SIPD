<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Donlot extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->library('zip');
		$this->load->library('ftp');
	}

	function buka($idd){
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai",$idd);
		$data['fotoSrc']= Modules::run("appbkpp/profile/pasfoto_ini",$idd);

		$data['pangkat'] = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$idd);
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$idd);
		$data['pendidikan'] = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$idd);
		$data['cpns'] = Modules::run("appbkpp/profile/ini_pegawai_cpns",$idd);
		$data['pns'] = Modules::run("appbkpp/profile/ini_pegawai_pns",$idd);
		$this->load->view('donlot/buka',$data);
	}

	function dua($nip){
		$path="assets/media/file/".$nip."/";
		$this->ftp->chmod($path, DIR_READ_MODE);
		$this->zip->read_dir($path, FALSE); 
		$this->zip->download($nip.'.zip');
	}

}
?>