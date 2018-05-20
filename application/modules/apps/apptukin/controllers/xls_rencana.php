<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_rencana extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_pegawai');
	}

	function index(){
		$this->load->library('myexcel');
		$this->myexcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$this->myexcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
		$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
		$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
//////////////////////////////////////////
		$id_pegawai = $this->session->userdata('pegawai_info');
		$unor = $this->session->userdata('unor');
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->dropdowns->bulan();
		$val = $this->m_tukin->ini_tpp($id_tpp);
//////////////////////////////////////////
		$this->myexcel->setActiveSheetIndex(0);
		$this->myexcel->getActiveSheet()->setTitle('rencana_bulanan');
		$this->myexcel->getActiveSheet()->setCellValue('B1', "SASARAN KERJA TAHUN ".$val->tahun);
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B1:T1');
		$this->myexcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->setCellValue('B2', "PEGAWAI NEGERI SIPIL PEMERINTAH KOTA TANGERANG");
		$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B2:T2');
		$this->myexcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->setCellValue('B3', $unor);
		$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B3:T3');
		$this->myexcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(11);

//////////////////////////////////////////
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
$nama_penilai = ((trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'').$val->penilai_nama_pegawai.((trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'');
//////////////////////////////////////////
$styleArray1 = array(
      'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray1a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray1b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray1c = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);

$styleArray2a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray2b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray2c = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray3 = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
);
$styleArray3b = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray3c = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray4 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray5 = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);

		$this->myexcel->getActiveSheet()->setCellValue('B5', "PEJABAT PENILAI");
		$this->myexcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('C5:L5')->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('B5')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B5')->getFont()->setSize(12);

		$this->myexcel->getActiveSheet()->setCellValue('K5', "PEGAWAI YANG DINILAI");
		$this->myexcel->getActiveSheet()->getStyle('K5')->applyFromArray($styleArray1b);
		$this->myexcel->getActiveSheet()->getStyle('K5')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('K5')->getFont()->setSize(12);
		$this->myexcel->getActiveSheet()->getStyle('L5:S5')->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('T5')->applyFromArray($styleArray1c);

		$this->myexcel->getActiveSheet()->getRowDimension(6)->setRowHeight(6);

		$this->myexcel->getActiveSheet()->setCellValue('B7', "Nama");
		$this->myexcel->getActiveSheet()->setCellValue('B8', "NIP");
		$this->myexcel->getActiveSheet()->setCellValue('B9', "Pangkat/Gol.");
		$this->myexcel->getActiveSheet()->setCellValue('B10', "Jabatan");
		$this->myexcel->getActiveSheet()->setCellValue('B11', "Unit kerja");
		$this->myexcel->getActiveSheet()->setCellValue('D7', $nama_penilai);
		$this->myexcel->getActiveSheet()->setCellValueExplicit('D8', $val->penilai_nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
		$this->myexcel->getActiveSheet()->setCellValue('D9', $val->penilai_nama_pangkat." - ".$val->penilai_nama_golongan);
		$this->myexcel->getActiveSheet()->setCellValue('D10', $val->penilai_nomenklatur_jabatan);
		$this->myexcel->getActiveSheet()->getStyle('D10')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('D10:J10');
		$this->myexcel->getActiveSheet()->setCellValue('D11', $val->penilai_nomenklatur_pada);
		$this->myexcel->getActiveSheet()->getStyle('D11')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('D11:J12');

		$this->myexcel->getActiveSheet()->setCellValue('K7', "Nama");
		$this->myexcel->getActiveSheet()->setCellValue('K8', "NIP");
		$this->myexcel->getActiveSheet()->setCellValue('K9', "Pangkat/Gol.");
		$this->myexcel->getActiveSheet()->setCellValue('K10', "Jabatan");
		$this->myexcel->getActiveSheet()->setCellValue('K11', "Unit kerja");
		$this->myexcel->getActiveSheet()->setCellValue('M7', $nama_pegawai);
		$this->myexcel->getActiveSheet()->setCellValueExplicit('M8', $val->nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
		$this->myexcel->getActiveSheet()->setCellValue('M9', $val->nama_pangkat." - ".$val->nama_golongan);
		$this->myexcel->getActiveSheet()->setCellValue('M10', $val->nomenklatur_jabatan);
		$this->myexcel->getActiveSheet()->getStyle('M10')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('M10:T10');
		$this->myexcel->getActiveSheet()->setCellValue('M11', $val->nomenklatur_pada);
		$this->myexcel->getActiveSheet()->getStyle('M11')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('M11:T12');

		$this->myexcel->getActiveSheet()->getStyle('B6:B12')->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->getStyle('K6:K12')->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->getStyle('T6:T12')->applyFromArray($styleArray2c);

		$this->myexcel->getActiveSheet()->setCellValue('B13', "No.");
		$this->myexcel->getActiveSheet()->mergeCells('B13:B14');
		$this->myexcel->getActiveSheet()->getStyle('B13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B13')->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('B14:B15')->applyFromArray($styleArray2a);

		$this->myexcel->getActiveSheet()->setCellValue('C13', "KEGIATAN TUGAS JABATAN");
		$this->myexcel->getActiveSheet()->mergeCells('C13:F14');
		$this->myexcel->getActiveSheet()->getStyle('C13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C13')->applyFromArray($styleArray1c);
		$this->myexcel->getActiveSheet()->getStyle('D13:S13')->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('T13')->applyFromArray($styleArray1c);

		$this->myexcel->getActiveSheet()->setCellValue('G13', "TARGET OUTPUT");
		$this->myexcel->getActiveSheet()->mergeCells('G13:G14');
		$this->myexcel->getActiveSheet()->getStyle('G13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('G13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('G13')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->setCellValue('H13', "BULAN");
		$this->myexcel->getActiveSheet()->mergeCells('H13:S13');
		$this->myexcel->getActiveSheet()->getStyle('H13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->setCellValue('H14', "JAN");
		$this->myexcel->getActiveSheet()->setCellValue('I14', "FEB");
		$this->myexcel->getActiveSheet()->getStyle('I14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('J14', "MAR");
		$this->myexcel->getActiveSheet()->getStyle('J14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('K14', "APR");
		$this->myexcel->getActiveSheet()->getStyle('K14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('L14', "MEI");
		$this->myexcel->getActiveSheet()->getStyle('L14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('M14', "JUN");
		$this->myexcel->getActiveSheet()->getStyle('M14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('N14', "JUL");
		$this->myexcel->getActiveSheet()->getStyle('N14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('O14', "AGT");
		$this->myexcel->getActiveSheet()->getStyle('O14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P14', "SEP");
		$this->myexcel->getActiveSheet()->getStyle('P14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('Q14', "OKT");
		$this->myexcel->getActiveSheet()->getStyle('Q14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('R14', "NOV");
		$this->myexcel->getActiveSheet()->getStyle('R14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('S14', "DES");
		$this->myexcel->getActiveSheet()->getStyle('S14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('H14:S14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->myexcel->getActiveSheet()->setCellValue('T13', "JUMLAH");
		$this->myexcel->getActiveSheet()->mergeCells('T13:T14');
		$this->myexcel->getActiveSheet()->getStyle('T13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('T13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('T13')->getAlignment()->setWrapText(true);

		$this->myexcel->getActiveSheet()->getStyle('C13:C14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('B14:T14')->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->getStyle('T13:T15')->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('G13:G14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('H13:H14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('T13:T14')->applyFromArray($styleArray4);
//////////////////////////////////////////
$rc=15;
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':T'.$rc)->applyFromArray($styleArray3b);

$cl[1]="H";
$cl[2]="I";
$cl[3]="J";
$cl[4]="K";
$cl[5]="L";
$cl[6]="M";
$cl[7]="N";
$cl[8]="O";
$cl[9]="P";
$cl[10]="Q";
$cl[11]="R";
$cl[12]="S";

$rc++;
$target = $this->m_tukin->get_target($id_tpp);
$g_biaya=0;
foreach($target AS $key=>$vl){
$no=$key+1;
//////////////////////////////////////////
	for($i=$val->bulan_mulai;$i<=$val->bulan_selesai;$i++){
		$ak = "ak_".$i;
		$vol = "vol_".$i;
		$biaya = "biaya_".$i;
		$this->myexcel->getActiveSheet()->setCellValue($cl[$i].$rc, $vl->$ak);
		$this->myexcel->getActiveSheet()->setCellValue($cl[$i].($rc+1), $vl->$vol);
		$this->myexcel->getActiveSheet()->setCellValue($cl[$i].($rc+2), 100);
		$this->myexcel->getActiveSheet()->setCellValue($cl[$i].($rc+3), $vl->$biaya);
		$this->myexcel->getActiveSheet()->getStyle($cl[$i].($rc+3))->getNumberFormat()->setFormatCode('_-* #,##0.00');
		$this->myexcel->getActiveSheet()->getStyle($cl[$i].($rc+3))->getFont()->setSize(6);
	}

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':B'.($rc+3));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.($rc+3))->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $vl->pekerjaan);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':F'.($rc+3));
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':F'.($rc+3))->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':C'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "AK");
	$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+1), "Kuant. (".$vl->satuan.")");
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+1))->getFont()->setSize(7);
	$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+2), "KUALITAS");
	$this->myexcel->getActiveSheet()->setCellValue('G'.($rc+3), "BIAYA (Rp.)");
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+3))->getFont()->setSize(7);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc.':G'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc.':H'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc.':I'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc.':J'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc.':K'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc.':L'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc.':M'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('N'.$rc.':N'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('O'.$rc.':O'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc.':P'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('Q'.$rc.':Q'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc.':R'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('S'.$rc.':S'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->setCellValue('T'.$rc, $vl->ak_total);
	$this->myexcel->getActiveSheet()->setCellValue('T'.($rc+1), $vl->vol_total);
	$this->myexcel->getActiveSheet()->setCellValue('T'.($rc+2), " - ");
	$this->myexcel->getActiveSheet()->setCellValue('T'.($rc+3), $vl->biaya_total);
	$this->myexcel->getActiveSheet()->getStyle('T'.($rc+3))->getNumberFormat()->setFormatCode('_-* #,##0.00');
	$this->myexcel->getActiveSheet()->getStyle('T'.($rc+3))->getFont()->setSize(6);
	$this->myexcel->getActiveSheet()->getStyle('T'.$rc.':T'.($rc+3))->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('T'.$rc.':T'.($rc+3))->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+3).':T'.($rc+3))->applyFromArray($styleArray3b);

	$this->myexcel->getActiveSheet()->getStyle('G'.$rc.':T'.$rc)->applyFromArray($styleArray3c);
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+1).':T'.($rc+1))->applyFromArray($styleArray3c);
	$this->myexcel->getActiveSheet()->getStyle('G'.($rc+2).':T'.($rc+2))->applyFromArray($styleArray3c);

$g_biaya = $g_biaya+$vl->biaya_total;
$rc=$rc+4;
//////////////////////////////////////////
}
//////////////////////////////////////////
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->getStyle('T'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':T'.$rc)->applyFromArray($styleArray5);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, "Total biaya");
	$this->myexcel->getActiveSheet()->setCellValue('T'.$rc, $g_biaya);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->getStyle('T'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':T'.$rc)->applyFromArray($styleArray5);
$rc=$rc+2;
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, "Tangerang,  Januari 2016");
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "Pejabat Penilai");
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, "Pegawai Negeri Sipil Yang Dinilai");
	$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':T'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc=$rc+5;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_penilai);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':T'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "NIP. ".$val->penilai_nip_baru);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc,  "NIP. ".$val->nip_baru);
	$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':T'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='rencana_kerja_tahunan.xls'; //save our workbook as this file name
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