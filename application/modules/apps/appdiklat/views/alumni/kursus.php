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



						<span class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-graduation-cap fa-fw"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
								<li role="presentation"><a href="<?=site_url('module/appdiklat/alumni/prajabatan');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Diklat Prajabatan</a></li>
								<li role="presentation"><a href="<?=site_url('module/appdiklat/alumni/penjenjangan');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Diklat Penjenjangan</a></li>
								<li role="presentation" class="active"><a href="#" role="menuitem"><i class="fa fa-graduation-cap fa-fw"></i> Kusus</a></li>
							</ul>
							<span id="judul"> Daftar Alumni Kursus</span>
						</span>


			</div><!--/.panel-heading-->
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
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:55px;text-align:center; vertical-align:middle">AKSI</th>
<th style="width:110px;text-align:center; vertical-align:middle">KODE</th>
<th style="width:300px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:300px;text-align:center; vertical-align:middle">PENYELENGGARA - TEMPAT</th>
<th style="text-align:center; vertical-align:middle">NAMA KURSUS</th>
</tr>
</thead>
<tbody id="list"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->

<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging("end");
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
function regrid(){
	var ini = $("#paging #inputpaging").val();
	gridpaging(ini);
}
function gridpaging(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/alumni/getkursus",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="zoom_dok(\''+item.nip_baru+'\',\''+item.id_peg_kursus+'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat dokumen</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td>"+item.tanggal_sertifikat+"<br>"+item.dokumen+"</td>";
					table = table+ "<td><b>"+item.nama_pegawai+"</b><br>"+item.nip_baru+" ("+item.id_pegawai+")</td>";
					table = table+ "<td>"+item.penyelenggara+"<br>"+item.tempat_kursus+"</td>";
					table = table+ "<td>"+item.nama_kursus+"<br><b>"+item.nomor_sertifikat+"</b></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function zoom_dok(nip_baru,idd){
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="sertifikat_kursus">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>