<div class="row">
	<div class="col-lg-12">
					<div class="page-header"><h1><?=$satu;?></h1></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
			<i class="fa fa-user fa-fw"></i> Identitas Pegawai
<?php
if($tutup=="ya"){
?>
		<div class="btn-group pull-right">
			<div class="btn btn-warning btn-xs" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
		</div>
<?php
}
?>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div id="panel_nama_penilai">
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><b><?=(trim($data->gelar_depan) != '-')?trim($data->gelar_depan).' ':'';?><?=(trim($data->gelar_nonakademis) != '-')?trim($data->gelar_nonakademis).' ':'';?><?=$data->nama_pegawai;?><?=(trim($data->gelar_belakang) != '-')?', '.trim($data->gelar_belakang):'';?></b></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$data->nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="penilai_pangkat"><?=$data->nama_pangkat." / ".$data->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="penilai_jabatan"><?=$data->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="penilai_unor"><?=$data->nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div>
	</div>
</div><!-- /.row -->

<div class="row" id="detailpegawai">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<b>Catatan Absensi Pegawai</b>
					<div class="pull-right">
							<div id='bulan_bct' style="display:none;"><?=date('m');?></div>
							<div id='tahun_bct' style="display:none;"><?=date('Y');?></div>
							<div id='tab_act' style="display:none;">apel</div>
							<div class="btn-group pagingframe pull-right">
							<div class="btn btn-default btn-xs" onclick="bulan_mns();"><i class="fa fa-backward fa-fw"></i></div>
							<div class="btn btn-warning btn-xs active" id="blth_bct"><?=$bulan[date('m')]." ".date('Y');?></div>
							<div class="btn btn-default btn-xs" onclick="bulan_pls();"><i class="fa fa-forward fa-fw"></i></div>
							</div>
					</div>
			</div>
			<div class="panel-body" style="padding:5px;">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:25px;text-align:center; vertical-align:middle">No.</th>
<th style="width:100px;text-align:center; vertical-align:middle;padding:0px;">HARI<br>TANGGAL</th>
<th style="width:75px;text-align:center; vertical-align:middle;padding:0px;">JAM KERJA</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>HARIAN</th>
<th style="width:80px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI MASUK <br />(<font color="#F00">Telat Masuk</font>)</th>
<th style="width:80px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI PULANG <br />(<font color="#F00">Cepat Pulang</font>)</th>
<th style="width:100px;text-align:center; vertical-align:middle;padding:0px;">LOKASI<br>APEL</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>APEL</th>
</tr>
</thead>
<tbody id="list_catatan_absen">
</tbody>
</table>
</div><!-- table-responsive --->
			</div><!-- /.panel body -->
		</div>
	</div>
</div><!-- /.row -->



<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	viewCPegawai();
});
function viewCPegawai(){
	var period = $('#tahun_bct').html()+"-"+$('#bulan_bct').html();
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/absensi/pegawai_catatan",
				data:{"period":period},
				beforeSend:function(){
					$('#list_catatan_absen').html('<tr><td colspan=8><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
				},
				success:function(data){
					var table="";
					var no=1;
					$.each( data.hsl, function(index, item){
						table = table+ "<tr>";
						table = table+ "<td>"+no+".</td>";
						table = table+ "<td>"+item.hari+"</td>";
						table = table+ "<td>"+item.jam_kerja+"</td>";
						table = table+ "<td>"+item.status_harian+"</td>";
						table = table+ "<td>"+item.absen_masuk+item.selisih_masuk+"</td>";
						table = table+ "<td>"+item.absen_pulang+item.selisih_pulang+"</td>";
						table = table+ "<td>"+item.lokasi+"</td>";
						table = table+ "<td>"+item.status_apel+"</td>";
						table = table+ "</tr>";
						no++;
					}); //endeach
					$('#list_catatan_absen').html(table);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"json"}); // end ajax
}
function bulan_mns(){
	var n_bulan = $('#bulan_bct').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_bct').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_bct').html(nw_tahun);
		$('#bulan_bct').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_bct').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_bct').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_bct').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	viewCPegawai(tab_act);
}
function bulan_pls(){
	var n_bulan = $('#bulan_bct').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_bct').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_bct').html(nw_tahun);
		$('#bulan_bct').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_bct').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_bct').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_bct').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	viewCPegawai(tab_act);
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
</script>
<style>
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

