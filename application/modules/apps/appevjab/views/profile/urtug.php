<div class="row" style="padding-top:15px;">
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="text-align:center; vertical-align:middle">URAIAN TUGAS</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($urtug AS $key=>$val){
	?>
		<tr id="row_<?=$val->id_urtug;?>">
			<td><?=$key+1;?></td>
			<td>
			<div id="bt_tahapan_<?=$val->id_urtug;?>" class="btn btn-default dropdown-toggle btn-xs" title="Lihat Tahapan Pekerjaan" onclick="tahapan_dw(<?=$val->id_urtug;?>);"><i class="fa fa-caret-down fa-fw"></i></div>
			</td>
			<td><?=$val->uraian_tugas;?></td>
		</tr>
	<?php
	}
	if(empty($urtug)){
	?>
		<tr>
			<td colspan=3 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>

</div><!--/.table-responsive-->
</div><!--/.col-lg-12-->
</div><!--/.row-->

<script type="text/javascript">
function tahapan_dw(idd){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/profile_pegjab/urtug_tahapan",
			data:{"idd": idd },
			beforeSend:function(){	
				$("#row_"+idd).addClass("success");
				$("#bt_tahapan_"+idd).html('<i class="fa fa-caret-up fa-fw"></i>').attr("title","Tutup Tahapan Pekerjaan").attr("onclick","tahapan_tutup("+idd+")");
				$('<tr id="row_tahapan_'+idd+'" class="success"><td colspan="5" id="tahapan_'+idd+'"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>').insertAfter("#row_"+idd);
			},
			success:function(data){
				$("#tahapan_"+idd).html(data);
			},
			dataType:"html"});
}
function tahapan_tutup(idd){
	$("#row_"+idd).removeClass("success");
	$("#row_tahapan_"+idd).hide();
	$("#bt_tahapan_"+idd).html('<i class="fa fa-caret-down fa-fw"></i>').attr("title","Lihat Tahapan Pekerjaan").attr("onclick","tahapan_buka("+idd+")");
}
function tahapan_buka(idd){
	$("#row_"+idd).addClass("success");
	$("#row_tahapan_"+idd).show();
	$("#bt_tahapan_"+idd).html('<i class="fa fa-caret-up fa-fw"></i>').attr("title","Tutup Tahapan Pekerjaan").attr("onclick","tahapan_tutup("+idd+")");
}
</script>
