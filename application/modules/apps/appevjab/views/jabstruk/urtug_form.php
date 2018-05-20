							<div class="row" style="padding-bottom:15px;padding-top:15px;">
								<div class="col-lg-2"><b>Uraian tugas:</b></div>
								<div class="col-lg-10">
								<input type="text" name="uraian_tugas" id="uraian_tugas" value="<?=@$val->uraian_tugas;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
				<input type="hidden" id="id_urtug" name="id_urtug" value="<?=$idd;?>">


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
