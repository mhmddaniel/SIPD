<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_dashboard_ekinerja extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_dashboard_ekinerja');
		$this->load->model('widget_dashboard_sikda/m_dashboard_sikda');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['dwBulan'] = $this->dropdowns->bulan();
		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:date('n');
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');


		$query = $this->m_dashboard_sikda->get_panel(8,$data['bulan'],$data['tahun']);
		$data['unor'] =json_decode(@$query->meta_value);
		$query = $this->m_dashboard_sikda->get_panel(9,$data['bulan'],$data['tahun']);
		$jbt =json_decode(@$query->meta_value);
		$data['ess2'] = @$jbt->ess2;
		$data['ess3'] = @$jbt->ess3;
		$data['ess4'] = @$jbt->ess4;
		$data['jfu'] = @$jbt->jfu;
		$data['jft'] = @$jbt->jft;

		$data['margin_top']=$opsi[0]->nilai;
		$data['satu']=$opsi[1]->nilai;
		$data['dua']=$opsi[2]->nilai;
		$this->load->view('index',$data);
  }
  public function daftar_pegawai()  {
		$data['unor'] = $this->m_dashboard_sikda->gettree(0,5,"2015-01-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$data['st_realisasi'] = $this->dropdowns->tahapan_tpp_realisasi();
		$data['nl_realisasi'] = $this->dropdowns->tpp_nilai();

		$data['dua'] = $this->session->userdata('nama_unor');
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
		$data['pstrealisasi'] = (isset($_POST['pstrealisasi']))?$_POST['pstrealisasi']:"";
		$data['pnlrealisasi'] = (isset($_POST['pnlrealisasi']))?$_POST['pnlrealisasi']:"";

		$data['bulan'] = (isset($_POST['bulan']))?$_POST['bulan']:str_replace("0","",date('m'));
		$data['tahun'] = (isset($_POST['tahun']))?$_POST['tahun']:date('Y');
		$this->load->view('aktif',$data);
  }


	function getrealisasi(){
			$unor="all";
			$kode=$_POST['kode'];
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
			$tahun=$_POST['tahun'];
			$st_realisasi=$_POST['st_realisasi'];
			$nl_realisasi=$_POST['nl_realisasi'];
			$data['bulan'] = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];

		$cct = $this->m_dashboard_ekinerja->hitung_pegawai($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$data['bulan'],$tahun,$st_realisasi,$nl_realisasi);
		$data['count'] = count($cct);
		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);
		$this->session->set_userdata("tahun",$tahun);
		$this->session->set_userdata("bulan",$data['bulan']);

		$pangkat = $this->dropdowns->kode_pangkat();
		$golongan = $this->dropdowns->kode_golongan();
		$bulan = $this->dropdowns->bulan();
		$tahapan_tpp_nomor = $this->dropdowns->tahapan_tpp_nomor();
		$tahapan_tpp = $this->dropdowns->tahapan_tpp();

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpagingA' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_dashboard_ekinerja->get_pegawai($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$data['bulan'],$tahun,$st_realisasi,$nl_realisasi);
			foreach($data['hslquery'] AS $key=>$val){
				@$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$pangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$golongan[$val->kode_golongan];

				$data['hslquery'][$key]->penilai_nama_pegawai = ($val->status!='acc_penilai')?"-":((trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'').((trim($val->penilai_gelar_nonakademis) != '-')?trim($val->penilai_gelar_nonakademis).' ':'').$val->penilai_nama_pegawai.((trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'');
				$data['hslquery'][$key]->penilai_nip_baru = ($val->status!='acc_penilai')?"-":$val->penilai_nip_baru; 
				$data['hslquery'][$key]->penilai_nama_pangkat = ($val->status!='acc_penilai')?"-":$val->penilai_nama_pangkat; 
				$data['hslquery'][$key]->penilai_nama_golongan = ($val->status!='acc_penilai')?"-":$val->penilai_nama_golongan; 
				$data['hslquery'][$key]->penilai_nomenklatur_jabatan = ($val->status!='acc_penilai')?"-":$val->penilai_nomenklatur_jabatan; 

				$data['hslquery'][$key]->nilai_skp = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":$val->nilai_tugaspokok; 
				$data['hslquery'][$key]->nilai_tugastambahan = (empty($val->nilai_tugastambahan) || $val->status!='acc_penilai')?"-":$val->nilai_tugastambahan; 
				$data['hslquery'][$key]->nilai_kreatifitas = (empty($val->nilai_kreatifitas) || $val->status!='acc_penilai')?"-":$val->nilai_kreatifitas; 
				$data['hslquery'][$key]->nilai_perilaku = (empty($val->nilai_perilaku) || $val->status!='acc_penilai')?"-":$val->nilai_perilaku; 
				$data['hslquery'][$key]->nilai_total = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":(($val->nilai_tugaspokok+$val->nilai_kreatifitas+$val->nilai_tugastambahan)*.6)+($val->nilai_perilaku); 
				$data['hslquery'][$key]->biaya = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":($val->biaya == NULL)?"-":number_format($val->biaya,2,"."," "); 

				$data['hslquery'][$key]->aksi = ($val->status!='acc_penilai')?"&nbsp;":"<div class='btn btn-default btn-xs' onclick=\"ppost(".$val->id_tpp.",'module/apptukin/pantau/realisasi_arsip')\"><i class='fa fa-binoculars fa-fw'></i></div>";


				$data['hslquery'][$key]->status_tpp = @$realisasi->status; 
			}
			$data['pager'] = Modules::run("web/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}




}