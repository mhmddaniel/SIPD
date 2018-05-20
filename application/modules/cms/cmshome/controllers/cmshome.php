<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cmshome extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_home');
		$this->load->library("paging");
	}
	
	function index(){
			if($this->uri->segment(5)==""){
				echo Modules::run("cmshome/".$this->uri->segment(4)."/index");
			} else {
				echo Modules::run("cmshome/".$this->uri->segment(4)."/".$this->uri->segment(5));
			}
	}

	function form_text(){
		$data['idd'] = $_POST['idd'];
		$ini = $this->m_home->iniopsi($data['idd']);
			$jj = json_decode($ini[0]->meta_value);
		$data['label'] = $jj->label;
		$data['nilai'] = $jj->nilai;
		$this->load->view('form_text',$data);
	}
	function edit_text_aksi(){
 		$this->form_validation->set_rules("nama_kategori","ISIAN..","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_home->edit_text_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function form_upload(){
		$data['idd'] = $_POST['idd'];
		$ini = $this->m_home->iniopsi($data['idd']);
			$jj = json_decode($ini[0]->meta_value);
		$data['label'] = $jj->label;
		$data['nilai'] = $jj->nilai;
		$this->load->view('form_upload',$data);
	}
	function ganti_gambar(){
    	$hasil=$this->m_home->simpan_file($_POST['id_opsi'],$_POST['id_gambar'],$_POST['path']);
		echo $hasil;
	}
/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////Titipan dari Halaman Login///////////////////////////////////
/// ---> RUBRIK / KATEGORI
	function hitungrubrik($komponen){
		$res = $this->m_home->hitung_rubrik($komponen);
		return $res;
	}
	function getrubrik($komponen,$mulai,$batas){
		$res = $this->m_home->get_rubrik($komponen,$mulai,$batas)->result();
		return $res;
	}
	function detailrubrik($idd){
		$res = $this->m_home->detail_rubrik($idd)->result();
		return $res;
	}
/// ---> JUDUL KONTEN
	function hitungkonten($rubrik,$komponen){
		$res = $this->m_home->hitung_konten($rubrik,$komponen);
		return $res;
	}
	function getkonten($mulai,$batas,$rubrik,$komponen){
		$res = $this->m_home->get_konten($mulai,$batas,$rubrik,$komponen);
		return $res;
	}
	function detailkonten($idkonten){
		$res = $this->m_home->detail_konten($idkonten);
		return $res;
	}
/// ---> PENULIS
	function hitungpenulis($rubrik,$komponen){
		$res = $this->m_home->hitung_penulis($rubrik,$komponen);
		return $res;
	}
/// ---> FOTO KONTEN
	function fotokonten($idkonten){
		$res = $this->m_home->foto_konten($idkonten)->result();
		return $res;
	}
/// ---> SLIDER KONTEN
	function sliderkonten($idkonten){
		$res = $this->m_home->slider_konten($idkonten)->result();
		return $res;
	}
/// ---> LAMPIRAN KONTEN
	function lampirankonten($idkonten){
		$res = $this->m_home->lampiran_konten($idkonten);
		return $res;
	}
/// ---> OPTIONS
	function kanal_options($id_parent=0,$id_kanal="",$awal=1){
		$res = $this->m_home->get_kanal($id_parent);
		$str_opt = '';
		
		$awl = $awal+1;
		foreach($res as $key=>$val):
			$slc = ($id_kanal==$val->id_item)?"selected":"";
			$prep = ($awl==2)?"":" - ";
			$str_opt.= "<option value='".$val->id_item."' ".$slc.">".$prep.ucfirst($val->nama_item)."</option>";
			$str_opt.=$this->kanal_options($val->id_item,$id_kanal,$awl);
		endforeach;
		return $str_opt;
	}
/// ---> DEFAULT KANAL
	function default_kanal(){
		$res = $this->m_home->default_kanal();
		return $res;
	}

	function kategori_options($id_kategori="",$komponen){
		$res = $this->m_home->get_rubrik($komponen,0,100);
		$str_opt = '';
		foreach($res as $key=>$val):
			$slc = ($id_kategori==$val->id_kategori)?"selected":"";
			$str_opt.= "<option value='".$val->id_kategori."' ".$slc.">".ucfirst($val->nama_kategori)." (kanal : ".($val->nama_kanal).")</option>";
		endforeach;
		return $str_opt;
	}
	function penulis_options($id_penulis=""){
		$res = $this->m_home->get_penulis("all",100)->result();
		$str_opt = '';
		foreach($res as $key=>$val):
			$slc = ($id_penulis==$val->id_penulis)?"selected":"";
			$str_opt.= "<option value='".$val->id_penulis."' ".$slc.">".ucfirst($val->nama_penulis)."</option>";
		endforeach;
		return $str_opt;
	}
	function komponen_options($rbrk="all",$komponen=""){
		$res = $this->m_home->get_komponen($rbrk,"all",1000);
		$str_opt = '';
		foreach($res as $key=>$val):
			$jj = json_decode($val->meta_value);
			$slc = ($val->nama_item==$komponen)?"selected":"";
			$str_opt.="<option value='".$val->nama_item."' ".$slc.">".ucfirst($jj->label)."</option>";
		endforeach;
		return $str_opt;
	}
	function pilihanpolling($poll){
		$res = $this->m_home->get_pilihanpolling($poll)->result();
		return $res;
	}
	function theme_options($path=""){
		$res = $this->m_home->get_theme("all",1000)->result();
		$str_opt = '';
		foreach($res as $key=>$val):
			$jj = json_decode($val->meta_value);
			$slc = ($jj->theme_path==$path)?"selected":"";
			$str_opt.="<option value='".$jj->theme_path."' ".$slc.">".ucfirst($val->nama_item)."</option>";
		endforeach;
		return $str_opt;
	}
	function theme_admin_options($path=""){
		$res = $this->m_home->get_theme_admin("all",1000)->result();
		$str_opt = '';
		foreach($res as $key=>$val):
			$jj = json_decode($val->meta_value);
			$slc = ($jj->theme_path==$path)?"selected":"";
			$str_opt.="<option value='".$jj->theme_path."' ".$slc.">".ucfirst($val->nama_item)."</option>";
		endforeach;
		return $str_opt;
	}
	function height_options($path=""){
		$str_opt = '';
		for($i=5;$i<56;$i++){
			$slc = (($i*5)."px"==$path)?"selected":"";
			$str_opt.="<option value='".($i*5)."px' ".$slc.">".($i*5)."px</option>";
		}
		return $str_opt;
	}
	function margin_options($path=""){
		$str_opt = '';
		for($i=0;$i<81;$i++){
			$slc = ($i."px"==$path)?"selected":"";
			$str_opt.="<option value='".$i."px' ".$slc.">".$i."px</option>";
		}
		return $str_opt;
	}
	function durasi_options($path=""){
		$str_opt = '';
		for($i=2;$i<11;$i++){
			$slc = (($i*500)==$path)?"selected":"";
			$str_opt.="<option value='".($i*500)."' ".$slc.">".($i*500/1000)." detik</option>";
		}
		return $str_opt;
	}
	function banyak_post_options($path=""){
		$str_opt = '';
		for($i=1;$i<51;$i++){
			$slc = ($i==$path)?"selected":"";
			$str_opt.="<option value='".$i."' ".$slc.">".$i." item</option>";
		}
		return $str_opt;
	}
	function paging_kategori_options($path=""){
		$str_opt = '';
		for($i=1;$i<26;$i++){
			$slc = ($i==$path)?"selected":"";
			$str_opt.="<option value='".$i."' ".$slc.">".$i." item</option>";
		}
		return $str_opt;
	}
	function lokasi_widget_options($path=""){
		$pil = array('topbar','mainbar','sidebar');
		for($i=0;$i<3;$i++){
			$slc = ($pil[$i]==$path)?"selected":"";
			$str_opt.="<option value='".$pil[$i]."' ".$slc.">".$pil[$i]."</option>";
		}
		return $str_opt;
	}



}
?>