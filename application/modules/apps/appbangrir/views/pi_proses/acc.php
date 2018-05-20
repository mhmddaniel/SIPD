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

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor SIB</label>
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($sib->nomor_surat))?'':$sib->nomor_surat;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal SIB</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($sib->tanggal_surat))?'':date("d-m-Y", strtotime($sib->tanggal_surat));?>" <?=(isset($hapus))?"disabled":"";?> class="form-control" placeholder="DD-MM-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>

<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-check fa-fw"></i> Acc</div>
<?php
}
?>

		</div>
	</div>
</div>

<script type="text/javascript">
function ajukan(){
		var nomor = $("input[name='nomor']").val();
		var tanggal = $("input[name='tanggal']").val();
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbangrir/pi_proses/acc_aksi",
		data:{"id_pi": <?=$idd;?>,"nomor": nomor,"tanggal": tanggal },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbangrir/pi_proses';
		},
		dataType:"html"});
}
</script>