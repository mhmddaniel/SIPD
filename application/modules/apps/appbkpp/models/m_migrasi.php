<?php
class M_migrasi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_jabatan($th,$bl,$cari,$kode,$pkt,$jbt){
			$sess = $this->session->userdata('logged_in');
			$uid = $sess['id_user'];
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM (r_peg_jab a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tmt_jabatan LIKE '$thbl%'
		AND a.user_id='$uid'
		AND c.tahun='$th' AND c.bulan='$bl'
		$iUnor $iPkt $iJbt
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_jabatan($th,$bl,$cari,$mulai,$batas,$kode,$pkt,$jbt){
			$sess = $this->session->userdata('logged_in');
			$uid = $sess['id_user'];
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT a.*,b.*,c.gelar_depan,c.gelar_belakang,c.gelar_nonakademis,c.kode_golongan
		FROM (r_peg_jab a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tmt_jabatan LIKE '$thbl%'
		AND a.user_id='$uid'
		AND c.tahun='$th' AND c.bulan='$bl'
		$iUnor $iPkt $iJbt
		ORDER BY a.last_updated
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
}
