<?php
class Impor extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$sess = $this->session->userdata('logged_in');
		$this->nama_grup = $sess['group_name'];
		$this->load->model('csapk/m_impor');
	}
/////////////////////////////////////////////////////////////////////////////////	
	public function index(){ 
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['exec'] = ($this->nama_grup=="admin")?"ya":"tidak";

		$this->load->view('impor/index',$data);
	}

	public function getdata(){ 
		$cari = $_POST['cari'];
		$data['count'] = $this->m_impor->hitung_sama($_POST['jenis'],$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_impor->get_sama($_POST['jenis'],$cari,$mulai,$batas);

				foreach($data['hslquery'] AS $key=>$val){

					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);


		}
		echo json_encode($data);
	}






	public function sapk_ada(){ 
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('impor/sapk_ada',$data);
	}

	public function getsapk(){ 
		$cari = $_POST['cari'];
		$data['count'] = $this->m_impor->hitung_sapk($_POST['jenis'],$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_impor->get_sapk($_POST['jenis'],$cari,$mulai,$batas);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->stt = ($val->status_kepegawaian==NULL)?"kosong":"Ada";
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);


		}
		echo json_encode($data);
	}





	public function sikda_ada(){ 
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('impor/sikda_ada',$data);
	}

	public function getsikda(){ 
		$cari = $_POST['cari'];
		$data['count'] = $this->m_impor->hitung_sikda($_POST['jenis'],$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_impor->get_sikda($_POST['jenis'],$cari,$mulai,$batas);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);


		}
		echo json_encode($data);
	}

	public function golongan(){ 
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('impor/golongan',$data);
	}

	public function getgolongan(){ 
		$cari = $_POST['cari'];
		$data['count'] = $this->m_impor->hitung_golongan($_POST['jenis'],$cari);
		$this->session->set_userdata('pilgol',$_POST['jenis']);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_impor->get_golongan($_POST['jenis'],$cari,$mulai,$batas);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pangkat_aktual = date("d-m-Y", strtotime($val->tmt_pangkat_aktual));
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);


		}
		echo json_encode($data);
	}


	public function jenis(){ 
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:"end";
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";

		$this->load->view('impor/jenis',$data);
	}

	public function getjenis(){ 
		$cari = $_POST['cari'];
		$data['count'] = $this->m_impor->hitung_jenis($_POST['jenis'],$cari);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {

			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_impor->get_jenis($_POST['jenis'],$cari,$mulai,$batas);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime($val->tmt_pns));
					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime($val->tmt_cpns));
					$data['hslquery'][$key]->tmt_jabatan_aktual = date("d-m-Y", strtotime($val->tmt_jabatan_aktual));
					$data['hslquery'][$key]->thumb = Modules::run("appbkpp/profile/pasfoto_nip",$val->nip_baru);
				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);


		}
		echo json_encode($data);
	}



	public function impor(){ 
		$this->db->query("TRUNCATE TABLE xx_r_pegawai_sapk");


		$sql = "SELECT * FROM xx_dw_20171006_sapk";
		$qry = $this->db->query($sql)->result();
		
		foreach($qry AS $key=>$val){
			$sq = "SELECT * FROM r_pegawai_aktual WHERE nip_baru='".$val->NIP_BARU."'";
			$qr = $this->db->query($sq)->row();
			$id_pegawai = (empty($qr))?0:@$qr->id_pegawai;
			
			$tg1 = explode("-",@$val->TGL_LAHIR);
			$tg_lahir = @$tg1[2]."-".@$tg1[1]."-".@$tg1[0];
			$tg1 = explode("-",@$val->TMT_JABATAN);
			$tmt_jab = @$tg1[2]."-".@$tg1[1]."-".@$tg1[0];
			$tg1 = explode("-",@$val->TMT_CPNS);
			$tmt_cpns = @$tg1[2]."-".@$tg1[1]."-".@$tg1[0];
			$tg1 = explode("-",@$val->TMT_PNS);
			$tmt_pns = @$tg1[2]."-".@$tg1[1]."-".@$tg1[0];
			$tg1 = explode("-",@$val->TMT_GOLONGAN);
			$tmt_pkt = @$tg1[2]."-".@$tg1[1]."-".@$tg1[0];
			$tg_lulus = @$val->TAHUN_LULUS."-01-01";

			$unn = $val->UNOR_NAMA." - ".$val->UNOR_INDUK_NAMA;
			$this->db->set('id_pegawai',$id_pegawai);
			$this->db->set('nip_baru',$val->NIP_BARU);
			$this->db->set('gender',$val->JENIS_KELAMIN);
			$this->db->set('nama_pegawai',$val->NAMA);
			$this->db->set('gelar_depan',$val->GELAR_DEPAN);
			$this->db->set('gelar_belakang',$val->GELAR_BLK);
			$this->db->set('tempat_lahir',$val->TEMPAT_LAHIR_NAMA);
			$this->db->set('tanggal_lahir',$tg_lahir);
			$this->db->set('kode_golongan',$val->GOL_ID);
			$this->db->set('nama_golongan',$val->GOL_NAMA);
			$this->db->set('nip',$val->GOL_AWAL_ID);
			$this->db->set('status_kepegawaian',$val->GOL_AWAL_NAMA);
			$this->db->set('mk_gol_tahun',$val->MK_TAHUN);
			$this->db->set('mk_gol_bulan',$val->MK_BULAN);
			$this->db->set('nama_unor',$val->UNOR_NAMA);
			$this->db->set('nomenklatur_jabatan',$val->JABATAN_NAMA);
			$this->db->set('nomenklatur_pada',$unn);
			$this->db->set('tmt_jabatan',$tmt_jab);
			$this->db->set('tmt_cpns',$tmt_cpns);
			$this->db->set('tmt_pns',$tmt_pns);
			$this->db->set('tmt_pangkat',$tmt_pkt);
			$this->db->set('tanggal_lulus',$tg_lulus);
			$this->db->set('status_perkawinan',$val->JENIS_KAWIN_NAMA);
			$this->db->set('jab_type',$val->JENIS_JABATAN_NAMA);
			$this->db->set('nama_jenjang',$val->TINGKAT_PENDIDIKAN_NAMA);
			$this->db->set('nama_jenjang_rumpun',$val->PENDIDIKAN_NAMA);
			$this->db->insert('xx_r_pegawai_sapk');

		}


		$sql = "SELECT * FROM r_pegawai_aktual WHERE status_kepegawaian='pns' AND nip_baru NOT IN (SELECT nip_baru FROM xx_dw_20171006_sapk)";
		$qry = $this->db->query($sql)->result();

		foreach($qry AS $key=>$val){
			$this->db->set('id_pegawai',1);
			$this->db->set('nip_baru',$val->nip_baru);
			$this->db->set('gender',$val->gender);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('gelar_depan',$val->gelar_depan);
			$this->db->set('gelar_belakang',$val->gelar_belakang);
			$this->db->set('tempat_lahir',$val->tempat_lahir);
			$this->db->set('tanggal_lahir',$val->tanggal_lahir);
			$this->db->set('nama_golongan',$val->nama_golongan);
			$this->db->set('mk_gol_tahun',@$val->mk_gol_tahun);
			$this->db->set('mk_gol_bulan',@$val->mk_gol_bulan);
			$this->db->set('nomenklatur_jabatan',$val->nomenklatur_jabatan);
			$this->db->set('nomenklatur_pada',$val->nomenklatur_pada);
			$this->db->set('tmt_jabatan',$val->tmt_jabatan);
			$this->db->set('tmt_cpns',$val->tmt_cpns);
			$this->db->set('tmt_pns',$val->tmt_pns);
			$this->db->set('tmt_pangkat',$val->tmt_pangkat);
			$this->db->set('id_jenjang_jabatan',$val->id_pegawai);
			$this->db->insert('xx_r_pegawai_sapk');

		}



		$sql = "SELECT nip_baru FROM xx_r_pegawai_sapk WHERE id_pegawai='0'";
		$qry = $this->db->query($sql)->result();

		foreach($qry AS $key=>$val){
			$sq1 = "SELECT * FROM r_pegawai_keluar WHERE nip_baru='".$val->nip_baru."'";
			$qr1 = $this->db->query($sq1)->row();
			if(!empty($qr1)){
				$tg = explode("-",$qr1->tanggal_keluar);
				$tgm = $tg[2]."-".$tg[1]."-".$tg[0];
				$mng = "KELUAR, tmt: ".$tgm;
				$this->db->where('nip_baru',$val->nip_baru);
				$this->db->set('status_kepegawaian',$mng);
				$this->db->set('id_jenjang_jabatan',$qr1->id_pegawai);
				$this->db->update('xx_r_pegawai_sapk');
			}


			$sq2 = "SELECT * FROM r_pegawai_pensiun WHERE nip_baru='".$val->nip_baru."'";
			$qr2 = $this->db->query($sq2)->row();
			if(!empty($qr2)){
				$tg = explode("-",$qr2->tanggal_pensiun);
				$tgm = $tg[2]."-".$tg[1]."-".$tg[0];
				$mng = "PENSIUN, tmt: ".$tgm;
				$this->db->where('nip_baru',$val->nip_baru);
				$this->db->set('status_kepegawaian',$mng);
				$this->db->set('id_jenjang_jabatan',$qr2->id_pegawai);
				$this->db->update('xx_r_pegawai_sapk');
			}

			$sq3 = "SELECT * FROM r_pegawai_meninggal WHERE nip_baru='".$val->nip_baru."'";
			$qr3 = $this->db->query($sq3)->row();
			if(!empty($qr3)){
				$tg = explode("-",$qr3->tanggal_meninggal);
				$tgm = $tg[2]."-".$tg[1]."-".$tg[0];
				$mng = "MENINGGAL, ".$tgm;
				$this->db->where('nip_baru',$val->nip_baru);
				$this->db->set('status_kepegawaian',$mng);
				$this->db->set('id_jenjang_jabatan',$qr3->id_pegawai);
				$this->db->update('xx_r_pegawai_sapk');
			}

			$sq4 = "SELECT * FROM r_pegawai WHERE nip_baru='".$val->nip_baru."'";
			$qr4 = $this->db->query($sq4)->row();
			if(!empty($qr4) && empty($qr1) && empty($qr2) && empty($qr3)){
				if($qr4->status=="masuk"){
					$stt = "PROSES MUTASI MASUK";
				} else {
					$stt = "ADA DI MASTER";
				}
			
			
				$this->db->where('nip_baru',$val->nip_baru);
				$this->db->set('status_kepegawaian',$stt);
				$this->db->set('id_jenjang_jabatan',$qr4->id_pegawai);
				$this->db->update('xx_r_pegawai_sapk');
			}
		}


				$this->db->where('jab_type','Jabatan Fungsional Umum');
				$this->db->set('jab_type','jfu');
				$this->db->update('xx_r_pegawai_sapk');

				$this->db->where('jab_type','Jabatan Struktural');
				$this->db->set('jab_type','js');
				$this->db->update('xx_r_pegawai_sapk');

				$this->db->where('jab_type','Jabatan Fungsional Tertentu');
				$this->db->set('jab_type','jft');
				$this->db->update('xx_r_pegawai_sapk');

		$data['title'] = "Honda";
		$this->load->view('impor/impor',$data);
	}
/////////////////////////////////////////////////////////////////////////////////	
}