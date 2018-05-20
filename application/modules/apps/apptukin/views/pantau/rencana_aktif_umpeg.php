<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
		<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
				<li role="presentation"><a href="<?=site_url('apptukin/xls_rencana');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i>Cetak Rencana Kerja</a></li>
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
											<div onClick="setForm('rencana/track','1','1');" class="btn btn-warning btn-xs">
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
			<div class="panel-heading"><span id=judul_box_penilai><b>PEJABAT PENILAI</b></span></div>
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
			<div class="panel-heading"><span id=judul_box_pegawai><b>PEGAWAI YANG DINILAI</b></span></div>
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
?>
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

