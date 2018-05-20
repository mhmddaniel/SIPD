<?php
class M_profil_berkala extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
///////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai($idd){
		$sqlstr="SELECT a.*,b.agama,b.gender	FROM r_pegawai_aktual a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) WHERE a.id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		
		$iniDik = $this->ini_pegawai_pendidikan($idd);
		$pend = end($iniDik);
		@$hslquery->nama_pendidikan = $pend->nama_pendidikan;

		return $hslquery;
	}

	function get_last_agenda()
	{
		$this->db->select_max('no_agenda');
		$query = $this->db->get('r_agenda');

		$no_agenda = $query->row('no_agenda');

		$no_agenda = $no_agenda + 1;

		$this->db->set('no_agenda',$no_agenda);
		$this->db->insert('r_agenda');

		return $no_agenda; 
	}

	function get_last_kgb()
	{
		$this->db->select_max('id_kgb');
		$query = $this->db->get('r_peg_kgb');

		$id_kgb= $query->row('id_kgb');

		return $id_kgb; 
	}

	function get_last_id_agenda()
	{
		$this->db->select_max('id_agenda');
		$query = $this->db->get('r_agenda');

		$id_agenda= $query->row('id_agenda');

		return $id_agenda; 
	}

	function ini_berkala($idd){
		$sqlstr="SELECT a.*,b.agama,b.gender,c.gaji_baru, c.kode_golongan as golongan_lama
		FROM r_pegawai_aktual a LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN (r_peg_kgb c) ON (a.id_pegawai = c.id_pegawai) WHERE a.id_pegawai='$idd' ORDER BY c.gaji_baru DESC";
		$hslquery=$this->db->query($sqlstr)->row();
		
		$iniDik = $this->ini_pegawai_pendidikan($idd);
		$pend = end($iniDik);
		
		$id_agenda = $this->get_last_id_agenda() + 1;

		@$hslquery->nama_pendidikan = $pend->nama_pendidikan;

		$no_sk = "822.".floor($hslquery->kode_golongan/10)."/".$id_agenda."/BKPSDM.III/".date('Y');
		@$hslquery->no_sk = $no_sk;


		return $hslquery;
	}

	function get_pejabat($nama_jabatan)
	{
		$sqlstr="SELECT b.gelar_depan,b.nama_pegawai,b.gelar_belakang, b.nip_baru, b.nama_pangkat,c.nama_jabatan, c.id_jabatan
		FROM r_pegawai_aktual b 
		JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai )
		WHERE nama_jabatan = '$nama_jabatan' 
		ORDER BY id_peg_jab DESC";
		$hslquery=$this->db->query($sqlstr)->row('');
		return $hslquery;

	}

	function get_eselon($unor)
	{
		$sqlstr="SELECT b.gelar_depan,b.nama_pegawai,b.gelar_belakang, b.nip_baru, b.nama_pangkat,c.nama_jabatan, c.id_jabatan, c.kode_unor
		FROM r_pegawai_aktual b 
		JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai )
		WHERE c.kode_ese = '22' AND c.kode_unor = '$unor' 
		ORDER BY id_peg_jab DESC";
		$hslquery=$this->db->query($sqlstr)->row('');
		return $hslquery;

	}

	function cek_eselon($unor)
	{
		$sqlstr="SELECT c.kode_unor
		FROM r_pegawai_aktual b 
		JOIN r_peg_jab c ON (b.id_pegawai=c.id_pegawai AND c.kode_ese = '22' AND c.kode_unor = '$unor')";
		$hslquery=$this->db->query($sqlstr)->row('');
		return $hslquery;
	}

	function ini_berkala_lanjutan($var){

		$idd = $var['id_pegawai'];
		$no_sk = $var['no_sk'];
		$mk_gol_tahun = $var['mk_gol_tahun'];
		$mk_gol_bulan = $var['mk_gol_bulan'];
		$tmt_gaji = $var['tmt_gaji'];

		$sqlstr="SELECT a.*,b.agama,b.gender, 
		c.tmt_cpns, d.tanggal_sk,d.tmt_gaji,d.no_sk,d.oleh_pejabat,d.kode_golongan as kode_golongan_lama,  d.mk_gol_tahun, d.mk_gol_bulan,d.gaji_baru, e.masa_jabatan, e.gaji_pokok, f.kode_unor as unor

		FROM r_pegawai_aktual a
		LEFT JOIN r_pegawai b ON (a.id_pegawai=b.id_pegawai) 
		LEFT JOIN (r_peg_cpns c) ON (a.id_pegawai = c.id_pegawai)
		LEFT JOIN (r_peg_kgb d) ON (a.id_pegawai = d.id_pegawai)
		LEFT JOIN (r_berkala e) ON (a.kode_golongan=e.kode_golongan)
		LEFT JOIN (r_peg_jab f) ON (a.id_pegawai=f.id_pegawai)
		WHERE a.id_pegawai='$idd' and e.masa_jabatan = '$mk_gol_tahun' ORDER BY d.gaji_baru DESC";
		$hslquery=$this->db->query($sqlstr)->row();

		$iniDik = $this->ini_pegawai_pendidikan($idd);
		$pend = end($iniDik);
		@$hslquery->nama_pendidikan = $pend->nama_pendidikan;
		
		$no_agenda = $this->get_last_agenda();
		@$hslquery->no_agenda = $no_agenda;



		$masa_jabatan_tahun = $mk_gol_tahun;
		@$hslquery->masa_jabatan_tahun = $masa_jabatan_tahun;
		$masa_jabatan_bulan = $newbln;
		@$hslquery->masa_jabatan_bulan = $masa_jabatan_bulan;

		
		$sass = $this->session->userdata('logged_in');
		@$hslquery->nama_user = $sass['nama_user'];

		$unor = substr(@$hslquery->unor, 0, 5);
		$ese = $this->cek_eselon($unor);



		if(@$hslquery->kode_golongan>0 && @$hslquery->kode_golongan<30)
		{
			if($ese->kode_unor!=NULL && $ese->kode_unor!='03.04')
			{
				$pejabat = $this->get_eselon($unor);
			}	
			else
			{
				$pejabat = $this->get_pejabat('Kepala Bidang Pengembangan Dan Kepangkatan');
			}
		}
		if(@$hslquery->kode_golongan>=30 && @$hslquery->kode_golongan<40)
		{
			$pejabat = $this->get_pejabat('Kepala Bidang Pengembangan Dan Kepangkatan');	
		}

		if(@$hslquery->kode_golongan>40 && @$hslquery->kode_golongan<=42)
		{
			$pejabat = $this->get_pejabat('Kepala Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia');
		}
		else if(@$hslquery->kode_golongan>42)
		{

			$pejabat = $this->get_pejabat('Sekretaris Daerah');
		}

		@$hslquery->nama_pejabat = str_replace("-","",$pejabat->gelar_depan)." ". $pejabat->nama_pegawai .", ". $pejabat->gelar_belakang;
		@$hslquery->nip_pejabat = $pejabat->nip_baru;
		@$hslquery->pangkat_pejabat = strtoupper($pejabat->nama_pangkat);
		@$hslquery->jabatan_pejabat = strtoupper($pejabat->nama_jabatan);
		if(@$hslquery->kode_golongan>=30 && @$hslquery->kode_golongan<40)
		{
			
			@$hslquery->jabatan_pejabat = "KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA <br /> u.b. <br />" .  @$hslquery->jabatan_pejabat;
		}


		$id_agenda = $this->get_last_id_agenda();

		$isi['kode_golongan'] = $hslquery->kode_golongan;
		$isi['mk_gol_tahun'] = $masa_jabatan_tahun;
		$isi['mk_gol_bulan'] = $masa_jabatan_bulan;
		$isi['oleh_pejabat'] = "WALIKOTA PALEMBANG";
		$isi['no_sk'] = $no_sk;
		$isi['tanggal_sk'] = date('d-m-Y');
		$isi['gaji_lama'] = $hslquery->gaji_baru;
		$isi['gaji_baru'] = str_replace(",","",trim($hslquery->gaji_pokok));
		$isi['tmt_gaji'] = $tmt_gaji;
		$isi['id_pegawai'] = $idd;

		$this->kgb_tambah_aksi($isi);


		$id_kgb = $this->get_last_kgb();

		$kgb['id_kgb'] = $id_kgb;
		$kgb['id_pegawai'] = $idd;
		$kgb['id_agenda'] = $id_agenda;
		$kgb['bulan'] = date('m');
		$kgb['tahun'] = date('Y');

		$this->kgb_val_tambah_aksi($kgb);

		return $hslquery;
	}	

	function ini_pegawai_master($idd){
		$this->db->select('*,DATE_FORMAT(tanggal_lahir,\'%d-%m-%Y\') AS tanggal_lahirr',false);
		$this->db->from('r_pegawai');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function akhir_pegawai_bulanan($idPeg){
		$sqlstr="SELECT a.*	FROM r_pegawai_bulanan a WHERE a.id_pegawai='$idPeg' ORDER BY a.id DESC LIMIT 0,1";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_pegawai_r_pegawai_rekap($idd){
		$sqlstr="SELECT a.*	FROM r_pegawai_aktual a WHERE a.id_pegawai='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		
		return $hslquery;
	}
///////////////////////////////////////////////////////////////////////////////////////
	function biodata_edit_aksi($id_pegawai,$data)
	{
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->from('r_pegawai');
		$pegawai = $this->db->get()->row();
		if(!$pegawai){
			$this->db->set('nip',$data['nip']);
			$this->db->insert('r_pegawai');
			$id_pegawai = $this->db->insert_id();

			$this->db->set('id_pegawai',$id_pegawai);
			$this->db->insert('r_pegawai_aktual');
		}
		
		$this->db->set('nip',$data['nip']);
		$this->db->set('nip_baru',$data['nip_baru']);
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('gender',$data['gender']);
		$this->db->set('tempat_lahir',$data['tempat_lahir']);
		$this->db->set('tanggal_lahir',$data['tanggal_lahir']);
		$this->db->set('status_perkawinan',$data['status_perkawinan']);
		$this->db->set('status_kepegawaian',$data['status_kepegawaian']);
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->update('r_pegawai_aktual');

		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('nip',$data['nip']);
		$this->db->set('nip_baru',$data['nip_baru']);
		$this->db->set('gelar_nonakademis',$data['gelar_nonakademis']);
		$this->db->set('nama_pegawai',$data['nama_pegawai']);
		$this->db->set('gelar_depan',$data['gelar_depan']);
		$this->db->set('gelar_belakang',$data['gelar_belakang']);
		$this->db->set('gender',$data['gender']);
		$this->db->set('tempat_lahir',$data['tempat_lahir']);
		$this->db->set('tanggal_lahir',$data['tanggal_lahir']);
		$this->db->set('agama',$data['agama']);
		$this->db->set('status_perkawinan',$data['status_perkawinan']);
		$this->db->set('status_kepegawaian',$data['status_kepegawaian']);
		$this->db->set('nomor_hp',$data['nomor_hp']);
		$this->db->set('nomor_tlp_rumah',$data['nomor_tlp_rumah']);
		$this->db->where('id_pegawai',$id_pegawai);
		return  $this->db->update('r_pegawai');
	}
	function biodata_hapus_aksi($id_pegawai)
	{
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai_aktual');

		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->delete('r_pegawai');
	}
///////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_alamat($idd){
		$this->db->from('r_peg_alamat');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function alamat_edit_aksi($id_pegawai,$data)
	{
		$this->db->where('id_pegawai',$id_pegawai);
		$alamat = $this->db->from('r_peg_alamat')->get()->row();
		if(! $alamat){
			$this->db->set('id_pegawai',$id_pegawai);
			$this->db->insert('r_peg_alamat');
		}
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('jalan',$data['jalan']);
		$this->db->set('rt',$data['rt']);
		$this->db->set('rw',$data['rw']);
		$this->db->set('kel_desa',$data['kel_desa']);
		$this->db->set('kecamatan',$data['kecamatan']);
		$this->db->set('kab_kota',$data['kab_kota']);
		$this->db->set('propinsi',$data['propinsi']);
		$this->db->set('kode_pos',$data['kode_pos']);
		$this->db->set('jarak_meter',$data['jarak_meter']);
		$this->db->set('jarak_menit',$data['jarak_menit']);
		$this->db->where('id_pegawai',$id_pegawai);
		$result = $this->db->update('r_peg_alamat');
		return  $result;
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_pernikahan($idd){
		$this->db->from('r_peg_perkawinan');
		$this->db->where('id_pegawai',$idd);
		$this->db->order_by('tanggal_menikah','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_karis_karsu($idd){
		$this->db->from('r_peg_perkawinan');
		$this->db->where('id_peg_perkawinan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function karis_karsu_tambah_aksi($isi){
		$this->db->set('nama_suris',$isi['nama_suris']);
		$this->db->set('tempat_lahir_suris',$isi['tempat_lahir_suris']);
		$this->db->set('tanggal_lahir_suris',$isi['tanggal_lahir_suris']);
		$this->db->set('tanggal_menikah',$isi['tanggal_menikah']);
		$this->db->set('pekerjaan_suris',$isi['pekerjaan_suris']);
		$this->db->set('pendidikan_suris',$isi['pendidikan_suris']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_perkawinan');
	}
	function karis_karsu_edit_aksi($isi){
		$this->db->set('nama_suris',$isi['nama_suris']);
		$this->db->set('tempat_lahir_suris',$isi['tempat_lahir_suris']);
		$this->db->set('tanggal_lahir_suris',$isi['tanggal_lahir_suris']);
		$this->db->set('tanggal_menikah',$isi['tanggal_menikah']);
		$this->db->set('pekerjaan_suris',$isi['pekerjaan_suris']);
		$this->db->set('pendidikan_suris',$isi['pendidikan_suris']);
		$this->db->where('id_peg_perkawinan',$isi['id_peg_perkawinan']);
		$this->db->update('r_peg_perkawinan');
	}
	function karis_karsu_hapus_aksi($isi){
		$this->db->where('id_peg_perkawinan',$isi['id_peg_perkawinan']);
		$this->db->delete('r_peg_perkawinan');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function get_karpeg($idd){
		$this->db->from('r_peg_karpeg');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_karpeg($idd){
		$this->db->from('r_peg_karpeg');
		$this->db->where('id_karpeg',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function karpeg_input_aksi($isi){
		$this->db->set('karpeg_nomor',$isi['karpeg_nomor']);
		$this->db->set('karpeg_tanggal',$isi['karpeg_tanggal']);
		$this->db->set('karpeg_pejabat',$isi['karpeg_pejabat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_karpeg');
	}
	function karpeg_edit_aksi($isi){
		$this->db->set('karpeg_nomor',$isi['karpeg_nomor']);
		$this->db->set('karpeg_tanggal',$isi['karpeg_tanggal']);
		$this->db->set('karpeg_pejabat',$isi['karpeg_pejabat']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_karpeg');
	}
	function get_taspen($idd){
		$this->db->from('r_peg_taspen');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_taspen($idd){
		$this->db->from('r_peg_taspen');
		$this->db->where('id_taspen',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function taspen_input_aksi($isi){
		$this->db->set('taspen_nomor',$isi['taspen_nomor']);
		$this->db->set('taspen_tanggal',$isi['taspen_tanggal']);
		$this->db->set('taspen_pejabat',$isi['taspen_pejabat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_taspen');
	}
	function taspen_edit_aksi($isi){
		$this->db->set('taspen_nomor',$isi['taspen_nomor']);
		$this->db->set('taspen_tanggal',$isi['taspen_tanggal']);
		$this->db->set('taspen_pejabat',$isi['taspen_pejabat']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_taspen');
	}

	function get_pupns($idd){
		$this->db->select('*,DATE_FORMAT(pupns_tanggal,\'%d-%m-%Y\') AS pupns_tanggall',false);
		$this->db->from('r_peg_pupns');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_pupns($idd){
		$this->db->from('r_peg_pupns');
		$this->db->where('id_pupns',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pupns_input_aksi($isi){
		$this->db->set('pupns_nomor',$isi['pupns_nomor']);
		$this->db->set('pupns_tanggal',$isi['pupns_tanggal']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_pupns');
	}
	function pupns_edit_aksi($isi){
		$this->db->set('pupns_nomor',$isi['pupns_nomor']);
		$this->db->set('pupns_tanggal',$isi['pupns_tanggal']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_pupns');
	}
	/// pertek ///
	function get_pertek($idd){
		$this->db->select('*,DATE_FORMAT(pertek_tanggal,\'%d-%m-%Y\') AS pertek_tanggall',false);
		$this->db->from('r_peg_pertek');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_pertek($idd){
		$this->db->from('r_peg_pertek');
		$this->db->where('id_pertek',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pertek_input_aksi($isi){
		$this->db->set('pertek_nomor',$isi['pertek_nomor']);
		$this->db->set('pertek_tanggal',$isi['pertek_tanggal']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_pertek');
	}
	function pertek_edit_aksi($isi){
		$this->db->set('pertek_nomor',$isi['pertek_nomor']);
		$this->db->set('pertek_tanggal',$isi['pertek_tanggal']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_pertek');
	}
	//// end-pertek ////
	function get_ibel($idd){
		$this->db->from('r_peg_ibel');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_ibel_sekolah($idd){
		$this->db->from('r_peg_ibel_sekolah');
		$this->db->where('id_ibel',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_ibel($idd){
		$sqlstr="SELECT a.*,b.*	FROM r_peg_ibel a LEFT JOIN r_peg_ibel_sekolah b ON (a.id_ibel=b.id_ibel) WHERE a.id_ibel='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_tubel($idd){
		$sqlstr="SELECT a.*,b.*	FROM r_peg_tubel a LEFT JOIN r_peg_tubel_sekolah b ON (a.id_tubel=b.id_tubel) WHERE a.id_tubel='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function get_konversi_nip($idd){
		$this->db->select('*,DATE_FORMAT(konversi_nip_tanggal,\'%d-%m-%Y\') AS konversi_nip_tanggall',false);
		$this->db->from('r_peg_konversi_nip');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_konversi_nip($idd){
		$this->db->from('r_peg_konversi_nip');
		$this->db->where('id_konversi_nip',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function konversi_nip_input_aksi($isi){
		$this->db->set('konversi_nip_nomor',$isi['konversi_nip_nomor']);
		$this->db->set('konversi_nip_tanggal',$isi['konversi_nip_tanggal']);
		$this->db->set('konversi_nip_pejabat',$isi['konversi_nip_pejabat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_konversi_nip');
	}
	function konversi_nip_edit_aksi($isi){
		$this->db->set('konversi_nip_nomor',$isi['konversi_nip_nomor']);
		$this->db->set('konversi_nip_tanggal',$isi['konversi_nip_tanggal']);
		$this->db->set('konversi_nip_pejabat',$isi['konversi_nip_pejabat']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_konversi_nip');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_anak($idd){
		$this->db->from('r_peg_anak');
		$this->db->where('id_pegawai',$idd);
		$this->db->order_by('tanggal_lahir_anak','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_anak($idd){
		$this->db->from('r_peg_anak');
		$this->db->where('id_peg_anak',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function anak_tambah_aksi($isi){
		$this->db->set('nama_anak',$isi['nama_anak']);
		$this->db->set('tempat_lahir_anak',$isi['tempat_lahir_anak']);
		$this->db->set('tanggal_lahir_anak',$isi['tanggal_lahir_anak']);
		$this->db->set('gender_anak',$isi['gender_anak']);
		$this->db->set('pendidikan_anak',$isi['pendidikan_anak']);
		$this->db->set('pekerjaan_anak',$isi['pekerjaan_anak']);
		$this->db->set('status_anak',$isi['status_anak']);
		$this->db->set('keterangan_tunjangan',$isi['keterangan_tunjangan']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_anak');
	}
	function anak_edit_aksi($isi){
		$this->db->set('nama_anak',$isi['nama_anak']);
		$this->db->set('tempat_lahir_anak',$isi['tempat_lahir_anak']);
		$this->db->set('tanggal_lahir_anak',$isi['tanggal_lahir_anak']);
		$this->db->set('gender_anak',$isi['gender_anak']);
		$this->db->set('pendidikan_anak',$isi['pendidikan_anak']);
		$this->db->set('pekerjaan_anak',$isi['pekerjaan_anak']);
		$this->db->set('status_anak',$isi['status_anak']);
		$this->db->set('keterangan_tunjangan',$isi['keterangan_tunjangan']);
		$this->db->where('id_peg_anak',$isi['id_peg_anak']);
		$this->db->update('r_peg_anak');
	}

	function anak_hapus_aksi($isi){
		$this->db->where('id_peg_anak',$isi['id_peg_anak']);
		$this->db->delete('r_peg_anak');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
	function get_sertifikat_prajab($idd){
		$this->db->select('*,DATE_FORMAT(tanggal_sttpl,\'%d-%m-%Y\') AS tanggal_sttpll',false);
		$this->db->from('r_peg_diklat_struk');
		$this->db->where('id_rumpun','5');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_sertifikat_prajab($idd){
		$this->db->from('r_peg_diklat_struk');
		$this->db->where('id_rumpun','5');
		$this->db->where('id_peg_diklat_struk',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function sertifikat_prajab_input_aksi($isi){
		$this->db->set('nama_diklat',$isi['nama_diklat']);
		$this->db->set('tempat_diklat',$isi['tempat_diklat']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('angkatan',$isi['angkatan']);
		$this->db->set('nomor_sttpl',$isi['nomor_sttpl']);
		$this->db->set('tanggal_sttpl',$isi['tanggal_sttpl']);
		$this->db->set('tmt_diklat',$isi['tmt_diklat']);
		$this->db->set('tst_diklat',$isi['tst_diklat']);
		$this->db->set('jam',$isi['jam']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('id_rumpun','5');
		$this->db->insert('r_peg_diklat_struk');
	}
	function sertifikat_prajab_edit_aksi($isi){
		$this->db->set('nama_diklat',$isi['nama_diklat']);
		$this->db->set('tempat_diklat',$isi['tempat_diklat']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('angkatan',$isi['angkatan']);
		$this->db->set('nomor_sttpl',$isi['nomor_sttpl']);
		$this->db->set('tanggal_sttpl',$isi['tanggal_sttpl']);
		$this->db->set('tmt_diklat',$isi['tmt_diklat']);
		$this->db->set('tst_diklat',$isi['tst_diklat']);
		$this->db->set('jam',$isi['jam']);
		$this->db->set('id_rumpun','5');
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_diklat_struk');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_cpns($idd){
		$this->db->select('*,DATE_FORMAT(tmt_cpns,\'%d-%m-%Y\') AS tmt_cpnss,DATE_FORMAT(sk_cpns_tgl,\'%d-%m-%Y\') AS sk_cpns_tgll',false);
		$this->db->from('r_peg_cpns');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function sk_cpns_input_aksi($isi){
		$this->db->set('tmt_cpns',$isi['tmt_cpns']);
		$this->db->set('sk_cpns_nomor',$isi['sk_cpns_nomor']);
		$this->db->set('sk_cpns_tgl',$isi['sk_cpns_tgl']);
		$this->db->set('sk_cpns_pejabat',$isi['sk_cpns_pejabat']);
		$this->db->set('mk_th',$isi['mk_th']);
		$this->db->set('mk_bl',$isi['mk_bl']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_cpns');

		$this->db->set('tmt_cpns',$isi['tmt_cpns']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');
	}
	function sk_cpns_edit_aksi($isi){
		$this->db->set('tmt_cpns',$isi['tmt_cpns']);
		$this->db->set('sk_cpns_nomor',$isi['sk_cpns_nomor']);
		$this->db->set('sk_cpns_tgl',$isi['sk_cpns_tgl']);
		$this->db->set('sk_cpns_pejabat',$isi['sk_cpns_pejabat']);
		$this->db->set('mk_th',$isi['mk_th']);
		$this->db->set('mk_bl',$isi['mk_bl']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_cpns');

		$this->db->set('tmt_cpns',$isi['tmt_cpns']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');
	}
///////////////////////////////////////////////////////////////////////////////////////
	function ini_pns($idd){
		$this->db->select('*,DATE_FORMAT(tmt_pns,\'%d-%m-%Y\') AS tmt_pnss,DATE_FORMAT(sk_pns_tanggal,\'%d-%m-%Y\') AS sk_pns_tanggall',false);
		$this->db->from('r_peg_pns');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_pns_id($idd){
		$this->db->from('r_peg_pns');
		$this->db->where('id',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function sk_pns_input_aksi($isi){
		$this->db->set('tmt_pns',$isi['tmt_pns']);
		$this->db->set('sk_pns_nomor',$isi['sk_pns_nomor']);
		$this->db->set('sk_pns_tanggal',$isi['sk_pns_tanggal']);
		$this->db->set('sk_pns_pejabat',$isi['sk_pns_pejabat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_pns');

		$this->db->set('tmt_pns',$isi['tmt_pns']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');
	}
	function sk_pns_edit_aksi($isi){
		$this->db->set('tmt_pns',$isi['tmt_pns']);
		$this->db->set('sk_pns_nomor',$isi['sk_pns_nomor']);
		$this->db->set('sk_pns_tanggal',$isi['sk_pns_tanggal']);
		$this->db->set('sk_pns_pejabat',$isi['sk_pns_pejabat']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_peg_pns');

		$this->db->set('tmt_pns',$isi['tmt_pns']);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_riwayat_pendidikan($id_peg){
		$sqlstr="SELECT a.*,EXTRACT(YEAR FROM a.tanggal_lulus) AS tahun_lulus	FROM r_peg_pendidikan a WHERE  a.id_pegawai = '$id_peg'
		ORDER BY a.tanggal_lulus ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_riwayat_pendidikan($idd){
		$this->db->from('r_peg_pendidikan');
		$this->db->where('id_peg_pendidikan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pendidikan_riwayat_tambah_aksi($isi){
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('id_pendidikan',$isi['id_pendidikan']);
		$this->db->set('kode_jenjang',$isi['kode_jenjang']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->set('nama_pendidikan',$isi['nama_pendidikan']);
		$this->db->set('nama_jenjang_rumpun',$isi['nama_jenjang_rumpun']);
		$this->db->set('nama_sekolah',$isi['nama_sekolah']);
		$this->db->set('lokasi_sekolah',$isi['lokasi_sekolah']);
		$this->db->set('tanggal_lulus',$isi['tanggal_lulus']);
		$this->db->set('nomor_ijazah',$isi['nomor_ijazah']);
		$this->db->set('gelar_depan',$isi['gelar_depan']);
		$this->db->set('gelar_belakang',$isi['gelar_belakang']);
		if(isset($isi['diakui'])){$this->db->set('diakui',$isi['diakui']);} else {$this->db->set('diakui',"X");}
		if(isset($isi['pendidikan_pertama'])){$this->db->set('pendidikan_pertama',$isi['pendidikan_pertama']);} else {$this->db->set('pendidikan_pertama','X');}
		$this->db->insert('r_peg_pendidikan');

		$riwayat = $this->get_riwayat_pendidikan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->set('nama_jenjang_rumpun',$jab->nama_jenjang_rumpun);
		$this->db->set('tanggal_lulus',$jab->tanggal_lulus);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function pendidikan_riwayat_edit_aksi($isi){
		$this->db->where('id_peg_pendidikan',$isi['id_peg_pendidikan']);
		$this->db->set('id_pendidikan',$isi['id_pendidikan']);
		$this->db->set('kode_jenjang',$isi['kode_jenjang']);
		$this->db->set('nama_jenjang',$isi['nama_jenjang']);
		$this->db->set('nama_pendidikan',$isi['nama_pendidikan']);
		$this->db->set('nama_jenjang_rumpun',$isi['nama_jenjang_rumpun']);
		$this->db->set('nama_sekolah',$isi['nama_sekolah']);
		$this->db->set('lokasi_sekolah',$isi['lokasi_sekolah']);
		$this->db->set('tanggal_lulus',$isi['tanggal_lulus']);
		$this->db->set('nomor_ijazah',$isi['nomor_ijazah']);
		$this->db->set('gelar_depan',$isi['gelar_depan']);
		$this->db->set('gelar_belakang',$isi['gelar_belakang']);
		if(isset($isi['diakui'])){$this->db->set('diakui',$isi['diakui']);} else {$this->db->set('diakui',"X");}
		if(isset($isi['pendidikan_pertama'])){$this->db->set('pendidikan_pertama',$isi['pendidikan_pertama']);} else {$this->db->set('pendidikan_pertama','X');}
		$this->db->update('r_peg_pendidikan');

		$riwayat = $this->get_riwayat_pendidikan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->set('nama_jenjang_rumpun',$jab->nama_jenjang_rumpun);
		$this->db->set('tanggal_lulus',$jab->tanggal_lulus);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function pendidikan_riwayat_hapus_aksi($isi){
		$this->db->where('id_peg_pendidikan',$isi['id_peg_pendidikan']);
		$this->db->delete('r_peg_pendidikan');

		$riwayat = $this->get_riwayat_pendidikan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->set('nama_jenjang_rumpun',$jab->nama_jenjang_rumpun);
		$this->db->set('tanggal_lulus',$jab->tanggal_lulus);
		$this->db->where('id_pegawai',$isi['id_pegawai']);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('nama_jenjang',$jab->nama_jenjang);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function ini_pegawai_pendidikan($idd){
		$sqlstr="SELECT a.*,DATE_FORMAT(a.tanggal_lulus,'%d-%m-%Y') AS tangga,EXTRACT(YEAR FROM a.tanggal_lulus) AS tahun_lulus	
		FROM r_peg_pendidikan a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tanggal_lulus ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_kursus($idd){
		$sqlstr="SELECT a.*	FROM r_peg_kursus a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tanggal_sertifikat ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_sertifikat_kursus($idd){
		$this->db->from('r_peg_kursus');
		$this->db->where('id_peg_kursus',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function kursus_tambah_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('r_peg_kursus');
	}
	function kursus_edit_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_peg_kursus',$isi['id_peg_kursus']);
		$this->db->update('r_peg_kursus');
	}
	function kursus_hapus_aksi($isi){
		$this->db->where('id_peg_kursus',$isi['id_peg_kursus']);
		$this->db->delete('r_peg_kursus');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function get_ujian_dinas($idd){
		$sqlstr="SELECT a.*	FROM r_peg_ujian_dinas a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tanggal_sertifikat ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_ujian_dinas($idd){
		$this->db->from('r_peg_ujian_dinas');
		$this->db->where('id_peg_ujian_dinas',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ujian_dinas_tambah_aksi($isi){
		$this->db->set('nama_ujian_dinas',$isi['nama_ujian_dinas']);
		$this->db->set('tempat_ujian_dinas',$isi['tempat_ujian_dinas']);
		$this->db->set('tanggal_ujian_dinas',$isi['tanggal_ujian_dinas']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('id_udin',$isi['id_udin']);
		$this->db->insert('r_peg_ujian_dinas');
	}
	function ujian_dinas_edit_aksi($isi){
		$this->db->set('nama_ujian_dinas',$isi['nama_ujian_dinas']);
		$this->db->set('tempat_ujian_dinas',$isi['tempat_ujian_dinas']);
		$this->db->set('tanggal_ujian_dinas',$isi['tanggal_ujian_dinas']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->where('id_peg_ujian_dinas',$isi['id_peg_ujian_dinas']);
		$this->db->update('r_peg_ujian_dinas');
	}
	function ujian_dinas_hapus_aksi($isi){
		$udin = $this->ini_ujian_dinas($isi['id_peg_ujian_dinas']);

		$this->db->where('id_peg_ujian_dinas',$isi['id_peg_ujian_dinas']);
		$this->db->delete('r_peg_ujian_dinas');

		$this->db->where('id_udin',$udin->id_udin);
		$this->db->delete('r_peg_ujian_dinas_aju');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function get_penyesuaian_ijazah($idd){
		$sqlstr="SELECT a.*	FROM r_peg_penyesuaian_ijazah a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tanggal_sertifikat ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_penyesuaian_ijazah($idd){
		$this->db->from('r_peg_penyesuaian_ijazah');
		$this->db->where('id_peg_penyesuaian_ijazah',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function penyesuaian_ijazah_tambah_aksi($isi){
		$this->db->set('nama_penyesuaian_ijazah',$isi['nama_penyesuaian_ijazah']);
		$this->db->set('tempat_penyesuaian_ijazah',$isi['tempat_penyesuaian_ijazah']);
		$this->db->set('tanggal_penyesuaian_ijazah',$isi['tanggal_penyesuaian_ijazah']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('id_pi',$isi['id_pi']);
		$this->db->insert('r_peg_penyesuaian_ijazah');
	}
	function penyesuaian_ijazah_edit_aksi($isi){
		$this->db->set('nama_penyesuaian_ijazah',$isi['nama_penyesuaian_ijazah']);
		$this->db->set('tempat_penyesuaian_ijazah',$isi['tempat_penyesuaian_ijazah']);
		$this->db->set('tanggal_penyesuaian_ijazah',$isi['tanggal_penyesuaian_ijazah']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->where('id_peg_penyesuaian_ijazah',$isi['id_peg_penyesuaian_ijazah']);
		$this->db->update('r_peg_penyesuaian_ijazah');
	}
	function penyesuaian_ijazah_hapus_aksi($isi){
		$pi = $this->ini_penyesuaian_ijazah($isi['id_peg_penyesuaian_ijazah']);

		$this->db->where('id_peg_penyesuaian_ijazah',$isi['id_peg_penyesuaian_ijazah']);
		$this->db->delete('r_peg_penyesuaian_ijazah');

		$this->db->where('id_pi',$pi->id_pi);
		$this->db->delete('r_peg_penyesuaian_ijazah_aju');
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_pangkat($idd){
		$this->db->select('*,DATE_FORMAT(tmt_golongan,\'%d-%m-%Y\') AS tangga',false);
		$this->db->select('DATE_FORMAT(sk_tanggal,\'%d-%m-%Y\') AS sk_tangga',false);
		$this->db->from('r_peg_golongan');
		$this->db->where('id_pegawai',$idd);
		$this->db->order_by('tmt_golongan','asc');
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function ini_pangkat_riwayat($idd){
		$this->db->from('r_peg_golongan');
		$this->db->where('id_peg_golongan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pangkat_riwayat_tambah_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->set('last_updated',"NOW()",false);
		$this->db->insert('r_peg_golongan');
		
		$riwayat = $this->ini_pegawai_pangkat($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->set('nama_golongan',$jab->nama_golongan);
		$this->db->set('nama_pangkat',$jab->nama_pangkat);
		$this->db->set('mk_gol_tahun',$jab->mk_gol_tahun);
		$this->db->set('mk_gol_bulan',$jab->mk_gol_bulan);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function pangkat_riwayat_edit_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_peg_golongan',$isi['id_peg_golongan']);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->update('r_peg_golongan');
		
		$riwayat = $this->ini_pegawai_pangkat($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->set('nama_golongan',$jab->nama_golongan);
		$this->db->set('nama_pangkat',$jab->nama_pangkat);
		$this->db->set('mk_gol_tahun',$jab->mk_gol_tahun);
		$this->db->set('mk_gol_bulan',$jab->mk_gol_bulan);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function pangkat_riwayat_hapus_aksi($isi){
		$this->db->where('id_peg_golongan',$isi['id_peg_golongan']);
		$this->db->delete('r_peg_golongan');
		
		$riwayat = $this->ini_pegawai_pangkat($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->set('nama_golongan',$jab->nama_golongan);
		$this->db->set('nama_pangkat',$jab->nama_pangkat);
		$this->db->set('mk_gol_tahun',$jab->mk_gol_tahun);
		$this->db->set('mk_gol_bulan',$jab->mk_gol_bulan);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('tmt_pangkat',$jab->tmt_golongan);
		$this->db->set('kode_golongan',$jab->kode_golongan);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function ini_pegawai_jabatan($idd){
		$sql = "SELECT a.*,DATE_FORMAT(a.sk_tanggal,'%d-%m-%Y') AS sk_tanggall,DATE_FORMAT(a.tmt_jabatan,'%d-%m-%Y') AS tmt_jabatann,b.nip_baru,c.tingkat,c.nama_jenjang
		FROM r_peg_jab a 
		LEFT JOIN (r_pegawai b) ON (a.id_pegawai=b.id_pegawai)
		LEFT JOIN (m_jft_jenjang c) ON (a.id_jenjang_jabatan=c.id_jenjang_jabatan)
		WHERE a.id_pegawai='$idd' ORDER BY a.tmt_jabatan ASC";
		$hslquery = $this->db->query($sql)->result();
		return $hslquery;
	}
	function ini_jabatan_riwayat($idd){
		$sqlstr="SELECT a.*,c.tingkat,c.nama_jenjang	FROM r_peg_jab a
		LEFT JOIN (m_jft_jenjang c) ON (a.id_jenjang_jabatan=c.id_jenjang_jabatan)
		WHERE  a.id_peg_jab = '$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function jabatan_riwayat_tambah_aksi($isi){
		$sess = $this->session->userdata('logged_in');
		$uid = $sess['id_user'];

		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('user_id',$uid);
		$this->db->insert('r_peg_jab');
		
		$riwayat = $this->ini_pegawai_jabatan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('nama_unor',$jab->nama_unor);
		$this->db->set('nomenklatur_pada',$jab->nomenklatur_pada);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		$this->db->set('nama_ese',$jab->nama_ese);
		$this->db->set('tugas_tambahan',$jab->tugas_tambahan);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		$this->db->set('tmt_ese',$jab->tmt_ese);
		$this->db->set('tugas_tambahan',$jab->tugas_tambahan);
		$this->db->set('reff_jabatan',$jab->id_peg_jab);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function jabatan_riwayat_edit_aksi($isi){
		$sess = $this->session->userdata('logged_in');
		$uid = $sess['id_user'];
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_peg_jab',$isi['id_peg_jab']);
		$this->db->set('last_updated',"NOW()",false);
		$this->db->set('user_id',$uid);
		$this->db->update('r_peg_jab');
		
		$riwayat = $this->ini_pegawai_jabatan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('nama_unor',$jab->nama_unor);
		$this->db->set('nomenklatur_pada',$jab->nomenklatur_pada);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		$this->db->set('nama_ese',$jab->nama_ese);
		$this->db->set('tugas_tambahan',$jab->tugas_tambahan);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		if($isi['kode_ese']<$pegAkhir->kode_ese){
			$this->db->set('tmt_ese',$isi['tmt_jabatan']);
		} else {
			$this->db->set('tmt_ese',$pegAkhir->tmt_ese);
		}
		$this->db->set('tugas_tambahan',$jab->tugas_tambahan);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
	function jabatan_riwayat_hapus_aksi($isi){
		$this->db->where('id_peg_jab',$isi['id_peg_jab']);
		$this->db->delete('r_peg_jab');
		
		$riwayat = $this->ini_pegawai_jabatan($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('nama_unor',$jab->nama_unor);
		$this->db->set('nomenklatur_pada',$jab->nomenklatur_pada);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		$this->db->set('nama_ese',$jab->nama_ese);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');

		$pegAkhir = $this->akhir_pegawai_bulanan($isi['id_pegawai']);
		$this->db->set('id_unor',$jab->id_unor);
		$this->db->set('kode_unor',$jab->kode_unor);
		$this->db->set('jab_type',$jab->nama_jenis_jabatan);
		$this->db->set('id_jenjang_jabatan',$jab->id_jenjang_jabatan);
		$this->db->set('tmt_jabatan',$jab->tmt_jabatan);
		$this->db->set('nomenklatur_jabatan',$jab->nama_jabatan);
		$this->db->set('kode_ese',$jab->kode_ese);
		$this->db->set('tugas_tambahan',$jab->tugas_tambahan);
		$this->db->where('id',$pegAkhir->id);
		$this->db->update('r_pegawai_bulanan');
	}
////////////////////////////////////////////////////////////////////////////////////////////////
	function get_sertifikat_penghargaan($idd){
		$sqlstr="SELECT a.*	FROM r_peg_penghargaan a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tanggal_sertifikat ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_sertifikat_penghargaan($idd){
		$this->db->from('r_peg_penghargaan');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function riwayat_sertifikat_penghargaan($idd){
		$this->db->from('r_peg_penghargaan');
		$this->db->where('id_peg_penghargaan',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function penghargaan_tambah_aksi($isi){
		$this->db->set('nama_penghargaan',$isi['nama_penghargaan']);
		$this->db->set('tempat_penghargaan',$isi['tempat_penghargaan']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('angkatan',$isi['angkatan']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_penghargaan');
	}
	function penghargaan_edit_aksi($isi){
		$this->db->set('nama_penghargaan',$isi['nama_penghargaan']);
		$this->db->set('tempat_penghargaan',$isi['tempat_penghargaan']);
		$this->db->set('penyelenggara',$isi['penyelenggara']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('angkatan',$isi['angkatan']);
		$this->db->set('nomor_sertifikat',$isi['nomor_sertifikat']);
		$this->db->set('tanggal_sertifikat',$isi['tanggal_sertifikat']);
		$this->db->where('id_peg_penghargaan',$isi['id_peg_penghargaan']);
		$this->db->update('r_peg_penghargaan');
	}
	function penghargaan_hapus_aksi($isi){
		$this->db->where('id_peg_penghargaan',$isi['id_peg_penghargaan']);
		$this->db->delete('r_peg_penghargaan');
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_pak($idd){
		$sqlstr="SELECT a.*	FROM r_peg_pak a WHERE  a.id_pegawai = '$idd' ORDER BY a.tahun ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_pak($idd){
		$this->db->from('r_peg_pak');
		$this->db->where('id_pak',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function pak_tambah_aksi($isi){
		$bulan = ($isi['bulan']=="")?1:$isi['bulan'];
		$this->db->set('penilai_nama_pegawai',$isi['penilai_nama_pegawai']);
		$this->db->set('ak',$isi['ak']);
		$this->db->set('ak_kumulatif',$isi['ak_kumulatif']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('bulan',$bulan);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_pak');
	}
	function pak_edit_aksi($isi){
		$bulan = ($isi['bulan']=="")?1:$isi['bulan'];
		$this->db->set('penilai_nama_pegawai',$isi['penilai_nama_pegawai']);
		$this->db->set('ak',$isi['ak']);
		$this->db->set('ak_kumulatif',$isi['ak_kumulatif']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('bulan',$bulan);
		$this->db->where('id_pak',$isi['id_pak']);
		$this->db->update('r_peg_pak');
	}
	function pak_hapus_aksi($isi){
		$this->db->where('id_pak',$isi['id_pak']);
		$this->db->delete('r_peg_pak');
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_kgb($idd){
		$sqlstr="SELECT a.*	FROM r_peg_kgb a WHERE  a.id_pegawai = '$idd' ORDER BY a.tanggal_sk ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_kgb($idd){
		$this->db->from('r_peg_kgb');
		$this->db->where('id_kgb',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}


	function kgb_tambah_aksi($isi){
		$gaji_lama = str_replace(" ","",trim($isi['gaji_lama']));
		$gaji_baru = str_replace(" ","",trim($isi['gaji_baru']));
		$tanggal_sk = date("Y-m-d", strtotime($isi['tanggal_sk']));
		$tmt_gaji = date("Y-m-d", strtotime($isi['tmt_gaji']));
		$this->db->set('kode_golongan',$isi['kode_golongan']);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('oleh_pejabat',$isi['oleh_pejabat']);
		$this->db->set('no_sk',$isi['no_sk']);
		$this->db->set('tanggal_sk',$tanggal_sk);
		$this->db->set('gaji_lama',$gaji_lama);
		$this->db->set('gaji_baru',$gaji_baru);
		$this->db->set('tmt_gaji',$tmt_gaji);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_kgb');
	}

	function kgb_val_tambah_aksi($isi){

		$this->db->set('id_kgb',$isi['id_kgb']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->set('id_agenda',$isi['id_agenda']);
		$this->db->set('bulan',$isi['bulan']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->insert('r_peg_kgb_val');
	}

	function kgb_edit_aksi($isi){
		$gaji_lama = str_replace(" ","",trim($isi['gaji_lama']));
		$gaji_baru = str_replace(" ","",trim($isi['gaji_baru']));
		$tanggal_sk = date("Y-m-d", strtotime($isi['tanggal_sk']));
		$tmt_gaji = date("Y-m-d", strtotime($isi['tmt_gaji']));
		$this->db->set('kode_golongan',$isi['kode_golongan']);
		$this->db->set('mk_gol_tahun',$isi['mk_gol_tahun']);
		$this->db->set('mk_gol_bulan',$isi['mk_gol_bulan']);
		$this->db->set('oleh_pejabat',$isi['oleh_pejabat']);
		$this->db->set('no_sk',$isi['no_sk']);
		$this->db->set('tanggal_sk',$tanggal_sk);
		$this->db->set('gaji_lama',$gaji_lama);
		$this->db->set('gaji_baru',$gaji_baru);
		$this->db->set('tmt_gaji',$tmt_gaji);
		$this->db->where('id_kgb',$isi['id_kgb']);
		$this->db->update('r_peg_kgb');
	}
	function kgb_hapus_aksi($isi){
		$this->db->where('id_kgb',$isi['id_kgb']);
		$this->db->delete('r_peg_kgb');
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_dp3($idd){
		$sqlstr="SELECT a.*	FROM r_peg_dp3 a WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tahun ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_dp3($idd){
		$this->db->from('r_peg_dp3');
		$this->db->where('id_dp3',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function dp3_tambah_aksi($isi){
		$this->db->set('penilai_nama_pegawai',$isi['penilai_nama_pegawai']);
		$this->db->set('penilai_nip_baru',$isi['penilai_nip_baru']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->set('id_pegawai',$isi['id_pegawai']);
		$this->db->insert('r_peg_dp3');
	}
	function dp3_edit_aksi($isi){
		$this->db->set('penilai_nama_pegawai',$isi['penilai_nama_pegawai']);
		$this->db->set('penilai_nip_baru',$isi['penilai_nip_baru']);
		$this->db->set('tahun',$isi['tahun']);
		$this->db->where('id_dp3',$isi['id_dp3']);
		$this->db->update('r_peg_dp3');
	}
	function dp3_hapus_aksi($isi){
		$this->db->where('id_dp3',$isi['id_dp3']);
		$this->db->delete('r_peg_dp3');
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_skp($idd){
		$sqlstr="SELECT 
		a. *,
		b. `nilai_perilaku`
		FROM `p_skp` a
		LEFT JOIN `p_skp_penilaian_akhir` b
		on a.`id_skp` = b.`id_skp`
		WHERE  a.id_pegawai = '$idd'
		ORDER BY a.tahun ASC, a.bulan_selesai ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_skp($idd){
		$this->db->from('p_skp');
		$this->db->where('id_pegawai',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function riwayat_skp($idd){
		$this->db->from('p_skp');
		$this->db->where('id_skp',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_sertifikat_diklat($idd){
		$sqlstr="SELECT a.*	FROM r_peg_diklat_struk a WHERE  a.id_pegawai = '$idd' AND id_rumpun!='5'
		ORDER BY a.tanggal_sttpl ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_sertifikat_diklat($idd){
		$this->db->from('r_peg_diklat_struk');
		$this->db->where('id_peg_diklat_struk',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function ini_pegawai_diklat_struk($idd){
//		$this->db->select('year(a.tmt_diklat) as tahun,a.*',false);
		$this->db->from('r_peg_diklat_struk a');
		$this->db->order_by('a.tmt_diklat desc');
		$this->db->where('a.id_pegawai',$idd);
		$this->db->where('a.id_rumpun !=',0);
		$data = $this->db->get()->result();
		return $data;
	}
	function ini_diklat_struk_riwayat($idd){
		$this->db->from('r_peg_diklat_struk');
		$this->db->where('id_peg_diklat_struk',$idd);
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}
	function diklat_struk_riwayat_tambah_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->insert('r_peg_diklat_struk');
/*
		$riwayat = $this->ini_pegawai_diklat_struk($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_diklat_struk',$jab->nama_diklat);
		$this->db->set('tanggal_sttpl_diklat_struk',$jab->tanggal_sttpl);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');
*/
	}
	function diklat_struk_riwayat_edit_aksi($isi){
		foreach($isi AS $key=>$val){	$this->db->set($key,$val);	}
		$this->db->where('id_peg_diklat_struk',$isi['id_peg_diklat_struk']);
		$this->db->update('r_peg_diklat_struk');
		
/*
		$riwayat = $this->ini_pegawai_diklat_struk($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_diklat_struk',$jab->nama_diklat);
		$this->db->set('tanggal_sttpl_diklat_struk',$jab->tanggal_sttpl);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');
*/
	}
	function diklat_struk_riwayat_hapus_aksi($isi){
		$this->db->where('id_peg_diklat_struk',$isi['id_peg_diklat_struk']);
		$this->db->delete('r_peg_diklat_struk');
		
/*
		$riwayat = $this->ini_pegawai_diklat_struk($isi['id_pegawai']);
		$jab = end($riwayat);

		$this->db->set('nama_diklat_struk',$jab->nama_diklat);
		$this->db->set('tanggal_sttpl_diklat_struk',$jab->tanggal_sttpl);
		$this->db->where('id_pegawai',$jab->id_pegawai);
		$this->db->update('r_pegawai_aktual');
*/
	}

}
