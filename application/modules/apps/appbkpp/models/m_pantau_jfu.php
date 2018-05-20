<?php
class M_pantau_jfu extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function hitung_jfu($cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE  
		a.jab_type = 'jfu' 
		AND
		(
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}


    function get_jfu($cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM r_pegawai_aktual a
		WHERE  
		a.jab_type = 'jfu' 
		AND
		(
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,a.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


    function get_daftar(){
		$cari="6.";
		$sqlstr="SELECT a.*,a.kode_unor AS bbb
		FROM r_pegawai_aktual a
		WHERE 
		EXISTS (SELECT b.kode_unor FROM r_pegawai_aktual b WHERE b.kode_unor LIKE '%$cari%')
		";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cpnsdobel(){
		$sqlstr="SELECT a.* 
				FROM r_peg_cpns a, r_peg_cpns b
				WHERE a.id_pegawai = b.id_pegawai 
				AND a.id <> b.id
				ORDER BY a.id_pegawai
				";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cekDokCpns($idd){
		$sqlstr="SELECT id_reff FROM r_peg_dokumen WHERE tipe_dokumen='sk_cpns' AND id_reff='$idd' LIMIT 0,1";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
    function hapuscpns($idd){
		$this->db->where('id',$idd);
		$this->db->delete('r_peg_cpns');
	}

    function pnsdobel(){
		$sqlstr="SELECT a.* 
				FROM r_peg_pns a, r_peg_pns b
				WHERE a.id_pegawai = b.id_pegawai 
				AND a.id <> b.id
				ORDER BY a.id_pegawai
				";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cekDokPns($idd){
		$sqlstr="SELECT id_reff FROM r_peg_dokumen WHERE tipe_dokumen='sk_pns' AND id_reff='$idd' LIMIT 0,1";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
    function hapuspns($idd){
		$this->db->where('id',$idd);
		$this->db->delete('r_peg_pns');
	}



}
