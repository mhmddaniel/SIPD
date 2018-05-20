<?php 		date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
		<div class="col-lg-12" style="padding-bottom:10px;">
			<div class="btn btn-warning pull-right" onclick="tutupPick();"><i class="fa fa-close fa-fw"></i> Tutup</div>
		</div>
</div>


<div class="row"><div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<span class="fa fa-graduation-cap fa-fw"></span> Daftar Pendidikan Formal
								</div>
								<div class="col-lg-6">
									<div style="float:right;"><?=form_dropdown('kode_jenjang_pendidikan',$this->dropdowns->kode_jenjang_pendidikan(),(!isset($val->kode_jenjang_pendidikan))?'':$val->kode_jenjang_pendidikan,'id="kode_jenjang_pendidikanPick"  class="form-control" onchange="gridpagingPick(1);" style="width:200px;height:23px;padding:2px 0px 1px 5px;"');?></div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">



<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_lengthPick" style="width:70px;" onchange="gridpagingPick(1)">
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
                                <input id="caripagingPick" onchange="gridpagingPick(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:55px;text-align:center; vertical-align:middle">PILIH</th>
<th style="width:110px;text-align:center; vertical-align:middle">KODE BKN</th>
<th style="width:300px;text-align:center; vertical-align:middle">JENJANG PENDIDIKAN<br />RUMPUN JENJANG PENDIDIKAN</th>
<th style="width:400px;text-align:center; vertical-align:middle">NAMA PENDIDIKAN</th>
</tr>
</thead>
<tbody id="listPick"></tbody>
</table>
	<div id="pagingPick"></div>

			</div>
			<!-- table-responsive --->

		</div>
		<!--//panel-body-->
	</div>
	<!--panel-->
</div></div>

<div class="row"><div class="col-lg-12" style="padding-top:0px;"><div class="btn btn-warning pull-right" onclick="tutupPick();"><i class="fa fa-close fa-fw"></i> Tutup</div></div></div>


<script type="text/javascript">
$(document).ready(function(){
	gridpagingPick(1);
});
function repagingPick(){
	$( "#pagingPick .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingPick .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingPick(inu);	}
	});
}
function gopagingPick(){
	$("#pagingPick #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingPick(ini);
	});
}
function gridpagingPick(hal){
var cari = $('#caripagingPick').val();
var batas = $('#item_lengthPick').val();
var jenjang = $('#kode_jenjang_pendidikanPick').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pendidikan/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"jenjang":jenjang,"kehal":"pagingPick"},
		beforeSend:function(){	
			$('#listPick').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingPick').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
					table = table+ "<td style='padding:3px;text-align:center;'><div onclick=\"pilihPickPendidikan('"+item.nama_pendidikan+"','"+item.kode_jenjang+"','"+item.nama_jenjang+"','"+item.nama_jenjang_rumpun+"','"+item.id_pendidikan+"');\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check fa-fw\"></i></div></td>";
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jenjang+"<br /><b>"+item.nama_jenjang_rumpun+"</b></td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_pendidikan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listPick').html(table);
					$('#pagingPick').html(data.pager);
					repagingPick();gopagingPick();
			} else {
				$('#listPick').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingPick').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>