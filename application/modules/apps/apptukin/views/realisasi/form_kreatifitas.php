<div style="padding-top:5px; padding-bottom:15px">
	<label>Kreatifitas :</label>
	<?php $hpp=(isset($hapus))?' disabled':'';	?>
	<?=form_input('kreatifitas',(!isset($isi->kreatifitas))?'':$isi->kreatifitas,'class="form-control"'.$hpp.'');?>
	<?=form_hidden('id_kreatifitas',(!isset($isi->id_kreatifitas))?'':$isi->id_kreatifitas);?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Tingkat Implementasi :</label>
	<?=form_dropdown('tingkat',$this->dropdowns->tingkat_kreatifitas(),(!isset($isi->tingkat))?'':$isi->tingkat,'id="tingkat" class="form-control" style="width:200px;"');?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Nomor Surat Keputusan :</label>
	<?=form_input('no_sk',(!isset($isi->no_sk))?'':$isi->no_sk,'class="form-control"'.$hpp.'');?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Tanggal Surat Keputusan :</label>
	<?=form_input('tanggal_sk',(!isset($isi->tanggal_sk))?'':date("d-m-Y", strtotime($isi->tanggal_sk)),'class="form-control"'.$hpp.' placeholder="dd-mm-yyyy" style="width:150px;"');?>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<label>Penandatangan Surat Keputusan :</label>
	<?=form_input('penandatangan_sk',(!isset($isi->penandatangan_sk))?'':$isi->penandatangan_sk,'class="form-control"'.$hpp.'');?>
</div>
<script type="text/javascript">
function ajukan(){
	var data="";
	var dati="";
			var nnm = $.trim($("#tingkat").val());
			data=data+nnm+"**";
			if( nnm ==""){	dati=dati+"TINGKAT IMPLEMENTASI tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {ajukan_aksi();}
}
function ajukan_aksi(){
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
		vTab("kreatifitas");
	},
	dataType:"html"});
	return false;
}
</script>
