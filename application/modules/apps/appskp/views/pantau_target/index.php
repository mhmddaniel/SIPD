<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?>
			<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
			
			<div class="btn-group pull-right">
				<div class="btn btn-default" onclick="tahun_minus();"><i class="fa fa-backward fa-fw"></i></div>
				<div class="btn btn-warning active" id="blth_act"><?="Tahun ".$tahun;?></div>
				<div class="btn btn-default" onclick="tahun_plus();"><i class="fa fa-forward fa-fw"></i></div>
			</div>
		 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper">
<div style="padding-top:15px;" class="row">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" onClick="cetak_excel();return false;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
										</ul>
										Daftar Pegawai
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-danger btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>
						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																$selKode = ($kode==$val->kode_unor)?"selected":"";
																echo '<option value="'.$val->kode_unor.'" '.$selKode.'>'.$val->nama_unor.'</option>';															
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Jenis jabatan:</label>
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jbt as $key=>$val){
																$selJbt = ($key==$pjbt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selJbt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Eselon:</label>
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpagingA('end');">
														<option value="" <?=($pese=="")?"selected":"";?>>Semua...</option>
														<option value="2" <?=($pese==2)?"selected":"";?>>Eselon II</option>
														<option value="3" <?=($pese==3)?"selected":"";?>>Eselon III</option>
														<option value="4" <?=($pese==4)?"selected":"";?>>Eselon IV</option>
														<option value="5" <?=($pese==5)?"selected":"";?>>Eselon V</option>
													</select>
											</div>
											<div class="form-group">
												<label>Tahapan Realisasi:</label>
													<select id="a_st_realisasi" name="a_st_realisasi" class="form-control" onchange="gridpagingA('end');">
														<option value="" <?=($pstrealisasi=="")?"selected":"";?>>Semua...</option>
														<option value="BS" <?=($pstrealisasi=="BS")?"selected":"";?>>Belum selesai</option>
														<?php
															foreach($st_realisasi as $key=>$val){
																$selPstrealisasi = ($key==$pstrealisasi)?"selected":"";
																if($key!="buat"){	echo '<option value="'.$key.'" '.$selPstrealisasi.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($pkt as $key=>$val){
																$selPkt = ($key==$ppkt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selPkt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
...
										</div>
									</div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_lengthA" style="width:70px;" onchange="gridpagingA(1)">
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
                                <input id="caripagingA" onchange="gridpagingA(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:250px;text-align:center; vertical-align:middle;">TARGET SKP</th>
</tr>
</thead>
<tbody id=list>
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id=pagingA></div>

											<div id="paging_print" style="display:none;"></div>


		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->



<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpagingA('<?=$hal;?>');
});
function repagingA(){
	$( "#pagingA .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingA .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopagingA(){
	$("#pagingA #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}
function gridpagingA(hal){
var cari = $('#caripagingA').val();
var batas = $('#item_lengthA').val();
var kode = $('#a_kode_unor').val();
var pkt = $('#a_pangkat').val();
var jbt = $('#a_jabatan').val();
var ese = $('#a_ese').val();
var tahun = $('#tahun_act').html();
var st_realisasi = $('#a_st_realisasi').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appskp/pantau_target/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tahun":tahun,"st_realisasi":st_realisasi},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingA').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>"+item.aksi+"</td>";
	//tombol aksi<--
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:95px;'>Nama</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'><b>"+item.nama_pegawai+"</b></div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>NIP</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nip_baru+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Pangkat/Gol.</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nama_pangkat+" / "+item.nama_golongan+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Jabatan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'>"+item.nomenklatur_jabatan+"</div></span>";
					table = table+ "</div></td>";
					table = table+ "<td>";
					$.each( item.realisasi, function(index, item2){
					table = table+ "<div style='clear:both;'>";
					table = table+ "<div style='float:left; width:95px;'>Penilai</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'><b>"+item2.penilai_nama_pegawai+"</b></div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both;'>";
					table = table+ "<div style='float:left; width:95px;'>Periode</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item2.bulan_mulai+" s.d. "+item2.bulan_selesai+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both;padding-bottom:5px;margin-bottom:5px;border-bottom: 1px dotted #666;'>";
					table = table+ "<div style='float:left;width:95px;'>Status</div>";
					table = table+ "<div style='float:left;width:10px;'>:</div>";
					table = table+ "<div class='btn btn-warning btn-xs' onclick='alih("+item2.idskp+"); return false;'><i class='fa fa-search fa-fw'></i> "+item2.status+"</div>";
					table = table+ "</div>";
					});
					table = table+ "</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#pagingA').html(data.pager);
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print').html(ini);
					repagingA();gopagingA();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingA').html("<input type='hidden' id='inputpaging' value='1'>");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function ganti_tahun(tahun){
	$("#a_kode_unor").html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appskp/pantau_realisasi/ganti_tahun",
		data:{"tahun":tahun},
		beforeSend:function(){	
			tutup_div_opsi();
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingA').html('');
		},
		success:function(data){
			$("#a_kode_unor").html(data);
			gridpagingA("end");
		}, // end success
	dataType:"html"}); // end ajax
}
function tahun_minus(){
	var n_tahun = $('#tahun_act').html();
	var r_tahun = parseInt(n_tahun);
	var nw_tahun = r_tahun-1;
	$('#tahun_act').html(nw_tahun);
	$('#blth_act').html("Tahun "+nw_tahun);
	ganti_tahun(nw_tahun);
//	gridpagingA('end');
//	$("#tombol_dashboard").attr("href","<?=site_url();?>apptukin/pantau/refresh_dashboard/"+nw_bulan+"/<?=$tahun;?>");
}
function tahun_plus(){
	var n_tahun = $('#tahun_act').html();
	var r_tahun = parseInt(n_tahun);
	var nw_tahun = r_tahun+1;
	$('#tahun_act').html(nw_tahun);
	$('#blth_act').html("Tahun "+nw_tahun);
	ganti_tahun(nw_tahun);
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}
function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	$('#div_opsi').hide();
}
function alih(idd){
	$.ajax({	type:"POST",	url:"<?=site_url();?>appskp/skp/alih_skp",	data:{"idd": idd},	success:function(data){	pindah();	}, dataType:"html"});
}
function pindah(){
var hal=$("#inputpaging").val();
var cari = $('#caripagingA').val();
var batas = $('#item_lengthA').val();
var tahun = $('#tahun_act').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appskp/sett/target/",
				data:{"hal": hal, "batas": batas,"cari":cari,"tahun":tahun},
				beforeSend:function(){	$('#page-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');	},
				success:function(data){	$('#page-wrapper').html(data);	}, // end success
	        dataType:"html"});
}
function cetak_excel(){
	var ini = $('#paging_print').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>apptukin/xls_realisasi_admin/index/"+hal,"_blank");
}
function batal(aksi,idd){   /////////////// Dipakai untuk kembali dari opsi cetak exel
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
