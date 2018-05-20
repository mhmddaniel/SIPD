<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Peralihan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		echo "<br><br>";
		$sqlstr="SELECT a.nip_pegawai,a.no_sk,a.tgl_sk,b.*
		FROM sk_peralihan_propinsi a 
		LEFT JOIN r_pegawai b ON (a.nip_pegawai=b.nip_baru)
		";
		$query = $this->db->query($sqlstr)->result(); 

		foreach($query AS $key=>$val){
			$sql="SELECT a.* FROM r_peg_jab a WHERE a.id_pegawai='".$val->id_pegawai."' ORDER BY a.tmt_jabatan DESC LIMIT 1";
			$qry = $this->db->query($sql)->row(); 

			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('nip_baru',$val->nip_pegawai);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('instansi_tujuan','Propinsi Banten');
			$this->db->set('tanggal_keluar','2017-01-01');
			$this->db->set('no_sk',$val->no_sk);
			$this->db->set('tanggal_sk',$val->tgl_sk);
			$this->db->insert('r_pegawai_keluar');

			echo ($key+1).". ".$val->nip_baru." :: ".$val->nama_pegawai." :: ".$qry->nomenklatur_pada."<br>";
		}
	}
	function reff_jabatan(){
		$sqlstr="SELECT a.id,b.id_peg_jab, c.nip_baru
		FROM r_pegawai_bulanan a 
		LEFT JOIN r_pegawai c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN r_peg_jab b ON (a.id_pegawai=b.id_pegawai AND a.tmt_jabatan=b.tmt_jabatan)
		WHERE a.status_kepegawaian='pns'";
		$query = $this->db->query($sqlstr)->result(); 

		foreach($query AS $key=>$val){
			if($val->id_peg_jab!=""){
				$sqA = "UPDATE r_pegawai_bulanan SET reff_jabatan=".$val->id_peg_jab." WHERE id='".$val->id."'";
				$qrA = $this->db->query($sqA);
			}
//			echo $val->id." :: ".$val->nip_baru." :: ".$val->id_peg_jab."<br>";
		}

		echo "ya";
	}


}
?>