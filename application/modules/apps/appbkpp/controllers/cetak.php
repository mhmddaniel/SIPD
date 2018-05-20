<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cetak extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_mutasi');
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index($awal){


$this->load->library('myexcel');

$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar pegawai');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Daftar Pegawai');
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
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);

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

			$id_print=$this->session->userdata('id_cetak');
			$dwBulan = $this->dropdowns->bulan();
			$bulan = $id_print['bulan_print'];
			$tahun = $id_print['tahun_print'];

$rc=2;
$periode="PERIODE : ".$dwBulan[$bulan]." ".$tahun;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=4;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA PEGAWAI');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'PANGKAT / GOL.');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'TMT PANGKAT');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'TMT JABATAN');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'SKPD');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);
$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, 'GENDER');
$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, 'TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, 'AGAMA');
$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, 'JENJANG PENDIDIKAN');
$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, 'NAMA SEKOLAH');
$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, 'NAMA PENDIDIKAN');
$this->myexcel->getActiveSheet()->setCellValue('S'.$rc, 'TANGGAL LULUS');
$this->myexcel->getActiveSheet()->setCellValue('T'.$rc, 'ESELON');
$this->myexcel->getActiveSheet()->setCellValue('U'.$rc, 'TUGAS TAMBAHAN');

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

			$cari = $id_print['cari'];
			$pns = $id_print['pns'];
			$unor = "all";
			$kode = $id_print['kode'];
			$pkt = $id_print['pkt'];
			$jbt = $id_print['jbt'];
			$ese = $id_print['ese'];
			$tugas = $id_print['tugas'];
			$gender = $id_print['gender'];
			$agama = $id_print['agama'];
			$status = $id_print['status'];
			$jenjang = $id_print['jenjang'];
			
			$batas = $id_print['bat_print'];
			$start = ($awal-1)*$batas;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$dWese = $this->dropdowns->kode_ese();

			$hsl = $this->m_pegawai->get_pegawai_bulanan($cari,$start,$batas,$pns,$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,"all","all",$bulan,$tahun,'pns');

$rc=5;$i=$start+1;
foreach($hsl as $key=>$val){
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
$pangkat = @$dWgolongan[$val->kode_golongan]." - ".@$dWpangkat[$val->kode_golongan];
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $pangkat);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
$tmt_pangkat = " ".date("d-m-Y", strtotime($val->tmt_pangkat));
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $tmt_pangkat);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
$jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $jabatan);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
$tmt_jabatan = " ".date("d-m-Y", strtotime($val->tmt_jabatan));
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $tmt_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);
if($val->kode_unor!=""){
	$kode=substr($val->kode_unor,0,5);
	$tanggal=$id_print['tahun_print']."-".$id_print['bulan_print']."-01";
	$sqlstr="SELECT a.nama_unor FROM (m_unor a) WHERE a.kode_unor='$kode' AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
	$rr = $this->db->query($sqlstr)->row(); 
	$nama=$rr->nama_unor;
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $nama);
} else {
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, "");
}
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $val->nomenklatur_pada);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray7);
if($val->tugas_tambahan!="" && $val->tugas_tambahan!="xx"){$tt=$val->tugas_tambahan;}else{$tt="";}
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $tt);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->gender);
$tanggal_lahir = date("Y/m/d", strtotime($val->tanggal_lahir));
	$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, $tanggal_lahir);
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, $val->agama);
$pend = Modules::run('appbkpp/profile/ini_pegawai_pendidikan',$val->id_pegawai);
$pendidikan = end($pend);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, @$pendidikan->nama_jenjang);
	$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, @$pendidikan->nama_sekolah);
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, @$pendidikan->nama_pendidikan);
	$this->myexcel->getActiveSheet()->setCellValue('S'.$rc, @$pendidikan->tanggal_lulus);
$nama_ese = @$dWese[$val->kode_ese];
	$this->myexcel->getActiveSheet()->setCellValue('T'.$rc, @$nama_ese);
	$this->myexcel->getActiveSheet()->setCellValue('U'.$rc, $val->tugas_tambahan);

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