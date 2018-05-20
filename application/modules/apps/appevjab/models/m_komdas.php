<?php
class M_komdas extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////
	function ini_rekomendasi($idd){
		$sqlstr="SELECT a.* FROM r_peg_rekomendasi a WHERE a.id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();

		if(empty($hslquery)){
			$this->db->set('id_pegawai',$idd);
			$this->db->insert('r_peg_rekomendasi');

			$sqlstr="SELECT a.* FROM r_peg_rekomendasi a WHERE a.id_pegawai='$idd'";
			$hslquery=$this->db->query($sqlstr)->row();
		}
		return $hslquery;
	}
	function edit_rekomendasi($isi){
		$this->db->set('rekomendasi',$isi['rekomendasi']);
		$this->db->where('id_peg_rekomendasi',$isi['idd']);
		$this->db->update('r_peg_rekomendasi');
	}


	function ini_tik($idd){
		$sqlstr="SELECT a.* FROM r_peg_kpt_tik a WHERE a.id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();

		if(empty($hslquery)){
			$this->db->set('id_pegawai',$idd);
			$this->db->insert('r_peg_kpt_tik');

			$sqlstr="SELECT a.* FROM r_peg_kpt_tik a WHERE a.id_pegawai='$idd'";
			$hslquery=$this->db->query($sqlstr)->row();
		}
		return $hslquery;
	}

	function edit_tik($isi){
		$sqlstr="SELECT a.* FROM r_peg_kpt_tik a WHERE a.id_peg_komputer='".$isi['idd']."'";
		$hslquery=$this->db->query($sqlstr)->row();
		
		$vr = $isi['jenis'];
		$vrr = json_decode(@$hslquery->$vr);
		$pg = @$vrr->pg;
		$pn = @$vrr->pn;
		$nll = ($isi['nl']=="hpp")?"":$isi['nl'];
		
		if($isi['kol']=="pg"){
			$baru = "{\"pg\":\"".$nll."\",\"pn\":\"".$pn."\"}";
		} else {
			$baru = "{\"pg\":\"".$pg."\",\"pn\":\"".$nll."\"}";
		}

		$this->db->set($vr,$baru);
		$this->db->where('id_peg_komputer',$isi['idd']);
		$this->db->update('r_peg_kpt_tik');
	}



	function ini_inggris($idd){
		$sqlstr="SELECT a.* FROM r_peg_kpt_inggris a WHERE a.id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();

		if(empty($hslquery)){
			$this->db->set('id_pegawai',$idd);
			$this->db->insert('r_peg_kpt_inggris');

			$sqlstr="SELECT a.* FROM r_peg_kpt_inggris a WHERE a.id_pegawai='$idd'";
			$hslquery=$this->db->query($sqlstr)->row();
		}
		return $hslquery;
	}

	function edit_inggris($isi){
		$sqlstr="SELECT a.* FROM r_peg_kpt_inggris a WHERE a.id_peg_inggris='".$isi['idd']."'";
		$hslquery=$this->db->query($sqlstr)->row();
		
		$vr = $isi['jenis'];
		$vrr = json_decode(@$hslquery->$vr);
		$pg = @$vrr->pg;
		$pn = @$vrr->pn;
		$nll = ($isi['nl']=="hpp")?"":$isi['nl'];
		
		if($isi['kol']=="pg"){
			$baru = "{\"pg\":\"".$nll."\",\"pn\":\"".$pn."\"}";
		} else {
			$baru = "{\"pg\":\"".$pg."\",\"pn\":\"".$nll."\"}";
		}

		$this->db->set($vr,$baru);
		$this->db->where('id_peg_inggris',$isi['idd']);
		$this->db->update('r_peg_kpt_inggris');
	}

}
