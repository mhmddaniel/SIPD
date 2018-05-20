<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?>
		<a href="<?=site_url('module/appbkpp/mutasi/kembali_rancangan');?>" class="pull-right" id="bt_kembali"><div class="btn btn-warning btn-xs"><i class="fa fa-backward fa-fw"></i> Kembali</div></a>
		 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="tabel_1">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><div class="btn btn-default btn-xs"><i class="fa fa-user fa-fw"></i></div> <b>Daftar Pegawai Non Jabatan Struktural</b></div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:110px;text-align:center; vertical-align:middle">No.</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">JABATAN STRUKTURAL<br /><b>UNIT KERJA</b></th>
<th style="width:200px;text-align:center; vertical-align:middle">BANYAKNYA PEGAWAI<br>KUMULATIF</th>
<th style="width:200px;text-align:center; vertical-align:middle">BANYAKNYA PEGAWAI<br>UNIT</th>
<th style="width:200px;text-align:center; vertical-align:middle">JUMLAH PEGAWAI</th>
</tr>
</thead>
<tbody>
<tr height=5 id="gridhead" style="display:none;">
<td align=right colspan=8 id=pg style='padding:0px;'>&nbsp;</td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->

			</div><!--/.panel-body-->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1,0,0);
});
////////////////////////////////////////////////////////////////////////////
function gridpaging(hal,level,id_parent){
var tanggal = "2-1-2017";
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appsotkbaru/njs2017/gettree/",
				data:{"tanggal": tanggal, "level":level, "id_parent":id_parent},
				beforeSend:function(){	
					if(level == 0){
						$("[id^='row_']").remove();
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
				if(item.toggle == "tutup"){ var terkecil = "tidak";	} else {	var terkecil = "ya";	}
				table = table+ "<td align=center style='padding:3px;'>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil(\''+item.id_unor+'**'+terkecil+'**'+level+'**'+id_parent+'\',\'appsotkbaru/njs2017/daftar_pegawai\');return false;"><i class="fa fa-binoculars fa-fw"></i> Lihat Daftar Pegawai</a></li>';
						table = table+ '<li class="divider"></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil(\''+item.id_unor+'**'+terkecil+'**'+level+'**'+id_parent+'\',\'appsotkbaru/njs2017/tambahpegawai_form\');return false;"><i class="fa fa-sign-in fa-fw"></i> Tambah Pegawai</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
				table = table+ "</td>";
//tombol aksi<--
////////////////tombol treegrid && variabel kunci-->
				table = table+ "<td style='padding: 3px 3px 3px "+item.spare +"px;'>";
				if(item.toggle == "tutup"){
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"gridpaging('"+hal+"','"+item.level+"','"+item.idchild+"');\"></i></div>";
				} else {
					table = table+ "<div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa fa-file-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div>";
				}
				table = table+ "<span style=\"display:table;\" id='nama_jenis_"+item.id_unor+"'><b>"+item.nomenklatur_jabatan+"</b><br />"+item.nama_ese+", <u>pada</u><br />"+item.nomenklatur_pada+"</span>";
				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci<--
				table = table+ "<td align=left style='padding:3px 3px 3px 15px;'>";
				if(item.toggle == "tutup"){
				table = table+ "<div><i class='fa fa-tasks fa-fw'></i> JFU: "+item.jfu+"</div>";
				table = table+ "<div><i class='fa fa-support fa-fw'></i> JFT: "+item.jft+"</div>";
				if(item.guru!=0){table = table+ "<div><i class='fa fa-user-plus fa-fw'></i> GURU: "+item.guru+"</div>";}
				}
				table = table+ "</td>";
				table = table+ "<td align=left style='padding:3px 3px 3px 15px;'>";
				if(item.toggle != "tutup"){
					table = table+ "<div><i class='fa fa-tasks fa-fw'></i> JFU :: "+item.jfu_u+"</div>";
					table = table+ "<div><i class='fa fa-support fa-fw'></i> JFT :: "+item.jft_u+"</div>";
					if(item.guru_u!=0){table = table+ "<div><i class='fa fa-user-plus fa-fw'></i> GURU :: "+item.guru_u+"</div>"};
				}
				table = table+ "</td>";
				table = table+ "<td align=left style='padding:3px 3px 3px 7px;'>";
				if(item.toggle == "tutup"){table = table+ "<b>KUMULATIF :: "+item.jumlah+"</b><br>";}
				if(item.toggle == "tutup"){table = table+ "UNIT :: "+item.jumlah_u+"</div>";} else {table = table+ "<b>UNIT :: "+item.jumlah_u+"</b>";}
				table = table+ "</td>";
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
});


function detil(idd,aksi){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>"+aksi,
				data:{"idd": idd},
				beforeSend:function(){	
					$('<div id="tabel_2"><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></div>').insertAfter("#tabel_1");
					$("#tabel_1").hide();
				},
				success:function(data){
					$("#tabel_2").html(data);
					$("#bt_kembali").hide();
	            }, //tutup::success
        dataType:"html"});
}
</script>
