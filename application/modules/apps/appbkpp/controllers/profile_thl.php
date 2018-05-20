<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Profile_thl extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_profil');
		$this->load->model('appdok/m_edok');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Data THL";
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);
		
		$this->session->set_userdata('boleh','ya');
		$this->load->view('profile_thl/index',$data);
	}

	function thl_ini(){
		$this->session->set_userdata('pegawai_info',$_POST['idd']);
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);
		$data['awal'] = (isset($_POST['awal']))?$_POST['awal']:"pasfoto";

		$this->session->set_userdata('boleh',$_POST['boleh']);
		$this->load->view('profile_thl/thl_ini',$data);
	}

	function pasfoto(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$this->konten($id_pegawai);
	}
	function pasfoto_ini($idd){
		$mPeg = $this->m_profil->ini_pegawai_master($idd);
		$nip = $mPeg->nip_baru;

		$cek = $this->m_edok->cek_dokumen($nip,"pasfoto",0);
		if(empty($cek)){
					$foto = base_url()."assets/file/foto/photo.jpg";
		} else {
			$foto = base_url()."assets/media/file/".$nip."/pasfoto/".$cek[0]->file_dokumen;
		}
		return $foto;
	}
	function konten($id_pegawai,$tutup=2){
		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);
		$data['fotoSrc']= $this->pasfoto_ini($id_pegawai);
		$jabatan = end($this->m_profil->ini_pegawai_jabatan($id_pegawai));
		@$data['data']->tmt_jabatan=$jabatan->tmt_jabatan;
		$data['data']->id_pegawai=$id_pegawai;
		$data['cpns']=$this->m_profil->ini_cpns($id_pegawai);
		$data['pns']=$this->m_profil->ini_pns($id_pegawai);
		$pangkat = end($this->m_profil->ini_pegawai_pangkat($id_pegawai));
		@$data['data']->tmt_pangkat=$pangkat->tmt_golongan;
		@$data['data']->nama_pangkat=$pangkat->nama_pangkat;
		@$data['data']->nama_golongan=$pangkat->nama_golongan;
		if($tutup==1){	$data['tutup']=1;	}

		$boleh = $this->session->userdata('boleh');
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";
		$this->load->view('profile_tkk/konten',$data);
	}
	function utama_tkk(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$data['data'] = $this->m_profil->ini_pegawai_master($id_pegawai);
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = ($sess['group_name']=="pengelola" || ($sess['group_name']=="admin") && $boleh=="ya")?"yes":"no";
		$this->load->view('profile_tkk/utama_tkk',$data);
	}
	function ktp(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$id_pegawai);
		$boleh = $this->session->userdata('boleh');
		$data['data'] = $this->m_profil->ini_pegawai_alamat($id_pegawai);


		if(!empty($data['data'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"ktp",$data['data']->id_peg_alamat);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/ktp/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}

		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/ktp',$data);
	}
	function ijazah_pendidikan_tkk(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);
		$data['data'] = $this->m_profil->ini_pegawai_pendidikan($id_pegawai);
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ijazah_pendidikan_tkk",$val->id_peg_pendidikan);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan_tkk/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile_tkk/ijazah_pendidikan',$data);
	}



	function formjabatan_tambah(){
		$data['no'] = $_POST['nomor'];
		$tugas_tambahan = $this->dropdowns->tugas_tambahan();
		$this->load->view('profile_thl/formjabatan_update',$data);
	}
	function formjabatan_edit(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['nomor'];
		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);
		$jab = $this->m_unor->ini_unor($data['val']->id_unor);
		$data['val']->nama_jab_struk = @$jab->nomenklatur_jabatan;
		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));
		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));
		$this->load->view('profile_thl/formjabatan_update',$data);
	}
	function formjabatan_hapus(){
		$data['idd'] = $_POST['idd'];
		$data['no'] = $_POST['nomor'];
		$data['val'] = $this->m_profil->ini_jabatan_riwayat($data['idd']);
		$data['val']->sk_tanggal = date("d-m-Y", strtotime($data['val']->sk_tanggal));
		$data['val']->tmt_jabatan = date("d-m-Y", strtotime($data['val']->tmt_jabatan));
		$this->load->view('profile/formjabatan_hapus',$data);
	}
	function formjabatan_hapus_aksi(){
		$this->db->where('id_peg_jab',$_POST['id_peg_jab']);
		$this->db->delete('r_peg_jab');
	}
	function jabatan_riwayat(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$data['pegawai'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$jabatan = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
			$data['jabatan'] = '';
			$mulai=0;
			foreach($jabatan as $row){
				$row->no=$mulai+1;
				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));
				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));
				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);
				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
				$data['jabatan'] .= $this->load->view('profile_thl/formjabatan_row',array('val'=>$row),true);
				$mulai++;
			}
			$data['no'] = $mulai+1;
		echo json_encode($data);
	}

	function sk_jabatan(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$data['pegawai'] = $this->m_profil->ini_pegawai_master($id_pegawai);

		$jabatan = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
			$data['jabatan'] = '';
			$mulai=0;
			foreach($jabatan as $row){
				$row->no=$mulai+1;
				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));
				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));
				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);
				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
				$data['jabatan'] .= $this->load->view('profile_thl/formjabatan_row',array('val'=>$row),true);
				$mulai++;
			}
		$data['no']=$mulai+1;

		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile_thl/sk_jabatan',$data);
	}
	function spj_kegiatan(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);
		
		$sqlstr="SELECT * FROM r_peg_spj_kegiatan WHERE id_pegawai='$id_pegawai'";
		$data['data'] = $this->db->query($sqlstr)->result();
		
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"spj_kegiatan",$val->id_spj_kegiatan);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/spj_kegiatan/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="mutasi") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile_thl/spj_kegiatan',$data);
	}

	function formspj_kegiatan_tambah_aksi(){
			$this->db->set('id_pegawai',$_POST['id_pegawai']);
			$this->db->set('tahun',$_POST['tahun']);
			$this->db->set('nomor_dpa',$_POST['nomor_dpa']);
			$this->db->set('judul_dpa',$_POST['judul_dpa']);
			$this->db->set('nip_pptk',$_POST['nip_pptk']);
			$this->db->set('nama_pptk',$_POST['nama_pptk']);
			$this->db->insert('r_peg_spj_kegiatan');
			
			echo "sukses";
	}
	function formspj_kegiatan_edit_aksi(){
			$this->db->set('tahun',$_POST['tahun']);
			$this->db->set('nomor_dpa',$_POST['nomor_dpa']);
			$this->db->set('judul_dpa',$_POST['judul_dpa']);
			$this->db->set('nip_pptk',$_POST['nip_pptk']);
			$this->db->set('nama_pptk',$_POST['nama_pptk']);
			$this->db->where('id_spj_kegiatan',$_POST['id_spj_kegiatan']);
			$this->db->update('r_peg_spj_kegiatan');
			
			echo "sukses";
	}
	function formspj_kegiatan_hapus_aksi(){
			$this->db->where('id_spj_kegiatan',$_POST['id_spj_kegiatan']);
			$this->db->delete('r_peg_spj_kegiatan');
			
			echo "sukses";
	}

	function sertifikat_kursus(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);
		$data['data'] = $this->m_profil->ini_pegawai_kursus($id_pegawai);
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_kursus",$val->id_peg_kursus);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_kursus/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/sertifikat_kursus',$data);
	}
	function sertifikat_penghargaan(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$boleh = $this->session->userdata('boleh');
		$pegawai = $this->m_profil->ini_pegawai_master($id_pegawai);
		$data['data'] = $this->m_profil->get_sertifikat_penghargaan($id_pegawai);
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sertifikat_penghargaan",$val->id_peg_penghargaan);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_penghargaan/thumb_".$dok_ref[0]->file_dokumen;
		}
		$sess = $this->session->userdata('logged_in');
		$data['editable'] = (($sess['group_name']=="admin" || $sess['group_name']=="pengelola" || $sess['group_name']=="pegmasuk") && $boleh=="ya")?"yes":"no";

		$this->load->view('profile/sertifikat_penghargaan',$data);
	}

}
?>