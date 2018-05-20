<tr class="row_tt success">
<td colspan=2>&nbsp;</td>
<td colspan=3>
<div class="btn btn-<?=($aksi=="hapus")?"danger":"primary";?> btn-xs" onclick="javascript:void(0);hapus_widyaiswara(<?=$idd;?>);"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
<div class="btn btn-default btn-xs" onclick="batal_setFjj();"><i class="fa fa-close fa-fw"></i> Batal...</div>
</td>
</tr>
<script type="text/javascript">
function hapus_widyaiswara(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event/widyaiswara_<?=$aksi;?>_aksi",
		data:{"idd":idd},
		beforeSend:function(){	
			$('.row_tt').html('<td colspan=5 align=center><i class="fa fa-spinner fa-spin fa-1x"></i></td>');
		},
		success:function(data){
			batal_setFjj();
			regrid_widyaiswara();
		}, // end success
	dataType:"html"}); // end ajax
	return false;
}
</script>
