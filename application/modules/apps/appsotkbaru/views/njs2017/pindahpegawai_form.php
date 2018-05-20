<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Pilih unit kerja...</b>
				<div class="btn btn-danger btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
				<div style="float:left;">
				<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging_pindah(1)">
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
                                <input id="caripaging" onchange="gridpaging_pindah(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:105px;text-align:center; vertical-align:middle">KODE</th>
<th style="text-align:center; vertical-align:middle">NAMA UNIT KERJA</th>
<th style="width:390px;text-align:center; vertical-align:middle">ESELON</th>
</tr>
</thead>
<tbody id="list_pindah">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_pindah"></div>


			</div><!--/.panel-body-->
		</div><!--/.panel-->
	</div><!--/.col-lg-12-->
</div><!--/.row-->
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_pindah(<?=$hal;?>);
});
function repaging_pindah(){
	$( "#paging_pindah .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pindah .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pindah(inu);	}
	});
}
function gopaging_pindah(){
	$("#paging_pindah #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pindah(ini);
	});
}
function gridpaging_pindah(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var tanggal = "2017-1-1";
var ese = "xx";
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/unor/getdata",
		data:{"hal": hal, "batas": batas,"tanggal":tanggal,"cari":cari,"ese":ese},
		beforeSend:function(){	
			$('#list_pindah').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pindah').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					table = table+ '<div class="btn btn-default btn-xs" onclick="pindah_ini('+item.id_unor+');"><i class="fa fa-check fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_unor+"</td>";
					table = table+ "<td style='padding:3px;'><b>"+item.nama_unor+"</b></td>";
					table = table+ "<td style='padding:3px;'><div id='kol_2_"+item.id_unor+"'>" +item.nama_ese+", <u>pada</u><br />"+item.nomenklatur_pada+"</div></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_pindah').html(table);
					$('#paging_pindah').html(data.pager);
					repaging_pindah();gopaging_pindah();
			} else {
				$('#list_pindah').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_pindah').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}



function pindah_ini(idd){
	var tanggal = "2017-1-1";
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appsotkbaru/njs2017/pindah_ini",
		data:{"id_unor":idd,"id_pegawai":<?=$idd;?>,"tanggal":tanggal},
		beforeSend:function(){	
			$('#list_pindah').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pindah').hide();
		},
		success:function(data){
			if(data=="sukses"){
				regrid();
			} else {
				alert(data);
				tutup();
			}
		}, // end success
	dataType:"html"}); // end ajax
}
</script>