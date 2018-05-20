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
						echo $bulan[$realisasi->bulan];
					?>
					</div></span>
				</div>
				<div>
					<div style="float:left; width:90px;">Tahapan Rencana Kerja</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;"><?=$tahapan_tpp[$realisasi->status];?></div></span>
				</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
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
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
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
			<td><?=$val->status;?></td>
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


<?php
//if(empty($catatan))	{
if($no==1)	{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Tidak ada catatan untuk pegawai...</h4>
	Realisasi kerja tidak dapat dikembalikan.
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
?>
<script>
function ajukan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/realisasi_aju';
	},
	dataType:"html"});
	return false;
}
</script>
