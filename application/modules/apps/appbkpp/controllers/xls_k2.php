<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_k2 extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index(){


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('terdaftar');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Daftar Pegawai K2');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
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
$periode="PERIODE :";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'TEMPAT, TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);

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
$this->myexcel->getActiveSheet()->getStyle('B4:G4')->applyFromArray($styleArray);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$styleArray5 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray6 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray7 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);

			$sql = "SELECT * FROM r_pegawai_cltn WHERE status_perkawinan=''";
			$qry = $this->db->query($sql)->result();

$rc=5;$i=0+1;
foreach($qry as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
$tanggal_lahir = $val->tempat_lahir.", ".date("d-m-Y", strtotime($val->tanggal_lahir));
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $tanggal_lahir);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
$unor = $val->nomenklatur_pada;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $unor);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
$pend = $val->nama_jenjang_rumpun;
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $pend);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray7);

$i++;$rc++;
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
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':F'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray10);
///////////////////////////////////////////////////////////////////////////
$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('diterima');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Daftar Pegawai K2');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

$rc=2;
$periode="PERIODE :";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'TEMPAT, TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);

$this->myexcel->getActiveSheet()->getStyle('B4:G4')->applyFromArray($styleArray);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

			$sql = "SELECT * FROM r_pegawai_cltn WHERE status_perkawinan='' AND nip_baru LIKE '19%'";
			$qry = $this->db->query($sql)->result();

$rc=5;$i=0+1;
foreach($qry as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
$tanggal_lahir = $val->tempat_lahir.", ".date("d-m-Y", strtotime($val->tanggal_lahir));
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $tanggal_lahir);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
$unor = $val->nomenklatur_pada;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $unor);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
$pend = $val->nama_jenjang_rumpun;
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $pend);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray7);

$i++;$rc++;
}
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':F'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray10);
///////////////////////////////////////////////////////////////////////////
$this->myexcel->createSheet(NULL, 2);
$this->myexcel->setActiveSheetIndex(2);
$this->myexcel->getActiveSheet()->setTitle('dipending');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Daftar Pegawai K2');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

$rc=2;
$periode="PERIODE :";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'TEMPAT, TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);

$this->myexcel->getActiveSheet()->getStyle('B4:G4')->applyFromArray($styleArray);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

			$sql = "SELECT * FROM r_pegawai_cltn WHERE status_perkawinan='' AND nip_baru NOT LIKE '19%'";
			$qry = $this->db->query($sql)->result();

$rc=5;$i=0+1;
foreach($qry as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
$tanggal_lahir = $val->tempat_lahir.", ".date("d-m-Y", strtotime($val->tanggal_lahir));
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $tanggal_lahir);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
$unor = $val->nomenklatur_pada;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $unor);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
$pend = $val->nama_jenjang_rumpun;
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $pend);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray7);

$i++;$rc++;
}
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':F'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray10);
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