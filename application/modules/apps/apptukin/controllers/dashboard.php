<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('apptukin/m_tukin');
  }

  public function index()   {
  	echo "Honda...";
  }

  public function unor()   {
  	echo "Kawasaki...";
  }
  public function pegawai()   {
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['kelola_skp'] = $this->m_tukin->get_rencana_kerja_aju($id_pegawai);
		$data['kelola_realisasi'] = $this->m_tukin->get_realisasi_aju($id_pegawai);
		$data['skp'] = $this->m_tukin->get_tpp($id_pegawai);
		$data['peg'] = $this->m_tukin->get_pegawai($id_pegawai);

		$tpp = $this->m_tukin->get_tpp_last($id_pegawai);
			@$data['tpp']->bulan_mulai = ($tpp->bulan_mulai=="")?1:$tpp->bulan_mulai;
			@$data['tpp']->bulan_selesai = ($tpp->bulan_selesai=="")?12:$tpp->bulan_selesai;
			@$data['tpp']->tahun = ($tpp->tahun=="")?date("Y"):$tpp->tahun;
			$data['tpp']->id_tpp = (empty($tpp->id_tpp))?"0":$tpp->id_tpp;
		$data['target'] = $this->m_tukin->get_target($data['tpp']->id_tpp);

		$data['bulan'] = $this->dropdowns->bulan();
		$data['bulan2'] = $this->dropdowns->bulan2();
		$this->load->view('dashboard/pegawai',$data);
  }

}
?>