<?php
class M_tubel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_tubel($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
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
		FROM r_peg_tubel_aju n
			LEFT JOIN (r_pegawai_aktual a) ON (n.id_pegawai=a.id_pegawai)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR n.nomenklatur_pada LIKE '%$cari%'
		OR n.kode_unor LIKE '$cari%'
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
	function get_tubel($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
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
		a.id_pegawai,
		FLOOR(( DATE_FORMAT('$ttIni','%Y%m%d') - DATE_FORMAT(n.tmt_pangkat,'%Y%m%d'))/10000) AS mk_gol_tahun,
		FLOOR((1200 + DATE_FORMAT('$ttIni','%m%d') - DATE_FORMAT(n.tmt_pangkat,'%m%d'))/100) %12 AS mk_gol_bulan,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,b.agama,
		d.tmt_cpns, e.tmt_pns
		FROM r_peg_tubel_aju n
			LEFT JOIN (r_pegawai_aktual a) ON (n.id_pegawai=a.id_pegawai)
			LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (a.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (a.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		WHERE  (
		b.nip_baru LIKE '$cari%'
		OR b.nama_pegawai LIKE '%$cari%'
		OR n.nomenklatur_pada LIKE '%$cari%'
		OR n.kode_unor LIKE '$cari%'
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
		ORDER BY n.id_tubel
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function ini_tubel($idd){
		$sqlstr="SELECT a.*, b.nama_pegawai, b.nip_baru FROM r_peg_tubel_aju a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) WHERE a.id_tubel='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
	function ini_acc($idd){
		$sqlstr="SELECT a.*, DATE_FORMAT(a.tanggal_surat,'%d-%m-%Y') AS tg_surat FROM r_peg_tubel a WHERE a.id_tubel='$idd'";
		$acc = $this->db->query($sqlstr)->row();
		return $acc;
	}
	function get_tubel_riwayat($idd){
		$sqlstr="SELECT a.*,b.* FROM r_peg_tubel a LEFT JOIN (r_peg_tubel_sekolah b) ON (a.id_tubel=b.id_tubel) WHERE a.id_pegawai='$idd'";
		$acc = $this->db->query($sqlstr)->result();
		return $acc;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_catatan($idd,$stct=""){
		$this->db->from('r_peg_tubel_catatan');
		$this->db->where('id_tubel',$idd);
		if($stct!=""){
		$this->db->where('status',$stct);
		}
		$this->db->order_by('id_catatan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_catatan($idd){
		$this->db->from('r_peg_tubel_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function save_catatan($idd,$isi){
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status',"ditanya");
        $this->db->set('last_updated',"NOW()",false);
		if($isi['id_catatan']==""){
		$this->db->set('id_tubel',$idd);
		$this->db->insert('r_peg_tubel_catatan');
		} else {
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_tubel_catatan');
		}
	}
	function save_jawaban($isi){
		$this->db->set('jawaban',$isi['jawaban']);
		$this->db->set('status',"dijawab");
        $this->db->set('waktu',"NOW()",false);
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('r_peg_tubel_catatan');
	}
	function hapus_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('r_peg_tubel_catatan');
	}
//////////////////////////////////////////////////////////////////////////////////
	function tambah_pemohon($pegawai){
		$this->db->set('id_pegawai',$pegawai->id_pegawai);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
		$this->db->set('id_unor',$pegawai->id_unor);
		$this->db->set('kode_unor',$pegawai->kode_unor);
		$this->db->set('kode_ese',$pegawai->kode_ese);
		$this->db->set('tmt_ese',$pegawai->tmt_ese);
		$this->db->set('tmt_pangkat',$pegawai->tmt_pangkat);
		$this->db->set('tmt_jabatan',$pegawai->tmt_jabatan);
		$this->db->set('kode_golongan',$pegawai->kode_golongan);
		$this->db->set('nomenklatur_pada',$pegawai->nomenklatur_pada);
		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);
		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);
		$this->db->set('jab_type',$pegawai->jab_type);
		$this->db->set('status',"draft");
        $this->db->set('buat',"NOW()",false);
		$this->db->insert('r_peg_tubel_aju');
		$id_tubel = $this->db->insert_id();
		return $id_tubel;
	}

	function ajukan_pemohon($idd){
		$this->db->set('status',"aju");
        $this->db->set('aju',"NOW()",false);
		$this->db->where('id_tubel',$idd);
		$this->db->update('r_peg_tubel_aju');
	}
	function draft_pemohon($idd){
        $this->db->set('draft',"NOW()",false);
		$this->db->where('id_tubel',$idd);
		$this->db->update('r_peg_tubel_aju');
	}
	function koreksi_pemohon($idd){
		$this->db->set('status',"koreksi");
        $this->db->set('koreksi',"NOW()",false);
		$this->db->where('id_tubel',$idd);
		$this->db->update('r_peg_tubel_aju');
	}
	function acc_pemohon($isi){
		$this->db->set('status',"acc");
        $this->db->set('acc',"NOW()",false);
		$this->db->where('id_tubel',$isi['id_tubel']);
		$this->db->update('r_peg_tubel_aju');

		$peg = $this->ini_tubel($isi['id_tubel']);
		$tgl = date("Y-m-d", strtotime($isi['tanggal']));
		$this->db->set('id_tubel',$isi['id_tubel']);
		$this->db->set('id_pegawai',$peg->id_pegawai);
		$this->db->set('nomor_surat',$isi['nomor']);
		$this->db->set('tanggal_surat',$tgl);
		$this->db->insert('r_peg_tubel');
	}

	function btl_pemohon($isi){
		$this->db->set('status',"revisi");
        $this->db->set('revisi',"NOW()",false);
		$this->db->where('id_tubel',$isi['id_tubel']);
		$this->db->update('r_peg_tubel_aju');
	}

	function ini_sekolah($idd){
		$sqlstr="SELECT a.* FROM r_peg_tubel_sekolah a WHERE a.id_tubel='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
	function sekolah_edit($isi){
		$tanggal_masuk = date("Y-m-d", strtotime($isi['tanggal_masuk']));
		$this->db->set('id_pendidikan',$isi['id_pendidikan']);
		$this->db->set('nama_pendidikan',$isi['nama_pendidikan']);
		$this->db->set('lokasi_sekolah',$isi['lokasi_sekolah']);
		$this->db->set('nama_sekolah',$isi['nama_sekolah']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->set('nama_jenjang_rumpun',$isi['nama_jenjang_rumpun']);
		$this->db->set('tanggal_masuk',$tanggal_masuk);
		$this->db->set('gelar_depan',$isi['gelar_depan']);
		$this->db->set('gelar_belakang',$isi['gelar_belakang']);
		$this->db->where('id_tubel_sekolah',$isi['id_tubel_sekolah']);
		$this->db->update('r_peg_tubel_sekolah');
	}
	function sekolah_tambah($isi){
		$tanggal_masuk = date("Y-m-d", strtotime($isi['tanggal_masuk']));
		$this->db->set('id_pendidikan',$isi['id_pendidikan']);
		$this->db->set('nama_pendidikan',$isi['nama_pendidikan']);
		$this->db->set('lokasi_sekolah',$isi['lokasi_sekolah']);
		$this->db->set('nama_sekolah',$isi['nama_sekolah']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->set('nama_jenjang_rumpun',$isi['nama_jenjang_rumpun']);
		$this->db->set('tanggal_masuk',$tanggal_masuk);
		$this->db->set('gelar_depan',$isi['gelar_depan']);
		$this->db->set('gelar_belakang',$isi['gelar_belakang']);
		$this->db->set('id_tubel',$isi['id_tubel']);
		$this->db->insert('r_peg_tubel_sekolah');
	}
//////////////////////////////////////////////////////////////////////////////////
	function ijin_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ijin_pimpinan',$tIsi);
		$this->db->where('id_tubel',$isi['idd']);
		$this->db->update('r_peg_tubel_aju');
	}
	function akreditasi_edit($isi){
		$tIsi = "{\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\",\"peringkat\":\"".$isi['peringkat']."\",\"kadaluarsa\":\"".$isi['kadaluarsa']."\"}";
		$this->db->set('akreditasi',$tIsi);
		$this->db->where('id_tubel',$isi['idd']);
		$this->db->update('r_peg_tubel_aju');
	}
	function jadwal_edit($isi){
		$tIsi = "{\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('jadwal',$tIsi);
		$this->db->where('id_tubel',$isi['idd']);
		$this->db->update('r_peg_tubel_aju');
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($id_tubel,$tipe){
		$this->db->from('r_peg_tubel_dokumen');
		$this->db->where('id_tubel',$id_tubel);
		$this->db->where('tipe',$tipe);
		$this->db->order_by('halaman','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_dokumen($idd,$tipe);
		$hal = count($ini)+1;
			$this->db->set('id_tubel',$idd);
			$this->db->set('tipe',$tipe);
			$this->db->set('tubel_file',$nama_file);
			$this->db->set('halaman',$hal);
//			$this->db->set('id_reff',$idd);
			$this->db->insert('r_peg_tubel_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
/*
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_thumb,file_dokumen,halaman_item_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$hal','$idd')";		
			$this->db->query($sqlstr);
*/
	}

	function rename_dokumen($idd,$nama){
		$this->db->set('tubel_file',$nama);
		$this->db->where('id_tubel_dokumen',$idd);
		$this->db->update('r_peg_tubel_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_tubel_dokumen');
		$this->db->where('id_tubel_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_tubel_dokumen', array('id_tubel_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_reff,$komponen);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_tubel_dokumen SET halaman='".($key+1)."' WHERE id_tubel_dokumen='".$val->id_tubel_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}

	function edit_keterangan_dokumen($isi){
		$this->db->set('keterangan',$isi['keterangan']);
		$this->db->set('sub_keterangan',$isi['sub_keterangan']);
		$this->db->where('id_tubel_dokumen',$isi['idd']);
		$this->db->update('r_peg_tubel_dokumen');
	}

}
