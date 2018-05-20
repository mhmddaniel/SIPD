<?php 		date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="content-wrapper2" style="padding-bottom:30px;">
<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
									<input id="iptTanggal" class="form-control" type="text" onchange="gridpaging(1);" value="<?=date("d-m-Y");?>" style="float:right; width:100px; padding:3px; background-color:#FFFF99; height:26px;">
									<div style="float:right; padding-top:3px;padding-right:5px;">due-Date: </div>
	</div><!-- /.col-lg-12 -->
</div>
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list fa-fw"></i> Daftar Unit Kerja per due-Date</a></li>
											<li role="presentation"><a href="<?=site_url('module/appbkpp/unor/tree');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Tampilan hirarki</a></li>
											<?php if($master=="ya"){ ?>
											<li role="presentation" class="divider">
											<li role="presentation"><a href="<?=site_url('module/appbkpp/unor/master');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><div class="btn btn-primary btn-xs"><i class="fa fa-tasks fa-fw"></i></div> Daftar Unit Kerja Master</a></li>
											<?php } ?>
										</ul>
										<span>Daftar Unit Kerja per due-Date</span>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-danger btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>


						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-12">
									<div class="panel panel-default">
										<div class="panel-body">
																	<div class="form-group">
																		<label>Eselon:</label>
																			<select id="a_ese" name="a_ese" class="form-control" onchange="gridpaging('end');">
																				<option value="xx" selected>Semua...</option>
																				<?php
																					foreach($ese as $key=>$val){
																						$selEse = ($key==$pese)?"selected":"";
																						if($key!=""){	echo '<option value="'.$key.'" '.$selEse.'>'.$val.'</option>';	}
																					}
																				?>
																			</select>
																	</div>
										</div>
									</div>
								</div>
						</div>


		</div>
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
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:105px;text-align:center; vertical-align:middle">KODE</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA UNIT KERJA</th>
<th style="width:390px;text-align:center; vertical-align:middle">ESELON<br /><b>JABATAN STRUKTURAL</b></th>
<th style="width:110px;text-align:center; vertical-align:middle">MASA BERLAKU</b></th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging"></div>
		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.content -->
<div id="sub_konten2" style="padding-bottom:30px; display:none;"></div>

<script type="text/javascript">
$(document).ready(function(){
	gridpaging(<?=$hal;?>);
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
function gridpaging(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
var tanggal = $('#iptTanggal').val();
var ese = $('#a_ese').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/unor/getdata",
		data:{"hal": hal, "batas": batas,"tanggal":tanggal,"cari":cari,"ese":ese},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil2('+item.id_unor+',\'appbkpp/pejabat/pemangku_riwayat\');return false;"><i class="fa fa-binoculars fa-fw"></i> Lihat pemangku jabatan</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_unor+"<br>"+item.id_unor+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_unor+"</td>";
					table = table+ "<td style='padding:3px;'><div id='kol_2_"+item.id_unor+"'><b>"+item.nomenklatur_jabatan+"</b><br />"+item.nama_ese+" <u>pada</u><br />"+item.nomenklatur_pada+"</div></td>";
					table = table+ "<td style='padding:3px;text-align:center'>"+item.tmt_berlaku+"</br>s.d.</br>"+item.tst_berlaku+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	$('#div_opsi').hide();
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
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>