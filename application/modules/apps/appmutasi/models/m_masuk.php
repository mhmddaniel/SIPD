<?php
class M_masuk extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_masuk($cari,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
		$sqlstr="SELECT COUNT(n.id_masuk) AS numrows
		FROM r_peg_masuk_aju n
		WHERE  (
		n.nip_baru LIKE '$cari%'
		OR n.nama_pegawai LIKE '%$cari%'
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_masuk($cari,$mulai,$batas,$pns="all",$unor="all",$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur="all",$mkcpns="all",$stib="all"){
		$sqlstr="SELECT 
		n.*
		FROM r_peg_masuk_aju n
		WHERE  (
		n.nip_baru LIKE '$cari%'
		OR n.nama_pegawai LIKE '%$cari%'
		)
		ORDER BY n.id_masuk
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	
	function ini_pemohon($idd){
		$sqlstr="SELECT a.*,DATE_FORMAT(a.tanggal_lahir,'%d-%m-%Y') AS tanggal_lahir FROM r_peg_masuk_aju a	WHERE a.id_masuk='$idd'";
		$peg = $this->db->query($sqlstr)->row();
		return $peg;
	}
//////////////////////////////////////////////////////////////////////////////////
	function tambah_masuk($data){
		$tanggal_lahir = date("Y-m-d", strtotime($data['tanggal_lahir']));


		$this->db->set('nip',$data['nip']);
		$this->db->set('nip_baru',$data['nip_baru']);
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('gender',$data['gender']);
		$this->db->set('tempat_lahir',$data['tempat_lahir']);
		$this->db->set('tanggal_lahir',$tanggal_lahir);
		$this->db->set('agama',$data['agama']);
		$this->db->set('status_perkawinan',$data['status_perkawinan']);
//		$this->db->set('status_kepegawaian',$data['status_kepegawaian']);
		$this->db->set('nomor_hp',$data['nomor_hp']);
		$this->db->set('nomor_tlp_rumah',$data['nomor_tlp_rumah']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_peg_masuk_aju');
		$id_pensiun = $this->db->insert_id();
		return $id_pensiun;
	}

	function edit_masuk($data){
		$tanggal_lahir = date("Y-m-d", strtotime($data['tanggal_lahir']));


		$this->db->set('nip',$data['nip']);
		$this->db->set('nip_baru',$data['nip_baru']);
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('gender',$data['gender']);
		$this->db->set('tempat_lahir',$data['tempat_lahir']);
		$this->db->set('tanggal_lahir',$tanggal_lahir);
		$this->db->set('agama',$data['agama']);
		$this->db->set('status_perkawinan',$data['status_perkawinan']);
//		$this->db->set('status_kepegawaian',$data['status_kepegawaian']);
		$this->db->set('nomor_hp',$data['nomor_hp']);
		$this->db->set('nomor_tlp_rumah',$data['nomor_tlp_rumah']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_masuk',$data['id_masuk']);
		$this->db->update('r_peg_masuk_aju');
	}

	function hapus_masuk($data){
		$this->db->where('id_masuk',$data['id_masuk']);
		$this->db->delete('r_peg_masuk_aju');
	}



//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($id_kpo,$tipe){
		$this->db->from('r_peg_masuk_dokumen');
		$this->db->where('id_masuk',$id_kpo);
		$this->db->where('tipe',$tipe);
		$this->db->order_by('halaman','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_dokumen($idd,$tipe);
		$hal = count($ini)+1;
			$this->db->set('id_masuk',$idd);
			$this->db->set('tipe',$tipe);
			$this->db->set('masuk_file',$nama_file);
			$this->db->set('halaman',$hal);
//			$this->db->set('id_reff',$idd);
			$this->db->insert('r_peg_masuk_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
/*
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_thumb,file_dokumen,halaman_item_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$hal','$idd')";		
			$this->db->query($sqlstr);
*/
	}
	function rename_dokumen($idd,$nama){
		$this->db->set('masuk_file',$nama);
		$this->db->where('id_masuk_dokumen',$idd);
		$this->db->update('r_peg_masuk_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_masuk_dokumen');
		$this->db->where('id_masuk_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_masuk_dokumen', array('id_masuk_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_reff,$komponen);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_masuk_dokumen SET halaman='".($key+1)."' WHERE id_masuk_dokumen='".$val->id_masuk_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}
//////////////////////////////////////////////////////////////////////////////////
	function permohonan_edit($isi){
		$tIsi = "{\"tanggal_surat\":\"".$isi['tanggal']."\",\"tanggal_diterima\":\"".$isi['tanggal_diterima']."\"}";
		$this->db->set('permohonan',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function pengantar_edit($isi){
		$tIsi = "{\"nama_pimpinan\":\"".$isi['nama_pimpinan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"tanggal\":\"".$isi['tanggal']."\",\"nomor\":\"".$isi['nomor']."\"}";
		$this->db->set('pengantar',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function ijazah_edit($isi){
		$tIsi = "{\"gelar_belakang\":\"".$isi['gelar_belakang']."\",\"gelar_depan\":\"".$isi['gelar_depan']."\",\"id_pendidikan\":\"".$isi['id_pendidikan']."\",\"kode_jenjang\":\"".$isi['kode_jenjang']."\",\"nama_jenjang\":\"".$isi['nama_jenjang']."\",\"nama_jenjang_rumpun\":\"".$isi['nama_jenjang_rumpun']."\",\"nama_pendidikan\":\"".$isi['nama_pendidikan']."\",\"lokasi_sekolah\":\"".$isi['lokasi_sekolah']."\",\"nama_sekolah\":\"".$isi['nama_sekolah']."\",\"nomor_ijazah\":\"".$isi['nomor_ijazah']."\",\"tanggal_lulus\":\"".$isi['tanggal_lulus']."\"}";
		$this->db->set('ijazah',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function sk_cpns_edit($isi){
		$tIsi = "{\"penandatangan\":\"".$isi['penandatangan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"tmt\":\"".$isi['tmt']."\",\"tanggal\":\"".$isi['tanggal']."\",\"nomor\":\"".$isi['nomor']."\"}";
		$this->db->set('sk_cpns',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function sk_pns_edit($isi){
		$tIsi = "{\"penandatangan\":\"".$isi['penandatangan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"tmt\":\"".$isi['tmt']."\",\"tanggal\":\"".$isi['tanggal']."\",\"nomor\":\"".$isi['nomor']."\"}";
		$this->db->set('sk_pns',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function sk_pangkat_edit($isi){
		$tIsi = "{\"penandatangan\":\"".$isi['penandatangan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"pangkat\":\"".$isi['pangkat']."\",\"tmt\":\"".$isi['tmt']."\",\"tanggal\":\"".$isi['tanggal']."\",\"nomor\":\"".$isi['nomor']."\"}";
		$this->db->set('sk_pangkat',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function sk_jabatan_edit($isi){
		$tIsi = "{\"penandatangan\":\"".$isi['penandatangan']."\",\"jabatan\":\"".$isi['jabatan']."\",\"nama_jabatan\":\"".$isi['nama_jabatan']."\",\"tmt\":\"".$isi['tmt']."\",\"tanggal\":\"".$isi['tanggal']."\",\"nomor\":\"".$isi['nomor']."\"}";
		$this->db->set('sk_jabatan',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}
	function skp_edit($isi){
		$tIsi = "{\"penilai\":\"".$isi['penilai']."\",\"jabatan\":\"".$isi['jabatan']."\",\"tahun\":\"".$isi['tahun']."\",\"nilai\":\"".$isi['nilai']."\"}";
		$this->db->set('skp',$tIsi);
		$this->db->where('id_masuk',$isi['idd']);
		$this->db->update('r_peg_masuk_aju');
	}


}
