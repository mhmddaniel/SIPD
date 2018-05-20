<?php
class M_pantau extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function update_pasfoto(){
		$sqlstr="SELECT nip_baru FROM r_peg_dokumen WHERE tipe_dokumen='pasfoto'";
		$hasil = $this->db->query($sqlstr)->result();
		foreach($hasil AS $key=>$val){
			$sql="UPDATE r_peg_dokumen_kontrol SET pasfoto='1' WHERE nip_baru='".$val->nip_baru."'";
			$this->db->query($sql);
		}
	}


	function update_kontrol($nip_baru){
		$sqlstr="SELECT id_pegawai,status_kepegawaian FROM r_pegawai_aktual WHERE nip_baru='$nip_baru'";
		$hasil = $this->db->query($sqlstr)->row();
////////////////////////////
		$sqlstr2="SELECT id FROM r_peg_dokumen_kontrol WHERE nip_baru='$nip_baru'";
		$hasil2 = $this->db->query($sqlstr2)->row();
		if(empty($hasil2)){
			$sqlstr3 = "INSERT INTO r_peg_dokumen_kontrol (nip_baru,id_pegawai) VALUES ('$nip_baru','".$hasil->id_pegawai."')";
			$this->db->query($sqlstr3);
		}
////////////////////////////
///// IJAZAH PENDIDIKAN /////////
		$sql01a="SELECT COUNT(DISTINCT a.id_reff ) AS num01a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'ijazah_pendidikan' AND a.nip_baru='$nip_baru'";
		$has01a = $this->db->query($sql01a)->row();
		$sql01b="SELECT COUNT(a.id_peg_pendidikan) AS num01b FROM r_peg_pendidikan a WHERE a.id_pegawai='".$hasil->id_pegawai."'";
		$has01b = $this->db->query($sql01b)->row();
///// SK PANGKAT /////////
		$sql02a="SELECT COUNT(DISTINCT a.id_reff ) AS num02a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'sk_pangkat' AND a.nip_baru='$nip_baru'";
		$has02a = $this->db->query($sql02a)->row();
		$sql02b="SELECT COUNT(a.id_peg_golongan) AS num02b FROM r_peg_golongan a WHERE a.id_pegawai='".$hasil->id_pegawai."'";
		$has02b = $this->db->query($sql02b)->row();
///// SK JABATAN /////////
		$sql03a="SELECT COUNT(DISTINCT a.id_reff) AS num03a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'sk_jabatan' AND a.nip_baru='$nip_baru'";
		$has03a = $this->db->query($sql03a)->row();
		$sql03b="SELECT COUNT(a.id_peg_jab) AS num03b FROM r_peg_jab a WHERE a.id_pegawai='".$hasil->id_pegawai."'";
		$has03b = $this->db->query($sql03b)->row();
///// PASFOTO /////////
		$sql04a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num04a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'pasfoto' AND a.nip_baru='$nip_baru'";
		$has04a = $this->db->query($sql04a)->row();
///// SK CPNS /////////
		$sql05a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num05a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'sk_cpns' AND a.nip_baru='$nip_baru'";
		$has05a = $this->db->query($sql05a)->row();
///// SERTIFIKAT PRAJAB /////////
		$sql06a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num06a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'sertifikat_prajab' AND a.nip_baru='$nip_baru'";
		$has06a = $this->db->query($sql06a)->row();
///// SK PNS /////////
		$sql07a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num07a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'sk_pns' AND a.nip_baru='$nip_baru'";
		$has07a = $this->db->query($sql07a)->row();
		$num07a = ($hasil->status_kepegawaian=="cpns")?1:$has07a->num07a;
///// KARPEG /////////
		$sql08a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num08a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'karpeg' AND a.nip_baru='$nip_baru'";
		$has08a = $this->db->query($sql08a)->row();
///// TASPEN /////////
		$sql09a="SELECT COUNT(DISTINCT a.tipe_dokumen ) AS num09a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'taspen' AND a.nip_baru='$nip_baru'";
		$has09a = $this->db->query($sql09a)->row();
///// KARIS KARSU /////////
		$sql10a="SELECT COUNT(DISTINCT a.id_reff) AS num10a FROM r_peg_dokumen a WHERE a.tipe_dokumen = 'karis_karsu' AND a.nip_baru='$nip_baru'";
		$has10a = $this->db->query($sql10a)->row();
		$sql10b="SELECT COUNT(a.id_peg_perkawinan) AS num10b FROM r_peg_perkawinan a WHERE a.id_pegawai='".$hasil->id_pegawai."'";
		$has10b = $this->db->query($sql10b)->row();
///// ///////////////////
		$sql="UPDATE r_peg_dokumen_kontrol SET 
		ijazah_pendidikan='".$has01a->num01a."', ijazah_pendidikan_r='".$has01b->num01b."',
		sk_pangkat='".$has02a->num02a."', sk_pangkat_r='".$has02b->num02b."',
		sk_jabatan='".$has03a->num03a."', sk_jabatan_r='".$has03b->num03b."',
		sertifikat_prajab='".$has06a->num06a."', sertifikat_prajab_r='1',
		sk_cpns='".$has05a->num05a."', sk_cpns_r='1',
		sk_pns='".$num07a."', sk_pns_r='1',
		karpeg='".$has08a->num08a."', karpeg_r='1',
		taspen='".$has09a->num09a."', taspen_r='1',
		karis_karsu='".$has10a->num10a."', karis_karsu_r='".$has10b->num10b."',
		pasfoto='".$has04a->num04a."', pasfoto_r='1'
		WHERE nip_baru='$nip_baru'";
		$this->db->query($sql);
	}

	function ini_kontrol($nip_baru){
/*
		$sql="SELECT nip_baru FROM r_pegawai_aktual a ORDER BY id_pegawai LIMIT 10000,1000";
		$has = $this->db->query($sql)->result();
		foreach($has AS $key=>$val){
			$this->update_kontrol($val->nip_baru);
		}
*/
		$this->update_kontrol($nip_baru);

		$sql01a="SELECT a.* FROM r_peg_dokumen_kontrol a WHERE a.nip_baru='$nip_baru'";
		$has01a = $this->db->query($sql01a)->row();
		return $has01a;
	}


	function hitung_pantau_dok_umpeg($status,$tipe,$cari,$kode,$hal){
		$brr=$tipe."_r";
		if($status=="1"){	$st = "(a.$tipe>=a.$brr AND a.$brr!=0)";	}else{	$st = "(a.$tipe<a.$brr)";	}
		$sqlstr="SELECT a.nip_baru
		FROM (r_peg_dokumen_kontrol a)
		LEFT JOIN r_pegawai_aktual b ON a.nip_baru=b.nip_baru
		WHERE  $st
		AND  (
		b.nip LIKE '$cari%'
		OR b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		)
		AND b.id_unor IN ($kode)
		";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}


	function pantau_dok_umpeg($status,$tipe,$cari,$kode,$mulai,$batas){
		$brr=$tipe."_r";
		if($status=="1"){	$st = "(a.$tipe>=a.$brr AND a.$brr!=0)";	}else{	$st = "(a.$tipe<a.$brr)";	}
		$sqlstr="SELECT a.*,b.*
		FROM r_peg_dokumen_kontrol a
		LEFT JOIN r_pegawai_aktual b ON a.nip_baru=b.nip_baru
		WHERE  $st
		AND  (
		b.nip LIKE '$cari%'
		OR b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		)
		AND b.id_unor IN ($kode)
		ORDER BY b.nama_pegawai ASC
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
		AND a.status_kepegawaian='pns'
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
		AND a.status_kepegawaian='pns'
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
