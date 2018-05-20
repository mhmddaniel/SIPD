<?php
class Cetak extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('csapk/m_impor');
	}
/////////////////////////////////////////////////////////////////////////////////	
	public function sapk_ada(){ 


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('sapk_ada_dw');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'SAPK ADA (AKTIF), SIKDA TIDAK ADA (TIDAK AKTIF)');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(12);


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



	$this->myexcel->getActiveSheet()->setCellValue('A5', 'no');
	$this->myexcel->getActiveSheet()->setCellValue('B5', 'nip_baru');
	$this->myexcel->getActiveSheet()->setCellValue('C5', 'nama_pegawai');
	$this->myexcel->getActiveSheet()->setCellValue('D5', 'tempat_lahir');
	$this->myexcel->getActiveSheet()->setCellValue('E5', 'tanggal_lahir');
	$this->myexcel->getActiveSheet()->setCellValue('F5', 'tmt_cpns');
	$this->myexcel->getActiveSheet()->setCellValue('G5', 'tmt_pns');
	$this->myexcel->getActiveSheet()->setCellValue('H5', 'nama_golongan');
	$this->myexcel->getActiveSheet()->setCellValue('I5', 'tmt_pangkat');
	$this->myexcel->getActiveSheet()->setCellValue('J5', 'nomenklatur_jabatan');
	$this->myexcel->getActiveSheet()->setCellValue('K5', 'tmt_jabatan');
	$this->myexcel->getActiveSheet()->setCellValue('L5', 'nomenklatur_pada');

	$sql = "SELECT a.* FROM xx_r_pegawai_sapk a	WHERE a.id_pegawai='0'	ORDER BY a.status_kepegawaian ASC,a.nama_pegawai ASC";
	$hsl = $this->db->query($sql)->result();

$rc=6;
foreach($hsl as $key=>$val){
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('A'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->tempat_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->tanggal_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->tmt_cpns);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->tmt_pns);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $val->nama_golongan);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $val->tmt_pangkat);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $val->tmt_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $val->nomenklatur_pada);

$rc++;
}


$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('sapk_ada_proses');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'SAPK ADA (AKTIF), SIKDA TIDAK ADA (TIDAK AKTIF)');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(4);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);

$this->myexcel->getActiveSheet()->setCellValue('B5', 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C5', 'NAMA / NIP');
$this->myexcel->getActiveSheet()->setCellValue('D5', 'TP. / TG. LAHIR');
$this->myexcel->getActiveSheet()->setCellValue('E5', 'STATUS SAPK');
$this->myexcel->getActiveSheet()->setCellValue('F5', 'REKOMENDASI');


$rc=6;
foreach($hsl as $key=>$val){
$rp = $rc+1;
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rp, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->tempat_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rp, $val->tanggal_lahir);
$rc++;
$rc++;
}

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
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	
	public function sikda_ada(){ 


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('sikda_ada_dw');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'SAPK TIDAK ADA (TIDAK AKTIF), SIKDA ADA (AKTIF)');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(12);


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



	$this->myexcel->getActiveSheet()->setCellValue('A5', 'no');
	$this->myexcel->getActiveSheet()->setCellValue('B5', 'nip_baru');
	$this->myexcel->getActiveSheet()->setCellValue('C5', 'nama_pegawai');
	$this->myexcel->getActiveSheet()->setCellValue('D5', 'tempat_lahir');
	$this->myexcel->getActiveSheet()->setCellValue('E5', 'tanggal_lahir');
	$this->myexcel->getActiveSheet()->setCellValue('F5', 'tmt_cpns');
	$this->myexcel->getActiveSheet()->setCellValue('G5', 'tmt_pns');
	$this->myexcel->getActiveSheet()->setCellValue('H5', 'nama_golongan');
	$this->myexcel->getActiveSheet()->setCellValue('I5', 'tmt_pangkat');
	$this->myexcel->getActiveSheet()->setCellValue('J5', 'nomenklatur_jabatan');
	$this->myexcel->getActiveSheet()->setCellValue('K5', 'tmt_jabatan');
	$this->myexcel->getActiveSheet()->setCellValue('L5', 'nomenklatur_pada');

	$sql = "SELECT a.* FROM xx_r_pegawai_sapk a	WHERE a.id_pegawai='1'	ORDER BY a.status_kepegawaian ASC,a.nama_pegawai ASC";
	$hsl = $this->db->query($sql)->result();

$rc=6;
foreach($hsl as $key=>$val){
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('A'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->tempat_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->tanggal_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->tmt_cpns);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->tmt_pns);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $val->nama_golongan);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $val->tmt_pangkat);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $val->tmt_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $val->nomenklatur_pada);

$rc++;
}


$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('sikda_ada_proses');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'SAPK TIDAK ADA (TIDAK AKTIF), SIKDA ADA (AKTIF)');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(4);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);

$this->myexcel->getActiveSheet()->setCellValue('B5', 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C5', 'NAMA / NIP');
$this->myexcel->getActiveSheet()->setCellValue('D5', 'TP. / TG. LAHIR');
$this->myexcel->getActiveSheet()->setCellValue('E5', 'STATUS SAPK');
$this->myexcel->getActiveSheet()->setCellValue('F5', 'REKOMENDASI');


$rc=6;
foreach($hsl as $key=>$val){
$rp = $rc+1;
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rp, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->tempat_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rp, $val->tanggal_lahir);
$rc++;
$rc++;
}

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
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	
	public function golongan(){ 


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('golongan_dw');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'Data GOLONGAN :: SAPK-SIKDA | Tidak Sama');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);


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



	$this->myexcel->getActiveSheet()->setCellValue('A5', 'no');
	$this->myexcel->getActiveSheet()->setCellValue('B5', 'nip_baru');
	$this->myexcel->getActiveSheet()->setCellValue('C5', 'nama_pegawai');
	$this->myexcel->getActiveSheet()->setCellValue('D5', 'gol_sapk');
	$this->myexcel->getActiveSheet()->setCellValue('E5', 'tmt_sapk');
	$this->myexcel->getActiveSheet()->setCellValue('F5', 'gol_sikda');
	$this->myexcel->getActiveSheet()->setCellValue('G5', 'tmt_sikda');


$jenis = $this->session->userdata('pilgol');
if($jenis=="kecil"){
	$pilgol = "AND a.kode_golongan<b.kode_golongan";
} elseif($jenis=="besar") {
	$pilgol = "AND a.kode_golongan>b.kode_golongan";
} else {
	$pilgol = "AND a.kode_golongan!=b.kode_golongan";
}

	$sql = "SELECT a.*,b.kode_golongan AS kode_golongan_aktual,b.nama_golongan AS nama_golongan_aktual,b.tmt_pangkat AS tmt_pangkat_aktual,
		b.mk_gol_tahun AS mk_gol_tahun_aktual,b.mk_gol_bulan AS mk_gol_bulan_aktual
		FROM xx_r_pegawai_sapk a
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  a.id_pegawai NOT IN (0,1)
		$pilgol
		ORDER BY a.tmt_pangkat ASC";
	$hsl = $this->db->query($sql)->result();

$rc=6;
foreach($hsl as $key=>$val){
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('A'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->nama_golongan);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->tmt_pangkat);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->nama_golongan_aktual);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->tmt_pangkat_aktual);

$rc++;
}


$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('golongan_proses');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'Data GOLONGAN :: SAPK-SIKDA | Tidak Sama');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);

$this->myexcel->getActiveSheet()->setCellValue('B5', 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C5', 'NAMA / NIP');
$this->myexcel->getActiveSheet()->setCellValue('D5', 'STATUS SAPK');
$this->myexcel->getActiveSheet()->setCellValue('E5', 'STATUS SIKDA');


$rc=6;
foreach($hsl as $key=>$val){
$rp = $rc+1;
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rp, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->nama_golongan);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rp, $val->tmt_pangkat);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->nama_golongan_aktual);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rp, $val->tmt_pangkat_aktual);
$rc++;
$rc++;
}

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
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	
	public function jenis(){ 


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
$this->myexcel->getActiveSheet()->setTitle('jenis_dw');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'Data JENIS JABATAN :: SAPK-SIKDA | Tidak Sama');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);


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



	$this->myexcel->getActiveSheet()->setCellValue('A5', 'no');
	$this->myexcel->getActiveSheet()->setCellValue('B5', 'nip_baru');
	$this->myexcel->getActiveSheet()->setCellValue('C5', 'nama_pegawai');
	$this->myexcel->getActiveSheet()->setCellValue('D5', 'jenis_sapk');
	$this->myexcel->getActiveSheet()->setCellValue('E5', 'tmt_sapk');
	$this->myexcel->getActiveSheet()->setCellValue('F5', 'jenis_sikda');
	$this->myexcel->getActiveSheet()->setCellValue('G5', 'tmt_sikda');

	$sql = "SELECT a.*,b.jab_type AS jab_type_aktual,b.tmt_jabatan AS tmt_jabatan_aktual,b.nomenklatur_jabatan AS nomenklatur_jabatan_aktual
		FROM xx_r_pegawai_sapk a
		LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
		WHERE  a.id_pegawai NOT IN (0,1)
		AND a.jab_type!=b.jab_type
		AND b.jab_type!='jft-guru'
		ORDER BY a.id ASC";
	$hsl = $this->db->query($sql)->result();

$rc=6;
foreach($hsl as $key=>$val){
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('A'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->tmt_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->nomenklatur_jabatan_aktual);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->tmt_jabatan_aktual);

$rc++;
}


$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('jenis_proses');
$this->myexcel->getActiveSheet()->setCellValue('B1', 'DAFTAR PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->setCellValue('B2', 'Data JENIS JABATAN :: SAPK-SIKDA | Tidak Sama');
$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->setCellValue('B3', 'Periode: OKTOBER 2017');
$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);

$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(40);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);

$this->myexcel->getActiveSheet()->setCellValue('B5', 'No.');
$this->myexcel->getActiveSheet()->setCellValue('C5', 'NAMA / NIP');
$this->myexcel->getActiveSheet()->setCellValue('D5', 'STATUS SAPK');
$this->myexcel->getActiveSheet()->setCellValue('E5', 'STATUS SIKDA');


$rc=6;
foreach($hsl as $key=>$val){
$rp = $rc+1;
	$no = $key+1;
	$nip = " ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rp, $nip);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $val->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rp, $val->tmt_jabatan);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->nomenklatur_jabatan_aktual);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rp, $val->tmt_jabatan);
$rc++;
$rc++;
}

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
/////////////////////////////////////////////////////////////////////////////////	










}