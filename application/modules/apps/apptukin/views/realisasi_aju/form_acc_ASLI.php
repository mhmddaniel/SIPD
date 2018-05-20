<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			<span style="margin-left:5px;" id=judul_tpp onclick="jena();"><b>REALISASI KERJA TAHUN <?=$tpp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
				<div>
					<div style="float:left; width:90px;">Bulan</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;">
					<?php
						echo $dwBulan[$realisasi->bulan];
					?>
					</div></span>
				</div>
				<div>
					<div style="float:left; width:90px;">Tahapan Rencana Kerja</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;"><?=$tahapan_tpp[$realisasi->status];?></div></span>
				</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->





<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'';?><?=(trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'';?><?=$tpp->penilai_nama_pegawai;?><?=(trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$realisasi->penilai_nama_pangkat." / ".$realisasi->penilai_nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEGAWAI YANG DINILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->gelar_nonakademis) != '-')?trim($tpp->gelar_nonakademis).' ':'';?><?=(trim($tpp->gelar_depan) != '-')?trim($tpp->gelar_depan).' ':'';?><?=$tpp->nama_pegawai;?><?=(trim($tpp->gelar_belakang) != '-')?', '.trim($tpp->gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$realisasi->nama_pangkat." / ".$realisasi->nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$tpp->nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading"><b>Prestasi kerja:</b></div>
			<div class="panel-body">
<?php
		$b_ak = "ak_".$bulan;$b_vol = "vol_".$bulan;$b_kualitas = "kualitas_".$bulan;$b_biaya = "biaya_".$bulan;
		foreach($target AS $key=>$val){
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$rel = $this->m_tukin->ini_realisasi_target($val->id_target);

			$rc_ak = 0;$rc_vol = 0;$rc_kualitas=0;$rc_biaya=0;
			$rl_ak = 0;$rl_vol = 0;$rl_kualitas=0;$rl_biaya=0;
			
			$mml=0;
			for($i=$tpp->bulan_mulai;$i<=$bulan;$i++){
				$c_ak = "ak_".$i;$c_vol = "vol_".$i;$c_kualitas = "kualitas_".$i;$c_biaya = "biaya_".$i;

				$rc_ak = $rc_ak+$val->$c_ak;
				$rc_vol = $rc_vol+$val->$c_vol;
				$rc_kualitas = $rc_kualitas+$val->$c_kualitas;
				$rc_biaya = $rc_biaya+$val->$c_biaya;

				$rl_ak = $rl_ak+$rel->$c_ak;
				$rl_vol = $rl_vol+$rel->$c_vol;
				$rl_kualitas = $rl_kualitas+$rel->$c_kualitas;
				$rl_biaya = $rl_biaya+$rel->$c_biaya;

				$mml++;
			}
			$target[$key]->$b_ak = $rc_ak;
			$target[$key]->$b_vol = $rc_vol;
			$target[$key]->$b_kualitas = 100;
			$target[$key]->$b_biaya = $rc_biaya;

			@$realisasi_target[$key]->$b_ak = $rl_ak;
			@$realisasi_target[$key]->$b_vol = $rl_vol;
			@$realisasi_target[$key]->$b_kualitas = $rl_kualitas/$mml;
			@$realisasi_target[$key]->$b_biaya = $rl_biaya;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
?>
<div class="table-responsive">
<table class="table info table-striped table-bordered table-hover">
			<tr>
				<td rowspan=2 align=center style="background-color:#eee"><b>No.</b></td>
				<td rowspan=2 align=center style="background-color:#eee"><b>PEKERJAAN</b></td>
				<td colspan=4 align=center style="background-color:#eee"><b>RENCANA s.d. <?=strtoupper($dwBulan[$bulan]);?></b></td>
				<td colspan=4 align=center style="background-color:#eee"><b>REALISASI s.d. <?=strtoupper($dwBulan[$bulan]);?></b></td>
				<td rowspan=2 align=center style="background-color:#eee"><b>PERHITUNGAN</b></td>
				<td rowspan=2 align=center style="background-color:#eee"><b>NILAI<br>CAPAIAN</b></td>
			</tr>
			<tr style="background-color:#eee">
				<td><b>AK</b></td>
				<td><b>KUANTITAS</b></td>
				<td><b>KUALITAS</b></td>
				<td><b>BIAYA</b></td>
	
				<td><b>AK</b></td>
				<td><b>KUANTITAS</b></td>
				<td><b>KUALITAS</b></td>
				<td><b>BIAYA</b></td>
			</tr>
<?php
		$jhh = 0;
		$nhh = 0;
		$n_biaya = 0;
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
?>
			<tr>
				<td><?=($key+1);?></td>
				<td><?=$val->pekerjaan;?></td>
	
				<td><?=$val->$b_ak;?></td>
				<td><?=$val->$b_vol?> (<?=$val->satuan;?>)</td>
				<td><?=$val->$b_kualitas;?></td>
				<td><?=$val->$b_biaya;?></td>
	
				<td><?=@$realisasi_target[$key]->$b_ak;?></td>
				<td><?=@$realisasi_target[$key]->$b_vol;?> (<?=$val->satuan;?>)</td>
				<td><?=@$realisasi_target[$key]->$b_kualitas;?></td>
				<td><?=@$realisasi_target[$key]->$b_biaya;?></td>
				<td><?=number_format($smm,2,","," ");?></td>
				<td><?=number_format($nmm,2,","," ");?></td>
			</tr>
<?php
			$jhh = $jhh+$nmm;
			$nhh = $nhh+$hh;
			$n_biaya = $n_biaya+$realisasi_target[$key]->$b_biaya;
}
			$np=($nhh==0)?0:$jhh/$nhh;
?>
			<tr>
				<td colspan=11 align=right><b>NILAI TUGAS POKOK (I):</b> </td>
				<td><?=number_format($np,2,","," ")?></td>
			</tr>
</table>
</div>


<div class="table-responsive">
<table class="table info table-striped table-bordered table-hover">
			<tr>
			<td><b>No.</b></td>
			<td align=center><b>TUGAS TAMBAHAN</b></td>
			<td align=center><b>NOMOR SURAT PERINTAH</b></td>
			<td align=center><b>TANGGAL SURAT</b></td>
			<td align=center><b>PEJABAT PEMBERI PERINTAH</b></td>
			</tr>
<?php
		$no=0;
		foreach($ttambahan AS $key=>$val){
		$no++;
?>
			<tr>
			<td><?=$no;?></td>
			<td><?=$val->pekerjaan;?></td>
			<td><?=$val->no_sp;?></td>
			<td><?=$val->tanggal_sp;?></td>
			<td><?=$val->penandatangan_sp;?></td>
			</tr>
<?php
		}
		if(empty($ttambahan)){
?>
			<tr>
			<td colspan=5 align=center>Tidak Ada Data</td>
			</tr>
<?php
		}
			$ntt = $this->dropdowns->nilai_tugas_tambahan($no);
?>
			<tr>
				<td colspan=4 align=right><b>NILAI TUGAS TAMBAHAN (II):</b> </td>
				<td><?=$ntt;?></td>
			</tr>
</table>
</div>


<div class="table-responsive">
<table class="table info table-striped table-bordered table-hover">
			<tr>
			<td><b>No.</b></td>
			<td align=center><b>KREATIFITAS</b></td>
			<td align=center><b>IMPLEMENTASI</b></td>
			<td align=center><b>NOMOR SURAT KEPUTUSAN</b></td>
			<td align=center><b>TANGGAL SURAT</b></td>
			<td align=center><b>PENANDATANGAN SURAT KEPUTUSAN</b></td>
			<td align=center><b>NILAI</b></td>
			</tr>
<?php
		$tingkat = $this->dropdowns->tingkat_kreatifitas();
		$nilai = $this->dropdowns->nilai_kreatifitas();
		$nk = 0;
		foreach($kreatifitas AS $key=>$val){
			$nk = $nk+$nilai[$val->tingkat];
?>
			<tr>
			<td><?=($key+1);?></td>
			<td><?=$val->kreatifitas;?></td>
			<td><?=$tingkat[$val->tingkat];?></td>
			<td><?=$val->no_sk;?></td>
			<td><?=$val->tanggal_sk;?></td>
			<td><?=$val->penandatangan_sk;?></td>
			<td><?=$nilai[$val->tingkat];?></td>
			</tr>
<?php
		}
		if(empty($kreatifitas)){
?>
			<tr>
			<td colspan=7 align=center>Tidak Ada Data</td>
			</tr>
<?php
		}
?>
			<tr>
				<td colspan=6 align=right><b>NILAI KREATIFITAS (III):</b> </td>
				<td><?=$nk;?></td>
			</tr>
</table>
</div>

			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading"><b>Perilaku kerja:</b></div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table info table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th width=25>No.</th>
<th>USUR PENILAIAN / INDIKATOR</th>
<th width=156>NILAI</th>
<th width=150>KATEGORI</th>
</tr>
</thead>
<tbody>
<?php
$n_perilaku_kosong = 0;
$j_perilaku=0; $n_perilaku=0;
foreach($i_perilaku AS $key=>$val){
if($key!=""){
if($val!="Kepemimpinan"){	$tpll="ya";	} else {	if($jab_type=="js"){	$tpll="ya";	} else {$tpll="tidak";}	}
if($tpll=="ya"){
?>
<tr>
	<td style="background-color:#FFFF99"><?=$key;?></td>
	<td colspan=3 style="background-color:#FFFF99"><?=strtoupper($val);?></td>
</tr>
<?php
	$indi = "indikator_".$key;
	$isi = $this->dropdowns->$indi();
	$no=0;
	foreach($isi AS $key2=>$val2){
	if($key2!=""){	
	$no++;
		if(isset($perilaku->$key2) && $perilaku->$key2!=0){
			$j_perilaku=$j_perilaku+$perilaku->$key2;
			$n_perilaku++;
		} else {
			$n_perilaku_kosong++;
		}
?>
<tr>
	<td><?=$no;?></td>
	<td><?=$val2;?></td>
	<td><?=(isset($perilaku->$key2))?$perilaku->$key2:"";?></td>
	<td><?=(isset($perilaku->$key2))?$this->dropdowns->kategori($perilaku->$key2):"-";?></td>
</tr>
<?php
	} // if indikator
	} // for indikator
} // if jfu
} // if perilaku
} //for perilaku
$r_perilaku = ($n_perilaku>0)?$j_perilaku/$n_perilaku:"-";
$nilai_perilaku = ($n_perilaku>0)?$r_perilaku*.4:"-";
?>
<tr>
	<td align=right colspan=2>Jumlah</td>
	<td><?=$j_perilaku;?></td>
	<td>&nbsp;</td>
</tr>
<tr id='row_'>
	<td align=right colspan=2>Nilai rata-rata</td>
	<td><?=@number_format($r_perilaku,2,","," ");?></td>
	<td><?=$this->dropdowns->kategori($r_perilaku);?></td>
</tr>
<tr id='row_'>
	<td align=right colspan=2>Nilai Perilaku Kerja</td>
	<td><div style="font-weight:bold;"><?=@number_format($nilai_perilaku,2,","," ");?></div></td>
	<td>&nbsp;</td>
</tr>
</table>
</div><!-- table-responsive --->

			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><b>NILAI PRESTASI:</b></div>
			<div class="panel-body">
PRESTASI + PERILAKU = <?=number_format((($np+$ntt+$nk)*.6+$nilai_perilaku),2,","," ");?> 
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan untuk pegawai:</b></div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=25 align=center>No.</th>
			<th width=300 align=center>URAIAN CATATAN</th>
			<th width=80 align=center>WAKTU</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		foreach($catatan AS $key=>$val){
			if($val->status=="ditanya"){
		?>
		<tr>
			<td><?=$no;?></td>
			<td><?=$val->catatan;?></td>
			<td><?=$val->last_updated;?></td>
		</tr>
		<?php 
			$no++;
			}
		} 
		if($no==1){
		?>
		<tr>
			<td colspan=5 align=center>Tidak Ada Catatan</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div><!-- table-responsive --->
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<input type='hidden' name='nilai_tugaspokok' value='<?=$np;?>'>
<input type='hidden' name='nilai_tugastambahan' value='<?=$ntt;?>'>
<input type='hidden' name='nilai_kreatifitas' value='<?=$nk;?>'>
<input type='hidden' name='nilai_biaya' value='<?=$n_biaya;?>'>
<input type='hidden' name='nilai_perilaku' value='<?=$nilai_perilaku;?>'>


<?php
$pesan = array();
if($n_perilaku_kosong>0){	$pesan[]="Ada ".$n_perilaku_kosong." kolom perilaku belum di-Isi!";	}
if($no>1){	$pesan[]="Ada catatan untuk pegawai...!";	}

if(!empty($pesan))	{
?>
<div class="row">
	<div class="col-lg-12">
	<?php foreach($pesan AS $key=>$val){	echo "<h4>".$val."</h4>";	}	?>
	Realisasi kerja tidak dapat disetujui.
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
?>
<script type="text/javascript">
function ajukan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<div id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/realisasi_aju';
	},
	dataType:"html"});
	return false;
}
</script>
