<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dafpeg extends MX_Controller {

	function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_dafpeg');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()  {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "index_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "index_mutasi";
		} elseif($group_name=="admin") {
			$rd = "index";
		} elseif($group_name=="pempeg" || $group_name=="pempeg2") {
			$rd = "index_pempeg";
		} elseif($group_name=="kepala_opd") {
			$rd = "index_kepala_opd";
		} else {
			$rd = "index_mutasi";
		}

		$data['satu'] = "Daftar Pegawai";
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
/*
		$data['unor'] = $this->m_unor->gettree(0,5,$data['tahun']."-".$data['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
*/
		$data['dua'] = $this->session->userdata('nama_unor');
//		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
//		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
//		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
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

		$data['tab'] = (isset($_POST['tab']))?$_POST['tab']:"aktif";
		
		$this->load->view('dafpeg/'.$rd,$data);
	}

	public function aktif_tkk()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['cari'] = "";
		$data['batas'] = 10;
		$data['hal'] = 'end';
		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";

		$this->load->view('dafpeg/aktif_tkk',$data);
	}
	public function aktif_thl()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['cari'] = "";
		$data['batas'] = 10;
		$data['hal'] = 'end';
		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";

		$this->load->view('dafpeg/aktif_thl',$data);
	}
	public function aktif()  {
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['unor'] = $this->m_unor->gettree(0,5,$data['tahun']."-".$data['bulan']."-01"); 
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

		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="admin") {
			$rd = "aktif";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} elseif($group_name=="pempeg2" || $group_name=="diklat") {
			$rd = "aktif_pempeg2";
		} else {
			$rd = "aktif_pempeg2";
		}

		$this->load->view('dafpeg/'.$rd,$data);
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function meninggal()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/meninggal',$data);
	}
	public function getmeninggal()  {
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];

		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$thbl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_pros("meninggal",$thbl,$cari,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$data['hslquery'] = $this->m_dafpeg->get_pegawai_pros("meninggal",$thbl,$cari,$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$row){
					@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_meninggal = date("d-m-Y", strtotime($row->tanggal_meninggal));
					@$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$row->kode_golongan];
					@$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$row->kode_golongan];
					@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function pensiun()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/pensiun',$data);
	}
	public function getpensiun()  {
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];

		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$thbl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_pros("pensiun",$thbl,$cari,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_pros("pensiun",$thbl,$cari,$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$row){
					@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_pensiun = date("d-m-Y", strtotime($row->tanggal_pensiun));
					@$data['hslquery'][$key]->tanggal_sk =  date("d-m-Y", strtotime($row->tanggal_sk));
					@$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$row->kode_golongan];
					@$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$row->kode_golongan];
					@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	public function cc_pensiun($idPeg)  {
		$cek	=	$this->m_dafpeg->ini_pegawai_aktif($idPeg);
		if(empty($cek)){	$this->m_dafpeg->pending_pensiun($idPeg);	}
	}



	public function keluar()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/keluar',$data);
	}
	public function getkeluar()  {
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];

		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$thbl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_pros("keluar",$thbl,$cari,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$data['hslquery'] = $this->m_dafpeg->get_pegawai_pros("keluar",$thbl,$cari,$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$row){
					@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_keluar = date("d-m-Y", strtotime($row->tanggal_keluar));
					@$data['hslquery'][$key]->tanggal_sk =  date("d-m-Y", strtotime($row->tanggal_sk));
					@$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$row->kode_golongan];
					@$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$row->kode_golongan];
					@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	public function masuk()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/masuk',$data);
	}
	public function getmasuk()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_masuk($tbhl,$_POST['cari']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_masuk($tbhl,$_POST['cari'],$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);

					$pangkat = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$val->id_pegawai);
					$pendidikan = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$val->id_pegawai);
					$cpns = Modules::run("appbkpp/profile/ini_pegawai_cpns",$val->id_pegawai);
					$pns = Modules::run("appbkpp/profile/ini_pegawai_cpns",$val->id_pegawai);
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////
	public function jabatan()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/jabatan',$data);
	}
	public function getdata_jabatan()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$tahun_sb = ($_POST['bulan']==1)?($_POST['tahun']-1):$_POST['tahun'];
		$bulan_sb = ($_POST['bulan']==1)?12:($_POST['bulan']-1);
		$jenismutasi=($_POST['jenis_mutasi']=="biasa")?"":$_POST['jenis_mutasi'];

		$data['count'] = $this->m_dafpeg->hitung_pegawai_jabatan($tahun,$bulan,$tahun_sb,$bulan_sb,$_POST['cari'],$_POST['kode'],$_POST['pkt'],$_POST['jbt'],$jenismutasi);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_jabatan($tahun,$bulan,$tahun_sb,$bulan_sb,$_POST['cari'],$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt'],$jenismutasi);
			foreach($data['hslquery'] AS $key=>$val){
				$sebelum = $this->m_dafpeg->get_jabatan_sebelum($val->tmt_jabatan,$val->id_pegawai);
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				@$data['hslquery'][$key]->nama_jabatan_awal = $sebelum->nama_jabatan;
				@$data['hslquery'][$key]->nama_unor_awal = $sebelum->nama_unor;
				@$data['hslquery'][$key]->nomenklatur_pada_awal = $sebelum->nomenklatur_pada;

				$dok_ref = $this->m_edok->cek_dokumen($val->nip_baru,"sk_jabatan",$val->id_peg_jab);
				$data['hslquery'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$val->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////
	public function pangkat()  {
		$data['unor'] = $this->m_unor->gettree(0,5,$_POST['tahun']."-".$_POST['bulan']."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/pangkat',$data);
	}
	public function getdata_pangkat()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_pangkat($tahun,$bulan,$_POST['cari'],$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_pangkat($tahun,$bulan,$_POST['cari'],$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$val){
				$sebelum = $this->m_dafpeg->get_pangkat_sebelum($val->tmt_golongan,$val->id_pegawai);
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tmt_golongan = date("d-m-Y", strtotime($val->tmt_golongan));
				@$data['hslquery'][$key]->nama_pangkat_awal = $sebelum->nama_golongan;
				@$data['hslquery'][$key]->nama_golongan_awal = $sebelum->nama_pangkat;

				$dok_ref = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pangkat",$val->id_peg_golongan);
				$data['hslquery'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$val->nip_baru."/sk_pangkat/thumb_".$dok_ref[0]->file_dokumen;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////
	public function prajab()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/prajab',$data);
	}
	public function diklat_penjenjangan()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/diklat_penjenjangan',$data);
	}
	public function diklat_fungsional()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/diklat_fungsional',$data);
	}
	public function diklat_teknis()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/diklat_teknis',$data);
	}
////////////////////////////////////////////////////////////////////////////
	public function getdata_diklat()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_diklat($tbhl,$_POST['rumpun'],$_POST['cari'],$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_diklat($tbhl,$_POST['rumpun'],$_POST['cari'],$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}

		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////
	public function menikah()  {
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('dafpeg/menikah',$data);
	}
	public function getdata_menikah()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$data['count'] = $this->m_dafpeg->hitung_pegawai_menikah($tahun,$bulan,$_POST['cari'],$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();

			$data['hslquery'] = $this->m_dafpeg->get_pegawai_menikah($tahun,$bulan,$_POST['cari'],$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tanggal_menikah = date("d-m-Y", strtotime($val->tanggal_menikah));
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////
	public function cerai()  {
		
		echo "<br>";

		$sql = "SELECT nip_baru FROM r_pegawai_pensiun WHERE tanggal_pensiun>'2016-04-01' ORDER BY nip_baru ASC";
		$hsl = $this->db->query($sql)->result();
		
		foreach($hsl AS $key=>$val){

			$sq = "SELECT COUNT(id_dokumen) AS jml FROM r_peg_dokumen WHERE nip_baru='".$val->nip_baru."'";
			$hs = $this->db->query($sq)->row();

			echo ($key+1).". ".$val->nip_baru." :: ".$hs->jml."<br>";
		}
		


	}

}
?>