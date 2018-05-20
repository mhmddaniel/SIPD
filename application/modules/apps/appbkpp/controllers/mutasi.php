<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mutasi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_mutasi');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Mutasi Pegawai";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('mutasi/index',$data);
//		redirect(site_url()."module/appsotkbaru/migrasi_pegawai");
	}
	function cari_nip(){
 		$this->form_validation->set_rules("nip","NIP","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$data = $this->m_pegawai->get_pegawai_by_nip($_POST['nip']);
		} else {
			$data = "";
		}
		echo json_encode($data);
	}

	function cari_nip_kandidat(){
 		$this->form_validation->set_rules("nip","NIP","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$data = $this->m_pegawai->get_pegawai_by_nip($_POST['nip']);
			if(!empty($data)){
				$id_rancangan = $this->session->userdata('id_rancangan');
				$cek_jabatan = $this->m_mutasi->cek_jabatan_pegawai($data->id_pegawai,$id_rancangan);
				if(!empty($cek_jabatan)){
					$this->m_mutasi->mutasi($data,$_POST,$id_rancangan);
				} else {
					$this->m_mutasi->promosi($data,$_POST,$id_rancangan);
				}
			}
		} else {
			$data = "";
		}
		echo json_encode($data);
	}

	function rancangan(){
		$data['satu'] = "Rancangan Mutasi";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$rancangan = $this->m_mutasi->get_rancangan();
		if(!empty($rancangan)){
			$idrancangan = $this->session->userdata('idrancangan');
			if($idrancangan==""){
				$pilih = end($rancangan);
				$this->session->set_userdata("id_rancangan",$pilih->id_rancangan);
			} else {
				$this->session->set_userdata("id_rancangan",$idrancangan);
			}
			$this->session->set_userdata("idrancangan","");
			$id_rancangan = $this->session->userdata('id_rancangan');
			$data['id_rancangan'] = $id_rancangan;
			$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);
			$this->load->view('mutasi/rancangan',$data);
		} else {
			$data['id_rancangan'] = "xx";
			$this->load->view('mutasi/rancangan_pertama',$data);
		}
	}

	function getdata(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_unor->hitung_master_unor($cari,$tanggal,"xx");

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();

			$data['hslquery'] = $this->m_unor->get_master_unor($cari,$mulai,$batas,$tanggal,"xx");
				foreach($data['hslquery'] AS $ky=>$vl){
					$pejabat = $this->m_mutasi->get_pejabat_rancangan($vl->id_unor,$id_rancangan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$ky]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$ky]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$ky]->pejabat[$key]['nip_baru'] = $val->nip_baru;
						$data['hslquery'][$ky]->pejabat[$key]['status'] = $val->status;

						$data['hslquery'][$ky]->pejabat[$key]['nama_pangkat'] = @$dWpangkat[$val->kode_golongan];
						$data['hslquery'][$ky]->pejabat[$key]['nama_golongan'] = @$dWgolongan[$val->kode_golongan];

						$data['hslquery'][$ky]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function gethasil(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_mutasi->hitung_hasil_rancangan($cari,$id_rancangan);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();

			$data['hslquery'] = $this->m_mutasi->get_hasil_rancangan($cari,$mulai,$batas,$id_rancangan);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->pejabat = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				$pegawai = Modules::run("appbkpp/profile/ini_pegawai",$val->id_pegawai);
				$unor = $this->m_mutasi->ini_unor($pegawai->id_unor);
				$data['hslquery'][$key]->kode_unor_lama = $unor->kode_unor;
				$data['hslquery'][$key]->nomenklatur_jabatan_lama = $pegawai->nomenklatur_jabatan;
				$data['hslquery'][$key]->nomenklatur_pada_lama = $pegawai->nomenklatur_pada;
				$data['hslquery'][$key]->nama_ese_lama = @$pegawai->nama_ese;
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function gettree(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
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
				$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
				$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
				$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;

					$pejabat = $this->m_mutasi->get_pejabat_rancangan($val->id_unor,$id_rancangan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$it]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$it]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$it]->pejabat[$key]['nip_baru'] = $val->nip_baru;
						$data['hslquery'][$it]->pejabat[$key]['status'] = $val->status;

						$data['hslquery'][$it]->pejabat[$key]['nama_pangkat'] = @$dWpangkat[$val->kode_golongan];
						$data['hslquery'][$it]->pejabat[$key]['nama_golongan'] = @$dWgolongan[$val->kode_golongan];

						$data['hslquery'][$it]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$it]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}

		}
		$data['mulai'] = 1;
		$data['pager'] = "";
		echo json_encode($data);
	}


	function getrangkap(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_mutasi->hitung_rangkap_unor($cari,$tanggal,$id_rancangan);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_mutasi->get_rangkap_unor($cari,$mulai,$batas,$tanggal,$id_rancangan);
				foreach($data['hslquery'] AS $ky=>$vl){
					$pejabat = $this->m_mutasi->get_pejabat_rancangan($vl->id_unor,$id_rancangan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$ky]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$ky]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$ky]->pejabat[$key]['nip_baru'] = $val->nip_baru;

						$data['hslquery'][$ky]->pejabat[$key]['nama_pangkat'] = @$dWpangkat[$val->kode_golongan];
						$data['hslquery'][$ky]->pejabat[$key]['nama_golongan'] = @$dWgolongan[$val->kode_golongan];

						$data['hslquery'][$ky]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}
				}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function getkosong(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_mutasi->hitung_kosong_unor($cari,$tanggal,$id_rancangan);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_mutasi->get_kosong_unor($cari,$mulai,$batas,$tanggal,$id_rancangan);
				foreach($data['hslquery'] AS $ky=>$vl){
					$pejabat = $this->m_mutasi->get_pejabat_rancangan($vl->id_unor,$id_rancangan);
					foreach($pejabat AS $key=>$val){
						$data['hslquery'][$ky]->pejabat[$key]['nama_pegawai'] = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$ky]->pejabat[$key]['id_pegawai'] = $val->id_pegawai;
						$data['hslquery'][$ky]->pejabat[$key]['nip_baru'] = $val->nip_baru;

						$data['hslquery'][$ky]->pejabat[$key]['nama_pangkat'] = @$dWpangkat[$val->kode_golongan];
						$data['hslquery'][$ky]->pejabat[$key]['nama_golongan'] = @$dWgolongan[$val->kode_golongan];

						$data['hslquery'][$ky]->pejabat[$key]['tmt_pangkat'] = date("d-m-Y", strtotime($val->tmt_pangkat));
						$data['hslquery'][$ky]->pejabat[$key]['tmt_ese'] = date("d-m-Y", strtotime($val->tmt_ese));
					}
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function getsisa(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
		$tanggal = (isset($_POST['tanggal']))?date("Y-m-d", strtotime($_POST['tanggal'])):"xx";
		$kehal = (isset($_POST['kehal']))?$_POST['kehal']:"paging";
		$cari = $_POST['cari'];
		$data['count'] = $this->m_mutasi->hitung_sisa($cari,$tanggal,$id_rancangan);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_mutasi->get_sisa($cari,$mulai,$batas,$tanggal,$id_rancangan);
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}













	function picker_pegawai(){
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('m');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$tGH = date('Y-m-d');
		
		$data['idd'] = $_POST['idd']; 
		$data['unor'] = $this->m_unor->gettree(0,5,$tGH); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();

		$data['satu'] = "Daftar Pegawai";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"js";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";
		$data['ptugas'] = (isset($_POST['ptugas']))?$_POST['ptugas']:"";
		$data['pagama'] = (isset($_POST['pagama']))?$_POST['pagama']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";
		$data['pstatus'] = (isset($_POST['pstatus']))?$_POST['pstatus']:"";
		$data['pjenjang'] = (isset($_POST['pjenjang']))?$_POST['pjenjang']:"";
		$data['pumur'] = (isset($_POST['pumur']))?$_POST['pumur']:"";
		$data['pmkcpns'] = (isset($_POST['pmkcpns']))?$_POST['pmkcpns']:"";
		$this->load->view('mutasi/picker_pegawai',$data);
	}

















	function rancangan_hasil(){
		$data['satu'] = "Rancangan Mutasi";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);

		$this->load->view('mutasi/rancangan_hasil',$data);
	}

	function rancangan_kosong(){
		$data['satu'] = "Rancangan Mutasi";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);

		$this->load->view('mutasi/rancangan_kosong',$data);
	}

	function rancangan_rangkap(){
		$data['satu'] = "Rancangan Mutasi";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);

		$this->load->view('mutasi/rancangan_rangkap',$data);
	}

	function rancangan_tree(){
		$data['satu'] = "Rancangan Mutasi";
		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);

		$this->load->view('mutasi/rancangan_tree',$data);
	}

	function kembali_jabatan_asal(){
		$id_pegawai = $_POST['idd'];
		$id_unor = $_POST['id_unor'];
		$tanggal = $_POST['tmt_jabatan'];
		$id_rancangan = $this->session->userdata('id_rancangan');
		$j_rancangan = $this->m_mutasi->cek_jabatan_pegawai($id_pegawai,$id_rancangan);
		$val = Modules::run("appbkpp/profile/ini_pegawai",$id_pegawai);

		$sq = "DELETE FROM p_mut_rancangan_pemangku WHERE id_rancangan='$id_rancangan' AND id_pegawai='$id_pegawai'";
		$this->db->query($sq);


		$sqA = "SELECT * FROM m_unor WHERE id_unor='".$val->id_unor."' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
		$hsA = $this->db->query($sqA)->row();
		if(!empty($hsA) && ($val->jab_type=='js' || $val->tugas_tambahan=="Kepala Sekolah")){
			$this->db->set('id_rancangan',$id_rancangan);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('nip_baru',$val->nip_baru);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('gelar_nonakademis',$val->gelar_nonakademis);
			$this->db->set('gelar_depan',$val->gelar_depan);
			$this->db->set('gelar_belakang',$val->gelar_belakang);
			$this->db->set('tmt_cpns',$val->tmt_cpns);
			$this->db->set('tmt_pns',$val->tmt_pns);
			$this->db->set('kode_golongan',$val->kode_golongan);
			$this->db->set('tmt_pangkat',$val->tmt_pangkat);
			$this->db->set('id_unor',$val->id_unor);
			$this->db->set('jab_type',$val->jab_type);
			$this->db->set('kode_ese',$val->kode_ese);
			$this->db->set('tmt_ese',$val->tmt_ese);
			$this->db->set('tugas_tambahan',$val->tugas_tambahan);
			$this->db->set('status',0);
			$this->db->insert('p_mut_rancangan_pemangku');
		}

		echo $id_rancangan;
	}
	function rancangan_sisa(){
		$data['satu'] = "Rancangan Mutasi";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['rancangan'] = $this->m_mutasi->ini_rancangan($id_rancangan);

		$this->load->view('mutasi/rancangan_sisa',$data);
	}

	function arsip(){
		$data['rancangan'] = $this->m_mutasi->get_rancangan();
		$this->load->view('mutasi/rancangan_arsip',$data);
	}
	function baru(){
		$this->load->view('mutasi/rancangan_baru');
	}
	function baru_aksi(){
		$this->m_mutasi->rancangan_baru_aksi($_POST);
		echo "success";
	}
	function edit(){
		$data['isi'] = $this->m_mutasi->ini_rancangan($_POST['idd']);
		$this->load->view('mutasi/rancangan_baru',$data);
	}
	function edit_aksi(){
		$this->m_mutasi->rancangan_edit_aksi($_POST);
		$this->session->set_userdata("idrancangan",$_POST['id_rancangan']);
		echo "success";
	}
	function hapus(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$data['isi'] = $this->m_mutasi->ini_rancangan($id_rancangan);
		$this->load->view('mutasi/rancangan_hapus',$data);
	}
	function hapus_aksi(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$this->m_mutasi->rancangan_hapus_aksi($id_rancangan);
		echo "success";
	}
	function ajukan(){
		$data['isi'] = $this->m_mutasi->ini_rancangan($_POST['idd']);
		$this->load->view('mutasi/rancangan_ajukan',$data);
	}
	function ajukan_aksi(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$this->m_mutasi->rancangan_ajukan_aksi($id_rancangan);
		echo "success";
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////
	function alih_rancangan(){
		$this->session->set_userdata("idrancangan",$_POST['idd']);
		echo "success";
	}
	function kembali_rancangan(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$this->session->set_userdata("idrancangan",$id_rancangan);
		redirect(site_url()."module/appbkpp/mutasi/rancangan");
	}

}
?>