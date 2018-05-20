<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Fungsi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////
  function index()  {
  	$data['satu'] = "Honda";
	$data['id_unor'] = $_POST['idd'];

		$this->db->from('m_unor');
		$this->db->where('id_unor',$data['id_unor']);
		$data['unor'] = $this->db->get()->row();

		$this->db->from('evip_fungsi');
		$this->db->where('id_unor',$data['id_unor']);
		$data['fungsi'] = $this->db->get()->result();

	$this->load->view('fungsi/index',$data);
  }

  function form_tambah()  {
  	$data['aksi'] = "tambah";
	$data['id_unor'] = $_POST['id_unor'];
	$data['id_fungsi'] = $_POST['id_fungsi'];
	$this->load->view('fungsi/form_uraian',$data);
  }
  function form_edit()  {
  	$data['aksi'] = "edit";
	$data['id_unor'] = $_POST['id_unor'];
	$data['id_fungsi'] = $_POST['id_fungsi'];
		$this->db->from('evip_fungsi');
		$this->db->where('id_fungsi',$data['id_fungsi']);
		$data['fungsi'] = $this->db->get()->row();
	$this->load->view('fungsi/form_uraian',$data);
  }
  function tambah_aksi(){
		$this->db->set('fungsi',$_POST['fungsi']);
		$this->db->set('id_unor',$_POST['id_unor']);
		$this->db->insert('evip_fungsi');
  	echo "sukses";
  }
  function edit_aksi(){
		$this->db->set('fungsi',$_POST['fungsi']);
		$this->db->where('id_fungsi',$_POST['id_fungsi']);
		$this->db->update('evip_fungsi');
  	echo "sukses";
  }
  function form_hapus()  {
  	$data['aksi'] = "hapus";
	$data['id_unor'] = $_POST['id_unor'];
	$data['id_fungsi'] = $_POST['id_fungsi'];
		$this->db->from('evip_fungsi');
		$this->db->where('id_fungsi',$data['id_fungsi']);
		$data['fungsi'] = $this->db->get()->row();
	$this->load->view('fungsi/form_uraian',$data);
  }
  function hapus_aksi(){
		$this->db->where('id_fungsi',$_POST['id_fungsi']);
		$this->db->delete('evip_fungsi');
  	echo "sukses";
  }

}
?>