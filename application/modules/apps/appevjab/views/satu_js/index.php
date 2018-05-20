<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Jabatan Struktural</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
						<div class="row">
							<div class="col-lg-6"><div class="btn btn-default btn-xs"><i class="fa fa-sitemap fa-fw"></i></div> Daftar Kelas Jabatan Struktural</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">



<div class="row" style="display:none;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_js" style="width:70px;" onchange="gridpaging_js(1)">
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
                                <input id="caripaging_js" onchange="gridpaging_js(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:250px;text-align:center; vertical-align:middle">ESELONERING JABATAN</th>
<th style="width:80px;text-align:center; vertical-align:middle">BANYAKNYA JABATAN</th>
<th style="width:80px;text-align:center; vertical-align:middle">BANYAKNYA<br>PEMANGKU JABATAN</th>
<th style="width:80px;text-align:center; vertical-align:middle">BANYAKNYA<br>JABATAN LOWONG</th>
</tr>
</thead>
<tbody id="list_js">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_js"></div>


				</div><!-- /.panel-body -->
			</div><!-- /.panel -->
		</div><!-- /.col-lg-12 -->
	</div><!-- /.row -->
	<div class="row">
		<div class="col-lg-12" style="display:none;">
<?php
foreach($hslB AS $key=>$val){
?>
<?=$key+1;?>. <?=$val->jenis;?><br>
<?php
}
?>
		</div><!-- /.col-lg-12 -->
	</div><!-- /.row -->
</div><!-- /.content -->


<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_js('end');
});
function repaging_js(){
	$( "#paging_js .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_js .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_js(inu);	}
	});
}
function gopaging_js(){
	$("#paging_js #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_js(ini);
	});
}
function regrid_js(){
	var ini = $("#paging_js #inputpaging").val();
	gridpaging_js(ini);
}

function gridpaging_js(hal){
var cari = $('#a_caripaging_js').val();
var batas = $('#item_length_js').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/satu_js/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_js').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_js').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var jJab=0;
				var jIsi=0;
				var jKosong=0;
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama+"</td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-default btn-sm' onclick=\"detil4('"+item.kode+"','appevjab/satu_js/rincian','ya'); return false;\">"+item.banyak_jabatan+"</div></td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-default btn-sm' onclick=\"detil4('"+item.kode+"','appevjab/satu_js/rincian_isi','ya'); return false;\">"+item.banyak_pegawai+"</div></td>";
					table = table+ "<td style='padding:3px;'>"+item.selisih+"</td>";
					table = table+ "</tr>";
					no++;
					jJab=jJab+parseInt(item.banyak_jabatan);
					jIsi=jIsi+parseInt(item.banyak_pegawai);
				}); //endeach


					table = table+ "<tr>";
					table = table+ "<td colspan='2' style='padding:3px;' align='right'>Jumlah:</td>";
					table = table+ "<td style='padding:3px;'><b>"+jJab+"</b></td>";
					table = table+ "<td style='padding:3px;'><b>"+jIsi+"</b></td>";
					table = table+ "<td style='padding:3px;'><b>"+(jJab-jIsi)+"</b></td>";
					table = table+ "</tr>";


					$('#list_js').html(table);
					$('#paging_js').html(data.pager);
					repaging_js();gopaging_js();

					var ini="";
					for(i=0;i<data.seg_print;i++){
						var jj = (i*data.bat_print)+1;
						var kk = (i+1)*data.bat_print;
						ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
					}
					$('#paging_print_js').html(ini);

			} else {
				$('#list_js').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_js').html("");
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