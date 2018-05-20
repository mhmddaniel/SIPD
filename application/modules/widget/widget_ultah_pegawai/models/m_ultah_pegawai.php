<?php
class M_ultah_pegawai extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////
	function get_ultah($unor="all",$pns="all",$jabatan="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "WHERE kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($jabatan=="all"){	$iJabatan = "";	} else {	$iJabatan = "AND jab_type='$jabatan'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND gender='$gender'";	}
		$ultah = date('m-d');
		$sqlstr="SELECT DATE_FORMAT(a.tanggal_lahir,'%d-%m-%Y') AS tanggal_ultah,a.tanggal_lahir,a.nama_pegawai,a.nomenklatur_pada,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,
		TIMESTAMPDIFF(YEAR, a.tanggal_lahir, CURRENT_DATE) AS umur
		FROM (r_pegawai_aktual a)
		WHERE a.tanggal_lahir LIKE '%-$ultah'
		ORDER BY umur DESC
		";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
}
