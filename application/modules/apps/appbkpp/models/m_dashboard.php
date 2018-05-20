<?php
class M_dashboard extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_panel($idd,$blh,$thh){
		$sqlstr="SELECT * FROM r_peg_dashboard_val WHERE id_setting='$idd' AND bulan=$blh AND tahun=$thh";
		$query = $this->db->query($sqlstr)->row();
		return $query;
	}

    function isi_pns($bulan,$tahun){
		$sqlstr="SELECT id_pegawai FROM r_pegawai_bulanan WHERE bulan='$bulan' AND tahun='$tahun' ORDER BY id_pegawai ASC";
		$hasil = $this->db->query($sqlstr)->result();
		foreach($hasil AS $key=>$val){
			$sq ="SELECT id_pegawai FROM r_peg_pns WHERE id_pegawai='".$val->id_pegawai."'";
			$qy = $this->db->query($sq)->row();
			if(empty($qy)){
				$sqq="INSERT INTO r_peg_pns (id_pegawai) VALUES ('".$val->id_pegawai."')";
				$this->db->query($sqq);
			}
			$sq ="SELECT id_pegawai FROM r_peg_cpns WHERE id_pegawai='".$val->id_pegawai."'";
			$qy = $this->db->query($sq)->row();
			if(empty($qy)){
				$sqq="INSERT INTO r_peg_cpns (id_pegawai) VALUES ('".$val->id_pegawai."')";
				$this->db->query($sqq);
			}
		}
	}

    function satu($ids,$nama,$isi,$bulan,$tahun){
		$sql = "SELECT id_item FROM r_peg_dashboard_val WHERE id_setting='$ids' AND bulan='$bulan' AND tahun='$tahun'";
		$hsl = $this->db->query($sql)->row();
		if(empty($hsl)){
			$sqlstr="INSERT INTO r_peg_dashboard_val (id_setting,nama_item,meta_value,bulan,tahun) VALUES ('$ids','$nama','$isi','$bulan','$tahun')";
			$this->db->query($sqlstr);
		} else {
			$sqlstr="UPDATE r_peg_dashboard_val SET meta_value='$isi' WHERE id_item='".$hsl->id_item."'";
			$this->db->query($sqlstr);
		}
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_jabatan($jabatan="all",$gender="all",$unor="all",$dBulan,$tahun){
			if($jabatan=="all"){	$iJabatan = "";	} else {	$iJabatan = "AND a.jab_type='$jabatan'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND b.gender='$gender'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		$iJabatan
		$iGender
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai_pendidikan($pendidikan="all",$gender="all",$unor="all",$dBulan,$tahun){
			if($pendidikan=="all"){	$iPendidikan = "";	} else {	$iPendidikan = "AND a.nama_jenjang='$pendidikan'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND b.gender='$gender'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		$iPendidikan
		$iGender
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai_golongan($golongan="all",$gender="all",$unor="all",$dBulan,$tahun){
			if($golongan=="all"){	$iGolongan = "";	} else {	$iGolongan = "AND a.kode_golongan='$golongan'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND b.gender='$gender'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		$iGolongan
		$iGender
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai_umur($batas,$gender,$unor="all",$dBulan,$tahun){
			$bdd = $tahun."-".$dBulan."-01";
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = " b.gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		AND
		$iGender
		$iUnor
		AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$bdd') $batas
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai_mkcpns($batas,$gender,$unor="all",$dBulan,$tahun){
			$bdd = $tahun."-".$dBulan."-01";
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND id_unor IN ($unor)";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = " b.gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b,r_peg_cpns c) ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=c.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		AND
		$iGender
		$iUnor
		AND TIMESTAMPDIFF(YEAR, c.tmt_cpns, '$bdd') $batas
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai($unor="all",$pns="all",$gol="all",$gender="all",$dBulan,$tahun){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND c.tmt_pns='0000-00-00'";	} else {	$iPns = "AND c.tmt_pns!='0000-00-00'";	}
			if($gol=="all"){	$iGol = "";	} else {	$iGol = "AND a.kode_golongan='$gol'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_bulanan a)
		LEFT JOIN (r_pegawai b,r_peg_pns c) ON (a.id_pegawai=b.id_pegawai AND a.id_pegawai=c.id_pegawai)
		WHERE a.bulan='$dBulan' AND a.tahun='$tahun' AND a.status_kepegawaian='pns'
		$iUnor
		$iPns
		$iGol
		$iGender
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function hitung_pegawai_unor($unor="all",$pns="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND id_unor IN ($unor)";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE a.status_kepegawaian='pns'
		$iUnor
		$iPns
		$iGender
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function hitung_pegawai_agama($agama="all",$gender="all",$unor="all"){
			if($agama=="all"){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND b.gender='$gender'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE a.status_kepegawaian='pns'
		$iAgama
		$iGender
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function hitung_pegawai_perkawinan($perkawinan="all",$gender="all",$unor="all"){
			if($perkawinan=="all"){	$iPerkawinan = "";	} else {	$iPerkawinan = "AND status_perkawinan='$perkawinan'";	}
			if($gender=="all"){	$iGender = "";	}  else {	$iGender = "AND gender='$gender'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE a.status_kepegawaian='pns'
		$iPerkawinan
		$iGender
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_pendidikan_unor($unor="all",$pns="all",$pendidikan="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($pendidikan=="all"){	$iPendidikan = "";	} else {	$iPendidikan = "AND nama_jenjang='$pendidikan'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE a.status_kepegawaian='pns'
		$iUnor
		$iPns
		$iPendidikan
		$iGender
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_pegawai_jabatan_unor($unor="all",$pns="all",$jabatan="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($jabatan=="all"){	$iJabatan = "";	} else {	$iJabatan = "AND jab_type='$jabatan'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND gender='$gender'";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		WHERE a.status_kepegawaian='pns'
		$iUnor
		$iPns
		$iJabatan
		$iGender
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function hitung_ultah($unor="all",$pns="all",$jabatan="all",$gender="all"){
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "WHERE kode_unor LIKE '$unor%'";	}
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND tmt_pns='0000-00-00'";	} else {	$iPns = "AND tmt_pns!='0000-00-00'";	}
			if($jabatan=="all"){	$iJabatan = "";	} else {	$iJabatan = "AND jab_type='$jabatan'";	}
			if($gender=="all"){	$iGender = "";	} else {	$iGender = "AND gender='$gender'";	}
		$ultah = date('m-d');
		$sqlstr="SELECT DATE_FORMAT(a.tanggal_lahir,'%d-%m-%Y') AS tanggal_ultah,a.tanggal_lahir,a.nama_pegawai,
		TIMESTAMPDIFF(YEAR, a.tanggal_lahir, CURRENT_DATE) AS umur
		FROM (r_pegawai_aktual a)
		WHERE a.tanggal_lahir LIKE '%-$ultah' AND a.status_kepegawaian='pns'
		ORDER BY umur ASC
		";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_anak($kode,$tanggal){
		$sqlstr="SELECT * FROM m_unor WHERE kode_unor LIKE '$kode%' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'	ORDER BY kode_unor ASC";
		$query = $this->db->query($sqlstr)->result();
		return $query;
	}
	function cek_orphan($kdd){
		$sqlstr="SELECT * FROM r_pegawai_aktual WHERE status_kepegawaian='pns' AND kode_unor NOT IN ($kdd)";
		$query = $this->db->query($sqlstr)->result();
		return $query;
	}


}
