<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div>
<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appbkpp/pejabat');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Daftar Pemangku Jabatan</a></li>
											<li role="presentation"><a href="<?=site_url('module/appbkpp/pejabat/kosong');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-toggle-off fa-fw"></i> Daftar Jabatan Kosong</a></li>
											<li role="presentation"><a href="<?=site_url('module/appbkpp/pejabat/rangkap');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-toggle-on fa-fw"></i> Daftar Jabatan Rangkap</a></li>
											<li role="presentation" class="divider"></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Tampilan hirarki</a></li>
										</ul>
										Daftar Hirarki Pemangku Jabatan
									</div>
								</div>
								<div class="col-lg-6">
									<input id="iptTanggal" class="form-control" type="text" onchange="bersih();gridpaging(1,0,0);" value="<?=date("d-m-Y");?>" style="float:right; width:100px; padding:3px; background-color:#FFFF99; height:26px;">
									<div style="float:right; padding-top:3px;padding-right:5px;">due-Date: </div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div id="gridRubrikartikel">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:110px;text-align:center; vertical-align:middle">No.</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:400px;text-align:center; vertical-align:middle">JABATAN STRUKTURAL<br /><b>ESELON / UNIT KERJA</b></th>
<th style="width:545px;text-align:center; vertical-align:middle">PEMANGKU JABATAN</th>
</tr>
</thead>
<tbody>
<tr height=5 id=gridhead>
<td align=right colspan=8 id=pg style='padding:0px;'>&nbsp;</td>
</tr>
</tbody>
</table>
			</div>
			<!-- table-responsive --->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>











</div>
</div>
		</div>
	</div>
		</div>

<div id="sub_konten2" style="padding-bottom:30px; display:none;"></div>
<br/><br/>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1,0,0);
});
////////////////////////////////////////////////////////////////////////////
function gridpaging(hal,level,id_parent){
var tanggal = $('#iptTanggal').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/pejabat/gettree/",
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


					var pemangku="";
					if(item.pejabat){
							var no2 = 1;
							$.each( item.pejabat, function(index, item2){
								pemangku = pemangku+'<div style="clear:both;">';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="display:table;"><b>'+item2.nama_pegawai+'</b></div>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div style="clear:both;">';
										pemangku = pemangku+'<div style="width:105px;float:left;">NIP / Pangkat</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.nip_baru+' / '+item2.nama_pangkat+" - "+item2.nama_golongan+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="width:105px;float:left;">TMT Pkt/Jab/Es.</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.tmt_pangkat+' / <b>'+item2.tmt_jabatan+'</b> / '+item2.tmt_ese+'</div></span>';
									pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								no2++;
							});
					}

				table = table+ "<tr height=25 id=row_"+ item.idchild +">";
				table = table+ "<td align=left style='padding:3px;'><div id='nomer_"+item.idchild+"'>"+ni+no+"</div><br>"+item.kode_unor+"</td>";
				table = table+ "<td align=center style='padding:3px;'>";
//				table = table+ '<div class="btn btn-default btn-xs" onClick="detil2('+item.id_unor+',\'appbkpp/pejabat/pemangku_riwayat\');return false;"><i class="fa fa-binoculars fa-fw"></i></div>';


					table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
					table = table+ '<ul class="dropdown-menu" role="menu">';
					<?php if($master=="ya"){ ?>
					table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil2('+item.id_unor+',\'appevip/fungsi\',\'dd\');"><i class="fa fa-gear fa-fw"></i> Set Fungsi Jabatan</a></li>';
					table = table+ '<li role="presentation" class="divider">';
					<?php } ?>
					table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil2('+item.id_unor+',\'appbkpp/pejabat/pemangku_riwayat\');return false;"><i class="fa fa-binoculars fa-fw"></i> Lihat pemangku jabatan</a></li>';
					table = table+ '</ul></div>';




				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci-->
				table = table+ "<td style='padding: 3px 3px 3px "+item.spare +"px;'>";
				if(item.toggle == "tutup"){
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"gridpaging('"+hal+"','"+item.level+"','"+item.idchild+"');\"></i></div>";
				} else {
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-file-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div>";
				}
				table = table+ "<span style=\"display:table;\" id='nama_jenis_"+item.id_unor+"'><b>"+item.nomenklatur_jabatan+"</b><br />"+item.nama_ese+" <u>pada</u><br />"+item.nomenklatur_pada+"</span>";
				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci<--
				table = table+ "<td align=left style='padding:3px;'><div id='kol_2_"+item.id_unor+"'>"+pemangku+"</div></td>";
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
					
//					loadDialogTutup();
//				zebra();
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

function bersih(){
	$("[id^='row_']").remove();
}

function detil2(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#pageKonten").hide();
			$('#sub_konten2').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten2').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup2(){
	$("#sub_konten2").html("").hide();
	$("#pageKonten").show();
}
</script>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}
.gridcell {	padding:0px;	}
</style>
