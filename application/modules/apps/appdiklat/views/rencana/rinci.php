<div  id="pageKonten" style="padding-bottom:30px;">
<div id="id_diklat_event" style="display:none;"><?=$idd;?></div>
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<span><i class="fa fa-tags fa-fw"></i> <?=$rumpun;?> Tahun <?=$tahun;?></span>
					<span class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-close fa-fw"></i></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Jenis</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->jenis_diklat;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Nama Diklat</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><b><?=$diklat->nama_diklat;?></b></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Jenjang</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->jenjang_diklat;?></div></span>
									</div>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
                  <div class="panel panel-default">
                        <div class="panel-body" style="padding:0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pengusul" data-toggle="tab" id="key_pengusul"><i class="fa fa-child fa-fw"></i> Pengusul</a></li>
                                <li><a href="#peserta" data-toggle="tab" onClick="vTab('peserta');return false;" id="key_peserta"><i class="fa fa-trophy fa-fw"></i> Calon Peserta</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:25px 5px 5px 5px;">
                                <div class="tab-pane fade in active" id="pengusul">

<div class="table-responsive pengusul">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">UNIT KERJA</th>
<th style="text-align:center; vertical-align:middle">REKOMENDASI</th>
</tr>
</thead>
<tbody id="list_pengusul">
<?php
foreach($pengusul AS $key=>$val){
?>
<tr>
<td><?=$key+1;?></td>
<td>...</td>
<td><?=$val->nama_unor;?></td>
<td>
		<div class="row">
			<div class="col-lg-12">
				<div style="float:left; width:100px;">Penyelenggara</div>
				<div style="float:left; width:10px;"> : </div>
				<span><div style="display:table;"><?=$val->penyelenggara;?></div></span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div style="float:left; width:100px;">Tempat</div>
				<div style="float:left; width:10px;"> : </div>
				<span><div style="display:table;"><?=$val->tempat_diklat;?></div></span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div style="float:left; width:100px;">Durasi</div>
				<div style="float:left; width:10px;"> : </div>
				<span><div style="display:table;"><?=$val->jam;?> jam</div></span>
			</div>
		</div>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div><!-- table-responsive --->


<div class="row pengusul" id="rp_pengusul"><div id="paging_pengusul" class="col-lg-12"></div></div>


								</div><!--/. tab id=pengusul -->
                                <div class="tab-pane fade" id="peserta" style="padding-top:5px;">

						<div class="table-responsive prajabatan">
						<table class="table table-striped table-bordered table-hover">
						<thead id=gridhead>
						<tr height=20>
						<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
						<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
						<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP / PANGKAT (Gol.)</th>
						<th style="width:250px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA</th>
						<th style="width:150px;text-align:center; vertical-align:middle">STATUS PENCALONAN</th>
						</tr>
						</thead>
						<tbody id="list_peserta">
<?php foreach($calon AS $key=>$val){ ?>
<tr>
<td><?=$key+1;?></td>
<td>..</td>
<td><?="<b>".$val->nama_pegawai."</b> (".$val->gender.")<br>".$val->nip_baru;?><br><?=$val->nama_golongan." - ".$val->nama_pangkat;?></td>
<td><?=$val->nama_jabatan;?><br><u>pada</u> :<br><?=$val->nomenklatur_pada;?></td>
<td>...</td>
</tr>
<?php } ?>
						</tbody>
						</table>
						</div><!-- table-responsive --->
								</div>
							</div><!--/tab-content-->
						</div><!-- /.panel-body -->
				  </div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="tab_aktif" style="display:none;">pengusul</div>
<script type="text/javascript">
function pTab(tabini){
	batal_setFt();
	$('#tab_aktif').html(tabini);
	$('#'+tabini).addClass('in').addClass('active');
}
function vTab(tabini){
/*
	batal_setFt();
	var tab_aktif = $('#tab_aktif').html();
	$('#'+ tab_aktif).removeClass('in').removeClass('active');
	$('#tab_aktif').html(tabini);
	var id_diklat_event = $('#id_diklat_event').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event/"+tabini,
		data:{"id_diklat_event":id_diklat_event},
		beforeSend:function(){	
			$('#bt_tambah_isi_tab').hide();
			$('#'+tabini).html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').addClass('in').addClass('active');
		},
		success:function(data){
			$('#key_'+tabini).removeAttr('onClick').attr('onclick','pTab(\''+tabini+'\');return false;')
			$('#bt_tambah_isi_tab').show();
			$('#'+tabini).html(data);
		}, // end success
	dataType:"html"}); // end ajax
*/
}
$(document).ready(function(){
//	gridpaging_pengusul(1);
});
function repaging_pengusul(){
	$( "#paging_pengusul .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pengusul .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pengusul(inu);	}
	});
}
function gopaging_pengusul(){
	$("#paging_pengusul #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pengusul(ini);
	});
}
function regrid_pengusul(){
	var ini = $("#paging_pengusul #inputpaging").val();
	gridpaging_pengusul(ini);
}
function gridpaging_pengusul(hal){
var cari = $('#caripaging_pengusul').val();
var batas = $('#item_length_pengusul').val();
var id_diklat_event = $('#id_diklat_event').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event/getpengusul",
		data:{"hal": hal, "batas": batas,"cari":cari,"id_diklat_event":id_diklat_event},
		beforeSend:function(){	
			$('#list_pengusul').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pengusul').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rowjj_"+item.id_diklat_pengusul+"'>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj(\'appdiklat/event/pengusul_hapus\',\''+item.id_diklat_pengusul+'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						table = table+ '<li class="divider"></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj(\'rinci\',\''+item.id_diklat_pengusul+'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br>"+item.nip_baru+"</td>";
					table = table+ "<td>"+item.nama_golongan+" - "+item.nama_pangkat+"<br>"+item.nama_jabatan+"</td>";
					table = table+ "<td>"+item.nama_unor+"<br><u>pada</u> :<br>"+item.nomenklatur_pada+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_pengusul').html(table);
					$('#paging_pengusul').html(data.pager);
					repaging_pengusul();gopaging_pengusul();
			} else {
				$('#list_pengusul').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_pengusul').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}

function setFt(aksi,idd){
	batal_setFt();
	var tab_aktif = $('#tab_aktif').html();
	var id_diklat_event = $('#id_diklat_event').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event/"+tab_aktif+"_"+aksi,
		data:{"id_diklat_event":id_diklat_event,"idd":idd},
		beforeSend:function(){	
			$('#bt_tambah_isi_tab').hide();
			$('.'+tab_aktif).hide();
			$('<div id="actForm"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>').insertAfter('#rp_'+tab_aktif);
		},
		success:function(data){
			$('#actForm').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_setFt(){
	var tab_aktif = $('#tab_aktif').html();
	$('.'+tab_aktif).show();
	$('#bt_tambah_isi_tab').show();
	$('#actForm').remove();
}
function setFjj(aksi,idd){
	batal_setFjj();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd":idd},
		beforeSend:function(){	
			$('#rowjj_'+idd).addClass('success');
			$('<tr class="success" id="row_tt"><td colspan=5 align=center><i class="fa fa-spinner fa-spin fa-1x"></i></td></tr>').insertAfter('#rowjj_'+idd);
		},
		success:function(data){
			$('#row_tt').replaceWith(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_setFjj(){
	$('.row_tt').remove();
	$("[id^='rowjj_']").removeClass();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
