<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body" style="padding:0px;">


				<ul class="nav nav-tabs" role="tablist" id="myTab"><!-- Nav tabs -->
					<li style="padding: 7px 10px 5px 5px;">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" onClick="cetak_excel();return false;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
<!--
											<li role="presentation" class="divider ssd"></li>
											<li onclick="tambah_pegawai();return false;" class="ssd"><a href='#'><i class="fa fa-plus fa-fw"></i> Tambah Pegawai</a></li>
-->
											<li role="presentation" class="divider ssd"></li>
											<li onclick="pegawai_unit();return false;" id="pilpeg_unit"><a href='#'><i class="fa fa-list fa-fw"></i> Daftar Pegawai Kumulatif</a></li>
										</ul>
									</div>
					</li>
					<li class="active"><a href="#" role="tab" data-toggle="tab" onclick="viewTab('all');return false;"><i class="fa fa-recycle fa-fw"></i> Seluruhnya</a></li>
					<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('jfu');return false;"><i class="fa fa-tasks fa-fw"></i> Fungsional Umum</a></li>
					<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('jft');return false;"><i class="fa fa-support fa-fw"></i> Fungsional Tertentu</a></li>
					<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('jft-guru');return false;"><i class="fa fa-user-plus fa-fw"></i> Fungsional Guru</a></li>
					<li class="btn-group pull-right" style="padding: 7px 15px 5px 5px;">
						<button class="btn btn-primary btn-xs" type="button" onclick="tutupX1();"><i class="fa fa-close fa-fw"></i></button>
					</li>
				</ul><!-- /.Nav tabs -->


						<div class="row" style="padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success"><div class="panel-heading">
								<div style="clear:both;padding-bottom:5px;">
									<div style="clear:both;">
										<div style="width:105px;float:left;">Unit kerja</div>
										<div style="width:10px;float:left;">:</div>
										<span><div style="display:table"><b><?=$unor->nama_unor;?></b></div></span>
									</div>
									<div style="clear:both;">
										<div style="width:105px;float:left;">Pejabat</div>
										<div style="width:10px;float:left;">:</div>
										<span><div style="display:table"><b><?=$unor->nomenklatur_jabatan;?></b></div></span>
									</div>
									<div style="clear:both;">
										<div style="width:105px;float:left;">pada</div>
										<div style="width:10px;float:left;">:</div>
										<span><div style="display:table"><b><?=$unor->nomenklatur_pada;?></b></div></span>
									</div>
								</div>
						</div></div></div></div>


<div class="row" style="padding:15px 5px 5px 5px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_aktif" style="width:70px;" onchange="gridpaging_aktif('end')">
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
                                <input id="caripaging_aktif" onchange="gridpaging_aktif('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row" style="padding:5px;">
<div class="col-lg-12" style="margin-bottom:5px;">
<div class="table-responsive">
<div id="pilAct" style="display:none">all</div>
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:55px;vertical-align:middle">No.</th>
<th style="width:50px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP :: PANGKAT/GOLONGAN</th>
<th style="width:300px;vertical-align:middle">JABATAN</th>
<th style="width:300px;vertical-align:middle">UNIT KERJA LAMA</th>
</tr>
</thead>
<tbody id="list_aktif"></tbody>
</table>
</div><!--/.table-responsive-->
<div id="paging_aktif"></div>
</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


			</div><!--/.panel-body-->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div style="display:none;" id="p_unit">unit</div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_aktif('end');
});

function viewTab(jns){
	$('#pilAct').html(jns);
	gridpaging_aktif(1);
	var act = $('#pilAct').html();
	if(act=="all"){	$('.ssd').show();	} else {	$('.ssd').hide();	}
}

function repaging_aktif(){
	$( "#paging_aktif .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_aktif .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_aktif(inu);	}
	});
}
function gopaging_aktif(){
	$("#paging_aktif #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_aktif(ini);
	});
}
//function regrid_aktif(){
function regrid(){
	var ini = $("#paging_aktif #inputpaging").val();
	gridpaging_aktif(ini);
}
function gridpaging_aktif(hal){
	var cari = $('#caripaging_aktif').val();
	var batas = $('#item_length_aktif').val();
	var jenis = $('#pilAct').html();
	var p_unit = $('#p_unit').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appsotkbaru/njs2017/getpegawai",
		data:{"hal":hal, "batas": batas,"cari":cari,"jenis":jenis,"unit":p_unit},
		beforeSend:function(){	
			$('#list_aktif').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_aktif').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rwpeg_"+item.id_pegawai+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs utm" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSub(\'appbkpp/profile/pns_ini\',\''+item.id_pegawai +'\',\''+item.id_unor +'\');"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li class="divider"></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSub(\'appsotkbaru/njs2017/pindah_pegawai\',\''+item.id_pegawai +'\',\''+item.id_unor +'\');"><i class="fa fa-refresh fa-fw"></i> Pindahkan</a></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSub(\'appsotkbaru/njs2017/hapus_pegawai\',\''+item.id_pegawai +'\',\''+item.id_unor +'\');"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+" :: "+item.nama_pangkat+" ("+item.nama_golongan+")</td>";
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br><u>pada</u> "+item.nama_unor+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_pada_lama+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_aktif').html(table);
					$('#paging_aktif').html(data.pager);
					repaging_aktif();gopaging_aktif();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_aktif').html(ini);

			} else {
				$('#list_aktif').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_aktif').html("");
			} // end if
/*			
			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}
			if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
				$("#panel_filter").removeClass("panel-danger").addClass("panel-success");
			} else {
				$("#panel_filter").removeClass("panel-success").addClass("panel-danger");
			}
*/
		}, // end success
	dataType:"json"}); // end ajax
}

function tutupX1(){
	$('#tabel_2').remove();
	$('#tabel_1').show();
	$("[id^='row_<?=$id_parent;?>_']").remove();
	gridpaging(1,'<?=$level;?>','<?=$id_parent;?>');
	$('#bt_kembali').show();
}

function tambah_pegawai(){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appsotkbaru/njs2017/tambahpegawai_form",
				data:{"idd": "idd"},
				beforeSend:function(){	
					$('<div id="tabel_3"><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></div>').insertAfter("#tabel_2");
					$("#tabel_2").hide();
				},
				success:function(data){
					$("#tabel_3").html(data);
	            }, //tutup::success
        dataType:"html"});
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
			$('#rwpeg_'+idd).addClass('success');
			$('<tr id="row_tt" class="success"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#rwpeg_'+idd);
		},
        success:function(data){
			$('#row_tt').html('<td colspan=10>'+data+'</td>');
		},
        dataType:"html"});
}
function tutup(){
	$('#row_tt').remove();
	$("[id^='rwpeg_']").removeClass();
}
function pegawai_unit(){
	var p_unit = $('#p_unit').html();
	if(p_unit=='unit'){	
		$('#p_unit').html('');
		$('#pilpeg_unit').html("<a href='#'><i class='fa fa-list fa-fw'></i> Daftar Pegawai Unit</a>");
	} else {	
		$('#p_unit').html('unit');	
		$('#pilpeg_unit').html("<a href='#'><i class='fa fa-sitemap fa-fw'></i> Daftar Pegawai Kumulatif</a>");
	}
	gridpaging_aktif('end');
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>

