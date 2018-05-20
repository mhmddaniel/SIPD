<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends MX_Controller {

  function __construct(){
	    parent::__construct();
		$this->load->model('appskp/m_skp');
		$this->load->model('appbina/m_cuti');
		$this->load->model('appbina/m_harian');
		date_default_timezone_set('Asia/Jakarta');
  }

  public function pegawai()   {
		$id_pegawai = $this->session->userdata('pegawai_info');
		$data['peg'] = $this->m_skp->get_pegawai($id_pegawai);
		$tkn = $this->m_harian->get_token(date('Y-m-d'),$id_pegawai);
		@$data['token']->token_masuk = $tkn->token_masuk;
		@$data['token']->token_pulang = $tkn->token_pulang;
		
		
			$this->db->select('sisa_cuti');
			$this->db->select('tahun');
			$this->db->where('id_pegawai',$id_pegawai);
			$query = $this->db->get('r_peg_cuti_tahunan');
			
			$row = count($query->row());
			
			if($row==0){
				@$data['sisa_cuti'] = 12;
				$this->db->set('id_pegawai',$id_pegawai);
				$this->db->set('sisa_cuti', 12);
				$this->db->insert('r_peg_cuti_tahunan');
			}
			else{
				
				$tahun = $query->row('tahun');
				$tahun = date("Y",strtotime($tahun));

				if($tahun < date("Y"))
				{
				$tahun_sekarang = date("Y-m-d");
				$this->db->set('id_pegawai',$id_pegawai);
 				$this->db->set('sisa_cuti', 12);
 				$this->db->set('tahun', $tahun_sekarang);
				$this->db->where('id_pegawai',$id_pegawai);
				$this->db->update('r_peg_cuti_tahunan');
				
				
				@$data['sisa_cuti'] = 12;
				}
				else
				{
					
				@$data['sisa_cuti'] = $query->row('sisa_cuti');
					
				}
			}
			
		$hari = $this->dropdowns->hari_konversi();
		$data['hari'] = $hari[date('l')].", ".date('d-m-Y');
		$data['jam'] = date('H:i:s');

		$this->load->view('dashboard/pegawai',$data);
  }

}
?>