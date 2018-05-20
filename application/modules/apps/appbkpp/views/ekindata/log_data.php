						<div class="row" id="div_opsi_aktif" style="padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success" id="panel_filter"><div class="panel-heading">
						<div class="btn btn-primary btn-xs pull-right" onclick="cetak();"><i class="fa fa-print fa-fw"></i></div>
						<div class="row">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Riwayat kepegawaian:</label>
													<select id="a_riwayat" name="a_riwayat" class="form-control" onchange="gridpaging(1);">
														<option value="" selected>Semua...</option>
														<?php
															foreach($riwayat as $key=>$val){
																$selKode = ($kodeHal==$val->tipe_dokumen)?"selected":"";
																echo '<option value="'.$val->tipe_dokumen.'" '.$selKode.'>'.$val->tipe_dokumen.'</option>';															
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Aksi operator:</label>
													<select id="a_aksi" name="a_aksi" class="form-control" onchange="gridpaging(1);">
														<option value="" selected>Semua...</option>
														<?php
															foreach($aksi as $key=>$val){
																$selKode = ($kodeAksi==$val->file_dokumen)?"selected":"";
																echo '<option value="'.$val->file_dokumen.'" '.$selKode.'>'.$val->file_dokumen.'</option>';															
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
												<label>Status kepegawaian:</label>
													<select id="a_stp" name="a_stp" class="form-control" onchange="gridpaging(1);">
														<option value="" selected>Semua...</option>
														<option value="pns">PNS</option>															
														<option value="thl">THL</option>															
														<option value="tkk">TKK</option>															
														<option value="pppk">PPPK</option>															
													</select>
										</div>
									</div>
								</div>
						</div>
						</div></div></div></div>



<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
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
                                <input id="a_caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<tr>
<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">LOG</th>
<th style="width:300px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:300px;text-align:center; vertical-align:middle">OPERATOR</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging"></div>

<form id="sb_act" method="post"></form>

<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1);
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
var cari = $('#a_caripaging').val();
var batas = $('#item_length').val();
var bulan = $('#bulan_act').html();
var tahun = $('#tahun_act').html();
var riwayat = $('#a_riwayat').val();
var aksi = $('#a_aksi').val();
var stp = $('#a_stp').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/ekindata/get_log_data",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"riwayat":riwayat,"aksi":aksi,"stp":stp},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ '<tr id="row_'+no+'">';
	//tombol aksi-->
					table = table+ "<td style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="btn btn-default btn-xs" onclick="detil('+no+','+item.id_dokumen+',\''+item.file_dokumen+'\',\''+item.tipe_dokumen+'\');">'+no+' <i class="fa fa-binoculars fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.log_aksi+"</b><br>"+item.file_dokumen+": "+item.id_reff+"<br>"+item.tipe_dokumen+"</td>";
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+'</td>';
					table = table+ "<td style='padding:3px;'><b>"+item.username+"</b><br>" +item.nama_user+"<br/><u>Grup</u>: "+item.nama_grup+"</td>";
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
	dataType:"json"}); // end ajax
}
function detil(no,idd,aksi,tabel){
	tutup();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/ekindata/log_"+tabel,
		data:{"idd": idd,"aksi":aksi},
		beforeSend:function(){	
			var tab = '<tr id="det_'+no+'" class="success">';
			tab = tab + '<td colspan="4" align=center><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td>';
			tab = tab + "</tr>";
			$(tab).insertAfter('#row_'+no);
		},
		success:function(data){
			$("#det_"+no).html(data);			
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("[id^='det_']").remove();
}

function cetak(){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act').attr('action','<?=site_url();?>appbkpp/ekindata/xcl_data').attr('target','_blank');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act').html(tab).submit();
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
