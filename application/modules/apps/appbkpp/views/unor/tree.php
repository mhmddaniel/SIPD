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
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-sitemap fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appbkpp/unor');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Daftar Unit Kerja per due-Date</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Tampilan hirarki</a></li>
											<?php if($master=="ya"){ ?>
											<li role="presentation" class="divider">
											<li role="presentation"><a href="<?=site_url('module/appbkpp/unor/master');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><div class="btn btn-primary btn-xs"><i class="fa fa-tasks fa-fw"></i></div> Daftar Unit Kerja Master</a></li>
											<?php } ?>
										</ul>
										Susunan Hirarki Unit Kerja
									</div>
								</div>
								<div class="col-lg-6">
									<input id="iptTanggal" class="form-control" type="text" onchange="bersih();gridpaging(1,0,0);" value="<?=date("d-m-Y");?>" style="float:right; width:100px; padding:3px; background-color:#FFFF99; height:26px;">
									<div style="float:right; padding-top:3px;padding-right:5px;">due-Date: </div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">


<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:85px;vertical-align:middle;">No.</th>
<th style="width:40px;vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:450px;vertical-align:middle;">KODE<br /><b>NAMA UNIT ORGANISASI</b><br />KUNCI PENCARIAN</th>
<th style="width:450px;vertical-align:middle;">ESELON<br /><b>JABATAN STRUKTURAL</b></th>
<th style="width:110px;text-align:center; vertical-align:middle">MASA BERLAKU</b></th>
<th style="width:55px;vertical-align:middle;"><b>id</b></th>
</tr>
</thead>
<tbody>
<tr height=5 id=gridhead>
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


<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();" id="btBTL"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				  <div class="row">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" nama="kode_jabatan" id="kode_jabatan" value="<?=@$unit->kode_kelas_jabatan;?>" class="form-control" disabled style="width:300px; background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" nama="nama_jabatan" id="nama_jabatan" value="<?=@$unit->nama_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Unit kerja:</b></div>
								<div class="col-lg-10">
								<input type="text" nama="unit_kerja" id="unit_kerja" value="<?=@$unit->nama_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row" style="padding-bottom:10px;">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kelas jabatan:</b></div>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" value="" class="form-control" id="kelas_jabatan" disabled>
										<span class="input-group-btn"><div class="btn btn-default" onclick="pilShow();" id="btnPil"><i class="fa fa-search"></i></div></span>
									</div>
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

					<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
						<input type="hidden" name="id_unor" id="id_unor">
						<input type="hidden" name="idJt" id="idJt">
					</form>
						<div id="isiForm"></div>
						<div id="tbForm" style="text-align:right;">
							<button id="btAct"></button>
							<button type=button class="btn btn-default" onClick='tutupForm();' id='btBatal'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
						</div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!--/.row-->
<div id="sub_konten2" style="padding-bottom:30px; display:none;"></div>

<br/><br/>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1,0,0);
});
////////////////////////////////////////////////////////////////////////////
function gridpaging(hal,level,id_parent){
var tanggal = $('#iptTanggal').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/unor/gettree/",
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
					<?php if($master=="ya"){ ?>
					table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF(\'formsetup\','+item.id_unor+');"><i class="fa fa-gear fa-fw"></i> Set Kelas Jabatan</a></li>';
					table = table+ '<li role="presentation" class="divider">';
					<?php } ?>
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
				table = table+ "<td align=left style='padding:3px;'><div id='kol_2_"+item.id_unor+"'><b>"+item.nomenklatur_jabatan+"</b><br />" +item.nama_ese+" <u>pada</u><br />"+item.nomenklatur_pada+"</div></td>";
				table = table+ "<td style='padding:3px;text-align:center'>"+item.tmt_berlaku+"</br>s.d.</br>"+item.tst_berlaku+"</td>";
				table = table+ "<td align=left style='padding:3px;'><div id='id_unor_"+item.id_unor+"'>"+item.nomenklatur_unor+"</div></td>";
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
function setF(tujuan,idd){
	var kop = []; 
	kop['formsetup'] = "FORM SETUP KELAS JABATAN"; 
	var act = []; 
	act['formsetup'] = "<?=site_url();?>appevjab/jabstruk/kelas_setup_aksi";
	var btt = []; 
	btt['formsetup'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabstruk/kelas_"+tujuan,
			data:{"idd": idd },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
				$('#pageFormTo').attr('action',act[tujuan]);
				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
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
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
