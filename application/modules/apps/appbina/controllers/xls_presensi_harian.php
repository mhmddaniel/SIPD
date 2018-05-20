<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_presensi_harian extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
  }

	function index(){
		$this->load->library('myexcel');

$styleArray2a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
		'bold' => true,
        'color' => array('rgb' => 'ffffff',),
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
		'bold' => true,
        'color' => array('rgb' => 'ffffff',),
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray2c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
		'bold' => true,
        'color' => array('rgb' => 'ffffff',),
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '999999',),
      ),
);
$styleArray3a = array(
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
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray4a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray4b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray4c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);

		$this->myexcel->setActiveSheetIndex(0);
		//name the worksheet
		$this->myexcel->getActiveSheet()->setTitle('presensi pegawai');
		//set cell A1 content with some text
		$this->myexcel->getActiveSheet()->setCellValue('B1', "Daftar Presensi Pegawai");
		//change the font size
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
		//make the font become bold
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

		$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
		$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
		$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(14);
		$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(14);
		$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(14);
		$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(14);
		$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(14);









///////////////////////////////////////////
		$rc=2;
$hari = $this->dropdowns->hari_konversi();

$id_harian = $this->session->userdata('id_harian');
$hariCetak = $this->m_harian->ini_harian($id_harian);
$hh = $hari[$hariCetak->hari_kerja];
$tanggal = $hh.", ".$hariCetak->tanggal_harian;
//////////////////////////////////////////////
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $tanggal);
$rc++;
$id_cetak = $this->session->userdata("id_cetak");
$mulai = ($_POST['hal']-1)*$id_cetak['bat_print'];
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $id_cetak['kode']);
/////////////////////////////////////////
$rc++;
$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "No.");
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "NAMA");
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "JAM MASUK");
		$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "JAM PULANG");
		$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "TERLAMBAT MASUK");
		$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "CEPAT PULANG");
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "STATUS");
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getRowDimension($rc)->setRowHeight(22);
$rc++;


$dPeg = $this->m_harian->get_wajib_hadir("",$mulai,$id_cetak['bat_print'],"all","all",$id_cetak['kode'],"","","","","","","","","all","all",$id_harian,"all","all",$id_cetak['bulan_print'],$id_cetak['tahun_print']);
$hpp = (strtotime(date('Y-m-d'))-strtotime(date($hariCetak->tg_harian))<0)?"ya":"tidak";

foreach($dPeg AS $key=>$val){
$nomer = $mulai+$key+1;
$nama = $val->nama_pegawai;
			if($hpp=="ya"){
							$jmasuk = " -";
							$jpulang = " -";
							$tmasuk = " -";
							$cpulang = " -";
							$status = " -";
			} else {

						if($val->absen_masuk!="00:00:00"){
							$jmasuk = @$val->absen_masuk;
							$jpulang = @$val->absen_pulang;
							$tmasuk = @$val->selisih_masuk;
							$cpulang = @$val->mnt_pulang;
							$status = "Hadir";
//							$sta->HADIR++;
						} else {
							$jmasuk = " -";
							$jpulang = " -";
							$tmasuk = " -";
							$cpulang = " -";
							$status = @$val->status;
							$kdd = @$val->status;
//							$sta->$kdd++;
						}
			}

		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nomer);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray3a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $jmasuk);
		$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $jpulang);
		$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $tmasuk);
		$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $cpulang);
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $status);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3c);
$rc++;
}


		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray4a);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4b);
		$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray4b);
		$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray4b);
		$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray4b);
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4b);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4c);
$rc++;
$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "Rekapitulasi:");
/*
		foreach($sta AS $key=>$val){
			$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $key);
			$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val);
$rc++;
		}
*/		
		
		$filename='presensi_harian.xls'; //save our workbook as this file name
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