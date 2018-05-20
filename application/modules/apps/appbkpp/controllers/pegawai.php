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
	function index(){
		$data['satu'] = "Daftar Master Pegawai";
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

		$this->load->view('pegawai/index',$data);
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
							@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
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
	function aktif(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "aktif_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="absensor_unit") {
			$rd = "aktif_absensor_unit";
		} elseif($group_name=="mutasi") {
			$rd = "aktif_mutasi";
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
		$this->dansec->htmlReq();
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

			$jenis=(isset($_POST['jenis']))?$_POST['jenis']:"pns";

			$kode=$_POST['kode'];
			$pkt=($jenis=='pns')?$_POST['pkt']:"";
			$jbt=($jenis=='pns')?$_POST['jbt']:"";
			$ese=($jenis=='pns')?$_POST['ese']:"";
			$tugas=($jenis=='pns')?$_POST['tugas']:"";
			$gender=$_POST['gender'];
			$agama=($jenis=='pns')?$_POST['agama']:"";
			$status=($jenis=='pns')?$_POST['status']:"";
			$jenjang=($jenis=='pns')?$_POST['jenjang']:"";
			$umur=($jenis=='pns')?$_POST['umur']:"";
			$mkcpns=($jenis=='pns')?$_POST['mkcpns']:"";
			$jPns = ($jenis=='pns')?$_POST['pns']:"all";

			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$bulan = $_POST['bulan'];
			$tahun=$_POST['tahun'];

		$data['utmAct'] = ($tahun."-".$bulan==date('Y-n'))?"ya":"tidak";
		$data['count'] = $this->m_pegawai->hitung_pegawai_bulanan($_POST['cari'],$jPns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);

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


			$data['hslquery'] = $this->m_pegawai->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$jPns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$bulan,$tahun,$jenis);

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
		
							@$pendidikan = end(@$pend);
							$data['hslquery'][$key]->nama_jenjang = (isset($pendidikan->nama_jenjang))?$pendidikan->nama_jenjang:"-";
							$data['hslquery'][$key]->nama_sekolah = (isset($pendidikan->nama_sekolah))?$pendidikan->nama_sekolah:"-";
							$data['hslquery'][$key]->tanggal_lulus = (isset($pendidikan->tanggal_lulus))?date("d-m-Y", strtotime($pendidikan->tanggal_lulus)):"-";
		
							@$jabatan = end(@$jab);
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
			if($jenis=="jfu"){
				$tanggal = date("Y-m-d", strtotime(@$_POST['tanggal']));
				$kode = @$_POST['kode_unor'].".";
				$sqlstr="SELECT COUNT(a.id_unor) AS numrows FROM (m_unor a)	WHERE a.kode_unor LIKE '$kode%' AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
				$query = $this->db->query($sqlstr)->row();
				if($query->numrows>0){
						$data['pesan']="<font color='#f00'><h2>UNIT KERJA SALAH !</h2><br>Untuk <b>JABATAN FUNGSIONAL UMUM</b> harus ditempatkan pada:<br><h3>Unit Kerja Terkecil</h3></font>";
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
			} else {
				$batas=$_POST['batas'];
				$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
				$mulai=($hal-1)*$batas;
				$data['mulai']=$mulai+1;
				$data['hslquery'] = $this->m_pegawai->get_jfu($cari,$jenis,$mulai,$batas);
				$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
				$data['pesan']="";
			}
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
				$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
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
		FROM r_pegawai_aktual WHERE 
		IF(kode_ese='22' OR jab_type='jft-guru' OR nomenklatur_jabatan LIKE 'PENGAWAS SEKOLAH%',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		AND status_kepegawaian='pns'
		$iGD $iJT";
		$query = $this->db->query($sqlstr)->row();
		return $query->numrows;
	}
	function prediksi_pensiun($mulai,$batas,$tahun,$jt,$gg,$cari){
		$iJT = ($jt=="guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$iGD = ($gg=="l")?"AND gender='l'":(($gg=="p")?"AND gender='p'":"");
		$tt = $tahun;
		$sqlstr="SELECT *
		FROM r_pegawai_aktual WHERE 
		IF(kode_ese='22' OR jab_type='jft-guru' OR nomenklatur_jabatan LIKE 'PENGAWAS SEKOLAH%',('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM tanggal_lahir)=58))
		AND  (
		nip_baru LIKE '$cari%'
		OR nama_pegawai LIKE '%$cari%'
		OR nomenklatur_pada LIKE '%$cari%'
		OR kode_unor LIKE '$cari%'
		)
		AND status_kepegawaian='pns'
		$iGD $iJT
		ORDER BY nip_baru ASC,jab_type ASC
		LIMIT $mulai,$batas";
		$query = $this->db->query($sqlstr)->result();
		return $query;
	}
///////////////////////////////////////////////////////////////////////////////////
	function meninggal(){
		$sess = $this->session->userdata('logged_in');
		$data['grup'] = $sess['group_name'];

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
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
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
/////////////////////////////////////////////////////////////////////////////////////////////////////
	function cltn(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";
/*
		$sq = "SELECT * FROM r_pegawai_cltn";
		$hs = $this->db->query($sq)->result();
		foreach($hs AS $key=>$val){
			$sqA = "SELECT id_pegawai,nip_baru,status_kepegawaian FROM r_pegawai WHERE nama_pegawai='".$val->nama_pegawai."' AND tempat_lahir='".$val->tempat_lahir."' AND tanggal_lahir='".$val->tanggal_lahir."'";
			$hsA = $this->db->query($sqA)->row();

			$this->db->set('id_pegawai',$hsA->id_pegawai);
			$this->db->set('nip_baru',$hsA->nip_baru);
			$this->db->set('status_kepegawaian',$hsA->status_kepegawaian);
			$this->db->where('id',$val->id);
			$this->db->update('r_pegawai_cltn');
		}
*/
		$this->load->view('pegawai/formsub_cltn',$data);
	}
	function getsub_cltn(){
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"pagingB";
		$cari = $_POST['cari'];
		$sub = $_POST['sub'];
		$data['count'] = $this->m_pegawai->hitung_pegawai_cltn($cari,$sub);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_pegawai->get_pegawai_cltn($cari,$mulai,$batas,$sub);
			foreach($hslquery AS $key=>$row){
					@$data['hslquery'][$key] = $row;
					@$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
					@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
					@$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($row->tanggal_lahir));
					@$data['hslquery'][$key]->tmt_cpns =  date("d-m-Y", strtotime($row->tmt_cpns));
					@$data['hslquery'][$key]->tmt_pns =  date("d-m-Y", strtotime($row->tmt_pns));
					@$data['hslquery'][$key]->tmt_pangkat =  date("d-m-Y", strtotime($row->tmt_pangkat));
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function formsub_cltn_tambah(){
		$data['idd'] = $_POST['idd'];
		$data['nomor'] = $_POST['nomor'];
		$this->load->view('pegawai/formsub_'.$_POST['sub'].'_update',$data);
	}
	function formsub_cltn_tambah_aksi(){
//			$peg = $this->m_pegawai->ini_pegawai($_POST['id_pegawai']);
			$peg = Modules::run("appbkpp/profile/ini_pegawai",$_POST['id_pegawai']);
//			$peg = json_encode($peg);
			$this->m_pegawai->cltn_tambah_aksi($_POST,$peg);
		echo "success";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
	function keluar(){
		$sess = $this->session->userdata('logged_in');
		$data['grup'] = $sess['group_name'];

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
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
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
		$sess = $this->session->userdata('logged_in');
		$data['grup'] = $sess['group_name'];

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
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$row->nip_baru);
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

}
?>