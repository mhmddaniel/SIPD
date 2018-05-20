<?php
class C_01 extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
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
									<strong><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;NIP harus berupa 18 digit angka.</strong> <a href="">&laquo;&laquo;kembali</a><br />
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


		$this->load->view('c_01/index',$data);
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
/////////////////////////////////////////////////////////////////////////////////	
}