<?php
class M_kpo extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_kpo($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT COUNT(n.id_kpo) AS numrows
		FROM r_peg_kpo_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_golongan o) ON (n.id_peg_golongan=o.id_peg_golongan)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
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
	function get_kpo($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
			$ttIni = date('Y')."-".date('m')."-01";
			if($pns=="all"){	$iPns = "";	} elseif($pns=="cpns"){	$iPns = "AND e.tmt_pns='0000-00-00'";	} else {	$iPns = "AND e.tmt_pns!='0000-00-00'";	}
			if($kode==""){
				if($unor=="all"){	$iUnor = "";	} else {	/*$iUnor = "AND n.id_unor IN ($unor)";*/	$iUnor = "AND n.id_pegawai IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE id_unor IN ($unor))";	}
			} else {
				$iUnor="AND b.kode_unor LIKE '$kode%'";
			}
			if($pkt==""){	$iPkt = "";	} else {	$iPkt = "AND n.kode_golongan='$pkt'";	}
			if($jbt==""){	$iJbt = "";	} else {	$iJbt = "AND n.jab_type='$jbt'";	}
			if($ese==""){	$iEse = "";	} else {	$iEse = "AND n.kode_ese='$ese'";	}
			if($tugas==""){	$iTugas = "";	} else {	$iTugas = "AND n.tugas_tambahan='$tugas'";	}
			if($gender==""){	$iGender = "";	} else {	$iGender = "AND f.gender='$gender'";	}
			if($agama==""){	$iAgama = "";	} else {	$iAgama = "AND f.agama='$agama'";	}
			if($status==""){	$iStatus = "";	} else {	$iStatus = "AND a.status_perkawinan='$status'";	}
			if($jenjang==""){	$iJenjang = "";	} else {	$iJenjang = "AND a.nama_jenjang='$jenjang'";	}
			$umur_db = $this->dropdowns->umur_db();
			if($umur=="all" || $umur==""){	$iUmur = "";$batUmur = "";	} else {	$iUmur = "AND TIMESTAMPDIFF(YEAR, b.tanggal_lahir, '$ttIni')";$batUmur = $umur_db[$umur];	}
			$mkcpns_db = $this->dropdowns->mkcpns_db();
			if($mkcpns=="all" || $mkcpns==""){	$iMkcpns = "";$batMkcpns = "";	} else {	$iMkcpns = "AND TIMESTAMPDIFF(YEAR, d.tmt_cpns, '$ttIni')";$batMkcpns = $mkcpns_db[$mkcpns];	}
			if($stib=="all" || $stib==""){	$iStib = "";	} elseif($stib=="selesai") {	$iStib = "AND n.status IN ('injek','acc')";	} elseif($stib=="berjalan") {	$iStib = "AND n.status NOT IN ('injek','acc')";	} else {	$iStib = "AND n.status='$stib'";	}

		$sqlstr="SELECT 
		n.*,DATE_FORMAT(n.aju,'%d-%m-%Y') AS tg_aju,DATE_FORMAT(n.koreksi,'%d-%m-%Y') AS tg_koreksi,
		c.nomenklatur_pada,
		b.nama_pegawai,b.nip_baru,b.gender,b.tempat_lahir,b.tanggal_lahir,f.agama,
		d.tmt_cpns, e.tmt_pns,
		o.kode_golongan AS kode_golongan_aju,o.kode_jenis_kp AS kode_jenis_kpo
		FROM r_peg_kpo_aju n
			LEFT JOIN (r_pegawai_aktual b) ON (n.id_pegawai=b.id_pegawai)
			LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
			LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
			LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
			LEFT JOIN (r_peg_golongan o) ON (n.id_peg_golongan=o.id_peg_golongan)
			LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
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
		ORDER BY n.id_kpo
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function ini_kpo($idd){
		$sqlstr="SELECT a.*, b.nama_pegawai, b.nip_baru, c.nomenklatur_pada,
		o.kode_golongan AS kode_golongan_aju,o.kode_jenis_kp AS kode_jenis_kpo,o.sk_nomor,o.sk_tanggal,o.mk_gol_tahun,o.mk_gol_bulan,o.kredit_utama,o.kredit_tambahan,o.tmt_golongan,o.bkn_nomor,o.bkn_tanggal
		FROM r_peg_kpo_aju a 
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN (m_unor c) ON (a.id_unor=c.id_unor)
		LEFT JOIN (r_peg_golongan o) ON (a.id_peg_golongan=o.id_peg_golongan)
		WHERE a.id_kpo='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_catatan($idd,$stct=""){
		$this->db->from('r_peg_kpo_catatan');
		$this->db->where('id_kpo',$idd);
		if($stct!=""){
		$this->db->where('status',$stct);
		}
		$this->db->order_by('id_catatan','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function ini_catatan($idd){
		$this->db->from('r_peg_kpo_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function save_catatan($idd,$isi){
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status',"ditanya");
        $this->db->set('last_updated',"NOW()",false);
		if($isi['id_catatan']==""){
		$this->db->set('id_kpo',$idd);
		$this->db->insert('r_peg_kpo_catatan');
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
		$this->db->update('r_peg_kpo_catatan');
	}
	function hapus_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('r_peg_kpo_catatan');
	}
//////////////////////////////////////////////////////////////////////////////////
	function tambah_pemohon($pegawai){
		$this->db->set('id_pegawai',$pegawai->id_pegawai);
		$this->db->set('id_peg_golongan',$pegawai->id_peg_golongan);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
		$this->db->set('id_unor',$pegawai->id_unor);
		$this->db->set('kode_golongan',$pegawai->kode_golongan);
		$this->db->set('jab_type',$pegawai->jab_type);
		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);
		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);
		$this->db->set('tahun_periode',$pegawai->tahun_periode);
		$this->db->set('bulan_periode',$pegawai->bulan_periode);
		$this->db->set('status',"draft");
        $this->db->set('buat',"NOW()",false);
		$this->db->insert('r_peg_kpo_aju');
		$this->db->insert_id();
	}
	function golongan_tambah($isi){
		$this->db->set('kode_golongan',$isi['kode_golongan_aju']);
		$this->db->set('kode_jenis_kp',$isi['kode_jenis_kpo']);
		$this->db->insert('r_peg_golongan');
		$id_peg_golongan = $this->db->insert_id();
		return $id_peg_golongan;
	}

	function kpo_edit($isi){
		$this->db->set('tahun_periode',$isi['tahun_periode']);
		$this->db->set('bulan_periode',$isi['bulan_periode']);
		$this->db->where('id_kpo',$isi['id_kpo']);
		$this->db->update('r_peg_kpo_aju');
		
		$ini = $this->ini_kpo($isi['id_kpo']);
		$this->db->set('kode_golongan',$isi['kode_golongan_aju']);
		$this->db->set('kode_jenis_kp',$isi['kode_jenis_kpo']);
		$this->db->where('id_peg_golongan',$ini->id_peg_golongan);
		$this->db->update('r_peg_golongan');
	}

	function ajukan_pemohon($idd){
		$this->db->set('status',"aju");
        $this->db->set('aju',"NOW()",false);
		$this->db->where('id_kpo',$idd);
		$this->db->update('r_peg_kpo_aju');
	}
	function draft_pemohon($idd){
        $this->db->set('draft',"NOW()",false);
		$this->db->where('id_kpo',$idd);
		$this->db->update('r_peg_kpo_aju');
	}
	function koreksi_pemohon($idd){
		$this->db->set('status',"koreksi");
        $this->db->set('koreksi',"NOW()",false);
		$this->db->where('id_kpo',$idd);
		$this->db->update('r_peg_kpo_aju');
	}
	function acc_pemohon($isi){
		$this->db->set('status',"acc");
        $this->db->set('acc',"NOW()",false);
		$this->db->where('id_kpo',$isi['id_kpo']);
		$this->db->update('r_peg_kpo_aju');

			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dJenis = $this->dropdowns->kode_jenis_kp();
		$tmt_golongan = date("Y-m-d", strtotime($isi['tmt_golongan']));
		$sk_tanggal = date("Y-m-d", strtotime($isi['tanggal']));
		$bkn_tanggal = date("Y-m-d", strtotime($isi['bkn_tanggal']));
		$ini = $this->ini_kpo($isi['id_kpo']);
		$nama_pangkat = $dWpangkat[$ini->kode_golongan];
		$nama_golongan = $dWgolongan[$ini->kode_golongan];
		$jenis_kp = $dJenis[$ini->kode_jenis_kpo];
		$this->db->set('id_pegawai',$ini->id_pegawai);
		$this->db->set('tmt_golongan',$tmt_golongan);
		$this->db->set('nama_pangkat',$nama_pangkat);
		$this->db->set('nama_golongan',$nama_golongan);
		$this->db->set('jenis_kp',$jenis_kp);
		$this->db->set('sk_nomor',$isi['nomor']);
		$this->db->set('sk_tanggal',$sk_tanggal);
		$this->db->set('bkn_nomor',$isi['bkn_nomor']);
		$this->db->set('bkn_tanggal',$bkn_tanggal);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('kredit_utama',$isi['kredit_utama']);
		$this->db->set('kredit_tambahan',$isi['kredit_tambahan']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_peg_golongan',$ini->id_peg_golongan);
		$this->db->update('r_peg_golongan');
	}

	function btl_pemohon($isi){
		$this->db->set('status',"revisi");
        $this->db->set('revisi',"NOW()",false);
		$this->db->where('id_kpo',$isi['id_kpo']);
		$this->db->update('r_peg_kpo_aju');
	}

//////////////////////////////////////////////////////////////////////////////////
	function ijin_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('ijin_pimpinan',$tIsi);
		$this->db->where('id_kpo',$isi['idd']);
		$this->db->update('r_peg_kpo_aju');
	}
	function buku_nikah_suami_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('buku_nikah_suami',$tIsi);
		$this->db->where('id_kpo',$isi['idd']);
		$this->db->update('r_peg_kpo_aju');
	}
	function buku_nikah_istri_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nomor\":\"".$isi['nomor']."\",\"tanggal\":\"".$isi['tanggal']."\"}";
		$this->db->set('buku_nikah_istri',$tIsi);
		$this->db->where('id_kpo',$isi['idd']);
		$this->db->update('r_peg_kpo_aju');
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($id_kpo,$tipe){
		$this->db->from('r_peg_kpo_dokumen');
		$this->db->where('id_kpo',$id_kpo);
		$this->db->where('tipe',$tipe);
		$this->db->order_by('halaman','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_dokumen($idd,$tipe);
		$hal = count($ini)+1;
			$this->db->set('id_kpo',$idd);
			$this->db->set('tipe',$tipe);
			$this->db->set('kpo_file',$nama_file);
			$this->db->set('halaman',$hal);
//			$this->db->set('id_reff',$idd);
			$this->db->insert('r_peg_kpo_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
/*
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_thumb,file_dokumen,halaman_item_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$hal','$idd')";		
			$this->db->query($sqlstr);
*/
	}

	function rename_dokumen($idd,$nama){
		$this->db->set('kpo_file',$nama);
		$this->db->where('id_kpo_dokumen',$idd);
		$this->db->update('r_peg_kpo_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_kpo_dokumen');
		$this->db->where('id_kpo_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_kpo_dokumen', array('id_kpo_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_reff,$komponen);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_kpo_dokumen SET halaman='".($key+1)."' WHERE id_kpo_dokumen='".$val->id_kpo_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}

	function edit_keterangan_dokumen($isi){
		$this->db->set('keterangan',$isi['keterangan']);
		$this->db->set('sub_keterangan',$isi['sub_keterangan']);
		$this->db->where('id_kpo_dokumen',$isi['idd']);
		$this->db->update('r_peg_kpo_dokumen');
	}

}
