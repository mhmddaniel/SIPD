<?php
class Mapi_pegawai extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function get_pegawai(){
		$sqlstr="SELECT a.*
		FROM r_pegawai a
		WHERE a.status_kepegawaian='pns'
		LIMIT 10
		";
		$query = $this->db->query($sqlstr)->result(); 
		return $query;
	}



}
