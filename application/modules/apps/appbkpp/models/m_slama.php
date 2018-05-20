<?php
class M_slama extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function get_unor($idAt,$idp,$st=0,$kd=""){
		$this->db->select('*');
		$this->db->from('m_unorlama');
		$this->db->where('id_aturan_skpd',$idAt);
		$this->db->where('id_parent',$idp);
		$this->db->where('kode_unor !=','');
		$this->db->order_by('kode_unor','ASC');
		$unori = $this->db->get()->result();
		
		$unoric=array();
		foreach($unori AS $key=>$val){
			$unoric[$st] = $unori[$key];
			$st++;

					$anak = $this->get_unor($idAt,$val->id_jabatan,$st);
					foreach($anak AS $key2=>$val){
						$unoric[$st] = $anak[$key2];
						$st++;
					}
		}

		return $unoric;
	}

    function get_unor_ASLI($idAt,$idp,$st=0,$kd=""){
		$this->db->select('*');
		$this->db->from('m_unorlama');
		$this->db->where('id_aturan_skpd',$idAt);
		$this->db->where('id_parent',$idp);
		$this->db->order_by('kode_unor','ASC');
		$this->db->order_by('urutan','ASC');
		$unori = $this->db->get()->result();
		
		$unoric=array();
		$ku = ($st==0)?"":"- ";
		foreach($unori AS $key=>$val){
			$unoric[$st] = $unori[$key];
			$unoric[$st]->ku = $ku;
			$ns = ($idp==0)?$val->kode_unor:$kd;
			$ky = ($key<9)?"0".($key+1):($key+1);
			$nb = ($kd=="")?$ns:$ns.".".$ky;
			$unoric[$st]->kd = $nb;
//			$this->edit_kode($val->id_unor,$nb);
			$st++;

					$anak = $this->get_unor($idAt,$val->id_jabatan,$st,$nb);
					foreach($anak AS $key2=>$val){
						$unoric[$st] = $anak[$key2];
						$unoric[$st]->ku = $ku.$unoric[$st]->ku;
						$st++;
					}
		}

		return $unoric;
	}

//SELECT * FROM `m_unorlama` WHERE id_aturan_skpd='4' AND id_parent='0' ORDER BY urutan;

    function edit_kode($idd,$kdd){
		$this->db->set('kode_unor',$kdd);
		$this->db->where('id_unor',$idd);
		$this->db->update('m_unorlama');
	}




	function gettree($kode,$lgh,$tanggal,$st=0){
		$iKode = ($kode==0)?"":"AND a.kode_unor LIKE '$kode%'";
		$sqlstr="SELECT a.* 
		FROM (m_unor a)
		WHERE CHAR_LENGTH(a.kode_unor) = $lgh
		AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'
		$iKode
		ORDER BY a.kode_unor asc
		";
		$res = $this->db->query($sqlstr)->result(); 



/*
		$unoric=array();
		foreach($res AS $key=>$val){
			$unoric[$st] = $res[$key];

			$this->db->set('status','1');
			$this->db->where('id_unor',$val->id_unor);
			$this->db->update('m_unor');
			$st++;
			$lgt=$lgh+3;

					$anak = $this->gettree($val->kode_unor,$lgt,$tanggal,$st);
					foreach($anak AS $key2=>$val){
						$unoric[$st] = $anak[$key2];
						$st++;
					}
		}
		return $unoric;

*/




		return $res;
	}



//SELECT * FROM m_unor WHERE tmt_berlaku<='2015-09-12' AND tst_berlaku>='2015-09-12' AND status='0';









}
