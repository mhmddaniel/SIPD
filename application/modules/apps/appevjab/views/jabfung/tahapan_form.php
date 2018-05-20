								<div class="col-lg-2"><b>Tahapan Uraian Tugas:</b></div>
								<div class="col-lg-10">
								<input type="text" name="tahapan" id="tahapan" value="<?=@$val->tahapan;?>" class="form-control" placeholder="Wajib di-isi!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>>
								</div>
				<input type="hidden" id="id_tahapan" name="id_tahapan" value="<?=$idt;?>">

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
		tutupFormTahapan();
		refreshTahapan();
	},
	dataType:"html"});
	return false;
}
</script>
