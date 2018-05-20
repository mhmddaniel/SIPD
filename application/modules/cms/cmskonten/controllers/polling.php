<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Polling extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_polling');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('polling');
		$this->load->view('polling/index',$data);
	}
	function getkonten(){
		$dt = $this->m_konten->hitung_konten($_POST['cari'],$_POST['komponen'],$_POST['id_kat']);
		if($dt==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else { 
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_konten->get_konten($_POST['cari'],$mulai,$batas,$_POST['komponen'],$_POST['id_kat']);
			foreach($data['hslquery'] as $it=>$val){
					$cek = Modules::run("cmshome/fotokonten",$val->id_konten);
					if(!empty($cek)){
						$data['hslquery'][$it]->cek="ada";
						$data['hslquery'][$it]->thumb="<img src='".base_url().@$cek[0]->foto."' height=40 border=0>";
					}	else	{
						$data['hslquery'][$it]->cek="kosong";
						$data['hslquery'][$it]->thumb="<img src='".base_url()."assets/media/upload/bawaan/no_images.gif' height=40 border=0>";
					}
					$cek3 = Modules::run("cmshome/lampirankonten",$val->id_konten);
					if(!empty($cek3)){
						$data['hslquery'][$it]->cek3="ada";
						$data['hslquery'][$it]->lampiran="<img src='".base_url()."assets/media/upload/bawaan/any_attachment.gif' height=40 border=0>";
					} else {
						$data['hslquery'][$it]->cek3="kosong";
						$data['hslquery'][$it]->lampiran="<img src='".base_url()."assets/media/upload/bawaan/no_attachment.gif' height=40 border=0>";
					}
					$cek = Modules::run("cmshome/pilihanpolling",$val->id_konten);
					if(!empty($cek)){
						$data['hslquery'][$it]->cekpil="ada";
						$data['hslquery'][$it]->pil=@$cek;
					}	else	{
						$data['hslquery'][$it]->cekpil="kosong";
						$data['hslquery'][$it]->pil="";
					}
			}
			$data['pager'] = Modules::run("web/pagerC",$dt,$batas,$hal);
		}
			echo json_encode($data);
	}
	function formtambah(){
		$data = array( 'tema'=> 'Wajib diisi','tgl_mulai'=> 'Wajib diisi','tgl_selesai'=> 'Wajib diisi', 'tempat'=> 'Wajib diisi', 'isi_agenda'=> 'Wajib diisi');
		if($_POST['id_kat']==""){
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options","","polling");
				$vv = $vv."</select>\n";

		} else {
				$dt = Modules::run("cmshome/detailrubrik",$_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".$dt[0]->id_item."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		}
		$data['pilrb']=$vv;
		$data['aksi'] = "tambah";
		$this->load->view('polling/formedit',$data);
	}
	function tambah_aksi(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("judul","Judul Polling","trim|required|xss_clean");
        $this->form_validation->set_rules("isi","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_polling->tambah_aksi($_POST);
			echo "sukses#kjkj";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formedit(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,"polling");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['aksi'] = "edit";
		$this->load->view('polling/formedit',$data);
	}
	function edit_aksi(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("judul","Judul Polling","trim|required|xss_clean");
        $this->form_validation->set_rules("isi","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_polling->edit_aksi($_POST);
			echo "sukses#kjkj";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formhapus(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\" disabled>\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,"polling");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['aksi'] = "hapus";
		$this->load->view('polling/formedit',$data);
	}
	function hapus_aksi(){
			$this->m_polling->hapus_aksi($_POST);
			echo "sukses#kjkj";
	}
////////////////////////////////////////////////////////////////////
//////////////////////////PILIHAN HANDLING//////////////////////////
	function formpilihan(){
		$data['idd']=$_POST['id_konten'];
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['jj']=array();
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('polling/formpilihan',$data);
	}
	function tambah_pilihan_aksi(){
		$this->load->library("form_validation");
		$jml=count($this->input->post('pilihan')); 
		for($i=0;$i<$jml;$i++){
	        $this->form_validation->set_rules("pilihan[$i]","Pilihan - ".($i+1),"trim|required|xss_clean");
		}
		if($this->form_validation->run()) {
			$this->m_polling->tambah_pilihan_aksi($_POST);
			echo "sukses#kjkj";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formpilihanedit(){
		$data['idd']=$_POST['id_konten'];
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['pil'] = Modules::run("cmshome/pilihanpolling",$_POST['id_konten']);
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('polling/formpilihanedit',$data);
	}
	function edit_pilihan_aksi(){
		$this->m_polling->edit_pilihan_aksi($_POST);
		echo "success#ggr";
	}
	function tambah_pilihan_satu_aksi(){
		$this->m_polling->tambah_pilihan_satu_aksi($_POST);
		echo "success";
	}
	function reurut_pilihan(){
		$this->m_polling->reurut_pilihan_aksi($_POST);
		echo "success";
	}
	function hapus_pilihan_aksi(){
		$this->m_polling->hapus_pilihan_aksi($_POST);
		echo "success";
	}
/*
function loadForm(){
	$('#sb_act').attr('action','<?=site_url();?>admin/module/cmskonten/polling/formpilihanedit');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="id_kat" value="<?=$id_kat;?>">';
	var tab = tab + '<input type="hidden" name="id_konten" value="<?=$idd;?>">';	
	$('#sb_act').html(tab).submit();
}
*/

///////////////////////////RUBRIK HANDLING//////////////////////////
	function custom_kategori(){
		echo "";
	}

}
?>