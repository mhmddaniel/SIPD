<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Njs2017 extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('appbkpp/m_unor');
		$this->load->model('appbkpp/m_pegawai');
		$this->load->model('appsotkbaru/m_njs2017');
		date_default_timezone_set('Asia/Jakarta');
	}

///////////////////////////////////////////////////////////////////////////////////
	function index(){
		$data['satu'] = "Pengukuhan Pegawai SOTK 2017";
		$this->load->view('njs2017/index',$data);
	}

	function gettree(){
		$id_rancangan = $this->session->userdata('id_rancangan');
		$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
		$this->session->set_userdata('tanggal',$tanggal);
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();
		$level=($_POST['level']+1);
		$spare=3+(($level*20)-20);
		$lgh=5+(($level*3)-3);
		$id_parentxx=explode("_",$_POST['id_parent']);	
		$id_parent=end($id_parentxx);	

		$iUnor = $this->m_unor->ini_unor($id_parent);
		$uUnor = ($_POST['id_parent']==0)?0:$iUnor->kode_unor;
		$data['hslquery'] = $this->m_unor->gettree($uUnor,$lgh,$tanggal);

		foreach($data['hslquery'] as $it=>$val){
			$id=$data['hslquery'][$it]->id_unor;
			$data['hslquery'][$it]->idparent=$_POST['id_parent'];	
			$data['hslquery'][$it]->spare=$spare;	
			$data['hslquery'][$it]->level=$level;
				$anak=$this->m_unor->gettree($data['hslquery'][$it]->kode_unor,($lgh+3),$tanggal);
				$data['hslquery'][$it]->toggle=(!empty($anak))?"tutup":"buka";
				$data['hslquery'][$it]->idchild=($_POST['id_parent']==0)?$id:$_POST['id_parent']."_".$id;
			
			$kode = $val->kode_unor;
			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a LEFT JOIN m_unor b ON a.id_unor=b.id_unor WHERE a.jab_type='jfu' AND b.kode_unor LIKE '$kode%' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->jfu = $hsA->jml;	
			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a LEFT JOIN m_unor b ON a.id_unor=b.id_unor WHERE a.jab_type='jft' AND b.kode_unor LIKE '$kode%' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->jft = $hsA->jml;	
			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a LEFT JOIN m_unor b ON a.id_unor=b.id_unor WHERE a.jab_type='jft-guru' AND b.kode_unor LIKE '$kode%' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->guru = $hsA->jml;
			$data['hslquery'][$it]->jumlah = $data['hslquery'][$it]->jfu+$data['hslquery'][$it]->jft+$data['hslquery'][$it]->guru;	

			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a WHERE a.jab_type='jfu' AND a.id_unor='".$id."' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->jfu_u = $hsA->jml;	
			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a WHERE a.jab_type='jft' AND a.id_unor='".$id."' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->jft_u = $hsA->jml;	
			$sqA = "SELECT COUNT(a.id) AS jml FROM p_mut_rancangan_pemangku a WHERE a.jab_type='jft-guru' AND a.id_unor='".$id."' AND a.id_rancangan='0'";
			$hsA=$this->db->query($sqA)->row();
			$data['hslquery'][$it]->guru_u = $hsA->jml;	
			$data['hslquery'][$it]->jumlah_u = $data['hslquery'][$it]->jfu_u+$data['hslquery'][$it]->jft_u+$data['hslquery'][$it]->guru_u;	
		}
		$data['mulai'] = 1;
		$data['pager'] = "";
		echo json_encode($data);
	}

	function daftar_pegawai(){
		$idd = explode("**",$_POST['idd']);
		$id_unor = $idd[0];
		$data['terkecil'] = $idd[1];
		$data['level'] = $idd[2];
		$data['id_parent'] = $idd[3];

		$data['unor'] = $this->m_unor->ini_unor($id_unor);
		$this->session->set_userdata('id_unor',$id_unor);
		$this->session->set_userdata('kode_unor',$data['unor']->kode_unor);
		$data['batas'] = 10;
		$data['cari'] = "";
		$this->load->view('njs2017/daftar_pegawai',$data);
	}

	function getpegawai(){
		$cari = $_POST['cari'];
		$tanggal = $this->session->userdata('tanggal');
		$kode_unor = $this->session->userdata('kode_unor');
		$iJenis = ($_POST['jenis']=="all")?"":" AND a.jab_type='".$_POST['jenis']."'";

		if($_POST['unit']=="unit"){
			$id_unor = $this->session->userdata('id_unor');
			$sqA = "SELECT a.id FROM p_mut_rancangan_pemangku a	
			LEFT JOIN (m_unor e) ON (a.id_unor=e.id_unor)
			WHERE a.id_rancangan='0' $iJenis 
			AND (
			a.nip_baru LIKE '$cari%'
			OR a.nama_pegawai LIKE '%$cari%'
			OR e.nomenklatur_pada LIKE '%$cari%'
			OR e.kode_unor LIKE '$cari%'
			)
			AND a.id_unor='$id_unor'";
		} else {
			$sqA = "SELECT a.id FROM p_mut_rancangan_pemangku a
				LEFT JOIN (m_unor e) ON (a.id_unor=e.id_unor)
				WHERE a.id_rancangan='0' $iJenis 
				AND (
				a.nip_baru LIKE '$cari%'
				OR a.nama_pegawai LIKE '%$cari%'
				OR e.nomenklatur_pada LIKE '%$cari%'
				OR e.kode_unor LIKE '$cari%'
				)
				AND e.kode_unor LIKE '$kode_unor%' AND e.tmt_berlaku<='$tanggal' AND e.tst_berlaku>='$tanggal'";
		}


		$hsA=$this->db->query($sqA)->result();
		$data['count'] = count($hsA);
		$dWpangkat = $this->dropdowns->kode_pangkat();
		$dWgolongan = $this->dropdowns->kode_golongan();

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas = $_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
	
		if($_POST['unit']=="unit"){
			$id_unor = $this->session->userdata('id_unor');
			$sqB = "SELECT a.*,d.nama_unor,b.nomenklatur_jabatan,b.gender,c.nama_unor AS nama_unor_lama,c.nomenklatur_pada AS nomenklatur_pada_lama FROM p_mut_rancangan_pemangku a	
					LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
					LEFT JOIN m_unor c ON (b.id_unor=c.id_unor)
					LEFT JOIN m_unor d ON (a.id_unor=d.id_unor)
					LEFT JOIN (m_unor e) ON (a.id_unor=e.id_unor)
					WHERE a.id_rancangan='0' $iJenis 
					AND (
					a.nip_baru LIKE '$cari%'
					OR a.nama_pegawai LIKE '%$cari%'
					OR e.nomenklatur_pada LIKE '%$cari%'
					OR e.kode_unor LIKE '$cari%'
					)
					AND a.id_unor='$id_unor'
					ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.tmt_cpns ASC LIMIT $mulai,$batas";
		} else {
			$sqB = "SELECT a.*,d.nama_unor,b.nomenklatur_jabatan,b.gender,c.nama_unor AS nama_unor_lama,c.nomenklatur_pada AS nomenklatur_pada_lama FROM p_mut_rancangan_pemangku a	
					LEFT JOIN r_pegawai_aktual b ON (a.id_pegawai=b.id_pegawai)
					LEFT JOIN m_unor c ON (b.id_unor=c.id_unor)
					LEFT JOIN m_unor d ON (a.id_unor=d.id_unor)
					LEFT JOIN (m_unor e) ON (a.id_unor=e.id_unor)
					WHERE a.id_rancangan='0' $iJenis 
					AND (
					a.nip_baru LIKE '$cari%'
					OR a.nama_pegawai LIKE '%$cari%'
					OR e.nomenklatur_pada LIKE '%$cari%'
					OR e.kode_unor LIKE '$cari%'
					)
					AND e.kode_unor LIKE '$kode_unor%' AND e.tmt_berlaku<='$tanggal' AND e.tst_berlaku>='$tanggal'
					ORDER BY a.kode_golongan DESC,a.tmt_pangkat ASC,a.tmt_cpns ASC LIMIT $mulai,$batas";
		}
			$data['hslquery'] = $this->db->query($sqB)->result();
			foreach($data['hslquery'] AS $key=>$val){
				$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');
				$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
				$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];
			}

			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		} //end if
		echo json_encode($data);
	}

	function tambahpegawai_form(){
		$idd = explode("**",$_POST['idd']);
		$id_unor = $idd[0];
		$data['terkecil'] = $idd[1];
		$data['level'] = $idd[2];
		$data['id_parent'] = $idd[3];
		$this->session->set_userdata('id_unor',$id_unor);
		$data['unorini'] = $this->m_unor->ini_unor($id_unor);
		$data['batas'] = 10;
		$data['cari'] = "";
		$data['kode'] = ""; 
		$data['unor'] = $this->m_unor->gettree(0,5,'2016-12-10'); 
		$data['pkt'] = $this->dropdowns->kode_golongan_pangkat();
		$data['jbt'] = $this->dropdowns->jenis_jabatan();
		$data['ese'] = $this->dropdowns->kode_ese();
		$data['tugas'] = $this->dropdowns->tugas_tambahan();
		$data['agama'] = $this->dropdowns->agama();
		$data['status'] = $this->dropdowns->status_perkawinan();
		$data['jenjang'] = $this->dropdowns->kode_jenjang_pendidikan();
		$data['umur'] = $this->dropdowns->umur();
		$data['mkcpns'] = $this->dropdowns->mkcpns();
		$this->load->view('njs2017/tambahpegawai_form',$data);
	}

	function getaktif(){
			$unor="all";
			$kode=$_POST['kode'];
			$pkt=$_POST['pkt'];
			$jbt=$_POST['jbt'];
			$ese=$_POST['ese'];
			$tugas=$_POST['tugas'];
			$gender=$_POST['gender'];
			$agama=$_POST['agama'];
			$status=$_POST['status'];
			$jenjang=$_POST['jenjang'];
			$umur=$_POST['umur'];
			$mkcpns=$_POST['mkcpns'];
			$jenis=(isset($_POST['jenis']))?$_POST['jenis']:"pns";
			$dWpangkat = $this->dropdowns->kode_pangkat();
			$dWgolongan = $this->dropdowns->kode_golongan();
			$dWjjGuru = $this->dropdowns->jenjang_jabatan_guru();

		$data['count'] = $this->m_njs2017->hitung_pegawai_bulanan($_POST['cari'],$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$jenis);

		$data['bat_print'] = 200;
		$data['seg_print'] = ceil($data['count']/$data['bat_print']);
		$_POST['bat_print'] = $data['bat_print'];
		$this->session->set_userdata("id_cetak",$_POST);

		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;


			$data['hslquery'] = $this->m_njs2017->get_pegawai_bulanan($_POST['cari'],$mulai,$batas,$_POST['pns'],$unor,$kode,$pkt,$jbt,$ese,$tugas,$gender,$agama,$status,$jenjang,$umur,$mkcpns,$jenis);

				foreach($data['hslquery'] AS $key=>$val){
					$data['hslquery'][$key]->tanggal_lahir = date("d-m-Y", strtotime($val->tanggal_lahir));
					$data['hslquery'][$key]->nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');

					$data['hslquery'][$key]->tmt_cpns = date("d-m-Y", strtotime(@$val->tmt_cpns));
					$data['hslquery'][$key]->tmt_pns = date("d-m-Y", strtotime(@$val->tmt_pns));
					$data['hslquery'][$key]->tmt_pangkat = date("d-m-Y", strtotime($val->tmt_pangkat));
					$data['hslquery'][$key]->tmt_jabatan = date("d-m-Y", strtotime($val->tmt_jabatan));
					$data['hslquery'][$key]->nomenklatur_jabatan = ($val->jab_type=='jft-guru')?@$dWjjGuru[$val->kode_golongan]." - ".$val->nomenklatur_jabatan:$val->nomenklatur_jabatan;
					$data['hslquery'][$key]->nama_pangkat = @$dWpangkat[$val->kode_golongan];
					$data['hslquery'][$key]->nama_golongan = @$dWgolongan[$val->kode_golongan];

				}
			$data['pager'] = Modules::run("crest/pager/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function pilih_ini(){
		$sqA = "SELECT * FROM r_pegawai_aktual	WHERE id_pegawai='".$_POST['idd']."'";
		$val=$this->db->query($sqA)->row();
		$id_unor = $this->session->userdata('id_unor');
			$this->db->set('id_rancangan',0);
			$this->db->set('id_pegawai',$val->id_pegawai);
			$this->db->set('nip_baru',$val->nip_baru);
			$this->db->set('nama_pegawai',$val->nama_pegawai);
			$this->db->set('gelar_nonakademis',$val->gelar_nonakademis);
			$this->db->set('gelar_depan',$val->gelar_depan);
			$this->db->set('gelar_belakang',$val->gelar_belakang);
			$this->db->set('tmt_cpns',$val->tmt_cpns);
			$this->db->set('tmt_pns',$val->tmt_pns);
			$this->db->set('kode_golongan',$val->kode_golongan);
			$this->db->set('tmt_pangkat',$val->tmt_pangkat);
			$this->db->set('id_unor',$id_unor);
			$this->db->set('jab_type',$val->jab_type);
			$this->db->set('kode_ese',$val->kode_ese);
			$this->db->set('tmt_ese',$val->tmt_ese);
			$this->db->set('tugas_tambahan',$val->tugas_tambahan);
			$this->db->insert('p_mut_rancangan_pemangku');
		echo "sukses";
	}
	function hapus_pegawai(){
		$data['idd'] = $_POST['idd'];
		$this->load->view('njs2017/hapuspegawai_form',$data);
	}
	function hapus_ini(){
			$this->db->where('id_rancangan',0);
			$this->db->where('id_pegawai',$_POST['idd']);
			$this->db->delete('p_mut_rancangan_pemangku');
		echo "sukses";
	}
	function pindah_pegawai(){
		$data['idd'] = $_POST['idd'];
		$data['hal'] = 1;
		$data['batas'] = 10;
		$data['cari'] = "";
		$this->load->view('njs2017/pindahpegawai_form',$data);
	}

	function pindah_ini(){
		$iUnor = $this->m_unor->ini_unor($_POST['id_unor']);
		$lgh = strlen($iUnor->kode_unor)+3;
		$anak = $this->m_unor->gettree($iUnor->kode_unor,$lgh,$_POST['tanggal']);

		$sqA = "SELECT * FROM r_pegawai_aktual	WHERE id_pegawai='".$_POST['id_pegawai']."'";
		$val=$this->db->query($sqA)->row();
		
		if($val->jab_type=="jfu" && !empty($anak)){
			echo "JFU hanya bisa dipindahkan ke Unit Kerja terkecil";
		} else {
			$this->db->set('id_unor',$_POST['id_unor']);
			$this->db->where('id_rancangan',0);
			$this->db->where('id_pegawai',$_POST['id_pegawai']);
			$this->db->update('p_mut_rancangan_pemangku');
			echo "sukses";
		}
	}

}
?>