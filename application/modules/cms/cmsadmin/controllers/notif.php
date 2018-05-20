<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Notif extends MX_Controller {

	function __construct(){
		$this->auth->restrict();
		parent::__construct();
	}

	function webadmin(){
		$this->load->view('notif/webadmin');
	}
	function admin(){
		$this->load->view('notif/admin');
	}
	function absensor_unit(){
		$this->load->view('notif/absensor_unit');
	}
	function pengelola(){
		$data['kode'] = $this->session->userdata('kode_unor');
		$this->load->view('notif/pengelola',$data);
	}
	function pengelola_lengkap(){
		$this->load->view('notif/pengelola_lengkap');
	}
	function evjab_admin(){
		$this->load->view('notif/evjab_admin');
	}
	function evjab_umpeg(){
		$data['kode'] = $this->session->userdata('kode_unor');
		$this->load->view('notif/evjab_umpeg',$data);
	}
	function pegawai(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$cek = $this->cek_kepala_opd($id_pegawai);
		if(strlen($cek->kode_unor)==5 && $cek->jab_type=='js'){
			$data['kepala_opd'] = "ya";
			$this->session->set_userdata('kode_unor',$cek->kode_unor);
			$this->session->set_userdata('nama_unor',$cek->nomenklatur_pada);
		} else {
			$data['kepala_opd'] = "tidak";
		}
		$this->load->view('notif/pegawai',$data);
	}
	function pegawai_tukin(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$cek = $this->cek_kepala_opd($id_pegawai);
		if(strlen($cek->kode_unor)==5 && $cek->jab_type=='js'){
			$data['kepala_opd'] = "ya";
			$this->session->set_userdata('kode_unor',$cek->kode_unor);
			$this->session->set_userdata('nama_unor',$cek->nomenklatur_pada);
		} else {
			$data['kepala_opd'] = "tidak";
		}
		
		$this->load->view('notif/pegawai_tukin',$data);
	}
	function skp_online(){
		$id_pegawai = $this->session->userdata('pegawai_info');
		$cek = $this->cek_kepala_opd($id_pegawai);
		if(strlen($cek->kode_unor)==5 && $cek->jab_type=='js'){
			$data['kepala_opd'] = "ya";
			$this->session->set_userdata('kode_unor',$cek->kode_unor);
			$this->session->set_userdata('nama_unor',$cek->nomenklatur_pada);
		} else {
			$data['kepala_opd'] = "tidak";
		}
		$this->load->view('notif/skp_online',$data);
	}
	function kepala_opd(){
		$this->load->view('notif/kepala_opd');
	}
    function cek_kepala_opd($idd){
		$sqlstr="SELECT * FROM r_pegawai_aktual WHERE id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();

		if(empty($hslquery)){
			$sql="SELECT a.* FROM r_pegawai_bulanan a WHERE a.id_pegawai='$idd' ORDER BY a.tahun,a.bulan DESC LIMIT 0,1";
			$res = $this->db->query($sql)->row();

			$sql2="SELECT a.nama_pegawai,a.nip_baru FROM r_pegawai a WHERE a.id_pegawai='$idd'";
			$res2 = $this->db->query($sql2)->row();
			
			$hslquery = $res;
			$hslquery->nama_pegawai = $res2->nama_pegawai;
			$hslquery->nip_baru = $res2->nip_baru;
			
		}

		return $hslquery;
	}


}
?>