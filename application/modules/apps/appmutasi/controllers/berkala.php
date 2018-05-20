<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Berkala extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appmutasi/m_berkala');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Daftar Ajuan Berkala";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";
		$data['jenis'] = $this->dropdowns->status_kepegawaian();

		$tGH = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tGH); 
		$data['kode'] = "";
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['pjenjang'] = "";
		$data['pgender'] = "";

		$this->load->view('berkala/index',$data);
	}
	function getdata(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_pegawai->hitung_master_pegawai($_POST['jenis'],$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_pegawai->get_master_pegawai($_POST['jenis'],$cari,$mulai,$batas);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

					if($_POST['jenis']=="pns"){
							$cpns = Modules::run('appbkpp/profile/ini_pegawai_cpns',$val->id_pegawai);
							$pns = Modules::run('appbkpp/profile/ini_pegawai_pns',$val->id_pegawai);
							$jab = Modules::run('appbkpp/profile/ini_pegawai_jabatan',$val->id_pegawai);
							$pkt = Modules::run('appbkpp/profile/ini_pegawai_pangkat',$val->id_pegawai);
							$arsip = $this->m_pegawai->ini_arsip($val->id_pegawai);
							$aktif =  Modules::run('appbkpp/profile/ini_pegawai',$val->id_pegawai);
							$meninggal = $this->m_pegawai->ini_pegawai_meninggal($val->id_pegawai);
							$pensiun = $this->m_pegawai->ini_pegawai_pensiun($val->id_pegawai);
							$keluar = $this->m_pegawai->ini_pegawai_keluar($val->id_pegawai);
							$data['hslquery'][$key]->hapus = (empty($cpns) && empty($pns) && empty($jab)  && empty($pkt))? "ya":"tidak";
							
							@$data['hslquery'][$key]->status = (!empty($aktif)?"Aktif":(!empty($meninggal)?"Meninggal":(!empty($pensiun)?"Pensiun":(!empty($keluar)?"Keluar":"Non-aktif"))));
							@$data['hslquery'][$key]->kd_arsip = $arsip->kd_arsip;
							@$data['hslquery'][$key]->lemari = $arsip->lemari;
							@$data['hslquery'][$key]->pintu = $arsip->pintu;
							@$data['hslquery'][$key]->rak = $arsip->rak;
		
							@$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($cpns->tmt_cpns));
							@$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($pns->tmt_pns));
					}

					if($_POST['jenis']=="tkk" || $_POST['jenis']=="thl"){
							$amt = Modules::run('appbkpp/profile/ini_pegawai_alamat',$val->id_pegawai);
							$pend = Modules::run('appbkpp/profile/ini_pegawai_pendidikan',$val->id_pegawai);
							$jab = Modules::run('appbkpp/profile/ini_pegawai_jabatan',$val->id_pegawai);
		
							$pendidikan = end(@$pend);
							$data['hslquery'][$key]->nama_jenjang = (isset($pendidikan->nama_jenjang))?$pendidikan->nama_jenjang:"-";
							$data['hslquery'][$key]->nama_sekolah = (isset($pendidikan->nama_sekolah))?$pendidikan->nama_sekolah:"-";
							$data['hslquery'][$key]->tanggal_lulus = (isset($pendidikan->tanggal_lulus))?date("d-m-Y", strtotime($pendidikan->tanggal_lulus)):"-";
		
							$jabatan = end(@$jab);
							$data['hslquery'][$key]->nama_jabatan = (isset($jabatan->nama_jabatan))?$jabatan->nama_jabatan:"-";
							$data['hslquery'][$key]->nomenklatur_pada = (isset($jabatan->nomenklatur_pada))?$jabatan->nomenklatur_pada:"-";
							$data['hslquery'][$key]->sk_nomor = (isset($jabatan->sk_nomor))?$jabatan->sk_nomor:"-";
							$data['hslquery'][$key]->sk_tanggal = (isset($jabatan->sk_tanggal))?date("d-m-Y", strtotime($jabatan->sk_tanggal)):"-";
							$data['hslquery'][$key]->sk_pejabat = (isset($jabatan->sk_pejabat))?$jabatan->sk_pejabat:"-";
							if(empty($amt) && empty($pend) && empty($jab)){	$data['hslquery'][$key]->hapus="ya";	}	else	{	$data['hslquery'][$key]->hapus="tidak";	}
					}


				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////////////
	function naik(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "aktif_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="absensor_unit") {
			$rd = "aktif_absensor_unit";
		} elseif($group_name=="mutasi") {
			$rd = "aktif_berkala";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} elseif($group_name=="pempeg2") {
			$rd = "aktif_pempeg2";
		} elseif($group_name=="sekretariat_bkpp") {
			$rd = "aktif_pempeg2";
		} elseif($group_name=="upt_assesment") {
			$rd = "aktif_upt_ass";
		} elseif($group_name=="kepala_opd") {
			$rd = "aktif_kepala_opd";
		} else {
			$rd = "aktif";
		}

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$tGH = date('Y-m-d');
		
//		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 
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

		$data['satu'] = "Daftar Berkala Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";
		$data['pdwBulan'] = (isset($_POST['pdwBulan']))?$_POST['pdwBulan']:"";
		$data['ptugas'] = (isset($_POST['ptugas']))?$_POST['ptugas']:"";
		$data['pagama'] = (isset($_POST['pagama']))?$_POST['pagama']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";
		$data['pstatus'] = (isset($_POST['pstatus']))?$_POST['pstatus']:"";
		$data['pjenjang'] = (isset($_POST['pjenjang']))?$_POST['pjenjang']:"";
		$data['pumur'] = (isset($_POST['pumur']))?$_POST['pumur']:"";
		$data['pmkcpns'] = (isset($_POST['pmkcpns']))?$_POST['pmkcpns']:"";
		$this->load->view('berkala/'.$rd,$data);
	}

	function edit(){//,$oleh_pejabat=false,$gaji_lama=false,$gaji_baru=false,$tmt_gaji=false){


		$id_pegawai = $_GET['id_pegawai'];

		$mk_gol_tahun =$_GET['mk_gol_tahun'];
		$mk_gol_bulan =$_GET['mk_gol_bulan'];

		$isi['id_pegawai'] =$_GET['id_pegawai'];
		$result = $this->m_berkala->hitung_gaji_baru($id_pegawai,$mk_gol_tahun,$mk_gol_bulan);
		


		$isi['kode_golongan'] =$result['kode_golongan'];
		$isi['no_sk'] =$result['no_sk'];
		$isi['tanggal_sk'] =$result['tanggal_sk'];
		$isi['mk_gol_tahun'] =$result['mk_gol_tahun'];
		$isi['mk_gol_bulan'] =$result['mk_gol_bulan'];
		$isi['oleh_pejabat'] =$result['oleh_pejabat'];
		$isi['gaji_lama'] =$result['gaji_lama'];
		$isi['gaji_baru'] =$result['gaji_baru'];
		$isi['tmt_gaji'] =$result['tmt_gaji'];

		$data['isi'] = (object) $isi;
		$data['id_pegawai'] = $_GET['id_pegawai'];

		$this->load->view('berkala/form',$data);
	}




function lihat(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "aktif_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="absensor_unit") {
			$rd = "aktif_absensor_unit";
		} elseif($group_name=="mutasi") {
			$rd = "aktif_berkala";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} elseif($group_name=="pempeg2") {
			$rd = "aktif_pempeg2";
		} elseif($group_name=="sekretariat_bkpp") {
			$rd = "aktif_pempeg2";
		} elseif($group_name=="upt_assesment") {
			$rd = "aktif_upt_ass";
		} elseif($group_name=="kepala_opd") {
			$rd = "aktif_kepala_opd";
		} else {
			$rd = "aktif";
		}

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$tGH = date('Y-m-d');
		
//		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 
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

		$data['satu'] = "Daftar Berkala Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";
		$data['pdwBulan'] = (isset($_POST['pdwBulan']))?$_POST['pdwBulan']:"";
		$data['ptugas'] = (isset($_POST['ptugas']))?$_POST['ptugas']:"";
		$data['pagama'] = (isset($_POST['pagama']))?$_POST['pagama']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";
		$data['pstatus'] = (isset($_POST['pstatus']))?$_POST['pstatus']:"";
		$data['pjenjang'] = (isset($_POST['pjenjang']))?$_POST['pjenjang']:"";
		$data['pumur'] = (isset($_POST['pumur']))?$_POST['pumur']:"";
		$data['pmkcpns'] = (isset($_POST['pmkcpns']))?$_POST['pmkcpns']:"";
		$this->load->view('berkala/'.$rd,$data);
	}

	function getaktif(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola" || $group_name=="absensor_unit"){
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
			$dwBulan=$_POST['dwBulan'];
			$tugas=$_POST['tugas'];
			$gender=$_POST['gender'];
			$agama=$_POST['agama'];
			$status=$_POST['status'];
			$jenjang=$_POST['jenjang'];
			$umur=$_POST['umur'];
			$mkcpns=$_POST['mkcpns'];
			$jenis=(isset($_POST['jenis']))?$_POST['jenis']:"pns";
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

//			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$bulan = $_POST['bulan'];
			$tahun=$_POST['tahun'];

		$data['utmAct'] = ($tahun."-".$bulan==date('Y-n'))?"ya":"tidak";
		$data['count'] = $this->m_berkala->hitung_pegawai_bulanan($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$dwBulan,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);

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


			$data['hslquery'] = $this->m_berkala->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$dwBulan,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');


					if($jenis=="pns"){
							$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime(@$val->tmt_cpns));
							$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime(@$val->tmt_pns));
							$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
							$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
							$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
							$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
							$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];

							$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
					}


					if($jenis=="tkk" || $jenis=="thl"){
							$amt = Modules::run('appbkpp/profile/ini_pegawai_alamat',$val->id_pegawai);
							$pend = Modules::run('appbkpp/profile/ini_pegawai_pendidikan',$val->id_pegawai);
							$jab = Modules::run('appbkpp/profile/ini_pegawai_jabatan',$val->id_pegawai);
		
							$pendidikan = end(@$pend);
							$data['hslquery'][$key]->nama_jenjang = (isset($pendidikan->nama_jenjang))?$pendidikan->nama_jenjang:"-";
							$data['hslquery'][$key]->nama_sekolah = (isset($pendidikan->nama_sekolah))?$pendidikan->nama_sekolah:"-";
							$data['hslquery'][$key]->tanggal_lulus = (isset($pendidikan->tanggal_lulus))?date("d-m-Y", strtotime($pendidikan->tanggal_lulus)):"-";
		
							$jabatan = end(@$jab);
							$data['hslquery'][$key]->nama_jabatan = (isset($jabatan->nama_jabatan))?$jabatan->nama_jabatan:"-";
							$data['hslquery'][$key]->nomenklatur_pada = (isset($jabatan->nomenklatur_pada))?$jabatan->nomenklatur_pada:"-";
							$data['hslquery'][$key]->sk_nomor = (isset($jabatan->sk_nomor))?$jabatan->sk_nomor:"-";
							$data['hslquery'][$key]->sk_tanggal = (isset($jabatan->sk_tanggal))?date("d-m-Y", strtotime($jabatan->sk_tanggal)):"-";
							$data['hslquery'][$key]->sk_pejabat = (isset($jabatan->sk_pejabat))?$jabatan->sk_pejabat:"-";
							if(empty($amt) && empty($pend) && empty($jab)){	$data['hslquery'][$key]->hapus="ya";	}	else	{	$data['hslquery'][$key]->hapus="tidak";	}
					}


				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function duk(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola" || $group_name=="absensor_unit" || $group_name=="kepala_opd"){
			$rd = "duk_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="diklat") {
			$rd = "duk_diklat";
		} else {
			$rd = "duk";
		}
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";
		$this->load->view('pegawai/'.$rd,$data);
	}
	function getduk(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola" || $group_name=="absensor_unit"){
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

		$data['count'] = $this->m_pegawai->hitung_pegawai_duk($_POST['cari'],$_POST['pns'],$unor);
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
			$data['hslquery'] = $this->m_pegawai->get_pegawai_duk($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
	function formuserskp(){
		$data['pegawai'] = Modules::run('appbkpp/profile/ini_pegawai',$_POST['idd']);
		$this->load->view('pegawai/formuserskp',$data);
	}

	function formuserskp_aksi(){
		$this->m_pegawai->userskp_setup_aksi($_POST);
		echo "success";
	}
///////////////////////////////////////////////////////////////////////////////////
	function getjfu(){
		$cari = $_POST['cari'];
		$jenis = $_POST['jenis'];
		$data['count'] = $this->m_pegawai->hitung_jfu($cari,$jenis);

		if($data['count']==0){
			$data['pesan']="<b>Tidak ada data...</b>";
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
				$batas=$_POST['batas'];
				$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
				$mulai=($hal-1)*$batas;
				$data['mulai']=$mulai+1;
				$data['hslquery'] = $this->m_pegawai->get_jfu($cari,$jenis,$mulai,$batas);
				$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
				$data['pesan']="";
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

		$this->load->view('pegawai/bup',$data);
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
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
				$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
				$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
				$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}
	function hitung_prediksi_pensiun($tahun,$jt,$gg,$cari){
		$iJT = ($jt=="guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$iGD = ($gg=="l")?"AND gender='l'":(($gg=="p")?"AND gender='p'":"");
		$tt = $tahun;
		$sqlstr="SELECT COUNT(id_pegawai) AS numrows
		FROM rekap_peg WHERE 
		IF(kode_ese='22' OR jab_type='jft-guru' OR nomenklatur_jabatan LIKE 'PENGAWAS SEKOLAH%',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		$iGD $iJT";
		$query = $this->db->query($sqlstr)->row();
		return $query->numrows;
	}
	function prediksi_pensiun($mulai,$batas,$tahun,$jt,$gg,$cari){
		$iJT = ($jt=="guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$iGD = ($gg=="l")?"AND gender='l'":(($gg=="p")?"AND gender='p'":"");
		$tt = $tahun;
		$sqlstr="SELECT *
		FROM rekap_peg WHERE 
		IF(kode_ese='22' OR jab_type='jft-guru' OR nomenklatur_jabatan LIKE 'PENGAWAS SEKOLAH%',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		$iGD $iJT
		ORDER BY nip_baru ASC,jab_type ASC
		LIMIT $mulai,$batas";
		$query = $this->db->query($sqlstr)->result();
		return $query;
	}
///////////////////////////////////////////////////////////////////////////////////
	function meninggal(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";

		$this->load->view('pegawai/meninggal',$data);
	}

	function getsub(){
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];
		$sub = $_POST['sub'];
		$data['count'] = $this->m_pegawai->hitung_pegawai_pros($cari,$sub);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_pegawai->get_pegawai_pros($cari,$mulai,$batas,$sub);
			foreach($hslquery AS $key=>$row){
					$val = json_decode($row->var_r_pegawai_rekap);
					@$data['hslquery'][$key] = $val;
					@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					@$data['hslquery'][$key]->tempat_meninggal = $row->tempat_meninggal;
					@$data['hslquery'][$key]->tanggal_meninggal = date("d-m-Y", strtotime($row->tanggal_meninggal));
					@$data['hslquery'][$key]->sebab_meninggal = $row->sebab_meninggal;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function formsub_meninggal_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}

	function formsub_meninggal_tambah_aksi(){
		if($_POST['sub']=="meninggal"){
			$peg = Modules::run('appbkpp/profile/ini_pegawai_r_pegawai_rekap',$_POST['id_pegawai']);
			$peg = json_encode($peg);
			$this->m_pegawai->pros_meninggal_tambah_aksi($_POST,$peg);
		}
		echo "success";
	}



	function formsub_meninggal_edit(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_meninggal($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_meninggal = date("d-m-Y", strtotime($peg->tanggal_meninggal));
		$data['val']->tempat_meninggal = $peg->tempat_meninggal;
		$data['val']->sebab_meninggal = $peg->sebab_meninggal;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}

	function formsub_meninggal_edit_aksi(){
		$this->m_pegawai->pros_meninggal_edit_aksi($_POST);
		echo "success";
	}

	function formsub_meninggal_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_meninggal($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_meninggal = date("d-m-Y", strtotime($peg->tanggal_meninggal));
		$data['val']->tempat_meninggal = $peg->tempat_meninggal;
		$data['val']->sebab_meninggal = $peg->sebab_meninggal;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_hapus',$data);
	}

	function formsub_meninggal_hapus_aksi(){
		$peg = $this->m_pegawai->ini_pegawai_meninggal($_POST['id_pegawai']);
		$val = json_decode($peg->var_r_pegawai_rekap);

		$this->m_pegawai->pros_meninggal_hapus_aksi($val);
		echo "success";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
	function formsub(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['form'] = $_POST['id_pegawai'];
		$this->load->view('pegawai/formsub_'.$data['form'],$data);
	}

	function getsub_cltn(){
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];
		$sub = $_POST['sub'];
		$data['count'] = $this->m_pegawai->hitung_pegawai_pros($cari,$sub);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_pegawai->get_pegawai_pros($cari,$mulai,$batas,$sub);
			foreach($hslquery AS $key=>$row){
					$val = json_decode($row->var_r_pegawai_rekap);
					@$data['hslquery'][$key] = $val;
					@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_keluar = date("d-m-Y", strtotime($row->tanggal_keluar));
					@$data['hslquery'][$key]->no_sk = $row->no_sk;
					@$data['hslquery'][$key]->tanggal_sk =  date("d-m-Y", strtotime($row->tanggal_sk));
					@$data['hslquery'][$key]->instansi_tujuan = $row->instansi_tujuan;
			}
			$data['pager'] = Modules::run("appskp/appskp/pagerB",$data['count'],$batas,$hal,$kehal);
		}
		echo json_encode($data);
	}
	function formsub_cltn_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}
	function formsub_cltn_tambah_aksi(){
			$peg = $this->m_pegawai->ini_pegawai($_POST['id_pegawai']);
			$peg = json_encode($peg);
			$this->m_pegawai->pros_cltn_tambah_aksi($_POST,$peg);
		echo "success";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
	function keluar(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";
		$this->load->view('pegawai/keluar',$data);
	}

	function getsub_keluar(){
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];
		$sub = $_POST['sub'];
		$data['count'] = $this->m_pegawai->hitung_pegawai_pros($cari,$sub);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_pegawai->get_pegawai_pros($cari,$mulai,$batas,$sub);
			foreach($hslquery AS $key=>$row){
					$val = json_decode($row->var_r_pegawai_rekap);
					@$data['hslquery'][$key] = $val;
					@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_keluar = date("d-m-Y", strtotime($row->tanggal_keluar));
					@$data['hslquery'][$key]->no_sk = $row->no_sk;
					@$data['hslquery'][$key]->tanggal_sk =  date("d-m-Y", strtotime($row->tanggal_sk));
					@$data['hslquery'][$key]->instansi_tujuan = $row->instansi_tujuan;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function formsub_keluar_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}
	function formsub_keluar_tambah_aksi(){
			$peg = Modules::run('appbkpp/profile/ini_pegawai_r_pegawai_rekap',$_POST['id_pegawai']);
			$peg = json_encode($peg);
			$this->m_pegawai->pros_keluar_tambah_aksi($_POST,$peg);
		echo "success";
	}
	function formsub_keluar_edit(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_keluar($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_keluar = date("d-m-Y", strtotime($peg->tanggal_keluar));
		$data['val']->no_sk = $peg->no_sk;
		$data['val']->tanggal_sk = date("d-m-Y", strtotime($peg->tanggal_sk));
		$data['val']->instansi_tujuan = $peg->instansi_tujuan;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}

	function formsub_keluar_edit_aksi(){
		$this->m_pegawai->pros_keluar_edit_aksi($_POST);
		echo "success";
	}
	function formsub_keluar_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_keluar($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_keluar = date("d-m-Y", strtotime($peg->tanggal_keluar));
		$data['val']->no_sk = $peg->no_sk;
		$data['val']->tanggal_sk = date("d-m-Y", strtotime($peg->tanggal_sk));
		$data['val']->instansi_tujuan = $peg->instansi_tujuan;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_hapus',$data);
	}

	function formsub_keluar_hapus_aksi(){
		$peg = $this->m_pegawai->ini_pegawai_keluar($_POST['id_pegawai']);
		$val = json_decode($peg->var_r_pegawai_rekap);

		$this->m_pegawai->pros_keluar_hapus_aksi($val);
		echo "success";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
	function pensiun(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";
		$this->load->view('pegawai/pensiun',$data);
	}
	function getsub_pensiun(){
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];
		$sub = $_POST['sub'];
		$data['count'] = $this->m_pegawai->hitung_pegawai_pros($cari,$sub);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_pegawai->get_pegawai_pros($cari,$mulai,$batas,$sub);
			foreach($hslquery AS $key=>$row){
					$val = json_decode($row->var_r_pegawai_rekap);
					@$data['hslquery'][$key] = $val;
					@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_pensiun = date("d-m-Y", strtotime($row->tanggal_pensiun));
					@$data['hslquery'][$key]->no_sk = $row->no_sk;
					@$data['hslquery'][$key]->tanggal_sk =  date("d-m-Y", strtotime($row->tanggal_sk));
					@$data['hslquery'][$key]->jenis_pensiun = $row->jenis_pensiun;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function formsub_pensiun_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}
	function formsub_pensiun_tambah_aksi(){
			$peg = Modules::run('appbkpp/profile/ini_pegawai_r_pegawai_rekap',$_POST['id_pegawai']);
			$peg = json_encode($peg);
			$this->m_pegawai->pros_pensiun_tambah_aksi($_POST,$peg);
		echo "success";
	}
	function formsub_pensiun_edit(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_pensiun($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_pensiun = date("d-m-Y", strtotime($peg->tanggal_pensiun));
		$data['val']->no_sk = $peg->no_sk;
		$data['val']->tanggal_sk = date("d-m-Y", strtotime($peg->tanggal_sk));
		$data['val']->jenis_pensiun = $peg->jenis_pensiun;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}

	function formsub_pensiun_edit_aksi(){
		$this->m_pegawai->pros_pensiun_edit_aksi($_POST);
		echo "success";
	}
	function formsub_pensiun_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$peg = $this->m_pegawai->ini_pegawai_pensiun($data['idd']);
		$val = json_decode($peg->var_r_pegawai_rekap);
		$data['val'] = $val;
		$data['val']->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$data['val']->tanggal_pensiun = date("d-m-Y", strtotime($peg->tanggal_pensiun));
		$data['val']->no_sk = $peg->no_sk;
		$data['val']->tanggal_sk = date("d-m-Y", strtotime($peg->tanggal_sk));
		$data['val']->jenis_pensiun = $peg->jenis_pensiun;
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_hapus',$data);
	}

	function formsub_pensiun_hapus_aksi(){
		$peg = $this->m_pegawai->ini_pegawai_pensiun($_POST['id_pegawai']);
		$val = json_decode($peg->var_r_pegawai_rekap);

		$this->m_pegawai->pros_pensiun_hapus_aksi($val);
		echo "success";
	}
//////////////////////////////////////////////////////////////////
	function tambah_master(){
		$this->load->view('pegawai/form_tambah_master');
	}
	function hapus_master(){
		$data['val'] = Modules::run('appbkpp/profile/ini_pegawai_master',$_POST['idd']);
		$data['id_pegawai'] = $_POST['idd'];
		$this->load->view('pegawai/form_hapus_master',$data);
	}
	function formarsip(){
		$data['id_pegawai'] = $_POST['idd'];
		$data['val'] = Modules::run('appbkpp/profile/ini_pegawai_master',$_POST['idd']);
		$data['isi'] = $this->m_pegawai->ini_arsip($data['id_pegawai']);
		$this->load->view('pegawai/form_arsip',$data);
	}
	function arsip_aksi(){
		if($_POST['id_arsip']==""){
			$this->m_pegawai->input_arsip($_POST);
		} else {
			$this->m_pegawai->edit_arsip($_POST);
		}
		echo "sukses";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         PROSES REKON PEGAWAI MASTER
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function formsub_pensiun(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$data['peg'] = Modules::run('appbkpp/profil/ini_pegawai_master',$data['idd']);
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update_non',$data);
	}
	function formsub_pensiun_aksi(){
			$master = $this->m_pegawai->ini_pegawai_master($_POST['id_pegawai']);
			$pkt = $this->m_pegawai->ini_pegawai_pangkat($_POST['id_pegawai']);
			$jab = $this->m_pegawai->ini_pegawai_jabatan($_POST['id_pegawai']);
			$pend = $this->m_pegawai->ini_pegawai_pendidikan($_POST['id_pegawai']);
			$cpns = $this->m_pegawai->ini_cpns($_POST['id_pegawai']);
			$pns = $this->m_pegawai->ini_pns($_POST['id_pegawai']);
			
			$peg = array();
			$pkt = end($pkt);
			$pend = end($pend);
			$jab = end($jab);
			
			$peg['id_pegawai'] = $master->id_pegawai;
			$peg['nip_baru'] = $master->nip_baru;
			$peg['nama_pegawai'] = $master->nama_pegawai;
			$peg['tempat_lahir'] = $master->tempat_lahir;
			$peg['tanggal_lahir'] = $master->tanggal_lahir;
			$peg['gelar_depan'] = $master->gelar_depan;
			$peg['gelar_belakang'] = $master->gelar_belakang;
			$peg['gelar_nonakademis'] = $master->gelar_nonakademis;
			$peg['gender'] = $master->gender;
			$peg['agama'] = $master->agama;
			$peg['status_perkawinan'] = $master->status_perkawinan;

			$peg['nama_pangkat'] = @$pkt->nama_pangkat;
			$peg['nama_golongan'] = @$pkt->nama_golongan;
			$peg['kode_golongan'] = @$pkt->kode_golongan;
			$peg['mk_gol_tahun'] = @$pkt->mk_gol_tahun;
			$peg['mk_gol_bulan'] = @$pkt->mk_gol_bulan;
			$peg['tmt_pangkat'] = @$pkt->tmt_golongan;

			$peg['tmt_cpns'] = @$cpns->tmt_cpns;
			$peg['tmt_pns'] = @$pns->tmt_pns;

			$peg['id_unor'] = @$jab->id_unor;
			$peg['kode_unor'] = @$jab->kode_unor;
			$peg['nama_unor'] = @$jab->nama_unor;
			$peg['nomenklatur_jabatan'] = @$jab->nama_jabatan;
			$peg['nomenklatur_pada'] = @$jab->nomenklatur_pada;
			$peg['kode_ese'] = @$jab->kode_ese;
			$peg['nama_ese'] = @$jab->nama_ese;
			$peg['tmt_jabatan'] = @$jab->tmt_jabatan;
			$peg['jab_type'] = @$jab->nama_jenis_jabatan;

			$peg['id_pendidikan'] = @$pend->id_pendidikan;
			$peg['nama_pendidikan'] = @$pend->nama_pendidikan;
			$peg['nama_jenjang'] = @$pend->nama_jenjang;
			$peg['nama_sekolah'] = @$pend->nama_sekolah;
			$peg['tanggal_lulus'] = @$pend->tanggal_lulus;
			$peg['tahun_lulus'] = @$pend->tahun_lulus;

			$peg = json_encode($peg);
			$peg = str_replace("null","\"\"",$peg);
			$this->m_pegawai->pros_pensiun_tambah_aksi($_POST,$peg);
			
			echo $peg;
	}

	function formsub_meninggal(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$data['peg'] = $this->m_pegawai->ini_pegawai_master($data['idd']);
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update_non',$data);
	}

	function formsub_meninggal_aksi(){
			$master = $this->m_pegawai->ini_pegawai_master($_POST['id_pegawai']);
			$pkt = $this->m_pegawai->ini_pegawai_pangkat($_POST['id_pegawai']);
			$jab = $this->m_pegawai->ini_pegawai_jabatan($_POST['id_pegawai']);
			$pend = $this->m_pegawai->ini_pegawai_pendidikan($_POST['id_pegawai']);
			$cpns = $this->m_pegawai->ini_cpns($_POST['id_pegawai']);
			$pns = $this->m_pegawai->ini_pns($_POST['id_pegawai']);
			
			$peg = array();
			$pkt = end($pkt);
			$pend = end($pend);
			$jab = end($jab);
			
			$peg['id_pegawai'] = $master->id_pegawai;
			$peg['nip_baru'] = $master->nip_baru;
			$peg['nama_pegawai'] = $master->nama_pegawai;
			$peg['tempat_lahir'] = $master->tempat_lahir;
			$peg['tanggal_lahir'] = $master->tanggal_lahir;
			$peg['gelar_depan'] = $master->gelar_depan;
			$peg['gelar_belakang'] = $master->gelar_belakang;
			$peg['gelar_nonakademis'] = $master->gelar_nonakademis;
			$peg['gender'] = $master->gender;
			$peg['agama'] = $master->agama;
			$peg['status_perkawinan'] = $master->status_perkawinan;

			$peg['nama_pangkat'] = @$pkt->nama_pangkat;
			$peg['nama_golongan'] = @$pkt->nama_golongan;
			$peg['kode_golongan'] = @$pkt->kode_golongan;
			$peg['mk_gol_tahun'] = @$pkt->mk_gol_tahun;
			$peg['mk_gol_bulan'] = @$pkt->mk_gol_bulan;
			$peg['tmt_pangkat'] = @$pkt->tmt_golongan;

			$peg['tmt_cpns'] = @$cpns->tmt_cpns;
			$peg['tmt_pns'] = @$pns->tmt_pns;

			$peg['id_unor'] = @$jab->id_unor;
			$peg['kode_unor'] = @$jab->kode_unor;
			$peg['nama_unor'] = @$jab->nama_unor;
			$peg['nomenklatur_jabatan'] = @$jab->nama_jabatan;
			$peg['nomenklatur_pada'] = @$jab->nomenklatur_pada;
			$peg['kode_ese'] = @$jab->kode_ese;
			$peg['nama_ese'] = @$jab->nama_ese;
			$peg['tmt_jabatan'] = @$jab->tmt_jabatan;
			$peg['jab_type'] = @$jab->nama_jenis_jabatan;

			$peg['id_pendidikan'] = @$pend->id_pendidikan;
			$peg['nama_pendidikan'] = @$pend->nama_pendidikan;
			$peg['nama_jenjang'] = @$pend->nama_jenjang;
			$peg['nama_sekolah'] = @$pend->nama_sekolah;
			$peg['tanggal_lulus'] = @$pend->tanggal_lulus;
			$peg['tahun_lulus'] = @$pend->tahun_lulus;

			$peg = json_encode($peg);
			$peg = str_replace("null","\"\"",$peg);
			$this->m_pegawai->pros_meninggal_tambah_aksi($_POST,$peg);
		
			echo $peg;
	}

	function formsub_keluar(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
//		$data['peg'] = $this->m_pegawai->ini_pegawai_master($data['idd']);
//		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update_non',$data);
	}

	function formsub_keluar_aksi(){
			$master = Modules::run('appbkpp/profile/ini_pegawai_master',$_POST['id_pegawai']);	
			$pkt = Modules::run('appbkpp/profile/ini_pegawai_pangkat',$_POST['id_pegawai']);	
			$jab = Modules::run('appbkpp/profile/ini_pegawai_jabatan',$_POST['id_pegawai']);	
			$pend = Modules::run('appbkpp/profile/ini_pegawai_pendidikan',$_POST['id_pegawai']); 
			$cpns = Modules::run('appbkpp/profile/ini_cpns',$_POST['id_pegawai']); 
			$pns = Modules::run('appbkpp/profile/ini_pns',$_POST['id_pegawai']); 
			
			
			$peg = array();
			$pkt = end($pkt);
			$pend = end($pend);
			$jab = end($jab);
			
			$peg['id_pegawai'] = $master->id_pegawai;
			$peg['nip_baru'] = $master->nip_baru;
			$peg['nama_pegawai'] = $master->nama_pegawai;
			$peg['tempat_lahir'] = $master->tempat_lahir;
			$peg['tanggal_lahir'] = $master->tanggal_lahir;
			$peg['gelar_depan'] = $master->gelar_depan;
			$peg['gelar_belakang'] = $master->gelar_belakang;
			$peg['gelar_nonakademis'] = $master->gelar_nonakademis;
			$peg['gender'] = $master->gender;
			$peg['agama'] = $master->agama;
			$peg['status_perkawinan'] = $master->status_perkawinan;

			$peg['nama_pangkat'] = @$pkt->nama_pangkat;
			$peg['nama_golongan'] = @$pkt->nama_golongan;
			$peg['kode_golongan'] = @$pkt->kode_golongan;
			$peg['mk_gol_tahun'] = @$pkt->mk_gol_tahun;
			$peg['mk_gol_bulan'] = @$pkt->mk_gol_bulan;
			$peg['tmt_pangkat'] = @$pkt->tmt_golongan;

			$peg['tmt_cpns'] = @$cpns->tmt_cpns;
			$peg['tmt_pns'] = @$pns->tmt_pns;

			$peg['id_unor'] = @$jab->id_unor;
			$peg['kode_unor'] = @$jab->kode_unor;
			$peg['nama_unor'] = @$jab->nama_unor;
			$peg['nomenklatur_jabatan'] = @$jab->nama_jabatan;
			$peg['nomenklatur_pada'] = @$jab->nomenklatur_pada;
			$peg['kode_ese'] = @$jab->kode_ese;
			$peg['nama_ese'] = @$jab->nama_ese;
			$peg['tmt_jabatan'] = @$jab->tmt_jabatan;
			$peg['jab_type'] = @$jab->nama_jenis_jabatan;

			$peg['id_pendidikan'] = @$pend->id_pendidikan;
			$peg['nama_pendidikan'] = @$pend->nama_pendidikan;
			$peg['nama_jenjang'] = @$pend->nama_jenjang;
			$peg['nama_sekolah'] = @$pend->nama_sekolah;
			$peg['tanggal_lulus'] = @$pend->tanggal_lulus;
			$peg['tahun_lulus'] = @$pend->tahun_lulus;

			$peg = json_encode($peg);
			$peg = str_replace("null","\"\"",$peg);
//			$this->m_pegawai->pros_keluar_aksi($_POST,$peg);
			echo $peg;
	}

	function formsub_lihat(){
		$id_pegawai = $_POST['idd'];
		$data['id_unor'] = $_POST['nomor'];

		$this->session->set_userdata("pegawai_info",$id_pegawai);
		$data['data'] = $this->m_pegawai->ini_pegawai_master($id_pegawai);
/*		
		$foto = $this->m_pegawai->ini_pegawai_foto($id_pegawai);
		$data['fotoSrc']=site_url()."assets/file/".$foto->foto;

		$jabatan = end($this->m_pegawai->ini_pegawai_jabatan($id_pegawai));
		$data['data']->tmt_jabatan=$jabatan->tmt_jabatan;

		$data['cpns']=$this->m_pegawai->ini_cpns($id_pegawai);
		$data['pns']=$this->m_pegawai->ini_pns($id_pegawai);

		$pangkat = end($this->m_pegawai->ini_pegawai_pangkat($id_pegawai));
		$data['data']->tmt_pangkat=$pangkat->tmt_golongan;
		$data['data']->nama_pangkat=$pangkat->nama_pangkat;
		$data['data']->nama_golongan=$pangkat->nama_golongan;
*/
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update_non',$data);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         PROSES INJEK K2
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////CEK USER GRUP 7 (pegawai) YANG TIDAK ADA DI USER_PEGAWAI///////////////
	function injek_k2(){
		$this->db->from('users');
		$this->db->where('group_id',7);
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
				$this->db->from('user_pegawai');
				$this->db->where('user_id',$vl->user_id);
				$hl = $this->db->get()->row();
				
				if(empty($hl)){
						$this->db->from('rekap_peg');
						$this->db->where('nip_baru',$vl->username);
						$sl = $this->db->get()->row();
					echo $no." - ".$vl->nama_user." - ".$vl->username." - ".$sl->id_pegawai."<br/>";
					$no++;
				}
		}
	}

//////INJEK USER UNTUK K2///////////////
	function injek_k2_MB(){
		$this->db->from('rekap_peg');
		$this->db->order_by('nama_pegawai');
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
				$this->db->from('user_pegawai');
				$this->db->where('id_pegawai',$vl->id_pegawai);
				$hl = $this->db->get()->row();
				if(empty($hl)){

							$this->db->set('group_id',7);
							$this->db->set('username',$vl->nip_baru);
					        $this->db->set('nama_user',$vl->nama_pegawai);
							$this->db->set('passwd',sha1($vl->nip_baru));
							$this->db->insert('users');
							$user_id = $this->db->insert_id();

							$this->db->set('user_id',$user_id);
							$this->db->set('id_pegawai',$vl->id_pegawai);
							$this->db->insert('user_pegawai');
				
					echo $no." - ".$vl->nip_baru." - ".$vl->id_pegawai." - ".$vl->nama_pegawai." - ".@$hl->kode_unor."<br/>";
					$no++;
				}
		}
	}

//////CEK UNTUK KEKUATAN PEGAWAI///////////////
	function injek_k2_XC(){
		$this->db->from('rekap_peg');
		$this->db->order_by('nama_pegawai');
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
			if($vl->kode_unor==""){

				$this->db->from('r_peg_jab');
				$this->db->where('id_pegawai',$vl->id_pegawai);
				$hl = $this->db->get()->row();
				if(!empty($hl)){
//							$this->db->set('kode_unor',$hl->kode_unor);
//							$this->db->where('id_pegawai',$vl->id_pegawai);
//							$this->db->update('rekap_peg');
					echo $no." - ".$vl->nip_baru." - ".$vl->id_pegawai." - ".$vl->nama_pegawai." - ".@$hl->kode_unor."<br/>";
					$no++;
				}
			}
		}
	}
//////perbaikan kode golongan= 0 padahal ada di r_peg_golongan///////////////
	function injek_k2_PKT(){
		$this->db->from('rekap_peg');
		$this->db->where('kode_golongan',0);
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
			$this->db->from('r_peg_golongan');
			$this->db->order_by('tmt_golongan','asc');
			$this->db->where('id_pegawai',$vl->id_pegawai);
			$hl = $this->db->get()->result();

			if(!empty($hl)){
				$gol = end($hl);
				$ada = $gol->tmt_golongan;
							$this->db->set('tmt_pangkat',$gol->tmt_golongan);
							$this->db->set('nama_pangkat',$gol->nama_pangkat);
							$this->db->set('nama_golongan',$gol->nama_golongan);
							$this->db->set('kode_golongan',$gol->kode_golongan);
							$this->db->set('mk_gol_tahun',$gol->mk_gol_tahun);
							$this->db->set('mk_gol_bulan',$gol->mk_gol_bulan);
							$this->db->where('id_pegawai',$vl->id_pegawai);
							$this->db->update('rekap_peg');
				
			} else {	$ada="";	}
			echo $no." - ".$vl->nama_pegawai.$ada."<br/>";
			$no++;
		}
	}



//////perbaikan nama golongan yang kebalik sama nama pangkat///////////////
	function injek_k2_rekon_pangkat(){
		$pkt = $this->dropdowns->kode_golongan_pangkat();

		$this->db->from('rekap_peg');
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
			if($vl->kode_golongan!=0){
				$pkt_X=explode(",",$pkt[$vl->kode_golongan]);
				$nm_pangkat = trim($pkt_X[1]);
				$nm_golongan = trim($pkt_X[0]);
					if($nm_pangkat!=$vl->nama_pangkat){
							$this->db->set('nama_golongan',$nm_golongan);
							$this->db->set('nama_pangkat',$nm_pangkat);
							$this->db->where('id_pegawai',$vl->id_pegawai);
							$this->db->update('rekap_peg');
						echo $no." - ".$vl->id_pegawai."<br/>";
						$no++;
					}
			}
		}

		$this->db->from('r_peg_golongan');
		$hsl = $this->db->get()->result();
		$no=1;
		foreach($hsl as $ky=>$vl){
			if($vl->kode_golongan!=0){
				$pkt_X=explode(",",$pkt[$vl->kode_golongan]);
				$nm_pangkat = trim($pkt_X[1]);
				$nm_golongan = trim($pkt_X[0]);
					if($nm_pangkat!=$vl->nama_pangkat){
							$this->db->set('nama_golongan',$nm_golongan);
							$this->db->set('nama_pangkat',$nm_pangkat);
							$this->db->where('id_peg_golongan',$vl->id_peg_golongan);
							$this->db->update('r_peg_golongan');
						echo $no." - ".$vl->nama_pegawai."<br/>";
						$no++;
					}
			}
		}


	}

	function injek_k2_ASLI(){
		$sqlstr="SELECT * FROM (k2_gregs)";
		$query = $this->db->query($sqlstr)->result(); 
		
		$idd = 42501;
		foreach($query AS $key=>$val){
			$sqr="SELECT * FROM r_pegawai WHERE nip_baru='".$val->nip_baru."'";
			$qr = $this->db->query($sqr)->row();
			$ada = (empty($qr))?"kosong":"ada";

			$sqr2="SELECT * FROM m_pendidikan WHERE nama_pendidikan='".$val->nama_pendidikan."'";
			$qr2= $this->db->query($sqr2)->row();
			$pend = (empty($qr2))?"kosong":$qr2->nama_pendidikan;


			echo $val->nip_baru."/".$val->nama_pegawai."/".$val->tempat_lahir."/".date("Y-m-d", strtotime($val->tanggal_lahir))."/".$ada."/".date("Y-m-d", strtotime($val->tmt_pangkat))."/".$pend."<br/>";

			if($ada=="kosong"){
				$idp['id_pegawai'] = $idd;
				$idp['nip_baru'] = $val->nip_baru;
				$idp['nama_pegawai'] = $val->nama_pegawai;
				$idp['tempat_lahir'] = $val->tempat_lahir;
				$idp['tanggal_lahir'] = date("Y-m-d", strtotime($val->tanggal_lahir));
				$idp['agama'] = $val->agama;
				$idp['gender'] = $val->gender;
				$idp['status_perkawinan'] = $val->status_perkawinan;
				$idp['tmt_pangkat'] = date("Y-m-d", strtotime($val->tmt_pangkat));
				$idp['nama_pangkat'] = $val->nama_pangkat;
				$idp['nama_golongan'] = $val->nama_golongan;
				$idp['kode_golongan'] = $val->kode_golongan;
				$this->m_pegawai->pros_injek_k2($idp);
				$idd++;
			} //endif
		} //end foreach
	}

}
?>