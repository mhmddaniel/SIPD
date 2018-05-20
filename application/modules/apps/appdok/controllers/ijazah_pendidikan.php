<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ijazah_pendidikan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();

		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function edit(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['row'] = Modules::run("appbkpp/profile/ini_riwayat_pendidikan",$_POST['idd']);
		@$data['row']->tanggal_lulus = date("d-m-Y", strtotime($data['row']->tanggal_lulus));
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_pendidikan_'.$data['id_pegawai']);
		}else {
			$data['aksi'] = "edit";
			$data['token'] = sha1('data_edit_pendidikan_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('ijazah_pendidikan/form',$data);
	}

	function hapus(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['row'] = Modules::run("appbkpp/profile/ini_riwayat_pendidikan",$_POST['idd']);
		@$data['row']->tanggal_lulus = date("d-m-Y", strtotime($data['row']->tanggal_lulus));
		$data['hapus'] = "ya";
		$data['token'] = sha1('data_hapus_pendidikan_'.$data['id_pegawai']);
		$this->load->view('ijazah_pendidikan/form',$data);
	}

	function tambah(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		if(empty($data['isi'])) {
			$data['aksi'] = "input";
			$data['token'] = sha1('data_input_pendidikan_'.$data['id_pegawai']);
		}
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('ijazah_pendidikan/form',$data);
	}

	function uploadDok(){
		$data['id_pegawai'] = $_POST['id_pegawai'];
		$data['idd'] = $_POST['idd'];
		$data['komponen'] = $_POST['komponen'];
		$data['isi'] = $this->m_edok->ini_pendidikan($_POST['idd']);
		$data['row'] = $this->m_edok->cek_dokumen($_POST['id_pegawai'],$_POST['komponen'],$_POST['idd']);
		$this->load->view('ijazah_pendidikan/upload',$data);
	}

	function edit_keterangan_aksi(){
		$this->m_edok->edit_keterangan_dokumen($_POST);
		echo json_encode($_POST);
	}

	function saveupload(){
		if(strlen($_FILES['artikel_file']['name'])>0){
				$id_pegawai = $_POST['id_pegawai'];
				$komponen = $_POST['komponen'];
				$idd = $_POST['idd'];

			    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
				$ext = pathinfo($_FILES['artikel_file']['name'], PATHINFO_EXTENSION);
				$base = basename($_FILES['artikel_file']['name'], ".".$ext);
				$nama_file = str_replace($d,"_",$base);
				$result = $this->uploadFile($id_pegawai,$nama_file,$komponen,$idd);

				$config['image_library'] = 'gd2';
				$config['width'] = 250;
				$config['height'] = 150;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				//$config['thumb_marker']='';
				$config['source_image'] = 'assets/media/file/'.$id_pegawai.'/'.$komponen.'/'.$result['raw'].".".$ext;
				$config['new_image'] = 'assets/media/file/'.$id_pegawai.'/'.$komponen.'/thumb_'.$result['raw'].".".$ext;
				//$cek = createImageThumbnail(250,150,$config);
				$this->load->library('image_lib', $config);
				$cek = $this->image_lib->resize();
////////////////////////////////
			$nmB=str_replace($d, '_',$result['raw']);
			$nmF = $idd."_".$nmB.".".$ext;
			rename("assets/media/file/".$id_pegawai."/".$komponen."/".$result['raw'].".".$ext,"assets/media/file/".$id_pegawai."/".$komponen."/".$nmF);
			rename("assets/media/file/".$id_pegawai."/".$komponen."/thumb_".$result['raw'].".".$ext,"assets/media/file/".$id_pegawai."/".$komponen."/thumb_".$nmF);
			$this->m_edok->rename_dokumen($result['idd'],$nmF);
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
			$path="assets/media/file/".$id_pegawai."/";
			if(!file_exists($path)){	mkdir($path,755);	}
			$path2="assets/media/file/".$id_pegawai."/".$komponen."/";
			if(!file_exists($path2)){	mkdir($path2,755);	}
		
		$config['upload_path'] = $path2;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
		//$config['max_size']	= '512';
		$config['remove_spaces']=true;
        $config['overwrite']=true;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('artikel_file'))		{
			$data= array('status' => 'error', 'error' => $this->upload->display_errors());
			return $data;
		}	else {

			$dn = $this->upload->data('artikel_file');
			$ttpp = $dn['raw_name'];
			$idB = $this->m_edok->simpan_dokumen($id_pegawai,$nama_file,$komponen,$idd);
			$data['raw'] = $ttpp;
			$data['status'] = "success";
			$data['idd'] = $idB;
			$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			return $data;
		}
	}
	
	function hapus_dok(){
		$komponen = $_POST['komponen'];
		$id_pegawai = $_POST['id_pegawai'];
		$id_dokumen = $_POST['id_dokumen'];
		$dok = $this->m_edok->ini_dokumen($id_dokumen);
		unlink("assets/media/file/".$id_pegawai."/".$komponen."/".$dok->file_dokumen);
		unlink("assets/media/file/".$id_pegawai."/".$komponen."/thumb_".$dok->file_dokumen);
		$hp = $this->m_edok->hapus_dokumen($id_dokumen,$id_pegawai,$komponen,$_POST['idd']);

		$gg = Modules::run("appdok/pantau/kontrol",$id_pegawai);
			echo "<b>Sukses...</b>";
	}

}
?>