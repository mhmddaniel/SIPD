<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sakit extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Ijin Sakit"; 
		$this->load->view('sakit/index',$data);
	}

	function hitung_masuk(){
		$j_masuk = $_POST['j_masuk'];
		$a_masuk = $_POST['a_masuk'];

		$jj_masuk = explode(":",$j_masuk);
		$n_masuk = (3600*$jj_masuk[0])+(60*$jj_masuk[1])+$jj_masuk[2];

		$aa_masuk = explode(":",$a_masuk);
		$m_masuk = (3600*$aa_masuk[0])+(60*$aa_masuk[1])+$aa_masuk[2];


		$jn = $n_masuk-$m_masuk;
		if($jn<0){
			if($jn<(-36000)){
				$jb = ($m_masuk-86400)-$n_masuk;
			} else {
				$jb = -$jn;
			}
		} else {
			$jb = -$jn;
		}
		
		$jk = abs($jb);
		$jam =  floor($jk/3600);
		$menit = floor(($jk-($jam*3600))/60);
		$detik = $jk-(($jam*3600)+($menit*60));

		if($jb>0){
			echo $jam.":".$menit.":".$detik." (TELAT MASUK)<br>";
		} else {
			echo $jam.":".$menit.":".$detik;
		}
	}

	function hitung_pulang(){
		$j_pulang = $_POST['j_pulang'];
		$a_pulang = $_POST['a_pulang'];

		$jj_pulang = explode(":",$j_pulang);
		$n_pulang = (3600*$jj_pulang[0])+(60*$jj_pulang[1])+$jj_pulang[2];

		$aa_pulang = explode(":",$a_pulang);
		$m_pulang = (3600*$aa_pulang[0])+(60*$aa_pulang[1])+$aa_pulang[2];


		$jn = $m_pulang-$n_pulang;
		if($jn<0){
			if($jn<(-36000)){
				$jb = -(86400-$n_pulang)-$m_pulang;
			} else {
				$jb = -$jn;
			}
		} else {
			if($jn>36000){
				$jb = $n_pulang+(86400-$m_pulang);
			} else {
				$jb = -$jn;
			}
		}
		
		$jk = abs($jb);
		$jam =  floor($jk/3600);
		$menit = floor(($jk-($jam*3600))/60);
		$detik = $jk-(($jam*3600)+($menit*60));


		if($jb>0){
			echo $jam.":".$menit.":".$detik." (CEPAT PULANG)<br>";
		} else {
			echo $jam.":".$menit.":".$detik;
		}


	}
	

}
?>