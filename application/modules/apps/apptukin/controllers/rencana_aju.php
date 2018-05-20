<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rencana_aju extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_profil');
	}

	function index(){
		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['satu'] = "Persetujuan Rencana Kerja Pegawai";
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['tpp'] = $this->m_tukin->get_rencana_kerja_aju($id_pegawai);
					$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
					$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
					$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();

		$this->load->view('rencana_aju/index',$data);
	}
	function arsip(){
		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['satu'] = "Arsip Persetujuan Rencana Kerja Pegawai";
		$data['pegawai_info'] = $this->m_tukin->get_pegawai($id_pegawai);
		$data['tpp'] = $this->m_tukin->get_rencana_kerja_arsip($id_pegawai);
					$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
					$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
					$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_tpp_nomor();

		$this->load->view('rencana_aju/arsip',$data);
	}
	
////////////////////////////////////////////////////////////////////////////////
	function alih()	{
        $this->session->set_userdata("id_tpp",$this->uri->segment(4));
		$id_tpp= $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$this->m_tukin->koreksi_penilai($id_tpp);
		redirect(site_url("module/apptukin/rencana_aju/target"));
	}
	function alih_arsip()	{
        $this->session->set_userdata("id_tpp",$this->uri->segment(4));
		$id_tpp= $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		if($data['tpp']->koreksi_penilai==NULL){	$this->m_tukin->koreksi_penilai($id_tpp);	}
		redirect(site_url("module/apptukin/rencana_aju/target_arsip"));
	}
////////////////////////////////////////////////////////////////////////////////
	function target()	{
		$data['satu'] = "Persetujuan Rencana Kerja Pegawai";

		$data['id_tpp'] = $this->session->userdata('id_tpp');
		$id_penilai = $this->session->userdata('pegawai_info');

		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['penilai'] = $this->m_tukin->get_pegawai($id_penilai);
		$data['pegawai'] = $this->m_tukin->get_pegawai($data['tpp']->id_pegawai);
		$data['bulan2'] = $this->dropdowns->bulan2();
		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		$data['catatan'] = $this->m_tukin->get_catatan($data['id_tpp']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
					$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
					$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_skp_pelaku();
					$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_skp_nomor();
		$this->load->view('rencana_aju/target',$data);
	}
	function target_arsip()	{
		$data['satu'] = "Persetujuan Rencana Kerja Pegawai";

		$data['id_tpp'] = $this->session->userdata('id_tpp');
		$id_penilai = $this->session->userdata('pegawai_info');

		$data['tpp'] = $this->m_tukin->ini_tpp($data['id_tpp']);
		$data['penilai'] = $this->m_tukin->get_pegawai($id_penilai);
		$data['pegawai'] = $this->m_tukin->get_pegawai($data['tpp']->id_pegawai);
		$data['bulan2'] = $this->dropdowns->bulan2();
		$data['target'] = $this->m_tukin->get_target($data['id_tpp']);
		$data['catatan'] = $this->m_tukin->get_catatan($data['id_tpp']);
		foreach($data['catatan'] AS $key=>$val){
			$jawaban = $this->m_tukin->get_jawaban($val->id_catatan);
			@$data['catatan'][$key]->jawaban = $jawaban->jawaban;
			@$data['catatan'][$key]->id_jawaban = $jawaban->id_jawaban;
			@$data['catatan'][$key]->waktu = $jawaban->last_updated;
		}
					$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
					$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_skp_pelaku();
					$data['tahapan_tpp_nomor'] = $this->dropdowns->tahapan_skp_nomor();
		$this->load->view('rencana_aju/target_arsip',$data);
	}
////////////////////////////////////////////////////////////////////////////////
	function track()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['tahapan_tpp_pelaku'] = $this->dropdowns->tahapan_tpp_pelaku();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$data['tahapan_tpp_nomor'] = $tahapan_tpp_nomor[$data['tpp']->status];	
		
		$this->load->view('rencana_aju/track',$data);
	}
////////////////////////////////////////////////////////////////////////////////
	function tambah_catatan()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$this->load->view('rencana_aju/form_catatan',$data);
	}
	function tambah_catatan_aksi()	{
		$id_tpp = $this->session->userdata('id_tpp');
		$this->m_tukin->input_catatan($id_tpp,$_POST);
		redirect(site_url("module/apptukin/rencana_aju/target"));
	}
	function edit_catatan()	{
		$data['isi'] = $this->m_tukin->ini_catatan($_POST['idd']);
		$this->load->view('rencana_aju/form_catatan',$data);
	}
	function edit_catatan_aksi()	{
		$this->m_tukin->edit_catatan($_POST);
		redirect(site_url("module/apptukin/rencana_aju/target"));
	}
	function hapus_catatan()	{
		$data['isi'] = $this->m_tukin->ini_catatan($_POST['idd']);
		$data['hapus'] = "1";
		$this->load->view('rencana_aju/form_catatan',$data);
	}
	function hapus_catatan_aksi()	{
		$this->m_tukin->hapus_catatan($_POST);
		redirect(site_url("module/apptukin/rencana_aju/target"));
	}
////////////////////////////////////////////////////////////////////////////////
	function form_kembalikan(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['catatan'] = $this->m_tukin->get_catatan($id_tpp);
		$this->load->view('rencana_aju/form_kembalikan',$data);
	}
	function kembalikan_aksi(){
		$id_tpp = $this->session->userdata('id_tpp');
		$this->m_tukin->revisi_penilai($id_tpp);
		redirect(site_url("module/apptukin/rencana_aju"));
	}
	function form_acc(){
		$id_tpp = $this->session->userdata('id_tpp');
		$data['tpp'] = $this->m_tukin->ini_tpp($id_tpp);
		$data['tahapan_tpp'] = $this->dropdowns->tahapan_tpp();
		$data['catatan'] = $this->m_tukin->get_catatan($id_tpp);
		$this->load->view('rencana_aju/form_acc',$data);
	}
	function acc_aksi(){
		$id_tpp = $this->session->userdata('id_tpp');
		$this->m_tukin->acc_penilai($id_tpp,$_POST);
		redirect(site_url("module/apptukin/rencana_aju"));
	}

}
?>