<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

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
					<button type=button class="btn btn-default" onClick='tutupForm();' id="btBatal"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
				</div>
			</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.pageForm -->

<div id="pageKonten">
<div class="row">
	<div class="col-lg-12" style="text-align:right; padding-bottom:10px;">
		<div class="btn btn-warning btn-sm" onclick="batal();"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
	<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenu1" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu1">
			<li role="presentation"><a href="<?=site_url('apptukin/xls_realisasi');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i>Cetak Realisasi</a></li>
		</ul>
	</div>
	</div>
			<span style="margin-left:5px;"><b>REALISASI KERJA TAHUN <?=$tpp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px; width:100%;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Periode</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;">
											<?php
												$bulan = $this->dropdowns->bulan();
												echo $bulan[$bulan_aju];
											?>
										</div></span>
									</div>
								</div>
								<div class="row" id=status_skp>
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Tahapan</div>
										<div style="float:left; width:10px;"> : </div>
										<span onClick="setForm('track','1','1','r');" id='trackbutton'>
											<div class="btn btn-warning btn-xs">
												<span id="tahapan_skp_nomor"><?=$tahapan_realisasi_nomor[$realisasi_tahapan->status];?>.</span>
												<span><?=$tahapan_realisasi[$realisasi_tahapan->status];?> <i class="fa fa-caret-down fa-fw"></i></span>
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
										<span><?=$tpp->penilai_nip_baru;?></span>
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
										<span><?=$tpp->nip_baru;?></span>
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
                        <div class="panel-body" style="padding:0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tugas_pokok" data-toggle="tab"><i class="fa fa-briefcase fa-fw"></i> Tugas pokok</a></li>
                                <li><a href="#tugas_tambahan" data-toggle="tab" onClick="vTab('tugas_tambahan');return false;" id="key_tugas_tambahan"><i class="fa fa-ra fa-fw"></i>Tugas tambahan</a></li>
                                <li><a href="#kreatifitas" data-toggle="tab" onClick="vTab('kreatifitas');return false;" id="key_kreatifitas"><i class="fa fa-trophy fa-fw"></i> Kreatifitas</a></li>
                                <li><a href="#perilaku" data-toggle="tab" onClick="vTab('perilaku');return false;" id="key_perilaku"><i class="fa fa-child fa-fw"></i> Perilaku</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:5px;">
                                <div class="tab-pane fade in active" id="tugas_pokok">
<div id="grid-data">
		<div class="table-responsive">
<form id="tugas_pokok-form" method="post" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;">No.</th>
<th style="width:200px;">KEGIATAN TUGAS JABATAN</th>
<th style="width:110px;">UNSUR</th>
<th style="width:100px;">TARGET</th>
<th style="width:100px;">REALISASI</th>
</tr>
</thead>
<tbody>
<?php
$b_ak = "ak_".$bulan_aju;$b_vol = "vol_".$bulan_aju;$b_kualitas = "kualitas_".$bulan_aju;$b_biaya = "biaya_".$bulan_aju;
$no=1;
foreach($target AS $key=>$val){
?>
<tr id='row_tugas_pokok_<?=$val->id_target;?>'>
<td id='nomor_tugas_pokok_<?=$val->id_target;?>'><?=$no;?></td>
<td id='pekerjaan_<?=$val->id_target;?>'><?=$val->pekerjaan;?></td>
<td id='unsur_<?=$val->id_target;?>'>
	<div style="text-align:right;" class="ket ak_<?=$val->id_target;?>">AK :</div>
	<div style="text-align:right;" class="ket volume_<?=$val->id_target;?>">KUANTITAS :</div>
	<div style="text-align:right;" class="ket kualitas_<?=$val->id_target;?>">KUALIITAS :</div>
	<div style="text-align:right;" class="ket biaya_<?=$val->id_target;?>">BIAYA :</div>
</td>
<td id='target_<?=$val->id_target;?>'>
	<div id='ak_target_<?=$val->id_target;?>' class="ket ak_<?=$val->id_target;?>"><?=$val->$b_ak;?></div>
	<div><span id='kuantitas_target_<?=$val->id_target;?>' class="ket volume_<?=$val->id_target;?>"><?=$val->$b_vol;?></span> <span><?=$val->satuan;?></span></div>
	<div id='kualitas_target_<?=$val->id_target;?>' class="ket kualitas_<?=$val->id_target;?>"><?=$val->$b_kualitas;?></div>
	<div id='biaya_target_<?=$val->id_target;?>' class="ket biaya_<?=$val->id_target;?>" style='text-align:right'><?=number_format($val->$b_biaya,2,"."," ");?></div>
</td>
<td id='realisasi_<?=$val->id_target;?>'>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='ak' id='ak_realisasi_<?=$val->id_target;?>'><?=$realisasi_target[$key]->$b_ak;?></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='volume' id='kuantitas_realisasi_<?=$val->id_target;?>'><?=$realisasi_target[$key]->$b_vol;?> <span><?=$val->satuan;?></span></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='kualitas' id='kualitas_realisasi_<?=$val->id_target;?>'><?=$realisasi_target[$key]->$b_kualitas;?></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='biaya' id='biaya_realisasi_<?=$val->id_target;?>' style='text-align:right'><?=number_format($realisasi_target[$key]->$b_biaya,2,"."," ");?></div>
</td>
</tr>
<?php
$no++;
}
?>
</table>
</form>
		</div><!-- table-responsive --->
</div><!-- /.grid-data -->
								</div><!-- tab id=tugas -->
                                <div class="tab-pane fade" id="tugas_tambahan" style="padding-top:5px;">Tugas tambahan</div>
                                <div class="tab-pane fade" id="kreatifitas" style="padding-top:5px;">Kreatifitaskkk</div>
                                <div class="tab-pane fade" id="perilaku" style="padding-top:5px;">Perilaku</div>
							</div>
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
					<?php if($val->jawaban!="") { ?>
					<div class="row">
						<div class="col-lg-12" style="padding-left:50px;"><div class="well well-sm" style="background-color:#ccFFFF;margin:0px;padding:3px;"><?=$val->jawaban;?><br /><small><?=$val->waktu;?></small></div></div>
					</div><!-- /.row -->
					<?php } ?>
			</td>
		</tr>
		<?php } ?>
		<?php if(empty($catatan)) {	?>
		<tr>
			<td>&nbsp;</td>
			<td align=center>Tidak Ada Catatan</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div><!-- table-responsive --->

			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


</div>	
<!--#pageKonten-->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}
function setForm(tujuan,idd,no,urutan){
	var kop = []; 
	kop['track'] = "DAFTAR TAHAPAN REALISASI KERJA"; 
	var act = []; 
	act['track'] = ""; 
	var btt = []; 
	btt['track'] = ""; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/realisasi_aju/"+tujuan,
			data:{"idd": idd },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').hide();
				$('#btBatal').show();
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

function vTab(isi){
	$('.btn.batal').click();
	$('#'+isi+'').html('');
	var bulan = <?=$bulan_aju;?>;
	$("#tab_aktif").html(isi);
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/realisasi_aju/lembar_"+isi+"/",
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

function isiParam(indikator){
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>apptukin/realisasi_aju/perilaku_param/",
					data:{"indikator":indikator },
					beforeSend:function(){	
						$('#grid_perilaku').hide();
						$('#param_perilaku').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><p>').show();
					},
					success:function(data){
						$('#param_perilaku').html(data);
					},
					dataType:"html"});//end jax
}
function tutupParam(){
	$('#param_perilaku').html('').hide();
	$('#grid_perilaku').show();
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/apptukin/<?=$asal;?>');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';	
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="kode" value="<?=$kode;?>">';
	var tab = tab + '<input type="hidden" name="pns" value="<?=$pns;?>">';
	var tab = tab + '<input type="hidden" name="ppkt" value="<?=$pkt;?>">';
	var tab = tab + '<input type="hidden" name="pjbt" value="<?=$jbt;?>">';
	var tab = tab + '<input type="hidden" name="pese" value="<?=$ese;?>">';
	var tab = tab + '<input type="hidden" name="ptugas" value="<?=$tugas;?>">';
	var tab = tab + '<input type="hidden" name="pgender" value="<?=$gender;?>">';
	var tab = tab + '<input type="hidden" name="pagama" value="<?=$agama;?>">';
	var tab = tab + '<input type="hidden" name="pstatus" value="<?=$status;?>">';
	var tab = tab + '<input type="hidden" name="pjenjang" value="<?=$jenjang;?>">';
	var tab = tab + '<input type="hidden" name="pumur" value="<?=$umur;?>">';
	var tab = tab + '<input type="hidden" name="pmkcpns" value="<?=$mkcpns;?>">';
	var tab = tab + '<input type="hidden" name="bulan" value="<?=$bulan_aju;?>">';
	var tab = tab + '<input type="hidden" name="tahun" value="<?=$tahun;?>">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
