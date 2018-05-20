<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="padding-bottom:10px;">Absensi Apel</h1>
	</div><!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-map-marker fa-fw"></i> <b>Rekapitulasi Wajib Apel per Lokasi Apel</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning">
			<div class="panel-heading"><span class="fa fa-calendar fa-fw"></span> <b>JADUAL APEL</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_apel;?>, <?=$val->tanggal_apel;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Lokasi</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:305px;">Semua</div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Kehadiran</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:305px;">Semua</div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">

<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:200px;text-align:center; vertical-align:middle">LOKASI APEL</th>
<th style="width:150px;text-align:center; vertical-align:middle">WAJIB APEL</th>
<th style="width:50px;text-align:center; vertical-align:middle">HADIR</th>
<th style="width:50px;text-align:center; vertical-align:middle">SAKIT</th>
<th style="width:50px;text-align:center; vertical-align:middle">IJIN</th>
<th style="width:50px;text-align:center; vertical-align:middle">CUTI</th>
<th style="width:50px;text-align:center; vertical-align:middle">DINAS LUAR</th>
<th style="width:50px;text-align:center; vertical-align:middle">T.K.</th>
</tr>
</thead>
<tbody id=list>
	<?php
	$jj = 0;
	$jhadir = 0;
	$jsakit = 0;
	$jijin = 0;
	$jcuti = 0;
	$jdl = 0;
	$jtk = 0;
	foreach($lokasi_apel AS $key=>$val){
	$jj = $jj+$val->wajib;
	$jhadir = $jhadir+$val->hadir;
	$jsakit = $jsakit+$val->sakit;
	$jijin = $jijin+$val->ijin;
	$jcuti = $jcuti+$val->cuti;
	$jdl = $jdl+$val->dl;
	$jtk = $jtk+$val->tk;
	?>
<tr>
<td><?=$key+1;?></td>
<td><?=$val->lokasi;?></td>
<td><b><?=$val->wajib;?></b> pegawai</td>
<td><?=$val->hadir;?></td>
<td><?=$val->sakit;?></td>
<td><?=$val->ijin;?></td>
<td><?=$val->cuti;?></td>
<td><?=$val->dl;?></td>
<td><?=$val->tk;?></td>
</tr>
	<?php
	}
	?>
<tr>
<td align=right colspan=2><b>Jumlah</b></td>
<td><b><?=$jj;?> pegawai</b></td>
<td><b><?=$jhadir;?></b></td>
<td><b><?=$jsakit;?></b></td>
<td><b><?=$jijin;?></b></td>
<td><b><?=$jcuti;?></b></td>
<td><b><?=$jdl;?></b></td>
<td><b><?=$jtk;?></b></td>
</tr>
</tbody>
</table>



	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
									</div><!-- /.panel-body -->
								</div><!-- /.panel -->
							</div><!-- /.col-lg-12 -->
						</div><!-- /.row -->


<form id="sb_act" method="post"></form>
<script type="text/javascript">
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel');
	$('#sb_act').submit();
}
</script>

<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
