<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$dua;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div style="padding-bottom:30px;">
<div class="row" id="content-wrapper">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
										<i class="fa fa-user fa-fw"></i> Daftar Pegawai
								</div>
								<div class="col-lg-6" style="display:none;">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>
						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																$selKode = ($kode==$val->kode_unor)?"selected":"";
																echo '<option value="'.$val->kode_unor.'" '.$selKode.'>'.$val->nama_unor.'</option>';															
															}
														?>
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
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->



			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP / PANGKAT (Gol.)<br /> JABATAN</th>
<th style="width:450px;text-align:center; vertical-align:middle">RIWAYAT JABATAN</th>
</tr>
</thead>
<tbody id=list>
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id=paging></div>

											<div id="paging_print" style="display:none;"></div>


		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.content -->


<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>

<script type="text/javascript">
$(document).ready(function(){
	gridpaging('<?=$hal;?>');
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
var kode = $('#a_kode_unor').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pantau/get_jabatan",
		data:{"hal": hal, "batas": batas,"cari":cari,"kode":kode},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="ppost('+item.id_pegawai+',\'module/appbkpp/profile/alih\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+" / " +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.nomenklatur_jabatan+"</td>";

					var ts=""; var nomor = 1;
					$.each( item.seno, function(index, itemm){
						if(itemm.st_sk_nomor=="benar"){	var stt_sk_nomor = '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>';	}	else	{	var stt_sk_nomor = '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>';	}
						if(itemm.st_sk_tanggal=="benar"){	var stt_sk_tanggal = '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>';	}	else	{	var stt_sk_tanggal = '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>';	}
						if(itemm.st_tmt_jabatan=="benar"){	var stt_tmt_jabatan = '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>';	}	else	{	var stt_tmt_jabatan = '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>';	}
						if(itemm.st_dokumen=="benar"){	var stt_dokumen = '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>';	}	else	{	var stt_dokumen = '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>';	}
						ts = ts+ '<div style="border-bottom:1px dotted #0ff; display:table; width:100%; margin-bottom:5px;">';
						ts = ts+ '<div style="width:35px;float:left;">'+nomor+'.</div>';

						ts = ts+ '<div style="float:left;">';

						ts = ts+ '<div style="clear:both;">';
						ts = ts+ '<div style="float:left; width:115px;">Jabatan</div>';
						ts = ts+ '<div style="float:left; width:10px;">:</div>';
						ts = ts+ '<span>'+itemm.nama_jabatan+'</b></span>';
						ts = ts+ '</div>';
						ts = ts+ '<div style="clear:both;">';
						ts = ts+ '<div style="float:left; width:115px;">Nomor SK</div>';
						ts = ts+ '<div style="float:left; width:10px;">:</div>';
						ts = ts+ '<span>'+itemm.sk_nomor+' '+stt_sk_nomor+'</span>';
						ts = ts+ '</div>';
						ts = ts+ '<div style="clear:both;">';
						ts = ts+ '<div style="float:left; width:115px;">Tanggal SK</div>';
						ts = ts+ '<div style="float:left; width:10px;">:</div>';
						ts = ts+ '<span>'+itemm.sk_tanggall+' '+stt_sk_tanggal+'</span>';
						ts = ts+ '</div>';
						ts = ts+ '<div style="clear:both;">';
						ts = ts+ '<div style="float:left; width:115px;">TMT Jabatan</div>';
						ts = ts+ '<div style="float:left; width:10px;">:</div>';
						ts = ts+ '<span>'+itemm.tmt_jabatann+' '+stt_tmt_jabatan+'</span>';
						ts = ts+ '</div>';
						ts = ts+ '<div style="clear:both; margin-bottom:5px;">';
						ts = ts+ '<div style="float:left; width:115px;">eDokumen</div>';
						ts = ts+ '<div style="float:left; width:10px;">:</div>';
						ts = ts+ '<span>'+stt_dokumen+'</span>';
						ts = ts+ '</div>';

						ts = ts+ '</div>';
						ts = ts+ '</div>';
						nomor++;
					}); //endeach


					table = table+ "<td style='padding:3px;'>"+ts+"</td>";
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

function batal(aksi,idd){
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}
function cetak_excel(){
	var ini = $('#paging_print').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/xls_pegawai_umpeg/index/"+hal,"_blank");
}
function ppost(idd,act){
	var cari = $('#a_caripaging').val();
	var batas = $('#item_length').val();
	var hal=$("#inputpaging").val();
	var kode = $('#a_kode_unor').val();

	$('#sb_act').attr('action','<?=site_url();?>'+act);
	var tab = '<input type="hidden" name="cari" value="'+cari+'">';
	var tab = tab + '<input type="hidden" name="batas" value="'+batas+'">';	
	var tab = tab + '<input type="hidden" name="hal" value="'+hal+'">';	
	var tab = tab + '<input type="hidden" name="kode" value="'+kode+'">';
	var tab = tab + '<input type="hidden" name="id_pegawai" value="'+idd+'">';
	var tab = tab + '<input type="hidden" name="awal" value="sk_jabatan">';
	var tab = tab + '<input type="hidden" name="asal" value="appbkpp/pantau/jabatan">';
	$('#sb_act').html(tab).submit();
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

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>

