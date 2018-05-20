<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jabfung extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_anjab');
		$this->load->model('appevjab/m_kelas');
		date_default_timezone_set('Asia/Jakarta');
	}


	function index(){
		$data['satu'] = "Referensi Jabatan";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['tipe'] = (isset($_POST['tipe']))?$_POST['tipe']:"jfu";
		$this->load->view('jabfung/index',$data);
	}
	function getdata(){
		$tipe = $_POST['tipe'];
		
		$judul['jfu'] = "Daftar Jabatan Fungsional Umum";
		$judul['jft'] = "Daftar Jabatan Fungsional Tertentu";
		$judul['jft-guru'] = "Daftar Jabatan Guru";
		$judul['js'] = "Daftar Kelas Jabatan Struktural";
		$judul['jsst'] = "Daftar Jabatan Struktural Master";
		
		$data['judul'] = $judul[$tipe];

		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_anjab->hitung_jabfung($cari,$tipe);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			////////***
			$this->session->set_userdata("hal",$hal);
			$this->session->set_userdata("batas",$batas);
			$this->session->set_userdata("cari",$cari);
			$this->session->set_userdata("tipe",$tipe);
			////////***
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_anjab->get_jabfung($cari,$mulai,$batas,$tipe);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->cek = $this->m_anjab->get_urtug($val->id_jabatan,$tipe);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function formedit(){
		$data['idd']=$_POST['idd'];
		$data['unit'] = $this->m_anjab->ini_jabfung($data['idd']);
		$this->load->view('jabfung/formedit',$data);
	}
	function edit_aksi(){
 		$this->form_validation->set_rules("kode_bkn","Kode Jabatan","trim|required|xss_clean");
        $this->form_validation->set_rules("nama_jabatan","Nama Jabatan","trim|required|xss_clean");
 		$this->form_validation->set_rules("idd","ID Jabatan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_anjab->edit_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formtambah(){
		$data['tipe'] = $_POST['tipe'];
		$this->load->view('jabfung/formtambah',$data);
	}
	function tambah_aksi(){
 		$this->form_validation->set_rules("kode_bkn","Kode Jabatan","trim|required|xss_clean");
        $this->form_validation->set_rules("nama_jabatan","Nama Jabatan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_anjab->tambah_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formhapus(){
		$data['idd']=$_POST['idd'];
		$data['unit'] = $this->m_anjab->ini_jabfung($data['idd']);
		$this->load->view('jabfung/formhapus',$data);
	}
	function hapus_aksi(){
		$ddir=$this->m_anjab->hapus_aksi($_POST); 
		echo "sukses#"."add#";
	}
////////////////////////////////////////////////////////
	function jenjang_jabatan(){
		$data['idd'] = $_POST['idd'];
		$data['unit'] = $this->m_anjab->ini_jabfung($data['idd']);
		$data['jenjang'] = $this->m_anjab->get_jenjang($data['idd']);
		$data['dWpangkat'] = $this->dropdowns->kode_pangkat();
		$data['dWgolongan'] = $this->dropdowns->kode_golongan();
		$this->load->view('jabfung/jenjang_jabatan',$data);
	}
	function jenjang_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['idk'] = "xx";
		$data['aksi'] = "tambah";
		$this->load->view('jabfung/jenjang_form',$data);
	}
	function jenjang_tambah_aksi(){
		$this->m_anjab->jenjang_tambah($_POST);
		echo "sukses#";
	}
	function jenjang_edit(){
		$gh = explode("**",$_POST['idd']);
		$data['idd'] = $gh[0];
		$data['idk'] = $gh[1];
		$data['aksi'] = "edit";
		$data['row'] = $this->m_anjab->ini_jenjang($data['idk']);
		$this->load->view('jabfung/jenjang_form',$data);
	}
	function jenjang_edit_aksi(){
		$this->m_anjab->jenjang_edit($_POST);
		echo "sukses#";
	}
	function jenjang_hapus(){
		$gh = explode("**",$_POST['idd']);
		$data['idd'] = $gh[0];
		$data['idk'] = $gh[1];
		$data['aksi'] = "hapus";
		$data['hapus'] = "ya";
		$data['row'] = $this->m_anjab->ini_jenjang($data['idk']);
		$this->load->view('jabfung/jenjang_form',$data);
	}
	function jenjang_hapus_aksi(){
		$this->m_anjab->jenjang_hapus($_POST);
		echo "sukses#";
	}
	function jenjang_guru(){
		$data['jenjang'] = $this->m_anjab->get_jenjang_guru();
		$data['dWpangkat'] = $this->dropdowns->kode_pangkat();
		$data['dWgolongan'] = $this->dropdowns->kode_golongan();
		$this->load->view('jabfung/jenjang_guru',$data);
	}
////////////////////////////////////////////////////////
	function prestasi(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['prestasi'] = $this->m_anjab->get_prestasi($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/prestasi',$data);
	}
	function prestasi_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_prestasi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/prestasi_form',$data);
	}
	function prestasi_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->prestasi_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function prestasi_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_prestasi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/prestasi_form',$data);
	}
	function prestasi_edit_aksi(){
		$this->m_anjab->prestasi_edit($_POST);
		echo "sukses";
	}
	function prestasi_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_prestasi($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/prestasi_form',$data);
	}
	function prestasi_hapus_aksi(){
		$this->m_anjab->prestasi_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function resiko(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['resiko'] = $this->m_anjab->get_resiko($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/resiko',$data);
	}
	function resiko_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_resiko($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/resiko_form',$data);
	}
	function resiko_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->resiko_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function resiko_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_resiko($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/resiko_form',$data);
	}
	function resiko_edit_aksi(){
		$this->m_anjab->resiko_edit($_POST);
		echo "sukses";
	}
	function resiko_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_resiko($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/resiko_form',$data);
	}
	function resiko_hapus_aksi(){
		$this->m_anjab->resiko_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function kondisi(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['kondisi'] = $this->m_anjab->get_kondisi($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/kondisi',$data);
	}
	function kondisi_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_kondisi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/kondisi_form',$data);
	}
	function kondisi_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->kondisi_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function kondisi_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_kondisi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/kondisi_form',$data);
	}
	function kondisi_edit_aksi(){
		$this->m_anjab->kondisi_edit($_POST);
		echo "sukses";
	}
	function kondisi_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_kondisi($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/kondisi_form',$data);
	}
	function kondisi_hapus_aksi(){
		$this->m_anjab->kondisi_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function korelasi(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['korelasi'] = $this->m_anjab->get_korelasi($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/korelasi',$data);
	}
	function korelasi_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_korelasi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/korelasi_form',$data);
	}
	function korelasi_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->korelasi_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function korelasi_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_korelasi($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/korelasi_form',$data);
	}
	function korelasi_edit_aksi(){
		$this->m_anjab->korelasi_edit($_POST);
		echo "sukses";
	}
	function korelasi_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_korelasi($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/korelasi_form',$data);
	}
	function korelasi_hapus_aksi(){
		$this->m_anjab->korelasi_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function hasil(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['hasil'] = $this->m_anjab->get_hasil($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/hasil',$data);
	}
	function hasil_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_hasil($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/hasil_form',$data);
	}
	function hasil_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->hasil_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function hasil_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_hasil($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/hasil_form',$data);
	}
	function hasil_edit_aksi(){
		$this->m_anjab->hasil_edit($_POST);
		echo "sukses";
	}
	function hasil_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_hasil($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/hasil_form',$data);
	}
	function hasil_hapus_aksi(){
		$this->m_anjab->hasil_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function alat(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['alat'] = $this->m_anjab->get_alat($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/alat',$data);
	}
	function alat_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_alat($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/alat_form',$data);
	}
	function alat_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->alat_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function alat_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_alat($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/alat_form',$data);
	}
	function alat_edit_aksi(){
		$this->m_anjab->alat_edit($_POST);
		echo "sukses";
	}
	function alat_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_alat($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/alat_form',$data);
	}
	function alat_hapus_aksi(){
		$this->m_anjab->alat_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function bahan(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['bahan'] = $this->m_anjab->get_bahan($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");
		$this->load->view('jabfung/bahan',$data);
	}
	function bahan_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_bahan($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/bahan_form',$data);
	}
	function bahan_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->bahan_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function bahan_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_bahan($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/bahan_form',$data);
	}
	function bahan_edit_aksi(){
		$this->m_anjab->bahan_edit($_POST);
		echo "sukses";
	}
	function bahan_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_bahan($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/bahan_form',$data);
	}
	function bahan_hapus_aksi(){
		$this->m_anjab->bahan_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function wewenang(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['wewenang'] = $this->m_anjab->get_wewenang($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");

		$this->load->view('jabfung/wewenang',$data);
	}
	function wewenang_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_wewenang($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/wewenang_form',$data);
	}
	function wewenang_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->wewenang_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function wewenang_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_wewenang($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/wewenang_form',$data);
	}
	function wewenang_edit_aksi(){
		$this->m_anjab->wewenang_edit($_POST);
		echo "sukses";
	}
	function wewenang_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_wewenang($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/wewenang_form',$data);
	}
	function wewenang_hapus_aksi(){
		$this->m_anjab->wewenang_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function tanggungjawab(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['tanggungjawab'] = $this->m_anjab->get_tanggungjawab($data['idd'],$data['jab_type']);

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");

		$this->load->view('jabfung/tanggungjawab',$data);
	}
	function tanggungjawab_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_tanggungjawab($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/tanggungjawab_form',$data);
	}
	function tanggungjawab_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->tanggungjawab_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function tanggungjawab_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_tanggungjawab($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/tanggungjawab_form',$data);
	}
	function tanggungjawab_edit_aksi(){
		$this->m_anjab->tanggungjawab_edit($_POST);
		echo "sukses";
	}
	function tanggungjawab_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_tanggungjawab($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/tanggungjawab_form',$data);
	}
	function tanggungjawab_hapus_aksi(){
		$this->m_anjab->tanggungjawab_hapus($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function urtug_alih(){
		$this->session->set_userdata("id_jabatan",$_POST['idd']);
		redirect("module/appevjab/jabfung/urtug");
	}
	function urtug(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_kelas->ini_kelas_jabatan($data['idd'],$data['jab_type']);
		$data['urtug'] = $this->m_anjab->get_urtug($data['idd'],$data['jab_type']);
		foreach($data['urtug'] AS $key=>$val){
			@$data['urtug'][$key]->cek = $this->m_anjab->get_urtug_tahapan($val->id_urtug);
		}
		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");
		$data['tipe'] = $this->session->userdata("tipe");

		$this->load->view('jabfung/urtug',$data);
	}
	function urtug_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/urtug_form',$data);
	}
	function urtug_tambah_aksi(){
		$idj = $this->session->userdata("id_jabatan");
		$jT = $this->session->userdata("jab_type");
		$this->m_anjab->urtug_tambah($idj,$jT,$_POST);
		echo "sukses";
	}
	function urtug_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/urtug_form',$data);
	}
	function urtug_edit_aksi(){
		$this->m_anjab->urtug_edit($_POST);
		echo "sukses";
	}
	function urtug_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/urtug_form',$data);
	}
	function urtug_hapus_aksi(){
		$this->m_anjab->urtug_hapus($_POST);
		echo "sukses";
	}

	function urtug_tahapan(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['tahapan'] = $this->m_anjab->get_urtug_tahapan($data['idd']);
		$this->load->view('jabfung/urtug_tahapan',$data);
	}
	function tahapan_formtambah(){
		$data['idt'] = $_POST['idt'];
		$data['isian'] = "ya";
		$this->load->view('jabfung/tahapan_form',$data);
	}
	function tahapan_tambah_aksi(){
		$idU = $_POST['id_urtug'];
		$this->m_anjab->tahapan_tambah($idU,$_POST);
	}
	function tahapan_formedit(){
		$data['idt'] = $_POST['idt'];
		$data['val'] = $this->m_anjab->ini_urtug_tahapan($data['idt']);
		$data['isian'] = "ya";
		$this->load->view('jabfung/tahapan_form',$data);
	}
	function tahapan_edit_aksi(){
		$this->m_anjab->tahapan_edit($_POST);
	}
	function tahapan_formhapus(){
		$data['idt'] = $_POST['idt'];
		$data['val'] = $this->m_anjab->ini_urtug_tahapan($data['idt']);
		$data['isian'] = "tidak";
		$this->load->view('jabfung/tahapan_form',$data);
	}
	function tahapan_hapus_aksi(){
		$this->m_anjab->tahapan_hapus($_POST);
	}


////////////////////////////////////////////////////////
}
?>