<div class="row" style="padding-top:15px;">
	<div class="col-lg-12">
		<textarea name="rekomendasi" id="rekomendasi" class="form-control"  style="background-color:#FFFF99;" rows="5" disabled><?=$val->rekomendasi;?></textarea>
		<input type="hidden"  id="id_peg_rekomendasi" value="<?=$val->id_peg_rekomendasi;?>">
	</div><!--/.col-lg-12-->
</div><!--/.row-->
<div class="row" id="rwAct">
	<div class="col-lg-12" style="padding-top:10px;">
		<div class="btn btn-default pull-right" onclick="editt();"><i class="fa fa-pencil fa-fw"></i> Edit</div>
	</div><!--/.col-lg-12-->
</div><!--/.row-->
<div class="row" id="btAct" style="display:none;">
	<div class="col-lg-12" style="padding-top:10px;">
		<div class="btn btn-default pull-right" onclick="gajadi();"><i class="fa fa-close fa-fw"></i> Batal</div>
		<div class="btn btn-primary pull-right" onclick="simpann();"><i class="fa fa-save fa-fw"></i> Simpan</div>
	</div><!--/.col-lg-12-->
</div><!--/.row-->
<div class="row" id="spAct" style="display:none;">
	<div class="col-lg-12" style="padding-top:10px;">
	<p style="text-align:right;"><i class="fa fa-spinner fa-spin fa-2x"></i></p>
	</div><!--/.col-lg-12-->
</div><!--/.row-->


<script type="text/javascript">
function editt(){
	$("#rwAct").hide();
	$("#btAct").show();
	$("#rekomendasi").prop("disabled",false).attr("style","background-color:#ccffcc;");
}
function gajadi(){
	$("#rwAct").show();
	$("#btAct").hide();
	$("#rekomendasi").prop("disabled",true).attr("style","background-color:#FFFF99;");
}
function simpann(){
	var rekomendasi = $("#rekomendasi").val();
	var idd = $("#id_peg_rekomendasi").val();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/profile_pegjab/rekomendasi_edit",
			data:{"idd": idd,"rekomendasi": rekomendasi },
			beforeSend:function(){	
				$("#btAct").hide();
				$("#spAct").show();
			},
			success:function(data){
				$("#spAct").hide();
				$('#rwAct').show();
				$("#rekomendasi").prop("disabled",true).attr("style","background-color:#FFFF99;").val(data);
			},
			dataType:"html"});
}
</script>