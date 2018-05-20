<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Nonpns extends MX_Controller {

	function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_dafpeg');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tkk()  {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "tkk_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "tkk_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "tkk_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "tkk_pempeg";
		} elseif($group_name=="kepala_opd") {
			$rd = "tkk_kepala_opd";
		} else {
			$rd = "tkk";
		}

		$data['tab'] = (isset($_POST['tab']))?$_POST['tab']:"aktif";
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = "end";
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['jenis'] = $this->dropdowns->status_kepegawaian();

		$this->load->view('nonpns/'.$rd,$data);
	}

	public function getdata_tkk()  {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
		} elseif($group_name=="kepala_opd") {
			$kode_unor = $this->session->userdata('kode_unor');
			$sqlstr = "SELECT * FROM m_unor WHERE kode_unor LIKE '$kode_unor%'";
			$query = $this->db->query($sqlstr)->result();
			$unor="";
			foreach($query AS $key=>$val){
				$unor = ($key==0)?$unor.$val->id_unor:$unor.",".$val->id_unor;
			}
		} else {
			$unor="all";
		}

			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

			$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
			$tahun=$_POST['tahun'];

		$data['utmAct'] = ($tahun."-".$bulan==date('Y-m'))?"ya":"tidak";
		$data['count'] = $this->m_pegawai->hitung_pegawai_bulanan($_POST['cari'],"all",$unor,"","","","","","","","","","all","all",$bulan,$tahun,$_POST['jenis'],'pns');

		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$_POST['bulan_print'] = $bulan;
		$_POST['tahun_print'] = $tahun;
		$this->session->set_userdata("id_cetak",$_POST);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_pegawai->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,"all",$unor,"","","","","","","","","","all","all",$bulan,$tahun,$_POST['jenis']);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

					$amt = Modules::run('appbkpp/profile/ini_pegawai_alamat',$val->id_pegawai);
					$pend = Modules::run('appbkpp/profile/ini_pegawai_pendidikan',$val->id_pegawai);
					$jab = Modules::run('appbkpp/profile/ini_pegawai_jabatan',$val->id_pegawai);

					$pendidikan = end(@$pend);
					$data['hslquery'][$key]->nama_jenjang = (isset($pendidikan->nama_jenjang))?$pendidikan->nama_jenjang:"-";
					$data['hslquery'][$key]->nama_sekolah = (isset($pendidikan->nama_sekolah))?$pendidikan->nama_sekolah:"-";
					$data['hslquery'][$key]->tanggal_lulus = (isset($pendidikan->tanggal_lulus))?date("d-m-Y", strtotime($pendidikan->tanggal_lulus)):"-";

					$jabatan = end(@$jab);
					$data['hslquery'][$key]->nama_jabatan = (isset($jabatan->nama_jabatan))?$jabatan->nama_jabatan:"-";
					$data['hslquery'][$key]->nomenklatur_pada = (isset($jabatan->nomenklatur_pada))?$jabatan->nomenklatur_pada:"-";
					$data['hslquery'][$key]->sk_nomor = (isset($jabatan->sk_nomor))?$jabatan->sk_nomor:"-";
					$data['hslquery'][$key]->sk_tanggal = (isset($jabatan->sk_tanggal))?date("d-m-Y", strtotime($jabatan->sk_tanggal)):"-";
					$data['hslquery'][$key]->sk_pejabat = (isset($jabatan->sk_pejabat))?$jabatan->sk_pejabat:"-";
					
					$data['hslquery'][$key]->hapus = (empty($pend) && empty($jab) && empty($amt))?"ya":"tidak";
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}








	public function formtambah_biodata()  {
		$data['satu'] = "formtambah";
		$data['status_kepegawaian'] = $_POST['status_kepegawaian'];
		$this->load->view('nonpns/form_biodata',$data);
	}

	public function biodata_aksi()  {
///////////////////// Bagian 1 =>cari id_unor
		$user_id = $this->session->userdata('user_id');
		$this->db->from('user_umpeg a');
		$this->db->where('a.user_id',$user_id);
		$a_unor = $this->db->get()->row();
			$dd=array("{","}");
		$b_unor = str_replace($dd,"",$a_unor->unor_akses);
		$sql="SELECT a.* FROM m_unor a WHERE a.id_unor IN ($b_unor) ORDER BY a.kode_unor";
		$qry = $this->db->query($sql)->result();
		$id_unor = $qry[0]->id_unor;
		$kode_unor = $qry[0]->kode_unor;
		$nama_unor = $qry[0]->nama_unor;
///////////////////// Bagian 2
		$sqC="SELECT a.id_pegawai FROM r_pegawai a WHERE a.nip_baru='".$_POST['nip_baru']."'";
		$qrC = $this->db->query($sqC)->row(); 

		if(empty($qrC)){
					$isi = $_POST;
					$isi['tanggal_lahir'] =  date("Y-m-d", strtotime($isi['tanggal_lahir']));
					$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows	FROM r_pegawai a WHERE a.status_kepegawaian='".$isi['status_kepegawaian']."' AND a.gender='".$isi['gender']."' AND a.tanggal_lahir='".$isi['tanggal_lahir']."'";
					$query = $this->db->query($sqlstr)->row(); 
					$kdGender = array();
					$kdGender['l']=1;
					$kdGender['p']=2;
					$tl_lahir = date("Ymd", strtotime($isi['tanggal_lahir']));
					$regIni = sprintf("%03d",($query->numrows+1));
					$nip = $tl_lahir.'-'.$isi['status_kepegawaian'].'-'.$kdGender[$isi['gender']].$regIni;
					$bulan = sprintf("%02d",date('m'));
			
						$this->db->set('nama_pegawai',$isi['nama_pegawai']);
						$this->db->set('nip',$nip);
						$this->db->set('nip_baru',$isi['nip_baru']);
						$this->db->set('tempat_lahir',$isi['tempat_lahir']);
						$this->db->set('tanggal_lahir',$isi['tanggal_lahir']);
						$this->db->set('gender',$isi['gender']);
						$this->db->set('agama',$isi['agama']);
						$this->db->set('status_perkawinan',$isi['status_perkawinan']);
						$this->db->set('nomor_hp',$isi['nomor_hp']);
						$this->db->set('status_kepegawaian',$isi['status_kepegawaian']);
						$this->db->insert('r_pegawai');
						$id_pegawai = $this->db->insert_id();
			
						$this->db->set('id_pegawai',$id_pegawai);
						$this->db->set('nama_pegawai',$isi['nama_pegawai']);
						$this->db->set('nip_baru',$isi['nip_baru']);
						$this->db->set('status_kepegawaian',$isi['status_kepegawaian']);
						$this->db->set('id_unor',$id_unor);
						$this->db->set('kode_unor',$kode_unor);
						$this->db->set('nama_unor',$nama_unor);
						$this->db->insert('r_pegawai_aktual');
			
						$this->db->set('id_pegawai',$id_pegawai);
						$this->db->set('bulan',$bulan);
						$this->db->set('tahun',date('Y'),false);
						$this->db->set('id_unor',$id_unor);
						$this->db->set('kode_unor',$kode_unor);
						$this->db->set('status_kepegawaian',$isi['status_kepegawaian']);
						$this->db->insert('r_pegawai_bulanan');
		
				echo "sukses";
		} else {
				echo "NIK sudah terdaftar... Coba NIK lain!!";
		}
	}

	public function formhapus_biodata()  {
		$data['isi'] = Modules::run('appbkpp/profile/ini_pegawai_master',$_POST['idd']);
		$data['status_kepegawaian'] = $data['isi']->status_kepegawaian;
		$this->load->view('nonpns/form_biodata_hapus',$data);
	}

	public function biodata_aksi_hapus()  {
		$id_pegawai = $_POST['id_pegawai'];

		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai_aktual');

		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai_bulanan');

		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai');
	}

























	public function thl()  {
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$rd = "thl_umpeg";
			$data['dua'] = $this->session->userdata('nama_unor');
		} elseif($group_name=="mutasi") {
			$rd = "thl_mutasi";
		} elseif($group_name=="diklat") {
			$rd = "thl_diklat";
		} elseif($group_name=="pempeg") {
			$rd = "thl_pempeg";
		} elseif($group_name=="kepala_opd") {
			$rd = "thl_kepala_opd";
		} else {
			$rd = "thl";
		}

		$data['tab'] = (isset($_POST['tab']))?$_POST['tab']:"aktif";
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = "end";
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['jenis'] = $this->dropdowns->status_kepegawaian();

		$this->load->view('nonpns/'.$rd,$data);
	}



}
?>