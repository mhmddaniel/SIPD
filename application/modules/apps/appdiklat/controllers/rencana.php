<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rencana extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdiklat/m_kursus');
		$this->load->model('appdiklat/m_usulan');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');

		$this->id_unor = $this->session->userdata('id_unor');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Rencana Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat prajabatan";
		$this->load->view('rencana/index',$data);
	}
	function diklat_penjenjangan(){
		$data['satu'] = "Rencana Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 2;
		$data['nama'] = "diklat penjenjangan";
		$this->load->view('rencana/index',$data);
	}
	function diklat_fungsional(){
		$data['satu'] = "Rencana Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 3;
		$data['nama'] = "diklat fungsional";
		$this->load->view('rencana/index',$data);
	}
	function diklat_teknis(){
		$data['satu'] = "Rencana Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 4;
		$data['nama'] = "diklat teknis";
		$this->load->view('rencana/index',$data);
	}
	function getdata(){
		$tahun = $_POST['tahun'];
		$rumpun = $_POST['rumpun'];
		$cari = $_POST['cari'];
		$sess = $this->session->userdata('logged_in');

		$data['count'] = $this->m_usulan->hitung_rencana($cari,$rumpun,$tahun);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_usulan->get_rencana($cari,$rumpun,$tahun,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->j_skpd = $this->m_usulan->hitung_pengusul($val->id_diklat,$val->tahun,"pengelola");
				$data['hslquery'][$key]->j_pegawai = $this->m_usulan->hitung_pengusul($val->id_diklat,$val->tahun,"pegawai");
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function rinci(){
		$idd = explode("*",$_POST['idd']);
		$data['nama'] = $idd[0];
		$data['idd'] = $idd[1];
		$data['id_rumpun'] = $idd[2];
		$data['tahun'] = $_POST['tahun'];
		$rumpun = Modules::run("appdiklat/kursus/rumpun_diklat");
		$data['rumpun'] = $rumpun[$data['id_rumpun']];
		$data['diklat'] = $this->m_kursus->ini_diklat($data['idd']);
		$data['pengusul'] = $this->m_usulan->get_pengusul($data['idd'],$data['tahun'],"pengelola");
		$data['calon'] =  $this->m_usulan->get_pengusul_calon($data['idd'],$data['tahun'],"pengelola");
		foreach($data['calon'] AS $key=>$val){
			$data['calon'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim(@$val->gelar_nonakademis) != '-')?trim(@$val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		}
		$this->load->view('rencana/rinci',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
	function aju(){
		$data['satu'] = "Pengajuan Usulan Diklat";
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat prajabatan";
/////////////// session dari auth
		$data['nama_unor'] = $this->session->userdata('nama_unor');
		$data['kode_unor'] = $this->session->userdata('kode_unor');
		$data['id_unor'] = $this->session->userdata('id_unor');
///////////////
		$this->load->view('rencana/aju',$data);
	}
	function aju_penjenjangan(){
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat penjenjangan";
		$this->load->view('rencana/aju_penjenjangan',$data);
	}
	function aju_fungsional(){
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat fungsional";
		$this->load->view('rencana/aju_fungsional',$data);
	}
	function aju_teknis(){
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat teknis";
		$this->load->view('rencana/aju_teknis',$data);
	}
	function getaju(){
		$data['hslquery'] = $this->m_usulan->get_aju($_POST['rumpun'],$_POST['tahun'],"pengelola",$this->id_unor);
		foreach($data['hslquery'] AS $key=>$val){
			$data['hslquery'][$key]->peserta = $this->m_usulan->hitung_calon($val->id_diklat_rencana);
		}
		echo json_encode($data);
	}
	function aju_tambah(){
		$rmp['prajabatan'] = 1;
		$rmp['penjenjangan'] = 2;
		$rmp['fungsional'] = 3;
		$rmp['teknis'] = 4;

		$nm['prajabatan'] = "diklat prajabatan";
		$nm['penjenjangan'] = "diklat penjenjangan";
		$nm['fungsional'] = "diklat fungsional";
		$nm['teknis'] = "diklat teknis";

		$data['nama'] = $nm[$_POST['nama']];
		$data['id_rumpun'] = $rmp[$_POST['nama']];
		$data['tahun'] = $_POST['tahun'];
		$data['pengusul'] = $_POST['pengusul'];
		$data['aksi'] = "tambah";
		$this->load->view('rencana/aju_form',$data);
	}
	function aju_tambah_aksi(){
		$this->m_usulan->aju_tambah($_POST,$this->id_unor);
		echo "sukses#";
	}
	function aju_hapus(){
		$rmp['prajabatan'] = 1;
		$rmp['penjenjangan'] = 2;
		$rmp['fungsional'] = 3;
		$rmp['teknis'] = 4;

		$nm['prajabatan'] = "diklat prajabatan";
		$nm['penjenjangan'] = "diklat penjenjangan";
		$nm['fungsional'] = "diklat fungsional";
		$nm['teknis'] = "diklat teknis";

		$data['nama'] = $nm[$_POST['nama']];
		$data['id_rumpun'] = $rmp[$_POST['nama']];
		$data['tahun'] = $_POST['tahun'];
		$data['pengusul'] = $_POST['pengusul'];
		$data['aksi'] = "hapus";
		$data['isi'] = $this->m_usulan->ini_aju($_POST['idd']);
		$this->load->view('rencana/aju_form',$data);
	}
	function aju_hapus_aksi(){
		$this->m_usulan->aju_hapus($_POST);
		echo "sukses#";
	}
	function aju_calon(){
		$data['isi'] = $this->m_usulan->ini_aju($_POST['idd']);
		$this->load->view('rencana/aju_calon',$data);
	}
	function getcalon(){
		$data['hslquery'] = $this->m_usulan->get_calon($_POST['idd']);
		foreach($data['hslquery'] AS $key=>$val){
			$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim(@$val->gelar_nonakademis) != '-')?trim(@$val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		}
		echo json_encode($data);
	}
	function calon_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$this->load->view('rencana/calon_hapus',$data);
	}
	function calon_hapus_aksi(){
		$this->m_usulan->hapus_calon($_POST);
		echo "sukses#";
	}
	function calon_tambah(){
		$data['idd'] = $_POST['idd'];

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$tGH = date('Y-m-d');
		
		$data['unor'] = $this->m_unor->gettree(0,5,$tGH); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();

		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";
		$data['ptugas'] = (isset($_POST['ptugas']))?$_POST['ptugas']:"";
		$data['pagama'] = (isset($_POST['pagama']))?$_POST['pagama']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";
		$data['pstatus'] = (isset($_POST['pstatus']))?$_POST['pstatus']:"";
		$data['pjenjang'] = (isset($_POST['pjenjang']))?$_POST['pjenjang']:"";
		$data['pumur'] = (isset($_POST['pumur']))?$_POST['pumur']:"";
		$data['pmkcpns'] = (isset($_POST['pmkcpns']))?$_POST['pmkcpns']:"";


		$this->load->view('rencana/calon_tambah',$data);
	}
	function calon_tambah_aksi(){
		$cek = $this->m_usulan->cek_calon($_POST['id_diklat_rencana'],$_POST['id_pegawai']);
		if(empty($cek)){
			$pegawai = Modules::run("appbkpp/profile/ini_pegawai",$_POST['id_pegawai']);
			$peg_pangkat = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$_POST['id_pegawai']);
			$pangkat = end($peg_pangkat);
			$peg_jabatan = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$_POST['id_pegawai']);
			$jabatan = end($peg_jabatan);
			$peg_pendidikan = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$_POST['id_pegawai']);
			$pendidikan = end($peg_pendidikan);
			$this->m_usulan->tambah_calon($_POST,$pegawai,$jabatan->id_peg_jab,$pangkat->id_peg_golongan,$pendidikan->id_peg_pendidikan);
		}
		echo "sukses#";
	}

}
?>