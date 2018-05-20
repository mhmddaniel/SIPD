							<div class="row" style="padding-bottom:10px;">
								<div class="col-lg-2" style="padding-top:7px;"><b>Ikhtisar jabatan:</b></div>
								<div class="col-lg-10">
								<textarea name="ihtisar" id="ihtisar" class="form-control" style="background-color:#FFFF99;" rows="3"><?=@$unit->nomenklatur_unor;?></textarea>
								</div>
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
		location.href = '<?=site_url();?>module/appevjab/jabstruk/urtug';
	},
	dataType:"html"});
	return false;
}
</script>
