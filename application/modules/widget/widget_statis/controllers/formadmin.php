<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_widget_statis');
		$this->auth->restrict();
	}

	public function tambah()	{
			$tpl_1= Modules::run("cmshome/margin_options","10px");
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options","10px");
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$data['nilai'][2] = "3";

			$rbk = $this->m_widget_statis->getkategori_by_komponen("statis");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td>";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_konten."'>";
				$data['pilisi'].="</td><td>".$val->judul."</td><td>".$val->sub_judul."</td></tr>";
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

			$rbk = $this->m_widget_statis->getkategori_by_komponen("statis");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$chk = (in_array($val->id_konten,$id_kategori))?"checked":"";
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td class=\"gridcell\">";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_konten."' $chk>";
				$data['pilisi'].="</td><td>".$val->judul."</td><td>".$val->sub_judul."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}

}