<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Orphan</h1>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Daftar Pegawai Tidak Punya Unor</b></div>
			<div class="panel-body" style="padding:5px;">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th align="center">No.</th>
			<th align="center">NIP</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach($ky AS $key=>$val){
?>
		<tr>
			<td><?=$key+1;?></td>
			<td><?=$val->nip_baru;?></td>
		</tr>
<?php
}
if(empty($ky)){
?>
		<tr>
			<td colspan=2 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</div><!-- /.table-responsive -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Daftar Unor dan Sub-Unor</b></div>
			<div class="panel-body" style="padding:5px;">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th align="center">No.</th>
			<th align="center">KODE UNOR</th>
			<th align="center">ID UNOR</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach($unor  AS $key=>$val){
?>
		<tr>
			<td><?=$key+1;?></td>
			<td><?=$val->kode_unor;?></td>
			<td><?=$val->rt;?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</div><!-- /.table-responsive -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

