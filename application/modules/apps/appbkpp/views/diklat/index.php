<?php 		date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();"><i class="fa fa-close fa-fw"></i></button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body" style="padding-top:15px; padding-bottom:5px; padding-right:5px; padding-left:5px;">
			<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
				<div id="isiForm"></div>
				<div id="tbForm" style="text-align:right;">
					<button id="btAct"></button>
					<button type=button class="btn btn-default" onClick='tutupForm();'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
				</div>
			</form>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel-default -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.pageForm -->
<div  id="pageKonten" style="padding-bottom:30px;">
<?php
if($id_diklat!="xx"){
?>
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
		<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-refresh fa-fw"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('tambah','xx','1');"><i class="fa fa-star fa-fw"></i> Buat Rancangan Diklat Baru</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('edit','<?=$diklat->id_diklat_struk;?>','1');"><i class="fa fa-edit fa-fw"></i> Edit Rancangan Diklat</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('hapus','<?=$diklat->id_diklat_struk;?>','1');"><i class="fa fa-trash fa-fw"></i> Hapus Rancangan Diklat</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('arsip','1','1');"><i class="fa fa-binoculars fa-fw"></i> Lihat Arsip Diklat Penjenjangan</a></li>
			</ul>
		</div>
	</div>
			<span style="margin-left:5px;" id=judul_skp><b><?=$diklat->nama_diklat;?> Tahun <?=$diklat->tahun;?> Angkatan <?=$diklat->angkatan;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Tempat</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->tempat_diklat;?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Waktu</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=date("d-m-Y", strtotime($diklat->tmt_diklat));?> s.d. <?=date("d-m-Y", strtotime($diklat->tst_diklat));?></div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Durasi</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;"><?=$diklat->jam;?> jam</div></span>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:100px;">Penyelenggara</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;" id="tg_jab"><?=$diklat->penyelenggara;?></div></span>
									</div>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12">
                  <div class="panel panel-default">
                        <div class="panel-body" style="padding:0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#peserta" data-toggle="tab"><i class="fa fa-child fa-fw"></i> Peserta</a></li>
                                <li><a href="#jadwal" data-toggle="tab" onClick="vTab('jadwal');return false;" id="key_jadwal"><i class="fa fa-calendar fa-fw"></i> Jadwal</a></li>
                                <li><a href="#widyaiswara" data-toggle="tab" onClick="vTab('widyaiswara');return false;" id="key_widyaiswara"><i class="fa fa-trophy fa-fw"></i> Widyaiswara</a></li>
                                <li><a href="#modul" data-toggle="tab" onClick="vTab('modul');return false;" id="key_modul"><i class="fa fa-folder-open fa-fw"></i> Modul</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:5px;">
                                <div class="tab-pane fade in active" id="peserta">
<div id="grid-data">
		<div class="table-responsive">
<form id="content-form" method="post" action="<?=site_url("appskp/skp/edit_aksi");?>" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover" style="width:1024px;">
<thead id=gridhead>
<tr height=20>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MASA KERJA GOLONGAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
</tr>
</thead>
<tbody>

<?php
$no=0;
foreach($peserta as $key=>$val){
$no++;
?>
<tr id='row_peserta_<?=$val->id_pegawai;?>'>
<td id='nomor_peserta_<?=$val->id_pegawai;?>'><?=$no;?></td>
<td id='aksi_peserta_<?=$val->id_pegawai;?>' style="text-align:center;">
	<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="aksirow('peserta','hapus','<?=$no;?>','<?=$val->id_pegawai;?>');"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
		</ul>
	</div>
</td>
<td><?=$val->nama_pegawai;?> (<?=$val->gender;?>)<br/><?=$val->tempat_lahir;?>, <?=$val->tanggal_lahir;?><br/><?=$val->nip_baru;?></td>
<td>..</td>
<td>..</td>
</tr>
<?php
}
if($no==0){
?>
<tr id='row_peserta_00'>
<td id='nomor_peserta_00'>...</td>
<td id='aksi_peserta_00' align=center>...</td>
<td id='peserta_00'>Belum ada peserta Diklat</td>
<td id='pangkat_00'>...</td>
<td id='jabatan_00'>...</td>
</tr>
<?php
}
?>
<tr id='row_peserta_xx'>
<td id='nomor_peserta_xx'>...</td>
<td id='aksi_peserta_xx' align=center>...</td>
<td id='peserta_xx'>
<button class="btn btn-primary btn-xs" type="button" onclick="aksirow('peserta','tambah','<?=($no+1);?>','xx');" id='xx'><i class="fa fa-plus fa-fw"></i> Tambah peserta...</button>
</td>
<td id='pangkat_xx'>...</td>
<td id='jabatan_xx'>...</td>
</tr>
</table>
</form>
		</div>
		<!-- table-responsive --->
</div>
<!-- /.grid-data -->
								</div>
								<!-- tab id=tugas -->
                                <div class="tab-pane fade" id="jadwal" style="padding-top:5px;">Jadwal Diklat...</div>
                                <div class="tab-pane fade" id="widyaiswara" style="padding-top:5px;">Widyaiswara....</div>
                                <div class="tab-pane fade" id="modul" style="padding-top:5px;">Modul....</div>
							</div>
						</div>
						<!-- /.panel-body -->
				  </div>
				<!-- /.panel-default -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
} else {
?>
<div class="row target">
	<div class="col-lg-12">
		<a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('tambah','xx','1');"><i class="fa fa-star fa-fw"></i>Buat Diklat Pertama</a>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php
}
?>
</div>	
<!--#pageKonten-->
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
<script type="text/javascript">
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}
function ajukan(){
		$.ajax({
        type:"POST",
		url:	$("#pageFormTo").attr('action'),
		data:$("#pageFormTo").serialize(),
		beforeSend:function(){	
			$('#btAct').hide();
			$('#isiForm').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
		},
        success:function(data){
			location.href = '<?=site_url();?>'+'module/appbkpp/diklat';
		},
        dataType:"html"});
	return false;
}
function setForm(tujuan,idd,no){
	batal();
	var kop = []; 
	kop['tambah'] = "FORM DIKLAT BARU"; 
	kop['edit'] = "FORM EDIT DIKLAT"; 
	kop['hapus'] = "FORM HAPUS DIKLAT"; 
	kop['arsip'] = "DAFTAR ARSIP PENYELENGGARAAN DIKLAT STRUKTURAL"; 
	var act = []; 
	act['tambah'] = "<?=site_url();?>appbkpp/diklat/tambah_aksi"; 
	act['edit'] = "<?=site_url();?>appbkpp/diklat/edit_aksi"; 
	act['hapus'] = "<?=site_url();?>appbkpp/diklat/hapus_aksi"; 
	act['arsip'] = ""; 
	var btt = []; 
	btt['tambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['arsip'] = "<div id='btAct'></div>"; 

			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbkpp/diklat/"+tujuan,
			data:{"idd": idd },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$('#pageFormTo').attr('action',act[tujuan]);
				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function aksirow(segmen,aksi,no,idd){
	batal();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appbkpp/diklat/"+segmen+"_"+aksi,
			data:{"no": no,"idd": idd },
			beforeSend:function(){	
				$('#row_'+segmen+'_'+idd).addClass('simpan').hide();
				$('<tr id="row_'+segmen+'_tt"><td colspan=7><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#row_'+segmen+'_'+idd);
			},
			success:function(data){
				$('#row_'+segmen+'_tt').replaceWith(data);
			},
			dataType:"html"});
}
function vTab(){
	batal();
}
function batal(){
	$('.info').remove();
	$('.simpan').removeClass().show();
}
</script>

