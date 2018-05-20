<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Apel extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbina/m_apel');
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function injek_to_harian(){
			$id_apel = $this->session->userdata('id_apel'); 
			$apel = $this->m_apel->ini_apel($id_apel);

				$sqlstrN="SELECT * FROM ubina_harian WHERE  tanggal_harian='".$apel->tg_apel."'";
				$harian = $this->db->query($sqlstrN)->row();

			echo "tanggal apel: ".$apel->tg_apel."<br>";
			echo "id apel: ".$apel->id_apel."<br>";
			echo "tanggal harian: ".$harian->tanggal_harian."<br>";
			echo "id harian: ".$harian->id_harian."<br>";

				$sql = "SELECT * FROM ubina_apel_wajib WHERE  id_apel='$id_apel' AND apel_masuk!='00:00:00'";
				$hsl = $this->db->query($sql)->result();
			foreach($hsl AS $key=>$val){
				$this->db->set('status','H');
				$this->db->set('absen_masuk',$val->apel_masuk);
				$this->db->where('id_harian',$harian->id_harian);
				$this->db->where('id_pegawai',$val->id_pegawai);
				$this->db->update('ubina_harian_wajib');

				echo ($key+1).". ".$val->id_pegawai." :: ".$val->apel_masuk."<br>";
			}


	}

	function index(){
		$tGH = date('Y-m-d');
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
		$data['hadir'] = $this->dropdowns->kehadiran();
		$data['lokasi_apel'] = $this->dropdowns->lokasi_apel();

		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
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
		$data['lokasi'] = (isset($_POST['lokasi']))?$_POST['lokasi']:"";

		$hari = $this->dropdowns->hari_konversi();
		$id_apel = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($id_apel);
		$data['keterangan'] = $data['val']->keterangan;
		$data['val']->hari_apel = $hari[$data['val']->hari_apel];
		$this->session->set_userdata('bulan_apel',$data['val']->bulan_apel);
		$this->session->set_userdata('tahun_apel',$data['val']->tahun_apel);

		$data['hapus'] = (strtotime(date('Y-m-d'))-strtotime(date($data['val']->tg_apel))<=0)?"ya":"tidak";
		$data['id_maju'] = $this->session->userdata('id_maju'); 
		$data['id_mundur'] = $this->session->userdata('id_mundur'); 

		$this->load->view('apel/index',$data);
	}
	
	function getdata(){
			$unor="all";
			$kode=$_POST['kode'];
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
			$lokasi=$_POST['lokasi'];
			$id_apel = $this->session->userdata('id_apel'); 
			$blh = $this->session->userdata('bulan_apel'); 
			$thh = $this->session->userdata('tahun_apel'); 
			$IniApel = $this->m_apel->ini_apel($id_apel);


		$hpp = (strtotime(date('Y-m-d'))-strtotime(date($IniApel->tg_apel))>=0)?"ya":"tidak";
		if($hpp=="ya"){
			$data['count'] = $this->m_apel->hitung_wajib_apel($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$hadir,$lokasi,$id_apel,$blh,$thh);
		} else {
			$data['count'] = $this->m_apel->hitung_wajib_apel_N($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$hadir,$lokasi,$id_apel);
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
			$pangkat = $this->dropdowns->kode_pangkat();
			$golongan = $this->dropdowns->kode_golongan();
			$data['hslquery'] = $this->m_apel->get_wajib_apel($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$hadir,$lokasi,$id_apel,$blh,$thh);

			if($hpp=="ya"){
				$data['hslquery'] = $this->m_apel->get_wajib_apel($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$hadir,$lokasi,$id_apel,$blh,$thh);
			} else {
				$data['hslquery'] = $this->m_apel->get_wajib_apel_N($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$hadir,$lokasi,$id_apel);
			}

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
					$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];


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
		$id_apel = $this->session->userdata('id_apel');
		$hh = $this->m_apel->maju_hari($id_apel);

		$maju = $this->m_apel->get_maju_apel($hh->tanggal_apel);
		$this->session->set_userdata('id_maju',$maju->id_apel); 
		$mundur = $this->m_apel->get_mundur_apel($hh->tanggal_apel);
		$this->session->set_userdata('id_mundur',$mundur->id_apel); 
		$this->session->set_userdata('id_apel',$hh->id_apel); 
	}

	function form_apel_baru(){
		$id_apel = $this->session->userdata('id_apel');
		$data['balik'] = ($id_apel!="")?"ya":"tidak";
		$this->load->view('apel/form_apel_baru',$data);
	}
	function jadual_apel_tambah_aksi(){
		$isi = $_POST;
		$isi['tanggal_apel'] =  date("Y-m-d", strtotime($_POST['tanggal_apel']));
		$id_apel = $this->m_apel->tambah_jadual_apel($isi);
		$this->session->set_userdata('id_apel',$id_apel); 
		echo "sukses";
	}
/*
	function form_apel_edit(){
		$id_apel = $this->session->userdata('id_apel');
		$data['val'] = $this->m_apel->ini_apel($id_apel);
		$this->load->view('apel/form_apel_edit',$data);
	}
	function jadual_apel_edit_aksi(){
		$isi = $_POST;
		$isi['tanggal_apel'] =  date("Y-m-d", strtotime($_POST['tanggal_apel']));
		$id_apel = $this->session->userdata('id_apel');
		$this->m_apel->edit_jadual_apel($id_apel,$isi);
		echo "sukses";
	}
*/
	function daftar_apel(){
		$data['id_apel'] = $this->session->userdata('id_apel');
		$data['lokasi_apel'] = $this->dropdowns->lokasi_apel();
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('apel/daftar_apel',$data);
	}

	function getdaftar(){
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun = $_POST['tahun'];
		$data['count'] = $this->m_apel->hitung_daftar($tahun,$bulan);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$hari = $this->dropdowns->hari_konversi();
			$data['hslquery'] = $this->m_apel->get_daftar($tahun,$bulan);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->hari_apel = $hari[$val->hari_apel];

				$hpp = (strtotime(date('d-m-Y'))-strtotime(date($val->tanggal_apel))>=0)?"ya":"tidak";
				if($hpp=="ya"){
						$data['hslquery'][$key]->wajib_apel	= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->hadir		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->sakit		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","S",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->ijin		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","I",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->cuti		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","C",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->dl			= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","DL",0,$val->id_apel,$bulan,$tahun);
						$data['hslquery'][$key]->tk			= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TK",0,$val->id_apel,$bulan,$tahun);
				} else {
						$data['hslquery'][$key]->wajib_apel	= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","all",0,$val->id_apel);
						$data['hslquery'][$key]->hadir		= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","H",0,$val->id_apel);
						$data['hslquery'][$key]->sakit		= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","S",0,$val->id_apel);
						$data['hslquery'][$key]->ijin		= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","I",0,$val->id_apel);
						$data['hslquery'][$key]->cuti		= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","C",0,$val->id_apel);
						$data['hslquery'][$key]->dl			= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","DL",0,$val->id_apel);
						$data['hslquery'][$key]->tk			= $this->m_apel->hitung_wajib_apel_N("","all","all","","","","","","","","","","all","all","TK",0,$val->id_apel);
				}



			}

		}
		echo json_encode($data);
	}

	function alih(){
		$hari_ini = date('Y-m-d');
		$apel = $this->m_apel->get_akhir_apel($hari_ini);
		if(empty($apel)){
			redirect(site_url("module/appbina/apel/form_apel_baru"));
		} else {
			$akhir = end($apel);
			$this->session->set_userdata('id_apel',$akhir->id_apel); 
			$maju = $this->m_apel->get_maju_apel($hari_ini);
			$this->session->set_userdata('id_maju',$maju->id_apel); 
			$mundur = $this->m_apel->get_mundur_apel($hari_ini);
			$this->session->set_userdata('id_mundur',$mundur->id_apel); 
			redirect(site_url("module/appbina/apel"));
		}
	}

	function pilih(){
		$idd = $_POST['idd'];
		$this->session->set_userdata('id_apel',$idd); 
		$apel = $this->m_apel->ini_apel($idd);

			$maju = $this->m_apel->get_maju_apel($apel->tg_apel);
			$this->session->set_userdata('id_maju',$maju->id_apel); 
			$mundur = $this->m_apel->get_mundur_apel($apel->tg_apel);
			$this->session->set_userdata('id_mundur',$mundur->id_apel); 
		redirect(site_url("module/appbina/apel"));
	}

	function formtambah_wajib_apel(){
		$hari = $this->dropdowns->hari_konversi();
		$id_apel = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($id_apel);
		$data['val']->hari_apel = $hari[$data['val']->hari_apel];

		$tGH = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tGH); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['lokasi_apel'] = $this->dropdowns->lokasi_apel();

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
		$data['lokasi'] = (isset($_POST['lokasi']))?$_POST['lokasi']:"0";
		$this->load->view('apel/formtambah_wajib_apel',$data);
	}

	function XX_getaktif(){
			$id_apel = $this->session->userdata('id_apel');

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

		$data['count'] = $this->m_pegawai->hitung_pegawai($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang);
		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);


		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

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
					$cek = $this->m_apel->cek_wajib($id_apel,$val->id_pegawai);
					$data['hslquery'][$key]->cek = (empty($cek))?"ya":"tidak";
				}
			$data['pager'] = Modules::run("appskp/appskp/pagerB",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function getbelum(){
			$unor="all";
			$kode=$_POST['kode'];
			$ese=$_POST['ese'];
			$pns=$_POST['pns'];
			$pkt=$_POST['pkt'];
			$jbt=$_POST['jbt'];
			$tugas=$_POST['tugas'];
			$gender=$_POST['gender'];
			$agama=$_POST['agama'];
			$status=$_POST['status'];
			$jenjang=$_POST['jenjang'];
			$stt="0";
			$lokasi=0;
			$id_apel = $this->session->userdata('id_apel'); 
			$IniApel = $this->m_apel->ini_apel($id_apel);

		$data['count'] = $this->m_apel->hitung_belum($_POST['cari'],$unor,$kode,$pns,$ese,$pkt,$jbt,$tugas,$gender,$agama,$status,$jenjang,$lokasi,$id_apel);
		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);


		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_apel->get_belum($_POST['cari'],$mulai,$batas,$unor,$kode,$pns,$ese,$pkt,$jbt,$tugas,$gender,$agama,$status,$jenjang,$lokasi,$id_apel);
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
					$cek = $this->m_apel->cek_wajib($id_apel,$val->id_pegawai);
					$data['hslquery'][$key]->cek = (empty($cek))?"ya":"tidak";
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	function wajib_apel_tambah_aksi(){
		if(isset($_POST['id_pegawai'])){
			$isi = $_POST;
			$id_apel = $this->session->userdata('id_apel');
			$id_lokasi = $_POST['lokasi_apel'];
			$this->m_apel->tambah_wajib_apel($id_apel,$id_lokasi,$isi);
			
/// tambahan:: untuk inputan apel sekaligus inputan harian per 8/jul/2016
			$harian = $this->m_harian->ini_harian_by_tanggal($_POST['tanggal_apel']);
			$jam = $this->m_harian->get_jam_kerja(0,2);
			$jamE = $jam[0];
			foreach($_POST['id_pegawai'] AS $key=>$val){
				$this->m_harian->hapus_wajib_hadir($harian->id_harian,$val);
			}
			$this->m_harian->tambah_wajib_hadir($harian->id_harian,$jamE->id_jam,$isi);
/// end tambahan::
		}
		echo "sukses";
	}

	function formcopy_wajib_apel(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_apel'] = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($data['id_apel']);
		$data['val']->hari_apel = $hari[$data['val']->hari_apel];

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');

		$this->load->view('apel/formcopy_wajib_apel',$data);
	}

	function copy_wajib_apel_aksi(){
		$id_apel = $_POST['idd'];
		$id_ini = $this->session->userdata('id_apel'); 
//		$this->m_apel->copy_wajib_apel($id_ini,$id_apel); //diganti sama fungsi dibawah
/// tambahan:: untuk inputan apel sekaligus inputan harian per 8/jul/2016
		$hasil = $this->m_apel->copy_wajib_apel($id_ini,$id_apel);
		$apel = $this->m_apel->ini_apel($id_ini);
		$harian = $this->m_harian->ini_harian_by_tanggal($apel->tg_apel);

		foreach($hasil AS $key=>$val){	
			$isi['id_pegawai'][] = $val->id_pegawai;
			$this->m_harian->hapus_wajib_hadir($harian->id_harian,$val->id_pegawai);
		}		
		$jam = $this->m_harian->get_jam_kerja(0,2);
		$jamE = $jam[0];
		$this->m_harian->tambah_wajib_hadir($harian->id_harian,$jamE->id_jam,$isi);
/// end tambahan::
	}

	function rekap_lokasi(){
		$data['lokasi_apel'] = $this->m_apel->get_lokasi(0,200);

		$hari = $this->dropdowns->hari_konversi();
		$id_apel = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($id_apel);
		$data['keterangan'] = $data['val']->keterangan;
		$data['val']->hari_apel = $hari[$data['val']->hari_apel];

		foreach($data['lokasi_apel'] AS $key=>$val){
			@$data['lokasi_apel'][$key]->wajib = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->hadir = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->sakit = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","S",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->ijin = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","I",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->cuti = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","C",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->dl = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","DL",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key]->tk = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TK",$val->id_lokasi,$id_apel,$data['val']->bulan_apel,$data['val']->tahun_apel);

		}
		$this->load->view('apel/rekap_lokasi',$data);
	}
/*
	function hapus_wajib_apel_aksi(){
		$idd = $_POST['idd'];
		$this->m_apel->hapus_wajib_apel($idd);
		echo "sukses";
	}
*/

	function formhadir_wajib_apel(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['no'];
		$data['ini'] = $this->m_apel->ini_wajib($_POST['idd']);
		$data['ini']->nama_pegawai = ((trim($data['ini']->gelar_depan) != '-')?trim($data['ini']->gelar_depan).' ':'').((trim($data['ini']->gelar_nonakademis) != '-')?trim($data['ini']->gelar_nonakademis).' ':'').$data['ini']->nama_pegawai.((trim($data['ini']->gelar_belakang) != '-')?', '.trim($data['ini']->gelar_belakang):'');

		$this->load->view('apel/formhadir_wajib_apel',$data);
	}
	function hadir_wajib_apel_aksi(){
		$idd = $_POST['idd'];
		$status = $_POST['status'];
		$this->m_apel->hadir_wajib_apel($idd,$status);
		echo "sukses";
	}
	function ijin_wajib_apel_aksi(){
		$idd = $_POST['idd'];
		$status = $_POST['status'];
		$this->m_apel->ijin_wajib_apel($idd,$status);
		echo "sukses";
	}
	function formhapus_semua(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_apel'] = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($data['id_apel']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_apel];
		$tt = explode("-",$data['val']->tg_apel);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();


		$data['lokasi_apel'] = $this->m_apel->get_lokasi(0,200);
		foreach($data['lokasi_apel'] AS $key2=>$val2){
			@$data['lokasi_apel'][$key2]->wajib = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key2]->e2 = $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","all",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key2]->e3 = $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","all",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key2]->e4 = $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","all",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);
			@$data['lokasi_apel'][$key2]->ne = $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","all",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);
//			@$data['lokasi_apel'][$key2]->tk = $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TK",$val2->id_lokasi,$data['id_apel'],$data['val']->bulan_apel,$data['val']->tahun_apel);

		}

		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('apel/formhapus_semua',$data);
	}
	function hapus_semua_aksi(){
		$id_apel = $_POST['id_apel'];
		$id_ini = $this->session->userdata('id_apel'); 
		$this->m_apel->hapus_semua($id_apel);
		echo "sukses";
	}
	function hapus_pil(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_apel'] = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($data['id_apel']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_apel];
		$tt = explode("-",$data['val']->tg_apel);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		foreach($_POST['id_pegawai'] AS $key=>$val){
			$lok = $this->m_apel->ini_apel_pegawai($data['id_apel'],$val);
			@$data['pegawai'][$key] = Modules::run('appbkpp/profile/ini_pegawai',$val);
			@$data['pegawai'][$key]->lokasi = $lok->lokasi;
		}
		$this->load->view('apel/formhapus_pilih',$data);
	}
	function hapus_pil_aksi(){
		$idp = $_POST['id_apel'];
		foreach($_POST['id_pegawai'] AS $key=>$val){
			$this->m_apel->hapus_wajib_apel($idp,$val);
		}
		echo "sukses";
	}
	function pindah_pil(){
		$hari = $this->dropdowns->hari_konversi();
		$data['id_apel'] = $this->session->userdata('id_apel'); 
		$data['val'] = $this->m_apel->ini_apel($data['id_apel']);
		$data['val']->hari_kerja = $hari[$data['val']->hari_apel];
		$tt = explode("-",$data['val']->tg_apel);
		$data['tahun'] = $tt[0];
		$data['bulan'] = str_replace("0","",$tt[1]);
		$data['dwBulan'] = $this->dropdowns->bulan();

		$data['lokasi_apel'] = $this->dropdowns->lokasi_apel();


		foreach($_POST['id_pegawai'] AS $key=>$val){
			$lok = $this->m_apel->ini_apel_pegawai($data['id_apel'],$val);
			@$data['pegawai'][$key] = Modules::run('appbkpp/profile/ini_pegawai',$val);
			@$data['pegawai'][$key]->lokasi = $lok->lokasi;
		}
		$this->load->view('apel/formpindah_pilih',$data);
	}
	function pindah_pil_aksi(){
		$idl = $_POST['lokasi_apel'];
		$idp = $_POST['id_apel'];
		foreach($_POST['id_pegawai'] AS $key=>$val){
			$this->m_apel->pindah_wajib_apel($idl,$idp,$val);
		}
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////////
	function lokasi(){
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';

		$this->load->view('apel/lokasi',$data);
	}

	function getlokasi(){
		$data['count'] = $this->m_apel->hitung_lokasi($_POST['cari']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_apel->get_lokasi($mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$cek = $this->m_apel->cek_lokasi($val->id_lokasi);
				@$data['hslquery'][$key]->hapus = (empty($cek))?"ya":"tidak";
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function formtambah_lokasi(){
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$this->load->view('apel/form_lokasi_tambah',$data);
	}
	function lokasi_tambah_aksi(){
		$this->m_apel->lokasi_tambah($_POST);
		echo "sukses";
	}

	function formedit_lokasi(){
		$data['idd'] = $_POST['idd'];
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['isi'] = $this->m_apel->ini_lokasi($_POST['idd']);
		$this->load->view('apel/form_lokasi_edit',$data);
	}
	function lokasi_edit_aksi(){
		$this->m_apel->lokasi_edit($_POST);
		echo "sukses";
	}

	function formhapus_lokasi(){
		$data['idd'] = $_POST['idd'];
		$data['cari'] = $_POST['cari'];
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['isi'] = $this->m_apel->ini_lokasi($_POST['idd']);
		$this->load->view('apel/form_lokasi_hapus',$data);
	}
	function lokasi_hapus_aksi(){
		$this->m_apel->lokasi_hapus($_POST);
		echo "sukses";
	}
	function edit_keterangan(){
		$idd = $this->session->userdata('id_apel');
		$this->m_apel->edit_keterangan($idd,$_POST['keterangan']);
		echo "sukses";
	}

}
?>