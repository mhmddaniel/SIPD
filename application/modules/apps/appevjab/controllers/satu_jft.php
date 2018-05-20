<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Satu_jft extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_satu');
	}

////////////////////////////////////////////////////////
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('satu_jft/index',$data);
	}

	function getdata(){
		$cari = $_POST['cari'];
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
					$this->load->model('appbkpp/m_umpeg');
					$user_id = $this->session->userdata('user_id');
					$user = $this->m_umpeg->ini_user($user_id);
						$dd=array("{","}");
					$unor =  str_replace($dd,"",$user->unor_akses);
		} else {
					$unor =  "";
		}
		$iUnor = ($unor=="")?"":"AND id_unor IN ($unor)";
		$data['count'] = $this->m_satu->hitung_jabatan('jft',$cari,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_jabatan('jft',$mulai,$batas,$cari,$unor);

			foreach($data['hslquery'] AS $key=>$val){
				$sql = "SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='jft' $iUnor AND nomenklatur_jabatan='".$val->nomenklatur_jabatan."'";
				$hsl = $this->db->query($sql)->row();
				@$data['hslquery'][$key]->banyak =$hsl->numrows;
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if

		echo json_encode($data);
	}
	function rincian(){
		$data['idd'] = ($_POST['idd']=="")?"x":$_POST['idd'];
		$data['idc'] = $_POST['idd'];
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('satu_jft/rincian',$data);
	}
	function getrincian(){
		$cari = $_POST['cari'];
		$idd = $_POST['idd'];
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
					$this->load->model('appbkpp/m_umpeg');
					$user_id = $this->session->userdata('user_id');
					$user = $this->m_umpeg->ini_user($user_id);
						$dd=array("{","}");
					$unor =  str_replace($dd,"",$user->unor_akses);
		} else {
					$unor =  "";
		}
		$data['count'] = $this->m_satu->hitung_peg('jft',$cari,$idd,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_peg('jft',$mulai,$batas,$cari,$idd,$unor);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if
		echo json_encode($data);
	}
}
?>