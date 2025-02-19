<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_polling_samping');
		$this->auth->restrict();
	}

	public function tambah()	{
			$tpl_1= Modules::run("cmshome/margin_options","10px");
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options","10px");
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$data['nilai'][2] = "3";

			$rbk = $this->m_polling_samping->getkategori_by_komponen("polling");
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

			$tpl_1= Modules::run("cmshome/margin_options",$data['nilai'][0]);
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options",$data['nilai'][1]);
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";

			$rbk = $this->m_polling_samping->getkategori_by_komponen("polling");
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

	public function tambah_ASLI()	{
			$rbr = $this->m_polling_samping->ini_item($_POST['id_widget']);
			$jj = json_decode($rbr[0]->meta_value);
		$data['id_widget'] = $_POST['id_widget'];
		$data['nama_widget'] = $rbr[0]->nama_item;
		$data['posisi'] = $jj->lokasi_widget;
		$data['komponen'] = $jj->komponen;
		$data['opsi'] = $jj->opsi;
		$id_kategori = ($_POST['id_kategori']=="{}")?array():explode(",",$_POST['id_kategori']);
		
			$data['rubrik'] = $jj->rubrik;
			$rbk = $this->m_polling_samping->getkategori_by_komponen($jj->komponen);
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$chk = (in_array($val->id_item,$id_kategori))?"checked":"";
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td class=\"gridcell\">";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."' ".$chk.">";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('tambah',$data);
	}

}