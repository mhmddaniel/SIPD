<?php
class M_tukin extends CI_Model{
	function __construct(){
		parent::__construct();
	}

/////////////////////////////////////////////////////////////////////
////////////////////=== identitas pegawai
	function get_pegawai_bulanan($id_pegawai,$tahun,$bulan){
		$sql="SELECT a.*,b.nama_pegawai,b.nip_baru FROM r_pegawai_bulanan a 
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) WHERE a.id_pegawai='$id_pegawai' AND a.tahun='$tahun' AND a.bulan='$bulan'";
		$res = $this->db->query($sql)->row();

		if(empty($res)){
			$this->db->from('r_pegawai_aktual');
			$this->db->where('id_pegawai',$id_pegawai);
			$res = $this->db->get()->row();
		}

		return $res;
	}
	function get_pegawai($id_pegawai){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$id_pegawai);
		$hslquery = $this->db->get()->row();
		
		if(empty($hslquery)){
			$sql="SELECT a.* FROM r_pegawai_bulanan a WHERE a.id_pegawai='$id_pegawai' ORDER BY tahun,bulan DESC LIMIT 0,1";
			$res = $this->db->query($sql)->row();

			$sql2="SELECT a.nama_pegawai,a.nip_baru FROM r_pegawai a WHERE a.id_pegawai='$id_pegawai'";
			$res2 = $this->db->query($sql2)->row();
			
			@$hslquery = $res;
			@$hslquery->nama_pegawai = @$res2->nama_pegawai;
			@$hslquery->nip_baru = @$res2->nip_baru;
		}
		return $hslquery;
	}

	function get_pegawai_by_nip($nip){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('nip_baru',$nip);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}

	function getunor($kode,$tanggal){
		$sqlstr="SELECT a.* 
		FROM (m_unor a)
		WHERE CHAR_LENGTH(a.kode_unor) = 5
		AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'
		AND a.kode_unor='$kode'";
		$res = $this->db->query($sqlstr)->row(); 
		return $res;
	}

	function get_m_unor($id_unor){
		$sqlstr="SELECT a.* FROM (m_unor a)	WHERE a.id_unor='$id_unor'";
		$res = $this->db->query($sqlstr)->row(); 
		return $res;
	}
/////////////////////////////////////////////////////////////////////
////////////////////=== Rencana Kerja
	function get_tpp($id_pegawai){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->order_by('tahun','asc');
		$this->db->order_by('bulan_mulai','asc');
		$hslquery = $this->db->get()->result();

		return $hslquery;
	}
	function get_tpp_tahun($id_pegawai,$th){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('tahun',$th);
		$this->db->order_by('bulan_mulai','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	
	function get_tpp_last($id_pegawai,$stt=""){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_pegawai',$id_pegawai);
		if($stt!=""){
		$this->db->where('status',$stt);
		}
		$this->db->order_by('tahun','desc');
		$this->db->order_by('bulan_mulai','desc');
		$this->db->limit(1);		
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}
	
	function ini_tpp($id_tpp){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_tpp',$id_tpp);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}
	
	function set_tpp($isi,$pegawai,$penilai){
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('bulan_mulai',$isi['bulan_mulai']);
		$this->db->set('bulan_selesai',$isi['bulan_selesai']);
		$this->db->set('id_pegawai',$pegawai->id_pegawai);
		$this->db->set('nip_baru',$pegawai->nip_baru);
		$this->db->set('nama_pegawai',$pegawai->nama_pegawai);
		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
		$this->db->set('gelar_depan',$pegawai->gelar_depan);
		$this->db->set('nama_golongan',$pegawai->nama_golongan);
		$this->db->set('nama_pangkat',$pegawai->nama_pangkat);
		$this->db->set('id_unor',$pegawai->id_unor);
		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);
		$this->db->set('nomenklatur_pada',$pegawai->nomenklatur_pada);
		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);
		$this->db->set('nama_ese',$pegawai->nama_ese);
		$this->db->set('id_penilai',$penilai->id_pegawai);
		$this->db->set('penilai_nip_baru',$penilai->nip_baru);
		$this->db->set('penilai_nama_pegawai',$penilai->nama_pegawai);
		$this->db->set('penilai_gelar_nonakademis',$penilai->gelar_nonakademis);
		$this->db->set('penilai_gelar_depan',$penilai->gelar_depan);
		$this->db->set('penilai_gelar_belakang',$penilai->gelar_belakang);
		$this->db->set('penilai_gelar_depan',$penilai->gelar_depan);
		$this->db->set('penilai_nama_golongan',$penilai->nama_golongan);
		$this->db->set('penilai_nama_pangkat',$penilai->nama_pangkat);
		$this->db->set('penilai_id_unor',$penilai->id_unor);
		$this->db->set('penilai_nomenklatur_jabatan',$penilai->nomenklatur_jabatan);
		$this->db->set('penilai_nomenklatur_pada',$penilai->nomenklatur_pada);
		$this->db->set('penilai_tugas_tambahan',$penilai->tugas_tambahan);
		$this->db->set('penilai_nama_ese',$penilai->nama_ese);
		$this->db->set('status',"draft");
		
		if($isi['id_tpp']!=""){
			$this->db->where('id_tpp',$isi['id_tpp']);
			$rt = $this->db->update('tpp_rencana_kerja');

			$this->db->set('bulan',$isi['bulan_mulai']);
			$this->db->set('nama_golongan',$pegawai->nama_golongan);
			$this->db->set('nama_pangkat',$pegawai->nama_pangkat);
			$this->db->set('penilai_nama_golongan',$penilai->nama_golongan);
			$this->db->set('penilai_nama_pangkat',$penilai->nama_pangkat);
			$this->db->where('id_tpp',$isi['id_tpp']);
			$this->db->update('tpp_realisasi');
			return $rt;
		} else {
	        $this->db->set('buat',"NOW()",false);
			$this->db->insert('tpp_rencana_kerja');
			$id_tpp = $this->db->insert_id();

			$this->db->set('id_tpp',$id_tpp);
			$this->db->set('bulan',$isi['bulan_mulai']);
	        $this->db->set('status',"draft");
			$this->db->set('nama_golongan',$pegawai->nama_golongan);
			$this->db->set('nama_pangkat',$pegawai->nama_pangkat);
			$this->db->set('penilai_nama_golongan',$penilai->nama_golongan);
			$this->db->set('penilai_nama_pangkat',$penilai->nama_pangkat);
	        $this->db->set('buat',"NOW()",false);
			$this->db->insert('tpp_realisasi');
			return $id_tpp;
		}
	}
	function hapus_tpp($isi){
		$this->db->delete('tpp_rencana_kerja', array('id_tpp' => $isi['id_tpp']));
		$this->db->delete('tpp_realisasi', array('id_tpp' => $isi['id_tpp']));
	}
	
	function set_tpp_pegawai_pangkat($id_tpp,$nama_golongan,$nama_pangkat){
		$this->db->set('nama_golongan',$nama_golongan);
		$this->db->set('nama_pangkat',$nama_pangkat);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->update('tpp_rencana_kerja');
	}
	function set_tpp_penilai_pangkat($id_tpp,$nama_golongan,$nama_pangkat){
		$this->db->set('penilai_nama_golongan',$nama_golongan);
		$this->db->set('penilai_nama_pangkat',$nama_pangkat);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->update('tpp_rencana_kerja');
	}
	function set_realisasi_pegawai_pangkat($id_tpp,$bulan,$nama_golongan,$nama_pangkat){
		$this->db->set('nama_golongan',$nama_golongan);
		$this->db->set('nama_pangkat',$nama_pangkat);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->where('bulan',$bulan);
		$this->db->update('tpp_realisasi');
	}
	function set_realisasi_penilai_pangkat($id_tpp,$bulan,$nama_golongan,$nama_pangkat){
		$this->db->set('penilai_nama_golongan',$nama_golongan);
		$this->db->set('penilai_nama_pangkat',$nama_pangkat);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->where('bulan',$bulan);
		$this->db->update('tpp_realisasi');
	}
	function set_tpp_pegawai_jabatan($id_tpp,$id_unor,$nomenklatur_jabatan,$nomenklatur_pada,$nama_ese,$tugas_tambahan){
		$this->db->set('id_unor',$id_unor);
		$this->db->set('nomenklatur_jabatan',$nomenklatur_jabatan);
		$this->db->set('nomenklatur_pada',$nomenklatur_pada);
		$this->db->set('nama_ese',$nama_ese);
		$this->db->set('tugas_tambahan',$tugas_tambahan);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->update('tpp_rencana_kerja');
	}
	function set_tpp_penilai_jabatan($id_tpp,$id_unor,$nomenklatur_jabatan,$nomenklatur_pada,$nama_ese,$tugas_tambahan){
		$this->db->set('penilai_id_unor',$id_unor);
		$this->db->set('penilai_nomenklatur_jabatan',$nomenklatur_jabatan);
		$this->db->set('penilai_nomenklatur_pada',$nomenklatur_pada);
		$this->db->set('penilai_nama_ese',$nama_ese);
		$this->db->set('penilai_tugas_tambahan',$tugas_tambahan);
		$this->db->where('id_tpp',$id_tpp);
		$this->db->update('tpp_rencana_kerja');
	}

/////////////////////////////////////////////////////////////////////
//////////////////=== target rencana kerja
	function get_target($id_tpp){
		$this->db->from('tpp_rencana_kerja_target');
		$this->db->where('id_tpp',$id_tpp);
		$this->db->order_by('id_target','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	
	function get_target_tahun($id_tpp){
		$sqlstr="SELECT a.*,b.bulan_mulai,b.bulan_selesai
		FROM tpp_rencana_kerja_target a
		LEFT JOIN tpp_rencana_kerja b ON (a.id_tpp=b.id_tpp)
		WHERE a.id_tpp IN ($id_tpp)
		ORDER BY a.id_tpp DESC,a.id_target DESC";
		$hslquery = $this->db->query($sqlstr)->result(); 
		return $hslquery;
	}

	function ini_target($id_target){
		$this->db->from('tpp_rencana_kerja_target');
		$this->db->where('id_target',$id_target);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}

	function tambah_aksi($isi){
		$this->db->set('id_tpp',$isi['id_tpp']);
		$this->db->set('pekerjaan',$isi['pekerjaan']);
		$this->db->set('satuan',$isi['satuan']);

		$ak_total = $isi['ak_1']+$isi['ak_2']+$isi['ak_3']+$isi['ak_4']+$isi['ak_5']+$isi['ak_6']+$isi['ak_7']+$isi['ak_8']+$isi['ak_9']+$isi['ak_10']+$isi['ak_11']+$isi['ak_12'];
		$vol_total = $isi['vol_1']+$isi['vol_2']+$isi['vol_3']+$isi['vol_4']+$isi['vol_5']+$isi['vol_6']+$isi['vol_7']+$isi['vol_8']+$isi['vol_9']+$isi['vol_10']+$isi['vol_11']+$isi['vol_12'];
		$biaya_total = $isi['biaya_1']+$isi['biaya_2']+$isi['biaya_3']+$isi['biaya_4']+$isi['biaya_5']+$isi['biaya_6']+$isi['biaya_7']+$isi['biaya_8']+$isi['biaya_9']+$isi['biaya_10']+$isi['biaya_11']+$isi['biaya_12'];
	
		$this->db->set('ak_1',$isi['ak_1']);
		$this->db->set('ak_2',$isi['ak_2']);
		$this->db->set('ak_3',$isi['ak_3']);
		$this->db->set('ak_4',$isi['ak_4']);
		$this->db->set('ak_5',$isi['ak_5']);
		$this->db->set('ak_6',$isi['ak_6']);
		$this->db->set('ak_7',$isi['ak_7']);
		$this->db->set('ak_8',$isi['ak_8']);
		$this->db->set('ak_9',$isi['ak_9']);
		$this->db->set('ak_10',$isi['ak_10']);
		$this->db->set('ak_11',$isi['ak_11']);
		$this->db->set('ak_12',$isi['ak_12']);
		$this->db->set('ak_total',$ak_total);

		$this->db->set('vol_1',$isi['vol_1']);
		$this->db->set('vol_2',$isi['vol_2']);
		$this->db->set('vol_3',$isi['vol_3']);
		$this->db->set('vol_4',$isi['vol_4']);
		$this->db->set('vol_5',$isi['vol_5']);
		$this->db->set('vol_6',$isi['vol_6']);
		$this->db->set('vol_7',$isi['vol_7']);
		$this->db->set('vol_8',$isi['vol_8']);
		$this->db->set('vol_9',$isi['vol_9']);
		$this->db->set('vol_10',$isi['vol_10']);
		$this->db->set('vol_11',$isi['vol_11']);
		$this->db->set('vol_12',$isi['vol_12']);
		$this->db->set('vol_total',$vol_total);

		$this->db->set('biaya_1',$isi['biaya_1']);
		$this->db->set('biaya_2',$isi['biaya_2']);
		$this->db->set('biaya_3',$isi['biaya_3']);
		$this->db->set('biaya_4',$isi['biaya_4']);
		$this->db->set('biaya_5',$isi['biaya_5']);
		$this->db->set('biaya_6',$isi['biaya_6']);
		$this->db->set('biaya_7',$isi['biaya_7']);
		$this->db->set('biaya_8',$isi['biaya_8']);
		$this->db->set('biaya_9',$isi['biaya_9']);
		$this->db->set('biaya_10',$isi['biaya_10']);
		$this->db->set('biaya_11',$isi['biaya_11']);
		$this->db->set('biaya_12',$isi['biaya_12']);
		$this->db->set('biaya_total',$biaya_total);

		$this->db->set('kualitas_1',$isi['kualitas_1']);
		$this->db->set('kualitas_2',$isi['kualitas_2']);
		$this->db->set('kualitas_3',$isi['kualitas_3']);
		$this->db->set('kualitas_4',$isi['kualitas_4']);
		$this->db->set('kualitas_5',$isi['kualitas_5']);
		$this->db->set('kualitas_6',$isi['kualitas_6']);
		$this->db->set('kualitas_7',$isi['kualitas_7']);
		$this->db->set('kualitas_8',$isi['kualitas_8']);
		$this->db->set('kualitas_9',$isi['kualitas_9']);
		$this->db->set('kualitas_10',$isi['kualitas_10']);
		$this->db->set('kualitas_11',$isi['kualitas_11']);
		$this->db->set('kualitas_12',$isi['kualitas_12']);

        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_rencana_kerja_target');
		$id_target = $this->db->insert_id();
		if($isi['nomor']==1){
	        $this->db->set('draft',"NOW()",false);
			$this->db->where('id_tpp',$isi['id_tpp']);
			$this->db->update('tpp_rencana_kerja');
		}
		return $id_target;
	}
	
	function edit_aksi($isi){
		$this->db->set('pekerjaan',$isi['pekerjaan']);
		$this->db->set('satuan',$isi['satuan']);

		$ak_total = $isi['ak_1']+$isi['ak_2']+$isi['ak_3']+$isi['ak_4']+$isi['ak_5']+$isi['ak_6']+$isi['ak_7']+$isi['ak_8']+$isi['ak_9']+$isi['ak_10']+$isi['ak_11']+$isi['ak_12'];
		$vol_total = $isi['vol_1']+$isi['vol_2']+$isi['vol_3']+$isi['vol_4']+$isi['vol_5']+$isi['vol_6']+$isi['vol_7']+$isi['vol_8']+$isi['vol_9']+$isi['vol_10']+$isi['vol_11']+$isi['vol_12'];
		$biaya_total = $isi['biaya_1']+$isi['biaya_2']+$isi['biaya_3']+$isi['biaya_4']+$isi['biaya_5']+$isi['biaya_6']+$isi['biaya_7']+$isi['biaya_8']+$isi['biaya_9']+$isi['biaya_10']+$isi['biaya_11']+$isi['biaya_12'];
	
		$this->db->set('ak_1',$isi['ak_1']);
		$this->db->set('ak_2',$isi['ak_2']);
		$this->db->set('ak_3',$isi['ak_3']);
		$this->db->set('ak_4',$isi['ak_4']);
		$this->db->set('ak_5',$isi['ak_5']);
		$this->db->set('ak_6',$isi['ak_6']);
		$this->db->set('ak_7',$isi['ak_7']);
		$this->db->set('ak_8',$isi['ak_8']);
		$this->db->set('ak_9',$isi['ak_9']);
		$this->db->set('ak_10',$isi['ak_10']);
		$this->db->set('ak_11',$isi['ak_11']);
		$this->db->set('ak_12',$isi['ak_12']);
		$this->db->set('ak_total',$ak_total);

		$this->db->set('vol_1',$isi['vol_1']);
		$this->db->set('vol_2',$isi['vol_2']);
		$this->db->set('vol_3',$isi['vol_3']);
		$this->db->set('vol_4',$isi['vol_4']);
		$this->db->set('vol_5',$isi['vol_5']);
		$this->db->set('vol_6',$isi['vol_6']);
		$this->db->set('vol_7',$isi['vol_7']);
		$this->db->set('vol_8',$isi['vol_8']);
		$this->db->set('vol_9',$isi['vol_9']);
		$this->db->set('vol_10',$isi['vol_10']);
		$this->db->set('vol_11',$isi['vol_11']);
		$this->db->set('vol_12',$isi['vol_12']);
		$this->db->set('vol_total',$vol_total);

		$this->db->set('biaya_1',$isi['biaya_1']);
		$this->db->set('biaya_2',$isi['biaya_2']);
		$this->db->set('biaya_3',$isi['biaya_3']);
		$this->db->set('biaya_4',$isi['biaya_4']);
		$this->db->set('biaya_5',$isi['biaya_5']);
		$this->db->set('biaya_6',$isi['biaya_6']);
		$this->db->set('biaya_7',$isi['biaya_7']);
		$this->db->set('biaya_8',$isi['biaya_8']);
		$this->db->set('biaya_9',$isi['biaya_9']);
		$this->db->set('biaya_10',$isi['biaya_10']);
		$this->db->set('biaya_11',$isi['biaya_11']);
		$this->db->set('biaya_12',$isi['biaya_12']);
		$this->db->set('biaya_total',$biaya_total);

		$this->db->set('kualitas_1',$isi['kualitas_1']);
		$this->db->set('kualitas_2',$isi['kualitas_2']);
		$this->db->set('kualitas_3',$isi['kualitas_3']);
		$this->db->set('kualitas_4',$isi['kualitas_4']);
		$this->db->set('kualitas_5',$isi['kualitas_5']);
		$this->db->set('kualitas_6',$isi['kualitas_6']);
		$this->db->set('kualitas_7',$isi['kualitas_7']);
		$this->db->set('kualitas_8',$isi['kualitas_8']);
		$this->db->set('kualitas_9',$isi['kualitas_9']);
		$this->db->set('kualitas_10',$isi['kualitas_10']);
		$this->db->set('kualitas_11',$isi['kualitas_11']);
		$this->db->set('kualitas_12',$isi['kualitas_12']);

		$this->db->where('id_target',$isi['id_target']);
		$this->db->update('tpp_rencana_kerja_target');
	}

	function hapus_aksi($isi){
		$this->db->delete('tpp_rencana_kerja_target', array('id_target' => $isi['id_target']));
		$this->db->delete('tpp_realisasi_target', array('id_target' => $isi['id_target']));
	}
	
	function get_realisasi_target($id_target){
		$this->db->from('tpp_realisasi_target');
		$this->db->where('id_target',$id_target);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}

	function get_catatan($idd){
		$this->db->from('tpp_rencana_kerja_catatan');
		$this->db->where('id_tpp',$idd);
		$this->db->order_by('id_catatan');
		$this->db->order_by('last_updated');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_catatan($idd){
		$this->db->from('tpp_rencana_kerja_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_catatan($idd,$isi){
		$this->db->set('id_tpp',$idd);
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status','ditanya');
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_rencana_kerja_catatan');
	}
	function edit_catatan($isi){
		$this->db->set('catatan',$isi['catatan']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('tpp_rencana_kerja_catatan');
	}
	function hapus_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('tpp_rencana_kerja_catatan');
	}
	function get_jawaban($idd){
		$this->db->from('tpp_rencana_kerja_jawaban');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_jawaban($idd){
		$this->db->from('tpp_rencana_kerja_jawaban');
		$this->db->where('id_jawaban',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_jawaban($isi){
		$this->db->set('id_catatan',$isi['id_catatan']);
		$this->db->set('jawaban',$isi['jawaban']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_rencana_kerja_jawaban');

		$this->db->set('status','dijawab');
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('tpp_rencana_kerja_catatan');
	}
	function edit_jawaban($isi){
		$this->db->set('jawaban',$isi['jawaban']);
		$this->db->where('id_jawaban',$isi['id_jawaban']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->update('tpp_rencana_kerja_jawaban');
	}

/////////////////////////////////////////////////////////////////////////
///////////////////== Tahapan Rencana Kerja
	function get_realisasi_catatan($idd,$bln){
		$this->db->from('tpp_realisasi_catatan');
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->order_by('id_catatan');
		$this->db->order_by('last_updated');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_realisasi_catatan($idd){
		$this->db->from('tpp_realisasi_catatan');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_realisasi_catatan($idd,$bln,$isi){
		$this->db->set('id_tpp',$idd);
		$this->db->set('bulan',$bln);
		$this->db->set('catatan',$isi['catatan']);
		$this->db->set('status','ditanya');
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_realisasi_catatan');
	}
	function edit_realisasi_catatan($isi){
		$this->db->set('catatan',$isi['catatan']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('tpp_realisasi_catatan');
	}
	function hapus_realisasi_catatan($isi){
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->delete('tpp_realisasi_catatan');
	}
	function get_realisasi_jawaban($idd){
		$this->db->from('tpp_realisasi_jawaban');
		$this->db->where('id_catatan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_realisasi_jawaban($idd){
		$this->db->from('tpp_realisasi_jawaban');
		$this->db->where('id_jawaban',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_realisasi_jawaban($isi){
		$this->db->set('id_catatan',$isi['id_catatan']);
		$this->db->set('jawaban',$isi['jawaban']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_realisasi_jawaban');

		$this->db->set('status','dijawab');
		$this->db->where('id_catatan',$isi['id_catatan']);
		$this->db->update('tpp_realisasi_catatan');
	}
	function edit_realisasi_jawaban($isi){
		$this->db->set('jawaban',$isi['jawaban']);
		$this->db->where('id_jawaban',$isi['id_jawaban']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->update('tpp_realisasi_jawaban');
	}
/////////////////////////////////////////////////////////////////////////
///////////////////== Tahapan Rencana Kerja
	function aju_penilai($isi){
		$this->db->set('status',"aju_penilai");
        $this->db->set('aju_penilai',"NOW()",false);
		$this->db->where('id_tpp',$isi['id_tpp']);
		return $this->db->update('tpp_rencana_kerja');
	}
	function koreksi_penilai($idd){
		$this->db->set('status',"koreksi_penilai");
        $this->db->set('koreksi_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->update('tpp_rencana_kerja');
	}
	function revisi_penilai($idd){
		$this->db->set('status','revisi_penilai');
        $this->db->set('revisi_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->update('tpp_rencana_kerja');
	}
	
	function acc_penilai($idd,$isi){
		$this->db->set('status','acc_penilai');
        $this->db->set('acc_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->update('tpp_rencana_kerja');

		$this->db->set('id_tpp',$idd);
		$this->db->set('kegiatan',$isi['kegiatan']);
		$this->db->set('biaya',$isi['biaya']);
        $this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_rencana_kerja_acc');
	}
/////////////////////////////////////////////////////////////////	
///////////////== Realisasi Kerja
	function get_realisasi($id_tpp,$bulan){
		$sql="SELECT a.*,b.tahun FROM tpp_realisasi a LEFT JOIN tpp_rencana_kerja b ON (a.id_tpp=b.id_tpp) WHERE a.id_tpp='$id_tpp' AND a.bulan='$bulan'";
		$hslquery = $this->db->query($sql)->row();

		return $hslquery;
	}
	function get_realisasi_last_bulan($id_tpp){
		$sql="SELECT a.bulan FROM tpp_realisasi a WHERE a.id_tpp='$id_tpp' ORDER BY a.bulan DESC LIMIT 0,1";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery;
	}

	function set_realisasi($id_tpp,$bulan){
		$tpp = $this->ini_tpp($id_tpp);
		$this->db->set('id_tpp',$id_tpp);
		$this->db->set('bulan',$bulan);
		$this->db->insert('tpp_realisasi');
	}

	function ini_realisasi($id_realisasi){
		$this->db->from('tpp_realisasi');
		$this->db->where('id_realisasi',$id_realisasi);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}
	function realisasi_draft($idd,$bln){
		$this->db->set('status',"draft");
        $this->db->set('draft',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
	}
	function realisasi_aju_penilai($idd,$bln){
		$this->db->set('status',"aju_penilai");
        $this->db->set('aju_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
	}
	function realisasi_koreksi_penilai($idd,$bln){
		$this->db->set('status',"koreksi_penilai");
        $this->db->set('koreksi_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
	}
	function realisasi_revisi_penilai($idd,$bln){
		$this->db->set('status','revisi_penilai');
        $this->db->set('revisi_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
	}
	function realisasi_acc_penilai($idd,$bln,$isi){
		$this->db->set('status',"acc_penilai");
        $this->db->set('acc_penilai',"NOW()",false);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi');
		
		if($bln!=12){
			$realisasi = $this->get_realisasi($idd,$bln);
			$bulan = $bln+1;
			$this->db->set('id_tpp',$idd);
			$this->db->set('bulan',$bulan);
	        $this->db->set('status',"draft");
			$this->db->set('nama_golongan',$realisasi->nama_golongan);
			$this->db->set('nama_pangkat',$realisasi->nama_pangkat);
			$this->db->set('penilai_nama_golongan',$realisasi->nama_golongan);
			$this->db->set('penilai_nama_pangkat',$realisasi->nama_pangkat);
	        $this->db->set('buat',"NOW()",false);
			$this->db->insert('tpp_realisasi');
		}		


		$this->db->set('id_tpp',$idd);
		$this->db->set('bulan',$bln);
		$this->db->set('biaya',$isi['biaya']);
		$this->db->set('nilai_tugaspokok',$isi['nilai_tugaspokok']);
		$this->db->set('nilai_tugastambahan',$isi['nilai_tugastambahan']);
		$this->db->set('nilai_kreatifitas',$isi['nilai_kreatifitas']);
		$this->db->set('nilai_perilaku',$isi['nilai_perilaku']);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('tpp_realisasi_acc');
	}
	function realisasi_acc_edit($idd,$bln,$tgp,$tgt,$kr,$pr){
		$this->db->set('nilai_tugaspokok',$tgp);
		$this->db->set('nilai_tugastambahan',$tgt);
		$this->db->set('nilai_kreatifitas',$kr);
		$this->db->set('nilai_perilaku',$pr);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_realisasi_acc');
	}
/////////////////////////////////////////////////////////////////////
//////////////////=== Realisasi Target
	function ini_realisasi_target($id_target){
		$this->db->from('tpp_realisasi_target');
		$this->db->where('id_target',$id_target);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_realisasi_target($ipp){
		$this->db->set('id_target',$ipp['idd']);
		$this->db->set($ipp['nama'],$ipp['nilai']);
		$this->db->insert('tpp_realisasi_target');
	}
	function edit_realisasi_target($ipp){
		$this->db->set($ipp['nama'],$ipp['nilai']);
		$this->db->where('id_target',$ipp['idd']);
		$this->db->update('tpp_realisasi_target');
	}
	function ini_nilai_realisasi($ipp){
		$sql="SELECT ".$ipp['nama']." AS isi FROM tpp_realisasi_target WHERE id_target=".$ipp['idd']."";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery->isi;
	}
/////////////////////////////////////////////////////////////////////
//////////////////=== Perilaku
	function ini_perilaku($idd,$bln){
		$this->db->from('tpp_perilaku');
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function input_perilaku($idd,$bln,$ipp){
		$this->db->set('id_tpp',$idd);
		$this->db->set('bulan',$bln);
		$this->db->set($ipp['nama'],$ipp['nilai']);
		$this->db->insert('tpp_perilaku');
	}
	function edit_perilaku($idd,$bln,$ipp){
		$this->db->set($ipp['nama'],$ipp['nilai']);
		$this->db->where('id_tpp',$idd);
		$this->db->where('bulan',$bln);
		$this->db->update('tpp_perilaku');
	}
	function ini_nilai_perilaku($idd,$bln,$ipp){
		$sql="SELECT ".$ipp['nama']." AS isi FROM tpp_perilaku WHERE id_tpp='$idd' AND bulan='$bln'";
		$hslquery = $this->db->query($sql)->row();
		return $hslquery->isi;
	}
//////////////////////////////////////////////////////////////////	
///////////////== Pengajuan Rencana Kerja
	function get_rencana_kerja_aju($id_pegawai){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_penilai',$id_pegawai);
		$this->db->having('status','aju_penilai');
		$this->db->or_having('status','koreksi_penilai');
		$this->db->order_by('id_tpp','asc');
		$hslquery = $this->db->get()->result();

		return $hslquery;
	}
	function get_rencana_kerja_arsip($id_pegawai){
		$this->db->from('tpp_rencana_kerja');
		$this->db->where('id_penilai',$id_pegawai);
		$this->db->having('status','acc_penilai');
		$this->db->order_by('id_tpp','asc');
		$hslquery = $this->db->get()->result();

		return $hslquery;
	}
//////////////////////////////////////////////////////////////////	
///////////////== Pengajuan Realisasi Kerja
	function get_realisasi_aju($id_pegawai){
		$sql="SELECT a.tahun,a.nama_pegawai,a.gelar_depan,a.gelar_belakang,gelar_nonakademis,a.nip_baru,a.nomenklatur_jabatan, b.*
		FROM tpp_rencana_kerja a LEFT JOIN tpp_realisasi b ON (a.id_tpp=b.id_tpp)
		WHERE a.id_penilai='$id_pegawai' AND b.status IN ('aju_penilai','koreksi_penilai')
		ORDER BY a.id_tpp ASC";
		$hslquery = $this->db->query($sql)->result();

		return $hslquery;
	}
	function get_realisasi_arsip($id_pegawai,$bll,$thh){
		$sql="SELECT a.tahun,a.nama_pegawai,a.gelar_depan,a.gelar_belakang,gelar_nonakademis,a.nip_baru,a.nomenklatur_jabatan, b.*
		FROM tpp_rencana_kerja a LEFT JOIN tpp_realisasi b ON (a.id_tpp=b.id_tpp)
		WHERE a.id_penilai='$id_pegawai' AND b.status='acc_penilai' AND b.bulan='$bll' AND a.tahun='$thh'
		ORDER BY a.id_tpp ASC";

		$hslquery = $this->db->query($sql)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////	
//////////// == Lembar Kerja Realisasi
	function get_tugas_tambahan($id_tpp,$bulan){
		$this->db->from('tpp_tugas_tambahan');
		$this->db->where_in('id_tpp',$id_tpp);
		$this->db->where('bulan <=',$bulan);
		$hslquery = $this->db->get()->result();

		return $hslquery;
	}
	function ini_tugas_tambahan($id_tambahan){
		$this->db->from('tpp_tugas_tambahan');
		$this->db->where('id_tugas_tambahan',$id_tambahan);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}
	function tugas_tambahan_tambah_aksi($isi){
		$this->db->set('id_tpp',$isi['id_tpp']);
		$this->db->set('bulan',$isi['bulan']);
		$this->db->set('pekerjaan',$isi['pekerjaan']);
		$this->db->set('no_sp',$isi['no_sp']);
		$this->db->set('tanggal_sp',$isi['tanggal_sp']);
		$this->db->set('penandatangan_sp',$isi['penandatangan_sp']);
		$this->db->insert('tpp_tugas_tambahan');
	}
	function tugas_tambahan_edit_aksi($isi){
		$this->db->set('pekerjaan',$isi['pekerjaan']);
		$this->db->set('no_sp',$isi['no_sp']);
		$this->db->set('tanggal_sp',$isi['tanggal_sp']);
		$this->db->set('penandatangan_sp',$isi['penandatangan_sp']);
		$this->db->where('id_tugas_tambahan',$isi['id_tugas_tambahan']);
		$this->db->update('tpp_tugas_tambahan');
	}
	function tugas_tambahan_hapus_aksi($isi){
		$this->db->where('id_tugas_tambahan',$isi['id_tugas_tambahan']);
		$this->db->delete('tpp_tugas_tambahan');
	}
	function get_kreatifitas($id_tpp,$bulan){
		$this->db->from('tpp_kreatifitas');
		$this->db->where_in('id_tpp',$id_tpp);
		$this->db->where('bulan <=',$bulan);
		$hslquery = $this->db->get()->result();

		return $hslquery;
	}
	function ini_kreatifitas($id_kreatifitas){
		$this->db->from('tpp_kreatifitas');
		$this->db->where('id_kreatifitas',$id_kreatifitas);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function kreatifitas_tambah_aksi($isi){
		$this->db->set('id_tpp',$isi['id_tpp']);
		$this->db->set('bulan',$isi['bulan']);
		$this->db->set('kreatifitas',$isi['kreatifitas']);
		$this->db->set('tingkat',$isi['tingkat']);
		$this->db->set('no_sk',$isi['no_sk']);
		$this->db->set('tanggal_sk',$isi['tanggal_sk']);
		$this->db->set('penandatangan_sk',$isi['penandatangan_sk']);
		$this->db->insert('tpp_kreatifitas');
	}
	function kreatifitas_edit_aksi($isi){
		$this->db->set('kreatifitas',$isi['kreatifitas']);
		$this->db->set('tingkat',$isi['tingkat']);
		$this->db->set('no_sk',$isi['no_sk']);
		$this->db->set('tanggal_sk',$isi['tanggal_sk']);
		$this->db->set('penandatangan_sk',$isi['penandatangan_sk']);
		$this->db->where('id_kreatifitas',$isi['id_kreatifitas']);
		$this->db->update('tpp_kreatifitas');
	}
	function kreatifitas_hapus_aksi($isi){
		$this->db->where('id_kreatifitas',$isi['id_kreatifitas']);
		$this->db->delete('tpp_kreatifitas');
	}
//////////////////////////////////////////////////////////////////	
//////////// == PERUBAHAN TARGET
	function get_perubahan($id_target,$bulan){
		$this->db->from('tpp_rubah');
		$this->db->where('id_target',$id_target);
		$this->db->where('bulan',$bulan);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}
	function rubah_aksi($isi){
		$this->db->from('tpp_rencana_kerja_target');
		$this->db->where('id_target',$isi['id_target']);
		$hslquery = $this->db->get()->row();
		$semula = json_encode($hslquery);

		$a_ak = "ak_".$isi['bulan'];
		$a_vol = "vol_".$isi['bulan'];
		$a_kualitas = "kualitas_".$isi['bulan'];
		$a_biaya = "biaya_".$isi['bulan'];

		$this->db->set($a_ak,$isi['rb_ak']);
		$this->db->set($a_vol,$isi['rb_vol']);
		$this->db->set($a_biaya,$isi['rb_biaya']);
		$this->db->set($a_kualitas,$isi['rb_kualitas']);
		$this->db->where('id_target',$isi['id_target']);
		$this->db->update('tpp_rencana_kerja_target');

		$this->db->set('id_tpp',$isi['id_tpp']);
		$this->db->set('id_target',$isi['id_target']);
		$this->db->set('bulan',$isi['bulan']);
		$this->db->set('alasan',$isi['alasan']);
		$this->db->set('ak',$isi['rb_ak']);
		$this->db->set('volume',$isi['rb_vol']);
		$this->db->set('kualitas',$isi['rb_kualitas']);
		$this->db->set('biaya',$isi['rb_biaya']);
		$this->db->set('semula',$semula);
		$this->db->insert('tpp_rubah');
	}
	function rubah_edit_aksi($isi){
		$a_ak = "ak_".$isi['bulan'];
		$a_vol = "vol_".$isi['bulan'];
		$a_kualitas = "kualitas_".$isi['bulan'];
		$a_biaya = "biaya_".$isi['bulan'];

		$this->db->set($a_ak,$isi['rb_ak']);
		$this->db->set($a_vol,$isi['rb_vol']);
		$this->db->set($a_biaya,$isi['rb_biaya']);
		$this->db->set($a_kualitas,$isi['rb_kualitas']);
		$this->db->where('id_target',$isi['id_target']);
		$this->db->update('tpp_rencana_kerja_target');

		$this->db->set('alasan',$isi['alasan']);
		$this->db->set('ak',$isi['rb_ak']);
		$this->db->set('volume',$isi['rb_vol']);
		$this->db->set('biaya',$isi['rb_biaya']);
		$this->db->set('kualitas',$isi['rb_kualitas']);
		$this->db->where('id_tpp',$isi['id_tpp']);
		$this->db->where('id_target',$isi['id_target']);
		$this->db->where('bulan',$isi['bulan']);
		$this->db->update('tpp_rubah');
	}
	function rubah_batal_aksi($isi){
		$this->db->from('tpp_rubah');
		$this->db->where('id_target',$isi['id_target']);
		$this->db->where('bulan',$isi['bulan']);
		$hslquery = $this->db->get()->row();

		$semula = json_decode($hslquery->semula);
		$a_ak = "ak_".$isi['bulan'];
		$a_vol = "vol_".$isi['bulan'];
		$a_kualitas = "kualitas_".$isi['bulan'];
		$a_biaya = "biaya_".$isi['bulan'];

		$this->db->set($a_ak,$semula->$a_ak);
		$this->db->set($a_vol,$semula->$a_vol);
		$this->db->set($a_biaya,$semula->$a_biaya);
		$this->db->set($a_kualitas,$semula->$a_kualitas);
		$this->db->where('id_target',$isi['id_target']);
		$this->db->update('tpp_rencana_kerja_target');
		
		$this->db->where('id_tpp',$isi['id_tpp']);
		$this->db->where('id_target',$isi['id_target']);
		$this->db->where('bulan',$isi['bulan']);
		$this->db->delete('tpp_rubah');
	}

}
