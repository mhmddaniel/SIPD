<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Laporan_cuti extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbina/m_cuti');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbina/m_laporan_cuti');
		$this->load->model('appskp/m_skp');
		$this->load->model('appbina/m_apel');
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()  {
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->session->set_userdata('bulan',$data['bulan']);
		$this->session->set_userdata('tahun',$data['tahun']);

		$query = $this->m_laporan_cuti->get_panel(1,$data['bulan'],$data['tahun']);
		$data['jabatan'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(2,$data['bulan'],$data['tahun']);
		$data['pendidikan'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(3,$data['bulan'],$data['tahun']);
		$data['golongan'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(4,$data['bulan'],$data['tahun']);
		$data['umur'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(5,$data['bulan'],$data['tahun']);
		$data['mkcpns'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(6,$data['bulan'],$data['tahun']);
		$data['unor'] =json_decode(@$query->meta_value);

		$query = $this->m_laporan_cuti->get_panel(7,$data['bulan'],$data['tahun']);
		$data['bup'] =json_decode(@$query->meta_value);

		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pempeg2"){
			$rd = "index";
//		} elseif($group_name=="mutasi") {
//			$rd = "aktif_mutasi";
		} else {
			$rd = "mutasi";
		}

		$this->load->view('laporan_cuti/'.$rd,$data);   }

		public function index_hitung()  {
			$data['dwBulan'] = $this->dropdowns->bulan();
			$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
			$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
			$this->load->view('laporan_cuti/refresh',$data);
		}

		private function reff_jabatan($tahun,$bulan){
			$sq = "SELECT c.id_pegawai,d.id_peg_jab FROM r_pegawai_bulanan c
			INNER JOIN r_peg_jab d ON c.id_pegawai=d.id_pegawai
			WHERE c.bulan='$bulan' AND c.tahun='$tahun' AND c.status_kepegawaian='pns'
			AND d.id_peg_jab = (SELECT MAX(D2.id_peg_jab) FROM r_peg_jab AS D2 WHERE D2.id_pegawai = d.id_pegawai ORDER BY D2.tmt_jabatan)";
			$qr = $this->db->query($sq)->result();

			foreach($qr AS $key=>$val){
				$this->db->set('reff_jabatan',$val->id_peg_jab);
				$this->db->where('id_pegawai',$val->id_pegawai);
				$this->db->where('tahun',$tahun);
				$this->db->where('bulan',$bulan);
				$this->db->update('r_pegawai_bulanan');
			}
		}
		public function index_hitung_aksi()  {
			$dBulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
//		$dBulan = (strlen($bulan)==1)?"0".$bulan:$bulan;
/////////////////////  ---PREPARE---   /////////////////////////////////
// 		$this->hapus_yang_pensiun();											// PENSIUN OFFF
// 		Modules::run("appbina/absensi/r_pegawai_rekap_generate",$tahun,$dBulan);// MENGUPDATE TABEL REKAP PEGAWAI BULANAN
// 		$this->reff_jabatan($tahun,$dBulan);									// CARI JABATAN TERAKHIR
// 		Modules::run("appbkpp/pantau_jfu/cpnsdobel","tidak");					// MENGHAPUS RECORD CPNS & PNS GANDA
// 		$this->m_laporan_cuti->isi_pns($dBulan,$tahun);							// ISI TABEL PNS & CPNS DULU
// ////////////////////////////////////////////////////////////////////////
// 		$jabatan = $this->dropdowns->jenis_jabatan();
// 		$data['jabatan'] = array();
// 		foreach($jabatan as $key=>$val){	if($key!=""){
// 			$jl = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"l","all",$dBulan,$tahun);
// 			$jp = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"p","all",$dBulan,$tahun);
// 			@$data['jabatan'][$key]->nama = $val;
// 			@$data['jabatan'][$key]->l = $jl;
// 			@$data['jabatan'][$key]->p = $jp;
// 			@$data['jabatan'][$key]->j = $jl+$jp;
// 		}}
// 		$vll = json_encode($data['jabatan']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Jenis Jabatan";
// 		$df = $this->m_laporan_cuti->satu(1,$jj,$vll,$dBulan,$tahun);
// ////////////////////////////////////////////////////////////////////////
// 		$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
// 		$data['pendidikan'] = array();
// 		foreach($pendidikan as $key=>$val){	if($key!=""){
// 			$jl = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"l","all",$dBulan,$tahun);
// 			$jp = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"p","all",$dBulan,$tahun);
// 			@$data['pendidikan'][$key]->nama = $val;
// 			@$data['pendidikan'][$key]->l = $jl;
// 			@$data['pendidikan'][$key]->p = $jp;
// 			@$data['pendidikan'][$key]->j = $jl+$jp;
// 		}}
// 		$vll = json_encode($data['pendidikan']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Jenjang Pendidikan";
// 		$df = $this->m_laporan_cuti->satu(2,$jj,$vll,$dBulan,$tahun);
// ////////////////////////////////////////////////////////////////////////
// 		$golongan = $this->dropdowns->kode_golongan_pangkat();
// 		$data['golongan'] = array();
// 		foreach($golongan as $key=>$val){	if($key!=""){
// 			$jl = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"l","all",$dBulan,$tahun);
// 			$jp = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"p","all",$dBulan,$tahun);
// 			@$data['golongan'][$key]->nama = $val;
// 			@$data['golongan'][$key]->l = $jl;
// 			@$data['golongan'][$key]->p = $jp;
// 			@$data['golongan'][$key]->j = $jl+$jp;
// 		}}
// 		$vll = json_encode($data['golongan']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Golongan";
// 		$df = $this->m_laporan_cuti->satu(3,$jj,$vll,$dBulan,$tahun);
// ////////////////////////////////////////////////////////////////////////
// 		$umur = $this->dropdowns->umur();
// 		$umur_db = $this->dropdowns->umur_db();
// 		$data['umur'] = array();
// 		foreach($umur as $key=>$val){	if($key!=""){
// 			@$data['umur'][$key]->nama = $val;
// 			$batas = $umur_db[$key];
// 			$jl = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"l","all",$dBulan,$tahun);
// 			$jp = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"p","all",$dBulan,$tahun);
// 			@$data['umur'][$key]->l = $jl;
// 			@$data['umur'][$key]->p = $jp;
// 			@$data['umur'][$key]->j = $jl+$jp;
// 		}}
// 		$vll = json_encode($data['umur']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Kelompok Umur";
// 		$df = $this->m_laporan_cuti->satu(4,$jj,$vll,$dBulan,$tahun);
// ////////////////////////////////////////////////////////////////////////
// 		$mkcpns = $this->dropdowns->mkcpns();
// 		$mkcpns_db = $this->dropdowns->mkcpns_db();
// 		$data['mkcpns'] = array();
// 		foreach($mkcpns as $key=>$val){	if($key!=""){
// 			@$data['mkcpns'][$key]->nama = $val;
// 			$batas = $mkcpns_db[$key];
// 			$jl = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"l","all",$dBulan,$tahun);
// 			$jp = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"p","all",$dBulan,$tahun);
// 			@$data['mkcpns'][$key]->l = $jl;
// 			@$data['mkcpns'][$key]->p = $jp;
// 			@$data['mkcpns'][$key]->j = $jl+$jp;
// 		}}
// 		$vll = json_encode($data['mkcpns']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Masa Kerja CPNS";
// 		$df = $this->m_laporan_cuti->satu(5,$jj,$vll,$dBulan,$tahun);
// ////////////////////////////////////////////////////////////////////////
// 		$dueDate = $tahun."-".$dBulan."-01";
// 		$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
// 		foreach($data['unor'] AS $key=>$val){
// 			$j_all = $this->m_laporan_cuti->hitung_pegawai($val->kode_unor,"all","all","all",$dBulan,$tahun);
// 			$j_pns = $this->m_laporan_cuti->hitung_pegawai($val->kode_unor,"pns","all","all",$dBulan,$tahun);
// 			$j_cpns = $this->m_laporan_cuti->hitung_pegawai($val->kode_unor,"cpns","all","all",$dBulan,$tahun);
// 			$data['unor'][$key]->j_all = $j_all;
// 			$data['unor'][$key]->j_pns = $j_pns;
// 			$data['unor'][$key]->j_cpns = $j_cpns;

// //				$data['where'] = ($key==0)?$data['where']."kode_unor NOT LIKE '".$val->kode_unor."%'":$data['where']." AND kode_unor NOT LIKE '".$val->kode_unor."%'";
// 		}
// 		$vll = json_encode($data['unor']);
// 		$jj = "Banyaknya Pegawai Berdasarkan Unit Kerja";
// 		$df = $this->m_laporan_cuti->satu(6,$jj,$vll,$dBulan,$tahun);
////////////////////////////////////////////////////////////////////////
		$data['bup'] = array();
		for($i=0;$i<1;$i++){
			$th = date('Y')+$i;
			@$data['bup'][$i]->tahun = $th;
			@$data['bup'][$i]->cuti_sakit = $this->hitung_cuti(1);
			@$data['bup'][$i]->cuti_besar = $this->hitung_cuti(2);
			@$data['bup'][$i]->cuti_besar_haji = $this->hitung_cuti(3);
			@$data['bup'][$i]->cuti_besar_umroh = $this->hitung_cuti(4);
			@$data['bup'][$i]->cuti_alasan_penting = $this->hitung_cuti(5);
			@$data['bup'][$i]->cuti_bersalin = $this->hitung_cuti(6);
			@$data['bup'][$i]->cuti_tahunan = $this->hitung_cuti(7);
			@$data['bup'][$i]->cuti_diluar_tanggungan_negara = $this->hitung_cuti(8);	
			@$data['bup'][$i]->non_l = $this->prediksi_pensiun($th,'non','l',$dBulan,$tahun);
			@$data['bup'][$i]->non_p = $this->prediksi_pensiun($th,'non','p',$dBulan,$tahun);
			@$data['bup'][$i]->non_j = @$data['bup'][$i]->non_l+@$data['bup'][$i]->non_p;
			@$data['bup'][$i]->gunon_l = @$data['bup'][$i]->guru_l+@$data['bup'][$i]->non_l;
			@$data['bup'][$i]->gunon_p = @$data['bup'][$i]->guru_p+@$data['bup'][$i]->non_p;
			@$data['bup'][$i]->gunon_j = @$data['bup'][$i]->gunon_l+@$data['bup'][$i]->gunon_p;
		}
		$vll = json_encode($data['bup']);
		$jj = "Banyaknya Pegawai Pengaju Cuti";
		$df = $this->m_laporan_cuti->satu(7,$jj,$vll,$dBulan,$tahun);

		$data['acc'] = array();
		for($i=0;$i<1;$i++){
			$th = date('Y')+$i;
			@$data['acc'][$i]->tahun = $th;
			@$data['acc'][$i]->cuti_sakit_acc = $this->hitung_cuti_acc(1);
			@$data['acc'][$i]->cuti_besar_acc = $this->hitung_cuti_acc(2);
			@$data['acc'][$i]->cuti_besar_haji_acc = $this->hitung_cuti_acc(3);
			@$data['acc'][$i]->cuti_besar_umroh_acc = $this->hitung_cuti_acc(4);
			@$data['acc'][$i]->cuti_alasan_penting_acc = $this->hitung_cuti_acc(5);
			@$data['acc'][$i]->cuti_bersalin_acc = $this->hitung_cuti_acc(6);
			@$data['acc'][$i]->cuti_tahunan_acc = $this->hitung_cuti_acc(7);
			@$data['acc'][$i]->cuti_diluar_tanggungan_negara_acc = $this->hitung_cuti_acc(8);	
			@$data['acc'][$i]->non_l = $this->prediksi_pensiun($th,'non','l',$dBulan,$tahun);
			@$data['acc'][$i]->non_p = $this->prediksi_pensiun($th,'non','p',$dBulan,$tahun);
			@$data['acc'][$i]->non_j = @$data['bup'][$i]->non_l+@$data['bup'][$i]->non_p;
			@$data['acc'][$i]->gunon_l = @$data['bup'][$i]->guru_l+@$data['bup'][$i]->non_l;
			@$data['acc'][$i]->gunon_p = @$data['bup'][$i]->guru_p+@$data['bup'][$i]->non_p;
			@$data['acc'][$i]->gunon_j = @$data['bup'][$i]->gunon_l+@$data['bup'][$i]->gunon_p;
		}
		$vll = json_encode($data['acc']);
		$jj = "Banyaknya Pegawai Pengaju Cuti";
		$df = $this->m_laporan_cuti->satu(8,$jj,$vll,$dBulan,$tahun);
////////////////////////////////////////////////////////////////////////
//		redirect(site_url('module/appbkpp/dashboard'));
	}

	function orphan(){
		$dueDate = date("Y-m-d");
		$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
		$trn = array();
		foreach($data['unor'] AS $key=>$val){
			$kl = $this->m_laporan_cuti->cek_anak($val->kode_unor,$dueDate);
			$rn=array();
			foreach($kl AS $ky=>$vl){	$rn[] = $vl->id_unor;$trn[] = "'".$vl->kode_unor."'";	}
			$rt = implode(", ",$rn);
			$data['unor'][$key]->rt = "{".$rt."}";
		}
		$trn = implode(",",$trn);
		$data['ky'] = $this->m_laporan_cuti->cek_orphan($trn);
		$this->load->view('dashboard/orphan',$data);
	}


	function prediksi_pensiun($tahun,$jt,$gg,$bll,$thh){
		$iJT = ($jt=="jft-guru")?"AND jab_type='jft-guru'":(($jt=="non")?"AND jab_type!='jft-guru'":"");
		$tt = $tahun;
		$sqlstr="SELECT COUNT(a.id_pegawai) AS numrows
		FROM (r_pegawai_aktual a)
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		WHERE
		IF(a.kode_ese='22' OR a.jab_type='jft-guru' OR a.nomenklatur_jabatan LIKE 'PENGAWAS SEKOLAH%',('$tt'-EXTRACT(YEAR FROM b.tanggal_lahir)=60),('$tt'-EXTRACT(YEAR FROM b.tanggal_lahir)=58))
		AND a.status_kepegawaian='pns'
		AND a.gender='$gg' $iJT";
		$query = $this->db->query($sqlstr)->row();
		return $query->numrows;
	}

	function hitung_cuti($kode_jenis_cuti)
	{
		$sqlstr="SELECT COUNT(n.id_cuti) AS numrows
		FROM r_peg_cuti_aju n
		LEFT JOIN (rekap_peg b) ON (n.id_pegawai=b.id_pegawai)
		LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
		LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
		LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
		LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
		LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
		WHERE kode_jenis_cuti = '$kode_jenis_cuti'
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
		
	}

	function hitung_cuti_acc($kode_jenis_cuti)
	{
		$sqlstr="SELECT COUNT(n.id_cuti) AS numrows
		FROM r_peg_cuti_aju n
		LEFT JOIN (rekap_peg b) ON (n.id_pegawai=b.id_pegawai)
		LEFT JOIN (r_peg_cpns d) ON (n.id_pegawai=d.id_pegawai)
		LEFT JOIN (r_peg_pns e) ON (n.id_pegawai=e.id_pegawai)
		LEFT JOIN (m_unor c) ON (n.id_unor=c.id_unor)
		LEFT JOIN (r_peg_cuti o) ON (n.id_peg_cuti=o.id_peg_cuti)
		LEFT JOIN (r_pegawai f) ON (n.id_pegawai=f.id_pegawai)
		LEFT JOIN (r_peg_cuti_aju z) ON (z.id_peg_cuti=o.id_peg_cuti)
		WHERE (kode_jenis_cuti = '$kode_jenis_cuti' AND z.status = 'acc')
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
		
	}

	function hapus_yang_pensiun(){
		$tg = date("Y-m-d");
		$sql="SELECT * FROM r_pegawai_pensiun WHERE status='pending' AND tanggal_pensiun<='$tg'";
		$hsl = $this->db->query($sql)->result();
		foreach($hsl AS $key=>$val){
			$this->db->set('status','fix');
			$this->db->where('id_pegawai',$val->id_pegawai);
			$this->db->update('r_pegawai_pensiun');

			$this->db->set('status','pensiun');
			$this->db->where('id_pegawai',$val->id_pegawai);
			$this->db->update('r_pegawai');

			$this->db->where('id_pegawai',$val->id_pegawai);
			$this->db->delete('r_pegawai_aktual');
		}
	}


	public function unor() {
		$unor = $this->m_unor->ini_unor($_POST['idd']);
		$data['unor'] = $unor;
		$bll = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$thh = $_POST['tahun'];

		$golongan = $this->dropdowns->kode_golongan_pangkat();
		$data['golongan'] = array();
		foreach($golongan as $key=>$val){	if($key!=""){
			$pns_l = $this->m_laporan_cuti->hitung_pegawai($unor->kode_unor,'pns',$key,'l',$bll,$thh);
			$pns_p = $this->m_laporan_cuti->hitung_pegawai($unor->kode_unor,'pns',$key,'p',$bll,$thh);
			$cpns_l = $this->m_laporan_cuti->hitung_pegawai($unor->kode_unor,'cpns',$key,'l',$bll,$thh);
			$cpns_p = $this->m_laporan_cuti->hitung_pegawai($unor->kode_unor,'cpns',$key,'p',$bll,$thh);

			@$data['golongan'][$key]->nama = $val;
			@$data['golongan'][$key]->pns_l = $pns_l;
			@$data['golongan'][$key]->pns_p = $pns_p;
			@$data['golongan'][$key]->cpns_l = $cpns_l;
			@$data['golongan'][$key]->cpns_p = $cpns_p;
		}}

		$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
		$data['pendidikan'] = array();
		foreach($pendidikan as $key=>$val){	if($key!=""){
			$pns_l = $this->m_laporan_cuti->hitung_pegawai_pendidikan_unor($unor->kode_unor,'pns',$val,'l');
			$pns_p = $this->m_laporan_cuti->hitung_pegawai_pendidikan_unor($unor->kode_unor,'pns',$val,'p');
			$cpns_l = $this->m_laporan_cuti->hitung_pegawai_pendidikan_unor($unor->kode_unor,'cpns',$val,'l');
			$cpns_p = $this->m_laporan_cuti->hitung_pegawai_pendidikan_unor($unor->kode_unor,'cpns',$val,'p');
			@$data['pendidikan'][$key]->nama = $val;
			@$data['pendidikan'][$key]->pns_l = $pns_l;
			@$data['pendidikan'][$key]->pns_p = $pns_p;
			@$data['pendidikan'][$key]->cpns_l = $cpns_l;
			@$data['pendidikan'][$key]->cpns_p = $cpns_p;
		}}
		$jabatan = $this->dropdowns->jenis_jabatan();
		$data['jabatan'] = array();
		foreach($jabatan as $key=>$val){	if($key!=""){
			$pns_l = $this->m_laporan_cuti->hitung_pegawai_jabatan_unor($unor->kode_unor,'pns',$key,'l');
			$pns_p = $this->m_laporan_cuti->hitung_pegawai_jabatan_unor($unor->kode_unor,'pns',$key,'p');
			$cpns_l = $this->m_laporan_cuti->hitung_pegawai_jabatan_unor($unor->kode_unor,'cpns',$key,'l');
			$cpns_p = $this->m_laporan_cuti->hitung_pegawai_jabatan_unor($unor->kode_unor,'cpns',$key,'p');
			@$data['jabatan'][$key]->nama = $val;
			@$data['jabatan'][$key]->pns_l = $pns_l;
			@$data['jabatan'][$key]->pns_p = $pns_p;
			@$data['jabatan'][$key]->cpns_l = $cpns_l;
			@$data['jabatan'][$key]->cpns_p = $cpns_p;
		}}


		$this->load->view('dashboard/unor',$data);
	}
	public function pegawai()   {
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['kelola_skp'] = $this->m_skp->get_skp_kelola($id_pegawai);
		$data['kelola_realisasi'] = $this->m_skp->get_realisasi_kelola($id_pegawai);
		$data['skp'] = $this->m_skp->get_skp($id_pegawai);
		$data['peg'] = $this->m_skp->get_pegawai($id_pegawai);

		$this->load->view('dashboard/pegawai',$data);
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////		tambahan khusus untuk KEPALA OPD
		$ln_kode_unor = strlen($data['peg']->kode_unor);
		$jab_type = $data['peg']->jab_type;
		if($ln_kode_unor==5 && $jab_type=='js'){
			$this->session->set_userdata('kepala_opd', "ya");
			$this->session->set_userdata('kode_unor', $data['peg']->kode_unor);
			$this->session->set_userdata('nama_unor', $data['peg']->nomenklatur_pada);
//			redirect(site_url('sso/kepala_opd'));
		}
///////////////////////////////////////////////////////////////////////////////////////////////////
	}

	public function verifikatur() {
		$data['satu'] = "satu";
		$this->load->view('dashboard/verifikatur',$data);
	}
	public function umpeg() {
		$data['satu'] = $this->session->userdata('user_id');
		$bulan = date('m');
		$tahun = date('Y');
		$data['dua'] = $this->session->userdata('nama_unor');
		$data['unor'] = array();
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola" || $group_name=="absensor_unit"){
			$data['aksi'] = "module/appbkpp/pegawai/aktif";
		} else {
			$data['aksi'] = "module/appevjab/pegawai/aktif_umpeg";
		}

		$this->load->model('appbkpp/m_umpeg');
		$user_id = $this->session->userdata('user_id');
		$user = $this->m_umpeg->ini_user($user_id);
		$dd=array("{","}");
		$acl=  str_replace($dd,"",$user->unor_akses);

		$data['j_pns_l'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"pns","l");
		$data['j_pns_p'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"pns","p");
		$data['j_cpns_l'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"cpns","l");
		$data['j_cpns_p'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"cpns","p");

		$golongan = $this->dropdowns->kode_golongan_pangkat();
		$data['golongan'] = array();
		foreach($golongan as $key=>$val){	if($key!=""){
			$jl = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"l",$acl,$bulan,$tahun);
			$jp = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"p",$acl,$bulan,$tahun);
			@$data['golongan'][$key]->nama = $val;
			@$data['golongan'][$key]->l = $jl;
			@$data['golongan'][$key]->p = $jp;
		}}

		$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
		$data['pendidikan'] = array();
		foreach($pendidikan as $key=>$val){	if($key!=""){
			$jl = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"l",$acl,$bulan,$tahun);
			$jp = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"p",$acl,$bulan,$tahun);
			@$data['pendidikan'][$key]->nama = $val;
			@$data['pendidikan'][$key]->l = $jl;
			@$data['pendidikan'][$key]->p = $jp;
		}}

		$jabatan = $this->dropdowns->jenis_jabatan();
		$data['jabatan'] = array();
		foreach($jabatan as $key=>$val){	if($key!=""){
			$jl = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"l",$acl,$bulan,$tahun);
			$jp = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"p",$acl,$bulan,$tahun);
			@$data['jabatan'][$key]->nama = $val;
			@$data['jabatan'][$key]->l = $jl;
			@$data['jabatan'][$key]->p = $jp;
		}}

		$perkawinan = $this->dropdowns->status_perkawinan();
		$data['perkawinan'] = array();
		foreach($perkawinan as $key=>$val){	if($key!=""){
			$jl = $this->m_laporan_cuti->hitung_pegawai_perkawinan($val,"l",$acl);
			$jp = $this->m_laporan_cuti->hitung_pegawai_perkawinan($val,"p",$acl);
			@$data['perkawinan'][$key]->nama = $val;
			@$data['perkawinan'][$key]->l = $jl;
			@$data['perkawinan'][$key]->p = $jp;
		}}

		$agama = $this->dropdowns->agama();
		$data['agama'] = array();
		foreach($agama as $key=>$val){	if($key!=""){
			$jl = $this->m_laporan_cuti->hitung_pegawai_agama($val,"l",$acl);
			$jp = $this->m_laporan_cuti->hitung_pegawai_agama($val,"p",$acl);
			@$data['agama'][$key]->nama = $val;
			@$data['agama'][$key]->l = $jl;
			@$data['agama'][$key]->p = $jp;
		}}

		$umur = $this->dropdowns->umur();
		$umur_db = $this->dropdowns->umur_db();
		$data['umur'] = array();
		foreach($umur as $key=>$val){	if($key!=""){
			@$data['umur'][$key]->nama = $val;
			$batas = $umur_db[$key];
			$jl = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"l",$acl,$bulan,$tahun);
			$jp = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"p",$acl,$bulan,$tahun);
			@$data['umur'][$key]->l = $jl;
			@$data['umur'][$key]->p = $jp;
		}}

		$mkcpns = $this->dropdowns->mkcpns();
		$mkcpns_db = $this->dropdowns->mkcpns_db();
		$data['mkcpns'] = array();
		foreach($mkcpns as $key=>$val){	if($key!=""){
			@$data['mkcpns'][$key]->nama = $val;
			$batas = $mkcpns_db[$key];
			$jl = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"l",$acl,$bulan,$tahun);
			$jp = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"p",$acl,$bulan,$tahun);
			@$data['mkcpns'][$key]->l = $jl;
			@$data['mkcpns'][$key]->p = $jp;
		}}

		$this->load->view('dashboard/umpeg',$data);
	}

	public function umpeg_kode() {
		$kode = $this->session->userdata('kode_unor');
		if($kode=="04.02"){
			redirect(site_url('module/appbkpp/dashboard/umpeg_pendidikan'));
		} elseif($kode=="04.03") {
			redirect(site_url('module/appbkpp/dashboard/umpeg_kesehatan'));
		} else {
			$data['dua'] = $this->session->userdata('nama_unor');
			$this->load->view('dashboard/umpeg_kode',$data);
		}
	}

	public function umpeg_pendidikan() {
		$data['dua'] = $this->session->userdata('nama_unor');
		$bulan = date('m');
		$tahun = date('Y');
		$kode = $this->session->userdata('kode_unor');
		$tanggal = date('Y-m-d');
		$sqlstr="SELECT a.id_unor FROM m_unor a WHERE a.kode_unor LIKE '$kode%' AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$hslquery=$this->db->query($sqlstr)->result();
		$acl = "";
		foreach($hslquery as $key=>$val){	$acl = ($key==0)?$acl.$val->id_unor:$acl.",".$val->id_unor;	}

			$jabatan = $this->dropdowns->jenis_jabatan();
			$data['jabatan'] = array();
			foreach($jabatan as $key=>$val){	if($key!=""){
				$jl = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"l",$acl,$bulan,$tahun);
				$jp = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"p",$acl,$bulan,$tahun);
				@$data['jabatan'][$key]->nama = $val;
				@$data['jabatan'][$key]->l = $jl;
				@$data['jabatan'][$key]->p = $jp;
			}}

			$this->load->view('dashboard/umpeg_pendidikan',$data);
		}
		public function umpeg_kesehatan() {
			$data['dua'] = $this->session->userdata('nama_unor');
			$bulan = date('m');
			$tahun = date('Y');
			$kode = $this->session->userdata('kode_unor');
			$tanggal = date('Y-m-d');
			$sqlstr="SELECT a.id_unor FROM m_unor a WHERE a.kode_unor LIKE '$kode%' AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
			$hslquery=$this->db->query($sqlstr)->result();
			$acl = "";
			foreach($hslquery as $key=>$val){	$acl = ($key==0)?$acl.$val->id_unor:$acl.",".$val->id_unor;	}

				$jabatan = $this->dropdowns->jenis_jabatan();
				$data['jabatan'] = array();
				foreach($jabatan as $key=>$val){	if($key!="" && $key!='jft-guru'){
					$jl = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"p",$acl,$bulan,$tahun);
					@$data['jabatan'][$key]->nama = $val;
					@$data['jabatan'][$key]->l = $jl;
					@$data['jabatan'][$key]->p = $jp;
				}}

				$this->load->view('dashboard/umpeg_kesehatan',$data);
			}

			public function kepala_opd() {
				$data['satu'] = $this->session->userdata('user_id');
				$bulan = date('m');
				$tahun = date('Y');
				$data['aksi'] = "module/appbkpp/pegawai/aktif";
				$data['dua'] = $this->session->userdata('nama_unor');
				$kode_unor = $this->session->userdata('kode_unor');
				$sqlstr = "SELECT * FROM m_unor WHERE kode_unor LIKE '$kode_unor%'";
				$query = $this->db->query($sqlstr)->result();
				$acl="";
				foreach($query AS $key=>$val){
					$acl = ($key==0)?$acl.$val->id_unor:$acl.",".$val->id_unor;
				}


				$data['j_pns_l'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"pns","l");
				$data['j_pns_p'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"pns","p");
				$data['j_cpns_l'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"cpns","l");
				$data['j_cpns_p'] = $this->m_laporan_cuti->hitung_pegawai_unor($acl,"cpns","p");

				$golongan = $this->dropdowns->kode_golongan_pangkat();
				$data['golongan'] = array();
				foreach($golongan as $key=>$val){	if($key!=""){
					$jl = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_golongan($key,"p",$acl,$bulan,$tahun);
					@$data['golongan'][$key]->nama = $val;
					@$data['golongan'][$key]->l = $jl;
					@$data['golongan'][$key]->p = $jp;
				}}

				$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
				$data['pendidikan'] = array();
				foreach($pendidikan as $key=>$val){	if($key!=""){
					$jl = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_pendidikan($val,"p",$acl,$bulan,$tahun);
					@$data['pendidikan'][$key]->nama = $val;
					@$data['pendidikan'][$key]->l = $jl;
					@$data['pendidikan'][$key]->p = $jp;
				}}

				$jabatan = $this->dropdowns->jenis_jabatan();
				$data['jabatan'] = array();
				foreach($jabatan as $key=>$val){	if($key!=""){
					$jl = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_jabatan($key,"p",$acl,$bulan,$tahun);
					@$data['jabatan'][$key]->nama = $val;
					@$data['jabatan'][$key]->l = $jl;
					@$data['jabatan'][$key]->p = $jp;
				}}

				$perkawinan = $this->dropdowns->status_perkawinan();
				$data['perkawinan'] = array();
				foreach($perkawinan as $key=>$val){	if($key!=""){
					$jl = $this->m_laporan_cuti->hitung_pegawai_perkawinan($val,"l",$acl);
					$jp = $this->m_laporan_cuti->hitung_pegawai_perkawinan($val,"p",$acl);
					@$data['perkawinan'][$key]->nama = $val;
					@$data['perkawinan'][$key]->l = $jl;
					@$data['perkawinan'][$key]->p = $jp;
				}}

				$agama = $this->dropdowns->agama();
				$data['agama'] = array();
				foreach($agama as $key=>$val){	if($key!=""){
					$jl = $this->m_laporan_cuti->hitung_pegawai_agama($val,"l",$acl);
					$jp = $this->m_laporan_cuti->hitung_pegawai_agama($val,"p",$acl);
					@$data['agama'][$key]->nama = $val;
					@$data['agama'][$key]->l = $jl;
					@$data['agama'][$key]->p = $jp;
				}}

				$umur = $this->dropdowns->umur();
				$umur_db = $this->dropdowns->umur_db();
				$data['umur'] = array();
				foreach($umur as $key=>$val){	if($key!=""){
					@$data['umur'][$key]->nama = $val;
					$batas = $umur_db[$key];
					$jl = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_umur($batas,"p",$acl,$bulan,$tahun);
					@$data['umur'][$key]->l = $jl;
					@$data['umur'][$key]->p = $jp;
				}}

				$mkcpns = $this->dropdowns->mkcpns();
				$mkcpns_db = $this->dropdowns->mkcpns_db();
				$data['mkcpns'] = array();
				foreach($mkcpns as $key=>$val){	if($key!=""){
					@$data['mkcpns'][$key]->nama = $val;
					$batas = $mkcpns_db[$key];
					$jl = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"l",$acl,$bulan,$tahun);
					$jp = $this->m_laporan_cuti->hitung_pegawai_mkcpns($batas,"p",$acl,$bulan,$tahun);
					@$data['mkcpns'][$key]->l = $jl;
					@$data['mkcpns'][$key]->p = $jp;
				}}

				$this->load->view('dashboard/umpeg',$data);

			}
			public function mutasi()   {
				$data['satu'] = "satu";
				$this->load->view('dashboard/mutasi',$data);
			}
			public function apel()   {
				$hari_ini = (isset($_POST['hari']))?$_POST['hari']:date('Y-m-d');
				$apel = $this->m_apel->get_akhir_apel($hari_ini);
				$data['lokasi'] = $this->m_apel->get_lokasi(0,200);
				$harian = $this->m_harian->get_akhir_harian($hari_ini);


				$akhir = end($apel);
				$this->session->set_userdata('id_apel',$akhir->id_apel); 

				$data['apel'] = $this->m_apel->ini_apel($akhir->id_apel);
				$hari = $this->dropdowns->hari_konversi();
				$data['hari_apel'] = $hari[$data['apel']->hari_apel];

				$this->session->set_userdata('id_harian',$harian->id_harian); 
				$data['harian'] = $this->m_harian->ini_harian($harian->id_harian);
				$data['hari_maju'] = $this->m_harian->get_maju_harian($harian->tanggal_harian);
				$data['hari_mundur'] = $this->m_harian->get_mundur_harian($harian->tanggal_harian);
				$data['hari_kerja'] = $hari[$data['harian']->hari_kerja];

				$data['wajib'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['hadir'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['sakit'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","S",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['ijin'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","I",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['cuti'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","C",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['dl'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","DL",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['tk'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TK",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

				$data['hadir_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['th_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['s_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","S",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['i_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","I",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['c_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","C",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['dl_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","DL",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['tk_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TK",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

				$data['hadir_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['th_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['s_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","S",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['i_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","I",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['c_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","C",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['dl_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","DL",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['tk_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TK",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

				$data['hadir_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['th_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['s_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","S",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['i_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","I",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['c_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","C",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['dl_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","DL",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['tk_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TK",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

				$data['hadir_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['th_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['s_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","S",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['i_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","I",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['c_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","C",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['dl_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","DL",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
				$data['tk_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TK",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);


				$this->load->view('dashboard/apel',$data);
			}
			public function last_child()   {
				if(isset($_POST['refresh'])){
					$dueDate = date("Y-m-d");
					$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
					$no=0;
					foreach($data['unor'] AS $key=>$val){
						$kl = $this->m_laporan_cuti->cek_anak($val->kode_unor,$dueDate);
						$n=0;
						@$data['san'][$key]->kode_unor = $val->kode_unor;
						@$data['san'][$key]->daftar_unor = "";
						foreach($kl AS $key2=>$val2){
							$kl2 = $this->m_laporan_cuti->cek_anak($val2->kode_unor.".",$dueDate);
							if(empty($kl2)){
								$kode_unor[$no] = $val2->kode_unor;
								$data['san'][$key]->daftar_unor = ($n==0)?$data['san'][$key]->daftar_unor.$val2->id_unor:$data['san'][$key]->daftar_unor.",".$val2->id_unor;
								@$data['makin'][$key][$n]->id_unor = $val2->id_unor;
								$data['makin'][$key][$n]->kode_unor = $val2->kode_unor;
								$data['makin'][$key][$n]->nama_unor = $val2->nama_unor;
								$n++;
								$no++;
							}
						}
						$isi = $data['san'][$key]->daftar_unor;

						$sqlstr="DELETE FROM r_peg_dashboard_val WHERE id_setting='14' AND nama_item='".$val->kode_unor."'";
						$this->db->query($sqlstr);
						$sqlstr="INSERT INTO r_peg_dashboard_val (id_setting,nama_item,meta_value) VALUES ('14','".$val->kode_unor."','$isi')";
						$this->db->query($sqlstr);
					}
				} else {
					$sq ="SELECT * FROM r_peg_dashboard_val WHERE id_setting='14' ORDER BY id_item";
					$qy = $this->db->query($sq)->result();
					foreach($qy AS $key=>$val){
						@$data['unor'][$key]->kode_unor = $val->nama_item;
						$idUnor = explode(",",$val->meta_value);
						foreach($idUnor AS $kk=>$vv){
							$sql ="SELECT * FROM m_unor WHERE id_unor='$vv'";
							$qry = $this->db->query($sql)->row();

							@$data['makin'][$key][$kk]->id_unor = $vv;
							@$data['makin'][$key][$kk]->kode_unor = $qry->kode_unor;
							@$data['makin'][$key][$kk]->nama_unor = $qry->nama_unor;
						}
					}
				}
				$this->load->view('dashboard/last_child',$data);
			}
			public function last_child_jfu_non()   {
				$kode = $_POST['kode'];
				$tanggal = date("Y-m-d");
				$sq ="SELECT * FROM r_peg_dashboard_val WHERE id_setting='14' AND nama_item='$kode'";
				$qy = $this->db->query($sq)->row();
				$lastChild = $qy->meta_value;

				$sqlstr="SELECT * FROM m_unor WHERE kode_unor='$kode' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
				$data['unor'] = $this->db->query($sqlstr)->row();

				$sq ="SELECT * FROM r_pegawai_aktual WHERE jab_type='jfu' AND kode_unor LIKE '$kode%' AND id_unor NOT IN ($lastChild)";
				$data['pegawai'] = $this->db->query($sq)->result();

				$this->load->view('dashboard/last_child_jfu_non',$data);
			}

			public function part_apel()   {
				$id_lokasi = $_POST['id_lokasi'];
				$id_apel = $_POST['id_apel'];
				$apel = $this->m_apel->ini_apel($id_apel);


				$data['wajib'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['hadir'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['sakit'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","S",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['ijin'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","I",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['cuti'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","C",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['dl'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","DL",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['tk'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TK",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

				$data['hadir_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['th_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['s_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","S",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['i_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","I",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['c_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","C",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['dl_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","DL",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['tk_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TK",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

				$data['hadir_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['th_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['s_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","S",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['i_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","I",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['c_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","C",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['dl_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","DL",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['tk_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TK",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

				$data['hadir_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['th_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['s_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","S",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['i_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","I",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['c_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","C",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['dl_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","DL",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['tk_e4'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TK",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

				$data['hadir_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['th_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['s_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","S",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['i_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","I",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['c_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","C",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['dl_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","DL",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
				$data['tk_ne'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TK",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

/*
			$data['wajib'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['wajib_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['wajib_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['wajib_e4']	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['wajib_e99'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","all",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

			$data['hadir'] 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['hadir_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['hadir_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['hadir_e4']	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['hadir_e99'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","H",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);

			$data['thadir'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['thadir_e2'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['thadir_e3'] 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['thadir_e4']	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
			$data['thadir_e99'] = $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TH",$id_lokasi,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
*/

			$this->load->view('dashboard/part_apel',$data);
		}
		public function pempeg()   {
			$hari_ini = (isset($_POST['hari']))?$_POST['hari']:date('Y-m-d');
			$apel = $this->m_apel->get_akhir_apel($hari_ini);
			$data['lokasi'] = $this->m_apel->get_lokasi(0,200);

			$harian = $this->m_harian->get_akhir_harian($hari_ini);
			$this->session->set_userdata('id_harian',$harian->id_harian); 
			$hari = $this->dropdowns->hari_konversi();
			$data['harian'] = $this->m_harian->ini_harian($harian->id_harian);
			$data['hari_maju'] = $this->m_harian->get_maju_harian($harian->tanggal_harian);
			$data['hari_mundur'] = $this->m_harian->get_mundur_harian($harian->tanggal_harian);
			$data['hari_kerja'] = $hari[$data['harian']->hari_kerja];
			$data['tanggal'] = $hari_ini;

			if(empty($apel)){
				$this->load->view('dashboard/pempeg_kosong',$data);
			} else {
				$akhir = end($apel);
				$this->session->set_userdata('id_apel',$akhir->id_apel); 
				$data['apel'] = $this->m_apel->ini_apel($akhir->id_apel);

				$query = $this->get_panel_ubina(3,$hari_ini);
				if(empty($query)){
					$this->load->view('dashboard/pempeg_kosong',$data);
				} else {
					$data['unor'] =json_decode(@$query->meta_value);

					$query = $this->get_panel_ubina(2,$hari_ini);
					$dati = json_decode(@$query->meta_value);
					foreach($dati AS $key=>$val){	$data[$key] = $val;	}

					$query = $this->get_panel_ubina(1,$hari_ini);
					$dati = json_decode(@$query->meta_value);
					foreach($dati AS $key=>$val){	$data[$key] = $val;	}

					$this->load->view('dashboard/pempeg',$data);
				}
			}
		}

		function pempegh(){
////////////////////////////////////////////////////////////////////////
			$dueDate = $_POST['tanggal'];
			$hari_ini = (isset($_POST['hari']))?$_POST['hari']:$dueDate;
			$apel = $this->m_apel->get_akhir_apel($hari_ini);
			$data['lokasi'] = $this->m_apel->get_lokasi(0,200);
			$harian = $this->m_harian->get_akhir_harian($hari_ini);
			$data['harian'] = $this->m_harian->ini_harian($harian->id_harian);

			$akhir = end($apel);
			$data['apel'] = $this->m_apel->ini_apel($akhir->id_apel);
			$hari = $this->dropdowns->hari_konversi();
			$data['hari_apel'] = $hari[$data['apel']->hari_apel];
////////////////////////////////////////////////////////////////////////
			@$iso->a_wajib 		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_wajib_e2 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_wajib_e3 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_wajib_e4		= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_wajib_e99 	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$iso->a_hadir		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_hadir_e2		= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_hadir_e3		= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_hadir_e4		= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_hadir_e99	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$iso->a_thadir		= $this->m_apel->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_thadir_e2	= $this->m_apel->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_thadir_e3	= $this->m_apel->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_thadir_e4	= $this->m_apel->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$iso->a_thadir_e99	= $this->m_apel->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$vll = json_encode($iso);
			$jj = "Absensi Apel";
			$df = $this->dua(1,$jj,$vll,$dueDate);
////////////////////////////////////////////////////////////////////////
			@$isi->hadir = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->hadir_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$isi->cuti = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->cuti_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$isi->sakit = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->sakit_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$isi->ijin = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->ijin_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$isi->dl = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->dl_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$isi->tk = $this->m_harian->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_e2 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_e3 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_e4 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_jft = $this->m_harian->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_jfu = $this->m_harian->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$isi->tk_e99 = $this->m_harian->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$vll = json_encode($isi);
			$jj = "Absensi Eselon";
			$df = $this->dua(2,$jj,$vll,$dueDate);
////////////////////////////////////////////////////////////////////////
			$data['unor'] = $this->m_unor->gettree(0,5,$dueDate);
			foreach($data['unor'] AS $key=>$val){
				$data['unor'][$key]->wajib_hadir = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"all",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->hadir       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->sakit       = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->ijin        = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->cuti        = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->dl          = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->tk          = $this->m_harian->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			}
			$vll = json_encode($data['unor']);
			$jj = "Absensi Unit Kerja";
			$df = $this->dua(3,$jj,$vll,$dueDate);
			echo "sudah";
		}
////////////////////////////////////////////////////////////////////////
		function dua($ids,$nama,$isi,$tanggal){
			$sql="SELECT id_item FROM r_peg_ubina_val WHERE id_setting='$ids' AND tanggal='$tanggal'";
			$hsl = $this->db->query($sql)->row();
			if(empty($hsl)){
				$sqlstr="INSERT INTO r_peg_ubina_val (id_setting,nama_item,meta_value,tanggal) VALUES ('$ids','$nama','$isi','$tanggal')";
				$this->db->query($sqlstr);
			} else {
				$sqlstr="UPDATE r_peg_ubina_val SET meta_value='$isi' WHERE id_item='".$hsl->id_item."'";
				$this->db->query($sqlstr);
			}
		}
		function get_panel_ubina($idd,$tanggal){
			$sqlstr="SELECT * FROM r_peg_ubina_val WHERE id_setting='$idd' AND tanggal='$tanggal'";
			$query = $this->db->query($sqlstr)->row();
			return $query;
		}
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
		function pil_sttkepegawaian(){
			$bulan = $this->session->userdata('bulan');
			$tahun = $this->session->userdata('tahun');

			$dueDate = $tahun."-".$bulan."-01";
			$unor = $this->m_unor->gettree(0,5,$dueDate);

			echo "
			<div class='col-lg-12 col-md-6'>
			<div class='table-responsive'>
			<table class='table table-striped table-bordered table-hover'>
			<tbody id='list_gol_jenjang'>";

			$jp = 0;
			$jl = 0;
			foreach($unor AS $key=>$val){

				$jp1 = $this->j_sttkepegawaian($tahun,$bulan,$_POST['jenis'],'p',$val->kode_unor);
				$jl1 = $this->j_sttkepegawaian($tahun,$bulan,$_POST['jenis'],'l',$val->kode_unor);
				$jp = $jp+$jp1;
				$jl = $jl+$jl1;

				echo "
				<tr>
				<td>".($key+1)."</td>
				<td>".$val->nama_unor."</td>
				<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','l','x','x','x','".$val->kode_unor."','x','x');\"><i class='fa fa-mars'></i> ".$jl1."</div></td>
				<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','p','x','x','x','".$val->kode_unor."','x','x');\"><i class='fa fa-venus'></i> ".$jp1."</div></td>
				<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','x','x','x','x','".$val->kode_unor."','x','x');\">J: ".($jp1+$jl1)."</div></td>
				</tr>
				";

			}

			echo "
			<tr style='background-color:#eee;'>
			<td style='text-align:right;' colspan='2'><b>Total :</b></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".$jl."</div></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".$jp."</div></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('nt','aktif_".$_POST['jenis']."','x','x','x','x','x','x','x','x');\">T: ".($jp+$jl)."</div></td>
			</tr>

			</tbody>
			</table>
			</div>
			</div>
			";
		}

		function pil_pendidikan(){
			echo "<div class='col-lg-12'>".$_POST['jenis']."</div>";
		}

		function pil_pangkat(){
			$bulan = $this->session->userdata('bulan');
			$tahun = $this->session->userdata('tahun');

			$jp1 = $this->j_pangkat($tahun,$bulan,'p','11,12,13,14');
			$jl1 = $this->j_pangkat($tahun,$bulan,'l','11,12,13,14');
			$jp2 = $this->j_pangkat($tahun,$bulan,'p','21,22,23,24');
			$jl2 = $this->j_pangkat($tahun,$bulan,'l','21,22,23,24');
			$jp3 = $this->j_pangkat($tahun,$bulan,'p','31,32,33,34');
			$jl3 = $this->j_pangkat($tahun,$bulan,'l','31,32,33,34');
			$jp4 = $this->j_pangkat($tahun,$bulan,'p','41,42,43,44,45');
			$jl4 = $this->j_pangkat($tahun,$bulan,'l','41,42,43,44,45');

			echo "
			<div class='col-lg-12 col-md-6'>
			<div class='table-responsive'>
			<table class='table table-striped table-bordered table-hover'>
			<tbody id='list_gol_jenjang'>

			<tr>
			<td>Golongan I</td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('11,12,13,14','x','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".$jl1."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('11,12,13,14','x','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".$jp1."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('11,12,13,14','x','x','x','x','x','x','x','x','x');\">J: ".($jp1+$jl1)."</div></td>
			</tr>
			<tr>
			<td>Golongan II</td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('21,22,23,24','x','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".$jl2."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('21,22,23,24','x','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".$jp2."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('21,22,23,24','x','x','x','x','x','x','x','x','x');\">J: ".($jp2+$jl2)."</div></td>
			</tr>
			<tr>
			<td>Golongan III</td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('31,32,33,34','x','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".$jl3."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('31,32,33,34','x','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".$jp3."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('31,32,33,34','x','x','x','x','x','x','x','x','x');\">J: ".($jp3+$jl3)."</div></td>
			</tr>
			<tr>
			<td>Golongan IV</td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('41,42,43,44,45','x','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".$jl4."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('41,42,43,44,45','x','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".$jp4."</div></td>
			<td class='item-dashboard'><div class='btn btn-default btn-sm' onClick=\"pilih('41,42,43,44,45','x','x','x','x','x','x','x','x','x');\">J: ".($jp4+$jl4)."</div></td>
			</tr>
			<tr style='background-color:#eee;'>
			<td style='text-align:right;'><b>Total :</b></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('x','x','x','l','x','x','x','x','x','x');\"><i class='fa fa-mars'></i> ".($jl1+$jl2+$jl3+$jl4)."</div></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('x','x','x','p','x','x','x','x','x','x');\"><i class='fa fa-venus'></i> ".($jp1+$jp2+$jp3+$jp4)."</div></td>
			<td class='item-dashboard'><div class='btn btn-success btn-sm' onClick=\"pilih('x','x','x','x','x','x','x','x','x','x');\">T: ".($jp1+$jp2+$jp3+$jp4+$jl1+$jl2+$jl3+$jl4)."</div></td>
			</tr>

			</tbody>
			</table>
			</div>
			</div>
			";
		}

		private function j_pangkat($tahun,$bulan,$gender,$pkt){
			$sq = "SELECT COUNT(a.id_pegawai) AS banyak_peg FROM r_pegawai_bulanan a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
			WHERE a.status_kepegawaian='pns' AND b.gender='$gender' AND a.tahun='$tahun' AND a.bulan='$bulan' AND a.kode_golongan IN ($pkt)";
			$qr = $this->db->query($sq)->row();
			$jml = $qr->banyak_peg;
			return $jml;
		}
		private function j_sttkepegawaian($tahun,$bulan,$stt,$gender,$kode){
			$sq = "SELECT COUNT(a.id_pegawai) AS banyak_peg FROM r_pegawai_bulanan a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
			WHERE a.status_kepegawaian='$stt' AND b.gender='$gender' AND a.tahun='$tahun' AND a.bulan='$bulan' AND a.kode_unor LIKE '$kode%'";
			$qr = $this->db->query($sq)->row();
			$jml = $qr->banyak_peg;
			return $jml;
		}


	}
	?>