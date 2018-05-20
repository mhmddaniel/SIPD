<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mutasi_staf_daftar extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appmutasi/m_kpo');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
  function tahapan_mutasi_staf($asRef=false)  {
    $select ['buat'] = 'Pembuatan Pengajuan Mutasi Staf';
    $select ['draft'] = 'Pengisian Formulir Mutasi Staf';
    $select ['aju'] = 'Pengajuan Mutasi Staf';
    $select ['koreksi'] = 'Koreksi Pengajuan Mutasi Staf';
    $select ['revisi'] = 'Perbaikan Pengajuan Mutasi Staf';
    $select ['acc'] = 'Penerbitan SK Mutasi Staf';
    return $select;
  }
  function kode_dokumen_mutasi_staf($asRef=false)  {
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
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Pengajuan Mutasi Staf";
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "index_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} else {
			$rd = "index";
		}


		$this->load->view('mutasi_staf_daftar/'.$rd,$data);
	}




}
?>