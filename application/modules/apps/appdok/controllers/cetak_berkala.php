<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cetak_berkala extends MX_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('UTC');
//		$this->load->model('appdok/m_edok');
//		$this->load->model('appbkpp/m_pegawai');
		// $this->load->helper('sikda');
	}
	function index($id_pegawai=false){
		$this->load->library('mypdf');
    
		$this->mypdf->SetCreator(PDF_CREATOR);
		$this->mypdf->SetAuthor('BKPP');
		$this->mypdf->SetTitle('CV PEGAWAI');
		$this->mypdf->SetSubject('CV PEGAWAI');
		$this->mypdf->SetKeywords('BKPP, PDF, CV');
		$tglCetak = date("s:i:H d/m/Y",mktime(date('s'),date('i'),date('H'),date('d'),date('h'),date('Y')));
    
		$this->mypdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->mypdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->mypdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->mypdf->SetMargins(10, 10, 10);
		$this->mypdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->mypdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->mypdf->SetAutoPageBreak(TRUE, 10);
		$this->mypdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->mypdf->SetFont('helvetica', '', 8);
    $this->createcv($id_pegawai);
		$this->mypdf->Output($id_pegawai.'.pdf', 'I');
	}

  function sk(){

    $isi['id_pegawai'] =$_GET['id_pegawai'];
    // $isi['kode_golongan'] =$result['kode_golongan'];
    $isi['no_sk'] =$_GET['no_sk'];
    // $isi['tanggal_sk'] =$result['tanggal_sk'];
    $isi['mk_gol_tahun'] =$_GET['mk_gol_tahun'];
    $isi['mk_gol_bulan'] =$_GET['mk_gol_bulan'];
    // $isi['oleh_pejabat'] =$result['oleh_pejabat'];
    // $isi['gaji_lama'] =$result['gaji_lama'];
    // $isi['gaji_baru'] =$result['gaji_baru'];
    $isi['tmt_gaji'] =$_GET['tmt_gaji'];


    $this->load->library('mypdf');
    
    $this->mypdf->SetCreator(PDF_CREATOR);
    $this->mypdf->SetAuthor('BKPP');
    $this->mypdf->SetTitle('SK BERKALA PEGAWAI');
    $this->mypdf->SetSubject('SK BERKALA PEGAWAI');
    $this->mypdf->SetKeywords('BKPP, PDF, SK BERKALA');
    $tglCetak = date("s:i:H d/m/Y",mktime(date('s'),date('i'),date('H'),date('d'),date('h'),date('Y')));
    
    $this->mypdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $this->mypdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $this->mypdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $this->mypdf->SetMargins(5, 5, 5);
    $this->mypdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $this->mypdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $this->mypdf->SetAutoPageBreak(TRUE, 10);
    $this->mypdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $this->mypdf->SetFont('HELVETICA', '', 12);
    $this->createsk($isi);
    $this->mypdf->Output("sk_berkala_".$isi['id_pegawai'].'.pdf', 'I');
  }

	function createcv($id_pegawai=false){
		$this->mypdf->AddPage();
		$this->mypdf->SetFillColor(255, 255, 127);
		$fotopath = $this->pasfoto($id_pegawai);
		$this->mypdf->Image($fotopath, 160, 38, '', 30, '', '', '', true, 100);

		$logo = base_url()."assets/images/logo.png";
		$this->mypdf->Image($logo, 10, 8, '', 18, '', '', '', true, 100);

		$html = $this->gethtml($id_pegawai);
		$this->mypdf->writeHTML($html, true, 0, true, 0);
	}

  function createsk($isi){
    $this->mypdf->AddPage();
    $this->mypdf->SetFillColor(255, 255, 127);

    $html = $this->gethtmlsk($isi);
    $this->mypdf->writeHTML($html, true, 0, true, 0);
  }


	function gethtml($id_pegawai=false){
		$html = $this->getdata($id_pegawai);
		return $this->load->view('cv/template',array('data'=>$html),true );
	}

function gethtmlsk($isi){
    $html = $this->getdatask($isi);
    return $this->load->view('berkala/sk',array('data'=>$html),true );
  }


function getdatask($isi){

    $id_pegawai = $isi['id_pegawai'];

    $data['head'] = Modules::run("appbkpp/profile_berkala/ini_berkala",$id_pegawai);//  Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
    $html['head'] = $this->load->view('berkala/head_berkala',array('data'=>$data['head']),true );
    $data['pribadi'] = Modules::run("appbkpp/profile_berkala/ini_berkala",$id_pegawai);//   Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
    $html['pribadi'] = $this->load->view('berkala/pribadi_berkala',array('data'=>$data['pribadi']),true );

    $data['alamat'] = Modules::run("appbkpp/profile_berkala/ini_berkala_lanjutan",$isi);//   Modules::run("datamodel/pegawai/get_peg_alamat",$id_pegawai);
    $html['alamat'] = $this->load->view('berkala/pribadi_berkala_lanjutan',array('data'=>$data['alamat']),true );    
    return $html;
  }


	function getdata($id_pegawai=false){

 

		$data['head'] = Modules::run("appbkpp/profile/ini_pegawai",$id_pegawai);// 	Modules::run("datamodel/pegawai/get_pegawai",$id_pegawai);
		$html['head'] = $this->load->view('cv/head',array('data'=>$data['head']),true );
 		$data['pribadi'] = Modules::run("appbkpp/profile/ini_pegawai",$id_pegawai);// 	Modules::run("datamodel/pegawai/get_peg_biodata",$id_pegawai);
		$html['pribadi'] = $this->load->view('cv/pribadi',array('data'=>$data['pribadi']),true );
		$data['alamat'] = Modules::run("appbkpp/profile/ini_pegawai_alamat",$id_pegawai);// 	Modules::run("datamodel/pegawai/get_peg_alamat",$id_pegawai);
		$html['alamat'] = $this->load->view('cv/alamat',array('data'=>$data['alamat']),true );
		$data['marital'] = Modules::run("appbkpp/profile/ini_pegawai_pernikahan",$id_pegawai);// 	Modules::run("datamodel/pegawai/get_riwayat_perkawinan",$id_pegawai);
    if(count($data['marital']) > 0){
      $html['marital'] = $this->load->view('cv/marital',array('data'=>$data['marital']),true );
    }else{
      $html['marital'] = 'Tidak Ada Data untuk ditampilkan';
    }
    
		$data['anak'] = Modules::run("appbkpp/profile/ini_pegawai_anak",$id_pegawai);// 	MModules::run("datamodel/pegawai/get_riwayat_anak",$id_pegawai);
    if(count($data['anak']) > 0){
      $html['anak'] = $this->load->view('cv/anak',array('data'=>$data['anak']),true );
    }else{
      $html['anak'] = 'Tidak Ada Data untuk ditampilkan';
    }
    
		$data['pendidikan'] = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$id_pegawai);// 	Modules::run("datamodel/pegawai/get_riwayat_pend",$id_pegawai);
    if(count($data['pendidikan']) > 0){
      $html['pendidikan'] = $this->load->view('cv/pendidikan',array('data'=>$data['pendidikan']),true,true );
      }else{
      $html['pendidikan'] = 'Tidak Ada Data untuk ditampilkan';
    }
    
		$data['pengangkatan']['pns'] = Modules::run("appbkpp/profile/ini_pegawai_pns",$id_pegawai);
		$data['pengangkatan']['cpns'] = Modules::run("appbkpp/profile/ini_pegawai_cpns",$id_pegawai);
		$html['pengangkatan'] = $this->load->view('cv/pengangkatan',array('data'=>$data['pengangkatan']),true );
    
		$data['pangkat'] = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$id_pegawai);
    if(count($data['pangkat']) > 0){
      $html['pangkat'] = $this->load->view('cv/pangkat',array('data'=>$data['pangkat']),true );
      }else{
      $html['pangkat'] = 'Tidak Ada Data untuk ditampilkan';
    }
		$data['jabatan'] = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$id_pegawai);
    if(count($data['jabatan']) > 0){
      $html['jabatan'] = $this->load->view('cv/jabatan',array('data'=>$data['jabatan']),true );
      }else{
      $html['jabatan'] = 'Tidak Ada Data untuk ditampilkan';
    }  
		$data['diklat'] = Modules::run("appbkpp/profile/ini_pegawai_diklat_struk",$id_pegawai);
    if(count($data['diklat']) > 0){
      $html['diklat'] = $this->load->view('cv/diklat',array('data'=>$data['diklat']),true );
      }else{
      $html['diklat'] = 'Tidak Ada Data untuk ditampilkan';
    }  
		$data['kursus'] = Modules::run("appbkpp/profile/ini_pegawai_kursus",$id_pegawai);
    if(count($data['kursus']) > 0){
      $html['kursus'] = $this->load->view('cv/kursus',array('data'=>$data['kursus']),true );
      }else{
      $html['kursus'] = 'Tidak Ada Data untuk ditampilkan';
    }
		$data['skp'] = Modules::run("appbkpp/profile/ini_skp",$id_pegawai);
    if(count($data['skp']) > 0){
      $html['skp'] = $this->load->view('cv/skp',array('data'=>$data['skp']),true );
      }else{
      $html['skp'] = 'Tidak Ada Data untuk ditampilkan';
    }

		$data['penghargaan'] = Modules::run("appbkpp/profile/ini_sertifikat_penghargaan",$id_pegawai);
    if(count($data['penghargaan']) > 0){
      $html['penghargaan'] = $this->load->view('cv/penghargaan',array('data'=>$data['penghargaan']),true );
      }else{
      $html['penghargaan'] = 'Tidak Ada Data untuk ditampilkan';
    }    
		return $html;
	}
	function banyak(){
    $this->load->model('auth/auths');
    $acl = $this->auths->get_user_acl_unor($this->session->userdata('user_id'));
    $nama_unor = $this->session->userdata('nama_unor');

    $path = str_replace('\\','/',FCPATH)."assets/file/cv/".$nama_unor;
    if (!file_exists($path)) {
      if (!mkdir($path, 0777, true)) {
        die('Failed to create folders...');
      }
    }
    if(is_array($acl)){
      $sqlselect="a.*";
      $this->db->select($sqlselect,false);
      $this->db->where_in('a.id_unor',$acl);
      // $this->db->limit(2);
      $data = $this->db->get('rekap_peg a')->result();
    }
    if($data){
      foreach($data as $row){
        // echo 'Membuat file '.$row->nama_pegawai.' - '.$row->nip_baru.".pdf";
        
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_URL, site_url('appdatapegawai/cetak/index/'.$row->id_pegawai) );
        
        $data = curl_exec($ch);
        $result = file_put_contents($path.'/'.$row->nama_pegawai.' - '.$row->nip_baru.".pdf", $data);
        // echo '.... Selesai<br/>';
      }
      // echo '<a href="'.site_url('appdatapegawai/cetak/zipdownload').'">Download CV</a>';
      $this->zipdownload();
    }
	}
	function zipdownload(){
    $nama_unor = $this->session->userdata('nama_unor');
    
    $path = str_replace('\\','/',FCPATH)."assets/file/cv/".$nama_unor.'/';

    $this->load->library('zip');
    
    $this->zip->read_dir($path, FALSE);
    $this->zip->download($nama_unor.'.zip'); 
  }

	function pasfoto($idd){
		$mPeg = Modules::run("appbkpp/profile/ini_pegawai_master",$idd);//$this->m_pegawai->ini_pegawai_master($idd);
		$nip = $mPeg->nip_baru;

		$cek = $this->m_edok->cek_dokumen($nip,"pasfoto",0);
		if(empty($cek)){
			$foto = base_url()."assets/file/foto/photo.jpg";
		} else {
			$path2 = "assets/media/file/".$nip."/pasfoto/".$cek[0]->file_dokumen;
			if(!file_exists($path2)){	
				$foto = base_url()."assets/file/foto/photo.jpg";
			} else {
				$foto = $path2;
			}
		}
		return $foto;
	}
}
?>