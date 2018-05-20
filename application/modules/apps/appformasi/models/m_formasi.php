<?php
class M_formasi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_formasi($tab,$thbl,$cari,$kode,$pkt,$jbt){
			$iUnor = ($kode=="")?"":"AND b.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND b.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND b.jab_type='$jbt'";
		$sqlstr="SELECT COUNT(a.id) AS numrows	FROM (r_pegawai_$tab a)
		LEFT JOIN r_pegawai_bulanan b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND tanggal_$tab LIKE '$thbl%'
		AND b.id = (SELECT kk.id FROM r_pegawai_bulanan kk WHERE kk.id_pegawai=a.id_pegawai ORDER BY kk.tahun,kk.bulan DESC LIMIT 0,1)
		$iUnor $iPkt $iJbt
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
}
