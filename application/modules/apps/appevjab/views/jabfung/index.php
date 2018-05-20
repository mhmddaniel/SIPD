<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
					<span class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
							<li role="presentation"><a onClick="pilTipe('jfu'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Jabatan Fungsional Umum</a></li>
							<li role="presentation"><a onClick="pilTipe('jft'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Jabatan Fungsional Tertentu</a></li>
							<li role="presentation"><a onClick="pilTipe('jft-guru'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-tasks fa-fw"></i> Jabatan Guru</a></li>
							<li class="divider"></li>
							<li role="presentation"><a href="<?=site_url('module/appbkpp/unor/setara');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-tasks fa-fw"></i> Jabatan Struktural Master</a></li>
							<li role="presentation"><a href="<?=site_url('module/appevjab/jabstruk');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-tasks fa-fw"></i> Kelas Jabatan Struktural</a></li>
						</ul>
						<span id="judul">Daftar Jabatan Fungsional Umum</span>
					</span>
					<span class="btn btn-primary btn-xs pull-right" onClick="setForm('formtambah','xx');"><i class="fa fa-plus fa-fw"></i> Tambah Jabatan</span>
					<span id='tb_guru' class="btn btn-primary btn-xs pull-right" onclick="setForm('jenjang_guru'); return false;" style="margin-right:2px;"><i class="fa fa-gear fa-fw"></i> Jenjang Jabatan Guru</span>
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
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:100px;text-align:center; vertical-align:middle">KODE</th>
<th style="text-align:center; vertical-align:middle">NAMA JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging"></div>
		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.content -->

<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<div id="tipe" style="display:none;"><?=$tipe;?></div>

<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging(<?=$hal;?>);
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
function pilTipe(tipe){
$('#caripaging').val('');
$('#item_length').val(10);
$('#tipe').html(tipe);
gridpaging(1);
}

function gridpaging(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var tipe = $('#tipe').html();
if(tipe=='jft-guru'){$('#tb_guru').show();}else{$('#tb_guru').hide();}
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/jabfung/getdata",
		data:{"hal": hal, "batas": batas,"tipe":tipe,"cari":cari},
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
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'formedit\',\''+item.id_jabatan +'\');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>';
						if(item.cek==""){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'formhapus\',\''+item.id_jabatan +'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						if(tipe=="jft"){
						table = table+ "<li class='divider'></li>";
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'jenjang_jabatan\',\''+item.id_jabatan +'\');"><i class="fa fa-signal fa-fw"></i> Jenjang jabatan</a></li>';
						}
						table = table+ "</ul></div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					$('#judul').html(data.judul);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function setForm(aksi,idd){
var tipe = $('#tipe').html();
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var hal=$("#inputpaging").val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/jabfung/"+aksi,
		data:{"hal": hal, "batas": batas,"cari":cari,"idd":idd,"tipe":tipe},
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
function pindah(idd){
	var jab_type = $('#tipe').html();
	$('#sb_act').attr('action','<?=site_url();?>appevjab/jabfung/urtug_alih');
	var tab = '<input type="hidden" name="idd" value="'+idd+'">';
	tab=tab+'<input type="hidden" name="jab_type" value="'+jab_type+'">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>