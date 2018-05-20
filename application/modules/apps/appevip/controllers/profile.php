<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Profile extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
//		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
  function index()  {
		$this->load->model('appbkpp/m_profil');
		$this->session->set_userdata('pegawai_info',$_POST['idd']);
		$data['data'] = $this->m_profil->ini_pegawai($_POST['idd']);
		$data['pasfoto'] = $this->pasfoto($data['data']->nip_baru);

		$sql = "SELECT * FROM evip_fungsi WHERE id_unor='".$data['data']->id_unor."'";
		$data['fungsi'] = $this->db->query($sql)->result();

		$this->load->view('profile/index',$data);
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
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
	function ijazah_pendidikan(){
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');

		$this->session->set_userdata('boleh','tidak');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);
		$data['id_unor'] = $pegawai->id_unor;

		$sql = "SELECT a.*,EXTRACT(YEAR FROM a.tanggal_lulus) AS tahun_lulus,b.id_ip_pendidikan_item
		FROM r_peg_pendidikan a
		LEFT JOIN evip_pendidikan_item b ON (a.id_peg_pendidikan=b.id_peg_pendidikan  AND b.id_unor='".$pegawai->id_unor."')
		WHERE a.id_pegawai='$id_peg' ORDER BY a.kode_jenjang";
		$data['data'] = $this->db->query($sql)->result();

		foreach($data['data'] AS $key=>$val){
			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ijazah_pendidikan",$val->id_peg_pendidikan);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
		}

		$sql = "SELECT * FROM evip_pendidikan_gap WHERE id_pegawai='$id_peg' AND id_unor='".$pegawai->id_unor."'";
		$hsl = $this->db->query($sql)->row();
		$data['gap'] = @$hsl->id_ip_pendidikan_gap;

		$this->load->view('profile/pendidikan',$data);
	}
///////////////////////////////////
	function check_pendidikan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="hapus"){
			$this->db->where('id_unor',$pegawai->id_unor);
			$this->db->where('id_peg_pendidikan',$_POST['idd']);
			$this->db->delete('evip_pendidikan_item');
		}
		if($_POST['aksi']=="isi"){
			$this->db->set('id_unor',$pegawai->id_unor);
			$this->db->set('id_peg_pendidikan',$_POST['idd']);
			$this->db->insert('evip_pendidikan_item');
		}
		echo "ok";
	}
///////////////////////////////////
	function gap_pendidikan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="n"){
			$this->db->where('id_unor',$_POST['idd']);
			$this->db->where('id_pegawai',$id_peg);
			$this->db->delete('evip_pendidikan_gap');
		}
		if($_POST['aksi']=="y"){
			$this->db->set('id_unor',$_POST['idd']);
			$this->db->set('id_pegawai',$id_peg);
			$this->db->insert('evip_pendidikan_gap');
		}
		echo "ok";
	}
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
	function administrasi(){
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');

		$this->session->set_userdata('boleh','tidak');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);
		$data['id_unor'] = $pegawai->id_unor;

		$sql = "SELECT a.* FROM r_peg_diklat_struk a 
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE id_pegawai='$id_peg' AND a.id_diklat IN (SELECT c.id_diklat FROM md_diklat c WHERE c.id_rumpun=2)";
		$data['data'] = $this->db->query($sql)->result();


		foreach($data['data'] AS $key=>$val){
			$id_rumpun = $val->id_rumpun;
			$rumpun = Modules::run("appdiklat/kursus/rumpun_diklat");
			$nama_rumpun = @$rumpun[$val->id_rumpun];
			@$data['data'][$key]->nama_rumpun = $nama_rumpun;
			


			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$nama_rumpun,$val->id_peg_diklat_struk);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sertifikat_diklat/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
			@$data['data'][$key]->nama_rumpun = $nama_rumpun;
					$this->db->select('id_ip_administrasi_item');
					$this->db->from('evip_administrasi_item');
					$this->db->where('id_unor',$pegawai->id_unor);
					$this->db->where('id_peg_diklat_struk',$val->id_peg_diklat_struk);
					$hsl = $this->db->get()->row();
			$data['data'][$key]->id_ip_pelatihan_item = @$hsl->id_ip_pelatihan_item;
		}

		$sql = "SELECT * FROM evip_administrasi_gap WHERE id_pegawai='$id_peg' AND id_unor='".$pegawai->id_unor."'";
		$hsl = $this->db->query($sql)->row();
		$data['gap'] = @$hsl->id_ip_administrasi_gap;


		$this->load->view('profile/administrasi',$data);
	}
///////////////////////////////////
	function check_administrasi_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="hapus"){
			$this->db->where('id_unor',$pegawai->id_unor);
			$this->db->where('id_peg_diklat_struk',$_POST['idd']);
			$this->db->delete('evip_administrasi_item');
		}
		if($_POST['aksi']=="isi"){
			$this->db->set('id_unor',$pegawai->id_unor);
			$this->db->set('id_peg_diklat_struk',$_POST['idd']);
			$this->db->insert('evip_administrasi_item');
		}
		echo "ok";
	}
///////////////////////////////////
	function gap_administrasi_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="n"){
			$this->db->where('id_unor',$_POST['idd']);
			$this->db->where('id_pegawai',$id_peg);
			$this->db->delete('evip_administrasi_gap');
		}
		if($_POST['aksi']=="y"){
			$this->db->set('id_unor',$_POST['idd']);
			$this->db->set('id_pegawai',$id_peg);
			$this->db->insert('evip_administrasi_gap');
		}
		echo "ok";
	}
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
	function pelatihan(){
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');

		$this->session->set_userdata('boleh','tidak');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);
		$data['id_unor'] = $pegawai->id_unor;

		$sql = "SELECT a.*,b.id_rumpun AS id_rumpun FROM r_peg_diklat_struk a 
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE a.id_pegawai='$id_peg' AND a.id_diklat IN (SELECT c.id_diklat FROM md_diklat c WHERE  c.id_rumpun NOT IN (1,2,0))";
		$data['data'] = $this->db->query($sql)->result();


		foreach($data['data'] AS $key=>$val){
			$id_rumpun = $val->id_rumpun;
			$rumpun = Modules::run("appdiklat/kursus/rumpun_diklat");
			$nama_rumpun = @$rumpun[$val->id_rumpun];
			$nm_rp = strtolower($nama_rumpun);
			$nm_rp = str_replace(" ","_",$nm_rp);


			$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,$nm_rp,$val->id_peg_diklat_struk);
			@$data['data'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/".$nm_rp."/thumb_".$dok_ref[0]->file_dokumen;
			@$data['data'][$key]->gbr = (empty($dok_ref))?"kosong":"ada";
			@$data['data'][$key]->nama_rumpun = $nama_rumpun;
			@$data['data'][$key]->nm_rp = $nm_rp;

					$this->db->select('id_ip_pelatihan_item');
					$this->db->from('evip_pelatihan_item');
					$this->db->where('id_unor',$pegawai->id_unor);
					$this->db->where('id_peg_diklat_struk',$val->id_peg_diklat_struk);
					$hsl = $this->db->get()->row();
			$data['data'][$key]->id_ip_pelatihan_item = @$hsl->id_ip_pelatihan_item;
		}

		$sql = "SELECT * FROM evip_pelatihan_gap WHERE id_pegawai='$id_peg' AND id_unor='".$pegawai->id_unor."'";
		$hsl = $this->db->query($sql)->row();
		$data['gap'] = @$hsl->id_ip_pelatihan_gap;

		$this->load->view('profile/pelatihan',$data);
	}
///////////////////////////////////
	function check_pelatihan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="hapus"){
			$this->db->where('id_unor',$pegawai->id_unor);
			$this->db->where('id_peg_diklat_struk',$_POST['idd']);
			$this->db->delete('evip_pelatihan_item');
		}
		if($_POST['aksi']=="isi"){
			$this->db->set('id_unor',$pegawai->id_unor);
			$this->db->set('id_peg_diklat_struk',$_POST['idd']);
			$this->db->insert('evip_pelatihan_item');
		}
		echo "ok";
	}
///////////////////////////////////
	function gap_pelatihan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="n"){
			$this->db->where('id_unor',$_POST['idd']);
			$this->db->where('id_pegawai',$id_peg);
			$this->db->delete('evip_pelatihan_gap');
		}
		if($_POST['aksi']=="y"){
			$this->db->set('id_unor',$_POST['idd']);
			$this->db->set('id_pegawai',$id_peg);
			$this->db->insert('evip_pelatihan_gap');
		}
		echo "ok";
	}
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
	function jabatan(){
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_profil');

		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['pegawai'] = $this->m_profil->ini_pegawai($id_pegawai);
		$boleh = $this->session->userdata('boleh');
		$sess = $this->session->userdata('logged_in');
		$editable = "yes";
		$data['id_unor'] = $data['pegawai']->id_unor;

		$jabatan = $this->m_profil->ini_pegawai_jabatan($id_pegawai);
			$data['jabatan'] = '';
			$mulai=0;
			foreach($jabatan as $row){
				$row->no=$mulai+1;
				$row->tmt_jabatan = date("d-m-Y", strtotime($row->tmt_jabatan));
				$row->sk_tanggal = date("d-m-Y", strtotime($row->sk_tanggal));
				$dok_ref = $this->m_edok->cek_dokumen($data['pegawai']->nip_baru,"sk_jabatan",$row->id_peg_jab);
				$row->editable = $editable;
				$row->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$data['pegawai']->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
					$this->db->select('id_ip_jabatan_item');
					$this->db->from('evip_jabatan_item');
					$this->db->where('id_unor',$data['pegawai']->id_unor);
					$this->db->where('id_peg_jab',$row->id_peg_jab);
					$hsl = $this->db->get()->row();
				$row->id_ip_jabatan_item = @$hsl->id_ip_jabatan_item;
				$row->sekarang = ($row->id_unor==$data['pegawai']->id_unor)?"sama":"tidak";
				$data['jabatan'] .= $this->load->view('profile/jabatan_row',array('val'=>$row),true);
				$mulai++;
			}
		$data['no']=$mulai+1;

		$sql = "SELECT * FROM evip_jabatan_gap WHERE id_pegawai='$id_pegawai' AND id_unor='".$data['pegawai']->id_unor."'";
		$hsl = $this->db->query($sql)->row();
		$data['gap'] = @$hsl->id_ip_jabatan_gap;

		$this->load->view('profile/jabatan',$data);
	}
///////////////////////////////////
	function check_jabatan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="hapus"){
			$this->db->where('id_unor',$pegawai->id_unor);
			$this->db->where('id_peg_jab',$_POST['idd']);
			$this->db->delete('evip_jabatan_item');
		}
		if($_POST['aksi']=="isi"){
			$this->db->set('id_unor',$pegawai->id_unor);
			$this->db->set('id_peg_jab',$_POST['idd']);
			$this->db->insert('evip_jabatan_item');
		}
		echo "ok";
	}
///////////////////////////////////
	function gap_jabatan_aksi(){
		$this->load->model('appbkpp/m_profil');
		$id_peg = $this->session->userdata('pegawai_info');
		$pegawai = $this->m_profil->ini_pegawai($id_peg);

		if($_POST['aksi']=="n"){
			$this->db->where('id_unor',$_POST['idd']);
			$this->db->where('id_pegawai',$id_peg);
			$this->db->delete('evip_jabatan_gap');
		}
		if($_POST['aksi']=="y"){
			$this->db->set('id_unor',$_POST['idd']);
			$this->db->set('id_pegawai',$id_peg);
			$this->db->insert('evip_jabatan_gap');
		}
		echo "ok";
	}

}
?>