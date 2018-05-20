<?php

class Login extends MX_Controller {



	function __construct(){

		parent::__construct();

		$this->load->model('m_web');

	}

/////////////////////////////////////////////////////////

	public function index(){

		$snx = (date('n')*2678407)+(date('d')*86403)+(date('H')*3600)+(date('i')*60)+date('s');

		$inx = sha1(($snx+114)."sentul");

		if(!isset($_GET['ind'])){

			redirect(site_url('login?ind=bkpsdm2017'));

		} else {

				$session_data = $this->session->userdata('logged_in');

				$data['sesi'] = $session_data['back_office'];

				

				if(!empty($data['sesi'])){ redirect($data['sesi']);	}

		

				$data['nama_app']=$this->m_web->getopsivalue('nama_app');

				$data['slogan_app']=$this->m_web->getopsivalue('slogan_app');

				$data['logo_app']=$this->m_web->getopsivalue('logo_app');

				$data['ind'] = $inx;

				$data['ccn'] = $snx;

				$data['aksi'] = ($_GET['ind']=="hj")?"sama":"dologin";

		

				$this->viewPath = '../../assets/themes/login/';

				$this->load->view($this->viewPath.'index',$data);

		}

	}

/////////////////////////////////////////////////////////

	public function dologin(){

		$this->load->library('auth/auth');

		$this->form_validation->set_rules('ibuku_sayang',"Nama User",'trim|required');

		$this->form_validation->set_rules('sendok',"Password",'trim|required');

		$user_name = $_POST['user_name'];

		$user_password = $_POST['user_password'];

		if($this->form_validation->run() == false || $user_name!="" || $user_password!=""){

				$responce = array('result'=>'failed','message'=>'Username dan Password harus diisi');

		} else {

				$ccv = (isset($_POST['ccn']))?($_POST['ccn']+114)."sentul":"dd";

				$ccg = sha1($ccv);

				$snx = (date('n')*2678407)+(date('d')*86403)+(date('H')*3600)+(date('i')*60)+date('s');

				$snq = (date('n')*2678407)+(date('d')*86403)+(date('H')*3600)+((date('i')*60)-120)+date('s');



				if(isset($_POST['ind']) && isset($_POST['ccn']) && $ccg==$_POST['ind'] && $_POST['ccn']<$snx && $_POST['ccn']>$snq){

							$this->load->library('auth');	

							$datalogin = array(

								'user_name'=>$this->input->post('ibuku_sayang'),

								'user_password'=>$this->input->post('sendok')

							);

							if($this->auth->process_login($datalogin)==FALSE){  

								$responce = array('result'=>'failed','message'=>'Username atau Password yang anda masukkan salah ');

							} else {		

								$session_data = $this->session->userdata('logged_in');

								$responce = array('result'=>'succes','message'=>'Login anda diterima. Mohon menunggu..','section'=>'admin');

							}

				} else {

							$responce = array('result'=>'failed','message'=>'Form Login sudah kadaluarsa, harap di-<a href="'.site_url().'login">REFRESH</a> ');

				}

		}

		echo json_encode($responce);

	}

/////////////////////////////////////////////////////////

	public function keepalive(){

		echo 'OK';

	}

/////////////////////////////////////////////////////////

	public function out(){

		$session_data = $this->session->userdata('logged_in');

		$this->db->delete('user_online',array('user_id'=>@$session_data['id_user']));

		$this->session->sess_destroy();

		echo "<script type=\"text/javascript\">location.href = '".site_url()."' + 'login'; </script>";

	}

/////////////////////////////////////////////////////////

	public function sama(){

		$this->load->library('auth/auth_sama');

		$this->form_validation->set_rules('ibuku_sayang',"Nama User",'trim|required');

		$this->form_validation->set_rules('sendok',"Password",'trim|required');

		$user_name = $_POST['user_name'];

		$user_password = $_POST['user_password'];

		if($this->form_validation->run() == false || $user_name!="" || $user_password!=""){

				$responce = array('result'=>'failed','message'=>'Username dan Password harus diisi');

		} else {

				$ccv = (isset($_POST['ccn']))?($_POST['ccn']+114)."sentul":"dd";

				$ccg = sha1($ccv);

				$snx = (date('n')*2678407)+(date('d')*86403)+(date('H')*3600)+(date('i')*60)+date('s');

				$snq = (date('n')*2678407)+(date('d')*86403)+(date('H')*3600)+((date('i')*60)-120)+date('s');



				if(isset($_POST['ind']) && isset($_POST['ccn']) && $ccg==$_POST['ind'] && $_POST['ccn']<$snx && $_POST['ccn']>$snq){

							$this->load->library('auth/auth_sama');	

							$datalogin = array(

								'user_name'=>$this->input->post('ibuku_sayang'),

								'user_password'=>$this->input->post('sendok')

							);

							if($this->auth_sama->process_login($datalogin)==FALSE){  

								$responce = array('result'=>'failed','message'=>'Username atau Password yang anda masukkan salah ');

							} else {		

								$session_data = $this->session->userdata('logged_in');

								$responce = array('result'=>'succes','message'=>'Login anda diterima. Mohon menunggu..','section'=>'admin');

							}

				} else {

							$responce = array('result'=>'failed','message'=>'Form Login sudah kadaluarsa, harap di-<a href="'.site_url().'login">REFRESH</a> ');

				}

		}

		echo json_encode($responce);

	}

/////////////////////////////////////////////////////////

}



