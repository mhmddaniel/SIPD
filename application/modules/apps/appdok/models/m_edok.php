<?php
class M_edok extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai($idpeg){
		$this->db->from('r_pegawai_aktual');
		$this->db->where('id_pegawai',$idpeg);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function ini_pendidikan($idd){
		$this->db->from('r_peg_pendidikan');
		$this->db->where('id_peg_pendidikan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
	function ini_cpns($idd){
		$this->db->from('r_peg_cpns');
		$this->db->where('id',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}
//////////////////////////////////////////////////////////////////////////////////
	function cek_dokumen($nip_baru,$tipe,$idd){
		$this->db->from('r_peg_dokumen');
		$this->db->where('nip_baru',$nip_baru);
		$this->db->where('tipe_dokumen',$tipe);
		if($tipe!="pasfoto"){
		$this->db->where('id_reff',$idd);
		}
		$this->db->order_by('halaman_item_dokumen','ASC');
		$hslquery = $this->db->get()->result();
		return $hslquery;	
	}
	function cek_dokumen_satu($nip_baru,$tipe,$idd,$hal){
		$this->db->from('r_peg_dokumen');
		$this->db->where('nip_baru',$nip_baru);
		$this->db->where('tipe_dokumen',$tipe);
		$this->db->where('halaman_item_dokumen',$hal);
		if($tipe!="pasfoto"){
		$this->db->where('id_reff',$idd);
		}
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}

	function simpan_dokumen($nip_baru,$nama_file,$tipe,$idd){
		$sess = $this->session->userdata('logged_in');
		$ini = $this->cek_dokumen($nip_baru,$tipe,$idd);
		$hal = count($ini)+1;
			$this->db->set('nip_baru',$nip_baru);
			$this->db->set('tipe_dokumen',$tipe);
			$this->db->set('file_dokumen',$nama_file);
			$this->db->set('halaman_item_dokumen',$hal);
			$this->db->set('id_reff',$idd);
			$this->db->set('user_id',$sess['id_user']);
			$this->db->set('log_aksi',"NOW()",false);
			$this->db->insert('r_peg_dokumen');
			$id_dok = $this->db->insert_id();
			return $id_dok;
/*
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_thumb,file_dokumen,halaman_item_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$hal','$idd')";		
			$this->db->query($sqlstr);
*/
	}

	function rename_dokumen($idd,$nama){
		$this->db->set('file_dokumen',$nama);
		$this->db->where('id_dokumen',$idd);
		$this->db->update('r_peg_dokumen');
	}
	function ini_dokumen($idd){
		$this->db->from('r_peg_dokumen');
		$this->db->where('id_dokumen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function hapus_dokumen($idd,$id_peg,$komponen,$id_reff){
		$this->db->delete('r_peg_dokumen', array('id_dokumen' => $idd));
		
		$dok = $this->cek_dokumen($id_peg,$komponen,$id_reff);
		foreach($dok AS $key=>$val){
			$sqlstr="UPDATE r_peg_dokumen SET halaman_item_dokumen='".($key+1)."' WHERE id_dokumen='".$val->id_dokumen."'";		
			$this->db->query($sqlstr);
		}
		return $dok;
	}

	function edit_keterangan_dokumen($isi){
		$this->db->set('keterangan',$isi['keterangan']);
		$this->db->set('sub_keterangan',$isi['sub_keterangan']);
		$this->db->where('id_dokumen',$isi['idd']);
		$this->db->update('r_peg_dokumen');
	}

	function cek_pasfoto($nip_baru){
		$this->db->from('r_peg_dokumen');
		$this->db->where('nip_baru',$nip_baru);
		$this->db->where('tipe_dokumen','pasfoto');
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}

	function cek_foto_lama($idd){
		$this->db->from('r_peg_foto');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;	
	}


	function simpan_pasfoto($nip_baru,$nama_file,$tipe,$idd){
		$ini = $this->cek_pasfoto($nip_baru);
		if(empty($ini)){
			$sqlstr="INSERT INTO r_peg_dokumen (nip_baru,tipe_dokumen,file_dokumen,id_reff) 
			VALUES ('$nip_baru','$tipe','thumb_".$nama_file."','$nama_file','$idd')";		
			$this->db->query($sqlstr);
		} else {
			$sqlstr="UPDATE r_peg_dokumen SET file_dokumen='$nama_file' WHERE nip_baru='$nip_baru' AND tipe_dokumen='$tipe'";		
			$this->db->query($sqlstr);
		}
	}

}
