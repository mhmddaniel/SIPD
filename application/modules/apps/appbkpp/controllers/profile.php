<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Profile extends MX_Controller {



	function __construct(){

		parent::__construct();

		$this->auth->restrict();

		$this->load->model('appbkpp/m_unor');

		$this->load->model('appbkpp/m_pegawai');

		$this->load->model('appbkpp/m_profil');

		$this->load->model('appdok/m_edok');

	}

///////////////////////////////////////////////////////////////////////////////////

	function index(){

		$data['satu'] = "Data Pegawai";

		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$awalx = $this->session->userdata('awal');

		if($awalx!=""){

			$data['awal'] = $awalx;

			$data['stt'] = $this->session->userdata('stt');

			$data['kode'] = $this->session->userdata('kode');

		}

		$this->session->set_userdata('awal',"");

		$asalx = $this->session->userdata('asal');

		if($asalx!=""){

			$data['cari'] = $this->session->userdata('cari');

			$data['batas'] = $this->session->userdata('batas');

			$data['hal'] = $this->session->userdata('hal');

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

			$data['asal'] = $asalx;

		}

		$this->session->set_userdata('asal',"");

		$this->load->view('profile/index',$data);

	}



	function pns_ini(){

		$this->dansec->htmlReq();

		$this->session->set_userdata('pegawai_info',$_POST['idd']);

		$data['data'] = $this->m_profil->ini_pegawai_master($_POST['idd']);

		if(isset($_POST['awal'])){

			$data['awal'] = $_POST['awal'];

		}

		$this->session->set_userdata('boleh',$_POST['boleh']);

		$this->load->view('profile/pns_ini',$data);

	}





	function alih_v2(){

		$khi = str_replace('**','"',$_POST['var_x']);

		$kh = json_decode($khi);

		$this->session->set_userdata('umur',$kh->umur);

		$this->session->set_userdata('jenjang',$kh->jenjang);

		$this->session->set_userdata('status',$kh->status);

		$this->session->set_userdata('mkcpns',$kh->mkcpns);

		$this->session->set_userdata('asal',$_POST['asal']);



		if(isset($_POST['awal'])){	

			$this->session->set_userdata('awal',$_POST['awal']); 

			$this->session->set_userdata('stt',$_POST['stt']); 

		}

		if($_POST['asal']=="appbkpp/dafpeg" || $_POST['asal']=="appbkpp/pegawai/aktif" || $_POST['asal']=="appdok/pantau" || $_POST['asal']=="appbkpp/pantau" || $_POST['asal']=="appbkpp/pantau/cpns" || $_POST['asal']=="appbkpp/pantau/pns" || $_POST['asal']=="appbkpp/pantau/prajabatan" || $_POST['asal']=="appbkpp/pantau/biodata" || $_POST['asal']=="appbkpp/pantau/pangkat" || $_POST['asal']=="appbkpp/pantau/konversi"){	$this->session->set_userdata('boleh',"ya");	} else {	$this->session->set_userdata('boleh',"tidak");	}

		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);

		redirect(site_url("module/appbkpp/profile"));

	}



	function alih(){

		$this->session->set_userdata('umur',$_POST['umur']);

		$this->session->set_userdata('jenjang',$_POST['jenjang']);

		$this->session->set_userdata('status',$_POST['status']);

		$this->session->set_userdata('mkcpns',$_POST['mkcpns']);

		$this->session->set_userdata('asal',$_POST['asal']);

		if(isset($_POST['awal'])){	

			$this->session->set_userdata('awal',$_POST['awal']); 

			$this->session->set_userdata('stt',$_POST['stt']); 

		}

		if($_POST['asal']=="appbkpp/dafpeg" || $_POST['asal']=="appbkpp/pegawai/aktif" || $_POST['asal']=="appdok/pantau" || $_POST['asal']=="appbkpp/pantau" || $_POST['asal']=="appbkpp/pantau/cpns" || $_POST['asal']=="appbkpp/pantau/pns" || $_POST['asal']=="appbkpp/pantau/prajabatan" || $_POST['asal']=="appbkpp/pantau/biodata" || $_POST['asal']=="appbkpp/pantau/pangkat" || $_POST['asal']=="appbkpp/pantau/konversi"){	$this->session->set_userdata('boleh',"ya");	} else {	$this->session->set_userdata('boleh',"tidak");	}

		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);

		redirect(site_url("module/appbkpp/profile"));

	}



	function alihsub(){

		$data['konten'] = Modules::run("appbkpp/profile/konten",$_POST['idd'],1);

		$this->session->set_userdata('pegawai_info',$_POST['idd']);

		$this->session->set_userdata('boleh',"tidak");

		$this->load->view('profile/index',$data);

	}



	function konten($id_pegawai,$tutup=2){

		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['fotoSrc']= $this->pasfoto_ini($id_pegawai);

		$jtn = $this->m_profil->ini_pegawai_jabatan($id_pegawai);

		$jabatan = end($jtn);

		@$data['data']->tmt_jabatan=$jabatan->tmt_jabatan;

		$data['data']->id_pegawai=$id_pegawai;

		$data['cpns']=$this->m_profil->ini_cpns($id_pegawai);

		$data['pns']=$this->m_profil->ini_pns($id_pegawai);

		$pgt = $this->m_profil->ini_pegawai_pangkat($id_pegawai);

		$pangkat = end($pgt);

		@$data['data']->tmt_pangkat=$pangkat->tmt_golongan;

		@$data['data']->nama_pangkat=$pangkat->nama_pangkat;

		@$data['data']->nama_golongan=$pangkat->nama_golongan;

		if($tutup==1){	$data['tutup']=1;	}



		$boleh = $this->session->userdata('boleh');

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/konten',$data);

	}

	function pasfoto_nip($nip){

		$cek = $this->m_edok->cek_dokumen($nip,"pasfoto",0);

		if(empty($cek)){

					$foto = base_url()."assets/file/foto/photo.jpg";

		} else {

			$foto = base_url()."assets/media/file/".$nip."/pasfoto/thumb_".$cek[0]->file_dokumen;

		}

		return $foto;

	}

	function pasfoto_ini($idd){

		$mPeg = $this->m_profil->ini_pegawai_master($idd);

		$nip = $mPeg->nip_baru;



		$cek = $this->m_edok->cek_dokumen($nip,"pasfoto",0);

		if(empty($cek)){

					$foto = base_url()."assets/file/foto/photo.jpg";

		} else {

			$foto = base_url()."assets/media/file/".$nip."/pasfoto/".$cek[0]->file_dokumen;

		}

		return $foto;

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function ini_pegawai($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai($id_pegawai);

		return $result;

	}

	function ini_pegawai1($id_pegawai=false,$id_cuti=false){

		$result = $this->m_profil->ini_pegawai1($id_pegawai,$id_cuti);

		return $result;

	}

	function ini_pegawai_master($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_master($id_pegawai);

		return $result;

	}

	function ini_pegawai_r_pegawai_rekap($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_r_pegawai_rekap($id_pegawai);

		return $result;

	}

	function ini_pegawai_akhir_bulan($id_pegawai=false){

		$result = $this->m_profil->akhir_pegawai_bulanan($id_pegawai);

		return $result;

	}

	function ini_pegawai_alamat($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_alamat($id_pegawai);

		return $result;

	}

	function ini_pegawai_pernikahan($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_pernikahan($id_pegawai);

		return $result;

	}

	function ini_pegawai_anak($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_anak($id_pegawai);

		return $result;

	}

	function ini_pegawai_pendidikan($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_pendidikan($id_pegawai);

		return $result;

	}

	function ini_pegawai_prajabatan($id_pegawai=false){

		$result = $this->m_profil->get_sertifikat_prajab($id_pegawai);

		return $result;

	}

	function ini_pegawai_karpeg($id_pegawai=false){

		$result = $this->m_profil->get_karpeg($id_pegawai);

		return $result;

	}

	function ini_pegawai_taspen($id_pegawai=false){

		$result = $this->m_profil->get_taspen($id_pegawai);

		return $result;

	}

	function ini_pegawai_konversi_nip($id_pegawai=false){

		$result = $this->m_profil->get_konversi_nip($id_pegawai);

		return $result;

	}

	function ini_pegawai_cpns($id_pegawai=false){

		$result = $this->m_profil->ini_cpns($id_pegawai);

		return $result;

	}

	function ini_pegawai_pns($id_pegawai=false){

		$result = $this->m_profil->ini_pns($id_pegawai);

		return $result;

	}

	function ini_pegawai_pupns($id_pegawai=false){

		$result = $this->m_profil->get_pupns($id_pegawai);

		return $result;

	}

///////////// pertek /////////////////////////////////////////////////////////

	function ini_pegawai_pertek($id_pegawai=false){

		$result = $this->m_profil->get_pertek($id_pegawai);

		return $result;

	}

///////////// end-pertek /////////////////////////////////////////////////////////	

	function ini_pegawai_pangkat($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_pangkat($id_pegawai);

		return $result;

	}

	function ini_pangkat_riwayat($id_peg_gol){

		$result = $this->m_profil->ini_pangkat_riwayat($id_peg_gol);

		return $result;

	}

	function ini_pegawai_jabatan($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_jabatan($id_pegawai);

		return $result;

	}

	function ini_jabatan_riwayat($id_peg_jab){

		$result = $this->m_profil->ini_jabatan_riwayat($id_peg_jab);

		return $result;

	}

	function ini_pegawai_diklat_struk($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_diklat_struk($id_pegawai);

		return $result;

	}

	function ini_diklat_struk_riwayat($id_peg_diklat_struk){

		$result = $this->m_profil->ini_diklat_struk_riwayat($id_peg_diklat_struk);

		return $result;

	}

	function ini_pegawai_kursus($id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_kursus($id_pegawai);

		return $result;

	}

	function ini_sertifikat_kursus($id_peg_diklat_struk){

		$result = $this->m_profil->ini_sertifikat_kursus($id_peg_kursus);

		return $result;

	}

	function ini_skp($id_pegawai=false){

		$result = $this->m_profil->get_skp($id_pegawai);

		return $result;

	}

	function riwayat_skp($id_skp){

		$result = $this->m_profil->riwayat_skp($id_skp);

		return $result;

	}	

	function ini_sertifikat_penghargaan($id_pegawai=false){

		$result = $this->m_profil->get_sertifikat_penghargaan($id_pegawai);

		return $result;

	}

	function riwayat_sertifikat_penghargaan($id_peg_penghargaan){

		$result = $this->m_profil->riwayat_sertifikat_penghargaan($id_peg_penghargaan);

		return $result;

	}

	function ini_pegawai_diklat($rumpun,$id_pegawai=false){

		$result = $this->m_profil->ini_pegawai_diklat($rumpun,$id_pegawai);

		return $result;

	}

	function ini_pegawai_pak($id_pegawai=false){

		$result = $this->m_profil->get_pak($id_pegawai);

		return $result;

	}

	function ini_pegawai_kgb($id_pegawai=false){

		$result = $this->m_profil->get_kgb($id_pegawai);

		return $result;

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function utama(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$sess = $this->session->userdata('logged_in');
		
//Sekarang Umpeg Bisa Edit Data Utama | hilangkan group pengelola untuk DISABLEnya

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/utama',$data);

	}

	function pasfoto(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$this->konten($id_pegawai);

	}

	function alamat(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_pegawai_alamat($id_pegawai);



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/alamat',$data);

	}

	function ktp(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_pegawai_alamat($id_pegawai);



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";



		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"ktp",$data['data']->id_peg_alamat);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/ktp/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$this->load->view('profile/ktp',$data);

	}



	

	function alamat_edit_aksi(){

		$isi = $_POST;
		$stoken = $this->session->userdata('token_form');
		$id_pegawai = $_POST['id_pegawai'];
		if($stoken==$_POST['token']){
		$this->m_profil->alamat_edit_aksi($id_pegawai,$isi);
		}

	}

	

	function master_pegawai_tambah_aksi(){

		$isi = $_POST;

		$id_pegawai = $_POST['id_pegawai'];

		$cek = $this->m_pegawai->get_pegawai_master_by_nip($_POST['nip_baru']);

		if(empty($cek)){

			$isi['tanggal_lahir'] = date("Y-m-d", strtotime($_POST['tanggal_lahir']));

			$this->m_profil->biodata_edit_aksi($id_pegawai,$isi);

			echo "sukses";

		} else {

			echo "NIP BARU sudah tercatat dalam dB, tidak bisa di-input ulang!!!";

		}

	}



	function biodata_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$id_pegawai = $_POST['id_pegawai'];

		$peg = Modules::run("appbkpp/profile/ini_pegawai_master",$id_pegawai);  ////////////////////////////////////  tambahan => support ganti nip

		$isi['tanggal_lahir'] = date("Y-m-d", strtotime($_POST['tanggal_lahir']));

		if($stoken==$_POST['token']){

			$this->m_profil->biodata_edit_aksi($id_pegawai,$isi);

			/////////////////////// tambahan => support ganti nip /////////////////////////////

					$n_lama = $peg->nip_baru;

					$n_baru = $_POST['nip_baru'];

					rename("assets/media/file/".$n_lama,"assets/media/file/".$n_baru);

						$this->db->set('nip_baru',$n_baru);

						$this->db->where('nip_baru',$n_lama);

						$this->db->update('r_peg_dokumen');



						$npass = sha1($n_baru);

						$this->db->set('username',$n_baru);

						$this->db->set('passwd',$npass);

						$this->db->where('group_id','11000004');

						$this->db->where('username',$n_lama);

						$this->db->update('users');

			///////////////////////////////////////////////////////////////////////////////////

		}

	}

	function biodata_hapus_aksi(){

		$isi = $_POST;

		$id_pegawai = $_POST['id_pegawai'];

		$this->m_profil->biodata_hapus_aksi($id_pegawai,$isi);

	}

///////////////////////////////////////////////////////////

	function karis_karsu(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_pegawai_pernikahan($id_pegawai);

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);



		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"karis_karsu",$val->id_peg_perkawinan);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/karis_karsu/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/karis_karsu',$data);

	}

	function formkaris_karsu_tambah_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_lahir_suris'] =  date("Y-m-d", strtotime($_POST['tanggal_lahir_suris']));

		$isi['tanggal_menikah'] =  date("Y-m-d", strtotime($_POST['tanggal_menikah']));

		if($stoken==$_POST['token']){

		$this->m_profil->karis_karsu_tambah_aksi($isi);

		echo "ss";

		}

	}

	function formkaris_karsu_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_lahir_suris'] =  date("Y-m-d", strtotime($_POST['tanggal_lahir_suris']));

		$isi['tanggal_menikah'] =  date("Y-m-d", strtotime($_POST['tanggal_menikah']));

		if($stoken==$_POST['token']){

		$this->m_profil->karis_karsu_edit_aksi($isi);

		echo "ss";

		}

	}

	function formkaris_karsu_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->karis_karsu_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////

	function anak(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->ini_pegawai_anak($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"anak",$val->id_peg_anak);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/anak/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/anak',$data);

	}

	function anak_tambah_aksi(){

		$isi = $_POST;

		$stoken  = $this->session->userdata('token_form');

		$isi['tanggal_lahir_anak'] = date("Y-m-d", strtotime($_POST['tanggal_lahir_anak']));

		if($stoken==$_POST['token']){

		$this->m_profil->anak_tambah_aksi($isi);

		}

	}

	function anak_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_lahir_anak'] = date("Y-m-d", strtotime($_POST['tanggal_lahir_anak']));

		if($stoken==$_POST['token']){

		$this->m_profil->anak_edit_aksi($isi);

		}

	}

	function anak_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->anak_hapus_aksi($isi);

	}

////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

	function ijazah_pendidikan(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->ini_pegawai_pendidikan($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ijazah_pendidikan",$val->id_peg_pendidikan);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/ijazah_pendidikan',$data);

	}

	function get_riwayat_pendidikan($id_peg){

		$ini = $this->m_profil->get_riwayat_pendidikan($id_peg);

		return $ini;

	}

	function ini_riwayat_pendidikan($idd){

		$ini = $this->m_profil->ini_riwayat_pendidikan($idd);

		return $ini;

	}

	function riwayat_pendidikan_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_lulus'] = date("Y-m-d", strtotime($_POST['tanggal_lulus']));

		if($stoken==$_POST['token']){

			$this->m_profil->pendidikan_riwayat_edit_aksi($isi);

		}

	}

	function riwayat_pendidikan_tambah_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_lulus'] = date("Y-m-d", strtotime($_POST['tanggal_lulus']));

		if($stoken==$_POST['token']){

		$this->m_profil->pendidikan_riwayat_tambah_aksi($isi);

		}

	}

	function riwayat_pendidikan_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->pendidikan_riwayat_hapus_aksi($isi);

	}

////////////////////////////////////////////////////////////////////

	function sertifikat_kursus(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);



//		$data['data'] = $this->m_profil->ini_pegawai_kursus($id_pegawai);

		$sql = "SELECT a.*	FROM r_peg_kursus a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=6) ORDER BY a.tanggal_sertifikat";

		$data['data'] = $this->db->query($sql)->result();



		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_kursus",$val->id_peg_kursus);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_kursus/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_kursus',$data);

	}

	function formkursus_tambah_aksi(){

		$isi = $_POST;

		$isi['tmt_kursus'] = date("Y-m-d", strtotime($_POST['tmt_kursus']));

		$isi['tst_kursus'] =  date("Y-m-d", strtotime($_POST['tst_kursus']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->kursus_tambah_aksi($isi);

		echo "ss";

	}

	function formkursus_edit_aksi(){

		$isi = $_POST;

		$isi['tmt_kursus'] = date("Y-m-d", strtotime($_POST['tmt_kursus']));

		$isi['tst_kursus'] =  date("Y-m-d", strtotime($_POST['tst_kursus']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->kursus_edit_aksi($isi);

		echo "ss";

	}

	function formkursus_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->kursus_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////////////

	function pupns(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_pupns($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"pupns",$data['data']->id_pupns);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/pupns/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/pupns',$data);

	}

	function pupns_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['pupns_tanggal'] = date("Y-m-d", strtotime($_POST['pupns_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->pupns_input_aksi($isi);

		}

	}

	function pupns_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['pupns_tanggal'] = date("Y-m-d", strtotime($_POST['pupns_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->pupns_edit_aksi($isi);

		}

	}

///////////////////////////////////////////////////////////////////////////////////

///////////////////////////// pertek //////////////////////////////////////////////////////

	function pertek(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_pertek($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"pertek",$data['data']->id_pertek);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/pertek/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/pertek',$data);

	}

	function pertek_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['pertek_tanggal'] = date("Y-m-d", strtotime($_POST['pertek_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->pertek_input_aksi($isi);

		}

	}

	function pertek_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['pertek_tanggal'] = date("Y-m-d", strtotime($_POST['pertek_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->pertek_edit_aksi($isi);

		}

	}

///////////////////////////// end-pertek //////////////////////////////////////////////////////

	function konversi_nip(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_konversi_nip($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"konversi_nip",$data['data']->id_konversi_nip);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/konversi_nip/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/konversi_nip',$data);

	}

	function konversi_nip_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['konversi_nip_tanggal'] = date("Y-m-d", strtotime($_POST['konversi_nip_tanggal']));

		if($stoken==$_POST['token']){

		$this->m_profil->konversi_nip_input_aksi($isi);

		}

	}

	function konversi_nip_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['konversi_nip_tanggal'] = date("Y-m-d", strtotime($_POST['konversi_nip_tanggal']));

		if($stoken==$_POST['token']){

		$this->m_profil->konversi_nip_edit_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

	function karpeg(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_karpeg($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"karpeg",$data['data']->id_karpeg);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/karpeg/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/karpeg',$data);

	}

	function karpeg_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['karpeg_tanggal'] = date("Y-m-d", strtotime($_POST['karpeg_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->karpeg_input_aksi($isi);

		}

	}

	function karpeg_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['karpeg_tanggal'] = date("Y-m-d", strtotime($_POST['karpeg_tanggal']));

		if($stoken==$_POST['token']) {

		$this->m_profil->karpeg_edit_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

	function npwp(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_npwp($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"npwp",$data['data']->id_npwp);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/npwp/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/npwp',$data);

	}

	function npwp_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['npwp_tanggal'] = date("Y-m-d", strtotime($_POST['npwp_tanggal']));

		if($stoken==$_POST['token']) {

			$this->m_profil->npwp_input_aksi($isi);

		}

	}

	function npwp_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['npwp_tanggal'] = date("Y-m-d", strtotime($_POST['npwp_tanggal']));

		if($stoken==$_POST['token']) {

			$this->m_profil->npwp_edit_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

	function taspen(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->get_taspen($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"taspen",$data['data']->id_taspen);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/taspen/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/taspen',$data);

	}

	function taspen_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['taspen_tanggal'] = date("Y-m-d", strtotime($_POST['taspen_tanggal']));

		if($stoken==$_POST['token']) {

			$this->m_profil->taspen_input_aksi($isi);

		}

	}

	function taspen_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['taspen_tanggal'] = date("Y-m-d", strtotime($_POST['taspen_tanggal']));

		if($stoken==$_POST['token']) {

			$this->m_profil->taspen_edit_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

	function sertifikat_penghargaan(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_sertifikat_penghargaan($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_penghargaan",$val->id_peg_penghargaan);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_penghargaan/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="pempeg" || $sess['group_name']=="pempeg2" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_penghargaan',$data);

	}

	function formpenghargaan_tambah_aksi(){

		$isi = $_POST;

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->penghargaan_tambah_aksi($isi);

		echo "ss";

	}

	function formpenghargaan_edit_aksi(){

		$isi = $_POST;

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->penghargaan_edit_aksi($isi);

		echo "ss";

	}

	function formpenghargaan_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->penghargaan_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////////

	function ijin_belajar(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_ibel($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ibel",$val->id_peg_ibel);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ibel/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->sekolah = $this->m_profil->ini_ibel_sekolah($val->id_ibel);

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/ijin_belajar',$data);

	}

///////////////////////////////////////////////////////////////////////////////

//////////////////////////tugas belajar///////////////////////////////////////////////////

	function tugas_belajar(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_tubel($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"tubel",$val->id_peg_tubel);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/tubel/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->sekolah = $this->m_profil->ini_tubel_sekolah($val->id_tubel);

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/tubel_belajar',$data);

	}

////////////////////////////tugas belajar///////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////

	function ujian_dinas(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_ujian_dinas($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ujian_dinas",$val->id_peg_ujian_dinas);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ujian_dinas/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/ujian_dinas',$data);

	}

	function formujian_dinas_tambah_aksi(){

		$this->db->from('r_pegawai_aktual');

		$this->db->where('id_pegawai',$_POST['id_pegawai']);

		$pegawai = $this->db->get()->row();



		$this->db->set('id_pegawai',$pegawai->id_pegawai);

		$this->db->set('gelar_depan',$pegawai->gelar_depan);

		$this->db->set('gelar_belakang',$pegawai->gelar_belakang);

		$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);

		$this->db->set('id_unor',$pegawai->id_unor);

		$this->db->set('kode_golongan',$pegawai->kode_golongan);

		$this->db->set('nomenklatur_jabatan',$pegawai->nomenklatur_jabatan);

		$this->db->set('tugas_tambahan',$pegawai->tugas_tambahan);

		$this->db->set('jab_type',$pegawai->jab_type);

		$this->db->set('status',"injek");

        $this->db->set('buat',"NOW()",false);

		$this->db->insert('r_peg_ujian_dinas_aju');

		$id_udin = $this->db->insert_id();



		$isi = $_POST;

		$isi['id_udin'] = $id_udin;

		$isi['tanggal_ujian_dinas'] =  date("Y-m-d", strtotime($_POST['tanggal_ujian_dinas']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->ujian_dinas_tambah_aksi($isi);

		echo "ss";

	}

	function formujian_dinas_edit_aksi(){

		$isi = $_POST;

		$isi['tanggal_ujian_dinas'] =  date("Y-m-d", strtotime($_POST['tanggal_ujian_dinas']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->ujian_dinas_edit_aksi($isi);

		echo "ss";

	}

	function formujian_dinas_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->ujian_dinas_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////////

	function penyesuaian_ijazah(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_penyesuaian_ijazah($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"penyesuaian_ijazah",$val->id_peg_penyesuaian_ijazah);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/penyesuaian_ijazah/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/penyesuaian_ijazah',$data);

	}

	function formpenyesuaian_ijazah_tambah_aksi(){

		$this->db->from('r_pegawai_aktual');

		$this->db->where('id_pegawai',$_POST['id_pegawai']);

		$pegawai = $this->db->get()->row();



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

		$this->db->set('status',"injek");

	        $this->db->set('buat',"NOW()",false);

		$this->db->insert('r_peg_penyesuaian_ijazah_aju');

		$id_pi = $this->db->insert_id();



		$isi = $_POST;

		$isi['id_pi'] = $id_pi;

		$isi['tanggal_penyesuaian_ijazah'] =  date("Y-m-d", strtotime($_POST['tanggal_penyesuaian_ijazah']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->penyesuaian_ijazah_tambah_aksi($isi);

		echo "ss";

	}

	function formpenyesuaian_ijazah_edit_aksi(){

		$isi = $_POST;

		$isi['tanggal_penyesuaian_ijazah'] =  date("Y-m-d", strtotime($_POST['tanggal_penyesuaian_ijazah']));

		$isi['tanggal_sertifikat'] =  date("Y-m-d", strtotime($_POST['tanggal_sertifikat']));

		$this->m_profil->penyesuaian_ijazah_edit_aksi($isi);

		echo "ss";

	}

	function formpenyesuaian_ijazah_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->penyesuaian_ijazah_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////

	function pak(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_pak($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"pak",$val->id_pak);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/pak/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/pak',$data);

	}

	function formpak_tambah_aksi(){

		$isi = $_POST;

		$this->m_profil->pak_tambah_aksi($isi);

		echo "ss";

	}

	function formpak_edit_aksi(){

		$isi = $_POST;

		$this->m_profil->pak_edit_aksi($isi);

		echo "ss";

	}

	function formpak_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->pak_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////

	function kgb(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_kgb($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"kgb",$val->id_kgb);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/kgb/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/kgb',$data);

	}

	function formkgb_tambah_aksi(){

		$isi = $_POST;

		$this->m_profil->kgb_tambah_aksi($isi);

		echo "ss";

	}

	function formkgb_edit_aksi(){

		$isi = $_POST;

		$this->m_profil->kgb_edit_aksi($isi);

		echo "ss";

	}

	function formkgb_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->kgb_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////

	function dp3(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_dp3($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"dp3",$val->id_dp3);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/dp3/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/dp3',$data);

	}

	function formdp3_tambah_aksi(){

		$isi = $_POST;

		$this->m_profil->dp3_tambah_aksi($isi);

		echo "ss";

	}

	function formdp3_edit_aksi(){

		$isi = $_POST;

		$this->m_profil->dp3_edit_aksi($isi);

		echo "ss";

	}

	function formdp3_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->dp3_hapus_aksi($isi);

		echo "ss";

	}

///////////////////////////////////////////////////////////////////////////

	function skp(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$data['data'] = $this->m_profil->get_skp($id_pegawai);

		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"skp",$val->id_skp);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/skp/thumb_".$dok_ref[0]->file_dokumen;

		}

		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="superadmin") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/skp',$data);

	}

////////////////////////////////////////////////////////////////////

	function sk_cpns(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_cpns($id_pegawai);

		

		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_cpns",$data['data']->id);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_cpns/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/sk_cpns',$data);

	}

	function sk_cpns_edit_aksi(){

		$isi = $_POST;

		$isi['sk_cpns_tgl'] = date("Y-m-d", strtotime($_POST['sk_cpns_tgl']));

		$isi['tmt_cpns'] = date("Y-m-d", strtotime($_POST['tmt_cpns']));

		if($this->dansec->cekToken($_POST['token'])){

			$this->m_profil->sk_cpns_edit_aksi($isi);

		}

	}

	function sk_cpns_input_aksi(){

		$isi = $_POST;

		$isi['sk_cpns_tgl'] = date("Y-m-d", strtotime($_POST['sk_cpns_tgl']));

		$isi['tmt_cpns'] = date("Y-m-d", strtotime($_POST['tmt_cpns']));

		if($this->dansec->cekToken($_POST['token'])){

			$this->m_profil->sk_cpns_input_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

	function sk_pns(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$data['data'] = $this->m_profil->ini_pns($id_pegawai);



		if(!empty($data['data'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_pns",$data['data']->id);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pns/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sk_pns',$data);

	}

	function sk_pns_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['sk_pns_tanggal'] = date("Y-m-d", strtotime($_POST['sk_pns_tanggal']));

		$isi['tmt_pns'] = date("Y-m-d", strtotime($_POST['tmt_pns']));

		if($stoken==$_POST['token']){

		$this->m_profil->sk_pns_edit_aksi($isi);

		}

	}

	function sk_pns_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['sk_pns_tanggal'] = date("Y-m-d", strtotime($_POST['sk_pns_tanggal']));

		$isi['tmt_pns'] = date("Y-m-d", strtotime($_POST['tmt_pns']));

		if($stoken==$_POST['token']){

		$this->m_profil->sk_pns_input_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

	function sk_pangkat(){

		$data['id_pegawai'] = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);

		$data['pangkat'] = $this->m_profil->ini_pegawai_pangkat($data['id_pegawai']);



		foreach($data['pangkat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_pangkat",$val->id_peg_golongan);

			@$data['pangkat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pangkat/thumb_".$dok_ref[0]->file_dokumen;

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/sk_pangkat',$data);

	}

	function formpangkat_tambah_aksi(){

		$isi = $_POST;

		$pkt = $this->dropdowns->kode_golongan_pangkat();

		$pkt_X=explode(",",$pkt[$isi['kode_golongan']]);

		$kp = $this->dropdowns->kode_jenis_kp();



		$isi['jenis_kp'] = $kp[$isi['kode_jenis_kp']];

		$isi['nama_pangkat'] = trim($pkt_X[1]);

		$isi['nama_golongan'] = trim($pkt_X[0]);

		$isi['tmt_golongan'] = date("Y-m-d", strtotime($_POST['tmt_golongan']));

		$isi['sk_tanggal'] =  date("Y-m-d", strtotime($_POST['sk_tanggal']));

		$isi['bkn_tanggal'] =  date("Y-m-d", strtotime($_POST['bkn_tanggal']));

		$this->m_profil->pangkat_riwayat_tambah_aksi($isi);

		echo "ss";

	}

	function formpangkat_edit_aksi(){

		$isi = $_POST;

		$pkt = $this->dropdowns->kode_golongan_pangkat();

		$pkt_X=explode(",",$pkt[$isi['kode_golongan']]);

		$kp = $this->dropdowns->kode_jenis_kp();



		$isi['jenis_kp'] = $kp[$isi['kode_jenis_kp']];

		$isi['nama_pangkat'] = trim($pkt_X[1]);

		$isi['nama_golongan'] = trim($pkt_X[0]);

		$isi['tmt_golongan'] = date("Y-m-d", strtotime($_POST['tmt_golongan']));

		$isi['sk_tanggal'] =  date("Y-m-d", strtotime($_POST['sk_tanggal']));

		$isi['bkn_tanggal'] =  date("Y-m-d", strtotime($_POST['bkn_tanggal']));

		$this->m_profil->pangkat_riwayat_edit_aksi($isi);

		echo "ss";

	}

	function formpangkat_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->pangkat_riwayat_hapus_aksi($isi);

		echo "ss";

	}

////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

	function formjabatan_ajx(){

		$data['pegawai'] = $this->m_profil->ini_pegawai($_POST['idd']);

		$jabatan = $this->m_profil->ini_pegawai_jabatan($_POST['idd']);

			$data['jabatan'] = '';

			$mulai=0;

			foreach($jabatan as $row){

				$row->no=$mulai+1;

				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));

				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));

				$row->editable = $_POST['boleh'];

				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);

				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;

				$data['jabatan'] .= $this->load->view('profile/formjabatan_row',array('val'=>$row),true);

				$mulai++;

			}

		$data['no']=$mulai+1;

		$this->load->view('profile/formjabatan_ajx',$data);

	}

	function sk_jabatan(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['pegawai'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$sess = $this->session->userdata('logged_in');

		$editable = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi" || $sess['group_name']=="opwebbkpp") && $boleh=="ya")?"yes":"no";



		$jabatan = $this->m_profil->ini_pegawai_jabatan($id_pegawai);

			$data['jabatan'] = '';

			$mulai=0;

			foreach($jabatan as $row){

				$row->no=$mulai+1;

				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));

				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));

				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);

				$row->editable = $editable;

				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;

				$data['jabatan'] .= $this->load->view('profile/formjabatan_row',array('val'=>$row),true);

				$mulai++;

			}

		$data['no']=$mulai+1;

		$data['editable'] = $editable;

		$this->load->view('profile/sk_jabatan',$data);

	}

	function jabatan_riwayat(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$data['pegawai'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$boleh = $this->session->userdata('boleh');

		$sess = $this->session->userdata('logged_in');

		$editable = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi" || $sess['group_name']=="opwebbkpp") && $boleh=="ya")?"yes":"no";



		$jabatan = $this->m_profil->ini_pegawai_jabatan($id_pegawai);

			$data['jabatan'] = '';

			$mulai=0;

			foreach($jabatan as $row){

				$row->no=$mulai+1;

				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));

				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));

				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);

				$row->editable = $editable;

				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;

				$data['jabatan'] .= $this->load->view('profile/formjabatan_row',array('val'=>$row),true);

				$mulai++;

			}

		$data['no']=$mulai+1;

		$data['editable'] = $editable;

		$this->load->view('profile/sk_jabatan',$data);

	}

	function formjabatan_tambah(){

		$data['no'] = $_POST['nomor'];

		$tugas_tambahan = $this->dropdowns->tugas_tambahan();

		$this->load->view('profile/formjabatan_update',$data);

	}

	function formjabatan_tambah_aksi(){

/*

		$isi = $_POST;

		$isi['tmt_jabatan'] = date("Y-m-d", strtotime($_POST['tmt_jabatan']));

		$isi['sk_tanggal'] =  date("Y-m-d", strtotime($_POST['sk_tanggal']));

		$this->m_profil->jabatan_riwayat_tambah_aksi($isi);

		echo "ss";

*/

		$isi = $_POST;

		$isi['tmt_jabatan'] = date("Y-m-d", strtotime($_POST['tmt_jabatan']));

		$isi['sk_tanggal'] =  date("Y-m-d", strtotime($_POST['sk_tanggal']));



		if($_POST['nama_jenis_jabatan']=="js"){

						$sq = "SELECT a.id_peg_jab,b.id_pegawai FROM r_peg_jab a

						LEFT JOIN (r_pegawai_aktual b) ON (a.id_pegawai=b.id_pegawai AND a.id_unor=b.id_unor AND a.nama_jenis_jabatan=b.jab_type)

						WHERE  a.id_unor = '".$isi['id_unor']."' AND nama_jenis_jabatan='js' AND a.tmt_jabatan<='".$isi['tmt_jabatan']."'

						ORDER BY a.tmt_jabatan LIMIT 0,1";

						$hs = $this->db->query($sq)->row();

						if(empty($hs->id_pegawai) || $hs->id_pegawai==$isi['id_pegawai']){

							$this->m_profil->jabatan_riwayat_tambah_aksi($isi);

							echo "ss";

						} else {

							echo "Jabatan Struktural masih diduduki oleh pegawai lain!! \n Tidak boleh ada duplikasi Jabatan.";

//							echo "ss";

						}

		} else {

			$this->m_profil->jabatan_riwayat_tambah_aksi($isi);

			echo "ss";

		}

	}

	function formjabatan_edit(){

		$data['idd'] = $_POST['idd'];

		$data['no'] = $_POST['nomor'];

		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);

		$jab = $this->m_unor->ini_unor($data['val']->id_unor);

		$data['val']->nama_jab_struk = @$jab->nomenklatur_jabatan;

		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));

		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));

		$this->load->view('profile/formjabatan_update',$data);

	}

	function formjabatan_edit_aksi(){

		$isi = $_POST;

		$isi['tmt_jabatan'] = date("Y-m-d", strtotime($_POST['tmt_jabatan']));

		$isi['sk_tanggal'] =  date("Y-m-d", strtotime($_POST['sk_tanggal']));



		if($_POST['nama_jenis_jabatan']=="js"){

						$sq = "SELECT a.id_peg_jab,b.id_pegawai FROM r_peg_jab a

						LEFT JOIN (r_pegawai_aktual b) ON (a.id_pegawai=b.id_pegawai AND a.id_unor=b.id_unor AND a.nama_jenis_jabatan=b.jab_type)

						WHERE  a.id_unor = '".$isi['id_unor']."' AND nama_jenis_jabatan='js' AND a.tmt_jabatan<='".$isi['tmt_jabatan']."'

						ORDER BY a.tmt_jabatan LIMIT 0,1";

						$hs = $this->db->query($sq)->row();

						if(empty($hs->id_pegawai) || $hs->id_pegawai==$isi['id_pegawai']){

							$this->m_profil->jabatan_riwayat_edit_aksi($isi);

							echo "ss";

						} else {

							echo "Jabatan Struktural masih diduduki oleh pegawai lain!! \n Tidak boleh ada duplikasi Jabatan.";

//							echo "ss";

						}

		} else {

			$this->m_profil->jabatan_riwayat_edit_aksi($isi);

			echo "ss";

		}

	}

	function formjabatan_hapus(){

		$data['idd'] = $_POST['idd'];

		$data['no'] = $_POST['nomor'];

		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);

		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));

		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));

		$this->load->view('profile/formjabatan_hapus',$data);

	}

	function formjabatan_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->jabatan_riwayat_hapus_aksi($isi);

		echo "ss";

	}

	function getjenjangjabatan(){

		$dWgolongan = $this->dropdowns->kode_golongan();

		$idj = $_POST['id_jabatan'];

		$ijj = $_POST['id_jenjang_jabatan'];

		echo "<select id='pilihan_jenjang_jabatan' class='form-control' style='width:250px;height:20px;padding:1px 0px 0px 5px;' onchange='ini_jenjang_jabatan();'>";

		echo "<option value=''>Pilih...</option>";

		if($_POST['jenis_jabatan']=="jft"){

			$sqlstr="SELECT a.* FROM m_jft_jenjang a WHERE a.id_jabatan = '$idj' AND a.id_jabatan!='0' ORDER BY a.id_jenjang_jabatan";

			$hslquery=$this->db->query($sqlstr)->result();

			foreach($hslquery AS $key=>$val){

				$nama_golongan = @$dWgolongan[$val->kode_golongan];

				$slc = ($val->id_jenjang_jabatan==@$ijj)?"selected":"";

				echo "<option value='".$val->id_jenjang_jabatan."' ".$slc.">Gol. ".$nama_golongan." :: ".$val->tingkat." - ".$val->nama_jenjang."</option>";	

			}

		}

		if($_POST['jenis_jabatan']=="jft-guru"){

			$sqlstr="SELECT a.* FROM m_jft_jenjang a WHERE a.tingkat = 'Guru' ORDER BY a.kode_golongan";

			$hslquery=$this->db->query($sqlstr)->result();

			foreach($hslquery AS $key=>$val){

				$nama_golongan = @$dWgolongan[$val->kode_golongan];

				$slc = ($val->id_jenjang_jabatan==@$ijj)?"selected":"";

				echo "<option value='".$val->id_jenjang_jabatan."' ".$slc.">Gol. ".$nama_golongan." :: ".$val->tingkat." - ".$val->nama_jenjang."</option>";	

			}

		}

		echo "</select>";

	}

///////////////////////////////////////////////

	function sertifikat_diklat(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



//		$data['diklat'] = $this->m_profil->get_sertifikat_diklat($id_pegawai);

		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=2) ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_diklat",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_diklat/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_diklat',$data);

	}

	function formdiklat_tambah_aksi(){

		$isi = $_POST;

		$isi['tmt_diklat'] = date("Y-m-d", strtotime($_POST['tmt_diklat']));

		$isi['tst_diklat'] =  date("Y-m-d", strtotime($_POST['tst_diklat']));

		$isi['tanggal_sttpl'] =  date("Y-m-d", strtotime($_POST['tanggal_sttpl']));

		$this->m_profil->diklat_struk_riwayat_tambah_aksi($isi);

		echo "ss";

	}

	function formdiklat_edit_aksi(){

		$isi = $_POST;

		$isi['tmt_diklat'] = date("Y-m-d", strtotime($_POST['tmt_diklat']));

		$isi['tst_diklat'] =  date("Y-m-d", strtotime($_POST['tst_diklat']));

		$isi['tanggal_sttpl'] =  date("Y-m-d", strtotime($_POST['tanggal_sttpl']));

		$this->m_profil->diklat_struk_riwayat_edit_aksi($isi);

		echo "ss";

	}

	function formdiklat_hapus_aksi(){

		$isi = $_POST;

		$this->m_profil->diklat_struk_riwayat_hapus_aksi($isi);

		echo "ss";

	}

/////////////////////

	function sertifikat_prajab(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);

		$data['isi'] = $this->m_profil->get_sertifikat_prajab($id_pegawai);



		if(!empty($data['isi'])){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_prajab",$data['isi']->id_peg_diklat_struk);

			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_prajab/thumb_".$dok_ref[0]->file_dokumen;

		} else {

			$data['thumb'] = "assets/file/foto/photo.jpg";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_prajab',$data);

	}

	function sertifikat_prajab_input_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_sttpl'] = date("Y-m-d", strtotime($_POST['tanggal_sttpl']));

		$isi['tmt_diklat'] = date("Y-m-d", strtotime($_POST['tmt_diklat']));

		$isi['tst_diklat'] = date("Y-m-d", strtotime($_POST['tst_diklat']));

		if($stoken==$_POST['token']){

		$this->m_profil->sertifikat_prajab_input_aksi($isi);

		}

	}

	function sertifikat_prajab_edit_aksi(){

		$isi = $_POST;

		$stoken = $this->session->userdata('token_form');

		$isi['tanggal_sttpl'] = date("Y-m-d", strtotime($_POST['tanggal_sttpl']));

		$isi['tmt_diklat'] = date("Y-m-d", strtotime($_POST['tmt_diklat']));

		$isi['tst_diklat'] = date("Y-m-d", strtotime($_POST['tst_diklat']));

		if($stoken==$_POST['token']){

		$this->m_profil->sertifikat_prajab_edit_aksi($isi);

		}

	}

////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

	function diklat_fungsional(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=3) ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"diklat_fungsional",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/diklat_fungsional/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/diklat_fungsional',$data);

	}

	function diklat_teknis(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat FROM md_diklat b WHERE  b.id_rumpun=4) ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"diklat_teknis",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/diklat_teknis/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/diklat_teknis',$data);

	}

	function bimtek(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=5) ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"bimtek",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/bimtek/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/bimtek',$data);

	}

	function sertifikat_pengadaan(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_rumpun=10 ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_pengadaan",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_pengadaan/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_pengadaan',$data);

	}

	function sertifikat_profesi(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=7) ORDER BY a.tanggal_sttpl";

		$data['diklat'] = $this->db->query($sql)->result();



		foreach($data['diklat'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_profesi",$val->id_peg_diklat_struk);

			@$data['diklat'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_profesi/thumb_".$dok_ref[0]->file_dokumen;

			@$data['diklat'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/sertifikat_profesi',$data);

	}

	function seminar(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_kursus a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=8) ORDER BY a.tanggal_sertifikat";

		$data['data'] = $this->db->query($sql)->result();



		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"seminar",$val->id_peg_kursus);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/seminar/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/seminar',$data);

	}

	function workshop(){

		$id_pegawai = $this->session->userdata('pegawai_info');

		$boleh = $this->session->userdata('boleh');

		$data['id_pegawai'] = $id_pegawai;

		$pegawai = $this->m_profil->ini_pegawai_master($data['id_pegawai']);



		$sql = "SELECT a.*	FROM r_peg_kursus a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat	FROM md_diklat b WHERE  b.id_rumpun=9) ORDER BY a.tanggal_sertifikat";

		$data['data'] = $this->db->query($sql)->result();



		foreach($data['data'] AS $key=>$val){

			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"workshop",$val->id_peg_kursus);

			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/workshop/thumb_".$dok_ref[0]->file_dokumen;

			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";

		}



		$sess = $this->session->userdata('logged_in');

		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk" || $sess['group_name']=="diklat") && $boleh=="ya")?"yes":"no";



		$this->load->view('profile/workshop',$data);

	}

	function narasumber(){

		echo "Narasumber / Pembicara";

	}

	function kepengurusan(){

		echo "Kepengurusan Organisasi";

	}

	function kepanitiaan(){

		echo "Kepanitiaan Acara Resmi";

	}

	function penulisan(){

		echo "Penilisan Buku / Makalah";

	}

	function tugas_pptk(){

		echo "Penugasan PPK / PPTK KEGIATAN";

	}





}

?>