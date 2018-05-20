<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Token extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function index(){
		echo "honda";
	}
/////////////////////////////////////////////////////////////////////////////////
	function form_masuk(){
		$hari = $this->dropdowns->hari_konversi();
		$data['jam'] = date('H:i:s');

		$data['satu'] = "ABSENSI MASUK"; 
		$data['hari'] = $hari[date('l')].", ".date('d-m-Y');
		$this->load->view('token/form_masuk',$data);
	}
	function form_pulang(){
		$hari = $this->dropdowns->hari_konversi();
		$data['jam'] = date('H:i:s');

		$data['satu'] = "ABSENSI PULANG"; 
		$data['hari'] = $hari[date('l')].", ".date('d-m-Y');
		$this->load->view('token/form_pulang',$data);
	}

	function input_masuk(){
			$idh = $this->session->userdata('id_harian');
			$sqF = "SELECT * FROM ubina_harian a WHERE a.id_harian='$idh'";
			$qrF = $this->db->query($sqF)->row();

			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$acl=  str_replace($dd,"",$user->unor_akses);

		$tg = $qrF->tanggal_harian;
		$sq = "SELECT a.* FROM ubina_token a WHERE token_masuk='".$_POST['token']."' AND tanggal='$tg' AND a.user_id IN ($acl)";
		$qr = $this->db->query($sq)->row();
///>>>>>>>>>> APEL
		$sqA = "SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel='$tg'";
		$qrA = $this->db->query($sqA)->row();
//<<<<<<<<<<<
		$id_apel = @$qrA->id_apel;

		if(!empty($qr)){
			$idPeg = $qr->id_pegawai;
			$jam = date('H:i:s');

			$sq2 = "SELECT a.*,b.jam_masuk,c.nama_pegawai FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,r_pegawai_aktual c) ON (a.id_jam=b.id_jam AND a.id_pegawai=c.id_pegawai)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg' AND status='TK'";
			$qr2 = $this->db->query($sq2)->row();
			if(!empty($qr2)){

				$jj_masuk = explode(":",$qr2->jam_masuk);
				$n_masuk = (3600*$jj_masuk[0])+(60*$jj_masuk[1])+$jj_masuk[2];
				$aa_masuk = explode(":",$jam);
				$m_masuk = (3600*$aa_masuk[0])+(60*$aa_masuk[1])+$aa_masuk[2];
		
				$jn = $n_masuk-$m_masuk;
				if($jn<0){
					if($jn<(-36000)){	$jb = ($m_masuk-86400)-$n_masuk;	} else {	$jb = -$jn;	}
				} else {	$jb = -$jn;	}
				
				$jk = abs($jb);
//				$jm =  floor($jk/3600);
//				$menit = floor(($jk-($jm*3600))/60);
//				$detik = $jk-(($jm*3600)+($menit*60));

				$jjk = ($jb>0)?$jk:0;

				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_masuk='$jam',selisih_masuk='$jjk',status='H' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
				
				
				if($jjk==0){
						$sqAp = "UPDATE ubina_apel_wajib SET status='H',apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
						$qrAp = $this->db->query($sqAp);
				} else {
						$sqAp = "UPDATE ubina_apel_wajib SET apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
						$qrAp = $this->db->query($sqAp);
				}
				
				
			}
			$sukses = @$qr2->nama_pegawai." Absen Masuk pukul: ".$jam;
		} else {
			$sukses = "Absensi gagal, token tidak terdaftar";
		}
		echo $sukses;
	}
	function input_masuk_pejabat(){
		$tg = date('Y-m-d');
		$sq = "SELECT a.* FROM ubina_token a WHERE token_masuk='".$_POST['token']."' AND tanggal='$tg'";
		$qr = $this->db->query($sq)->row();
///>>>>>>>>>> APEL
		$sqA = "SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel='".date('Y-m-d')."'";
		$qrA = $this->db->query($sqA)->row();
//<<<<<<<<<<<
		$id_apel = @$qrA->id_apel;

		if(!empty($qr)){
			$idPeg = $qr->id_pegawai;
			$jam = date('H:i:s');

			$sqB = "SELECT a.id_harian FROM ubina_harian a WHERE a.tanggal_harian='".date('Y-m-d')."'";
			$qrB = $this->db->query($sqB)->row();
			$idh = $qrB->id_harian;

			$sq2 = "SELECT a.*,b.jam_masuk,c.nama_pegawai FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,r_pegawai_aktual c) ON (a.id_jam=b.id_jam AND a.id_pegawai=c.id_pegawai)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg' AND status='TK'";
			$qr2 = $this->db->query($sq2)->row();
			if(!empty($qr2)){
				$jj_masuk = explode(":",$qr2->jam_masuk);
				$n_masuk = (3600*$jj_masuk[0])+(60*$jj_masuk[1])+$jj_masuk[2];
				$aa_masuk = explode(":",$jam);
				$m_masuk = (3600*$aa_masuk[0])+(60*$aa_masuk[1])+$aa_masuk[2];
		
				$jn = $n_masuk-$m_masuk;
				if($jn<0){
					if($jn<(-36000)){	$jb = ($m_masuk-86400)-$n_masuk;	} else {	$jb = -$jn;	}
				} else {	$jb = -$jn;	}
				
				$jk = abs($jb);
//				$jm =  floor($jk/3600);
//				$menit = floor(($jk-($jm*3600))/60);
//				$detik = $jk-(($jm*3600)+($menit*60));

				$jjk = ($jb>0)?$jk:0;

				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_masuk='$jam',selisih_masuk='$jjk',status='H' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
				
				if($jjk==0){
						$sqAp = "UPDATE ubina_apel_wajib SET status='H',apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
						$qrAp = $this->db->query($sqAp);
				} else {
						$sqAp = "UPDATE ubina_apel_wajib SET apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
						$qrAp = $this->db->query($sqAp);
				}
			}
			$sukses = @$qr2->nama_pegawai." Absen Masuk pukul: ".$jam;
		} else {
			$sukses = "Absensi gagal, token tidak terdaftar";
		}
		echo $sukses;
	}



	function input_pulang(){
			$idh = $this->session->userdata('id_harian');
			$sqF = "SELECT * FROM ubina_harian a WHERE a.id_harian='$idh'";
			$qrF = $this->db->query($sqF)->row();

			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$acl=  str_replace($dd,"",$user->unor_akses);

		$tg = $qrF->tanggal_harian;
		$sq = "SELECT a.* FROM ubina_token a WHERE token_pulang='".$_POST['token']."' AND tanggal='$tg' AND a.user_id IN ($acl)";
		$qr = $this->db->query($sq)->row();

		if(!empty($qr)){
			$idPeg = $qr->id_pegawai;
			$jam = date('H:i:s');

			$sq2 = "SELECT a.*,b.jam_pulang,c.nama_pegawai FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,r_pegawai_aktual c) ON (a.id_jam=b.id_jam AND a.id_pegawai=c.id_pegawai)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg' AND a.status='H'";
			$qr2 = $this->db->query($sq2)->row();
			if(!empty($qr2)){

				$jj_pulang = explode(":",$qr2->jam_pulang);
				$n_pulang = (3600*$jj_pulang[0])+(60*$jj_pulang[1])+$jj_pulang[2];
				$aa_pulang = explode(":",$jam);
				$m_pulang = (3600*$aa_pulang[0])+(60*$aa_pulang[1])+$aa_pulang[2];
		
		
				$jn = $m_pulang-$n_pulang;
				if($jn<0){
					if($jn<(-36000)){
						$jb = -(86400-$n_pulang)-$m_pulang;	} else {	$jb = -$jn;	}
				} else {
					if($jn>36000){	$jb = $n_pulang+(86400-$m_pulang);	} else {	$jb = -$jn;	}
				}
			
				$jk = abs($jb);
//				$jm =  floor($jk/3600);
//				$menit = floor(($jk-($jm*3600))/60);
//				$detik = $jk-(($jm*3600)+($menit*60));

				$jjk = ($jb>0)?$jk:0;
				
				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_pulang='$jam',selisih_pulang='$jjk' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
			}

			$sukses = @$qr2->nama_pegawai." Absen Pulang pukul: ".$jam;
		} else {
			$sukses = "Absensi gagal, token tidak terdaftar";
		}

		echo $sukses;
	}
/////////////////////////////////////////////////////////////////////////////////
	function input_pulang_pejabat(){
			$idh = $this->session->userdata('id_harian');
			$sqF = "SELECT * FROM ubina_harian a WHERE a.id_harian='$idh'";
			$qrF = $this->db->query($sqF)->row();

		$tg = $qrF->tanggal_harian;
		$sq = "SELECT a.* FROM ubina_token a WHERE token_pulang='".$_POST['token']."' AND tanggal='$tg'";
		$qr = $this->db->query($sq)->row();

		if(!empty($qr)){
			$idPeg = $qr->id_pegawai;
			$jam = date('H:i:s');

			$sq2 = "SELECT a.*,b.jam_pulang,c.nama_pegawai FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,r_pegawai_aktual c) ON (a.id_jam=b.id_jam AND a.id_pegawai=c.id_pegawai)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg' AND a.status='H'";
			$qr2 = $this->db->query($sq2)->row();
			if(!empty($qr2)){

				$jj_pulang = explode(":",$qr2->jam_pulang);
				$n_pulang = (3600*$jj_pulang[0])+(60*$jj_pulang[1])+$jj_pulang[2];
				$aa_pulang = explode(":",$jam);
				$m_pulang = (3600*$aa_pulang[0])+(60*$aa_pulang[1])+$aa_pulang[2];
		
		
				$jn = $m_pulang-$n_pulang;
				if($jn<0){
					if($jn<(-36000)){
						$jb = -(86400-$n_pulang)-$m_pulang;	} else {	$jb = -$jn;	}
				} else {
					if($jn>36000){	$jb = $n_pulang+(86400-$m_pulang);	} else {	$jb = -$jn;	}
				}
			
				$jk = abs($jb);
//				$jm =  floor($jk/3600);
//				$menit = floor(($jk-($jm*3600))/60);
//				$detik = $jk-(($jm*3600)+($menit*60));

				$jjk = ($jb>0)?$jk:0;
				
				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_pulang='$jam',selisih_pulang='$jjk' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
			}

			$sukses = @$qr2->nama_pegawai." Absen Pulang pukul: ".$jam;
		} else {
			$sukses = "Absensi gagal, token tidak terdaftar";
		}

		echo $sukses;
	}
/////////////////////////////////////////////////////////////////////////////////
	function urno($min, $max, $quantity) {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}
}
?>