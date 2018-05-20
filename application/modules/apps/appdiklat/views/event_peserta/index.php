<div class="row">
	<div class="col-lg-12">
							 <h3 class="page-header">
								<?=$satu;?>
								<div class="btn-group pull-right" id="bt-tahun">
									<div class="btn btn-default" onclick="tahun_minus();"><i class="fa fa-backward fa-fw"></i></div>
									<div class="btn btn-warning active">Tahun <span id="tahun_act"><?=$tahun;?></span></div>
									<div class="btn btn-default" onclick="tahun_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
							 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<span class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-graduation-cap fa-fw"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
								<li role="presentation" <?=($rumpun==1)?'class="active"':"";?>><a href="<?=($rumpun==1)?"#":site_url('module/appdiklat/event_peserta');?>"><i class="fa fa-<?=($rumpun==1)?'graduation-cap':"tasks";?> fa-fw"></i> Diklat Prajabatan</a></li>
								<li class="divider"></li>
								<li role="presentation" <?=($rumpun==2)?'class="active"':"";?>><a href="<?=($rumpun==2)?"#":site_url('module/appdiklat/event_peserta/diklat_penjenjangan');?>" role="menuitem"><i class="fa fa-<?=($rumpun==2)?'graduation-cap':"tasks";?> fa-fw"></i> Diklat Penjenjangan</a></li>
								<li role="presentation" <?=($rumpun==3)?'class="active"':"";?>><a href="<?=($rumpun==3)?"#":site_url('module/appdiklat/event_peserta/diklat_fungsional');?>" role="menuitem"><i class="fa fa-<?=($rumpun==3)?'graduation-cap':"tasks";?> fa-fw"></i> Diklat Fungsional</a></li>
								<li role="presentation" <?=($rumpun==4)?'class="active"':"";?>><a href="<?=($rumpun==4)?"#":site_url('module/appdiklat/event_peserta/diklat_teknis');?>" role="menuitem"><i class="fa fa-<?=($rumpun==4)?'graduation-cap':"tasks";?> fa-fw"></i> Diklat Teknis</a></li>
								<li role="presentation" <?=($rumpun==5)?'class="active"':"";?>><a href="<?=($rumpun==5)?"#":site_url('module/appdiklat/event_peserta/bimtek');?>" role="menuitem"><i class="fa fa-<?=($rumpun==5)?'graduation-cap':"tasks";?> fa-fw"></i> Bimbingan Teknis</a></li>
								<li class="divider"></li>
								<li role="presentation" <?=($rumpun==6)?'class="active"':"";?>><a href="<?=($rumpun==6)?"#":site_url('module/appdiklat/event_peserta/kursus');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Kursus</a></li>
								<li role="presentation" <?=($rumpun==7)?'class="active"':"";?>><a href="<?=($rumpun==7)?"#":site_url('module/appdiklat/event_peserta/sertifikasi');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Sertifikasi</a></li>
								<li class="divider"></li>
								<li role="presentation" <?=($rumpun==8)?'class="active"':"";?>><a href="<?=($rumpun==8)?"#":site_url('module/appdiklat/event_peserta/seminar');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Seminar</a></li>
								<li role="presentation" <?=($rumpun==9)?'class="active"':"";?>><a href="<?=($rumpun==9)?"#":site_url('module/appdiklat/event_peserta/workshop');?>" role="menuitem"><i class="fa fa-tasks fa-fw"></i> Workshop</a></li>
							</ul>
							<span id="judul"><b><?=ucwords($nama);?></b></span>
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
<tr height=20>
<th style="width:45px;">No.</th>
<th style="width:45px;">AKSI</th>
<th>NAMA DIKLAT / TEMPAT / PENYELENGGARA</th>
<th style="width:200px;">TAHUN / ANGKATAN</th>
<th style="width:240px;">WAKTU / DURASI</th>
</tr>
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
<script type="text/javascript">
$(document).ready(function(){
	gridpaging(1);
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
var jenjang = $('#kode_jenjang_pendidikan').val();
var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/event_peserta/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"tahun":tahun,"rumpun":<?=$rumpun;?>},
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

						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'appdiklat/event_peserta/rinci\',\'<?=$nama;?>*'+item.id_diklat_event +'*<?=$rumpun;?>\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_diklat+"</b><br><u>di:</u> "+item.tempat_diklat+"<br><u>oleh:</u> "+item.penyelenggara+"</td>";
					table = table+ "<td>"+item.tahun+"<br>"+item.angkatan+"</td>";
					table = table+ "<td>"+item.tmt_diklat_alt+" s.d. "+item.tst_diklat_alt+"<br>"+item.jam+" jam</td>";
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
function tahun_minus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)-1;
		$('#tahun_act').html(r_tahun);
		if(r_tahun!=<?=$tahun;?>){	$('#bt-tambah').hide();	} else {	$('#bt-tambah').show();	}
		regrid();
}
function tahun_plus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)+1;
		$('#tahun_act').html(r_tahun);
		if(r_tahun!=<?=$tahun;?>){	$('#bt-tambah').hide();	} else {	$('#bt-tambah').show();	}
		regrid();
}

function setForm(aksi,idd){
	var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd":idd,"tahun":tahun},
		beforeSend:function(){	
			$('#bt-tahun').hide();
			$('#content-wrapper').hide();
			$('#form-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#form-wrapper').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal(){
	$('#bt-tahun').show();
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>