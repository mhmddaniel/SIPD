<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Slama extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_slama');
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
	function satu(){
		$path="assets/file/foto/";
		$this->addzip($path , "assets/folder.zip" );
		echo "berhasil";
	}

	function dua(){
			$name = 'mydata1.txt';
			$data = 'A Data String!';
			
			$this->zip->add_data($name, $data);
			
			// Write the zip file to a folder on your server. Name it "my_backup.zip"
			$this->zip->archive('/path/to/directory/my_backup.zip'); 
			
			// Download the file to your desktop. Name it "my_backup.zip"
			$this->zip->download('my_backup.zip');
	}

//class FlxZipArchive extends ZipArchive {
        /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
    public function addDir($location, $name) {
        $this->addEmptyDir($name);
         $this->addDirDo($location, $name);
     } // EO addDir;

        /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';         $location .= '/';
      // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))    {
            if ($file == '.' || $file == '..') continue;
          // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    } 
//}




}
?>