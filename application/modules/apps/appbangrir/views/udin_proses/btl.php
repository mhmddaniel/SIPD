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
Dokumen Ijin Pimpinan Belum di-UPLOAD, permohonan tidak bisa diajukan;<br>
<?php
}
?>
<?php
if(empty($akreditasi)){
$bar++;
?>
Dokumen Akreditasi Belum di-UPLOAD, permohonan tidak bisa diajukan;<br>
<?php
}
?>
<?php
if(empty($jadwal)){
$bar++;
?>
Dokumen Jadwal Belum di-UPLOAD, permohonan tidak bisa diajukan;<br>
<?php
}
?>
<?php
$cc = count($catatan);
if($cc==0){
$bar++;
?>
Tidak catatan pemroses untuk pemohon, permohonan tidak bisa dikembalikan;<br>
<?php
}
?>



<?php
if($bar==0){
?>
<div id='btAju' class="btn btn-danger" onclick="ajukan(); return false;"><i class="fa fa-fast-backward fa-fw"></i> Kembalikan</div>
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
		url:"<?=site_url();?>appbangrir/udin_proses/btl_aksi",
		data:{"id_udin": <?=$idd;?>},
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbangrir/udin_proses';
		},
		dataType:"html"});
}
</script>