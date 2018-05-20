<?php
class Sso extends MX_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$idd = $_POST['idd'];

			switch ($_POST['app']):
				case '_tukin':
					$app = "pegawai_tukin";
					break;
				case 'skp':
					$app = "skp_online";
					break;
				case 'kepala_opd':
					$app = "kepala_opd";
					break;
				case 'pegawai':
					$app = "pegawai";
					break;
				case 'evjab_umpeg':
					$app = "evjab_umpeg";
					break;
				case 'pengelola':
					$app = "pengelola";
					break;
				case 'pengelola_lengkap':
					$app = "pengelola_lengkap";
					break;
			endswitch;

//		$app = ($_POST['app']=='_tukin')?"pegawai_tukin":"pegawai";

			$sqlstr="SELECT a.*, b.* FROM users a LEFT JOIN (cmf_setting b) ON (a.group_id=b.id_item) WHERE a.user_id='$idd'";
			$query=$this->db->query($sqlstr);

			foreach ($query->result() as $row) {
				$id_user=$row->user_id;
				$username= $row->username;
				$nama_user = $row->nama_user;
				$id_group = $row->group_id;
				$group_name = $row->nama_item;
					$jj = json_decode($row->meta_value);

				$section_name = $jj->section_name;
				$back_office = $jj->back_office;
        	}

			//======================= VARIABEL SESSION WAJIB / STNDAR ==========================
				$sessm = array();
				$sessm['id_user'] = $id_user;
				$sessm['username']= $username;
				$sessm['nama_user']= $nama_user;
				$sessm['id_group'] = $this->grup($app);
				$sessm['group_name'] = $app;
				$sessm['section_name'] = $this->section($sessm['id_group']);
				$sessm['back_office'] = $back_office;
				$sessm['logged_in'] = TRUE;

                  	$pegawai = $this->get_user_pegawai($id_user);
//					$this->session->set_userdata('pegawai_info', $pegawai->id_pegawai);
					$this->session->set_userdata('user_id', $id_user);
					$this->session->set_userdata('group_id', $this->grup($app));
					$this->session->set_userdata('logged_in', $sessm);

		redirect(site_url('admin'));
	}

    function kepala_opd()    {
		$sessm = $this->session->userdata('logged_in');
		$gr = $this->grup('kepala_opd');
		$sessm['group_name'] = "kepala_opd";
		$sessm['id_group'] = $gr;
		$this->session->set_userdata('logged_in', $sessm);
		$this->session->set_userdata('group_id', $gr);

		redirect(site_url('admin'));
	}

    function grup($grup)    {
      $this->db->select('id_item');
      $this->db->from('cmf_setting');
      $this->db->where('id_setting',13);
      $this->db->where('nama_item',$grup);
      $pegawai = $this->db->get()->row();
      return $pegawai->id_item;
    }

    function section($idd)    {
      $this->db->select('meta_value');
      $this->db->from('cmf_setting');
      $this->db->where('id_item',$idd);
      $pegawai = $this->db->get()->row();
	  	$jj=json_decode($pegawai->meta_value);
      return $jj->section_name;
    }

    function get_user_pegawai($user_id = false)    {
      $this->db->select('b.id_pegawai');
      $this->db->select('b.nama_pegawai');
      $this->db->from('user_pegawai a');
      $this->db->join('rekap_peg b','a.id_pegawai=b.id_pegawai');
      $this->db->where('a.user_id',$user_id);
      $pegawai = $this->db->get()->row();
      return $pegawai;
    }

	
}