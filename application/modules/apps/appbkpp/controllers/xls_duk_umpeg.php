<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_duk_umpeg extends MX_Controller {

  function __construct(){
    parent::__construct();
    $this->auth->restrict();
    $this->load->model('appbkpp/m_unor');
    $this->load->model('appbkpp/m_pegawai');
    date_default_timezone_set('Asia/Jakarta');
  }

///////////////////////////////////////////////////////////////////////////////////
function jfu($jika){
$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Daftar Urut Kepangkatan');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("L")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("M")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("N")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("O")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("Q")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("R")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("S")->setWidth(8);

$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);
$this->myexcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);

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
$styleArray5 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray6 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);


$rc=2;
$sebut['jfu']="Jabatan Struktural";
$sebut['jft']="Jabatan Fungsional Tertentu";
$sebut['jft-guru']="Guru";

$periode="PERIODE :";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $sebut[$jika]);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->mergeCells('B'.($rc).':B'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('B'.($rc).':B'.($rc+1))->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->mergeCells('C'.($rc).':C'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('C'.($rc).':C'.($rc+1))->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->mergeCells('D'.($rc).':D'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('D'.($rc).':D'.($rc+1))->applyFromArray($styleArray3);

$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'PANGKAT');
$this->myexcel->getActiveSheet()->mergeCells('E'.($rc).':F'.($rc));
$this->myexcel->getActiveSheet()->getStyle('E'.($rc).':F'.($rc))->applyFromArray($styleArray6);

$this->myexcel->getActiveSheet()->setCellValue('E'.($rc+1), 'GOL');
$this->myexcel->getActiveSheet()->getStyle('E'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('F'.($rc+1), 'TMT');
$this->myexcel->getActiveSheet()->getStyle('F'.($rc+1))->applyFromArray($styleArray5);


$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->mergeCells('G'.($rc).':H'.($rc));
$this->myexcel->getActiveSheet()->getStyle('G'.($rc).':H'.($rc))->applyFromArray($styleArray6);

$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+1), 'NAMA');
$this->myexcel->getActiveSheet()->getStyle('G'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('H'.($rc+1), 'TMT');
$this->myexcel->getActiveSheet()->getStyle('H'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'M.K.');
$this->myexcel->getActiveSheet()->mergeCells('I'.($rc).':J'.($rc));
$this->myexcel->getActiveSheet()->getStyle('I'.($rc).':J'.($rc))->applyFromArray($styleArray6);

$this->myexcel->getActiveSheet()->setCellValue('I'.($rc+1), 'THN');
$this->myexcel->getActiveSheet()->getStyle('I'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('J'.($rc+1), 'BLN');
$this->myexcel->getActiveSheet()->getStyle('J'.($rc+1))->applyFromArray($styleArray5);


$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'LATIHAN JABATAN');
$this->myexcel->getActiveSheet()->mergeCells('K'.($rc).':M'.($rc));
$this->myexcel->getActiveSheet()->getStyle('K'.($rc).':M'.($rc))->applyFromArray($styleArray6);

$this->myexcel->getActiveSheet()->setCellValue('K'.($rc+1), 'NAMA');
$this->myexcel->getActiveSheet()->getStyle('K'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('L'.($rc+1), 'THN');
$this->myexcel->getActiveSheet()->getStyle('L'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('M'.($rc+1), 'JAM');
$this->myexcel->getActiveSheet()->getStyle('M'.($rc+1))->applyFromArray($styleArray5);


$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->mergeCells('N'.($rc).':P'.($rc));
$this->myexcel->getActiveSheet()->getStyle('N'.($rc).':P'.($rc))->applyFromArray($styleArray6);

$this->myexcel->getActiveSheet()->setCellValue('N'.($rc+1), 'NAMA LEMBAGA');
$this->myexcel->getActiveSheet()->getStyle('N'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('O'.($rc+1), 'THN LULUS');
$this->myexcel->getActiveSheet()->getStyle('O'.($rc+1))->applyFromArray($styleArray5);

$this->myexcel->getActiveSheet()->setCellValue('P'.($rc+1), 'TK. IJAZAH');
$this->myexcel->getActiveSheet()->getStyle('P'.($rc+1))->applyFromArray($styleArray5);


$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, 'TGL LAHIR');
$this->myexcel->getActiveSheet()->mergeCells('Q'.($rc).':Q'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('Q'.($rc).':Q'.($rc+1))->applyFromArray($styleArray3);


$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, 'MUTASI KEPEGAWAIAN');
$this->myexcel->getActiveSheet()->mergeCells('R'.($rc).':R'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('R'.($rc).':R'.($rc+1))->applyFromArray($styleArray3);


$this->myexcel->getActiveSheet()->setCellValue('S'.$rc, 'KET.');
$this->myexcel->getActiveSheet()->mergeCells('S'.($rc).':S'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('S'.($rc).':S'.($rc+1))->applyFromArray($styleArray4);


// $this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'TANGGAL LAHIR');
// $this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
// $this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PANGKAT / GOL.');
// $this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
// $this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'TMT PANGKAT');
// $this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
// $this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'JABATAN');
// $this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
// $this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'TMT JABATAN');
// $this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
// $this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'UNIT KERJA');
// $this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);

$styleArray = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'font' => array(
        'name' => 'Arial',
        'size' => '11',
    'bold' => true,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'CCCCCC',),
      ),
);
$this->myexcel->getActiveSheet()->getStyle('B4:s4')->applyFromArray($styleArray);
$this->myexcel->getActiveSheet()->getStyle('B5:S5')->applyFromArray($styleArray);
//$this->myexcel->getActiveSheet()->getStyle('B4:N4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
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
		$sess = $this->session->userdata('logged_in');
		$group_name = $sess['group_name'];
		if($group_name=="pengelola"){
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
		} else {
			$kode_unor = $this->session->userdata('kode_unor');
			$sqlstr = "SELECT * FROM m_unor WHERE kode_unor LIKE '$kode_unor%'";
			$query = $this->db->query($sqlstr)->result();
			$unor="";
			foreach($query AS $key=>$val){
				$unor = ($key==0)?$unor.$val->id_unor:$unor.",".$val->id_unor;
			}
		}

			$hsl = $this->m_pegawai->get_pegawai_duk("",0,10000,$jika,$unor);

$rc=6;$i=1;
foreach($hsl as $key=>$val){
  $this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
  $this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);

$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
  $this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
  $this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);

$nip=" ".$val->nip_baru;
  $this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $nip);
  $this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);

$pangkat = $val->nama_golongan;
  $this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $pangkat);
  $this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);

$tmt_pangkat = " ".date("d-m-Y", strtotime($val->tmt_pangkat));
  $this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $tmt_pangkat);
  $this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);

$jabatan = $val->nomenklatur_jabatan;
  $this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $jabatan);
  $this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);

$tmt_jabatan = " ".date("d-m-Y", strtotime($val->tmt_jabatan));
  $this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $tmt_jabatan);
  $this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);

  $this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $val->mk_gol_tahun);
  $this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);

  $this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->mk_gol_bulan);
  $this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray6);
  
  $this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $val->nama_diklat);
  $this->myexcel->getActiveSheet()->getStyle('k'.$rc)->applyFromArray($styleArray6);
  
$tahun_diklat = date("Y", strtotime($val->tmt_diklat));
  $this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $tahun_diklat);
  $this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray6);
  
  $this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->jam);
  $this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray6);

  $pendidikan = $val->nama_sekolah; 
   $this->myexcel->getActiveSheet()->setCellValue('N'.$rc, $pendidikan);
   $this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray6);

$tahun_lulus = date("Y", strtotime($val->tanggal_lulus));  
  $this->myexcel->getActiveSheet()->setCellValue('O'.$rc, $tahun_lulus);
  $this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray6);
  
  $this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $val->nama_jenjang);
  $this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray6);
  
 
  
$tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
  $this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, $tanggal_lahir);
  $this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray6);
  
  // $this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $val->mk_gol_bulan);
  $this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray6);
  
  // $this->myexcel->getActiveSheet()->setCellValue('S'.$rc, $val->mk_gol_bulan);
  $this->myexcel->getActiveSheet()->getStyle('S'.$rc)->applyFromArray($styleArray7);
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
//$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':N'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray8);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':I'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray10);

///////////////////////////////////////////////////////////////////////////
$filename='duk.xls'; //save our workbook as this file name
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