<div  id="pageKonten" style="padding-bottom:30px;">
<div id="id_diklat_event" style="display:none;"><?=$idd;?></div>
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<span><i class="fa fa-tags fa-fw"></i> <b><?=$diklat->nama_diklat;?> Tahun <?=$diklat->tahun;?> Angkatan <?=$diklat->angkatan;?></b></span>
					<span class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-close fa-fw"></i></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Tempat</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->tempat_diklat;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Waktu</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->tmt_diklat_alt;?> s.d. <?=$diklat->tst_diklat_alt;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Durasi</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->jam;?> jam</div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Penyelenggara</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;" id="tg_jab"><?=$diklat->penyelenggara;?></div></span>
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
                                <li class="active"><a href="#peserta" data-toggle="tab" onClick="pTab('peserta');return false;" id="key_peserta"><i class="fa fa-child fa-fw"></i> Peserta</a></li>
                               
								<li class="pull-right" style="padding: 2px 15px 5px 5px;">
									<div class="btn btn-primary btn-xs" id="bt_tambah_isi_tab" onclick="setFt('tambah','0');"><i class="fa fa-plus fa-fw"></i> Tambah data</div>
								</li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:5px;">
                                <div class="tab-pane fade in active" id="peserta">

<div class="row peserta">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_peserta" style="width:70px;" onchange="gridpaging_peserta(1)">
							<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
							<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
							<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
							<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
							</select>
							</div>
							<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging_peserta" onchange="gridpaging_peserta(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="table-responsive peserta">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP</th>
<th style="width:300px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />JABATAN</th>
<th style="width:300px;text-align:center; vertical-align:middle">UNIT KERJA</th>
</tr>
</thead>
<tbody id="list_peserta"></tbody>
</table>
</div><!-- table-responsive --->
<div class="row peserta" id="rp_peserta"><div id="paging_peserta" class="col-lg-12"></div></div>


								</div><!--/. tab id=peserta -->
                                <div class="tab-pane fade" id="widyaiswara" style="padding-top:5px;">Widyaiswara....</div>
                                <div class="tab-pane fade" id="modul" style="padding-top:5px;">Modul....</div>
                                <div class="tab-pane fade" id="jadwal" style="padding-top:5px;">Jadwal Diklat...</div>
							</div><!--/tab-content-->
						</div><!-- /.panel-body -->
				  </div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="tab_aktif" style="display:none;">peserta</div>
<script type="text/javascript">
function pTab(tabini){
	batal_setFt();
	$('#tab_aktif').html(tabini);
	$('#'+tabini).addClass('in').addClass('active');
}
function vTab(tabini){
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
}
$(document).ready(function(){
	gridpaging_peserta(1);
});
function repaging_peserta(){
	$( "#paging_peserta .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_peserta .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_peserta(inu);	}
	});
}
function gopaging_peserta(){
	$("#paging_peserta #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_peserta(ini);
	});
}
function regrid_peserta(){
	var ini = $("#paging_peserta #inputpaging").val();
	gridpaging_peserta(ini);
}
function gridpaging_peserta(hal){
var cari = $('#caripaging_peserta').val();
var batas = $('#item_length_peserta').val();
var id_diklat_event = $('#id_diklat_event').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event_peserta/getpeserta",
		data:{"hal": hal, "batas": batas,"cari":cari,"id_diklat_event":id_diklat_event},
		beforeSend:function(){	
			$('#list_peserta').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_peserta').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rowjj_"+item.id_diklat_peserta+"'>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						// table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj(\'appdiklat/event/peserta_hapus\',\''+item.id_diklat_peserta+'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						// table = table+ '<li class="divider"></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFt(\'rincian\',\''+item.id_diklat_peserta+'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--<div class="btn btn-primary btn-xs" id="bt_tambah_isi_tab" onclick="setFt('tambah','0');"><i class="fa fa-plus fa-fw"></i> Tambah data</div>
					table = table+ "<td><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br>"+item.nip_baru+"</td>";
					table = table+ "<td>"+item.nama_golongan+" - "+item.nama_pangkat+"<br>"+item.nama_jabatan+"</td>";
					table = table+ "<td>"+item.nama_unor+"<br><u>pada</u> :<br>"+item.nomenklatur_pada+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_peserta').html(table);
					$('#paging_peserta').html(data.pager);
					repaging_peserta();gopaging_peserta();
			} else {
				$('#list_peserta').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_peserta').html(data.pager);
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
