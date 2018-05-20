<?php
class C_siak extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
	}

	public function genthl(){ 
		$this->load->view('c_siak/genthl');
	}
	public function genaksi(){ 
		$btc = $_POST['batch'];
		$batas = 100;
		$awal = ($btc-1)*$batas;
		$akhir = ($btc*$batas)-1;
		for($i=$awal;$i<=$akhir;$i++){
				$iniThl = $this->iniThl($i);
				$alamat = ($iniThl->id_peg_alamat!="")?"ada":"tidak";
				$tampil = $this->cekNik($iniThl->nip_baru,$alamat,$iniThl->id_pegawai);
		}

		echo "sukses";
	}


	public function index(){ 
					$data['formulir'] = "ya";
					$data['tampil'] = "";

					if(isset($_POST['submit'])){
						$url_check='http://103.4.167.188:8181/apimuflih/index.php/api/siak/wni/nik/';
						if($this->checkWeb($url_check)){
							//====================
							$username='admin';
							$password='1234567';
							//====================
							$nik=$_POST['InputNIK'];


							if(strlen($nik) < 16 || strlen($nik) > 16 || !is_numeric($nik)){
								$data['tampil'] = '
								<div class="well well-sm">
									<strong><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;NIK harus berupa 16 digit angka.</strong> <a href="">&laquo;&laquo;kembali</a><br />
								</div>';
								$data['formulir'] = "tidak";
							} else {
											$json_url = 'http://103.4.167.188:8181/apimuflih/index.php/api/siak/wni/nik/'.$nik;
											$ch = curl_init( $json_url );
											$options = array(
													CURLOPT_RETURNTRANSFER => true,
													CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
													//CURLOPT_POSTFIELDS => $json_string
											);
											curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
											curl_setopt_array( $ch, $options ); //Setting curl options
											$result =  curl_exec($ch); //Getting jSON result string
											$decode = json_decode($result, true);

											if(!empty($decode[0]['NIK'])){
//print_r($decode);
/*
Array ( [0] => Array ( 
[NIK] => 3671104506930001 
[NAMA_LGKP] => HANDARI TRI ASTUTI 
[JENIS_KLMIN] => Perempuan 
[AGAMA] => Islam 
[TMPT_LHR] => TANGERANG 
[TGL_LHR] => 05-06-1993 
[GOL_DARAH] => A 
[STAT_KWN] => Kawin 
[STAT_HBKEL] => Istri 
[PDDK_AKH] => Akademi/Diploma III/S. Muda 
[JENIS_PKRJN] => Karyawan Swasta 
[NIK_IBU] => 0 
[NAMA_LGKP_IBU] => URIYAH 
[NIK_AYAH] => 0 
[NAMA_LGKP_AYAH] => M NUR 
[NO_KK] => 3671101409160011 
[ALAMAT] => KARANG SARI 
[NO_RT] => 6 
[NO_RW] => 5 
[NO_KEL] => 1002 
[NAMA_KEL] => KARANG SARI 
[NO_KEC] => 10 
[NAMA_KEC] => NEGLASARI 
[NO_KAB] => 71 
[NAMA_KAB] => KOTA TANGERANG 
[NO_PROP] => 36 
[NAMA_PROP] => BANTEN 
[KODE_POS] => 15121 
[RNUM] => 1 ) ) 
*/
														$ddt = "";
														foreach($decode AS $key=>$val){
															$ddt = $ddt."NAMA LENGKAP: ".$val['NAMA_LGKP'];
														}
														$data['tampil'] = $ddt.'<br><br>
														<div class="well well-sm">
															<strong><span class="glyphicon glyphicon-ok"></span>&nbsp;NIK&nbsp;&nbsp;&nbsp;:&nbsp;'.$decode[0]['NIK'].'</strong><br />
															<strong><span class="glyphicon glyphicon-ok"></span>&nbsp;NAMA LENGKAP&nbsp;&nbsp;&nbsp;:&nbsp;'.$decode[0]['NAMA_LGKP'].'</strong><br />
															<strong><span class="glyphicon glyphicon-zoom-in"></span>&nbsp;Data tersebut terdaftar di Database Disdukcapil Kota Tangerang.</strong>
														</div>';
														$data['formulir'] = "ya";
											} else {
														$data['tampil'] = '
														<div class="well well-sm">
															<strong><span class="glyphicon glyphicon-remove"></span>&nbsp;NIK&nbsp;&nbsp;&nbsp;:&nbsp;'.$nik.'</strong><br />
															<strong><span class="glyphicon glyphicon-zoom-out"></span>&nbsp;Data tersebut tidak terdaftar di Database Disdukcapil Kota Tangerang.</strong>
														</div>';
														$data['formulir'] = "ya";
											}
							}
						} else {
							$data['tampil'] = '
							<div class="well well-sm">
								<strong><span class="glyphicon glyphicon-remove"></span>Mohon maaf, server SIAK sedang OFFLINE.</strong>
							</div>';
							$data['formulir'] = "tidak";
						}//   !checkWEB
					} // if ISSET => Submit


		$this->load->view('c_siak/index',$data);
	}

	private function cekNik($nik,$alamat,$id_pegawai){ 
						$url_check='http://103.4.167.188:8181/apimuflih/index.php/api/siak/wni/nik/';
						if($this->checkWeb($url_check)){
							//====================
							$username='admin';
							$password='1234567';
							//====================


							if(strlen($nik) < 16 || strlen($nik) > 16 || !is_numeric($nik)){
								$tampil = 'NIK Salah';
							} else {
											$json_url = 'http://103.4.167.188:8181/apimuflih/index.php/api/siak/wni/nik/'.$nik;
											$ch = curl_init( $json_url );
											$options = array(
													CURLOPT_RETURNTRANSFER => true,
													CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
													//CURLOPT_POSTFIELDS => $json_string
											);
											curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
											curl_setopt_array( $ch, $options ); //Setting curl options
											$result =  curl_exec($ch); //Getting jSON result string
											$decode = json_decode($result, true);

											if(!empty($decode[0]['NIK'])){



														$kdpos = ($decode[0]['KODE_POS']=="")?"10000":$decode[0]['KODE_POS'];
														$tg = explode("-",$decode[0]['TGL_LHR']);
														$tgl = $tg[2]."-".$tg[1]."-".$tg[0];
														$this->db->set('tempat_lahir',$decode[0]['TMPT_LHR']);
														$this->db->set('tanggal_lahir',$tgl);
														$this->db->set('agama',$decode[0]['AGAMA']);
														$this->db->set('rhesus',$decode[0]['NO_KK']);
														$this->db->where('id_pegawai',$id_pegawai);
														$this->db->update('r_pegawai');

														$this->db->set('jalan',$decode[0]['ALAMAT']);
														$this->db->set('rt',$decode[0]['NO_RT']);
														$this->db->set('rw',$decode[0]['NO_RW']);
														$this->db->set('kel_desa',$decode[0]['NAMA_KEL']);
														$this->db->set('kecamatan',$decode[0]['NAMA_KEC']);
														$this->db->set('kab_kota',$decode[0]['NAMA_KAB']);
														$this->db->set('propinsi',$decode[0]['NAMA_PROP']);
														$this->db->set('kode_pos',$kdpos);
														$this->db->set('status',"SIAK");
														if($alamat=="ada"){
														$this->db->where('id_pegawai',$id_pegawai);
														$this->db->update('r_peg_alamat');
														} else {
														$this->db->set('id_pegawai',$id_pegawai);
														$this->db->insert('r_peg_alamat');
														}
														$tampil = "warga kota";


											} else {
														$tampil = 'Tidak ada di SIAK';
											}
							}
						} else {
							$tampil = 'Server Offline';
						}//   !checkWEB

		return $tampil;
	}


	private function checkWeb($domain){
		if(!filter_var($domain, FILTER_VALIDATE_URL))
		{
			return false;
		}
		$curlInit = curl_init($domain);
		curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
		curl_setopt($curlInit,CURLOPT_HEADER,true);
		curl_setopt($curlInit,CURLOPT_NOBODY,true);
		curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curlInit,CURLOPT_DNS_CACHE_TIMEOUT,300);
	
		$response = curl_exec($curlInit);
		curl_close($curlInit);
		if ($response) return true;
		return false;
	}
	private function iniThl($urutan){
		$sql = "SELECT a.*,b.id_peg_alamat FROM r_pegawai a LEFT JOIN r_peg_alamat b ON (a.id_pegawai=b.id_pegawai) WHERE a.status_kepegawaian='thl' ORDER BY a.id_pegawai LIMIT $urutan,1";
		$hsl = $this->db->query($sql)->row();
		return $hsl;
	}
	public function daftar_thl(){
		$tgl = date('Y-m-d');
		$data['unor'] = $this->m_unor->gettree(0,5,$tgl); 
		$this->load->view('c_siak/daftar_thl',$data);
	}

	public function get_thl(){
		$cari = $_POST['cari'];
		$kode = $_POST['kode'];
		$data['count'] = $this->hitungThl($cari,$kode);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->getThl($cari,$kode,$mulai,$batas);
			$tanggal = date('Y-m-d');
			foreach($data['hslquery'] AS $key=>$val){
				$kd = @$val->kode_unor;
				$kunor = substr($kd,0,5);
				$iniUnor = $this->iniUnorbykode($tanggal,$kunor);
				@$data['hslquery'][$key]->nama_unor = $iniUnor->nama_unor;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	private function iniUnorbykode($tanggal,$kode){
		$sql = "SELECT a.* FROM m_unor a WHERE  a.kode_unor='$kode' AND a.tmt_berlaku<='$tanggal' AND a.tst_berlaku>='$tanggal'";
		$hsl = $this->db->query($sql)->row();
		return $hsl;
	}

	private function hitungThl($cari,$kode){
		$iUnor = ($kode=="")?"":"AND a.kode_unor LIKE '$kode%'";
		$sql = "SELECT COUNT(a.id_pegawai) AS jml FROM r_pegawai_aktual a LEFT JOIN r_peg_alamat b ON (a.id_pegawai=b.id_pegawai)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		$iUnor
		AND a.status_kepegawaian='thl' AND b.status='SIAK'";
		$hsl = $this->db->query($sql)->row();
		return $hsl->jml;
	}
	private function getThl($cari,$kode,$mulai,$batas){
		$iUnor = ($kode=="")?"":"AND a.kode_unor LIKE '$kode%'";
		$sql = "SELECT c.gender,a.nama_pegawai,a.kode_unor,a.nomenklatur_pada,
		c.nip_baru,c.tempat_lahir,c.tanggal_lahir,c.agama,c.rhesus,b.jalan,b.rt,b.rw,b.kel_desa,b.kecamatan,b.kab_kota,b.propinsi,b.kode_pos 
		FROM r_pegawai_aktual a 
		LEFT JOIN r_peg_alamat b ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN r_pegawai c ON (a.id_pegawai=c.id_pegawai)
		WHERE  (
		a.nama_pegawai LIKE '%$cari%'
		OR a.nip_baru LIKE '$cari%'
		)
		$iUnor
		AND a.status_kepegawaian='thl' AND b.status='SIAK' ORDER BY a.id_pegawai LIMIT $mulai,$batas";
		$hsl = $this->db->query($sql)->result();
		return $hsl;
	}
	
	public function cetak(){
		$tanggal = date('Y-m-d');
		$data['kode'] = $_POST['kode'];

		if($data['kode']==""){
			$data['unor'] = "Semua Unit Kerja";
		} else {
			$unor = $this->iniUnorbykode($tanggal,$data['kode']);
			$data['unor'] = $unor->nama_unor;
		}

		$data['batas'] = 500;
		$data['jml'] = $this->hitungThl("",$data['kode']);
		$data['count'] = ceil($data['jml']/$data['batas']);
		$this->load->view('c_siak/cetak',$data);
	}
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	
	public function xls_thl(){
		$kode = $_POST['kode'];
		$awal = $_POST['awal'];
		$batas = $_POST['batas'];
		$tanggal = date('Y-m-d');
		$dafThl = $this->getThl("",$kode,$awal,$batas);
		if($kode==""){
			$unor = "Semua";
		} else {
			$unr = $this->iniUnorbykode($tanggal,$kode);
			$unor = $unr->nama_unor;
		}

$this->load->library('myexcel');
$this->myexcel->setActiveSheetIndex(0);
//name the worksheet
$this->myexcel->getActiveSheet()->setTitle('daftar');
//set cell A1 content with some text
$this->myexcel->getActiveSheet()->setCellValue('B1', "THL Kota Tangerang");
//change the font size
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
//make the font become bold
$this->myexcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);


$styleArray = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'font' => array(
        'name' => 'Arial',
        'size' => '10',
		'bold' => true,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'CCCCCC',),
      ),
);
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



$this->myexcel->getActiveSheet()->getColumnDimension("A")->setWidth(5);
$this->myexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
$this->myexcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("F")->setWidth(8);
$this->myexcel->getActiveSheet()->getColumnDimension("G")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("H")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("I")->setWidth(10);
$this->myexcel->getActiveSheet()->getColumnDimension("J")->setWidth(30);
$this->myexcel->getActiveSheet()->getColumnDimension("K")->setWidth(8);
$this->myexcel->getActiveSheet()->getColumnDimension("L")->setWidth(8);
$this->myexcel->getActiveSheet()->getColumnDimension("M")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("N")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("O")->setWidth(20);
$this->myexcel->getActiveSheet()->getColumnDimension("Q")->setWidth(30);
$this->myexcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

$rc=2;
$periode="UNIT KERJA: ".strtoupper($unor);
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, $periode);
$rc++;
$rc++;
$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, 'No.');
$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray2);
$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, 'NAMA THL');
$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, 'NIK');
$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, 'NO. KK');
$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, 'GENDER');
$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, 'TEMPAT LAHIR');
$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, 'TANGGAL LAHIR');
$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, 'AGAMA');
$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, 'ALAMAT');
$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, 'RT');
$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, 'RW');
$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, 'KEL.');
$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, 'KEC.');
$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, 'KOTA');
$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, 'KODE POS');
$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray3);
$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, 'UNIT KERJA');
$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray4);

$this->myexcel->getActiveSheet()->getStyle('B4:Q4')->applyFromArray($styleArray);


$rc++;
foreach($dafThl AS $key=>$val){
				$kd = @$val->kode_unor;
				$kunor = substr($kd,0,5);
				$iniUnor = $this->iniUnorbykode($tanggal,$kunor);
				$nunor = @$iniUnor->nama_unor;
	$this->myexcel->getActiveSheet()->setCellValue('B'.$rc, ($awal+1+$key));
	$this->myexcel->getActiveSheet()->getStyle('B'.$rc)->applyFromArray($styleArray5);
	$this->myexcel->getActiveSheet()->setCellValue('C'.$rc, $val->nama_pegawai);
	$this->myexcel->getActiveSheet()->getStyle('C'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('D'.$rc, " ".$val->nip_baru);
	$this->myexcel->getActiveSheet()->getStyle('D'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('E'.$rc, " ".$val->rhesus);
	$this->myexcel->getActiveSheet()->getStyle('E'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('F'.$rc, $val->gender);
	$this->myexcel->getActiveSheet()->getStyle('F'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('G'.$rc, $val->tempat_lahir);
	$this->myexcel->getActiveSheet()->getStyle('G'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('H'.$rc, $val->tanggal_lahir);
	$this->myexcel->getActiveSheet()->getStyle('H'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('I'.$rc, $val->agama);
	$this->myexcel->getActiveSheet()->getStyle('I'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('J'.$rc, $val->jalan);
	$this->myexcel->getActiveSheet()->getStyle('J'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('K'.$rc, $val->rt);
	$this->myexcel->getActiveSheet()->getStyle('K'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('L'.$rc, $val->rw);
	$this->myexcel->getActiveSheet()->getStyle('L'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('M'.$rc, $val->kel_desa);
	$this->myexcel->getActiveSheet()->getStyle('M'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('N'.$rc, $val->kecamatan);
	$this->myexcel->getActiveSheet()->getStyle('N'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('O'.$rc, $val->kab_kota);
	$this->myexcel->getActiveSheet()->getStyle('O'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('P'.$rc, $val->kode_pos);
	$this->myexcel->getActiveSheet()->getStyle('P'.$rc)->applyFromArray($styleArray6);
	$this->myexcel->getActiveSheet()->setCellValue('Q'.$rc, $nunor);
	$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray7);
$rc++;
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
$this->myexcel->getActiveSheet()->getStyle('B'.$rc.':P'.$rc)->applyFromArray($styleArray9);
$this->myexcel->getActiveSheet()->getStyle('Q'.$rc)->applyFromArray($styleArray10);


///////////////////////////////////////////////////////////////////////////
$filename='daftar_thl.xls'; //save our workbook as this file name
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