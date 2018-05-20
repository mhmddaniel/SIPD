<div style="padding-top:5px; padding-bottom:15px">
	<label>Catatan Pejabat Penilai :</label>
	<?=form_input('catatan',$isi->catatan,'class="form-control" disabled');?>
	<?=form_hidden('id_catatan',$isi->id_catatan);?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Jawaban :</label>
	<?php $hpp=(isset($hapus))?' disabled':'';	?>
	<?=form_input('jawaban',(!isset($jj->jawaban))?'':$jj->jawaban,'class="form-control"'.$hpp.'');?>
	<?=form_hidden('id_jawaban',(!isset($jj->id_jawaban))?'':$jj->id_jawaban);?>
</div>
<script>
function input_jawaban(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/appskp/skp';
	},
	dataType:"html"});
	return false;
}
</script>
