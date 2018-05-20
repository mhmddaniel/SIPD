<div class="row">
	<div class="col-lg-12">
		<div class="page-header"><h1>Dashboard eDISIPLIN</h1></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading"><div class="btn btn-default btn-xs"><i class="fa fa-clock-o fa-fw"></i></div> <b>Token Absensi: <?=$hari;?></b> <div class="pull-right" id="output"><?=$jam;?></div></div>
			<div class="panel-body">
					  <div class="col-lg-6">
						<div class="panel panel-green">
							<div class="panel-heading"><i class="fa fa-sign-in fa-fw"></i> TOKEN MASUK</div>
							<div class="panel-body" style="text-align:right;"><font size="+5" id="token_masuk"><?=@$token->token_masuk;?></font></div>
						</div>
					  </div><!--/.col-lg-6-->
					  <div class="col-lg-6">
						<div class="panel panel-red">
							<div class="panel-heading"><i class="fa fa-sign-out fa-fw"></i> TOKEN PULANG</div>
							<div class="panel-body" style="text-align:right;"><font size="+5" id="token_pulang"><?=@$token->token_pulang;?></font></div>
						</div>
					  </div><!--/.col-lg-6-->
			</div><!--/.panel-body-->
		</div><!--/.panel-->
	</div><!--/.col-lg-8-->
	
  <div class="col-lg-4">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3"><i class="fa fa-calendar-minus-o fa-5x"></i></div>
						<div class="col-xs-9 text-right"><div class="huge"><?php echo $sisa_cuti ?></div>
						<div>hari</div>
					</div>
				</div>
				</div>
				<a href="<?php echo site_url('admin/module/appbina/cuti');?>">
				<div class="panel-footer">
					<span class="pull-left">Sisa Kuota Cuti Tahunan</span>
					<span class="pull-right">Lihat Detail <i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
				</a>
			</div>
  </div><!--/.col-lg-4-->
</div><!-- /.row -->


<script type="text/javascript">
$(document).ready(function() {
	waktu();
	anmPulang();
});
function anmPulang(){
	if("<?=@$token->token_masuk;?>" == "..."){
		var tandaMasuk = $("#token_masuk").html();
		tandaMasuk = tandaMasuk+".";
		if(tandaMasuk=="..........."){	tandaMasuk=".";	}
	}
	if("<?=@$token->token_pulang;?>" == "..."){
		var tandaPulang = $("#token_pulang").html();
		tandaPulang = tandaPulang+".";
		if(tandaPulang=="..........."){	tandaPulang=".";	}
	}
	$("#token_masuk").html(tandaMasuk);
	$("#token_pulang").html(tandaPulang);
	setTimeout("anmPulang()",300);  
}
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
</script>
