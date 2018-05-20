<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_data_umpeg extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appdok/m_edok');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index($awal){
$this->load->library('myexcel');


			$namaUnor = $this->session->userdata('nama_unor');


$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', $namaUnor);
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(20);
$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

$styleArray2 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray3 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray4 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);


$rc=2;
$periode="REKAPITULASI STATUS DATA SIKDA";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'BIODATA');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'CPNS');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'PRAJABATAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'PNS');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'KONVERSI NIP');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'KEPANGKATAN');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);


$styleArray = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'font' => array(
        'name' => 'Arial',
        'size' => '12',
		'bold' => true,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'CCCCCC',),
      ),
);
$this->myexcel->getActiveSheet()->getStyle('B4:K4')->applyFromArray($styleArray);
//$this->myexcel->getActiveSheet()->getStyle('B4:N4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$styleArray5 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray5b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray6 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray6b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray6bb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray6c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray7 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray7b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray7bb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray7c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);

			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			$hsl = $this->m_pegawai->get_pegawai_bulanan("",0,400,"all",$unor,"","","","","","","","","","","",date("m"),date("Y"),"pns");

$rc=5;$i=1;
foreach($hsl as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5b);
	$this->myexcel->getActiveSheet()->setCellValue('B'.($rc+1), "");
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+1))->applyFromArray($styleArray5);

		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.($rc+1), $nip);
	$this->myexcel->getActiveSheet()->getStyle('C'.($rc+1))->applyFromArray($styleArray6);

		$seno = Modules::run("appbkpp/profile/ini_pegawai_master",$val->id_pegawai);
				@$st_tanggal_lahirr = ($seno->tanggal_lahirr=="00-00-0000")?"salah":"benar";
				@$st_tempat_lahir = (strlen($seno->tempat_lahir)<=3)?"salah":"benar";
				@$st_agama = (strlen($seno->agama)<=3)?"salah":"benar";
				@$st_status_perkawinan = (strlen($seno->status_perkawinan)<=3)?"salah":"benar";
					$sena = ($st_tanggal_lahirr=="salah" || $st_tempat_lahir=="salah" || $st_agama=="salah" || $st_status_perkawinan=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
		$cek = $this->m_edok->cek_dokumen($val->nip_baru,"pasfoto",0);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('D'.($rc+1), "Pasfoto: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('D'.($rc+1))->applyFromArray($ws);


		$seno = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$val->id_pegawai);
			$salah=0;	$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->nama_sekolah)<3){	$salah++;	}
				if(strlen($vall->nomor_ijazah)<=3){	$salah++;	}
				if($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970"){	$salah++;	}
				if($keyy==0){
					if($vall->kode_jenjang!='05'){	$salah++;	}
				} else {
					if($seno[$keyy]->kode_jenjang<$seno[($keyy-1)]->kode_jenjang){	$salah++;	}
				}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"ijazah_pendidikan",$vall->id_peg_pendidikan);
				if(empty($cek)){	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('E'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('E'.($rc+1))->applyFromArray($ws);

			$seno = Modules::run("appbkpp/profile/ini_pegawai_cpns",$val->id_pegawai);
				@$st_sk_cpns_tgl = ($seno->sk_cpns_tgll=="00-00-0000" || $seno->sk_cpns_tgll=="")?"salah":"benar";
				@$st_sk_cpns_nomor = (strlen($seno->sk_cpns_nomor)<3)?"salah":"benar";
				@$st_tmt_cpns = ($seno->tmt_cpnss=="00-00-0000" || $seno->tmt_cpnss=="" || $seno->tmt_cpnss==$seno->sk_cpns_tgll)?"salah":"benar";
					$sena = ($st_sk_cpns_tgl=="salah" || $st_sk_cpns_nomor=="salah" || $st_tmt_cpns=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_cpns",@$seno->id);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('F'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('F'.($rc+1))->applyFromArray($ws);

			$seno = Modules::run("appbkpp/profile/ini_pegawai_prajabatan",$val->id_pegawai);
				@$st_tanggal_sttpl = ($seno->tanggal_sttpll=="00-00-0000" || $seno->tanggal_sttpll=="01-01-1970" || $seno->tanggal_sttpll=="")?"salah":"benar";
				@$st_nomor_sttpl = (strlen($seno->nomor_sttpl)<3)?"salah":"benar";
				@$st_penyelenggara = (strlen($seno->penyelenggara)<3)?"salah":"benar";
					$sena = ($st_tanggal_sttpl=="salah" || $st_nomor_sttpl=="salah" || $st_penyelenggara=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sertifikat_prajab",@$seno->id_peg_diklat_struk);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+1))->applyFromArray($ws);

			if($val->status_kepegawaian=="pns"){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_pns",$val->id_pegawai);
				@$st_sk_pns_tanggal = ($seno->sk_pns_tanggall=="00-00-0000" || $seno->sk_pns_tanggall=="")?"salah":"benar";
				@$st_sk_pns_nomor = (strlen($seno->sk_pns_nomor)<3)?"salah":"benar";
				@$st_tmt_pns = ($seno->tmt_pnss=="00-00-0000" || $seno->tmt_pnss=="" || $seno->tmt_pnss==$seno->sk_pns_tanggall)?"salah":"benar";
					$sena = ($st_sk_pns_tanggal=="salah" || $st_sk_pns_nomor=="salah" || $st_tmt_pns=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pns",@$seno->id);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
			} else {	$sena = "-";	$wr=$styleArray6b;	$senC = "-";	$ws = $styleArray6;	}
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('H'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('H'.($rc+1))->applyFromArray($ws);

			if(strlen($val->nip)==9){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_konversi_nip",$val->id_pegawai);
				@$st_konversi_nip_tanggal = ($seno->konversi_nip_tanggall=="00-00-0000" || $seno->konversi_nip_tanggall=="01-01-1970" || $seno->konversi_nip_tanggall=="")?"salah":"benar";
				@$st_konversi_nip_nomor = (strlen($seno->konversi_nip_nomor)<10)?"salah":"benar";
					$sena = ($st_konversi_nip_tanggal=="salah" || $st_konversi_nip_nomor=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"konversi_nip",@$seno->id_konversi_nip);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
			} else {	$sena = "-";	$wr=$styleArray6b;	$senC = "-";	$ws = $styleArray6;	}
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('I'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('I'.($rc+1))->applyFromArray($ws);

		$seno = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$val->id_pegawai);
			$salah=0;$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->sk_nomor)<=3)	{	$salah++;	}
				if($vall->sk_tangga=="00-00-0000" || $vall->sk_tangga=="01-01-1970")	{	$salah++;	}
				if($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970")	{	$salah++;	}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pangkat",$vall->id_peg_golongan);
				if(empty($cek))	{	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('J'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('J'.($rc+1))->applyFromArray($ws);

		$seno = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$val->id_pegawai);
			$salah=0;$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->sk_nomor)<=3)	{	$salah++;	}
				if($vall->sk_tanggall=="00-00-0000" || $vall->sk_tanggall=="01-01-1970")	{	$salah++;	}
				if($vall->tmt_jabatann=="00-00-0000" || $vall->tmt_jabatann=="01-01-1970")	{	$salah++;	}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_jabatan",$vall->id_peg_jab);
				if(empty($cek))	{	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray7bb:$styleArray7b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray7c:$styleArray7;
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('K'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('K'.($rc+1))->applyFromArray($ws);

$i++;$rc++;$rc++;
}

$styleArray8 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray9 = array(
      'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray10 = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
//
//$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':N'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':J'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray10);

///////////////////////////////////////////////////////////////////////////
$filename='daftar_pegawai.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
             
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->myexcel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
}


















/////////////////////////////khusus group_id = 6//////////////////////>>
    function get_user_unor($user_id = false)
    {
      $this->db->from('user_umpeg a');
      $this->db->where('a.user_id',$user_id);
      $a_unor = $this->db->get()->row();
			$dd=array("{","}");
      $b_unor = explode(",",str_replace($dd,"",$a_unor->unor_akses));
      $this->db->select('a.nama_unor');
      $this->db->from('m_unor a');
      $this->db->where('a.id_unor',$b_unor[0]);
      $c_unor = $this->db->get()->row();
	  
	  $acl = str_replace($dd,"",$a_unor->unor_akses);

      return array('nama_unor'=>$c_unor->nama_unor,'acl'=>$acl);
    }



function admin($awal){
$this->load->library('myexcel');


			$nm = $this->get_user_unor($awal);
			$namaUnor = $nm['nama_unor'];


$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', $namaUnor);
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(20);
$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

$styleArray2 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray3 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray4 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);


$rc=2;
$periode="REKAPITULASI STATUS DATA SIKDA";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'BIODATA');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'CPNS');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'PRAJABATAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'PNS');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'KONVERSI NIP');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'KEPANGKATAN');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);


$styleArray = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'font' => array(
        'name' => 'Arial',
        'size' => '12',
		'bold' => true,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'CCCCCC',),
      ),
);
$this->myexcel->getActiveSheet()->getStyle('B4:K4')->applyFromArray($styleArray);
//$this->myexcel->getActiveSheet()->getStyle('B4:N4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$styleArray5 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray5b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray6 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray6b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray6bb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray6c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray7 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray7b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray7bb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);
$styleArray7c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'EEEEEE',),
      ),
);

			$this->load->model('appbkpp/m_umpeg');
//			$user_id = $this->session->userdata('user_id');
//			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("[","]");
			$unor=  $nm['acl'];
			$hsl = $this->m_pegawai->get_pegawai("",0,400,"all",$unor,"","","","","","","","","");
$rc=5;$i=1;
foreach($hsl as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5b);
	$this->myexcel->getActiveSheet()->setCellValue('B'.($rc+1), "");
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+1))->applyFromArray($styleArray5);

		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
		$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.($rc+1), $nip);
	$this->myexcel->getActiveSheet()->getStyle('C'.($rc+1))->applyFromArray($styleArray6);


		$seno = Modules::run("appbkpp/profile/ini_pegawai_master",$val->id_pegawai);
				@$st_tanggal_lahirr = ($seno->tanggal_lahirr=="00-00-0000")?"salah":"benar";
				@$st_tempat_lahir = (strlen($seno->tempat_lahir)<=3)?"salah":"benar";
				@$st_agama = (strlen($seno->agama)<=3)?"salah":"benar";
				@$st_status_perkawinan = (strlen($seno->status_perkawinan)<=3)?"salah":"benar";
					$sena = ($st_tanggal_lahirr=="salah" || $st_tempat_lahir=="salah" || $st_agama=="salah" || $st_status_perkawinan=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
		$cek = $this->m_edok->cek_dokumen($val->nip_baru,"pasfoto",0);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('D'.($rc+1), "Pasfoto: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('D'.($rc+1))->applyFromArray($ws);


		$seno = Modules::run("appbkpp/profile/ini_pegawai_pendidikan",$val->id_pegawai);
			$salah=0;	$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->nama_sekolah)<3){	$salah++;	}
				if(strlen($vall->nomor_ijazah)<=3){	$salah++;	}
				if($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970"){	$salah++;	}
				if($keyy==0){
					if($vall->kode_jenjang!='05'){	$salah++;	}
				} else {
					if($seno[$keyy]->kode_jenjang<$seno[($keyy-1)]->kode_jenjang){	$salah++;	}
				}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"ijazah_pendidikan",$vall->id_peg_pendidikan);
				if(empty($cek)){	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('E'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('E'.($rc+1))->applyFromArray($ws);

			$seno = Modules::run("appbkpp/profile/ini_pegawai_cpns",$val->id_pegawai);
				@$st_sk_cpns_tgl = ($seno->sk_cpns_tgll=="00-00-0000" || $seno->sk_cpns_tgll=="")?"salah":"benar";
				@$st_sk_cpns_nomor = (strlen($seno->sk_cpns_nomor)<3)?"salah":"benar";
				@$st_tmt_cpns = ($seno->tmt_cpnss=="00-00-0000" || $seno->tmt_cpnss=="" || $seno->tmt_cpnss==$seno->sk_cpns_tgll)?"salah":"benar";
					$sena = ($st_sk_cpns_tgl=="salah" || $st_sk_cpns_nomor=="salah" || $st_tmt_cpns=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_cpns",@$seno->id);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('F'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('F'.($rc+1))->applyFromArray($ws);

			$seno = Modules::run("appbkpp/profile/ini_pegawai_prajabatan",$val->id_pegawai);
				@$st_tanggal_sttpl = ($seno->tanggal_sttpll=="00-00-0000" || $seno->tanggal_sttpll=="01-01-1970" || $seno->tanggal_sttpll=="")?"salah":"benar";
				@$st_nomor_sttpl = (strlen($seno->nomor_sttpl)<3)?"salah":"benar";
				@$st_penyelenggara = (strlen($seno->penyelenggara)<3)?"salah":"benar";
					$sena = ($st_tanggal_sttpl=="salah" || $st_nomor_sttpl=="salah" || $st_penyelenggara=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sertifikat_prajab",@$seno->id_peg_diklat_struk);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+1))->applyFromArray($ws);

			if($val->status_kepegawaian=="pns"){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_pns",$val->id_pegawai);
				@$st_sk_pns_tanggal = ($seno->sk_pns_tanggall=="00-00-0000" || $seno->sk_pns_tanggall=="")?"salah":"benar";
				@$st_sk_pns_nomor = (strlen($seno->sk_pns_nomor)<3)?"salah":"benar";
				@$st_tmt_pns = ($seno->tmt_pnss=="00-00-0000" || $seno->tmt_pnss=="" || $seno->tmt_pnss==$seno->sk_pns_tanggall)?"salah":"benar";
					$sena = ($st_sk_pns_tanggal=="salah" || $st_sk_pns_nomor=="salah" || $st_tmt_pns=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pns",@$seno->id);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
			} else {	$sena = "-";	$wr=$styleArray6b;	$senC = "-";	$ws = $styleArray6;	}
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('H'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('H'.($rc+1))->applyFromArray($ws);

			if(strlen($val->nip)==9){
			$seno = Modules::run("appbkpp/profile/ini_pegawai_konversi_nip",$val->id_pegawai);
				@$st_konversi_nip_tanggal = ($seno->konversi_nip_tanggall=="00-00-0000" || $seno->konversi_nip_tanggall=="01-01-1970" || $seno->konversi_nip_tanggall=="")?"salah":"benar";
				@$st_konversi_nip_nomor = (strlen($seno->konversi_nip_nomor)<10)?"salah":"benar";
					$sena = ($st_konversi_nip_tanggal=="salah" || $st_konversi_nip_nomor=="salah")?"KURANG":"Lengkap";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
			$cek = $this->m_edok->cek_dokumen($val->nip_baru,"konversi_nip",@$seno->id_konversi_nip);
					$senC = (empty($cek))?"TIDAK ADA":"Ada";
					$ws = ($senC=="TIDAK ADA")?$styleArray6c:$styleArray6;
			} else {	$sena = "-";	$wr=$styleArray6b;	$senC = "-";	$ws = $styleArray6;	}
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('I'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('I'.($rc+1))->applyFromArray($ws);

		$seno = Modules::run("appbkpp/profile/ini_pegawai_pangkat",$val->id_pegawai);
			$salah=0;$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->sk_nomor)<=3)	{	$salah++;	}
				if($vall->sk_tangga=="00-00-0000" || $vall->sk_tangga=="01-01-1970")	{	$salah++;	}
				if($vall->tangga=="00-00-0000" || $vall->tangga=="01-01-1970")	{	$salah++;	}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_pangkat",$vall->id_peg_golongan);
				if(empty($cek))	{	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray6bb:$styleArray6b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray6c:$styleArray6;
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('J'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('J'.($rc+1))->applyFromArray($ws);

		$seno = Modules::run("appbkpp/profile/ini_pegawai_jabatan",$val->id_pegawai);
			$salah=0;$salih=0;
			foreach($seno AS $keyy=>$vall){
				if(strlen($vall->sk_nomor)<=3)	{	$salah++;	}
				if($vall->sk_tanggall=="00-00-0000" || $vall->sk_tanggall=="01-01-1970")	{	$salah++;	}
				if($vall->tmt_jabatann=="00-00-0000" || $vall->tmt_jabatann=="01-01-1970")	{	$salah++;	}
						$cek = $this->m_edok->cek_dokumen($val->nip_baru,"sk_jabatan",$vall->id_peg_jab);
				if(empty($cek))	{	$salih++;	}
			}
					$sena = ($salah==0)?"Lengkap":"KURANG";
					$wr = ($sena=="KURANG")?$styleArray7bb:$styleArray7b;
					$senC = ($salih==0)?"Lengkap":"KURANG";
					$ws = ($senC=="KURANG")?$styleArray7c:$styleArray7;
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, "Data: ".$sena);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($wr);
	$this->myexcel->getActiveSheet()->setCellValue('K'.($rc+1), "eDok: ".$senC);
	$this->myexcel->getActiveSheet()->getStyle('K'.($rc+1))->applyFromArray($ws);

$i++;$rc++;$rc++;
}










$styleArray8 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray9 = array(
      'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray10 = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
//
//$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':N'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':J'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray10);

///////////////////////////////////////////////////////////////////////////
$filename='daftar_pegawai.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
             
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->myexcel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
}



}
?>