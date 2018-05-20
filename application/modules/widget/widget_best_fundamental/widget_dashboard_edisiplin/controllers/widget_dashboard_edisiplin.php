<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_dashboard_edisiplin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_dashboard_edisiplin');
		$this->load->model('appbkpp/m_unor');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['margin_top']=$opsi[0]->nilai;
		$data['satu']=$opsi[1]->nilai;
		$data['dua']=$opsi[2]->nilai;

		$data['satu'] = "satu";
		$hari_ini = (isset($_POST['hari']))?$_POST['hari']:date('Y-m-d');
		$apel = $this->m_dashboard_edisiplin->get_akhir_apel($hari_ini);
		$data['lokasi'] = $this->m_dashboard_edisiplin->get_lokasi(0,200);
		$harian = $this->m_dashboard_edisiplin->get_akhir_harian($hari_ini);


			$akhir = end($apel);
			$this->session->set_userdata('id_apel',$akhir->id_apel); 
			
			$data['apel'] = $this->m_dashboard_edisiplin->ini_apel($akhir->id_apel);
			$hari = $this->dropdowns->hari_konversi();
			$data['hari_apel'] = $hari[$data['apel']->hari_apel];

			$data['a_wajib'] 		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_wajib_e2'] 	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_wajib_e3'] 	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_wajib_e4']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_wajib_e99'] 	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","all",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$data['a_hadir']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_hadir_e2']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_hadir_e3']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_hadir_e4']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_hadir_e99']	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","H",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$data['a_thadir']		= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","","","","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_thadir_e2']	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",2,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_thadir_e3']	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",3,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_thadir_e4']	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",4,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);
			$data['a_thadir_e99']	= $this->m_dashboard_edisiplin->hitung_wajib_apel("","all","all","","","",99,"","","","","","all","all","TH",$data['lokasi'][0]->id_lokasi,$akhir->id_apel,$data['apel']->bulan_apel,$data['apel']->tahun_apel);

			$this->session->set_userdata('id_harian',$harian->id_harian); 
			$data['harian'] = $this->m_dashboard_edisiplin->ini_harian($harian->id_harian);
			$data['hari_maju'] = $this->m_dashboard_edisiplin->get_maju_harian($harian->tanggal_harian);
			$data['hari_mundur'] = $this->m_dashboard_edisiplin->get_mundur_harian($harian->tanggal_harian);
			$data['hari_kerja'] = $hari[$data['harian']->hari_kerja];

			$data['hadir'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['hadir_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['cuti'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['cuti_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['sakit'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['sakit_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['ijin'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['ijin_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['dl'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['dl_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['tk'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_e2'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","2","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_e3'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","3","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_e4'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","4","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_jft'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jft","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_jfu'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","jfu","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			$data['tk_e99'] = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all","","","","99","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);

			$data['unor'] = $this->m_unor->gettree(0,5,date("Y-m-d"));
			foreach($data['unor'] AS $key=>$val){
				$data['unor'][$key]->wajib_hadir = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"all",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->hadir       = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"H",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->sakit       = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"S",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->ijin        = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"I",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->cuti        = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"C",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->dl          = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"DL",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
				$data['unor'][$key]->tk          = $this->m_dashboard_edisiplin->hitung_wajib_hadir("","all","all",$val->kode_unor,"","","","","","","","","","",$harian->id_harian,0,"TK",$data['harian']->bulan_harian,$data['harian']->tahun_harian);
			}



		$this->load->view('index',$data);
	}


	public function hitung()	{
		$this->m_dashboard_edisiplin->kosong();
/////////////////////////////////////////////////////////////////////////
		$jabatan = $this->dropdowns->jenis_jabatan();
		$data['jabatan'] = array();
			foreach($jabatan as $key=>$val){	if($key!=""){
					$jl = $this->m_dashboard_edisiplin->hitung_pegawai_jabatan($key,"l");
					$jp = $this->m_dashboard_edisiplin->hitung_pegawai_jabatan($key,"p");
					@$data['jabatan'][$key]->nama = $val;
					@$data['jabatan'][$key]->l = $jl;
					@$data['jabatan'][$key]->p = $jp;
					@$data['jabatan'][$key]->j = $jl+$jp;
			}}
		$vll = json_encode($data['jabatan']);
		$jj = "Banyaknya Pegawai Berdasarkan Jenis Jabatan";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
		$data['pendidikan'] = array();
			foreach($pendidikan as $key=>$val){	if($key!=""){
					$jl = $this->m_dashboard_edisiplin->hitung_pegawai_pendidikan($val,"l");
					$jp = $this->m_dashboard_edisiplin->hitung_pegawai_pendidikan($val,"p");
					@$data['pendidikan'][$key]->nama = $val;
					@$data['pendidikan'][$key]->l = $jl;
					@$data['pendidikan'][$key]->p = $jp;
					@$data['pendidikan'][$key]->j = $jl+$jp;
			}}
		$vll = json_encode($data['pendidikan']);
		$jj = "Banyaknya Pegawai Berdasarkan Jenjang Pendidikan";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$golongan = $this->dropdowns->kode_golongan_pangkat();
		$data['golongan'] = array();
			foreach($golongan as $key=>$val){	if($key!=""){
					$jl = $this->m_dashboard_edisiplin->hitung_pegawai_golongan($key,"l");
					$jp = $this->m_dashboard_edisiplin->hitung_pegawai_golongan($key,"p");
					@$data['golongan'][$key]->nama = $val;
					@$data['golongan'][$key]->l = $jl;
					@$data['golongan'][$key]->p = $jp;
					@$data['golongan'][$key]->j = $jl+$jp;
			}}
		$vll = json_encode($data['golongan']);
		$jj = "Banyaknya Pegawai Berdasarkan Golongan";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$umur = $this->dropdowns->umur();
		$umur_db = $this->dropdowns->umur_db();
		$data['umur'] = array();
			foreach($umur as $key=>$val){	if($key!=""){
					@$data['umur'][$key]->nama = $val;
					$batas = $umur_db[$key];
					$jl = $this->m_dashboard_edisiplin->hitung_pegawai_umur($batas,"l");
					$jp = $this->m_dashboard_edisiplin->hitung_pegawai_umur($batas,"p");
					@$data['umur'][$key]->l = $jl;
					@$data['umur'][$key]->p = $jp;
					@$data['umur'][$key]->j = $jl+$jp;
			}}
		$vll = json_encode($data['umur']);
		$jj = "Banyaknya Pegawai Berdasarkan Kelompok Umur";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$mkcpns = $this->dropdowns->mkcpns();
		$mkcpns_db = $this->dropdowns->mkcpns_db();
		$data['mkcpns'] = array();
			foreach($mkcpns as $key=>$val){	if($key!=""){
					@$data['mkcpns'][$key]->nama = $val;
					$batas = $mkcpns_db[$key];
					$jl = $this->m_dashboard_edisiplin->hitung_pegawai_mkcpns($batas,"l");
					$jp = $this->m_dashboard_edisiplin->hitung_pegawai_mkcpns($batas,"p");
					@$data['mkcpns'][$key]->l = $jl;
					@$data['mkcpns'][$key]->p = $jp;
					@$data['mkcpns'][$key]->j = $jl+$jp;
			}}
		$vll = json_encode($data['mkcpns']);
		$jj = "Banyaknya Pegawai Berdasarkan Masa Kerja CPNS";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$data['unor'] = $this->m_unor->gettree(0,5,date("Y-m-d"));
		$data['where'] = "WHERE ";
			foreach($data['unor'] AS $key=>$val){
				$j_all = $this->m_dashboard_edisiplin->hitung_pegawai($val->kode_unor);
				$j_pns = $this->m_dashboard_edisiplin->hitung_pegawai($val->kode_unor,"pns");
				$j_cpns = $this->m_dashboard_edisiplin->hitung_pegawai($val->kode_unor,"cpns");
				$data['unor'][$key]->j_all = $j_all;
				$data['unor'][$key]->j_pns = $j_pns;
				$data['unor'][$key]->j_cpns = $j_cpns;
				
				$data['where'] = ($key==0)?$data['where']."kode_unor NOT LIKE '".$val->kode_unor."%'":$data['where']." AND kode_unor NOT LIKE '".$val->kode_unor."%'";
			}
		$vll = json_encode($data['unor']);
		$jj = "Banyaknya Pegawai Berdasarkan Unit Kerja";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
		$data['bup'] = array();
		for($i=0;$i<5;$i++){
			$th = date('Y')+$i;
			@$data['bup'][$i]->tahun = $th;
			@$data['bup'][$i]->guru_l = $this->prediksi_pensiun($th,'jft-guru','l');
			@$data['bup'][$i]->guru_p = $this->prediksi_pensiun($th,'jft-guru','p');
			@$data['bup'][$i]->guru_j = @$data['bup'][$i]->guru_l+@$data['bup'][$i]->guru_p;
			@$data['bup'][$i]->non_l = $this->prediksi_pensiun($th,'non','l');
			@$data['bup'][$i]->non_p = $this->prediksi_pensiun($th,'non','p');
			@$data['bup'][$i]->non_j = @$data['bup'][$i]->non_l+@$data['bup'][$i]->non_p;
			@$data['bup'][$i]->gunon_l = @$data['bup'][$i]->guru_l+@$data['bup'][$i]->non_l;
			@$data['bup'][$i]->gunon_p = @$data['bup'][$i]->guru_p+@$data['bup'][$i]->non_p;
			@$data['bup'][$i]->gunon_j = @$data['bup'][$i]->gunon_l+@$data['bup'][$i]->gunon_p;
		}
		$vll = json_encode($data['bup']);
		$jj = "Banyaknya Pegawai Mencapai BUP";
		$df = $this->m_dashboard_edisiplin->satu($jj,$vll);
/////////////////////////////////////////////////////////////////////////
	}


}