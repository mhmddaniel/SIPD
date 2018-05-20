<div class="row">
	<div class="col-lg-6">&nbsp;</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEGAWAI YANG DINILAI</b></div>
			<div class="panel-body">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=(trim($pegawai_info->gelar_depan) != '-')?trim($pegawai_info->gelar_depan).' ':'';?><?=(trim($pegawai_info->gelar_nonakademis) != '-')?trim($pegawai_info->gelar_nonakademis).' ':'';?><?=$pegawai_info->nama_pegawai;?><?=(trim($pegawai_info->gelar_belakang) != '-')?', '.trim($pegawai_info->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both"></div>
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nip_baru;?></div></span>
								</div>
								<div style="clear:both"></div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<div style="float:left;"><?=$pegawai_info->nama_pangkat." / ".$pegawai_info->nama_golongan;?></div>
								</div>
								<div style="clear:both"></div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both"></div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table style="width:1024px;" class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:25px;">No.</th>
<th style="width:35px;">PILIH</th>
<th style="width:250px;">TAHUN / PERIODE / TAHAPAN</th>
<th style="width:250px;">PEJABAT PENILAI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
$bulan = $this->dropdowns->bulan();
foreach($skp AS $key=>$val){
?>
<tr id='row_<?=$val->id_skp;?>'>
<td id='nomor_<?=$val->id_skp;?>'><?=$no;?></td>
<td id='aksi_<?=$val->id_skp;?>' align=center>
	<button class="btn btn-primary btn-xs" type="button" onclick="iniSKP(<?=$val->id_skp;?>);" data-dismiss="modal" title='Klik untuk memilih skp'><span class="fa fa-check"></span>
</td>
<td id='periode_<?=$val->id_skp;?>'>
<?=$val->tahun;?><br/><?=$bulan[$val->bulan_mulai]." s.d. ".$bulan[$val->bulan_selesai];?><br/>
<?=$tahapan_skp[$val->status];?>
</td>
<td id='penilai_<?=$val->id_skp;?>'>
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'';?><?=(trim($val->penilai_gelar_nonakademis) != '-')?trim($val->penilai_gelar_nonakademis).' ':'';?><?=$val->penilai_nama_pegawai;?><?=(trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->penilai_nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Pkt./Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->penilai_nama_pangkat." / ".$val->penilai_nama_golongan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->penilai_nomenklatur_jabatan;?></div></span>
								</div>
</td>
</tr>
<?php
$no++;
}
?>
</table>
		</div>
		<!-- table-responsive --->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<script type="text/javascript">
function iniSKP(idd){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appskp/skp/alih_skp",
		data:{"idd": idd },
		beforeSend:function(){	
			$('#isi_modal').html('<p class=\"text-center\"><i class=\"fa fa-spinner fa-spin fa-2x\"></i><p>');
		},
        success:function(data){
			location.href = '<?=site_url();?>'+'module/appskp/skp';
		},
        dataType:"html"});
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>