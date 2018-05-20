<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pantau extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pantaudata');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
  }

  public function index()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_pendidikan',$data);
  }


	function get_pendidikan(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$data['hslquery'][$key]->id_pegawai);
			foreach($seno AS $keyy=>$vall){
				@$seno[$keyy]->st_nama_sekolah = (strlen($vall->nama_sekolah)<3)?"salah":"benar";
				@$seno[$keyy]->st_nomor_ijazah = (strlen($vall->nomor_ijazah)<=3)?"salah":"benar";
				@$seno[$keyy]->st_tangga = ($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970")?"salah":"benar";
				if($keyy==0){
					$seno[$keyy]->st_jenjang = ($vall->kode_jenjang!='05')?"salah":"benar";
				} else {
					$seno[$keyy]->st_jenjang = ($seno[$keyy]->kode_jenjang<$seno[($keyy-1)]->kode_jenjang)?"salah":"benar";
				}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"ijazah_pendidikan",$vall->id_peg_pendidikan);
				@$seno[$keyy]->st_dokumen = (empty($cek))?"salah":"benar";
			}
			$data['hslquery'][$key]->seno = $seno;
		}
		echo json_encode($data);
	}

  public function pangkat()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_pangkat',$data);
  }
	function get_pangkat(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$data['hslquery'][$key]->id_pegawai);

			foreach($seno AS $keyy=>$vall){
				@$seno[$keyy]->st_sk_nomor = (strlen($vall->sk_nomor)<=3)?"salah":"benar";
				@$seno[$keyy]->st_sk_tanggal = ($vall->sk_tangga=="00-00-0000" || $vall->sk_tangga=="01-01-1970")?"salah":"benar";
				@$seno[$keyy]->st_tmt_golongan = ($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970")?"salah":"benar";
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pangkat",$vall->id_peg_golongan);
				@$seno[$keyy]->st_dokumen = (empty($cek))?"salah":"benar";
			}


			$data['hslquery'][$key]->seno = $seno;
		}
		echo json_encode($data);
	}

  public function cpns()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_cpns',$data);
  }

	function get_cpns(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_cpns",$data['hslquery'][$key]->id_pegawai);
			@$seno->st_sk_cpns_tgl = ($seno->sk_cpns_tgll=="00-00-0000" || $seno->sk_cpns_tgll=="")?"salah":"benar";
			@$seno->st_sk_cpns_nomor = (strlen($seno->sk_cpns_nomor)<3)?"salah":"benar";
			@$seno->st_tmt_cpns = ($seno->tmt_cpnss=="00-00-0000" || $seno->tmt_cpnss=="" || $seno->tmt_cpnss==$seno->sk_cpns_tgll)?"salah":"benar";
				@$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_cpns",$seno->id);
			@$seno->st_dokumen = (empty($cek))?"salah":"benar";
			$data['hslquery'][$key]->seno = $seno;
		}
		echo json_encode($data);
	}

  public function pns()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_pns',$data);
  }

	function get_pns(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_pns",$data['hslquery'][$key]->id_pegawai);
			@$seno->st_sk_pns_tanggal = ($seno->sk_pns_tanggall=="00-00-0000" || $seno->sk_pns_tanggall=="")?"salah":"benar";
			@$seno->st_sk_pns_nomor = (strlen($seno->sk_pns_nomor)<3)?"salah":"benar";
			@$seno->st_tmt_pns = ($seno->tmt_pnss=="00-00-0000" || $seno->tmt_pnss=="" || $seno->tmt_pnss==$seno->sk_pns_tanggall)?"salah":"benar";
				@$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pns",$seno->id);
			@$seno->st_dokumen = (empty($cek))?"salah":"benar";
			$data['hslquery'][$key]->seno = $seno;

		}
		echo json_encode($data);
	}


  public function jabatan()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_jabatan',$data);
  }
	function get_jabatan(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$val->id_pegawai);

			foreach($seno AS $keyy=>$vall){
				@$seno[$keyy]->st_sk_nomor = (strlen($vall->sk_nomor)<=3)?"salah":"benar";
				@$seno[$keyy]->st_sk_tanggal = ($vall->sk_tanggall=="00-00-0000" || $vall->sk_tanggall=="01-01-1970")?"salah":"benar";
				@$seno[$keyy]->st_tmt_jabatan = ($vall->tmt_jabatann=="00-00-0000" || $vall->tmt_jabatann=="01-01-1970")?"salah":"benar";
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_jabatan",@$vall->id_peg_jab);
				@$seno[$keyy]->st_dokumen = (empty($cek))?"salah":"benar";
			}
			$data['hslquery'][$key]->seno = $seno;
		}
		echo json_encode($data);
	}
  public function prajabatan()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_prajabatan',$data);
  }

	function get_prajabatan(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_prajabatan",$val->id_pegawai);
			@$seno->st_tanggal_sttpl = ($seno->tanggal_sttpll=="00-00-0000" || $seno->tanggal_sttpll=="01-01-1970" || $seno->tanggal_sttpll=="")?"salah":"benar";
			@$seno->st_nomor_sttpl = (strlen($seno->nomor_sttpl)<3)?"salah":"benar";
			@$seno->st_penyelenggara = (strlen($seno->penyelenggara)<3)?"salah":"benar";
				@$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sertifikat_prajab",$seno->id_peg_diklat_struk);
			@$seno->st_dokumen = (empty($cek))?"salah":"benar";
			$data['hslquery'][$key]->seno = $seno;

		}
		echo json_encode($data);
	}

  public function konversi()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_konversi',$data);
  }

	function get_konversi(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_konversi_nip",$val->id_pegawai);
			@$seno->st_konversi_nip_tanggal = ($seno->konversi_nip_tanggall=="00-00-0000" || $seno->konversi_nip_tanggall=="01-01-1970" || $seno->konversi_nip_tanggall=="")?"salah":"benar";
			@$seno->st_konversi_nip_nomor = (strlen($seno->konversi_nip_nomor)<10)?"salah":"benar";
				@$cek = $this->m_edok->cek_dokumen($val->nip_baru,"konversi_nip",@$seno->id_konversi_nip);
			@$seno->st_dokumen = (empty($cek))?"salah":"benar";
			$data['hslquery'][$key]->seno = $seno;

		}
		echo json_encode($data);
	}

	function daftar_pegawai($cari,$bts,$hl,$kd){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
		} else {
			$unor="all";
		}
			$kode=$kd;

		$data['count'] = $this->m_pantaudata->hitung_pantau_data($cari,$unor,$kode);
		$data['bat_print'] = 200;
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$bts;
			$hal = ($hl=="end")?ceil($data['count']/$batas):$hl;
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_pantaudata->get_pantau_data($cari,$mulai,$batas,$unor,$kode);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
//		echo json_encode($data);
		return $data;
	}

  public function biodata()   {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "aktif_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "aktif_pempeg";
		} else {
			$rd = "index";
		}
		
		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$this->load->view('pantau/'.$rd.'_biodata',$data);
  }
	function get_biodata(){
		$data = $this->daftar_pegawai($_POST['cari'],$_POST['batas'],$_POST['hal'],$_POST['kode']);
		foreach($data['hslquery'] AS $key=>$val){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_master",$data['hslquery'][$key]->id_pegawai);
				@$seno->st_tanggal_lahirr = ($seno->tanggal_lahirr=="00-00-0000")?"salah":"benar";
				@$seno->st_tempat_lahir = (strlen($seno->tempat_lahir)<=3)?"salah":"benar";
				@$seno->st_agama = (strlen($seno->agama)<=3)?"salah":"benar";
				@$seno->st_status_perkawinan = (strlen($seno->status_perkawinan)<=3)?"salah":"benar";
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"pasfoto",0);
				@$seno->st_pasfoto = (empty($cek))?"salah":"benar";

			$data['hslquery'][$key]->seno = $seno;
		}
		echo json_encode($data);
	}

}
?>