<?php
class M_diklat extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function get_diklat_struk(){
		$this->db->from('p_diklat_struk');
		$this->db->order_by('tmt_diklat','desc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}

    function ini_diklat_struk($idd){
		$this->db->from('p_diklat_struk');
		$this->db->where('id_diklat_struk',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

    function diklat_struk_tambah_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('p_diklat_struk');
	}
    function diklat_struk_edit_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_diklat_struk',$isi['id_diklat_struk']);
		$this->db->update('p_diklat_struk');
	}

    function ini_diklat_struk_peserta($id_diklat_struk){
		$this->db->from('r_peg_diklat_struk');
		$this->db->where('id_diklat_struk',$id_diklat_struk);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}




}
