  <div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
					<i class="fa fa-edit fa-fw"></i> <b><?=strtoupper($tipe);?> <?=strtoupper($nama_rumpun);?></b>
					<div class="btn btn-primary btn-xs pull-right" onclick="batal();"><i class="fa fa-close fa-fw"></i></div>
			</div><!-- /.panel-heading -->
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle">AKSI</th>
<th style="width:85px;text-align:center; vertical-align:middle">KODE</th>
<th style="text-align:center; vertical-align:middle">NAMA <?=strtoupper($tipe);?></th>
</tr>
</thead>
<tbody id="list">
<?php foreach($daftar AS $key=>$val){	?>
<tr id="rowjj_<?=$val->id_diklat_jangnis;?>">
<td style="padding:3psx;"><?=($key+1);?></td>
<td valign=top style='padding:3px 0px 0px 0px;' align=center>
			<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
				<ul class="dropdown-menu" role="menu">
					<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj('appdiklat/kursus/jangnis_edit','<?=$val->id_diklat_jangnis;?>','<?=($key+1);?>');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj('appdiklat/kursus/jangnis_hapus','<?=$val->id_diklat_jangnis;?>','<?=($key+1);?>');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
				</ul>
			</div>
</td>
<td style="padding:3psx;"><?=$val->kode;?></td>
<td style="padding:3psx;"><?=$val->nama_diklat_jangnis;?></td>
</tr>
<?php } ?>
<tr id="rowjj_tb">
<td style="padding:3psx;"><?=(empty($daftar))?1:($key+2);?></td>
<td style="padding:3psx;" colspan='3' onclick="setFjj('appdiklat/kursus/jangnis_tambah','tb','<?=(empty($daftar))?1:($key+2);?>');return false;"><div class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Tambah data</div></td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->

									
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		</form>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<script type="text/javascript">
function setFjj(aksi,idd,nomor){
	batal_aksi();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd":idd,"nomor":nomor,"id_rumpun":<?=$id_rumpun;?>,"nama_rumpun":"<?=$nama_rumpun;?>","tipe":"<?=$tipe;?>"},
		beforeSend:function(){	
			$('#rowjj_'+idd).hide();
			$('<tr class="success" id="row_tt"><td colspan=4 align=center><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>').insertAfter('#rowjj_'+idd);
		},
		success:function(data){
			$('#row_tt').replaceWith(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_aksi(){
	$('.row_tt').remove();
	$("[id^='rowjj_']").removeClass().show();
}
</script>