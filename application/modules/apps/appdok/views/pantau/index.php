<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



 <div class="row" id="content-wrapper">
	<div class="col-lg-12">
     <div class="panel panel-default">
     <div class="panel-body" style="padding:0px;">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="active dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><div class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></div> Sudah Upload File <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id="uli_pasfoto_sudah" href="#ddn_pasfoto" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('pasfoto','sudah');return false;"><i class="fa fa-home fa-fw"></i> Pasfoto</a></li>
					<li><a id="uli_karis_karsu_sudah" href="#ddn_karis_karsu" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('karis_karsu','sudah');return false;"><i class="fa fa-home fa-fw"></i> Karis/Karsu</a></li>
					<li><a id="uli_karpeg_sudah" href="#ddn_karpeg" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('karpeg','sudah');return false;"><i class="fa fa-home fa-fw"></i> Kartu Pegawai</a></li>
					<li><a id="uli_taspen_sudah" href="#ddn_taspen" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('taspen','sudah');return false;"><i class="fa fa-home fa-fw"></i> Taspen</a></li>
					<li role="presentation" class="divider"></li>
					<li><a id="uli_sertifikat_prajab_sudah" href="#ddn_sertifikat_prajab" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sertifikat_prajab','sudah');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Sertifikat Prajabatan</a></li>
					<li><a id="uli_sk_cpns_sudah" href="#ddn_sk_cpns" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_cpns','sudah');return false;"><i class="fa fa-star-half-o fa-fw"></i> SK CPNS</a></li>
					<li><a id="uli_sk_pns_sudah" href="#ddn_sk_pns" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_pns','sudah');return false;"><i class="fa fa-star-half-o fa-fw"></i> SK PNS</a></li>
					<li><a id="uli_ijazah_pendidikan_sudah" href="#ddn_ijazah_pendidikan" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('ijazah_pendidikan','sudah');return false;"><i class="fa fa-tasks fa-fw"></i> Ijazah Pendidikan</a></li>
					<li><a id="uli_sk_pangkat_sudah" href="#ddn_sk_pangkat" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_pangkat','sudah');return false;"><i class="fa fa-signal fa-fw"></i> SK Kepangkatan</a></li>
					<li><a id="uli_sk_jabatan_sudah" href="#ddn_sk_jabatan" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_jabatan','sudah');return false;"><i class="fa fa-tasks fa-fw"></i> SK Jabatan</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown"><div class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></div> Belum Upload File <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id="uli_pasfoto_belum" href="#ddn_pasfoto" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('pasfoto','belum');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Pasfoto</a></li>
					<li><a id="uli_karis_karsu_belum" href="#ddn_karis_karsu" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('karis_karsu','belum');return false;"><i class="fa fa-home fa-fw"></i> Karis/Karsu</a></li>
					<li><a id="uli_karpeg_belum" href="#ddn_karpeg" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('karpeg','belum');return false;"><i class="fa fa-home fa-fw"></i> Kartu Pegawai</a></li>
					<li><a id="uli_taspen_belum" href="#ddn_taspen" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('taspen','belum');return false;"><i class="fa fa-home fa-fw"></i> Taspen</a></li>
					<li role="presentation" class="divider"></li>
					<li><a id="uli_sertifikat_prajab_belum" href="#ddn_sertifikat_prajab" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sertifikat_prajab','belum');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Sertifikat Prajabatan</a></li>
					<li><a id="uli_sk_cpns_belum" href="#ddn_sk_cpns" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_cpns','belum');return false;"><i class="fa fa-star-half-o fa-fw"></i> SK CPNS</a></li>
					<li><a id="uli_sk_pns_belum" href="#ddn_sk_pns" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_pns','belum');return false;"><i class="fa fa-star-half-o fa-fw"></i> SK PNS</a></li>
					<li><a id="uli_ijazah_pendidikan_belum" href="#ddn_ijazah_pendidikan" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('ijazah_pendidikan','belum');return false;"><i class="fa fa-tasks fa-fw"></i> Ijazah Pendidikan</a></li>
					<li><a id="uli_sk_pangkat_belum" href="#ddn_sk_pangkat" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_pangkat','belum');return false;"><i class="fa fa-signal fa-fw"></i> SK Kepangkatan</a></li>
					<li><a id="uli_sk_jabatan_belum" href="#ddn_sk_jabatan" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('sk_jabatan','belum');return false;"><i class="fa fa-tasks fa-fw"></i> SK Jabatan</a></li>
<!--
					<li><a href="#ddn_skp" tabindex="-1" role="tab" data-toggle="tab" onclick="vTbPeg('skp','belum');return false;"><i class="fa fa-tasks fa-fw"></i> SKP</a></li>
-->
				</ul>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="padding:5px;">
		  <div class="tab-pane fade in active" id="ddn_pasfoto">
<!-- ISI GRID DATA -->
		  
		  
		  
<div class="panel panel-green" id="panelGrid">
<div class="panel-heading">
<div class="row">
	<div class="col-lg-7" id="kopGrid">PASFOTO</div>
	<div class="col-lg-5">
<?php
if($load!="_umpeg"){
?>
		<select id="kode_unor" name="kode_unor" class="form-control" onchange="gridpaging('end');" style="height:20px;padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px; background-color:#FFFF00;">
			<option value="" <?=($kode=="")?"selected":"";?>>Semua...</option>
				<?php
				foreach($unor as $key=>$val){
					$selKode = ($kode==$val->kode_unor)?" selected":"";
					echo '<option value="'.$val->kode_unor.'"'.$selKode.'>'.$val->nama_unor.'</option>';															
				}
				?>
		</select>
<?php
} else {
?>
		<input type=hidden id="kode_unor" name="kode_unor" value="xx">
<?php
}
?>

	</div>
</div>
</div>
<div class="panel-body">
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging('end')">
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
                                <input id="caripaging" onchange="gridpaging('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<form id="form_sub" method="post" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:50px;text-align:center; vertical-align:middle;padding:0px;">DOKUMEN</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MASA KERJA GOLONGAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</form>
</div><!-- table-responsive --->
	<div id="paging"></div>
</div>
</div>
		  
<!-- /.ISI GRID DATA -->
		  </div>
		</div>
	</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
  </div><!-- /.row -->



<div id="tipe_dok" style="display:none;"><?=$awal;?></div>
<div id="status_dok" style="display:none;"><?=$stt;?></div>
<div id="haltuju" style="display:none;"><?=$hal;?></div>
<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	$("#uli_<?=$awal;?>_<?=$stt;?>").click();
});

function vTbPeg(section,status){
	var haltuju = $('#haltuju').html();
	var statt = $('#status_act').html();
	if(statt=="sudah"){
		if(status=="belum"){ $("#panelGrid").removeClass("panel panel-green").addClass("panel panel-red");	} else {	$("#panelGrid").removeClass("panel panel-red").addClass("panel panel-green");	}
	}
	if(statt=="belum"){
		if(status=="sudah"){ $("#panelGrid").removeClass("panel panel-red").addClass("panel panel-green");	} else {	$("#panelGrid").removeClass("panel panel-green").addClass("panel panel-red");	}
	}

	var kop = []; 
	kop['pasfoto'] = "PASFOTO"; 
	kop['karis_karsu'] = "KARTU SUAMI / KARTU ISTRI"; 
	kop['karpeg'] = "KARTU PEGAWAI"; 
	kop['taspen'] = "TABUNGAN ASURANSI PENSIUN"; 
	kop['skp'] = "SASARAN KERJA PEGAWAI (SKP)"; 
	kop['sk_cpns'] = "SK CPNS"; 
	kop['sk_pns'] = "SK PNS"; 
	kop['sertifikat_prajab'] = "SERTIFIKAT PRAJAB"; 
	kop['ijazah_pendidikan'] = "IJAZAH PENDIDIKAN"; 
	kop['sk_pangkat'] = "SK KEPANGKATAN"; 
	kop['sk_jabatan'] = "SK JABATAN";
	$('#tipe_dok').html(section);
	$('#status_dok').html(status);
	$('#kopGrid').html(kop[section]);

//	$('#caripaging').val("");
//	$('#item_length option').removeAttr('selected').filter('[value=10]').attr('selected', true);
	gridpaging(haltuju);
	$("#haltuju").html("end");
}

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
<?php
if($load!="_umpeg"){
?>
var kode = $('#kode_unor').val();
<?php
} else {
?>
var kode = "";
<?php
}
?>
var pns = "";
var pkt = "";
var jbt = "";
var ese = "";
var tugas = "";
var gender = "";
var agama = "";
var status = "";
var jenjang = "";
var tipe = $('#tipe_dok').html();
var status = $('#status_dok').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdok/pantau/isi<?=$load;?>",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"tipe":tipe,"status":status},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					var iti = [];	var iti2 = [];
					iti['pasfoto'] = item.pasfoto;	iti2['pasfoto'] = item.pasfoto_r;
					iti['sk_cpns'] = item.sk_cpns;	iti2['sk_cpns'] = item.sk_cpns_r;
					iti['sk_pns'] = item.sk_pns;	iti2['sk_pns'] = item.sk_pns_r;
					iti['sertifikat_prajab'] = item.sertifikat_prajab;	iti2['sertifikat_prajab'] = item.sertifikat_prajab_r;
					iti['ijazah_pendidikan'] = item.ijazah_pendidikan;	iti2['ijazah_pendidikan'] = item.ijazah_pendidikan_r;
					iti['sk_pangkat'] = item.sk_pangkat;	iti2['sk_pangkat'] = item.sk_pangkat_r;
					iti['sk_jabatan'] = item.sk_jabatan;	iti2['sk_jabatan'] = item.sk_jabatan_r;
					iti['karis_karsu'] = item.karis_karsu;	iti2['karis_karsu'] = item.karis_karsu_r;
					iti['karpeg'] = item.karpeg;	iti2['karpeg'] = item.karpeg_r;
					iti['taspen'] = item.taspen;	iti2['taspen'] = item.taspen_r;

					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
//					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center><div class='btn btn-warning btn-xs' onclick='ppost(\""+item.id_pegawai+"\",\""+tipe+"\",\""+status+"\");'>"+iti[tipe]+" / "+iti2[tipe]+"</div></td>";
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center><div class='btn btn-warning btn-xs'  onclick=\"detil(\'"+item.id_pegawai+"\',\'appbkpp/profile/pns_ini\',\'ya\',\'"+tipe+"\');return false;\">"+iti[tipe]+" / "+iti2[tipe]+"</div></td>";
	//tombol aksi<--

					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.tmt_pangkat+"<br/>"+item.mk_gol_tahun+" tahun "+item.mk_gol_bulan+" bulan</td>";
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" ("+item.tugas_tambahan+") <br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					}
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

function tutup(){
	$("#content-wrapper").show();
	$("#sub_konten").html("").hide();
}
function detil(idd,act,boleh,awal){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh,"awal":awal},
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
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>

