<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?>
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right" id="geser_bulan">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
		 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body" style="padding:0px;">
				<ul class="nav nav-tabs" role="tablist" id="myTab"><!-- Nav tabs -->
					<li style="padding: 7px 10px 5px 5px;">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" onClick="cetak_excel();return false;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
											<li class="utm" onclick="ppost2('module/appbkpp/pegawai/duk');"><a href='#'><i class="fa fa-sort-amount-desc fa-fw"></i> Daftar Urut Kepangkatan</a></li>
											<li class="divider utm"></li>
											<li class="utm" onclick="ppost2('module/appbkpp/pegawai/meninggal');"><a href='#'><i class="fa fa-fire fa-fw"></i> Pegawai Meninggal</a></li>
											<li class="utm" onclick="ppost2('module/appbkpp/pegawai/pensiun');"><a href='#'><i class="fa fa-trophy fa-fw"></i> Pegawai Pensiun</a></li>
											<li class="divider utm"></li>
											<li class="utm"><a href="#"><i class="fa fa-external-link-square fa-fw"></i> Pegawai CLTN</a></li>
											<li class="utm"><a href="#"><i class="fa fa-asterisk fa-fw"></i> Pegawai Tugas Belajar</a></li>
										</ul>
									</div>
					</li>
					<li class="dropdown active">
						<a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> Aktif <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop2">
							<li class="active"><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('aktif');return false;"><i class="fa fa-user-secret fa-fw"></i> PNS dan CPNS</a></li>
							<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('aktif_tkk');return false;"><i class="fa fa-credit-card fa-fw"></i> Tenaga Kerja Kontrak</a></li>
							<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('aktif_thl');return false;"><i class="fa fa-calendar-times-o fa-fw"></i> Tenaga Harian Lepas</a></li>
						</ul>
					</li>
					<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('meninggal');return false;"><i class="fa fa-fire fa-fw"></i> Meninggal</a></li>
					<li><a href="#" role="tab" data-toggle="tab" onclick="viewTab('pensiun');return false;"><i class="fa fa-trophy fa-fw"></i> Pensiun</a></li>
					<li class="dropdown">
						<a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-asterisk fa-fw"></i> Lainnya <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('keluar');return false;"><i class="fa fa-external-link fa-fw"></i> Keluar</a></li>
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('masuk');return false;"><i class="fa fa-sign-in fa-fw"></i> Masuk</a></li>
							<li role="presentation" class="divider"></li>
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('pangkat');return false;"><i class="fa fa-signal fa-fw"></i> Mutasi Kepangkatan</a></li>
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('jabatan');return false;"><i class="fa fa-bookmark fa-fw"></i> Mutasi Jabatan</a></li>
							<li role="presentation" class="divider"></li>
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('menikah');return false;"><i class="fa fa-institution fa-fw"></i> Menikah</a></li>
							<li><a href="#" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTab('cerai');return false;"><i class="fa fa-star-half-o fa-fw"></i> Cerai</a></li>
						</ul>
					</li>
					<li class="btn-group pull-right" style="padding: 7px 15px 5px 5px;">
						<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
					</li>
				</ul><!-- /.Nav tabs -->



				<div class="isi-tab" id="tab_aktif">Aktif</div>
				<div class="isi-tab" style="display:none;" id="tab_aktif_tkk">Pensiun</div>
				<div class="isi-tab" style="display:none;" id="tab_aktif_thl">Pensiun</div>
				<div class="isi-tab" style="display:none;" id="tab_pensiun">Pensiun</div>
				<div class="isi-tab" style="display:none;" id="tab_pangkat">Mutasi Kepangkatan</div>
				<div class="isi-tab" style="display:none;" id="tab_jabatan">Mutasi Jabatan</div>
				<div class="isi-tab" style="display:none;" id="tab_meninggal">Meninggal</div>
				<div class="isi-tab" style="display:none;" id="tab_masuk">Masuk</div>
				<div class="isi-tab" style="display:none;" id="tab_keluar">Keluar</div>
				<div class="isi-tab" style="display:none;" id="tab_prajab">Prajab</div>
				<div class="isi-tab" style="display:none;" id="tab_diklat_penjenjangan">Diklat Penjenjangan</div>
				<div class="isi-tab" style="display:none;" id="tab_diklat_fungsional">Diklat Fungsional</div>
				<div class="isi-tab" style="display:none;" id="tab_diklat_teknis">Diklat Teknis</div>
				<div class="isi-tab" style="display:none;" id="tab_menikah">Menikah</div>
				<div class="isi-tab" style="display:none;" id="tab_cerai">Cerai</div>
				<div id="tab_act" style="display:none;">aktif</div>



			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



</div><!-- /.content-wrapper -->
<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<form id="sn_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	viewIni();
});
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	var ijj = $("#tab_act").html();
	$('#div_opsi_'+ijj).show();
}

function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	var ijj = $("#tab_act").html();
	$('#div_opsi_'+ijj).hide();
}
function batal(aksi,idd){   /////////////// Dipakai untuk kembali dari opsi cetak exel
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}
function bulan_minus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var iTab = $('#tab_act').html();
	viewTab(iTab);
}
function bulan_plus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var iTab = $('#tab_act').html();
	viewTab(iTab);
}
function nm_bulan(bln){
	var bulan = new Array();
    bulan[1] = 'Januari';
    bulan[2] = 'Februari';
    bulan[3] = 'Maret';
    bulan[4] = 'April';
    bulan[5] = 'Mei';
    bulan[6] = 'Juni';
    bulan[7] = 'Juli';
    bulan[8] = 'Agustus';
    bulan[9] = 'September';
    bulan[10] = 'Oktober';
    bulan[11] = 'November';
    bulan[12] = 'Desember';

	var nb_bulan = bulan[bln];
	return nb_bulan;
}
function viewIni(){
	var tahun = $('#tahun_act').html();
	var bulan = $('#bulan_act').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/dafpeg/aktif",
				data:{"tahun": tahun,"bulan":bulan,"kode":"<?=$kode;?>","pns":"<?=$pns;?>","ppkt":"<?=$ppkt;?>","pese":"<?=$pese;?>","pgender":"<?=$pgender;?>","ptugas":"<?=$ptugas;?>","pjenjang":"<?=$pjenjang;?>","pstatus":"<?=$pstatus;?>","pumur":"<?=$pumur;?>","pmkcpns":"<?=$pmkcpns;?>"},
				beforeSend:function(){	
					$("#tab_aktif").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$("#tab_aktif").html(data);
				}, // end success
			dataType:"html"}); // end ajax
}

function viewTab(iTab){
	var tahun = $('#tahun_act').html();
	var bulan = $('#bulan_act').html();
	$(".isi-tab").hide();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/dafpeg/"+iTab,
				data:{"tahun": tahun,"bulan":bulan},
				beforeSend:function(){	
					tutup_div_opsi();
					$("#tab_"+iTab).html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$("#tab_"+iTab).html(data);
					$("#tab_"+iTab).show();
					$("#tab_act").html(iTab);
				}, // end success
			dataType:"html"}); // end ajax
}
function gridpagingA(hh){
	var ijj = $("#tab_act").html();
	if(ijj=="aktif"){	gridpaging_aktif(hh);	}
	if(ijj=="pensiun"){	gridpaging_pensiun(hh);	}
	if(ijj=="meninggal"){	gridpaging_meninggal(hh);	}
	if(ijj=="keluar"){	gridpaging_keluar(hh);	}
	if(ijj=="masuk"){	gridpaging_masuk(hh);	}
	if(ijj=="prajab"){	gridpaging_prajab(hh);	}
	if(ijj=="diklat_penjenjangan"){	gridpaging_penjenjangan(hh);	}
	if(ijj=="diklat_fungsional"){	gridpaging_fungsional(hh);	}
	if(ijj=="diklat_teknis"){	gridpaging_teknis(hh);	}
	if(ijj=="pangkat"){	gridpaging_pangkat(hh);	}
	if(ijj=="jabatan"){	gridpaging_jabatan(hh);	}
	if(ijj=="menikah"){	gridpaging_menikah(hh);	}
	if(ijj=="cerai"){	gridpaging_cerai(hh);	}
}
function ppost2(act){
	$('#sn_act').attr('action','<?=site_url();?>'+act);
	var tab = '<input type="hidden" name="asal" value="module/appbkpp/dafpeg">';
	$('#sn_act').html(tab).submit();
	$('#sn_act').removeAttr( "target" );
}


function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#geser_bulan").hide();
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function detil2(idd,act,boleh,awal){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh,"awal":awal},
		beforeSend:function(){	
			$("#geser_bulan").hide();
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("#geser_bulan").show();
	$("#sub_konten").html("").hide();
	$("#content-wrapper").show();
	regrid();
//	var aact = $("#tab_act").html();
//	if(aact=="aktif"){	regrid_aktif();	}
//	if(aact=="aktif_tkk"){	regrid_aktif_tkk();	}
//	if(aact=="aktif_thl"){	regrid_aktif_thl();	}
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
