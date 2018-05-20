<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Satu_js extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_satu');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}

////////////////////////////////////////////////////////
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$th = $this->session->userdata('tahun');
		$bl = $this->session->userdata('bulan');
		$bulan = (strlen($bl)==1)?"0".$bl:$bl;
		$tanggal = $th."-".$bl."-01";

		$sqlB = "SELECT DISTINCT jenis FROM m_unor WHERE tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal' AND kode_ese IN ('21','22','31','32','41','42','51','52')";
		$data['hslB'] = $this->db->query($sqlB)->result();

		$this->load->view('satu_js/index',$data);
	}
	function getdata(){
		$ese = $this->dropdowns->kode_ese();
		$no = 0;
		$data['mulai'] = 1; 
		foreach($ese AS $key=>$val){
			if($key!="" && $key!=99){	


				$sess = $this->session->userdata('logged_in');
				if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
							$tanggal = date('Y-m-d');
							$this->load->model('appbkpp/m_umpeg');
							$user_id = $this->session->userdata('user_id');
							$user = $this->m_umpeg->ini_user($user_id);
								$dd=array("{","}");
							$unor=  str_replace($dd,"",$user->unor_akses);
		
							$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='js' AND kode_ese='$key' AND id_unor IN ($unor)";
							$hslA=$this->db->query($sqlA)->row();
							$sqlB="SELECT COUNT(id_unor) AS numrows FROM m_unor WHERE kode_ese='$key' AND id_unor IN ($unor) AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
							$hslB=$this->db->query($sqlB)->row();
				} else {
							$th = $this->session->userdata('tahun');
							$bl = $this->session->userdata('bulan');
							$bulan = (strlen($bl)==1)?"0".$bl:$bl;
							$tanggal = $th."-".$bl."-01";
							$sqlA="SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE status_kepegawaian='pns' AND jab_type='js' AND kode_ese='$key'";
							$hslA=$this->db->query($sqlA)->row();
							$sqlB="SELECT COUNT(id_unor) AS numrows FROM m_unor WHERE kode_ese='$key' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
							$hslB=$this->db->query($sqlB)->row();
				}

				@$data['hslquery'][$no]->kode = $key; 
				@$data['hslquery'][$no]->nama = $val; 
				@$data['hslquery'][$no]->banyak_pegawai = $hslA->numrows; 
				@$data['hslquery'][$no]->banyak_jabatan = $hslB->numrows; 
				@$data['hslquery'][$no]->selisih = (($hslB->numrows-$hslA->numrows)>0)?" <div class='btn btn-warning btn-sm' onclick=\"detil4(".$key.",'appevjab/satu_js/rincian_kosong','ya'); return false;\">".($hslB->numrows-$hslA->numrows)."</div>":"..."; 
				$no++;
			}
		}
		echo json_encode($data);
	}
	function rincian(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$ese = $this->dropdowns->kode_ese();
		$data['idd'] = $ese[$_POST['idd']];
		$data['idc'] = $_POST['idd'];
		
		$this->load->view('satu_js/rincian',$data);
	}


	function getrincian(){
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):date("Y-m-d");
		$ese=$_POST['idd'];

		$batas = $_POST['batas'];
		$cari = $_POST['cari'];
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
					$this->load->model('appbkpp/m_umpeg');
					$user_id = $this->session->userdata('user_id');
					$user = $this->m_umpeg->ini_user($user_id);
						$dd=array("{","}");
					$unor =  str_replace($dd,"",$user->unor_akses);
		} else {
					$unor =  "";
		}

		$data['count'] = $this->m_unor->hitung_master_unor($cari,$tanggal,$ese,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese,$unor);
				foreach($data['hslquery'] AS $ky=>$vl){
					$pejabat = $this->m_unor->get_pejabat($vl->id_unor,$vl->kode_ese,$vl->tugas_tambahan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$ky]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$ky]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$ky]->pejabat[$key]['nip_baru'] = $val->nip_baru;
						$data['hslquery'][$ky]->pejabat[$key]['nama_pangkat'] = $val->nama_pangkat;
						$data['hslquery'][$ky]->pejabat[$key]['nama_golongan'] = $val->nama_golongan;
						$data['hslquery'][$ky]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_jabatan'] = date("d-m-Y", strtotime($val->tmt_jabatan));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	function rincian_isi(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$ese = $this->dropdowns->kode_ese();
		$data['idd'] = $ese[$_POST['idd']];
		$data['idc'] = $_POST['idd'];
		
		$this->load->view('satu_js/rincian_isi',$data);
	}
	function getrincian_isi(){
//		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):date("Y-m-d");
		$ese=$_POST['idd'];

		$batas = $_POST['batas'];
		$cari = $_POST['cari'];
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
					$this->load->model('appbkpp/m_umpeg');
					$user_id = $this->session->userdata('user_id');
					$user = $this->m_umpeg->ini_user($user_id);
						$dd=array("{","}");
					$unor =  str_replace($dd,"",$user->unor_akses);
		} else {
					$unor =  "";
		}
		$data['count'] = $this->m_satu->hitung_peg_js("js",$cari,$ese,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_satu->get_peg_js("js",$mulai,$batas,$cari,$ese,$unor);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function rincian_kosong(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:25;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$ese = $this->dropdowns->kode_ese();
		$data['idd'] = $ese[$_POST['idd']];
		$data['idc'] = $_POST['idd'];
		
		$this->load->view('satu_js/rincian_kosong',$data);
	}
	function getrincian_kosong(){
//		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):date("Y-m-d");

							$th = $this->session->userdata('tahun');
							$bl = $this->session->userdata('bulan');
							$bulan = (strlen($bl)==1)?"0".$bl:$bl;
							$tanggal = $th."-".$bl."-01";

		$ese=$_POST['idd'];

		$batas = $_POST['batas'];
		$cari = $_POST['cari'];
		$sess = $this->session->userdata('logged_in');
		if($sess['group_name']=="pengelola" || $sess['group_name']=="evjab_umpeg"){
					$this->load->model('appbkpp/m_umpeg');
					$user_id = $this->session->userdata('user_id');
					$user = $this->m_umpeg->ini_user($user_id);
						$dd=array("{","}");
					$unor =  str_replace($dd,"",$user->unor_akses);
		} else {
					$unor =  "";
		}
		$data['count'] = $this->m_unor->hitung_kosong_unor($cari,$tanggal,$ese,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_kosong_unor($cari,$mulai,$batas,$tanggal,$ese,$unor);
				foreach($data['hslquery'] AS $ky=>$vl){
					$pejabat = $this->m_unor->get_pejabat($vl->id_unor,$vl->kode_ese,$vl->tugas_tambahan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$ky]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$ky]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$ky]->pejabat[$key]['nip_baru'] = $val->nip_baru;
						$data['hslquery'][$ky]->pejabat[$key]['nama_pangkat'] = $val->nama_pangkat;
						$data['hslquery'][$ky]->pejabat[$key]['nama_golongan'] = $val->nama_golongan;
						$data['hslquery'][$ky]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_jabatan'] = date("d-m-Y", strtotime($val->tmt_jabatan));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}
				}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

}
?>