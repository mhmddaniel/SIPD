<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rencana extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_profil');
	}
////////////////////////////////////////////////////////////	
	function index(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$tpp = $this->m_tukin->get_tpp_last($id_pegawai);
		if(empty($tpp)){
			redirect("module/apptukin/rencana/baru");
		} else {
			$this->session->set_userdata("id_tpp",$tpp->id_tpp);
			$this->session->set_userdata("bulan_pilih","total");
			redirect("module/apptukin/rencana/aktif");
		}
	}
	
	function baru(){
		$data['title'] = "Penyusunan Rencana Kerja Pegawai";
		$this->load->view('rencana/form_tpp_baru',$data);
	}
	
	function aktif(){
		$data['title'] = "Penyusunan Rencana Kerja Pegawai";
		$id_tpp= $this->session->userdata('id_tpp');

		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
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
		$this->load->view('rencana/index',$data);
	}
	
	function form_tpp_baru(){
		$data['idd'] = $_POST['idd'];
		$this->load->view('rencana/form_tpp',$data);
	}

	function form_tpp_edit(){
		$data['idd'] = $_POST['idd'];
		$data['isi'] = $this->m_tukin->ini_tpp($_POST['idd']);
		$penilai = $this->m_tukin->get_pegawai($data['isi']->id_penilai);
		$data['isi']->penilai = $penilai->nip_baru;
		
		$this->load->view('rencana/form_tpp',$data);
	}
	
	function form_aksi_tpp(){
 		$this->form_validation->set_rules("tahun","Tahun","trim|required|xss_clean");
 		$this->form_validation->set_rules("bulan_mulai","Bulan Awal Periode","trim|required|xss_clean");
 		$this->form_validation->set_rules("bulan_selesai","Bulan Akhir Periode","trim|required|xss_clean");
		$this->form_validation->set_rules("penilai","Pejabat Penilai","trim|required|xss_clean");
		if($this->form_validation->run()) {
				$id_pegawai = $this->session->userdata('pegawai_info');
				$pegawai = $this->m_tukin->get_pegawai($id_pegawai);
				$penilai = $this->m_tukin->get_pegawai_by_nip($_POST['penilai']);
				$bulan = $this->dropdowns->bulan();

				if($_POST['id_tpp']==""){
					$ddir=$this->m_tukin->set_tpp($_POST,$pegawai,$penilai);
					$this->session->set_userdata("id_tpp",$ddir);
					$data->aksi="tambah";
				} else {
					$ddir=$this->m_tukin->set_tpp($_POST,$pegawai,$penilai);
					$data->aksi="edit";
				}
				echo json_encode($data);

		 } else {
		 	$alert = validation_errors();
			$alert = str_replace("The","",$alert);
			$alert = str_replace("field is required","harus di isi",$alert);
			echo "<strong><u>Terjadi Kesalahan</u></strong> :<p></p>".$alert;	
		 }
	}
	function form_tpp_hapus(){
		$data['tpp'] = $this->m_tukin->ini_tpp($_POST['idd']);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['target'] = $this->m_tukin->get_target($_POST['idd']);
		$this->load->view('rencana/form_tpp_hapus',$data);
	}
	function hapus_tpp()	{
		$this->m_tukin->hapus_tpp($_POST);
		redirect("module/apptukin/rencana");
	}
	function alih_tpp(){
		$this->session->set_userdata("id_tpp",$_POST['idd']);
		echo "success";
	}
	function alih2(){
		$this->session->set_userdata("id_tpp",$_POST['idd']);
		$this->session->set_userdata("bulan_pilih",$_POST['bulan']);
		redirect("module/apptukin/rencana/aktif");
	}
	function arsip(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['tpp'] = $this->m_tukin->get_tpp($id_pegawai);
				$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$this->load->view('rencana/arsip',$data);
	}	
//////////////////////////////////////////////////////////////////////////////////////	
	function tambahtarget(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$tpp = $this->m_tukin->ini_tpp($data['id_tpp']);
		for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
			$data['bulan_pil'][] = $i;
		}

		$data['no'] = $_POST['no'];
		$data['id_target'] = ($_POST['idd']=="xx")?"":$_POST['idd'];
		$data['avail'] = ($tpp->status=="draft" or $tpp->status=="revisi_penilai" or $tpp->status=="revisi_verifikatur")?"yes":"no";

		$this->load->view('rencana/form_target',$data);
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

		$this->load->view('rencana/form_target',$data);
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

		$this->load->view('rencana/form_target',$data);
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
	function track()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$data['tahapan_tpp_nomor'] = $tahapan_tpp_nomor[$data['tpp']->status];	
		
		$this->load->view('rencana/track',$data);
	}
	function form_tpp_ajupenilai(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['target'] = $this->m_tukin->get_target($id_tpp);
		$data['catatan'] = $this->m_tukin->get_catatan($id_tpp);
		$this->load->view('rencana/form_tpp_ajupenilai',$data);
	}
	
	function aju_penilai()	{
		$_POST['id_tpp'] = $this->session->userdata('id_tpp');
		$ddir=$this->m_tukin->aju_penilai($_POST);
		redirect("module/apptukin/rencana/aktif");
	}
/////////////////////////////////////////////////////////////////////////////////////////////
	function input_jawaban(){
		$data['isi'] = $this->m_tukin->ini_catatan($_POST['idd']);
		$this->load->view('rencana/form_jawaban',$data);
	}
	function input_jawaban_aksi(){
		$this->m_tukin->input_jawaban($_POST);
		redirect("module/apptukin/rencana/aktif");
	}
	function edit_jawaban(){
		$data['isi'] = $this->m_tukin->ini_catatan($_POST['idd']);
		$data['jj'] = $this->m_tukin->ini_jawaban($_POST['no']);
		$this->load->view('rencana/form_jawaban',$data);
	}
	function edit_jawaban_aksi(){
		$this->m_tukin->edit_jawaban($_POST);
		redirect("module/apptukin/rencana/aktif");
	}
/////////////////////////////////////////////////////////////////////////////////////////////
	function form_pangkat_penilai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pejabat Penilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "penilai";
		$this->load->view('rencana/riwayat_pangkat',$data);
	}
	function form_jabatan_penilai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pejabat Penilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['jabatan'] = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
		$data['peg'] = "penilai";
		$this->load->view('rencana/riwayat_jabatan',$data);
	}
	function form_pangkat_pegawai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pegawai Yang Dinilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "pegawai";
		$this->load->view('rencana/riwayat_pangkat',$data);
	}
	function form_jabatan_pegawai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pegawai Yang Dinilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['jabatan'] = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
		$data['peg'] = "pegawai";
		$this->load->view('rencana/riwayat_jabatan',$data);
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


}
?>