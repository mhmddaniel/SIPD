<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cuti_edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('appbina/m_cuti');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function alih(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
		$this->session->set_userdata('idd',$_POST['idd']);

		$cuti = $this->m_cuti->ini_cuti($_POST['idd']);
		if($cuti->status=="draft" && $cuti->draft==null){	$this->m_cuti->draft_pemohon($_POST['idd']);	}

		redirect("module/appbina/cuti_edok");
	}
	function index(){
		$data['satu'] = "Pengajuan Cuti";
		$data['cari'] = $this->session->userdata('cari');
		$data['batas'] = $this->session->userdata('batas');
		$data['hal'] = $this->session->userdata('hal');
		$data['asal'] = $this->session->userdata('asal');
		$data['kode'] = $this->session->userdata('kode');
		$data['pns'] = $this->session->userdata('pns');
		$data['pkt'] = $this->session->userdata('pkt');
		$data['jbt'] = $this->session->userdata('jbt');
		$data['ese'] = $this->session->userdata('ese');
		$data['tugas'] = $this->session->userdata('tugas');
		$data['gender'] = $this->session->userdata('gender');
		$data['agama'] = $this->session->userdata('agama');
		$data['status'] = $this->session->userdata('status');
		$data['jenjang'] = $this->session->userdata('jenjang');
		$data['umur'] = $this->session->userdata('umur');
		$data['mkcpns'] = $this->session->userdata('mkcpns');
		$data['idd'] = $this->session->userdata('idd');

	
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$data['jenis'] = $this->dropdowns->kode_jenis_cuti();
			$dTujuan = $this->dropdowns->kode_jenis_tujuan();
			
			//$data['bulan'] = $this->dropdowns->bulan();
		$data['val'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$data['val']->kode_jenis_tujuan = @$dTujuan[$data['val']->kode_tujuan];
		$data['val']->pangkat_aju = @$dWpangkat[$data['val']->kode_golongan_aju]." / ".@$dWgolongan[$data['val']->kode_golongan_aju];
		if(!empty($data['val']->kode_tujuan)){
			$data['val']->kode_tujuan = @$dTujuan[$data['val']->kode_tujuan];}
		else {
			$data['val']->kode_tujuan ="";	
		}
		
		if($data['val']->kode_jenis_cuti==1){
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_sakit");
		} else if($data['val']->kode_jenis_cuti==2 || $data['val']->kode_jenis_cuti==3 || $data['val']->kode_jenis_cuti==4 ) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_besar");
		} else if($data['val']->kode_jenis_cuti==5) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_alasan_penting");
		} else if($data['val']->kode_jenis_cuti==6) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_bersalin");
		} else if($data['val']->kode_jenis_cuti==7) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_tahunan");
		} else if($data['val']->kode_jenis_cuti==8) {
			$data['kode_dokumen_cuti'] = Modules::run("appbina/cuti/kode_dokumen_cuti_diluar_tanggungan_negara");
		}
		$data['id_pegawai'] = $data['val']->id_pegawai;

		

		$this->load->view('cuti_edok/index',$data);
	}
	function ajukan_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('ibel_edok/ajukan_form',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ijin(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "ijin";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->ijin_pimpinan);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			} 
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/ijin',$data);
	}
	function ijin_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('cuti_edok/ijin_formedit',$data);
	}
	function ijin_edit_aksi(){
		$this->m_cuti->ijin_edit($_POST);
		echo "sukses";
	}
	function ijin_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			}else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/ijin_upload',$data);
	}
	
	function keterangan_dokter(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "keterangan_dokter";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->keterangan_dokter);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/keterangan_dokter',$data);
	}
	
	function keterangan_dokter_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->keterangan_dokter);
		$this->load->view('cuti_edok/keterangan_dokter_formedit',$data);
	}
	function keterangan_dokter_edit_aksi(){
		$this->m_cuti->keterangan_dokter_edit($_POST);
		echo "sukses";
	}
	function keterangan_dokter_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->keterangan_dokter);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			}else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/keterangan_dokter_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	function buku_nikah_suami(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "buku_nikah_suami";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->buku_nikah_suami);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/buku_nikah_suami',$data);
	}
	
	function buku_nikah_suami_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->buku_nikah_suami);
		$this->load->view('cuti_edok/buku_nikah_suami_formedit',$data);
	}
	function buku_nikah_suami_edit_aksi(){
		$this->m_cuti->buku_nikah_suami_edit($_POST);
		echo "sukses";
	}
	function buku_nikah_suami_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->buku_nikah_suami);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/buku_nikah_suami_upload',$data);
	}
	
////////////////////////////////////////////////////////////////////////////////////////	
	
	function buku_nikah_istri(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "buku_nikah_istri";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->buku_nikah_istri);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/buku_nikah_istri',$data);
	}
	
	function buku_nikah_istri_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->buku_nikah_istri);
		$this->load->view('cuti_edok/buku_nikah_istri_formedit',$data);
	}
	function buku_nikah_istri_edit_aksi(){
		$this->m_cuti->buku_nikah_istri_edit($_POST);
		echo "sukses";
	}
	function buku_nikah_istri_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->buku_nikah_istri);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/buku_nikah_istri_upload',$data);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////
	
	function keterangan_hamil(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "keterangan_hamil";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->keterangan_hamil);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/keterangan_hamil',$data);
	}
	
	function keterangan_hamil_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->keterangan_hamil);
		$this->load->view('cuti_edok/keterangan_hamil_formedit',$data);
	}
	function keterangan_hamil_edit_aksi(){
		$this->m_cuti->keterangan_hamil_edit($_POST);
		echo "sukses";
	}
	function keterangan_hamil_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->keterangan_hamil);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/keterangan_hamil_upload',$data);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////
	
		function kartu_keluarga(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "kartu_keluarga";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->kartu_keluarga);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/kartu_keluarga',$data);
	}
	
	function kartu_keluarga_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->kartu_keluarga);
		$this->load->view('cuti_edok/kartu_keluarga_formedit',$data);
	}
	function kartu_keluarga_edit_aksi(){
		$this->m_cuti->kartu_keluarga_edit($_POST);
		echo "sukses";
	}
	function kartu_keluarga_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->kartu_keluarga);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/kartu_keluarga_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////

	function bpih(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "bpih";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->bpih);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/bpih',$data);
	}
	
	function bpih_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->bpih);
		$this->load->view('cuti_edok/bpih_formedit',$data);
	}
	function bpih_edit_aksi(){
		$this->m_cuti->bpih_edit($_POST);
		echo "sukses";
	}
	function bpih_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->bpih);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/bpih_upload',$data);
	}
	
////////////////////////////////////////////////////////////////////////////////////////	
	
	function pbb(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "pbb";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->pbb);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/pbb',$data);
	}
	
	function pbb_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->pbb);
		$this->load->view('cuti_edok/pbb_formedit',$data);
	}
	function pbb_edit_aksi(){
		$this->m_cuti->pbb_edit($_POST);
		echo "sukses";
	}
	function pbb_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->pbb);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/pbb_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function lunas_pbb(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "lunas_pbb";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->lunas_pbb);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/lunas_pbb',$data);
	}
	
	function lunas_pbb_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->lunas_pbb);
		$this->load->view('cuti_edok/lunas_pbb_formedit',$data);
	}
	function lunas_pbb_edit_aksi(){
		$this->m_cuti->lunas_pbb_edit($_POST);
		echo "sukses";
	}
	function lunas_pbb_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->lunas_pbb);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/lunas_pbb_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		function ktp_suami(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "ktp_suami";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->ktp_suami);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/ktp_suami',$data);
	}
	
	function ktp_suami_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ktp_suami);
		$this->load->view('cuti_edok/ktp_suami_formedit',$data);
	}
	function ktp_suami_edit_aksi(){
		$this->m_cuti->ktp_suami_edit($_POST);
		echo "sukses";
	}
	function ktp_suami_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ktp_suami);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/ktp_suami_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function ktp_istri(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "ktp_istri";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->ktp_istri);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/ktp_istri',$data);
	}
	
	function ktp_istri_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ktp_istri);
		$this->load->view('cuti_edok/ktp_istri_formedit',$data);
	}
	function ktp_istri_edit_aksi(){
		$this->m_cuti->ktp_istri_edit($_POST);
		echo "sukses";
	}
	function ktp_istri_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->ktp_istri);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/ktp_istri_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function surat_nikah(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "surat_nikah";
		$data['cuti'] = $this->m_cuti->ini_cuti($data['idd']);
		$data['surat'] = json_decode($data['cuti']->surat_nikah);

		$data['isi'] = $this->m_cuti->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->cuti_file;
			} else if($data['raw']=="jpeg"){
				$data['thumb'] = "assets/media/cuti/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('cuti_edok/surat_nikah',$data);
	}
	
	function surat_nikah_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->surat_nikah);
		$this->load->view('cuti_edok/surat_nikah_formedit',$data);
	}
	function surat_nikah_edit_aksi(){
		$this->m_cuti->surat_nikah_edit($_POST);
		echo "sukses";
	}
	function surat_nikah_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_cuti->ini_cuti($data['idd']);
		$data['isi'] = json_decode($surat->surat_nikah);
		$data['row'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg" ){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->cuti_file;
			} else if($raw=="jpeg"){
				@$data['row'][$key]->thumb = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			} else if($data['raw']!="jpg" || $data['raw']!="jpeg"){
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('cuti_edok/surat_nikah_upload',$data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function sk_cpns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_cpns");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	function sk_pns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pns");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	function sk_pangkat(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pangkat");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	function konversi_nip(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/konversi_nip");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	function skp(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/skp");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	
	function karpeg(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/karpeg");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
	function pak(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/pak");
		$this->load->view('cuti_edok/sk_cpns',$data);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function saveupload(){
		if(strlen($_FILES['artikel_file']['name'])>0){
				$id_pegawai = $_POST['id_pegawai'];
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
						$config['source_image'] = 'assets/media/cuti/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
						$config['new_image'] = 'assets/media/cuti/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
						//$cek = createImageThumbnail(250,150,$config);
						$this->load->library('image_lib', $config);
						$cek = $this->image_lib->resize();
				}
////////////////////////////////
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $idd."_".$nmB.".".$ext;
				rename("assets/media/cuti/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/cuti/".$id_pegawai."/".$komponen."/".$nmF);
				if($ext=="jpg"){
						rename("assets/media/cuti/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/cuti/".$id_pegawai."/".$komponen."/thumb_".$nmF);
				}
				$this->m_cuti->rename_dokumen($result['idd'],$nmF);
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
			$path="assets/media/cuti/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/cuti/".$id_pegawai."/".$komponen."/";
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
			$ttpp = $dn['raw_name'];
			$idB = $this->m_cuti->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
			$data['raw'] = $ttpp;
			$data['status'] = "success";
			$data['idd'] = $idB;
//			$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			return $data;
		}
	}

	function hapus_dok(){
		$komponen = $_POST['komponen'];
		$id_pegawai = $_POST['id_pegawai'];
		$id_dokumen = $_POST['id_dokumen'];
		$dok = $this->m_cuti->ini_dokumen($id_dokumen);
		unlink("assets/media/cuti/".$id_pegawai."/".$komponen."/".$dok->cuti_file);
		unlink("assets/media/cuti/".$id_pegawai."/".$komponen."/thumb_".$dok->cuti_file);
		$hp = $this->m_cuti->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

//		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}
	function edit_keterangan_aksi(){
		$this->m_cuti->edit_keterangan_dokumen($_POST);
		echo json_encode($_POST);
	}
	function zoom(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_cuti->cek_dokumen($data['idd'],$_POST['komponen']);
		foreach($data['dokumen'] AS $key=>$val){
			$ffl = "assets/media/cuti/".$data['nip_baru']."/".$data['komponen']."/".$val->cuti_file;
			@$data['dokumen'][$key]->row = pathinfo($ffl, PATHINFO_EXTENSION);
		}
		$this->load->view('cuti_edok/zoom',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////
}
?>