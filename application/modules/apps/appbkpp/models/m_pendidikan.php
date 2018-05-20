<?php
class M_pendidikan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_pendidikan($idd){
		$this->db->from('m_pendidikan');
		$this->db->where('id_pendidikan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function hitung_pendidikan($cari,$jenjang){
		$iJenjang = ($jenjang=="")?"":" AND kode_jenjang='$jenjang'";
		$sqlstr="SELECT COUNT(a.id_pendidikan) AS numrows
		FROM (m_pendidikan a)
		WHERE  (
		a.nama_pendidikan LIKE '%$cari%'
		)
		$iJenjang
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_pendidikan($cari,$mulai,$batas,$jenjang){
		$iJenjang = ($jenjang=="")?"":" AND kode_jenjang='$jenjang'";
		$sqlstr="
		SELECT a.*
		FROM m_pendidikan a
		WHERE  (
		a.nama_pendidikan LIKE '%$cari%'
		)
		$iJenjang
		ORDER BY a.kode_bkn ASC
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
		$this->db->set('tmt_berlaku',$isi['tmt_berlaku']);
		$this->db->set('tst_berlaku',$isi['tst_berlaku']);
		$this->db->insert('m_unor');
	}
	
    function hapus_aksi($isi){
		$this->db->delete('m_unor', array('id_unor' => $isi['idd']));
	}


///////////////////////////////////////////////////////////////////
    function get_konsol(){
		$sqlstr="
		SELECT a.*
		FROM r_pegawai_aktual a
		WHERE  
		a.id_pendidikan='0'
		OR a.id_pendidikan IS NULL
		";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_akhir($idd){
		$sqlstr="
		SELECT a.*
		FROM r_peg_pendidikan a
		WHERE  
		a.id_pegawai='$idd'
		ORDER BY tahun_lulus DESC
		LIMIT 0,1
		";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
    function aksi_konsol($id_pegawai,$id_pendidikan){
		$this->db->set('id_pendidikan',$id_pendidikan);
		$this->db->set('pend_jurusan','777');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('r_pegawai_aktual');
	}



}
