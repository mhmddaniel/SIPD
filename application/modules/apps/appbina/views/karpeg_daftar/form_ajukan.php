<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">
<?php
$bar = 0;
?>


<?php
if(empty($ijin)){
$bar++;
?>
Ijin/Pengantar Belum di-UPLOAD, permohonan tidak bisa diajukan;<br>
<?php
}
?>
<?php
$cc = count($catatan);
if($cc>0){
$bar++;
?>
Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
<?php
}
?>



<?php
if($bar==0){
?>
<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
<?php
}
?>

		</div>
	</div>
</div>

<script type="text/javascript">
function ajukan(){
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/karpeg_daftar/ajukan_aksi",
		data:{"id_karpeg": <?=$idd;?> },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbina/karpeg_daftar';
		},
		dataType:"html"});
}
</script>