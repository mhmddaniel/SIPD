<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_presensi_bulan extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('appbina/m_harian');
		$this->load->model('appbkpp/m_pegawai');
  }

	function index(){
		$this->load->library('myexcel');
$styleArray2 = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray2a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray2b = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray2c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray2d = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray2e = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE,), 
      ),
      'font' => array(
        'color' => array('rgb' => 'ffffff',),
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => '666666',),
      ),
);
$styleArray3 = array(
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
$styleArray3ba = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray3bac = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray3bb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
);
$styleArray3c = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$stArr3cb = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR) 
      )
);
$stArr3cc = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN) 
      )
);
$styleArray3d = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'eeeeee',),
      ),
);
$styleArray3dd = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'eeeeee',),
      ),
);
$styleArray3e = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_HAIR,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'cccccc',),
      ),
);
$styleArray3ee = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'cccccc',),
      ),
);
$styleArray4a = array(
      'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray4 = array(
      'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);
$styleArray4b = array(
      'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM,), 
      ),
);

$sessB = $this->session->userdata('id_cetak');
$sess = $this->session->userdata('logged_in');
if($sess['group_name']=="pengelola" || $sess['group_name']=="absensor_unit"){
	$this->load->model('appbkpp/m_umpeg');
	$user_id = $this->session->userdata('user_id');
	$user = $this->m_umpeg->ini_user($user_id);
		$dd=array("{","}");
	$unor=  str_replace($dd,"",$user->unor_akses);
	$kode = "";
	$nama_unit = $this->session->userdata('nama_unor');
} else {
	$kode = $this->session->userdata('kode');
	$sqlstr = "SELECT * FROM m_unor WHERE kode_unor LIKE '$kode%'";
	$query = $this->db->query($sqlstr)->result();
	$unor="";
	foreach($query AS $key=>$val){
		$unor = ($key==0)?$unor.$val->id_unor:$unor.",".$val->id_unor;
	}

	if($kode==""){
		$nama_unit = "";
	} else {
		$tanggal = $sessB['tahun_print']."-".$sessB['bulan_print']."-10";
		$sql = "SELECT nama_unor FROM m_unor WHERE kode_unor='$kode' AND tmt_berlaku<='$tanggal' AND tst_berlaku>='$tanggal'";
		$qry = $this->db->query($sql)->row();
		$nama_unit = $qry->nama_unor;
	}
}

		$this->myexcel->setActiveSheetIndex(0);
		$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(4);
		$this->myexcel->getActiveSheet()->getColumnDimension("B")->setWidth(6);
		$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);

		$this->myexcel->getActiveSheet()->setTitle('kehadiran_bulanan');
		$this->myexcel->getActiveSheet()->setCellValue('B1', "Daftar Kehadiran Pegawai");
		$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
$rc=2;
		if($nama_unit!=""){
			$namaUnit = strtoupper($nama_unit);
			$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $namaUnit);
			$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getFont()->setSize(14);
			$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getFont()->setBold(true);
			$rc++;
		}
$bln = $this->dropdowns->bulan3();
$bulan_ini = $sessB['bulan_print'];
$vv = "PERIODE : ".strtoupper($bln[$bulan_ini])." - ".$sessB['tahun_print'];
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $vv);
///////////////////////////////////////////
$kol[0] = "D";
$kol[1] = "E";
$kol[2] = "F";
$kol[3] = "G";
$kol[4] = "H";
$kol[5] = "I";
$kol[6] = "J";
$kol[7] = "K";
$kol[8] = "L";
$kol[9] = "M";
$kol[10] = "N";
$kol[11] = "O";
$kol[12] = "P";
$kol[13] = "Q";
$kol[14] = "R";
$kol[15] = "S";
$kol[16] = "T";
$kol[17] = "U";
$kol[18] = "V";
$kol[19] = "W";
$kol[20] = "X";
$kol[21] = "Y";
$kol[22] = "Z";
$kol[23] = "AA";
$kol[24] = "AB";
$kol[25] = "AC";
$kol[26] = "AD";
$kol[27] = "AE";
$kol[28] = "AF";
$kol[29] = "AG";
$kol[30] = "AH";
$kol[31] = "AI";
$kol[32] = "AJ";
$kol[33] = "AK";
$kol[34] = "AL";
$kol[35] = "AM";
$kol[36] = "AN";
$kol[37] = "AO";
$kol[38] = "AP";
/////////////////////////////////////////
$rc++;
$rc++;$rd=$rc+1;
		$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, "NO.");
		$this->myexcel->getActiveSheet()->mergeCells('B'.$rc.':B'.$rd);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':B'.$rd)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
		$this->myexcel->getActiveSheet()->getStyle('B'.$rd)->applyFromArray($styleArray2);
		$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, "NAMA");
		$this->myexcel->getActiveSheet()->mergeCells('C'.$rc.':C'.$rd);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc.':C'.$rd)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray2c);
		$this->myexcel->getActiveSheet()->getStyle('C'.$rd)->applyFromArray($styleArray2d);
		$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, "TANGGAL");
$rc++;

$df = $this->m_harian->get_daftar( $sessB['tahun_print'], $sessB['bulan_print']);
foreach($df AS $key=>$val){
$tanggal = $val->tanggal_harian;
$tgl = explode("-",$tanggal);
$tglc = $tgl[0];
$tgln = $kol[$key];
$tgld = $kol[($key+1)];

$tglH = $kol[($key+1)];
$tglI = $kol[($key+2)];
$tglC = $kol[($key+3)];
$tglDL = $kol[($key+4)];
$tglS = $kol[($key+5)];
$tglTK = $kol[($key+6)];
$this->myexcel->getActiveSheet()->setCellValue($tgln.$rc, $tglc);
$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray2d);
$this->myexcel->getActiveSheet()->getStyle($tgld.$rc)->applyFromArray($styleArray3c);
}
			$this->myexcel->getActiveSheet()->mergeCells('D'.($rc-1).':'.$tgln.($rc-1));
			$this->myexcel->getActiveSheet()->getStyle('D'.($rc-1).':'.$tgln.($rc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle('D'.($rc-1).':'.$tgln.($rc-1))->applyFromArray($styleArray2c);

			$this->myexcel->getActiveSheet()->setCellValue($tgld.($rc-1), "REKAP");
			$this->myexcel->getActiveSheet()->getStyle($tgld.($rc-1).':'.$tglTK.($rc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tgld.($rc-1).':'.$tglTK.($rc-1))->applyFromArray($styleArray2c);
			$this->myexcel->getActiveSheet()->getStyle($tglTK.($rc-1))->applyFromArray($styleArray2a);
			$this->myexcel->getActiveSheet()->mergeCells($tgld.($rc-1).':'.$tglTK.($rc-1));

			$this->myexcel->getActiveSheet()->setCellValue($tglH.$rc, "H");
			$this->myexcel->getActiveSheet()->setCellValue($tglI.$rc, "I");
			$this->myexcel->getActiveSheet()->setCellValue($tglC.$rc, "C");
			$this->myexcel->getActiveSheet()->setCellValue($tglDL.$rc, "DL");
			$this->myexcel->getActiveSheet()->setCellValue($tglS.$rc, "S");
			$this->myexcel->getActiveSheet()->setCellValue($tglTK.$rc, "TK");

			$this->myexcel->getActiveSheet()->getStyle($tglH.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglH.$rc)->applyFromArray($styleArray2d);

			$this->myexcel->getActiveSheet()->getStyle($tglI.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglI.$rc)->applyFromArray($styleArray2d);

			$this->myexcel->getActiveSheet()->getStyle($tglC.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglC.$rc)->applyFromArray($styleArray2d);

			$this->myexcel->getActiveSheet()->getStyle($tglDL.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglDL.$rc)->applyFromArray($styleArray2d);

			$this->myexcel->getActiveSheet()->getStyle($tglS.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglS.$rc)->applyFromArray($styleArray2d);

			$this->myexcel->getActiveSheet()->getStyle($tglTK.$rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->myexcel->getActiveSheet()->getStyle($tglTK.$rc)->applyFromArray($styleArray2e);

$rc++;


$batas = $sessB['bat_print'];
$start = ($_POST['hal']-1)*$batas;

$dWpangkat = $this->dropdowns->kode_pangkat();
$dWgolongan = $this->dropdowns->kode_golongan();
$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();
$hsl = $this->m_pegawai->get_pegawai_bulanan("",$start,$batas,"all",$unor,$kode,"","","","","","","","","","",$sessB['bulan_print'],$sessB['tahun_print'],'pns');


foreach($hsl AS $kk=>$vv){
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($start+$kk+1));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray3ba);
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+1))->applyFromArray($styleArray3ba);
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+2))->applyFromArray($styleArray3ba);
	$this->myexcel->getActiveSheet()->getStyle('B'.($rc+3))->applyFromArray($styleArray3bac);

	$nm_pegawai = ((trim($vv->gelar_depan) != '-')?trim($vv->gelar_depan).' ':'').((trim($vv->gelar_nonakademis) != '-')?trim($vv->gelar_nonakademis).' ':'').$vv->nama_pegawai.((trim($vv->gelar_belakang) != '-')?', '.trim($vv->gelar_belakang):'');
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $nm_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3b);

	$this->myexcel->getActiveSheet()->setCellValue('C'.($rc+1), " ".$vv->nip_baru);
	$this->myexcel->getActiveSheet()->getStyle('C'.($rc+1))->applyFromArray($styleArray3b);

	$this->myexcel->getActiveSheet()->setCellValue('C'.($rc+2), " ".$vv->nomenklatur_jabatan);
	$this->myexcel->getActiveSheet()->getStyle('C'.($rc+2))->applyFromArray($styleArray3b);
	$this->myexcel->getActiveSheet()->getStyle('C'.($rc+3))->applyFromArray($styleArray3bb);

						$sH = 0;
						$sI = 0;
						$sC = 0;
						$sDL = 0;
						$sS = 0;
						$sTK = 0;
						$slMasuk = 0;
						foreach($df AS $key=>$val){
								$tanggal = $val->tanggal_harian;
								$tgl = explode("-",$tanggal);
								$tglc = $tgl[0];
								$tgln = $kol[$key];

								$ff = $val->id_harian;
								$sqA = "SELECT * FROM ubina_harian_wajib a WHERE a.id_harian='".$val->id_harian."' AND a.id_pegawai='".$vv->id_pegawai."'";
								$hsA = $this->db->query($sqA)->row();
								if(@$hsA->status=="H"){
									$aMasuk = (isset($hsA->id_wajib))?@$hsA->absen_masuk:"";
									$aPulang = (isset($hsA->id_wajib))?@$hsA->absen_pulang:"";
									$sMasuk = (isset($hsA->id_wajib))?((@$hsA->selisih_masuk==0)?"-":date('H:i:s',@$hsA->selisih_masuk-(7*3600))):"";
									$sPulang = (isset($hsA->id_wajib))?((@$hsA->selisih_pulang==0)?"-":date('H:i:s',@$hsA->selisih_pulang)):"";
									$sH++;
									$slMasuk = $slMasuk+@$hsA->selisih_masuk;
								} else {
									$aMasuk = (isset($hsA->id_wajib))?@$hsA->status:"";
									$aPulang = (isset($hsA->id_wajib))?"-":"";
									$sMasuk = (isset($hsA->id_wajib))?"-":"";
									$sPulang = (isset($hsA->id_wajib))?"-":"";
									if(@$hsA->status=="I"){	$sI++;	}
									if(@$hsA->status=="C"){	$sC++;	}
									if(@$hsA->status=="DL"){	$sDL++;	}
									if(@$hsA->status=="S"){	$sS++;	}
									if(@$hsA->status=="TK"){	$sTK++;	}
								}
								$slaMasuk = ($slMasuk==0)?" - ":date('H:i:s',$slMasuk-(7*3600));

								$this->myexcel->getActiveSheet()->setCellValue($tgln.$rc, $aMasuk);
								$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray3b);

								$this->myexcel->getActiveSheet()->setCellValue($tgln.($rc+1), $sMasuk);
								$this->myexcel->getActiveSheet()->getStyle($tgln.($rc+1))->applyFromArray($styleArray3b);

								$this->myexcel->getActiveSheet()->setCellValue($tgln.($rc+2), $aPulang);
								$this->myexcel->getActiveSheet()->getStyle($tgln.($rc+2))->applyFromArray($styleArray3b);

								$this->myexcel->getActiveSheet()->setCellValue($tgln.($rc+3), $sPulang);
								$this->myexcel->getActiveSheet()->getStyle($tgln.($rc+3))->applyFromArray($styleArray3bb);

								if($val->hari_kerja=="Saturday"){
									$this->myexcel->getActiveSheet()->getStyle($tgln.$rc.":".$tgln.($rc+3))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('dddddd');
								}
								if($val->hari_kerja=="Sunday"){
									$this->myexcel->getActiveSheet()->getStyle($tgln.$rc.":".$tgln.($rc+3))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('cccccc');
								}
								


						}
				$this->myexcel->getActiveSheet()->setCellValue($tglH.$rc, $sH);
				$this->myexcel->getActiveSheet()->getStyle($tglH.$rc)->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglH.($rc+2))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglH.($rc+3))->applyFromArray($styleArray3bb);

				$this->myexcel->getActiveSheet()->setCellValue($tglH.($rc+1), $slaMasuk);
				$this->myexcel->getActiveSheet()->getStyle($tglH.($rc+1))->applyFromArray($styleArray3b);

				$this->myexcel->getActiveSheet()->setCellValue($tglI.$rc, $sI);
				$this->myexcel->getActiveSheet()->getStyle($tglI.$rc)->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglI.($rc+1))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglI.($rc+2))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglI.($rc+3))->applyFromArray($styleArray3bb);

				$this->myexcel->getActiveSheet()->setCellValue($tglC.$rc, $sC);
				$this->myexcel->getActiveSheet()->getStyle($tglC.$rc)->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglC.($rc+1))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglC.($rc+2))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglC.($rc+3))->applyFromArray($styleArray3bb);

				$this->myexcel->getActiveSheet()->setCellValue($tglDL.$rc, $sDL);
				$this->myexcel->getActiveSheet()->getStyle($tglDL.$rc)->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglDL.($rc+1))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglDL.($rc+2))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglDL.($rc+3))->applyFromArray($styleArray3bb);

				$this->myexcel->getActiveSheet()->setCellValue($tglS.$rc, $sS);
				$this->myexcel->getActiveSheet()->getStyle($tglS.$rc)->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglS.($rc+1))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglS.($rc+2))->applyFromArray($styleArray3b);
				$this->myexcel->getActiveSheet()->getStyle($tglS.($rc+3))->applyFromArray($styleArray3bb);

				$this->myexcel->getActiveSheet()->setCellValue($tglTK.$rc, $sTK);
				$this->myexcel->getActiveSheet()->getStyle($tglTK.$rc)->applyFromArray($stArr3cb);
				$this->myexcel->getActiveSheet()->getStyle("AN".($rc+1))->applyFromArray($stArr3cb);
				$this->myexcel->getActiveSheet()->getStyle("AN".($rc+2))->applyFromArray($stArr3cb);
				$this->myexcel->getActiveSheet()->getStyle("AN".($rc+3))->applyFromArray($stArr3cc);
$rc++;
$rc++;
$rc++;
$rc++;
}
		$this->myexcel->getActiveSheet()->getStyle("B".$rc)->applyFromArray($styleArray4a);
		$this->myexcel->getActiveSheet()->getStyle("C".$rc)->applyFromArray($styleArray4);
		foreach($df AS $key=>$val){
			$tgln = $kol[$key];
			$this->myexcel->getActiveSheet()->getStyle($tgln.$rc)->applyFromArray($styleArray4);
		}
		$this->myexcel->getActiveSheet()->getStyle($tglH.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle($tglI.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle($tglC.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle($tglDL.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle($tglS.$rc)->applyFromArray($styleArray4);
		$this->myexcel->getActiveSheet()->getStyle($tglTK.$rc)->applyFromArray($styleArray4b);


		$filename='daftar_hadir_bulanan.xls'; //save our workbook as this file name
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