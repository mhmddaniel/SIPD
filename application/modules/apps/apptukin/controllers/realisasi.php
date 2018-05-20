<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Realisasi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_profil');
	}

	function index(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$tpp = $this->m_tukin->get_tpp_last($id_pegawai,"acc_penilai");		
		if(empty($tpp)){
			$data['title'] = "Penyusunan Realisasi Kerja Pegawai";
			$this->load->view('realisasi/kosong',$data);
		} else {
			$this->session->set_userdata("id_tpp",$tpp->id_tpp);
			$rel = $this->m_tukin->get_realisasi_last_bulan($tpp->id_tpp);
			$this->session->set_userdata("bulan",$rel->bulan);
			redirect("module/apptukin/realisasi/aktif");
		}
	}

	function aktif(){
		$data['title'] = "Penyusunan Realisasi Kerja Pegawai";
		$data['id_tpp'] = $this->session->userdata('id_tpp');
		$data['bulan_aktif'] = $this->session->userdata('bulan');
		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['realisasi'] = $this->m_tukin->get_realisasi($data['id_tpp'],$data['bulan_aktif']);

		$peg = $this->m_tukin->get_pegawai_bulanan($data['tpp']->id_pegawai,$data['tpp']->tahun,$data['bulan_aktif']);
		$this->session->set_userdata('jab_type',$peg->jab_type);

		$data['pil_bulan'] = array();
		for($i=$data['tpp']->bulan_mulai;$i<=$data['tpp']->bulan_selesai;$i++){
			$cek = $this->m_tukin->get_realisasi($data['id_tpp'],$i);
			if(!empty($cek)){
				@$data['pil_bulan'][$i]->bulan=$i;
				@$data['pil_bulan'][$i]->status=$cek->status;
			}
		}

		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
			$data['target'][$key]->rubah = $this->m_tukin->get_perubahan($val->id_target,$data['bulan_aktif']);
		}
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($data['id_tpp'],$data['bulan_aktif']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_realisasi_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}

		$data['bulan'] = $this->dropdowns->bulan();
		$data['bulan2'] = $this->dropdowns->bulan2();
		$data['tahapan_tpp_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();

		$this->load->view('realisasi/index',$data);
	}
	function alih_realisasi(){
		$realisasi = $this->m_tukin->get_realisasi($_POST['id_tpp'],$_POST['bulan']);
		if(!empty($realisasi)){	
			$this->session->set_userdata("id_tpp",$_POST['id_tpp']);
			$this->session->set_userdata("bulan",$_POST['bulan']);
		}
		redirect("module/apptukin/realisasi/aktif");
	}
	function arsip()	{
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['tpp'] = $this->m_tukin->get_tpp($id_pegawai);
		$this->load->view('realisasi/arsip',$data);
	}


	function ipt_realisasi(){
		$cek = $this->m_tukin->ini_realisasi_target($_POST['idd']);
		if(empty($cek)){
			$this->m_tukin->input_realisasi_target($_POST);
		} else {
			$this->m_tukin->edit_realisasi_target($_POST);
		}

			$id_tpp = $this->session->userdata('id_tpp');
			$bulan = $this->session->userdata('bulan');
			$realisasi = $this->m_tukin->get_realisasi($id_tpp,$bulan);
			if($realisasi->status=="draft" && $realisasi->draft==NULL){	
				$this->m_tukin->realisasi_draft($id_tpp,$bulan);	
			}
		$isi = $this->m_tukin->ini_nilai_realisasi($_POST);
		@$data->pesan="sukses";
		@$data->isi = (preg_match('/biaya/',$_POST['nama']))?number_format($isi,2,"."," "):$isi;
		echo json_encode($data);
	}

	function lembar_tugas_tambahan(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$id_tpp = $this->session->userdata('id_tpp');
		$data['bulan_aktif'] = $this->session->userdata('bulan');
		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$tpp_tahun = $this->m_tukin->get_tpp_tahun($id_pegawai,$tpp->tahun);
		$tpp_in = array();
		foreach($tpp_tahun AS $key=>$val){	array_push($tpp_in,$val->id_tpp);	}
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$data['bulan_aktif']);
		$data['ttambahan'] = $this->m_tukin->get_tugas_tambahan($tpp_in,$data['bulan_aktif']);
		$this->load->view('realisasi/lembar_tugas_tambahan',$data);
	}
	function tugas_tambahan_tambah(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$data['avail'] = "yes";
		$this->load->view('realisasi/form_tugas_tambahan',$data);
	}
	function tugas_tambahan_tambah_aksi(){
		$ipt = $this->input->post();
		$ipt['tanggal_sp'] = date("Y-m-d", strtotime($ipt['tanggal_sp']));
		$ipt['id_tpp'] = $this->session->userdata('id_tpp');
		$ipt['bulan'] = $this->session->userdata('bulan');
		$this->m_tukin->tugas_tambahan_tambah_aksi($ipt);
		echo "success";
	}
	function tugas_tambahan_edit(){
		$data['id_tugas_tambahan'] = $_POST['idd'];
		$data['isi'] = $this->m_tukin->ini_tugas_tambahan($data['id_tugas_tambahan']);
		$this->load->view('realisasi/form_tugas_tambahan',$data);
	}
	function tugas_tambahan_edit_aksi(){
		$ipt = $this->input->post();
		$ipt['tanggal_sp'] = date("Y-m-d", strtotime($ipt['tanggal_sp']));
		$this->m_tukin->tugas_tambahan_edit_aksi($ipt);
		echo "success";
	}
	function tugas_tambahan_hapus(){
		$data['id_tugas_tambahan'] = $_POST['idd'];
		$data['isi'] = $this->m_tukin->ini_tugas_tambahan($data['id_tugas_tambahan']);
		$data['hapus'] = "ya";
		$this->load->view('realisasi/form_tugas_tambahan',$data);
	}
	function tugas_tambahan_hapus_aksi(){
		$ipt = $this->input->post();
		$this->m_tukin->tugas_tambahan_hapus_aksi($ipt);
		echo "success";
	}



	function lembar_kreatifitas(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$id_tpp = $this->session->userdata('id_tpp');
		$data['bulan_aktif'] = $this->session->userdata('bulan');

		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$tpp_tahun = $this->m_tukin->get_tpp_tahun($id_pegawai,$tpp->tahun);
		$tpp_in = array();
		foreach($tpp_tahun AS $key=>$val){	array_push($tpp_in,$val->id_tpp);	}
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$data['bulan_aktif']);
		$data['kreatifitas'] = $this->m_tukin->get_kreatifitas($tpp_in,$data['bulan_aktif']);
		$data['tingkat'] = $this->dropdowns->tingkat_kreatifitas();
		$this->load->view('realisasi/lembar_kreatifitas',$data);
	}
	function kreatifitas_tambah(){
		$data['id_tpp']=$this->session->userdata('id_tpp');
		$data['avail'] = "yes";
		$this->load->view('realisasi/form_kreatifitas',$data);
	}
	function kreatifitas_tambah_aksi(){
		$ipt = $this->input->post();
		$ipt['tanggal_sk'] = date("Y-m-d", strtotime($ipt['tanggal_sk']));
		$ipt['id_tpp'] = $this->session->userdata('id_tpp');
		$ipt['bulan'] = $this->session->userdata('bulan');
		$this->m_tukin->kreatifitas_tambah_aksi($ipt);
		echo "success";
	}
	function kreatifitas_edit(){
		$data['id_kreatifitas'] = $_POST['idd'];
		$data['isi'] = $this->m_tukin->ini_kreatifitas($data['id_kreatifitas']);
		$this->load->view('realisasi/form_kreatifitas',$data);
	}
	function kreatifitas_edit_aksi(){
		$ipt = $this->input->post();
		$ipt['tanggal_sk'] = date("Y-m-d", strtotime($ipt['tanggal_sk']));
		$this->m_tukin->kreatifitas_edit_aksi($ipt);
		echo "success";
	}
	function kreatifitas_hapus(){
		$data['id_kreatifitas'] = $_POST['idd'];
		$data['isi'] = $this->m_tukin->ini_kreatifitas($data['id_kreatifitas']);
		$data['hapus'] = "ya";
		$this->load->view('realisasi/form_kreatifitas',$data);
	}
	function kreatifitas_hapus_aksi(){
		$ipt = $this->input->post();
		$this->m_tukin->kreatifitas_hapus_aksi($ipt);
		echo "success";
	}
	function lembar_perilaku()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$data['perilaku'] = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$data['i_perilaku'] = $this->dropdowns->perilaku();

		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$peg = $this->m_tukin->get_pegawai_bulanan($tpp->id_pegawai,$tpp->tahun,$bulan);
		$data['jab_type'] = $peg->jab_type;

		$this->load->view('realisasi/lembar_perilaku',$data);
	}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
	function form_aju_penilai(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['bulan_aktif'] = $this->session->userdata('bulan');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$data['bulan_aktif']);
		$data['tahapan_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['target'] = $this->m_tukin->get_target($id_tpp);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
		}
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($id_tpp,$data['bulan_aktif']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_realisasi_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
		$this->load->view('realisasi/form_aju_penilai',$data);
	}

	function aju_penilai(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$this->m_tukin->realisasi_aju_penilai($id_tpp,$bulan);
		redirect("module/apptukin/realisasi/aktif");
	}

	function track()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');

		$data['tpp'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$data['tahapan_tpp_nomor'] = $tahapan_tpp_nomor[$data['tpp']->status];	
		
		$this->load->view('realisasi/track',$data);
	}

/////////////////////////////////////////////////////////////////////////////////////////////
	function rubah_form(){
		$data['id_tpp'] = $_POST['no'];
		$data['id_target'] = $_POST['idd'];
		$data['val'] = $this->m_tukin->ini_target($data['id_target']); 
		$data['semula'] = $data['val'];
		$bulan_aktif = $this->session->userdata('bulan');
		$data['bulan_aktif'] = $bulan_aktif;

		$data['a_ak'] = "ak_".$bulan_aktif;
		$data['a_vol'] = "vol_".$bulan_aktif;
		$data['a_kualitas'] = "kualitas_".$bulan_aktif;
		$data['a_biaya'] = "biaya_".$bulan_aktif;
		$data['isian'] = "ya";

		$this->load->view('realisasi/rubah_form',$data);
	}
	function rubah_aksi(){
		$this->m_tukin->rubah_aksi($_POST);
		echo "sukses";
	}
	function rubah_form_edit(){
		$data['id_tpp'] = $_POST['no'];
		$data['id_target'] = $_POST['idd'];
		$bulan_aktif = $this->session->userdata('bulan');
		$data['bulan_aktif'] = $bulan_aktif;
		$data['val'] = $this->m_tukin->ini_target($data['id_target']); 
		$data['rubah'] = $this->m_tukin->get_perubahan($data['id_target'],$bulan_aktif);
		$data['semula'] = json_decode($data['rubah']->semula);

		$data['a_ak'] = "ak_".$bulan_aktif;
		$data['a_vol'] = "vol_".$bulan_aktif;
		$data['a_kualitas'] = "kualitas_".$bulan_aktif;
		$data['a_biaya'] = "biaya_".$bulan_aktif;
		$data['isian'] = "ya";

		$this->load->view('realisasi/rubah_form',$data);
	}
	function rubah_edit_aksi(){
		$this->m_tukin->rubah_edit_aksi($_POST);
		echo "sukses";
	}
	function rubah_form_batal(){
		$data['id_tpp'] = $_POST['no'];
		$data['id_target'] = $_POST['idd'];
		$bulan_aktif = $this->session->userdata('bulan');
		$data['bulan_aktif'] = $bulan_aktif;
		$data['val'] = $this->m_tukin->ini_target($data['id_target']); 
		$data['rubah'] = $this->m_tukin->get_perubahan($data['id_target'],$bulan_aktif);
		$data['semula'] = json_decode($data['rubah']->semula);
		$data['isian'] = "tidak";

		$data['a_ak'] = "ak_".$bulan_aktif;
		$data['a_vol'] = "vol_".$bulan_aktif;
		$data['a_kualitas'] = "kualitas_".$bulan_aktif;
		$data['a_biaya'] = "biaya_".$bulan_aktif;

		$this->load->view('realisasi/rubah_form',$data);
	}
	function rubah_batal_aksi(){
		$this->m_tukin->rubah_batal_aksi($_POST);
		echo "sukses";
	}
	function rubah_lihat()	{
		$data['id_tpp'] = $_POST['no'];
		$data['id_target'] = $_POST['idd'];
		$bulan_aktif = $this->session->userdata('bulan');
		$data['bulan_aktif'] = $bulan_aktif;
		$data['val'] = $this->m_tukin->ini_target($data['id_target']); 
		$data['rubah'] = $this->m_tukin->get_perubahan($data['id_target'],$bulan_aktif);
		$data['semula'] = json_decode($data['rubah']->semula);

		$data['a_ak'] = "ak_".$bulan_aktif;
		$data['a_vol'] = "vol_".$bulan_aktif;
		$data['a_kualitas'] = "kualitas_".$bulan_aktif;
		$data['a_biaya'] = "biaya_".$bulan_aktif;
		$data['isian'] = "tidak";

		$this->load->view('realisasi/rubah_form',$data);
	}
/////////////////////////////////////////////////////////////////////////////////////////////
	function input_jawaban(){
		$data['isi'] = $this->m_tukin->ini_realisasi_catatan($_POST['idd']);
		$this->load->view('realisasi/form_jawaban',$data);
	}
	function input_jawaban_aksi(){
		$this->m_tukin->input_realisasi_jawaban($_POST);
		redirect("module/apptukin/realisasi/aktif");
	}
	function edit_jawaban(){
		$data['isi'] = $this->m_tukin->ini_realisasi_catatan($_POST['idd']);
		$data['jj'] = $this->m_tukin->ini_realisasi_jawaban($_POST['no']);
		$this->load->view('realisasi/form_jawaban',$data);
	}
	function edit_jawaban_aksi(){
		$this->m_tukin->edit_realisasi_jawaban($_POST);
		redirect("module/apptukin/realisasi/aktif");
	}
/////////////////////////////////////////////////////////////////////////////////////
	function form_pangkat_penilai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pejabat Penilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "penilai";
		$this->load->view('realisasi/riwayat_pangkat',$data);
	}
	function form_pangkat_pegawai(){
		$id_pegawai = $_POST['no'];
		$data['pelaku'] = "Pegawai Yang Dinilai";
		$data['pegawai'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($id_pegawai);
		$data['peg'] = "pegawai";
		$this->load->view('realisasi/riwayat_pangkat',$data);
	}
	function edit_pangkat(){
		$idd = $_POST['idd'];
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$this->session->set_userdata("idtpp",$id_tpp);
		$ini_pangkat = $this->m_profil->ini_pangkat_riwayat($idd);
		if($_POST['peg']=="pegawai"){
			$this->m_tukin->set_realisasi_pegawai_pangkat($id_tpp,$bulan,$ini_pangkat->nama_golongan,$ini_pangkat->nama_pangkat);
		} else {
			$this->m_tukin->set_realisasi_penilai_pangkat($id_tpp,$bulan,$ini_pangkat->nama_golongan,$ini_pangkat->nama_pangkat);
		}
	}

}
?>