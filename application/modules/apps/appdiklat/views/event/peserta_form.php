<?php 
if($aksi=="tambah"){
?>
<div class="row" id="row_cari_nip" style="padding-top:25px;padding-left:15px;">
	<div class="col-lg-6">
			<form id="cari_nip" method="post">
			<span style="margin-right:5px;" class="btn btn-default pull-left" onclick="batal_setFt();"><i class="fa fa-backward fa-fw"></i> Batal</span>
			<span class="form-group input-group pull-left" style="width:250px;">
				<input class="form-control" type="text" name="nip" id="nip" placeholder="Masukkan NIP...">
				<span class="input-group-btn"><button class="btn btn-default" type="button" onclick="cari_nip();"><i class="fa fa-search"></i></button></span>
			</span>
			</form>
	</div><!--/.col-lg-6-->
</div><!--/.row-->
<?php
} else {
?>
saya...

<?php
}
?>
<script type="text/javascript">
function cari_nip(){
	$.ajax({
		type:"POST", 
		url:"<?=site_url();?>appbkpp/mutasi/cari_nip",
		data: $("#cari_nip").serialize(),
		beforeSend:function(){	
			$('#row_cari_nip').hide();
			$('<div id="reNIP"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>').insertAfter('#row_cari_nip');
		},
		success:function(data){
			if(data.id_pegawai){
				var idd = data.id_pegawai; 
				isiNip(idd);
			} else {
				alert("Pegawai dengan NIP tersebut TIDAK DITEMUKAN... Masukkan NIP Lain!!");
				$('#row_cari_nip').show();
				$('#reNIP').remove();
			}
		}, // end success
	dataType:"json"}); // end ajax
}

function isiNip(idd){
	var id_diklat_event = $('#id_diklat_event').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event/peserta_tambah_aksi",
		data:{"id_diklat_event":id_diklat_event,"id_pegawai":idd},
		success:function(data){
			batal_setFt();
			gridpaging_peserta("end");
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
