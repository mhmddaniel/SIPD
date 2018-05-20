<div class="row">
	<div class="col-lg-12">
					<div class="page-header"><h1><?=$satu;?></h1></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<form method="post" onSubmit="okk(); return false;" id="iniForm">
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-12">
		<span class="btn btn-primary btn-xs" style="width:140px; text-align:center;"><?=$hari;?></span>
		<a href="<?=site_url('module/appbina/absensi/umpeg');?>" class="btn btn-warning btn-xs"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" style="margin-bottom:5px">
	<div class="col-lg-12">
		 <div class="btn btn-primary btn-lg" style="width:110px; text-align:right;" id="output"><?=$jam;?></div>
		 <input type="text" class="btn btn-primary btn-lg" id="isian" style="width:105px; text-align:right;" value="" placeholder="...." onkeyup="isiB();return false;">
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-9">
		 <div class="btn btn-default btn-lg" onclick="isi(1);return false;" style="width:70px;">1</div>
		 <div class="btn btn-default btn-lg" onclick="isi(2);return false;" style="width:70px;">2</div>
		 <div class="btn btn-default btn-lg" onclick="isi(3);return false;" style="width:70px;">3</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="isi(4);return false;" style="width:70px;">4</div>
		 <div class="btn btn-default btn-lg" onclick="isi(5);return false;" style="width:70px;">5</div>
		 <div class="btn btn-default btn-lg" onclick="isi(6);return false;" style="width:70px;">6</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-12">
		 <div class="btn btn-default btn-lg" onclick="isi(7);return false;" style="width:70px;">7</div>
		 <div class="btn btn-default btn-lg" onclick="isi(8);return false;" style="width:70px;">8</div>
		 <div class="btn btn-default btn-lg" onclick="isi(9);return false;" style="width:70px;">9</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="margin-bottom:5px">
	<div class="col-lg-12">
		 <div class="btn btn-warning btn-lg" onclick="clearr();return false;" style="width:70px;"><i class="fa fa-backward fw"></i></div>
		 <div class="btn btn-default btn-lg" onclick="isi(0);return false;" style="width:70px;">0</div>
		 <input type="submit" class="btn btn-warning btn-lg" onclick="okk();return false;" style="width:70px;" id="bt_token" value="OK">
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</form>
<div class="row" style="margin-top:200px;">
	<div class="col-lg-12">...</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<script type="text/javascript">
$(document).ready(function() {
	waktu();
});
function waktu() {   
	var waktu = $("#output").html();
	var arr = waktu.split(":");

	var jam = parseInt(arr[0]);
	var menit = parseInt(arr[1]);
	var detik = parseInt(arr[2]);
	detik = detik+1;

	if ( detik == 60 ){	detik = 0;	menit = menit+1;	}
	if ( menit == 60 ){	menit = 0;	jam = jam+1;	}
	if ( jam == 24 ){	jam = 0;	}

	if ( jam < 10 ){	jam = "0" + jam;	}
	if ( menit < 10 ){	menit = "0" + menit;	}
	if ( detik < 10 ){	detik = "0" + detik;	}

	teksjam = jam + ":" + menit + ":" + detik;
	$("#output").html(teksjam);
	setTimeout("waktu()",1000);  
}
function isiB(){
	var isian = $("#isian").val();
	var lnt = isian.length;
	if(lnt==6){	var ist="";	} else { var ist = isian;}
	$('#isian').val(ist);
}
function isi(inn){
	var isian = $("#isian").val();
	var lnt = isian.length;
	if(lnt==5){	var ist=inn;	} else { var ist = isian+inn;}
	$('#isian').val(ist);
}
function clearr(){
	$('#isian').val("");
}
function okk(){
	var isian = $("#isian").val();
	var lnt = isian.length;
	if(lnt>2 && lnt<6){	kirim(isian);	}
}
function kirim(token){
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbina/token/input_pulang",
			data:{"token": token },
			beforeSend:function(){
				$("#bt_token").replaceWith("<div id='bt_token' class='btn btn-default btn-lg' style='width:70px;'><i class='fa fa-spinner fa-spin fa-1x'></i></div>");
			},
			success:function(data){
				alert(data);
				$('#bt_token').replaceWith('<div class="btn btn-success btn-lg" onclick="okk();return false;" style="width:70px;" id="bt_token">OK</div>');
				clearr();
				$("#isian").focus();
			},
        dataType:"html"});
}
</script>
