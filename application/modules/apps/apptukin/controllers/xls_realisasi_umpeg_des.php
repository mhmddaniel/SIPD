<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_realisasi_umpeg_des extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('apptukin/m_pantau');
		$this->load->model('apptukin/m_tukin');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index($awal){
$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Rekapitulasi Realisasi Kerja Pegawai');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$nama_unor = $this->session->userdata('nama_unor');
$nama_unor = strtoupper($nama_unor);
$this->myexcel->getActiveSheet()->setCellValue('B2', $nama_unor);
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
//make the font become bold
//$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(15);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(28);
//$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(25);
//$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(25);
//$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(25);
//$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(28);

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
			$this->load->model('appbkpp/m_umpeg');
			$user_id = $this->session->userdata('user_id');
			$user = $this->m_umpeg->ini_user($user_id);
				$dd=array("{","}");
			$unor=  str_replace($dd,"",$user->unor_akses);
			$dWbulan = $this->dropdowns->bulan3();

			$tahun=$this->session->userdata('tahun');
			$bulan=$this->session->userdata('bulan');
			$id_print=$this->session->userdata('id_cetak');
			$batas = $id_print['bat_print'];
			$start = ($awal-1)*$batas;

			$hsl = $this->m_pantau->get_pegawai_des("",$start,$batas,"all",$unor,"","","","","","","","","","","",$bulan,$tahun);


$rc=3;
$periode="PERIODE : bulan Desember, tahun 2016";
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=5;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PANGKAT - GOL. / JABATAN');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'SKP');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PERILAKU');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'T.TAMBAHAN');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'KREATIFITAS');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'NILAI PRESTASI KERJA');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray4);


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
$this->myexcel->getActiveSheet()->getStyle('B5:I5')->applyFromArray($styleArray);
//$this->myexcel->getActiveSheet()->getStyle('B4:N4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$styleArray5 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray5b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray6 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray6b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray7 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray7b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);

		$DWpangkat = $this->dropdowns->kode_pangkat();
		$DWgolongan = $this->dropdowns->kode_golongan();

$rc=6;$i=$start+1;
foreach($hsl as $key=>$val){
//	$tpp = $this->m_pantau->get_tpp_pegawai($val->id_pegawai,$val->id_unor,$tahun);
//	$realisasi = (empty($tpp))?array():$this->m_tukin->get_realisasi($tpp->id_tpp,$bulan);
//	$tpp_acc = (empty($tpp))?array():$this->m_pantau->get_realisasi_acc($tpp->id_tpp,$bulan);


	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$pangkat = @$DWgolongan[$val->kode_golongan]." - ".@$DWpangkat[$val->kode_golongan];
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $pangkat);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
//$nilai_skp = (empty($tpp_acc))?"":$tpp_acc->nilai_tugaspokok; 
$nilai_skp = (empty($val->nilai_tugaspokok) || $val->status!='acc_penilai')?"-":$val->nilai_tugaspokok; 
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $nilai_skp);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
//$nilai_perilaku = (empty($tpp_acc))?"":$tpp_acc->nilai_perilaku; 
$nilai_perilaku = (empty($val->nilai_perilaku) || $val->status!='acc_penilai')?"-":$val->nilai_perilaku;
//$nilai_tugastambahan = (empty($tpp_acc))?"":$tpp_acc->nilai_tugastambahan; 
$nilai_tugastambahan = (empty($val->nilai_tugastambahan) || $val->status!='acc_penilai')?"-":$val->nilai_tugastambahan; 
//$nilai_kreatifitas = (empty($tpp_acc))?"":$tpp_acc->nilai_kreatifitas; 
$nilai_kreatifitas = (empty($val->nilai_kreatifitas) || $val->status!='acc_penilai')?"-":$val->nilai_kreatifitas;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $nilai_perilaku);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $nilai_tugastambahan);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $nilai_kreatifitas);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, "=((E".$rc."+G".$rc."+H".$rc.")*.6)+F".$rc);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray7);
$rc++;
$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray7b);
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
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':I'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray10);

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