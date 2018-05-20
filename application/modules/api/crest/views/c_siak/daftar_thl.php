<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>Tenaga Harian Lepas <small>Kota Tangerang</small></h1>
		</div><!-- Registration form - START -->
	</div>
</div>
<div class="row" id="main_konten">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6" style="padding-top:8px;">
			<div class="btn btn-primary btn-xs" onclick="ppost('module/crest/c_siak/cetak');return false;"><i class="fa fa-print fa-fw"></i></div> Daftar THL
								</div>
								<div class="col-lg-6">
													<select id="a_aktif_thl_kode_unor" name="a_aktif_thl_kode_unor" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua Unit Kerja</option>
														<?php
															foreach($unor as $key=>$val){
																echo '<option value="'.$val->kode_unor.'">'.$val->nama_unor.'</option>';															
															}
														?>
													</select>
								</div>
						</div>
			
			</div>
			<div class="panel-body"  style="padding:5px;">


<div class="row" style="padding:15px 0px 5px 0px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_aktif_thl" style="width:70px;" onchange="gridpagingA('end')">
							<option value="10" selected>10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
							</select>
							</div>
							<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging_aktif_thl" onchange="gridpagingA('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr id="head_thl">
			<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:250px;text-align:center; vertical-align:middle">NAMA / GENDER / NIK / KK<br />TEMPAT, TANGGAL LAHIR / AGAMA</th>
			<th style="width:250px;text-align:center; vertical-align:middle">ALAMAT</th>
			<th style="width:250px;text-align:center; vertical-align:middle">UNIT KERJA</th>
		</tr>
	</thead>
<tbody id="list_aktif_thl"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_aktif_thl"></div>
			</div><!--//panel-body-->
		</div><!--//panel-->
	</div><!--//col-lg-12-->
</div><!--//row-->


<script type="text/javascript">
$(document).ready(function(){
	gridpagingA('end');
});
function repaging_aktif_thl(){
	$( "#paging_aktif_thl .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_aktif_thl .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopaging_aktif_thl(){
	$("#paging_aktif_thl #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}
//function regrid_aktif_thl(){
function regrid(){
	var ini = $("#paging_aktif_thl #inputpaging").val();
	gridpagingA(ini);
}
function gridpagingA(hal){
	var cari = $('#caripaging_aktif_thl').val();
	var batas = $('#item_length_aktif_thl').val();
	var kode = $('#a_aktif_thl_kode_unor').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>crest/c_siak/get_thl",
		data:{"hal": hal, "batas": batas,"cari":cari,"kode":kode},
		beforeSend:function(){	
			$('#list_aktif_thl').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_aktif_thl').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+" / "+item.rhesus+"<br>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.agama+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.jalan+"<br>RT."+item.rt+" / RW."+item.rw+" - Kel. "+item.kel_desa+"<br>Kec. "+item.kecamatan+" - "+item.kab_kota+"<br>"+item.propinsi+" - "+item.kode_pos+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_unor+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_aktif_thl').html(table);
					$('#paging_aktif_thl').html(data.pager);
					repaging_aktif_thl();gopaging_aktif_thl();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_aktif_thl').html(ini);

			} else {
				$('#list_aktif_thl').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_aktif_thl').html("");
			} // end if
			
			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}

		}, // end success
	dataType:"json"}); // end ajax
}

function ppost(tuju){
	var kode = $('#a_aktif_thl_kode_unor').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>crest/c_siak/cetak",
		data:{"kode":kode},
		beforeSend:function(){	
			$('<div class="row" id="pil_cetak"><div class="col-lg-12"><i class="fa fa-spinner fa-spin fa-5x"></i></div></div>').insertAfter('#main_konten');
			$('#main_konten').hide();
		},
		success:function(data){
			$('#pil_cetak').replaceWith(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function kembali(){
	$('#pil_cetak').remove();
	$('#main_konten').show();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
