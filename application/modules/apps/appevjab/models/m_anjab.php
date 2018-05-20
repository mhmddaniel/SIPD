<?php
class M_anjab extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_jabfung($idd){
		$this->db->from('m_jf');
		$this->db->where('id_jabatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function hitung_jabfung($cari,$tipe){
		$sqlstr="SELECT COUNT(a.id_jabatan) AS numrows
		FROM (m_jf a)
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '$cari%'
		)
		AND jab_type='$tipe'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_jabfung($cari,$mulai,$batas,$tipe){
		$sqlstr="
		SELECT a.*
		FROM m_jf a
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '$cari%'
		)
		AND jab_type='$tipe'
		ORDER BY a.kode_bkn ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function ini_jenjang($idd){
		$this->db->from('m_jft_jenjang');
		$this->db->where('id_jenjang_jabatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
    function get_jenjang($idd){
		$this->db->from('m_jft_jenjang');
		$this->db->where('id_jabatan',$idd);
		$this->db->order_by('tingkat','DESC');
		$this->db->order_by('kode_golongan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
    function jenjang_tambah($isi){
		if($isi['idd']!="xx"){
		$this->db->set('id_jabatan',$isi['idd']);
		}
		$this->db->set('kode_golongan',$isi['kode_golongan']);
		$this->db->set('tingkat',$isi['tingkat']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->insert('m_jft_jenjang');
	}
    function jenjang_edit($isi){
		$this->db->set('kode_golongan',$isi['kode_golongan']);
		$this->db->set('tingkat',$isi['tingkat']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->where('id_jenjang_jabatan',$isi['idk']);
		$this->db->update('m_jft_jenjang');
	}
    function jenjang_hapus($isi){
		$this->db->where('id_jenjang_jabatan',$isi['idk']);
		$this->db->delete('m_jft_jenjang');
	}
    function get_jenjang_guru(){
		$this->db->from('m_jft_jenjang');
		$this->db->where('tingkat','guru');
		$this->db->order_by('kode_golongan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
///////////////////////////////////////////////////////////
	function hitung_jabfung_belum($cari,$tipe){
		$sqlstr="SELECT COUNT(a.id_jabatan) AS numrows
		FROM (m_jf a)
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '$cari%'
		)
		AND jab_type='$tipe'
		AND id_jabatan NOT IN (SELECT id_jabatan FROM evjab_kelas_jabatan WHERE jab_type='$tipe')
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_jabfung_belum($cari,$mulai,$batas,$tipe){
		$sqlstr="
		SELECT a.*
		FROM m_jf a
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '$cari%'
		)
		AND jab_type='$tipe'
		AND id_jabatan NOT IN (SELECT id_jabatan FROM evjab_kelas_jabatan WHERE jab_type='$tipe')
		ORDER BY a.kode_bkn ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////
    function edit_aksi($isi){
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->where('id_jabatan',$isi['idd']);
		$this->db->update('m_jf');
	}

    function tambah_aksi($isi){
		$this->db->set('jab_type',$isi['jab_type']);
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('kode_bkn',$isi['kode_bkn']);
		$this->db->insert('m_jf');
	}
	
    function hapus_aksi($isi){
		$this->db->delete('m_jf', array('id_jabatan' => $isi['idd']));
	}
//////////////////////////////////////////////////////////////////////
	function ihtisar_js_edit($idd,$isi){
		$this->db->set('nomenklatur_unor',$isi['ihtisar']);
		$this->db->where('id_unor',$idd);
		$this->db->update('m_unor');
	}
	function get_ihtisar($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_kelas_jabatan a	WHERE a.id_jabatan='$idJab'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function get_ihtisar_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_kelas_jabatan a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND b.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////
	function get_prestasi($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_prestasi a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_prestasi_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_prestasi a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_prestasi($idPrestasi){
		$sqlstr="SELECT a.*	FROM evjab_prestasi a	WHERE a.id_prestasi='$idPrestasi'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function prestasi_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('satuan',$isi['satuan']);
		$this->db->set('jumlah',$isi['jumlah']);
		$this->db->set('waktu',$isi['waktu']);
		$this->db->insert('evjab_prestasi');
	}
	function prestasi_edit($isi){
		$this->db->set('satuan',$isi['satuan']);
		$this->db->set('jumlah',$isi['jumlah']);
		$this->db->set('waktu',$isi['waktu']);
		$this->db->where('id_prestasi',$isi['id_prestasi']);
		$this->db->update('evjab_prestasi');
	}
	function prestasi_hapus($isi){
		$this->db->where('id_prestasi',$isi['id_prestasi']);
		$this->db->delete('evjab_prestasi');
	}
//////////////////////////////////////////////////////////////////////
	function get_resiko($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_resiko a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_resiko_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_resiko a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_resiko($idResiko){
		$sqlstr="SELECT a.*	FROM evjab_resiko a	WHERE a.id_resiko='$idResiko'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function resiko_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('fisik',$isi['fisik']);
		$this->db->set('penyebab',$isi['penyebab']);
		$this->db->insert('evjab_resiko');
	}
	function resiko_edit($isi){
		$this->db->set('fisik',$isi['fisik']);
		$this->db->set('penyebab',$isi['penyebab']);
		$this->db->where('id_resiko',$isi['id_resiko']);
		$this->db->update('evjab_resiko');
	}
	function resiko_hapus($isi){
		$this->db->where('id_resiko',$isi['id_resiko']);
		$this->db->delete('evjab_resiko');
	}
//////////////////////////////////////////////////////////////////////
	function get_kondisi($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_kondisi a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_kondisi_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_kondisi a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_kondisi($idKondisi){
		$sqlstr="SELECT a.*	FROM evjab_kondisi a	WHERE a.id_kondisi='$idKondisi'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function kondisi_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('aspek',$isi['aspek']);
		$this->db->set('faktor',$isi['faktor']);
		$this->db->insert('evjab_kondisi');
	}
	function kondisi_edit($isi){
		$this->db->set('aspek',$isi['aspek']);
		$this->db->set('faktor',$isi['faktor']);
		$this->db->where('id_kondisi',$isi['id_kondisi']);
		$this->db->update('evjab_kondisi');
	}
	function kondisi_hapus($isi){
		$this->db->where('id_kondisi',$isi['id_kondisi']);
		$this->db->delete('evjab_kondisi');
	}
//////////////////////////////////////////////////////////////////////
	function get_korelasi($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_korelasi a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_korelasi_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_korelasi a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_korelasi($idKorelasi){
		$sqlstr="SELECT a.*	FROM evjab_korelasi a	WHERE a.id_korelasi='$idKorelasi'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function korelasi_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('instansi',$isi['instansi']);
		$this->db->set('dalam_hal',$isi['dalam_hal']);
		$this->db->insert('evjab_korelasi');
	}
	function korelasi_edit($isi){
		$this->db->set('nama_jabatan',$isi['nama_jabatan']);
		$this->db->set('instansi',$isi['instansi']);
		$this->db->set('dalam_hal',$isi['dalam_hal']);
		$this->db->where('id_korelasi',$isi['id_korelasi']);
		$this->db->update('evjab_korelasi');
	}
	function korelasi_hapus($isi){
		$this->db->where('id_korelasi',$isi['id_korelasi']);
		$this->db->delete('evjab_korelasi');
	}
//////////////////////////////////////////////////////////////////////
	function get_hasil($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_hasil a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_hasil_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_hasil a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_hasil($idHasil){
		$sqlstr="SELECT a.*	FROM evjab_hasil a	WHERE a.id_hasil='$idHasil'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function hasil_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('hasil',$isi['hasil']);
		$this->db->set('satuan',$isi['satuan']);
		$this->db->insert('evjab_hasil');
	}
	function hasil_edit($isi){
		$this->db->set('hasil',$isi['hasil']);
		$this->db->set('satuan',$isi['satuan']);
		$this->db->where('id_hasil',$isi['id_hasil']);
		$this->db->update('evjab_hasil');
	}
	function hasil_hapus($isi){
		$this->db->where('id_hasil',$isi['id_hasil']);
		$this->db->delete('evjab_hasil');
	}
//////////////////////////////////////////////////////////////////////
	function get_alat($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_alat a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_alat_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_alat a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_alat($idAlat){
		$sqlstr="SELECT a.*	FROM evjab_alat a	WHERE a.id_alat='$idAlat'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function alat_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('alat',$isi['alat']);
		$this->db->set('untuk',$isi['untuk']);
		$this->db->insert('evjab_alat');
	}
	function alat_edit($isi){
		$this->db->set('alat',$isi['alat']);
		$this->db->set('untuk',$isi['untuk']);
		$this->db->where('id_alat',$isi['id_alat']);
		$this->db->update('evjab_alat');
	}
	function alat_hapus($isi){
		$this->db->where('id_alat',$isi['id_alat']);
		$this->db->delete('evjab_alat');
	}
//////////////////////////////////////////////////////////////////////
	function get_bahan($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_bahan a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_bahan_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_bahan a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_bahan($idBahan){
		$sqlstr="SELECT a.*	FROM evjab_bahan a	WHERE a.id_bahan='$idBahan'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function bahan_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('bahan',$isi['bahan']);
		$this->db->set('penggunaan',$isi['penggunaan']);
		$this->db->insert('evjab_bahan');
	}
	function bahan_edit($isi){
		$this->db->set('bahan',$isi['bahan']);
		$this->db->set('penggunaan',$isi['penggunaan']);
		$this->db->where('id_bahan',$isi['id_bahan']);
		$this->db->update('evjab_bahan');
	}
	function bahan_hapus($isi){
		$this->db->where('id_bahan',$isi['id_bahan']);
		$this->db->delete('evjab_bahan');
	}
//////////////////////////////////////////////////////////////////////
	function get_wewenang($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_wewenang a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_wewenang_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_wewenang a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_wewenang($idBahan){
		$sqlstr="SELECT a.*	FROM evjab_wewenang a	WHERE a.id_wewenang='$idBahan'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function wewenang_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('wewenang',$isi['wewenang']);
		$this->db->insert('evjab_wewenang');
	}
	function wewenang_edit($isi){
		$this->db->set('wewenang',$isi['wewenang']);
		$this->db->where('id_wewenang',$isi['id_wewenang']);
		$this->db->update('evjab_wewenang');
	}
	function wewenang_hapus($isi){
		$this->db->where('id_wewenang',$isi['id_wewenang']);
		$this->db->delete('evjab_wewenang');
	}
//////////////////////////////////////////////////////////////////////
	function get_tanggungjawab($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_tanggungjawab a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_tanggungjawab_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_tanggungjawab a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_tanggungjawab($idBahan){
		$sqlstr="SELECT a.*	FROM evjab_tanggungjawab a	WHERE a.id_tanggungjawab='$idBahan'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function tanggungjawab_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('tanggungjawab',$isi['tanggungjawab']);
		$this->db->insert('evjab_tanggungjawab');
	}
	function tanggungjawab_edit($isi){
		$this->db->set('tanggungjawab',$isi['tanggungjawab']);
		$this->db->where('id_tanggungjawab',$isi['id_tanggungjawab']);
		$this->db->update('evjab_tanggungjawab');
	}
	function tanggungjawab_hapus($isi){
		$this->db->where('id_tanggungjawab',$isi['id_tanggungjawab']);
		$this->db->delete('evjab_tanggungjawab');
	}
//////////////////////////////////////////////////////////////////////
	function get_urtug($idJab,$jT){
		$sqlstr="SELECT a.*	FROM evjab_urtug a	WHERE a.id_jabatan='$idJab' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_urtug_nama($nmm,$jT){
		$sqlstr="SELECT a.*	FROM evjab_urtug a	
		LEFT JOIN m_jf b ON (a.id_jabatan=b.id_jabatan)
		WHERE b.nama_jabatan='$nmm' AND a.jab_type='$jT'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_urtug($idUrtug){
		$sqlstr="SELECT a.*	FROM evjab_urtug a	WHERE a.id_urtug='$idUrtug'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function urtug_tambah($idj,$jT,$isi){
		$this->db->set('id_jabatan',$idj);
		$this->db->set('jab_type',$jT);
		$this->db->set('uraian_tugas',$isi['uraian_tugas']);
		$this->db->insert('evjab_urtug');
	}
	function urtug_edit($isi){
		$this->db->set('uraian_tugas',$isi['uraian_tugas']);
		$this->db->where('id_urtug',$isi['id_urtug']);
		$this->db->update('evjab_urtug');
	}
	function urtug_hapus($isi){
		$this->db->where('id_urtug',$isi['id_urtug']);
		$this->db->delete('evjab_urtug');
	}

	function get_urtug_tahapan($idUr){
		$sqlstr="SELECT a.*	FROM evjab_urtug_tahapan a	WHERE a.id_urtug='$idUr'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_urtug_tahapan($idT){
		$sqlstr="SELECT a.*	FROM evjab_urtug_tahapan a	WHERE a.id_tahapan='$idT'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function tahapan_tambah($idU,$isi){
		$this->db->set('id_urtug',$idU);
		$this->db->set('tahapan',$isi['tahapan']);
		$this->db->insert('evjab_urtug_tahapan');
	}
	function tahapan_edit($isi){
		$this->db->set('tahapan',$isi['tahapan']);
		$this->db->where('id_tahapan',$isi['id_tahapan']);
		$this->db->update('evjab_urtug_tahapan');
	}
	function tahapan_hapus($isi){
		$this->db->where('id_tahapan',$isi['id_tahapan']);
		$this->db->delete('evjab_urtug_tahapan');
	}


}
