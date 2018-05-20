<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Dansec {

	function __construct() {
		date_default_timezone_set('Asia/Jakarta');
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->helper('url');
	}

//////////////////////////////////////////////////
// htmlReq() untuk memeriksa requaest html ajax atau bukan
// kalo bukan ajax :	1. Session user dihapus
	function htmlReq(){
		if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				$session_data = $this->CI->session->userdata('logged_in');
				$this->CI->db->delete('user_online',array('user_id'=>@$session_data['id_user']));
				$this->CI->session->sess_destroy();
				redirect(site_url('login'));
				exit();
		}
	}

//////////////////////////////////////////////////
// setToken() untuk generate token yang siap dipasang di form-form aplikasi
	function setToken($kustom=FALSE){
		$waktu = date('i');
		$token = (!($kustom))?sha1($waktu):sha1($waktu.$kustom); // generate token
		$this->CI->session->set_userdata('token_form',$token); // simpan token ke session
		return $token;
	}
// cekToken() untuk mencocokkan token dari form dan token di session
	function cekToken($token){
		$sesToken = $this->CI->session->userdata('token_form'); // ambil session token_form
		$this->CI->session->set_userdata('token_form',""); // kosongkan session token_form, supaya token hanya bisa dipakai 1x
		if($token==$sesToken){
			return TRUE;
		} else {
			return FALSE;
		}
	}


}
?>