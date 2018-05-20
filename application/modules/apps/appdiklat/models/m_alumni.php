<?php
class M_alumni extends CI_Model{
	function __construct(){
		parent::__construct();
	}


//////////////////////////////////////////////////////////////////////////////////
	function hitungalumni($tahun,$cari){
		$sqlstr="SELECT COUNT(a.id_diklat_peserta) AS numrows FROM (md_diklat_peserta a) 
		LEFT JOIN md_diklat_event c ON (a.id_diklat_event=c.id_diklat_event)
		WHERE c.id_diklat_event IN (SELECT id_diklat_event FROM md_diklat_event WHERE tahun='$tahun')
		GROUP BY a.id_pegawai
		";
		$query = $this->db->query($sqlstr)->row(); 
		return (empty($query))?0:$query->numrows;
	}
	function getalumni($tahun,$cari,$mulai,$batas){
//		GROUP BY a.id_pegawai
		$sqlstr="
		SELECT a.*,b.gender,d.nama_pangkat,d.nama_golongan,e.nama_jabatan,e.nama_unor,e.nomenklatur_pada,
		c.jam,SUM(c.jam) AS jjam,COUNT(a.id_diklat_peserta) AS cjam
		FROM md_diklat_peserta a
		LEFT JOIN r_pegawai b  ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN md_diklat_event c ON (a.id_diklat_event=c.id_diklat_event)
		LEFT JOIN r_peg_golongan d ON (a.reff_pangkat=d.id_peg_golongan)
		LEFT JOIN r_peg_jab e ON (a.reff_jabatan=e.id_peg_jab)
		WHERE c.id_diklat_event IN (SELECT id_diklat_event FROM md_diklat_event WHERE tahun='$tahun')
		GROUP BY a.id_pegawai
		ORDER BY jjam ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_alumni($cari,$rumpun){
		$iRumpun = ($rumpun=="")?"":" AND id_rumpun='$rumpun'";
		$sqlstr="SELECT COUNT(a.id_peg_diklat_struk) AS numrows FROM (r_peg_diklat_struk a)
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		OR a.id_rumpun='$cari'
		) $iRumpun
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_alumni($cari,$mulai,$batas,$rumpun){
		$iRumpun = ($rumpun=="")?"":" AND id_rumpun='$rumpun'";
		$sqlstr="
		SELECT a.*,b.* FROM r_peg_diklat_struk a
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		OR a.id_rumpun='$cari'
		) $iRumpun
		ORDER BY a.id_peg_diklat_struk DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_alumni_kursus($cari){
		$sqlstr="SELECT COUNT(a.id_peg_kursus) AS numrows FROM (r_peg_kursus a)
		WHERE  (
		a.nama_kursus LIKE '%$cari%'
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_alumni_kursus($cari,$mulai,$batas){
		$sqlstr="
		SELECT a.*,b.* FROM r_peg_kursus a
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nama_kursus LIKE '%$cari%'
		)
		ORDER BY a.tanggal_sertifikat DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function dokumen($tipe,$idd){
		$sqlstr="SELECT a.* FROM r_peg_dokumen a WHERE a.tipe_dokumen='$tipe' AND id_reff='$idd'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_durasi($idpeg,$tahun,$id_rumpun){
		$sqlstr="
		SELECT SUM(b.jam) AS jjam,COUNT(a.id_diklat_peserta) AS kali
		FROM md_diklat_peserta a
		LEFT JOIN md_diklat_event b ON (a.id_diklat_event=b.id_diklat_event)
		LEFT JOIN md_diklat c ON (b.id_diklat=c.id_diklat)
		WHERE a.id_pegawai='$idpeg'
		AND a.id_diklat_event IN (SELECT id_diklat_event FROM md_diklat_event WHERE tahun='$tahun')
		AND c.id_rumpun='$id_rumpun'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function diklat_ikut($idpeg,$tahun){
		$sqlstr="
		SELECT b.*,
		c.*
		FROM md_diklat_peserta a
		LEFT JOIN md_diklat_event b ON (a.id_diklat_event=b.id_diklat_event)
		LEFT JOIN md_diklat c ON (b.id_diklat=c.id_diklat)
		WHERE a.id_pegawai='$idpeg'
		AND a.id_diklat_event IN (SELECT id_diklat_event FROM md_diklat_event WHERE tahun='$tahun')
		ORDER BY b.tmt_diklat";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

}
