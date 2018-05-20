<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Udin_proses extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_udin');
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
		$data['studin'] = Modules::run("appbangrir/udin_daftar/tahapan_udin");

		$data['satu'] = "Pengajuan Ujian Dinas";
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
		$data['pstudin'] = (isset($_POST['pstudin']))?$_POST['pstudin']:"";

		$this->load->view('udin_proses/'.$rd,$data);
	}
	function alih(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
		$this->session->set_userdata('idd',$_POST['idd']);

		$udin = $this->m_udin->ini_udin($_POST['idd']);
		if($udin->status=="aju"){	$this->m_udin->koreksi_pemohon($_POST['idd']);	}

		redirect("module/appbangrir/udin_proses/ini");
	}
	function ini(){
		$data['satu'] = "Pengajuan Ujian Dinas";
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
		$data['val'] = $this->m_udin->ini_udin($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;
		$data['kode_dokumen'] = Modules::run("appbangrir/udin_daftar/kode_dokumen_udin");

		$data['catatan'] = array();

		$this->load->view('udin_proses/ini',$data);
	}
	function catatan(){
		$idd = $this->session->userdata('idd');
		$data['udin'] = $this->m_udin->ini_udin($idd);
		$data['catatan'] = $this->m_udin->get_catatan($idd);
		$this->load->view('udin_proses/catatan',$data);
	}
	function ini_catatan(){
		$catatan = $this->m_udin->ini_catatan($_POST['id_catatan']);
		echo json_encode($catatan);
	}
	function save_catatan(){
		$idd = $this->session->userdata('idd');
		$this->m_udin->save_catatan($idd,$_POST);
		echo "sukses";
	}
	function save_jawaban(){
		$this->m_udin->save_jawaban($_POST);
		echo "sukses";
	}
	function hapus_catatan(){
		$this->m_udin->hapus_catatan($_POST);
		echo "sukses";
	}
	function jawaban(){
		$idd = $this->session->userdata('idd');
		$data['udin'] = $this->m_udin->ini_udin($idd);
		$data['catatan'] = $this->m_udin->get_catatan($idd);
		$this->load->view('udin_proses/jawaban',$data);
	}
	function ajukan(){
		$data['idd'] = $this->session->userdata('idd');
		$data['ijin'] = $this->m_udin->cek_dokumen($data['idd'],'ijin');
		$data['akreditasi'] = $this->m_udin->cek_dokumen($data['idd'],'akreditasi');
		$data['jadwal'] = $this->m_udin->cek_dokumen($data['idd'],'jadwal');
		$data['catatan'] = $this->m_udin->get_catatan($data['idd'],'ditanya');
		$this->load->view('udin_proses/acc',$data);
	}
	function acc_aksi(){
		$this->m_udin->acc_pemohon($_POST);
		echo "sukses";
	}
	function not_ajukan(){
		$data['idd'] = $this->session->userdata('idd');
		$data['ijin'] = $this->m_udin->cek_dokumen($data['idd'],'ijin');
		$data['akreditasi'] = $this->m_udin->cek_dokumen($data['idd'],'akreditasi');
		$data['jadwal'] = $this->m_udin->cek_dokumen($data['idd'],'jadwal');
		$data['catatan'] = $this->m_udin->get_catatan($data['idd'],'ditanya');
		$this->load->view('udin_proses/btl',$data);
	}
	function btl_aksi(){
		$this->m_udin->btl_pemohon($_POST);
		echo "sukses";
	}

	function upl(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
		$this->session->set_userdata('idd',$_POST['idd']);
		$data['idd'] = $this->session->userdata('idd');
		$data['satu'] = "eDokumen Ujian Dinas";

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
		$data['acc'] = $this->m_udin->ini_acc($data['idd']);
		$data['val'] = $this->m_udin->ini_udin($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;
		$data['kode_dokumen'] = Modules::run("appbangrir/ibel_daftar/kode_dokumen_ibel");
		$this->load->view('udin_proses/upl',$data);
	}
	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $this->session->userdata('idd');
		$data['acc'] = $this->m_udin->ini_acc($data['idd']);
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_ujian_dinas($data['acc']->id_peg_ujian_dinas);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$data['acc']->id_peg_ujian_dinas);
		$this->load->view('udin_proses/upload',$data);
	}

}
?>