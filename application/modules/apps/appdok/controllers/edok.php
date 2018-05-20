<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_profil');
		date_default_timezone_set('Asia/Jakarta');
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         PROSES DOKUMEN ELEKTRONIK
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['kode'] = $_POST['kode'];
		$data['pns'] = $_POST['pns'];
		$data['pkt'] = $_POST['pkt'];
		$data['jbt'] = $_POST['jbt'];
		$data['ese'] = $_POST['ese'];
		$data['tugas'] = $_POST['tugas'];
		$data['gender'] = $_POST['gender'];
		$data['agama'] = $_POST['agama'];
		$data['status'] = $_POST['status'];
		$data['jenjang'] = $_POST['jenjang'];
		$data['umur'] = $_POST['umur'];
		$data['mkcpns'] = $_POST['mkcpns'];

		$data['idd'] = $_POST['id_pegawai'];
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai",$data['idd']);
		$data['kode_dokumen'] = $this->dropdowns->kode_dokumen_peg();

		$this->load->view('index',$data);
	}
function pasfoto(){
	$data['id_pegawai'] = $_POST['id_pegawai'];

	$data['pegawai'] = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['alamat'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$data['id_pegawai']);
	$cek = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"pasfoto",0);
	if(empty($cek)){

		$fotolama = $this->m_edok->cek_foto_lama($data['id_pegawai']);
		$pathfoto="assets/file/".@$fotolama->foto;
		if(!empty($fotolama) && file_exists($pathfoto)){
			$fotobaru = str_replace("foto/","",$fotolama->foto);
			
			$path="assets/media/file/".$data['pegawai']->nip_baru."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/file/".$data['pegawai']->nip_baru."/pasfoto/";
			if(!file_exists($path2)){	mkdir($path2,755);	}

			copy("assets/file/foto/".$fotobaru,"assets/media/file/".$data['pegawai']->nip_baru."/pasfoto/".$fotobaru);

				$config['image_library'] = 'gd2';
				$config['width'] = 250;
				$config['height'] = 150;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['source_image'] = 'assets/file/foto/'.$fotobaru;
				$config['new_image'] = 'assets/media/file/'.$data['pegawai']->nip_baru.'/pasfoto/thumb_'.$fotobaru;
				$this->load->library('image_lib', $config);
				$cekG = $this->image_lib->resize();


			$this->m_edok->simpan_dokumen($data['pegawai']->nip_baru,$fotobaru,"pasfoto",0);
			
			$data['pasfoto'] = "assets/media/file/".$data['pegawai']->nip_baru."/pasfoto/".$fotobaru;
			$data['ada'] = "yes";


		} else {
			$data['pasfoto'] = "assets/file/foto/photo.jpg";
			$data['ada'] = "no";
		}

	} else {
		$data['pasfoto'] = "assets/media/file/".$data['pegawai']->nip_baru."/pasfoto/".$cek[0]->file_dokumen;
		$data['ada'] = "yes";
	}

	$this->load->view('pasfoto/index',$data);
}



function sertifikat_prajab(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sertifikat_prajab";
	$cek = $this->m_edok->cek_dokumen($data['id_pegawai'],'sertifikat_prajab','0');


	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_sertifikat_prajab($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id_peg_diklat_struk);
			$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$data['komponen']."/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('sertifikat_prajab/index',$data);
}
function karpeg(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "karpeg";
	$cek = $this->m_edok->cek_dokumen($data['id_pegawai'],'karpeg',0);
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_karpeg($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id_karpeg);
			$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$data['komponen']."/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('karpeg/index',$data);
}
function konversi_nip(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "konversi_nip";
	$cek = $this->m_edok->cek_dokumen($data['id_pegawai'],'konversi_nip',0);
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_konversi_nip($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id_konversi_nip);
			$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$data['komponen']."/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('konversi_nip/index',$data);
}
function sk_cpns(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sk_cpns";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_cpns($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_cpns/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('sk_cpns/index',$data);
}
function sk_pns(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sk_pns";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_pns($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pns/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('sk_pns/index',$data);
}
function sk_pangkat(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sk_pangkat";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_pegawai_pangkat($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_golongan);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pangkat/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('sk_pangkat/index',$data);
}
function ijazah_pendidikan(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "ijazah_pendidikan";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = Modules::run("appbkpp/profile/get_riwayat_pendidikan",$_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_pendidikan);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('ijazah_pendidikan/index',$data);
}
function sk_jabatan(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sk_jabatan";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_pegawai_jabatan($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_jab);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('sk_jabatan/index',$data);
}
function sertifikat_diklat(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sertifikat_diklat";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_sertifikat_diklat($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_diklat_struk);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_diklat/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('sertifikat_diklat/index',$data);
}
function karis_karsu(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "karis_karsu";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_pegawai_pernikahan($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_perkawinan);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/karis_karsu/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('karis_karsu/index',$data);
}
function taspen(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "taspen";
	$cek = $this->m_edok->cek_dokumen($data['id_pegawai'],'taspen',0);
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_taspen($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id_taspen);
			$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$data['komponen']."/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('taspen/index',$data);
}
function sertifikat_kursus(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sertifikat_kursus";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->ini_pegawai_kursus($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_kursus);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_kursus/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('sertifikat_kursus/index',$data);
}
function sertifikat_penghargaan(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "sertifikat_penghargaan";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_sertifikat_penghargaan($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_penghargaan);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_penghargaan/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('sertifikat_penghargaan/index',$data);
}
function skp(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "skp";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_skp($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_skp);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/skp/thumb_".$dok_ref[0]->file_dokumen;
	}
	$this->load->view('skp/index',$data);
}
function dp3(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "dp3";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_dp3($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_dp3);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/dp3/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('dp3/index',$data);
}
function ujian_dinas(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "ujian_dinas";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_ujian_dinas($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_ujian_dinas);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ujian_dinas/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('ujian_dinas/index',$data);
}
function penyesuaian_ijazah(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "penyesuaian_ijazah";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_penyesuaian_ijazah($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_peg_penyesuaian_ijazah);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/penyesuaian_ijazah/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('penyesuaian_ijazah/index',$data);
}
function pak(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "pak";
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_pak($_POST['id_pegawai']);
	foreach($data['isi'] AS $key=>$val){
		$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$val->id_pak);
		@$data['isi'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/pak/thumb_".$dok_ref[0]->file_dokumen;
		@$data['isi'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
	}
	$this->load->view('pak/index',$data);
}
function pupns(){
	$data['id_pegawai'] = $_POST['id_pegawai'];
	$data['komponen'] = "pupns";
	$cek = $this->m_edok->cek_dokumen($data['id_pegawai'],'pupns',0);
	$pegawai = $this->m_edok->ini_pegawai($data['id_pegawai']);
	$data['isi'] = $this->m_profil->get_pupns($_POST['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$data['komponen'],$data['isi']->id_pupns);
			$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$data['komponen']."/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
	$this->load->view('pupns/index',$data);
}


}
?>