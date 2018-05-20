<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Xls_realisasi extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('apptukin/m_tukin');
		$this->load->model('appbkpp/m_pegawai');
	}


	function index(){
		$id_tpp = $this->session->userdata('id_tpp');
		$bulan = $this->session->userdata('bulan');
		$tpp = $this->m_tukin->ini_tpp($id_tpp);
		$rel = $this->m_tukin->get_realisasi($id_tpp,$bulan);
		$target = $this->m_tukin->get_target($id_tpp);
		$ttambahan = $this->m_tukin->get_tugas_tambahan($id_tpp,$bulan);
		$kreatifitas = $this->m_tukin->get_kreatifitas($id_tpp,$bulan);
		
		$dwBulan = $this->dropdowns->bulan();

		foreach($target AS $key=>$val){
			$realisasi_target[$key] = $this->m_tukin->ini_realisasi_target($val->id_target);
		}
		$b_ak = "ak_".$bulan;$b_vol = "vol_".$bulan;$b_kualitas = "kualitas_".$bulan;$b_biaya = "biaya_".$bulan;
		
		$pgd = (trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'';
		$pga = (trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'';
		$pgb = (trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'';

		$gd = (trim($tpp->gelar_depan) != '-')?trim($tpp->gelar_depan).' ':'';
		$ga = (trim($tpp->gelar_nonakademis) != '-')?trim($tpp->gelar_nonakademis).' ':'';
		$gb = (trim($tpp->gelar_belakang) != '-')?', '.trim($tpp->gelar_belakang):'';


		echo "<table width=100%>";
		echo "<tr>";
			echo "<td>".$pgd.$pga.$tpp->penilai_nama_pegawai.$pgb."</td>";
			echo "<td>".$gd.$ga.$tpp->nama_pegawai.$gb."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>".$tpp->penilai_nip_baru."</td>";
			echo "<td>".$tpp->nip_baru."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>".$tpp->penilai_nomenklatur_pada."</td>";
			echo "<td>".$tpp->nomenklatur_pada."</td>";
		echo "</tr>";
		echo "</table><br/><br/>";

		echo "<table>";
		echo "<tr>";
			echo "<td>Jangka Waktu Penilaian</td>";
			echo "<td>".$dwBulan[$tpp->bulan_mulai]." s.d. ".$dwBulan[$bulan]." (".(($bulan-$tpp->bulan_mulai)+1)." bulan)</td>";
		echo "</tr>";
		echo "</table>";
		echo "<table border=1>";
			echo "<tr>";
				echo "<td bgcolor='#999' rowspan=2 align=center><font color='#fff'><b>No.</b></font></td>";
				echo "<td width=400 bgcolor='#999' rowspan=2 align=center><font color='#fff'><b>PEKERJAAN</b></font></td>";
				echo "<td bgcolor='#999' colspan=4 align=center><font color='#fff'><b>RENCANA</b></font></td>";
				echo "<td bgcolor='#999' colspan=4 align=center><font color='#fff'><b>REALISASI</b></font></td>";
				echo "<td bgcolor='#999' rowspan=2 align=center><font color='#fff'><b>PERHITUNGAN</b></font></td>";
				echo "<td bgcolor='#999' rowspan=2 align=center><font color='#fff'><b>NILAI<br>CAPAIAN</b></font></td>";
				echo "<td rowspan=2>&nbsp;</td>";
				echo "<td rowspan=2 align=center>if:: H>0</td>";
				echo "<td rowspan=2>dd</td>";
				echo "<td rowspan=2><small>persen<br>waktu</small></td>";
				echo "<td rowspan=2><small>persen<br>biaya</small></td>";
				echo "<td rowspan=2><small>kuantitas</small></td>";
				echo "<td rowspan=2><small>kualitas</small></td>";
				echo "<td rowspan=2><small>waktu</small></td>";
				echo "<td rowspan=2><small>biaya</small></td>";
				echo "<td rowspan=2>RW < 24</td>";
				echo "<td rowspan=2>RW > 24</td>";
				echo "<td rowspan=2>RB < 24</td>";
				echo "<td rowspan=2>RB > 24</td>";
				echo "<td rowspan=2>SUM</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td width=200 bgcolor='#999'><font color='#fff'><b>AK (G)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>KUANTITAS (H)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>KUALITAS (I)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>BIAYA  (J)</b></font></td>";
	
				echo "<td width=200 bgcolor='#999'><font color='#fff'><b>AK (K)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>KUANTITAS (L)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>KUALITAS (M)</b></font></td>";
				echo "<td bgcolor='#999'><font color='#fff'><b>BIAYA (N)</b></font></td>";
			echo "</tr>";
		$jhh = 0;
		$nhh = 0;
		foreach($target AS $key=>$val){
		$hh = ($val->$b_vol>0)?1:0;
		$persen_waktu = 100-(1/1*100);
		$persen_biaya = ($val->$b_biaya!=0)?100-(@$realisasi_target[$key]->$b_biaya/$val->$b_biaya*100):"0";
		$kuantitas = ($val->$b_vol!=0)?@$realisasi_target[$key]->$b_vol/$val->$b_vol*100:"-";
		$kualitas = ($val->$b_kualitas!=0)?@$realisasi_target[$key]->$b_kualitas/$val->$b_kualitas*100:"0";
		$rw_kecil = ((1.76*1-1)/1)*100;
		$rw_besar = 76-((((1.76*1-1)/1)*100)-100);
		if($val->$b_biaya==0.00){
			$rb_kecil = 0;
			$rb_besar = 0;
		} else {
			$rb_kecil = ((1.76*$val->$b_biaya-@$realisasi_target[$key]->$b_biaya)/$val->$b_biaya)*100;
			$rb_besar = 76-((((1.76*$val->$b_biaya-@$realisasi_target[$key]->$b_biaya)/@$realisasi_target[$key]->$b_biaya)*100)-100);
		}
		if(@$realisasi_target[$key]->$b_vol==0){
			$waktu=0;
			$biaya=0;
			$kuantitas=0;
			$kualitas=0;
		} else {
			$waktu = ($persen_waktu>24)?$rw_besar:$rw_kecil;
			$biaya = ($persen_biaya>24)?$rb_besar:$rb_kecil;
			$kuantitas = ($val->$b_vol!=0)?@$realisasi_target[$key]->$b_vol/$val->$b_vol*100:"-";
			$kualitas = ($val->$b_kualitas!=0)?@$realisasi_target[$key]->$b_kualitas/$val->$b_kualitas*100:"0";
		}
		if($val->$b_biaya==0.00){
			$smm = ($val->$b_vol==0)?0:$kuantitas+$kualitas+$waktu;
			$nmm = ($val->$b_vol==0)?0:$smm/3;
		} else {
			$smm = ($val->$b_vol==0)?0:$kuantitas+$kualitas+$waktu+$biaya;
			$nmm = ($val->$b_vol==0)?0:$smm/4;
		}
		
			echo "<tr>";
				echo "<td>".($key+1)."</td>";
				echo "<td>".$val->pekerjaan."</td>";
	
				echo "<td>".$val->$b_ak."</td>";
				echo "<td>".$val->$b_vol." (".$val->satuan.")</td>";
				echo "<td>".$val->$b_kualitas."</td>";
				echo "<td>".$val->$b_biaya."</td>";
	
				echo "<td>".@$realisasi_target[$key]->$b_ak."</td>";
				echo "<td>".@$realisasi_target[$key]->$b_vol." (".$val->satuan.")</td>";
				echo "<td>".@$realisasi_target[$key]->$b_kualitas."</td>";
				echo "<td>".@$realisasi_target[$key]->$b_biaya."</td>";
				echo "<td>".$smm."</td>";
				echo "<td>".number_format($nmm,2,","," ")."</td>";
				echo "<td>_______</td>";
				echo "<td>".$hh."</td>";
				echo "<td>".number_format($nmm,2,","," ")."</td>";
				echo "<td>".$persen_waktu."</td>";
				echo "<td>".$persen_biaya."</td>";
				echo "<td>".$kuantitas."</td>";
				echo "<td>".$kualitas."</td>";
				echo "<td>".$waktu."</td>";
				echo "<td>".$biaya."</td>";
				echo "<td>".$rw_kecil."</td>";
				echo "<td>".$rw_besar."</td>";
				echo "<td>".$rb_kecil."</td>";
				echo "<td>".$rb_besar."</td>";
				echo "<td>".$smm."</td>";
			$jhh = $jhh+$nmm;
			$nhh = $nhh+$hh;
			echo "</tr>";
		}
			$np=($nhh==0)?0:$jhh/$nhh;
			echo "<tr>";
				echo "<td colspan=11 align=right><b>NILAI PRESTASI KERJA (I):</b> </td>";
				echo "<td>".number_format($jhh,2,","," ").":".$nhh."=".number_format($np,2,","," ")."</td>";
				echo "<td colspan=14>&nbsp;</td>";
			echo "</tr>";
		echo "</table><br>";

		echo "<table border=1>";
			echo "<tr bgcolor='#999'>";
			echo "<td><font color='#fff'><b>No.</b></font></td>";
			echo "<td width=400 align=center><font color='#fff'><b>TUGAS TAMBAHAN</b></font></td>";
			echo "<td align=center><font color='#fff'><b>NOMOR SURAT PERINTAH</b></font></td>";
			echo "<td align=center><font color='#fff'><b>TANGGAL SURAT</b></font></td>";
			echo "<td align=center><font color='#fff'><b>PEJABAT PEMBERI PERINTAH</b></font></td>";
			echo "</tr>";
		$no=0;
		foreach($ttambahan AS $key=>$val){
		$no++;
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$val->pekerjaan."</td>";
			echo "<td>".$val->no_sp."</td>";
			echo "<td>".$val->tanggal_sp."</td>";
			echo "<td>".$val->penandatangan_sp."</td>";
			echo "</tr>";
		}
		if(empty($ttambahan)){
			echo "<tr>";
			echo "<td colspan=5 align=center>Tidak Ada Data</td>";
			echo "</tr>";
		}
			$ntt = $this->dropdowns->nilai_tugas_tambahan($no);
			echo "<tr>";
				echo "<td colspan=4 align=right><b>NILAI TUGAS TAMBAHAN (II):</b> </td>";
				echo "<td>".$ntt."</td>";
			echo "</tr>";
			echo "</table><br>";

		echo "<table border=1>";
			echo "<tr bgcolor='#999'>";
			echo "<td><font color='#fff'><b>No.</b></font></td>";
			echo "<td width=400 align=center><font color='#fff'><b>KREATIFITAS</b></font></td>";
			echo "<td align=center><font color='#fff'><b>IMPLEMENTASI</b></font></td>";
			echo "<td align=center><font color='#fff'><b>NOMOR SURAT KEPUTUSAN</b></font></td>";
			echo "<td align=center><font color='#fff'><b>TANGGAL SURAT</b></font></td>";
			echo "<td align=center><font color='#fff'><b>PENANDATANGAN SURAT KEPUTUSAN</b></font></td>";
			echo "<td align=center><font color='#fff'><b>NILAI</b></font></td>";
			echo "</tr>";
		$tingkat = $this->dropdowns->tingkat_kreatifitas();
		$nilai = $this->dropdowns->nilai_kreatifitas();
		$nk = 0;
		foreach($kreatifitas AS $key=>$val){
			$nk = $nk+$nilai[$val->tingkat];
			echo "<tr>";
			echo "<td>".($key+1)."</td>";
			echo "<td>".$val->kreatifitas."</td>";
			echo "<td>".$tingkat[$val->tingkat]."</td>";
			echo "<td>".$val->no_sk."</td>";
			echo "<td>".$val->tanggal_sk."</td>";
			echo "<td>".$val->penandatangan_sk."</td>";
			echo "<td>".$nilai[$val->tingkat]."</td>";
			echo "</tr>";
		}
		if(empty($kreatifitas)){
			echo "<tr>";
			echo "<td colspan=7 align=center>Tidak Ada Data</td>";
			echo "</tr>";
		}
			echo "<tr>";
				echo "<td colspan=6 align=right><b>NILAI KREATIFITAS (III):</b> </td>";
				echo "<td>".$nk."</td>";
			echo "</tr>";
		echo "</table><br>";

		echo "<table>";
		echo "<tr>";
			echo "<td>Jumlah Prestasi Kerja = (I+II+III) = ".number_format($np,2,","," ")."+".$ntt."+".$nk." = ".number_format(($np+$ntt+$nk),2,","," ")."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td bgcolor='#ff0'><b>Nilai Prestasi Kerja = (I+II+III) x 60% = ".number_format((($np+$ntt+$nk)*.6),2,","," ")."</b></td>";
		echo "</tr>";
		echo "</table><br><br>";

		echo "<table border=1>";
			echo "<tr bgcolor='#999'>";
			echo "<td><font color='#fff'><b>No.</b></font></td>";
			echo "<td><font color='#fff'><b>UNSUR PENILAIAN / INDIKATOR</b></font></td>";
			echo "<td><font color='#fff'><b>NILAI</b></font></td>";
			echo "<td><font color='#fff'><b>KATEGORI</b></font></td>";
			echo "</tr>";
		$perilaku = $this->m_tukin->ini_perilaku($id_tpp,$bulan);
		$i_perilaku = $this->dropdowns->perilaku();
				$j_perilaku=0; $n_perilaku=0;
				foreach($i_perilaku AS $key=>$val){
				if($key!=""){
			echo "<tr bgcolor='#eee'>";
			echo "<td>".$key."</td>";
			echo "<td colspan=3>".$val."</td>";
			echo "</tr>";
					$indi = "indikator_".$key;
					$isi = $this->dropdowns->$indi();
					$no=0;
					foreach($isi AS $key2=>$val2){
					if($key2!=""){
						$no++;
						if(isset($perilaku->$key2) && $perilaku->$key2!=0){	$j_perilaku=$j_perilaku+$perilaku->$key2;	$n_perilaku++;	}
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$val2."</td>";
			echo "<td>".@$perilaku->$key2."</td>";
			echo "<td>".$this->dropdowns->kategori(@$perilaku->$key2)."</td>";
			echo "</tr>";
					} // if indikator
					} // for indikator
				} // if perilaku
				} //for perilaku
			$r_perilaku = ($n_perilaku>0)?$j_perilaku/$n_perilaku:"-";
			$nilai_perilaku = ($n_perilaku>0)?$r_perilaku*.4:"-";
			echo "<tr>";
			echo "<td colspan=2 align=right>Jumlah: </td>";
			echo "<td><b>".$j_perilaku."</b></td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan=2 align=right>Rerata:</td>";
			echo "<td><b>".$r_perilaku."</b></td>";
			echo "<td><b>".$this->dropdowns->kategori($r_perilaku)."</b></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan=2 align=right>Nilai perilaku (Rerata X 40%): </td>";
			echo "<td><b>".$nilai_perilaku."</b></td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
		echo "</table><br><br>";
		
		echo "<table bgcolor='#0ff'>";
		echo "<tr>";
			echo "<td><b>TOTAL NILAI = PRESTASI + PERILAKU</b></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td><b>".number_format((($np+$ntt+$nk)*.6+$nilai_perilaku),2,","," ")."</b></td>";
		echo "</tr>";
		echo "</table><br><br>";
	}

}
?>