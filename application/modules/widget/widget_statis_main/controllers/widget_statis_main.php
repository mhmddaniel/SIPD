<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_statis_main extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_statis_main');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['daftar'] = $this->m_statis_main->getwidget($id_widget,$id_wrapper);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
			@$data['daftar'][0]->kat_seo = str_replace($d, '-', $data['daftar']->nama_kategori);
			@$data['daftar'][0]->seo=str_replace($d, '-', $data['daftar']->judul);
			$fr=@$data['daftar']->isi_konten;
			$df=explode("\n",$fr);
			@$data['daftar'][0]->sub=$df[0];

			$data['margin_top']=$opsi[0]->nilai;

		$this->load->view('index',$data);
	}

}