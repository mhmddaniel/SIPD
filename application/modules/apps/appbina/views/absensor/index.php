<div class="row">
	<div class="col-lg-12" style="margin-bottom:25px;">
		<h3 class="page-header" style="margin-bottom:5px;"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tags fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a onclick="setModal('appbina/absensor/absensor','tambah','xx');" style="cursor:pointer;"><i class="fa fa-gear fa-fw"></i> Tambah Petugas</a></li>
										</ul>
										<?=$satu;?>
									</div>
								</div>
						</div>
			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="clear:both;"></div>
<div style="float:left;">
<select class="form-control input-sm" id="item_length_pengelola" style="width:70px;" onchange="gridpaging_pengelola(1)">
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
                                <input id="caripaging_pengelola" onchange="gridpaging_pengelola(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<div id="grid-data">
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table width="100%" class="table info table-striped table-bordered table-hover" style="margin-bottom:5px;">
<thead id=gridhead>
<tr height=20>
<th width=65 style="vertical-align:middle;">No.</th>
<th width=25 style="vertical-align:middle;">AKSI</th>
<th width=600>NAMA PETUGAS ABSEN</th>
<th style="vertical-align:middle;">username</th>
</tr>
</thead>
<tbody id=list>
	<tr id=isi class=gridrow><td colspan=8 align=center><b>Isi Records</b></td></tr>
</tbody>
</table>
		</div>
		<!-- table-responsive --->
	<div id="paging_pengelola"></div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.grid-data -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
		<!-- Modal -->
		<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form id="modal-form" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body" id="isi_modal">
										  satu
                                        </div>
	                                    <!-- /.modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="modalButtonAksi"></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close fa-fw"></i> Batal...</button>
                                        </div>
	                                    <!-- /.modal-footer -->
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
			</form>
		</div>
		<!-- /.modal -->
<br/><br/>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_pengelola(<?=$hal;?>);
});
function repaging_pengelola(){
	$( "#paging_pengelola .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pengelola .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pengelola(inu);	}
	});
}
function gopaging_pengelola(){
	$("#paging_pengelola #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pengelola(ini);
	});
}
function gridpaging_pengelola(hal){
var cari = $('#caripaging_pengelola').val();
var batas = $('#item_length_pengelola').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/absensor/row_absensor/",
				data:{"hal": hal, "batas": batas,"cari":cari},
				beforeSend:function(){	
					$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
					$('#paging').html('');
				},
				success:function(data){
					if(data!=""){
						var table=data.hslquery;
						$('#list').html(table);
						$('#paging_pengelola').html(data.pager);
						repaging_pengelola();gopaging_pengelola();
					} else {
						$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
						$('#paging_pengelola').html("");
					} // end if
				}, // end success
        dataType:"json"});
}

function set_id(idd,alih,hal,cari){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/sett/set_id/",
			data:{"idd": idd,"hal": hal,"cari":cari },
			beforeSend:function(){
				$('#page-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				loadSegment('page-wrapper',alih);
			},
			dataType:"html"});
}
function set_idu(idd,alih,hal,cari){
var batas = $('#item_length').val();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/sett/set_idu/",
			data:{"idd": idd,"hal": hal,"cari":cari,"batas":batas,"asal":"pengelola" },
			beforeSend:function(){
				$('#page-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				loadSegment('page-wrapper',alih);
			},
			dataType:"html"});
}

function setModal(tujuan,aksi,idd){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>"+tujuan+"_"+aksi+"_form",
			data:{"idd": idd },
			beforeSend:function(){	
				$('#myModalLabel').html('FORM SET-UP PETUGAS ABSENSI');
				$('#modal-form').attr('action','<?=site_url();?>'+tujuan+'_'+aksi+'_aksi');
				$('#modalButtonAksi').attr('onclick','set_pengelola_aksi();').html('<i class="fa fa-save fa-fw"></i> Simpan').show();
				$("#isi_modal").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$('#myModal').modal('show');
			},
			success:function(data){
				$('#isi_modal').html(data);
			},
			dataType:"html"});
}
function set_pengelola_aksi(aksi){
			$.ajax({
			type:"POST",
			url:	$("#modal-form").attr('action'),
			data:$("#modal-form").serialize(),
			beforeSend:function(){	
				$('#modalButtonAksi').hide();
				$('#isi_modal').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$('#myModal').modal('hide');
				gridpaging_pengelola(1);
				if(data=="gagal"){	alert("Gagal.. Coba username lain!");	}
			},
			dataType:"html"});
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/xls_data_umpeg/admin/"+hal,"_blank");
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>