<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Harian extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$tGH = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tGH); 
		$data['jam_kerja'] = $this->dropdowns->jam_kerja();
		$data['jam'] = (isset($_POST['jam']))?$_POST['jam']:"";
		$data['kurang'] = date("H:i:s",10);

		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['hadir'] = $this->dropdowns->kehadiran();

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
		$data['phadir'] = (isset($_POST['phadir']))?$_POST['phadir']:"all";

		$hari = $this->dropdowns->hari_konversi();
		$id_harian = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($id_harian);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$data['keterangan'] = $data['val']->keterangan;
		$this->session->set_userdata('bulan_harian',$data['val']->bulan_harian);
		$this->session->set_userdata('tahun_harian',$data['val']->tahun_harian);
		
		$data['hapus'] = (strtotime(date('Y-m-d'))-strtotime(date($data['val']->tg_harian))<=0)?"ya":"tidak";
		$data['id_maju'] = $this->session->userdata('id_maju'); 
		$data['id_mundur'] = $this->session->userdata('id_mundur'); 

		$this->load->view('harian/index',$data);
	}
	
	function getdata(){
			$unor="all";
			$kode=$_POST['kode'];
			$this->session->set_userdata('kode',$kode); // set session untuk daftar rekap bulanan
			$pns=$_POST['pns'];
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
			$hadir=$_POST['hadir'];
			$idj = $_POST['idj'];
			$idh = $this->session->userdata('id_harian'); 
			$blh = $this->session->userdata('bulan_harian'); 
			$thh = $this->session->userdata('tahun_harian'); 
			$IniHarian = $this->m_harian->ini_harian($idh);
			$kehadiran = $this->dropdowns->kehadiran();


		$hpp = (strtotime(date('Y-m-d'))-strtotime(date($IniHarian->tg_harian))>=0)?"ya":"tidak";
		if($hpp=="ya"){
			$data['count'] = $this->m_harian->hitung_wajib_hadir($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$blh,$thh);
		} else {
			$data['count'] = $this->m_harian->hitung_wajib_hadir_N($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$blh,$thh);
		}


		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			if($hpp=="ya"){
				$data['hslquery'] = $this->m_harian->get_wajib_hadir($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$blh,$thh);
			} else {
				$data['hslquery'] = $this->m_harian->get_wajib_hadir_N($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$blh,$thh);
			}
			$pangkat = $this->dropdowns->kode_pangkat();
			$golongan = $this->dropdowns->kode_golongan();


			$data['bat_print'] = 200;
			$data['seg_print'] = ceil($data['count']/$data['bat_print']);
			$ctk['bat_print'] = $data['bat_print'];
			$ctk['kode'] = $kode;
			$ctk['bulan_print'] = $blh;
			$ctk['tahun_print'] = $thh;
			$this->session->set_userdata("id_cetak",$ctk);



			foreach($data['hslquery'] AS $key=>$val){
				$token = $this->m_harian->get_token($IniHarian->tg_harian,$val->id_pegawai);
				@$data['hslquery'][$key]->token_masuk = $token->token_masuk;
				@$data['hslquery'][$key]->token_pulang = $token->token_pulang;

				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];
				$data['hslquery'][$key]->telat_masuk = ($val->selisih_masuk==0)?"-":date('H:i:s',($val->selisih_masuk-(7*3600)));
				$data['hslquery'][$key]->cepat_pulang = ($val->selisih_pulang==0)?"-":date('H:i:s',$val->selisih_pulang);
				$data['hslquery'][$key]->absen_masuk = ($val->absen_masuk=="00:00:00")?"-":$val->absen_masuk;
				$data['hslquery'][$key]->absen_pulang = ($val->absen_pulang=="00:00:00")?"-":$val->absen_pulang;

				if($val->status=="H"){
					$data['hslquery'][$key]->stt = '<div class="btn btn-primary btn-xs" style="cursor:none;"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
				} elseif($val->status=="S") {
					$data['hslquery'][$key]->stt = '<div class="btn btn-warning btn-xs" style="cursor:none;"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
				} elseif($val->status=="I") {
					$data['hslquery'][$key]->stt = '<div class="btn btn-info btn-xs" style="cursor:none;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
				} elseif($val->status=="DL") {
					$data['hslquery'][$key]->stt = '<div class="btn btn-success btn-xs" style="cursor:none;"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
				} elseif($val->status=="TK") {
					$data['hslquery'][$key]->stt = '<div class="btn btn-danger btn-xs" style="cursor:none;"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
				} elseif($val->status=="C") {
					$data['hslquery'][$key]->stt= '<div class="btn btn-danger btn-xs" style="cursor:none;"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';
				}
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function baru(){
		$id_harian = $this->session->userdata('id_harian');
		$hh = $this->m_harian->maju_hari($id_harian);

		$maju = $this->m_harian->get_maju_harian($hh->tanggal_harian);
		$this->session->set_userdata('id_maju',$maju->id_harian); 
		$mundur = $this->m_harian->get_mundur_harian($hh->tanggal_harian);
		$this->session->set_userdata('id_mundur',$mundur->id_harian); 
		$this->session->set_userdata('id_harian',$hh->id_harian); 
	}
/*
	function form_harian_baru(){
		$id_harian = $this->session->userdata('id_harian');
		$data['balik'] = ($id_harian!="")?"ya":"tidak";
		$this->load->view('harian/form_harian_baru',$data);
	}

	function jadual_harian_tambah_aksi(){
		$isi = $_POST;
		$isi['tanggal_harian'] =  date("Y-m-d", strtotime($_POST['tanggal_harian']));
		$id_harian = $this->m_harian->tambah_jadual_harian($isi);
		$this->session->set_userdata('id_harian',$id_harian); 
		echo "sukses";
	}
*/
	function form_harian_edit(){
		$id_harian = $this->session->userdata('id_harian');
		$data['val'] = $this->m_harian->ini_harian($id_harian);
		$this->load->view('harian/form_harian_edit',$data);
	}
	function jadual_harian_edit_aksi(){
		$isi = $_POST;
		$isi['tanggal_harian'] =  date("Y-m-d", strtotime($_POST['tanggal_harian']));
		$id_harian = $this->session->userdata('id_harian');
		$this->m_harian->edit_jadual_harian($id_harian,$isi);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function formtambah_wajib_hadir(){
		$hari = $this->dropdowns->hari_konversi();
		$id_harian = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($id_harian);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];

		$data['unor'] = $this->m_unor->gettree(0,5,"2015-01-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['jam_kerja'] = $this->dropdowns->jam_kerja();

		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
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
		$data['jam'] = (isset($_POST['jam']))?$_POST['jam']:"";
		$this->load->view('harian/formtambah_wajib_hadir',$data);
	}
	function getbelum(){
			$id_harian = $this->session->userdata('id_harian');

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
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

		$data['count'] = $this->m_harian->hitung_belum($id_harian,$_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang);
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
			$data['hslquery'] = $this->m_harian->get_belum($id_harian,$_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
					$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
					$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
					$cek = $this->m_harian->cek_wajib($id_harian,$val->id_pegawai);
					$data['hslquery'][$key]->cek = (empty($cek))?"ya":"tidak";
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function getaktif(){
			$id_harian = $this->session->userdata('id_harian');

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
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

		$data['count'] = $this->m_pegawai->hitung_pegawai($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang);
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
			$data['hslquery'] = $this->m_pegawai->get_pegawai($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
					$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
					$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
					$cek = $this->m_harian->cek_wajib($id_harian,$val->id_pegawai);
					$data['hslquery'][$key]->cek = (empty($cek))?"ya":"tidak";
				}
			$data['pager'] = Modules::run("appskp/appskp/pagerB",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function wajib_hadir_tambah_aksi(){
		if(isset($_POST['id_pegawai'])){
			$isi = $_POST;
			$id_harian = $this->session->userdata('id_harian');
			$id_jam = $_POST['jam_kerja'];
			$this->m_harian->tambah_wajib_hadir($id_harian,$id_jam,$isi);
		}
		echo "sukses";
	}

	function formcopy_wajib_hadir(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_harian'] = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($data['id_harian']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$tt = explode("-",$data['val']->tg_harian);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('harian/formcopy_wajib_hadir',$data);
	}

	function copy_wajib_hadir_aksi(){
		$id_harian = $_POST['idd'];
		$id_ini = $this->session->userdata('id_harian'); 
		$this->m_harian->copy_wajib_hadir($id_ini,$id_harian);
	}
	function formtambah_semua(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_harian'] = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($data['id_harian']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$tt = explode("-",$data['val']->tg_harian);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		$data['j_pegawai'] = $this->m_pegawai->hitung_pegawai_bulanan("","all","all","","","","","","","","","","all","all",$tt[1],$tt[0],'pns');
		$unor = $this->m_unor->gettree(0,5,"2015-01-01"); 
		$data['j_unor'] = count($unor);
		$data['jam'] = $this->m_harian->get_jam_kerja(0,1);

		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('harian/formtambah_semua',$data);
	}
	function tambah_semua_aksi(){
		$id_harian = $_POST['id_harian'];
		$id_jam = $_POST['id_jam'];
		$id_ini = $this->session->userdata('id_harian'); 
		$this->m_harian->tambah_semua($id_jam,$id_harian);
		echo "sukses";
	}
	function hapus_pil(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_harian'] = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($data['id_harian']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$tt = explode("-",$data['val']->tg_harian);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		foreach($_POST['id_pegawai'] AS $key=>$val){
			@$data['pegawai'][$key] = Modules::run('appbkpp/profile/ini_pegawai',$val);
		}
		$this->load->view('harian/formhapus_pilih',$data);
	}
	function hapus_pil_aksi(){
		$idp = $_POST['id_harian'];
		foreach($_POST['id_pegawai'] AS $key=>$val){
			$this->m_harian->hapus_wajib_hadir($idp,$val);
		}
		echo "sukses";
	}
	function pindah_pil(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_harian'] = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($data['id_harian']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$tt = explode("-",$data['val']->tg_harian);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		$sess = $this->session->userdata('logged_in');
		$data['asal'] = ($sess['group_name']=="pengelola" || $sess['group_name']=="absensor_unit")?"module/appbina/absensi/umpeg":"module/appbina/harian";

		$data['jam_kerja'] = $this->dropdowns->jam_kerja();

		foreach($_POST['id_wajib'] AS $key=>$val){
			$idW = $this->m_harian->ini_wajib_hadir($val);
			@$data['pegawai'][$key] = Modules::run('appbkpp/profile/ini_pegawai',$idW->id_pegawai);
		}
		$this->load->view('harian/formpindah_pilih',$data);
	}
	function pindah_pil_aksi(){
		$idj = $_POST['jam_kerja'];
		$idh = $_POST['id_harian'];
		foreach($_POST['id_pegawai'] AS $key=>$val){
			$this->m_harian->pindah_wajib_hadir($idj,$idh,$val);
		}
		echo "sukses";
	}
/*
	function formhapus_wajib_hadir(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['no'];
		$data['ini'] = $this->m_harian->ini_wajib($_POST['idd']);
		$data['ini']->nama_pegawai = ((trim($data['ini']->gelar_depan) != '-')?trim($data['ini']->gelar_depan).' ':'').((trim($data['ini']->gelar_nonakademis) != '-')?trim($data['ini']->gelar_nonakademis).' ':'').$data['ini']->nama_pegawai.((trim($data['ini']->gelar_belakang) != '-')?', '.trim($data['ini']->gelar_belakang):'');

		$this->load->view('harian/formhapus_wajib_hadir',$data);
	}
	function hapus_wajib_hadir_aksi(){
		$idd = $_POST['idd'];
		$this->m_harian->hapus_wajib_hadir($idd);
		echo "sukses";
	}
*/
	function formhapus_semua(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_harian'] = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($data['id_harian']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$tt = explode("-",$data['val']->tg_harian);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		$data['jam'] = $this->m_harian->get_jam_kerja(0,1);


			$data['unor'] = $this->m_unor->gettree(0,5,date("Y-m-d"));
			foreach($data['unor'] AS $key=>$val){
				$data['unor'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$data['id_harian'],0,"all",$data['val']->bulan_harian,$data['val']->tahun_harian);
				$data['unor'][$key]->e2       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","2","","","","","","","",$data['id_harian'],0,"all",$data['val']->bulan_harian,$data['val']->tahun_harian);
				$data['unor'][$key]->e3       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","3","","","","","","","",$data['id_harian'],0,"all",$data['val']->bulan_harian,$data['val']->tahun_harian);
				$data['unor'][$key]->e4       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","4","","","","","","","",$data['id_harian'],0,"all",$data['val']->bulan_harian,$data['val']->tahun_harian);
				$data['unor'][$key]->ne       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","9","","","","","","","",$data['id_harian'],0,"all",$data['val']->bulan_harian,$data['val']->tahun_harian);
//				$data['unor'][$key]->dl          = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$data['id_harian'],0,"DL",$data['val']->bulan_harian,$data['val']->tahun_harian);
//				$data['unor'][$key]->tk          = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$data['id_harian'],0,"TK",$data['val']->bulan_harian,$data['val']->tahun_harian);
			}


		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('harian/formhapus_semua',$data);
	}
	function hapus_semua_aksi(){
		$id_harian = $_POST['id_harian'];
		$id_ini = $this->session->userdata('id_harian'); 
		$this->m_harian->hapus_semua($id_harian);
		echo "sukses";
	}
	function formhadir_wajib_hadir(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['no'];
		$data['ini'] = $this->m_harian->ini_wajib($_POST['idd']);
		$data['ini']->nama_pegawai = ((trim($data['ini']->gelar_depan) != '-')?trim($data['ini']->gelar_depan).' ':'').((trim($data['ini']->gelar_nonakademis) != '-')?trim($data['ini']->gelar_nonakademis).' ':'').$data['ini']->nama_pegawai.((trim($data['ini']->gelar_belakang) != '-')?', '.trim($data['ini']->gelar_belakang):'');

		$this->load->view('harian/formhadir_wajib_hadir',$data);
	}
	function hadir_wajib_hadir_aksi(){
		$idd = $_POST['idd'];
		$status = $_POST['status'];
		$this->m_harian->hadir_wajib_hadir($idd,$status);
		echo "sukses";
	}
	function formpulang_wajib_hadir(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['no'];
		$data['ini'] = $this->m_harian->ini_wajib($_POST['idd']);
		$data['ini']->nama_pegawai = ((trim($data['ini']->gelar_depan) != '-')?trim($data['ini']->gelar_depan).' ':'').((trim($data['ini']->gelar_nonakademis) != '-')?trim($data['ini']->gelar_nonakademis).' ':'').$data['ini']->nama_pegawai.((trim($data['ini']->gelar_belakang) != '-')?', '.trim($data['ini']->gelar_belakang):'');

		$this->load->view('harian/formpulang_wajib_hadir',$data);
	}
	function pulang_wajib_hadir_aksi(){
		$idd = $_POST['idd'];
		$isi = $_POST;
		$this->m_harian->pulang_wajib_hadir($idd,$isi);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////////
	function alih(){
		$hari_ini = date('Y-m-d');
		$harian = $this->m_harian->get_akhir_harian($hari_ini);
		if(empty($harian)){
			redirect(site_url("module/appbina/apel/form_harian_baru"));
		} else {
//			$akhir = end($harian);
			$this->session->set_userdata('id_harian',$harian->id_harian); 

			$maju = $this->m_harian->get_maju_harian($hari_ini);
			$this->session->set_userdata('id_maju',$maju->id_harian); 
			$mundur = $this->m_harian->get_mundur_harian($hari_ini);
			$this->session->set_userdata('id_mundur',$mundur->id_harian); 

			redirect(site_url("module/appbina/harian"));
		}
	}
	function pilih(){
		$idd = $_POST['idd'];
		$this->session->set_userdata('id_harian',$idd); 
		$hari = $this->m_harian->ini_harian($idd);

			$maju = $this->m_harian->get_maju_harian($hari->tg_harian);
			$this->session->set_userdata('id_maju',$maju->id_harian); 
			$mundur = $this->m_harian->get_mundur_harian($hari->tg_harian);
			$this->session->set_userdata('id_mundur',$mundur->id_harian); 

		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola"){
			redirect(site_url("module/appbina/absensi/umpeg"));
		} else {
			redirect(site_url("module/appbina/harian"));
		}
	}


	function daftar_harian(){
		$sess = $this->session->userdata('logged_in');
		$data['kembali'] = ($sess['group_name']=="pengelola" || $sess['group_name']=="absensor_unit")?"absensi/umpeg":"harian";

		$data['id_harian'] = $this->session->userdata('id_harian');
		$data['jam_kerja'] = $this->dropdowns->jam_kerja();
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		
				$data['kode'] = $this->session->userdata('kode');
				if($data['kode']==""){
					$data['nama_unit'] = "";
				} else {
					$bln = (strlen($data['bulan'])==1)?"0".$data['bulan']:$data['bulan'];
					$tanggal = $data['tahun']."-".$bln."-10";
					$sql = "SELECT nama_unor FROM m_unor WHERE kode_unor='".$data['kode']."' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
					$qry = $this->db->query($sql)->row();
					$data['nama_unit'] = $qry->nama_unor;
				}


		$this->load->view('harian/daftar_harian',$data);
	}
	function daftar_harian_cetak(){
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="absensor_unit"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			$kode = "";
		} else {
			$unor="all";
			$kode = $this->session->userdata('kode'); 
		}

		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun = $_POST['tahun'];
		$pkt="";$jbt="";$ese="";$tugas="";$gender="";$agama="";$status="";$jenjang="";$umur="";$mkcpns="";$jenis=(isset($_POST['jenis']))?$_POST['jenis']:"pns";
		$data['count'] = $this->m_pegawai->hitung_pegawai_bulanan("","all",$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);

		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$_POST['bulan_print'] = $bulan;
		$_POST['tahun_print'] = $tahun;
		$this->session->set_userdata("id_cetak",$_POST);

		$this->load->view('harian/daftar_harian_cetak',$data);
	}


	function getcopy(){
		$hari = $this->dropdowns->hari_konversi();
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun = $_POST['tahun'];
			$data['hslquery'] = $this->m_harian->get_daftar($tahun,$bulan);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->hari_kerja = $hari[$val->hari_kerja];
				$hpp = (strtotime(date('d-m-Y'))-strtotime(date($val->tanggal_harian))>=0)?"ya":"tidak";
				if($hpp=="ya"){
					$data['hslquery'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$val->id_harian,0,"all",$bulan,$tahun);
				} else {
					$data['hslquery'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir_N("","all","all","","","","","","","","","","","",$val->id_harian,0,"all",$bulan,$tahun);
				}
			}
		echo json_encode($data);
	}

	function getdaftar(){
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="absensor_unit"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			$kode = "";
		} else {
			$unor="all";
			$kode = $this->session->userdata('kode'); 
		}


		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun = $_POST['tahun'];
		$data['count'] = $this->m_harian->hitung_daftar($tahun,$bulan);

		if($data['count']==0){
			$data['hslquery']="";
		} else {
			$hari = $this->dropdowns->hari_konversi();
			$data['hslquery'] = $this->m_harian->get_daftar($tahun,$bulan);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->hari_kerja = $hari[$val->hari_kerja];
				$hpp = (strtotime(date('d-m-Y'))-strtotime(date($val->tanggal_harian))>=0)?"ya":"tidak";
				if($hpp=="ya"){
						$data['hslquery'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"all",$bulan,$tahun);
						$data['hslquery'][$key]->sakit = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"S",$bulan,$tahun);
						$data['hslquery'][$key]->ijin  = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"I",$bulan,$tahun);
						$data['hslquery'][$key]->cuti  = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"C",$bulan,$tahun);
						$data['hslquery'][$key]->dl    = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"DL",$bulan,$tahun);
						$data['hslquery'][$key]->tk    = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"TK",$bulan,$tahun);
						$data['hslquery'][$key]->hadir = $this->m_harian->hitung_wajib_hadir("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"H",$bulan,$tahun);
				} else {
						$data['hslquery'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"all",$bulan,$tahun);
						$data['hslquery'][$key]->sakit = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"S",$bulan,$tahun);
						$data['hslquery'][$key]->ijin  = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"I",$bulan,$tahun);
						$data['hslquery'][$key]->cuti  = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"C",$bulan,$tahun);
						$data['hslquery'][$key]->dl    = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"DL",$bulan,$tahun);
						$data['hslquery'][$key]->tk    = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"TK",$bulan,$tahun);
						$data['hslquery'][$key]->hadir = $this->m_harian->hitung_wajib_hadir_N("","all",$unor,$kode,"","","","","","","","","","",$val->id_harian,0,"H",$bulan,$tahun);
				}
			}
		}
		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////////////////
	function jam_kerja(){
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('harian/jam_kerja',$data);
	}

	function getjam_kerja(){
		$data['count'] = $this->m_harian->hitung_jam_kerja();
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_harian->get_jam_kerja($mulai,$batas);
//			foreach($data['hslquery'] AS $key=>$val){
//				$cek = $this->m_harian->cek_jam_kerja($val->id_jam);
//				@$data['hslquery'][$key]->hapus = (empty($cek))?"ya":"tidak";
//			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function formtambah_jam_kerja(){
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$this->load->view('harian/form_jam_kerja_tambah',$data);
	}
	function jam_kerja_tambah_aksi(){
		$this->m_harian->jam_kerja_tambah($_POST);
		echo "sukses";
	}
	function formedit_jam_kerja(){
		$data['idd'] = $_POST['idd'];
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['isi'] = $this->m_harian->ini_jam_kerja($_POST['idd']);
		$this->load->view('harian/form_jam_kerja_edit',$data);
	}
	function jam_kerja_edit_aksi(){
		$this->m_harian->jam_kerja_edit($_POST);
		echo "sukses";
	}

	function formhapus_jam_kerja(){
		$data['idd'] = $_POST['idd'];
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['isi'] = $this->m_harian->ini_jam_kerja($_POST['idd']);
		$this->load->view('harian/form_jam_kerja_hapus',$data);
	}
	function jam_kerja_hapus_aksi(){
		$this->m_harian->jam_kerja_hapus($_POST);
		echo "sukses";
	}
	function edit_keterangan(){
		$idd = $this->session->userdata('id_harian');
		$this->m_harian->edit_keterangan($idd,$_POST['keterangan']);
		echo "sukses";
	}

}
?>