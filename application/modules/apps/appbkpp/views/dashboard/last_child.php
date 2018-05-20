<div class="row main">
	<div class="col-lg-12">
		<h1 class="page-header">Daftar Unit Kerja Terkecil</h1>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row main">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Daftar Unor dan Sub-Unor</b></div>
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
$no=1;
foreach($unor  AS $key=>$val){
?>
		<tr>
			<td><?=$key+1;?></td>
			<td style="text-align:center;"><div class="btn btn-default btn-xs" onclick="ppost2('<?=$val->kode_unor;?>');"><i class="fa fa-user fa-fw"></i></div></td>
			<td><?=$val->kode_unor;?></td>
			<td>
<?php
foreach($makin[$key] AS $key2=>$val2){
	echo "(".$no.")".($key2+1).". ".$val2->kode_unor." - ".$val2->nama_unor." (".$val2->id_unor.")<br>";
	$no++;
}
?>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</div><!-- /.table-responsive -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		<a href='#' onclick='ppost();return false;' >refresh</a>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="sub" style="display:none;">
Sub Content
</div>

<form id="sb_act2" method="post"></form>
<script type="text/javascript">
function ppost2(kode){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/dashboard/last_child_jfu_non",
		data:{"kode": kode },
		beforeSend:function(){
			$(".main").hide();
			$(".sub").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
        success:function(data){
			$(".sub").html(data);
		},
        dataType:"html"});
}
function kembali(){
	$(".main").show();
	$(".sub").hide();
}
function ppost(){
	$('#sb_act2').attr('action','<?=site_url();?>module/appbkpp/dashboard/last_child');
	var tab = '<input type="hidden" name="refresh" value="ya">';
	$('#sb_act2').html(tab).submit();
}
</script>
