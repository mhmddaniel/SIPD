<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pejabat extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		date_default_timezone_set('Asia/Jakarta');
	}


	function index(){
		$data['satu'] = "Daftar Pemangku Jabatan";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$data['ese'] = $this->dropdowns->kode_ese();
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";

		$this->load->view('pejabat/index',$data);
	}
	function getdata(){
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$ese=$_POST['ese'];


		$cari = $_POST['cari'];
		$data['count'] = $this->m_unor->hitung_master_unor($cari,$tanggal,$ese);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese);
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

	function tree(){
		$data['satu']="Daftar Pemangku Jabatan";
		$sess = $this->session->userdata('logged_in');
		$data['master'] = ($sess['group_name']=="admin")?"ya":"tidak";
		$this->load->view('pejabat/tree',$data);
	}

	function gettree(){
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));

		$level=($_POST['level']+1);
		$spare=3+(($level*20)-20);
		$lgh=5+(($level*3)-3);
		$id_parentts = explode("_",$_POST['id_parent']);	
		$id_parent = end($id_parentts);	

		$iUnor = $this->m_unor->ini_unor($id_parent);
		$uUnor = ($_POST['id_parent']==0)?0:$iUnor->kode_unor;
		$data['hslquery'] = $this->m_unor->gettree($uUnor,$lgh,$tanggal);

		foreach($data['hslquery'] as $it=>$val){
			$id=$data['hslquery'][$it]->id_unor;
			$data['hslquery'][$it]->idparent=$_POST['id_parent'];	
			$data['hslquery'][$it]->spare=$spare;	
			$data['hslquery'][$it]->level=$level;
				$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
				$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
				$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;



					$pejabat = $this->m_unor->get_pejabat($val->id_unor,$val->kode_ese,$val->tugas_tambahan);
					foreach($pejabat AS $key=>$vl){
						$data['hslquery'][$it]->pejabat[$key]['id_pegawai'] = $vl->id_pegawai;
						$data['hslquery'][$it]->pejabat[$key]['nama_pegawai'] = ((trim($vl->gelar_depan) != '-')?trim($vl->gelar_depan).' ':'').((trim($vl->gelar_nonakademis) != '-')?trim($vl->gelar_nonakademis).' ':'').$vl->nama_pegawai.((trim($vl->gelar_belakang) != '-')?', '.trim($vl->gelar_belakang):'');
						$data['hslquery'][$it]->pejabat[$key]['nip_baru'] = $vl->nip_baru;
						$data['hslquery'][$it]->pejabat[$key]['nama_pangkat'] = $vl->nama_pangkat;
						$data['hslquery'][$it]->pejabat[$key]['nama_golongan'] = $vl->nama_golongan;
						$data['hslquery'][$it]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($vl->tmt_pangkat));
						$data['hslquery'][$it]->pejabat[$key]['tmt_jabatan'] = date("d-m-Y", strtotime($vl->tmt_jabatan));
						$data['hslquery'][$it]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($vl->tmt_ese));
					}

		}
		$data['mulai'] = 1;
		$data['pager'] = "";
		echo json_encode($data);
	}

	function kosong(){
		$data['satu'] = "Daftar Pemangku Jabatan";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('pejabat/kosong',$data);
	}

	function getkosong(){
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";

		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";


		$cari = $_POST['cari'];
		$data['count'] = $this->m_unor->hitung_kosong_unor($cari,$tanggal);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_kosong_unor($cari,$mulai,$batas,$tanggal);
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

	function rangkap(){
		$data['satu'] = "Daftar Pemangku Jabatan";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('pejabat/rangkap',$data);
	}

	function getrangkap(){
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";

		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";


		$cari = $_POST['cari'];
		$data['count'] = $this->m_unor->hitung_rangkap_unor($cari,$tanggal);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_rangkap_unor($cari,$mulai,$batas,$tanggal);
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

	function pemangku_riwayat(){
		$data['id_unor'] = $_POST['idd'];

		$sql = "SELECT * FROM m_unor WHERE id_unor=".$_POST['idd']."";
		$data['unor'] = $this->db->query($sql)->row();

		$sql = "SELECT b.id_pegawai,b.nama_pegawai,b.nip_baru,b.status,a.tmt_jabatan FROM r_peg_jab a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) WHERE (a.id_unor=".$_POST['idd']." AND a.nama_jenis_jabatan='js') OR (a.id_unor=".$_POST['idd']." AND a.tugas_tambahan='Kepala Sekolah') ORDER BY a.tmt_jabatan";
		$data['hsl'] = $this->db->query($sql)->result();
		$this->load->view('pejabat/pemangku_riwayat',$data);
	}
}
?>