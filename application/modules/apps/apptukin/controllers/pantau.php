<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pantau extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('apptukin/m_pantau');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_profil');
		$this->load->model('appbkpp/m_dashboard');
		date_default_timezone_set('Asia/Jakarta');
	}
////////////////////////////////////////////////////////////	
	function dashboard_rencana(){
		$this->load->model('widget_dashboard_sikda/m_dashboard_sikda');

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');

		$query = $this->m_dashboard_sikda->get_panel(10,$data['bulan'],$data['tahun']);
		$data['unor'] =json_decode(@$query->meta_value);
		$query = $this->m_dashboard_sikda->get_panel(11,$data['bulan'],$data['tahun']);
		$jbt =json_decode(@$query->meta_value);
		$data['ess2'] = @$jbt->ess2;
		$data['ess3'] = @$jbt->ess3;
		$data['ess4'] = @$jbt->ess4;
		$data['jfu'] = @$jbt->jfu;
		$data['jft'] = @$jbt->jft;
		$query = $this->m_dashboard_sikda->get_panel(12,$data['bulan'],$data['tahun']);
		$data['unorB'] =json_decode(@$query->meta_value);
		$query = $this->m_dashboard_sikda->get_panel(13,$data['bulan'],$data['tahun']);
		$jbt =json_decode(@$query->meta_value);
		$data['ess2B'] = @$jbt->ess2;
		$data['ess3B'] = @$jbt->ess3;
		$data['ess4B'] = @$jbt->ess4;
		$data['jftB'] = @$jbt->jft;
		$data['jfuB'] = @$jbt->jfu;

		$this->load->view('pantau/dash_rencana',$data);
	}
	function rencana(){
		$sess = $this->session->userdata('logged_in');
		$data['grup'] = $sess['group_name'];

		$data['dwBulan'] = $this->dropdowns->bulan();
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['st_rencana'] = $this->dropdowns->tahapan_tpp();
		$data['n_rencana'] = $this->dropdowns->tpp_kegiatan();
		$data['n_biaya'] = $this->dropdowns->tpp_biaya();

		$data['satu'] = "Daftar Rencana Kerja Pegawai";
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
		$data['pstrencana'] = (isset($_POST['pstrencana']))?$_POST['pstrencana']:"";
		$data['pnrencana'] = (isset($_POST['pnrencana']))?$_POST['pnrencana']:"";
		$data['pnbiaya'] = (isset($_POST['pnbiaya']))?$_POST['pnbiaya']:"";
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('pantau/rencana',$data);
	}

	function rencana_umpeg(){
		$data['dwBulan'] = $this->dropdowns->bulan();
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['st_rencana'] = $this->dropdowns->tahapan_tpp();
		$data['n_rencana'] = $this->dropdowns->tpp_kegiatan();
		$data['n_biaya'] = $this->dropdowns->tpp_biaya();

		$data['satu'] = "Daftar Rencana Kerja Pegawai";
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
		$data['pstrencana'] = (isset($_POST['pstrencana']))?$_POST['pstrencana']:"";
		$data['pnrencana'] = (isset($_POST['pnrencana']))?$_POST['pnrencana']:"";
		$data['pnbiaya'] = (isset($_POST['pnbiaya']))?$_POST['pnbiaya']:"";
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('pantau/rencana_umpeg',$data);
	}

	function getrencana(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
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
			$st_rencana=$_POST['st_rencana'];
			$n_rencana=$_POST['n_rencana'];
			$n_biaya=$_POST['n_biaya'];
			$blnn = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];

		$cct = $this->m_pantau->hitung_rencana($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$blnn,$tahun,$st_rencana,$n_rencana,$n_biaya);
		$data['count'] = count($cct);
		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);
		$this->session->set_userdata("tahun",$tahun);

		$pangkat = $this->dropdowns->kode_pangkat();
		$golongan = $this->dropdowns->kode_golongan();
		$bulan = $this->dropdowns->bulan();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$tahapan_tpp = $this->dropdowns->tahapan_tpp();


		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpagingA' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_pantau->get_rencana($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$blnn,$tahun,$st_rencana,$n_rencana,$n_biaya);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];

				@$data['hslquery'][$key]->aksi = ($val->id_tpp==NULL)?"":"<div class='btn btn-default btn-xs' onclick=\"ppost(".@$val->id_tpp.",'module/apptukin/pantau/rencana_arsip')\"><i class='fa fa-binoculars fa-fw'></i></div>";
				@$data['hslquery'][$key]->biaya = number_format(@$val->biaya,2,"."," ");
				@$data['hslquery'][$key]->bulan_mulai = $bulan[@$val->bulan_mulai];
				@$data['hslquery'][$key]->bulan_selesai = $bulan[@$val->bulan_selesai];

				@$data['hslquery'][$key]->penilai_nama_pegawai = ($val->id_tpp==NULL)?"-":((trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'').((trim($val->penilai_gelar_nonakademis) != '-')?trim($val->penilai_gelar_nonakademis).' ':'').$val->penilai_nama_pegawai.((trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'');

			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	function rencana_arsip(){
		$data['satu'] = "Daftar Rencana Kerja Pegawai";
		$data['cari'] = $_POST['cari'];
		$data['batas'] = $_POST['batas'];
		$data['hal'] = $_POST['hal'];
		$data['kode'] = $_POST['kode'];
		$data['pns'] = $_POST['pns'];
		$data['pkt'] = $_POST['pkt'];
		$data['jbt'] = $_POST['jbt'];
		$data['ese'] = $_POST['ese'];
		$data['tugas'] = $_POST['tugas'];
		$data['gender'] = $_POST['gender'];
		$data['agama'] = $_POST['agama'];
		$data['status'] = $_POST['status'];
		$data['jenjang'] = $_POST['jenjang'];
		$data['umur'] = $_POST['umur'];
		$data['mkcpns'] = $_POST['mkcpns'];
		$data['tahun'] = $_POST['tahun'];
		$data['asal'] = $_POST['asal'];

		$data['id_tpp'] = $_POST['idd'];
		$this->session->set_userdata('id_tpp',$_POST['idd']);
		$this->session->set_userdata("bulan_pilih","total");
		$this->load->view('pantau/rencana_arsip',$data);
	}
	function arsip(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['tpp'] = $this->m_tukin->get_tpp($id_pegawai);
				$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$this->load->view('pantau/arsip',$data);
	}	
	function alih_tpp(){
		$this->session->set_userdata("id_tpp",$_POST['idd']);
		$this->session->set_userdata("bulan_pilih","total");
		echo "success";
	}
	function rencana_aktif(){
		$id_tpp= $this->session->userdata('id_tpp');

		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$this->session->set_userdata("pegawai_info",$data['tpp']->id_pegawai);
		$data['bulan_pilih'] = $this->session->userdata('bulan_pilih');
		$data['target'] = $this->m_tukin->get_target($id_tpp);
		$data['catatan'] = $this->m_tukin->get_catatan($id_tpp);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
		$data['bulan'] = $this->dropdowns->bulan();
		$data['bulan2'] = $this->dropdowns->bulan2();
		$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$unr = $this->m_tukin->get_m_unor($data['tpp']->id_unor);
		$kode = substr($unr->kode_unor,0,5);
		$unor = $this->m_tukin->getunor($kode,date("Y-m-d"));
		$nama_unor = (!empty($unor))?$unor->nama_unor:"xxxxx";
		$this->session->set_userdata("unor",$nama_unor);
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola" || $group_name=="kepala_opd"){
			$this->load->view('pantau/rencana_aktif_umpeg',$data);
		} else {
			$this->load->view('pantau/rencana_aktif',$data);
		}
	}

	function form_tpp_hapus(){
		$data['tpp'] = $this->m_tukin->ini_tpp($_POST['idd']);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['target'] = $this->m_tukin->get_target($_POST['idd']);
		$this->load->view('pantau/form_tpp_hapus',$data);
	}
	function hapus_tpp()	{
		$this->m_pantau->hapus_tpp($_POST);
	}
	function tambahtarget(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$tpp = $this->m_tukin->ini_tpp($data['id_tpp']);
		for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
			$data['bulan_pil'][] = $i;
		}

		$data['no'] = $_POST['no'];
		$data['id_target'] = ($_POST['idd']=="xx")?"":$_POST['idd'];
		$data['avail'] = ($tpp->status=="draft" or $tpp->status=="revisi_penilai" or $tpp->status=="revisi_verifikatur")?"yes":"no";

		$this->load->view('pantau/form_target',$data);
	}
	function edittarget(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$tpp = $this->m_tukin->ini_tpp($data['id_tpp']);
		for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
			$data['bulan_pil'][] = $i;
		}
		$data['isi'] = $this->m_tukin->ini_target($_POST['idd']);
			$data['isi']->biaya_1 = number_format($data['isi']->biaya_1,2,"."," ");
			$data['isi']->biaya_2 = number_format($data['isi']->biaya_2,2,"."," ");
			$data['isi']->biaya_3 = number_format($data['isi']->biaya_3,2,"."," ");
			$data['isi']->biaya_4 = number_format($data['isi']->biaya_4,2,"."," ");
			$data['isi']->biaya_5 = number_format($data['isi']->biaya_5,2,"."," ");
			$data['isi']->biaya_6 = number_format($data['isi']->biaya_6,2,"."," ");
			$data['isi']->biaya_7 = number_format($data['isi']->biaya_7,2,"."," ");
			$data['isi']->biaya_8 = number_format($data['isi']->biaya_8,2,"."," ");
			$data['isi']->biaya_9 = number_format($data['isi']->biaya_9,2,"."," ");
			$data['isi']->biaya_10 = number_format($data['isi']->biaya_10,2,"."," ");
			$data['isi']->biaya_11 = number_format($data['isi']->biaya_11,2,"."," ");
			$data['isi']->biaya_12 = number_format($data['isi']->biaya_12,2,"."," ");
		$data['no'] = $_POST['no'];
		$data['id_target'] = ($_POST['idd']=="xx")?"":$_POST['idd'];
		$data['avail'] = ($tpp->status=="draft" or $tpp->status=="revisi_penilai" or $tpp->status=="revisi_verifikatur")?"yes":"no";

		$this->load->view('pantau/form_target',$data);
	}
	function hapustarget(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$tpp = $this->m_tukin->ini_tpp($data['id_tpp']);
		for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
			$data['bulan_pil'][] = $i;
		}
		$data['isi'] = $this->m_tukin->ini_target($_POST['idd']);
			$data['isi']->biaya_1 = number_format($data['isi']->biaya_1,2,"."," ");
			$data['isi']->biaya_2 = number_format($data['isi']->biaya_2,2,"."," ");
			$data['isi']->biaya_3 = number_format($data['isi']->biaya_3,2,"."," ");
			$data['isi']->biaya_4 = number_format($data['isi']->biaya_4,2,"."," ");
			$data['isi']->biaya_5 = number_format($data['isi']->biaya_5,2,"."," ");
			$data['isi']->biaya_6 = number_format($data['isi']->biaya_6,2,"."," ");
			$data['isi']->biaya_7 = number_format($data['isi']->biaya_7,2,"."," ");
			$data['isi']->biaya_8 = number_format($data['isi']->biaya_8,2,"."," ");
			$data['isi']->biaya_9 = number_format($data['isi']->biaya_9,2,"."," ");
			$data['isi']->biaya_10 = number_format($data['isi']->biaya_10,2,"."," ");
			$data['isi']->biaya_11 = number_format($data['isi']->biaya_11,2,"."," ");
			$data['isi']->biaya_12 = number_format($data['isi']->biaya_12,2,"."," ");
		$data['nomor'] = $_POST['no'];
		$data['id_target'] = ($_POST['idd']=="xx")?"":$_POST['idd'];
		$data['avail'] = ($tpp->status=="draft" or $tpp->status=="revisi_penilai" or $tpp->status=="revisi_verifikatur")?"yes":"no";

		$this->load->view('pantau/form_target',$data);
	}
	function edit_target_aksi(){
 		$this->form_validation->set_rules("pekerjaan","Pekerjaan","trim|required|xss_clean");
 		$_POST['biaya_1'] = str_replace(" ","",trim($_POST['biaya_1']));
 		$_POST['biaya_2'] = str_replace(" ","",trim($_POST['biaya_2']));
 		$_POST['biaya_3'] = str_replace(" ","",trim($_POST['biaya_3']));
 		$_POST['biaya_4'] = str_replace(" ","",trim($_POST['biaya_4']));
 		$_POST['biaya_5'] = str_replace(" ","",trim($_POST['biaya_5']));
 		$_POST['biaya_6'] = str_replace(" ","",trim($_POST['biaya_6']));
 		$_POST['biaya_7'] = str_replace(" ","",trim($_POST['biaya_7']));
 		$_POST['biaya_8'] = str_replace(" ","",trim($_POST['biaya_8']));
 		$_POST['biaya_9'] = str_replace(" ","",trim($_POST['biaya_9']));
 		$_POST['biaya_10'] = str_replace(" ","",trim($_POST['biaya_10']));
 		$_POST['biaya_11'] = str_replace(" ","",trim($_POST['biaya_11']));
 		$_POST['biaya_12'] = str_replace(" ","",trim($_POST['biaya_12']));
				
		if($this->form_validation->run()) {
			if($_POST['id_target']==""){
				$id_target = $this->m_tukin->tambah_aksi($_POST);
				$data = $this->m_tukin->ini_target($id_target);
				$data->aksi="tambah";
			} else { 
				$ddir=$this->m_tukin->edit_aksi($_POST);
				$data = $this->m_tukin->ini_target($_POST['id_target']);
				$data->aksi="edit";
			}
			redirect("module/apptukin/rencana/aktif");
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function hapus_target_aksi(){
		$this->m_tukin->hapus_aksi($_POST);
		redirect("module/apptukin/rencana/aktif");
	}
/////////////////////////////////////////////////////////////////////////////////////////////
	function form_pangkat_penilai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pejabat Penilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "penilai";
		$this->load->view('pantau/riwayat_pangkat',$data);
	}
	function form_jabatan_penilai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pejabat Penilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['jabatan'] = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
		$data['peg'] = "penilai";
		$this->load->view('pantau/riwayat_jabatan',$data);
	}
	function form_pangkat_pegawai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pegawai Yang Dinilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "pegawai";
		$this->load->view('pantau/riwayat_pangkat',$data);
	}
	function form_jabatan_pegawai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pegawai Yang Dinilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['jabatan'] = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
		$data['peg'] = "pegawai";
		$this->load->view('pantau/riwayat_jabatan',$data);
	}
	function edit_pangkat(){
		$idd = $_POST['idd'];
		$peg = $_POST['peg'];
		$id_tpp = $this->session->userdata('id_tpp');
		$this->session->set_userdata("idtpp",$id_tpp);
		$ini_pangkat = $this->m_profil->ini_pangkat_riwayat($idd);
		if($peg=="pegawai"){
			$this->m_tukin->set_tpp_pegawai_pangkat($id_tpp,$ini_pangkat->nama_golongan,$ini_pangkat->nama_pangkat);
		} else {
			$this->m_tukin->set_tpp_penilai_pangkat($id_tpp,$ini_pangkat->nama_golongan,$ini_pangkat->nama_pangkat);
		}
	}
	function edit_jabatan(){
		$idd = $_POST['idd'];
		$peg = $_POST['peg'];
		$id_tpp= $this->session->userdata('id_tpp');
		$this->session->set_userdata("idtpp",$id_tpp);
		$ini_jab = $this->m_profil->ini_jabatan_riwayat($idd);
		if($peg=="pegawai"){
			$this->m_tukin->set_tpp_pegawai_jabatan($id_tpp,$ini_jab->id_unor,$ini_jab->nama_jabatan,$ini_jab->nomenklatur_pada,$ini_jab->nama_ese,$ini_jab->tugas_tambahan);
		} else {
			$this->m_tukin->set_tpp_penilai_jabatan($id_tpp,$ini_jab->id_unor,$ini_jab->nama_jabatan,$ini_jab->nomenklatur_pada,$ini_jab->nama_ese,$ini_jab->tugas_tambahan);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////
	function dashboard_realisasi(){
		$this->load->model('widget_dashboard_sikda/m_dashboard_sikda');

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');


		$query = $this->m_dashboard_sikda->get_panel(8,$data['bulan'],$data['tahun']);
		$data['unor'] =json_decode(@$query->meta_value);
		$query = $this->m_dashboard_sikda->get_panel(9,$data['bulan'],$data['tahun']);
		$jbt =json_decode(@$query->meta_value);
		$data['ess2'] = @$jbt->ess2;
		$data['ess3'] = @$jbt->ess3;
		$data['ess4'] = @$jbt->ess4;
		$data['jfu'] = @$jbt->jfu;
		$data['jft'] = @$jbt->jft;

		$this->load->view('pantau/dash_realisasi',$data);
	}
	function realisasi(){
		$sess = $this->session->userdata('logged_in');
		$data['grup'] = $sess['group_name'];

		$data['dwBulan'] = $this->dropdowns->bulan();
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['st_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['nl_realisasi'] = $this->dropdowns->tpp_nilai();

		$data['satu'] = "Daftar Realisasi Kerja Pegawai";
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
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['pstrealisasi'] = (isset($_POST['pstrealisasi']))?$_POST['pstrealisasi']:"";
		$data['pnlrealisasi'] = (isset($_POST['pnlrealisasi']))?$_POST['pnlrealisasi']:"";
		$this->load->view('pantau/realisasi',$data);
	}



	function realisasi_umpeg(){
		$data['dwBulan'] = $this->dropdowns->bulan();
		$tgHl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgHl); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['st_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['nl_realisasi'] = $this->dropdowns->tpp_nilai();

		$data['satu'] = "Daftar Realisasi Kerja Pegawai";
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
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['pstrealisasi'] = (isset($_POST['pstrealisasi']))?$_POST['pstrealisasi']:"";
		$data['pnlrealisasi'] = (isset($_POST['pnlrealisasi']))?$_POST['pnlrealisasi']:"";
		$this->load->view('pantau/realisasi_umpeg',$data);
	}
	function getrealisasi(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
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
			$tahun=$_POST['tahun'];
			$st_realisasi=$_POST['st_realisasi'];
			$nl_realisasi=$_POST['nl_realisasi'];
			$data['bulan'] = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];

		$cct = $this->m_pantau->hitung_pegawai($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$data['bulan'],$tahun,$st_realisasi,$nl_realisasi);
		$data['count'] = count($cct);
		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);
		$this->session->set_userdata("tahun",$tahun);
		$this->session->set_userdata("bulan",$data['bulan']);

		$pangkat = $this->dropdowns->kode_pangkat();
		$golongan = $this->dropdowns->kode_golongan();
		$bulan = $this->dropdowns->bulan();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$tahapan_tpp = $this->dropdowns->tahapan_tpp();

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpagingA' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_pantau->get_pegawai($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$data['bulan'],$tahun,$st_realisasi,$nl_realisasi);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];

				$data['hslquery'][$key]->penilai_nama_pegawai = ($val->status!='acc_penilai')?"-":((trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'').((trim($val->penilai_gelar_nonakademis) != '-')?trim($val->penilai_gelar_nonakademis).' ':'').$val->penilai_nama_pegawai.((trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'');
				$data['hslquery'][$key]->penilai_nip_baru = ($val->status!='acc_penilai')?"-":$val->penilai_nip_baru; 
				$data['hslquery'][$key]->penilai_nama_pangkat = ($val->status!='acc_penilai')?"-":$val->penilai_nama_pangkat; 
				$data['hslquery'][$key]->penilai_nama_golongan = ($val->status!='acc_penilai')?"-":$val->penilai_nama_golongan; 
				$data['hslquery'][$key]->penilai_nomenklatur_jabatan = ($val->status!='acc_penilai')?"-":$val->penilai_nomenklatur_jabatan; 

				$data['hslquery'][$key]->nilai_skp = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":$val->nilai_tugaspokok; 
				$data['hslquery'][$key]->nilai_tugastambahan = (empty($val->nilai_tugastambahan) || $val->status!='acc_penilai')?"-":$val->nilai_tugastambahan; 
				$data['hslquery'][$key]->nilai_kreatifitas = (empty($val->nilai_kreatifitas) || $val->status!='acc_penilai')?"-":$val->nilai_kreatifitas; 
				$data['hslquery'][$key]->nilai_perilaku = (empty($val->nilai_perilaku) || $val->status!='acc_penilai')?"-":$val->nilai_perilaku; 
				$data['hslquery'][$key]->nilai_total = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":(($val->nilai_tugaspokok+$val->nilai_kreatifitas+$val->nilai_tugastambahan)*.6)+($val->nilai_perilaku); 
				$data['hslquery'][$key]->biaya = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":($val->biaya == NULL)?"-":number_format($val->biaya,2,"."," "); 

				$data['hslquery'][$key]->aksi = ($val->status!='acc_penilai')?"&nbsp;":"<div class='btn btn-default btn-xs' onclick=\"ppost(".$val->id_tpp.",'module/apptukin/pantau/realisasi_arsip')\"><i class='fa fa-binoculars fa-fw'></i></div>";


				$data['hslquery'][$key]->status_tpp = @$realisasi->status; 
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function realisasi_arsip(){
		if(isset($_POST['refresh'])){ $data['reff'] = "ya";	} else {	$data['reff'] = "tidak";	}
		$this->session->set_userdata('refresh',$data['reff']);
		if(isset($_POST['proses'])){
			$tr = $_POST['proses'];
			$this->$tr($_POST['idd'],$_POST['bulan']);
		}

		$data['satu'] = "Daftar Realisasi Kerja Pegawai";
		$data['cari'] = $_POST['cari'];
		$data['batas'] = $_POST['batas'];
		$data['hal'] = $_POST['hal'];
		$data['kode'] = $_POST['kode'];
		$data['pns'] = $_POST['pns'];
		$data['pkt'] = $_POST['pkt'];
		$data['jbt'] = $_POST['jbt'];
		$data['ese'] = $_POST['ese'];
		$data['tugas'] = $_POST['tugas'];
		$data['gender'] = $_POST['gender'];
		$data['agama'] = $_POST['agama'];
		$data['status'] = $_POST['status'];
		$data['jenjang'] = $_POST['jenjang'];
		$data['umur'] = $_POST['umur'];
		$data['mkcpns'] = $_POST['mkcpns'];
		$data['tahun'] = $_POST['tahun'];
		$data['bulan'] = $_POST['bulan'];
		$data['asal'] = $_POST['asal'];

		$data['bulan_aju'] = $data['bulan'];

		$data['id_tpp'] = $_POST['idd'];
		$this->session->set_userdata('id_tpp',$_POST['idd']);
		$this->session->set_userdata('bulan',$data['bulan']);
		$id_penilai = $this->session->userdata('pegawai_info');

		$data['layak_turun'] = $this->m_pantau->cek_layak_turun($data['id_tpp'],$data['bulan']);

		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['penilai'] = $this->m_tukin->get_pegawai($id_penilai);
		$data['pegawai'] = $this->m_tukin->get_pegawai_bulanan($data['tpp']->id_pegawai,$data['tpp']->tahun,$data['bulan']);
		$this->session->set_userdata('jab_type',$data['pegawai']->jab_type);
		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
		}
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($data['id_tpp'],$data['bulan_aju']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_realisasi_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
		$data['realisasi_tahapan'] = $this->m_tukin->get_realisasi($data['id_tpp'],$data['bulan_aju']);
		$data['tahapan_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['tahapan_realisasi_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$data['tahapan_realisasi_nomor'] = $this->dropdowns->tahapan_tpp_nomor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$unr = $this->m_tukin->get_m_unor($data['tpp']->id_unor);
		$kode = substr($unr->kode_unor,0,5);
		$unor = $this->m_tukin->getunor($kode,date("Y-m-d"));
		$nama_unor = (!empty($unor))?$unor->nama_unor:"xxxxx";
		$this->session->set_userdata("unor",$nama_unor);
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$this->load->view('pantau/realisasi_arsip',$data);
	}

	function turun_status($id,$bln){
		$this->m_pantau->turun_status($id,$bln);
	}
	function refresh_dashboard($bulan,$tahun){

		$bulan = (strlen($bulan)==1)?"0".$bulan:$bulan;
		$dueDate = $tahun."-".$bulan."-01";
		$unor = $this->m_unor->gettree(0,5,$dueDate);
		$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
			foreach($data['unor'] AS $key=>$val){
					$cct = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'BS');
					$data['unor'][$key]->tm = count($cct);
					$cctA = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun);
					$data['unor'][$key]->j_all = count($cctA);
					$cct2 = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'',5);
					$data['unor'][$key]->j_kat_5 = count($cct2);
					$cct3 = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'',4);
					$data['unor'][$key]->j_kat_4 = count($cct3);
					$cct4 = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'',3);
					$data['unor'][$key]->j_kat_3 = count($cct4);
					$cct2 = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'',2);
					$data['unor'][$key]->j_kat_2 = count($cct2);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'',1);
					$data['unor'][$key]->j_kat_1 = count($cct1);
			}
		$vll = json_encode($data['unor']);
		$jj = "Nilai Realisasi Kerja Pegawai Berdasarkan Unit Kerja";
		$df = $this->m_dashboard->satu(8,$jj,$vll,$bulan,$tahun);
///////////////////////////////////////////////////////////////////////////////////////////////////
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess2']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'',5);
					@$data['jabatan']['ess2']->j_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'',4);
					@$data['jabatan']['ess2']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'',3);
					@$data['jabatan']['ess2']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'',2);
					@$data['jabatan']['ess2']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'',1);
					@$data['jabatan']['ess2']->j_kat_1 = count($cct1);

					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess3']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',5);
					@$data['jabatan']['ess3']->j_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',4);
					@$data['jabatan']['ess3']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',3);
					@$data['jabatan']['ess3']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',2);
					@$data['jabatan']['ess3']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',1);
					@$data['jabatan']['ess3']->j_kat_1 = count($cct1);

					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess4']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'',5);
					@$data['jabatan']['ess4']->j_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'',4);
					@$data['jabatan']['ess4']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'',3);
					@$data['jabatan']['ess4']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'',2);
					@$data['jabatan']['ess4']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'',1);
					@$data['jabatan']['ess4']->j_kat_1 = count($cct1);

					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jfu']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'',5);
					@$data['jabatan']['jfu']->j_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'',4);
					@$data['jabatan']['jfu']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'',3);
					@$data['jabatan']['jfu']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'',2);
					@$data['jabatan']['jfu']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'',1);
					@$data['jabatan']['jfu']->j_kat_1 = count($cct1);

					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jft']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'',5);
					@$data['jabatan']['jft']->j_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'',4);
					@$data['jabatan']['jft']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'',3);
					@$data['jabatan']['jft']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'',2);
					@$data['jabatan']['jft']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_pegawai("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'',1);
					@$data['jabatan']['jft']->j_kat_1 = count($cct1);

		$vll = json_encode($data['jabatan']);
		$jj = "Nilai Realisasi Kerja Pegawai Berdasarkan Jenis Jabatan";
		$df = $this->m_dashboard->satu(9,$jj,$vll,$bulan,$tahun);

	}
	function refresh_dashrencana($bulan,$tahun){
		$bulan = (strlen($bulan)==1)?"0".$bulan:$bulan;
		$dueDate = $tahun."-".$bulan."-01";
		$unor = $this->m_unor->gettree(0,5,$dueDate);
		$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
			foreach($data['unor'] AS $key=>$val){
					$cctA = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun);
					$data['unor'][$key]->j_all = count($cctA);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['unor'][$key]->tm = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['unor'][$key]->j_kat_1 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['unor'][$key]->j_kat_2 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['unor'][$key]->j_kat_3 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['unor'][$key]->j_kat_4 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['unor'][$key]->j_kat_5 = count($cct);
			}
		$vll = json_encode($data['unor']);
		$jj = "Rencana Kerja Pegawai Berdasarkan Unit Kerja";
		$df = $this->m_dashboard->satu(10,$jj,$vll,$bulan,$tahun);
///////////////////////////////////////////////////////////////////////////////////////////////////
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess2']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['jabatan']['ess2']->j_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['jabatan']['ess2']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['jabatan']['ess2']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['jabatan']['ess2']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['jabatan']['ess2']->j_kat_5 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess3']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['jabatan']['ess3']->j_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['jabatan']['ess3']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['jabatan']['ess3']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['jabatan']['ess3']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['jabatan']['ess3']->j_kat_5 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess4']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['jabatan']['ess4']->j_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['jabatan']['ess4']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['jabatan']['ess4']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['jabatan']['ess4']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['jabatan']['ess4']->j_kat_5 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jfu']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['jabatan']['jfu']->j_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['jabatan']['jfu']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['jabatan']['jfu']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['jabatan']['jfu']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['jabatan']['jfu']->j_kat_5 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jft']->tm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',1);
					@$data['jabatan']['jft']->j_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',2);
					@$data['jabatan']['jft']->j_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',3);
					@$data['jabatan']['jft']->j_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',4);
					@$data['jabatan']['jft']->j_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',5);
					@$data['jabatan']['jft']->j_kat_5 = count($cct1);
		$vll = json_encode($data['jabatan']);
		$jj = "Rencana Kerja Pegawai Berdasarkan Jenis Jabatan";
		$df = $this->m_dashboard->satu(11,$jj,$vll,$bulan,$tahun);
///////////////////////////////////////////////////////////////////////////////////////////////////
			foreach($data['unor'] AS $key=>$val){
					$cctA = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun);
					$data['unor'][$key]->j_all = count($cctA);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['unor'][$key]->tm = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['unor'][$key]->j_kat_1 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['unor'][$key]->j_kat_2 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['unor'][$key]->j_kat_3 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['unor'][$key]->j_kat_4 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['unor'][$key]->j_kat_5 = count($cct);
					$cct = $this->m_pantau->hitung_rencana("","all","all",$val->kode_unor,"","","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['unor'][$key]->j_kat_6 = count($cct);
			}
		$vll = json_encode($data['unor']);
		$jj = "Rencana Kerja Pegawai Berdasarkan Unit Kerja";
		$df = $this->m_dashboard->satu(12,$jj,$vll,$bulan,$tahun);
///////////////////////////////////////////////////////////////////////////////////////////////////
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess2']->btm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['jabatan']['ess2']->b_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['jabatan']['ess2']->b_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['jabatan']['ess2']->b_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['jabatan']['ess2']->b_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['jabatan']['ess2']->b_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",2,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['jabatan']['ess2']->b_kat_6 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess3']->btm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['jabatan']['ess3']->b_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['jabatan']['ess3']->b_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['jabatan']['ess3']->b_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['jabatan']['ess3']->b_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['jabatan']['ess3']->b_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",3,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['jabatan']['ess3']->b_kat_6 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['ess4']->btm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['jabatan']['ess4']->b_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['jabatan']['ess4']->b_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['jabatan']['ess4']->b_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['jabatan']['ess4']->b_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['jabatan']['ess4']->b_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","",4,"","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['jabatan']['ess4']->b_kat_6 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jft']->btm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['jabatan']['jft']->b_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['jabatan']['jft']->b_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['jabatan']['jft']->b_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['jabatan']['jft']->b_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['jabatan']['jft']->b_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jft","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['jabatan']['jft']->b_kat_6 = count($cct1);

					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'BS');
					@$data['jabatan']['jfu']->btm = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",1);
					@$data['jabatan']['jfu']->b_kat_1 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",2);
					@$data['jabatan']['jfu']->b_kat_2 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",3);
					@$data['jabatan']['jfu']->b_kat_3 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",4);
					@$data['jabatan']['jfu']->b_kat_4 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",5);
					@$data['jabatan']['jfu']->b_kat_5 = count($cct1);
					$cct1 = $this->m_pantau->hitung_rencana("","all","all","","","jfu","","","","","","","all","all",$bulan,$tahun,'acc_penilai',"",6);
					@$data['jabatan']['jfu']->b_kat_6 = count($cct1);
		$vll = json_encode($data['jabatan']);
		$jj = "Rencana Kerja Pegawai Berdasarkan Jenis Jabatan";
		$df = $this->m_dashboard->satu(13,$jj,$vll,$bulan,$tahun);
	}


	function pindah(){
		$this->session->set_userdata('pegawai_info',$_POST['idd']);


			$this->db->where('id_pegawai',$_POST['idd']);
			$this->db->from('user_pegawai');
			$hslquery = $this->db->get()->row();
			
			if(empty($hslquery)){
				$val = Modules::run('appbkpp/profile/ini_pegawai_master',$_POST['idd']);

				$sqlstrN="SELECT id_item FROM cmf_setting WHERE  id_setting='4' AND nama_item='pegawai'";
				$hslqueryN=$this->db->query($sqlstrN)->row();
					$passwd = sha1("admin_xd");
					$this->db->set('username',$val->nip_baru);
					$this->db->set('nama_user',$val->nama_pegawai);
					$this->db->set('group_id',$hslqueryN->id_item);
					$this->db->set('passwd',$passwd);
					$this->db->insert('users');
					$user_id = $this->db->insert_id();
		
					$this->db->set('user_id',$user_id);
					$this->db->set('id_pegawai',$val->id_pegawai);
					$this->db->insert('user_pegawai');
			} else {
					$user_id = $hslquery->user_id;
			}

		echo $user_id;
	}

	
}
?>