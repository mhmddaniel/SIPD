<div class="row">
	<div class="col-lg-12"><h3 class="page-header">KOMPARASI PNS SIPD-SAPK</h3></div>
</div>

<div id="content-wrapper">
<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
								<div class="row">
										<div class="col-lg-6">
											<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
												<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
													<li role="presentation"><a href="<?=site_url('module/csapk/impor');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Data PNS Sinkron by NIP</a></li>
													<li role="presentation"><a href="<?=site_url('module/csapk/impor/sapk_ada');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Data NIP :: SAPK-Ada, SIPD-Tidak Ada</a></li>
													<li role="presentation"><a href="<?=site_url('module/csapk/impor/sikda_ada');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Data NIP :: SAPK-Tidak Ada, SIPD-Ada</a></li>
													<li class="divider"></li>
													<li role="presentation"><a href="<?=site_url('module/csapk/impor/golongan');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Data GOLONGAN :: SAPK-SIPD | Tidak Sama</a></li>
													<li role="presentation" class="active"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Data JENIS JABATAN :: SAPK-SIPD | Tidak Sama</a></li>
												</ul>
												<span>Data JENIS JABATAN :: SAPK-SIPD | Tidak Sama</span>
											</div>
										</div>
										<div class="col-lg-6">
											<a href="<?=site_url();?>csapk/cetak/jenis" target="_blank"><div class="btn btn-primary btn-xs pull-right" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-print fa-fw"></i></div></a>
										</div>
								</div>
				</div><!-- /panel-heading -->
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
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<tr id="head_pns">
<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
<th style="width:300px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:250px;text-align:center; vertical-align:middle">STATUS SAPK</th>
<th style="width:250px;text-align:center; vertical-align:middle">STATUS SIPD</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging"></div>

		</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


</div><!-- /.content-wrapper -->

<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>

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
function gridpaging(hal){
var jenis = $('#jenis_act').text();
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>csapk/impor/getjenis",
		data:{"hal": hal, "batas": batas,"cari":cari,"jenis":jenis},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
				
					table = table+ "<tr id='row_"+no+"'>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					table = table+ '<div class="btn btn-default btn-xs"  onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'tidak\');return false;">'+no+' <i class="fa fa-binoculars fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ '<td><div style="width:150px;"><div class="thumbnail"><img src="'+item.thumb+'"></div></div></td>';
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+"<br>"+item.tmt_pns;
					table = table+ '<div style="margin-top:10px;padding-top:10px;border-top: 1px dotted #ddd;">';
					table = table+ '<div style="float:left; width:130px;">Gol. (Pangkat)</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.nama_golongan+" ("+item.nama_pangkat+')</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">TMT Golongan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tmt_pangkat+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">MK.Golongan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.mk_gol_tahun+' tahun '+item.mk_gol_bulan+' bulan</div>';
					table = table+ '</div></td>';
					table = table+ "<td style='padding:3px;'>";
					table = table+ '<div style="float:left; width:110px;">Jenis</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.jab_type+'</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:110px;">TMT Jabatan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tmt_jabatan+'</div>';
					table = table+ '</div><br><br>'+item.nomenklatur_jabatan;
					table = table+ '</td>';
					table = table+ "<td style='padding:3px;'>";
					table = table+ '<div style="float:left; width:110px;">Jenis</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.jab_type_aktual+'</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:110px;">TMT Jabatan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tmt_jabatan_aktual+'</div>';
					table = table+ '</div><br><br>'+item.nomenklatur_jabatan_aktual;
					table = table+ '</td>';
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
function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh,"awal":"sk_jabatan"},
		beforeSend:function(){	
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("#sub_konten").html("").hide();
	$("#content-wrapper").show();
	regrid();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>