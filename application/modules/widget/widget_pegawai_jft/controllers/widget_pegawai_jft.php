<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_pegawai_jft extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_pegawai_jft');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{

		$data['isi'] = $this->m_pegawai_jft->get_jft();
		$data['margin_top']=$opsi[0]->nilai;
		$this->load->view('index',$data);
	}

}