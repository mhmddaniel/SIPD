<?php
class M_kelas extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////
	function ini_kelas_jabatan($idd){
		$sqlstr="SELECT a.*,b.* FROM m_jf b LEFT JOIN evjab_kelas_jabatan a ON (b.id_jabatan=a.id_jabatan) WHERE b.id_jabatan='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function hitung_kelas($cari,$jT){
		$sqlstr="SELECT a.id_jabatan FROM m_jf a WHERE a.jab_type='$jT' AND (a.nama_jabatan LIKE '%$cari%' OR a.kode_bkn  LIKE '$cari%')";
		$hslquery=$this->db->query($sqlstr)->result();
		return count($hslquery);
	}
	function get_kelas($cari,$mulai,$batas,$jT){
		$sqlstr="SELECT a.* FROM m_jf a WHERE a.jab_type='$jT' AND (a.nama_jabatan LIKE '%$cari%' OR a.kode_bkn  LIKE '$cari%') ORDER BY a.kode_bkn ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function fungsional_tambah($isi){
		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->set('ihtisar',$isi['ihtisar']);
		$this->db->insert('evjab_kelas_jabatan');
	}
	function fungsional_edit($isi){
		$this->db->set('ihtisar',$isi['ihtisar']);
		$this->db->where('id_jabatan',$isi['id_jabatan']);
		$this->db->update('evjab_kelas_jabatan');
	}
	function fungsional_edit_ASLI($isi){
		$this->db->set('kode_kelas_jabatan',$isi['kode_jabatan']);
		$this->db->set('ihtisar',$isi['ihtisar']);
		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_kelas_jabatan');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_urtug');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_alat');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_bahan');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_hasil');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_tanggungjawab');

		$this->db->set('id_jabatan',$isi['id_jabatan']);
		$this->db->where('id_jabatan',$isi['id_jabatan_lama']);
		$this->db->where('jab_type',$isi['jab_type']);
		$this->db->update('evjab_wewenang');
	}
	function kelas_setup($isi){
		$this->db->set('nomenklatur_unor',$isi['idJt']);
		$this->db->where('id_unor',$isi['id_unor']);
		$this->db->update('m_unor');
	}


}
