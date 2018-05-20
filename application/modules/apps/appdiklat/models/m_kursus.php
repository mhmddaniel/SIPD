<?php
class M_kursus extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_diklat($idd){
		$this->db->where('id_diklat',$idd);
		$this->db->from('md_diklat');
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hitung_diklat($idr,$cari,$jenjang=""){
		$iJenjang = ($jenjang=="")?"":" AND kode_jenjang='$jenjang'";
		$sqlstr="SELECT COUNT(a.id_diklat) AS numrows FROM (md_diklat a)
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		)
		AND id_rumpun='$idr'		$iJenjang
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_diklat($idr,$cari,$mulai,$batas,$jenjang=""){
		$iJenjang = ($jenjang=="")?"":" AND kode_jenjang='$jenjang'";
		$sqlstr="
		SELECT a.*
		FROM md_diklat a
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		)
		AND id_rumpun='$idr'		$iJenjang
		ORDER BY a.kode_diklat ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function tambah_diklat($idr,$kode,$nama,$jenis,$jenjang){
		$this->db->set('id_rumpun',$idr);
		$this->db->set('kode_diklat',$kode);
		$this->db->set('nama_diklat',$nama);
		$this->db->set('jenis_diklat',$jenis);
		$this->db->set('jenjang_diklat',$jenjang);
		$this->db->insert('md_diklat');
	}
    function edit_diklat($idk,$kode,$nama,$jenis,$jenjang){
		$this->db->set('kode_diklat',$kode);
		$this->db->set('nama_diklat',$nama);
		$this->db->set('jenis_diklat',$jenis);
		$this->db->set('jenjang_diklat',$jenjang);
		$this->db->where('id_diklat',$idk);
		$this->db->update('md_diklat');
	}
    function hapus_diklat($idk){
		$this->db->where('id_diklat',$idk);
		$this->db->delete('md_diklat');
	}
////////////////////////////////////////////////////
    function ini_jangnis($idd){
		$this->db->where('id_diklat_jangnis',$idd);
		$this->db->from('md_diklat_jangnis');
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
    function tambah_jangnis($isi){
		$this->db->set('id_rumpun',$isi['id_rumpun']);
		$this->db->set('tipe',$isi['tipe']);
		$this->db->set('kode',$isi['kode']);
		$this->db->set('nama_diklat_jangnis',$isi['nama_diklat_jangnis']);
		$this->db->insert('md_diklat_jangnis');
	}
    function edit_jangnis($isi){
		$this->db->set('kode',$isi['kode']);
		$this->db->set('nama_diklat_jangnis',$isi['nama_diklat_jangnis']);
		$this->db->where('id_diklat_jangnis',$isi['idd']);
		$this->db->update('md_diklat_jangnis');
	}
    function hapus_jangnis($isi){
		$this->db->where('id_diklat_jangnis',$isi['idd']);
		$this->db->delete('md_diklat_jangnis');
	}
}
