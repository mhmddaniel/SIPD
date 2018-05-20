<?php
class M_pegawai_struk extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////
	function get_struk($unor="all",$pns="all",$jabatan="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "WHERE kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($jabatan=="all"){	$iJabatan = "";	} else {	$iJabatan = "AND jab_type='$jabatan'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND gender='$gender'";	}
		$ultah = date('m-d');
		$sqlstr="SELECT
					r_pegawai_aktual.nama_pegawai,
					r_pegawai_aktual.gender,
					r_pegawai_aktual.tempat_lahir,
					r_pegawai_aktual.tanggal_lahir,
					r_pegawai_aktual.nip_baru,
					r_pegawai_aktual.nama_golongan,
					r_pegawai_aktual.nama_pangkat,
					r_pegawai_aktual.mk_gol_tahun,
					r_pegawai_aktual.mk_gol_bulan,
					r_pegawai_aktual.kode_unor,
					r_pegawai_aktual.nomenklatur_jabatan,
					r_pegawai_aktual.jab_type,
					r_pegawai_aktual.kode_ese,
					r_pegawai_aktual.tmt_jabatan,
					r_peg_dokumen.tipe_dokumen,
					r_peg_dokumen.id_dokumen,
					r_peg_dokumen.file_dokumen
					FROM
					r_pegawai_aktual
					INNER JOIN r_peg_dokumen ON r_pegawai_aktual.nip_baru = r_peg_dokumen.nip_baru
					WHERE
					r_pegawai_aktual.kode_unor = 02.02 AND
					r_pegawai_aktual.jab_type LIKE '%js%' AND
					r_peg_dokumen.tipe_dokumen LIKE '%pasfoto%'
					ORDER BY
					r_pegawai_aktual.kode_ese ASC";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
}
