<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Masuk_daftar_edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appmutasi/m_masuk');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function pasfoto(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "pasfoto";

		$data['masuk'] = $this->m_masuk->ini_pemohon($data['idd']);
		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/pasfoto',$data);
	}

	function pasfoto_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
//		$surat = $this->m_kpo->ini_kpo($data['idd']);
//		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/pasfoto_upload',$data);
	}
///////////////////////////////////////////////////////////////////////////////////
	function permohonan(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "permohonan";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->permohonan);
		@$data['surat']->tanggal = $surat->tanggal_surat;
		@$data['surat']->tanggal_diterima = $surat->tanggal_diterima;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/permohonan',$data);
	}
	function permohonan_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/permohonan_upload',$data);
	}
	function permohonan_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->permohonan);
		@$data['surat']->tanggal = $surat->tanggal_surat;
		@$data['surat']->tanggal_diterima = $surat->tanggal_diterima;

		$this->load->view('masuk_daftar_edok/permohonan_formedit',$data);
	}
	function permohonan_edit_aksi(){
		$this->m_masuk->permohonan_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function pengantar(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "pengantar";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->pengantar);
		@$data['surat']->nama_pimpinan = $surat->nama_pimpinan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/pengantar',$data);
	}
	function pengantar_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/pengantar_upload',$data);
	}
	function pengantar_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->pengantar);
		@$data['surat']->nama_pimpinan = $surat->nama_pimpinan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$this->load->view('masuk_daftar_edok/pengantar_formedit',$data);
	}
	function pengantar_edit_aksi(){
		$this->m_masuk->pengantar_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function ijazah(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "ijazah";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->ijazah);
		@$data['surat']->nama_jenjang = $surat->nama_jenjang;
		@$data['surat']->nama_pendidikan = $surat->nama_pendidikan;
		@$data['surat']->nomor_ijazah = $surat->nomor_ijazah;
		@$data['surat']->tanggal_lulus = $surat->tanggal_lulus;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/ijazah',$data);
	}
	function ijazah_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/ijazah_upload',$data);
	}
	function ijazah_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->ijazah);
		@$data['row']->gelar_depan = $surat->gelar_depan;
		@$data['row']->gelar_belakang = $surat->gelar_belakang;
		@$data['row']->kode_jenjang = $surat->kode_jenjang;
		@$data['row']->nama_jenjang_rumpun = $surat->nama_jenjang_rumpun;
		@$data['row']->nama_jenjang = $surat->nama_jenjang;
		@$data['row']->id_pendidikan = $surat->id_pendidikan;
		@$data['row']->nama_pendidikan = $surat->nama_pendidikan;
		@$data['row']->nama_sekolah = $surat->nama_sekolah;
		@$data['row']->lokasi_sekolah = $surat->lokasi_sekolah;
		@$data['row']->nomor_ijazah = $surat->nomor_ijazah;
		@$data['row']->tanggal_lulus = $surat->tanggal_lulus;

		$this->load->view('masuk_daftar_edok/ijazah_formedit',$data);
	}
	function ijazah_edit_aksi(){
		$this->m_masuk->ijazah_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function sk_cpns(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "sk_cpns";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->sk_cpns);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/sk_cpns',$data);
	}
	function sk_cpns_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/sk_cpns_upload',$data);
	}
	function sk_cpns_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->sk_cpns);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tmt = $surat->tmt;
		@$data['surat']->tanggal = $surat->tanggal;

		$this->load->view('masuk_daftar_edok/sk_cpns_formedit',$data);
	}
	function sk_cpns_edit_aksi(){
		$this->m_masuk->sk_cpns_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function sk_pns(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "sk_pns";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->sk_pns);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/sk_pns',$data);
	}
	function sk_pns_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/sk_pns_upload',$data);
	}
	function sk_pns_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->sk_pns);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tmt = $surat->tmt;
		@$data['surat']->tanggal = $surat->tanggal;

		$this->load->view('masuk_daftar_edok/sk_pns_formedit',$data);
	}
	function sk_pns_edit_aksi(){
		$this->m_masuk->sk_pns_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function sk_pangkat(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "sk_pangkat";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->sk_pangkat);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/sk_pangkat',$data);
	}
	function sk_pangkat_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/sk_pangkat_upload',$data);
	}
	function sk_pangkat_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->sk_pangkat);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->pangkat = $surat->pangkat;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tmt = $surat->tmt;
		@$data['surat']->tanggal = $surat->tanggal;

		$this->load->view('masuk_daftar_edok/sk_pangkat_formedit',$data);
	}
	function sk_pangkat_edit_aksi(){
		$this->m_masuk->sk_pangkat_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function sk_jabatan(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "sk_jabatan";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->sk_jabatan);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tanggal = $surat->tanggal;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/sk_jabatan',$data);
	}
	function sk_jabatan_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/sk_jabatan_upload',$data);
	}
	function sk_jabatan_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->sk_jabatan);
		@$data['surat']->penandatangan = $surat->penandatangan;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->nama_jabatan = $surat->nama_jabatan;
		@$data['surat']->nomor = $surat->nomor;
		@$data['surat']->tmt = $surat->tmt;
		@$data['surat']->tanggal = $surat->tanggal;

		$this->load->view('masuk_daftar_edok/sk_jabatan_formedit',$data);
	}
	function sk_jabatan_edit_aksi(){
		$this->m_masuk->sk_jabatan_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
	function skp(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = "skp";

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		$surat = json_decode($masuk->skp);
		@$data['surat']->penilai = $surat->penilai;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->tahun = $surat->tahun;
		@$data['surat']->nilai = $surat->nilai;

		$data['isi'] = $this->m_masuk->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$data['isi'][0]->masuk_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$data['isi'][0]->masuk_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}
		$this->load->view('masuk_daftar_edok/skp',$data);
	}
	function skp_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];

		$data['row'] = $this->m_masuk->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $data['idd'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/".$val->masuk_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/masuk/".$data['idd']."/".$data['komponen']."/thumb_".$val->masuk_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('masuk_daftar_edok/skp_upload',$data);
	}
	function skp_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel

		$masuk = $this->m_masuk->ini_pemohon($data['idd']);
		@$surat = json_decode($masuk->skp);
		@$data['surat']->penilai = $surat->penilai;
		@$data['surat']->jabatan = $surat->jabatan;
		@$data['surat']->tahun = $surat->tahun;
		@$data['surat']->nilai = $surat->nilai;

		$this->load->view('masuk_daftar_edok/skp_formedit',$data);
	}
	function skp_edit_aksi(){
		$this->m_masuk->skp_edit($_POST);
		echo "sukses";
	}
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function saveupload(){
		if(strlen($_FILES['artikel_file']['name'])>0){
				$id_pegawai = $this->session->userdata('idd');
				$komponen = $_POST['komponen'];
				$idd = $this->session->userdata('idd');

			    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
				$ext = pathinfo($_FILES['artikel_file']['name'], PATHINFO_EXTENSION);
				$base = basename($_FILES['artikel_file']['name'], ".".$ext);
				$nama_file = str_replace($d,"_",$base);
				$result = $this->uploadFile($id_pegawai,$nama_file,$komponen,$idd);

				if($ext=="jpg"){
						$config['image_library'] = 'gd2';
						$config['width'] = 250;
						$config['height'] = 150;
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = TRUE;
						//$config['thumb_marker']='';
						$config['source_image'] = 'assets/media/masuk/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
						$config['new_image'] = 'assets/media/masuk/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
						//$cek = createImageThumbnail(250,150,$config);
						$this->load->library('image_lib', $config);
						$cek = $this->image_lib->resize();
				}
////////////////////////////////
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $idd."_".$nmB."_".$result['idd'].".".$ext;
				rename("assets/media/masuk/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/masuk/".$id_pegawai."/".$komponen."/".$nmF);
				if($ext=="jpg"){
						rename("assets/media/masuk/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/masuk/".$id_pegawai."/".$komponen."/thumb_".$nmF);
				}
				$this->m_masuk->rename_dokumen($result['idd'],$nmF);
////////////////////////////////
				if($result['status']=='error'){
					echo "error-<b>File gagal di upload</b> : <br />".$result['error'];
				}else{
					echo "success-".$result['idd'];
				}
		}else{
			echo "error-<b>Tidak ada file</b>";
		}
	}

	function uploadFile($id_pegawai,$nama_file,$komponen,$idd){
		$this->load->helper('file');
			$path="assets/media/masuk/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/masuk/".$id_pegawai."/".$komponen."/";
			if(!file_exists($path2)){	mkdir($path2,755);	}
		
		$config['upload_path'] = $path2;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg|pdf|doc|docx|xls|xlsx';
//		$config['max_size']	= '512';
		$config['remove_spaces']=true;
        $config['overwrite']=true;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('artikel_file'))		{
			$data= array('status' => 'error', 'error' => $this->upload->display_errors());
			return $data;
		}	else {
			$dn = $this->upload->data('artikel_file');
//			$ttpp = $dn['raw_name'];
			$ttpp = $nama_file;
			$idB = $this->m_masuk->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
			$data['raw'] = $ttpp;
			$data['status'] = "success";
			$data['idd'] = $idB;
//			$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			return $data;
		}
	}

	function hapus_dok(){
		$komponen = $_POST['komponen'];
		$id_pegawai = $this->session->userdata('idd');
		$id_dokumen = $_POST['id_dokumen'];
		$dok = $this->m_masuk->ini_dokumen($id_dokumen);
		unlink("assets/media/masuk/".$id_pegawai."/".$komponen."/".$dok->masuk_file);
		unlink("assets/media/masuk/".$id_pegawai."/".$komponen."/thumb_".$dok->masuk_file);
		$hp = $this->m_masuk->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

//		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}

}
?>