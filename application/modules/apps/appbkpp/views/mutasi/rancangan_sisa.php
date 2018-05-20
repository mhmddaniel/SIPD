<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i></div> <b><?=$rancangan->nama_rancangan;?></b>
				<a href="<?=site_url('module/appbkpp/mutasi/kembali_rancangan');?>" class="pull-right"><div class="btn btn-warning btn-xs"><i class="fa fa-backward fa-fw"></i> Kembali</div></a>
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
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-recycle fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
										</ul>
			<span style="margin-left:5px;"><b>Daftar Pejabat Belum Ditempatkan</b></span>
									</div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length_sisa" style="width:70px;" onchange="gridpaging_sisa(1)">
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
                                <input id="caripaging_sisa" onchange="gridpaging_sisa(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
									<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
									<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
									<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
									<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MASA KERJA GOLONGAN</th>
									<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
								</tr>
							</thead>
							<tbody id="list_sisa"></tbody>
							</table>
							</div><!-- table-responsive --->
							<div id="paging_sisa"></div>




		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->


<script type="text/javascript">
$(document).ready(function(){
	gridpaging_sisa('<?=$hal;?>');
});
function repaging_sisa(){
	$( "#paging_sisa .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_sisa .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_sisa(inu);	}
	});
}
function gopaging_sisa(){
	$("#paging_sisa #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_sisa(ini);
	});
}
function regrid(){
	var ini = $("#paging_sisa #inputpaging").val();
	gridpaging_sisa(ini);
}
function gridpaging_sisa(hal){
var cari = $('#caripaging_sisa').val();
var batas = $('#item_length_sisa').val();
var tanggal = $('#tg_jab').html();
var status_rancangan = $('#status_rancangan').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/mutasi/getsisa",
		data:{"hal": hal, "batas": batas,"tanggal":tanggal,"cari":cari},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rwsisa_"+item.id_pegawai+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs utm" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+'<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSub(\'appbkpp/profile/pns_ini\',\''+item.id_pegawai +'\',\''+item.id_unor +'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian data pegawai</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.tmt_pangkat+"<br/>"+item.mk_gol_tahun+" tahun "+item.mk_gol_bulan+" bulan</td>";
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" (<b>"+item.tugas_tambahan+"</b>) <br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					}
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_sisa').html(table);
					$('#paging_sisa').html(data.pager);
					repaging_sisa();gopaging_sisa();
			} else {
				$('#list_sisa').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_sisa').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
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
			$('#rwsisa_'+idd).addClass('success');
			$('<tr id="row_tt" class="success"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#rwsisa_'+idd);
		},
        success:function(data){
			$('#form_sub').attr('action','<?=site_url("appbkpp/mutasi/formsub_");?>'+aksi+'_aksi');
			$('#row_tt').html('<td colspan=10>'+data+'</td>');
		},
        dataType:"html"});
}
function tutup(){
	$('#row_tt').remove();
	$("[id^='rwsisa_']").removeClass();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
