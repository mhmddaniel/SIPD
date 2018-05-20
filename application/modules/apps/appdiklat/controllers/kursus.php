<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Kursus extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdiklat/m_kursus');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function diklat_prajabatan(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 1;
		$data['nama'] = "diklat prajabatan";
		$this->load->view('kursus/diklat_prajabatan',$data);
	}
	function diklat_penjenjangan(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 2;
		$data['nama'] = "diklat penjenjangan";
		$this->load->view('kursus/diklat_penjenjangan',$data);
	}
	function seminar(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 8;
		$data['nama'] = "seminar";
		$this->load->view('kursus/diklat_penjenjangan',$data);
	}
	function index(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 6;
		$data['nama'] = "kursus";
		$this->load->view('kursus/index',$data);
	}
	function diklat_fungsional(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 3;
		$data['nama'] = "diklat fungsional";
		$this->load->view('kursus/index',$data);
	}
	function diklat_teknis(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 4;
		$data['nama'] = "diklat teknis";
		$this->load->view('kursus/index',$data);
	}
	function bimtek(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 5;
		$data['nama'] = "bimbingan teknis";
		$this->load->view('kursus/index',$data);
	}
	function sertifikasi(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 7;
		$data['nama'] = "sertifikasi";
		$this->load->view('kursus/index',$data);
	}
	function workshop(){
		$data['satu'] = "Referensi Pendidikan dan Pelatihan";
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['rumpun'] = 9;
		$data['nama'] = "workshop";
		$this->load->view('kursus/index',$data);
	}
	function picker(){
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['id_rumpun'] = $_POST['id_rumpun'];
		$rumpun = $this->rumpun_diklat();
		$data['nama'] = $rumpun[$data['id_rumpun']];
		$this->load->view('kursus/picker',$data);
	}
	function getdata(){
		$rumpun = $_POST['rumpun'];
		$cari = $_POST['cari'];
		$data['count'] = $this->m_kursus->hitung_diklat($rumpun,$cari);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_kursus->get_diklat($rumpun,$cari,$mulai,$batas);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
//////////////////////////////////////////////////////////////////////////
	function tambah(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['jenjang_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenjang');
		$data['jenis_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$data['aksi'] = "tambah";
		$this->load->view('kursus/kursus_form',$data);
	}
	function tambah_diklat_prajabatan(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "tambah";
		$this->load->view('kursus/diklat_prajabatan_form',$data);
	}
	function tambah_diklat_penjenjangan(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['aksi'] = "tambah";
		$data['jenis_diklat'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$this->load->view('kursus/diklat_penjenjangan_form',$data);
	}
	function tambah_aksi(){
		$jenis = $this->jangnis_kursus($_POST['rumpun'],'jenis');
		$jenjang = $this->jangnis_kursus($_POST['rumpun'],'jenjang');
		$jns = $jenis[$_POST['jenis_kursus']];
		$jnk = $jenjang[$_POST['jenjang_kursus']];
		$this->m_kursus->tambah_diklat($_POST['rumpun'],$_POST['kode_kursus'],$_POST['nama_kursus'],$jns,$jnk);
		echo "sukses#";
	}
//////////////////////////////////////////////////////////////////////////
	function edit(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['jenjang_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenjang');
		$data['jenis_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$data['aksi'] = "edit";
		$this->load->view('kursus/kursus_form',$data);
	}
	function edit_diklat_prajabatan(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['aksi'] = "edit";
		$this->load->view('kursus/diklat_prajabatan_form',$data);
	}
	function edit_diklat_penjenjangan(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['aksi'] = "edit";
		$data['jenis_diklat'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$this->load->view('kursus/diklat_penjenjangan_form',$data);
	}
	function edit_aksi(){
		$jenis = $this->jangnis_kursus($_POST['rumpun'],'jenis');
		$jenjang = $this->jangnis_kursus($_POST['rumpun'],'jenjang');
		$jns = $jenis[$_POST['jenis_kursus']];
		$jnk = $jenjang[$_POST['jenjang_kursus']];
		$this->m_kursus->edit_diklat($_POST['idd'],$_POST['kode_kursus'],$_POST['nama_kursus'],$jns,$jnk);
		echo "sukses#";
	}
//////////////////////////////////////////////////////////////////////////
	function hapus(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['jenjang_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenjang');
		$data['jenis_kursus'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$data['aksi'] = "hapus";
		$this->load->view('kursus/kursus_form',$data);
	}
	function hapus_diklat_prajabatan(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['aksi'] = "hapus";
		$this->load->view('kursus/diklat_prajabatan_form',$data);
	}
	function hapus_diklat_penjenjangan(){
		$tbs = explode("*",$_POST['idd']);
		$data['nama'] = $tbs[0];
		$data['idd'] = $tbs[1];
		$data['rumpun'] = $tbs[2];
		$data['val'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['aksi'] = "hapus";
		$data['jenis_diklat'] = $this->jangnis_kursus($data['rumpun'],'jenis');
		$this->load->view('kursus/diklat_penjenjangan_form',$data);
	}
	function hapus_aksi(){
		$this->m_kursus->hapus_diklat($_POST['idd']);
		echo "sukses#";
	}
//////////////////////////////////////////////////////////////////
////////////////////pilihan kursus////////////////////////////////
		function rumpun_diklat($asRef=false){
		if(!$asRef){
		  $select [''] = 'Pilih Jenis Diklat';
		}else{
		  $select [''] = '-';
		}
		$select [1] = 'Diklat Prajabatan';
		$select [2] = 'Diklat Penjenjangan';
		$select [3] = 'Diklat Fungsional';
		$select [4] = 'Diklat Teknis';
		$select [5] = 'Bimbingan Teknis';
		$select [6] = 'Kursus';
		$select [7] = 'Sertifikasi';
		$select [8] = 'Seminar';
		$select [9] = 'Workshop';
		
		return $select;
		}

	function jangnis_kursus($idr,$tipe,$asRef=false){
		if(!$asRef){
			$select [''] = 'Pilih Jenis...';
			} else {
			$select [''] = '-';
		}
		$sqlstr="SELECT * FROM md_diklat_jangnis WHERE id_rumpun='$idr' AND tipe='$tipe' ORDER BY kode ASC";
		$query = $this->db->query($sqlstr)->result(); 
		foreach($query AS $key=>$val){	$select [$val->id_diklat_jangnis] = $val->nama_diklat_jangnis;	}
		return $select;
	}
	function jangnis(){
		$rumpun = explode("*",$_POST['idd']);
		$data['nama_rumpun'] = $rumpun[0];
		$data['id_rumpun'] = $rumpun[1];
		$data['tipe'] = $rumpun[2];

		$sqlstr="SELECT * FROM md_diklat_jangnis WHERE id_rumpun='".$data['id_rumpun']."' AND tipe='".$data['tipe']."' ORDER BY kode ASC";
		$data['daftar'] = $this->db->query($sqlstr)->result(); 

		$this->load->view('kursus/kursus_jangnis',$data);
	}
	function jangnis_tambah(){
		$data['idd'] = "xx";
		$data['nomor'] = $_POST['nomor'];
		$data['id_rumpun'] = $_POST['id_rumpun'];
		$data['nama_rumpun'] = $_POST['nama_rumpun'];
		$data['tipe'] = $_POST['tipe'];
		$data['aksi'] = "tambah";
		$this->load->view('kursus/kursus_jangnis_form',$data);
	}
	function jangnis_tambah_aksi(){
		$this->m_kursus->tambah_jangnis($_POST);
		echo "sukses";
	}
	function jangnis_edit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_kursus->ini_jangnis($data['idd']);
		$data['nomor'] = $_POST['nomor'];
		$data['id_rumpun'] = $_POST['id_rumpun'];
		$data['nama_rumpun'] = $_POST['nama_rumpun'];
		$data['tipe'] = $_POST['tipe'];
		$data['aksi'] = "edit";
		$this->load->view('kursus/kursus_jangnis_form',$data);
	}
	function jangnis_edit_aksi(){
		$this->m_kursus->edit_jangnis($_POST);
		echo "sukses";
	}
	function jangnis_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_kursus->ini_jangnis($data['idd']);
		$data['nomor'] = $_POST['nomor'];
		$data['id_rumpun'] = $_POST['id_rumpun'];
		$data['nama_rumpun'] = $_POST['nama_rumpun'];
		$data['tipe'] = $_POST['tipe'];
		$data['aksi'] = "hapus";
		$this->load->view('kursus/kursus_jangnis_form',$data);
	}
	function jangnis_hapus_aksi(){
		$this->m_kursus->hapus_jangnis($_POST);
		echo "sukses";
	}
}
?>