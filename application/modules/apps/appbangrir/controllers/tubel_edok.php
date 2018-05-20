<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tubel_edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbangrir/m_tubel');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function alih(){
		$this->session->set_userdata('cari',$_POST['cari']);
		$this->session->set_userdata('batas',$_POST['batas']);
		$this->session->set_userdata('hal',$_POST['hal']);
		$this->session->set_userdata('asal',$_POST['asal']);
/*
		$this->session->set_userdata('kode',$_POST['kode']);
		$this->session->set_userdata('pns',$_POST['pns']);
		$this->session->set_userdata('pkt',$_POST['pkt']);
		$this->session->set_userdata('jbt',$_POST['jbt']);
		$this->session->set_userdata('ese',$_POST['ese']);
		$this->session->set_userdata('tugas',$_POST['tugas']);
		$this->session->set_userdata('gender',$_POST['gender']);
		$this->session->set_userdata('agama',$_POST['agama']);
		$this->session->set_userdata('status',$_POST['status']);
		$this->session->set_userdata('jenjang',$_POST['jenjang']);
		$this->session->set_userdata('umur',$_POST['umur']);
		$this->session->set_userdata('mkcpns',$_POST['mkcpns']);
*/
		$this->session->set_userdata('idd',$_POST['idd']);

		$tubel = $this->m_tubel->ini_tubel($_POST['idd']);
		if($tubel->status=="draft" && $tubel->draft==null){	$this->m_tubel->draft_pemohon($_POST['idd']);	}

		redirect("module/appbangrir/tubel_edok");
	}
	function index(){
		$data['satu'] = "Pengajuan Tugas Belajar";
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
		$data['val'] = $this->m_tubel->ini_tubel($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$val->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$val->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;

		$data['sek'] = $this->m_tubel->ini_sekolah($data['idd']);
		$data['kode_dokumen'] = Modules::run("appbangrir/tubel_daftar/kode_dokumen_tubel");

		$this->load->view('tubel_edok/index',$data);
	}
	function ajukan_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('tubel_edok/ajukan_form',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ijin(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "ijin";
		$data['tubel'] = $this->m_tubel->ini_tubel($data['idd']);
		$data['surat'] = json_decode($data['tubel']->ijin_pimpinan);

		$data['isi'] = $this->m_tubel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->tubel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->tubel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('tubel_edok/ijin',$data);
	}
	function ijin_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('tubel_edok/ijin_formedit',$data);
	}
	function ijin_edit_aksi(){
		$this->m_tubel->ijin_edit($_POST);
		echo "sukses";
	}
	function ijin_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$data['row'] = $this->m_tubel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/".$val->tubel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->tubel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('tubel_edok/ijin_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function akreditasi(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "akreditasi";
		$data['tubel'] = $this->m_tubel->ini_tubel($data['idd']);
		$data['surat'] = json_decode($data['tubel']->akreditasi);

		$data['isi'] = $this->m_tubel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->tubel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->tubel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('tubel_edok/akreditasi',$data);
	}
	function akreditasi_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->akreditasi);
		$this->load->view('tubel_edok/akreditasi_formedit',$data);
	}
	function akreditasi_edit_aksi(){
		$this->m_tubel->akreditasi_edit($_POST);
		echo "sukses";
	}
	function akreditasi_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->akreditasi);
		$data['row'] = $this->m_tubel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];

		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/".$val->tubel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->tubel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('tubel_edok/akreditasi_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function jadwal(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$peg = Modules::run("appbkpp/profile/ini_pegawai",$data['id_pegawai']);
		$data['komponen'] = "jadwal";
		$data['tubel'] = $this->m_tubel->ini_tubel($data['idd']);
		$data['surat'] = json_decode($data['tubel']->jadwal);

		$data['isi'] = $this->m_tubel->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->tubel_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/tubel/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->tubel_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('tubel_edok/jadwal',$data);
	}
	function jadwal_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->jadwal);
		$this->load->view('tubel_edok/jadwal_formedit',$data);
	}
	function jadwal_edit_aksi(){
		$this->m_tubel->jadwal_edit($_POST);
		echo "sukses";
	}
	function jadwal_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_tubel->ini_tubel($data['idd']);
		$data['isi'] = json_decode($surat->jadwal);
		$data['row'] = $this->m_tubel->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/".$val->tubel_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->tubel_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}
		$this->load->view('tubel_edok/jadwal_upload',$data);
	}
	function sk_cpns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_tubel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_cpns");
		$this->load->view('tubel_edok/sk_cpns',$data);
	}
	function sk_pangkat(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_tubel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pangkat");
		$this->load->view('tubel_edok/sk_cpns',$data);
	}
	function skp(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_tubel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/skp");
		$this->load->view('tubel_edok/sk_cpns',$data);
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
						$config['source_image'] = 'assets/media/tubel/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
						$config['new_image'] = 'assets/media/tubel/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
						//$cek = createImageThumbnail(250,150,$config);
						$this->load->library('image_lib', $config);
						$cek = $this->image_lib->resize();
				}
////////////////////////////////
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $idd."_".$nmB.".".$ext;
				rename("assets/media/tubel/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/tubel/".$id_pegawai."/".$komponen."/".$nmF);
				if($ext=="jpg"){
						rename("assets/media/tubel/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/tubel/".$id_pegawai."/".$komponen."/thumb_".$nmF);
				}
				$this->m_tubel->rename_dokumen($result['idd'],$nmF);
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
			$path="assets/media/tubel/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/tubel/".$id_pegawai."/".$komponen."/";
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
			$idB = $this->m_tubel->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
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
		$dok = $this->m_tubel->ini_dokumen($id_dokumen);
		unlink("assets/media/tubel/".$id_pegawai."/".$komponen."/".$dok->tubel_file);
		unlink("assets/media/tubel/".$id_pegawai."/".$komponen."/thumb_".$dok->tubel_file);
		$hp = $this->m_tubel->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

//		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}
	function edit_keterangan_aksi(){
		$this->m_tubel->edit_keterangan_dokumen($_POST);
		echo json_encode($_POST);
	}
	function zoom(){
		$data['idd'] = $this->session->userdata('idd');//id_tubel
		$data['komponen'] = $_POST['komponen'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_tubel->cek_dokumen($data['idd'],$_POST['komponen']);
		foreach($data['dokumen'] AS $key=>$val){
			$ffl = "assets/media/tubel/".$data['nip_baru']."/".$data['komponen']."/".$val->tubel_file;
			@$data['dokumen'][$key]->row = pathinfo($ffl, PATHINFO_EXTENSION);
		}
		$this->load->view('tubel_edok/zoom',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////
}
?>