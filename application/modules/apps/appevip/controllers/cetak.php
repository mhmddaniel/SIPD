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
function index($kode){


$this->load->library('myexcel');


		$sq = "SELECT * FROM m_unor WHERE id_unor='".$kode."'";
		$hs = $this->db->query($sq)->row();



$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('1. Kompetensi');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', 'Indeks Profesionalitas ASN');
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
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("Q")->setAutoSize(true);
$this->myexcel->getActiveSheet()->getColumnDimension("R")->setAutoSize(true);

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
$styleArray3c = array(
      'borders' => array(
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
			$bulan = date('n');
			$tahun = date('Y');

$rc=2;
$nmUnor = strtoupper($hs->nama_unor);
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $nmUnor);
$rc=3;
$periode="PERIODE : ".$dwBulan[$bulan]." ".$tahun;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc=5;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'JABATAN');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'FUNGSI');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'NAMA PEJABAT');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'NIP');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, ' ');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'PENDIDIKAN');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3c);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'Y/N');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, ' ');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'PELATIHAN');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray3c);
$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, 'Y/N');
$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, ' ');
$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, 'PENGALAMAN');
$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray3c);
$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, 'Y/N');
$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, ' ');
$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, 'ADMINISTRASI');
$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray3c);
$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, 'Y/N');
$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('S'.$rc, 'GAP');
$this->myexcel->getActiveSheet()->getStyle('S'.$rc)->applyFromArray($styleArray4);

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
$this->myexcel->getActiveSheet()->getStyle('B5:S5')->applyFromArray($styleArray);
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

$styleArray5a = array(
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
$styleArray6a = array(
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
$styleArray6c = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
);
$styleArray7a = array(
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

			
			$awal = 1;
			$batas = $id_print['bat_print'];
			$start = ($awal-1)*$batas;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
			$dWese = $this->dropdowns->kode_ese();

		$sqlstr = "SELECT * FROM r_pegawai_aktual WHERE jab_type='js' AND kode_unor LIKE '".$hs->kode_unor."%' ORDER BY kode_ese,kode_unor LIMIT 0,100";
		$hsl=$this->db->query($sqlstr)->result();

$rc=6;$iK=$start+1;
foreach($hsl as $key=>$val){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $iK);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5a);

$jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;

	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $jabatan);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6a);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':C'.($rc+2));
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':C'.($rc+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setWrapText(true);

		$sqPendidikan = "SELECT * FROM evip_fungsi WHERE id_unor='".$val->id_unor."' LIMIT 0,3";
		$hsPendidikan = $this->db->query($sqPendidikan)->result();
		$rcR = $rc;
		for($i=0;$i<3;$i++){
			$nmS = (isset($hsPendidikan[$i]->fungsi))?$hsPendidikan[$i]->fungsi:" ";
			$this->myexcel->getActiveSheet()->setCellValue('D'.$rcR, $nmS);
			if($i<2){
				if(isset($hsPendidikan[$i]->fungsi)){
					$this->myexcel->getActiveSheet()->getStyle('D'.$rcR)->applyFromArray($styleArray6b);
				} else {
					$this->myexcel->getActiveSheet()->getStyle('D'.$rcR)->applyFromArray($styleArray6a);
				}
			} else {
				$this->myexcel->getActiveSheet()->getStyle('D'.$rcR)->applyFromArray($styleArray6b);
			}
		$rcR++;
		}

$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6a);
$nip=" ".$val->nip_baru;
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $nip);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6a);


		$sqPendidikan = "SELECT * FROM r_peg_pendidikan WHERE id_pegawai='".$val->id_pegawai."' ORDER BY kode_jenjang DESC LIMIT 0,3";
		$hsPendidikan = $this->db->query($sqPendidikan)->result();
		$rcP = $rc; $noA = 1;
		for($i=0;$i<3;$i++){
				$nmSekolah = (isset($hsPendidikan[$i]->id_peg_pendidikan))?$hsPendidikan[$i]->nama_jenjang.", ".$hsPendidikan[$i]->nama_pendidikan:" ";
				$noB = (isset($hsPendidikan[$i]->id_peg_pendidikan))?" ".$noA.".":" ";
			$this->myexcel->getActiveSheet()->setCellValue('G'.$rcP, $noB);
			$this->myexcel->getActiveSheet()->getStyle('G'.$rcP)->applyFromArray($styleArray6b);
			$this->myexcel->getActiveSheet()->setCellValue('H'.$rcP, $nmSekolah);
			$this->myexcel->getActiveSheet()->getStyle('H'.$rcP)->applyFromArray($styleArray6c);
		$noA++; $rcP++;
		}
		$sGPend = "SELECT id_ip_pendidikan_gap FROM evip_pendidikan_gap WHERE id_pegawai='".$val->id_pegawai."' AND id_unor='".$val->id_unor."'";
		$hGPend = $this->db->query($sGPend)->row();
		$nGPend = (isset($hGPend->id_ip_pendidikan_gap))?"Y":"N";
			$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $nGPend);
			$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('I'.($rc+1), " ");
			$this->myexcel->getActiveSheet()->getStyle('I'.($rc+1))->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('I'.($rc+2), " ");
			$this->myexcel->getActiveSheet()->getStyle('I'.($rc+2))->applyFromArray($styleArray6b);




		$sqPelatihan = "SELECT a.* FROM r_peg_diklat_struk a 
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE a.id_pegawai='".$val->id_pegawai."' AND a.id_diklat IN (SELECT c.id_diklat FROM md_diklat c WHERE  c.id_rumpun NOT IN (1,2,0))  LIMIT 0,3";
		$hsPelatihan = $this->db->query($sqPelatihan)->result();
		$rcP = $rc; $noA = 1;
		for($i=0;$i<3;$i++){
				$nmSekolah = (isset($hsPelatihan[$i]->nama_diklat))?$hsPelatihan[$i]->nama_diklat:" ";
				$noB = (isset($hsPelatihan[$i]->nama_diklat))?" ".$noA.".":" ";
				$this->myexcel->getActiveSheet()->setCellValue('J'.$rcP, $noB);
				$this->myexcel->getActiveSheet()->getStyle('J'.$rcP)->applyFromArray($styleArray6b);
				$this->myexcel->getActiveSheet()->setCellValue('K'.$rcP, $nmSekolah);
				$this->myexcel->getActiveSheet()->getStyle('K'.$rcP)->applyFromArray($styleArray6c);
		$noA++; $rcP++;
		}
		$sGPelat = "SELECT id_ip_pelatihan_gap FROM evip_pelatihan_gap WHERE id_pegawai='".$val->id_pegawai."' AND id_unor='".$val->id_unor."'";
		$hGPelat = $this->db->query($sGPelat)->row();
		$nGPelat = (isset($hGPelat->id_ip_pelatihan_gap))?"Y":"N";
			$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $nGPelat);
			$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('L'.($rc+1), " ");
			$this->myexcel->getActiveSheet()->getStyle('L'.($rc+1))->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('L'.($rc+2), " ");
			$this->myexcel->getActiveSheet()->getStyle('L'.($rc+2))->applyFromArray($styleArray6b);


		$sqPendidikan = "SELECT * FROM r_peg_jab WHERE id_pegawai='".$val->id_pegawai."' ORDER BY tmt_jabatan DESC LIMIT 1,3";
		$hsPendidikan = $this->db->query($sqPendidikan)->result();
		$rcP = $rc; $noA = 1;
		for($i=0;$i<3;$i++){
			$nmSekolah =(isset($hsPendidikan[$i]->nama_jabatan))?$hsPendidikan[$i]->nama_jabatan:" ";
			$noB = (isset($hsPendidikan[$i]->nama_jabatan))?" ".$noA.".":" ";
			$this->myexcel->getActiveSheet()->setCellValue('M'.$rcP, $noB);
			$this->myexcel->getActiveSheet()->getStyle('M'.$rcP)->applyFromArray($styleArray6b);
			$this->myexcel->getActiveSheet()->setCellValue('N'.$rcP, $nmSekolah);
			$this->myexcel->getActiveSheet()->getStyle('N'.$rcP)->applyFromArray($styleArray6c);
			$noA++;$rcP++;
		}
		$sGJabatan = "SELECT id_ip_jabatan_gap FROM evip_jabatan_gap WHERE id_pegawai='".$val->id_pegawai."' AND id_unor='".$val->id_unor."'";
		$hGJabatan = $this->db->query($sGJabatan)->row();
		$nGJabatan = (isset($hGJabatan->id_ip_jabatan_gap))?"Y":"N";
			$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "$nGJabatan");
			$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('O'.($rc+1), " ");
			$this->myexcel->getActiveSheet()->getStyle('O'.($rc+1))->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('O'.($rc+2), " ");
			$this->myexcel->getActiveSheet()->getStyle('O'.($rc+2))->applyFromArray($styleArray6b);



		$sqPelatihan = "SELECT a.* FROM r_peg_diklat_struk a 
		LEFT JOIN md_diklat b ON (a.id_diklat=b.id_diklat)
		WHERE id_pegawai='".$val->id_pegawai."' AND a.id_diklat IN (SELECT c.id_diklat FROM md_diklat c WHERE c.id_rumpun=2)  LIMIT 0,3";
		$hsPelatihan = $this->db->query($sqPelatihan)->result();
		$rcP = $rc; $noA = 1;
		for($i=0;$i<3;$i++){
				$nmSekolah = (isset($hsPelatihan[$i]->nama_diklat))?$hsPelatihan[$i]->nama_diklat:" ";
				$noB = (isset($hsPelatihan[$i]->nama_diklat))?" ".$noA.".":" ";
				$this->myexcel->getActiveSheet()->setCellValue('P'.$rcP, $noB);
				$this->myexcel->getActiveSheet()->getStyle('P'.$rcP)->applyFromArray($styleArray6b);
				$this->myexcel->getActiveSheet()->setCellValue('Q'.$rcP, $nmSekolah);
				$this->myexcel->getActiveSheet()->getStyle('Q'.$rcP)->applyFromArray($styleArray6c);
			$noA++;$rcP++;
		}
		$sGAdm = "SELECT id_ip_administrasi_gap FROM evip_administrasi_gap WHERE id_pegawai='".$val->id_pegawai."' AND id_unor='".$val->id_unor."'";
		$hGAdm = $this->db->query($sGAdm)->row();
		$nGAdm = (isset($hGAdm->id_ip_administrasi_gap))?"Y":"N";
			$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $nGAdm);
			$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('R'.($rc+1), " ");
			$this->myexcel->getActiveSheet()->getStyle('R'.($rc+1))->applyFromArray($styleArray6a);
			$this->myexcel->getActiveSheet()->setCellValue('R'.($rc+2), " ");
			$this->myexcel->getActiveSheet()->getStyle('R'.($rc+2))->applyFromArray($styleArray6b);


			$this->myexcel->getActiveSheet()->setCellValue('S'.$rc,'=(U'.$rc.'*.25)+(V'.$rc.'*.25)+(W'.$rc.'*.25)+(X'.$rc.'*.25)');
			$this->myexcel->getActiveSheet()->getStyle('S'.$rc)->applyFromArray($styleArray7a);
			$this->myexcel->getActiveSheet()->setCellValue('S'.($rc+1), " ");
			$this->myexcel->getActiveSheet()->getStyle('S'.($rc+1))->applyFromArray($styleArray7a);
			$this->myexcel->getActiveSheet()->setCellValue('S'.($rc+2), " ");
			$this->myexcel->getActiveSheet()->getStyle('S'.($rc+2))->applyFromArray($styleArray7b);

			$this->myexcel->getActiveSheet()->setCellValue('U'.$rc,'=if(I'.$rc.'="Y",0,1)');
			$this->myexcel->getActiveSheet()->setCellValue('V'.$rc,'=if(L'.$rc.'="Y",0,1)');
			$this->myexcel->getActiveSheet()->setCellValue('W'.$rc,'=if(O'.$rc.'="Y",0,1)');
			$this->myexcel->getActiveSheet()->setCellValue('X'.$rc,'=if(R'.$rc.'="Y",0,1)');
			$this->myexcel->getActiveSheet()->setCellValue('Z'.$rc,1);



$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6a);
//	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "");
//	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6a);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, " ");
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6a);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6a);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6b);
//	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "");
//	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, " ");
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6b);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, "");
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6b);

$iK++;$rc++;
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
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('S'.$rc)->applyFromArray($styleArray10);

			$rcM = $rc-3;
			$this->myexcel->getActiveSheet()->setCellValue('S'.$rc,'=(SUM(S6:S'.$rcM.'))/Z'.$rc);
			$this->myexcel->getActiveSheet()->setCellValue('Z'.$rc,'=SUM(Z6:Z'.$rcM.')');

///////////////////////////////////////////////////////////////////////////
$gFile = "ip_asn_".$hs->kode_unor.".xls";
$filename=$gFile; //save our workbook as this file name
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