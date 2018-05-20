<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tubel_injek extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_tubel');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Pengajuan Tugas Belajar";
		$this->load->view('tubel_injek/form_tambah',$data);
	}
	function cari_nip(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('nip_baru',$_POST['nip']);
		$data['val'] = $this->db->get()->row();
		$this->load->view('tubel_injek/form_tambah_nip',$data);
	}
	function tambah_aksi(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$_POST['id_pegawai']);
		$peg = $this->db->get()->row();
		$id_tubel = $this->m_tubel->tambah_pemohon($peg);

		$this->db->set('status',"injek");
		$this->db->where('id_tubel',$id_tubel);
		$this->db->update('r_peg_tubel_aju');

		$_POST['id_tubel'] = $id_tubel;
		$this->m_tubel->sekolah_tambah($_POST);

		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$this->db->set('id_pegawai',$_POST['id_pegawai']);
		$this->db->set('id_peg_tubel',$id_tubel);
		$this->db->set('nomor_surat',$_POST['nomor']);
		$this->db->set('tanggal_surat',$tanggal);
		$this->db->insert('r_peg_tubel');

		echo "sukses";
	}
	function edit(){
		$data['satu'] = "Pengajuan Tugas Belajar";
		$data['idd'] = $_POST['idd'];
		$this->load->view('tubel_injek/form_edit',$data);
	}
	function edit_form(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_tubel->ini_tubel($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['row'] = $this->m_tubel->ini_sekolah($_POST['idd']);
		$data['sib'] = $this->m_tubel->ini_acc($_POST['idd']);

		$data['idd'] = $_POST['idd'];

		$this->load->view('tubel_injek/form_tambah_nip',$data);
	}
	function edit_aksi(){
		$this->m_tubel->sekolah_edit($_POST);
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$this->db->set('nomor_surat',$_POST['nomor']);
		$this->db->set('tanggal_surat',$tanggal);
		$this->db->where('id_tubel',$_POST['id_tubel']);
		$this->db->update('r_peg_tubel');
		echo "sukses";
	}
	
	function hapus(){
		$data['satu'] = "Pengajuan Tugas Belajar";
		$data['hapus'] = "ya";
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_tubel->ini_tubel($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['row'] = $this->m_tubel->ini_sekolah($_POST['idd']);
		$data['sib'] = $this->m_tubel->ini_acc($_POST['idd']);

		$data['idd'] = $_POST['idd'];
		$this->load->view('tubel_injek/form_hapus',$data);
	}
	function hapus_aksi(){
		$this->db->where('id_tubel',$_POST['id_tubel']);
		$this->db->delete('r_peg_tubel');
		$this->db->where('id_tubel',$_POST['id_tubel']);
		$this->db->delete('r_peg_tubel_aju');
		$this->db->where('id_tubel',$_POST['id_tubel']);
		$this->db->delete('r_peg_tubel_sekolah');

		echo "sukses";
	}

}
?>