<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cuti_proses extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('appbina/m_cuti');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_profil');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
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
		$data['stib'] = Modules::run("appbina/cuti/tahapan_cuti");

		$data['satu'] = "Pengajuan Cuti";
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
		$data['pstib'] = (isset($_POST['pstib']))?$_POST['pstib']:"";

		$this->load->view('cuti_proses/'.$rd,$data);
	}
	function alih(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
		$this->session->set_userdata('idd',$_POST['idd']);

		$ibel = $this->m_cuti->ini_cuti($_POST['idd']);
		if($ibel->status=="aju"){	$this->m_cuti->koreksi_pemohon($_POST['idd']);	}

		redirect("module/appbina/cuti_proses/ini");
	}
	function ini(){
		$data['satu'] = "Pengajuan Cuti";
		$data['cari'] = $this->session->userdata('cari');
		$data['batas'] = $this->session->userdata('batas');
		$data['hal'] = $this->session->userdata('hal');
		$data['asal'] = $this->session->userdata('asal');
		$data['kode'] = $this->session->userdata('kode');
		$data['pns'] = $this->session->userdata('pns');
		$data['pkt'] = $this->session->userdata('pkt');
		$data['jbt'] = $this->session->userdata('jbt');
		$data['ese'] = $this->session->userdata('ese');
		$data['tugas'] = $this->session->userdata('tugas');
		$data['gender'] = $this->session->userdata('gender');
		$data['agama'] = $this->session->userdata('agama');
		$data['status'] = $this->session->userdata('status');
		$data['jenjang'] = $this->session->userdata('jenjang');
		$data['umur'] = $this->session->userdata('umur');
		$data['mkcpns'] = $this->session->userdata('mkcpns');
		$data['idd'] = $this->session->userdata('idd');


			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$data['jenis'] = $this->dropdowns->kode_jenis_cuti();
			$dTujuan = $this->dropdowns->kode_jenis_tujuan();
			
			//$data['bulan'] = $this->dropdowns->bulan();
		$data['val'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$data['val']->kode_jenis_tujuan = @$dTujuan[$data['val']->kode_tujuan];
		$data['val']->pangkat_aju = @$dWpangkat[$data['val']->kode_golongan_aju]." / ".@$dWgolongan[$data['val']->kode_golongan_aju];
		//$data['val']->kode_jenis_cuti = @$dCuti[$data['val']->kode_jenis_cuti];
			if(!empty($data['val']->kode_tujuan)){
			$data['val']->kode_tujuan = @$dTujuan[$data['val']->kode_tujuan];}
			else {
			$data['val']->kode_tujuan ="";	
			}
		$data['id_pegawai'] = $data['val']->id_pegawai;
		if($data['val']->kode_jenis_cuti==1){
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_sakit");
		} else if($data['val']->kode_jenis_cuti==2 || $data['val']->kode_jenis_cuti==3 || $data['val']->kode_jenis_cuti==4 ) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_besar");
		} else if($data['val']->kode_jenis_cuti==5) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_alasan_penting");
		} else if($data['val']->kode_jenis_cuti==6) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_bersalin");
		} else if($data['val']->kode_jenis_cuti==7) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_tahunan");
		} else if($data['val']->kode_jenis_cuti==8) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_diluar_tanggungan_negara");
		}
		$data['catatan'] = array();

		$this->load->view('cuti_proses/ini',$data);
	}
	function catatan(){
		$idd = $this->session->userdata('idd');
		$data['ibel'] = $this->m_cuti->ini_cuti($idd);
		$data['catatan'] = $this->m_cuti->get_catatan($idd);
		$this->load->view('cuti_proses/catatan',$data);
	}
	function ini_catatan(){
		$catatan = $this->m_cuti->ini_catatan($_POST['id_catatan']);
		echo json_encode($catatan);
	}
	function save_catatan(){
		$idd = $this->session->userdata('idd');
		$this->m_cuti->save_catatan($idd,$_POST);
		echo "sukses";
	}
	function save_jawaban(){
		$this->m_cuti->save_jawaban($_POST);
		echo "sukses";
	}
	function hapus_catatan(){
		$this->m_cuti->hapus_catatan($_POST);
		echo "sukses";
	}
	function jawaban(){
		$idd = $this->session->userdata('idd');
		$data['ibel'] = $this->m_cuti->ini_cuti($idd);
		$data['catatan'] = $this->m_cuti->get_catatan($idd);
		$this->load->view('cuti_proses/jawaban',$data);
	}
	function ajukan(){
		$data['idd'] = $this->session->userdata('idd');
		$data['ijin'] = $this->m_cuti->cek_dokumen($data['idd'],'ijin');
		$data['catatan'] = $this->m_cuti->get_catatan($data['idd'],'ditanya');
		$this->load->view('cuti_proses/acc',$data);
	}
	function acc_aksi(){
		$this->m_cuti->acc_pemohon($_POST);
		echo "sukses";
	}
	
	function edit_sk(){
		$data['idd'] = $this->session->userdata('idd');
		$data['isi'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['edit'] = "ya";
		$data['ijin'] = $this->m_cuti->cek_dokumen($data['idd'],'ijin');
		$data['catatan'] = $this->m_cuti->get_catatan($data['idd'],'ditanya');
		$this->load->view('cuti_proses/acc',$data);
	}

	function not_ajukan(){
		$data['idd'] = $this->session->userdata('idd');
		$data['ijin'] = $this->m_cuti->cek_dokumen($data['idd'],'ijin');
		$data['catatan'] = $this->m_cuti->get_catatan($data['idd'],'ditanya');
		$this->load->view('cuti_proses/btl',$data);
	}
	function btl_aksi(){
		$this->m_cuti->btl_pemohon($_POST);
		echo "sukses";
	}

	function upl(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
		$this->session->set_userdata('idd',$_POST['idd']);
		$data['idd'] = $this->session->userdata('idd');
		$data['satu'] = "eDokumen CUTI";


		$data['cari'] = $this->session->userdata('cari');
		$data['batas'] = $this->session->userdata('batas');
		$data['hal'] = $this->session->userdata('hal');
		$data['asal'] = $this->session->userdata('asal');
		$data['kode'] = $this->session->userdata('kode');
		$data['pns'] = $this->session->userdata('pns');
		$data['pkt'] = $this->session->userdata('pkt');
		$data['jbt'] = $this->session->userdata('jbt');
		$data['ese'] = $this->session->userdata('ese');
		$data['tugas'] = $this->session->userdata('tugas');
		$data['gender'] = $this->session->userdata('gender');
		$data['agama'] = $this->session->userdata('agama');
		$data['status'] = $this->session->userdata('status');
		$data['jenjang'] = $this->session->userdata('jenjang');
		$data['umur'] = $this->session->userdata('umur');
		$data['mkcpns'] = $this->session->userdata('mkcpns');
		$data['idd'] = $this->session->userdata('idd');


			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['acc'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['val'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;
		$data['kode_dokumen'] = Modules::run("appbangrir/cuti/kode_dokumen_cuti");
		$this->load->view('cuti_proses/upl',$data);
	}
	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $this->session->userdata('idd');
		$data['acc'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_cuti_riwayat($data['acc']->id_peg_cuti);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$data['acc']->id_peg_cuti);
		$this->load->view('cuti_proses/upload',$data);
	}

}
?>