<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_rencana_umpeg extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('apptukin/m_pantau');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index($awal){
$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Rekapitulasi Rencana Kerja Pegawai');
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$nama_unor = $this->session->userdata('nama_unor');
$nama_unor = strtoupper($nama_unor);
$this->myexcel->getActiveSheet()->setCellValue('B2', $nama_unor);
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);

//$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
/*
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
*/
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

			$tahun=$this->session->userdata('tahun');
			$bulan = $this->dropdowns->bulan();
			$id_print=$this->session->userdata('id_cetak');
			$batas = $id_print['bat_print'];
			$start = ($awal-1)*$batas;

			$hsl = $this->m_pantau->get_pegawai("",$start,$batas,"all",$unor,"","","","","","","","","","","","01",$tahun);

$rc=3;
$periode="PERIODE : TAHUN ".$tahun;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=5;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'PEJABAT PENILAI');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'RENCANA KERJA');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray4);
/*
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PANGKAT / GOL.');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'TMT PANGKAT');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'TMT JABATAN');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'TUGAS TAMBAHAN');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);
*/

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
$this->myexcel->getActiveSheet()->getStyle('B5:E5')->applyFromArray($styleArray);
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
	$tpp = $this->m_pantau->get_tpp_pegawai($val->id_pegawai,$val->id_unor,$tahun);
	$tpp_acc = (empty($tpp))?array():$this->m_pantau->get_tpp_acc($tpp->id_tpp);

	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $i);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$nip=" ".$val->nip_baru;
$penilai_nama_pegawai = (empty($tpp))?"-":((trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'').((trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'').$tpp->penilai_nama_pegawai.((trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'');
$bln = (empty($tpp))?"":"Bulan: ".$bulan[$tpp->bulan_mulai]." s.d. ".$bulan[$tpp->bulan_selesai];
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $penilai_nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $bln);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray7);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$penilai_nip_baru = (empty($tpp))?"-":" ".$tpp->penilai_nip_baru; 
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $penilai_nip_baru);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
$keg = (empty($tpp_acc))?"":"Banyaknya kegiatan: ".$tpp_acc->kegiatan;
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $keg);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray7);
$rc++;
//$pangkat = $val->nama_golongan." - ".$val->nama_pangkat;
$pangkat = @$DWgolongan[$val->kode_golongan]." - ".@$DWpangkat[$val->kode_golongan];
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $pangkat);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
$penilai_nama_pangkat = (empty($tpp))?"-":$tpp->penilai_nama_pangkat; 
$penilai_nama_golongan = (empty($tpp))?"-":$tpp->penilai_nama_golongan; 
$biaya = (empty($tpp_acc))?"":"Total biaya: Rp. ".number_format($tpp_acc->biaya,2,","," ");
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $penilai_nama_pangkat." - ".$penilai_nama_golongan);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $biaya);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray7);
$rc++;
//$pangkat = $val->nama_golongan." - ".$val->nama_pangkat;
$pangkat = @$DWgolongan[$val->kode_golongan]." - ".@$DWpangkat[$val->kode_golongan];
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6b);
$penilai_jabatan = (empty($tpp))?"-":$tpp->penilai_nomenklatur_jabatan; 
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $penilai_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc,"");
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray7b);

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
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':D'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray10);

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