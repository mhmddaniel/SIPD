<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jabstruk extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_anjab');
		$this->load->model('appevjab/m_kelas');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}

////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Kelas Jabatan Struktural";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['tipe'] = "js";
		$this->load->view('jabstruk/index',$data);
	}
	function formtambah(){
		$data['satu'] = "semen";
		$this->load->view('jabstruk/formkelas',$data);
	}
	function formedit(){
		$data['unit'] = $this->m_anjab->ini_jabfung($_POST['idd']);
		$this->load->view('jabstruk/formkelas',$data);
	}
	function formhapus(){
		$data['unit'] = $this->m_anjab->ini_jabfung($_POST['idd']);
		$this->load->view('jabstruk/formkelas',$data);
	}
////////////////////////////////////////////////////////
	function kelas_formsetup(){
		$data['idd'] = $_POST['idd'];
		$data['unit'] = $this->m_unor->ini_unor($data['idd']);
		$jabatan = $this->m_anjab->ini_jabfung($data['unit']->nomenklatur_unor);
		@$data['unit']->IDjabatan = $jabatan->id_jabatan;
		@$data['unit']->jabatan = $jabatan->nama_jabatan;

		$this->session->set_userdata("jab_type","js");
		$this->session->set_userdata("hal","end");
		$this->session->set_userdata("batas","10");
		$this->session->set_userdata("cari","");

		$data['batas'] = $this->session->userdata("batas");
		$data['hal'] = $this->session->userdata("hal");
		$data['cari'] = $this->session->userdata("cari");

		$this->load->view('jabstruk/setupkelas',$data);
	}
	function kelas_setup_aksi(){
		$this->m_kelas->kelas_setup($_POST);
		echo "sukses";
	}
////////////////////////////////////////////////////////
	function urtug_alih(){
		$this->session->set_userdata("id_jabatan",$_POST['idd']);
		$this->session->set_userdata("jab_type","js");
		redirect("module/appevjab/jabstruk/urtug");
	}
	function urtug(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['jab_type'] = $this->session->userdata("jab_type");
		$data['unit'] = $this->m_unor->ini_unor($data['idd']);
		$data['urtug'] = $this->m_anjab->get_urtug($data['idd'],$data['jab_type']);
		foreach($data['urtug'] AS $key=>$val){
			@$data['urtug'][$key]->cek = $this->m_anjab->get_urtug_tahapan($val->id_urtug);
		}

		$this->load->view('jabstruk/urtug',$data);
	}
	function urtug_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabstruk/urtug_form',$data);
	}
	function urtug_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "ya";
		$this->load->view('jabstruk/urtug_form',$data);
	}
	function urtug_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['isian'] = "tidak";
		$this->load->view('jabstruk/urtug_form',$data);
	}
	function urtug_formihtisar(){
		$data['idd'] = $this->session->userdata("id_jabatan");
		$data['unit'] = $this->m_unor->ini_unor($data['idd']);
		$this->load->view('jabstruk/urtug_formihtisar',$data);
	}
	function ihtisar_edit_aksi(){
		$idd = $this->session->userdata("id_jabatan");
		$this->m_anjab->ihtisar_js_edit($idd,$_POST);
		echo "sukses";
	}

	function urtug_tahapan(){
		$data['idd'] = $_POST['idd'];
		$data['val'] = $this->m_anjab->ini_urtug($data['idd']);
		$data['tahapan'] = $this->m_anjab->get_urtug_tahapan($data['idd']);
		$this->load->view('jabfung/urtug_tahapan',$data);
	}
}
?>