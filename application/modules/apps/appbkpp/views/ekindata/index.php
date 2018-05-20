<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
		<?=$satu;?>
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
		</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div class="row" id="detailpegawai">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div style="float:left;">
							<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
									<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setLog('log_data','LOG DATA');"><i class="fa fa-star fa-fw"></i> Log Data</a></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setLog('log_dokumen','LOG DOKUMEN');"><i class="fa fa-binoculars fa-fw"></i> Log Dokumen</a></li>
									<li class="divider"></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setLog('log_delta','LOG DELTA');"><i class="fa fa-binoculars fa-fw"></i> Log Delta</a></li>
								</ul>
							</div>
						</div>
						<span style="margin-left:5px;" id="judul_log"><b>LOG DATA</b></span>
			</div><!-- /.panel-heading -->
			<div class="panel-body" id="section">
			...
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<form id="sb_zoom" method="post"></form>

<script type="text/javascript">
$(document).ready(function(){
	viewTabPegawai('log_data');
});
function viewTabPegawai(section){
	$('#uppldok').hide();
	$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbkpp/ekindata/"+section,
			beforeSend:function(){
				$('#section').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i></p>');
			},
			success:function(data){
				$('#section').html(data);
			}, // end success
			error: function(data) {
			   alert('Gagal koneksi ke server'); 
			},
	dataType:"html"}); // end ajax
}
function setLog(lognya,judulnya){
	$('#judul_log').html(judulnya);
	viewTabPegawai(lognya);
}
function bulan_minus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	gridpaging(1);
}
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
	gridpaging(1);
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

function zoom_dok(komponen,idd,nip,hal){
	var nip_baru = nip;
	$('#sb_zoom').attr('action','<?=site_url();?>appdok/zoom/satu').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	var tab = tab + '<input type="hidden" name="hal" value="'+hal+'">';	
	$('#sb_zoom').html(tab).submit();
	$('#sb_zoom').removeAttr( "target" );
}

function thumb(){
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
}
</script>
<style>
.thumbnail {	position:relative;	overflow:hidden; margin-bottom:5px;	}
.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
