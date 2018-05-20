<?php
class M_dashboard_ekinerja extends CI_Model{
	function __construct(){
		parent::__construct();
	}
///////////////////////////////////////////
	function hitung_pegawai($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stTpp="",$nTpp=""){
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND l.tmt_pns='0000-00-00'";	} else {	$iPns = "AND l.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese LIKE '$ese%'";	}
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
			if($stTpp==""){	$iTpp = "";	} else {	if($stTpp=="BS"){$iTpp = "AND (d.status IS NULL OR d.status!='acc_penilai')";}  else {$iTpp = "AND d.status='$stTpp'";}	}
			$tpp_db = $this->dropdowns->tpp_nilai_db();
			if($nTpp==""){	$iMkTpp = ""; $batMkTpp ="";	} else {	$iMkTpp = "AND d.status='acc_penilai' AND (((h.nilai_tugaspokok+h.nilai_tugastambahan+h.nilai_kreatifitas)*.6)+h.nilai_perilaku)";	$batMkTpp = $tpp_db[$nTpp];	}

		$sqlstr="SELECT a.id_pegawai
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai j,r_peg_cpns k,r_peg_pns l,m_unor m) ON (a.id_pegawai=j.id_pegawai AND a.id_pegawai=k.id_pegawai AND a.id_pegawai=l.id_pegawai AND a.id_unor=m.id_unor) 
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND tahun='$tahun' AND bulan_mulai<='$bln')
			LEFT JOIN tpp_realisasi d ON (b.id_tpp=d.id_tpp AND d.bulan='$bln') 
			LEFT JOIN tpp_realisasi_acc h ON (b.id_tpp=h.id_tpp AND h.bulan='$bln') 
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru'
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
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese LIKE '$ese%'";	}
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
			LEFT JOIN tpp_rencana_kerja b ON b.id_tpp=(SELECT MAX(c.id_tpp) FROM tpp_rencana_kerja c WHERE c.id_pegawai=a.id_pegawai AND tahun='$tahun' AND bulan_mulai<='$bln')
			LEFT JOIN tpp_realisasi d ON (b.id_tpp=d.id_tpp AND d.bulan='$bln') 
			LEFT JOIN tpp_realisasi_acc h ON (b.id_tpp=h.id_tpp AND h.bulan='$bln') 
		WHERE a.bulan='$bulan' AND a.tahun='$tahun'
		AND (
		j.nip_baru LIKE '$cari%'
		OR j.nama_pegawai LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		OR m.nomenklatur_pada LIKE '%$cari%'
		)
		AND a.jab_type!='jft-guru'
		$iTpp		$iPns		$iUnor		$iPkt		$iJbt		$iEse		$iTugas		$iGender		$iAgama		$iStatus		$iJenjang		$iUmur $batUmur		$iMkcpns $batMkcpns		$iMkTpp $batMkTpp
		GROUP BY a.id_pegawai
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,k.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

}
