<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Profile_pegjab extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appevjab/m_anjab');
		$this->load->model('appevjab/m_komdas');
		$this->load->model('appbkpp/m_profil');
		$this->load->model('appbkpp/m_unor');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function pegawai(){
		$this->session->set_userdata('pegawai_info',$_POST['idd']);
		$data['data'] = $this->m_profil->ini_pegawai($_POST['idd']);
		$data['pasfoto'] = $this->pasfoto($data['data']->nip_baru);
		$this->load->view('profile/pegawai',$data);
	}
	function index(){
		$data['satu'] = "Data Pegawai";
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['data'] = $this->m_profil->ini_pegawai($id_pegawai);
		$data['pasfoto'] = $this->pasfoto($data['data']->nip_baru);
		$asalx = $this->session->userdata('asal');
		if($asalx!=""){
			$data['cari'] = $this->session->userdata('cari');
			$data['batas'] = $this->session->userdata('batas');
			$data['hal'] = $this->session->userdata('hal');
			$data['kode'] = $this->session->userdata('kode');
			$data['pns'] = $this->session->userdata('pns');
			$data['pkt'] = $this->session->userdata('pkt');
			$data['jbt'] = $this->session->userdata('jbt');
			$data['ese'] = $this->session->userdata('ese');
			$data['tugas'] = $this->session->userdata('tugas');
			$data['gender'] = $this->session->userdata('gender');
			$data['agama'] = $this->session->userdata('agama');
			$data['status'] = $this->session->userdata('status');
			$data['jenjang'] = $this->session->userdata('jenjang');
			$data['umur'] = $this->session->userdata('umur');
			$data['mkcpns'] = $this->session->userdata('mkcpns');
			$data['asal'] = $asalx;
		}
		$this->session->set_userdata('asal',"");
		$this->load->view('profile/index',$data);
	}

	function alih(){
		$this->session->set_userdata('umur',$_POST['umur']);
		$this->session->set_userdata('jenjang',$_POST['jenjang']);
		$this->session->set_userdata('status',$_POST['status']);
		$this->session->set_userdata('mkcpns',$_POST['mkcpns']);
		$this->session->set_userdata('asal',$_POST['asal']);
		if(isset($_POST['awal'])){	
			$this->session->set_userdata('awal',$_POST['awal']); 
			$this->session->set_userdata('stt',$_POST['stt']); 
		}
		if($_POST['asal']=="appevjab/pegawai/aktif_umpeg"){	$this->session->set_userdata('boleh',"ya");	} else {	$this->session->set_userdata('boleh',"tidak");	}
		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);
		redirect(site_url("module/appevjab/profile_pegjab"));
	}

	function ihtisar(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['ihtisar'] = $this->m_anjab->get_ihtisar($jbt->nomenklatur_unor,'js');
		} else {
			$data['ihtisar'] = $this->m_anjab->get_ihtisar_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/ihtisar',$data);
	}
	function urtug(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['urtug'] = $this->m_anjab->get_urtug($jbt->nomenklatur_unor,'js');
		} else {
			$data['urtug'] = $this->m_anjab->get_urtug_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/urtug',$data);
	}
	function urtug_tahapan(){
		$id_urtug = $_POST['idd'];
		$data['tahapan'] = $this->m_anjab->get_urtug_tahapan($id_urtug);
		$this->load->view('profile/urtug_tahapan',$data);
	}
	function bahan(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['bahan'] = $this->m_anjab->get_bahan($jbt->nomenklatur_unor,'js');
		} else {
			$data['bahan'] = $this->m_anjab->get_bahan_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/bahan',$data);
	}
	function alat(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['alat'] = $this->m_anjab->get_alat($jbt->nomenklatur_unor,'js');
		} else {
			$data['alat'] = $this->m_anjab->get_alat_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/alat',$data);
	}
	function hasil(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['hasil'] = $this->m_anjab->get_hasil($jbt->nomenklatur_unor,'js');
		} else {
			$data['hasil'] = $this->m_anjab->get_hasil_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/hasil',$data);
	}
	function tanggungjawab(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['tanggungjawab'] = $this->m_anjab->get_tanggungjawab($jbt->nomenklatur_unor,'js');
		} else {
			$data['tanggungjawab'] = $this->m_anjab->get_tanggungjawab_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/tanggungjawab',$data);
	}
	function wewenang(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['wewenang'] = $this->m_anjab->get_wewenang($jbt->nomenklatur_unor,'js');
		} else {
			$data['wewenang'] = $this->m_anjab->get_wewenang_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/wewenang',$data);
	}
	function korelasi(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['korelasi'] = $this->m_anjab->get_korelasi($jbt->nomenklatur_unor,'js');
		} else {
			$data['korelasi'] = $this->m_anjab->get_korelasi_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/korelasi',$data);
	}
	function kondisi(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['kondisi'] = $this->m_anjab->get_kondisi($jbt->nomenklatur_unor,'js');
		} else {
			$data['kondisi'] = $this->m_anjab->get_kondisi_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/kondisi',$data);
	}
	function resiko(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['resiko'] = $this->m_anjab->get_resiko($jbt->nomenklatur_unor,'js');
		} else {
			$data['resiko'] = $this->m_anjab->get_resiko_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/resiko',$data);
	}
	function prestasi(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_pegawai);
		if($pegawai->jab_type=="js"){
			$jbt = $this->m_unor->ini_unor($pegawai->id_unor);
			$data['prestasi'] = $this->m_anjab->get_prestasi($jbt->nomenklatur_unor,'js');
		} else {
			$data['prestasi'] = $this->m_anjab->get_prestasi_nama($pegawai->nomenklatur_jabatan,$pegawai->jab_type);
		}
		$this->load->view('profile/prestasi',$data);
	}
	function inggris(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['val'] = $this->m_komdas->ini_inggris($id_pegawai);
		$data['penguasaan'] = $this->penguasaan();
		$data['penerapan'] = $this->penerapan();
		$this->load->view('profile/inggris',$data);
	}
	function inggris_edit(){
		$this->m_komdas->edit_inggris($_POST);
		$hss = ($_POST['kol']=="pg")?$this->penguasaan():$this->penerapan();
		if($_POST['nl']=="hpp"){	echo "...";	} else {	echo $hss[$_POST['nl']];	}
	}
	function rekomendasi(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['val'] = $this->m_komdas->ini_rekomendasi($id_pegawai);
		$this->load->view('profile/rekomendasi',$data);
	}
	function rekomendasi_edit(){
		$this->m_komdas->edit_rekomendasi($_POST);
		echo $_POST['rekomendasi'];
	}
	function komputer(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['val'] = $this->m_komdas->ini_tik($id_pegawai);
		$data['penguasaan'] = $this->penguasaan();
		$data['penerapan'] = $this->penerapan();
		$this->load->view('profile/komputer',$data);
	}
	function komputer_edit(){
		$this->m_komdas->edit_tik($_POST);
		$hss = ($_POST['kol']=="pg")?$this->penguasaan():$this->penerapan();
		if($_POST['nl']=="hpp"){	echo "...";	} else {	echo $hss[$_POST['nl']];	}
	}
	function jabatan(){
		$this->session->set_userdata('boleh','tidak');
		echo Modules::run("appbkpp/profile/sk_jabatan");
	}
	function ijazah_pendidikan(){
		$this->session->set_userdata('boleh','tidak');
		echo Modules::run("appbkpp/profile/ijazah_pendidikan");
	}
	function sertifikat_prajab(){
		$this->session->set_userdata('boleh','tidak');
		echo Modules::run("appbkpp/profile/sertifikat_prajab");
	}
	function sertifikat_diklat(){
		$this->session->set_userdata('boleh','tidak');
		echo Modules::run("appbkpp/profile/sertifikat_diklat");
	}
	function sertifikat_kursus(){
		$this->session->set_userdata('boleh','tidak');
		echo Modules::run("appbkpp/profile/sertifikat_kursus");
	}
//////////////////////////////////////////////////////////////////////
	function pasfoto($nip_baru){
		$sqlstr = "SELECT file_dokumen FROM r_peg_dokumen WHERE nip_baru='".$nip_baru."' AND tipe_dokumen='pasfoto'";
		$cek=$this->db->query($sqlstr)->row();
		if(empty($cek)){
			$foto = "<img src='".base_url()."assets/file/foto/photo.jpg' width='80'><br>";
		} else {
			$path="assets/media/file/".$nip_baru."/pasfoto/thumb_".$cek->file_dokumen;
			if(file_exists($path)){
				$foto = "<img src='".base_url()."assets/media/file/".$nip_baru."/pasfoto/thumb_".$cek->file_dokumen."'><br>";
			} else {
				$foto = "<img src='".base_url()."assets/file/foto/photo.jpg' width='100'><br>";
			}
		}
		return $foto;
	}

  function penguasaan($asRef=false)
  {
    if(!$asRef){
      $select [''] = '...';
    }else{
      $select [''] = '-';
    }
    $select ['TM']	= 'Tidak menguasai';
    $select ['PA']  = 'Pemula';
    $select ['MH']  = 'Menengah';
    $select ['MR']  = 'Mahir';
    
    return $select;
  }

  function penerapan($asRef=false)
  {
    if(!$asRef){
      $select [''] = '...';
    }else{
      $select [''] = '-';
    }
    $select ['TP']	= 'Tidak pernah';
    $select ['JG']  = 'Jarang';
    $select ['SH']  = 'Setiap hari';
    
    return $select;
  }


}
?>