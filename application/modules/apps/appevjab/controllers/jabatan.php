<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jabatan extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_kelas');
		$this->load->model('appevjab/m_anjab');
		$this->load->model('appevjab/m_satu');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////
	function jfu(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['satu'] = "Jabatan Fungsional Umum";
		$this->session->set_userdata('jab_type','jfu');
		$this->load->view('jabatan/jfu',$data);
	}
	function getjfu(){
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
		$iUnor = ($unor=="")?"":"AND id_unor IN ($unor)";

		$data['count'] = $this->m_satu->hitung_jabatan('jfu',$cari,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_jabatan('jfu',$mulai,$batas,$cari,$unor);

			foreach($data['hslquery'] AS $key=>$val){
				$sql = "SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='jfu' $iUnor AND nomenklatur_jabatan='".$val->nomenklatur_jabatan."'";
				$hsl = $this->db->query($sql)->row();
				$sqlA = "SELECT a.id_jabatan,b.id_kelas_jabatan,b.ihtisar FROM m_jf a LEFT JOIN evjab_kelas_jabatan b ON (a.id_jabatan=b.id_jabatan) WHERE a.jab_type='jfu' AND a.nama_jabatan='".$val->nomenklatur_jabatan."'";
				$hslA = $this->db->query($sqlA)->row();

				@$data['hslquery'][$key]->banyak = $hsl->numrows;
				@$data['hslquery'][$key]->id_kelas_jabatan = (empty($hslA->id_kelas_jabatan))?"":$hslA->id_kelas_jabatan;
				@$data['hslquery'][$key]->id_jabatan = $hslA->id_jabatan;
				@$data['hslquery'][$key]->ihtisar = (empty($hslA->ihtisar))?"...":$hslA->ihtisar;
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if

		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////
	function jft(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['satu'] = "Jabatan Fungsional Tertentu";
		$this->session->set_userdata('jab_type','jft');
		$this->load->view('jabatan/jft',$data);
	}
	function getjft(){
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
		$iUnor = ($unor=="")?"":"AND id_unor IN ($unor)";

		$data['count'] = $this->m_satu->hitung_jabatan('jft',$cari,$unor);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_satu->get_jabatan('jft',$mulai,$batas,$cari,$unor);

			foreach($data['hslquery'] AS $key=>$val){
				$sql = "SELECT COUNT(id_pegawai) AS numrows FROM r_pegawai_aktual WHERE jab_type='jft' $iUnor AND nomenklatur_jabatan='".$val->nomenklatur_jabatan."'";
				$hsl = $this->db->query($sql)->row();
				$sqlA = "SELECT a.id_jabatan,b.id_kelas_jabatan,b.ihtisar FROM m_jf a LEFT JOIN evjab_kelas_jabatan b ON (a.id_jabatan=b.id_jabatan) WHERE a.jab_type='jft' AND a.nama_jabatan='".$val->nomenklatur_jabatan."'";
				$hslA = $this->db->query($sqlA)->row();

				@$data['hslquery'][$key]->banyak = $hsl->numrows;
				@$data['hslquery'][$key]->id_kelas_jabatan = (empty($hslA->id_kelas_jabatan))?"":$hslA->id_kelas_jabatan;
				@$data['hslquery'][$key]->id_jabatan = $hslA->id_jabatan;
				@$data['hslquery'][$key]->ihtisar = (empty($hslA->ihtisar))?"...":$hslA->ihtisar;
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}  //end if

		echo json_encode($data);
	}
///////////////////////////////////////////////////////////////////////////
	function js(){
		$data['satu'] = "Jabatan Struktural";
		$this->session->set_userdata('jab_type','js');

		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):date("Y-m-d");
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

		$sqlstr = "SELECT a.*,b.*,c.id_kelas_jabatan,c.ihtisar
		FROM m_unor a
		LEFT JOIN m_jf b ON (a.nomenklatur_unor=b.id_jabatan)
		LEFT JOIN evjab_kelas_jabatan c ON (b.id_jabatan=c.id_jabatan)
		WHERE  a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'
		AND a.id_unor IN ($unor)
		AND a.nomenklatur_unor IS NOT NULL
		GROUP BY a.nomenklatur_unor
		ORDER BY a.kode_unor ASC";
		$data['hslquery'] = $this->db->query($sqlstr)->result();
		$this->load->view('jabatan/js',$data);
	}


	function get_fungsional(){
		$tipe = $this->session->userdata("jab_type");
		$data['count'] = $this->m_kelas->hitung_kelas($_POST['cari'],$tipe);
		
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			////////***
			$this->session->set_userdata("hal",$hal);
			$this->session->set_userdata("batas",$batas);
			$this->session->set_userdata("cari",$_POST['cari']);
			////////***
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_kelas->get_kelas($_POST['cari'],$mulai,$batas,$tipe);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function fungsional_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['tipe'] = $this->session->userdata("jab_type");
		$data['val'] = $this->m_kelas->ini_kelas_jabatan($data['idd']);
		$data['isian'] = "ya";
		$data['batas'] = 10;
		$data['cari'] = "";
		$this->load->view('jabatan/fungsional_form',$data);
	}
	function fungsional_tambah_aksi(){
		$this->m_kelas->fungsional_tambah($_POST);
		echo "sukses";
	}
	function fungsional_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['tipe'] = $this->session->userdata("jab_type");
		$data['val'] = $this->m_kelas->ini_kelas_jabatan($data['idd']);
		$data['isian'] = "ya";
		$data['batas'] = 10;
		$data['cari'] = "";
		$this->load->view('jabatan/fungsional_form',$data);
	}
	function fungsional_edit_aksi(){
		$this->m_kelas->fungsional_edit($_POST);
		echo "sukses";
	}
	function pil_fungsional(){
		$tipe = $_POST['tipe'];
		$data['count'] = $this->m_anjab->hitung_jabfung_belum($_POST['cari'],$tipe);
		
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_anjab->get_jabfung_belum($_POST['cari'],$mulai,$batas,$tipe);
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

}
?>