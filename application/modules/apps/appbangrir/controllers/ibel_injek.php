<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ibel_injek extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_ibel');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Pengajuan Ijin Belajar";
		$this->load->view('ibel_injek/form_tambah',$data);
	}
	function cari_nip(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('nip_baru',$_POST['nip']);
		$data['val'] = $this->db->get()->row();
		$this->load->view('ibel_injek/form_tambah_nip',$data);
	}
	function tambah_aksi(){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$_POST['id_pegawai']);
		$peg = $this->db->get()->row();
		$id_ibel = $this->m_ibel->tambah_pemohon($peg);

		$this->db->set('status',"injek");
		$this->db->where('id_ibel',$id_ibel);
		$this->db->update('r_peg_ibel_aju');

		$_POST['id_ibel'] = $id_ibel;
		$this->m_ibel->sekolah_tambah($_POST);

		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$this->db->set('id_pegawai',$_POST['id_pegawai']);
		$this->db->set('id_ibel',$id_ibel);
		$this->db->set('nomor_surat',$_POST['nomor']);
		$this->db->set('tanggal_surat',$tanggal);
		$this->db->insert('r_peg_ibel');

		echo "sukses";
	}
	function edit(){
		$data['satu'] = "Pengajuan Ijin Belajar";
		$data['idd'] = $_POST['idd'];
		$this->load->view('ibel_injek/form_edit',$data);
	}
	function edit_form(){
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_ibel->ini_ibel($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['row'] = $this->m_ibel->ini_sekolah($_POST['idd']);
		$data['sib'] = $this->m_ibel->ini_acc($_POST['idd']);

		$data['idd'] = $_POST['idd'];

		$this->load->view('ibel_injek/form_tambah_nip',$data);
	}
	function edit_aksi(){
		$this->m_ibel->sekolah_edit($_POST);
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$this->db->set('nomor_surat',$_POST['nomor']);
		$this->db->set('tanggal_surat',$tanggal);
		$this->db->where('id_ibel',$_POST['id_ibel']);
		$this->db->update('r_peg_ibel');
		echo "sukses";
	}
	
	function hapus(){
		$data['satu'] = "Pengajuan Ijin Belajar";
		$data['hapus'] = "ya";
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
		$data['val'] = $this->m_ibel->ini_ibel($_POST['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['row'] = $this->m_ibel->ini_sekolah($_POST['idd']);
		$data['sib'] = $this->m_ibel->ini_acc($_POST['idd']);

		$data['idd'] = $_POST['idd'];
		$this->load->view('ibel_injek/form_hapus',$data);
	}
	function hapus_aksi(){
		$this->db->where('id_ibel',$_POST['id_ibel']);
		$this->db->delete('r_peg_ibel');
		$this->db->where('id_ibel',$_POST['id_ibel']);
		$this->db->delete('r_peg_ibel_aju');
		$this->db->where('id_ibel',$_POST['id_ibel']);
		$this->db->delete('r_peg_ibel_sekolah');

		echo "sukses";
	}

}
?>