<?php
class M_dashboard_edisiplin extends CI_Model{
	function __construct(){
		parent::__construct();
	}
///////////////////////////////////////////
	function get_akhir_harian($iHari){
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<='$iHari' ORDER BY tanggal_harian DESC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function ini_harian($id_harian){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%m') AS bulan_harian, DATE_FORMAT(a.tanggal_harian,'%Y') AS tahun_harian,a.tanggal_harian AS tg_harian, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggal_harian FROM ubina_harian a WHERE a.id_harian='$id_harian'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function get_maju_harian($iHari){
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian>'$iHari' ORDER BY tanggal_harian ASC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function get_mundur_harian($iHari){
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<'$iHari' ORDER BY tanggal_harian DESC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function hitung_wajib_hadir($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$idh,$idj,$hdr="all",$blh,$thh){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese LIKE '$ese%'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND c.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND c.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, c.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($idj==0){	$iJamKerja = "";	} else {	$iJamKerja = "AND b.id_jam='$idj'";	}
			if($hdr=="all"){	$iHadir = "";	} else {	$iHadir = "AND b.status='$hdr'";	}

		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM ubina_harian_wajib b
		LEFT JOIN (r_pegawai_bulanan a,r_peg_cpns d,r_peg_pns e,r_pegawai c)
		ON (b.id_pegawai=a.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai)
		WHERE a.bulan='$blh' AND a.tahun='$thh'
 		AND b.id_harian='$idh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iJamKerja
		$iHadir
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_wajib_hadir($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$idh,$idj,$hdr="all",$blh,$thh){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese LIKE '$ese%'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND c.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND c.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, c.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($idj==0){	$iJamKerja = "";	} else {	$iJamKerja = "AND b.id_jam='$idj'";	}
			if($hdr=="all"){	$iHadir = "";	} else {	$iHadir = "AND b.status='$hdr'";	}

		$sqlstr="SELECT 
		b.id_wajib,b.absen_masuk,b.absen_pulang,b.status,b.selisih_masuk,b.selisih_pulang,SEC_TO_TIME(b.selisih_masuk) as telat_masuk,SEC_TO_TIME(b.selisih_pulang) as cepat_pulang,
		a.id_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.kode_golongan,a.nomenklatur_jabatan,a.tugas_tambahan,
		c.nama_pegawai,c.nip_baru,c.gender,
		f.nomenklatur_pada
		FROM ubina_harian_wajib b
		LEFT JOIN (r_pegawai_bulanan a,r_pegawai c,r_peg_cpns d,r_peg_pns e,m_unor f)
		ON (b.id_pegawai=a.id_pegawai AND a.id_pegawai=c.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_unor=f.id_unor)
		WHERE a.bulan='$blh' AND a.tahun='$thh'
 		AND b.id_harian='$idh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
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
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iJamKerja
		$iHadir
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,d.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////
///////////////////////////////////////////
	function get_lokasi($mulai,$batas){
		$sqlstr="SELECT a.* FROM ubina_apel_lokasi a ORDER BY a.kode_lokasi ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_akhir_apel($iHari){
		$sqlstr="SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel<='$iHari'";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;	
	}
	function ini_apel($id_apel){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_apel) AS hari_apel,a.tanggal_apel AS tg_apel, DATE_FORMAT(a.tanggal_apel,'%m') AS bulan_apel, DATE_FORMAT(a.tanggal_apel,'%Y') AS tahun_apel, DATE_FORMAT(a.tanggal_apel,'%d-%m-%Y') AS tanggal_apel FROM ubina_apel a WHERE a.id_apel='$id_apel'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_wajib_apel($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stt,$lokasi,$idd,$blh,$thh){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	
				if($ese=="2"){
					$iEse = "AND (a.kode_ese='21' OR a.kode_ese='22')";
				} elseif($ese=="3") {
					$iEse = "AND (a.kode_ese='31' OR a.kode_ese='32')";
				} elseif($ese=="4") {
					$iEse = "AND (a.kode_ese='41' OR a.kode_ese='42')";
				} elseif($ese=="5") {
					$iEse = "AND (a.kode_ese='51' OR a.kode_ese='52')";
				} elseif($ese=="99") {
					$iEse = "AND a.kode_ese='99'";
				}
			}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND c.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND c.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, c.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stt=="all"){	$iStt = "";	} else {
				if($stt=="TK"){
					$iStt = "AND (b.status='TK' OR b.status='pending')";	
				} elseif($stt=="TH")	{
					$iStt = "AND (b.status='TK' OR b.status='pending' OR b.status='S' OR b.status='I' OR b.status='DL' OR b.status='C')";	
				} else {
					$iStt = "AND b.status='$stt'";	
				}
			}
			if($lokasi==0){	$iLokasi = "";	} else {	$iLokasi = "AND b.id_lokasi='$lokasi'";	}

		$sqlstr="SELECT COUNT(b.id_pegawai) AS numrows
		FROM ubina_apel_wajib b
		LEFT JOIN (r_pegawai_bulanan a,r_peg_cpns d,r_peg_pns e,r_pegawai c)
		ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai)		
		WHERE a.bulan='$blh' AND a.tahun='$thh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND b.id_apel='$idd'
 		$iPns
		$iStt
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
		$iLokasi
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_wajib_apel($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stt,$lokasi,$idd,$blh,$thh){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	
				if($ese=="2"){
					$iEse = "AND (a.kode_ese='21' OR a.kode_ese='22')";
				} elseif($ese=="3") {
					$iEse = "AND (a.kode_ese='31' OR a.kode_ese='32')";
				} elseif($ese=="4") {
					$iEse = "AND (a.kode_ese='41' OR a.kode_ese='42')";
				} elseif($ese=="5") {
					$iEse = "AND (a.kode_ese='51' OR a.kode_ese='52')";
				} elseif($ese=="99") {
					$iEse = "AND a.kode_ese='99'";
				}
			}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND c.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND c.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, c.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stt=="all"){	$iStt = "";	} else {
				if($stt=="TK"){
					$iStt = "AND (b.status='TK' OR b.status='pending')";	
				} elseif($stt=="TH")	{
					$iStt = "AND (b.status='TK' OR b.status='pending' OR b.status='S' OR b.status='I' OR b.status='DL' OR b.status='C')";	
				} else {
					$iStt = "AND b.status='$stt'";	
				}
			}
			if($lokasi==0){	$iLokasi = "";	} else {	$iLokasi = "AND b.id_lokasi='$lokasi'";	}

		$sqlstr="SELECT b.id_wajib,b.status,b.apel_masuk,a.*,
		c.nama_pegawai,c.nip_baru,c.gender,
		f.nomenklatur_pada,
		g.lokasi
		FROM ubina_apel_wajib b
		LEFT JOIN (r_pegawai_bulanan a,r_peg_cpns d,r_peg_pns e,r_pegawai c,m_unor f,ubina_apel_lokasi g)
		ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai AND a.id_unor=f.id_unor AND b.id_lokasi=g.id_lokasi)		
		WHERE a.bulan='$blh' AND a.tahun='$thh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND b.id_apel='$idd'
 		$iPns
		$iStt
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
		$iLokasi
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,d.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////

}
