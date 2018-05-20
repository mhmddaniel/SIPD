<div>
	<div style="width:100px; float:left; padding-top:7px;">Tahun</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tahun',(!isset($isi->tahun))?date('Y'):$isi->tahun,'class="form-control" style="width:50px; padding-left:2px; padding-right:2px;"');?>
		<?=form_hidden('id_tpp',(!isset($isi->id_tpp))?'':$isi->id_tpp);?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:100px; float:left; padding-top:7px;">Periode</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_dropdown('bulan_mulai',$this->dropdowns->bulan(),(!isset($isi->bulan_mulai))?'':$isi->bulan_mulai,'class="form-control" style="width:100px; padding-left:2px; padding-right:2px; float:left;"');?>
		<div style="float:left; padding-top:5px; margin:0px 2px 0px 2px;">s.d. <b>Desember</b></div>
		<?=form_hidden('bulan_selesai',12);?>
	</div></span>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<div style="width:100px; float:left; padding-top:7px;">Pejabat penilai</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table; width:160px;">
		<?=form_input('penilai',(!isset($isi->penilai))?'':$isi->penilai,'class="form-control" placeholder="NIP Pejabat Penilai" style="padding-right:3px;padding-left:3px;"');?>
	</div></span>
</div>
<script type="text/javascript">
	$('#colForm').attr('class','col-lg-6');
function ajukan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/rencana/aktif';
	},
	dataType:"html"});
	return false;
}
</script>
