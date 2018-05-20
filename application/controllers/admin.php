<?php
class Admin extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$sess = $this->session->userdata('logged_in');
		$this->id_grup = $sess['id_group'];
		$this->nama_user = $sess['nama_user'];
		$this->nama_grup = $sess['group_name'];
		$this->theme = $sess['section_name'];
	}

	public function index(){ 
		$menu = $this->get_group_menu($this->id_grup);
		redirect(site_url($menu[0]->path_menu));
	}
	public function module($modulename,$contrr)	{
		if($contrr==""){	redirect(site_url('admin'));	}else{

		$fni = ($this->uri->segment(4)=="")?"":"/".$this->uri->segment(4);
		$this->cekAclGet("module/".$modulename."/".$contrr.$fni,$this->id_grup);

		/* Contoh untuk bikin tampilan identitas pengguna 
		Bisa saja dikasih foto, nama dlll
		*/		
		$data['pengenal'] = ($this->nama_grup=="pegawai" || $this->nama_grup=="pegawai_tukin" || $this->nama_grup=="skp_online")?Modules::run('cmsadmin/pengenal/pegawai'):Modules::run('cmsadmin/pengenal/'.$this->nama_grup);
		
		$induk = $this->induk($modulename."/".$contrr.$fni);
		$data['actt'] = $this->session->userdata('menu_induk_aktif');

		$data['logo'] = $this->getopsivalue('logo_app');
		$data['nama'] = $this->getopsivalue('nama_app');
		$data['slogan'] = $this->getopsivalue('slogan_app');

		$data['sidebar'] = $this->get_group_menu($this->id_grup);
		$data['konten'] = ($this->uri->segment(4)=="")?Modules::run($modulename."/".$contrr."/index"):Modules::run($modulename."/".$contrr."/".$this->uri->segment(4));	//$data['konten'] =   Modules::run($modulename."/index");

		$data['gr'] = $this->getgroupvar($this->id_grup);
		$data['notif'] =   Modules::run('cmsadmin/notif/'.$this->nama_grup);
			
		$this->viewPath = '../../assets/themes/'. $this->theme.'/';
		$this->load->view($this->viewPath.'index',$data);
		}
	}
/////////////////////////////////////////////////////////
	public function get_group_menu($id_groups,$id_menu=0){
		$sqlstr="SELECT a.* FROM cmf_setting a WHERE a.id_setting='12' AND a.id_parent='$id_menu' ORDER BY a.urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();

		$data=array();$ky=0;
		foreach($hslquery as $key=>$val){
			$sqlstrb="SELECT a.id_item FROM cmf_setting a WHERE a.id_setting='14' AND a.meta_value LIKE '%\"id_menu\":\"".$val->id_item."\"%'  AND a.meta_value LIKE '%\"group_id\":\"$id_groups\"%'";
			$hslqueryb=$this->db->query($sqlstrb)->row();
			if(!empty($hslqueryb)){	
				$jj=json_decode($val->meta_value);
				@$data[$ky]->id_menu = $val->id_item;
				$data[$ky]->nama_menu = $val->nama_item;
				$data[$ky]->path_menu = $jj->path_menu;
				$data[$ky]->icon_menu = $jj->icon_menu;
					$anak = $this->get_group_menu($id_groups,$val->id_item);
					if(!empty($anak)){	$data[$ky]->anak = $anak;	}	
				$ky++;
			}
		}
		return $data;
	}
	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->row();
		$ff=json_decode(@$hslqueryp->meta_value);
		return @$ff->nilai;
	}
	function getgroupvar($idd){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_item' => $idd))->row();
		$ff=json_decode(@$hslqueryp->meta_value);
		return $ff;
	}

	function pindah(){
		$ids = $this->session->userdata('logged_in');
		echo $ids['id_user'];
	}
	private function induk($urr)	{
		$urr = "module/".$urr;
		$sqlstr="SELECT meta_value,nama_item,id_item,urutan FROM cmf_setting  WHERE id_setting='12' AND meta_value LIKE '%\"path_menu\":\"$urr\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
		if(empty($hslquery)){	$balik="TIDAK ADA";	} else {	
			$balik = $this->cari_induk($hslquery->id_item);
			$this->session->set_userdata('menu_induk_aktif',$balik);
		}
		return $balik;
	}
	private function cari_induk($idd)	{
		$sqlstr="SELECT a.id_item,a.id_parent FROM cmf_setting a WHERE a.id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		if($hslquery->id_parent==0){
			return $hslquery->id_item;
		} else {
			$ulang=$this->cari_induk($hslquery->id_parent);
			return $ulang;
		}
	}
	function lanjutkan(){
		echo "OK!";
	}

	private function cekAclGet($namaMenu,$id_grup)	{
		$sqlstr="SELECT id_item FROM cmf_setting  WHERE id_setting='12' AND meta_value LIKE '%\"path_menu\":\"$namaMenu\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
		
		if(!empty($hslquery)){
			$idmenu = $hslquery->id_item;
			$sq = "SELECT meta_value FROM cmf_setting  WHERE id_setting='14' AND meta_value LIKE '%\"group_id\":\"$id_grup\"%' AND meta_value LIKE '%\"id_menu\":\"$idmenu\"%'";
			$hs = $this->db->query($sq)->row();
			if(empty($hs)){	redirect(site_url('login/out'));	exit();	}
		}
	}

}