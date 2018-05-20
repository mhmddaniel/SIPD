<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dl extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Ijin Dinas Luar"; 
		$this->load->view('dl/index',$data);
	}
	

}
?>