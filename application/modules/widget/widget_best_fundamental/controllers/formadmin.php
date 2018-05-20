<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->auth->restrict();
	}

	public function tambah()	{
		$data['nilai'] = array();
		$this->load->view('formadmin',$data);
	}
	public function edit()	{
		$data['nilai'] = explode(",",$_POST['opsi']);
		$this->load->view('formadmin',$data);
	}

}