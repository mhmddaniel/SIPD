<?php
class M_pegmasuk extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai($cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai a)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND a.status IN ('masuk','fix')
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai($cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM (r_pegawai a)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		AND a.status IN ('masuk','fix')
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

///////////////////////////////////////////////////////////////////////////////////////
	function simpan_aksi($id_pegawai,$data)	{
		if($id_pegawai==""){
			$this->db->set('nip',$data['nip']);
			$this->db->insert('r_pegawai');
			$id_pegawai = $this->db->insert_id();

//			$this->db->set('id_pegawai',$id_pegawai);
//			$this->db->insert('r_pegawai_aktual');
		}

		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('nip',$data['nip']);
		if($data['nip_baru']!=""){	$this->db->set('nip_baru',$data['nip_baru']);	}
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('gender',$data['gender']);
		$this->db->set('tempat_lahir',$data['tempat_lahir']);
		$this->db->set('tanggal_lahir',$data['tanggal_lahir']);
		$this->db->set('agama',$data['agama']);
		$this->db->set('status_perkawinan',$data['status_perkawinan']);
		$this->db->set('nomor_hp',$data['nomor_hp']);
		$this->db->set('nomor_tlp_rumah',$data['nomor_tlp_rumah']);
		$this->db->set('status','masuk');
		$this->db->set('status_kepegawaian',$data['status_kepegawaian']);
		$this->db->where('id_pegawai',$id_pegawai);
		return  $this->db->update('r_pegawai');
	}
	function hapus_aksi($id_pegawai)	{
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai');
	}
///////////////////////////////////////////////////////////////////////////////////////////////////




}
