<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ibel_edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_ibel');
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

		$ibel = $this->m_ibel->ini_ibel($_POST['idd']);
		if($ibel->status=="draft" && $ibel->draft==null){	$this->m_ibel->draft_pemohon($_POST['idd']);	}

		redirect("module/appbangrir/ibel_edok");
	}
	function index(){
		$data['satu'] = "Pengajuan Ijin Belajar";
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
		$data['val'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;

		$data['sek'] = $this->m_ibel->ini_sekolah($data['idd']);
		$data['kode_dokumen'] = Modules::run("appbangrir/ibel_daftar/kode_dokumen_ibel");

		$this->load->view('ibel_edok/index',$data);
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
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->ijin_pimpinan);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/ijin',$data);
	}
	function ijin_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('ibel_edok/ijin_formedit',$data);
	}
	function ijin_edit_aksi(){
		$this->m_ibel->ijin_edit($_POST);
		echo "sukses";
	}
	function ijin_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/ijin_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function pengantar(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "pengantar";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->pengantar);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/pengantar',$data);
	}
	function pengantar_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->pengantar);
		$this->load->view('ibel_edok/pengantar_formedit',$data);
	}
	function pengantar_edit_aksi(){
		$this->m_ibel->pengantar_edit($_POST);
		echo "sukses";
	}
	function pengantar_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->pengantar);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/pengantar_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ket_mahasiswa(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "ket_mahasiswa";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->ket_mahasiswa);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/ket_mahasiswa',$data);
	}
	function ket_mahasiswa_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->ket_mahasiswa);
		$this->load->view('ibel_edok/ket_mahasiswa_formedit',$data);
	}
	function ket_mahasiswa_edit_aksi(){
		$this->m_ibel->ket_mahasiswa_edit($_POST);
		echo "sukses";
	}
	function ket_mahasiswa_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->ket_mahasiswa);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/ket_mahasiswa_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function proposal_ta(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "proposal_ta";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->proposal_ta);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/proposal_ta',$data);
	}
	function proposal_ta_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->proposal_ta);
		$this->load->view('ibel_edok/proposal_ta_formedit',$data);
	}
	function proposal_ta_edit_aksi(){
		$this->m_ibel->proposal_ta_edit($_POST);
		echo "sukses";
	}
	function proposal_ta_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->proposal_ta);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/proposal_ta_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function no_jabatan(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "no_jabatan";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->no_jabatan);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/no_jabatan',$data);
	}
	function no_jabatan_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->no_jabatan);
		$this->load->view('ibel_edok/no_jabatan_formedit',$data);
	}
	function no_jabatan_edit_aksi(){
		$this->m_ibel->no_jabatan_edit($_POST);
		echo "sukses";
	}
	function no_jabatan_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->no_jabatan);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/no_jabatan_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function akreditasi(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "akreditasi";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->akreditasi);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/akreditasi',$data);
	}
	function akreditasi_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->akreditasi);
		$this->load->view('ibel_edok/akreditasi_formedit',$data);
	}
	function akreditasi_edit_aksi(){
		$this->m_ibel->akreditasi_edit($_POST);
		echo "sukses";
	}
	function akreditasi_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->akreditasi);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];

		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('ibel_edok/akreditasi_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function jadwal(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "jadwal";
		$data['ibel'] = $this->m_ibel->ini_ibel($data['idd']);
		$data['surat'] = json_decode($data['ibel']->jadwal);

		$data['isi'] = $this->m_ibel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->ibel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/ibel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->ibel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('ibel_edok/jadwal',$data);
	}
	function jadwal_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->jadwal);
		$this->load->view('ibel_edok/jadwal_formedit',$data);
	}
	function jadwal_edit_aksi(){
		$this->m_ibel->jadwal_edit($_POST);
		echo "sukses";
	}
	function jadwal_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_ibel->ini_ibel($data['idd']);
		$data['isi'] = json_decode($surat->jadwal);
		$data['row'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->ibel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}
		$this->load->view('ibel_edok/jadwal_upload',$data);
	}
	function sk_cpns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_cpns");
		$this->load->view('ibel_edok/sk_cpns',$data);
	}
	function sk_pangkat(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pangkat");
		$this->load->view('ibel_edok/sk_cpns',$data);
	}
	function ijazah_pendidikan(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/ijazah_pendidikan");
		$this->load->view('ibel_edok/ijazah_pendidikan',$data);
	}
	function skp(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/skp");
		$this->load->view('ibel_edok/sk_cpns',$data);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
						$config['source_image'] = 'assets/media/ibel/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
						$config['new_image'] = 'assets/media/ibel/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
						//$cek = createImageThumbnail(250,150,$config);
						$this->load->library('image_lib', $config);
						$cek = $this->image_lib->resize();
				}
////////////////////////////////
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $idd."_".$nmB.".".$ext;
				rename("assets/media/ibel/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/ibel/".$id_pegawai."/".$komponen."/".$nmF);
				if($ext=="jpg"){
						rename("assets/media/ibel/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/ibel/".$id_pegawai."/".$komponen."/thumb_".$nmF);
				}
				$this->m_ibel->rename_dokumen($result['idd'],$nmF);
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
			$path="assets/media/ibel/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/ibel/".$id_pegawai."/".$komponen."/";
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
			$idB = $this->m_ibel->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
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
		$dok = $this->m_ibel->ini_dokumen($id_dokumen);
		unlink("assets/media/ibel/".$id_pegawai."/".$komponen."/".$dok->ibel_file);
		unlink("assets/media/ibel/".$id_pegawai."/".$komponen."/thumb_".$dok->ibel_file);
		$hp = $this->m_ibel->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

//		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}
	function edit_keterangan_aksi(){
		$this->m_ibel->edit_keterangan_dokumen($_POST);
		echo json_encode($_POST);
	}
	function zoom(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_ibel->cek_dokumen($data['idd'],$_POST['komponen']);
		foreach($data['dokumen'] AS $key=>$val){
			$ffl = "assets/media/ibel/".$data['nip_baru']."/".$data['komponen']."/".$val->ibel_file;
			@$data['dokumen'][$key]->row = pathinfo($ffl, PATHINFO_EXTENSION);
		}
		$this->load->view('ibel_edok/zoom',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////
}
?>