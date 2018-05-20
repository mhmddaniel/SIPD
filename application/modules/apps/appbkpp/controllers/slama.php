<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Slama extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_slama');
		$this->load->library('zip');
		$this->load->library('flxziparchive');
		date_default_timezone_set('Asia/Jakarta');
	}


	function index(){
		$data['satu'] = "Daftar Unit Kerja";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		
		$data['unor'] = $this->m_slama->get_unor(4,0);
		$this->load->view('slama/index',$data);
	}

	function tree(){
		$data['satu'] = "Daftar Unit Kerja";

		$tanggal = date("Y-m-d", strtotime('12-09-2015'));
		$data['unor'] = $this->m_slama->gettree(0,5,$tanggal);

		$this->load->view('slama/tree',$data);
	}

	function satu($nip){
			$the_folder = "assets/media/file/".$nip."/";
			$zip_file_name = $nip.'.zip';

			$res = $this->flxziparchive->open($zip_file_name, ZipArchive::CREATE);
			if($res === TRUE)    {
				$this->flxziparchive->addDir($the_folder, basename($the_folder)); 
				$this->flxziparchive->close();
			}	else	{
				echo 'Could not create a zip archive';
			}
	}

/*
	function satu(){
		$path="assets/file/foto/";
		$this->addzip($path , "assets/folder.zip" );
		echo "berhasil";
	}

	function create_zip($files = array(), $dest = '', $overwrite = false) {
		if (file_exists($dest) && !$overwrite) {
			return false;
		}
		if (($files)) {
			$zip = new ZipArchive();
			if ($zip->open($dest, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			foreach ($files as $file) {
				$zip->addFile($file, $file);
			}
			$zip->close();
			return file_exists($dest);
		} else {
			return false;
		}
	}
	
	function addzip($source, $destination) {
		$files_to_zip = glob($source . '/*');
		$this->create_zip($files_to_zip, $destination);
//		echo "done";
	}

	function dua(){
	}

*/



}
?>