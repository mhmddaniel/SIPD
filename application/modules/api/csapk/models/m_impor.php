<?php
class M_impor extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_sama($jenis,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (xx_r_pegawai_sapk a)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai NOT IN (0,1)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_sama($jenis,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM xx_r_pegawai_sapk a
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai NOT IN (0,1)
		ORDER BY a.nama_pegawai ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_sapk($jenis,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (xx_r_pegawai_sapk a)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai='0'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_sapk($jenis,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM xx_r_pegawai_sapk a
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai='0'
		ORDER BY a.status_kepegawaian ASC,a.nama_pegawai ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_sikda($jenis,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (xx_r_pegawai_sapk a)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai='1'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_sikda($jenis,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM xx_r_pegawai_sapk a
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND id_pegawai='1'
		ORDER BY a.id ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


	function hitung_golongan($jenis,$cari){
		if($jenis=="kecil"){
			$pilgol = "AND a.kode_golongan<b.kode_golongan";
		} elseif($jenis=="besar") {
			$pilgol = "AND a.kode_golongan>b.kode_golongan";
		} elseif($jenis=="sama") {
			$pilgol = "AND a.kode_golongan=b.kode_golongan";
		} else {
			$pilgol = "AND a.kode_golongan!=b.kode_golongan";
		}
		
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (xx_r_pegawai_sapk a)
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_pegawai NOT IN (0,1)
		$pilgol
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_golongan($jenis,$cari,$mulai,$batas){
		if($jenis=="kecil"){
			$pilgol = "AND a.kode_golongan<b.kode_golongan";
		} elseif($jenis=="besar") {
			$pilgol = "AND a.kode_golongan>b.kode_golongan";
		} elseif($jenis=="sama") {
			$pilgol = "AND a.kode_golongan=b.kode_golongan";
		} else {
			$pilgol = "AND a.kode_golongan!=b.kode_golongan";
		}
		$sqlstr="SELECT a.*,b.kode_golongan AS kode_golongan_aktual,b.nama_golongan AS nama_golongan_aktual,b.tmt_pangkat AS tmt_pangkat_aktual,
		b.mk_gol_tahun AS mk_gol_tahun_aktual,b.mk_gol_bulan AS mk_gol_bulan_aktual
		FROM xx_r_pegawai_sapk a
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_pegawai NOT IN (0,1)
		$pilgol
		ORDER BY a.id ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_jenis($jenis,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (xx_r_pegawai_sapk a)
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_pegawai NOT IN (0,1)
		AND a.jab_type!=b.jab_type
		AND b.jab_type!='jft-guru'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_jenis($jenis,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*,b.jab_type AS jab_type_aktual,b.tmt_jabatan AS tmt_jabatan_aktual,b.nomenklatur_jabatan AS nomenklatur_jabatan_aktual
		FROM xx_r_pegawai_sapk a
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_pegawai NOT IN (0,1)
		AND a.jab_type!=b.jab_type
		AND b.jab_type!='jft-guru'
		ORDER BY a.id ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


}
