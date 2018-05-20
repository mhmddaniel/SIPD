<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pensiun_edok extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appmutasi/m_pensiun');
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

		$kpo = $this->m_pensiun->ini_pensiun($_POST['idd']);
		if($pensiun->status=="draft" && $pensiun->draft==null){	
			$this->m_pensiun->draft_pemohon($_POST['idd']);	
		}
		$this->session->set_userdata('token_form',$data['token']);
		redirect("module/appmutasi/pensiun_edok");
	}
	function index(){
		$data['satu'] = "Pengajuan Pensiun";
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
		$data['val'] = $this->m_pensiun->ini_pensiun($data['idd']);
		$data['val']->nama_pangkat = @$dWpangkat[$data['val']->kode_golongan];
		$data['val']->nama_golongan = @$dWgolongan[$data['val']->kode_golongan];
		$data['id_pegawai'] = $data['val']->id_pegawai;

		$data['kode_dokumen'] = Modules::run("appmutasi/pensiun_daftar/kode_dokumen_pensiun");

		$this->load->view('pensiun_edok/index',$data);
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
		$data['pensiun'] = $this->m_pensiun->ini_pensiun($data['idd']);
		$data['surat'] = json_decode($data['pensiun']->ijin_pimpinan);

		$data['isi'] = $this->m_pensiun->cek_dokumen($data['idd'],$data['komponen']);
		if(!empty($data['isi'])){
			$ffl = "assets/media/pensiun/".$peg->nip_baru."/".$data['komponen']."/".$data['isi'][0]->pensiun_file;
			$data['raw'] = pathinfo($ffl, PATHINFO_EXTENSION);
			if($data['raw']=="jpg"){
				$data['thumb'] = "assets/media/pensiun/".$peg->nip_baru."/".$data['komponen']."/thumb_".$data['isi'][0]->pensiun_file;
			} else {
				$data['thumb'] = "assets/media/foto/default/doc.png";
			}
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
			$data['raw'] = "sayur";
		}

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('pensiun_edok/ijin',$data);
	}
	function ijin_formedit(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$surat = $this->m_pensiun->ini_pensiun($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$this->load->view('pensiun_edok/ijin_formedit',$data);
	}
	function ijin_edit_aksi(){
		$this->m_pensiun->ijin_edit($_POST);
		echo "sukses";
	}
	function ijin_upload(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$surat = $this->m_pensiun->ini_pensiun($data['idd']);
		$data['isi'] = json_decode($surat->ijin_pimpinan);
		$data['row'] = $this->m_pensiun->cek_dokumen($data['idd'],$_POST['komponen']);
		$data['nip_baru'] = $_POST['id_pegawai'];
		
		foreach($data['row'] AS $key=>$val){
			$ffl = "assets/media/pensiun/".$data['nip_baru']."/".$data['komponen']."/".$val->pensiun_file;
			$raw = pathinfo($ffl, PATHINFO_EXTENSION);
			if($raw=="jpg"){
				@$data['row'][$key]->thumb = "assets/media/pensiun/".$data['nip_baru']."/".$data['komponen']."/thumb_".$val->pensiun_file;
			} else {
				@$data['row'][$key]->thumb = "assets/media/foto/default/doc.png";
			}
		}

		$this->load->view('pensiun_edok/ijin_upload',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	function kgb(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/kgb");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function sk_cpns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_cpns");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function sk_pns(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pns");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function sk_pangkat(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/sk_pangkat");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function konversi_nip(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/konversi_nip");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function skp(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/skp");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function karpeg(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/karpeg");
		$this->load->view('kpo_edok/sk_cpns',$data);
	}
	function pak(){
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);	//id_ibel
		$this->session->set_userdata('boleh','tidak');
		$data['isi'] = Modules::run("appbkpp/profile/pak");
		$this->load->view('kpo_edok/sk_cpns',$data);
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
						$config['source_image'] = 'assets/media/pensiun/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
						$config['new_image'] = 'assets/media/pensiun/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
						//$cek = createImageThumbnail(250,150,$config);
						$this->load->library('image_lib', $config);
						$cek = $this->image_lib->resize();
				}
////////////////////////////////
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $idd."_".$nmB.".".$ext;
				rename("assets/media/pensiun/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/pensiun/".$id_pegawai."/".$komponen."/".$nmF);
				if($ext=="jpg"){
						rename("assets/media/pensiun/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/pensiun/".$id_pegawai."/".$komponen."/thumb_".$nmF);
				}
				$this->m_pensiun->rename_dokumen($result['idd'],$nmF);
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
			$path="assets/media/pensiun/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/pensiun/".$id_pegawai."/".$komponen."/";
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
			$idB = $this->m_pensiun->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
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
		$dok = $this->m_pensiun->ini_dokumen($id_dokumen);
		unlink("assets/media/pensiun/".$id_pegawai."/".$komponen."/".$dok->pensiun_file);
		unlink("assets/media/pensiun/".$id_pegawai."/".$komponen."/thumb_".$dok->pensiun_file);
		$hp = $this->m_pensiun->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

//		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}
	function edit_keterangan_aksi(){
		$this->m_pensiun->edit_keterangan_dokumen($_POST);
		echo json_encode($_POST);
	}
	function zoom(){
		$data['idd'] = $this->session->userdata('idd');//id_ibel
		$data['komponen'] = $_POST['komponen'];
		$data['nip_baru'] = $_POST['nip_baru'];
		$data['dokumen'] = $this->m_pensiun->cek_dokumen($data['idd'],$_POST['komponen']);
		foreach($data['dokumen'] AS $key=>$val){
			$ffl = "assets/media/pensiun/".$data['nip_baru']."/".$data['komponen']."/".$val->pensiun_file;
			@$data['dokumen'][$key]->row = pathinfo($ffl, PATHINFO_EXTENSION);
		}
		$this->load->view('pensiun_edok/zoom',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////
}
?>