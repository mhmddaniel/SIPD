<?php
class Dokumen extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
	}

	public function index(){ 
		$sq = "SELECT * FROM yy_20171009_penataan_arsip";
		$qr = $this->db->query($sq)->result();

		foreach($qr AS $key=>$val){


			$sq1 = "SELECT COUNT(id_dokumen) AS jml FROM r_peg_dokumen WHERE nip_baru='".$val->nip_baru."'";
			$qr1 = $this->db->query($sq1)->row();
			$jmlh = $qr1->jml;

			$this->db->where('nip_baru',$val->nip_baru);
			$this->db->set('keterangan',$jmlh);
			$this->db->update('yy_20171009_penataan_arsip');


			$path2="assets/media/file/".$val->nip_baru."/";
			if(file_exists($path2)){	
				echo $val->nip_baru."<br>";
			}
		}

	}

	public function impor(){ 
		echo "Honda";

/*
		$this->db->query("TRUNCATE TABLE xx_local_r_peg_dokumen");


		$sql = "SELECT nip_baru FROM r_pegawai_aktual WHERE status_kepegawaian='pns'";
		$qry = $this->db->query($sql)->result();
		
		foreach($qry AS $key=>$val){


			$sq = "SELECT * FROM xx_20171009_penataan_arsip WHERE nip_baru='".$val->nip_baru."'";
			$qr = $this->db->query($sq)->row();

			if(empty($qr)){

				$sn = "SELECT COUNT(id_dokumen) AS jml FROM r_peg_dokumen WHERE nip_baru='".$val->nip_baru."'";
				$qn = $this->db->query($sn)->row();


				$this->db->set('nip_baru',$val->nip_baru);
				$this->db->set('halaman_item_dokumen',$qn->jml);
				$this->db->insert('xx_local_r_peg_dokumen');
			}

		}
*/

	}
/////////////////////////////////////////////////////////////////////////////////	
}