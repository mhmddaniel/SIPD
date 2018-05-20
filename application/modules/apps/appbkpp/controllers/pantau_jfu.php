<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pantau_jfu extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_pantau_jfu');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()   {
		$data['satu'] = "Masiv";
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['hal'] = "end";
		$this->load->view('pantau_jfu/index',$data);
	}



	public function getdata()   {
		$data['count'] = $this->m_pantau_jfu->hitung_jfu($_POST['cari']);


		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpagingA' value='1'>";
		} else {
			$batas = $_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai = ($hal-1)*$batas;
			$data['mulai'] = $mulai+1;
			$data['hslquery'] = $this->m_pantau_jfu->get_jfu($_POST['cari'],$mulai,$batas);
			$data['pager'] = Modules::run("appskp/appskp/pagerB",$data['count'],$batas,$hal);
		}
		echo json_encode($data);

	}

	public function cpnsdobel($tampil="ya")   {
/*
		$sq = "SELECT a.id_pegawai,a.tmt_cpns FROM r_pegawai_aktual a";
		$qr = $this->db->query($sq)->result();
		foreach($qr AS $key=>$val){
			$sqI = "UPDATE r_peg_cpns SET tmt_cpns='".$val->tmt_cpns."' WHERE id_pegawai='".$val->id_pegawai."'";
			$qrI = $this->db->query($sqI);
		}

		$data['satu'] = "Tb. r_peg_cpns ID PEGAWAI GANDA";
		$data['cpns'] = $this->m_pantau_jfu->cpnsdobel();
		foreach($data['cpns'] AS $key=>$val){
			$cekDok = $this->m_pantau_jfu->cekDokCpns($val->id);
			@$data['cpns'][$key]->id_reff = $cekDok->id_reff;
			if($key!=0 && $data['cpns'][($key-1)]->id_pegawai==$val->id_pegawai && $data['cpns'][($key-1)]->id_reff!=""){	
				$data['cpns'][$key]->tanda="hapus";	
				$this->m_pantau_jfu->hapuscpns($val->id);
			} else {	
				$data['cpns'][$key]->tanda="";	
			}
			if($key!=0 && $data['cpns'][($key-1)]->id_pegawai==$val->id_pegawai){
				$this->m_pantau_jfu->hapuscpns($val->id);
				$data['cpns'][$key]->tanda2="juga";	
			} else {
				$data['cpns'][$key]->tanda2="";	
			}
		}


		$data['pns'] = $this->m_pantau_jfu->pnsdobel();
		foreach($data['pns'] AS $key=>$val){
			$cekDok = $this->m_pantau_jfu->cekDokPns($val->id);
			@$data['pns'][$key]->id_reff = $cekDok->id_reff;
			if($key!=0 && $data['pns'][($key-1)]->id_pegawai==$val->id_pegawai && $data['pns'][($key-1)]->id_reff!=""){	
				$data['pns'][$key]->tanda="hapus";	
				$this->m_pantau_jfu->hapuspns($val->id);
			} else {	
				$data['pns'][$key]->tanda="";	
			}
			if($key!=0 && $data['pns'][($key-1)]->id_pegawai==$val->id_pegawai){
				$this->m_pantau_jfu->hapuspns($val->id);
				$data['pns'][$key]->tanda2="juga";	
			} else {
				$data['pns'][$key]->tanda2="";	
			}
		}
*/


		if($tampil=="ya"){
			$this->load->view('cpnsdobel/index',$data);
		}
	}

}
?>