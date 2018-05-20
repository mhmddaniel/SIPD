<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Pemantauan SKP</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-indent fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appskp/sett/pantau_target');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list-ol fa-fw"></i> Menyusun Target Kinerja</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list-ul fa-fw"></i> Menyusun Realisasi Kinerja</a></li>
											<li role="presentation" class="divider"></li>
											<li role="presentation"><a href="<?=site_url('module/appskp/sett/pantau_target_non');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list-ol fa-fw"></i> Tidak Menyusun Target Kinerja</a></li>
										</ul>
										<?=$satu;?> Tahun <span id="kop_tahun"><?=$tahun;?></span>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right">
										<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>


						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-6">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja</label>
													<select id="kode_unor" name="kode_unor" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																echo '<option value="'.$val->kode_unor.'">'.$val->nama_unor.'</option>';															
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Tahun</label>
													<select id="tahun" name="tahun" class="form-control" onchange="gettree();">
														<option value="2014">2014</option>
														<option value="2015">2015</option>
														<option value="2016" selected>2016</option>
													</select>
											</div>
										</div>
									</div>
								</div>
						</div>


			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="clear:both;"></div>
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging(1)">
<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
</select>
</div>
<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" value="<?=$cari;?>" placeholder="Masukkan kata kunci...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
<div style="float:right; margin:7px 5px 0px 0px;">Cari:</div>
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<div id="grid-data">
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
<thead id=gridhead>
	<tr height=20>
		<th style="padding:0px; width:50px;">No.</th>
		<th style="padding:0px; width:50px;">AKSI</th>
		<th style="width:200px;">TAHUN / PERIODE / STATUS</th>
		<th style="width:250px;" align=center>PEJABAT PENILAI</th>
		<th style="width:250px;" align=center>PEGAWAI</th>
	</tr>
</thead>
<tbody id=list>
	<tr id=isi class=gridrow><td colspan=8 align=center><b>Isi Records</b></td></tr>
</tbody>
</table>
		</div>
		<!-- table-responsive --->
	<div id=paging></div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.grid-data -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<br/><br/>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging('end');
});
function repaging(){
	$( "#paging .pagingframe div" ).addClass("btn btn-default");
	$( "#paging .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging(inu);	}
	});
}
function gopaging(){
	$("#paging #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging(ini);
	});
}
function regrid(){
	var ini = $("#paging #inputpaging").val();
	gridpaging(ini);
}
function gridpaging(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var tahun = $('#tahun').val();
var kode_unor = $('#kode_unor').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appskp/sett/get_pantau_realisasi/",
				data:{"hal": hal, "batas": batas,"cari":cari,"tahun":tahun,"kode_unor":kode_unor},
				beforeSend:function(){	
					$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
					$('#paging').html('');
				},
				success:function(data){
if((data.hslquery.length)>0){
			var table="";
			var no=data.mulai;
			$.each( data.hslquery, function(index, item){
				table = table+ "<tr><td>"+no+"</td>";
				table = table+ "<td align=center><a href='#' onclick='alih("+item.id_skp+"); return false;' style='cursor:pointer;'><button class='btn btn-default btn-xs'><i class='fa fa-binoculars fa-fw'></i></button></a></td>";
				table = table+ "<td>"+item.tahun+"<br/>"+item.bulan_mulai+" s.d. "+item.bulan_selesai+"<br/>"+item.status+"</td>";
				table = table+ '<td>';
				table = table+ '<div>';
				table = table+ '<div style="float:left; width:65px;">Nama</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;">'+item.penilai_nama_pegawai+'</div></span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">NIP</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span>'+item.penilai_nip_baru+'</span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">Pkt/Gol.</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span>'+item.penilai_nama_pangkat+' / '+item.penilai_nama_golongan+'</span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">Jabatan</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;">'+item.penilai_nomenklatur_jabatan+'</div><span>';
				table = table+ '</div>';
				table = table+ '<div style="float:left; width:65px;">Unit kerja</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;">'+item.penilai_nomenklatur_pada+'</div><span>';
				table = table+ '</div></td>';
				table = table+ '<td>';
				table = table+ '<div>';
				table = table+ '<div style="float:left; width:65px;">Nama</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;"><b>'+item.nama_pegawai+'</b></div></span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">NIP</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span>'+item.nip_baru+'</span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">Pkt/Gol.</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span>'+item.nama_pangkat+' / '+item.nama_golongan+'</span>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">Jabatan</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;">'+item.nomenklatur_jabatan+'</span></div>';
				table = table+ '</div>';
				table = table+ '<div style="clear:both">';
				table = table+ '<div style="float:left; width:65px;">Unit kerja</div>';
				table = table+ '<div style="float:left; width:10px;">:</div>';
				table = table+ '<span><div style="display:table;">'+item.nomenklatur_pada+'</div><span>';
				table = table+ '</div></td>';
				table = table+ "</tr>";
			no++;
			}); //endeach
				$('#list').html(table);
				$('#paging').html(data.pager);
				repaging();gopaging();
		} else {
			$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
			$('#paging').html("");
		} // end if
		}, // end success
        dataType:"json"});
}
function alih(idd){
	$.ajax({	type:"POST",	url:"<?=site_url();?>appskp/skp/alih_skp",	data:{"idd": idd},	success:function(data){	pindah();	}, dataType:"html"});
}
function pindah(){
var hal=$("#inputpaging").val();
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appskp/sett/realisasi/",
				data:{"hal": hal, "batas": batas,"cari":cari},
				beforeSend:function(){	$('#page-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');	},
				success:function(data){	$('#page-wrapper').html(data);	}, // end success
	        dataType:"html"});
}


function gettree(){
var tahun=$("#tahun").val();
$('#kop_tahun').html(tahun);
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appskp/sett/gettree/",
				data:{"tahun":tahun},
				beforeSend:function(){	
					$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
					$('#paging').html('');
					$('#kode_unor').html('<option value="" selected>Semua...</option>');
				},
				success:function(data){	
					$('#kode_unor').html(data);
					gridpaging('end');
				}, // end success
	        dataType:"html"});
}

function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	$('#div_opsi').hide();
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>