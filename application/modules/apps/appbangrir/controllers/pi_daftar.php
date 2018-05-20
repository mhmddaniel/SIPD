<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pi_daftar extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_pi');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
  function tahapan_pi($asRef=false)  {
    $select ['buat'] = 'Pembuatan Pengajuan Penyesuaian Ijazah';
    $select ['draft'] = 'Pengisian Formulir Penyesuaian Ijazah';
    $select ['aju'] = 'Pengajuan Penyesuaian Ijazah';
    $select ['koreksi'] = 'Koreksi Pengajuan Penyesuaian Ijazah';
    $select ['revisi'] = 'Perbaikan Pengajuan Penyesuaian Ijazah';
    $select ['acc'] = 'Persetujuan Penyesuaian Ijazah';
    return $select;
  }
  function kode_dokumen_pi($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Jenis Dokumen';	}else{	$select [''] = '-';	}
    $select ['ijin'] = 'Ijin Pimpinan';
    $select ['akreditasi'] = 'Sertifikat Akreditasi Sekolah';
    $select ['jadwal'] = 'Keterangan Jadwal Sekolah';
    $select ['ijazah_pendidikan'] = 'Riwayat Pendidikan';
    $select ['sk_cpns'] = 'SK CPNS';
    $select ['sk_pangkat'] = 'SK PANGKAT';
    $select ['skp'] = 'SKP';

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
		$data['stpi'] = Modules::run("appbangrir/pi_daftar/tahapan_pi");

		$data['satu'] = "Pengajuan Penyesuaian Ijazah";
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
		$data['pstpi'] = (isset($_POST['pstpi']))?$_POST['pstpi']:"";

		$this->load->view('pi_daftar/index',$data);
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
			$stpi=$_POST['stpi'];
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$dWtahapan = $this->tahapan_pi();
			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];
			$data['count'] = $this->m_pi->hitung_pi($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$stpi);


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

			$data['hslquery'] = $this->m_pi->get_pi($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$stpi);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime(@$val->tmt_cpns));
				$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime(@$val->tmt_pns));
//				$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
//				$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
				$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				$data['hslquery'][$key]->gambar = ($val->status=="acc" || $val->status=="injek")?"ya":"tidak";
				$data['hslquery'][$key]->tahapan = ($val->status=="injek")?"injek":$dWtahapan[$val->status];
				$data['hslquery'][$key]->hapus = $this->cek_dok($val->id_pi);
				$data['hslquery'][$key]->tg_aju = ($val->tg_aju==null)?"...":$val->tg_aju;
				$data['hslquery'][$key]->tg_koreksi = ($val->tg_koreksi==null)?"...":$val->tg_koreksi;

				$ibel = Modules::run("appbangrir/ibel_daftar/ini_acc",$val->id_ibel);
				if(empty($ibel)){
					@$ibel['nomor_surat'] = "...";
					@$ibel['tg_surat'] = "...";
					@$ibel['nama_jenjang'] = "...";
					@$ibel['nama_pendidikan'] = "...";
					@$ibel['nama_sekolah'] = "...";
					@$ibel['lokasi_sekolah'] = "...";
				}
				$data['hslquery'][$key]->ibel = $ibel;

				$accIb = $this->m_pi->ini_acc($val->id_pi);
				if(empty($accIb)){
					@$acc['nomor_surat'] = "...";
					@$acc['tanggal_surat'] = "...";
					@$acc['editable'] = "yes";
					@$acc['thumb'] = "assets/file/foto/photo.jpg";
					@$acc['idd'] = "";
				} else {
					@$acc['nomor_surat'] = @$accIb->nomor_sertifikat;
					@$acc['tanggal_surat'] = date("d-m-Y", strtotime(@$accIb->tanggal_sertifikat));
					@$acc['editable'] = "yes";
					@$acc['thumb'] = $this->ini_thumb($val->nip_baru,$accIb->id_peg_penyesuaian_ijazah);
					@$acc['idd'] = $accIb->id_peg_penyesuaian_ijazah;
				}
				$data['hslquery'][$key]->accIb = $acc;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	function cek_dok($idd){
		$this->db->from('r_peg_penyesuaian_ijazah_dokumen');
		$this->db->where('id_pi',$idd);
		$data = $this->db->get()->result();
		$hps = (empty($data))?"ya":"tidak";
		return $hps;
	}
	function ini_thumb($nip,$idd){
		$gbr = $this->m_edok->cek_dokumen($nip,"penyesuaian_ijazah",$idd);
		$gambar = (empty($gbr))?"assets/file/foto/photo.jpg":"assets/media/file/".$nip."/penyesuaian_ijazah/thumb_".$gbr[0]->file_dokumen;
		return $gambar;
	}
	function form_tambah(){
		$this->load->view('pi_daftar/form_tambah');
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

		$data['ibel'] = (empty($data['val']))?array():Modules::run("appbangrir/ibel_daftar/get_ibel_riwayat",$data['val']->id_pegawai);

		$this->load->view('pi_daftar/form_tambah_nip',$data);
	}
	function tambah_aksi(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$_POST['id_pegawai']);
		$peg = $this->db->get()->row();
		$id_pi = $this->m_pi->tambah_pemohon($peg,$_POST['id_ibel'],$_POST['nomor_ijazah'],$_POST['tanggal_ijazah']);
		echo "sukses";
	}
	function form_hapus(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_pi->ini_pi($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$this->load->view('pi_daftar/form_hapus',$data);
	}
	function hapus_aksi(){
		$this->db->where('id_pi',$_POST['id_pi']);
		$this->db->delete('r_peg_penyesuaian_ijazah_aju');
		$this->db->where('id_pi',$_POST['id_pi']);
		$this->db->delete('r_peg_penyesuaian_ijazah');
//		$this->db->where('id_ibel',$_POST['id_ibel']);
//		$this->db->delete('r_peg_ibel_sekolah');
		echo "sukses";
	}
	function ajukan(){
		$data['idd'] = $this->session->userdata('idd');

		$data['ijin'] = $this->m_pi->cek_dokumen($data['idd'],'ijin');
		$data['akreditasi'] = $this->m_pi->cek_dokumen($data['idd'],'akreditasi');
		$data['jadwal'] = $this->m_pi->cek_dokumen($data['idd'],'jadwal');
		$data['catatan'] = $this->m_pi->get_catatan($data['idd'],'ditanya');

		$this->load->view('pi_daftar/form_ajukan',$data);
	}

	function ajukan_aksi(){
		$this->m_pi->ajukan_pemohon($_POST['id_pi']);
		echo "sukses";
	}

	function form_sekolah(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_pi->ini_pi($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['ibel'] = Modules::run("appbangrir/ibel_daftar/get_ibel_riwayat",$data['val']->id_pegawai);

		$this->load->view('pi_daftar/form_tambah_nip',$data);
	}
	function sekolah_aksi(){
		$this->m_pi->edit_pemohon($_POST);
		echo "sukses";
	}

}
?>