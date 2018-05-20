<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xapel_presensi_bulan extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('appbina/m_apel');
  }

	function index(){
		$this->load->library('myexcel');
$styleArray2 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2d = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2e = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray3 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray3b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray3c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray3d = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'eeeeee',),
      ),
);
$styleArray3dd = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'eeeeee',),
      ),
);
$styleArray3e = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'cccccc',),
      ),
);
$styleArray3ee = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'cccccc',),
      ),
);
$styleArray4 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);


		$this->myexcel->setActiveSheetIndex(0);
		$this->myexcel->getActiveSheet()->setTitle('rekap_kehadiran');
		$this->myexcel->getActiveSheet()->setCellValue('B1', "Rekapitulasi Apel Pegawai");
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

		$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(4);
		$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
		$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
///////////////////////////////////////////
$kol[0] = "D";
$kol[1] = "E";
$kol[2] = "F";
$kol[3] = "G";
$kol[4] = "H";
$kol[5] = "I";
$kol[6] = "J";
$kol[7] = "K";
$kol[8] = "L";
$kol[9] = "M";
$kol[10] = "N";
$kol[11] = "O";
$kol[12] = "P";
$kol[13] = "Q";
$kol[14] = "R";
$kol[15] = "S";
$kol[16] = "T";
$kol[17] = "U";
$kol[18] = "V";
$kol[19] = "W";
$kol[20] = "X";
$kol[21] = "Y";
$kol[22] = "Z";
$kol[23] = "AA";
$kol[24] = "AB";
$kol[25] = "AC";
$kol[26] = "AD";
$kol[27] = "AE";
$kol[28] = "AF";
$kol[29] = "AG";
$kol[30] = "AH";
$kol[31] = "AI";
$kol[32] = "AJ";
$kol[33] = "AK";
$kol[34] = "AL";
$kol[35] = "AM";
$kol[36] = "AN";
$kol[37] = "AO";
	foreach($kol AS $key=>$val){
		$this->myexcel->getActiveSheet()->getColumnDimension($val)->setWidth(4);
	}

/////////////////////////////////////////
$id_apel = $this->session->userdata('id_apel');
$apel = $this->m_apel->ini_apel($id_apel);
$hari = explode("-",$apel->tg_apel);
$bln = $this->dropdowns->bulan3();
$blnn = $bln[$hari[1]];
//////////////////////////////////////////////
		$rc=2;
		$prd = "Bulan ".$blnn.", Tahun ".$hari[0];
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $prd);
		$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "nn");

$rc++;
$rc++;$rd=$rc+1;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "NO.");
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':B'.$rd);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.$rd)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rd)->applyFromArray($styleArray2e);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "NAMA");
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':C'.$rd);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':C'.$rd)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rd)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "TANGGAL");
$rc++;
$df = $this->m_apel->get_daftar($apel->tahun_apel,$apel->bulan_apel);
foreach($df AS $key=>$val){
$tanggal = $val->tanggal_apel;
$tgl = explode("-",$tanggal);
$tglc = $tgl[0];
$tgln = $kol[$key];
$tgld = $kol[($key+1)];
		$this->myexcel->getActiveSheet()->setCellValue($tgln.$rc, $tglc);
		$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray2d);
		$this->myexcel->getActiveSheet()->getStyle($tgld.$rc)->applyFromArray($styleArray3c);
}
		$this->myexcel->getActiveSheet()->mergeCells('D'.($rc-1).':'.$tgln.($rc-1));
		$this->myexcel->getActiveSheet()->getStyle('B4:'.$tgln.$rc)->getFont()->setBold(true);
		$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1))->applyFromArray($styleArray2);
		$this->myexcel->getActiveSheet()->setCellValue($tgld.($rc-1), "REKAP");
		$this->myexcel->getActiveSheet()->getStyle($tgld.($rc-1))->applyFromArray($styleArray3c);


$dk = $this->dropdowns->kehadiran();
$dk['H'] = "Hadir";
$kk=0;
foreach($dk AS $keyA=>$valA){
$tglc=$keyA;
	if($tglc!=""){
		$tgln = $kol[($key+$kk+1)];
		$this->myexcel->getActiveSheet()->setCellValue($tgln.$rc, $tglc);
		$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray2d);

		$kk++;
	}
}
		$this->myexcel->getActiveSheet()->mergeCells($tgld.($rc-1).':'.$tgln.($rc-1));
		$this->myexcel->getActiveSheet()->getStyle($tgld.($rc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle($tgld.($rc-1))->applyFromArray($styleArray2d);

		$this->myexcel->getActiveSheet()->getStyle('D'.($rc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('D'.($rc-1).':'.$tgln.($rc-1))->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->getStyle($tgln.($rc-1))->applyFromArray($styleArray3c);


$rc++;


$dPeg = $this->m_apel->get_wajib_apel("",0,20,"all","all","","","","","","","","","","all","all","all",0,$id_apel,$apel->bulan_apel,$apel->tahun_apel);
foreach($dPeg AS $key=>$val){
	$jtk = 0;
	$jdl = 0;
	$jcuti = 0;
	$jsakit = 0;
	$jijin = 0;
	$jhadir = 0;

	$nama = $val->nama_pegawai;
	$nomer = $key+1;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nomer);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3b);
		foreach($df AS $key2=>$val2){
			$hari_ini = date('Y-m-d');
			$idd = $val2->id_apel;
			$tgln = $kol[$key2];
			$tgld = $kol[($key2+1)];

			$tgle = $kol[($key2+2)];
			$tglf = $kol[($key2+3)];
			$tglg = $kol[($key2+4)];
			$tglh = $kol[($key2+5)];
			$tgli = $kol[($key2+6)];
			$tglj = $kol[($key2+7)];

			if($hari_ini<$val2->tg_apel){
				$idS = " -";
			} else {

					$idS = "H";
/*
				$shift = $this->m_xls->get_status($val->id_pegawai,$idd);
				if(@$shift->kode_keterangan_presensi==86){
					$idS = "H";
				} else {
					$idS = @$shift->kode_keterangan_presensi;
				}
*/
			}

			if($idS=="H"){
				$jhadir++;
			} elseif($idS=="S") {
				$jsakit++;
			} elseif($idS=="DL") {
				$jdl++;
			} elseif($idS=="I") {
				$jijin++;
			} elseif($idS=="C") {
				$jcuti++;
			} elseif($idS=="TK") {
				$jtk++;
			}

		$this->myexcel->getActiveSheet()->setCellValue($tgln.$rc, $idS);
		$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				if(@$val2->hari_apel=="Saturday"){
					$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray3d);
				} elseif(@$val2->hari_apel=="Sunday") {
					$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray3e);
				} else {
					$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray3b);
				}
		$this->myexcel->getActiveSheet()->getStyle($tgld.$rc)->applyFromArray($styleArray3c);
		}

		$this->myexcel->getActiveSheet()->setCellValue($tgld.$rc, $jtk);
		$this->myexcel->getActiveSheet()->getStyle($tgld.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue($tgle.$rc, $jcuti);
		$this->myexcel->getActiveSheet()->getStyle($tgle.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue($tglf.$rc, $jsakit);
		$this->myexcel->getActiveSheet()->getStyle($tglf.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue($tglg.$rc, $jijin);
		$this->myexcel->getActiveSheet()->getStyle($tglg.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue($tglh.$rc, $jdl);
		$this->myexcel->getActiveSheet()->getStyle($tglh.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue($tgli.$rc, $jhadir);
		$this->myexcel->getActiveSheet()->getStyle($tgli.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->getStyle($tglj.$rc)->applyFromArray($styleArray3c);

$rc++;
}

		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':'.$tgli.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':'.$tgli.$rc);
		$this->myexcel->getActiveSheet()->unmergeCells('B'.$rc.':'.$tgli.$rc);
$rc++;
$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "Keterangan :");
		$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3dd);
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "Sabtu");
$rc++;
		$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3ee);
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "Minggu");


		
		$filename='rekap_apel_bulanan.xls'; //save our workbook as this file name
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