            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
					Generate Token Absen
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								<div id='maju_act' style="display:none;">0</div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();" id="bTt"><i class="fa fa-forward fa-fw"></i></div>
								</div>
					</h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
<br>
<div style="float:right;">
<div class="btn btn-info btn-sm" onclick="ppost(1);" id="mg_1">Minggu I</div> 
<div class="btn btn-info btn-sm" onclick="ppost(2);" id="mg_2">Minggu II</div> 
<div class="btn btn-info btn-sm" onclick="ppost(3);" id="mg_3">Minggu III</div> 
<div class="btn btn-info btn-sm" onclick="ppost(4);" id="mg_4">Minggu IV</div> 
<div class="btn btn-info btn-sm" onclick="ppost(5);" id="mg_5">Minggu V</div> 
</div>

<script type="text/javascript">
function bulan_plus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();

	$('#bTt').remove();
}
function nm_bulan(bln){
	var bulan = new Array();
    bulan[1] = 'Januari';
    bulan[2] = 'Februari';
    bulan[3] = 'Maret';
    bulan[4] = 'April';
    bulan[5] = 'Mei';
    bulan[6] = 'Juni';
    bulan[7] = 'Juli';
    bulan[8] = 'Agustus';
    bulan[9] = 'September';
    bulan[10] = 'Oktober';
    bulan[11] = 'November';
    bulan[12] = 'Desember';

	var nb_bulan = bulan[bln];
	return nb_bulan;
}
function ppost(minggu){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/absensi/gen_token_harian",
		data:{"minggu": minggu,"bulan":bulan,"tahun":tahun },
		beforeSend:function(){	
			$('#mg_'+minggu).html('<i class="fa fa-spinner fa-spin fa-1x"></i>');
		},
        success:function(data){
			$('#mg_'+minggu).remove();
		},
        dataType:"html"});
}
</script>