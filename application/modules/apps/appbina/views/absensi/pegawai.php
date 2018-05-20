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
<th style="width:20px;text-align:center; vertical-align:middle">No.</th>
<th style="width:100px;text-align:center; vertical-align:middle;padding:0px;">HARI<br>TANGGAL</th>
<th style="width:150px;text-align:center; vertical-align:middle;padding:0px;">JAM KERJA</th>
<th style="width:25px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>HARIAN</th>
<th style="width:150px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI MASUK <br />(<font color="#F00">Telat Masuk</font>)</th>
<th style="width:150px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI PULANG <br />(<font color="#F00">Cepat Pulang</font>)</th>
<th style="width:100px;text-align:center; vertical-align:middle;padding:0px;">LOKASI<br>APEL</th>
<th style="width:25px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>APEL</th>
</tr>
</thead>
<tbody id="list_catatan_absen"></tbody>
</table>
</div><!-- table-responsive --->
			</div><!-- /.panel body -->
		</div>
	</div>
</div><!-- /.row -->

<div id="simpan" style="display:none;">
	<div id="simpan_col"></div>
	<div id="simpan_isi"></div>
	<div id="simpan_id"></div>
</div>

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
						table = table+ "<tr id='row_"+item.id_harian+"'>";
						table = table+ "<td>"+no+".</td>";
						table = table+ "<td>"+item.hari+"</td>";
						if(item.pos_harian=="ya"){	
						var iniPos = "<span onclick='ganti_jam("+item.id_harian+");'>"+item.jam_kerja+"</span>";	
						var iniMasuk = "<span onclick='ganti_masuk("+item.id_harian+");'>"+item.absen_masuk+item.selisih_masuk+"<span>";	
						var iniPulang = "<span onclick='ganti_pulang("+item.id_harian+");'>"+item.absen_pulang+item.selisih_pulang+"<span>";	
						} else {
						var iniPos = item.jam_kerja;	
						var iniMasuk = item.absen_masuk+item.selisih_masuk;	
						var iniPulang = item.absen_pulang+item.selisih_pulang;	
						}
						table = table+ "<td class='col_jam'>"+iniPos+"</td>";
						table = table+ "<td class='col_icon_harian' data-expand='"+item.id_harian+"'>"+item.status_harian+"</td>";
						<?php if($boleh=="ya"){	?>
						table = table+ "<td class='col_masuk'>"+iniMasuk+"</td>";
						table = table+ "<td class='col_pulang'>"+iniPulang+"</td>";
						<?php } else { ?>
						table = table+ "<td class='col_masuk'>"+item.absen_masuk+item.selisih_masuk+"</td>";
						table = table+ "<td class='col_pulang'>"+item.absen_pulang+item.selisih_pulang+"</td>";
						<?php } ?>
						table = table+ "<td>"+item.lokasi+"</td>";
						table = table+ "<td class='col_icon_apel'>"+item.status_apel+"</td>";
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

function ganti_jam(idd){
		ganti_batal();
		var simpan_isi = $("#row_"+idd+" .col_jam").html();
		$("#simpan_col").html('jam');
		$("#simpan_isi").html(simpan_isi);
		$("#simpan_id").html(idd);

		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/absensi/pilihan_jam",
				data:{"idd":idd},
				beforeSend:function(){
					$("#row_"+idd+" .col_jam").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
				},
				success:function(data){
					$("#row_"+idd+" .col_jam").attr("style","padding:0px;").html(data);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function pilih_ini_jam(){
	var simpan_id = $("#simpan_id").html();
	var id_jam = $("#jam_kerja").val();
	if(id_jam==0){
					ganti_batal();
	} else {
					$.ajax({
							type:"POST",
							url:"<?=site_url();?>appbina/absensi/pilihan_jam_aksi",
							data:{"id_harian":simpan_id,"id_jam":id_jam},
							beforeSend:function(){
								$("#row_"+simpan_id+" .col_jam").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
							},
							success:function(data){
								ganti_batal();
								$("#row_"+simpan_id+" .col_jam").html("<span onclick='ganti_jam("+simpan_id+");'>"+data.jam+"<span>");
								$("#row_"+simpan_id+" .col_masuk").html("<span onclick='ganti_masuk("+simpan_id+");'>"+data.masuk+"<span>");
								$("#row_"+simpan_id+" .col_pulang").html("<span onclick='ganti_pulang("+simpan_id+");'>"+data.pulang+"<span>");
							}, // end success
							error: function(data) {
							   alert('Gagal koneksi ke server'); 
							},
					dataType:"json"}); // end ajax
	}
}
function ganti_masuk(idd){
		ganti_batal();
		var simpan_isi = $("#row_"+idd+" .col_masuk").html();
		$("#simpan_col").html('masuk');
		$("#simpan_isi").html(simpan_isi);
		$("#simpan_id").html(idd);

		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/absensi/pilihan_masuk",
				data:{"idd":idd},
				beforeSend:function(){
					$("#row_"+idd+" .col_masuk").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
				},
				success:function(data){
					$("#row_"+idd+" .col_masuk").attr("style","padding:0px;").html(data);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function isi_masuk(){
	var simpan_id = $("#simpan_id").html();
	var jam_masuk = $("#jam_masuk").val();
	if(jam_masuk==""){
					ganti_batal();
	} else {
					$.ajax({
							type:"POST",
							url:"<?=site_url();?>appbina/absensi/isi_masuk_aksi",
							data:{"id_harian":simpan_id,"jam_masuk":jam_masuk},
							beforeSend:function(){
								$("#row_"+simpan_id+" .col_masuk").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
							},
							success:function(data){
								ganti_batal();
								$("#row_"+simpan_id+" .col_masuk").html("<span onclick='ganti_masuk("+simpan_id+");'>"+data.selisih_masuk+"<span>");
								$("#row_"+simpan_id+" .col_icon_harian").html(data.icon_harian);
								$("#row_"+simpan_id+" .col_icon_apel").html(data.icon_apel);
							}, // end success
							error: function(data) {
							   alert('Gagal koneksi ke server'); 
							},
					dataType:"json"}); // end ajax
	}
}
function ganti_pulang(idd){
		ganti_batal();
		var simpan_isi = $("#row_"+idd+" .col_pulang").html();
		$("#simpan_col").html('pulang');
		$("#simpan_isi").html(simpan_isi);
		$("#simpan_id").html(idd);

		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/absensi/pilihan_pulang",
				data:{"idd":idd},
				beforeSend:function(){
					$("#row_"+idd+" .col_pulang").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
				},
				success:function(data){
					$("#row_"+idd+" .col_pulang").attr("style","padding:0px;").html(data);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function isi_pulang(){
	var simpan_id = $("#simpan_id").html();
	var jam_pulang = $("#jam_pulang").val();
	if(jam_pulang==""){
					ganti_batal();
	} else {
					$.ajax({
							type:"POST",
							url:"<?=site_url();?>appbina/absensi/isi_pulang_aksi",
							data:{"id_harian":simpan_id,"jam_pulang":jam_pulang},
							beforeSend:function(){
								$("#row_"+simpan_id+" .col_pulang").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
							},
							success:function(data){
								ganti_batal();
								$("#row_"+simpan_id+" .col_pulang").html("<span onclick='ganti_pulang("+simpan_id+");'>"+data.selisih_pulang+"<span>");
							}, // end success
							error: function(data) {
							   alert('Gagal koneksi ke server'); 
							},
					dataType:"json"}); // end ajax
	}
}
function ganti_batal(){
	var simpan_col = $("#simpan_col").html();
	var simpan_id = $("#simpan_id").html();
	var simpan_isi = $("#simpan_isi").html();
	$("#row_"+simpan_id+" .col_"+simpan_col).attr("style","").html(simpan_isi);
	$("#simpan_id").html("");
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
$(document).on('click', '.col_icon_harian .gt',function(){
	var stt = $(this).text();
	if(stt!=" Hadir"){
		ganti_batal();
		var lvl = $(this).parent().attr("data-expand");
		ganti_icon(lvl);
	}
});

function ganti_icon(lvl){
		var simpan_isi = $("#row_"+lvl+" .col_icon_harian").html();
		$("#simpan_col").html('icon_harian');
		$("#simpan_isi").html(simpan_isi);
		$("#simpan_id").html(lvl);
					$.ajax({
							type:"POST",
							url:"<?=site_url();?>appbina/absensi/ganti_icon_harian",
							data:{"idd":lvl},
							beforeSend:function(){
								$("#row_"+lvl+" .col_icon_harian").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
							},
							success:function(data){
								$("#row_"+lvl+" .col_icon_harian").html(data);
							}, // end success
							error: function(data) {
								ganti_batal();
							},
					dataType:"html"}); // end ajax
}
function ganti_icon_aksi(stt){
	var idd = $("#simpan_id").html();
	$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbina/absensi/ganti_icon_aksi",
			data:{"idd":idd,"stt":stt},
			beforeSend:function(){
				$("#row_"+idd+" .col_icon_harian").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><div>');
			},
			success:function(data){
				$("#row_"+idd+" .col_icon_harian").html(data);
				$("#simpan_id").html("");$("#simpan_col").html("");
			}, // end success
			error: function(data) {
				ganti_batal();
			},
	dataType:"html"}); // end ajax
}
function batal_icon(){
	var idd = $("#simpan_id").html();
	var simpanan = $("#simpan_isi").html();
	$("#row_"+idd+" .col_icon_harian").html(simpanan);
}

</script>
<style>
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

