<?php
class M_mutasi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function get_pejabat_rancangan($idd,$idr){
		$this->db->from('p_mut_rancangan_pemangku');
		$this->db->where('id_unor',$idd);
		$this->db->where('id_rancangan',$idr);
		$this->db->where('jab_type','js');
		$this->db->or_where('tugas_tambahan','Kepala Sekolah');
		$this->db->where('id_unor',$idd);
		$this->db->where('id_rancangan',$idr);
		$this->db->order_by('kode_golongan','DESC');
		$this->db->order_by('tmt_pangkat','ASC');
		$this->db->order_by('tmt_cpns','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}

    function get_rancangan(){
		$this->db->from('p_mut_rancangan');
		$this->db->order_by('id_rancangan','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}

    function ini_rancangan($idd){
		$this->db->from('p_mut_rancangan');
		$this->db->where('id_rancangan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

    function rancangan_edit_aksi($idd){
		$this->db->set('nama_rancangan',$idd['nama_rancangan']);
		$this->db->set('tahun',$idd['tahun']);
		$this->db->where('id_rancangan',$idd['id_rancangan']);
		$this->db->update('p_mut_rancangan');
	}
    function rancangan_ajukan_aksi($idd){
		$this->db->set('status',"fix");
		$this->db->where('id_rancangan',$idd);
		$this->db->update('p_mut_rancangan');
	}
    function rancangan_hapus_aksi($idd){
		$this->db->where('id_rancangan',$idd);
		$this->db->delete('p_mut_rancangan');

		$this->db->where('id_rancangan',$idd);
		$this->db->delete('p_mut_rancangan_pemangku');
	}

    function rancangan_baru_aksi($idd){
		$tmt = date("Y-m-d", strtotime($idd['tmt_jabatan']));
		$this->db->set('nama_rancangan',$idd['nama_rancangan']);
		$this->db->set('tahun',$idd['tahun']);
		$this->db->set('periode',$tmt);
		$this->db->insert('p_mut_rancangan');
		$id_rancangan = $this->db->insert_id();

		$pemangku = $this->get_pegawai_duk($tmt);
		foreach($pemangku AS $key=>$val){
			$this->db->set('id_rancangan',$id_rancangan);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('nip_baru',$val->nip_baru);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('gelar_nonakademis',$val->gelar_nonakademis);
			$this->db->set('gelar_depan',$val->gelar_depan);
			$this->db->set('gelar_belakang',$val->gelar_belakang);
			$this->db->set('tmt_cpns',$val->tmt_cpns);
			$this->db->set('tmt_pns',$val->tmt_pns);
			$this->db->set('kode_golongan',$val->kode_golongan);
			$this->db->set('tmt_pangkat',$val->tmt_pangkat);
			$this->db->set('id_unor',$val->id_unor);
			$this->db->set('jab_type',$val->jab_type);
			$this->db->set('kode_ese',$val->kode_ese);
			$this->db->set('tmt_ese',$val->tmt_ese);
			$this->db->set('tugas_tambahan',$val->tugas_tambahan);
			$this->db->insert('p_mut_rancangan_pemangku');
		}
	}


	function get_pegawai_duk($tanggal){
		$sqlstr="SELECT a.*
		FROM r_pegawai_aktual a
		WHERE 
		(jab_type='js' OR tugas_tambahan='Kepala Sekolah')
		AND a.id_unor IN (SELECT b.id_unor FROM m_unor b WHERE b.tmt_berlaku<='$tanggal' AND b.tst_berlaku>='$tanggal')
		ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.tmt_cpns ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function cek_jabatan_pegawai($idd,$idr){
		$this->db->from('p_mut_rancangan_pemangku');
		$this->db->where('id_pegawai',$idd);
		$this->db->where('id_rancangan',$idr);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

    function mutasi($idd,$idp,$idr){
		$unor = $this->ini_unor($idp['id_unor']);
		$tanggal = $idp['tmt_jabatan'];
			$val = Modules::run("appbkpp/profile/ini_pegawai",$idd->id_pegawai);
			$sqA = "SELECT * FROM m_unor WHERE id_unor='".$val->id_unor."' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
			$hsA = $this->db->query($sqA)->row();
			if((empty($hsA) || $unor->id_unor!=$val->id_unor) && ($val->jab_type!='js' || $val->tugas_tambahan!="Kepala Sekolah")){
				$stt=1;
			} else {
				$stt=0;
			}
		$this->db->set('id_unor',$unor->id_unor);
		$this->db->set('kode_ese',$unor->kode_ese);
if($unor->kode_ese==99){
			$this->db->set('tugas_tambahan','Kepala Sekolah');
			$this->db->set('jab_type','jft-guru');
} else {
			$this->db->set('tugas_tambahan','');
			$this->db->set('jab_type','js');
}
		$this->db->set('status',$stt);
		$this->db->where('id_rancangan',$idr);
		$this->db->where('id_pegawai',$idd->id_pegawai);
		$this->db->update('p_mut_rancangan_pemangku');
	}

    function promosi($val,$idp,$idr){
		$unor = $this->ini_unor($idp['id_unor']);
		$tmt = date("Y-m-d", strtotime($idp['tmt_jabatan']));

			$this->db->set('id_rancangan',$idr);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('nip_baru',$val->nip_baru);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('gelar_nonakademis',$val->gelar_nonakademis);
			$this->db->set('gelar_depan',$val->gelar_depan);
			$this->db->set('gelar_belakang',$val->gelar_belakang);

			$this->db->set('tmt_cpns',$val->tmt_cpns);
			$this->db->set('tmt_pns',$val->tmt_pns);
			$this->db->set('kode_golongan',$val->kode_golongan);
			$this->db->set('tmt_pangkat',$val->tmt_pangkat);
			$this->db->set('tmt_ese',$val->tmt_ese);
if($unor->kode_ese==99){
			$this->db->set('kode_ese','99');
			$this->db->set('tugas_tambahan','Kepala Sekolah');
			$this->db->set('jab_type',$val->jab_type);
} else {
			$this->db->set('kode_ese',$unor->kode_ese);
			$this->db->set('tugas_tambahan',$val->tugas_tambahan);
			$this->db->set('jab_type','js');
}
			$this->db->set('id_unor',$unor->id_unor);
			$this->db->set('status',1);
			$this->db->insert('p_mut_rancangan_pemangku');
	}

	function ini_unor($idd){
		$this->db->from('m_unor');
		$this->db->where('id_unor',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_hasil_rancangan($cari,$idd){
		$sqlstr="SELECT COUNT(a.id) AS numrows FROM (p_mut_rancangan_pemangku a)
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_rancangan='$idd' AND a.status='1'";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_hasil_rancangan($cari,$mulai,$batas,$idd){
		$sqlstr="SELECT a.*,b.*	FROM (p_mut_rancangan_pemangku a) LEFT JOIN m_unor b ON (a.id_unor=b.id_unor)
		WHERE  (
		a.nip_baru LIKE '$cari%'
		OR a.nama_pegawai LIKE '%$cari%'
		)
		AND a.id_rancangan='$idd' AND a.status='1' ORDER BY b.kode_unor ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_sisa($cari,$tanggal,$idr,$ese="",$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
		$sqlstr="
				SELECT COUNT(a.id_pegawai) AS numrows FROM r_pegawai_aktual a
						WHERE  (
						a.nama_pegawai LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				AND a.status_kepegawaian='pns'
				AND (a.jab_type='js' OR a.tugas_tambahan='Kepala Sekolah')
				AND a.id_pegawai NOT IN (SELECT b.id_pegawai FROM p_mut_rancangan_pemangku b WHERE b.id_rancangan='$idr')
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_sisa($cari,$mulai,$batas,$tanggal,$idr,$ese="",$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
		$sqlstr="
				SELECT a.* FROM r_pegawai_aktual a
						WHERE  (
						a.nama_pegawai LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				AND a.status_kepegawaian='pns'
				AND (a.jab_type='js' OR a.tugas_tambahan='Kepala Sekolah')
				AND a.id_pegawai NOT IN (SELECT b.id_pegawai FROM p_mut_rancangan_pemangku b WHERE b.id_rancangan='$idr')
				ORDER BY a.kode_unor
						LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_kosong_unor($cari,$tanggal,$idr,$ese="",$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
		$sqlstr="
				SELECT COUNT(a.id_unor) AS numrows FROM m_unor a
						WHERE  (
						a.kode_unor LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				$iTanggal
				$iUnor
				AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')
				$iKode
				AND a.id_unor NOT IN 
				(SELECT b.id_unor FROM p_mut_rancangan_pemangku b WHERE b.id_rancangan='$idr' AND (b.kode_ese!='99' OR b.tugas_tambahan='Kepala Sekolah'))
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_kosong_unor($cari,$mulai,$batas,$tanggal,$idr,$ese="",$unorIn=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$iUnor = ($unorIn=="")?"":"AND a.id_unor IN ($unorIn)";
		$iKode = ($ese=="")?"":"AND kode_ese='$ese'";
		$sqlstr="
				SELECT a.* FROM m_unor a
						WHERE  (
						a.kode_unor LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				$iTanggal
				$iUnor
				AND (a.kode_ese!='99' OR a.tugas_tambahan='Kepala Sekolah')
				$iKode
				AND a.id_unor NOT IN 
				(SELECT b.id_unor FROM p_mut_rancangan_pemangku b WHERE b.id_rancangan='$idr' AND (b.kode_ese!='99' OR b.tugas_tambahan='Kepala Sekolah'))
				ORDER BY a.kode_unor
						LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_rangkap_unor($cari,$tanggal,$idr,$ese=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$sqlstr="
				SELECT a.id_unor
				FROM m_unor a
				LEFT JOIN (r_pegawai_aktual c) ON (a.id_unor=c.id_unor AND a.kode_ese=c.kode_ese AND c.tugas_tambahan=a.tugas_tambahan)
						WHERE  (
						a.kode_unor LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				$iTanggal
				AND (SELECT COUNT(c.id_pegawai) FROM p_mut_rancangan_pemangku c WHERE c.id_rancangan='$idr' AND c.id_unor=a.id_unor AND (c.jab_type='js' OR c.tugas_tambahan='Kepala Sekolah'))>1
				GROUP BY c.id_unor
		";
		$query = $this->db->query($sqlstr)->result(); 
		return count($query);
	}

	function get_rangkap_unor($cari,$mulai,$batas,$tanggal,$idr,$ese=""){
		$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
				$sqlstr="
				SELECT a.*
				FROM m_unor a
				LEFT JOIN (r_pegawai_aktual c) ON (a.id_unor=c.id_unor AND a.kode_ese=c.kode_ese AND c.tugas_tambahan=a.tugas_tambahan)
						WHERE  (
						a.kode_unor LIKE '$cari%'
						OR a.nama_unor LIKE '%$cari%'
						OR a.nama_ese='$cari'
						)
				$iTanggal
				AND (SELECT COUNT(c.id_pegawai) FROM p_mut_rancangan_pemangku c WHERE c.id_rancangan='$idr' AND c.id_unor=a.id_unor AND (c.jab_type='js' OR c.tugas_tambahan='Kepala Sekolah'))>1
				GROUP BY c.id_unor
				ORDER BY a.kode_unor
						LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

}
