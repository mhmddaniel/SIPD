<?php
class M_artikel_slider extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($idd,$ini){
		$sqlstr3="SELECT a.*,b.nama_item AS nama_kategori, b.id_item AS id_kategori, b.id_parent AS id_kanal 
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON 
		(a.id_kategori=b.id_item AND b.id_setting='6') 
		WHERE a.id_kategori IN ($ini) ORDER BY tanggal DESC,id_konten DESC LIMIT 0,4";
		$hslquery3=$this->db->query($sqlstr3)->result();

		return $hslquery3;
	}

	function cekimage($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='slider'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='6' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
