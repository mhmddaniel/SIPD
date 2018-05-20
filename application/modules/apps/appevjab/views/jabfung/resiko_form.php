							<div class="row" style="padding-bottom:15px;padding-top:15px;">
								<div class="col-lg-2"><b>Fisik/mental:</b></div>
								<div class="col-lg-10">
								<input type="text" name="fisik" id="fisik" value="<?=@$val->fisik;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<div class="row" style="padding-bottom:15px;">
								<div class="col-lg-2"><b>Penyebab</b></div>
								<div class="col-lg-10">
								<input type="text" name="penyebab" id="penyebab" value="<?=@$val->penyebab;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<input type="hidden" id="id_resiko" name="id_resiko" value="<?=$idd;?>">


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
		location.href = '<?=site_url();?>module/appevjab/jabfung/resiko';
	},
	dataType:"html"});
	return false;
}
</script>
