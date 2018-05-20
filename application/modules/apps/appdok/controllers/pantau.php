<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pantau extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appdok/m_pantau');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Pemantauan Dokumen Elektronik";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl);
		$data['awal'] = (isset($_POST['awal']))?$_POST['awal']:"pasfoto";
		$data['stt'] = (isset($_POST['stt']))?$_POST['stt']:"sudah";
		
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola"){
			$data['load']="_umpeg";}else{$data['load']="";
		}

		$this->load->view('pantau/index',$data);
	}

	function isi(){
		$tipe = $_POST['tipe'];
		$cari = $_POST['cari'];
		$phal = $_POST['hal'];
		$kode = $_POST['kode'];
		$status = $_POST['status'];

		$hitung = ($status=="sudah")?$this->m_pantau->hitung_pantau_dok(1,$tipe,$cari,$kode,$phal):$this->m_pantau->hitung_pantau_dok(0,$tipe,$cari,$kode,$phal);
		$data['count'] = count($hitung);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($phal=="end")?ceil($data['count']/$batas):$phal;
			$mulai=($hal-1)*$batas;
			$data['batas']=$batas;
			$data['cari']=$cari;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = ($status=="sudah")?$this->m_pantau->pantau_dok(1,$tipe,$cari,$kode,$mulai,$batas):$this->m_pantau->pantau_dok(0,$tipe,$cari,$kode,$mulai,$batas);

			$this->session->set_userdata('cari',$cari);
			$this->session->set_userdata('hal',$phal);
			$this->session->set_userdata('batas',$batas);
			$this->session->set_userdata('kode',$kode);

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}


	function isi_umpeg(){
		$tipe = $_POST['tipe'];
		$cari = $_POST['cari'];
		$phal = $_POST['hal'];
		$kode = $_POST['kode'];
		$status = $_POST['status'];

		$sess = $this->session->userdata('logged_in');
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$akses=  str_replace($dd,"",$user->unor_akses);

		$hitung = ($status=="sudah")?$this->m_pantau->hitung_pantau_dok_umpeg(1,$tipe,$cari,$akses,$phal):$this->m_pantau->hitung_pantau_dok_umpeg(0,$tipe,$cari,$akses,$phal);
		$data['count'] = count($hitung);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($phal=="end")?ceil($data['count']/$batas):$phal;
			$mulai=($hal-1)*$batas;
			$data['batas']=$batas;
			$data['cari']=$cari;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = ($status=="sudah")?$this->m_pantau->pantau_dok_umpeg(1,$tipe,$cari,$akses,$mulai,$batas):$this->m_pantau->pantau_dok_umpeg(0,$tipe,$cari,$akses,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$sudah = $this->m_pantau->cek_dokumen($tipe,$val->nip_baru);
				@$data['hslquery'][$key]->sudah = (!empty($sudah))?$sudah->id_dokumen:"tidak";
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}

	function kontrol($nip_baru){
		$hsl = $this->m_pantau->ini_kontrol($nip_baru);
		return $hsl;
	}

	function intip(){
		$data['tipe'] = $_POST['tipe'];
		$data['status'] = $_POST['status'];
		$data['nip_baru'] = $_POST['nip_baru'];
		
		$this->load->view('pantau/intip',$data);
	}



}
?>