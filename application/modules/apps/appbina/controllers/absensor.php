<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Absensor extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbina/m_apel');
		$this->load->model('appbina/m_harian');
		$this->load->model('appbina/m_absensor');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Setting Petugas Absen";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('absensor/index',$data);
	}
	function row_absensor(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_absensor->hitung_absensor($cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$hslquery = $this->m_absensor->get_absensor($cari,$mulai,$batas);
			$data['hslquery'] = '';
			foreach($hslquery as $row){
				$row->hal = $hal;
				$row->cari = $cari;
				$row->no=$mulai+1;
				$data['hslquery'] .= $this->load->view('absensor/absensor_row',array('val'=>$row),true);
				$mulai++;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function absensor_tambah_form(){
		$this->load->view('absensor/form_update_absensor');
	}
	function absensor_tambah_aksi(){
 		$this->form_validation->set_rules("nama_user","Nama pengelola","trim|required|xss_clean");
 		$this->form_validation->set_rules("username","Username","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$proses = $this->m_absensor->absensor_tambah_aksi($this->input->post());
		}
		echo $proses;
	}
	function absensor_edit_form(){
		$data['pengelola'] = $this->m_absensor->ini_absensor($_POST['idd']);
		$this->load->view('absensor/form_update_absensor',$data);
	}
	function absensor_edit_aksi(){
 		$this->form_validation->set_rules("user_id","","trim|required|xss_clean");
 		$this->form_validation->set_rules("nama_user","Nama pengelola","trim|required|xss_clean");
 		$this->form_validation->set_rules("username","Username","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$proses = $this->m_absensor->absensor_edit_aksi($this->input->post());
		}
		echo $proses;
	}
	function absensor_hapus_form(){
		$data['pengelola'] = $this->m_absensor->ini_absensor($_POST['idd']);
		$this->load->view('absensor/form_update_absensor',$data);
	}
	function absensor_hapus_aksi(){
 		$this->form_validation->set_rules("user_id","","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$proses = $this->m_absensor->absensor_hapus_aksi($this->input->post());
		}
		echo $proses;
	}

	function absensor_akses(){
		$data['satu'] = "Setting Petugas Absen";
		$idd = $this->session->userdata('id_pengelola');
		$data['pengelola'] = $this->m_absensor->ini_absensor($idd);
		$data['hal'] = $this->session->userdata('hal');
		$data['cari'] = $this->session->userdata('cari');
		$this->load->view('absensor/pil_unor_absensor',$data);
	}
	function absensor_lihat(){
		$data['satu'] = "Setting Petugas Absen";
		$idd = $this->session->userdata('id_pengelola');
		$data['pengelola'] = $this->m_absensor->ini_absensor($idd);
		$data['hal'] = $this->session->userdata('hal');
		$data['cari'] = $this->session->userdata('cari');
		$this->load->view('absensor/lihat_unor_absensor',$data);
	}
	function reset_password(){
		$data['satu'] = "Reset Password Pengguna";
		$data['user'] = $this->m_absensor->ini_absensor($this->session->userdata('idu'));
		$sess = $this->session->userdata('logged_in');
		$data['user']->group = $sess['group_name'];
		$data['hal'] = $this->session->userdata('hal');
		$data['cari'] = $this->session->userdata('cari');
		$data['batas'] = 10;
		$data['asal'] = $this->session->userdata('asal');
		$this->load->view('absensor/form_reset_password',$data);
	}
	function reset_password_aksi(){
		$_POST['pw1'] = $this->security->xss_clean($this->input->post('pw1'));
		$_POST['pw2'] = $this->security->xss_clean($this->input->post('pw2'));
		if($_POST['pw1']!="" && $_POST['pw1']==$_POST['pw2']){
			$_POST['user_id'] = $this->session->userdata('idu');
			$this->m_absensor->ganti_password($_POST);
			echo "success";
		} else {
			echo "successv";
		}
	}
}
?>