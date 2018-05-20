<div style="padding-left:100px;">
<div class="btn btn-danger btn-xs" onclick="hapus_ini(<?=$idd;?>);"><i class="fa fa-trash fa-fw"></i> Hapus</div>
<div class="btn btn-default btn-xs" onclick="tutup();"><i class="fa fa-close fa-fw"></i> Batal...</div>
</div>
<script type="text/javascript">
function hapus_ini(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appsotkbaru/njs2017/hapus_ini",
		data:{"idd":idd},
		beforeSend:function(){	
			$('#list_aktif').hide();
			$('#paging_aktif').hide();
		},
		success:function(data){
			$('#list_aktif').show();
			regrid();
			$('#paging_aktif').show();
		}, // end success
	dataType:"html"}); // end ajax
}
</script>