<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?=$unor->nama_unor;?></h1>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row main">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Daftar JFU Non LastChild</b>
				<div class="btn btn-danger btn-xs pull-right" onclick="kembali();"><i class="fa fa-close fa-fw"></i></div>
			</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding:5px;">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th style="text-align:center;">AKSI</th>
			<th>KODE UNOR</th>
			<th>ID UNOR</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach($pegawai  AS $key=>$val){
?>
		<tr>
			<td><?=$key+1;?></td>
			<td><?=$val->nama_pegawai;?></td>
			<td><?=$val->kode_unor;?></td>
			<td><?=$val->nama_unor;?></td>
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

