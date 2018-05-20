<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($pegawai_info->gelar_depan) != '-')?trim($pegawai_info->gelar_depan).' ':'';?><?=(trim($pegawai_info->gelar_nonakademis) != '-')?trim($pegawai_info->gelar_nonakademis).' ':'';?><?=$pegawai_info->nama_pegawai;?><?=(trim($pegawai_info->gelar_belakang) != '-')?', '.trim($pegawai_info->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;"><?=$pegawai_info->nip_baru;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=@$pegawai_info->nama_pangkat." / ".@$pegawai_info->nama_golongan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=@$pegawai_info->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=@$pegawai_info->nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6">&nbsp;</div>
</div>
<!-- /.row -->



<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<div style="float:left;">
						<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
								<li role="presentation"><a href="<?=site_url('module/apptukin/realisasi_aju');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-edit fa-fw"></i>Daftar Pengajuan</a></li>
								<li role="presentation"><a href="<?=site_url('module/apptukin/realisasi_aju/arsip');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-save fa-fw"></i>Arsip Persetujuan</a></li>
							</ul>
						</div>
					</div>
					<span style="margin-left:5px;" id=judul_tpp><b>DAFTAR PENGAJUAN REALISASI KERJA</b></span>
			</div>
			<div class="panel-body">
<div id="grid-data">
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="width:100%;">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;">No.</th>
<th style="width:25px;">AKSI</th>
<th style="width:350px;">TAHUN / BULAN / TAHAPAN</th>
<th style="width:350px;">PEGAWAI YANG DINILAI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
$bulan = $this->dropdowns->bulan();
foreach($tpp AS $key=>$val){
?>
<tr id='row_<?=$val->id_tpp;?>'>
<td id='nomor_<?=$val->id_tpp;?>'><?=$no;?></td>
<td id='aksi_<?=$val->id_tpp;?>' align=center>
	<a href="<?=site_url('apptukin/realisasi_aju/alih/'.$val->id_tpp.'/'.$val->bulan);?>" style="cursor:pointer;"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenu1"><i class="fa fa-binoculars fa-fw"></i></button></a>
</td>
<td id='periode_<?=$val->id_tpp;?>'>
<?=$val->tahun;?><br/>
<?=$bulan[$val->bulan];?><br/>
<div>
	<div style="float:left; margin-right:5px;"><?=$tahapan_tpp_nomor[$val->status];?>.</div>
	<span><div style="display:table;"><?=$tahapan_tpp[$val->status];?></div></span>
</div>
</td>
<td id='penilai_<?=$val->id_tpp;?>'>
								<div>
										<div style="float:left; width:110px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nama_penilai_<?=$val->id_tpp;?>'><?=(trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'';?><?=(trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'';?><?=$val->nama_pegawai;?><?=(trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'';?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nip_penilai_<?=$val->id_tpp;?>'><?=$val->nip_baru;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='pangkat_penilai_<?=$val->id_tpp;?>'><?=$val->nama_pangkat." / ".$val->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id='jabatan_penilai_<?=$val->id_tpp;?>'><?=$val->nomenklatur_jabatan;?></div></span>
								</div>
</td>
</tr>
<?php
$no++;
}
if($no==1){
?>
<tr>
<td colspan=7 align="center">Tidak Ada Pengajuan Realisasi Kerja Pegawai</td>
</tr>
<?php
}
?>
</table>
		</div>
		<!-- table-responsive --->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.grid-data -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>