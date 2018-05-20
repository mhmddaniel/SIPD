<?php
class M_apel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_apel($lokasi=""){
		$this->db->from('ubina_apel');
		if($lokasi!=""){
			$this->db->where('lokasi_apel',$lokasi);
		}
		$this->db->order_by('tanggal_apel','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_apel($id_apel){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_apel) AS hari_apel,a.tanggal_apel AS tg_apel, DATE_FORMAT(a.tanggal_apel,'%m') AS bulan_apel, DATE_FORMAT(a.tanggal_apel,'%Y') AS tahun_apel, DATE_FORMAT(a.tanggal_apel,'%d-%m-%Y') AS tanggal_apel FROM ubina_apel a WHERE a.id_apel='$id_apel'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_apel_pegawai($id_apel,$idpeg){
		$sqlstr="SELECT a.*,b.* FROM ubina_apel_wajib a LEFT JOIN (ubina_apel_lokasi b) ON (a.id_lokasi=b.id_lokasi) WHERE a.id_apel='$id_apel' AND a.id_pegawai='$idpeg'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function get_akhir_apel($iHari){
		$sqlstr="SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel<='$iHari'";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;	
	}
	function get_maju_apel($iHari){
		$sqlstr="SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel>'$iHari' ORDER BY tanggal_apel ASC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function get_mundur_apel($iHari){
		$sqlstr="SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel<'$iHari' ORDER BY tanggal_apel DESC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function maju_hari($iHari){
		$sqlstr="SELECT *,(tanggal_apel+ INTERVAL 1 DAY) AS tanggalMaju FROM ubina_apel WHERE id_apel='$iHari'";
		$hslquery = $this->db->query($sqlstr)->row();
		$hariMaju = $hslquery->tanggalMaju;

		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_apel) AS hari_kerja, DATE_FORMAT(a.tanggal_apel,'%d-%m-%Y') AS tanggalK FROM ubina_apel a WHERE a.tanggal_apel='$hariMaju'";
		$hslquery = $this->db->query($sqlstr)->row();
		if(empty($hslquery)){
			$this->db->set('tanggal_apel',$hariMaju);
			$this->db->insert('ubina_apel');
		}

		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_apel) AS hari_kerja, DATE_FORMAT(a.tanggal_apel,'%d-%m-%Y') AS tanggalK FROM ubina_apel a WHERE a.tanggal_apel='$hariMaju'";
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
	function hitung_wajib_apel_N($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stt,$lokasi,$idd){
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
		LEFT JOIN (r_pegawai_aktual a,r_peg_cpns d,r_peg_pns e,r_pegawai c)
		ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai)		
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
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
	function get_wajib_apel_N($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stt,$lokasi,$idd){
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

		$sqlstr="SELECT b.id_wajib,b.status,b.apel_masuk,g.lokasi,a.*
		FROM ubina_apel_wajib b
		LEFT JOIN (r_pegawai_aktual a,r_peg_cpns d,r_peg_pns e,r_pegawai c,ubina_apel_lokasi g)
		ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai AND b.id_lokasi=g.id_lokasi)		
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
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
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,a.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_belum($cari,$unor="all",$kode,$pns="all",$ese,$pkt,$jbt,$tugas,$gender,$agama,$status,$jenjang,$lokasi,$idd){
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			if($lokasi==0){	$iLokasi = "";	} else {	$iLokasi = "AND b.id_lokasi='$lokasi'";	}


		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND a.status_kepegawaian='pns'
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM ubina_apel_wajib WHERE id_apel='$idd')
		$iPkt
		$iJbt
		$iPns
		$iUnor
		$iTugas
		$iGender
		$iAgama
		$iEse
		$iStatus
		$iJenjang
		$iLokasi
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_belum($cari,$mulai,$batas,$unor="all",$kode,$pns="all",$ese,$pkt,$jbt,$tugas,$gender,$agama,$status,$jenjang,$lokasi,$idd){
			$ttIni = date('Y')."-".date('m')."-01";
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			if($lokasi==0){	$iLokasi = "";	} else {	$iLokasi = "AND b.id_lokasi='$lokasi'";	}

		$sqlstr="SELECT 
		a.id_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.tmt_pangkat,a.tmt_jabatan,a.kode_golongan,a.nomenklatur_jabatan,a.tugas_tambahan,a.jab_type,a.kode_unor,
		FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(a.tmt_pangkat,'%Y%m%d'))/10000) AS mk_gol_tahun,
		FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(a.tmt_pangkat,'%m%d'))/100) %12 AS mk_gol_bulan,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,b.agama,
		d.tmt_cpns,
		e.tmt_pns,
		c.nomenklatur_pada
		FROM r_pegawai_aktual a
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND a.status_kepegawaian='pns'
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM ubina_apel_wajib WHERE id_apel='$idd')
		$iPkt
		$iJbt
		$iPns
		$iUnor
		$iEse
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iLokasi
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,a.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_apel_wajib($id_apel){
		$sql = "SELECT b.* FROM ubina_apel_wajib a LEFT JOIN r_pegawai_aktual b ON a.id_pegawai=b.id_pegawai WHERE a.id_apel='$id_apel'";
		$hslquery = $this->db->query($sql)->result();
		return $hslquery;
	}

	function ini_wajib($idWajib){
		$sql = "SELECT a.*,b.* FROM ubina_apel_wajib a LEFT JOIN r_pegawai_aktual b ON a.id_pegawai=b.id_pegawai WHERE a.id_wajib='$idWajib'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}

	function cek_wajib($id_apel,$id_pegawai){
		$sql = "SELECT id_wajib FROM ubina_apel_wajib WHERE id_apel='$id_apel' AND id_pegawai='$id_pegawai'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}

	function tambah_wajib_apel($id_apel,$id_lokasi,$isi){
		foreach($isi['id_pegawai'] AS $key=>$val){
			$this->db->set('id_apel',$id_apel);
			$this->db->set('id_lokasi',$id_lokasi);
			$this->db->set('id_pegawai',$val);
			$this->db->set('status','TK');
			$this->db->insert('ubina_apel_wajib');
		}
	}
	function copy_wajib_apel($id_ini,$id_apel){
		$sql = "SELECT a.* FROM ubina_apel_wajib a WHERE a.id_apel='$id_apel'";
		$hslquery = $this->db->query($sql)->result();
		foreach($hslquery AS $key=>$val){
			$cek = $this->cek_wajib($id_ini,$val->id_pegawai);
			if(empty($cek)){
				$this->db->set('id_apel',$id_ini);
				$this->db->set('id_lokasi',$val->id_lokasi);
				$this->db->set('id_pegawai',$val->id_pegawai);
				$this->db->set('status','TK');
				$this->db->insert('ubina_apel_wajib');
			}
		}
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////
	function edit_keterangan($idd,$isi){
			$this->db->set('keterangan',$isi);
			$this->db->where('id_apel',$idd);
			$this->db->update('ubina_apel');
	}
	function cek_apel_pegawai($tg,$idPeg){
		$sqlstr="SELECT a.*	FROM ubina_apel_wajib a LEFT JOIN ubina_apel b ON (a.id_apel=b.id_apel) WHERE b.tanggal_apel='$tg' AND a.id_pegawai='$idPeg'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
	function hapus_wajib_apel($idp,$idpeg){
			$this->db->where('id_apel',$idp);
			$this->db->where('id_pegawai',$idpeg);
			$this->db->delete('ubina_apel_wajib');
	}
	function hapus_semua($idH){
		$sqlstr="DELETE FROM ubina_apel_wajib WHERE id_apel='$idH' AND apel_masuk='00:00:00'";
		$this->db->query($sqlstr);
	}
	function hadir_wajib_apel($idd,$status){
			$this->db->set('status',$status);
			$this->db->where('id_wajib',$idd);
			$this->db->update('ubina_apel_wajib');
	}
	function pindah_wajib_apel($idl,$idp,$idpeg){
			$this->db->set('id_lokasi',$idl);
			$this->db->where('id_apel',$idp);
			$this->db->where('id_pegawai',$idpeg);
			$this->db->update('ubina_apel_wajib');
	}
	function ijin_wajib_apel($idd,$status){
			$sqA = "SELECT a.id_pegawai FROM ubina_harian_wajib a WHERE a.id_wajib='$idd'";
			$qrA = $this->db->query($sqA)->row();
			$tg = date('Y-m-d');
			$sqB = "SELECT a.id_apel FROM ubina_apel a WHERE a.tanggal_apel='$tg'";
			$qrB = $this->db->query($sqB)->row();
			$sqlstr="UPDATE ubina_apel_wajib SET status='$status',apel_masuk='00:00:01' WHERE id_pegawai='".$qrA->id_pegawai."' AND id_apel='".$qrB->id_apel."'";
			$this->db->query($sqlstr);
	}
///////////////////////////////////////////////////////////////////////
	function tambah_jadual_apel($isi){
			$this->db->set('tanggal_apel',$isi['tanggal_apel']);
			$this->db->set('waktu',$isi['waktu']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->insert('ubina_apel');
			$id_apel = $this->db->insert_id();
			return $id_apel;
	}
/*
	function edit_jadual_apel($idd,$isi){
			$this->db->set('tanggal_apel',$isi['tanggal_apel']);
			$this->db->set('waktu',$isi['waktu']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->where('id_apel',$idd);
			$this->db->update('ubina_apel');
	}
*/
//////////////////////////////////////////////////////////////////////////////////
	function hitung_daftar($th,$bl){
		$thh = $th."-".$bl."-";
		$sqlstr="SELECT COUNT(b.id_apel) AS numrows	FROM ubina_apel b WHERE b.tanggal_apel LIKE '$thh%'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_daftar($th,$bl){
		$thh = $th."-".$bl."-";
		$sqlstr="SELECT a.*,a.tanggal_apel AS tg_apel, DAYNAME(a.tanggal_apel) AS hari_apel, DATE_FORMAT(a.tanggal_apel,'%d-%m-%Y') AS tanggal_apel FROM ubina_apel a WHERE a.tanggal_apel LIKE '$thh%' ORDER BY a.tanggal_apel ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_lokasi($cari){
		$sqlstr="SELECT *	FROM ubina_apel_lokasi WHERE id_lokasi='$cari'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
	function hitung_lokasi($cari){
		$sqlstr="SELECT COUNT(b.id_lokasi) AS numrows	FROM ubina_apel_lokasi b";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_lokasi($mulai,$batas){
		$sqlstr="SELECT a.* FROM ubina_apel_lokasi a ORDER BY a.kode_lokasi ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function lokasi_tambah($isi){
			$this->db->set('kode_lokasi',$isi['kode_lokasi']);
			$this->db->set('lokasi',$isi['lokasi']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->insert('ubina_apel_lokasi');
	}
	function lokasi_edit($isi){
			$this->db->set('kode_lokasi',$isi['kode_lokasi']);
			$this->db->set('lokasi',$isi['lokasi']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->where('id_lokasi',$isi['id_lokasi']);
			$this->db->update('ubina_apel_lokasi');
	}
	function lokasi_hapus($isi){
			$this->db->where('id_lokasi',$isi['id_lokasi']);
			$this->db->delete('ubina_apel_lokasi');
	}
	function cek_lokasi($cari){
		$sqlstr="SELECT * FROM ubina_apel_wajib WHERE id_lokasi='$cari'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
/////////////////////////////////////////////////////
	function get_absensi_apel($idd,$per){
		$sqlstr="SELECT a.id_apel,a.status,DAYNAME(b.tanggal_apel) AS hari_apel, DATE_FORMAT(b.tanggal_apel,'%d-%m-%Y') AS tanggal,b.tanggal_apel,b.waktu,b.keterangan,c.lokasi
		FROM ubina_apel_wajib a 
		LEFT JOIN (ubina_apel b, ubina_apel_lokasi c) ON (a.id_apel=b.id_apel AND a.id_lokasi=c.id_lokasi)
		WHERE a.id_pegawai='$idd'
		AND b.tanggal_apel>='$per' AND b.tanggal_apel < '$per'+ INTERVAL 1 MONTH
		ORDER BY b.tanggal_apel ASC";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}


}
