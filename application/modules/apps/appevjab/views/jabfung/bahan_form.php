							<div class="row" style="padding-bottom:15px;padding-top:15px;">
								<div class="col-lg-2"><b>Bahan kerja:</b></div>
								<div class="col-lg-10">
								<input type="text" name="bahan" id="bahan" value="<?=@$val->bahan;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<div class="row" style="padding-bottom:15px;">
								<div class="col-lg-2"><b>Penggunaan dalam tugas:</b></div>
								<div class="col-lg-10">
								<input type="text" name="penggunaan" id="penggunaan" value="<?=@$val->penggunaan;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
							</div>
							<input type="hidden" id="id_bahan" name="id_bahan" value="<?=$idd;?>">


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
		location.href = '<?=site_url();?>module/appevjab/jabfung/bahan';
	},
	dataType:"html"});
	return false;
}
</script>
