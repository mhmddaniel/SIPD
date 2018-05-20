  <div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-indent fa-fw"></i> <b>Jenjang Jabatan <?=$unit->nama_jabatan;?></b>
				<span class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-close fa-fw"></i></span>
			</div>
			<div class="panel-body">

<div class="table-responsive" id="daftar_jenjang">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="width:250px;text-align:center; vertical-align:middle">GOLONGAN</th>
			<th style="width:250px;text-align:center; vertical-align:middle">TINGKAT</th>
			<th style="text-align:center; vertical-align:middle">NAMA JENJANG JABATAN</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if(empty($jenjang)){	echo "<tr><td colspan=5 align=center>Tidak Ada Data</td></tr>";	} else {
	foreach($jenjang AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td>
			<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
				<ul class="dropdown-menu" role="menu">
					<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="fJenjang('edit','<?=$idd."**".$val->id_jenjang_jabatan;?>');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="fJenjang('hapus','<?=$idd."**".$val->id_jenjang_jabatan;?>');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
				</ul>
			</div>
			</td>
			<td><?=$dWgolongan[$val->kode_golongan];?> - <?=$dWpangkat[$val->kode_golongan];?></td>
			<td><?=$val->tingkat;?></td>
			<td><?=$val->nama_jenjang;?></td>
		</tr>
	<?php	} } ?>
		<tr>
			<td colspan=2>&nbsp;</td>
			<td colspan=3><div class="btn btn-primary btn-xs" onclick="fJenjang('tambah',<?=$idd;?>);"><i class="fa fa-plus fa-fw"></i> Tambah data</div></td>
		</tr>
	</tbody>
</table>
</div>


			</div><!-- /.panel-body -->
		</div>		<!-- /.panel -->
	</div>	<!-- /.col-lg-12 -->
  </div><!-- /.row -->


<script type="text/javascript">
function fJenjang(aksi,idd){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabfung/jenjang_"+aksi,
			data:{"idd": idd },
			beforeSend:function(){	
				$("#daftar_jenjang").hide();
				$('<p class="text-center" id="form_jenjang"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').insertAfter('#daftar_jenjang');
			},
			success:function(data){
				$('#form_jenjang').replaceWith(data);
			},
			dataType:"html"});
}
function tutupfJenjang(){
	$('#form_jenjang').remove();
	$('#daftar_jenjang').show();
}
</script>
