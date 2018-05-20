<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pegawai extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function aktif_umpeg(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="evjab_umpeg"){
			$rd = "aktif_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} else {
			$rd = "aktif";
		}

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
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
		$this->load->view('pegawai/'.$rd,$data);
	}
	function getaktif(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="evjab_umpeg"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
		} elseif($group_name=="kepala_opd") {
			$kode_unor = $this->session->userdata('kode_unor');
			$sqlstr = "SELECT * FROM m_unor WHERE kode_unor LIKE '$kode_unor%'";
			$query = $this->db->query($sqlstr)->result();
			$unor="";
			foreach($query AS $key=>$val){
				$unor = ($key==0)?$unor.$val->id_unor:$unor.",".$val->id_unor;
			}
		} else {
			$unor="all";
		}
			$kode=$_POST['kode'];
			$pkt=$_POST['pkt'];
			$jbt=$_POST['jbt'];
			$ese=$_POST['ese'];
			$tugas=$_POST['tugas'];
			$gender=$_POST['gender'];
			$agama=$_POST['agama'];
			$status=$_POST['status'];
			$jenjang=$_POST['jenjang'];
			$umur=$_POST['umur'];
			$mkcpns=$_POST['mkcpns'];
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];

		$data['utmAct'] = ($tahun."-".$bulan==date('Y-m'))?"ya":"tidak";
		$data['count'] = $this->m_pegawai->hitung_pegawai_bulanan($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,'pns');


		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;


			$data['hslquery'] = $this->m_pegawai->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,'pns');

			$this->sett_sesi($_POST['cari'],$hal,$batas,$_POST['pns'],$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime(@$val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime(@$val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
					$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
					$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function sett_sesi($cari,$hal,$batas,$pns,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama){
		$this->session->set_userdata('cari',$cari);
		$this->session->set_userdata('hal',$hal);
		$this->session->set_userdata('batas',$batas);
		$this->session->set_userdata('pns',$pns);
		$this->session->set_userdata('kode',$kode);
		$this->session->set_userdata('pkt',$pkt);
		$this->session->set_userdata('jbt',$jbt);
		$this->session->set_userdata('ese',$ese);
		$this->session->set_userdata('tugas',$tugas);
		$this->session->set_userdata('gender',$gender);
		$this->session->set_userdata('agama',$agama);
	}
///////////////////////////////////////////////////////////////////////////////////
	function alih(){
	echo "saya";
	}


}
?>