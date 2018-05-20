<?php
class M_pensiun extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_pensiun($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM r_peg_pensiun_aju n
			LEFT JOIN (r_pegawai_aktual a) ON (n.id_pegawai=a.id_pegawai)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_pensiun($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND a.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND b.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND b.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		a.id_pegawai,c.nomenklatur_pada,
		FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(a.tmt_pangkat,'%Y%m%d'))/10000) AS mk_gol_tahun,
		FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(a.tmt_pangkat,'%m%d'))/100) %12 AS mk_gol_bulan,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,b.agama,
		d.tmt_cpns, e.tmt_pns
		FROM r_peg_pensiun_aju n
			LEFT JOIN (r_pegawai_aktual a) ON (n.id_pegawai=a.id_pegawai)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		)
		$iPns
		$iUnor
		$iPkt
		$iJbt
		$iEse
		$iTugas
		$iGender
		$iAgama
		$iStatus
		$iJenjang
		$iUmur $batUmur
		$iMkcpns $batMkcpns
		$iStib
		ORDER BY n.id_pensiun
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function ini_pensiun($idd){
		$sqlstr="SELECT a.*,d.id, d.tanggal_pensiun,d.no_sk,d.tanggal_sk,d.bkn_nomor,d.bkn_tanggal,d.mk_gol_tahun,d.mk_gol_bulan, b.nama_pegawai, b.nip_baru,c.nomenklatur_pada
		FROM r_peg_pensiun_aju a 
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN m_unor c ON (a.id_unor=c.id_unor) 
		LEFT JOIN r_pegawai_pensiun d ON (a.id_pegawai=d.id_pegawai) 
		WHERE a.id_pensiun='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_catatan($idd,$stct=""){
		$this->db->from('r_peg_pensiun_catatan');
		$this->db->where('id_pensiun',$idd);
		if($stct!=""){
		$this->db->where('status',$stct);
		}
		$this->db->order_by('id_catatan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_catatan($idd){
		$this->db->from('r_peg_pensiun_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function save_catatan($idd,$isi){
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status',"ditanya");
        $this->db->set('last_updated',"NOW()",false);
		if($isi['id_catatan']==""){
		$this->db->set('id_pensiun',$idd);
		$this->db->insert('r_peg_pensiun_catatan');
		} else {
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_kpo_catatan');
		}
	}
	function save_jawaban($isi){
		$this->db->set('jawaban',$isi['jawaban']);
		$this->db->set('status',"dijawab");
        $this->db->set('waktu',"NOW()",false);
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_pensiun_catatan');
	}
	function hapus_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('r_peg_pensiun_catatan');
	}
//////////////////////////////////////////////////////////////////////////////////
	function tambah_pemohon($pegawai){
		$this->db->set('id_pegawai',$pegawai->id_pegawai);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
		$this->db->set('id_unor',$pegawai->id_unor);
		$this->db->set('kode_golongan',$pegawai->kode_golongan);
		$this->db->set('jab_type',$pegawai->jab_type);
		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);
		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);
		$this->db->set('kode_jenis_pensiun',$pegawai->kode_jenis_pensiun);
		$this->db->set('status',"draft");
        $this->db->set('buat',"NOW()",false);
		$this->db->insert('r_peg_pensiun_aju');
		$id_pensiun = $this->db->insert_id();
		return $id_pensiun;
	}
	function pensiun_edit($isi){
		$this->db->set('kode_jenis_pensiun',$isi['kode_jenis_pensiun']);
		$this->db->where('id_pensiun',$isi['id_pensiun']);
		$this->db->update('r_peg_pensiun_aju');
	}

	function ajukan_pemohon($idd){
		$this->db->set('status',"aju");
        $this->db->set('aju',"NOW()",false);
		$this->db->where('id_pensiun',$idd);
		$this->db->update('r_peg_pensiun_aju');
	}
	function draft_pemohon($idd){
        $this->db->set('draft',"NOW()",false);
		$this->db->where('id_pensiun',$idd);
		$this->db->update('r_peg_pensiun_aju');
	}
	function koreksi_pemohon($idd){
		$this->db->set('status',"koreksi");
        $this->db->set('koreksi',"NOW()",false);
		$this->db->where('id_pensiun',$idd);
		$this->db->update('r_peg_pensiun_aju');
	}
	function acc_pemohon($isi){
		$this->db->set('status',"acc");
        $this->db->set('acc',"NOW()",false);
		$this->db->where('id_pensiun',$isi['id_pensiun']);
		$this->db->update('r_peg_pensiun_aju');

		$ini = $this->ini_pensiun($isi['id_pensiun']);
		$dJenis = $this->dropdowns->kode_jenis_pensiun();
		$jenis_pensiun = $dJenis[$ini->kode_jenis_pensiun];
		$tanggal_pensiun = date("Y-m-d", strtotime($isi['tanggal_pensiun']));
		$sk_tanggal = date("Y-m-d", strtotime($isi['tanggal']));
		$bkn_tanggal = date("Y-m-d", strtotime($isi['bkn_tanggal']));

		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$ini->id_pegawai);
		$hslquery = $this->db->get()->row();
		$ijo = json_encode($hslquery);	

		$tg = date("Y-m-d");
		$status = ($tanggal_pensiun<$tg)?"fix":"pending";

		$this->db->set('id_pegawai',$ini->id_pegawai);
		$this->db->set('nip_baru',$ini->nip_baru);
		$this->db->set('nama_pegawai',$ini->nama_pegawai);
		$this->db->set('no_sk',$isi['nomor']);
		$this->db->set('jenis_pensiun',$jenis_pensiun);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('bkn_nomor',$isi['bkn_nomor']);
		$this->db->set('tanggal_pensiun',$tanggal_pensiun);
		$this->db->set('tanggal_sk',$sk_tanggal);
		$this->db->set('bkn_tanggal',$bkn_tanggal);
		$this->db->set('var_r_pegawai_rekap',$ijo);
		$this->db->set('status',$status);
		$this->db->insert('r_pegawai_pensiun');
	}
	function edit_sk($isi){
		$ini = $this->ini_pensiun($isi['id_pensiun']);
		$dJenis = $this->dropdowns->kode_jenis_pensiun();
		$jenis_pensiun = $dJenis[$ini->kode_jenis_pensiun];
		$tanggal_pensiun = date("Y-m-d", strtotime($isi['tanggal_pensiun']));
		$sk_tanggal = date("Y-m-d", strtotime($isi['tanggal']));
		$bkn_tanggal = date("Y-m-d", strtotime($isi['bkn_tanggal']));

		$tg = date("Y-m-d");
		$status = ($tanggal_pensiun<$tg)?"fix":"pending";

		$this->db->set('nip_baru',$ini->nip_baru);
		$this->db->set('nama_pegawai',$ini->nama_pegawai);
		$this->db->set('no_sk',$isi['nomor']);
		$this->db->set('jenis_pensiun',$jenis_pensiun);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('bkn_nomor',$isi['bkn_nomor']);
		$this->db->set('tanggal_pensiun',$tanggal_pensiun);
		$this->db->set('tanggal_sk',$sk_tanggal);
		$this->db->set('bkn_tanggal',$bkn_tanggal);
		$this->db->set('status',$status);
		$this->db->where('id_pegawai',$ini->id_pegawai);
		$this->db->update('r_pegawai_pensiun');
	}

	function btl_pemohon($isi){
		$this->db->set('status',"revisi");
        $this->db->set('revisi',"NOW()",false);
		$this->db->where('id_pensiun',$isi['id_pensiun']);
		$this->db->update('r_peg_pensiun_aju');
	}

//////////////////////////////////////////////////////////////////////////////////
	function ijin_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ijin_pimpinan',$tIsi);
		$this->db->where('id_pensiun',$isi['idd']);
		$this->db->update('r_peg_pensiun_aju');
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($id_kpo,$tipe){
		$this->db->from('r_peg_pensiun_dokumen');
		$this->db->where('id_pensiun',$id_kpo);
		$this->db->where('tipe',$tipe);
		$this->db->order_by('halaman','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_dokumen($idd,$tipe);
		$hal = count($ini)+1;
			$this->db->set('id_pensiun',$idd);
			$this->db->set('tipe',$tipe);
			$this->db->set('pensiun_file',$nama_file);
			$this->db->set('halaman',$hal);
			$this->db->insert('r_peg_pensiun_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
	}

	function rename_dokumen($idd,$nama){
		$this->db->set('pensiun_file',$nama);
		$this->db->where('id_pensiun_dokumen',$idd);
		$this->db->update('r_peg_pensiun_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_pensiun_dokumen');
		$this->db->where('id_pensiun_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_pensiun_dokumen', array('id_pensiun_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_reff,$komponen);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_pensiun_dokumen SET halaman='".($key+1)."' WHERE id_pensiun_dokumen='".$val->id_pensiun_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}

	function edit_keterangan_dokumen($isi){
		$this->db->set('keterangan',$isi['keterangan']);
		$this->db->set('sub_keterangan',$isi['sub_keterangan']);
		$this->db->where('id_pensiun_dokumen',$isi['idd']);
		$this->db->update('r_peg_pensiun_dokumen');
	}

}
