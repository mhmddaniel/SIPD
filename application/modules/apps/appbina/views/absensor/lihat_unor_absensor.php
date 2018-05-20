<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="margin-bottom:5px;"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12" style="text-align:right;">
		<button class="btn btn-primary" type="button" onclick="kembali(); return false;"><i class="fa fa-fast-backward fa-fw"></i>Kembali...</button>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PENGELOLA KEPEGAWAIAN</b></div>
			<div class="panel-body">
								<div>
										<div style="float:left; width:110px;">Nama pengelola</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pengelola->nama_user;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">Username</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pengelola->username;?></div></span>
								</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="padding-left:0px;padding-right:10px;">&nbsp;</div>
</div>
<!-- /.row -->



<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length_lihat" style="width:70px;" onchange="gridpaging_lihat(1)">
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
</div>
<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging_lihat" onchange="gridpaging_lihat(1)" type="text" class="form-control" placeholder="Masukkan kata kunci...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
<div style="float:right; margin:7px 5px 0px 0px;">Cari:</div>
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
<table class="table info table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:30px;text-align:center; padding:20px 0px 17px 0px;">
		<button class="btn btn-primary btn-xs"><i class="fa fa-caret-down fa-fw"></i></button>
</th>
<th style="width:120px;text-align:center; vertical-align:middle">KODE</th>
<th style="width:380px;text-align:center; vertical-align:middle">NAMA UNIT ORGANISASI</th>
<th style="text-align:center; vertical-align:middle">JABATAN STRUKTURAL</th>
</tr>
</thead>
<tbody id="list_lihat">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging_lihat"></div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
		<!-- Modal -->
		<div class="modal fade modal-wide" id="myModalY" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Sedang Setup Unit Organisasi, mohon menunggu...</h4>
                                        </div>
                                        <div class="modal-body" id="isi_modal"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div><!-- /.modal-body -->
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<br/><br/>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_lihat(1);
});
function repaging_lihat(){
	$( "#paging_lihat .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_lihat .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_lihat(inu);	}
	});
}
function gopaging_lihat(){
	$("#paging_lihat #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_lihat(ini);
	});
}
function gridpaging_lihat(hal){
var cari = $('#caripaging_lihat').val();
var batas = $('#item_length_lihat').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appskp/sett/pengelola_lihat_getdata/",
				data:{"hal": hal, "batas": batas,"cari":cari},
				beforeSend:function(){	
					$('#list_lihat').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
					$('#paging_lihat').html('');
				},
				success:function(data){
if((data.hslquery.length)>0){
			var table="";
			var no=data.mulai;
			$.each( data.hslquery, function(index, item){
				table = table+ "<tr id='row_"+item.id_unor+"'>";
				table = table+ "<td style='padding:7px 0px 0px 0px;text-align:center;' class='danger' id='aks_"+item.id_unor+"'><input type=checkbox data-aksi='uncheck' id='check_"+item.id_unor+"' value='"+item.id_unor+"' onclick='pilih_satu("+item.id_unor+");' checked></td>";
				table = table+ "<td>"+item.kode_unor+"</td>";
				table = table+ "<td>"+item.nama_unor+"</td>";
				table = table+ "<td>"+item.nomenklatur_jabatan+"</td>";
				table = table+ "</tr>";
			no++;
			}); //endeach
				$('#list_lihat').html(table);
				$('#paging_lihat').html(data.pager);
				repaging_lihat();gopaging_lihat();
		} else {
			$('#list_lihat').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
			$('#paging_lihat').html("");
		} // end if
		}, // end success
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
function pilih_satu(idd){
	var aksi = $('#check_'+idd).attr('data-aksi');
	var njj = parseInt($('#jj').html());
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>appskp/sett/unchecked_pengelola_unor/",
					data:{"idd": idd},
					beforeSend:function(){	
						$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='check' id='check_"+idd+"' value='"+idd+"' onclick='pilih_satu("+idd+");'>");
						$('#row_'+idd).removeClass('info');
						njj = njj - 1;
						$('#jj').html(njj);
						$('#myModalY').modal('show');
					},
					success:function(data){

						$('#row_'+idd).remove();
						$('#myModalY').modal('hide');
					},
					dataType:"html"});
}
function kembali(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbina/absensor",
			data:{"hal": <?=$hal;?>,"cari":"<?=$cari;?>" },
			beforeSend:function(){	
				$("#page-wrapper").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$('#page-wrapper').html(data);
			},
			dataType:"html"});
}
</script>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
