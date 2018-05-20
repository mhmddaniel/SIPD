<?php
class M_dafpeg extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_pros($tab,$thbl,$cari,$kode,$pkt,$jbt){
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
	function get_pegawai_pros($tab,$thbl,$cari,$mulai,$batas,$kode,$pkt,$jbt){
			$iUnor = ($kode=="")?"":"AND b.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND b.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND b.jab_type='$jbt'";
		$sqlstr="SELECT a.*,c.gender,
		b.gelar_belakang,b.gelar_depan,b.gelar_nonakademis,b.nomenklatur_jabatan AS nama_jabatan,
		b.kode_golongan,
		d.nomenklatur_pada
		FROM r_pegawai_$tab a
		LEFT JOIN r_pegawai_bulanan b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN m_unor d ON (b.id_unor=d.id_unor)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND tanggal_$tab LIKE '$thbl%'	
		AND b.id = (SELECT kk.id FROM r_pegawai_bulanan kk WHERE kk.id_pegawai=a.id_pegawai ORDER BY kk.tahun,kk.bulan DESC LIMIT 0,1)
		$iUnor $iPkt $iJbt
		ORDER BY a.tanggal_$tab ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_masuk($thbl,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM (r_pegawai a)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND a.status IN ('masuk','fix')	AND last_updated LIKE '$thbl%'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_masuk($thbl,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*	FROM (r_pegawai a)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND a.status IN ('masuk','fix')	AND last_updated LIKE '$thbl%'
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_diklat($thbl,$rumpun,$cari,$kode,$pkt,$jbt){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM md_diklat_peserta a
		LEFT JOIN md_diklat_event c ON (a.id_diklat_event=c.id_diklat_event)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND c.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		AND c.tst_diklat LIKE '$thbl%'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_diklat($thbl,$rumpun,$cari,$mulai,$batas,$kode,$pkt,$jbt){
		$sqlstr="SELECT a.*,d.*,e.*,f.*	FROM md_diklat_peserta a
		LEFT JOIN md_diklat_event c ON (a.id_diklat_event=c.id_diklat_event)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_peg_golongan d ON (a.reff_pangkat=d.id_peg_golongan)
		LEFT JOIN r_peg_jab e ON (a.reff_jabatan=e.id_peg_jab)
		LEFT JOIN md_diklat f ON (c.id_diklat=f.id_diklat)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND c.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		AND c.tst_diklat LIKE '$thbl%'
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_jabatan($th,$bl,$thsb,$blsb,$cari,$kode,$pkt,$jbt,$jns){
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
			if($jns=="tojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type!='jft'";
			} elseif($jns=="jfutojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type='jfu'";
			} elseif($jns=="jfttojfu"){
				$iJns = " AND c.jab_type='jfu' AND d.jab_type='jft'";
			} elseif($jns=="jfttojs"){
				$iJns = " AND c.jab_type='js' AND d.jab_type='jft'";
			} elseif($jns=="jstojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type='js'";
			} elseif($jns=="jstojfu"){
				$iJns = " AND c.jab_type='jfu' AND d.jab_type='js'";
			} elseif($jns=="promosi") {
				$iJns = " AND c.kode_ese<d.kode_ese";
			} else {
				$iJns = "";
			}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM (r_peg_jab a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN r_pegawai_bulanan d ON (a.id_pegawai=d.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND b.status_kepegawaian='pns'
		AND a.tmt_jabatan LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bl'
		AND d.tahun='$thsb' AND d.bulan='$blsb'
		$iUnor $iPkt $iJbt $iJns
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_jabatan($th,$bl,$thsb,$blsb,$cari,$mulai,$batas,$kode,$pkt,$jbt,$jns){
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
			if($jns=="tojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type!='jft'";
			} elseif($jns=="jfutojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type='jfu'";
			} elseif($jns=="jfttojfu"){
				$iJns = " AND c.jab_type='jfu' AND d.jab_type='jft'";
			} elseif($jns=="jfttojs"){
				$iJns = " AND c.jab_type='js' AND d.jab_type='jft'";
			} elseif($jns=="jstojft"){
				$iJns = " AND c.jab_type='jft' AND d.jab_type='js'";
			} elseif($jns=="jstojfu"){
				$iJns = " AND c.jab_type='jfu' AND d.jab_type='js'";
			} elseif($jns=="promosi") {
				$iJns = " AND c.kode_ese<d.kode_ese";
			} else {
				$iJns = "";
			}
		$sqlstr="SELECT a.*,b.*,c.gelar_depan,c.gelar_belakang,c.gelar_nonakademis,c.kode_golongan
		FROM (r_peg_jab a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN r_pegawai_bulanan d ON (a.id_pegawai=d.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND b.status_kepegawaian='pns'
		AND a.tmt_jabatan LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bl'
		AND d.tahun='$thsb' AND d.bulan='$blsb'
		$iUnor $iPkt $iJbt $iJns
		ORDER BY a.kode_ese ASC,c.kode_golongan DESC,c.tmt_pangkat ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_jabatan_sebelum($tmt,$id_peg){
		$sqlstr="SELECT a.* FROM r_peg_jab a WHERE a.id_pegawai='$id_peg' AND a.tmt_jabatan<'$tmt' ORDER BY a.tmt_jabatan DESC";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_pangkat($th,$bl,$cari,$kode,$pkt,$jbt){
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM (r_peg_golongan a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tmt_golongan LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bl'
		$iUnor $iPkt $iJbt
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_pangkat($th,$bl,$cari,$mulai,$batas,$kode,$pkt,$jbt){
			$thbl = $th."-".$bl;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT a.*,b.*,c.gelar_depan,c.gelar_belakang,c.gelar_nonakademis,
		c.nomenklatur_jabatan,d.nama_unor	
		FROM (r_peg_golongan a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN m_unor d ON (c.id_unor=d.id_unor)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tmt_golongan LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bl'
		$iUnor $iPkt $iJbt
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_pangkat_sebelum($tmt,$id_peg){
		$sqlstr="SELECT a.* FROM r_peg_golongan a WHERE a.id_pegawai='$id_peg' AND a.tmt_golongan<'$tmt' ORDER BY a.tmt_golongan DESC";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_menikah($th,$bl,$cari,$kode,$pkt,$jbt){
			$thbl = $th."-".$bl;
			$bll = $bl-1;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows FROM (r_peg_perkawinan a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tanggal_menikah LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bll'
		$iUnor $iPkt $iJbt
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_menikah($th,$bl,$cari,$mulai,$batas,$kode,$pkt,$jbt){
			$thbl = $th."-".$bl;
			$bll = $bl-1;
			$iUnor = ($kode=="")?"":"AND c.kode_unor LIKE '$kode%'";
			$iPkt = ($pkt=="")?"":"AND c.kode_golongan='$pkt'";
			$iJbt = ($jbt=="")?"":"AND c.jab_type='$jbt'";
		$sqlstr="SELECT a.*,b.*,c.gelar_depan,c.gelar_belakang,c.gelar_nonakademis,
		c.nomenklatur_jabatan,c.kode_golongan AS kode_golongan_awal,d.nama_unor	FROM (r_peg_perkawinan a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai_bulanan c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN m_unor d ON (c.id_unor=d.id_unor)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		OR b.nip_baru LIKE '$cari%'
		)
		AND a.tanggal_menikah LIKE '$thbl%'
		AND c.tahun='$th' AND c.bulan='$bll'
		$iUnor $iPkt $iJbt
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////////////



}
