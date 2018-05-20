<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_dashboard_sikda extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_dashboard_sikda');
	}

  public function index()  {
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');

		$query = $this->m_dashboard_sikda->get_panel(1,$data['bulan'],$data['tahun']);
		$data['jabatan'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(2,$data['bulan'],$data['tahun']);
		$data['pendidikan'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(3,$data['bulan'],$data['tahun']);
		$data['golongan'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(4,$data['bulan'],$data['tahun']);
		$data['umur'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(5,$data['bulan'],$data['tahun']);
		$data['mkcpns'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(6,$data['bulan'],$data['tahun']);
		$data['unor'] =json_decode(@$query->meta_value);

		$query = $this->m_dashboard_sikda->get_panel(7,$data['bulan'],$data['tahun']);
		$data['bup'] =json_decode(@$query->meta_value);

		$this->load->view('index',$data);
  }

  public function daftar_pegawai()  {
		$data['unor'] = $this->m_dashboard_sikda->gettree(0,5,"2015-01-01"); 
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

		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('aktif',$data);
  }
	function getaktif(){
			$unor="all";
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

			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];

			$data['count'] = $this->m_dashboard_sikda->hitung_pegawai_bulanan($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun);
		if($tahun."-".$bulan==date('Y-m')){
//			$data['count'] = $this->m_dashboard_sikda->hitung_pegawai($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns);
			$data['utmAct'] = "ya";
		} else {
			$data['utmAct'] = "tidak";
		}

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
				$data['hslquery'] = $this->m_dashboard_sikda->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
				}
			$data['pager'] = Modules::run("web/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////////////
	function bup(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$data['gender'] = (isset($_POST['pgender']))?$_POST['pgender']:$_POST['jgender'];
		$data['type'] = (isset($_POST['pjbt']))?$_POST['pjbt']:$_POST['jtype'];
		$data['tahun'] = (isset($_POST['pumur']))?$_POST['pumur']:$_POST['jtahun'];

		$this->load->view('bup',$data);
	}
	function getbup(){
		$data['hal'] = $_POST['hal'];
		$data['cari'] = $_POST['cari'];
		$data['tahun'] = $_POST['tahun'];
		$data['type'] = $_POST['type'];
		$data['gender'] = $_POST['gender'];
		
		$data['count'] = $this->hitung_prediksi_pensiun($data['tahun'],$data['type'],$data['gender'],$data['cari']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->prediksi_pensiun($mulai,$batas,$data['tahun'],$data['type'],$data['gender'],$data['cari']);

			$data['pager'] = Modules::run("web/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}
	function hitung_prediksi_pensiun($tahun,$jt,$gg,$cari){
		$iJT = ($jt=="guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$iGD = ($gg=="l")?"AND gender='l'":(($gg=="p")?"AND gender='p'":"");
		$tt = $tahun;
		$sqlstr="SELECT COUNT(id_pegawai) AS numrows
		FROM r_pegawai_aktual WHERE 
		IF(kode_ese='22',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		$iGD $iJT
		ORDER BY jab_type ASC,tanggal_lahir ASC";
		$query = $this->db->query($sqlstr)->row();
		return $query->numrows;
	}
	function prediksi_pensiun($mulai,$batas,$tahun,$jt,$gg,$cari){
		$iJT = ($jt=="guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$iGD = ($gg=="l")?"AND gender='l'":(($gg=="p")?"AND gender='p'":"");
		$tt = $tahun;
		$sqlstr="SELECT *
		FROM r_pegawai_aktual WHERE 
		IF(kode_ese='22',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		$iGD $iJT
		ORDER BY jab_type ASC,tanggal_lahir ASC
		LIMIT $mulai,$batas";
		$query = $this->db->query($sqlstr)->result();
		return $query;
	}
}