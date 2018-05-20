<?php
class M_event_peserta extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_event($idd){
		$sql = "SELECT a.*,
		DATE_FORMAT(a.tmt_diklat,'%d-%m-%Y') AS tmt_diklat_alt,
		DATE_FORMAT(a.tst_diklat,'%d-%m-%Y') AS tst_diklat_alt,
		b.jenis_diklat AS jenis,b.jenjang_diklat AS jenjang
		FROM md_diklat_event a LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat) 
		WHERE a.id_diklat_event='$idd'";
		$query = $this->db->query($sql)->row(); 
		return $query;
	}
	function hitung_event($cari,$rumpun,$tahun){
		$sqlstr="SELECT COUNT(a.id_diklat_event) AS numrows FROM (md_diklat_event a)
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		)
		AND a.tahun='$tahun'
		AND a.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	
	function hitung_widyaiswara($idd){
		$sqlstr="SELECT COUNT(id_diklat_widyaiswara) AS numrows 
		FROM md_diklat_widyaiswara WHERE id_diklat_event='$idd'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	
	function get_widyaiswara($idd,$mulai,$batas){
		$sqlstr="SELECT * FROM md_diklat_widyaiswara WHERE id_diklat_event='$idd'
		ORDER BY nama_pegawai DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function get_rincian($idd){
		$this->db->select('*');
		$this->db->from('md_diklat_peserta');
		$this->db->where('id_diklat_peserta',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	
	function biodata_edit_aksi($id_diklat_widyaiswara,$data)
	{
 
		$this->db->set('nip_baru',$data['nip_baru']);
//		$this->db->set('id_diklat_event',$isi['id_diklat_event']);
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('agama',$data['agama']);
		$this->db->set('materi',$data['materi']);
		$this->db->set('modul',$data['modul']);
		$this->db->set('hari',$data['hari']);
		$this->db->set('tanggal',date('Y-m-d',strtotime($data['tanggal'])));
		$this->db->set('jam',$data['jam']);
		$this->db->insert('md_diklat_widyaiswara');

	}
	
	function biodata_update_aksi($id_diklat_event,$id_diklat_widyaiswara)
	{

		$this->db->set('id_diklat_event',$id_diklat_event);
		$this->db->where('id_diklat_widyaiswara',$id_diklat_widyaiswara);
		$hslquery = $this->db->update('md_diklat_widyaiswara');
		return $hslquery;

	}
	
	function get_last_widyaiswara (){
		$sql = "select max(id_diklat_widyaiswara) as id_widyaiswara from md_diklat_widyaiswara";
		
		$hsl = $this->db->query($sql)->row('id_widyaiswara');
		
		return $hsl;
	} 
	
	function hapus_widyaiswara($isi){
		$sql = "SELECT * FROM md_diklat_widyaiswara WHERE id_diklat_widyaiswara='".$isi['idd']."'";
		$hsl = $this->db->query($sql)->row();
		
		$this->db->where('id_diklat_widyaiswara',$isi['idd']);
		$this->db->delete('md_diklat_widyaiswara');
	}
	
	function get_widyaiswara_by_nip($nip){
		$this->db->from('md_diklat_widyaiswara');
		$this->db->where('nip_baru',$nip);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	
	function get_event($cari,$rumpun,$tahun,$mulai,$batas){
		$sqlstr="
		SELECT a.*,
		DATE_FORMAT(a.tmt_diklat,'%d-%m-%Y') AS tmt_diklat_alt,
		DATE_FORMAT(a.tst_diklat,'%d-%m-%Y') AS tst_diklat_alt
		FROM md_diklat_event a
		WHERE  (
		a.nama_diklat LIKE '%$cari%'
		) 
		AND a.tahun='$tahun'
		AND a.id_diklat IN (SELECT id_diklat FROM md_diklat WHERE id_rumpun='$rumpun')
		ORDER BY a.id_diklat_event DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function tambah($isi){
		if($isi['id_diklat']!=""){
							$tmt_diklat = date("Y-m-d", strtotime($isi['tmt_diklat']));
							$tst_diklat = date("Y-m-d", strtotime($isi['tst_diklat']));
							$this->db->set('id_diklat',$isi['id_diklat']);
							$this->db->set('tahun',$isi['tahun']);
							$this->db->set('tempat_diklat',$isi['tempat_diklat']);
							$this->db->set('penyelenggara',$isi['penyelenggara']);
							$this->db->set('gelombang',$isi['gelombang']);
							$this->db->set('angkatan',$isi['angkatan']);
							$this->db->set('nama_diklat',$isi['nama_diklat']);
							$this->db->set('tmt_diklat',$tmt_diklat);
							$this->db->set('tst_diklat',$tst_diklat);
							$this->db->set('jam',$isi['jam']);
							$this->db->insert('md_diklat_event');
							$idk = $this->db->insert_id();
					
							$sqlstr="SELECT a.*	FROM md_diklat_calon a
							LEFT JOIN md_diklat_rencana b ON (a.id_diklat_rencana=b.id_diklat_rencana)
							WHERE a.id_diklat_rencana IN (SELECT id_diklat_rencana FROM md_diklat_rencana WHERE id_diklat='".$isi['id_diklat']."')
							AND a.status!='sudah'";
							$hslquery=$this->db->query($sqlstr)->result();
							foreach($hslquery AS $key=>$val){
									$pegawai = Modules::run("appbkpp/profile/ini_pegawai",$val->id_pegawai);
									$peg_pangkat = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$val->id_pegawai);
									$pangkat = end($peg_pangkat);
									$peg_jabatan = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$val->id_pegawai);
									$jabatan = end($peg_jabatan);
					
									$this->db->set('id_diklat_peserta_usulan',$val->id_diklat_calon);
									$this->db->set('id_pegawai',$val->id_pegawai);
									$this->db->set('nip_baru',$pegawai->nip_baru);
									$this->db->set('nama_pegawai',$pegawai->nama_pegawai);
									$this->db->set('id_diklat_event',$idk);
									$this->db->set('gelar_depan',$pegawai->gelar_depan);
									$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
									$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
									$this->db->set('reff_pangkat',$pangkat->id_peg_golongan);
									$this->db->set('reff_jabatan',$jabatan->id_peg_jab);
									$this->db->insert('md_diklat_peserta');
					
									$this->db->set('status','sudah');
									$this->db->where('id_diklat_calon',$val->id_diklat_calon);
									$this->db->update('md_diklat_calon');
							}
		}
	}

	function edit($isi){
		$tmt_diklat = date("Y-m-d", strtotime($isi['tmt_diklat']));
		$tst_diklat = date("Y-m-d", strtotime($isi['tst_diklat']));
		$this->db->set('id_diklat',$isi['id_diklat']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('nama_diklat',$isi['nama_diklat']);
		$this->db->set('tempat_diklat',$isi['tempat_diklat']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('angkatan',$isi['angkatan']);
		$this->db->set('tmt_diklat',$tmt_diklat);
		$this->db->set('tst_diklat',$tst_diklat);
		$this->db->set('jam',$isi['jam']);
		$this->db->where('id_diklat_event',$isi['idd']);
		$this->db->update('md_diklat_event');
	}
	function hapus($isi){
		$this->db->where('id_diklat_event',$isi['idd']);
		$this->db->delete('md_diklat_event');
	}
////////////////////////////////////////////////////////////////////
	function hitung_peserta($idd,$cari){
		$sqlstr="SELECT COUNT(a.id_diklat_peserta) AS numrows 
		FROM (md_diklat_peserta a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_diklat_event='$idd'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_peserta($idd,$cari,$mulai,$batas){

		$sqlstr="
		SELECT a.*, b.*, c.*, d.* 	
		FROM (md_diklat_peserta a)
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_peg_golongan c ON (a.reff_pangkat=c.id_peg_golongan)
		LEFT JOIN r_peg_jab d ON (a.reff_jabatan=d.id_peg_jab)
		WHERE  (
		b.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_diklat_event='$idd'
		ORDER BY a.nama_pegawai DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function tambah_peserta($isi,$peg,$rfjbt,$rfpkt){
		$event = $this->ini_event($isi['id_diklat_event']);
		$id_diklat = $event->id_diklat;
		$sql = "SELECT a.*	FROM md_diklat_calon a
		LEFT JOIN md_diklat_rencana b ON (a.id_diklat_rencana=b.id_diklat_rencana)
		WHERE a.id_pegawai = '".$isi['id_pegawai']."'
		AND a.id_diklat_rencana IN (SELECT id_diklat_rencana FROM md_diklat_rencana WHERE id_diklat='".$id_diklat."')
		AND a.status!='sudah'";
		$hsl = $this->db->query($sql)->row();

		if(!empty($hsl)){	$this->db->set('id_diklat_peserta_usulan',$hsl->id_diklat_calon);	}
		$this->db->set('id_diklat_event',$isi['id_diklat_event']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('nama_pegawai',$peg->nama_pegawai);
		$this->db->set('nip_baru',$peg->nip_baru);
		$this->db->set('gelar_depan',$peg->gelar_depan);
		$this->db->set('gelar_belakang',$peg->gelar_belakang);
		$this->db->set('gelar_nonakademis',$peg->gelar_nonakademis);
		$this->db->set('reff_pangkat',$rfpkt);
		$this->db->set('reff_jabatan',$rfjbt);
		$this->db->insert('md_diklat_peserta');
		
		$this->db->set('status','sudah');
		$this->db->where('id_diklat_calon',$hsl->id_diklat_calon);
		$this->db->update('md_diklat_calon');
	}
	function hapus_peserta($isi){
		$sql = "SELECT a.*	FROM md_diklat_peserta a WHERE a.id_diklat_peserta='".$isi['idd']."'";
		$hsl = $this->db->query($sql)->row();
		
		$this->db->where('id_diklat_peserta',$isi['idd']);
		$this->db->delete('md_diklat_peserta');

		$this->db->set('status','');
		$this->db->where('id_diklat_calon',$hsl->id_diklat_peserta_usulan);
		$this->db->update('md_diklat_calon');
	}
	function cek_peserta($idd,$id_peg){
		$sqlstr="SELECT a.*	FROM md_diklat_peserta a WHERE a.id_diklat_event='$idd' AND a.id_pegawai='$id_peg'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}


}
