<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" id="isian">....</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="isi(1);return false;">1</div>
		 <div class="btn btn-default btn-lg" onclick="isi(2);return false;">2</div>
		 <div class="btn btn-default btn-lg" onclick="isi(3);return false;">3</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="isi(4);return false;">4</div>
		 <div class="btn btn-default btn-lg" onclick="isi(5);return false;">5</div>
		 <div class="btn btn-default btn-lg" onclick="isi(6);return false;">6</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="isi(7);return false;">7</div>
		 <div class="btn btn-default btn-lg" onclick="isi(8);return false;">8</div>
		 <div class="btn btn-default btn-lg" onclick="isi(9);return false;">9</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="clearr();return false;"><i class="fa fa-backward fw"></i></div>
		 <div class="btn btn-default btn-lg" onclick="isi(0);return false;">0</div>
		 <div class="btn btn-default btn-lg" onclick="okk();return false;" id="bt_token">OK</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="margin-top:200px;">
	<div class="col-lg-12">...</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<script type="text/javascript">
function isi(inn){
	var isian = $("#isian").html();
	var lnt = isian.length;
	if(lnt==4){	var ist=inn;	} else { var ist = isian+inn;}
	$('#isian').html(ist);
}
function clearr(){
	$('#isian').html("....");
}
function okk(){
	var isian = $("#isian").html();
	var lnt = isian.length;
	if(lnt==4){	kirim(isian);	}
}
function kirim(token){
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbina/token/input",
			data:{"token": token },
			beforeSend:function(){
				$("#bt_token").replaceWith("<div id='bt_token'><p class='text-center'><i class='fa fa-spinner fa-spin fa-3x'></i><p></div>");
			},
			success:function(data){
				alert(data);
				$('#bt_token').replaceWith('<div class="btn btn-default btn-lg" onclick="okk();return false;" id="bt_token">OK</div>');
				clearr();
			},
        dataType:"html"});
}
</script>
