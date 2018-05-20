<div class="row"  style="margin-top:<?=$margin_top;?>px;">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><i class="fa fa-users fa-fw"></i> PEJABAT STRUKTURAL BKPP KOTA TANGERANG</div><!--/.panel-heading -->
			<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:70px;text-align:center; vertical-align:middle">FOTO</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA PEGAWAI </br> NIP</th>
<th style="width:200px;text-align:center; vertical-align:middle">PANGKAT/GOL. </br> MASA KERJA</th>
<th style="width:230px;text-align:center; vertical-align:middle">JABATAN </br>TMT JABATAN</th>
</tr>
</thead>
<tbody id=list>
<?php
foreach($isi AS $key=>$val){
?>
<tr>
	<td><?=($key+1);?></td>
	<td style="width:70px;text-align:center; vertical-align:middle"><img id="view_pasfoto_<?=$val->id_dokumen;?>" src="<?=base_url();?>assets/media/file/<?=$val->nip_baru;?>/<?=$val->tipe_dokumen;?>/thumb_<?=$val->file_dokumen;?>"></td>
	<td><?=$val->nama_pegawai;?> (<?=$val->gender;?>)</br>
	NIP. <?=$val->nip_baru;?></br><?=$val->tempat_lahir;?>, <?=$val->tanggal_lahir;?></td>
	<td><?=$val->nama_pangkat;?>, <?=$val->nama_golongan;?></br>
	<?=$val->mk_gol_tahun;?> Tahun <?=$val->mk_gol_bulan;?> Bulan</td>
	<td><?=$val->nomenklatur_jabatan;?></br>
	<u>Sejak :</u> <?=$val->tmt_jabatan;?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>

			</div><!--/.panel-body -->
		</div><!--/.panel -->
	</div><!--/.col-lg-12 -->
</div>
