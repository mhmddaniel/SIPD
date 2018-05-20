<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12" id="colForm">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
					<div id="isiForm"></div>
					<div id="tbForm" style="text-align:right;">
						<button id="btAct"></button>
						<button type=button class="btn btn-default" onClick='tutupForm();' id="btBatal"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
					</div>
				</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten">
<div class="row">
	<div class="col-lg-12" style="padding-bottom:5px; text-align:right">
		 <a href="<?=site_url('module/apptukin/rencana_aju/arsip');?>"><button class="btn btn-primary" type="button"><i class="fa fa-fast-backward fa-fw"></i>Kembali...</button></a>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
	<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenu1" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu1">
			<li role="presentation"><a href="<?=site_url('apptukin/xls_rencana');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i>Cetak Rencana Kerja</a></li>
		</ul>
	</div>
	</div>
			<span style="margin-left:5px;"><b>RENCANA KERJA TAHUN <?=$tpp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Periode</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;">
											<?php
												$bulan = $this->dropdowns->bulan();
												echo $bulan[$tpp->bulan_mulai]." s.d. ".$bulan[$tpp->bulan_selesai];
											?>
										</div></span>
									</div>
								</div>
								<div class="row" id=status_skp>
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Tahapan</div>
										<div style="float:left; width:10px;"> : </div>
										<span>
											<div onClick="setForm('track','1','1');" class="btn btn-warning btn-xs">
												<span id="tahapan_tpp_nomor"><?=$tahapan_tpp_nomor[$tpp->status];?>.</span>
												<span><?=$tahapan_tpp[$tpp->status];?> <i class="fa fa-caret-down fa-fw"></i></span>
											</div>
										</span>
									</div>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'';?><?=(trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'';?><?=$tpp->penilai_nama_pegawai;?><?=(trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nama_pangkat." / ".$tpp->penilai_nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-default" style="margin-bottom:5px;">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEGAWAI YANG DINILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->gelar_depan) != '-')?trim($tpp->gelar_depan).' ':'';?><?=(trim($tpp->gelar_nonakademis) != '-')?trim($tpp->gelar_nonakademis).' ':'';?><?=$tpp->nama_pegawai;?><?=(trim($tpp->gelar_belakang) != '-')?', '.trim($tpp->gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->nama_pangkat." / ".$tpp->nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
<?php
for($i=@$tpp->bulan_mulai;$i<=@$tpp->bulan_selesai;$i++){
?>
	<div class="btn btn-<?=($i==$tpp->bulan_mulai)?"warning":"default";?> btn-xs" onclick="pilih_bulan(<?=$i;?>);" id="btn_bulan_<?=$i;?>"><i class="fa fa-edit fa-fw"></i> <?=$bulan2[$i];?></div>
<?php
}
?>
	<div class="btn btn-default btn-xs" onclick="pilih_bulan('total');" id="btn_bulan_total"><i class="fa fa-edit fa-fw"></i> Total</div>
			</div>
			<!-- /.panel-heading -->

			<div class="panel-body">


<div class="row target" id="grid-data">
	<div class="col-lg-12">
		<div class="table-responsive">
<form id="content-form" method="post" action="<?=site_url("apptukin/rencana/edit_aksi");?>" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th rowspan="2" style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th rowspan="2" style="width:300px;text-align:center;vertical-align:middle;">KEGIATAN TUGAS JABATAN</th>
<th rowspan="2" style="width:80px;text-align:center;vertical-align:middle;">AK</th>
<th colspan="2" align=center valign=center>KUANTITAS</th>
<th rowspan="2" style="width:60px;text-align:center;vertical-align:middle;">K.LITAS</th>
<th rowspan="2" style="width:140px;text-align:center;vertical-align:middle;">BIAYA</th>
</tr>
<tr height=20>
<th style="width:80px;text-align:center;vertical-align:middle;">VOLUME</th>
<th style="width:80px;text-align:center;vertical-align:middle;">SATUAN</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach($target AS $key=>$val){
?>
<tr id='row_<?=$val->id_target;?>'>
<td id='nomor_<?=$val->id_target;?>'><?=$no;?></td>
<td><div id='pekerjaan_<?=$val->id_target;?>'><?=$val->pekerjaan;?></div></td>
<?php
for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
	$gg = "ak_".$i;
	$hh = "vol_".$i;
	$ii = "kualitas_".$i;
	$jj = "biaya_".$i;
?>
<td id='ak_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$tpp->bulan_mulai)?"style='display:none;'":"";?>><?=$val->$gg;?></td>
<td id='vol_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$tpp->bulan_mulai)?"style='display:none;'":"";?>><?=$val->$hh;?></td>
<td id='satuan_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$tpp->bulan_mulai)?"style='display:none;'":"";?>><?=$val->satuan;?></td>
<td id='kualitas_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$tpp->bulan_mulai)?"style='display:none;'":"";?>><?=$val->$ii;?></td>
<td id='biaya_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$tpp->bulan_mulai)?"style='display:none;'":"";?> align=right><?=number_format($val->$jj,2,"."," ");?></td>
<?php
}
?>
<td id='ak_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" style='display:none;'><?=$val->ak_total;?></td>
<td id='vol_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" style='display:none;'><?=$val->vol_total;?></td>
<td id='satuan_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" style='display:none;'><?=$val->satuan;?></td>
<td id='kualitas_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" style='display:none;'>100</td>
<td id='biaya_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" style='display:none;' align=right><?=number_format($val->biaya_total,2,"."," ");?></td>
</tr>
<?php
$no++;
}
?>
</table>
</form>
		</div><!-- table-responsive --->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row target #grid-data-->


			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan untuk pegawai:</b></div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=30 align=center>No.</th>
			<th width=400 align=center>URAIAN CATATAN</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($catatan AS $key=>$val){ ?>
		<tr>
			<td><?=($key+1);?></td>
			<td>
					<div class="row">
						<div class="col-lg-12" style="padding-right:50px;"><div class="well well-sm" style="background-color:#FFFFCC;margin:0px;padding:3px;"><?=$val->catatan;?><br /><small><?=$val->last_updated;?></small></div></div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<div class="row">
						<div class="col-lg-12" style="padding-left:50px;"><div class="well well-sm" style="background-color:#ccFFFF;margin:0px;padding:3px;"><?=$val->jawaban;?><br /><small><?=$val->waktu;?></small></div></div>
					</div><!-- /.row -->
			</td>
		</tr>
		<?php
		}
		if(empty($catatan)){
		?>
		<tr>
			<td colspan=5 align=center>Tidak Ada Catatan</td>
		</tr>
		<?php	}	?>
	</tbody>
</table>
</div><!-- table-responsive --->

			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

</div><!--#pageKonten-->

<script>
function setForm(tujuan,idd,no){
	var kop = []; 
	kop['track'] = "DAFTAR TAHAPAN RENCANA KERJA"; 
	var act = []; 
	act['track'] = ""; 
	var btt = []; 
	btt['track'] = "<div id='btAct'></div>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/rencana/"+tujuan,
			data:{"idd": idd,"no": no },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
				$('#pageFormTo').attr('action',act[tujuan]);

				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
				$("#colForm").attr('class','col-lg-12');
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}
function pilih_bulan(bulan){
	$("[id^='ak_<?=$id_tpp;?>_']").hide();
	$("[id^='vol_<?=$id_tpp;?>_']").hide();
	$("[id^='satuan_<?=$id_tpp;?>_']").hide();
	$("[id^='kualitas_<?=$id_tpp;?>_']").hide();
	$("[id^='biaya_<?=$id_tpp;?>_']").hide();
	$(".target_bulan_"+bulan).show();
	$("[id^='btn_bulan_']").removeClass('btn btn-warning').addClass('btn btn-default');
	$("#btn_bulan_"+bulan).removeClass('btn-default').addClass('btn-warning');
}
</script>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}
</style>
