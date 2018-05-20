<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_ultah_pegawai extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_ultah_pegawai');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{

		$data['isi'] = $this->m_ultah_pegawai->get_ultah();
				foreach($data['isi'] AS $key=>$val){
					$data['isi'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				}
		$data['margin_top']=$opsi[0]->nilai;
		$data['satu']=$opsi[1]->nilai;
		$data['dua']=$opsi[2]->nilai;
		$this->load->view('index',$data);
	}

}