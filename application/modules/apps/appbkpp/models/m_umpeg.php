<?php
class M_umpeg extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function ini_user($idd){
		$this->db->from('users a');
		$this->db->join('user_umpeg b','a.user_id=b.user_id');
		$this->db->where('a.user_id',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

    function ini_user_unor($idd){
		$sqlstr="SELECT * FROM r_pegawai_aktual WHERE id_unor IN ($idd) ORDER BY kode_unor ASC";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}

}
