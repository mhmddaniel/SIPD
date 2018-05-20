<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$title;?></h3>
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
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
		<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
				<?php if($tpp->status=="draft"){ ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_tpp_edit','<?=@$tpp->id_tpp;?>','1');"><i class="fa fa-edit fa-fw"></i>Edit Rencana Kerja</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_tpp_hapus','<?=@$tpp->id_tpp;?>','1');"><i class="fa fa-trash fa-fw"></i>Hapus Rencana Kerja</a></li>
				<li role="presentation" class="divider"></li>
				<?php } ?>
				<?php if($tpp->status=="draft" || $tpp->status=="revisi_penilai"){ ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_tpp_ajupenilai','<?=@$tpp->id_tpp;?>','1');"><i class="fa fa-upload fa-fw"></i>Ajukan kepada Pejabat Penilai</a></li>
				<?php } ?>
				<li role="presentation"><a href="<?=site_url('apptukin/xls_rencana');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i>Cetak Rencana Kerja</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_tpp_baru','xx','1');"><i class="fa fa-star fa-fw"></i>Buat Rencana Kerja Baru</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('arsip','1','1');"><i class="fa fa-binoculars fa-fw"></i>Lihat Arsip Rencana Kerja</a></li>
			</ul>
		</div>
	</div>
			<span style="margin-left:5px;" id=judul_tpp><b>RENCANA KERJA TAHUN <?=@$tpp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Periode</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;">
											<?=$bulan[@$tpp->bulan_mulai];?> s.d. <?=$bulan[@$tpp->bulan_selesai];?>
										</div></span>
									</div>
								</div>
								<div class="row" id=status_tpp>
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

<div class="row target">
	<div class="col-lg-6">
		<div class="panel panel-default" id="panel_penilai">
			<div class="panel-heading">
				<span class="fa fa-user fa-fw"></span>
				<span id=judul_box_penilai><b>PEJABAT PENILAI</b></span>
				<?php if($tpp->status=="draft"){ ?>
				<div class="dropdown pull-right">
					<div class="btn btn-primary btn-xs" id="ddMenuT" data-toggle="dropdown"><i class="fa fa-edit fa-fw"></i></div>
					<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_pangkat_penilai','<?=@$tpp->id_tpp;?>','<?=$tpp->id_penilai;?>');"><i class="fa fa-signal fa-fw"></i>Edit Pangkat</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_jabatan_penilai','<?=@$tpp->id_tpp;?>','<?=$tpp->id_penilai;?>');"><i class="fa fa-tasks fa-fw"></i>Edit Jabatan</a></li>
					</ul>
				</div>
				<?php } ?>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div id="panel_nama_penilai">
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->penilai_gelar_depan) != '-')?trim($tpp->penilai_gelar_depan).' ':'';?><?=(trim($tpp->penilai_gelar_nonakademis) != '-')?trim($tpp->penilai_gelar_nonakademis).' ':'';?><?=$tpp->penilai_nama_pegawai;?><?=(trim($tpp->penilai_gelar_belakang) != '-')?', '.trim($tpp->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->penilai_nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="penilai_pangkat"><?=$tpp->penilai_nama_pangkat." / ".$tpp->penilai_nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="penilai_jabatan"><?=$tpp->penilai_nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="penilai_unor"><?=$tpp->penilai_nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-default" style="margin-bottom:5px;" id="panel_pegawai">
			<div class="panel-heading">
				<span class="fa fa-user fa-fw"></span>
				<span id=judul_box_pegawai><b>PEGAWAI YANG DINILAI</b></span>
				<?php if($tpp->status=="draft"){ ?>
				<div class="dropdown pull-right">
					<div class="btn btn-primary btn-xs" id="ddMenuT" data-toggle="dropdown"><i class="fa fa-edit fa-fw"></i></div>
					<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_pangkat_pegawai','<?=@$tpp->id_tpp;?>','<?=$tpp->id_pegawai;?>');"><i class="fa fa-signal fa-fw"></i>Edit Pangkat</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_jabatan_pegawai','<?=@$tpp->id_tpp;?>','<?=$tpp->id_pegawai;?>');"><i class="fa fa-tasks fa-fw"></i>Edit Jabatan</a></li>
					</ul>
				</div>
				<?php } ?>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($tpp->gelar_depan) != '-')?trim($tpp->gelar_depan).' ':'';?><?=(trim($tpp->gelar_nonakademis) != '-')?trim($tpp->gelar_nonakademis).' ':'';?><?=$tpp->nama_pegawai;?><?=(trim($tpp->gelar_belakang) != '-')?', '.trim($tpp->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$tpp->nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="pegawai_pangkat"><?=$tpp->nama_pangkat." / ".$tpp->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_jabatan"><?=$tpp->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_unor"><?=$tpp->nomenklatur_pada;?></div></span>
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
	<div class="btn btn-<?=($i==$bulan_pilih)?"warning":"default";?> btn-xs" onclick="pilih_bulan(<?=$i;?>);" id="btn_bulan_<?=$i;?>"><i class="fa fa-edit fa-fw"></i> <?=$bulan2[$i];?></div>
<?php
}
?>
	<div class="btn btn-<?=($bulan_pilih=="total")?"warning":"default";?> btn-xs" onclick="pilih_bulan('total');" id="btn_bulan_total"><i class="fa fa-edit fa-fw"></i> Total</div>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th rowspan="2" style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<?php if($tpp->status!="aju_penilai" && $tpp->status!="koreksi_penilai" && $tpp->status!="acc_penilai"){ ?>
<th rowspan="2" style="width:25px;text-align:center;vertical-align:middle;">AKSI</th>
<?php } ?>
<th rowspan="2" style="width:300px;text-align:center;vertical-align:middle;">URAIAN TUGAS</th>
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
<?php if($tpp->status!="aju_penilai" && $tpp->status!="koreksi_penilai" && $tpp->status!="acc_penilai"){ ?>
<td id='aksi_<?=$val->id_target;?>' align=center>
	<div class="btn-group" id="btMenu<?=$val->id_target;?>">
		<button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenu<?=$val->id_target;?>" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('edittarget','<?=$val->id_target;?>','<?=$no;?>');"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('hapustarget','<?=$val->id_target;?>','<?=$no;?>');"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
		</ul>
	</div>
</td>
<?php } ?>
<td><div id='pekerjaan_<?=$val->id_target;?>'><?=$val->pekerjaan;?></div></td>
<?php
for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){  
	$gg = "ak_".$i;
	$hh = "vol_".$i;
	$ii = "kualitas_".$i;
	$jj = "biaya_".$i;
?>
<td id='ak_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$bulan_pilih)?"style='display:none;'":"";?>><?=$val->$gg;?></td>
<td id='vol_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$bulan_pilih)?"style='display:none;'":"";?>><?=$val->$hh;?></td>
<td id='satuan_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$bulan_pilih)?"style='display:none;'":"";?>><?=$val->satuan;?></td>
<td id='kualitas_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$bulan_pilih)?"style='display:none;'":"";?>><?=$val->$ii;?></td>
<td id='biaya_<?=$tpp->id_tpp."_".$val->id_target."_".$i;?>' class="target_bulan_<?=$i;?>" <?=($i!=$bulan_pilih)?"style='display:none;'":"";?> align=right><?=number_format($val->$jj,2,"."," ");?></td>
<?php
}
?>
<td id='ak_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" <?=($bulan_pilih!="total")?"style='display:none;'":"";?>><?=$val->ak_total;?></td>
<td id='vol_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" <?=($bulan_pilih!="total")?"style='display:none;'":"";?>><?=$val->vol_total;?></td>
<td id='satuan_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" <?=($bulan_pilih!="total")?"style='display:none;'":"";?>><?=$val->satuan;?></td>
<td id='kualitas_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" <?=($bulan_pilih!="total")?"style='display:none;'":"";?>>100</td>
<td id='biaya_<?=$tpp->id_tpp."_".$val->id_target."_total";?>' class="target_bulan_total" <?=($bulan_pilih!="total")?"style='display:none;'":"";?> align=right><?=number_format($val->biaya_total,2,"."," ");?></td>
</tr>
<?php
$no++;
}
if($tpp->status!="aju_penilai" && $tpp->status!="koreksi_penilai" && $tpp->status!="acc_penilai"){
?>
<tr id='row_xx'>
<td id='nomor_xx'><?=$no;?></td>
<td id='aksi_xx' align=center>...</td>
<td id='pekerjaan_xx'>
<button class="btn btn-primary btn-xs" type="button" data-nomor="<?=($no);?>" id='xx' onClick="setForm('tambahtarget','xx','<?=($no);?>');"><i class="fa fa-plus fa-fw"></i> Tambah kegiatan...</button>
</td>
<td id='ak_xx'>...</td>
<td id='volume_xx'>...</td>
<td id='satuan_xx'>...</td>
<td id='kualitas_xx'>...</td>
<td id='biaya_xx'>...</td>
</tr>
<?php } ?>
</tbody>
</table>
</div><!-- table-responsive --->



			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan dari Pejabat Penilai:</b></div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=30 align=center>No.</th>
			<?php if($tpp->status!="aju_penilai" && $tpp->status!="koreksi_penilai" && $tpp->status!="acc_penilai"){ ?>
			<th width=30 align=center>AKSI</th>
			<?php } ?>
			<th width=400 align=center>URAIAN CATATAN</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($catatan AS $key=>$val){ ?>
		<tr>
			<td><?=($key+1);?></td>
			<?php if($tpp->status!="aju_penilai" && $tpp->status!="koreksi_penilai" && $tpp->status!="acc_penilai"){ ?>
			<td align=center>
						<?php if($val->status=="ditanya"){ ?><div class="btn btn-primary btn-xs" onClick="setForm('input_jawaban','<?=$val->id_catatan;?>','1');"><i class="fa fa-pencil fa-fw"></i></div><?php } ?>
						<?php if($val->status=="dijawab"){ ?><div class="btn btn-primary btn-xs" onClick="setForm('edit_jawaban','<?=$val->id_catatan;?>','<?=$val->id_jawaban;?>');"><i class="fa fa-pencil fa-fw"></i></div><?php } ?>
			</td>
			<?php } ?>
			<td>
					<div class="row">
						<div class="col-lg-12" style="padding-right:50px;"><div class="well well-sm" style="background-color:#FFFFCC;margin:0px;"><?=$val->catatan;?><br /><small><?=$val->last_updated;?></small></div></div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<?php if($val->jawaban!="") { ?>
					<div class="row">
						<div class="col-lg-12" style="padding-left:50px;"><div class="well well-sm" style="background-color:#ccFFFF;margin:0px;"><?=$val->jawaban;?><br /><small><?=$val->waktu;?></small></div></div>
					</div><!-- /.row -->
					<?php } ?>
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
	kop['form_tpp_baru'] = "FORM RENCANA KERJA BARU"; 
	kop['form_tpp_edit'] = "FORM EDIT RENCANA KERJA"; 
	kop['form_tpp_hapus'] = "FORM PENGHAPUSAN RENCANA KERJA"; 
	kop['track'] = "DAFTAR TAHAPAN RENCANA KERJA"; 
	kop['form_tpp_ajupenilai'] = "FORM PENGAJUAN RENCANA KERJA KEPADA PEJABAT PENILAI"; 
	kop['arsip'] = "DAFTAR ARSIP RENCANA KERJA"; 
	kop['form_pangkat_penilai'] = "FORM EDIT PANGKAT PEJABAT PENILAI"; 
	kop['form_jabatan_penilai'] = "FORM EDIT JABATAN PEJABAT PENILAI"; 
	kop['form_pangkat_pegawai'] = "FORM EDIT PANGKAT PEGAWAI"; 
	kop['form_jabatan_pegawai'] = "FORM EDIT JABATAN PEGAWAI"; 
	kop['tambahtarget'] = "FORM ISIAN TARGET KEGIATAN"; 
	kop['edittarget'] = "FORM EDIT TARGET KEGIATAN"; 
	kop['hapustarget'] = "FORM HAPUS TARGET KEGIATAN"; 
	kop['input_jawaban'] = "FORM PENGISIAN JAWABAN ATAS CATATAN PENILAI"; 
	kop['edit_jawaban'] = "FORM EDIT JAWABAN ATAS CATATAN PENILAI"; 
	var act = []; 
	act['form_tpp_baru'] = "<?=site_url();?>apptukin/rencana/form_aksi_tpp"; 
	act['form_tpp_edit'] = "<?=site_url();?>apptukin/rencana/form_aksi_tpp"; 
	act['form_tpp_hapus'] = "<?=site_url();?>apptukin/rencana/hapus_tpp"; 
	act['track'] = ""; 
	act['form_tpp_ajupenilai'] = "<?=site_url();?>apptukin/rencana/aju_penilai"; 
	act['arsip'] = ""; 
	act['form_pangkat_penilai'] = ""; 
	act['form_jabatan_penilai'] = ""; 
	act['form_pangkat_pegawai'] = ""; 
	act['form_jabatan_pegawai'] = ""; 
	act['tambahtarget'] = "<?=site_url();?>apptukin/rencana/edit_target_aksi";
	act['edittarget'] = "<?=site_url();?>apptukin/rencana/edit_target_aksi";
	act['hapustarget'] = "<?=site_url();?>apptukin/rencana/hapus_target_aksi";
	act['input_jawaban'] = "<?=site_url();?>apptukin/rencana/input_jawaban_aksi"; 
	act['edit_jawaban'] = "<?=site_url();?>apptukin/rencana/edit_jawaban_aksi"; 
	var btt = []; 
	btt['form_tpp_baru'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['form_tpp_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['form_tpp_hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['track'] = "<div id='btAct'></div>"; 
	btt['form_tpp_ajupenilai'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-upload fa-fw'></i> Ajukan</button>"; 
	btt['arsip'] = "<div id='btAct'></div>"; 
	btt['form_pangkat_penilai'] = "<div id='btAct'></div>"; 
	btt['form_jabatan_penilai'] = "<div id='btAct'></div>"; 
	btt['form_pangkat_pegawai'] = "<div id='btAct'></div>"; 
	btt['form_jabatan_pegawai'] = "<div id='btAct'></div>"; 
	btt['tambahtarget'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['edittarget'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['hapustarget'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['input_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['edit_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
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
	$("[id^='ak_<?=$tpp->id_tpp;?>_']").hide();
	$("[id^='vol_<?=$tpp->id_tpp;?>_']").hide();
	$("[id^='satuan_<?=$tpp->id_tpp;?>_']").hide();
	$("[id^='kualitas_<?=$tpp->id_tpp;?>_']").hide();
	$("[id^='biaya_<?=$tpp->id_tpp;?>_']").hide();
	$(".target_bulan_"+bulan).show();
	$("[id^='btn_bulan_']").removeClass('btn btn-warning').addClass('btn btn-default');
	$("#btn_bulan_"+bulan).removeClass('btn-default').addClass('btn-warning');
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>