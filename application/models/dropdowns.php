<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Dropdowns extends CI_Model {

  public function __construct() 
  {
    parent::__construct();
  }

  function gender($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis Kelamin';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='1' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function agama($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Agama';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='2' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function status_perkawinan($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Status Pernikahan';
    } else {
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='3' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function status_anak($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Status Anak';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='4' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function keterangan_tunjangan($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Keterangan Tunjangan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='5' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }



  function jenis_jabatan($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis Jabatan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='6' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function status_kepegawaian($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='7' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function tugas_tambahan($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Tugas Tambahan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='8' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function jenis_pensiun($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis Pensiun';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='9' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_jenis_pensiun($asRef=false)  {
    if(!$asRef){
      $select [''] = 'Pilih Jenis Pensiun';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='10' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_jenjang_pendidikan($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenjang Pendidikan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='11' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_golongan($asRef=false){
    if(!$asRef){
    $select [''] = 'Pilih Golongan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='12' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_pangkat($asRef=false){
    if(!$asRef){
    $select [''] = 'Pilih Golongan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='13' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_golongan_pangkat($asRef=false){
    if(!$asRef){
    $select [''] = 'Pilih Golongan';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='14' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function kode_jenis_kp($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis KP';
    }else{
      $select [''] = '-';
    }
	$sqlstr = "SELECT kode_reff,nama_reff FROM m_reff WHERE id_setreff='15' ORDER BY urutan";
	$hslquery = $this->db->query($sqlstr)->result();
	foreach($hslquery AS $key=>$val){
		$select[$val->kode_reff] = $val->nama_reff;
	}
    return $select;
  }

  function rumpun_diklat_struk($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis Diklat';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Diklat PIM IV';
    $select [2] = 'Diklat PIM III';
    $select [3] = 'Diklat PIM II';
    $select [4] = 'Diklat PIM I';
    $select [5] = 'Diklat Pra Jabatan';
    
    return $select;
  }

  function rumpun_diklat_struk2($asRef=false){
    if(!$asRef){
      $select [''] = 'Pilih Jenis Diklat';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Diklat PIM IV';
    $select [2] = 'Diklat PIM III';
    $select [3] = 'Diklat PIM II';
    $select [4] = 'Diklat PIM I';
    
    return $select;
  }

  function jenjang_jabatan_guru($asRef=false)
  {
    if(!$asRef){
    $select [''] = 'Pilih Jenjang Jabatan';
    }else{
      $select [''] = '-';
    }
    $select [11] = 'Guru';
    $select [12] = 'Guru';
    $select [13] = 'Guru';
    $select [14] = 'Guru';
    $select [21] = 'Guru';
    $select [22] = 'Guru';
    $select [23] = 'Guru';
    $select [24] = 'Guru';
    $select [31] = 'Guru Pertama';
    $select [32] = 'Guru Pertama';
    $select [33] = 'Guru Muda';
    $select [34] = 'Guru Muda';
    $select [41] = 'Guru Madya';
    $select [42] = 'Guru Madya';
    $select [43] = 'Guru Madya';
    $select [44] = 'Guru Utama';
    $select [45] = 'Guru Utama';
    
    return $select;
  }

  function kedudukan_hukum($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Jenis Kedudukan Hukum';
    }else{
      $select [''] = '-';
    }
    $select [01] = 'Aktif';
    $select [02] = 'CLTN';
    $select [03] = 'Tugas Belajar';
    $select [04] = 'Pemberhentian Sementara';
    $select [05] = 'Penerima Uang Tunggu';
    $select [06] = 'Prajurit Wajib';
    $select [07] = 'Pejabat Negara';
    $select [08] = 'Kepala Desa';
    $select [09] = 'Sedang dlm Proses Banding BAPEK';
    $select [11] = 'Pegawai Titipan';
    $select [12] = 'Pengungsi';
    $select [13] = 'Perpanjangan CLTN';
    $select [14] = 'PNS yang dinyatakan hilang';
    $select [15] = 'PNS kena hukuman disiplin';
    $select [16] = 'Pemindahan dalam rangka penurunan Jabatan';
    $select [20] = 'Masa Persiapan Pensiun';
    $select [66] = 'Diberhentikan';
    $select [67] = 'Punah';
    $select [69] = 'TMS Dari Pengadaan';
    $select [70] = 'Pembatalan NIP';
    $select [77] = 'Pemberhentian tanpa hak pensiun';
    $select [88] = 'Pemberhentian dengan hak pensiun';
    $select [98] = 'Mencapai BUP';
    $select [99] = 'Pensiun';
    
    return $select;
  }

  function kode_ese($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Eselon';
    }else{
      $select [''] = '-';
    }
    $select [11] = 'Eselon IA';
    $select [12] = 'Eselon IB';
    $select [21] = 'Eselon IIA';
    $select [22] = 'Eselon IIB';
    $select [31] = 'Eselon IIIA';
    $select [32] = 'Eselon IIIB';
    $select [41] = 'Eselon IVA';
    $select [42] = 'Eselon IVB';
    $select [51] = 'Eselon VA';
    $select [52] = 'Eselon VB';
    $select [99] = 'Non-Esselon';
    
    return $select;
  }

  function umur($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Umur';
    }else{
      $select [''] = '-';
    }
    $select [1] = 's.d. 25 tahun';
    $select [2] = '25 - 34 tahun';
    $select [3] = '35 - 44 tahun';
    $select [4] = '45 - 54 tahun';
    $select [5] = '55 - 57 tahun';
    $select [6] = 'diatas 57 tahun';
    
    return $select;
  }

  function umur_db($asRef=false)
  {
    $select [1] = '< 25';
    $select [2] = "BETWEEN 25 AND 34";
    $select [3] = "BETWEEN 35 AND 44";
    $select [4] = "BETWEEN 45 AND 54";
    $select [5] = "BETWEEN 55 AND 57";
    $select [6] = "> 57";
    
    return $select;
  }

  function mkcpns($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Masa Kerja TMT CPNS';
    }else{
      $select [''] = '-';
    }
    $select [1] = 's.d. 5 tahun';
    $select [2] = '5 - 9 tahun';
    $select [3] = '10 - 14 tahun';
    $select [4] = '15 - 24 tahun';
    $select [5] = '25 - 34 tahun';
    $select [6] = 'diatas 35 tahun';
    
    return $select;
  }

  function mkcpns_db($asRef=false)
  {
    $select [1] = '< 5';
    $select [2] = "BETWEEN 5 AND 9";
    $select [3] = "BETWEEN 10 AND 14";
    $select [4] = "BETWEEN 15 AND 24";
    $select [5] = "BETWEEN 25 AND 34";
    $select [6] = "> 34";
    
    return $select;
  }

  function hari_konversi($asRef=false)
  {
    $select ['Monday'] = 'Senin';
    $select ['Tuesday'] = 'Selasa';
    $select ['Wednesday'] = 'Rabu';
    $select ['Thursday'] = 'Kamis';
    $select ['Friday'] = "Jum'at";
    $select ['Saturday'] = 'Sabtu';
    $select ['Sunday'] = 'Minggu';
    
    return $select;
  }

  function bulan($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Bulan';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Januari';
    $select [2] = 'Februari';
    $select [3] = 'Maret';
    $select [4] = 'April';
    $select [5] = 'Mei';
    $select [6] = 'Juni';
    $select [7] = 'Juli';
    $select [8] = 'Agustus';
    $select [9] = 'September';
    $select [10] = 'Oktober';
    $select [11] = 'November';
    $select [12] = 'Desember';
    
    return $select;
  }


  function bulan2($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Bulan';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Jan';
    $select [2] = 'Feb';
    $select [3] = 'Mar';
    $select [4] = 'Apr';
    $select [5] = 'Mei';
    $select [6] = 'Jun';
    $select [7] = 'Jul';
    $select [8] = 'Agt';
    $select [9] = 'Sep';
    $select [10] = 'Okt';
    $select [11] = 'Nov';
    $select [12] = 'Des';
    
    return $select;
  }
  function bulan3($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Bulan';
    }else{
      $select [''] = '-';
    }
    $select ['01'] = 'Januari';
    $select ['02'] = 'Februari';
    $select ['03'] = 'Maret';
    $select ['04'] = 'April';
    $select ['05'] = 'Mei';
    $select ['06'] = 'Juni';
    $select ['07'] = 'Juli';
    $select ['08'] = 'Agustus';
    $select ['09'] = 'September';
    $select [10] = 'Oktober';
    $select [11] = 'November';
    $select [12] = 'Desember';
    
    return $select;
  }

  function lokasi_apel($asRef=false)
  {
  	$select=array();
    if(!$asRef){	$select [0] = 'Semua...';	} else {	$select [0] = '-';	}

	$sqlstr="SELECT * FROM ubina_apel_lokasi";
	$hslquery=$this->db->query($sqlstr)->result();
	
	foreach($hslquery AS $key=>$val){
		$select[$val->id_lokasi] = $val->lokasi;
	}
    
    return $select;
  }

  function jam_kerja($asRef=false)
  {
  	$select=array();
    if(!$asRef){	$select [0] = 'Semua...';	} else {	$select [0] = '-';	}

	$sqlstr="SELECT * FROM ubina_harian_jam";
	$hslquery=$this->db->query($sqlstr)->result();
	
	foreach($hslquery AS $key=>$val){
		$select[$val->id_jam] = $val->jam_masuk." -s.d.- ".$val->jam_pulang;
	}
    
    return $select;
  }

  function kehadiran($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Kehadiran';
    }else{
      $select [''] = '-';
    }
    $select ['H'] = 'Hadir';
    $select ['S'] = 'Sakit';
    $select ['I'] = 'Ijin';
    $select ['C'] = 'Cuti';
    $select ['DL'] = 'Dinas Luar';
    $select ['TK'] = 'Tanpa Keterangan';
    
    return $select;
  }

  function kode_jenis_cuti($asRef=false)
  {
    if(!$asRef){
    $select [''] = 'Pilih Jenis Cuti';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Cuti Sakit';
    $select [2] = 'Cuti Besar';
    $select [3] = 'Cuti Besar  Untuk Haji';
    $select [4] = 'Cuti Besar  Untuk Umroh';
    $select [5] = 'Cuti Alasan Penting';
    $select [6] = 'Cuti Bersalin';
    $select [7] = 'Cuti Tahunan';
    $select [8] = 'Cuti Diluar Tanggungan Negara';
        

    return $select;
  }
  
  function kode_jenis_tujuan($asRef=false)
  {
    if(!$asRef){
    $select [''] = 'Pilih Jenis Tujuan';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Luar Kota';
    $select [2] = 'Dalam Kota';
        

    return $select;
  }

  function kode_jenis_pp($asRef=false)
  {
    if(!$asRef){
    $select [''] = 'Pilih Jenis Pulang Pergi';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Ya';
    $select [2] = 'Tidak';
        

    return $select;
  }
  
  function tujuan_cuti($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Tujuan Cuti';
      }else{
        $select [''] = '-';
      }
      $select [1] = 'Dalam Kota';
      $select [2] = 'Luar Kota';

      return $select;
  }

  function tahapan_skp_pelaku($asRef=false)  {
    $select ['buat'] = 'Pegawai';
    $select ['draft'] = 'Pegawai';
    $select ['aju_penilai'] = 'Pegawai';
    $select ['koreksi_penilai'] = 'Pejabat Penilai';
    $select ['revisi_penilai'] = 'Pegawai';
    $select ['acc_penilai'] = 'Pejabat Penilai';
    $select ['aju_verifikatur'] = 'Pejabat Penilai';
    $select ['koreksi_verifikatur'] = 'Verifikatur';
    $select ['revisi_verifikatur'] = 'Pegawai';
    $select ['acc_verifikatur'] = 'Verifikatur';
    return $select;
  }

  function tahapan_skp_nomor($asRef=false)  {
    $select ['buat'] = 1;
    $select ['draft'] = 2;
    $select ['aju_penilai'] = 3;
    $select ['koreksi_penilai'] = 4;
    $select ['revisi_penilai'] = 5;
    $select ['acc_penilai'] = 6;
    return $select;
  }
  function tahapan_skp($asRef=false)  {
    $select ['buat'] = 'Pembuatan SKP';
    $select ['draft'] = 'Pengisian target sasaran kerja pegawai';
    $select ['aju_penilai'] = 'Pengajuan target sasaran kerja pegawai kepada Pejabat Penilai';
    $select ['koreksi_penilai'] = 'Koreksi target sasaran kerja pegawai oleh Pejabat Penilai';
    $select ['revisi_penilai'] = 'Revisi target sasaran kerja pegawai oleh Pegawai';
    $select ['acc_penilai'] = 'Persetujuan target sasaran kerja pegawai oleh Pejabat Penilai';
    return $select;
  }

  function tahapan_realisasi($asRef=false)  {
    $select ['buat'] = 'Pembuatan Realisasi SKP';
    $select ['draft'] = 'Pengisan realisasi sasaran kerja pegawai';
    $select ['aju_penilai'] = 'Pengajuan realisasi sasaran kerja pegawai kepada Pejabat Penilai';
    $select ['koreksi_penilai'] = 'Koreksi realisasi sasaran kerja pegawai oleh Pejabat Penilai';
    $select ['revisi_penilai'] = 'Revisi realisasi sasaran kerja pegawai oleh Pegawai';
    $select ['acc_penilai'] = 'Persetujuan realisasi sasaran kerja pegawai oleh Pejabat Penilai';
    return $select;
  }

  function kode_dokumen_peg($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Jenis Dokumen';	}else{	$select [''] = '-';	}
    $select ['pasfoto'] = 'Pasfoto dan Biodata';
    $select ['sertifikat_prajab'] = 'Fotokopi Sertifikat Prajabatan/STTPL';
    $select ['karpeg'] = 'Fotokopi Karpeg';
    $select ['konversi_nip'] = 'Fotokopi Konversi NIP';
    $select ['sk_cpns'] = 'Fotokopi SK CPNS';
    $select ['sk_pns'] = 'Fotokopi SK PNS';
    $select ['sk_pangkat'] = 'Fotokopi SK Kepangkatan';
    $select ['ijazah_pendidikan'] = 'Fotokopi Ijazah Pendidikan';
    $select ['sk_jabatan'] = 'Fotokopi SK  Jabatan Struktural / Fungsional';
    $select ['sertifikat_diklat'] = 'Fotokopi Sertifikat Diklatpim/sejenisnya (apabila ada)';
    $select ['karis_karsu'] = 'Fotokopi Karis/Karsu';
    $select ['taspen'] = 'Fotokopi Kartu Taspen';
    $select ['sertifikat_kursus'] = 'Fotokopi Sertifikat Kursus (apabila ada)';
    $select ['sertifikat_penghargaan'] = 'Fotokopi Sertifikat Penghargaan (apabila ada)';
    $select ['skp'] = 'Fotokopi SKP';
    $select ['dp3'] = 'Fotokopi DP3 Tahun 2012 dan 2013';
    $select ['ujian_dinas'] = 'Fotokopi Tanda Lulus Ujian Dinas (apabila ada)';
    $select ['penyesuaian_ijazah'] = 'Fotokopi Tanda Lulus Ujian Penyesuaian Ijazah (apabila ada)';
    $select ['pak'] = 'Penetapan Angka Kredit';
    $select ['pupns'] = 'Registrasi PUPNS';

    return $select;
  }
  
  
  #------------------------------//
  # 		TUKIN 				//
  #----------------------------//
  function tahapan_tpp_pelaku($asRef=false)  {
    $select ['buat'] = 'Pegawai';
    $select ['draft'] = 'Pegawai';
    $select ['aju_penilai'] = 'Pegawai';
    $select ['koreksi_penilai'] = 'Pejabat Penilai';
    $select ['revisi_penilai'] = 'Pegawai';
    $select ['acc_penilai'] = 'Pejabat Penilai';
    return $select;
  }
  function tpp_nilai_db($asRef=false)
  {
    $select [1] = '< 50';
    $select [2] = "BETWEEN 51 AND 59";
    $select [3] = "BETWEEN 60 AND 75";
    $select [4] = "BETWEEN 76 AND 85";
    $select [5] = "> 85";
    
    return $select;
  }
  function tpp_nilai($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih Nilai SKP';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'dibawah 50';
    $select [2] = '51 s.d. 59';
    $select [3] = '60 s.d. 75';
    $select [4] = '76 s.d. 85';
    $select [5] = 'diatas 85';
    
    return $select;
  }
  function tpp_kegiatan_db($asRef=false)  {
    $select [1] = '<= 5';
    $select [2] = "BETWEEN 6 AND 10";
    $select [3] = "BETWEEN 11 AND 20";
    $select [4] = "BETWEEN 21 AND 30";
    $select [5] = "> 30";
    
    return $select;
  }
  function tpp_kegiatan($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih...';
    }else{
      $select [''] = '-';
    }
    $select [1] = 's.d. 5';
    $select [2] = '5 s.d. 10';
    $select [3] = '11 s.d. 20';
    $select [4] = '21 s.d. 30';
    $select [5] = 'diatas 30';
    
    return $select;
  }

  function tpp_biaya_db($asRef=false)  {
    $select [1] = '=0';
    $select [2] = "BETWEEN 1 AND 10000000";
    $select [3] = "BETWEEN 10000001 AND 100000000";
    $select [4] = "BETWEEN 100000001 AND 500000000";
    $select [5] = "BETWEEN 500000001 AND 1000000000";
    $select [6] = "> 1000000001";
    
    return $select;
  }
  function tpp_biaya($asRef=false)
  {
    if(!$asRef){
      $select [''] = 'Pilih...';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Rp.0,-';
    $select [2] = 'Dibawah Rp.10.000.000,-';
    $select [3] = 'Rp.10.000.000,- s.d. Rp.100.000.000,-';
    $select [4] = 'Rp.100.000.000,- s.d. Rp.500.000.000,-';
    $select [5] = 'Rp.500.000.000,- s.d. Rp.1.000.000.000,-';
    $select [6] = 'diatas Rp.1.000.000.000,-';
    
    return $select;
  }

  function tahapan_tpp_nomor($asRef=false)  {
    $select ['buat'] = 1;
    $select ['draft'] = 2;
    $select ['aju_penilai'] = 3;
    $select ['koreksi_penilai'] = 4;
    $select ['revisi_penilai'] = 5;
    $select ['acc_penilai'] = 6;
    return $select;
  }
  function tahapan_tpp($asRef=false)  {
    $select ['buat'] = 'Pembuatan Rencana Kerja';
    $select ['draft'] = 'Pengisian target rencana kerja pegawai';
    $select ['aju_penilai'] = 'Pengajuan target rencana kerja pegawai kepada Pejabat Penilai';
    $select ['koreksi_penilai'] = 'Koreksi target rencana kerja pegawai oleh Pejabat Penilai';
    $select ['revisi_penilai'] = 'Revisi target rencana kerja pegawai oleh Pegawai';
    $select ['acc_penilai'] = 'Rencana kerja pegawai disetujui';
    return $select;
  }

  function tahapan_tpp_realisasi($asRef=false)  {
    $select ['buat'] = 'Pembuatan Realisasi Kerja';
    $select ['draft'] = 'Pengisian realisasi kerja pegawai';
    $select ['aju_penilai'] = 'Pengajuan realiasi kerja pegawai kepada Pejabat Penilai';
    $select ['koreksi_penilai'] = 'Koreksi realisasi kerja pegawai oleh Pejabat Penilai';
    $select ['revisi_penilai'] = 'Revisi realisasi kerja pegawai oleh Pegawai';
    $select ['acc_penilai'] = 'Realisasi kerja pegawai disetujui';
    return $select;
  }
  
  function nilai_tugas_tambahan($ntt=false)  {
		$ntt = (int)$ntt;
		if($ntt > 0)		{
			switch ($ntt):
				case ($ntt>=7):
					$kat = 3;	break;
				case ($ntt>=4 && $ntt<=6):
					$kat = 2;	break;
				case ($ntt<=3):
					$kat = 1;	break;
			endswitch;
		}	else	{
			$kat = 0;
		}
		return $kat;
  }

  function nilai_kreatifitas($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Tingkat Kreatifitas';	}else{	$select [''] = '-';	}
    $select ['unor'] = 3;
    $select ['instansi'] = 6;
    $select ['nasional'] = 12;
    return $select;
  }
  function tingkat_kreatifitas($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Nilai Kreatifitas';	}else{	$select [''] = '-';	}
    $select ['unor'] = 'Tingkat Unit Kerja';
    $select ['instansi'] = 'Tingkat Instansi (Pemkot Tangerang)';
    $select ['nasional'] = 'Tingkat Nasional';
    return $select;
  }

  function perilaku($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Perilaku';	}else{	$select [''] = '-';	}
    $select ['A'] = 'Orientasi Pelayanan';
    $select ['B'] = 'Integritas';
    $select ['C'] = 'Komitmen';
    $select ['D'] = 'Disiplin';
    $select ['E'] = 'Kerjasama';
    $select ['F'] = 'Kepemimpinan';
    return $select;
  }
  function katakunci($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Katakunci';	}else{	$select [''] = '-';	}
    $select ['A'] = 'Kemampuan untuk mengetahui, memahami, dan memenuhi kebutuhan yang dilayani dalam setiap aktivitas kegiatan';
    $select ['B'] = 'Mampu bertindak secara konsisten ';
    $select ['C'] = 'Mampu menyelerasakan perilaku diri dengan melibatkan diri dalam kepentingan organisasi';
    $select ['D'] = 'Taat dan patuh terhadap nilai - nilai yang menjadi tanggung jawab';
    $select ['E'] = 'Mampu bekerja dalam kelompok untuk mencapai tujuan organisasi';
    $select ['F'] = 'Kemampuan dalam meyakinkan, mempengaruhi, dan memotivasi orang lain';
    return $select;
  }
  function indikator_A($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['pelayanan_1'] = 'Dapat memenuhi kebutuhan Penerima Layanan';
    $select ['pelayanan_2'] = 'Dapat menindaklanjuti permintaan, pertanyaan dan keluhan Penerima Layanan';
    $select ['pelayanan_3'] = 'Dapat memberikan informasi terkini tentang segala sesuatu yang relevan kepada Penerima Layanan';
    $select ['pelayanan_4'] = 'Dapat memberikan pelayanan yang ramah dan menyenangkan';
    $select ['pelayanan_5'] = 'Dapat mencari alternatif terbaik untuk kepuasan Penerima Layanan';
    return $select;
  }
  function indikator_B($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['integritas_1'] = 'Tidak bersikap kompromi jika berhubungan dengan kode etik profesi';
    $select ['integritas_2'] = 'Mematuhi peraturan dan melakukan hal-hal yang diharapkan oleh jabatannya';
    $select ['integritas_3'] = 'Mampu menepati janji dan konsisten terhadap pekerjaan yang dilakukan';
    $select ['integritas_4'] = 'Berdedikasi tinggi terhadap pekerjaan';
    $select ['integritas_5'] = 'Mampu menjaga kerahasiaan jabatan';
    return $select;
  }
  function indikator_C($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['komitmen_1'] = 'Dapat memahami pentingnya pelaksanaan pekerjaan sesuai dengan tugas pokok dan fungsi serta tanggung jawabnya';
    $select ['komitmen_2'] = 'Dapat ikut serta dalam agenda daerah dan atau agenda nasional (hari besar nasional, perayaan PHBN, HUT Kota, apel kesadaran nasional, dll)';
    $select ['komitmen_3'] = 'Dapat mengambil peran aktif ketika terjadi hambatan agar tujuan organisasi tetap tercapai';
    $select ['komitmen_4'] = 'Dapat menempatkan kepentingan organisasi di atas kepentingan pribadi';
    return $select;
  }
  function indikator_D($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['disiplin_1'] = 'Kehadiran Apel';
    $select ['disiplin_2'] = 'Kehadiran pada jam kerja';
    $select ['disiplin_3'] = 'Kerapihan dan kelengkapan atribut pakaian dinas';
    return $select;
  }
  function indikator_E($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['kerjasama_1'] = 'Berperan aktif sebagaianggota Organisasi dalam melakukan tugas/bagiannya untuk mendukung keputusan Organisasi';
    $select ['kerjasama_2'] = 'Dapat membantu rekan kerja / anggota tim yang membutuhkan';
    $select ['kerjasama_3'] = 'Dapat menjaga hubungan kerja yang baik';
    $select ['kerjasama_4'] = 'Dapat mendukung atau memfasilitasi pemecahan masalah';
    return $select;
  }
  function indikator_F($asRef=false)  {
    if(!$asRef){	$select [''] = 'Pilih Indikator';	}else{	$select [''] = '-';	}
    $select ['kepemimpinan_1'] = 'Dapat  memipin rapat dengan baik (menyampaikan tujuan dan agenda, mengendalikan waktu, memberi tugas, dll )';
    $select ['kepemimpinan_2'] = 'Dapat  mengarahkan bawahan untuk menyelesaikan pekerjaan';
    $select ['kepemimpinan_3'] = 'Dapat  menciptakan kondisi yang memungkinkan tim untuk bekerja dengan baik';
    $select ['kepemimpinan_4'] = 'Dapat mengorganisir sumber daya yang tersedia untuk optimalisasi pencapaian tujuan organisasi';
    $select ['kepemimpinan_5'] = 'Dapat memberikan contoh dengan melakukan perilaku yang diinginkan';
    return $select;
  }
  function kategori($nperilaku=false)  {
		$nperilaku = (int)$nperilaku;
		if($nperilaku > 0)		{
			switch ($nperilaku):
				case ($nperilaku>=91 && $nperilaku<=100):
					$kat = "Sangat Baik";	break;
				case ($nperilaku>=76 && $nperilaku<=90):
					$kat = "Baik";	break;
				case ($nperilaku>=61 && $nperilaku<=75):
					$kat = "Sedang";	break;
				case ($nperilaku>=51 && $nperilaku<=60):
					$kat = "Buruk";	break;
				case ($nperilaku<=50):
					$kat = "Sangat Buruk";	break;
			endswitch;
		}	else	{
			$kat = "-";
		}
		return $kat;
  }

}
