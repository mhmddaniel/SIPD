<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Spj_kegiatan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$sqlstr="SELECT * FROM r_peg_spj_kegiatan WHERE id_spj_kegiatan='".$_POST['idd']."'";
		$data['isi'] = $this->db->query($sqlstr)->row();
		$this->load->view('spj_kegiatan/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];

		$sqlstr="SELECT * FROM r_peg_spj_kegiatan WHERE id_spj_kegiatan='".$_POST['idd']."'";
		$data['isi'] = $this->db->query($sqlstr)->row();

		$data['hapus'] = "ya";
		$this->load->view('spj_kegiatan/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$this->load->view('spj_kegiatan/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$sqlstr="SELECT * FROM r_peg_spj_kegiatan WHERE id_spj_kegiatan='".$_POST['idd']."'";
		$data['isi'] = $this->db->query($sqlstr)->row();

		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('spj_kegiatan/upload',$data);
	}

}
?>