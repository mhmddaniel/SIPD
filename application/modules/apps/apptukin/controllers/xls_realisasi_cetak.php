<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_realisasi_cetak extends MX_Controller {

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
		$bulan = $this->session->userdata('bulan');
		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$target = $this->m_tukin->get_target($id_tpp);
		$tpp_tahun = $this->m_tukin->get_tpp_tahun($tpp->id_pegawai,$tpp->tahun);
		$tpp_in = array();
		foreach($tpp_tahun AS $key=>$val){	array_push($tpp_in,$val->id_tpp);	}
		$ttambahan = $this->m_tukin->get_tugas_tambahan($tpp_in,$bulan);
		$kreatifitas = $this->m_tukin->get_kreatifitas($tpp_in,$bulan);
		$jab_type = $this->session->userdata('jab_type');
		$dwBulan = $this->dropdowns->bulan();
//////////////////////////////////////////
		$this->myexcel->setActiveSheetIndex(0);
		$this->myexcel->getActiveSheet()->setTitle('realisasi');
		$this->myexcel->getActiveSheet()->setCellValue('B1', "REALISASI KERJA TAHUN ".$tpp->tahun);
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B1:R1');
		$this->myexcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->setCellValue('B2', "PEGAWAI NEGERI SIPIL PEMERINTAH KOTA TANGERANG");
		$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B2:R2');
		$this->myexcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->setCellValue('B3', $unor);
		$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(14);
		$this->myexcel->getActiveSheet()->mergeCells('B3:R3');
		$this->myexcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("Q")->setWidth(15);
//////////////////////////////////////////
$gelar_nonakademis_pegawai = ((trim($tpp->gelar_nonakademis) != '-')?trim($tpp->gelar_nonakademis).' ':'');
$nama_pegawai = ((trim($tpp->gelar_depan) != '-')?trim($tpp->gelar_depan).' ':'').$gelar_nonakademis_pegawai.$tpp->nama_pegawai.((trim($tpp->gelar_belakang) != '-')?', '.trim($tpp->gelar_belakang):'');
$gelar_nonakademis_penilai = ((trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'');
$nama_penilai = ((trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'').$gelar_nonakademis_penilai.$tpp->penilai_nama_pegawai.((trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'');
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

		$this->myexcel->getActiveSheet()->setCellValue('J5', "PEGAWAI YANG DINILAI");
		$this->myexcel->getActiveSheet()->getStyle('J5')->applyFromArray($styleArray1b);
		$this->myexcel->getActiveSheet()->getStyle('J5')->getFont()->setName('Arial');
		$this->myexcel->getActiveSheet()->getStyle('J5')->getFont()->setSize(12);
		$this->myexcel->getActiveSheet()->getStyle('K5:Q5')->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('R5')->applyFromArray($styleArray1c);

		$this->myexcel->getActiveSheet()->getRowDimension(6)->setRowHeight(6);

		$this->myexcel->getActiveSheet()->setCellValue('B7', "Nama");
		$this->myexcel->getActiveSheet()->setCellValue('B8', "NIP");
		$this->myexcel->getActiveSheet()->setCellValue('B9', "Pangkat/Gol.");
		$this->myexcel->getActiveSheet()->setCellValue('B10', "Jabatan");
		$this->myexcel->getActiveSheet()->setCellValue('B11', "Unit kerja");
		$this->myexcel->getActiveSheet()->setCellValue('D7', $nama_penilai);
		$this->myexcel->getActiveSheet()->setCellValueExplicit('D8', $tpp->penilai_nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
		$this->myexcel->getActiveSheet()->setCellValue('D9', $tpp->penilai_nama_pangkat." - ".$tpp->penilai_nama_golongan);
		$this->myexcel->getActiveSheet()->setCellValue('D10', $tpp->penilai_nomenklatur_jabatan);
		$this->myexcel->getActiveSheet()->getStyle('D10')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('D10:I10');
		$this->myexcel->getActiveSheet()->setCellValue('D11', $tpp->penilai_nomenklatur_pada);
		$this->myexcel->getActiveSheet()->getStyle('D11')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('D11:I12');

		$this->myexcel->getActiveSheet()->setCellValue('J7', "Nama");
		$this->myexcel->getActiveSheet()->setCellValue('J8', "NIP");
		$this->myexcel->getActiveSheet()->setCellValue('J9', "Pangkat/Gol.");
		$this->myexcel->getActiveSheet()->setCellValue('J10', "Jabatan");
		$this->myexcel->getActiveSheet()->setCellValue('J11', "Unit kerja");
		$this->myexcel->getActiveSheet()->setCellValue('L7', $nama_pegawai);
		$this->myexcel->getActiveSheet()->setCellValueExplicit('L8', $tpp->nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
		$this->myexcel->getActiveSheet()->setCellValue('L9', $tpp->nama_pangkat." - ".$tpp->nama_golongan);
		$this->myexcel->getActiveSheet()->setCellValue('L10', $tpp->nomenklatur_jabatan);
		$this->myexcel->getActiveSheet()->getStyle('L10')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('L10:R10');
		$this->myexcel->getActiveSheet()->setCellValue('L11', $tpp->nomenklatur_pada);
		$this->myexcel->getActiveSheet()->getStyle('L11')->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->mergeCells('L11:R12');

		$this->myexcel->getActiveSheet()->getStyle('B6:B12')->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->getStyle('J6:J12')->applyFromArray($styleArray2b);
		$this->myexcel->getActiveSheet()->getStyle('R6:R12')->applyFromArray($styleArray2c);

		$this->myexcel->getActiveSheet()->setCellValue('B13', "No.");
		$this->myexcel->getActiveSheet()->mergeCells('B13:B14');
		$this->myexcel->getActiveSheet()->getStyle('B13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B13')->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('B14:B15')->applyFromArray($styleArray2a);

		$this->myexcel->getActiveSheet()->setCellValue('C13', "I. KEGIATAN TUGAS JABATAN");
		$this->myexcel->getActiveSheet()->mergeCells('C13:D14');
		$this->myexcel->getActiveSheet()->getStyle('C13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C13')->applyFromArray($styleArray1c);
		$this->myexcel->getActiveSheet()->getStyle('D13:Q13')->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('R13')->applyFromArray($styleArray1c);

		$bln = strtoupper($dwBulan[$bulan]);
		$this->myexcel->getActiveSheet()->setCellValue('E13', "TARGET s.d. ".$bln);
		$this->myexcel->getActiveSheet()->mergeCells('E13:J13');
		$this->myexcel->getActiveSheet()->getStyle('E13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('E13')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('K13', "REALISASI s.d. ".$bln);
		$this->myexcel->getActiveSheet()->mergeCells('K13:P13');
		$this->myexcel->getActiveSheet()->getStyle('K13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('K13')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('Q13', "PERHITUNGAN");
		$this->myexcel->getActiveSheet()->mergeCells('Q13:Q14');
		$this->myexcel->getActiveSheet()->getStyle('Q13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('Q13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('Q13:Q14')->applyFromArray($styleArray4);

		$this->myexcel->getActiveSheet()->setCellValue('E14', "AK");
		$this->myexcel->getActiveSheet()->getStyle('E14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('F14', "KUANTITAS");
		$this->myexcel->getActiveSheet()->mergeCells('F14:G14');
		$this->myexcel->getActiveSheet()->getStyle('F14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H14', "KUALITAS");
		$this->myexcel->getActiveSheet()->getStyle('H14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('I14', "WAKTU");
		$this->myexcel->getActiveSheet()->getStyle('I14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('J14', "BIAYA");
		$this->myexcel->getActiveSheet()->getStyle('J14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('K14', "AK");
		$this->myexcel->getActiveSheet()->getStyle('K14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('L14', "KUANTITAS");
		$this->myexcel->getActiveSheet()->mergeCells('L14:M14');
		$this->myexcel->getActiveSheet()->getStyle('L14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('N14', "KUALITAS");
		$this->myexcel->getActiveSheet()->getStyle('N14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('O14', "WAKTU");
		$this->myexcel->getActiveSheet()->getStyle('O14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P14', "BIAYA");
		$this->myexcel->getActiveSheet()->getStyle('P14')->applyFromArray($styleArray4);

		$this->myexcel->getActiveSheet()->getStyle('E14:P14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->myexcel->getActiveSheet()->setCellValue('R13', "NILAI CAPAIAN");
		$this->myexcel->getActiveSheet()->mergeCells('R13:R14');
		$this->myexcel->getActiveSheet()->getStyle('R13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R13')->getAlignment()->setWrapText(true);

		$this->myexcel->getActiveSheet()->getStyle('C13:C14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('B14:R14')->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->getStyle('R13:R15')->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('G13:G14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('H13:H14')->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('R13:R14')->applyFromArray($styleArray4);
$rc=15;
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->getStyle('B13:R14')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CCCCCC',))));
$rc++;
//////////////////////////////////////////
		$b_ak = "ak_".$bulan;$b_vol = "vol_".$bulan;$b_kualitas = "kualitas_".$bulan;$b_biaya = "biaya_".$bulan;
		$nRubah = 0;
		foreach($target AS $key=>$val){
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$rubah = $this->m_tukin->get_perubahan($val->id_target,$bulan);
			if(!empty($rubah)){	$nRubah++;	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$rel = $this->m_tukin->ini_realisasi_target($val->id_target);
			$rc_ak = 0;$rc_vol = 0;$rc_kualitas=0;$rc_biaya=0;
			$rl_ak = 0;$rl_vol = 0;$rl_kualitas=0;$rl_biaya=0;
			$mml=0;
			for($i=$tpp->bulan_mulai;$i<=$bulan;$i++){
				$c_ak = "ak_".$i;$c_vol = "vol_".$i;$c_kualitas = "kualitas_".$i;$c_biaya = "biaya_".$i;
/*
				$rc_ak = $rc_ak+$val->$c_ak;
				$rc_vol = $rc_vol+$val->$c_vol;
				$rc_kualitas = $rc_kualitas+$val->$c_kualitas;
				$rc_biaya = $rc_biaya+$val->$c_biaya;

				$rl_ak = $rl_ak+@$rel->$c_ak;
				$rl_vol = $rl_vol+@$rel->$c_vol;
				$rl_kualitas = $rl_kualitas+@$rel->$c_kualitas;
				$rl_biaya = $rl_biaya+@$rel->$c_biaya;
*/
				$rc_ak = $val->$c_ak;
				$rc_vol = $val->$c_vol;
				$rc_kualitas = $val->$c_kualitas;
				$rc_biaya = $val->$c_biaya;

				$rl_ak = @$rel->$c_ak;
				$rl_vol = @$rel->$c_vol;
				$rl_kualitas = @$rel->$c_kualitas;
				$rl_biaya = @$rel->$c_biaya;

				$mml++;
			}
			$target[$key]->$b_ak = $rc_ak;
			$target[$key]->$b_vol = $rc_vol;
			$target[$key]->$b_kualitas = 100;
			$target[$key]->$b_biaya = $rc_biaya;

			@$realisasi_target[$key]->$b_ak = $rl_ak;
			@$realisasi_target[$key]->$b_vol = $rl_vol;
//			@$realisasi_target[$key]->$b_kualitas = $rl_kualitas/$mml;
			@$realisasi_target[$key]->$b_kualitas = $rl_kualitas;
			@$realisasi_target[$key]->$b_biaya = $rl_biaya;
		}

//$nbln = (($bulan-$tpp->bulan_mulai)+1);
$nbln = 1;
$g_biaya=0;
$jhh = 0;
$nhh = 0;
foreach($target AS $key=>$val){
$no=$key+1;
$rls_ak = $realisasi_target[$key]->$b_ak;
$rls_vol = $realisasi_target[$key]->$b_vol;
$rls_kualitas = $realisasi_target[$key]->$b_kualitas;
$rls_biaya = $realisasi_target[$key]->$b_biaya;

		$hh = ($val->$b_vol>0)?1:0;
		$persen_waktu = 100-(1/1*100);
		$persen_biaya = ($val->$b_biaya!=0)?100-($rls_biaya/$val->$b_biaya*100):"0";
		$kuantitas = ($val->$b_vol!=0)?$rls_vol/$val->$b_vol*100:"-";
		$kualitas = ($val->$b_kualitas!=0)?$rls_kualitas/$val->$b_kualitas*100:"0";
		$rw_kecil = ((1.76*1-1)/1)*100;
		$rw_besar = 76-((((1.76*1-1)/1)*100)-100);
		if($val->$b_biaya==0.00){
			$rb_kecil = 0;
			$rb_besar = 0;
		} else {
			$rb_kecil = ((1.76*$val->$b_biaya-$rls_biaya)/$val->$b_biaya)*100;
			$rb_besar = ($rls_biaya==0)?0:76-((((1.76*$val->$b_biaya-$rls_biaya)/$rls_biaya)*100)-100);
		}
		if($rls_vol==0){
			$waktu=0;
			$biaya=0;
			$kuantitas=0;
			$kualitas=0;
		} else {
			$waktu = ($persen_waktu>24)?$rw_besar:$rw_kecil;
			$biaya = ($persen_biaya>24)?$rb_besar:$rb_kecil;
			$kuantitas = ($val->$b_vol!=0)?$rls_vol/$val->$b_vol*100:"-";
			$kualitas = ($val->$b_kualitas!=0)?$rls_kualitas/$val->$b_kualitas*100:"0";
		}
		if($val->$b_biaya==0){
			$smm = ($val->$b_vol==0)?0:$kuantitas+$kualitas+$waktu;
			$nmm = ($val->$b_vol==0)?0:$smm/3;
		} else {
			$smm = ($val->$b_vol==0)?0:$kuantitas+$kualitas+$waktu+$biaya;
			$nmm = ($val->$b_vol==0)?0:$smm/4;
		}
//////////////////////////////////////////
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->pekerjaan);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':D'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':D'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, $val->$b_ak);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->$b_vol);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->satuan);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 100);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $nbln." bulan");
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->$b_biaya);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $rls_ak);
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $rls_vol);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->satuan);
	$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, $rls_kualitas);
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, $nbln." bulan");
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $rls_biaya);
	$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, $smm);
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $nmm);

	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3c);

$jhh = $jhh+$nmm;
$nhh = $nhh+$hh;
$rc++;
//////////////////////////////////////////
}
//////////////////////////////////////////
$np=($nhh==0)?0:$jhh/$nhh;
$rw_np = $rc;
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':R'.($rc-1))->applyFromArray($styleArray3b);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "Nilai Realisasi Kerja:");
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $np);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray5);
$rc++;

if($nRubah>0){
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "No.");
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':B'.($rc+1));
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.($rc+2))->applyFromArray($styleArray2a);

		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "(NOMOR KEGIATAN) - ALASAN PERUBAHAN TARGET");
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':F'.($rc+1));
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray1c);
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc.':R'.$rc)->applyFromArray($styleArray1);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray1c);

		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "SEBELUM PERUBAHAN");
		$this->myexcel->getActiveSheet()->mergeCells('G'.$rc.':L'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, "SESUDAH PERUBAHAN");
		$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':R'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray4);
//		$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, "PERHITUNGAN");
//		$this->myexcel->getActiveSheet()->mergeCells('Q'.$rc.':Q'.($rc+1));
		$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('Q'.$rc.':Q'.($rc+1))->applyFromArray($styleArray4);
//		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, "NILAI CAPAIAN");
//		$this->myexcel->getActiveSheet()->mergeCells('R'.$rc.':R'.($rc+1));
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->getAlignment()->setWrapText(true);
$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, "AK");
		$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "KUANTITAS");
		$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':I'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, "KUALITAS");
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, "WAKTU");
		$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, "BIAYA");
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, "AK");
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, "KUANTITAS");
		$this->myexcel->getActiveSheet()->mergeCells('N'.$rc.':O'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, "KUALITAS");
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, "WAKTU");
		$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, "BIAYA");
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('E'.$rc.':R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->myexcel->getActiveSheet()->getStyle('C'.($rc-1).':C'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->getStyle('R'.($rc-1).':R'.($rc+1))->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('G'.($rc-1).':G'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('H'.($rc-1).':H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('R'.($rc-1).':R'.$rc)->applyFromArray($styleArray4);

		$this->myexcel->getActiveSheet()->getStyle('B'.($rc+1).':R'.($rc+1))->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':R'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CCCCCC',))));

$rc++;
$rc++;
$no = 0;
foreach($target AS $key=>$val){
			$rubah = $this->m_tukin->get_perubahan($val->id_target,$bulan);
			if(!empty($rubah)){
	$semula = json_decode($rubah->semula);
	$no++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "(".($key+1).") - ".$rubah->alasan);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':F'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':F'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $semula->$b_ak);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $semula->$b_vol);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $val->satuan);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $semula->$b_kualitas);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $nbln." bulan");
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $semula->$b_biaya);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->$b_ak);
	$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, $val->$b_vol);
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, $val->satuan);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, 100);
	$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, $nbln." bulan");
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $val->$b_biaya);
//	$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, $smm);
//	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $nmm);

	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray4);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3c);
	$rc++;
			}
}
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':R'.($rc-1))->applyFromArray($styleArray3b);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
//	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "Nilai Realisasi Kerja:");
//	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $np);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray5);
$rc++;
} // end if ada perubahan
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "No.");
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "II. TUGAS TAMBAHAN");
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':G'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "No. SURAT PERINTAH");
		$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':K'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc.':K'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, "TANGGAL SURAT PERINTAH");
		$this->myexcel->getActiveSheet()->mergeCells('L'.$rc.':O'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc.':O'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, "PEJABAT PEMBERI PERINTAH");
		$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':R'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc.':R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CCCCCC',))));
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
$rc++;
	$no=0;
	foreach($ttambahan AS $key=>$val){
		$no++;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->pekerjaan);
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':D'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $val->no_sp);
		$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':K'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc.':K'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $val->tanggal_sp);
		$this->myexcel->getActiveSheet()->mergeCells('L'.$rc.':O'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc.':O'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $val->penandatangan_sp);
		$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':R'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc.':R'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3c);
$rc++;
	}
if($no==0){
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "Tidak Ada Tugas Tambahan");
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':R'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
$rc++;
}
$ntt = $this->dropdowns->nilai_tugas_tambahan($no);
$rw_ntt = $rc;
		$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':R'.($rc-1))->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "Nilai Tugas Tambahan:");
		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $ntt);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray5);
$rc++;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "No.");
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "III. KREATIFITAS");
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':G'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, "IMPLEMENTASI");
		$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':I'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc.':I'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, "No. SURAT PERINTAH");
		$this->myexcel->getActiveSheet()->mergeCells('J'.$rc.':L'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc.':L'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, "TANGGAL SK");
		$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':O'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc.':O'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, "PENANDATANGAN SK");
		$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':Q'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc.':Q'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, "NILAI");
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CCCCCC',))));
$rc++;
		$tingkat = $this->dropdowns->tingkat_kreatifitas();
		$nilai = $this->dropdowns->nilai_kreatifitas();
		$nkr = 0;
//		$no=0;
	foreach($kreatifitas AS $key=>$val){
		$no = $key+1;
		$rt = $tingkat[$val->tingkat];
		$rn = $nilai[$val->tingkat];
		$nkr=$nkr+$rn;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $no);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->kreatifitas);
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':D'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->no_sk);
		$this->myexcel->getActiveSheet()->mergeCells('J'.$rc.':L'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc.':L'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $rt);
		$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':I'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc.':I'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->tanggal_sk);
		$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':O'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc.':O'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $val->penandatangan_sk);
		$this->myexcel->getActiveSheet()->mergeCells('P'.$rc.':Q'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc.':Q'.$rc)->getAlignment()->setWrapText(true);
		$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $rn);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray3c);
$rc++;
	}
if($no==0){
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "Tidak Ada Kegiatan Kreatifitas");
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':R'.$rc);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
$rc++;
}
$rw_nkr = $rc;
		$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':R'.($rc-1))->applyFromArray($styleArray3b);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
		$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "Nilai Kreatifitas:");
		$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, $nkr);
		$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray5);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, "NILAI SASARAN KERJA :");
	$this->myexcel->getActiveSheet()->mergeCells('O'.$rc.':Q'.$rc);
	$this->myexcel->getActiveSheet()->setCellValue('R'.$rc, '=R'.$rw_np.'+R'.$rw_ntt.'+R'.$rw_nkr);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->getStyle('R'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':R'.$rc)->applyFromArray($styleArray5);
$rw_skp = $rc;
$rc=$rc+2;
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, "Tangerang,  Januari 2016");
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "Pejabat Penilai");
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, "Pegawai Negeri Sipil Yang Dinilai");
	$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':R'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc=$rc+5;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nama_penilai);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':R'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "NIP. ".$tpp->penilai_nip_baru);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':G'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc,  "NIP. ".$tpp->nip_baru);
	$this->myexcel->getActiveSheet()->mergeCells('M'.$rc.':R'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
$this->myexcel->createSheet(NULL, 1);
$this->myexcel->setActiveSheetIndex(1);
$this->myexcel->getActiveSheet()->setTitle('PENILAIAN');
$this->myexcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
$this->myexcel->getActiveSheet()->getPageSetup()->setScale(85);
$this->myexcel->getActiveSheet()->getPageMargins()->setLeft(.4);
$this->myexcel->getActiveSheet()->getPageMargins()->setRight(.2);
$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(2);
$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(6);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(14);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(8);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(6);
$rc=1;

$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'PENILAIAN PRESTASI KERJA');
$this->myexcel->getActiveSheet()->setCellValue('B'.($rc+1), 'Pegawai Negeri Sipil Pemerintah Kota Tangerang');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.($rc+1))->getFont()->setSize(16);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.($rc+1))->getFont()->setBold(true);
$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':L'.$rc);
$this->myexcel->getActiveSheet()->mergeCells('B'.($rc+1).':L'.($rc+1));
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->myexcel->getActiveSheet()->getStyle('B'.($rc+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc++;
$rc++;
$rc++;

$periode="PERIODE : ".$dwBulan[$bulan];
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':K'.$rc)->applyFromArray($styleArray1);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'I. PEJABAT PENILAI');
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':E'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'No.');
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'II. PEGAWAI NEGERI SIPIL YANG DINILAI');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->mergeCells('G'.$rc.':L'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray1c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'DDDDDD',))));
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 1);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'Nama');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $nama_penilai);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 1);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'Nama');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3b);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 2);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NIP');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValueExplicit('D'.$rc, $tpp->penilai_nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 2);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'NIP');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValueExplicit('I'.$rc, $tpp->nip_baru,PHPExcel_Cell_DataType::TYPE_STRING);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3c);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 3);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'Pangkat / Gol.Ruang');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $tpp->penilai_nama_pangkat." - ".$tpp->penilai_nama_golongan);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 3);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'Pangkat / Gol.Ruang');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $tpp->nama_pangkat." - ".$tpp->nama_golongan);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3c);
$rc++;
	$this->myexcel->getActiveSheet()->getRowDimension($rc)->setRowHeight(30);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 4);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'Jabatan');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $tpp->penilai_nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':E'.$rc);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 4);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'Jabatan');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $tpp->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->mergeCells('I'.$rc.':L'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3c);
$rc++;
	$this->myexcel->getActiveSheet()->getRowDimension($rc)->setRowHeight(30);
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 5);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'Unit Kerja');
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, $tpp->penilai_nomenklatur_pada);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->mergeCells('D'.$rc.':E'.$rc);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 5);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'Unit Kerja');
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $tpp->nomenklatur_pada);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->getAlignment()->setWrapText(true);
	$this->myexcel->getActiveSheet()->mergeCells('I'.$rc.':L'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3c);
$rc++;
//////////////////////////////////////////
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,'UNSUR YANG DINILAI');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':K'.$rc)->applyFromArray($styleArray1);
	$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':K'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc,'JUMLAH');
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray1c);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,'I');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':K'.$rc)->applyFromArray($styleArray1);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc,'SASARAN KERJA PEGAWAI');
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, '=realisasi!R'.$rw_skp);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'x');
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, '60%');
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, '=I'.$rc.'*K'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray1c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '666666',))));
	$styleArrayF = array('font'  => array('bold'  => true,'color' => array('rgb' => 'FFFFFF')));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArrayF);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,'II');
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':K'.$rc)->applyFromArray($styleArray1);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc,'PERILAKU');
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'x');
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, '40%');
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, '=I'.$rc.'*K'.$rc);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray1c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '666666',))));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArrayF);
$rc++;
		$perilaku = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
		$i_perilaku = $this->dropdowns->perilaku();
				$j_perilaku=0; $n_perilaku=0;
				foreach($i_perilaku AS $key=>$val){
				if($key!=""){
				if($val!="Kepemimpinan"){	$tpll="ya";	} else {	if($jab_type=="js"){	$tpll="ya";	} else {$tpll="tidak";}	}
				if($tpll=="ya"){
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $key.". ".$val);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
$rc++;
					$indi = "indikator_".$key;
					$isi = $this->dropdowns->$indi();
					$no=0;
					$fgg = 0;
					foreach($isi AS $key2=>$val2){
					if($key2!=""){
						$fgg = $fgg+@$perilaku->$key2;
						$no++;
						if(isset($perilaku->$key2) && $perilaku->$key2!=0){	$j_perilaku=$j_perilaku+$perilaku->$key2;	}
						$n_perilaku++;
$np = $this->dropdowns->kategori(@$perilaku->$key2);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $no.". ".$val2);
	$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':I'.$rc);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, @$perilaku->$key2);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $np);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray3c);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
$rc++;
					} // if indikator
					} // for indikator
$npc = $this->dropdowns->kategori(($fgg/$no));
	$this->myexcel->getActiveSheet()->setCellValue('H'.($rc-$no-1), '=(SUM(J'.($rc-$no).':J'.($rc-1).'))/'.$no);
	$this->myexcel->getActiveSheet()->setCellValue('I'.($rc-$no-1), $npc);
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-$no-1).':L'.($rc-$no-1))->applyFromArray($styleArray3b);
	if($key!="A"){	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-$no-2).':L'.($rc-$no-2))->applyFromArray($styleArray3b);	}
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-$no-1).':L'.($rc-$no-1))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'DDDDDD',))));
				} // if jfu
				} // if perilaku
				} //for perilaku
$this->myexcel->getActiveSheet()->setCellValue('I13', '=(SUM(J15:J'.($rc-1).'))/'.$n_perilaku);
//////////////////////////////////////////
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc-1).':L'.($rc-1))->applyFromArray($styleArray3b);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2a);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2c);
$rc++;
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc,'NILAI TOTAL:');
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc,'=L12+L13');
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray2b);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray1a);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':K'.$rc)->applyFromArray($styleArray1);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray1c);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '666666',))));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':L'.$rc)->applyFromArray($styleArrayF);
$rc++;
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc,'Tangerang,   Januari ');
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,'Pejabat Penilai');
$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':D'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc,'Pegawai Negeri Sipil Yang Dinilai');
$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':L'.$rc);
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc++;
$rc++;
$rc++;
$rc++;
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,$nama_penilai);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getFont()->setUnderline(true);
$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':D'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc,$nama_pegawai);
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getFont()->setUnderline(true);
$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':L'.$rc);
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc,"NIP. ".$tpp->penilai_nip_baru);
$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':D'.$rc);
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc,"NIP. ".$tpp->nip_baru);
$this->myexcel->getActiveSheet()->mergeCells('H'.$rc.':L'.$rc);
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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