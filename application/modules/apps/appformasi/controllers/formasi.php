<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Formasi extends MX_Controller {

	function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appformasi/m_formasi');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}


	public function index()  {
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->session->set_userdata('bulan',$data['bulan']);
		$this->session->set_userdata('tahun',$data['tahun']);


		$data['satu'] = "Saya.....";
		$this->load->view('formasi/index',$data);
	}

	function gettree(){
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));

		$level=($_POST['level']+1);
		$spare=3+(($level*20)-20);
		$lgh=5+(($level*3)-3);
		$id_parentxx=explode("_",$_POST['id_parent']);	
		$id_parent=end($id_parentxx);	

		$iUnor = $this->m_unor->ini_unor($id_parent);
		$uUnor = ($_POST['id_parent']==0)?0:$iUnor->kode_unor;
		$data['hslquery'] = $this->m_unor->gettree($uUnor,$lgh,$tanggal);

		foreach($data['hslquery'] as $it=>$val){
			$id=$data['hslquery'][$it]->id_unor;
			$data['hslquery'][$it]->idparent=$_POST['id_parent'];	
			$data['hslquery'][$it]->spare=$spare;	
			$data['hslquery'][$it]->level=$level;

			$data['hslquery'][$it]->js = $this->hitung_pegawai($tanggal,'js',$val->kode_unor);
			$data['hslquery'][$it]->jfu = $this->hitung_pegawai($tanggal,'jfu',$val->kode_unor);
			$data['hslquery'][$it]->jft = $this->hitung_pegawai($tanggal,'jft',$val->kode_unor);
			$data['hslquery'][$it]->guru = $this->hitung_pegawai($tanggal,'jft-guru',$val->kode_unor);

			$data['hslquery'][$it]->a_js = $this->hitung_pegawai('2017-1-05','js',$val->kode_unor);
			$data['hslquery'][$it]->a_jfu = $this->hitung_pegawai('2017-1-05','jfu',$val->kode_unor);
			$data['hslquery'][$it]->a_jft = $this->hitung_pegawai('2017-1-05','jft',$val->kode_unor);
			$data['hslquery'][$it]->a_guru = $this->hitung_pegawai('2017-1-05','jft-guru',$val->kode_unor);

			$data['hslquery'][$it]->s_js = $data['hslquery'][$it]->js-$data['hslquery'][$it]->a_js;
			$data['hslquery'][$it]->s_jfu = $data['hslquery'][$it]->jfu-$data['hslquery'][$it]->a_jfu;
			$data['hslquery'][$it]->s_jft = $data['hslquery'][$it]->jft-$data['hslquery'][$it]->a_jft;
			$data['hslquery'][$it]->s_guru = $data['hslquery'][$it]->guru-$data['hslquery'][$it]->a_guru;

			$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
			$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
			$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;
		}
		$data['mulai'] = 1;
		echo json_encode($data);
	}

	public function isolat()  {
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->session->set_userdata('bulan',$data['bulan']);
		$this->session->set_userdata('tahun',$data['tahun']);


		$data['satu'] = "Saya.....";
		$this->load->view('formasi/isolat',$data);
	}

	function gettreeisolat(){
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));

		$level=($_POST['level']+1);
		$spare=3+(($level*20)-20);
		$lgh=5+(($level*3)-3);
		$id_parentxx=explode("_",$_POST['id_parent']);	
		$id_parent=end($id_parentxx);	

		$iUnor = $this->m_unor->ini_unor($id_parent);
		$uUnor = ($_POST['id_parent']==0)?0:$iUnor->kode_unor;
		$data['hslquery'] = $this->m_unor->gettree($uUnor,$lgh,$tanggal);

		foreach($data['hslquery'] as $it=>$val){
			$id=$data['hslquery'][$it]->id_unor;
			$data['hslquery'][$it]->idparent=$_POST['id_parent'];	
			$data['hslquery'][$it]->spare=$spare;	
			$data['hslquery'][$it]->level=$level;

			$data['hslquery'][$it]->js = $this->hitung_isolat($tanggal,'js',$val->id_unor);
			$data['hslquery'][$it]->jfu = $this->hitung_isolat($tanggal,'jfu',$val->id_unor);
			$data['hslquery'][$it]->jft = $this->hitung_isolat($tanggal,'jft',$val->id_unor);
			$data['hslquery'][$it]->guru = $this->hitung_isolat($tanggal,'jft-guru',$val->id_unor);

			$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
			$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
			$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;
		}
		$data['mulai'] = 1;
		echo json_encode($data);
	}


	private function hitung_pegawai($tgl,$jenis,$kode){
		$tanggal = explode("-",$tgl);
		$bulan = $tanggal[1];
		$tahun = $tanggal[0];
		
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows	
		FROM r_pegawai_bulanan a
		WHERE  
		a.bulan='$bulan'
		AND a.tahun='$tahun'
		AND a.status_kepegawaian='pns'
		AND a.jab_type='$jenis'
		AND a.kode_unor LIKE '$kode%'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	private function hitung_isolat($tgl,$jenis,$idd){
		$tanggal = explode("-",$tgl);
		$bulan = $tanggal[1];
		$tahun = $tanggal[0];
		
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows	
		FROM r_pegawai_bulanan a
		WHERE  
		a.bulan='$bulan'
		AND a.tahun='$tahun'
		AND a.status_kepegawaian='pns'
		AND a.jab_type='$jenis'
		AND a.id_unor='$idd'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}




}
?>