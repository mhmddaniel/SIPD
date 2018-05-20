<?php
class M_diklat extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function get_diklat_struk(){
		$this->db->from('md_diklat_event');
		$this->db->order_by('tmt_diklat','desc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}

    function ini_diklat_struk($idd){
		$this->db->from('md_diklat_event');
		$this->db->where('id_diklat_event',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

    function diklat_struk_tambah_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('md_diklat_event');
	}
    function diklat_struk_edit_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_diklat_event',$isi['id_diklat_event']);
		$this->db->update('md_diklat_event');
	}

    function ini_diklat_struk_peserta($id_diklat_event){
		$this->db->from('md_diklat_peserta');
		$this->db->where('id_diklat_struk',$id_diklat_event);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}




}
