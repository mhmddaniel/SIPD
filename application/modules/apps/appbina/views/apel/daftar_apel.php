<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Rekapitulasi Absensi Apel Bulanan</h3>
	</div><!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="btn btn-primary btn-sm pull-right" onclick="batal();"><i class="fa fa-fast-backward fa-fw"></i>Kembali</div>
	</div>
</div>

						<div class="row" style="padding-top:15px;">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><span class="fa fa-calendar fa-fw"></span> <b>DAFTAR JADUAL APEL</b></div>
												<div class="col-lg-6">
			<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
			<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
			
			<div class="btn-group pull-right">
			<div class="btn btn-default btn-xs" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
			<div class="btn btn-warning btn-xs active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
			<div class="btn btn-default btn-xs" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
			</div>
												</div>
										</div>
									</div>
									<div class="panel-body">



			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">HARI - TANGGAL</th>
<th style="width:80px;text-align:center; vertical-align:middle">WAJIB HADIR</th>
<th style="width:80px;text-align:center; vertical-align:middle">HADIR</th>
<th style="width:80px;text-align:center; vertical-align:middle">SAKIT</th>
<th style="width:80px;text-align:center; vertical-align:middle">IJIN</th>
<th style="width:80px;text-align:center; vertical-align:middle">CUTI</th>
<th style="width:80px;text-align:center; vertical-align:middle">DINAS LUAR</th>
<th style="width:80px;text-align:center; vertical-align:middle">TANPA KETR.</th>
</tr>
</thead>
<tbody id=list>
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id=paging></div>

									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging('<?=$hal;?>');
});
function gridpaging(hal){
var bulan = $('#bulan_act').html();
var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/apel/getdaftar",
		data:{"bulan":bulan,"tahun":tahun},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=1;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_apel+"' style='height:35px;'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					if(item.id_apel==<?=$id_apel;?>){
						table = table+ '&nbsp;';
					} else {
						table = table+ '<button class="btn btn-success btn-xs" type="button" onclick="pilih('+item.id_apel+');"><i class="fa fa-check fa-fw"></i></button>';
					}
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.hari_apel+", "+item.tanggal_apel+" - "+item.waktu+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.wajib_apel+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.hadir+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.sakit+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.ijin+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.cuti+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.dl+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.tk+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);

			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=10 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function gopaging(){
	var gohal=$("#inputpaging").val();
	gridpaging(gohal);
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel');
	$('#sb_act').html('').submit();
}
function pilih(idd){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel/pilih');
	var tab = "<input type='hidden' name='idd' value='"+idd+"'>";
	$('#sb_act').html(tab).submit();
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
	gridpaging('end');
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
	gridpaging('end');
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
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
