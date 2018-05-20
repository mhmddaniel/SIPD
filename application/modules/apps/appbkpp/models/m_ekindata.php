<?php
class M_ekindata extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function hitung_log_data($bulan,$tahun,$cari,$riwayat="",$aksi="",$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iRiwayat = ($riwayat=="")?"":" AND a.tipe_dokumen='$riwayat'";
		$iAksi = ($aksi=="")?"":" AND a.file_dokumen='$aksi'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT COUNT(a.id_dokumen) AS numrows	FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen='0'
		$iRiwayat
		$iAksi
		$iStp
		 AND log_aksi LIKE '$blt%'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

    function get_log_data($bulan,$tahun,$cari,$mulai,$batas,$riwayat="",$aksi="",$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iRiwayat = ($riwayat=="")?"":" AND a.tipe_dokumen='$riwayat'";
		$iAksi = ($aksi=="")?"":" AND a.file_dokumen='$aksi'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT a.*	FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen='0'  AND log_aksi LIKE '$blt%'
		$iRiwayat
		$iAksi
		$iStp
		ORDER BY a.log_aksi DESC,a.nip_baru ASC,a.tipe_dokumen ASC,a.id_reff ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function ini_log_data($idd){
		$sqlstr="SELECT a.*	FROM r_peg_dokumen a WHERE  a.id_dokumen='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}

    function ini_user($idd){
		$sqlstr="SELECT a.*,b.nama_item AS nama_grup
		FROM users a
		LEFT JOIN cmf_setting b ON (a.group_id=b.id_item)
		WHERE  
		a.user_id='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}

    function hitung_log_dokumen($bulan,$tahun,$cari,$tipe,$aksi,$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iTipe = ($tipe=="")?"":" AND a.tipe_dokumen='$tipe'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT COUNT(a.id_dokumen) AS numrows	FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen!='0'
		$iTipe
		$iStp
		 AND log_aksi LIKE '$blt%'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

    function get_log_dokumen($bulan,$tahun,$cari,$mulai,$batas,$tipe,$aksi,$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iTipe = ($tipe=="")?"":" AND a.tipe_dokumen='$tipe'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT a.*,b.nip_baru
		FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen!='0' AND log_aksi LIKE '$blt%'
		$iTipe
		$iStp
		ORDER BY a.log_aksi DESC,a.nip_baru ASC,a.tipe_dokumen ASC,a.id_reff ASC LIMIT $mulai,$batas";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}


//////////////////////////////////
//////////////////////////////////
//////////////////////////////////
    function hitung_log_dokumen_TOTAL($bulan,$tahun,$cari,$tipe,$aksi,$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iTipe = ($tipe=="")?"":" AND a.tipe_dokumen='$tipe'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT COUNT(a.id_dokumen) AS numrows	FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen!='0'
		$iTipe
		$iStp";
//		 AND log_aksi LIKE '$blt%'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

    function get_log_dokumen_TOTAL($bulan,$tahun,$cari,$mulai,$batas,$tipe,$aksi,$stp=""){
		$blt = $tahun."-".$bulan."-";
		$iTipe = ($tipe=="")?"":" AND a.tipe_dokumen='$tipe'";
		$iStp = ($stp=="")?"":" AND b.status_kepegawaian='$stp'";
		$sqlstr="SELECT a.*,b.nip_baru
		FROM r_peg_dokumen a
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.halaman_item_dokumen!='0'
		$iTipe
		$iStp
		ORDER BY a.log_aksi DESC,a.nip_baru ASC,a.tipe_dokumen ASC,a.id_reff ASC LIMIT $mulai,$batas";
		$hslquery = $this->db->query($sqlstr)->result();
//		AND a.halaman_item_dokumen!='0' AND log_aksi LIKE '$blt%'
		return $hslquery;
	}
//////////////////////////////////
//////////////////////////////////
//////////////////////////////////




    function hitung_log_delta($bulanp,$tahunp,$bulan,$tahun,$cari,$aksi,$tipe){
		if($aksi=="tambah"){
			$blnA = $bulan;
			$blnB = $bulanp;
			$thnA = $tahun;
			$thnB = $tahunp;
		} else {
			$blnA = $bulanp;
			$blnB = $bulan;
			$thnA = $tahunp;
			$thnB = $tahun;
		}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM r_pegawai_bulanan a
		WHERE  
		a.bulan='$blnA' AND a.tahun='$thnA' AND a.status_kepegawaian='pns'
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_bulanan WHERE bulan='$blnB' AND tahun='$thnB' AND status_kepegawaian='pns')";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

    function get_log_delta($bulanp,$tahunp,$bulan,$tahun,$cari,$mulai,$batas,$aksi,$tipe){
		if($aksi=="tambah"){
			$blnA = $bulan;
			$blnB = $bulanp;
			$thnA = $tahun;
			$thnB = $tahunp;
		} else {
			$blnA = $bulanp;
			$blnB = $bulan;
			$thnA = $tahunp;
			$thnB = $tahun;
		}
		$sqlstr="SELECT a.*,b.*,c.id_pegawai AS id_pensiun,d.id_pegawai AS id_meninggal,e.id_pegawai AS id_keluar
		FROM r_pegawai_bulanan a
		LEFT JOIN r_pegawai b ON a.id_pegawai=b.id_pegawai
		LEFT JOIN r_pegawai_pensiun c ON a.id_pegawai=c.id_pegawai
		LEFT JOIN r_pegawai_meninggal d ON a.id_pegawai=d.id_pegawai
		LEFT JOIN r_pegawai_keluar e ON a.id_pegawai=e.id_pegawai
		WHERE  
		a.bulan='$blnA' AND a.tahun='$thnA' AND a.status_kepegawaian='pns'
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_bulanan WHERE bulan='$blnB' AND tahun='$thnB' AND status_kepegawaian='pns')
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}



}
