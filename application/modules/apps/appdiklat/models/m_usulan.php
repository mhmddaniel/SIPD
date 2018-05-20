<?php
class M_usulan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_rencana($cari,$rumpun,$tahun){
		$sqlstr="SELECT COUNT(a.id_diklat) AS numrows 
		FROM md_diklat_rencana a
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		)
		AND a.tahun='$tahun'
		AND a.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		GROUP BY a.id_diklat
		";
		$query = $this->db->query($sqlstr)->row(); 
		return (empty($query))?0:$query->numrows;
	}
	function get_rencana($cari,$rumpun,$tahun,$mulai,$batas){
		$sqlstr="
		SELECT a.*,b.jenis_diklat,b.jenjang_diklat
		FROM md_diklat_rencana a
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		) 
		AND a.tahun='$tahun'
		AND a.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		GROUP BY a.id_diklat
		ORDER BY a.id_diklat_rencana DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_pengusul($idd,$tahun,$pengusul){
		$sqlstr="SELECT COUNT(a.id_diklat_rencana) AS numrows 
		FROM md_diklat_rencana a
		WHERE a.id_diklat='$idd' AND a.tahun='$tahun' AND a.pengusul='$pengusul'";
		$query = $this->db->query($sqlstr)->row(); 
		return (empty($query))?0:$query->numrows;
	}
	function get_pengusul($idd,$tahun,$pengusul){
		$sqlstr="SELECT a.*,b.nama_unor
		FROM md_diklat_rencana a
		LEFT JOIN m_unor b ON (a.reff_pengusul=b.id_unor)
		WHERE a.id_diklat='$idd' AND a.tahun='$tahun' AND a.pengusul='$pengusul'";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
	function get_pengusul_calon($idd,$tahun,$pengusul){
		$sql="SELECT a.id_diklat_rencana FROM md_diklat_rencana a WHERE a.id_diklat='$idd' AND a.tahun='$tahun' AND a.pengusul='$pengusul'";
		$qry = $this->db->query($sql)->result();
		$sk = ""; foreach($qry AS $key=>$val){	if($key==0){	$sk=$sk.$val->id_diklat_rencana;	} else {	$sk=$sk.",".$val->id_diklat_rencana;	}	}
		$calon = $this->get_calon($sk);
		return $calon;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_aju($rumpun,$tahun,$pengusul,$reff_pengusul){
		$sqlstr="SELECT a.*	,b.jenis_diklat,b.jenjang_diklat
		FROM md_diklat_rencana a
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE  
		a.tahun='$tahun' AND a.pengusul='$pengusul' AND a.reff_pengusul='$reff_pengusul'
		AND a.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		ORDER BY a.id_diklat ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_aju($idd){
		$sqlstr="SELECT a.*	,b.jenis_diklat,b.jenjang_diklat
		FROM md_diklat_rencana a
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE a.id_diklat_rencana='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function aju_tambah($isi,$reff){
		$this->db->set('id_diklat',$isi['id_diklat']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('tempat_diklat',$isi['tempat_diklat']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('nama_diklat',$isi['nama_diklat']);
		$this->db->set('jam',$isi['jam']);
		$this->db->set('pengusul',$isi['pengusul']);
		$this->db->set('reff_pengusul',$reff);
		$this->db->insert('md_diklat_rencana');
	}
	function aju_hapus($isi){
		$this->db->where('id_diklat_rencana',$isi['idd']);
		$this->db->delete('md_diklat_rencana');
	}
	function hitung_calon($idd){
		$sqlstr="SELECT COUNT(a.id_diklat_calon) AS numrows	FROM md_diklat_calon a WHERE a.id_diklat_rencana IN ($idd)";
		$query = $this->db->query($sqlstr)->row(); 
		return (empty($query))?0:$query->numrows;
	}
	function get_calon($idd){
		$sqlstr="SELECT a.id_diklat_calon,b.nama_pegawai,b.gender,b.nip_baru,e.gelar_depan,e.gelar_belakang,
		d.nama_pangkat,d.nama_golongan,c.nama_jabatan,c.nama_unor,c.nomenklatur_pada
		FROM md_diklat_calon a
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_peg_jab c ON (a.reff_jabatan=c.id_peg_jab)
		LEFT JOIN r_peg_golongan d ON (a.reff_pangkat=d.id_peg_golongan)
		LEFT JOIN r_peg_pendidikan e ON (a.reff_pendidikan=e.id_peg_pendidikan)
		WHERE  
		a.id_diklat_rencana IN ($idd)
		";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function tambah_calon($isi,$peg,$rfjbt,$rfpkt,$rfpend){
		$this->db->set('id_diklat_rencana',$isi['id_diklat_rencana']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('reff_pendidikan',$rfpend);
		$this->db->set('reff_pangkat',$rfpkt);
		$this->db->set('reff_jabatan',$rfjbt);
		$this->db->insert('md_diklat_calon');
	}
	function hapus_calon($isi){
		$this->db->where('id_diklat_calon',$isi['idd']);
		$this->db->delete('md_diklat_calon');
	}
	function cek_calon($idd,$id_peg){
		$sqlstr="SELECT a.*	FROM md_diklat_calon a WHERE a.id_diklat_rencana='$idd' AND a.id_pegawai='$id_peg'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
}
