<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sk_jabatan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);
		$jab = $this->m_unor->ini_unor($data['val']->id_unor);
		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));
		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));
		$this->load->view('sk_jabatan/form',$data);
	}
	function edit_aksi(){
		$isi = $_POST;
		$isi['sk_tanggal'] = date("Y-m-d", strtotime($_POST['sk_tanggal']));
		$isi['tmt_jabatan'] = date("Y-m-d", strtotime($_POST['tmt_jabatan']));
		$ese = $this->dropdowns->kode_ese();
		
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->set('nama_ese',$ese[$_POST['kode_ese']]);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_peg_jab',$_POST['id_peg_jab']);
		$this->db->update('r_peg_jab');

		echo "sukses";
	}

	function hapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);
		$jab = $this->m_unor->ini_unor($data['val']->id_unor);
		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));
		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));
		$data['hapus'] = "ya";
		$this->load->view('sk_jabatan/form',$data);
	}
	function hapus_aksi(){
		$this->db->where('id_peg_jab',$_POST['id_peg_jab']);
		$this->db->delete('r_peg_jab');
		echo "sukses";
	}

	function tambah(){
		@$data['val']->id_pegawai = $_POST['id_pegawai'];
		$this->load->view('sk_jabatan/form',$data);
	}
	function tambah_aksi(){
		$pegawai = Modules::run("appbkpp/profile/ini_pegawai_master",$_POST['id_pegawai']);

		$isi = $_POST;
		$isi['sk_tanggal'] = date("Y-m-d", strtotime($_POST['sk_tanggal']));
		$isi['tmt_jabatan'] = date("Y-m-d", strtotime($_POST['tmt_jabatan']));
		$ese = $this->dropdowns->kode_ese();
		
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->set('nama_ese',$ese[$_POST['kode_ese']]);
		$this->db->set('kode_unor','00.00.00');
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_peg_jab');
		
		echo "sukses";
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_profil->ini_jabatan_riwayat($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('sk_jabatan/upload',$data);
	}

}
?>