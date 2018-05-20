<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
									<span class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appevjab/jabfung');?>"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="#"><i class="fa fa-sitemap fa-fw"></i> Tampilan hirarki</a></li>
										</ul>
										Daftar Jabatan Master
									</span>
									<div class="btn btn-primary btn-xs pull-right"  onclick="setForm('appbkpp/unor/setara_formtambah',0);return false;"><i class="fa fa-plus fa-fw"></i> Tambah Jabatan Master</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length_unmas" style="width:70px;" onchange="gridpaging_unmas(1)">
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
                                <input id="caripaging_unmas" onchange="gridpaging_unmas(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:125px;text-align:center; vertical-align:middle">KODE</th>
<th style="text-align:center; vertical-align:middle">NAMA JABATAN</th>
</tr>
</thead>
<tbody id="list_unmas">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging_unmas"></div>
		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->
<div id="form-wrapper" style="padding-bottom:30px; display:none;">
</div>

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_unmas(<?=$hal;?>);
});
function repaging_unmas(){
	$( "#paging_unmas .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_unmas .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_unmas(inu);	}
	});
}
function gopaging_unmas(){
	$("#paging_unmas #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_unmas(ini);
	});
}
function regrid_unmas(){
	var ini = $("#paging_unmas #inputpaging").val();
	gridpaging_unmas(ini);
}
function gridpaging_unmas(hal){
var cari = $('#caripaging_unmas').val();
var batas = $('#item_length_unmas').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/unor/getsetara",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_unmas').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_unmas').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){

if(item.kode_ese==99){ var yy =" <u>"+item.tugas_tambahan+"</u>"; } else { var yy = "";}

					table = table+ "<tr id='row_"+item.id_jabatan+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'appbkpp/unor/setara_formedit\',\''+item.id_jabatan +'\');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>';
						if(item.cek=="kosong"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'appbkpp/unor/setara_formhapus\',\''+item.id_jabatan +'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						table = table+ "</ul></div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_unmas').html(table);
					$('#paging_unmas').html(data.pager);
					repaging_unmas();gopaging_unmas();
			} else {
				$('#list_unmas').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_unmas').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}

function setForm(aksi,idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd":idd},
		beforeSend:function(){	
			$('#content-wrapper').hide();
			$('#form-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#form-wrapper').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal(aksi,idd){
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>