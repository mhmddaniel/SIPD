<?php
class M_cuti extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_cuti($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT COUNT(n.id_cuti) AS numrows
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function hitung_cuti1($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT COUNT(n.id_cuti) AS numrows
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
			LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND (z.status='koreksi' OR z.status='aju')

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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	
	function hitung_cuti_acc($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT COUNT(n.id_cuti) AS numrows
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
			LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND z.status='acc'
		
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function notif($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
            LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND z.status = 'revisi'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.id_cuti
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function notif2($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
            LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND z.status = 'acc' AND z.terima = '0'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.id_cuti
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function notif3($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
            LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND z.status = 'aju' OR z.status = 'koreksi'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.id_cuti
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function get_cuti($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.id_cuti
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function get_cuti1($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
            LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)			
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND (z.status='koreksi' OR z.status='aju')
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.buat DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function get_cuti_acc($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan
		FROM r_peg_cuti_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
            LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)			
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		AND z.status='acc'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.buat ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function ini_cuti($idd){
		$sqlstr="SELECT a.*, b.nama_pegawai, b.nip_baru, c.nomenklatur_pada,
		o.kode_jenis_cuti AS kode_jenis_cuti,o.kode_tujuan AS kode_tujuan,o.kode_pp AS kode_pp,o.sk_nomor,o.sk_tanggal,o.mk_gol_tahun,o.mk_gol_bulan,o.kredit_utama,o.kredit_tambahan,o.tmt_golongan,o.bkn_nomor,o.bkn_tanggal
		FROM r_peg_cuti_aju a 
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		LEFT JOIN (r_peg_cuti o) ON (a.id_peg_cuti=o.id_peg_cuti)
		WHERE a.id_cuti='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_catatan($idd,$stct=""){
		$this->db->from('r_peg_cuti_catatan');
		$this->db->where('id_cuti',$idd);
		if($stct!=""){
		$this->db->where('status',$stct);
		}
		$this->db->order_by('id_catatan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_catatan($idd){
		$this->db->from('r_peg_cuti_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function save_catatan($idd,$isi){
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status',"ditanya");
        $this->db->set('last_updated',"NOW()",false);
		if($isi['id_catatan']==""){
		$this->db->set('id_cuti',$idd);
		$this->db->insert('r_peg_cuti_catatan');
		} else {
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_cuti_catatan');
		}
	}
	function save_jawaban($isi){
		$this->db->set('jawaban',$isi['jawaban']);
		$this->db->set('status',"dijawab");
        $this->db->set('waktu',"NOW()",false);
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_cuti_catatan');
	}
	function hapus_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('r_peg_cuti_catatan');
	}
//////////////////////////////////////////////////////////////////////////////////
	function tambah_pemohon($pegawai){
		$agenda = $this->get_last_agenda();
		$this->db->set('no_agenda',$agenda);
		$this->db->insert('r_agenda');
		$id_agenda = $this->db->insert_id();
		$this->db->set('id_agenda',$id_agenda);
		$this->db->set('id_pegawai',$pegawai->id_pegawai);
		$this->db->set('id_peg_cuti',$pegawai->id_peg_cuti);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
		$this->db->set('id_unor',$pegawai->id_unor);
		$this->db->set('kode_golongan',$pegawai->kode_golongan);
		$this->db->set('jab_type',$pegawai->jab_type);
		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);
		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);
		$this->db->set('alasan_cuti',$pegawai->alasan_cuti);
		$this->db->set('tanggal_mulai_cuti',date('Y-m-d',strtotime($pegawai->tanggal_mulai_cuti)));
		$this->db->set('tanggal_sampai_cuti',date('Y-m-d',strtotime($pegawai->tanggal_sampai_cuti)));
		//$this->db->set('alasan_cuti',$pegawai->alasan_cuti);		
		$this->db->set('status',"draft");
        $this->db->set('buat',"NOW()",false);
		$this->db->insert('r_peg_cuti_aju');
		$this->db->insert_id();
	}
	
	function get_last_agenda()
	 {
	  $this->db->select_max('no_agenda');
	  $query = $this->db->get('r_agenda');

	  $no_agenda = $query->row('no_agenda')+1;

	  return $no_agenda; 
	 }
	
	function golongan_tambah($isi){
		$this->db->set('kode_jenis_cuti',$isi['kode_jenis_cuti']);
		$this->db->set('kode_tujuan',$isi['kode_tujuan']);
		$this->db->set('kode_pp',$isi['kode_pp']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_cuti');
		$id_peg_golongan = $this->db->insert_id();
		return $id_peg_golongan;
	}

	function cuti_edit($isi){
		$this->db->set('tanggal_mulai_cuti',date('Y-m-d',strtotime($isi['tanggal_mulai_cuti'])));
		$this->db->set('tanggal_sampai_cuti',date('Y-m-d',strtotime($isi['tanggal_sampai_cuti'])));
		$this->db->set('alasan_cuti',$isi['alasan_cuti']);
		$this->db->where('id_cuti',$isi['id_cuti']);
		$this->db->update('r_peg_cuti_aju');
		
		$ini = $this->ini_cuti($isi['id_cuti']);
		if($isi['kode_tujuan']==2){
			$isi['kode_pp']=0;	
		}
		if($isi['kode_jenis_cuti']!=7){
			$isi['kode_tujuan']=0;
		}

		$this->db->set('kode_jenis_cuti',$isi['kode_jenis_cuti']);
		$this->db->set('kode_tujuan',$isi['kode_tujuan']);
		$this->db->set('kode_pp',$isi['kode_pp']);
		
		$this->db->where('id_peg_cuti',$ini->id_peg_cuti);
		$this->db->update('r_peg_cuti');
	}

	function cuti_edit_admin($isi){
		$this->db->set('tanggal_mulai_cuti',date('Y-m-d',strtotime($isi['tanggal_mulai_cuti'])));
		$this->db->set('tanggal_sampai_cuti',date('Y-m-d',strtotime($isi['tanggal_sampai_cuti'])));
		$this->db->set('alasan_cuti',$isi['alasan_cuti']);
		$this->db->set('hari_libur',$isi['hari_libur']);
		$this->db->where('id_cuti',$isi['id_cuti']);
		$this->db->update('r_peg_cuti_aju');
		
		$ini = $this->ini_cuti($isi['id_cuti']);
		//$this->db->set('kode_jenis_cuti',$isi['kode_jenis_cuti']);
		$this->db->set('kode_tujuan',$isi['kode_tujuan']);
		if($isi['kode_tujuan']==2){
			$isi['kode_pp']=0;	
		}


		$this->db->set('kode_pp',$isi['kode_pp']);
		
		$this->db->where('id_peg_cuti',$ini->id_peg_cuti);
		$this->db->update('r_peg_cuti');
	}
	
	function cuti_terima($isi){
		$this->db->set('terima',"1");
		$this->db->where('id_cuti',$isi['id_cuti']);
		$this->db->update('r_peg_cuti_aju');
	}

	function ajukan_pemohon($idd){
		$this->db->set('status',"aju");
        $this->db->set('aju',"NOW()",false);
		$this->db->where('id_cuti',$idd);
		$this->db->update('r_peg_cuti_aju');
	}
	function draft_pemohon($idd){
        $this->db->set('draft',"NOW()",false);
		$this->db->where('id_cuti',$idd);
		$this->db->update('r_peg_cuti_aju');
	}
	function koreksi_pemohon($idd){
		$this->db->set('status',"koreksi");
        $this->db->set('koreksi',"NOW()",false);
		$this->db->where('id_cuti',$idd);
		$this->db->update('r_peg_cuti_aju');
	}
	function acc_pemohon($isi){
		$this->db->set('status',"acc");
        $this->db->set('acc',"NOW()",false);
		$this->db->where('id_cuti',$isi['id_cuti']);
		$this->db->update('r_peg_cuti_aju');

		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
		$dJenis = $this->dropdowns->kode_jenis_kp();
		$dCuti = $this->dropdowns->kode_jenis_cuti();
		$dTujuan = $this->dropdowns->kode_jenis_tujuan();
		$sk_tanggal = date("Y-m-d", strtotime($isi['tanggal']));
		/* $tmt_golongan = date("Y-m-d", strtotime($isi['tmt_golongan']));
		$bkn_tanggal = date("Y-m-d", strtotime($isi['bkn_tanggal'])); */
		
		$ini = $this->ini_cuti($isi['id_cuti']);
		$nama_pangkat = $dWpangkat[$ini->kode_golongan];
		$nama_tujuan = $dTujuan[$ini->kode_jenis_tujuan];
		$jenis_kp = $dCuti[$ini->kode_jenis_cuti];
		$this->db->set('id_pegawai',$ini->id_pegawai);
		/* $this->db->set('tmt_golongan',$tmt_golongan); *//* 
		$this->db->set('nama_pangkat',$nama_pangkat); */
		$this->db->set('nama_tujuan',$nama_tujuan);
		$this->db->set('jenis_cuti',$jenis_kp);
		$this->db->set('sk_nomor',$isi['nomor']);
		$this->db->set('sk_tanggal',$sk_tanggal);
		/* $this->db->set('bkn_nomor',$isi['bkn_nomor']);
		$this->db->set('bkn_tanggal',$bkn_tanggal);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('kredit_utama',$isi['kredit_utama']);
		$this->db->set('kredit_tambahan',$isi['kredit_tambahan']); */ 
        $this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_peg_cuti',$ini->id_peg_cuti);
		$this->db->update('r_peg_cuti');
		
		
		if($ini->kode_jenis_cuti==7){
			$this->db->select('sisa_cuti');
			$this->db->where('id_pegawai',$ini->id_pegawai);
			$query = $this->db->get('r_peg_cuti_tahunan');
			
			
			/* $tanggal_mulai_cuti = date("d-m-Y", strtotime($ini->tanggal_mulai_cuti));
			$tanggal_sampai_cuti = date("d-m-Y", strtotime($ini->tanggal_sampai_cuti));
			$diff = date_diff($tanggal_mulai_cuti,$tanggal_sampai_cuti); */
			
			$date1=date_create($ini->tanggal_mulai_cuti);
			$date2=date_create($ini->tanggal_sampai_cuti);
			$diff=date_diff($date1,$date2);
			
			$row = count($query->row());
			
			if($row==0){
				$tahun_sekarang = date("Y-m-d");
				$this->db->set('id_pegawai',$ini->id_pegawai);
				$this->db->set('tahun',$tahun_sekarang);
				$this->db->set('sisa_cuti',12-$diff->format("%d"));
			 	$this->db->insert('r_peg_cuti_tahunan'); 
			}
			else{
				
				$sisa_cuti = $query->row('sisa_cuti');
				$tahun_sekarang = date("Y-m-d");
				$this->db->set('id_pegawai',$ini->id_pegawai);
				$this->db->set('tahun',$tahun_sekarang);
 				$this->db->set('sisa_cuti', $sisa_cuti - $diff->format("%d"));
				$this->db->update('r_peg_cuti_tahunan');
			}
		}
		
	}

	function btl_pemohon($isi){
		$this->db->set('status',"revisi");
        $this->db->set('revisi',"NOW()",false);
		$this->db->where('id_cuti',$isi['id_cuti']);
		$this->db->update('r_peg_cuti_aju');
	}

//////////////////////////////////////////////////////////////////////////////////
	function ijin_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ijin_pimpinan',$tIsi);
		$this->db->set('nama_pimpinan_ijin',$isi['nama_pimpinan']);
		$this->db->set('jabatan_pimpinan_ijin',$isi['jabatan']);
		$this->db->set('nomor_pimpinan_ijin',$isi['nomor']);
		$this->db->set('tanggal_surat_ijin',$isi['tanggal']);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function keterangan_dokter_edit($isi){
		$tIsi = "{\"nama_dokter\":\"".$isi['nama_dokter']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('keterangan_dokter',$tIsi);
		$this->db->set('nama_dokter',$isi['nama_dokter']);
		$this->db->set('tanggal_surat_ijin',$isi['tanggal']);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function keterangan_hamil_edit($isi){
		$tIsi = "{\"nama_dokter\":\"".$isi['nama_dokter']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('keterangan_hamil',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function kartu_keluarga_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('kartu_keluarga',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function buku_nikah_suami_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('buku_nikah_suami',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function buku_nikah_istri_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('buku_nikah_istri',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function bpih_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('bpih',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function pbb_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('pbb',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function lunas_pbb_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('lunas_pbb',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function ktp_suami_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ktp_suami',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function ktp_istri_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ktp_istri',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
	function surat_nikah_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('surat_nikah',$tIsi);
		$this->db->where('id_cuti',$isi['idd']);
		$this->db->update('r_peg_cuti_aju');
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($id_cuti,$tipe){
		$this->db->from('r_peg_cuti_dokumen');
		$this->db->where('id_cuti',$id_cuti);
		$this->db->where('tipe',$tipe);
		$this->db->order_by('halaman','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_dokumen($idd,$tipe);
		$hal = count($ini)+1;
			$this->db->set('id_cuti',$idd);
			$this->db->set('tipe',$tipe);
			$this->db->set('cuti_file',$nama_file);
			$this->db->set('halaman',$hal);
//			$this->db->set('id_reff',$idd);
			$this->db->insert('r_peg_cuti_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
/*
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_thumb,file_dokumen,halaman_item_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$hal','$idd')";		
			$this->db->query($sqlstr);
*/
	}

	function rename_dokumen($idd,$nama){
		$this->db->set('cuti_file',$nama);
		$this->db->where('id_cuti_dokumen',$idd);
		$this->db->update('r_peg_cuti_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_cuti_dokumen');
		$this->db->where('id_cuti_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_cuti_dokumen', array('id_cuti_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_reff,$komponen);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_cuti_dokumen SET halaman='".($key+1)."' WHERE id_cuti_dokumen='".$val->id_cuti_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}

	function edit_keterangan_dokumen($isi){
		$this->db->set('keterangan',$isi['keterangan']);
		$this->db->set('sub_keterangan',$isi['sub_keterangan']);
		$this->db->where('id_cuti_dokumen',$isi['idd']);
		$this->db->update('r_peg_cuti_dokumen');
	}

}
