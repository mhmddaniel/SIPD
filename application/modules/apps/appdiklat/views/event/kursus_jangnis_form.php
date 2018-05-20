<tr class="row_tt success">
<td><?=$nomor;?></td>
<td>&nbsp;</td>
<td>
<input type="text" name="nama_diklat_jangnis" id="nama_diklat_jangnis" value="<?=@$val->nama_diklat_jangnis;?>" class="form-control" placeholder="Wajib di-isi">
</td>
</tr>
<tr class="row_tt success">
<td colspan=2>&nbsp;</td>
<td>
<div class="btn btn-<?=($aksi=="hapus")?"danger":"primary";?> btn-xs" onclick="javascript:void(0);simpan_jangnis('<?=$aksi;?>');"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
<div class="btn btn-default btn-xs" onclick="batal_aksi();"><i class="fa fa-close fa-fw"></i> Batal...</div>
</td>
</tr>
<script type="text/javascript">
function simpan_jangnis(aksi){
	var nama_diklat_jangnis = $('#nama_diklat_jangnis').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/kursus/jangnis_"+aksi+"_aksi",
		data:{"idd":"<?=$idd;?>","nama_diklat_jangnis":nama_diklat_jangnis,"id_rumpun":<?=$id_rumpun;?>,"tipe":"<?=$tipe;?>"},
		beforeSend:function(){	
			$('#form-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			setForm('appdiklat/kursus/jangnis','<?=$nama_rumpun;?>*<?=$id_rumpun;?>*<?=$tipe;?>');
		}, // end success
	dataType:"html"}); // end ajax
	return false;
}
</script>
