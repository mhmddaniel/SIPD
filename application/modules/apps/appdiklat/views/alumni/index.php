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

<div id="content-wrapper">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<span><i class="fa fa-trophy fa-fw"></i> Daftar Alumni Diklat</span>
			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_alumni" style="width:70px;" onchange="gridpaging_alumni(1)">
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
                                <input id="caripaging_alumni" onchange="gridpaging_alumni(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:350px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP - GOLONGAN - PANGKAT</th>
<th style="width:350px;text-align:center; vertical-align:middle">JABATAN<br />UNIT KERJA</th>
<th style="text-align:center; vertical-align:middle">JENIS DIKLAT<br>JAM PELAJARAN</th>
</tr>
</thead>
<tbody id="list_alumni"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_alumni"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<a href="<?=site_url('module/appdiklat/alumni/prajabatan');?>" class="pull-right" style="padding-bottom:30px;">data lama</a>
</div><!-- /.content -->
<div id="form-wrapper" style="display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_alumni("end");
});
function repaging_alumni(){
	$( "#paging_alumni .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_alumni .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_alumni(inu);	}
	});
}
function gopaging_alumni(){
	$("#paging_alumni #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_alumni(ini);
	});
}
function regrid_alumni(){
	var ini = $("#paging_alumni #inputpaging").val();
	gridpaging_alumni(ini);
}
function gridpaging_alumni(hal){
var cari = $('#caripaging_alumni').val();
var batas = $('#item_length_alumni').val();
var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/alumni/getalumni",
		data:{"hal": hal, "batas": batas,"cari":cari,"tahun":tahun},
		beforeSend:function(){	
			$('#list_alumni').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_alumni').html('');
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
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFd(\''+item.id_pegawai+'\');"><i class="fa fa-binoculars fa-fw"></i> Lihat rincian diklat</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br>"+item.nip_baru+"<br>"+item.nama_golongan+" - "+item.nama_pangkat+"</td>";
					table = table+ "<td>"+item.nama_jabatan+"<br><u>pada:</u> "+item.nomenklatur_pada+"</td>";
					table = table+ "<td>";
					table = table+ "Diklat Prajabatan: "+item.prajabatan_jam+" "+item.prajabatan_kali+"<br>";
					table = table+ "Diklat Penjenjangan: "+item.penjenjangan_jam+" "+item.penjenjangan_kali+"<br>";
					table = table+ "Diklat Fungsional: "+item.fungsional_jam+" "+item.fungsional_kali+"<br>";
					table = table+ "Diklat Teknis: "+item.teknis_jam+" "+item.teknis_kali+"<br>";
					table = table+ "<b>Jumlah: "+item.jjam+" jp ("+item.cjam+" kali)</b>";
					table = table+ "</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_alumni').html(table);
					$('#paging_alumni').html(data.pager);
					repaging_alumni();gopaging_alumni();
			} else {
				$('#list_alumni').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_alumni').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function tahun_minus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)-1;
		$('#tahun_act').html(r_tahun);
		gridpaging_alumni("end");
}
function tahun_plus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)+1;
		$('#tahun_act').html(r_tahun);
		gridpaging_alumni("end");
}
function setFd(idd){
	var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/alumni/rincian_pegawai",
		data:{"id_pegawai": idd, "tahun":tahun},
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
function tutup(){
	$('#form-wrapper').hide();
	$('#bt-tahun').show();
	$('#content-wrapper').show();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>