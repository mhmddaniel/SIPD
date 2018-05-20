<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_anjab');
		date_default_timezone_set('Asia/Jakarta');
	}

  public function satu()   {
			switch ($_POST['jenis']):
				case 'Jabatan Struktural':
					redirect(site_url("module/appevjab/satu_js"));
					break;
				case 'Jabatan Fungsional Umum':
					redirect(site_url("module/appevjab/satu_jfu"));
					break;
				case 'Jabatan Fungsional Tertentu':
					redirect(site_url("module/appevjab/satu_jft"));
					break;
				case 'Jabatan Fungsional Guru':
					redirect(site_url("module/appevjab/satu_guru"));
					break;
			endswitch;
  }


	function index(){
		$data['satu'] = "Selamat Datang...!!!";
		$this->load->view('dashboard/index',$data);
	}
}
?>