<?php
class M_jabfung extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_jabfung($idd){
		$this->db->from('m_jf');
		$this->db->where('id_jabatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function hitung_jabfung($cari,$tipe){
		$sqlstr="SELECT COUNT(a.id_jabatan) AS numrows
		FROM (m_jf a)
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		)
		AND jab_type='$tipe'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_jabfung($cari,$mulai,$batas,$tipe){
		$sqlstr="
		SELECT a.*
		FROM m_jf a
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		)
		AND jab_type='$tipe'
		ORDER BY a.id_jabatan ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function edit_aksi($isi){
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->set('ihtisar',$isi['ihtisar']);
		$this->db->where('id_jabatan',$isi['idd']);
		$this->db->update('m_jf');
	}

    function tambah_aksi($isi){
		$this->db->set('jab_type',$isi['jab_type']);
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->set('ihtisar',$isi['ihtisar']);
		$this->db->insert('m_jf');
	}
	
    function hapus_aksi($isi){
		$this->db->delete('m_jf', array('id_jabatan' => $isi['idd']));
	}

	function get_urtug($idJab){
		$sqlstr="SELECT a.*	FROM m_urtug a	WHERE a.id_jabatan='$idJab'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_urtug($idUrtug){
		$sqlstr="SELECT a.*	FROM m_urtug a	WHERE a.id_urtug='$idUrtug'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function urtug_tambah($idj,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('uraian_tugas',$isi['uraian_tugas']);
		$this->db->insert('m_urtug');
	}
	function urtug_edit($isi){
		$this->db->set('uraian_tugas',$isi['uraian_tugas']);
		$this->db->where('id_urtug',$isi['id_urtug']);
		$this->db->update('m_urtug');
	}
	function urtug_hapus($isi){
		$this->db->where('id_urtug',$isi['id_urtug']);
		$this->db->delete('m_urtug');
	}


}
