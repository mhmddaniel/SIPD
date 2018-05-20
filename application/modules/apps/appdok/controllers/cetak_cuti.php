<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cetak_cuti extends MX_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('UTC');
//		$this->load->model('appdok/m_edok');
//		$this->load->model('appbkpp/m_pegawai');
		// $this->load->helper('sikda');
	}
	function index($id_pegawai=false,$id_peg_cuti=false,$kode_jenis_cuti){
		$this->load->library('mypdf');
    
		$this->mypdf->SetCreator(PDF_CREATOR);
		$this->mypdf->SetAuthor('BKPP');
		$this->mypdf->SetTitle('Cuti PEGAWAI');
		$this->mypdf->SetSubject('Cuti PEGAWAI');
		$this->mypdf->SetKeywords('BKPP, PDF, CUTI');
		$tglCetak = date("s:i:H d/m/Y",mktime(date('s'),date('i'),date('H'),date('d'),date('h'),date('Y')));
    
		$this->mypdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->mypdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->mypdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->mypdf->SetMargins(10, 10, 10);
		$this->mypdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->mypdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->mypdf->SetAutoPageBreak(TRUE, 10);
		$this->mypdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->mypdf->SetFont('helvetica', '', 12);
		if($kode_jenis_cuti=="1"){
		$this->createcutisakit($id_pegawai,$id_peg_cuti);
		} else if($kode_jenis_cuti=="2"){
			//cuti besar
		} else if($kode_jenis_cuti=="3"){
		$this->createcutibesarhaji($id_pegawai,$id_peg_cuti);	
		} else if($kode_jenis_cuti=="4"){
		$this->createcutibesarumroh($id_pegawai,$id_peg_cuti);	
		} else if($kode_jenis_cuti=="5"){
		$this->createcutialasanpenting($id_pegawai,$id_peg_cuti);	
		} else if($kode_jenis_cuti=="6"){
		$this->createcutibersalin($id_pegawai,$id_peg_cuti);	
		} else if($kode_jenis_cuti=="7"){
		$this->createcutitahunan($id_pegawai,$id_peg_cuti);	
		} else if($kode_jenis_cuti=="8"){
			//diluar tanggungan negara
		}
		$this->mypdf->Output($id_pegawai.'.pdf', 'I');
	}
	
	function createcutisakit($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		$html = $this->gethtmlcutisakit($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutisakit($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutisakit($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_sakit',array('data'=>$html),true );
	}
	
	function createcutibesarhaji($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		$html = $this->gethtmlcutibesarhaji($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutibesarhaji($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutibesarhaji($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_besar',array('data'=>$html),true );
	}
	
	function createcutibesarumroh($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		$html = $this->gethtmlcutibesarumroh($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutibesarumroh($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutibesarumroh($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_besar_umroh',array('data'=>$html),true );
	}
	
	function createcutialasanpenting($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		
		$html = $this->gethtmlcutialasanpenting($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutialasanpenting($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutialasanpenting($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_alasan_penting',array('data'=>$html),true );
	}
	
	function createcutibersalin($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		$html = $this->gethtmlcutibersalin($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutibersalin($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutibersalin($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_bersalin',array('data'=>$html),true );
	}
	
	function createcutitahunan($id_pegawai=false,$id_cuti=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		
		/* $logo = base_url()."assets/images/logo.png";
		$this->mypdf->Image($logo, 14, 8, '', 30, '', '', '', true, 100); */
		$html = $this->gethtmlcutitahunan($id_pegawai,$id_cuti);
		$this->mypdf->writeHTML($html, true, 0, true, 0);;
	}
	
	function gethtmlcutitahunan($id_pegawai=false,$id_cuti=false){
		$html = $this->getdatacutitahunan($id_pegawai,$id_cuti);
		return $this->load->view('cv/cetak_cuti_tahunan',array('data'=>$html),true );
	}
	
	function getdatacutisakit($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_sakit',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_sakit',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff'] = $this->load->view('cv/diff',array('data'=>$data['diff']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		
		    
		return $html;
	}
	
	function getdatacutibesarhaji($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_besar',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_sakit',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff_cuti'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff_cuti'] = $this->load->view('cv/diff_cuti',array('data'=>$data['diff_cuti']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		
		return $html;
	}
	
	function getdatacutibesarumroh($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_besar_umroh',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_sakit',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff_cuti'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff_cuti'] = $this->load->view('cv/diff_cuti',array('data'=>$data['diff_cuti']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		
		    
		return $html;
	}
	
	function getdatacutialasanpenting($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_alasan_penting',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_sakit',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff'] = $this->load->view('cv/diff',array('data'=>$data['diff']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		
		return $html;
	}
	
	function getdatacutibersalin($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_bersalin',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_sakit',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff_cuti'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff_cuti'] = $this->load->view('cv/diff_cuti',array('data'=>$data['diff_cuti']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		
		
		return $html;
	}
	
	function getdatacutitahunan($id_pegawai=false,$id_cuti=false){
		
		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head_cuti_tahunan',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi_cuti_tahunan',array('data'=>$data['pribadi']),true );
 		$data['mulai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['mulai'] = $this->load->view('cv/tanggal_mulai_cuti',array('data'=>$data['mulai']),true );
		$data['alasan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['alasan'] = $this->load->view('cv/alasan_cuti',array('data'=>$data['alasan']),true );
		$data['sampai'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['sampai'] = $this->load->view('cv/tanggal_sampai_cuti',array('data'=>$data['sampai']),true );
		$data['tujuan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tujuan'] = $this->load->view('cv/tujuan',array('data'=>$data['tujuan']),true );
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['jabatan'] = $this->load->view('cv/jabatan_ijin',array('data'=>$data['jabatan']),true );
		$data['tahun_ijin'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['tahun_ijin'] = $this->load->view('cv/tahun_ijin',array('data'=>$data['tahun_ijin']),true );
		$data['diff'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['diff'] = $this->load->view('cv/diff',array('data'=>$data['diff']),true );
		$data['agenda'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);
		$html['agenda'] = $this->load->view('cv/no_agenda',array('data'=>$data['agenda']),true );
		$data['ttd'] = Modules::run("appbkpp/profile/ini_pegawai1",$id_pegawai,$id_cuti);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['ttd'] = $this->load->view('cv/ttd_cuti_tahunan',array('data'=>$data['ttd']),true );
		return $html;
	}

}
?>