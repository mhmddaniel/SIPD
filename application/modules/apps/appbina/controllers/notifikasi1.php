<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Notifikasi extends MX_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Notifikasi"; 
		$this->load->view('notifikasi/index',$data);
	}
	

}
?>