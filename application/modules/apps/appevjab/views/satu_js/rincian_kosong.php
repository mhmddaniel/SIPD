<div class="row" id="content-wrapper2">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="btn btn-primary btn-xs"><?=$idd;?></div>
						<div class="btn-group pull-right">
							<div class="btn btn-warning btn-xs" onclick="tutup4();"><i class="fa fa-close fa-fw"></i></div>
						</div>
			</div>
			<div class="panel-body">
		
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
		<div style="float:left;">
		<select class="form-control input-sm" id="item_length_rincian" style="width:70px;" onchange="gridpaging_rincian('end')">
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
                                <input id="a_caripaging_rincian" onchange="gridpaging_rincian('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:180px;text-align:center; vertical-align:middle">JABATAN</th>
<th style="width:180px;text-align:center; vertical-align:middle">PEMANGKU JABATAN</th>
<th style="width:50px;text-align:center; vertical-align:middle">STATUS EVJAB</th>
</tr>
</thead>
<tbody id="list_rincian">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_rincian"></div>
<div id="paging_print_rincian" style="display:none;"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="sub_konten2" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_rincian('end');
});
function repaging_rincian(){
	$( "#paging_rincian .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_rincian .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_rincian(inu);	}
	});
}
function gopaging_rincian(){
	$("#paging_rincian #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_rincian(ini);
	});
}
function regrid_rincian(){
	var ini = $("#paging_rincian #inputpaging").val();
	gridpaging_rincian(ini);
}

function gridpaging_rincian(hal){
var cari = $('#a_caripaging_rincian').val();
var batas = $('#item_length_rincian').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/satu_js/getrincian_kosong",
		data:{"hal": hal, "batas": batas,"cari":cari,"idd":"<?=$idc;?>"},
		beforeSend:function(){	
			$('#list_rincian').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_rincian').html('');
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
										pemangku = pemangku+'<div style="display:table;"><b>'+item2.nama_pegawai+'</b></div>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div style="clear:both;">';
										pemangku = pemangku+'<div style="width:105px;float:left;">NIP / Pangkat</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.nip_baru+' / '+item2.nama_pangkat+" - "+item2.nama_golongan+'</div></span>';
									pemangku = pemangku+'</div>';
									pemangku = pemangku+'<div>';
										pemangku = pemangku+'<div style="width:105px;float:left;">TMT Pkt/Jab</div>';
										pemangku = pemangku+'<div style="width:10px;float:left;">:</div>';
										pemangku = pemangku+'<span><div style="display:table">'+item2.tmt_pangkat+' / '+item2.tmt_jabatan+'</div></span>';
									pemangku = pemangku+'</div>';
								pemangku = pemangku+'</div>';
								no2++;
							});
					}
					if(pemangku==""){	var pjb = '<div class="btn btn-warning btn-xs" onclick="detil2('+item.id_unor+',\'appbkpp/pejabat/pemangku_riwayat\');return false;">Lihat pejabat sebelumnya</div>';	}else{	var pjb = pemangku;	}
				
				
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
//					table = table+ "<td valign=top align=center>";
//						table = table+ "<div class='btn btn-default btn-xs' onclick=\"detil('"+item.nomenklatur_jabatan+"','appevjab/satu_rincian/rincian','ya'); return false;\"><i class='fa fa-binoculars fa-fw'></i></div>";
//						table = table+ "</div>";
//					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nomenklatur_jabatan+"</b><br><u>pada</u><br>"+item.nomenklatur_pada+"</td>";
//					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b><br>"+item.nip_baru+"<br>"+item.nama_pangkat+" / "+item.nama_golongan+"</td>";
					table = table+ "<td style='padding:3px;'>"+pjb+"</td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-danger btn-xs'>belum</div></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_rincian').html(table);
					$('#paging_rincian').html(data.pager);
					repaging_rincian();gopaging_rincian();

					var ini="";
					for(i=0;i<data.seg_print;i++){
						var jj = (i*data.bat_print)+1;
						var kk = (i+1)*data.bat_print;
						ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
					}
					$('#paging_print_rincian').html(ini);

			} else {
				$('#list_rincian').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_rincian').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}

function detil2(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#content-wrapper2").hide();
			$('#sub_konten2').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten2').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup2(){
	$("#sub_konten2").html("").hide();
	$("#content-wrapper2").show();
}

</script>
