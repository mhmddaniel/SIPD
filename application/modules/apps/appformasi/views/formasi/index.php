            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
					Formasi Kepegawaian
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



<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
		<div class="panel-heading">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-sitemap fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Generatif Unit Kerja</a></li>
											<li role="presentation"><a href="<?=site_url('module/appformasi/formasi/isolat');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Isolat Unit Kerja</a></li>
										</ul>
										Generatif Unit Kerja
									</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">


<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:40px;vertical-align:middle;">No.</th>
<th style="width:20px;vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:200px;vertical-align:middle;">KODE<br /><b>NAMA UNIT ORGANISASI</b><br />KUNCI PENCARIAN</th>
<th style="width:200px;vertical-align:middle;">KEBUTUHAN</b></th>
<th style="width:200px;vertical-align:middle;">EKSISTING</b></th>
<th style="width:200px;vertical-align:middle;">KURANG / LEBIH</th>
</tr>
</thead>
<tbody>
<tr height=5 id=gridhead style="display:none;">
<td align=right colspan=8 id=pg style='padding:0px;'>&nbsp;</td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->
</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.pageContent -->



<br/><br/>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1,0,0);
});
////////////////////////////////////////////////////////////////////////////
function gridpaging(hal,level,id_parent){
var bulan = $('#bulan_act').html();
var tahun = $('#tahun_act').html();
var tanggal = "01-"+bulan+"-"+tahun;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appformasi/formasi/gettree/",
				data:{"tanggal": tanggal, "level":level, "id_parent":id_parent},
				beforeSend:function(){	
					if(level == 0){
						$('<tr id="row_xx"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter("#gridhead");
					} else {
						$('<tr id="row_xx"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter($("#row_"+id_parent+""));
					}

					$('').insertAfter();
				},
				success:function(data){

if((data.hslquery.length)>0){   // start klo ada ada
			if(id_parent==0){var ni="";} else{var ni=$("#nomer_"+id_parent+"").html()+".";}
			var table="";
			var no=data.mulai;
			$.each( data.hslquery, function(index, item){
				table = table+ "<tr height=25 id=row_"+ item.idchild +">";
				table = table+ "<td align=left style='padding:3px;'><div id='nomer_"+item.idchild+"'>"+ni+no+"</div></td>";
//tombol aksi-->
				table = table+ '<td valign=top style="padding:5px 0px 0px 0px;" align=center>';
					table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
					table = table+ '<ul class="dropdown-menu" role="menu">';
					table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil2('+item.id_unor+',\'appbkpp/pejabat/pemangku_riwayat\');return false;"><i class="fa fa-binoculars fa-fw"></i> Lihat pemangku jabatan</a></li>';
					table = table+ '</ul></div>';
				table = table+ '</td>';
//tombol aksi<--
////////////////tombol treegrid && variabel kunci-->
				table = table+ "<td style='padding: 3px 3px 3px "+item.spare +"px;'>";
				if(item.toggle == "tutup"){
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"gridpaging('"+hal+"','"+item.level+"','"+item.idchild+"');\"></i></div>";
				} else {
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-file-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div>";
				}
				table = table+ "<span style=\"display:table;\" id='nama_jenis_"+item.id_unor+"'>"+item.kode_unor+"<br /><b>"+item.nama_unor+ "</b><br />"+item.nomenklatur_cari+"</span>";
				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci<--
				table = table+ "<td align=left style='padding:3px;'>js: <b>"+item.a_js+"</b><br>jfu: <b>"+item.a_jfu+"</b><br>jft: <b>"+item.a_jft+"</b><br>guru: <b>"+item.a_guru+"</b></td>";
				table = table+ "<td align=left style='padding:3px;'>js: <b>"+item.js+"</b><br>jfu: <b>"+item.jfu+"</b><br>jft: <b>"+item.jft+"</b><br>guru: <b>"+item.guru+"</b></td>";
				table = table+ "<td align=left style='padding:3px;'>js: <b>"+item.s_js+"</b><br>jfu: <b>"+item.s_jfu+"</b><br>jft: <b>"+item.s_jft+"</b><br>guru: <b>"+item.s_guru+"</b></td>";
				table = table+ "</tr>"; 
			no++;
			}); //endeach
}  //tutup:: if data>0	

					if(level == 0){
						$('#row_xx').html("<td colspan=6 align=center><b>TIDAK ADA DATA</b></td>");
						if(data.hslquery.length>0){$('#row_xx').replaceWith(table); $('#pg').html(data.pager);}
					} else {
						$('#row_xx').remove();
						$(table).insertAfter($("#row_"+id_parent+""));
						$("#"+id_parent).replaceWith("<span class=\"fa tree fa-chevron-circle-down fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+id_parent+"'></span>");
					}
					
            }, //tutup::success
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
$(document).on('click', '.fa.tree',function(){
	var lvl = $(this).attr("data-expand");
	var idp = $(this).attr("id");
	if(lvl=='yes'){
		$("[id^='row_"+idp+"_']").hide();
		$("#"+idp).replaceWith("<span class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+idp+"'></span>");
	} else {
		$("[id^='"+idp+"_']").each(function(key,val) {
			var ini = $(this).attr("id");
			var status_ini = $(this).attr("data-expand");
			$("#row_"+ini+"").show();
			if(status_ini == "yes"){	$(this).removeClass("fa tree fa-chevron-circle-down fa-fw").addClass("fa tree fa-chevron-circle-right fa-fw").attr("data-expand","no");	}
		});
		$("[id^='"+idp+"_']").each(function(key,val) {	var ini = $(this).attr("id");	$("[id^='row_"+ini+"_']").hide();	});
		$("#"+idp).replaceWith("<span class=\"fa tree fa-chevron-circle-down fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+idp+"'></span>");
	}
//	zebra();
});


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

	$("[id^='row_']").remove();
	gridpaging(1,0,0);
//	ppost();
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

	$("[id^='row_']").remove();
	gridpaging(1,0,0);
//	ppost();
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
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}
.gridcell {	padding:0px;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
