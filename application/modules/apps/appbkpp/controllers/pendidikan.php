<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pendidikan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pendidikan');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Daftar Pendidikan Formal";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('pendidikan/index',$data);
	}
	function getdata(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_pendidikan->hitung_pendidikan($cari,$_POST['jenjang']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_pendidikan->get_pendidikan($cari,$mulai,$batas,$_POST['jenjang']);
			$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function picker(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('pendidikan/picker_pendidikan',$data);
	}

	function konsol(){
		$data['satu'] = "Pendidikan";
		$data['konsol'] = array();
/*
		$data['konsol'] = $this->m_pendidikan->get_konsol();
		foreach($data['konsol'] AS $key=>$val){
			$akhir=$this->m_pendidikan->cek_akhir($val->id_pegawai);
			@$data['konsol'][$key]->id_pendidikan=$akhir->id_pendidikan;
			if(!empty($akhir) && $akhir->id_pendidikan!='0'){	$this->m_pendidikan->aksi_konsol($val->id_pegawai,$akhir->id_pendidikan);	}
		}
*/
		$this->load->view('pendidikan/konsol',$data);
	}
	


}
?>