<?php
class M_berkala extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_master_pegawai($jenis,$cari){
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai a)
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.status_kepegawaian='$jenis'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_master_pegawai($jenis,$cari,$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM r_pegawai a
		WHERE  (
		a.nip LIKE '$cari%'
		OR a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.status_kepegawaian='$jenis'
		ORDER BY a.nama_pegawai ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_arsip($idd){
		$sqlstr="SELECT a.*
		FROM r_peg_arsip a
		WHERE id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function input_arsip($isi){
		$this->db->set('nama_lengkap',$isi['nama_pegawai']);
		$this->db->set('nip',$isi['nip']);
		$this->db->set('nip_baru',$isi['nip_baru']);
		$this->db->set('tempat_lahir',$isi['tempat_lahir']);
		$this->db->set('tgl_lahir',$isi['tanggal_lahir']);
		$this->db->set('kd_arsip',$isi['kd_arsip']);
		$this->db->set('lemari',$isi['lemari']);
		$this->db->set('pintu',$isi['pintu']);
		$this->db->set('rak',$isi['rak']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_arsip');
	}
	function edit_arsip($isi){
		$this->db->set('kd_arsip',$isi['kd_arsip']);
		$this->db->set('lemari',$isi['lemari']);
		$this->db->set('pintu',$isi['pintu']);
		$this->db->set('rak',$isi['rak']);
		$this->db->where('id_arsip',$isi['id_arsip']);
		$this->db->update('r_peg_arsip');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_bulanan($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$dwBulan,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stkp="all"){
			$ttIni = $tahun."-".$bulan."-1";
			$curbul = date('m');
			$curthn = date('Y');
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($dwBulan==""){	$iDwBulan = "";	} else {	$iDwBulan = "AND month(d.tmt_cpns)='$dwBulan'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stkp=="all"){	$iStkp = "";	} else {	$iStkp = "AND a.status_kepegawaian='$stkp'";	}

		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
			LEFT JOIN (r_peg_kgb g) ON (a.id_pegawai = g.id_pegawai) AND g.id_kgb = (SELECT MAX(id_kgb) from r_peg_kgb z WHERE a.id_pegawai = z.id_pegawai)
			LEFT JOIN (r_berkala f) ON (a.kode_golongan=f.kode_golongan AND f.gaji_pokok IS NOT NULL AND(
			(f.masa_jabatan = (g.mk_gol_tahun + (FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(g.tmt_gaji,'%Y%m%d'))/10000)))
			AND
			(FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(g.tmt_gaji,'%m%d'))/100) %12) = 0
			)

			))
		WHERE a.bulan='$curbul' AND a.tahun='$curthn' AND f.gaji_pokok !=''
		AND (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iDwBulan
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iStkp
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_bulanan($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$dwBulan,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$bulan,$tahun,$stkp="all"){
			$ttIni = $tahun."-".$bulan."-1";
			$curbul = date('m');
			$curthn = date('Y');
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND a.id_unor IN ($unor)";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND a.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND a.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND a.kode_ese='$ese'";	}
			if($dwBulan==""){	$iDwBulan = "";	} else {	$iDwBulan = "AND month(d.tmt_cpns)='$dwBulan'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND a.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stkp=="all"){	$iStkp = "";	} else {	$iStkp = "AND a.status_kepegawaian='$stkp'";	}

		$sqlstr="SELECT 
		a.id_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.tmt_pangkat,a.tmt_jabatan,a.kode_golongan,a.nomenklatur_jabatan,a.tugas_tambahan,a.jab_type,a.kode_unor,a.nama_jenjang,a.kode_ese,
		(g.mk_gol_tahun) AS mk_berkala_tahun,
		(g.mk_gol_bulan) AS mk_berkala_bulan,
		b.nama_pegawai,b.nip_baru,b.gender,b.agama,b.tempat_lahir,b.tanggal_lahir,
		d.tmt_cpns,
		e.tmt_pns,
		c.nomenklatur_pada,
		f.gaji_pokok,
		g.gaji_baru,
		g.tmt_gaji,
		g.tanggal_sk,
		g.no_sk,
		YEAR(g.tmt_gaji) AS tahun_berkala

		FROM r_pegawai_bulanan a
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
			LEFT JOIN (r_peg_kgb g) ON (a.id_pegawai = g.id_pegawai) AND g.id_kgb = (SELECT MAX(id_kgb) from r_peg_kgb z WHERE a.id_pegawai = z.id_pegawai)
			LEFT JOIN (r_berkala f) ON (a.kode_golongan=f.kode_golongan AND f.gaji_pokok IS NOT NULL AND(
			(f.masa_jabatan = (g.mk_gol_tahun + (FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(g.tmt_gaji,'%Y%m%d'))/10000)))
			AND
			(FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(g.tmt_gaji,'%m%d'))/100) %12) = 0
			)

			))
		WHERE a.bulan='$curbul' AND a.tahun='$curthn'  AND f.gaji_pokok !=''
		AND (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR c.nomenklatur_pada LIKE '%$cari%'
		OR a.kode_unor LIKE '$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iDwBulan
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iStkp
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,d.tmt_cpns ASC,a.kode_unor
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


	function get_last_id_agenda()
	{
		$this->db->select_max('id_agenda');
		$query = $this->db->get('r_agenda');

		$id_agenda= $query->row('id_agenda');

		return $id_agenda; 
	}
	
	function hitung_gaji_baru($idd,$tahun,$bulan){
		$tahun=$tahun+2;
		$sqlstr="SELECT a.*,b.agama,b.gender, 
		c.tmt_cpns, d.tanggal_sk,d.tmt_gaji,d.no_sk,d.oleh_pejabat,d.kode_golongan as kode_golongan_lama,  d.mk_gol_tahun, d.mk_gol_bulan,d.gaji_baru, e.masa_jabatan, e.gaji_pokok, f.kode_unor as unor

		FROM r_pegawai_aktual a
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN (r_peg_cpns c) ON (a.id_pegawai = c.id_pegawai)
		LEFT JOIN (r_peg_kgb d) ON (a.id_pegawai = d.id_pegawai)
		LEFT JOIN (r_berkala e) ON (a.kode_golongan=e.kode_golongan)
		LEFT JOIN (r_peg_jab f) ON (a.id_pegawai=f.id_pegawai)
		WHERE a.id_pegawai='$idd' and e.masa_jabatan = '$tahun' ORDER BY d.gaji_baru DESC";
		$hslquery=$this->db->query($sqlstr)->row();


		$datetime1 = date_create($hslquery->tmt_gaji);
		$datetime2 = date_create(date('d-m-Y', strtotime("+ 2 years ", strtotime($hslquery->tmt_gaji))));

		$interval = date_diff($datetime2, $datetime1);

		$newthn = $interval->format('%y');
		$newbln = $interval->format('%m');



		$masa_jabatan_tahun = $hslquery->mk_gol_tahun + $newthn;
		@$hslquery->masa_jabatan_tahun = $masa_jabatan_tahun;

		if($newbln!=0){
			$masa_jabatan_tahun = $masa_jabatan_tahun + 1;
			$hslquery->tmt_gaji = date('d-m-Y', strtotime("+ ".$newbln." months ", strtotime($hslquery->tmt_gaji)));
			$newbln = 0;
		}

		$masa_jabatan_bulan = $newbln;
		@$hslquery->masa_jabatan_bulan = $masa_jabatan_bulan;


		$id_agenda = $this->get_last_id_agenda()+1;
		
		$no_sk = "822.".floor($hslquery->kode_golongan/10)."/".$id_agenda."/BKPSDM.III/".date('Y');

		$isi['kode_golongan'] = $hslquery->kode_golongan;
		$isi['mk_gol_tahun'] = $masa_jabatan_tahun;
		$isi['mk_gol_bulan'] = $masa_jabatan_bulan;
		$isi['oleh_pejabat'] = "WALIKOTA PALEMBANG";
		$isi['no_sk'] = $no_sk;
		$isi['tanggal_sk'] = date('d-m-Y');
		$isi['gaji_lama'] = $hslquery->gaji_baru;
		$isi['gaji_baru'] = str_replace(",","",trim($hslquery->gaji_pokok));
		$isi['tmt_gaji'] = date('d-m-Y', strtotime("+ 2 years ", strtotime($hslquery->tmt_gaji)));
		$isi['id_pegawai'] = $idd;

		return $isi;
	}	
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_duk($cari,$pns,$unor="all"){
			if($pns=="jfu"){	$iPns = "AND (jab_type='jfu' OR jab_type='js')";	} elseif($pns=="jft"){	$iPns = "AND jab_type='jft'";	} else {	$iPns = "AND jab_type='jft-guru'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND id_unor IN ($unor)";	}
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (rekap_peg a)
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		)
		$iPns
		$iUnor
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_duk($cari,$mulai,$batas,$pns,$unor="all"){
			if($pns=="jfu"){	$iPns = "AND (jab_type='jfu' OR jab_type='js')";	} elseif($pns=="jft"){	$iPns = "AND jab_type='jft'";	} else {	$iPns = "AND jab_type='jft-guru'";	}
			if($unor=="all"){	$iUnor = "";	} else {	$iUnor = "AND id_unor IN ($unor)";	}
		$sqlstr="SELECT a.*
		FROM rekap_peg a
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		OR a.nomenklatur_pada LIKE '%$cari%'
		)
		$iPns
		$iUnor
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.kode_ese DESC,a.tmt_ese ASC,a.tmt_cpns ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_pegawai_master_by_nip($nip){
		$this->db->from('r_pegawai');
		$this->db->where('nip_baru',$nip);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function get_pegawai_by_nip($nip){
		$this->db->from('rekap_peg');
		$this->db->where('nip_baru',$nip);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
    function ini_pegawai_foto($idd){
		$this->db->from('r_peg_foto');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
//////////////////////////////////setup user/////////////////////////////////////
	function userskp_setup_aksi($isi){
		$this->db->from('cmf_setting');
		$this->db->where('id_setting',13);
		$this->db->where('nama_item','pegawai');
		$hslquery = $this->db->get()->row();
		$grupid = $hslquery->id_item; 

		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->delete('user_pegawai');

		$this->db->where('group_id',$grupid);
		$this->db->where('username',$isi['username']);
		$this->db->delete('users');

	        $this->db->set('group_id',$grupid);
	        $this->db->set('username',$isi['username']);
	        $this->db->set('passwd',sha1($isi['password']));
	        $this->db->set('nama_user',$isi['nama']);
	        $this->db->set('status','on');
			$this->db->insert('users');
			$id_user = $this->db->insert_id();

			$this->db->set('user_id',$id_user);
			$this->db->set('id_pegawai',$isi['id_pegawai']);
			$this->db->insert('user_pegawai');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pegawai_pros($cari,$tab){
		$sqlstr="SELECT COUNT(a.id) AS numrows
		FROM (r_pegawai_$tab a)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pegawai_pros($cari,$mulai,$batas,$tab){
		$sqlstr="SELECT a.*
		FROM r_pegawai_$tab a
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		ORDER BY a.tanggal_$tab ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_pegawai_meninggal($idd){
		$this->db->from('r_pegawai_meninggal');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function pros_meninggal_tambah_aksi($idd,$isi){
		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tanggal_meninggal',date("Y-m-d", strtotime($idd['tanggal_meninggal'])));
		$this->db->set('tempat_meninggal',$idd['tempat_meninggal']);
		$this->db->set('sebab_meninggal',$idd['sebab_meninggal']);
		$this->db->set('var_r_pegawai_rekap',$isi);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_pegawai_meninggal');

		$this->db->set('status','meninggal');
		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->update('r_pegawai');

		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->delete('rekap_peg');
	}
	function pros_meninggal_edit_aksi($idd){
		$this->db->set('tanggal_meninggal',date("Y-m-d", strtotime($idd['tanggal_meninggal'])));
		$this->db->set('tempat_meninggal',$idd['tempat_meninggal']);
		$this->db->set('sebab_meninggal',$idd['sebab_meninggal']);
		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->update('r_pegawai_meninggal');
	}

	function pros_meninggal_hapus_aksi($idd){
		$sql="SELECT var_r_pegawai_rekap FROM r_pegawai_meninggal WHERE id_pegawai='".$idd->id_pegawai."'";
		$qry = $this->db->query($sql)->row();
		$pv = json_decode($qry->var_r_pegawai_rekap);

		$dbS = $this->db->database;
		$sqA="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='$dbS' AND `TABLE_NAME`='rekap_peg'";
		$qrA = $this->db->query($sqA)->result(); 

		foreach($qrA AS $key=>$val){
			$fns = $val->COLUMN_NAME;
			$nli = @$pv->$fns;
			$this->db->set($fns,$nli);
		}
		$this->db->insert('rekap_peg');

		$this->db->set('status','aktif');
		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->update('r_pegawai');

		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->delete('r_pegawai_meninggal');
	}

	function ini_pegawai_pensiun($idd){
		$this->db->from('r_pegawai_pensiun');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pros_pensiun_tambah_aksi($idd,$isi){
		$tg = date("Y-m-d");
		$status = (strtotime($idd['tanggal_pensiun'])<$tg)?"fix":"pending";
		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tanggal_pensiun',date("Y-m-d", strtotime($idd['tanggal_pensiun'])));
		$this->db->set('no_sk',$idd['no_sk']);
		$this->db->set('tanggal_sk',date("Y-m-d", strtotime($idd['tanggal_sk'])));
		$this->db->set('jenis_pensiun',$idd['jenis_pensiun']);
		$this->db->set('var_r_pegawai_rekap',$isi);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('status',$status);
		$this->db->insert('r_pegawai_pensiun');

		if(date("Y-m-d", strtotime($idd['tanggal_pensiun']))<$tg){
			$this->db->set('status','pensiun');
			$this->db->where('id_pegawai',$idd['id_pegawai']);
			$this->db->update('r_pegawai');
	
			$this->db->where('id_pegawai',$idd['id_pegawai']);
			$this->db->delete('rekap_peg');
		}
	}

	function pros_pensiun_edit_aksi($idd){
		$this->db->set('tanggal_pensiun',date("Y-m-d", strtotime($idd['tanggal_pensiun'])));
		$this->db->set('no_sk',$idd['no_sk']);
		$this->db->set('tanggal_sk',date("Y-m-d", strtotime($idd['tanggal_sk'])));
		$this->db->set('jenis_pensiun',$idd['jenis_pensiun']);
		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->update('r_pegawai_pensiun');
	}
	function pros_pensiun_hapus_aksi($idd){

		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->delete('rekap_peg');

		foreach($idd AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('rekap_peg');

		$this->db->set('status','aktif');
		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->update('r_pegawai');

		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->delete('r_pegawai_pensiun');
	}

	function ini_pegawai_keluar($idd){
		$this->db->from('r_pegawai_keluar');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pros_keluar_tambah_aksi($idd,$isi){
		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tanggal_keluar',date("Y-m-d", strtotime($idd['tanggal_keluar'])));
		$this->db->set('no_sk',$idd['no_sk']);
		$this->db->set('tanggal_sk',date("Y-m-d", strtotime($idd['tanggal_sk'])));
		$this->db->set('instansi_tujuan',$idd['instansi_tujuan']);
		$this->db->set('var_r_pegawai_rekap',$isi);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_pegawai_keluar');

		$this->db->set('status','keluar');
		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->update('r_pegawai');

		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->delete('rekap_peg');
	}
	function pros_keluar_edit_aksi($idd){
		$this->db->set('tanggal_keluar',date("Y-m-d", strtotime($idd['tanggal_keluar'])));
		$this->db->set('no_sk',$idd['no_sk']);
		$this->db->set('tanggal_sk',date("Y-m-d", strtotime($idd['tanggal_sk'])));
		$this->db->set('instansi_tujuan',$idd['instansi_tujuan']);
		$this->db->where('id_pegawai',$idd['id_pegawai']);
		$this->db->update('r_pegawai_keluar');
	}
	function pros_keluar_hapus_aksi($idd){
		foreach($idd AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('rekap_peg');

		$this->db->set('status','aktif');
		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->update('r_pegawai');

		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->delete('r_pegawai_keluar');
	}

	function pros_penambahan_aksi($idd){
		foreach($idd AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('r_pegawai');
		$id_pegawai = $this->db->insert_id();

		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('id_pegawai',$id_pegawai);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nip',$idd['nip']);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('rekap_peg');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_jfu($cari,$jenis="jfu"){
		$sqlstr="SELECT COUNT(a.id_jabatan) AS numrows
		FROM (m_jf a)
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '%$cari%'
		)
		AND jab_type = '$jenis'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_jfu($cari,$jenis="jfu",$mulai,$batas){
		$sqlstr="SELECT a.*
		FROM m_jf a
		WHERE  (
		a.nama_jabatan LIKE '%$cari%'
		OR a.kode_bkn LIKE '%$cari%'
		)
		AND jab_type = '$jenis'
		ORDER BY a.nama_jabatan ASC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         PROSES INJEK K2
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function pros_injek_k2($idd){
		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tempat_lahir',$idd['tempat_lahir']);
		$this->db->set('tanggal_lahir',$idd['tanggal_lahir']);
		$this->db->set('agama',$idd['agama']);
		$this->db->set('gender',$idd['gender']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('status','cpns');
		$this->db->insert('r_pegawai');

		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tempat_lahir',$idd['tempat_lahir']);
		$this->db->set('tanggal_lahir',$idd['tanggal_lahir']);
		$this->db->set('agama',$idd['agama']);
		$this->db->set('gender',$idd['gender']);
		$this->db->set('tmt_pangkat',$idd['tmt_pangkat']);
		$this->db->set('nama_pangkat',$idd['nama_pangkat']);
		$this->db->set('nama_golongan',$idd['nama_golongan']);
		$this->db->set('kode_golongan',$idd['kode_golongan']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('status_kepegawaian','cpns');
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('rekap_peg');

		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('tmt_cpns',$idd['tmt_pangkat']);
		$this->db->set('sk_cpns_nomor',"CPNS K2 Tahun 2014");
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_peg_cpns');

		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('nama_pangkat',$idd['nama_pangkat']);
		$this->db->set('nama_golongan',$idd['nama_golongan']);
		$this->db->set('kode_golongan',$idd['kode_golongan']);
		$this->db->set('sk_nomor',"CPNS K2 Tahun 2014");
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_peg_golongan');
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         PROSES REKON PEGAWAI MASTER
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function formsub_pensiun_aksi($idd,$isi){
		$this->db->set('id_pegawai',$idd['id_pegawai']);
		$this->db->set('nip_baru',$idd['nip_baru']);
		$this->db->set('nama_pegawai',$idd['nama_pegawai']);
		$this->db->set('tanggal_pensiun',date("Y-m-d", strtotime($idd['tanggal_pensiun'])));
		$this->db->set('no_sk',$idd['no_sk']);
		$this->db->set('tanggal_sk',date("Y-m-d", strtotime($idd['tanggal_sk'])));
		$this->db->set('jenis_pensiun',$idd['jenis_pensiun']);
		$this->db->set('var_r_pegawai_rekap',$isi);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_pegawai_pensiun');

	}


}
