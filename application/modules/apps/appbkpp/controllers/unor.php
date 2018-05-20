<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Unor extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
		$sess = $this->session->userdata('logged_in');
		$this->id_grup = $sess['id_group'];
		$this->nama_grup = $sess['group_name'];
		$this->theme = $sess['section_name'];
	}


	function index(){
		$data['satu'] = "Daftar Unit Kerja";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$data['ese'] = $this->dropdowns->kode_ese();
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";

		$sess = $this->session->userdata('logged_in');
		$data['master'] = ($this->nama_grup=="admin")?"ya":"tidak";
		$this->load->view('unor/index',$data);
	}

	function getdata(){
/////:: tambahan, dalam rangka migrasi sotk baru  ///////
if(isset($_POST['internal']) && $_POST['internal']=="ya"){
		$idUser = $this->session->userdata('logged_in');
		$this->db->from('user_umpeg a');
		$this->db->where('a.user_id',$idUser['id_user']);
		$a_unor = $this->db->get()->row();
			$dd=array("{","}");
		$b_unor = str_replace($dd,"",$a_unor->unor_akses);
}
/////.. tambahan  ///////
		$tanggal = (isset($_POST['tanggal']))?(($_POST['tanggal']=="xx")?"xx":date("Y-m-d", strtotime($_POST['tanggal']))):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$ese=$_POST['ese'];

		$data['count'] = (isset($_POST['internal']) && $_POST['internal']=="ya")?$this->m_unor->hitung_master_unor($cari,$tanggal,$ese,$b_unor):$this->m_unor->hitung_master_unor($cari,$tanggal,$ese);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = (isset($_POST['internal']) && $_POST['internal']=="ya")?$this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese,$b_unor):$this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tmt_berlaku = date("d-m-Y", strtotime($val->tmt_berlaku));
					$data['hslquery'][$key]->tst_berlaku = date("d-m-Y", strtotime($val->tst_berlaku));
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function getdata_pengelola_only(){
// 		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
// 		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
// 		$cari = $_POST['cari'];


// 		$this->load->model('appbkpp/m_umpeg');
// 		$user_id = $this->session->userdata('user_id');
// 		$user = $this->m_umpeg->ini_user($user_id);
// 			$dd=array("{","}");
// 		$unor=  str_replace($dd,"",$user->unor_akses);

// 				$iTanggal = ($tanggal=="xx")?"":"AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
// 				$sqlstr="SELECT COUNT(a.id_unor) AS numrows FROM (m_unor a)
// 							WHERE  (
// 							a.kode_unor LIKE '$cari%'
// 							OR a.nama_unor LIKE '%$cari%'
// 							OR a.nomenklatur_cari LIKE '%$cari%'
// 							OR a.nomenklatur_pada LIKE '%$cari%'
// 							OR a.nama_ese='$cari'
// 							)
// 							AND a.id_unor IN ($unor) $iTanggal";
// 				$query = $this->db->query($sqlstr)->row(); 
// 				$data['count'] = $query->numrows;
// //		$data['count'] = $this->m_unor->hitung_master_unor($cari,$tanggal);

// 		if($data['count']==0){
// 			$data['hslquery']="";
// 			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
// 		} else {
// 			$batas=$_POST['batas'];
// 			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
// 			$mulai=($hal-1)*$batas;
// 			$data['mulai']=$mulai+1;


// 				$sqA="SELECT a.* FROM m_unor a
// 					WHERE  (
// 					a.kode_unor LIKE '$cari%'
// 					OR a.nama_unor LIKE '%$cari%'
// 					OR a.nomenklatur_cari LIKE '%$cari%'
// 					OR a.nomenklatur_pada LIKE '%$cari%'
// 					OR a.nama_ese='$cari'
// 					)
// 					AND a.id_unor IN ($unor) $iTanggal ORDER BY a.kode_unor ASC LIMIT $mulai,$batas";
// 					$data['hslquery'] = $this->db->query($sqA)->result();
// //			$data['hslquery'] = $this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal);





// 				foreach($data['hslquery'] AS $key=>$val){
// 					$data['hslquery'][$key]->tmt_berlaku = date("d-m-Y", strtotime($val->tmt_berlaku));
// 					$data['hslquery'][$key]->tst_berlaku = date("d-m-Y", strtotime($val->tst_berlaku));
// 				}
// 			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
// 		}
// 		echo json_encode($data);
		$tanggal = (isset($_POST['tanggal']))?(($_POST['tanggal']=="xx")?"xx":date("Y-m-d", strtotime($_POST['tanggal']))):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$ese=$_POST['ese'];

		$data['count'] = (isset($_POST['internal']) && $_POST['internal']=="ya")?$this->m_unor->hitung_master_unor($cari,$tanggal,$ese,$b_unor):$this->m_unor->hitung_master_unor($cari,$tanggal,$ese);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = (isset($_POST['internal']) && $_POST['internal']=="ya")?$this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese,$b_unor):$this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,$ese);
				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tmt_berlaku = date("d-m-Y", strtotime($val->tmt_berlaku));
					$data['hslquery'][$key]->tst_berlaku = date("d-m-Y", strtotime($val->tst_berlaku));
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	function formedit(){
		$data['unit'] = $this->m_unor->ini_unor($_POST['idd']);
		$data['unit']->tmt_berlaku = date("d-m-Y", strtotime($data['unit']->tmt_berlaku));
		$data['unit']->tst_berlaku = date("d-m-Y", strtotime($data['unit']->tst_berlaku));
		$this->load->view('unor/formedit',$data);
	}
	function edit_aksi(){
 		$this->form_validation->set_rules("nama_unor","Nama Unor","trim|required|xss_clean");
        $this->form_validation->set_rules("nomenklatur_jabatan","Jabatan (nomenklatur)","trim|required|xss_clean");
 		$this->form_validation->set_rules("nomenklatur_pada","Lokasi Jabatan (pada)","trim|required|xss_clean");
 		$this->form_validation->set_rules("nomenklatur_cari","Index Pencarian","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ese = $this->dropdowns->kode_ese();
			$_POST['nama_ese']=$ese[$_POST['kode_ese']];
			$_POST['tmt_berlaku']=date("Y-m-d", strtotime($_POST['tmt_berlaku']));
			$_POST['tst_berlaku']=date("Y-m-d", strtotime($_POST['tst_berlaku']));
			$ddir=$this->m_unor->edit_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formtambah(){
		$this->load->view('unor/formtambah');
	}
	function tambah_aksi(){
 		$this->form_validation->set_rules("nama_unor","Nama Unor","trim|required|xss_clean");
	    $this->form_validation->set_rules("nomenklatur_jabatan","Jabatan (nomenklatur)","trim|required|xss_clean");
 		$this->form_validation->set_rules("nomenklatur_pada","Lokasi Jabatan (pada)","trim|required|xss_clean");
 		$this->form_validation->set_rules("nomenklatur_cari","Index Pencarian","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ese = $this->dropdowns->kode_ese();
			$_POST['nama_ese']=$ese[$_POST['kode_ese']];
			$_POST['tmt_berlaku']=date("Y-m-d", strtotime($_POST['tmt_berlaku']));
			$_POST['tst_berlaku']=date("Y-m-d", strtotime($_POST['tst_berlaku']));
			$ddir=$this->m_unor->tambah_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}

	function formcopy(){
		$data['unit'] = $this->m_unor->ini_unor($_POST['idd']);
		$data['unit']->tmt_berlaku = date("d-m-Y", strtotime($data['unit']->tmt_berlaku));
		$data['unit']->tst_berlaku = date("d-m-Y", strtotime($data['unit']->tst_berlaku));
		$this->load->view('unor/formcopy',$data);
	}

	function formhapus(){
		$data['cekPegUnor'] =  $this->m_unor->cek_pegawai_unor($_POST['idd']);
		$data['unit'] = $this->m_unor->ini_unor($_POST['idd']);
		$data['unit']->tmt_berlaku = date("d-m-Y", strtotime($data['unit']->tmt_berlaku));
		$data['unit']->tst_berlaku = date("d-m-Y", strtotime($data['unit']->tst_berlaku));
		$this->load->view('unor/formhapus',$data);
	}
	function hapus_aksi(){
		$this->m_unor->hapus_aksi($_POST); 
		echo "sukses#"."add#";
	}
	function formsetberlaku(){
		$data['idd'] = $_POST['idd'];
		$this->load->view('unor/formsetberlaku',$data);
	}
	function setberlaku_aksi(){
		$dd=array("{","}");
		$unortt = 	explode(",",str_replace($dd,"",$_POST['idd']));
		$isi['tmt_berlaku']=date("Y-m-d", strtotime($_POST['tmt_berlaku']));
		$isi['tst_berlaku']=date("Y-m-d", strtotime($_POST['tst_berlaku']));

		foreach($unortt AS $key=>$val){
			$isi['id_unor'] = $val;
			$this->m_unor->setberlaku_aksi($isi); 
		}
		echo "sukses#"."add#";
	}
	function formsetmasjab(){
		$data['idd'] = $_POST['idd'];
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$this->load->view('unor/formsetmasjab',$data);
	}
	function setmasjab_aksi(){
		$dd=array("{","}");
		$unortt = 	explode(",",str_replace($dd,"",$_POST['idd']));

		foreach($unortt AS $key=>$val){
			$this->m_unor->setmasjab_aksi($val,$_POST['id_jabatan']); 
		}
		echo "sukses#";
	}

	function master(){
		$data['satu'] = "Daftar Unit Kerja";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('unor/master',$data);
	}

	function tree(){
		$data['satu']="Daftar Unit Kerja";
		$sess = $this->session->userdata('logged_in');
		$data['master'] = ($sess['id_group']=="5")?"ya":"tidak";
		$this->load->view('unor/tree',$data);
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
			$data['hslquery'][$it]->tmt_berlaku = date("d-m-Y", strtotime($val->tmt_berlaku));
			$data['hslquery'][$it]->tst_berlaku = date("d-m-Y", strtotime($val->tst_berlaku));
				$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
				$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
				$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;
		}
		$data['mulai'] = 1;
		$data['pager'] = "";
		echo json_encode($data);
	}

	function setara(){
		$data['satu'] = "Jabatan Master";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('unor/setara',$data);
	}

	function getsetara(){
		$cari = $_POST['cari'];
		$hal = $_POST['hal'];
		$data['count'] = $this->m_unor->hitung_setara($cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_unor->get_setara($cari,$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
				$cek = $this->m_unor->cek_setara($val->id_jabatan);
				$data['hslquery'][$key]->cek = (empty($cek))?"kosong":"ada";
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function setara_formtambah(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "tambah";
		$this->load->view('unor/setara_form',$data);
	}
	function setara_tambah_aksi(){
		$this->m_unor->setara_tambah($_POST);
		echo "sukses#hj";
	}
	function setara_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "edit";
		$data['val'] = $this->m_unor->ini_setara($data['idd']);
		$this->load->view('unor/setara_form',$data);
	}
	function setara_edit_aksi(){
		$this->m_unor->setara_edit($_POST);
		echo "sukses#hj";
	}
	function setara_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$data['val'] = $this->m_unor->ini_setara($data['idd']);
		$this->load->view('unor/setara_form',$data);
	}
	function setara_hapus_aksi(){
		$this->m_unor->setara_hapus($_POST);
		echo "sukses#hj";
	}


}
?>