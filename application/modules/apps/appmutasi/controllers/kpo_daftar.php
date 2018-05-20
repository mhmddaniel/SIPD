<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Kpo_daftar extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appmutasi/m_kpo');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
  function tahapan_kpo($asRef=false)  {
    $select ['buat'] = 'Pembuatan Pengajuan Kenaikan Pangkat';
    $select ['draft'] = 'Pengisian Formulir Kenaikan Pangkat';
    $select ['aju'] = 'Pengajuan Kenaikan Pangkat';
    $select ['koreksi'] = 'Koreksi Pengajuan Kenaikan Pangkat';
    $select ['revisi'] = 'Perbaikan Pengajuan Kenaikan Pangkat';
    $select ['acc'] = 'Penerbitan SK Pangkat';
    return $select;
  }
  function kode_dokumen_kpo($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Jenis Dokumen';	}else{	$select [''] = '-';	}
    $select ['ijin'] = 'IJIN/PENGANTAR PIMPINAN';
    $select ['karpeg'] = 'KARTU PEGAWAI';
    $select ['konversi_nip'] = 'SK. KONVERSI NIP';
    $select ['sk_cpns'] = 'SK CPNS';
    $select ['sk_pns'] = 'SK PNS';
    $select ['sk_pangkat'] = 'SK PANGKAT';
    $select ['pak'] = 'SK. PENETAPAN ANGKA KREDIT';
    $select ['skp'] = 'SKP';

    return $select;
  }
  function bulan_kpo($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih bulan';	}else{	$select [''] = '-';	}
    $select ['4'] = 'April';
    $select ['10'] = 'Oktober';
    return $select;
  }
  function tahun_kpo($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih tahun';	}else{	$select [''] = '-';	}
	$tNow = date('Y');
	$tNext = $tNow+1;
    $select [$tNow] = $tNow;
    $select [$tNext] = $tNext;
    return $select;
  }
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "index_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} else {
			$rd = "index";
		}

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
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
		$data['stib'] = Modules::run("appmutasi/kpo_daftar/tahapan_kpo");

		$data['satu'] = "Pengajuan Kenaikan Pangkat";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['pkt']))?$_POST['pkt']:"";
		$data['pjbt'] = (isset($_POST['jbt']))?$_POST['jbt']:"";
		$data['pese'] = (isset($_POST['ese']))?$_POST['ese']:"";
		$data['ptugas'] = (isset($_POST['tugas']))?$_POST['tugas']:"";
		$data['pagama'] = (isset($_POST['agama']))?$_POST['agama']:"";
		$data['pgender'] = (isset($_POST['gender']))?$_POST['gender']:"";
		$data['pstatus'] = (isset($_POST['status']))?$_POST['status']:"";
		$data['pjenjang'] = (isset($_POST['jenjang']))?$_POST['jenjang']:"";
		$data['pumur'] = (isset($_POST['umur']))?$_POST['umur']:"";
		$data['pmkcpns'] = (isset($_POST['mkcpns']))?$_POST['mkcpns']:"";
		$data['pstib'] = (isset($_POST['pstib']))?$_POST['pstib']:"";

		$this->load->view('kpo_daftar/'.$rd,$data);
	}


	function getdata(){
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
			$stib=$_POST['stib'];
			$dWjenis = $this->dropdowns->kode_jenis_kp();
			$dWbulan = $this->dropdowns->bulan();
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$dWtahapan = $this->tahapan_kpo();
			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];
			$data['count'] = $this->m_kpo->hitung_kpo($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$stib);


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

			$data['hslquery'] = $this->m_kpo->get_kpo($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$stib);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				$data['hslquery'][$key]->gambar = ($val->status=="acc" || $val->status=="injek")?"ya":"tidak";
				$data['hslquery'][$key]->tahapan = ($val->status=="injek")?"injek":$dWtahapan[$val->status];
				$data['hslquery'][$key]->hapus = $this->cek_dok($val->id_kpo);
				$data['hslquery'][$key]->tg_aju = ($val->tg_aju==null)?"...":$val->tg_aju;
				$data['hslquery'][$key]->tg_koreksi = ($val->tg_koreksi==null)?"...":$val->tg_koreksi;
				$data['hslquery'][$key]->pangkat_aju = @$dWpangkat[$val->kode_golongan_aju]." / ".@$dWgolongan[$val->kode_golongan_aju];
				$data['hslquery'][$key]->bulan_periode = @$dWbulan[$val->bulan_periode];
				$data['hslquery'][$key]->jenis_kpo = @$dWjenis[$val->kode_jenis_kpo];

				$accIb = $this->m_kpo->ini_kpo($val->id_kpo);
				if(empty($accIb)){
					@$acc['nomor_surat'] = "...";
					@$acc['tanggal_surat'] = "...";
					@$acc['editable'] = "yes";
					@$acc['thumb'] = "assets/file/foto/photo.jpg";
					@$acc['idd'] = "";
				} else {
					@$acc['nomor_surat'] = $accIb->sk_nomor;
					@$acc['tanggal_surat'] = date("d-m-Y", strtotime($accIb->sk_tanggal));
					@$acc['editable'] = "yes";
					@$acc['thumb'] = $this->ini_thumb($val->nip_baru,$accIb->id_peg_golongan);
					@$acc['idd'] = $accIb->id_kpo;
				}
				$data['hslquery'][$key]->accIb = $acc;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	
	
	function cek_dok($idd){
		$this->db->from('r_peg_kpo_dokumen');
		$this->db->where('id_kpo',$idd);
		$data = $this->db->get()->result();
		$hps = (empty($data))?"ya":"tidak";
		return $hps;
	}
	function ini_thumb($nip,$idd){
		$gbr = $this->m_edok->cek_dokumen($nip,"sk_pangkat",$idd);
		$gambar = (empty($gbr))?"assets/file/foto/photo.jpg":"assets/media/file/".$nip."/sk_pangkat/thumb_".$gbr[0]->file_dokumen;
		return $gambar;
	}

	function form_tambah(){
		$this->load->view('kpo_daftar/form_tambah');
	}
	function cari_nip(){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			$unor = explode(",",$unor);

		$this->db->from('r_pegawai_aktual');
		$this->db->where_in('id_unor',$unor);
		$this->db->where('nip_baru',$_POST['nip']);
		$data['val'] = $this->db->get()->row();
		$data['tahun_kpo'] = $this->tahun_kpo();
		$data['bulan_kpo'] = $this->bulan_kpo();
		$this->load->view('kpo_daftar/form_tambah_nip',$data);
	}
	function tambah_aksi(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$_POST['id_pegawai']);
		$peg = $this->db->get()->row();

		$peg->id_peg_golongan = $this->m_kpo->golongan_tambah($_POST);
		$peg->kode_jenis_kpo = $_POST['kode_jenis_kpo'];
		$peg->kode_golongan_aju = $_POST['kode_golongan_aju'];
		$peg->tahun_periode = $_POST['tahun_periode'];
		$peg->bulan_periode = $_POST['bulan_periode'];
		$this->m_kpo->tambah_pemohon($peg);
		echo "sukses";
	}
	function form_hapus(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['hapus'] = "ya";
		$data['tahun_kpo'] = $this->tahun_kpo();
		$data['bulan_kpo'] = $this->bulan_kpo();
		$data['val'] = $this->m_kpo->ini_kpo($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$this->load->view('kpo_daftar/form_tambah_nip',$data);
	}
	function hapus_aksi(){
		$ini = $this->m_kpo->ini_kpo($_POST['id_kpo']);
		$this->db->where('id_kpo',$_POST['id_kpo']);
		$this->db->delete('r_peg_kpo_aju');
		$this->db->where('id_peg_golongan',$ini->id_peg_golongan);
		$this->db->delete('r_peg_golongan');
		echo "sukses";
	}
	function ajukan(){
		$data['idd'] = $this->session->userdata('idd');
		$data['ijin'] = $this->m_kpo->cek_dokumen($data['idd'],'ijin');
		$data['catatan'] = $this->m_kpo->get_catatan($data['idd'],'ditanya');

		$this->load->view('kpo_daftar/form_ajukan',$data);
	}

	function ajukan_aksi(){
		$this->m_kpo->ajukan_pemohon($_POST['id_kpo']);
		echo "sukses";
	}

	function form_edit(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['tahun_kpo'] = $this->tahun_kpo();
		$data['bulan_kpo'] = $this->bulan_kpo();
		$data['val'] = $this->m_kpo->ini_kpo($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$this->load->view('kpo_daftar/form_tambah_nip',$data);
	}

	function edit_aksi(){
		$this->m_kpo->kpo_edit($_POST);
		echo "sukses";
	}
	
	function get_ibel_riwayat($id_peg){
		$ibel = $this->m_ibel->get_ibel_riwayat($id_peg);
		return $ibel;
	}
	function ini_ibel($idib){
		$ibel = $this->m_ibel->ini_ibel($idib);
		return $ibel;
	}
	function ini_acc($idib){
		$ibel = $this->m_ibel->ini_acc($idib);
		$sekolah = $this->m_ibel->ini_sekolah($idib);
					@$ibel->nama_jenjang = @$sekolah->nama_jenjang;
					@$ibel->nama_pendidikan = @$sekolah->nama_pendidikan;
					@$ibel->nama_sekolah = @$sekolah->nama_sekolah;
					@$ibel->lokasi_sekolah = @$sekolah->lokasi_sekolah;
		return $ibel;
	}

}
?>