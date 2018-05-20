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
		<div class="panel panel-default" id='id_petugas'>
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PETUGAS ABSEN</b></div>
			<div class="panel-body">
								<div>
										<div style="float:left; width:110px;">Nama petugas</div>
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
<select class="form-control input-sm" id="item_length_pengelola_pilunor" style="width:70px;" onchange="gridpaging_pengelola_pilunor(1)">
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
                                <input id="caripaging_pengelola_pilunor" onchange="gridpaging_pengelola_pilunor(1)" type="text" class="form-control" placeholder="Masukkan kata kunci...">
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
<th style="width:380px;text-align:center; vertical-align:middle">JABATAN STRUKTURAL</th>
</tr>
</thead>
<tbody id="list_pengelola_pilunor">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging_pengelola_pilunor"></div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

		<div class="modal fade modal-wide" id="myModalX" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Sedang Setup Unit Organisasi, mohon menunggu...</h4>
                                        </div>
                                        <div class="modal-body" id="isi_modal"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div><!-- /.modal-body -->
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<div id='jj' style="display:none">0</div>
<br/><br/>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_pengelola_pilunor(1);
});
function repaging_pengelola_pilunor(){
	$( "#paging_pengelola_pilunor .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pengelola_pilunor .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pengelola_pilunor(inu);	}
	});
}
function gopaging_pengelola_pilunor(){
	$("#paging_pengelola_pilunor #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pengelola_pilunor(ini);
	});
}
function gridpaging_pengelola_pilunor(hal){
	var cari = $('#caripaging_pengelola_pilunor').val();
	var batas = $('#item_length_pengelola_pilunor').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appskp/sett/getakses_pengelola/",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_pengelola_pilunor').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pengelola_pilunor').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
					$.each( data.hslquery, function(index, item){
						var pengelola = "";
						$.each( item.pengelola, function(index, item2){
							pengelola = pengelola+item2.nama_user+"; ";
						});

						if(pengelola==""){var isi=""; var tools="  data-container='body' data-placement='bottom' data-toggle='tooltip' data-original-title=''";}else{var isi=" class='danger'"; var tools="  data-container='body' data-placement='bottom' data-toggle='tooltip' data-original-title='"+pengelola+"'"}
						if(item.cek!="checked"){	var aks ="data-aksi='check'"; var rww ="";	} else {	var aks ="data-aksi='uncheck'"; var rww =" class='info'";	}
						table = table+ "<tr id='row_"+item.id_unor+"'"+tools+rww+">";
						table = table+ "<td style='padding:7px 0px 0px 0px;text-align:center;'"+isi+" id='aks_"+item.id_unor+"'><input type=checkbox "+aks+" id='check_"+item.id_unor+"' value='"+item.id_unor+"' onclick='pilih_satu("+item.id_unor+");' "+item.cek+"></td>";
						table = table+ "<td onclick='pilih_satu("+item.id_unor+");'>"+item.kode_unor+"</td>";
						table = table+ "<td onclick='pilih_satu("+item.id_unor+");'>"+item.nama_unor+"</td>";
						table = table+ "<td onclick='pilih_satu("+item.id_unor+");'>"+item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
						table = table+ "</tr>";
						no++;
					}); //endeach
				$('#list_pengelola_pilunor').html(table);
				$('#paging_pengelola_pilunor').html(data.pager);
				repaging_pengelola_pilunor();gopaging_pengelola_pilunor();
				$("[data-toggle='tooltip']").tooltip();
			} else {
				$('#list_pengelola_pilunor').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_pengelola_pilunor').html("");
			} // end if
				$("#tb_pilih").replaceWith("<input type=checkbox onchange='pilih_semua();' id='tb_pilih'>");
		}, // end success
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
function pilih_satu(idd){
	var aksi = $('#check_'+idd).attr('data-aksi');
	var njj = parseInt($('#jj').html());
	if(aksi=="check"){
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>appskp/sett/checked_pengelola_unor/",
					data:{"idd": idd},
					beforeSend:function(){	
						$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='uncheck' id='check_"+idd+"' name=id_unor[] value='"+idd+"' onclick='pilih_satu("+idd+");' checked>");
						$('#row_'+idd).addClass('info');
						njj = njj + 1;
						$('#jj').html(njj);
						$('#myModalX').modal('show');
					},
					success:function(data){

							 var arr_result = data.split("::");
							if(arr_result[1]!=""){
								$('#row_'+idd).attr("data-original-title",arr_result[1]);
								$('#aks_'+idd).removeClass("danger").addClass("danger");
							} else{
								$('#row_'+idd).attr("data-original-title","");
								$('#aks_'+idd).removeClass("danger");
							}


						$('#myModalX').modal('hide');
					},
					dataType:"html"});
	} else {
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>appskp/sett/unchecked_pengelola_unor/",
					data:{"idd": idd},
					beforeSend:function(){	
						$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='check' id='check_"+idd+"' value='"+idd+"' onclick='pilih_satu("+idd+");'>");
						$('#row_'+idd).removeClass('info');
						njj = njj - 1;
						$('#jj').html(njj);
						$('#myModalX').modal('show');
					},
					success:function(data){

							 var arr_result = data.split("::");
							if(arr_result[1]!=""){
								$('#row_'+idd).attr("data-original-title",arr_result[1]);
								$('#aks_'+idd).removeClass("danger").addClass("danger");
							} else{
								$('#row_'+idd).attr("data-original-title","");
								$('#aks_'+idd).removeClass("danger");
							}


						$('#myModalX').modal('hide');
					},
					dataType:"html"});
	}
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
.tooltip-inner{
    max-width:500px;
    padding:12px 28px;
    color:#fff;
    text-align:center;
    text-decoration:none;
    background-color:#000;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px
}
</style>
