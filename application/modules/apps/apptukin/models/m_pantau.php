<?php
class M_pantau extends CI_Model{
	function __construct(){
		parent::__construct();
	}

/////////////////////////////////////////////////////////////////////
////////////////////=== Rencana Kerja
	function hitung_rencana($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp="",$nBiaya=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	if(strlen($ese)==1){$iEse = "AND a.kode_ese LIKE '$ese%'";}else{$iEse = "AND a.kode_ese='$ese'";}	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND j.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND j.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, j.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, k.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			$bln = str_replace("0","",$bulan);
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (b.status IS NULL OR b.status!='acc_penilai')";}  else {$iTpp = "AND b.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_kegiatan_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";$iHbiaya="HAVING";	} else {	$iMkTpp = "HAVING COUNT(d.id_target)";	$batMkTpp = $tpp_db[$nTpp];$iHbiaya="AND";	}
			$biaya_db = $this->dropdowns->tpp_biaya_db();
			if($nBiaya==""){	$iMkBiaya = ""; $batMkBiaya ="";	} else {	$iMkBiaya = "$iHbiaya (SUM(d.biaya_1)+SUM(d.biaya_2)+SUM(d.biaya_3)+SUM(d.biaya_4)+SUM(d.biaya_5)+SUM(d.biaya_6)+SUM(d.biaya_7)+SUM(d.biaya_8)+SUM(d.biaya_9)+SUM(d.biaya_10)+SUM(d.biaya_11)+SUM(d.biaya_12))";	$batMkBiaya = $biaya_db[$nBiaya];	}

		$sqlstr="SELECT a.id_pegawai
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND c.tahun='$tahun' AND c.bulan_mulai<='$bln' ORDER BY c.bulan_mulai DESC)
			LEFT JOIN tpp_rencana_kerja_target d ON b.id_tpp=d.id_tpp
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru' AND a.nomenklatur_jabatan!='PNS TUGAS BELAJAR' AND a.status_kepegawaian='pns'
		$iTpp	$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns					
		GROUP BY a.id_pegawai
		$iMkTpp $batMkTpp	$iMkBiaya $batMkBiaya";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
	function get_rencana($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp="",$nBiaya=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	if(strlen($ese)==1){$iEse = "AND a.kode_ese LIKE '$ese%'";}else{$iEse = "AND a.kode_ese='$ese'";}	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND j.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND j.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, j.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, k.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
			$bln = str_replace("0","",$bulan);
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (b.status IS NULL OR b.status!='acc_penilai')";}  else {$iTpp = "AND b.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_kegiatan_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";$iHbiaya="HAVING";	} else {	$iMkTpp = "HAVING COUNT(d.id_target)";	$batMkTpp = $tpp_db[$nTpp];$iHbiaya="AND";	}
			$biaya_db = $this->dropdowns->tpp_biaya_db();
			if($nBiaya==""){	$iMkBiaya = ""; $batMkBiaya ="";	} else {	$iMkBiaya = "$iHbiaya (SUM(d.biaya_1)+SUM(d.biaya_2)+SUM(d.biaya_3)+SUM(d.biaya_4)+SUM(d.biaya_5)+SUM(d.biaya_6)+SUM(d.biaya_7)+SUM(d.biaya_8)+SUM(d.biaya_9)+SUM(d.biaya_10)+SUM(d.biaya_11)+SUM(d.biaya_12))";	$batMkBiaya = $biaya_db[$nBiaya];	}

		$sqlstr="SELECT a.*,
		j.nama_pegawai,j.nip_baru,
		b.id_tpp,b.penilai_nama_pegawai,b.penilai_gelar_depan,b.penilai_gelar_belakang,b.penilai_gelar_nonakademis,b.penilai_nip_baru,b.penilai_nomenklatur_jabatan,b.penilai_nama_golongan,b.penilai_nama_pangkat,
		b.status,b.bulan_mulai,b.bulan_selesai,
		COUNT(d.id_target) as kegiatan,(SUM(d.biaya_1)+SUM(d.biaya_2)+SUM(d.biaya_3)+SUM(d.biaya_4)+SUM(d.biaya_5)+SUM(d.biaya_6)+SUM(d.biaya_7)+SUM(d.biaya_8)+SUM(d.biaya_9)+SUM(d.biaya_10)+SUM(d.biaya_11)+SUM(d.biaya_12)) AS biaya
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND c.tahun='$tahun' AND c.bulan_mulai<='$bln' ORDER BY c.bulan_mulai DESC)
			LEFT JOIN tpp_rencana_kerja_target d ON b.id_tpp=d.id_tpp
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru' AND a.nomenklatur_jabatan!='PNS TUGAS BELAJAR' AND a.status_kepegawaian='pns'
		$iTpp	$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns				
		GROUP BY a.id_pegawai
		$iMkTpp $batMkTpp	$iMkBiaya $batMkBiaya
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,k.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


/*

	function get_tpp($cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM tpp_rencana_kerja a
		ORDER BY a.id_tpp ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
*/
//////////////////////////////////////////////////////////////////////////////////
//			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT c.id_tpp FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND tahun='$tahun' AND bulan_mulai<='$bln' ORDER BY c.bulan_mulai DESC LIMIT 0,1)
//			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND tahun='$tahun' AND bulan_mulai<='$bln')
	function hitung_pegawai($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	if(strlen($ese)==1){$iEse = "AND a.kode_ese LIKE '$ese%'";}else{$iEse = "AND a.kode_ese='$ese'";}	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND j.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND j.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, j.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, k.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
//			$bln = str_replace("0","",$bulan);
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (d.status IS NULL OR d.status!='acc_penilai')";}  else {$iTpp = "AND d.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_nilai_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";	} else {	$iMkTpp = "AND d.status='acc_penilai' AND (((h.nilai_tugaspokok+h.nilai_tugastambahan+h.nilai_kreatifitas)*.6)+h.nilai_perilaku)";	$batMkTpp = $tpp_db[$nTpp];	}

		$sqlstr="SELECT a.id_pegawai
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND c.tahun='$tahun' AND c.bulan_mulai<='$bulan' ORDER BY c.bulan_mulai DESC)
			LEFT JOIN tpp_realisasi d ON (b.id_tpp=d.id_tpp AND d.bulan='$bulan') 
			LEFT JOIN tpp_realisasi_acc h ON (b.id_tpp=h.id_tpp AND h.bulan='$bulan') 
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru' AND a.nomenklatur_jabatan!='PNS TUGAS BELAJAR' AND a.status_kepegawaian='pns'
		$iTpp		$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns		$iMkTpp $batMkTpp
		GROUP BY a.id_pegawai
		ORDER BY a.id_pegawai";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
	function get_pegawai($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	if(strlen($ese)==1){$iEse = "AND a.kode_ese LIKE '$ese%'";}else{$iEse = "AND a.kode_ese='$ese'";}	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND j.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND j.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, j.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, k.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
//			$bln = str_replace("0","",$bulan);
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (d.status IS NULL OR d.status!='acc_penilai')";}  else {$iTpp = "AND d.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_nilai_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";	} else {	$iMkTpp = "AND d.status='acc_penilai' AND (((h.nilai_tugaspokok+h.nilai_tugastambahan+h.nilai_kreatifitas)*.6)+h.nilai_perilaku)";	$batMkTpp = $tpp_db[$nTpp];	}

		$sqlstr="SELECT a.*,
		j.nama_pegawai,j.nip_baru,
		b.id_tpp,b.penilai_nama_pegawai,b.penilai_gelar_depan,b.penilai_gelar_belakang,b.penilai_gelar_nonakademis,b.penilai_nip_baru,b.penilai_nomenklatur_jabatan,
		d.id_realisasi,d.status,d.penilai_nama_pangkat,d.penilai_nama_golongan,
		h.*
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND c.tahun='$tahun' AND c.bulan_mulai<='$bulan' ORDER BY c.bulan_mulai DESC)
			LEFT JOIN tpp_realisasi d ON (b.id_tpp=d.id_tpp AND d.bulan='$bulan') 
			LEFT JOIN tpp_realisasi_acc h ON (b.id_tpp=h.id_tpp AND h.bulan='$bulan') 
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru' AND a.nomenklatur_jabatan!='PNS TUGAS BELAJAR' AND a.status_kepegawaian='pns'
		$iTpp		$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns		$iMkTpp $batMkTpp
		GROUP BY a.id_pegawai
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,k.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_pegawai_des($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	if(strlen($ese)==1){$iEse = "AND a.kode_ese LIKE '$ese%'";}else{$iEse = "AND a.kode_ese='$ese'";}	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND j.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND j.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, j.tanggal_lahir, CURRENT_DATE)";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, k.tmt_cpns, CURRENT_DATE)";$batMkcpns = $mkcpns_db[$mkcpns];	}
//			$bln = str_replace("0","",$bulan);
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (d.status IS NULL OR d.status!='acc_penilai')";}  else {$iTpp = "AND d.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_nilai_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";	} else {	$iMkTpp = "AND d.status='acc_penilai' AND (((h.nilai_tugaspokok+h.nilai_tugastambahan+h.nilai_kreatifitas)*.6)+h.nilai_perilaku)";	$batMkTpp = $tpp_db[$nTpp];	}

		$sqlstr="SELECT a.*,
		j.nama_pegawai,j.nip_baru,
		b.id_tpp,b.penilai_nama_pegawai,b.penilai_gelar_depan,b.penilai_gelar_belakang,b.penilai_gelar_nonakademis,b.penilai_nip_baru,b.penilai_nomenklatur_jabatan,
		d.id_realisasi,d.status,d.penilai_nama_pangkat,d.penilai_nama_golongan,
		h.*
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND c.tahun='2016' AND c.bulan_mulai<='12' ORDER BY c.bulan_mulai DESC)
			LEFT JOIN tpp_realisasi d ON (b.id_tpp=d.id_tpp AND d.bulan='12') 
			LEFT JOIN tpp_realisasi_acc h ON (b.id_tpp=h.id_tpp AND h.bulan='12') 
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru' AND a.nomenklatur_jabatan!='PNS TUGAS BELAJAR' AND a.status_kepegawaian='pns'
		$iTpp		$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns		$iMkTpp $batMkTpp
		GROUP BY a.id_pegawai
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,k.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";

		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_tpp_pegawai($id_pegawai,$id_unor,$th){
// AND id_unor='$id_unor'
		$sqlstr="SELECT *
		FROM tpp_rencana_kerja 
		WHERE id_pegawai='$id_pegawai' AND tahun='$th'
		ORDER BY id_tpp DESC
		LIMIT 0,1";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
/*
	function get_tpp_acc($idd){
		$sqlstr="SELECT a.*
		FROM tpp_rencana_kerja_acc a
		WHERE a.id_tpp='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
*/
	function get_realisasi_acc($idd,$bulan){
		$sqlstr="SELECT a.*
		FROM tpp_realisasi_acc a
		WHERE a.id_tpp='$idd' AND a.bulan='$bulan'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function hapus_tpp($isi){
		$this->db->delete('tpp_rencana_kerja', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_rencana_kerja_acc', array('id_tpp' => $isi['id_tpp']));
		$sqlstr="SELECT * FROM tpp_rencana_kerja_target WHERE id_tpp='".$isi['id_tpp']."'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->delete('tpp_realisasi_target', array('id_target' => $val->id_target));
			$this->db->delete('tpp_rencana_kerja_target', array('id_target' => $val->id_target));
		}
		$sqlstr="SELECT * FROM tpp_rencana_kerja_catatan WHERE id_tpp='".$isi['id_tpp']."'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->delete('tpp_rencana_kerja_jawaban', array('id_catatan' => $val->id_catatan));
			$this->db->delete('tpp_rencana_kerja_catatan', array('id_catatan' => $val->id_catatan));
		}
		$this->db->delete('tpp_tugas_tambahan', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_kreatifitas', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_perilaku', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_realisasi', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_realisasi_acc', array('id_tpp' => $isi['id_tpp']));
		$sqlstr="SELECT * FROM tpp_realisasi_catatan WHERE id_tpp='".$isi['id_tpp']."'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->delete('tpp_realisasi_jawaban', array('id_catatan' => $val->id_catatan));
			$this->db->delete('tpp_realisasi_catatan', array('id_catatan' => $val->id_catatan));
		}
	}
	function cek_layak_turun($id,$bln){
		$sqlstr="SELECT COUNT(a.id_realisasi) AS numrows FROM (tpp_realisasi a) WHERE id_tpp='$id' AND bulan>'$bln'";
		$query = $this->db->query($sqlstr)->row(); 
		$layak=($query->numrows>1)?"tidak":"ya";
		return $layak;
	}

	function turun_status($id,$bln){
		$sqlstr="SELECT * FROM tpp_realisasi_catatan WHERE id_tpp='$id' AND bulan='$bln'";
		$catatan = $this->db->query($sqlstr)->result();
		$sqlstr2="SELECT * FROM tpp_realisasi_catatan WHERE id_tpp='$id' AND bulan>'$bln'";
		$catatan2 = $this->db->query($sqlstr2)->result();
		
		$this->db->set('status','draft');
		$this->db->set('aju_penilai',NULL);
		$this->db->set('koreksi_penilai',NULL);
		$this->db->set('revisi_penilai',NULL);
		$this->db->set('acc_penilai',NULL);
		$this->db->where('id_tpp',$id);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
		
		foreach($catatan AS $key=>$val){	$this->db->delete('tpp_realisasi_jawaban', array('id_catatan' => $val->id_catatan));	}
		$this->db->delete('tpp_realisasi_acc', array('id_tpp' => $id,'bulan' => $bln));
		$this->db->delete('tpp_perilaku', array('id_tpp' => $id,'bulan' => $bln));
		$this->db->delete('tpp_tugas_tambahan', array('id_tpp' => $id,'bulan' => $bln));
		$this->db->delete('tpp_kreatifitas', array('id_tpp' => $id,'bulan' => $bln));
		$this->db->delete('tpp_realisasi_catatan', array('id_tpp' => $id,'bulan' => $bln));


		$sqlstr="DELETE	FROM tpp_realisasi WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);
		foreach($catatan2 AS $key=>$val){	$this->db->delete('tpp_realisasi_jawaban', array('id_catatan' => $val->id_catatan));	}
		$sqlstr="DELETE	FROM tpp_realisasi_acc WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);
		$sqlstr="DELETE	FROM tpp_perilaku WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);
		$sqlstr="DELETE	FROM tpp_tugas_tambahan WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);
		$sqlstr="DELETE	FROM tpp_kreatifitas WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);
		$sqlstr="DELETE	FROM tpp_realisasi_catatan WHERE id_tpp='$id' AND bulan>'$bln'";
		$this->db->query($sqlstr);

	}


}
