<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Jabatan Fungsional Tertentu</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Jabatan</div>
			<div class="panel-body">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
		<div style="float:left;">
		<select class="form-control input-sm" id="item_length_jft" style="width:70px;" onchange="gridpaging_jft('end')">
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
                                <input id="a_caripaging_jft" onchange="gridpaging_jft('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN</th>
<th style="width:150px;text-align:center; vertical-align:middle">BANYAKNYA PEGAWAI</th>
<th style="width:80px;text-align:center; vertical-align:middle">STATUS EVJAB</th>
</tr>
</thead>
<tbody id="list_jft">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_jft"></div>
<div id="paging_print_jft" style="display:none;"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->

<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_jft('end');
});
function repaging_jft(){
	$( "#paging_jft .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_jft .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_jft(inu);	}
	});
}
function gopaging_jft(){
	$("#paging_jft #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_jft(ini);
	});
}
function regrid_jft(){
	var ini = $("#paging_jft #inputpaging").val();
	gridpaging_jft(ini);
}

function gridpaging_jft(hal){
var cari = $('#a_caripaging_jft').val();
var batas = $('#item_length_jft').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/satu_jft/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_jft').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_jft').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.nomenklatur_jabatan+"</td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-default btn-xs' onclick=\"detil4('"+item.nomenklatur_jabatan+"','appevjab/satu_jft/rincian','ya'); return false;\">"+item.banyak+"</div></td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-danger btn-xs'>belum</div></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_jft').html(table);
					$('#paging_jft').html(data.pager);
					repaging_jft();gopaging_jft();

					var ini="";
					for(i=0;i<data.seg_print;i++){
						var jj = (i*data.bat_print)+1;
						var kk = (i+1)*data.bat_print;
						ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
					}
					$('#paging_print_jft').html(ini);

			} else {
				$('#list_jft').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_jft').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function detil4(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#pageKonten").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup4(){
	$("#sub_konten").html("").hide();
	$("#pageKonten").show();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>