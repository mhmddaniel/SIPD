<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pantau_target_umpeg extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appskp/m_skpd');
		$this->load->model('appskp/m_skp');
		$this->load->model('appskp/m_pantau');
		$this->load->model('appbkpp/m_unor');
	}	
/////////////////////////////////////////////////////////////////////////////
	function index(){
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['st_skp'] = $this->dropdowns->tahapan_skp();

		$data['satu'] = "Daftar Target Kerja Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";

		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['pstskp'] = (isset($_POST['pstskp']))?$_POST['pstskp']:"";
		$data['pnlskp'] = (isset($_POST['pnlskp']))?$_POST['pnlskp']:"";
		$this->load->view('pantau_target_umpeg/index',$data);
	}
	function ganti_tahun(){
		$unor = $this->m_unor->gettree(0,5,$_POST['tahun']."-01-10");
		$uu = "<option value='' selected>Semua...</option>";
		foreach($unor AS $key=>$val){
			$uu = $uu.'<option value="'.$val->kode_unor.'">'.$val->nama_unor.'</option>';															
		}
		echo $uu;
	}
	function getdata(){
			$kode=$_POST['kode'];
			$pkt=$_POST['pkt'];
			$jbt=$_POST['jbt'];
			$ese=$_POST['ese'];
			$unor="all";
			$pns="all";
			$tugas="";
			$gender="";
			$agama="";
			$status="";
			$jenjang="";
			$umur="all";
			$mkcpns="all";
			$jenis="pns";
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$tahun=$_POST['tahun'];
			$bulan = ($_POST['tahun']==date('Y'))?date('m'):12;

		$data['utmAct'] = ($tahun."-".$bulan==date('Y-n'))?"ya":"tidak";
		if($tahun=="2014" || $tahun=="2015"){
			$data['count'] = $this->m_pantau->hitung_pegawai_prim($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);
		} else {
			$data['count'] = $this->m_pantau->hitung_pegawai_bulanan($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);
		}

		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$_POST['bulan_print'] = $bulan;
		$_POST['tahun_print'] = $tahun;
		$this->session->set_userdata("id_cetak",$_POST);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			if($tahun=="2014" || $tahun=="2015"){
				$data['hslquery'] = $this->m_pantau->get_pegawai_prim($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);
			} else {
				$data['hslquery'] = $this->m_pantau->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);
			}

			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

//				$data['hslquery'][$key]->nomenklatur_jabatan = (@$val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				$data['hslquery'][$key]->aksi = "..";

				$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
//				$data['hslquery'][$key]->realisasi = $this->m_pantau->get_target_peg_tahun($val->id_pegawai,$tahun);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
}