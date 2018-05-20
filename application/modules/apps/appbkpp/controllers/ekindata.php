<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ekindata extends MX_Controller {
	function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_ekindata');
	}

	public function index()  {
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['satu'] = "Kinerja Sub-Bidang Data";
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('ekindata/index',$data);
	}

	public function log_data()  {
		$data['hal'] = 'end';
		$data['cari'] = "";
		$data['batas'] = 10;

		$sql = "SELECT DISTINCT(a.tipe_dokumen)	FROM r_peg_dokumen a WHERE a.halaman_item_dokumen=0 ORDER BY a.tipe_dokumen";
		$data['riwayat'] = $this->db->query($sql)->result();
		$data['kodeHal'] = "";
		$sql = "SELECT DISTINCT(a.file_dokumen)	FROM r_peg_dokumen a WHERE a.halaman_item_dokumen=0 ORDER BY a.file_dokumen";
		$data['aksi'] = $this->db->query($sql)->result();
		$data['kodeAksi'] = "";

		$this->load->view('ekindata/log_data',$data);
	}
	public function get_log_data()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$data['count'] = $this->m_ekindata->hitung_log_data($bulan,$_POST['tahun'],$_POST['cari'],$_POST['riwayat'],$_POST['aksi'],$_POST['stp']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_ekindata->get_log_data($bulan,$_POST['tahun'],$_POST['cari'],$mulai,$batas,$_POST['riwayat'],$_POST['aksi'],$_POST['stp']);
			foreach($data['hslquery'] AS $key=>$val){
				$row = Modules::run("appbkpp/profile/ini_pegawai",$val->nip_baru);
				$usr = $this->m_ekindata->ini_user($val->user_id);
				@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
				@$data['hslquery'][$key]->gender = $row->gender;
				@$data['hslquery'][$key]->nip_baru = $row->nip_baru;
				@$data['hslquery'][$key]->tempat_lahir = $row->tempat_lahir;
				@$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($row->tanggal_lahir));
				$data['hslquery'][$key]->nama_user = @$usr->nama_user;
				$data['hslquery'][$key]->username = @$usr->username;
				$data['hslquery'][$key]->nama_grup = @$usr->nama_grup;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	public function log_r_peg_pendidikan()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idd'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_pendidikan',$data);
	}
	public function log_r_peg_jab()  {
		$data['aksi'] = $_POST['aksi'];
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		$data['awal'] = json_decode($data['log']->keterangan);
		$data['baru'] = json_decode($data['log']->sub_keterangan);

		$data['compare'] = ($_POST['aksi']=="edit")?"ya":"tidak";

		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;
		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_jab',$data);
	}
	public function log_r_peg_golongan()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;
		$data['pangkat'] = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_golongan',$data);
	}

	public function log_r_peg_pak()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;

		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_pak",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_pak',$data);
	}

	public function log_r_peg_kgb()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;

		$data['data'] = Modules::run("appbkpp/profile/ini_pegawai_kgb",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_kgb',$data);
	}

	public function log_r_peg_penghargaan()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;

		$data['data'] = Modules::run("appbkpp/profile/ini_sertifikat_penghargaan",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_penghargaan',$data);
	}

	public function log_r_peg_sertifikat_prajab()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;

		$data['isi'] = Modules::run("appbkpp/profile/ini_pegawai_prajabatan",$id_pegawai);
		$this->load->view('ekindata/log_r_peg_sertifikat_prajab',$data);
	}

	public function log_r_peg_diklat_struk()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);

		if($_POST['aksi']=="edit"){
			$data['compare'] = "ya";
			$data['awal'] = json_decode($data['log']->keterangan);
			$data['baru'] = json_decode($data['log']->sub_keterangan);
			$diklat = $data['awal'];
		} elseif($_POST['aksi']=="tambah"){
			$data['compare'] = "tidak";
			$diklat = json_decode($data['log']->sub_keterangan);
		} else {
			$data['compare'] = "tidak";
			$diklat = json_decode($data['log']->keterangan);
		}
		$data['idref'] = $data['log']->id_reff;
		$id_pegawai = $data['log']->nip_baru;

		$sq = "SELECT id_rumpun FROM md_diklat WHERE id_diklat='".$diklat->id_diklat."'";
		$qr = $this->db->query($sq)->row();
		$pil_rumpun = Modules::run("appdiklat/kursus/rumpun_diklat");
		$data['nama_rumpun'] = $pil_rumpun[$qr->id_rumpun];

		$sql = "SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai=$id_pegawai AND a.id_diklat IN (SELECT b.id_diklat FROM md_diklat b WHERE  b.id_rumpun=".$qr->id_rumpun.") ORDER BY a.tanggal_sttpl";
		$data['diklat'] = $this->db->query($sql)->result();

		$this->load->view('ekindata/log_r_peg_diklat_struk',$data);
	}

	public function log_r_peg_alamat()  {
		$data['log'] = $this->m_ekindata->ini_log_data($_POST['idd']);
		$data['idref'] = $data['log']->id_reff;

		$data['awal'] = json_decode($data['log']->keterangan);
		$data['baru'] = json_decode($data['log']->sub_keterangan);

		$this->load->view('ekindata/log_r_peg_alamat',$data);
	}

	public function log_dokumen()  {
		$data['hal'] = 'end';
		$data['cari'] = "";
		$data['batas'] = 10;

		$sql = "SELECT DISTINCT(a.tipe_dokumen)	FROM r_peg_dokumen a WHERE a.halaman_item_dokumen!=0 ORDER BY a.tipe_dokumen";
		$data['riwayat'] = $this->db->query($sql)->result();
		$data['kodeDok'] = "";

		$this->load->view('ekindata/log_dokumen',$data);
	}

	public function get_log_dokumen()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$data['count'] = $this->m_ekindata->hitung_log_dokumen($bulan,$_POST['tahun'],$_POST['cari'],$_POST['tipe'],"tambah",$_POST['stp']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_ekindata->get_log_dokumen($bulan,$_POST['tahun'],$_POST['cari'],$mulai,$batas,$_POST['tipe'],"tambah",$_POST['stp']);
			foreach($data['hslquery'] AS $key=>$val){

				$sql = "SELECT a.id_pegawai	FROM r_pegawai a WHERE a.nip_baru='".$val->nip_baru."'";
				$hsl = $this->db->query($sql)->row();

				$row = Modules::run("appbkpp/profile/ini_pegawai",$hsl->id_pegawai);
				$usr = $this->m_ekindata->ini_user($val->user_id);
				@$data['hslquery'][$key]->nama_pegawai = ((trim($row->gelar_depan) != '-')?trim($row->gelar_depan).' ':'').((trim($row->gelar_nonakademis) != '-')?trim($row->gelar_nonakademis).' ':'').$row->nama_pegawai.((trim($row->gelar_belakang) != '-')?', '.trim($row->gelar_belakang):'');
				@$data['hslquery'][$key]->gender = $row->gender;
//				@$data['hslquery'][$key]->nip_baru = $row->nip_baru;
				@$data['hslquery'][$key]->tempat_lahir = $row->tempat_lahir;
				@$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($row->tanggal_lahir));
				$data['hslquery'][$key]->nama_user = @$usr->nama_user;
				$data['hslquery'][$key]->username = @$usr->username;
				$data['hslquery'][$key]->nama_grup = @$usr->nama_grup;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}




	public function log_delta()  {
		$data['hal'] = 'end';
		$data['cari'] = "";
		$data['batas'] = 10;

		$this->load->view('ekindata/log_delta',$data);
	}
	public function get_log_delta()  {
		if($_POST['bulan']==1){
			$bulan_sebel = 12;
			$tahun_sebel = $_POST['tahun']-1;
		} else {
			$bulan_sebel = $_POST['bulan']-1;
			$tahun_sebel = $_POST['tahun'];
		}

		$data['count'] = $this->m_ekindata->hitung_log_delta($bulan_sebel,$tahun_sebel,$_POST['bulan'],$_POST['tahun'],$_POST['cari'],$_POST['aksi'],"tipe");

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_ekindata->get_log_delta($bulan_sebel,$tahun_sebel,$_POST['bulan'],$_POST['tahun'],$_POST['cari'],$mulai,$batas,$_POST['aksi'],"tipe");
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

				@$data['hslquery'][$key]->tPensiun = ($val->id_pensiun=="")?"":"Pensiun";
				@$data['hslquery'][$key]->tMeninggal = ($val->id_meninggal=="")?"":"Meninggal";
				@$data['hslquery'][$key]->tKeluar = ($val->id_keluar=="")?"":"Keluar / Pindah instansi";

			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}







	public function xcl_data()  {
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
$this->load->library('myexcel');
		$tahun = $_POST['tahun'];
		$bulan = $_POST['bulan'];
		$bln = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$blt = $tahun."-".$bln."-";
		$dwBulan = $this->dropdowns->bulan();
		$nm_bulan = strtoupper($dwBulan[$bulan]);
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('sk_jabatan');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PERBARUAN DATA SK JABATAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'SK NOMOR / TANGGAL');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PENANDATANGAN SK / TMT JABATAN');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERASI');
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'OPERATOR');
$rc++;
		$sql = "SELECT a.*,c.*,b.nip_baru,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a 
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		LEFT JOIN r_peg_jab c ON (a.id_reff=c.id_peg_jab)
		WHERE b.status_kepegawaian='pns' AND a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='r_peg_jab' ORDER BY a.log_aksi";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->sk_nomor); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->sk_pejabat); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, " ".@$usr->username); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->sk_tanggal); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->tmt_jabatan); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, @$usr->nama_grup); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('sk_pangkat');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PERBARUAN DATA SK KEPANGKATAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'SK NOMOR / TANGGAL');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'JENIS KP / TMT GOLONGAN');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERASI');
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'OPERATOR');
$rc++;
		$sql = "SELECT a.*,c.*,b.nip_baru,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a 
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		LEFT JOIN r_peg_golongan c ON (a.id_reff=c.id_peg_golongan)
		WHERE b.status_kepegawaian='pns' AND a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='r_peg_golongan' ORDER BY a.log_aksi";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->sk_nomor); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->nama_golongan); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, " ".@$usr->username); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->sk_tanggal); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->nama_pangkat); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, @$usr->nama_grup); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 2);
$this->myexcel->setActiveSheetIndex(2);
$this->myexcel->getActiveSheet()->setTitle('ijazah_pendidikan');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PERBARUAN DATA IJAZAH PENDIDIKAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'IJAZAH NOMOR / TANGGAL');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'JENJANG / SEKOLAH');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERASI');
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'OPERATOR');
$rc++;
		$sql = "SELECT a.*,c.*,b.nip_baru,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a 
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		LEFT JOIN r_peg_pendidikan c ON (a.id_reff=c.id_peg_pendidikan)
		WHERE b.status_kepegawaian='pns' AND a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='r_peg_pendidikan' ORDER BY a.log_aksi";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->nomor_ijazah); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->nama_jenjang_rumpun); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, " ".@$usr->username); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->tanggal_lulus); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->nama_sekolah); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, @$usr->nama_grup); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 3);
$this->myexcel->setActiveSheetIndex(3);
$this->myexcel->getActiveSheet()->setTitle('pak');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PERBARUAN DATA PENETAPAN ANGKA KREDIT');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PEJABAT PENILAI');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'ANGKA KREDIT / ANGKA KREDIT KUMULATIF');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERASI');
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'OPERATOR');
$rc++;
		$sql = "SELECT a.*,c.*,b.nip_baru,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a 
		LEFT JOIN r_pegawai b ON (a.nip_baru=b.id_pegawai)
		LEFT JOIN r_peg_pak c ON (a.id_reff=c.id_pak)
		WHERE b.status_kepegawaian='pns' AND a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='r_peg_pak' ORDER BY a.log_aksi";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->penilai_nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->ak); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, " ".@$usr->username); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$val->ak_kumulatif); //
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, @$usr->nama_grup); //
		$rc++;
}


$filename='updating_data_bulanan.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($this->myexcel, 'Excel5');  
$objWriter->save('php://output');
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
	}












	public function xcl_dokumen()  {
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
$this->load->library('myexcel');
		$tahun = $_POST['tahun'];
		$bulan = $_POST['bulan'];
		$bln = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$blt = $tahun."-".$bln."-";
		$dwBulan = $this->dropdowns->bulan();
		$nm_bulan = strtoupper($dwBulan[$bulan]);
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('sk_jabatan');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PENGUNGGAHAN eDOKUMEN SK JABATAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'FILE');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'LOKASI FILE');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERATOR');
$rc++;
		$sql = "SELECT a.id_dokumen,a.file_dokumen,a.nip_baru,a.user_id,a.log_aksi,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		LEFT JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai AND a.id_reff=c.id_peg_jab)
		WHERE  a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='sk_jabatan' ORDER BY id_dokumen";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$lokasi = site_url()."assets/media/file/".$val->nip_baru."/sk_jabatan/";
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':D'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$lokasi); //
		$this->myexcel->getActiveSheet()->mergeCells('E'.$rc.':E'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, " ".@$usr->username); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('sk_kepangkatan');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PENGUNGGAHAN eDOKUMEN SK KEPANGKATAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'FILE');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'LOKASI FILE');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERATOR');
$rc++;
		$sql = "SELECT a.id_dokumen,a.file_dokumen,a.nip_baru,a.user_id,a.log_aksi,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		LEFT JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai AND a.id_reff=c.id_peg_jab)
		WHERE  a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='sk_pangkat' ORDER BY id_dokumen";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$lokasi = site_url()."assets/media/file/".$val->nip_baru."/sk_pangkat/";
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':D'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$lokasi); //
		$this->myexcel->getActiveSheet()->mergeCells('E'.$rc.':E'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, " ".@$usr->username); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 2);
$this->myexcel->setActiveSheetIndex(2);
$this->myexcel->getActiveSheet()->setTitle('ijazah_pendidikan');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PENGUNGGAHAN eDOKUMEN IJAZAH PENDIDIKAN');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'FILE');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'LOKASI FILE');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERATOR');
$rc++;
		$sql = "SELECT a.id_dokumen,a.file_dokumen,a.nip_baru,a.user_id,a.log_aksi,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		LEFT JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai AND a.id_reff=c.id_peg_jab)
		WHERE  a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='ijazah_pendidikan' ORDER BY id_dokumen";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$lokasi = site_url()."assets/media/file/".$val->nip_baru."/ijazah_pendidikan/";
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':D'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$lokasi); //
		$this->myexcel->getActiveSheet()->mergeCells('E'.$rc.':E'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, " ".@$usr->username); //
		$rc++;
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$this->myexcel->createSheet(NULL, 3);
$this->myexcel->setActiveSheetIndex(3);
$this->myexcel->getActiveSheet()->setTitle('pak');
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);

$this->myexcel->getActiveSheet()->setCellValue('B1', 'PENGUNGGAHAN eDOKUMEN PENETAPAN ANGKA KREDIT');
$this->myexcel->getActiveSheet()->setCellValue('B2', 'PERIODE : '.$nm_bulan." ".$tahun);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'FILE');
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'LOKASI FILE');
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'LOG / OPERATOR');
$rc++;
		$sql = "SELECT a.id_dokumen,a.file_dokumen,a.nip_baru,a.user_id,a.log_aksi,b.nama_pegawai,b.gelar_nonakademis,b.gelar_depan,b.gelar_belakang
		FROM r_peg_dokumen a LEFT JOIN r_pegawai b ON (a.nip_baru=b.nip_baru)
		LEFT JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai AND a.id_reff=c.id_peg_jab)
		WHERE  a.log_aksi LIKE '$blt%' AND a.tipe_dokumen='pak' ORDER BY id_dokumen";
		$hsl = $this->db->query($sql)->result();
foreach($hsl AS $key=>$val){
		$usr = $this->m_ekindata->ini_user($val->user_id);
		$lokasi = site_url()."assets/media/file/".$val->nip_baru."/pak/";
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($key+1));
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai); //
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, @$val->file_dokumen); //
		$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':D'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, @$lokasi); //
		$this->myexcel->getActiveSheet()->mergeCells('E'.$rc.':E'.($rc+1));
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, @$val->log_aksi); //
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, " ".@$val->nip_baru);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, " ".@$usr->username); //
		$rc++;
}


$filename='unggahan_edok_bulanan.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($this->myexcel, 'Excel5');  
$objWriter->save('php://output');
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
	}



}
?>