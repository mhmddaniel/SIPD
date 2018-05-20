  <div class="row">
	<div class="col-lg-12">
		<form id="content-form" method="post" action="<?=site_url("appbkpp/unor/setmasjab_aksi");?>" enctype="multipart/form-data" role="form">
		<input type="hidden" id="idd" name="idd" value="<?=$idd;?>">
		<input type="hidden" id="id_jabatan" name="id_jabatan">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-edit fa-fw"></i> <b>Form Set Jabatan Master</b>
				<div class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body" style="padding-left:5px; padding-right:5px;">



<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
				<div style="float:left;">
				<select class="form-control input-sm" id="item_length_masjab" style="width:70px;" onchange="gridpaging_masjab(1)">
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
					<input id="caripaging_masjab" onchange="gridpaging_masjab(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
					<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
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
<tbody id="list_masjab">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_masjab"></div>



	
			
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		</form>
	</div><!-- /.col-lg-12 -->
  </div><!-- /.row -->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_masjab(<?=$hal;?>);
});
function repaging_masjab(){
	$( "#paging_masjab .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_masjab .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_masjab(inu);	}
	});
}
function gopaging_masjab(){
	$("#paging_masjab #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_masjab(ini);
	});
}
function regrid_masjab(){
	var ini = $("#paging_masjab #inputpaging").val();
	gridpaging_masjab(ini);
}
function gridpaging_masjab(hal){
var cari = $('#caripaging_masjab').val();
var batas = $('#item_length_masjab').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/unor/getsetara",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_masjab').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_masjab').html('');
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
					table = table+ '<div class="btn btn-default btn-xs" onclick="simpan_ini('+item.id_jabatan+')"><i class="fa fa-check fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_masjab').html(table);
					$('#paging_masjab').html(data.pager);
					repaging_masjab();gopaging_masjab();
			} else {
				$('#list_masjab').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_masjab').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
////////////////////////////////////////////////////////////////////////////
function simpan_ini(idd){
	$('#id_jabatan').val(idd);
	simpan_aksi();
}
function simpan_aksi(){
	jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
		var arr_result = data.split("#");
		//alert(data);
		if(arr_result[0]=='sukses'){
			regrid_unmas();
			batal();
		} else {
			alert('Data gagal disimpan! \n Lihat pesan diatas form');
		}
	});
	return false;
}
</script>