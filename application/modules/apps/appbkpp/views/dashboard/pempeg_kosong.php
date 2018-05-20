            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Selamat Datang...</h1>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->


<?php	if($tanggal==date('Y-m-d')){	?>
<div class="pull-left" id="output" style="font-size:24px;">10</div>
<?php } ?>
<?php if($tanggal<=date('Y-m-d')){ ?>
<a href="#" class="pull-right" id="bt_refresh" onclick="refresh_db();return false;">refresh</a>
<?php } ?>
<script type="text/javascript">
<?php	if($tanggal==date('Y-m-d')){	?>
$(document).ready(function(){
	waktu();
});
<?php } ?>
function refresh_db(){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/dashboard/pempegh",
		data:{"tanggal":"<?=$tanggal;?>"},
		beforeSend:function(){	
			$("#output").hide();
			$('#bt_refresh').replaceWith('<p class="pull-right"><i class="fa fa-spinner fa-spin fa-4x"></i><p>');
		},
		success:function(data){
			location.reload();
		}, // end success
	dataType:"html"}); // end ajax
}
function waktu() {   
	var waktu = $("#output").html();
	var detik = parseInt(waktu);
	detik = detik-1;
	$("#output").html(detik);

	if ( detik == 0 ){	refresh_db();	} else {	setTimeout("waktu()",1000);	} 
}
</script>
