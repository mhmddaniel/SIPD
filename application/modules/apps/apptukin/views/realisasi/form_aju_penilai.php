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
						$bulan = $this->dropdowns->bulan();
						echo $bulan[$bulan_aktif];
					?>
					</div></span>
				</div>
				<div>
					<div style="float:left; width:90px;">Tahapan Realisasi</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;"><?=$tahapan_realisasi[$realisasi->status];?></div></span>
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
										<span><div style="display:table;"><?=$tpp->penilai_nama_pangkat." / ".$tpp->penilai_nama_golongan;?></div></span>
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
										<span><div style="display:table;"><?=$tpp->nama_pangkat." / ".$tpp->nama_golongan;?></div></span>
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
			</div>			<!-- /.panel body -->
		</div>		<!-- /.panel -->
	</div>	<!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php if($realisasi->status=="revisi_penilai"){ ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan dari Pejabat Penilai:</b></div>
			<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=25 align=center>No.</th>
			<th width=300 align=center>URAIAN CATATAN</th>
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
		</tr>
		<?php 
			$no++;
			} // endif DITANYA
		} // end FOREACH
		if($no==1){
		?>
		<tr>
			<td colspan=2 align=center>Tidak ada catatan</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div><!-- table-responsive --->
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<?php 
if($no>1)	{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Ada catatan untuk pegawai belum dijawab...</h4>
	Rencana kerja tidak dapat disetujui.
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
	}	// endif NO>1
} //...endif REVISI PENILAI
?>




<?php
$b_ak = "ak_".$bulan_aktif;$b_vol = "vol_".$bulan_aktif;$b_kualitas = "kualitas_".$bulan_aktif;$b_biaya = "biaya_".$bulan_aktif;
$kosong=0;
$nihil=0;
foreach($target AS $key=>$val){
	if(empty($realisasi_target[$key])){ 
		$kosong++;
	} else {
		if($realisasi_target[$key]->$b_ak==NULL || $realisasi_target[$key]->$b_vol==NULL || $realisasi_target[$key]->$b_kualitas==NULL || $realisasi_target[$key]->$b_biaya==NULL){	$nihil++;	}
	}
}
?>


<?php
if($kosong>0 || $nihil>0)	{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Realisasi Target Kinerja belum semua di-isi..</h4>
	Tidak dapat diajukan
	</div><!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
?>
<script type="text/javascript">
function ajukan(){
	var aksi = $("#pageFormTo").attr("action");
	$.ajax({
	type:"POST",
	url:	aksi,
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/realisasi/aktif';
	},
	dataType:"html"});
	return false;
}
</script>
