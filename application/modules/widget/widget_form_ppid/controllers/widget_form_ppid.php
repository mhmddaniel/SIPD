<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_form_ppid extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_form_ppid');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['margin_top']=$opsi[0]->nilai;
		$this->load->view('form',$data);
	}

}