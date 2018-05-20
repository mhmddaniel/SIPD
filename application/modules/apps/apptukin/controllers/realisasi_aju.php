<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Realisasi_aju extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_pegawai');
	}

	function index(){
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');

		$data['satu'] = "Persetujuan Realisasi Kerja Pegawai";
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($data['id_pegawai']);
		$data['tpp'] = $this->m_tukin->get_realisasi_aju($data['id_pegawai']);
			$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp_realisasi();
			$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
			$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();

		$this->load->view('realisasi_aju/index',$data);
	}
	function arsip(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['satu'] = "Arsip Persetujuan Realisasi Kerja Pegawai";
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);

		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');


		$data['tpp'] = $this->m_tukin->get_realisasi_arsip($id_pegawai,$data['bulan'],$data['tahun']);
			$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp_realisasi();
			$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
			$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();

		$this->load->view('realisasi_aju/arsip',$data);
	}
////////////////////////////////////////////////////////////////////////////////
	function alih()	{
        $this->session->set_userdata("id_tpp",$this->uri->segment(4));
        $this->session->set_userdata("bulan",$this->uri->segment(5));
        $id_tpp = $this->session->userdata("id_tpp");
        $bulan = $this->session->userdata("bulan");
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$this->m_tukin->realisasi_koreksi_penilai($id_tpp,$bulan);
		redirect(site_url("module/apptukin/realisasi_aju/target"));
	}
	function alih_arsip()	{
        $this->session->set_userdata("id_tpp",$this->uri->segment(4));
        $this->session->set_userdata("bulan",$this->uri->segment(5));
        $id_tpp = $this->session->userdata("id_tpp");
        $bulan = $this->session->userdata("bulan");
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		redirect(site_url("module/apptukin/realisasi_aju/target_arsip"));
	}
////////////////////////////////////////////////////////////////////////////////
	function target()	{
		$data['satu'] = "Persetujuan Realisasi Kerja Pegawai";

		$data['id_tpp'] = $this->session->userdata('id_tpp');
		$data['bulan_aju'] = $this->session->userdata('bulan');
		$id_penilai = $this->session->userdata('pegawai_info');

		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['penilai'] = $this->m_tukin->get_pegawai($id_penilai);
		$data['pegawai'] = $this->m_tukin->get_pegawai_bulanan($data['tpp']->id_pegawai,$data['tpp']->tahun,$data['bulan_aju']);
        $this->session->set_userdata("jab_type",$data['pegawai']->jab_type);
		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
			$data['target'][$key]->rubah = $this->m_tukin->get_perubahan($val->id_target,$data['bulan_aju']);
		}
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($data['id_tpp'],$data['bulan_aju']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_realisasi_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}

		$data['realisasi_tahapan'] = $this->m_tukin->get_realisasi($data['id_tpp'],$data['bulan_aju']);
		$data['tahapan_realisasi'] = $this->dropdowns->tahapan_realisasi();
		$data['tahapan_realisasi_pelaku'] = $this->dropdowns->tahapan_skp_pelaku();
		$data['tahapan_realisasi_nomor'] = $this->dropdowns->tahapan_skp_nomor();

		$this->load->view('realisasi_aju/target',$data);
	}
	function rubah_lihat()	{
		$data['id_tpp'] = $this->session->userdata('id_tpp');
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

	function target_arsip()	{
		$data['satu'] = "Persetujuan Realisasi Kerja Pegawai";

		$data['id_tpp'] = $this->session->userdata('id_tpp');
		$data['bulan_aju'] = $this->session->userdata('bulan');
		$id_penilai = $this->session->userdata('pegawai_info');

		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['penilai'] = $this->m_tukin->get_pegawai($id_penilai);
		$data['pegawai'] = $this->m_tukin->get_pegawai($data['tpp']->id_pegawai);
		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
			$data['target'][$key]->rubah = $this->m_tukin->get_perubahan($val->id_target,$data['bulan_aju']);
		}
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($data['id_tpp'],$data['bulan_aju']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_realisasi_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
		$data['realisasi_tahapan'] = $this->m_tukin->get_realisasi($data['id_tpp'],$data['bulan_aju']);
		$data['tahapan_realisasi'] = $this->dropdowns->tahapan_realisasi();
		$data['tahapan_realisasi_pelaku'] = $this->dropdowns->tahapan_skp_pelaku();
		$data['tahapan_realisasi_nomor'] = $this->dropdowns->tahapan_skp_nomor();

		$this->load->view('realisasi_aju/target_arsip',$data);
	}

	function lembar_tugas_tambahan(){
		$id_tpp = $this->session->userdata('id_tpp');
		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$tpp_tahun = $this->m_tukin->get_tpp_tahun($tpp->id_pegawai,$tpp->tahun);
		$tpp_in = array();
		foreach($tpp_tahun AS $key=>$val){	array_push($tpp_in,$val->id_tpp);	}
		$data['ttambahan'] = $this->m_tukin->get_tugas_tambahan($tpp_in,$_POST['bulan']);
//		$data['ttambahan'] = $this->m_tukin->get_tugas_tambahan($id_tpp,$_POST['bulan']);
		$this->load->view('realisasi_aju/lembar_tugas_tambahan',$data);
	}
	function lembar_kreatifitas(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['kreatifitas'] = $this->m_tukin->get_kreatifitas($id_tpp,$_POST['bulan']);
		$this->load->view('realisasi_aju/lembar_kreatifitas',$data);
	}
	function lembar_perilaku(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$data['jab_type'] = $this->session->userdata('jab_type');
		$data['i_perilaku'] = $this->dropdowns->perilaku();
		$data['perilaku'] = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$this->load->view('realisasi_aju/lembar_perilaku',$data);
	}
	function ipt_perilaku(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$jab_type = $this->session->userdata('jab_type');
		$cek = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
		if(empty($cek)){
			$this->m_tukin->input_perilaku($id_tpp,$bulan,$_POST);
		} else {
			$this->m_tukin->edit_perilaku($id_tpp,$bulan,$_POST);
		}

		$i_perilaku = $this->dropdowns->perilaku();
		$perilaku = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
				$j_perilaku=0; $n_perilaku=0;
				foreach($i_perilaku AS $key=>$val){
				if($key!=""){
				if($val!="Kepemimpinan"){	$tpll="ya";	} else {	if($jab_type=="js"){	$tpll="ya";	} else {$tpll="tidak";}	}
				if($tpll=="ya"){
					$indi = "indikator_".$key;
					$isi = $this->dropdowns->$indi();
					foreach($isi AS $key2=>$val2){
					if($key2!=""){	
						if(isset($perilaku->$key2)){	$j_perilaku=$j_perilaku+$perilaku->$key2;	}
							$n_perilaku++;
					} // if indikator
					} // for indikator
				} // if jfu
				} // if perilaku
				} //for perilaku
		@$data->pesan="sukses";
		@$data->isi = $this->m_tukin->ini_nilai_perilaku($id_tpp,$bulan,$_POST);
		@$data->kat = $this->dropdowns->kategori(@$data->isi);
		@$data->jumlah = $j_perilaku;
		@$data->r_perilaku = ($n_perilaku>0)?$j_perilaku/$n_perilaku:"-";
		@$data->kat_rerata = $this->dropdowns->kategori($data->r_perilaku);
		@$data->nilai_perilaku = ($n_perilaku>0)?$data->r_perilaku*.4:"-";

		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////////
	function track()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');

		$data['tpp'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$data['tahapan_tpp_nomor'] = $tahapan_tpp_nomor[$data['tpp']->status];	
		
		$this->load->view('rencana/track',$data);
	}
////////////////////////////////////////////////////////////////////////////////
	function tambah_catatan()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$this->load->view('realisasi_aju/form_catatan',$data);
	}
	function tambah_catatan_aksi()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$this->m_tukin->input_realisasi_catatan($id_tpp,$bulan,$_POST);
		redirect(site_url("module/apptukin/realisasi_aju/target"));
	}
	function edit_catatan()	{
		$data['isi'] = $this->m_tukin->ini_realisasi_catatan($_POST['idd']);
		$this->load->view('realisasi_aju/form_catatan',$data);
	}
	function edit_catatan_aksi()	{
		$this->m_tukin->edit_realisasi_catatan($_POST);
		redirect(site_url("module/apptukin/realisasi_aju/target"));
	}
	function hapus_catatan()	{
		$data['isi'] = $this->m_tukin->ini_realisasi_catatan($_POST['idd']);
		$data['hapus'] = "1";
		$this->load->view('realisasi_aju/form_catatan',$data);
	}
	function hapus_catatan_aksi()	{
		$this->m_tukin->hapus_realisasi_catatan($_POST);
		redirect(site_url("module/apptukin/realisasi_aju/target"));
	}
////////////////////////////////////////////////////////////////////////////////
	function form_kembalikan(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_realisasi();
		$data['target'] = $this->m_tukin->get_target($id_tpp);
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($id_tpp,$bulan);
		$this->load->view('realisasi_aju/form_kembalikan',$data);
	}
	function kembalikan_aksi(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$this->m_tukin->realisasi_revisi_penilai($id_tpp,$bulan);
		redirect(site_url("module/apptukin/realisasi_aju"));
	}
	function form_acc(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['bulan'] = $this->session->userdata('bulan');
		$data['jab_type'] = $this->session->userdata('jab_type');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['realisasi'] = $this->m_tukin->get_realisasi($id_tpp,$data['bulan']);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_realisasi();
		$data['target'] = $this->m_tukin->get_target($id_tpp);
		foreach($data['target'] AS $key=>$val){
			$data['realisasi_target'][$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
			$data['target'][$key]->rubah = $this->m_tukin->get_perubahan($val->id_target,$data['bulan']);
		}

		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$tpp_tahun = $this->m_tukin->get_tpp_tahun($data['tpp']->id_pegawai,$data['tpp']->tahun);
		$tpp_in = array();
		foreach($tpp_tahun AS $key=>$val){	array_push($tpp_in,$val->id_tpp);	}
		$data['ttambahan'] = $this->m_tukin->get_tugas_tambahan($tpp_in,$data['bulan']);
//		$data['ttambahan'] = $this->m_tukin->get_tugas_tambahan($id_tpp,$data['bulan']);
		$data['kreatifitas'] = $this->m_tukin->get_kreatifitas($id_tpp,$data['bulan']);
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['i_perilaku'] = $this->dropdowns->perilaku();
		$data['perilaku'] = $this->m_tukin->ini_perilaku($id_tpp,$data['bulan']);
		$data['catatan'] = $this->m_tukin->get_realisasi_catatan($id_tpp,$data['bulan']);
		$this->load->view('realisasi_aju/form_acc',$data);
	}
	function acc_aksi(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$this->m_tukin->realisasi_acc_penilai($id_tpp,$bulan,$_POST);
//		redirect(site_url("module/apptukin/realisasi_aju"));
	}
	function saya(){
		echo "saya";
//		redirect(site_url("module/apptukin/realisasi_aju"));
	}
}
?>