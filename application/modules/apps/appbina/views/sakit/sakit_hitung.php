<div class="row">
	<div class="col-lg-12">
		<div class="page-header"><h1><?=$satu;?></h1></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-4">
<label>Jam masuk:</label>
<input type=text class="form-control" id="jam_masuk" placeholder="jj:mm:dd">
<label>Absen masuk:</label>
<input type=text class="form-control" id="absen_masuk" placeholder="jj:mm:dd">
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-4" style="padding-top:25px;">
		<div class="btn btn-primary btn-sm" onclick="masuk();"><i class="fa fa-gear fa-fw"></i> Hitung</div>
		<div id="masuk"></div>
	</div><!-- /.col-lg-4 -->
</div><!-- /.row -->
<br><br>
<div class="row">
	<div class="col-lg-4">
<label>Jam pulang:</label>
<input type=text class="form-control" id="jam_pulang" placeholder="jj:mm:dd">
<label>Absen pulang:</label>
<input type=text class="form-control" id="absen_pulang" placeholder="jj:mm:dd">
	</div><!-- /.col-lg-4 -->
	<div class="col-lg-4" style="padding-top:25px;">
		<div class="btn btn-warning btn-sm" onclick="pulang();"><i class="fa fa-gear fa-fw"></i> Hitung</div>
		<div id="pulang"></div>
	</div><!-- /.col-lg-4 -->
</div><!-- /.row -->
<?php
echo date("i");
?>
<script type="text/javascript">
function masuk(){
		var j_masuk = $('#jam_masuk').val();
		var a_masuk = $('#absen_masuk').val();

		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/sakit/hitung_masuk",
		data:{"j_masuk": j_masuk,"a_masuk": a_masuk },
		beforeSend:function(){
			$('#masuk').html('<div id="spinner_keterangan"><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></div>');
		},
        success:function(data){
			$('#masuk').html(data);
		},
        dataType:"html"});
}
function pulang(){
		var j_pulang = $('#jam_pulang').val();
		var a_pulang = $('#absen_pulang').val();

		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/sakit/hitung_pulang",
		data:{"j_pulang": j_pulang,"a_pulang": a_pulang },
		beforeSend:function(){
			$('#pulang').html('<div id="spinner_keterangan"><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></div>');
		},
        success:function(data){
			$('#pulang').html(data);
		},
        dataType:"html"});
}
</script>
			

