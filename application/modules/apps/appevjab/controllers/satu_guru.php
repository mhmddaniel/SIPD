<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Satu_guru extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_satu');
		date_default_timezone_set('Asia/Jakarta');
	}

////////////////////////////////////////////////////////
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('satu_guru/index',$data);
	}

	function getdata(){
		$cari = $_POST['cari'];
		$data['count'] = $this->m_satu->hitung_jabatan('jft-guru',$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_jabatan('jft-guru',$mulai,$batas,$cari);

			foreach($data['hslquery'] AS $key=>$val){
				$sql = "SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='jft-guru' AND nomenklatur_jabatan='".$val->nomenklatur_jabatan."'";
				$hsl = $this->db->query($sql)->row();
				@$data['hslquery'][$key]->banyak =$hsl->numrows;
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if

		echo json_encode($data);
	}
	function rincian(){
		$data['idd'] = ($_POST['idd']=="")?"x":$_POST['idd'];
		$data['idc'] = $_POST['idd'];
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('satu_guru/rincian',$data);
	}
	function getrincian(){
		$cari = $_POST['cari'];
		$idd = $_POST['idd'];
		$data['count'] = $this->m_satu->hitung_peg('jft-guru',$cari,$idd);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_peg('jft-guru',$mulai,$batas,$cari,$idd);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if

		echo json_encode($data);
	}
	function kepala_sd(){
		$tanggal = date('Y-m-d');
		$sqlB="SELECT * FROM m_unor WHERE jenis='Sekolah Dasar' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal' ORDER BY kode_unor";
		$data['hslB'] = $this->db->query($sqlB)->result();
		foreach($data['hslB'] AS $key=>$val){
			$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan!='Kepala Sekolah'";
			$hslA=$this->db->query($sqlA)->row();
			$sqlK="SELECT * FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan='Kepala Sekolah'";
			$hslK=$this->db->query($sqlK)->result();
			@$data['hslB'][$key]->banyaknya = $hslA->numrows;
			@$data['hslB'][$key]->pejabat = $hslK;
		}
		$this->load->view('satu_guru/index_sd',$data);
	}
	function kepala_smp(){
		$tanggal = date('Y-m-d');
		$sqlB="SELECT * FROM m_unor WHERE jenis='Sekolah Menengah Pertama' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal' ORDER BY kode_unor";
		$data['hslB'] = $this->db->query($sqlB)->result();
		foreach($data['hslB'] AS $key=>$val){
			$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan!='Kepala Sekolah'";
			$hslA=$this->db->query($sqlA)->row();
			$sqlK="SELECT * FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan='Kepala Sekolah'";
			$hslK=$this->db->query($sqlK)->result();
			@$data['hslB'][$key]->banyaknya = $hslA->numrows;
			@$data['hslB'][$key]->pejabat = $hslK;
		}
		$this->load->view('satu_guru/index_smp',$data);
	}
	function kepala_sma(){
		$tanggal = date('Y-m-d');
		$sqlB="SELECT * FROM m_unor WHERE jenis='Sekolah Menengah Atas' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal' ORDER BY kode_unor";
		$data['hslB'] = $this->db->query($sqlB)->result();
		foreach($data['hslB'] AS $key=>$val){
			$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan!='Kepala Sekolah'";
			$hslA=$this->db->query($sqlA)->row();
			$sqlK="SELECT * FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan='Kepala Sekolah'";
			$hslK=$this->db->query($sqlK)->result();
			@$data['hslB'][$key]->banyaknya = $hslA->numrows;
			@$data['hslB'][$key]->pejabat = $hslK;
		}
		$this->load->view('satu_guru/index_sma',$data);
	}
	function kepala_smk(){
		$tanggal = date('Y-m-d');
		$sqlB="SELECT * FROM m_unor WHERE jenis='Sekolah Menengah Kejuruan' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal' ORDER BY kode_unor";
		$data['hslB'] = $this->db->query($sqlB)->result();
		foreach($data['hslB'] AS $key=>$val){
			$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan!='Kepala Sekolah'";
			$hslA=$this->db->query($sqlA)->row();
			$sqlK="SELECT * FROM r_pegawai_aktual WHERE id_unor='".$val->id_unor."' AND jab_type='jft-guru' AND tugas_tambahan='Kepala Sekolah'";
			$hslK=$this->db->query($sqlK)->result();
			@$data['hslB'][$key]->banyaknya = $hslA->numrows;
			@$data['hslB'][$key]->pejabat = $hslK;
		}
		$this->load->view('satu_guru/index_smk',$data);
	}
	function rincian_sekolah(){
		$data['idd'] = ($_POST['idd']=="")?"x":$_POST['idd'];
		$data['idc'] = $_POST['idd'];
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$sqlA = "SELECT * FROM m_unor WHERE id_unor='".$data['idd']."'";
		$data['unor'] = $this->db->query($sqlA)->row();

		$sql = "SELECT * FROM r_pegawai_aktual WHERE id_unor='".$data['idd']."' AND jab_type='jft-guru' AND tugas_tambahan!='Kepala Sekolah'";
		$data['hsl'] = $this->db->query($sql)->result();


		$this->load->view('satu_guru/rincian_sekolah',$data);
	}

}
?>