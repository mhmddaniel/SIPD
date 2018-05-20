<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Cetak per halaman
				<div class="btn btn-primary btn-xs pull-right" onclick="kembali();"><i class="fa fa-close fa-fw"></i></div>
			</div><!-- /.panel-body -->
			<div class="panel-body">

<?php
$ini="";
for($i=0;$i<$seg_print;$i++){
	$jj = ($i*$bat_print)+1;
	$kk = ($i+1)*$bat_print;
	$ini = $ini.'<div onclick="cetak('.($i+1).');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '.($i+1).' (item no.'.$jj.' - '.$kk.')</div><br/>';
}
echo $ini;
?>

			</div>
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
