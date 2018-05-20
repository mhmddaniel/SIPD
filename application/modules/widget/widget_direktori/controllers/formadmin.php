<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_direktori');
		$this->auth->restrict();
	}

	public function tambah()	{
			$rbk = $this->m_direktori->getkategori_by_komponen("direktori");
			$data['nilai'][0] = "10px";
			$data['nilai'][1] = "10px";
			$data['nilai'][2] = "3";
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td>";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."'>";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}
	public function edit()	{
			$id_kategori = ($_POST['id_kategori']=="{}")?array():explode(",",$_POST['id_kategori']);
			$data['nilai'] = explode(",",$_POST['opsi']);
			$rbk = $this->m_direktori->getkategori_by_komponen("direktori");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$chk = (in_array($val->id_item,$id_kategori))?"checked":"";
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td>";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."' ".$chk.">";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}

}