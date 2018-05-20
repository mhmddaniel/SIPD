<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Alumni extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdiklat/m_alumni');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Alumni Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('alumni/index',$data);
	}
	function getalumni(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_alumni->hitungalumni($_POST['tahun'],$cari);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_alumni->getalumni($_POST['tahun'],$cari,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

				$prajabatan = $this->m_alumni->hitung_durasi($val->id_pegawai,$_POST['tahun'],1);
				$data['hslquery'][$key]->prajabatan_jam = ($prajabatan->kali==0)?" - ":$prajabatan->jjam." jp";
				$data['hslquery'][$key]->prajabatan_kali = ($prajabatan->kali==0)?" ":"(".$prajabatan->kali." kali)";

				$penjenjangan = $this->m_alumni->hitung_durasi($val->id_pegawai,$_POST['tahun'],2);
				$data['hslquery'][$key]->penjenjangan_jam = ($penjenjangan->kali==0)?" - ":$penjenjangan->jjam." jp";
				$data['hslquery'][$key]->penjenjangan_kali = ($penjenjangan->kali==0)?" ":"(".$penjenjangan->kali." kali)";

				$fungsional = $this->m_alumni->hitung_durasi($val->id_pegawai,$_POST['tahun'],3);
				$data['hslquery'][$key]->fungsional_jam = ($fungsional->kali==0)?" - ":$fungsional->jjam." jp";
				$data['hslquery'][$key]->fungsional_kali = ($fungsional->kali==0)?" ":"(".$fungsional->kali." kali)";

				$teknis = $this->m_alumni->hitung_durasi($val->id_pegawai,$_POST['tahun'],4);
				$data['hslquery'][$key]->teknis_jam = ($teknis->kali==0)?" - ":$teknis->jjam." jp";
				$data['hslquery'][$key]->teknis_kali = ($teknis->kali==0)?" ":"(".$teknis->kali." kali)";
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function prajabatan(){
		$data['satu'] = "Alumni Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$this->load->view('alumni/prajabatan',$data);
	}
	function penjenjangan(){
		$data['satu'] = "Alumni Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['rumpun'] = $this->dropdowns->rumpun_diklat_struk();
		$this->load->view('alumni/penjenjangan',$data);
	}
	function kursus(){
		$data['satu'] = "Alumni Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$this->load->view('alumni/kursus',$data);
	}
	function getdata(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_alumni->hitung_alumni($cari,$_POST['rumpun']);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_alumni->get_alumni($cari,$mulai,$batas,$_POST['rumpun']);
			foreach($data['hslquery'] AS $key=>$val){
				$tipe = ($_POST['rumpun']==5)?"sertifikat_prajab":"sertifikat_diklat";
				$cek = $this->m_alumni->dokumen($tipe,$val->id_peg_diklat_struk);
				$data['hslquery'][$key]->dokumen = (empty($cek))?"kosong":"ada";
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function getkursus(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_alumni->hitung_alumni_kursus($cari);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_alumni->get_alumni_kursus($cari,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$cek = $this->m_alumni->dokumen("sertifikat_kursus",$val->id_peg_kursus);
				$data['hslquery'][$key]->dokumen = (empty($cek))?"kosong":"ada";
			}


			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function rincian_pegawai(){
		$data['tahun'] = $_POST['tahun'];
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai",$_POST['id_pegawai']);
		$data['diklat'] = $this->m_alumni->diklat_ikut($_POST['id_pegawai'],$_POST['tahun']);
		$rumpun = Modules::run("appdiklat/kursus/rumpun_diklat");
		foreach($data['diklat'] AS $key=>$val){
			$data['diklat'][$key]->nama_rumpun = $rumpun[$val->id_rumpun];
		}

		$this->load->view('alumni/rincian_pegawai',$data);
	}


}
?>