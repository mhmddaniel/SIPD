<?php
class M_harian extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_harian($lokasi=""){
		$this->db->from('ubina_apel');
		if($lokasi!=""){
			$this->db->where('lokasi_apel',$lokasi);
		}
		$this->db->order_by('tanggal_apel','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_harian($id_harian){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%m') AS bulan_harian, DATE_FORMAT(a.tanggal_harian,'%Y') AS tahun_harian,a.tanggal_harian AS tg_harian, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggal_harian FROM ubina_harian a WHERE a.id_harian='$id_harian'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function ini_harian_by_tanggal($tgl){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%m') AS bulan_harian, DATE_FORMAT(a.tanggal_harian,'%Y') AS tahun_harian,a.tanggal_harian AS tg_harian, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggal_harian FROM ubina_harian a WHERE a.tanggal_harian='$tgl'";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function get_akhir_harian($iHari){
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<='$iHari' ORDER BY tanggal_harian DESC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}

	function get_maju_harian($iHari){
//		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<='$iHari'+ INTERVAL 1 DAY ORDER BY tanggal_harian DESC LIMIT 0,1";
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian>'$iHari' ORDER BY tanggal_harian ASC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function get_mundur_harian($iHari){
//		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<='$iHari'- INTERVAL 1 DAY ORDER BY tanggal_harian DESC LIMIT 0,1";
		$sqlstr="SELECT a.* FROM ubina_harian a WHERE a.tanggal_harian<'$iHari' ORDER BY tanggal_harian DESC LIMIT 0,1";
		$hslquery = $this->db->query($sqlstr)->row();
		return $hslquery;	
	}
	function maju_hari($iHari){
		$sqlstr="SELECT *,(tanggal_harian+ INTERVAL 1 DAY) AS tanggalMaju FROM ubina_harian WHERE id_harian='$iHari'";
		$hslquery = $this->db->query($sqlstr)->row();
		$hariMaju = $hslquery->tanggalMaju;

		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggalK FROM ubina_harian a WHERE a.tanggal_harian='$hariMaju'";
		$hslquery = $this->db->query($sqlstr)->row();
		if(empty($hslquery)){
			$this->db->set('tanggal_harian',$hariMaju);
			$this->db->insert('ubina_harian');
		}

		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggalK FROM ubina_harian a WHERE a.tanggal_harian='$hariMaju'";
		$hslquery = $this->db->query($sqlstr)->row();

		return $hslquery;	
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_belum($idH,$cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}

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
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM ubina_harian_wajib WHERE id_harian='$idH')
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
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_belum($idH,$cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}

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
		AND a.id_pegawai NOT IN (SELECT id_pegawai FROM ubina_harian_wajib WHERE id_harian='$idH')
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
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,a.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
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
		AND a.status_kepegawaian='pns'
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
		f.nomenklatur_pada,
		g.jam_masuk,g.jam_pulang
		FROM ubina_harian_wajib b
		LEFT JOIN (r_pegawai_bulanan a,r_pegawai c,r_peg_cpns d,r_peg_pns e,m_unor f,ubina_harian_jam g)
		ON (b.id_pegawai=a.id_pegawai AND a.id_pegawai=c.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_unor=f.id_unor AND b.id_jam=g.id_jam)
		WHERE a.bulan='$blh' AND a.tahun='$thh'
 		AND b.id_harian='$idh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND a.status_kepegawaian='pns'
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
	function hitung_wajib_hadir_N($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$idh,$idj,$hdr="all",$blh,$thh){
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
		LEFT JOIN (r_pegawai_aktual a,r_peg_cpns d,r_peg_pns e,r_pegawai c)
		ON (b.id_pegawai=a.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_pegawai=c.id_pegawai)
		WHERE b.id_harian='$idh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND a.status_kepegawaian='pns'
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
	function get_wajib_hadir_N($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$idh,$idj,$hdr="all",$blh,$thh){
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
		LEFT JOIN (r_pegawai_aktual a,r_pegawai c,r_peg_cpns d,r_peg_pns e,m_unor f)
		ON (b.id_pegawai=a.id_pegawai AND a.id_pegawai=c.id_pegawai AND a.id_pegawai=d.id_pegawai AND a.id_pegawai=e.id_pegawai AND a.id_unor=f.id_unor)
		WHERE b.id_harian='$idh'
		AND  (
		c.nip_baru LIKE '$cari%'
		OR c.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		AND a.status_kepegawaian='pns'
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
	function ini_wajib_hadir($idw){
		$sqlstr="SELECT a.*	FROM ubina_harian_wajib a WHERE a.id_wajib='$idw'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_jam_kerja(){
		$sqlstr="SELECT COUNT(b.id_jam) AS numrows	FROM ubina_harian_jam b";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_jam_kerja($mulai,$batas){
		$sqlstr="SELECT a.* FROM ubina_harian_jam a ORDER BY a.id_jam ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function cek_jam_kerja($cari){
		$sqlstr="SELECT * FROM ubina_harian_wajib WHERE id_jam='$cari'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_daftar($th,$bl){
		$thh = $th."-".$bl."-";
		$sqlstr="SELECT COUNT(b.id_harian) AS numrows FROM ubina_harian b WHERE b.tanggal_harian LIKE '$thh%'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_daftar($th,$bl){
		$thh = $th."-".$bl."-";
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal_harian) AS hari_kerja, DATE_FORMAT(a.tanggal_harian,'%d-%m-%Y') AS tanggal_harian FROM ubina_harian a WHERE a.tanggal_harian LIKE '$thh%' ORDER BY a.tanggal_harian ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function cek_wajib($id_harian,$id_pegawai){
		$sql = "SELECT id_wajib FROM ubina_harian_wajib WHERE id_harian='$id_harian' AND id_pegawai='$id_pegawai'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}

	function tambah_wajib_hadir($id_harian,$id_jam,$isi){
		foreach($isi['id_pegawai'] AS $key=>$val){
			$this->db->set('id_harian',$id_harian);
			$this->db->set('id_jam',$id_jam);
			$this->db->set('id_pegawai',$val);
			$this->db->set('status','TK');
			$this->db->insert('ubina_harian_wajib');
		}
	}
	function tambah_semua($id_jam,$idH){
		$sqlstr="SELECT a.id_pegawai FROM r_pegawai_aktual a WHERE  a.id_pegawai NOT IN (SELECT id_pegawai FROM ubina_harian_wajib WHERE id_harian='$idH')";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->set('id_harian',$idH);
			$this->db->set('id_jam',$id_jam);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('status','TK');
			$this->db->insert('ubina_harian_wajib');
		}
	}
///////////////////////////////////////////////////////////////////////
	function tambah_jadual_harian($isi){
			$this->db->set('tanggal_harian',$isi['tanggal_harian']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->insert('ubina_harian');
			$id_apel = $this->db->insert_id();
			return $id_apel;
	}
	function edit_keterangan($idd,$isi){
			$this->db->set('keterangan',$isi);
			$this->db->where('id_harian',$idd);
			$this->db->update('ubina_harian');
	}
	function edit_jadual_harian($idd,$isi){
			$this->db->set('tanggal_harian',$isi['tanggal_harian']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->where('id_harian',$idd);
			$this->db->update('ubina_harian');
	}
	function copy_wajib_hadir($id_ini,$id_harian){
		$sql = "SELECT a.* FROM ubina_harian_wajib a WHERE a.id_harian='$id_harian'";
		$hslquery = $this->db->query($sql)->result();
		foreach($hslquery AS $key=>$val){
			$cek = $this->cek_wajib($id_ini,$val->id_pegawai);
			if(empty($cek)){
				$this->db->set('id_harian',$id_ini);
				$this->db->set('id_jam',$val->id_jam);
				$this->db->set('id_pegawai',$val->id_pegawai);
				$this->db->set('status','TK');
				$this->db->insert('ubina_harian_wajib');
			}
		}
	}
///////////////////////////////////////////////////////////////////////
	function hadir_wajib_hadir($idd,$status){
			$this->db->set('absen_pulang',"00:00:00");
			$this->db->set('status',$status);
			$this->db->where('id_wajib',$idd);
			$this->db->update('ubina_harian_wajib');

			$sqA = "SELECT a.id_pegawai FROM ubina_harian_wajib a WHERE a.id_wajib='$idd'";
			$qrA = $this->db->query($sqA)->row();
			$tg = date('Y-m-d');
			$sqB = "SELECT a.id_apel FROM ubina_apel a WHERE a.tanggal_apel='$tg'";
			$qrB = $this->db->query($sqB)->row();
			$sqlstr="UPDATE ubina_apel_wajib SET status='$status',apel_masuk='00:00:01' WHERE id_pegawai='".$qrA->id_pegawai."' AND id_apel='".$qrB->id_apel."'";
			$this->db->query($sqlstr);
	}
	function masuk_wajib_hadir($idd,$status){
			$this->db->set('absen_masuk',$status['absen_masuk']);
			$this->db->set('absen_pulang',"00:00:00");
			$this->db->set('status',"hadir");
			$this->db->where('id_wajib',$idd);
			$this->db->update('ubina_harian_wajib');

		$sql = "SELECT a.* FROM ubina_harian_wajib a WHERE a.id_wajib='$idd'";
		$hslquery = $this->db->query($sql)->row();
		$id_jam = $hslquery->id_jam;
		$absen_masuk = $hslquery->absen_masuk;

		$sql2 = "SELECT a.* FROM ubina_harian_jam a WHERE a.id_jam='$id_jam'";
		$hslquery2 = $this->db->query($sql2)->row();
		$jam_masuk = $hslquery2->jam_masuk;

/*		
		$selisih =  "TIMEDIFF('$absen_masuk','$jam_masuk')";
		
			$this->db->set('selisih_masuk',$selisih);
			$this->db->where('id_wajib',$idd);
			$this->db->update('ubina_harian_wajib');
*/
		$sqlstr="UPDATE ubina_harian_wajib SET selisih_masuk=TIMEDIFF('$absen_masuk','$jam_masuk') WHERE id_wajib='$idd'";
		$this->db->query($sqlstr);

	}
	function pulang_wajib_hadir($idd,$status){
			$this->db->set('absen_pulang',$status['absen_pulang']);
			$this->db->where('id_wajib',$idd);
			$this->db->update('ubina_harian_wajib');
	}
	function hapus_wajib_hadir($idh,$idpeg){
			$this->db->where('id_harian',$idh);
			$this->db->where('id_pegawai',$idpeg);
			$this->db->delete('ubina_harian_wajib');
	}
	function pindah_wajib_hadir($idj,$idh,$idpeg){
			$sql = "SELECT * FROM ubina_harian_wajib WHERE id_harian='$idh' AND id_pegawai='$idpeg'";
			$hsl = $this->db->query($sql)->row();
			$ini_jam = $this->ini_jam_kerja($idj);

			if($hsl->absen_masuk=="00:00:00"){	$selisih_masuk = 0;	} else {	
				$sm = "SELECT TIME_TO_SEC(TIMEDIFF('".$hsl->absen_masuk."','".$ini_jam->jam_masuk."')) AS s_masuk";
				$sls = $this->db->query($sm)->row();
				$selisih_masuk = $sls->s_masuk;
						$sqA = "SELECT b.tanggal_harian FROM ubina_harian_wajib a LEFT JOIN (ubina_harian b) ON (a.id_harian=b.id_harian) WHERE a.id_wajib='".$hsl->id_wajib."'";
						$qrA = $this->db->query($sqA)->row();
						$sqB = "SELECT a.id_apel FROM ubina_apel a WHERE a.tanggal_apel='".$qrA->tanggal_harian."'";
						$qrB = $this->db->query($sqB)->row();
						if($selisih_masuk>0){
							$sqlstr="UPDATE ubina_apel_wajib SET status='TK' WHERE id_pegawai='$idpeg' AND id_apel='".$qrB->id_apel."'";
							$this->db->query($sqlstr);
						} else {
							$sqlstr="UPDATE ubina_apel_wajib SET status='H' WHERE id_pegawai='$idpeg' AND id_apel='".$qrB->id_apel."'";
							$this->db->query($sqlstr);
						}
			}
			if($hsl->absen_pulang=="00:00:00"){	$selisih_pulang = 0;	} else {	
				$sp = "SELECT TIME_TO_SEC(TIMEDIFF('".$ini_jam->jam_pulang."','".$hsl->absen_pulang."')) AS s_pulang";
				$sks = $this->db->query($sp)->row();
				$selisih_pulang = $sks->s_pulang;
			}

			$sqlstr="UPDATE ubina_harian_wajib SET id_jam='$idj',selisih_masuk=$selisih_masuk,selisih_pulang=$selisih_pulang WHERE id_harian='$idh' AND id_pegawai='$idpeg'";
			$this->db->query($sqlstr);
/*
			$this->db->set('id_jam',$idj);
			$this->db->set('selisih',$idj);
			$this->db->where('id_harian',$idh);
			$this->db->where('id_pegawai',$idpeg);
			$this->db->update('ubina_harian_wajib');
*/
	}
	function hapus_semua($idH){
		$sqlstr="DELETE FROM ubina_harian_wajib WHERE id_harian='$idH' AND absen_masuk='00:00:00'";
		$this->db->query($sqlstr);
	}
	function ini_wajib($idWajib){
		$sql = "SELECT a.*,b.* FROM ubina_harian_wajib a LEFT JOIN r_pegawai_aktual b ON a.id_pegawai=b.id_pegawai WHERE a.id_wajib='$idWajib'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}

//////////////////////////////////////////////////////////////////////////////////
	function ini_jam_kerja($cari){
		$sqlstr="SELECT *	FROM ubina_harian_jam WHERE id_jam='$cari'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
	function jam_kerja_tambah($isi){
			$this->db->set('jam_masuk',$isi['jam_masuk']);
			$this->db->set('jam_pulang',$isi['jam_pulang']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->insert('ubina_harian_jam');
	}
	function jam_kerja_edit($isi){
			$this->db->set('jam_masuk',$isi['jam_masuk']);
			$this->db->set('jam_pulang',$isi['jam_pulang']);
			$this->db->set('keterangan',$isi['keterangan']);
			$this->db->where('id_jam',$isi['id_jam']);
			$this->db->update('ubina_harian_jam');
	}
	function jam_kerja_hapus($isi){
			$this->db->where('id_jam',$isi['id_jam']);
			$this->db->delete('ubina_harian_jam');
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_absensi_harian($idd,$per){
		$sqlstr="SELECT a.*,SEC_TO_TIME(a.selisih_masuk) as telat_masuk,SEC_TO_TIME(a.selisih_pulang) as cepat_pulang,DAYNAME(b.tanggal_harian) AS hari_kerja, DATE_FORMAT(b.tanggal_harian,'%d-%m-%Y') AS tanggal_harian,c.jam_masuk,c.jam_pulang
		FROM ubina_harian_wajib a 
		LEFT JOIN (ubina_harian b,ubina_harian_jam c) ON (a.id_harian=b.id_harian AND a.id_jam=c.id_jam)
		WHERE a.id_pegawai='$idd'
		AND b.tanggal_harian>='$per' AND b.tanggal_harian < '$per'+ INTERVAL 1 MONTH
		ORDER BY b.tanggal_harian ASC";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}

	function sum_absensi_harian($idd,$per){
		$sqlstr="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( selisih_masuk ) ) )  as sumtime
		FROM ubina_harian_wajib a 
		LEFT JOIN (ubina_harian b,ubina_harian_jam c) ON (a.id_harian=b.id_harian AND a.id_jam=c.id_jam)
		WHERE a.id_pegawai='$idd'
		AND b.tanggal_harian>='$per' AND b.tanggal_harian < '$per'+ INTERVAL 1 MONTH";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->sumtime;
	}
	function get_token($tgl,$idd){
		$sqlstr="SELECT * FROM ubina_token 	WHERE tanggal='$tgl' AND id_pegawai='$idd'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query;
	}
//////////////////////////////////////////////////////////////////////////////////
	function r_pegawai_rekap_generate_aksi($tahun,$bulan){
			$this->db->where('tahun',$tahun);
			$this->db->where('bulan',$bulan);
			$this->db->delete('r_pegawai_bulanan');

$sqA = "INSERT INTO r_pegawai_bulanan (id_pegawai,gelar_nonakademis,gelar_depan,gelar_belakang,status_perkawinan,status_kepegawaian,kode_golongan,tmt_pangkat,id_unor,kode_unor,jab_type,nomenklatur_jabatan,tugas_tambahan,tmt_jabatan,kode_ese,tmt_ese,nama_jenjang) 
		SELECT id_pegawai,gelar_nonakademis,gelar_depan,gelar_belakang,status_perkawinan,status_kepegawaian,kode_golongan,tmt_pangkat,id_unor,kode_unor,jab_type,nomenklatur_jabatan,tugas_tambahan,tmt_jabatan,kode_ese,tmt_ese,nama_jenjang 
		FROM r_pegawai_aktual ORDER BY id_pegawai ASC";
$qrA = $this->db->query($sqA);

			$this->db->set('tahun',$tahun);
			$this->db->set('bulan',$bulan);
			$this->db->where('tahun','');
			$this->db->where('bulan','');
			$this->db->update('r_pegawai_bulanan');


	}

}
