							<div class="row" style="padding-bottom:15px;padding-top:15px;">
								<div class="col-lg-2"><b>Hasil kerja:</b></div>
								<div class="col-lg-10">
								<input type="text" name="hasil" id="hasil" value="<?=@$val->hasil;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<div class="row" style="padding-bottom:15px;">
								<div class="col-lg-2"><b>Satuan:</b></div>
								<div class="col-lg-10">
								<input type="text" name="satuan" id="satuan" value="<?=@$val->satuan;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<input type="hidden" id="id_hasil" name="id_hasil" value="<?=$idd;?>">


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
		location.href = '<?=site_url();?>module/appevjab/jabfung/hasil';
	},
	dataType:"html"});
	return false;
}
</script>
