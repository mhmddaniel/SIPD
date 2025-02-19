<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_commented');
		$this->auth->restrict();
	}

	public function tambah()	{
			$tpl_1= Modules::run("cmshome/margin_options","10px");
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options","10px");
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";

			$rbk = $this->m_commented->getkategori_by_komponen("artikel");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td class=\"gridcell\">";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."'>";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}
	public function edit()	{
			$id_kategori = ($_POST['id_kategori']=="{}")?array():explode(",",$_POST['id_kategori']);
			$data['nilai'] = explode(",",$_POST['opsi']);

			$tpl_1= Modules::run("cmshome/margin_options",$data['nilai'][0]);
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options",$data['nilai'][1]);
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";

			$rbk = $this->m_commented->getkategori_by_komponen("artikel");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$chk = (in_array($val->id_item,$id_kategori))?"checked":"";
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td class=\"gridcell\">";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."' ".$chk.">";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}

}