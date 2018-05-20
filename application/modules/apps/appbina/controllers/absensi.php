<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Absensi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbina/m_apel');
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
	function pegawai(){
		$data['bulan'] = $this->dropdowns->bulan3();
		$data['tutup'] = "ya";
		$sess = $this->session->userdata('logged_in');
		$data['boleh'] = ($sess['group_name']=="pempeg")?"ya":"tidak";
		$this->session->set_userdata('pegawai_info',$_POST['idd']);
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai",$_POST['idd']);
		$this->load->view('absensi/pegawai',$data);
	}
	function pegawai_catatan(){
		$hari = $this->dropdowns->hari_konversi();
		$id_pegawai = $this->session->userdata('pegawai_info');
		$prd = explode("-",$_POST['period']);
		$bln = (strlen($prd[1])==1)?"0".$prd[1]:$prd[1];
		$period = $prd[0]."-".$bln;
		$hHarian = date("Y-m-d");
		
		$stt['H'] = '<div class="btn btn-primary btn-xs gt"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
		$stt['S'] = '<div class="btn btn-warning btn-xs gt"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
		$stt['I'] = '<div class="btn btn-info btn-xs gt"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
		$stt['DL'] = '<div class="btn btn-success btn-xs gt"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
		$stt['TK'] = '<div class="btn btn-danger btn-xs gt"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		$stt['C'] = '<div class="btn btn-success btn-xs gt"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';

		$sq = "SELECT *,DAYNAME(tanggal_harian) AS hari_kerja FROM ubina_harian WHERE tanggal_harian LIKE '$period%'";
		$qr = $this->db->query($sq)->result();
		foreach($qr AS $key=>$val){
			$sqApel = "SELECT id_apel FROM ubina_apel WHERE tanggal_apel='".$val->tanggal_harian."'";
			$qrApel = $this->db->query($sqApel)->row();
			$id_apel = @$qrApel->id_apel;
			$id_harian = $val->id_harian;

			$sqA = "SELECT a.*,b.lokasi FROM ubina_apel_wajib a LEFT JOIN ubina_apel_lokasi b ON (a.id_lokasi=b.id_lokasi) WHERE a.id_pegawai='$id_pegawai' AND a.id_apel='$id_apel'";
			$qrA = $this->db->query($sqA)->row();
			$sqH = "SELECT a.*,b.jam_masuk,b.jam_pulang FROM ubina_harian_wajib a LEFT JOIN ubina_harian_jam b ON (a.id_jam=b.id_jam) WHERE a.id_pegawai='$id_pegawai' AND a.id_harian='$id_harian'";
			$qrH = $this->db->query($sqH)->row();
			
			@$data['hsl'][$key]->id_harian = $id_harian;
			@$data['hsl'][$key]->pos_harian = ($val->tanggal_harian<=$hHarian && isset($qrH->id_wajib) && (@$qrH->status!="DL") && (@$qrH->status!="S") && (@$qrH->status!="C") && (@$qrH->status!="I"))?"ya":"tidak";
			@$data['hsl'][$key]->hari = $hari[$val->hari_kerja].", ".date("d-m-Y", strtotime($val->tanggal_harian));
			@$data['hsl'][$key]->jam_kerja = (isset($qrH->id_wajib))?@$qrH->jam_masuk." - ".@$qrH->jam_pulang:"-";
			@$data['hsl'][$key]->absen_masuk = (isset($qrH->id_wajib))?((@$qrH->status!="H")?"-":@$qrH->absen_masuk):"-";
			@$data['hsl'][$key]->absen_pulang = (isset($qrH->id_wajib))?((@$qrH->status!="H")?"-":@$qrH->absen_pulang):"-";
			@$data['hsl'][$key]->selisih_masuk = (isset($qrH->id_wajib))?((@$qrH->selisih_masuk>0)?" (<font color='#f00'>".$this->hitung_selisih(@$qrH->selisih_masuk)."</font>)":""):"";
			@$data['hsl'][$key]->selisih_pulang = (isset($qrH->id_wajib))?((@$qrH->selisih_pulang>0)?" (<font color='#f00'>".$this->hitung_selisih(@$qrH->selisih_pulang)."</font>)":""):"";
			@$data['hsl'][$key]->status_harian = (isset($qrH->id_wajib))?@$stt[@$qrH->status]:"-";
			@$data['hsl'][$key]->lokasi = (isset($qrH->id_wajib) && @$qrA->id_wajib != NULL)?@$qrA->lokasi:"-";
			@$data['hsl'][$key]->status_apel = (isset($qrH->id_wajib) && @$qrA->id_wajib != NULL)?@$stt[@$qrA->status]:"-";
//			@$data['hsl'][$key]->id_wajib_apel = @$qrA->id_wajib;
//			echo $hari[$val->hari_kerja].", ".date("d-m-Y", strtotime($val->tanggal_harian))." (".$id_apel.")".@$qrH->absen_masuk."<br>";
		}
		echo json_encode($data);
	}

	function pilihan_jam(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$id_harian = $_POST['idd'];
			$sqH = "SELECT a.*,b.jam_masuk,b.jam_pulang FROM ubina_harian_wajib a LEFT JOIN ubina_harian_jam b ON (a.id_jam=b.id_jam) WHERE a.id_pegawai='$id_pegawai' AND a.id_harian='$id_harian'";
			$qrH = $this->db->query($sqH)->row();
		$pil_jam = $this->dropdowns->jam_kerja();
		echo '<select id="jam_kerja" name="jam_kerja" class="form-control" onchange="pilih_ini_jam();">';
		echo '<option value="0">Batal...</option>';
		foreach($pil_jam AS $key=>$val){
			$selJam = ($qrH->id_jam==$key)?"selected":"";
			if($key!=0){
				echo '<option value="'.$key.'" '.$selJam.'>'.$val.'</option>';															
			}
		}
		echo '</select>';
	}
	function pilihan_jam_aksi(){
		$idPeg = $this->session->userdata('pegawai_info');
		$idh = $_POST['id_harian'];
		$id_jam = $_POST['id_jam'];

		$sqI = "UPDATE ubina_harian_wajib SET id_jam='$id_jam' WHERE id_harian='$idh' AND id_pegawai='$idPeg'";
		$qrI = $this->db->query($sqI);
		$sqH = "SELECT a.* FROM ubina_harian_jam a WHERE a.id_jam='$id_jam'";
		$qrH = $this->db->query($sqH)->row();

		$sq2 = "SELECT a.* FROM ubina_harian_wajib a WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg'";
		$qr2 = $this->db->query($sq2)->row();
//////////////////////////////////////// absen masuk >>>>
				$jj_masuk = explode(":",$qrH->jam_masuk);
				$n_masuk = (3600*$jj_masuk[0])+(60*$jj_masuk[1])+$jj_masuk[2];
				$aa_masuk = explode(":",$qr2->absen_masuk);
				$m_masuk = (3600*$aa_masuk[0])+(60*$aa_masuk[1])+$aa_masuk[2];
		
				$jn = $n_masuk-$m_masuk;
				if($jn<0){
					if($jn<(-36000)){	$jb = ($m_masuk-86400)-$n_masuk;	} else {	$jb = -$jn;	}
				} else {	$jb = -$jn;	}
				$jk = abs($jb);
				$jjk = ($jb>0)?$jk:0;

				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET selisih_masuk='$jjk',status='H' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
//////////////////////////////////////// absen pulang >>>>
				$jj_pulang = explode(":",$qrH->jam_pulang);
				$n_pulang = (3600*$jj_pulang[0])+(60*$jj_pulang[1])+$jj_pulang[2];
				$aa_pulang = explode(":",$qr2->absen_pulang);
				$m_pulang = (3600*$aa_pulang[0])+(60*$aa_pulang[1])+$aa_pulang[2];
		
				$jn = $m_pulang-$n_pulang;
				if($jn<0){
					if($jn<(-36000)){
						$jb = -(86400-$n_pulang)-$m_pulang;	} else {	$jb = -$jn;	}
				} else {
					if($jn>36000){	$jb = $n_pulang+(86400-$m_pulang);	} else {	$jb = -$jn;	}
				}
				$jk = abs($jb);
				$jjk = ($jb>0)?$jk:0;

				$sqI = "UPDATE ubina_harian_wajib SET selisih_pulang='$jjk' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);
		

		$sq2 = "SELECT a.* FROM ubina_harian_wajib a WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg'";
		$qr2 = $this->db->query($sq2)->row();


		$absen_masuk = $qr2->absen_masuk;
		$absen_pulang = $qr2->absen_pulang;
		$selisih_masuk = ($qr2->selisih_masuk>0)?" (<font color='#f00'>".$this->hitung_selisih($qr2->selisih_masuk)."</font>)":"";
		$selisih_pulang = ($qr2->selisih_pulang>0)?" (<font color='#f00'>".$this->hitung_selisih($qr2->selisih_pulang)."</font>)":"";

		$data['jam'] = $qrH->jam_masuk." - ".$qrH->jam_pulang;
		$data['masuk'] = $absen_masuk.$selisih_masuk;
		$data['pulang'] = $absen_pulang.$selisih_pulang;
		echo json_encode($data);
	}
	function ganti_icon_harian(){
		echo '<div class="btn btn-warning btn-xs" onclick="ganti_icon_aksi(\'S\');"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
		echo '<div class="btn btn-info btn-xs" onclick="ganti_icon_aksi(\'I\');"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
		echo '<div class="btn btn-success btn-xs" onclick="ganti_icon_aksi(\'DL\');"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
		echo '<div class="btn btn-danger btn-xs" onclick="ganti_icon_aksi(\'TK\');"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		echo '<div class="btn btn-success btn-xs" onclick="ganti_icon_aksi(\'C\');"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';
		echo '<div class="btn btn-default btn-xs" onclick="batal_icon();"><i class="fa fa-close fa-fw"></i> Batal</div>';
	}
	function ganti_icon_aksi(){
		$idPeg = $this->session->userdata('pegawai_info');
		$idh = $_POST['idd'];
		$status = $_POST['stt'];
		$sqI = "UPDATE ubina_harian_wajib SET status='$status' WHERE id_harian='$idh' AND id_pegawai='$idPeg'";
		$qrI = $this->db->query($sqI);

		$stt['H'] = '<div class="btn btn-primary btn-xs gt"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
		$stt['S'] = '<div class="btn btn-warning btn-xs gt"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
		$stt['I'] = '<div class="btn btn-info btn-xs gt"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
		$stt['DL'] = '<div class="btn btn-success btn-xs gt"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
		$stt['TK'] = '<div class="btn btn-danger btn-xs gt"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		$stt['C'] = '<div class="btn btn-success btn-xs gt"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';
		echo $stt[$status];
	}


	function pilihan_masuk(){
		echo "<div class='input-group' style='width:180px; margin:0px; padding:0px;'>";
		echo "<span class='input-group-btn' style='margin=0px;'><div class='btn btn-danger' onclick='ganti_batal();'><i class='fa fa-close fa-fw'></i></div></span>";
		echo "<input type='text' class='form-control' id='jam_masuk' name='jam_masuk' placeholder='00:00:00' style='margin:0px;'>";
		echo "<span class='input-group-btn' style='margin=0px;'><div class='btn btn-default' onclick='isi_masuk();'><i class='fa fa-fast-forward fa-fw'></i></div></span>";
		echo "</div>";
	}
	function isi_masuk_aksi(){
		$idPeg = $this->session->userdata('pegawai_info');
		$idh = $_POST['id_harian'];
		$jam = $_POST['jam_masuk'];

		$sq2 = "SELECT a.*,b.jam_masuk,c.tanggal_harian FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,ubina_harian c) ON (a.id_jam=b.id_jam AND a.id_harian=c.id_harian)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg'";
		$qr2 = $this->db->query($sq2)->row();
///>>>>>>>>>> APEL
		$sqA = "SELECT a.* FROM ubina_apel a WHERE a.tanggal_apel='".$qr2->tanggal_harian."'";
		$qrA = $this->db->query($sqA)->row();
		$id_apel = @$qrA->id_apel;
//<<<<<<<<<<<
				$jj_masuk = explode(":",$qr2->jam_masuk);
				$n_masuk = (3600*$jj_masuk[0])+(60*$jj_masuk[1])+$jj_masuk[2];
				$aa_masuk = explode(":",$jam);
				$m_masuk = (3600*$aa_masuk[0])+(60*$aa_masuk[1])+$aa_masuk[2];
		
				$jn = $n_masuk-$m_masuk;
				if($jn<0){
					if($jn<(-36000)){	$jb = ($m_masuk-86400)-$n_masuk;	} else {	$jb = -$jn;	}
				} else {	$jb = -$jn;	}
				
				$jk = abs($jb);
				$jjk = ($jb>0)?$jk:0;

				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_masuk='$jam',selisih_masuk='$jjk',status='H' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);


				$sqApel = "SELECT id_wajib FROM ubina_apel_wajib  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
				$qrApel = $this->db->query($sqApel)->row();
				if(!empty($qrApel)){
					if($jjk==0){
							$sqAp = "UPDATE ubina_apel_wajib SET status='H',apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
							$qrAp = $this->db->query($sqAp);
							$data['icon_apel'] = '<div class="btn btn-primary btn-xs"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
					} else {
							$sqAp = "UPDATE ubina_apel_wajib SET status='TK',apel_masuk='$jam'  WHERE id_apel='$id_apel' AND id_pegawai='$idPeg'";
							$qrAp = $this->db->query($sqAp);
							$data['icon_apel'] = '<div class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down fa-fw"></i> TK</div>';
					}
				} else {
					$data['icon_apel'] = '-';
				}


			$data['selisih_masuk'] = ($jjk>0)?$jam." (<font color='#f00'>".$this->hitung_selisih($jjk)."</font>)":$jam;
			$data['icon_harian'] = '<div class="btn btn-primary btn-xs"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';

		echo json_encode($data);
	}
	function pilihan_pulang(){
		echo "<div class='input-group' style='width:180px; margin:0px; padding:0px;'>";
		echo "<span class='input-group-btn' style='margin=0px;'><div class='btn btn-danger' onclick='ganti_batal();'><i class='fa fa-close fa-fw'></i></div></span>";
		echo "<input type='text' class='form-control' id='jam_pulang' name='jam_pulang' placeholder='00:00:00' style='margin:0px;'>";
		echo "<span class='input-group-btn' style='margin=0px;'><div class='btn btn-default' onclick='isi_pulang();'><i class='fa fa-fast-forward fa-fw'></i></div></span>";
		echo "</div>";
	}
	function isi_pulang_aksi(){
		$idPeg = $this->session->userdata('pegawai_info');
		$idh = $_POST['id_harian'];
		$jam = $_POST['jam_pulang'];

		$sq2 = "SELECT a.*,b.jam_pulang,c.tanggal_harian FROM ubina_harian_wajib a LEFT JOIN (ubina_harian_jam b,ubina_harian c) ON (a.id_jam=b.id_jam AND a.id_harian=c.id_harian)  WHERE a.id_harian='$idh' AND a.id_pegawai='$idPeg' AND a.status='H'";
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
				$jjk = ($jb>0)?$jk:0;
				
				$idw = $qr2->id_wajib;
				$sqI = "UPDATE ubina_harian_wajib SET absen_pulang='$jam',selisih_pulang='$jjk' WHERE id_wajib='$idw'";
				$qrI = $this->db->query($sqI);

				$data['selisih_pulang'] = ($jjk>0)?$jam." (<font color='#f00'>".$this->hitung_selisih($jjk)."</font>)":$jam;
			} else {
				$data['selisih_pulang'] = "-";
			}


		echo json_encode($data);
	}
	function hitung_selisih($jk){
		$jm =  floor($jk/3600);
		$jam = (strlen($jm)==1)?"0".$jm:$jm;
		$mnt = floor(($jk-($jam*3600))/60);
		$menit = (strlen($mnt)==1)?"0".$mnt:$mnt;
		$dtk = $jk-(($jam*3600)+($menit*60));
		$detik = (strlen($dtk)==1)?"0".$dtk:$dtk;
		return $jam.":".$menit.":".$detik;
	}


	function index(){
		$data['satu'] = "Data Absensi Pegawai";
		$data['bulan'] = $this->dropdowns->bulan3();
		$data['tutup'] = $this->session->userdata('tutup');

		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai",$id_pegawai);

		$this->load->view('absensi/index',$data);
	}
	
	function alih(){
		$this->session->set_userdata('status',$_POST['status']);
		$this->session->set_userdata('jenjang',$_POST['jenjang']);
		$this->session->set_userdata('umur',$_POST['umur']);
		$this->session->set_userdata('mkcpns',$_POST['mkcpns']);
		$this->session->set_userdata('asal',$_POST['asal']);

		$this->session->set_userdata('pegawai_info',$_POST['id_pegawai']);
		$this->session->set_userdata('tutup',"ya");
		redirect(site_url("module/appbina/absensi"));
	}

	function pilih(){
		$this->session->set_userdata('tutup',"tidak");
		redirect(site_url("module/appbina/absensi"));
	}

	function pejabat(){
		$hari = $this->dropdowns->hari_konversi();
		$data['jam'] = date('H:i:s');

		$data['satu'] = "ABSENSI MASUK"; 
		$data['hari'] = $hari[date('l')].", ".date('d-m-Y');
		$this->load->view('absensi/form_pejabat',$data);
	}
	function pejabat_pulang(){
		$hari = $this->dropdowns->hari_konversi();
		$data['jam'] = date('H:i:s');

		$data['satu'] = "ABSENSI PULANG"; 
		$data['hari'] = $hari[date('l')].", ".date('d-m-Y');
		$this->load->view('absensi/form_pejabat_pulang',$data);
	}

	function umpeg(){
		$data['satu'] = "Absensi Pegawai";
		$data['jam_kerja'] = $this->dropdowns->jam_kerja();
		$data['jam'] = (isset($_POST['jam']))?$_POST['jam']:"";

		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['hadir'] = $this->dropdowns->kehadiran();

		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['kode'] = (isset($_POST['kode']))?$_POST['kode']:"";
		$data['pns'] = (isset($_POST['pns']))?$_POST['pns']:"";
		$data['ppkt'] = (isset($_POST['ppkt']))?$_POST['ppkt']:"";
		$data['pjbt'] = (isset($_POST['pjbt']))?$_POST['pjbt']:"";
		$data['pese'] = (isset($_POST['pese']))?$_POST['pese']:"";
		$data['ptugas'] = (isset($_POST['ptugas']))?$_POST['ptugas']:"";
		$data['pagama'] = (isset($_POST['pagama']))?$_POST['pagama']:"";
		$data['pgender'] = (isset($_POST['pgender']))?$_POST['pgender']:"";
		$data['pstatus'] = (isset($_POST['pstatus']))?$_POST['pstatus']:"";
		$data['pjenjang'] = (isset($_POST['pjenjang']))?$_POST['pjenjang']:"";
		$data['pumur'] = (isset($_POST['pumur']))?$_POST['pumur']:"";
		$data['pmkcpns'] = (isset($_POST['pmkcpns']))?$_POST['pmkcpns']:"";
		$data['phadir'] = (isset($_POST['phadir']))?$_POST['phadir']:"all";


		$hari = $this->dropdowns->hari_konversi();
		$id_harian = $this->session->userdata('id_harian'); 
		$data['val'] = $this->m_harian->ini_harian($id_harian);
		$data['val']->hari_kerja = $hari[$data['val']->hari_kerja];
		$data['form'] = ($data['val']->tg_harian==date('Y-m-d'))?"ya":"tidak";
		$data['editjam'] = ($data['val']->tg_harian>=date('Y-m-d'))?"ya":"tidak";
		$data['id_maju'] = $this->session->userdata('id_maju'); 
		$data['id_mundur'] = $this->session->userdata('id_mundur'); 

		$this->load->view('absensi/harian_umpeg',$data);
	}

	function umpeg_get_pegawai(){
			$this->load->model('appbkpp/m_umpeg');
			$this->load->model('appbkpp/m_pegawai');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			
			$kode="";
			$pns=$_POST['pns'];
			$pkt=$_POST['pkt'];
			$jbt=$_POST['jbt'];
			$ese=$_POST['ese'];
			$tugas=$_POST['tugas'];
			$gender=$_POST['gender'];
			$agama=$_POST['agama'];
			$status=$_POST['status'];
			$jenjang=$_POST['jenjang'];
			$umur=$_POST['umur'];
			$mkcpns=$_POST['mkcpns'];
			$hadir=$_POST['hadir'];
			$idj = $_POST['idj'];
			$idh = $this->session->userdata('id_harian'); 
			$hh = $this->m_harian->ini_harian($idh);
			$kehadiran = $this->dropdowns->kehadiran();

			$form = ($hh->tg_harian==date('Y-m-d'))?"ya":"tidak";

			$data['count'] = $this->m_harian->hitung_wajib_hadir($_POST['cari'],$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$hh->bulan_harian,$hh->tahun_harian);
			$pangkat = $this->dropdowns->kode_pangkat();
			$golongan = $this->dropdowns->kode_golongan();
			if($data['count']==0){
				$data['hslquery']="";
				$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
			} else {
				$batas=$_POST['batas'];
				$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
				$mulai=($hal-1)*$batas;
				$data['mulai']=$mulai+1;
				$data['hslquery'] = $this->m_harian->get_wajib_hadir($_POST['cari'],$mulai,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$idh,$idj,$hadir,$hh->bulan_harian,$hh->tahun_harian);
					foreach($data['hslquery'] AS $key=>$val){
						$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
						$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
						$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];
						$data['hslquery'][$key]->absen_masuk = ($val->absen_masuk=="00:00:00")?"-":$val->absen_masuk;
						$data['hslquery'][$key]->telat_masuk = ($val->selisih_masuk==0)?"-":"<font color='#F00'>".$val->telat_masuk."</font>";
						$data['hslquery'][$key]->absen_pulang = ($val->absen_pulang=="00:00:00")?"-":$val->absen_pulang;
						$data['hslquery'][$key]->cepat_pulang = ($val->selisih_pulang==0)?"-":"<font color='#F00'>".$val->cepat_pulang."</font>";
						
						$sqr = ($form=="ya")?"onClick=\"formhadir(".$val->id_wajib.");\" id=\"sso_".$val->id_wajib."\"":" style=\"cursor:default;\"";
						if($val->status=="H"){
							$data['hslquery'][$key]->stt = '<div class="btn btn-primary btn-xs" style="cursor:default;"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
						} elseif($val->status=="S") {
							$data['hslquery'][$key]->stt = '<div class="btn btn-warning btn-xs" '.$sqr.'><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
						} elseif($val->status=="I") {
							$data['hslquery'][$key]->stt = '<div class="btn btn-info btn-xs" '.$sqr.'><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
						} elseif($val->status=="DL") {
							$data['hslquery'][$key]->stt = '<div class="btn btn-success btn-xs" '.$sqr.'><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
						} elseif($val->status=="TK") {
							$data['hslquery'][$key]->stt = '<div class="btn btn-danger btn-xs" '.$sqr.'><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
						} elseif($val->status=="C") {
							$data['hslquery'][$key]->stt= '<div class="btn btn-success btn-xs" '.$sqr.'><i class="fa fa-building-o fa-fw"></i> Cuti</div>';
						}


						$apel = $this->m_apel->cek_apel_pegawai($hh->tg_harian,$val->id_pegawai);
						$data['hslquery'][$key]->stp = @$apel->status;
						$sqs = ($form=="ya" && (@$apel->apel_masuk=="00:00:00" || $val->status=="H"))?"onClick=\"formijin(".$val->id_wajib.");\"":" style=\"cursor:default;\"";
						if(empty($apel)){
								$data['hslquery'][$key]->sta = '-';
						} else {
								if(@$apel->status=="H") {
									$data['hslquery'][$key]->sta = '<div class="btn btn-primary btn-xs" id="ssq_'.$val->id_wajib.'" style="cursor:default;"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
								} elseif(@$apel->status=="S") {
									$data['hslquery'][$key]->sta = '<div class="btn btn-warning btn-xs" id="ssq_'.$val->id_wajib.'" style="cursor:default;"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
								} elseif(@$apel->status=="I") {
									$data['hslquery'][$key]->sta = '<div class="btn btn-info btn-xs" id="ssq_'.$val->id_wajib.'" style="cursor:default;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
								} elseif(@$apel->status=="DL") {
									$data['hslquery'][$key]->sta = '<div class="btn btn-success btn-xs" id="ssq_'.$val->id_wajib.'" style="cursor:default;"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
								} elseif(@$apel->status=="TK" || @$apel->status==NULL) {
									$data['hslquery'][$key]->sta = '<div class="btn btn-danger btn-xs" '.$sqs.' id="ssq_'.$val->id_wajib.'"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
								} elseif(@$apel->status=="C") {
									$data['hslquery'][$key]->sta= '<div class="btn btn-success btn-xs" id="ssq_'.$val->id_wajib.'" style="cursor:default;"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';
								}
						}


					}
				$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
			}
			echo json_encode($data);
	}

	function alih_umpeg(){
		$hari_ini = date('Y-m-d');
		$harian = $this->m_harian->get_akhir_harian($hari_ini);
		if(empty($harian)){
			echo "tidak ada data";
		} else {
			$this->session->set_userdata('id_harian',$harian->id_harian); 

			$maju = $this->m_harian->get_maju_harian($hari_ini);
			$this->session->set_userdata('id_maju',$maju->id_harian); 
			$mundur = $this->m_harian->get_mundur_harian($hari_ini);
			$this->session->set_userdata('id_mundur',$mundur->id_harian); 

			redirect(site_url("module/appbina/absensi/umpeg"));
		}
	}

	function pilih_umpeg(){
		$idd = $_POST['idd'];
		$hh = $this->m_harian->ini_harian($idd);

		$maju = $this->m_harian->get_maju_harian($hh->tg_harian);
		$this->session->set_userdata('id_maju',$maju->id_harian); 
		$mundur = $this->m_harian->get_mundur_harian($hh->tg_harian);
		$this->session->set_userdata('id_mundur',$mundur->id_harian); 
		$this->session->set_userdata('id_harian',$idd); 
	}

	function pilih_apel(){
		$idd = $_POST['idd'];
		$hh = $this->m_apel->ini_apel($idd);

		$maju = $this->m_apel->get_maju_apel($hh->tg_apel);
		$this->session->set_userdata('id_maju',$maju->id_apel); 
		$mundur = $this->m_apel->get_mundur_apel($hh->tg_apel);
		$this->session->set_userdata('id_mundur',$mundur->id_apel); 
		$this->session->set_userdata('id_apel',$idd); 
	}

	function apel(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$period = $_POST['period']."-01";
		$data['hari'] = $this->dropdowns->hari_konversi();
		$data['status'] = array();
//		$data['status']['pending'] = '<div class="btn btn-danger btn-xs" style="cursor:default;"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		$data['status']['TK'] = '<div class="btn btn-danger btn-xs" style="cursor:default;"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		$data['status']['DL'] = '<div class="btn btn-success btn-xs" style="cursor:default;"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
		$data['status']['I'] = '<div class="btn btn-info btn-xs" style="cursor:default;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
		$data['status']['S'] = '<div class="btn btn-warning btn-xs" style="cursor:default;"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
		$data['status']['H'] = '<div class="btn btn-primary btn-xs" style="cursor:default;"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
		$data['status']['C'] = '<div class="btn btn-success btn-xs" style="cursor:default;"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';

		$data['abs'] = $this->m_apel->get_absensi_apel($id_pegawai,$period);
		$this->load->view('absensi/apel',$data);
	}
	function harian(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$period = $_POST['period']."-01";
		$data['hari'] = $this->dropdowns->hari_konversi();

		$data['abs'] = $this->m_harian->get_absensi_harian($id_pegawai,$period);
		$data['sumtimer'] = $this->m_harian->sum_absensi_harian($id_pegawai,$period);


		$data['status'] = array();
		$data['status']['TK'] = '<div class="btn btn-danger btn-xs" style="cursor:default;"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';
		$data['status']['DL'] = '<div class="btn btn-success btn-xs" style="cursor:default;"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';
		$data['status']['I'] = '<div class="btn btn-info btn-xs" style="cursor:default;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';
		$data['status']['S'] = '<div class="btn btn-warning btn-xs" style="cursor:default;"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';
		$data['status']['H'] = '<div class="btn btn-primary btn-xs" style="cursor:default;"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';
		$data['status']['C'] = '<div class="btn btn-success btn-xs" style="cursor:default;"><i class="fa fa-building-o fa-fw"></i> Cuti</div>';

		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pempeg") {
			$this->load->view('absensi/harian_pempeg',$data);
		} else {
			$this->load->view('absensi/harian',$data);
		}
	}
	function r_pegawai_rekap_bulanan(){
		$data['hari'] = date('m');
		$data['bulan'] = $this->dropdowns->bulan3();
		if(isset($_POST['bulan']) && $_POST['bulan']!=""){
			$thn = date('Y');
			$data['hasil'] = $this->r_pegawai_rekap_generate($thn,$_POST['bulan']);
		} else {
			$data['hasil'] = "";
		}
		$this->load->view('absensi/r_pegawai_rekap_bulanan',$data);
	}
	function r_pegawai_rekap_generate($thn,$bln){
		$this->m_harian->r_pegawai_rekap_generate_aksi($thn,$bln);
		return "Ada hasil";
	}
	function gen_token(){
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');

		$this->load->view('absensi/gen_token',$data);
	}

	function gen_token_harian(){
		$minggu = $_POST['minggu'];
		
		$iBln = $_POST['bulan'];
		$bln = ($iBln==10)?$iBln:str_replace("0","",$iBln);
		$yBln = ($minggu<6)?$bln:$bln+1;
		$xBln = (strlen($yBln)==1)?"0".$yBln:$yBln;
		$tahun = $_POST['tahun'];
		$ll = $yBln-2;
		$lalu = (strlen($ll)==1)?"0".$ll:$ll;
		
		$this->token_generate_harian($tahun,$xBln,$minggu,$lalu);
//		redirect(site_url('module/appbina/absensi/gen_token'));
		echo "sukses - ".$xBln." - ".$lalu;
	}


	private function token_generate_harian($thn,$bln,$masuk,$lalu){
		$awal = (($masuk-1)*7)+1;
		$akhir = $awal+7;
		$blnIni = $thn."-".$bln;

		$sqlstr = "DROP TABLE IF EXISTS `ubina_token_temp`";
		$query = $this->db->query($sqlstr);
		$sqlstr = "CREATE TABLE `ubina_token_temp` (
		  `id_token` int(11) NOT NULL AUTO_INCREMENT,
		  `user_id` int(11) NOT NULL,
		  `id_pegawai` int(11) NOT NULL,
		  `tanggal` date DEFAULT NULL,
		  `token_masuk` int(2) DEFAULT NULL,
		  `token_pulang` int(3) DEFAULT NULL,
		  PRIMARY KEY (`id_token`),
		  KEY `id_apel` (`user_id`,`id_pegawai`),
		  KEY `token_masuk` (`token_masuk`),
		  KEY `token_pulang` (`token_pulang`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1";
		$query = $this->db->query($sqlstr);

////////////////////////////////////>>>KHUSUS SENEN
		$sq = "SELECT * FROM r_pegawai_aktual WHERE kode_ese NOT IN (21,22,31,32,41,42) ORDER BY id_pegawai";
		$qr = $this->db->query($sq)->result();
		$mxx = count($qr);
			for($no=0;$no<8;$no++){
				$urnM[$no] = $this->urno(10000,99999,$mxx);
				$urnP[$no] = $this->urno(10000,99999,$mxx);
			}

		$hhr = array();
				$no=0;
		for($i=$awal;$i<$akhir;$i++){
			$tg[$i] = (strlen($i)==1)?$blnIni."-0".$i:$blnIni."-".$i;
			$sqlstr = "DELETE FROM ubina_token WHERE tanggal='".$tg[$i]."'";
			$query = $this->db->query($sqlstr);
			$sqlstr = "SELECT DAYNAME('".$tg[$i]."') AS hari";
			$hslquery=$this->db->query($sqlstr)->row();
			$hhr[$i] = $hslquery->hari;
//			if($hslquery->hari=="Monday" || $hslquery->hari=="Friday" || $hslquery->hari=="Saturday"){	
				foreach($qr AS $key2=>$val2){
//					$sqI = "INSERT INTO ubina_token_temp (user_id,id_pegawai,tanggal,token_masuk,token_pulang) VALUES (".$val2->id_unor.",".$val2->id_pegawai.",'".$tg[$i]."',".$urnM[$no][$key2].",".$urnP[$no][$key2].")";
//					$qrI = $this->db->query($sqI);
					$sqI = "INSERT INTO ubina_token_temp (user_id,id_pegawai,tanggal,token_masuk,token_pulang) VALUES (".$val2->id_unor.",".$val2->id_pegawai.",'".$tg[$i]."',".$urnM[$no][$key2].",".$urnP[$no][$key2].")";
					$qrI = $this->db->query($sqI);
				}
					$no++;
//			}
		}
////////////////////////////////////<<<KHUSUS SENEN
/*
		$sqlstr="SELECT * FROM user_umpeg";
		$query = $this->db->query($sqlstr)->result();
		$dd=array("{","}");
		foreach($query AS $key=>$val){
			$unor = str_replace($dd,"",$val->unor_akses);
				$sq = "SELECT * FROM r_pegawai_aktual WHERE id_unor IN ($unor) AND kode_ese NOT IN (21,22,31,32) ORDER BY id_pegawai";
				$qr = $this->db->query($sq)->result();
				$mxx = count($qr);
						for($no=0;$no<8;$no++){
							$urnM[$no] = $this->urno(10000,99999,$mxx);
							$urnP[$no] = $this->urno(10000,99999,$mxx);
						}
				foreach($qr AS $key2=>$val2){
						$no=0;
						for($i=$awal;$i<$akhir;$i++){	
						if($hhr[$i]!="Monday" && $hhr[$i]!="Friday" && $hhr[$i]!="Saturday"){
								$sqI = "INSERT INTO ubina_token_temp (user_id,id_pegawai,tanggal,token_masuk,token_pulang) VALUES (".$val2->id_unor.",".$val2->id_pegawai.",'".$tg[$i]."',".$urnM[$no][$key2].",".$urnP[$no][$key2].")";
								$qrI = $this->db->query($sqI);
						}
							$no++;
						}
				}
		}
*/
						$sq = "SELECT a.* FROM r_pegawai_aktual a WHERE a.kode_ese IN (21,22,31,32,41,42) ORDER BY a.id_pegawai";
						$qr = $this->db->query($sq)->result();
						$mxx = count($qr);
						for($no=0;$no<8;$no++){
							$urnM[$no] = $this->urno(1000,9999,$mxx);
							$urnP[$no] = $this->urno(1000,9999,$mxx);
						}
						foreach($qr AS $key2=>$val2){
							$no=0;
							for($i=$awal;$i<$akhir;$i++){	
								$sqI = "INSERT INTO ubina_token_temp (user_id,id_pegawai,tanggal,token_masuk,token_pulang) VALUES ('".$val2->id_unor."',".$val2->id_pegawai.",'".$tg[$i]."',".$urnM[$no][$key2].",".$urnP[$no][$key2].")";
								$qrI = $this->db->query($sqI);
								$no++;
							}
						}


		$tLalu_awal = $thn."-".$lalu."-".$awal;
		$tLalu_akhir = $thn."-".$lalu."-".$akhir;
		$sqLA = "DELETE FROM ubina_token WHERE tanggal BETWEEN '$tLalu_awal' AND '$tLalu_akhir'";
		$qrLA = $this->db->query($sqLA);

		$sqA = "INSERT INTO ubina_token (user_id,id_pegawai,tanggal,token_masuk,token_pulang) SELECT user_id,id_pegawai,tanggal,token_masuk,token_pulang FROM ubina_token_temp WHERE tanggal!='000-00-00' GROUP BY id_pegawai,tanggal";
		$qrA = $this->db->query($sqA);
		$sqlstr = "DROP TABLE `ubina_token_temp`";
		$query = $this->db->query($sqlstr);
	}


	function urno($min, $max, $quantity) {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}

}
?>