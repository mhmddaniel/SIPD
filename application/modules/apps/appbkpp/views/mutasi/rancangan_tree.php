<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div>
<div id="pageKonten" style="padding-bottom:30px;">

<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i></div> <b><?=$rancangan->nama_rancangan;?></b>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Tahun</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$rancangan->tahun;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">TMT Jabatan</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;" id="tg_jab"><?=$rancangan->periode;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Status</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;" id="status_rancangan"><?=($rancangan->status=="fix")?"Arsip":"Aktif";?></div></span>
									</div>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
							<div class="btn btn-primary btn-xs"><i class="fa fa-recycle fa-fw"></i></div> <b>Daftar Hirarki Pemangku Jabatan</b>
							<a href="<?=site_url('module/appbkpp/mutasi/kembali_rancangan');?>" class="pull-right"><div class="btn btn-warning btn-xs"><i class="fa fa-list fa-fw"></i></div></a>
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
<th style="width:400px;text-align:center; vertical-align:middle">JABATAN STRUKTURAL<br /><b>ESELON / UNIT KERJA</b></th>
<th style="width:545px;text-align:center; vertical-align:middle">PEMANGKU JABATAN</th>
</tr>
</thead>
<tbody>
<tr height=5 id="gridhead" style="display:none;">
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
tutup();
var tanggal = $('#tg_jab').html();
var status_rancangan = $('#status_rancangan').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/mutasi/gettree/",
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
					var pemangku="";
					if(item.pejabat){
							var no2 = 1;
							$.each( item.pejabat, function(index, item2){
								pemangku = pemangku+'<div style="clear:both;">';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="float:left;padding-right:5px;">';
											pemangku = pemangku+'<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
											pemangku = pemangku+'<ul class="dropdown-menu" role="menu">';
											pemangku = pemangku+'<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSub(\'appbkpp/profile/pns_ini\',\''+item2.id_pegawai +'\',\''+item.idchild +'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian data pegawai</a></li>';
											if(status_rancangan=="Aktif" && item2.status==1){	pemangku = pemangku+'<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setKembali(\'appbkpp/mutasi/kembali_jabatan_asal\',\''+item2.id_pegawai +'\',\''+item.idchild +'\');"><i class="fa fa-fast-backward fa-fw"></i> Kembalikan ke jabatan semula</a></li>';	}
											pemangku = pemangku+'</ul>';
											pemangku = pemangku+'</div>';
										pemangku = pemangku+'</div>';
										pemangku = pemangku+'<span><div style="display:table;">'+item2.nama_pegawai+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div style="clear:both;">';
										pemangku = pemangku+'<div style="width:105px;float:left;">NIP / Pangkat</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.nip_baru+' / '+item2.nama_pangkat+" - "+item2.nama_golongan+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="width:105px;float:left;">TMT Pkt./Ese.</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.tmt_pangkat+' / '+item2.tmt_ese+'</div></span>';
									pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								no2++;
							});
					}

								if(status_rancangan=="Aktif"){
								pemangku = pemangku+'<div style="clear:both;float:right;margin-bottom:0px;">';
								pemangku = pemangku+'<span style="margin-left:5px;" class="btn btn-default" onclick="setSub(\'appbkpp/mutasi/picker_pegawai\',\''+item.id_unor +'\',\''+item.idchild +'\');"><i class="fa fa-caret-down fa-fw"></i></span>';
								pemangku = pemangku+'<div class="form-group input-group" style="float:left;width:230px;">';
								pemangku = pemangku+'<input id="nip_baru_'+item.id_unor+'" class="form-control row-fluid" type="text" style="padding-left:5px;padding-right:5px;" placeholder="Masukkan NIP kandidat..." value="" name="nip_baru">';
								pemangku = pemangku+'<span class="input-group-btn">';
								pemangku = pemangku+'<button class="btn btn-default" type="button" onclick="cari_nip('+item.id_unor+');"><i class="fa fa-search"></i></button>';
								pemangku = pemangku+'</span>';
								pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								}

				table = table+ "<tr height=25 id=row_"+ item.idchild +">";
				table = table+ "<td align=left style='padding:3px;'><div id='nomer_"+item.idchild+"'>"+ni+no+"</div></td>";
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
tutup();
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

function cari_nip(idd){
	var tmt_jabatan = $('#tg_jab').html();
	var nip = $('#nip_baru_'+idd).val();

	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/mutasi/cari_nip_kandidat",
		data: {"nip":nip, "tmt_jabatan":tmt_jabatan, "id_unor":idd},
		beforeSend:function(){	
//			$('#ipt_nip').hide();
//			$('#ipt_spin').show();
		},
		success:function(data){
			if(data.id_pegawai){
				gridpaging(1,0,0);
			} else {
				alert("Pegawai dengan NIP tersebut TIDAK DITEMUKAN... Masukkan NIP Lain!!");
			}
		}, // end success
	dataType:"json"}); // end ajax
}

function pick_ini(nip,idunor){
	$('#nip_baru_'+idunor).val(nip);
	cari_nip(idunor);
}

function setKembali(aksi,idd,no){
	var tmt_jabatan = $('#tg_jab').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data: {"idd":idd,"tmt_jabatan":tmt_jabatan, "id_unor":no},
		beforeSend:function(){	
//			$('#ipt_nip').hide();
//			$('#ipt_spin').show();
		},
		success:function(data){
			gridpaging(1,0,0);
		}, // end success
	dataType:"html"}); // end ajax
}

function setSub(aksi,idd,no){
	tutup();
	var tmt_jabatan = $('#tg_jab').html();
	$('.btn.batal').click();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd": idd,"tmt_jabatan":tmt_jabatan,"boleh":"tidak" },
		beforeSend:function(){
			$('#row_'+no).addClass('success');
			$('<tr id="row_tt" class="success"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#row_'+no);
		},
        success:function(data){
			$('#form_sub').attr('action','<?=site_url("appbkpp/mutasi/formsub_");?>'+aksi+'_aksi');
			$('#row_tt').html('<td colspan=10>'+data+'</td>');
		},
        dataType:"html"});
}
function tutup(){
	$('#row_tt').remove();
	$("[id^='row_']").removeClass();
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}
.gridcell {	padding:0px;	}
</style>
