<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Restore extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->laindb = $this->load->database('lain', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()   {
		$data['satu'] = "Masiv";
		$data['bulan'] = (isset($_POST['nip']))?$_POST['bulan']:1;
		$data['cari'] = (isset($_POST['nip']))?$_POST['nip']:"";
		
//4142,4614,4615,4676
		if(isset($_POST['nip'])){
				$sqlstr="SELECT * FROM tpp_rencana_kerja WHERE nip_baru='".$_POST['nip']."'";
				$data['daftar'] = $this->laindb->query($sqlstr)->result();
				foreach($data['daftar'] AS $key=>$val){
					$sqlstr="SELECT * FROM tpp_realisasi WHERE bulan='".$_POST['bulan']."' AND id_tpp='".$val->id_tpp."'";
					$realisasi = $this->laindb->query($sqlstr)->row();

					$sqlstr="SELECT a.* FROM tpp_rencana_kerja_target a  WHERE a.id_tpp='".$val->id_tpp."'";
					$target = $this->laindb->query($sqlstr)->result();
					foreach($target AS $key2=>$val2){
						$sqlstr2="SELECT a.* FROM tpp_realisasi_target a  WHERE a.id_target='".$val2->id_target."'";
						$rel_target = $this->laindb->query($sqlstr2)->row();
						@$data['daftar'][$key]->target_rel = $rel_target;
					}					
				
					@$data['daftar'][$key]->target = $target;
					@$data['daftar'][$key]->realisasi = $realisasi;
				}
		}

		$this->load->view('restore/index',$data);
	}

	public function restore_tpp(){

		$id_tpp = $_POST['idd'];

		$sqlstr="SELECT * FROM tpp_rencana_kerja_target WHERE id_tpp='$id_tpp'";
		$catatan = $this->laindb->query($sqlstr)->result();
		foreach($catatan AS $key=>$val){
			$this->db->delete('tpp_realisasi_target', array('id_target' => $val->id_target));
			$sql = "INSERT INTO db_apl_bkpp_skp.tpp_realisasi_target  SELECT * FROM db_apl_bkpp_temp.tpp_realisasi_target WHERE id_target='".$val->id_target."'";
			$this->db->query($sql);
		}

		$sqlstr="SELECT * FROM tpp_rencana_kerja_catatan WHERE id_tpp='$id_tpp'";
		$catatan = $this->laindb->query($sqlstr)->result();
		foreach($catatan AS $key=>$val){
			$this->db->delete('tpp_rencana_kerja_jawaban', array('id_catatan' => $val->id_catatan));
			$sql = "INSERT INTO db_apl_bkpp_skp.tpp_rencana_kerja_jawaban  SELECT * FROM db_apl_bkpp_temp.tpp_rencana_kerja_jawaban WHERE id_catatan='".$val->id_catatan."'";
			$this->db->query($sql);
		}

		$sqlstr="SELECT * FROM tpp_realisasi_catatan WHERE id_tpp='$id_tpp'";
		$catatan = $this->laindb->query($sqlstr)->result();
		foreach($catatan AS $key=>$val){
			$this->db->delete('tpp_realisasi_jawaban', array('id_catatan' => $val->id_catatan));
			$sql = "INSERT INTO db_apl_bkpp_skp.tpp_realisasi_jawaban  SELECT * FROM db_apl_bkpp_temp.tpp_realisasi_jawaban WHERE id_catatan='".$val->id_catatan."'";
			$this->db->query($sql);
		}

		$this->db->delete('tpp_rencana_kerja', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_rencana_kerja  SELECT * FROM db_apl_bkpp_temp.tpp_rencana_kerja WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_rencana_kerja_target', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_rencana_kerja_target  SELECT * FROM db_apl_bkpp_temp.tpp_rencana_kerja_target WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_rencana_kerja_acc', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_rencana_kerja_acc  SELECT * FROM db_apl_bkpp_temp.tpp_rencana_kerja_acc WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_rencana_kerja_catatan', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_rencana_kerja_catatan  SELECT * FROM db_apl_bkpp_temp.tpp_rencana_kerja_catatan WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);
		
		$this->db->delete('tpp_tugas_tambahan', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_tugas_tambahan  SELECT * FROM db_apl_bkpp_temp.tpp_tugas_tambahan WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_kreatifitas', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_kreatifitas  SELECT * FROM db_apl_bkpp_temp.tpp_kreatifitas WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_perilaku', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_perilaku  SELECT * FROM db_apl_bkpp_temp.tpp_perilaku WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_realisasi', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_realisasi  SELECT * FROM db_apl_bkpp_temp.tpp_realisasi WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_realisasi_acc', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_realisasi_acc  SELECT * FROM db_apl_bkpp_temp.tpp_realisasi_acc WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);

		$this->db->delete('tpp_realisasi_catatan', array('id_tpp' => $id_tpp));
		$sql = "INSERT INTO db_apl_bkpp_skp.tpp_realisasi_catatan  SELECT * FROM db_apl_bkpp_temp.tpp_realisasi_catatan WHERE id_tpp='$id_tpp'";
		$this->db->query($sql);


		redirect("module/apptukin/restore");
	}


}
?>