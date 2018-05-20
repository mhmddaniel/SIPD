<?php
class M_satu extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_jabatan($tipe,$cari,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlA="SELECT DISTINCT(nomenklatur_jabatan) FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' $iUnor AND nomenklatur_jabatan LIKE '%$cari%'";
		$hslA=$this->db->query($sqlA)->result();
		return count($hslA);
	}
	function get_jabatan($tipe,$mulai,$batas,$cari,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlstr = "SELECT DISTINCT(nomenklatur_jabatan) FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' $iUnor AND nomenklatur_jabatan LIKE '%$cari%' ORDER BY nomenklatur_jabatan ASC LIMIT $mulai,$batas";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_peg($tipe,$cari,$idd,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' AND nomenklatur_jabatan='$idd' $iUnor AND nama_pegawai LIKE '%$cari%'";
		$hslA=$this->db->query($sqlA)->row();
		return $hslA->numrows;
	}
	function get_peg($tipe,$mulai,$batas,$cari,$idd,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlstr = "SELECT * FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' AND nomenklatur_jabatan='$idd' $iUnor AND nama_pegawai LIKE '%$cari%' ORDER BY kode_unor ASC LIMIT $mulai,$batas";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_peg_js($tipe,$cari,$idd,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' AND kode_ese='$idd' $iUnor AND nama_pegawai LIKE '%$cari%'";
		$hslA=$this->db->query($sqlA)->row();
		return $hslA->numrows;
	}
	function get_peg_js($tipe,$mulai,$batas,$cari,$idd,$unorIn=""){
		$iUnor = ($unorIn=="")?"":"AND id_unor IN ($unorIn)";
		$sqlstr = "SELECT * FROM r_pegawai_aktual WHERE jab_type='$tipe' AND status_kepegawaian='pns' AND kode_ese='$idd' $iUnor AND nama_pegawai LIKE '%$cari%' ORDER BY kode_unor ASC LIMIT $mulai,$batas";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}
}
