<div style="padding-top:5px; padding-bottom:15px">
	<label>Kegiatan :</label>
	<?php $hpp=(isset($hapus))?' disabled':'';	?>
	<?=form_input('pekerjaan',(!isset($isi->pekerjaan))?'':$isi->pekerjaan,'class="form-control"'.$hpp.'');?>
	<?=form_hidden('id_tugas_tambahan',(!isset($isi->id_tugas_tambahan))?'':$isi->id_tugas_tambahan);?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Nomor Surat Perintah :</label>
	<?=form_input('no_sp',(!isset($isi->no_sp))?'':$isi->no_sp,'class="form-control"'.$hpp.'');?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Tanggal Surat Perintah :</label>
	<?=form_input('tanggal_sp',(!isset($isi->tanggal_sp))?'':date("d-m-Y", strtotime($isi->tanggal_sp)),'class="form-control"'.$hpp.' placeholder="dd-mm-yyyy" style="width:150px;"');?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Pejabat Pemberi Perintah :</label>
	<?=form_input('penandatangan_sp',(!isset($isi->penandatangan_sp))?'':$isi->penandatangan_sp,'class="form-control"'.$hpp.'');?>
</div>
<script type="text/javascript">
function ajukan(){
	var aksi = $("#pageFormTo").attr("action");
	$.ajax({
	type:"POST",
	url:	aksi,
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		tutupForm();
		vTab("tugas_tambahan");
	},
	dataType:"html"});
	return false;
}
</script>
