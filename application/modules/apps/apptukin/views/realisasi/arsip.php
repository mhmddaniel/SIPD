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
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nama_pangkat." / ".$pegawai_info->nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_pada;?></div></span>
								</div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div id="grid-data">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:25px;">No.</th>
<th style="width:35px;">PILIH</th>
<th style="width:250px;">TAHUN / PERIODE</th>
<th style="width:250px;" align=center>PEJABAT PENILAI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
$bulan = $this->dropdowns->bulan();
foreach($tpp AS $key=>$val){
if($val->status=="acc_penilai"){
?>
<tr id='row_<?=$val->id_tpp;?>'>
<td id='nomor_<?=$val->id_tpp;?>'><?=$no;?></td>
<td id='aksi_<?=$val->id_tpp;?>' align=center>
	<button class="btn btn-primary btn-xs" type="button" onclick="pilih_bulan(<?=$val->id_tpp;?>,<?=$val->bulan_mulai;?>);" data-dismiss="modal" title='Klik untuk memilih skp'><span class="fa fa-check"></span>
</td>
<td id='periode_<?=$val->id_tpp;?>'>
<?=$val->tahun;?><br/><?=$bulan[$val->bulan_mulai]." s.d. ".$bulan[$val->bulan_selesai];?><br/>
</td>
<td id='penilai_<?=$val->id_tpp;?>'>
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nama_penilai_<?=$val->id_tpp;?>'><?=(trim($val->penilai_gelar_depan) != '-')?trim($val->penilai_gelar_depan).' ':'';?><?=(trim($val->penilai_gelar_nonakademis) != '-')?trim($val->penilai_gelar_nonakademis).' ':'';?><?=$val->penilai_nama_pegawai;?><?=(trim($val->penilai_gelar_belakang) != '-')?', '.trim($val->penilai_gelar_belakang):'';?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nip_penilai_<?=$val->id_tpp;?>'><?=$val->penilai_nip_baru;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Pkt./Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='pangkat_penilai_<?=$val->id_tpp;?>'><?=$val->penilai_nama_pangkat." / ".$val->penilai_nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id='jabatan_penilai_<?=$val->id_tpp;?>'><?=$val->penilai_nomenklatur_jabatan;?></div></span>
								</div>
</td>
</tr>
<?php
$no++;
}
}
?>
</table>
			</div><!-- table-responsive --->
		</div><!-- /.col-lg-12 -->
	</div><!-- /.row -->
</div><!-- /.grid-data -->
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>