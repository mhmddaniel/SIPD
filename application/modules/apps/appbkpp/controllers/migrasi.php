<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Migrasi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appbkpp/m_dafpeg');
		$this->load->model('appdok/m_edok');
		$this->load->model('appbkpp/m_migrasi');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
function index(){
				$sqI = "DROP TABLE IF EXISTS `r_pegawai_rekap_baru`";
				$qrI = $this->db->query($sqI);

				$sqI = "CREATE TABLE `r_pegawai_rekap_baru` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(20) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nip_baru` varchar(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `gelar_nonakademis` varchar(25) DEFAULT NULL,
  `gelar_depan` varchar(25) NOT NULL,
  `gelar_belakang` varchar(25) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `status_kepegawaian` varchar(100) DEFAULT NULL,
  `tmt_cpns` date NOT NULL,
  `tmt_pns` date NOT NULL,
  `kode_golongan` int(11) NOT NULL,
  `nama_golongan` varchar(100) NOT NULL,
  `nama_pangkat` varchar(100) NOT NULL,
  `tmt_pangkat` date NOT NULL,
  `mk_gol_tahun` int(3) DEFAULT NULL,
  `mk_gol_bulan` int(3) DEFAULT NULL,
  `id_unor` int(11) NOT NULL,
  `kode_unor` varchar(100) NOT NULL,
  `nama_unor` varchar(255) NOT NULL,
  `jab_type` varchar(100) NOT NULL COMMENT 'pilihan: js (jab. struktural), jfu (jab. fung. umum),jft (jab. fung. tertentu), jft-guru(jab. fung. tertentu guru)',
  `nomenklatur_jabatan` varchar(255) NOT NULL,
  `nomenklatur_pada` varchar(255) NOT NULL,
  `tugas_tambahan` varchar(255) DEFAULT NULL,
  `tmt_jabatan` date NOT NULL,
  `kode_ese` int(4) NOT NULL,
  `nama_ese` varchar(100) DEFAULT NULL,
  `tmt_ese` date DEFAULT NULL,
  `nama_jenjang` varchar(100) DEFAULT NULL,
  `nama_jenjang_rumpun` varchar(100) DEFAULT NULL,
  `tanggal_lulus` date NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `nip_baru` (`nip_baru`),
  KEY `jab_type` (`jab_type`),
  KEY `id_unor` (`id_unor`),
  KEY `kode_ese` (`kode_ese`),
  KEY `kode_unor` (`kode_unor`),
  KEY `kode_golongan` (`kode_golongan`),
  KEY `nama_jenjang_rumpun` (`nama_jenjang_rumpun`),
  KEY `gender` (`gender`),
  KEY `status_perkawinan` (`status_perkawinan`),
  KEY `tmt_pns` (`tmt_pns`),
  KEY `nama_jenjang` (`nama_jenjang`),
  KEY `status_kepegawaian` (`status_kepegawaian`),
  KEY `nomenklatur_jabatan` (`nomenklatur_jabatan`)
) ENGINE=MyISAM AUTO_INCREMENT=43613 DEFAULT CHARSET=utf8";
				$qrI = $this->db->query($sqI);


		$sqA = "INSERT INTO r_pegawai_rekap_baru 
		(id,id_pegawai,nip,nip_baru,nama_pegawai,gelar_nonakademis,gelar_depan,gelar_belakang,tempat_lahir,tanggal_lahir,status_perkawinan,
		tmt_cpns,tmt_pns,kode_golongan,nama_golongan,nama_pangkat,tmt_pangkat,mk_gol_tahun,mk_gol_bulan,id_unor,kode_unor,nama_unor,jab_type,
		nomenklatur_jabatan,nomenklatur_pada,tugas_tambahan,tmt_jabatan,kode_ese,nama_ese,tmt_ese,nama_jenjang,nama_jenjang_rumpun,tanggal_lulus,last_updated) 
		SELECT id,id_pegawai,nip,nip_baru,nama_pegawai,gelar_nonakademis,gelar_depan,gelar_belakang,tempat_lahir,tanggal_lahir,status_perkawinan,
		tmt_cpns,tmt_pns,kode_golongan,nama_golongan,nama_pangkat,tmt_pangkat,mk_gol_tahun,mk_gol_bulan,id_unor,kode_unor,nama_unor,jab_type,
		nomenklatur_jabatan,nomenklatur_pada,tugas_tambahan,tmt_jabatan,kode_ese,nama_ese,tmt_ese,nama_jenjang,nama_jenjang_rumpun,tanggal_lulus,last_updated
		FROM r_pegawai_aktual
		";
		$qrA = $this->db->query($sqA);
/*
		$sqA = "UPDATE r_pegawai_rekap_baru SET status_kepegawaian='pns'";
		$qrA = $this->db->query($sqA);

		$sqI = "DROP TABLE `r_pegawai_aktual`";
		$qrI = $this->db->query($sqI);
		$sqA = "RENAME TABLE `r_pegawai_rekap_baru` TO `r_pegawai_aktual`";
		$qrA = $this->db->query($sqA);
*/

	echo "satu";
}

	function reff_jabatan(){
		$sqlstr="SELECT a.id,b.id_peg_jab, c.nip_baru
		FROM r_pegawai_bulanan a 
		LEFT JOIN r_pegawai c ON (a.id_pegawai=c.id_pegawai)
		LEFT JOIN r_peg_jab b ON (a.id_pegawai=b.id_pegawai AND a.tmt_jabatan=b.tmt_jabatan)
		WHERE a.status_kepegawaian='pns'";
		$query = $this->db->query($sqlstr)->result(); 

		foreach($query AS $key=>$val){
			if($val->id_peg_jab!=""){
				$sqA = "UPDATE r_pegawai_bulanan SET reff_jabatan=".$val->id_peg_jab." WHERE id='".$val->id."'";
				$qrA = $this->db->query($sqA);
			}
//			echo $val->id." :: ".$val->nip_baru." :: ".$val->id_peg_jab."<br>";
		}

		echo "ya";
	}


	function inisiasi_r_peg_jab(){
		$sqlstr = "SELECT * FROM `r_pegawai_aktual` 
					WHERE status_kepegawaian='pns' 
					AND id_pegawai NOT IN (SELECT DISTINCT id_pegawai FROM r_peg_jab)";
		$query = $this->db->query($sqlstr)->result(); 

		foreach($query AS $key=>$val){
						$this->db->set('id_pegawai',$val->id_pegawai);
						$this->db->set('id_unor',$val->id_unor);
						$this->db->set('kode_unor',$val->kode_unor);
						$this->db->set('nama_unor',$val->nama_unor);
						$this->db->set('nomenklatur_pada',$val->nomenklatur_pada);
						$this->db->set('nama_jenis_jabatan',$val->jab_type);
						$this->db->set('tugas_tambahan',$val->tugas_tambahan);
						$this->db->set('nama_jabatan',$val->nomenklatur_jabatan);
						$this->db->set('tmt_jabatan',$val->tmt_jabatan);
						$this->db->set('kode_ese',$val->kode_ese);
						$this->db->set('nama_ese',$val->nama_ese);
						$this->db->set('id_jenjang_jabatan',$val->id_jenjang_jabatan);
						$this->db->set('last_updated',"NOW()",false);
						$this->db->insert('r_peg_jab');

						echo ($key+1).". ".$val->id_pegawai."<br>";
		}

		echo "ya";
	}


	function inputan_massal(){
		$data['unor'] = $this->m_unor->gettree(0,5,date('Y')."-".date('m')."-01"); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['batas'] = 10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$this->load->view('migrasi/inputan_massal',$data);
	}

	public function getdata_jabatan_uid()  {
		$bulan = (strlen($_POST['bulan'])==1)?"0".$_POST['bulan']:$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tbhl = $tahun."-".$bulan;

		$data['count'] = $this->m_migrasi->hitung_pegawai_jabatan($tahun,$bulan,$_POST['cari'],$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();

			$data['hslquery'] = $this->m_migrasi->get_pegawai_jabatan($tahun,$bulan,$_POST['cari'],$mulai,$batas,$_POST['kode'],$_POST['pkt'],$_POST['jbt']);
			foreach($data['hslquery'] AS $key=>$val){
				$sebelum = $this->m_dafpeg->get_jabatan_sebelum($val->tmt_jabatan,$val->id_pegawai);
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
				@$data['hslquery'][$key]->nama_jabatan_awal = $sebelum->nama_jabatan;
				@$data['hslquery'][$key]->nama_unor_awal = $sebelum->nama_unor;
				@$data['hslquery'][$key]->nomenklatur_pada_awal = $sebelum->nomenklatur_pada;

				$dok_ref = $this->m_edok->cek_dokumen($val->nip_baru,"sk_jabatan",$val->id_peg_jab);
				$data['hslquery'][$key]->thumb = (empty($dok_ref))?"assets/file/foto/photo.jpg":"assets/media/file/".$val->nip_baru."/sk_jabatan/thumb_".$dok_ref[0]->file_dokumen;
			}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}


	public function injek_guru()  {
		$sqlstr = "SELECT * FROM `r_pegawai_bulanan` 
					WHERE status_kepegawaian='pns' AND jab_type='jft-guru' AND bulan='12'
					AND id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_keluar)";
		$query = $this->db->query($sqlstr)->result(); 

		foreach($query AS $key=>$val){
				$this->db->set('gelar_depan',$val->gelar_depan);
				$this->db->set('gelar_belakang',$val->gelar_belakang);
				$this->db->set('gelar_nonakademis',$val->gelar_nonakademis);
				$this->db->set('status_perkawinan',$val->status_perkawinan);
				$this->db->set('kode_golongan',$val->kode_golongan);
				$this->db->set('tmt_pangkat',$val->tmt_pangkat);
				$this->db->set('id_unor',$val->id_unor);
				$this->db->set('kode_unor',$val->kode_unor);
				$this->db->set('jab_type',$val->jab_type);
				$this->db->set('id_jenjang_jabatan',$val->id_jenjang_jabatan);
				$this->db->set('tmt_jabatan',$val->tmt_jabatan);
				$this->db->set('nomenklatur_jabatan',$val->nomenklatur_jabatan);
				$this->db->set('kode_ese',$val->kode_ese);
				$this->db->set('tmt_ese',$val->tmt_ese);
				$this->db->set('tugas_tambahan',$val->tugas_tambahan);
				$this->db->set('tahun',2017);
				$this->db->set('bulan',1);
				$this->db->set('status_kepegawaian','pns');
				$this->db->set('id_pegawai',$val->id_pegawai);
				$this->db->set('reff_jabatan',$val->reff_jabatan);
				$this->db->insert('r_pegawai_bulanan');
		
			echo ($key+1).". ".$val->id_pegawai."<br>";
		}
	}

	public function sisa()  {
		$jbt = $this->uri->segment(6);
		$iJbt = ($this->uri->segment(6)=="")?"":" AND a.jab_type='$jbt'";
		$sqlstr = "SELECT a.jab_type,
					b.* FROM r_pegawai_bulanan a
					LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
					WHERE a.status_kepegawaian='pns' AND a.bulan='12' AND a.tahun='2016' $iJbt
					AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_keluar)
					AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_pensiun)
					AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_bulanan WHERE status_kepegawaian='pns'  AND bulan='1' AND tahun='2017')
					ORDER BY a.jab_type,b.nip_baru";
		$query = $this->db->query($sqlstr)->result(); 

		echo "<br><br>";
		echo "<b>DAFTAR PEGAWAI YANG BELUM DI-UPDATE SOTK 2017</b><br><br>";
		echo '<table style="border:none;">';
		foreach($query AS $key=>$val){
			$sql = "SELECT * FROM r_peg_jab WHERE id_pegawai='".$val->id_pegawai."' ORDER BY tmt_jabatan DESC LIMIT 1";
			$qry = $this->db->query($sql)->row(); 
			echo '<tr style="border-bottom:1px solid #ddd;">';
			echo '<td width="50">'.($key+1).'. </td>';
			echo '<td width="170">'.$val->nip_baru.'</td>';
			echo '<td width="30">'.$val->jab_type.'</td>';
			echo '<td>'.$val->nama_pegawai.'</td>';
			echo '<td>'.$qry->nama_jabatan.' :: '.$qry->nomenklatur_pada.'</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo "<br><br>";


			$sql = "SELECT * FROM r_pegawai_bulanan WHERE tahun='2016' AND bulan='12' AND status_kepegawaian='pns'";
			$qry = $this->db->query($sql)->result(); 
			foreach($qry AS $key=>$val){
				$sqlA = "UPDATE r_pegawai_bulanan SET nama_jenjang='".$val->nama_jenjang."' WHERE tahun='2017' AND bulan='1' AND id_pegawai='".$val->id_pegawai."'";
				$qryA = $this->db->query($sqlA); 
			}


	}


	public function rekon_r_pegawai_aktual()  {
		$sql = "SELECT a.id_pegawai,b.nip_baru FROM r_peg_jab a 
LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai)
WHERE a.tmt_jabatan='2017-01-03'
AND a.id_pegawai AND a.nama_jenis_jabatan!='jft-guru' AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_aktual WHERE status_kepegawaian='pns' AND tmt_jabatan='2017-01-03')
AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_keluar)
AND a.id_pegawai NOT IN (SELECT id_pegawai FROM r_pegawai_pensiun)";
		$qry = $this->db->query($sql)->result(); 
		$ky = 1;
		foreach($qry AS $key=>$val){
				echo $ky.". ".$val->nip_baru."<br>"; 
				$ky++;
/*
			$sqlA = "SELECT * FROM r_pegawai_aktual WHERE id_pegawai='".$val->id_pegawai."' AND tmt_jabatan='2017-01-03'";
			$qryA = $this->db->query($sqlA)->row();
			if($val->id_unor!=@$qryA->id_unor){
				echo $ky.". ".$val->nip_baru." || ".$val->id_unor." :: ".@$qryA->id_unor."<br>"; 
			}
*/
		}
	}





}
?>