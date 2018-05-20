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
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-print fa-fw"></i> Cetak Daftar Jabatan Kosong</a></li>
										</ul>
			<span style="margin-left:5px;" id=judul_skp><b>Daftar Jabatan Kosong</b></span>
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
<tr>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:400px;text-align:center; vertical-align:middle">JABATAN STRUKTURAL<br /><b>ESELON / UNIT KERJA</b></th>
<th style="width:545px;text-align:center; vertical-align:middle">PEMANGKU JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging"></div>




		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->


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
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var tanggal = $('#tg_jab').html();
var status_rancangan = $('#status_rancangan').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/mutasi/getkosong",
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
					var pemangku="";
					if(item.pejabat){
							var no2 = 1;
							$.each( item.pejabat, function(index, item2){
								pemangku = pemangku+'<div style="clear:both;">';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="float:left;padding-right:5px;">';
											pemangku = pemangku+'<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
											pemangku = pemangku+'<ul class="dropdown-menu" role="menu">';
											pemangku = pemangku+'<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="setForm(\'lihat\','+item2.id_pegawai+');return false;"><i class="fa fa-binoculars fa-fw"></i> Lihat Rincian Data Pegawai</a></li>';
											pemangku = pemangku+'</ul>';
											pemangku = pemangku+'</div>';
										pemangku = pemangku+'</div>';
										pemangku = pemangku+'<span><div style="display:table;">'+item2.nama_pegawai+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div style="clear:both;">';
										pemangku = pemangku+'<div style="width:105px;float:left;">NIP / Pangkat</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.nip_baru+' / '+item2.nama_pangkat+" - "+item2.nama_golongan+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="width:105px;float:left;">TMT Pkt./Ese.</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.tmt_pangkat+' / '+item2.tmt_ese+'</div></span>';
									pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								no2++;
							});
					}


								if(status_rancangan=="Aktif"){
								pemangku = pemangku+'<div style="clear:both;float:right;margin-bottom:0px;">';
								pemangku = pemangku+'<div class="form-group input-group" style="float:left;width:230px;">';
								pemangku = pemangku+'<input id="nip_baru_'+item.id_unor+'" class="form-control row-fluid" type="text" style="padding-left:5px;padding-right:5px;" placeholder="Masukkan NIP kandidat..." value="" name="nip_baru">';
								pemangku = pemangku+'<span class="input-group-btn">';
								pemangku = pemangku+'<button class="btn btn-default" type="button" onclick="cari_nip('+item.id_unor+');"><i class="fa fa-search"></i></button>';
								pemangku = pemangku+'</span>';
								pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								}


					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td style='padding:3px;'><div id='kol_2_"+item.id_unor+"'><b>"+item.nomenklatur_jabatan+"</b><br />"+item.nama_ese+" - <u>pada</u> :<br />"+item.nomenklatur_pada+"</div></td>";
					table = table+ "<td style='padding:3px;'>"+pemangku+"</td>";
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


function cari_nip(idd){
	var tmt_jabatan = $('#tg_jab').html();
	var nip = $('#nip_baru_'+idd).val();

	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/mutasi/cari_nip_kandidat",
		data: {"nip":nip, "tmt_jabatan":tmt_jabatan, "id_unor":idd},
		beforeSend:function(){	
//			$('#ipt_nip').hide();
//			$('#ipt_spin').show();
		},
		success:function(data){
			if(data.id_pegawai){
				regrid();
			} else {
				alert("Pegawai dengan NIP tersebut TIDAK DITEMUKAN... Masukkan NIP Lain!!");
			}
		}, // end success
	dataType:"json"}); // end ajax
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
