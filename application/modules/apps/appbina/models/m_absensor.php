<?php
class M_absensor extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_absensor($cari){
		$sqlstr="SELECT COUNT(a.user_id) AS numrows
FROM users a
LEFT JOIN cmf_setting b ON (a.group_id=b.id_item)
WHERE b.nama_item='absensor_unit'
AND (username LIKE '%$cari%' OR nama_user LIKE '%$cari%')
";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}

	function get_absensor($cari,$mulai,$batas){
		$sqlstr="SELECT a.*
FROM users a
LEFT JOIN cmf_setting b ON (a.group_id=b.id_item)
WHERE b.nama_item='absensor_unit'
AND (a.username LIKE '%$cari%' OR a.nama_user LIKE '%$cari%')
ORDER BY a.nama_user ASC
LIMIT $mulai,$batas
";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_user($usn,$idd){
		if($idd!="baru"){	$tb = "AND user_id!='$idd'";	} else {	$tb="";	}
		$sqlstr="SELECT * FROM users WHERE username='$usn' $tb";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function absensor_tambah_aksi($isi){
		$cek = $this->cek_user($isi['username'],"baru");

		$sql = "SELECT id_item FROM cmf_setting WHERE nama_item='absensor_unit'";
		$hsl = $this->db->query($sql)->row();
		
		if(empty($cek)){
			$this->db->set('username',$isi['username']);
			$this->db->set('nama_user',$isi['nama_user']);
			$this->db->set('group_id',$hsl->id_item);
			$this->db->set('passwd',sha1($isi['username']));
			$this->db->set('status','on');
			$this->db->insert('users');
			$user_id = $this->db->insert_id();
	
			$this->db->set('unor_akses',"{}");
			$this->db->set('user_id',$user_id);
			$this->db->insert('user_umpeg');

			$hasil = "sukses";
		} else {
			$hasil = "gagal";
		}
		return $hasil;
	}

	function absensor_edit_aksi($isi){
		$cek = $this->cek_user($isi['username'],$isi['user_id']);
		if(empty($cek)){
			$this->db->set('username',$isi['username']);
			$this->db->set('nama_user',$isi['nama_user']);
			$this->db->set('passwd',sha1($isi['username']));
			$this->db->where('user_id',$isi['user_id']);
			$this->db->update('users');

			$hasil = "sukses";
		} else {
			$hasil = "gagal";
		}
		return $hasil;
	}
	function absensor_hapus_aksi($isi){
		$this->db->where('user_id',$isi['user_id']);
		$this->db->delete('users');

		$this->db->where('user_id',$isi['user_id']);
		$this->db->delete('user_umpeg');

		$hasil = "sukses";
		return $hasil;
	}

	function ini_absensor($idd){
		$this->db->from('users a');
		$this->db->join('user_umpeg b','a.user_id=b.user_id','left');
		$this->db->where('a.user_id',$idd);
		$hslquery = $this->db->get()->row();

		return $hslquery;
	}

	function ganti_password($isi){
        $this->db->set('passwd',sha1($isi['pw1']));
        $this->db->where('user_id',$isi['user_id']);
		$this->db->update('users');
	}
}
