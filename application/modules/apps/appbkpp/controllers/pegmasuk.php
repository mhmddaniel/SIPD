<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pegmasuk extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_pegmasuk');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['asal'] = (isset($_POST['asal']))?$_POST['asal']:"module/appbkpp/pegawai/aktif";

		$sess = $this->session->userdata('logged_in');
		$data['group_name'] = $sess['group_name'];

		$this->load->view('pegmasuk/index',$data);
	}
	public function getdata()  {
		$data['count'] = $this->m_pegmasuk->hitung_pegawai($_POST['cari']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_pegmasuk->get_pegawai($_POST['cari'],$mulai,$batas);
			foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

					$cpns = Modules::run('appbkpp/profile/ini_pegawai_cpns',$val->id_pegawai);
					$pns = Modules::run('appbkpp/profile/ini_pegawai_pns',$val->id_pegawai);
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
					$data['hslquery'][$key]->hapus = (empty($cpns) && empty($pns))? "ya":"tidak";
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	public function formpeg()  {
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = ($_POST['cari']!="undefined")?$_POST['cari']:"";
		if($_POST['id_pegawai']!="xx"){
			$data['val'] = Modules::run("appbkpp/profile/ini_pegawai_master",$_POST['id_pegawai']);
		}
		$this->load->view('pegmasuk/formpeg',$data);
	}
	function simpan_aksi(){
		$isi = $_POST;
		$isi['tanggal_lahir'] = date("Y-m-d", strtotime($_POST['tanggal_lahir']));
		$id_pegawai = $_POST['id_pegawai'];
		$cek = $this->m_pegawai->get_pegawai_master_by_nip($_POST['nip_baru']);
		if($id_pegawai!=""){
				$isi['nip_baru'] = (empty($cek))?$_POST['nip_baru']:"";
				$this->m_pegmasuk->simpan_aksi($id_pegawai,$isi);
				echo "sukses";
		} else {
					if(empty($cek)){
						$this->m_pegmasuk->simpan_aksi($id_pegawai,$isi);
						echo "sukses";
					} else {
						echo "NIP BARU sudah tercatat dalam dB, tidak bisa di-input ulang!!!";
					}
		}
	}
	public function formpeg_hapus()  {
		$data['satu'] = "Daftar Pegawai";
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:1;
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = ($_POST['cari']!="undefined")?$_POST['cari']:"";

		$data['val'] = Modules::run("appbkpp/profile/ini_pegawai_master",$_POST['id_pegawai']);
		$data['hapus'] = "ya";

		$this->load->view('pegmasuk/formpeg',$data);
	}
	public function hapus_aksi()  {
		$this->m_pegmasuk->hapus_aksi($_POST['id_pegawai']);
		echo "sukses";
	}
/////////////////////////////////////////////////////////////////////////////
	public function biodata()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['fotoSrc'] = Modules::run("appbkpp/profile/pasfoto_ini",$data['id_pegawai']);
		$this->load->view('pegmasuk/biodata',$data);
	}
	public function alamat()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$data['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"ktp",$data['isi']->id_peg_alamat);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/ktp/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$data['token'] = sha1('data_edit_ktp_'.$data['id_pegawai']);
		$this->session->set_userdata('token_form',$data['token']);
		$this->load->view('pegmasuk/alamat',$data);
	}
	public function karpeg()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_karpeg",$data['id_pegawai']);

		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"karpeg",$data['isi']->id_karpeg);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/karpeg/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/karpeg',$data);
	}
	public function taspen()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_taspen",$data['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"taspen",$data['isi']->id_taspen);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/taspen/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/taspen',$data);
	}
	public function prajab()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_prajabatan",$data['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sertifikat_prajab",$data['isi']->id_peg_diklat_struk);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sertifikat_prajab/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/prajab',$data);
	}
	public function cpns()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_cpns",$data['id_pegawai']);

		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_cpns",$data['isi']->id);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_cpns/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/cpns',$data);
	}
	public function pns()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_pns",$data['id_pegawai']);

		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_pns",$data['isi']->id);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_pns/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/pns',$data);
	}
	public function konversi_nip()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_konversi_nip",$data['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"konversi_nip",$data['isi']->id_konversi_nip);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/konversi_nip/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/konversi_nip',$data);
	}
	public function pupns()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_pupns",$data['id_pegawai']);
		if(!empty($data['isi'])){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"pupns",$data['isi']->id_pupns);
			@$data['thumb'] = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/pupns/thumb_".$dok_ref[0]->file_dokumen;
		} else {
			$data['thumb'] = "assets/file/foto/photo.jpg";
		}
		$this->load->view('pegmasuk/pupns',$data);
	}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
	public function pendidikan_formal()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['pendidikan'] = Modules::run("appbkpp/profile/ijazah_pendidikan");
		$this->load->view('pegmasuk/pendidikan',$data);
	}
	public function kursus()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['kursus'] = Modules::run("appbkpp/profile/sertifikat_kursus");
		$this->load->view('pegmasuk/kursus',$data);
	}
	public function diklat_struk()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['diklat'] = Modules::run("appbkpp/profile/sertifikat_diklat");
		$this->load->view('pegmasuk/diklat_struk',$data);
	}
	public function ijin_belajar()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_ibel",$data['id_pegawai']);
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"ibel",$val->id_peg_ibel);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/ibel/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$this->load->view('pegmasuk/ibel',$data);
	}
	public function penyesuaian_ijazah()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_penyesuaian_ijazah",$data['id_pegawai']);
		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"penyesuaian_ijazah",$val->id_peg_penyesuaian_ijazah);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/penyesuaian_ijazah/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$this->load->view('pegmasuk/penyesuaian_ijazah',$data);
	}
	public function pernikahan()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['pernikahan'] = Modules::run("appbkpp/profile/karis_karsu");
		$this->load->view('pegmasuk/pernikahan',$data);
	}
	public function anak()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['anak'] = Modules::run("appbkpp/profile/anak");
		$this->load->view('pegmasuk/anak',$data);
	}
	public function pangkat()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['pangkat'] = Modules::run("appbkpp/profile/sk_pangkat");
		$this->load->view('pegmasuk/pangkat',$data);
	}
	public function pak()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['pak'] = Modules::run("appbkpp/profile/pak");
		$this->load->view('pegmasuk/pak',$data);
	}
	public function dp3()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['dp3'] = Modules::run("appbkpp/profile/dp3");
		$this->load->view('pegmasuk/dp3',$data);
	}
	public function penghargaan()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$this->session->set_userdata('boleh','ya');
		$data['penghargaan'] = Modules::run("appbkpp/profile/sertifikat_penghargaan");
		$this->load->view('pegmasuk/penghargaan',$data);
	}
	public function jabatan()  {
		$data['id_pegawai'] = $this->session->userdata('pegawai_info');
		$data['pegawai'] = Modules::run("appbkpp/profile/ini_pegawai_master",$data['id_pegawai']);
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$data['id_pegawai']);
		foreach($data['jabatan'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$val->id_peg_jab);
			@$data['jabatan'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
			@$data['jabatan'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}
		$this->load->view('pegmasuk/jabatan',$data);
	}
///////////////////////////////////////////////////////////////////////////////////
	public function set_user()  {
		$sqlstr="DELETE FROM users WHERE user_id IN (SELECT user_id FROM user_pegmasuk)";
		$this->db->query($sqlstr);
		$sqlstr = "TRUNCATE TABLE user_pegmasuk";
		$query = $this->db->query($sqlstr);
		$sqlstrN="SELECT id_item FROM cmf_setting WHERE  id_setting='13' AND nama_item='pegmasuk'";
		$hslqueryN=$this->db->query($sqlstrN)->row();
		$sqlstr="SELECT a.id_pegawai,a.nama_pegawai,a.nip_baru FROM (r_pegawai a) WHERE  a.status='masuk'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$passwd = sha1($val->nip_baru);
			$this->db->set('username',$val->nip_baru);
			$this->db->set('nama_user',$val->nama_pegawai);
			$this->db->set('group_id',$hslqueryN->id_item);
			$this->db->set('passwd',$passwd);
			$this->db->set('status','on');
			$this->db->insert('users');
			$user_id = $this->db->insert_id();

			$this->db->set('user_id',$user_id);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->insert('user_pegmasuk');
		}
		redirect(site_url("module/appbkpp/pegmasuk"));
	}
	public function aktifin()  {
		$pegawai = Modules::run("appbkpp/profile/ini_pegawai_master",$_POST['id_pegawai']);
		$pangkat = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$_POST['id_pegawai']);
		$pangkat = end($pangkat);
		$pendidikan = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$_POST['id_pegawai']);
		$pendidikan = end($pendidikan);
		$cpns = Modules::run("appbkpp/profile/ini_pegawai_cpns",$_POST['id_pegawai']);
		$pns = Modules::run("appbkpp/profile/ini_pegawai_pns",$_POST['id_pegawai']);

			$this->db->set('id_pegawai',$pegawai->id_pegawai);
			$this->db->set('nip',$pegawai->nip);
			$this->db->set('nip_baru',$pegawai->nip_baru);
			$this->db->set('nama_pegawai',$pegawai->nama_pegawai);
			$this->db->set('gelar_nonakademis',$pegawai->gelar_nonakademis);
			$this->db->set('gelar_depan',$pegawai->gelar_depan);
			$this->db->set('gelar_belakang',$pegawai->gelar_belakang);
			$this->db->set('gender',$pegawai->gender);
			$this->db->set('tempat_lahir',$pegawai->tempat_lahir);
			$this->db->set('tanggal_lahir',$pegawai->tanggal_lahir);
			$this->db->set('status_perkawinan',$pegawai->status_perkawinan);
			$this->db->set('status_kepegawaian','pns');
			$this->db->set('kode_golongan',@$pangkat->kode_golongan);
			$this->db->set('nama_golongan',@$pangkat->nama_golongan);
			$this->db->set('nama_pangkat',@$pangkat->nama_pangkat);
			$this->db->set('tmt_pangkat',@$pangkat->tmt_golongan);
			$this->db->set('mk_gol_tahun',@$pangkat->mk_gol_tahun);
			$this->db->set('mk_gol_bulan',@$pangkat->mk_gol_bulan);
			$this->db->set('nama_jenjang',@$pendidikan->nama_jenjang);
			$this->db->set('nama_jenjang_rumpun',@$pendidikan->nama_jenjang_rumpun);
			$this->db->set('tanggal_lulus',@$pendidikan->tanggal_lulus);
			$this->db->set('tmt_cpns',@$cpns->tmt_cpns);
			$this->db->set('tmt_pns',@$pns->tmt_pns);
			$this->db->insert('r_pegawai_aktual');

			$this->db->set('status','fix');
			$this->db->where('id_pegawai',$pegawai->id_pegawai);
			$this->db->update('r_pegawai');


			$sqlstrN="SELECT id_item FROM cmf_setting WHERE  id_setting='13' AND nama_item='pegawai'";
			$hslqueryN=$this->db->query($sqlstrN)->row();

			$this->db->set('group_id',$hslqueryN->id_item);
			$this->db->where('username',$pegawai->nip_baru);
			$this->db->update('users');

			$sqlstrN="SELECT user_id FROM users WHERE  username='".$pegawai->nip_baru."'";
			$hslqueryN=$this->db->query($sqlstrN)->row();

			$this->db->where('id_pegawai',$pegawai->id_pegawai);
			$this->db->delete('user_pegmasuk');

			$this->db->set('user_id',$hslqueryN->user_id);
			$this->db->set('id_pegawai',$pegawai->id_pegawai);
			$this->db->insert('user_pegawai');

		redirect(site_url("module/appbkpp/pegmasuk"));
	}

}
?>