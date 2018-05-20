<?php
class M_njs2017 extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_bulanan($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stkp="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "AND a.kode_ese='99'";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "AND a.tugas_tambahan!='Kepala Sekolah'";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stkp=="all"){	$iStkp = "";	} else {	$iStkp = "AND a.status_kepegawaian='$stkp'";	}

		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE a.id_pegawai NOT IN (SELECT id_pegawai FROM p_mut_rancangan_pemangku WHERE id_rancangan=0)
		AND (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iStkp
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_bulanan($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stkp="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "AND a.kode_ese='99'";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "AND a.tugas_tambahan!='Kepala Sekolah'";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stkp=="all"){	$iStkp = "";	} else {	$iStkp = "AND a.status_kepegawaian='$stkp'";	}

		$sqlstr="SELECT 
		a.id_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.tmt_pangkat,a.tmt_jabatan,a.kode_golongan,a.nomenklatur_jabatan,a.tugas_tambahan,a.jab_type,a.kode_unor,a.nama_jenjang,a.kode_ese,
		FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(a.tmt_pangkat,'%Y%m%d'))/10000) AS mk_gol_tahun,
		FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(a.tmt_pangkat,'%m%d'))/100) %12 AS mk_gol_bulan,
		b.nama_pegawai,b.nip_baru,b.gender,b.agama,b.tempat_lahir,b.tanggal_lahir,
		d.tmt_cpns,
		e.tmt_pns,
		c.nomenklatur_pada
		FROM r_pegawai_aktual a
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE a.id_pegawai NOT IN (SELECT id_pegawai FROM p_mut_rancangan_pemangku WHERE id_rancangan=0)
		AND (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iStkp
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,d.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
}
