<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$title;?></h3>
	</div><!-- /.col-lg-12 -->
</div>

<div id="pageKonten">
<div class="row target">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
							<div style="float:left;">
								<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
										<?php if($realisasi->status=="draft" || $realisasi->status=="revisi_penilai") { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_aju_penilai',1,1,1);"><i class="fa fa-upload fa-fw"></i>Ajukan kepada Pejabat Penilai</a></li>
										<?php } ?>
										<li role="presentation"><a href="<?=site_url('apptukin/xls_realisasi');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i>Cetak Lembar Penilaian</a></li>
										<li role="presentation" class="divider"></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('arsip',1,1,1);"><i class="fa fa-binoculars fa-fw"></i>Lihat Arsip Realisasi Kerja</a></li>
									</ul>
								</div>
							</div>
							<span style="margin-left:5px;" id=judul_tpp><b>REALISASI KERJA TAHUN <?=@$tpp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Periode</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table; margin-bottom:3px;">
<?php
foreach($pil_bulan AS $key=>$val){
?>
	<div class="btn btn-<?=($val->bulan==$bulan_aktif)?"warning":"default";?> btn-xs" onclick="pilih_bulan(<?=$id_tpp;?>,<?=$val->bulan;?>);"><i class="fa fa-edit fa-fw"></i> <?=$bulan2[$val->bulan];?></div>
<?php
}
?>
										</div></span>
									</div>
								</div>
								<div class="row" id=status_tpp>
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Tahapan</div>
										<div style="float:left; width:10px;"> : </div>
                                        <span>
											<div onClick="setForm('track','1','1','r');" id='trackbutton' class="btn btn-warning btn-xs">
												<span id="tahapan_tpp_nomor"><?=$tahapan_tpp_nomor[$realisasi->status];?>.</span>
												<span><?=$tahapan_tpp_realisasi[$realisasi->status];?> <i class="fa fa-caret-down fa-fw"></i></span>
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
				<?php if($realisasi->status=="draft" || $realisasi->status=="revisi_penilai") { ?>
				<div class="dropdown pull-right">
					<div class="btn btn-primary btn-xs" id="ddMenuT" data-toggle="dropdown"><i class="fa fa-edit fa-fw"></i></div>
					<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_pangkat_penilai','<?=@$id_tpp;?>','<?=$tpp->id_penilai;?>');"><i class="fa fa-signal fa-fw"></i>Edit Pangkat</a></li>
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
										<div style="float:left;" id="penilai_pangkat"><?=$realisasi->penilai_nama_pangkat." / ".$realisasi->penilai_nama_golongan;?></div>
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
				<?php if($realisasi->status=="draft" || $realisasi->status=="revisi_penilai") { ?>
				<div class="dropdown pull-right">
					<div class="btn btn-primary btn-xs" id="ddMenuT" data-toggle="dropdown"><i class="fa fa-edit fa-fw"></i></div>
					<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_pangkat_pegawai','<?=@$id_tpp;?>','<?=$tpp->id_pegawai;?>');"><i class="fa fa-signal fa-fw"></i>Edit Pangkat</a></li>
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
										<div style="float:left;" id="pegawai_pangkat"><?=$realisasi->nama_pangkat." / ".$realisasi->nama_golongan;?></div>
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
                        <div class="panel-body" style="padding:0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tugas_pokok" data-toggle="tab"><i class="fa fa-briefcase fa-fw"></i> Tugas pokok</a></li>
                                <li><a href="#tugas_tambahan" data-toggle="tab" onClick="vTab('tugas_tambahan');return false;" id="key_tugas_tambahan"><i class="fa fa-ra fa-fw"></i>Tugas tambahan</a></li>
                                <li><a href="#kreatifitas" data-toggle="tab" onClick="vTab('kreatifitas');return false;" id="key_kreatifitas"><i class="fa fa-trophy fa-fw"></i> Kreatifitas</a></li>
                                <li><a href="#perilaku" data-toggle="tab" onClick="vTab('perilaku');return false;" id="key_perilaku"><i class="fa fa-child fa-fw"></i> Perilaku</a></li>
                            </ul>
                            
                            <div class="tab-content" style="padding:5px;"><!-- Tab panes -->
                            <div class="tab-pane fade in active" id="tugas_pokok">
<div id="grid-data">
<div class="table-responsive">
<form id="content-form" method="post" action="<?=site_url("appskp/skp/edit_aksi");?>" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:55px" valign=center>No.</th>
<th style="width:55px" valign=center>PERUBAHAN<br/>TARGET</th>
<th style="width:450px">KEGIATAN TUGAS JABATAN</th>
<th style="width:120px">UNSUR</th>
<th style="width:150px">TARGET</th>
<th style="width:150px">REALISASI</th>
</tr>
</thead>
<tbody>
<?php
$b_ak = "ak_".$bulan_aktif;$b_vol = "vol_".$bulan_aktif;$b_kualitas = "kualitas_".$bulan_aktif;$b_biaya = "biaya_".$bulan_aktif;
$no=1;
foreach($target AS $key=>$val){
?>
<tr id='row_tugas_pokok_<?=$val->id_target;?>'>
<td id='nomor_<?=$val->id_target;?>'><?=$no;?></td>
<td id='rubah_<?=$val->id_target;?>' align=center>
<?php
$drubah = ($realisasi->status=="draft" || $realisasi->status=="revisi_penilai")?"rubah_form":"rubah_lihat";
if(!empty($val->rubah)){
	if($drubah=="rubah_form"){
		echo "<div class=\"btn-group\" title=\"Ada Perubahan Target\">";
		echo "<button class=\"btn btn-danger dropdown-toggle btn-xs\" type=\"button\" data-toggle=\"dropdown\"><i class=\"fa fa-warning fa-fw\"></i></button>";
		echo '<ul class="dropdown-menu" role="menu">';
		echo '<li role="presentation"><a tabindex="-1" href="#" onclick="setForm(\'rubah_form_edit\','.$val->id_target.','.@$id_tpp.',\'r\'); return false;"><i class="fa fa-pencil fa-fw"></i> Edit Perubahan</a></li>';
		echo '<li class="divider"></li>';
		echo '<li role="presentation"><a tabindex="-1" href="#" onclick="setForm(\'rubah_form_batal\','.$val->id_target.','.@$id_tpp.',\'r\'); return false;"><i class="fa fa-trash fa-fw"></i> Batalkan Perubahan</a></li>';
		echo '</ul>';
		echo '</div>';
	} else {
		echo "<div class=\"btn btn-danger btn-xs\" title=\"Lihat Catatan Perubahan Target\" onclick=\"setForm('".$drubah."',".$val->id_target.",".@$id_tpp.",'r');\"><i class=\"fa fa-warning fa-fw\"></i></div>";
	}
} else {
	if($drubah=="rubah_form"){
		echo "<div class=\"btn-group\" title=\"Tidak Ada Perubahan Target\">";
		echo "<button class=\"btn btn-default dropdown-toggle btn-xs\" type=\"button\" data-toggle=\"dropdown\"><i class=\"fa fa-genderless fa-fw\"></i></button>";
		echo '<ul class="dropdown-menu" role="menu">';
		echo '<li role="presentation"><a tabindex="-1" href="#" onClick="setForm(\''.$drubah.'\','.$val->id_target.','.@$id_tpp.',\'r\'); return false;"><i class="fa fa-pencil fa-fw"></i> Ajukan Perubahan Target</a></li>';
		echo '</ul>';
		echo '</div>';
	} else {
		echo "<div class=\"btn btn-default btn-xs\" title=\"Tidak Ada Perubahan Target\" style=\"cursor:default;\"><i class=\"fa fa-genderless fa-fw\"></i></div>";
	}
}
?>
</td>
<td id='pekerjaan_<?=$val->id_target;?>'><?=$val->pekerjaan;?></td>
<td id='unsur_<?=$id_tpp."_".$val->id_target."_".$bulan_aktif;?>' class="unsur_bulan_<?=$bulan_aktif;?>">
	<div style="text-align:right;" class="ket <?=$b_ak;?>_<?=$val->id_target;?>">AK :</div>
	<div style="text-align:right;" class="ket <?=$b_vol;?>_<?=$val->id_target;?>">KUANTITAS :</div>
	<div style="text-align:right;" class="ket <?=$b_kualitas;?>_<?=$val->id_target;?>">KUALITAS :</div>
	<div style="text-align:right;" class="ket <?=$b_biaya;?>_<?=$val->id_target;?>">BIAYA :</div>
</td>
<td id='target_<?=$id_tpp."_".$val->id_target."_".$bulan_aktif;?>' class="target_bulan_<?=$bulan_aktif;?>">
	<div class="ket <?=$b_ak;?>_<?=$val->id_target;?>"><?=$val->$b_ak;?></div>
	<div><span class="ket <?=$b_vol;?>_<?=$val->id_target;?>"><?=$val->$b_vol?></span> <?=$val->satuan;?></div>
	<div><span class="ket <?=$b_kualitas;?>_<?=$val->id_target;?>"><?=$val->$b_kualitas;?></span></div>
	<div class="ket <?=$b_biaya;?>_<?=$val->id_target;?>" style="text-align:right;"><?=number_format($val->$b_biaya,2,"."," ");?></div>
</td>
<td id='realisasi_<?=$id_tpp."_".$val->id_target."_".$bulan_aktif;?>' class="realisasi_bulan_<?=$bulan_aktif;?>" style='padding:7px 0px 0px 0px;'>
	<?php $dsb=($realisasi->status=="draft" || $realisasi->status=="revisi_penilai")?"":" disabled";	?>
	<input type="text" class="form-control rel" data-idt="<?=@$val->id_target;?>" data-var="<?=$b_ak;?>" id="ipt_<?=$b_ak;?>_<?=@$val->id_target;?>" data-lama="<?=(!isset($realisasi_target[$key]->$b_ak))?'':$realisasi_target[$key]->$b_ak;?>" value='<?=@$realisasi_target[$key]->$b_ak;?>' placeholder="Masukkan angka saja" style="width:100%;height:20px;padding:1px 0px 0px 5px;" <?=$dsb;?>>
	<input type="text" class="form-control rel" data-idt='<?=@$val->id_target;?>' data-var='<?=$b_vol;?>' id="ipt_<?=$b_vol;?>_<?=@$val->id_target;?>" data-lama="<?=(!isset($realisasi_target[$key]->$b_vol))?'':$realisasi_target[$key]->$b_vol;?>" value='<?=@$realisasi_target[$key]->$b_vol;?>' placeholder="Masukkan angka saja" style="width:100%;height:20px;padding:1px 0px 0px 5px;" <?=$dsb;?>>
	<input type="text" class="form-control rel" data-idt='<?=@$val->id_target;?>' data-var='<?=$b_kualitas;?>' id="ipt_<?=$b_kualitas;?>_<?=@$val->id_target;?>" data-lama="<?=(!isset($realisasi_target[$key]->$b_kualitas))?'':$realisasi_target[$key]->$b_kualitas;?>" value='<?=@$realisasi_target[$key]->$b_kualitas;?>' placeholder="Masukkan angka saja" style="width:100%;height:20px;padding:1px 0px 0px 5px;" <?=$dsb;?>>
	<input type="text" class="form-control rel biaya" data-idt='<?=@$val->id_target;?>' data-var='<?=$b_biaya;?>' id="ipt_<?=$b_biaya;?>_<?=@$val->id_target;?>" data-lama="<?=(!isset($realisasi_target[$key]->$b_biaya))?'':number_format($realisasi_target[$key]->$b_biaya,2,"."," ");?>" value='<?=(!isset($realisasi_target[$key]->$b_biaya))?'':number_format($realisasi_target[$key]->$b_biaya,2,"."," ");?>' placeholder="Masukkan angka saja" style="width:100%;height:20px;padding:1px 5px 0px 5px;text-align:right;" <?=$dsb;?>>
</td>
</tr>
<?php
$no++;
}
if($no==1){
?>
<tr><td colspan=6 align=center>Belum ada kegiatan tugas jabatan</td></tr>
<?php
}
?>
</table>
</form>
</div><!-- table-responsive --->
</div><!-- /.grid-data -->
								</div><!-- tab id=tugas_pokok -->
                                <div class="tab-pane fade" id="tugas_tambahan" style="padding-top:5px;"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
                                <div class="tab-pane fade" id="kreatifitas" style="padding-top:5px;"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
                                <div class="tab-pane fade" id="perilaku" style="padding-top:5px;"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
							</div><!-- Tab panes -->
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
			<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
			<th width=30 align=center>AKSI</th>
			<?php } ?>
			<th width=400 align=center>URAIAN CATATAN</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($catatan AS $key=>$val){ ?>
		<tr>
			<td><?=($key+1);?></td>
			<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
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

</div><!-- /.PageKonten -->


<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12">
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
							<button type=button class="btn btn-default" onClick='tutupForm();' id='btBatal'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
						</div>
					</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!--/.row-->


<form id="sb_act" method="post"></form>
<div id="simpan" style="display:none;"></div>
<script type="text/javascript" src="<?=base_url('assets/js/jquery/maskmoney/3.0.2/jquery.maskMoney.min.js');?>"></script>
<script type="text/javascript">
$(function() {
	$('.biaya').maskMoney({thousands:' ', decimal:'.', allowZero:true});
})
$(document).on('blur', '.form-control.rel',function(){
	var iniVar = $(this).attr('data-var');
	var iniDD = $(this).attr('data-idt');
	$('.aktif.'+iniVar+'_'+iniDD+'').removeClass('aktif').addClass('ket');
	var lama = $(this).attr('data-lama');
	var baru = $(this).val(); 
			if(lama!=baru){
					var baruu = baru.split(" ").join("");
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>apptukin/realisasi/ipt_realisasi",
					data:{"idd": iniDD,"nilai":baruu,"nama":iniVar },
					beforeSend:function(){
						$('#ipt_'+iniVar+'_'+iniDD).hide();
						$('<div style="height:20px;margin:0px;padding:0px;" id="paraC"><p class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><p></div>').insertAfter('#ipt_'+iniVar+'_'+iniDD);
					},
					success:function(data){
						if(data.pesan=="sukses"){
							$('#ipt_'+iniVar+'_'+iniDD).attr('data-lama',data.isi).val(data.isi).show();
						} else {
							alert(data.pesan);
							$('#ipt_'+iniVar+'_'+iniDD).val(baru).show().focus();
						}
						$('#paraC').remove();
					},
					dataType:"json"});//end jax
			} // end if
});
$(document).on('focus', '.form-control.rel',function(){
	var iniVar = $(this).attr('data-var');
	var iniDD = $(this).attr('data-idt');
	$('.ket.'+iniVar+'_'+iniDD+'').removeClass('ket').addClass('aktif');
});
///////////////////////////////////////////////////////////////////////
function setForm(tujuan,idd,no,urutan){
	var kop = []; 
	kop['form_aju_penilai'] = "FORM PENGAJUAN REALISASI KINERJA KEPADA PEJABAT PENILAI"; 
	kop['arsip'] = "DAFTAR ARSIP REALISASI KERJA PEGAWAI"; 
	kop['track'] = "DAFTAR TAHAPAN REALISASI KERJA"; 
	kop['form_pangkat_penilai'] = "FORM EDIT PANGKAT PEJABAT PENILAI"; 
	kop['form_pangkat_pegawai'] = "FORM EDIT PANGKAT PEGAWAI"; 
	kop['tugas_tambahan_tambah'] = "FORM INPUT KEGIATAN TUGAS TAMBAHAN"; 
	kop['tugas_tambahan_edit'] = "FORM EDIT KEGIATAN TUGAS TAMBAHAN"; 
	kop['tugas_tambahan_hapus'] = "FORM HAPUS KEGIATAN TUGAS TAMBAHAN"; 
	kop['kreatifitas_tambah'] = "FORM INPUT KEGIATAN KREATIFITAS"; 
	kop['kreatifitas_edit'] = "FORM EDIT KEGIATAN KREATIFITAS"; 
	kop['kreatifitas_hapus'] = "FORM HAPUS KEGIATAN KREATIFITAS"; 
	kop['input_jawaban'] = "FORM PENGISIAN JAWABAN ATAS CATATAN PENILAI"; 
	kop['edit_jawaban'] = "FORM EDIT JAWABAN ATAS CATATAN PENILAI"; 
	kop['rubah_form'] = "FORM PERUBAHAN TARGET KEGIATAN"; 
	kop['rubah_form_edit'] = "FORM EDIT PERUBAHAN TARGET KEGIATAN"; 
	kop['rubah_form_batal'] = "FORM PEMBATALAN PERUBAHAN TARGET KEGIATAN"; 
	kop['rubah_lihat'] = "CATATAN PERUBAHAN TARGET KEGIATAN"; 
	var act = []; 
	act['form_aju_penilai'] = "<?=site_url();?>apptukin/realisasi/aju_penilai";
	act['arsip'] = "<?=site_url();?>apptukin/realisasi/arsip_aksi"; 
	act['track'] = ""; 
	act['form_pangkat_penilai'] = ""; 
	act['form_pangkat_pegawai'] = ""; 
	act['tugas_tambahan_tambah'] = "<?=site_url();?>apptukin/realisasi/tugas_tambahan_tambah_aksi"; 
	act['tugas_tambahan_edit'] = "<?=site_url();?>apptukin/realisasi/tugas_tambahan_edit_aksi"; 
	act['tugas_tambahan_hapus'] = "<?=site_url();?>apptukin/realisasi/tugas_tambahan_hapus_aksi"; 
	act['kreatifitas_tambah'] = "<?=site_url();?>apptukin/realisasi/kreatifitas_tambah_aksi"; 
	act['kreatifitas_edit'] = "<?=site_url();?>apptukin/realisasi/kreatifitas_edit_aksi"; 
	act['kreatifitas_hapus'] = "<?=site_url();?>apptukin/realisasi/kreatifitas_hapus_aksi"; 
	act['input_jawaban'] = "<?=site_url();?>apptukin/realisasi/input_jawaban_aksi"; 
	act['edit_jawaban'] = "<?=site_url();?>apptukin/realisasi/edit_jawaban_aksi"; 
	act['rubah_form'] = "<?=site_url();?>apptukin/realisasi/rubah_aksi"; 
	act['rubah_form_edit'] = "<?=site_url();?>apptukin/realisasi/rubah_edit_aksi"; 
	act['rubah_form_batal'] = "<?=site_url();?>apptukin/realisasi/rubah_batal_aksi"; 
	act['rubah_lihat'] = ""; 
	var btt = []; 
	btt['form_aju_penilai'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-upload fa-fw'></i> Ajukan</button>"; 
	btt['arsip'] = "<div id='btAct'></div>"; 
	btt['track'] = "<div id='btAct'></div>"; 
	btt['form_pangkat_penilai'] = "<div id='btAct'></div>"; 
	btt['form_pangkat_pegawai'] = "<div id='btAct'></div>"; 
	btt['tugas_tambahan_tambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['tugas_tambahan_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['tugas_tambahan_hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['kreatifitas_tambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['kreatifitas_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['kreatifitas_hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['input_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['edit_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['rubah_form'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='rubah(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['rubah_form_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='rubah(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['rubah_form_batal'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='rubah(); return false;'><i class='fa fa-trash fa-fw'></i> Batalkan</button>"; 
	btt['rubah_lihat'] = ""; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/realisasi/"+tujuan,
			data:{"idd": idd,"no": no,"urutan": urutan, },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
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
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}
///////////////////////////////////////////////////////////////////////
function vTab(isi){
	$('.btn.batal').click();
	$('#'+isi+'').html('');
	var bulan = $("#bulan_aktif").html();
	$("#tab_aktif").html(isi);
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/realisasi/lembar_"+isi+"/",
			data:{"bulan": bulan },
			beforeSend:function(){	
				$('#'+isi+'').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$('#'+isi+'').html(data);
				$('#key_'+isi+'').removeAttr("onClick");
			},
			dataType:"html"});
}
function pilih_bulan(tpp,bln){
	$('#sb_act').attr('action','<?=site_url();?>apptukin/realisasi/alih_realisasi');
	var tab = '<input type="hidden" name="bulan" value="'+bln+'">';
	tab = tab+'<input type="hidden" name="id_tpp" value="'+tpp+'">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
.aktif { color:#ff0000; font-weight:bold;	}
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>