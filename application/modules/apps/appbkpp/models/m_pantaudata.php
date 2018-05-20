<?php
class M_pantaudata extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function hitung_pantau_data($cari,$unor="all",$kode){
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}

		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}


	function get_pantau_data($cari,$mulai,$batas,$unor="all",$kode){
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}

		$sqlstr="SELECT 
		a.id_pegawai,a.nama_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.nip_baru,a.nama_pangkat,a.nama_golongan,a.nomenklatur_jabatan,a.gender
		FROM r_pegawai_aktual a
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iUnor
		ORDER BY a.nama_pegawai
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


	function hitung_pantau_dok($status,$tipe,$cari,$kode,$hal){
/*
		if($status==1 && $tipe=='pasfoto' && $hal=='end'){	
				$sqlstr="SELECT nip_baru FROM r_peg_dokumen WHERE tipe_dokumen='pasfoto'";
				$hasil = $this->db->query($sqlstr)->result();
				foreach($hasil AS $key=>$val){
					$this->update_kontrol($val->nip_baru);
				}
		}
*/
		$brr=$tipe."_r";
		if($status=="1"){	$st = "(b.$tipe>=b.$brr AND b.$brr!=0)";	}else{	$st = "(b.$tipe<b.$brr)";	}
		if($kode==""){	$iUnor="";	}else{	$uUnor=$this->unor_in($kode); $iUnor="AND a.id_unor IN ($uUnor)";	}
		$sqlstr="SELECT a.nip_baru
		FROM (r_pegawai_aktual a)
		RIGHT JOIN r_peg_dokumen_kontrol b ON a.nip_baru=b.nip_baru
		WHERE  $st
		AND  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		$iUnor
		";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}


	function pantau_dok($status,$tipe,$cari,$kode,$mulai,$batas){
		$brr=$tipe."_r";
		if($status=="1"){	$st = "(b.$tipe>=b.$brr AND b.$brr!=0)";	}else{	$st = "(b.$tipe<b.$brr)";	}
		if($kode==""){	$iUnor="";	}else{	$uUnor=$this->unor_in($kode); $iUnor="AND a.id_unor IN ($uUnor)";	}
		$sqlstr="SELECT a.*,b.*
		FROM r_pegawai_aktual a
		RIGHT JOIN r_peg_dokumen_kontrol b ON a.nip_baru=b.nip_baru
		WHERE  $st
		AND  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		$iUnor
		ORDER BY a.nama_pegawai ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}



	function unor_in($kode){
		$sqlstr="SELECT id_unor	FROM (m_unor) WHERE kode_unor LIKE '$kode%' ORDER BY (kode_unor)";
		$unor=$this->db->query($sqlstr)->result();
		
		$in_unor="";
		foreach($unor as $key=>$val){
			if($key==0){$in_unor=$in_unor.$val->id_unor;}else{$in_unor=$in_unor.",".$val->id_unor;}
		}
		return $in_unor;
	}

	function cek_dokumen($tipe,$nip){
		$sqlstr="SELECT id_dokumen	FROM r_peg_dokumen WHERE tipe_dokumen='$tipe' AND nip_baru='$nip'";
		$unor=$this->db->query($sqlstr)->row();
		return $unor;
	}



}
