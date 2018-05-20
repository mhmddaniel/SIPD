<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-success">
		<div class="panel-heading">
					<div class="row">
						<div class="col-lg-9">
									<div class="dropdown"><button class="btn btn-warning dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-sign-in fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" <?php if($group_name=="admin"){?>onClick="ppost('xx','module/appbkpp/pegmasuk/formpeg')"<?php } ?>><i class="fa fa-bookmark fa-fw"></i> Tambah Pegawai</a></li>
											<li class="divider"></li>
											<li><a href="#" <?php if($group_name=="admin"){?>onClick="ppost('xx','appbkpp/pegmasuk/set_user')"<?php } ?>><i class="fa fa-lock fa-fw"></i> Buat Hak Akses</a></li>
										</ul>
										Pegawai Masuk
									</div>
						</div>
						<div class="col-lg-3">
									<a class="btn btn-warning btn-xs pull-right" href="<?=site_url($asal);?>"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a>
						</div>
					</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_masuk" style="width:70px;" onchange="gridpaging_masuk(1)">
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
                                <input id="caripaging_masuk" onchange="gridpaging_masuk(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
				<th style="width:35px;text-align:center; vertical-align:middle">AKSI</th>
				<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
				<th style="width:350px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR / NIP / NIP LAMA</th>
				<th style="width:250px;text-align:center; vertical-align:middle">AGAMA / STATUS PERKAWINAN</th>
				<th style="width:35px;text-align:center; vertical-align:middle">STATUS</th>
				</tr>
				</thead>
				<tbody id="list_masuk"></tbody>
				</tbody>
				</table>
			</div><!-- table-responsive --->
							<div id="paging_masuk"></div>
							<div id="paging_print_masuk" style="display:none;"></div>
		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div>


<form id="sb_act" method="post"></form>
<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_masuk('end');
});
function repaging_masuk(){
	$( "#paging_masuk .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_masuk .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_masuk(inu);	}
	});
}
function gopaging_masuk(){
	$("#paging_masuk #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_masuk(ini);
	});
}
function gridpaging_masuk(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_masuk').val();
	var batas = $('#item_length_masuk').val();
	var kode = $('#a_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_pangkat').val();
	var jbt = $('#a_jabatan').val();
	var ese = $('#a_ese').val();
	var tugas = $('#a_tugas').val();
	var gender = $('#a_gender').val();
	var agama = $('#a_agama').val();
	var status = $('#a_status').val();
	var jenjang = $('#a_jenjang').val();
	var umur = $('#a_umur').val();
	var mkcpns = $('#a_mkcpns').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegmasuk/getdata",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list_masuk').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_masuk').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs utm" type="button" data-toggle="dropdown">'+no+' <i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.status=="masuk"){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="ppost('+item.id_pegawai+',\'module/appbkpp/pegmasuk/formpeg\');"><i class="fa fa-pencil fa-fw"></i> Edit Data</a></li>';
							if(item.hapus=="ya"){
								table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="ppost('+item.id_pegawai+',\'module/appbkpp/pegmasuk/formpeg_hapus\');"><i class="fa fa-trash fa-fw"></i> Hapus Data</a></li>';
							}
							<?php if($group_name=="admin") { ?>
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="ppost('+item.id_pegawai+',\'module/appbkpp/pegmasuk/aktifin\');"><i class="fa fa-download fa-fw"></i> Masukkan ke Pegawai Aktif</a></li>';
							<?php } ?>
							table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'tidak\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ '<td><div style="width:150px;"><div class="thumbnail"><img src="'+item.thumb+'"></div></div></td>';
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br>";
					table = table+item.nip_baru+"<br> "+item.nip+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.agama+"<br/>"+item.status_perkawinan+"</td>";
					if(item.status=="masuk"){	var stti = "<div class='btn btn-warning btn-xs'>pending</div>";	}
					if(item.status=="fix"){	var stti = "<div class='btn btn-primary btn-xs'>diterima</div>";	}
					table = table+ "<td style='padding:3px;'>"+stti+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_masuk').html(table);
					$('#paging_masuk').html(data.pager);
					repaging_masuk();gopaging_masuk();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_masuk').html(ini);

			} else {
				$('#list_masuk').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_masuk').html("");
			} // end if
			
//			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}

								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_filter").removeClass("panel-danger").addClass("panel-success");
								} else {
									$("#panel_filter").removeClass("panel-success").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
function ppost(idd,act){
	var cari = $('#caripaging_keluar').val();
	var batas = $('#item_length_keluar').val();
	var hal=$("#paging_keluar #inputpaging").val();
	var kode = $('#a_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_pangkat').val();
	var jbt = $('#a_jabatan').val();
	var ese = $('#a_ese').val();
	var tugas = $('#a_tugas').val();
	var gender = $('#a_gender').val();
	var agama = $('#a_agama').val();
	var status = $('#a_status').val();
	var jenjang = $('#a_jenjang').val();
	var umur = $('#a_umur').val();
	var mkcpns = $('#a_mkcpns').val();

	$('#sb_act').attr('action','<?=site_url();?>'+act);
	var tab = '<input type="hidden" name="cari" value="'+cari+'">';
	var tab = tab + '<input type="hidden" name="batas" value="'+batas+'">';	
	var tab = tab + '<input type="hidden" name="hal" value="'+hal+'">';	
	var tab = tab + '<input type="hidden" name="kode" value="'+kode+'">';
	var tab = tab + '<input type="hidden" name="pns" value="'+pns+'">';
	var tab = tab + '<input type="hidden" name="pkt" value="'+pkt+'">';
	var tab = tab + '<input type="hidden" name="jbt" value="'+jbt+'">';
	var tab = tab + '<input type="hidden" name="ese" value="'+ese+'">';
	var tab = tab + '<input type="hidden" name="tugas" value="'+tugas+'">';
	var tab = tab + '<input type="hidden" name="gender" value="'+gender+'">';
	var tab = tab + '<input type="hidden" name="agama" value="'+agama+'">';
	var tab = tab + '<input type="hidden" name="status" value="'+status+'">';
	var tab = tab + '<input type="hidden" name="jenjang" value="'+jenjang+'">';
	var tab = tab + '<input type="hidden" name="umur" value="'+umur+'">';
	var tab = tab + '<input type="hidden" name="mkcpns" value="'+mkcpns+'">';
	var tab = tab + '<input type="hidden" name="id_pegawai" value="'+idd+'">';
	var tab = tab + '<input type="hidden" name="asal" value="appbkpp/pegmasuk">';
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
function tutup(){
	$("#content-wrapper").show();
	$("#sub_konten").html("").hide();
}
function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>