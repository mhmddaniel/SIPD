<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Event extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdiklat/m_event');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Penyelenggaraan Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 1;
		$data['nama'] = "diklat prajabatan";
		$this->load->view('event/index',$data);
	}
	function diklat_penjenjangan(){
		$data['satu'] = "Penyelenggaraan Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 2;
		$data['nama'] = "diklat penjenjangan";
		$this->load->view('event/index',$data);
	}
	function diklat_fungsional(){
		$data['satu'] = "Penyelenggaraan Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 3;
		$data['nama'] = "diklat fugsional";
		$this->load->view('event/index',$data);
	}
	function diklat_teknis(){
		$data['satu'] = "Penyelenggaraan Pendidikan dan Pelatihan";
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$data['rumpun'] = 4;
		$data['nama'] = "diklat teknis";
		$this->load->view('event/index',$data);
	}

	function getdata(){
		$tahun = $_POST['tahun'];
		$rumpun = $_POST['rumpun'];
		$cari = $_POST['cari'];
		$data['count'] = $this->m_event->hitung_event($cari,$rumpun,$tahun);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_event->get_event($cari,$rumpun,$tahun,$mulai,$batas);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function tambah(){
		$idd = explode("*",$_POST['idd']);
		$data['nama'] = $idd[0];
		$data['idd'] = $idd[1];
		$data['id_rumpun'] = $idd[2];
		$data['tahun'] = $_POST['tahun'];
		$data['aksi'] = "tambah";
		$this->load->view('event/event_form',$data);
	}
	function tambah_aksi(){
		$this->m_event->tambah($_POST);
		echo "sukses#";
	}
	function edit(){
		$idd = explode("*",$_POST['idd']);
		$data['nama'] = $idd[0];
		$data['idd'] = $idd[1];
		$data['id_rumpun'] = $idd[2];
		$data['tahun'] = $_POST['tahun'];
		$data['aksi'] = "edit";
		$data['isi'] = $this->m_event->ini_event($data['idd']);
		$this->load->view('event/event_form',$data);
	}
	function edit_aksi(){
		$this->m_event->edit($_POST);
		echo "sukses#";
	}
	function hapus(){
		$idd = explode("*",$_POST['idd']);
		$data['nama'] = $idd[0];
		$data['idd'] = $idd[1];
		$data['id_rumpun'] = $idd[2];
		$data['tahun'] = $_POST['tahun'];
		$data['aksi'] = "hapus";
		$data['isi'] = $this->m_event->ini_event($data['idd']);
		$this->load->view('event/event_form',$data);
	}
	function hapus_aksi(){
		$this->m_event->hapus($_POST);
		echo "sukses#";
	}
	function rinci(){
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$idd = explode("*",$_POST['idd']);
		$data['nama'] = $idd[0];
		$data['idd'] = $idd[1];
		$data['id_rumpun'] = $idd[2];
		$data['tahun'] = $_POST['tahun'];
		$data['diklat'] = $this->m_event->ini_event($data['idd']);
		$this->load->view('event/rinci',$data);
	}
	function getpeserta(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_event->hitung_peserta($_POST['id_diklat_event'],$cari);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_event->get_peserta($_POST['id_diklat_event'],$cari,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function peserta_rincian(){
		$id_diklat_peserta = $_POST['idd'];
		$data['aksi'] = "rincian";
		$data['data'] = $this->m_event->get_rincian($id_diklat_peserta);
		$this->load->view('event/rincian',$data);
	}
	function peserta_tambah(){
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$data['aksi'] = "tambah";
		$this->load->view('event/peserta_form',$data);
	}
	function peserta_tambah_aksi(){
		$cek = $this->m_event->cek_peserta($_POST['id_diklat_event'],$_POST['id_pegawai']);
		if(empty($cek)){
			$pegawai = Modules::run("appbkpp/profile/ini_pegawai",$_POST['id_pegawai']);
			$peg_pangkat = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$_POST['id_pegawai']);
			$pangkat = end($peg_pangkat);
			$peg_jabatan = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$_POST['id_pegawai']);
			$jabatan = end($peg_jabatan);
			$this->m_event->tambah_peserta($_POST,$pegawai,$jabatan->id_peg_jab,$pangkat->id_peg_golongan);
		}
		echo "sukses#";
	}
	function peserta_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$this->load->view('event/peserta_hapus',$data);
	}
	function peserta_hapus_aksi(){
		$this->m_event->hapus_peserta($_POST);
		echo "sukses#";
	}
////////////////////////////////////////////
	function getwidyaiswara(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_event->hitung_widyaiswara($_POST['id_diklat_event']);

		if($data['count']==0){
			$data['hslquery']=array();
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_event->get_widyaiswara($_POST['id_diklat_event'],$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
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
		$this->db->insert('md_diklat_widyaiswara');

	}
	
	function biodata_update_aksi($id_diklat_event,$id_diklat_widyaiswara)
	{

		$this->db->set('id_diklat_event',$id_diklat_event);
		$this->db->where('id_diklat_widyaiswara',$id_diklat_widyaiswara);
		$hslquery = $this->db->update('md_diklat_widyaiswara');
		return $hslquery;

	}
	
	function widyaiswara(){
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$this->load->view('event/widyaiswara',$data);
	}
	function widyaiswara_tambah(){
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$data['aksi'] = "tambah";
		$this->load->view('event/widyaiswara_form',$data);
	}

	function widyaiswara_tambah_aksi(){

		// $isi = $_POST;
		// $id_widyaiswara = $_POST['id_diklat_widyaiswara'];
			
		// $this->m_event->biodata_edit_aksi($id_widyaiswara,$isi);
			
		// echo "sukses";

		$this->load->library('upload');



		    $file = count($_FILES['modul']['name']);



		    // Faking upload calls to $_FILE

		    for ($i = 0; $i < $file; $i++) :

		      $_FILES['userfile']['name']     = $_FILES['modul']['name'][$i];

		      $_FILES['userfile']['type']     = $_FILES['modul']['type'][$i];

		      $_FILES['userfile']['tmp_name'] = $_FILES['modul']['tmp_name'][$i];

		      $_FILES['userfile']['error']    = $_FILES['modul']['error'][$i];

		      $_FILES['userfile']['size']     = $_FILES['modul']['size'][$i];

		      $path = $_FILES['modul']['name'][$i];

		      $ext = pathinfo($path,PATHINFO_EXTENSION);



		      $config = array(

		        'file_name'     => "Modul_" . date("DMdYGi").$i.'.'.$ext,

		        'allowed_types' => 'pdf',

		        'max_size'      => 3000,

		        'overwrite'     => FALSE,



		        /* real path to upload folder ALWAYS */

		        'upload_path'

		            =>'./assets/media/modul'

		      );



		      $this->upload->initialize($config);



		      if ( ! $this->upload->do_upload()) :

		        $error = array('error' => $this->upload->display_errors());

		        $this->load->view('upload_form', $error);

		      else :

		        $final_files_data[] = $this->upload->data();

						$isi['nip_baru'] = $_POST['nip_baru'];
						$isi['gelar_nonakademis'] = $_POST['gelar_nonakademis'];
						$isi['nama_pegawai'] = $_POST['nama_pegawai'];
						$isi['hari'] = $_POST['hari'];
						$isi['gelar_depan'] = $_POST['gelar_depan'];
						$isi['gelar_belakang'] = $_POST['gelar_belakang'];
						$isi['agama'] = $_POST['agama'];
						$isi['materi'] = $_POST['materi'];
						$isi['modul'] = $config['file_name'];
						$isi['tanggal'] = $_POST['tanggal'];
						$isi['jam'] = $_POST['jam'];


						$id_widyaiswara = $_POST['id_diklat_widyaiswara'];
							
						$this->m_event->biodata_edit_aksi($id_widyaiswara,$isi);
							
						echo "sukses";


		        // Continue processing the uploaded data

		      endif;

		    endfor;
	}
	
	 function widyaiswara_update_id_event(){
		$id_diklat_event = $_POST['id_diklat_event'];
		$id_diklat_widyaiswara = $this->m_event->get_last_widyaiswara();
		$hslquery = $this->m_event->biodata_update_aksi($id_diklat_event,$id_diklat_widyaiswara);
		echo json_encode ($id_diklat_widyaiswara);
	}
	
	function widyaiswara_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$this->load->view('event/widyaiswara_hapus',$data);
	}
	
	function widyaiswara_hapus_aksi(){
		$this->m_event->hapus_widyaiswara($_POST);
		echo "sukses#";
	}
////////////////////////////////////////////
	function modul(){
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$this->load->view('event/modul',$data);
	}
	function modul_tambah(){
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$data['aksi'] = "tambah";
		$this->load->view('event/modul_form',$data);
	}
////////////////////////////////////////////
	function jadwal(){
		$data['cari'] = "";
		$data['hal'] = "";
		$data['batas'] = 10;
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$this->load->view('event/jadwal',$data);
	}
	function jadwal_tambah(){
		$data['id_diklat_event'] = $_POST['id_diklat_event'];
		$data['aksi'] = "tambah";
		$this->load->view('event/jadwal_form',$data);
	}

}
?>