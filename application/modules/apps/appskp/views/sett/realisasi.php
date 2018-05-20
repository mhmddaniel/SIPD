<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?>
		<button class="btn btn-primary pull-right" type="button" onclick="kembali(); return false;"><i class="fa fa-fast-backward fa-fw"></i>Kembali...</button>
		 </h3>
	</div>	<!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	<div style="float:left;">
	<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenu1" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu1">
			<!--<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('realisasi_kelola/form_kembalikan_skp','1','1','1');"><i class="fa fa-download fa-fw"></i>Dikoreksi, kembalikan kepada Pegawai</a></li>-->
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('realisasi_kelola/form_hapus_skp','1','1','1');"><i class="fa fa-download fa-fw"></i>Hapus SKP</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('realisasi_kelola/form_turun_skp','1','1','1');"><i class="fa fa-download fa-fw"></i>Turun Status ke Pegawai</a></li>
		</ul>
	</div>
	</div>
			<span style="margin-left:5px;"><b>SKP TAHUN <?=$skp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px; width:100%;">
								<div class="row">
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Periode</div>
										<div style="float:left; width:10px;"> : </div>
										<span><div style="display:table;">
											<?php
												$bulan = $this->dropdowns->bulan();
												echo $bulan[$skp->bulan_mulai]." s.d. ".$bulan[$skp->bulan_selesai];
											?>
										</div></span>
									</div>
								</div>
								<div class="row" id=status_skp>
									<div class="col-lg-12">
										<div style="float:left; width:95px;">Tahapan</div>
										<div style="float:left; width:10px;"> : </div>
										<span onClick="bsmShow('track','1','1','r');" id='trackbutton'>
											<div class="btn-warning btn-xs" style="display:table;">
												<div style="float:left; width:25px; text-align:right; padding-right:5px;" id="tahapan_skp_nomor"><?=$tahapan_skp_nomor[$realisasi_tahapan->status];?>.</div>
												<span><div style="display:table;"><?=$tahapan_skp[$realisasi_tahapan->status];?> <i class="fa fa-caret-down fa-fw"></i></div></span>
											</div>
										</span>
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
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($skp->penilai_gelar_depan) != '-')?trim($skp->penilai_gelar_depan).' ':'';?><?=(trim($skp->penilai_gelar_nonakademis) != '-')?trim($skp->penilai_gelar_nonakademis).' ':'';?><?=$skp->penilai_nama_pegawai;?><?=(trim($skp->penilai_gelar_belakang) != '-')?', '.trim($skp->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><?=$skp->penilai_nip_baru;?></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nama_pangkat." / ".$skp->penilai_nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-default" style="margin-bottom:5px;">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEGAWAI YANG DINILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($skp->gelar_depan) != '-')?trim($skp->gelar_depan).' ':'';?><?=(trim($skp->gelar_nonakademis) != '-')?trim($skp->gelar_nonakademis).' ':'';?><?=$skp->nama_pegawai;?><?=(trim($skp->gelar_belakang) != '-')?', '.trim($skp->gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><?=$skp->nip_baru;?></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->nama_pangkat." / ".$skp->nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$skp->nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
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
<table class="table table-striped table-bordered table-hover" style="width:1024px;">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;">No.</th>
<th style="width:25px;">AKSI</th>
<th style="width:200px;">KEGIATAN TUGAS JABATAN</th>
<th style="width:110px;">UNSUR</th>
<th style="width:100px;">TARGET</th>
<th style="width:100px;">REALISASI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach($target AS $key=>$val){
?>
<tr id='row_tugas_pokok_<?=$val->id_target;?>'>
<td id='nomor_tugas_pokok_<?=$val->id_target;?>'><?=$no;?></td>
<td id='aksi_tugas_pokok_<?=$val->id_target;?>' align=center>
	<div class="dropdown" id="btMenu<?=$val->id_target;?>">
	<?php
	if(@$realisasi[$key]->icon=="pentung")
	{
	?>
		<button class="btn btn-danger dropdown-toggle btn-xs" type="button" id="dd_tugas_pokok_<?=$val->id_target;?>" data-toggle="dropdown"><i class="fa fa-exclamation fa-fw"></i></button>
	<?php
	}
	elseif(@$realisasi[$key]->icon=="acc")
	{
	?>
		<button class="btn btn-success dropdown-toggle btn-xs" type="button" id="dd_tugas_pokok_<?=$val->id_target;?>" data-toggle="dropdown"><i class="fa fa-check fa-fw"></i></button>
	<?php
	}
	else
	{
	?>
		<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dd_tugas_pokok_<?=$val->id_target;?>" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
	<?php
	}
	?>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu<?=$val->id_target;?>">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('point','<?=$val->id_target;?>','tugas_pokok','acc');"><i class="fa fa-check fa-fw"></i>ACC Realisasi Kegiatan Tugas Jabatan</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('point','<?=$val->id_target;?>','tugas_pokok','koreksi');"><i class="fa fa-edit fa-fw"></i>Koreksi Realisasi Kegiatan Tugas Jabatan, dan beri komentar</a></li>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="bsmShow('point','<?=$val->id_target;?>','tugas_pokok','komentar');"><i class="fa fa-comment fa-fw"></i>Lihat komentar</a></li>
		</ul>
	</div>
</td>
<td id='pekerjaan_<?=$val->id_target;?>'><?=$val->pekerjaan;?></td>
<td id='unsur_<?=$val->id_target;?>'>
	<div style="text-align:right;" class="ket ak_<?=$val->id_target;?>">AK :</div>
	<div style="text-align:right;" class="ket volume_<?=$val->id_target;?>">KUANTITAS :</div>
	<div style="text-align:right;" class="ket kualitas_<?=$val->id_target;?>">KUALIITAS :</div>
	<div style="text-align:right;" class="ket waktu_lama_<?=$val->id_target;?>">WAKTU :</div>
	<div style="text-align:right;" class="ket biaya_<?=$val->id_target;?>">BIAYA :</div>
</td>
<td id='target_<?=$val->id_target;?>'>
	<div id='ak_target_<?=$val->id_target;?>' class="ket ak_<?=$val->id_target;?>"><?=$val->ak;?></div>
	<div><span id='kuantitas_target_<?=$val->id_target;?>' class="ket volume_<?=$val->id_target;?>"><?=$val->volume;?></span> <span><?=$val->satuan;?></span></div>
	<div id='kualitas_target_<?=$val->id_target;?>' class="ket kualitas_<?=$val->id_target;?>"><?=$val->kualitas;?></div>
	<div><span id='waktu_target_<?=$val->id_target;?>' class="ket waktu_lama_<?=$val->id_target;?>"><?=$val->waktu_lama;?></span> <span><?=$val->waktu_satuan;?></div>
	<div id='biaya_target_<?=$val->id_target;?>' class="ket biaya_<?=$val->id_target;?>" style='text-align:right'><?=number_format($val->biaya,2,"."," ");?></div>
</td>
<td id='realisasi_<?=$val->id_target;?>'>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='ak' id='ak_realisasi_<?=$val->id_target;?>'><?=(!isset($realisasi[$key]->ak))?' - ':$realisasi[$key]->ak;?></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='volume' id='kuantitas_realisasi_<?=$val->id_target;?>'><?=(!isset($realisasi[$key]->volume))?' - ':$realisasi[$key]->volume;?> <span><?=$val->satuan;?></span></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='kualitas' id='kualitas_realisasi_<?=$val->id_target;?>'><?=(!isset($realisasi[$key]->kualitas))?' - ':$realisasi[$key]->kualitas;?></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='waktu_lama' id='waktu_realisasi_<?=$val->id_target;?>'><?=(!isset($realisasi[$key]->waktu_lama))?' - ':$realisasi[$key]->waktu_lama;?> <span><?=$val->waktu_satuan;?></div>
	<div class='realisasi' data-idt='<?=$val->id_target;?>' data-var='biaya' id='biaya_realisasi_<?=$val->id_target;?>' style='text-align:right'><?=(!isset($realisasi[$key]->biaya))?' - ':number_format($realisasi[$key]->biaya,2,"."," ");?></div>
</td>
</tr>
<?php
$no++;
}
?>
</table>
</form>
		</div>
		<!-- table-responsive --->
</div>
<!-- /.grid-data -->
								</div>
								<!-- tab id=tugas -->
                                <div class="tab-pane fade" id="tugas_tambahan" style="padding-top:5px;">Tugas tambahan</div>
                                <div class="tab-pane fade" id="kreatifitas" style="padding-top:5px;">Kreatifitaskkk</div>
                                <div class="tab-pane fade" id="perilaku" style="padding-top:5px;">Perilaku</div>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel-default -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<br/><br/>
		<!-- Modal -->
		<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form id="modal-form" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body" id="isi_modal">
										  satu
                                        </div>
	                                    <!-- /.modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary simpan_skp" id="modalButtonAksi"></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close fa-fw"></i> Batal...</button>
                                        </div>
	                                    <!-- /.modal-footer -->
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
			</form>
		</div>
		<!-- /.modal -->
		<!-- SIMPAN -->
		<div id="simpan" style="display:none;"></div>
		<!-- /.SIMPAN -->


<script type="text/javascript"> 
$(document).on('blur', '.form-control.rel',function(){
	var lama = $(this).attr('data-lama');
	var baru = $(this).val(); 
	var ipt = $(this).attr('data-ipt');
	var ada = $('#data_ada').html();
			if(lama!=baru){
					var baruu = baru.split(" ").join("");
					$.ajax({
					type:"POST",
					url:"<?=site_url();?>appskp/realisasi_kelola/perilaku_aksi/",
					data:{"idd": <?=$id_skp;?>,"ipt":ipt,"isi":baru,"ada":ada },
					beforeSend:function(){	
						$('#ipt_'+ipt).hide();
						$('<div id="paraC"><p class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><p></div>').insertAfter('#ipt_'+ipt);
					},
					success:function(data){
						if(data.pesan=="sukses"){
							$('#paraC').remove();
							$('#ipt_'+ipt).attr('data-lama',data.nilai).show();
							$('#kat_'+ipt).html(data.kat);
							$('#jumlah').html(data.jumlah);
							$('#rerata').html(data.rerata);
							$('#kat_rerata').html(data.kat_rerata);
							$('#nilai_perilaku').html(data.nilai_perilaku);
							$('#data_ada').html(data.ada);
						} else {
							alert(data.pesan);
							$('#paraC').remove();
							$('#ipt_'+ipt).val(baru).show().focus();
						}
					},
					dataType:"json"});//end jax
			}
});


$(document).on('click', '.btn.batal',function(){
	$("[id='row_tt']").each(function(key,val) {	$(this).remove();	});
	var ini = $(this).attr("id");
	var nomor = $(this).attr("data-nomor");
	var tt= $('#simpan').html();
	$('#row_'+ini+'').removeClass().html(tt);
	$('#simpan').html('');
});

function vTab(isi){
	$('.btn.batal').click();
	$('#'+isi+'').html('');
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/lembar_"+isi+"/",
			data:{"idd": <?=$id_skp;?> },
			beforeSend:function(){	
				$('#'+isi+'').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$('#'+isi+'').html(data);
//				$('#key_'+isi+'').removeAttr("onClick");
			},
			dataType:"html"});
}

function bsmShow(tujuan,idd,idx,operasi){
//	$('.btn.batal').click();
	tutup_track();
		if(tujuan=="track")
		{
			var no = $('#tahapan_skp_nomor').html();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi/track/",
			data:{"idd": <?=$id_skp;?>,"no":no },
			beforeSend:function(){	
				$('<div class="row track" id=track_status><div class="col-lg-12"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div></div>').insertAfter('#status_skp');
			},
			success:function(data){
				$('#track_status').html(data);
				$('#trackbutton i.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
				$('#trackbutton').attr('onclick','tutup_track()');
			},
			dataType:"html"});
		}
		if(tujuan=="point")
		{
			$('#row_tt').remove();
			$("[id='row_']").removeClass();
			if(operasi=="acc"){	var pclass="success";	}	if(operasi=="koreksi"){	var pclass="info";	}	if(operasi=="komentar"){	var pclass="danger";	}
			var nomor = $('#nomor_'+idx+'_'+idd+'').html();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/form"+operasi+"_"+idx+"/",
			data:{"idd": idd,"nomor":nomor },
			beforeSend:function(){	
				var ts = $('#row_'+idx+'_'+idd+'').html();
				$('#simpan').html(ts);
				$('#content-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/target_acc');
				$('<tr id="row_tt" class='+pclass+'><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-1x"></i><p></td></tr>').insertAfter('#row_'+idx+'_'+idd+'');
				$('#row_'+idx+'_'+idd+'').addClass(pclass);
			},
			success:function(data){
				$('#row_tt').html(data);
			},
			dataType:"html"});
		}
		if(tujuan=="realisasi_kelola/form_kembalikan_skp")
		{
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/"+tujuan+"/",
			data:{"idd": idd },
			beforeSend:function(){	
				$('#myModalLabel').html('FORM KOREKSI REALISASI SASARAN KINERJA PEGAWAI');
				$('#modal-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/kembali_skp_aksi');
				$('#modalButtonAksi').attr('onclick','kembalikan_skp();return false;').html('<i class="fa fa-download fa-fw"></i> Kembalikan').show();
				$("#isi_modal").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$('#myModal').addClass('modal-wide').modal('show');
			},
			success:function(data){
				$('#isi_modal').html(data);
			},
			dataType:"html"});
		}

		if(tujuan=="realisasi_kelola/form_turun_skp")
		{
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/"+tujuan+"/",
			data:{"idd": idd },
			beforeSend:function(){	
				$('#myModalLabel').html('FORM TURUN STATUS REALISASI SASARAN KINERJA PEGAWAI');
				$('#modal-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/turun_skp_aksi');
				$('#modalButtonAksi').attr('onclick','turun_skp();return false;').html('<i class="fa fa-download fa-fw"></i> Turunkan').show();
				$("#isi_modal").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$('#myModal').addClass('modal-wide').modal('show');
			},
			success:function(data){
				$('#isi_modal').html(data);
			},
			dataType:"html"});
		}
		if(tujuan=="realisasi_kelola/form_hapus_skp")
		{
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/"+tujuan+"/",
			data:{"idd": idd },
			beforeSend:function(){	
				$('#myModalLabel').html('FORM HAPUS SKP');
				$('#modal-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/hapus_skp_aksi');
				$('#modalButtonAksi').attr('onclick','hapus_skp();return false;').html('<i class="fa fa-trash fa-fw"></i> Hapus').show();
				$("#isi_modal").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$('#myModal').addClass('modal-wide').modal('show');
			},
			success:function(data){
				$('#isi_modal').html(data);
			},
			dataType:"html"});
		}


		if(tujuan=="realisasi_kelola/form_acc_skp")
		{
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/"+tujuan+"/",
			data:{"idd": idd },
			beforeSend:function(){	
				$('#myModalLabel').html('FORM PERSETUJUAN REALISASI SASARAN KINERJA PEGAWAI');
				$('#modal-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/acc_skp_aksi');
				$('#modalButtonAksi').attr('onclick','acc_skp();return_false;').html('<i class="fa fa-check fa-fw"></i> Acc').show();
				$("#isi_modal").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$('#myModal').addClass('modal-wide').modal('show');
			},
			success:function(data){
				$('#isi_modal').html(data);
			},
			dataType:"html"});
		}

		if(tujuan=="realisasi_kelola/target_koreksi")
		{  // hapus
			var ts = $('#row_'+idd+'').html();
			$('#simpan').html(ts);
			$('#content-form').attr('action','<?=site_url();?>appskp/realisasi_kelola/target_koreksi');
			var data = '<tr id="row_tt" class=info><td colspan=2 align=right><b>Komentar :</b></td><td colspan=8><textarea class=form-control id=komentar cols=60 style="height:50px;"></textarea>';
			data = data + '<div style="clear:both;margin-top:5px;"><button class="btn btn-primary btn-xs" type="button" onclick="simpan();">Simpan</button>&nbsp;<button class="btn batal btn-primary btn-xs" id="'+idd+'" data-nomor="'+idd+'" type="button">Batal...</button>';
			data = data + '</div><div style="display:none;" id=idd>'+idd+'</div></td></tr>';
			$(data).insertAfter('#row_'+idd+'');
			$('#row_'+idd+'').addClass('info');
		}
}
function acc(itemid,idd){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/acc_item_"+itemid,
			data:{"itemid":itemid,"idd": idd },
			beforeSend:function(){	
				$('#row_tt').html('<td colspan=7><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td>');
			},
			success:function(data){
				$('#row_'+itemid+'_'+idd).removeClass();
				$('#row_tt').remove();
				$('#dd_'+itemid+'_'+idd).removeClass('btn-danger').removeClass('btn-primary').addClass('btn-success').html('<i class="fa fa-check fa-fw"></i>');
//				location.href = '<?=site_url();?>'+'module/appskp/realisasi_kelola';
			},
			dataType:"html"});
}

function kembali(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/pantau_realisasi",
			data:{"hal": <?=$hal;?>,"cari":"<?=$cari;?>","batas":"<?=$batas;?>","tahun":"<?=$tahun;?>" },
			beforeSend:function(){	
				$("#page-wrapper").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$('#page-wrapper').html(data);
			},
			dataType:"html"});
}


function tutup_track(){
	$("[id^='row_']").removeClass();
	$('.track').remove();
	$('#trackbutton i.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
	$('#trackbutton').attr('onclick','bsmShow("track",1,1,"r")');
}

function kembalikan_skp(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/kembalikan_skp_aksi",
			data:{"komentar": "saya" },
			beforeSend:function(){	
				$('#modalButtonAksi').hide();
				$('#isi_modal').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
			},
			success:function(data){
				location.href = '<?=site_url();?>'+'module/appskp/realisasi_kelola';
			},
			dataType:"html"});
}
function turun_skp(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/turun_skp_aksi",
			data:{"komentar": "saya" },
			beforeSend:function(){	
				$('#modalButtonAksi').hide();
				$('#isi_modal').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
			},
			success:function(data){
				$('#myModal').hide();
				$('.modal-backdrop').hide();
				kembali();
			},
			dataType:"html"});
}
function hapus_skp(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/hapus_skp_aksi",
			data:{"komentar": "saya" },
			beforeSend:function(){	
				$('#modalButtonAksi').hide();
				$('#isi_modal').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
			},
			success:function(data){
				$('#myModal').hide();
				$('.modal-backdrop').hide();
				kembali();
			},
			dataType:"html"});
}
function acc_skp(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/acc_skp_aksi",
			data:{"komentar": "saya" },
			beforeSend:function(){	
				$('#modalButtonAksi').hide();
				$('#isi_modal').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p>');
			},
			success:function(data){
				location.href = '<?=site_url();?>'+'module/appskp/realisasi_kelola';
			},
			dataType:"html"});
}
function simpan(){
	var idd = $('#idd').html();
	var komen = $('#komentar').val();
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appskp/realisasi_kelola/target_koreksi",
			data:{"komentar": komen,"idd":idd },
			beforeSend:function(){	
				$('#row_tt').html('<td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td>');
			},
			success:function(data){
				$('#dropdownMenu_'+idd+'').removeClass('btn-success').removeClass('btn-primary').addClass('btn-danger').html('<i class="fa fa-exclamation fa-fw"></i>');
				$("[id='row_tt']").each(function(key,val) {	$(this).remove();	});
				var data2 = '<span id="tahapan_skp_nomor">4</span>. Koreksi target sasaran kerja pegawai oleh Pejabat Penilai &nbsp;<span class="fa fa-caret-down"></span>';
				$('#trackbutton').html(data2);
			},
			dataType:"html"});
}
$(document).on('click', '.btn.simpan_xx',function(){
	lembar = $(this).attr('data-lembar');
	nomor = $(this).attr('data-nomor');
	aksi = $(this).attr('data-aksi');
		$.ajax({
        type:"POST",
		url:	aksi,
		data:$("#"+lembar+"-form").serialize(),
		beforeSend:function(){	
			$('#row_tt').html('<td colspan=7><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td>');
		},
        success:function(data){
				$('#row_'+lembar+'_'+nomor).removeClass();
				$('#row_tt').remove();
				$('#dd_'+lembar+'_'+nomor).removeClass('btn-success').removeClass('btn-primary').addClass('btn-danger').html('<i class="fa fa-exclamation fa-fw"></i>');
		},
        dataType:"html"});
	return false;
});

</script>
<style>
.modal-wide .modal-dialog {	width: 950px;	}
table th {	text-align:center; vertical-align:middle;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
