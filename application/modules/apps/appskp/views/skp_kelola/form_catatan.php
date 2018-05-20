<div style="padding-top:5px; padding-bottom:15px">
	<label>Uraian :</label>
	<?php $hpp=(isset($hapus))?' disabled':'';	?>
	<?=form_input('catatan',(!isset($isi->catatan))?'':$isi->catatan,'class="form-control"'.$hpp.'');?>
	<?=form_hidden('id_catatan',(!isset($isi->id_catatan))?'':$isi->id_catatan);?>
</div>
<script>
function ajukan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/appskp/skp_kelola/target';
	},
	dataType:"html"});
	return false;
}
</script>
