<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_rekap_unor extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_dashboard');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index(){
$unor = $this->m_unor->ini_unor($_POST['kode']);
$nama_unor = $unor->nama_unor;
$this->load->library('myexcel');
$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('pangkat');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', $nama_unor);
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);

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


$rc=3;

$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'REKAPITULASI BERDASARKAN PANGKAT/GOLONGAN');
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PANGKAT / GOLONGAN');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PNS (l)');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PNS (p)');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PNS');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'CPNS (l)');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'CPNS (p)');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'CPNS');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'TOTAL');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);

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
$this->myexcel->getActiveSheet()->getStyle('B4:J4')->applyFromArray($styleArray);
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


$rc=5;$i=1;
		$golongan = $this->dropdowns->kode_golongan_pangkat();
		$data['golongan'] = array();
			foreach($golongan as $key=>$val){	if($key!=""){
					$pns_l = $this->m_dashboard->hitung_pegawai($unor->kode_unor,'pns',$key,'l');
					$pns_p = $this->m_dashboard->hitung_pegawai($unor->kode_unor,'pns',$key,'p');
					$cpns_l = $this->m_dashboard->hitung_pegawai($unor->kode_unor,'cpns',$key,'l');
					$cpns_p = $this->m_dashboard->hitung_pegawai($unor->kode_unor,'cpns',$key,'p');

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $pns_l);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $pns_p);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc,'=D'.$rc.'+E'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $cpns_l);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $cpns_p);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc,'=G'.$rc.'+H'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc,'=F'.$rc.'+I'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray7);

$rc++;
$i++;
			}}

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, '');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'TOTAL :');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, '=SUM(D5:D20)');
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, '=SUM(E5:E20)');
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, '=SUM(F5:F20)');
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, '=SUM(G5:G20)');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, '=SUM(H5:H20)');
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, '=SUM(I5:I20)');
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, '=SUM(J5:J20)');
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray10);


$rc++;
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'REKAPITULASI BERDASARKAN JENJANG PENDIDIKAN');
$rc++;

$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'JENJANG PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PNS (l)');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PNS (p)');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PNS');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'CPNS (l)');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'CPNS (p)');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'CPNS');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'TOTAL');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);

$this->myexcel->getActiveSheet()->getRowDimension(24)->setRowHeight(30);
$this->myexcel->getActiveSheet()->getStyle('B24:J24')->applyFromArray($styleArray);

$rc++;


		$pendidikan = $this->dropdowns->kode_jenjang_pendidikan();
		$data['pendidikan'] = array();

$i = 1;
			foreach($pendidikan as $key=>$val){	if($key!=""){
					$pns_l = $this->m_dashboard->hitung_pegawai_pendidikan_unor($unor->kode_unor,'pns',$val,'l');
					$pns_p = $this->m_dashboard->hitung_pegawai_pendidikan_unor($unor->kode_unor,'pns',$val,'p');
					$cpns_l = $this->m_dashboard->hitung_pegawai_pendidikan_unor($unor->kode_unor,'cpns',$val,'l');
					$cpns_p = $this->m_dashboard->hitung_pegawai_pendidikan_unor($unor->kode_unor,'cpns',$val,'p');
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $pns_l);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $pns_p);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc,'=D'.$rc.'+E'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $cpns_l);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $cpns_p);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc,'=G'.$rc.'+H'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc,'=F'.$rc.'+I'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray7);
$i++;
$rc++;
			}}

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, '');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'TOTAL :');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, '=SUM(D25:D37)');
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, '=SUM(E25:E37)');
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, '=SUM(F25:F37)');
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, '=SUM(G25:G37)');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, '=SUM(H25:H37)');
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, '=SUM(I25:I37)');
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, '=SUM(J25:J37)');
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray10);



$rc++;
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'REKAPITULASI BERDASARKAN JENIS JABATAN');
$rc++;

$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'JENIS JABATAN');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PNS (l)');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PNS (p)');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PNS');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'CPNS (l)');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'CPNS (p)');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'CPNS');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'TOTAL');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);

$this->myexcel->getActiveSheet()->getRowDimension(41)->setRowHeight(30);
$this->myexcel->getActiveSheet()->getStyle('B41:J41')->applyFromArray($styleArray);

$rc++;


		$jabatan = $this->dropdowns->jenis_jabatan();
		$data['jabatan'] = array();
$i = 1;
			foreach($jabatan as $key=>$val){	if($key!=""){
					$pns_l = $this->m_dashboard->hitung_pegawai_jabatan_unor($unor->kode_unor,'pns',$key,'l');
					$pns_p = $this->m_dashboard->hitung_pegawai_jabatan_unor($unor->kode_unor,'pns',$key,'p');
					$cpns_l = $this->m_dashboard->hitung_pegawai_jabatan_unor($unor->kode_unor,'cpns',$key,'l');
					$cpns_p = $this->m_dashboard->hitung_pegawai_jabatan_unor($unor->kode_unor,'cpns',$key,'p');
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $pns_l);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $pns_p);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc,'=D'.$rc.'+E'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $cpns_l);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $cpns_p);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc,'=G'.$rc.'+H'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc,'=F'.$rc.'+I'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray7);
$i++;
$rc++;
			}}

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, '');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'TOTAL :');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, '=SUM(D42:D45)');
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, '=SUM(E42:E45)');
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, '=SUM(F42:F45)');
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, '=SUM(G42:G45)');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, '=SUM(H42:H45)');
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, '=SUM(I42:I45)');
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray9);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, '=SUM(J42:J45)');
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray10);

///////////////////////////////////////////////////////////////////////////
$filename='rekap_unor.xls'; //save our workbook as this file name
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