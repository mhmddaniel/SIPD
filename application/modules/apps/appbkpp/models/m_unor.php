<?php
class M_unor extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_unor($idd){
		$this->db->from('m_unor');
		$this->db->where('id_unor',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function gettree($kode,$lgh,$tanggal){
		$iKode = ($kode==0)?"":"AND a.kode_unor LIKE '$kode%'";
		$sqlstr="SELECT a.* 
		FROM (m_unor a)
		WHERE CHAR_LENGTH(a.kode_unor) = $lgh
		AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'
		$iKode
		ORDER BY a.kode_unor asc
		";
		$res = $this->db->query($sqlstr)->result(); 
		return $res;
	}


	function hitung_master_unor($cari,$tanggal,$ese,$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iEse = ($ese=="xx")?"":"AND kode_ese='$ese'";
		$sqlstr="SELECT COUNT(a.id_unor) AS numrows
		FROM (m_unor a)
		WHERE  (
		a.kode_unor LIKE '$cari%'
		OR a.nama_unor LIKE '%$cari%'
		OR a.nomenklatur_cari LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		OR a.nama_ese='$cari'
		)
		$iTanggal
		$iUnor
		$iEse
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_master_unor($cari,$mulai,$batas,$tanggal,$ese,$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iEse = ($ese=="xx")?"":"AND kode_ese='$ese'";
		$sqlstr="
		SELECT a.*
		FROM m_unor a
		WHERE  (
		a.kode_unor LIKE '$cari%'
		OR a.nama_unor LIKE '%$cari%'
		OR a.nomenklatur_cari LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		OR a.nama_ese='$cari'
		)
		$iTanggal
		$iUnor
		$iEse
		ORDER BY a.kode_unor ASC,a.tmt_berlaku ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_kosong_unor($cari,$tanggal,$ese="",$unorIn=""){
		$ttg = explode("-",$tanggal);
		$thn = $ttg[0];
		$bln = $ttg[1];
		$ss = "SELECT b.id_unor FROM r_pegawai_bulanan b WHERE (b.tahun='$thn' AND b.bulan='$bln' AND b.kode_ese!='99' OR b.tugas_tambahan='Kepala Sekolah')";

		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
		$sqlstr="
				SELECT COUNT(a.id_unor) AS numrows FROM m_unor a
						WHERE  (
						a.kode_unor LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				$iTanggal
				$iUnor
				AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')
				$iKode
				AND a.id_unor NOT IN 
				($ss)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_kosong_unor($cari,$mulai,$batas,$tanggal,$ese="",$unorIn=""){
		$ttg = explode("-",$tanggal);
		$thn = $ttg[0];
		$bln = $ttg[1];
		$ss = "SELECT b.id_unor FROM r_pegawai_bulanan b WHERE (b.status_kepegawaian='pns' AND b.tahun='$thn' AND b.bulan='$bln' AND b.kode_ese!='99' OR b.tugas_tambahan='Kepala Sekolah')";
	
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
			$sqlstr="
			SELECT a.* FROM m_unor a
			WHERE  (
			a.kode_unor LIKE '$cari%'
			OR a.nama_unor LIKE '%$cari%'
			OR a.nama_ese='$cari'
			)
			$iTanggal
			$iUnor
			AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')
			$iKode
			AND a.id_unor NOT IN 
			($ss)
			ORDER BY a.kode_unor
			LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_rangkap_unor($cari,$tanggal,$ese=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$sqlstr="
SELECT a.id_unor
FROM m_unor a
LEFT JOIN (r_pegawai_aktual c) ON (a.id_unor=c.id_unor AND a.kode_ese=c.kode_ese AND c.tugas_tambahan=a.tugas_tambahan)
		WHERE  (
		a.kode_unor LIKE '$cari%'
		OR a.nama_unor LIKE '%$cari%'
		OR a.nama_ese='$cari'
		)
$iTanggal
AND (SELECT COUNT(c.id_pegawai) FROM r_pegawai_aktual c WHERE c.id_unor=a.id_unor AND (c.jab_type='js' OR c.tugas_tambahan='Kepala Sekolah'))>1
GROUP BY c.id_unor
		";
		$query = $this->db->query($sqlstr)->result(); 
		return count($query);
	}
//AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')
//AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')

	function get_rangkap_unor($cari,$mulai,$batas,$tanggal,$ese=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
				$sqlstr="
SELECT a.*
FROM m_unor a
LEFT JOIN (r_pegawai_aktual c) ON (a.id_unor=c.id_unor AND a.kode_ese=c.kode_ese AND c.tugas_tambahan=a.tugas_tambahan)
		WHERE  (
		a.kode_unor LIKE '$cari%'
		OR a.nama_unor LIKE '%$cari%'
		OR a.nama_ese='$cari'
		)
$iTanggal
AND (SELECT COUNT(c.id_pegawai) FROM r_pegawai_aktual c WHERE c.id_unor=a.id_unor AND (c.jab_type='js' OR c.tugas_tambahan='Kepala Sekolah'))>1
GROUP BY c.id_unor
ORDER BY a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


    function edit_aksi($isi){
		$this->db->set('nama_unor',$isi['nama_unor']);
		$this->db->set('jenis',$isi['jenis']);
		$this->db->set('kode_ese',$isi['kode_ese']);
		$this->db->set('nama_ese',$isi['nama_ese']);
		$this->db->set('nomenklatur_jabatan',$isi['nomenklatur_jabatan']);
		$this->db->set('nomenklatur_pada',$isi['nomenklatur_pada']);
		$this->db->set('nomenklatur_cari',$isi['nomenklatur_cari']);
		$this->db->set('tugas_tambahan',$isi['tugas_tambahan']);
		$this->db->set('kode_unor',$isi['kode_unor']);
		$this->db->set('tmt_berlaku',$isi['tmt_berlaku']);
		$this->db->set('tst_berlaku',$isi['tst_berlaku']);
		$this->db->where('id_unor',$isi['idd']);
		$this->db->update('m_unor');
	}

    function tambah_aksi($isi){
		$this->db->set('nama_unor',$isi['nama_unor']);
		$this->db->set('jenis',$isi['jenis']);
		$this->db->set('kode_ese',$isi['kode_ese']);
		$this->db->set('nama_ese',$isi['nama_ese']);
		$this->db->set('nomenklatur_jabatan',$isi['nomenklatur_jabatan']);
		$this->db->set('nomenklatur_pada',$isi['nomenklatur_pada']);
		$this->db->set('nomenklatur_cari',$isi['nomenklatur_cari']);
		$this->db->set('kode_unor',$isi['kode_unor']);
		$this->db->set('tugas_tambahan',$isi['tugas_tambahan']);
		$this->db->set('tmt_berlaku',$isi['tmt_berlaku']);
		$this->db->set('tst_berlaku',$isi['tst_berlaku']);
		$this->db->insert('m_unor');
	}
	
    function hapus_aksi($isi){
		$this->db->delete('m_unor', array('id_unor' => $isi['idd']));
	}

	function setberlaku_aksi($isi){
		$this->db->set('tmt_berlaku',$isi['tmt_berlaku']);
		$this->db->set('tst_berlaku',$isi['tst_berlaku']);
		$this->db->where('id_unor',$isi['id_unor']);
		$this->db->update('m_unor');
	}

	function cek_pegawai_unor($idd){
		$this->db->from('r_peg_jab');
		$this->db->where('id_unor',$idd);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}

    function get_pejabat($idd,$kode_ese,$tt){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_unor',$idd);
		$this->db->where('status_kepegawaian','pns');
		if($kode_ese=="99"){
			$this->db->where('tugas_tambahan',$tt);
		} else {
			$this->db->where('jab_type','js');
		}
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
////////////////////////////////////////////////////////////////////////
	function hitung_setara($cari){
		$sqlstr="SELECT COUNT(a.id_jabatan) AS numrows
		FROM m_jf a
		WHERE  (
		a.kode_bkn LIKE '$cari%'
		OR a.nama_jabatan LIKE '%$cari%'
		)
		AND jab_type='jsst'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_setara($cari,$mulai,$batas){
		$sqlstr="
		SELECT a.*
		FROM m_jf a
		WHERE  (
		a.kode_bkn LIKE '$cari%'
		OR a.nama_jabatan LIKE '%$cari%'
		)
		AND jab_type='jsst'
		ORDER BY a.kode_bkn ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_setara($idd){
		$sql = "SELECT * FROM m_jf WHERE id_jabatan='$idd'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}
	function cek_setara($idd){
		$sql = "SELECT * FROM m_unor WHERE id_masjab='$idd'";
		$hslquery = $this->db->query($sql)->result();
		return $hslquery;
	}
	function setara_tambah($isi){
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('jab_type','jsst');
		$this->db->insert('m_jf');
	}
	function setara_edit($isi){
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->where('id_jabatan',$isi['idd']);
		$this->db->update('m_jf');
	}
	function setara_hapus($isi){
		$this->db->where('id_jabatan',$isi['idd']);
		$this->db->delete('m_jf');
	}
	function setmasjab_aksi($id_unor,$idj){
		$this->db->set('id_masjab',$idj);
		$this->db->where('id_unor',$id_unor);
		$this->db->update('m_unor');
	}


}
