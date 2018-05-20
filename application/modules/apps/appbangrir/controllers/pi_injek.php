<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pi_injek extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_pi');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['satu'] = "Pengajuan Penyesuaian Ijazah";
		$data['idd'] = $_POST['idd'];
		$data['isi'] = $this->m_pi->ini_acc($data['idd']);
		$data['id_pegawai'] = $data['isi']->id_pegawai;
		$this->load->view('pi_injek/form',$data);
	}
	function hapus(){
		$data['satu'] = "Pengajuan Penyesuaian Ijazah";
		$data['hapus'] = "ya";
		$data['idd'] = $_POST['idd'];
		$data['isi'] = $this->m_pi->ini_acc($data['idd']);
		$data['id_pegawai'] = $data['isi']->id_pegawai;
		$this->load->view('pi_injek/form',$data);
	}

}
?>