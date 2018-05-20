<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pengenal extends MX_Controller {

	function __construct(){
		parent::__construct();
		$sess = $this->session->userdata('logged_in');
		$this->nama_user = $sess['nama_user'];
	}

	function webadmin(){
		$data['nama'] = $this->nama_user;
		$this->load->view('pengenal/webadmin',$data);
	}
	function admin(){
		$data['nama'] = $this->nama_user;
		$this->load->view('pengenal/admin',$data);
	}
	function pengelola(){
		$data['nama'] = "...";
		$this->load->view('pengenal/admin',$data);
	}
	function mutasi(){
		$data['nama'] = "...";
		$this->load->view('pengenal/admin',$data);
	}
	function pegawai()	{
		$idP = $this->session->userdata('pegawai_info');

		$sqlstr="SELECT a.nama_pegawai,a.gelar_depan,a.gelar_belakang,a.gelar_nonakademis,a.nip_baru FROM r_pegawai a  WHERE a.id_pegawai='$idP'";
		$val=$this->db->query($sqlstr)->row();
		$nama_pegawai = ((trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'').((trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'').$val->nama_pegawai.((trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'');


		$sqlstr = "SELECT file_dokumen FROM r_peg_dokumen WHERE nip_baru='".$val->nip_baru."' AND tipe_dokumen='pasfoto'";
		$cek=$this->db->query($sqlstr)->row();
		if(empty($cek)){
			$foto = "<img src='".base_url()."assets/file/foto/photo.jpg' width='100'><br>";
		} else {
			$path="assets/media/file/".$val->nip_baru."/pasfoto/thumb_".$cek->file_dokumen;
			if(file_exists($path)){
				$foto = "<img src='".base_url()."assets/media/file/".$val->nip_baru."/pasfoto/thumb_".$cek->file_dokumen."'><br>";
			} else {
				$foto = "<img src='".base_url()."assets/file/foto/photo.jpg' width='100'><br>";
			}
		}

		$sess = "<div class='user-dantech'>".$foto.$nama_pegawai."</div>";
		return $sess;
	}

}
?>