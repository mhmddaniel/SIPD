<div id="grid-data">
		<div class="table-responsive">
<form id="kreatifitas-form" method="post" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;">No.</th>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<th style="width:55px;">AKSI</th>
<?php }	?>
<th style="width:200px;">KARYA KREATIFITAS</th>
<th style="width:200px;">IMPLEMENTASI</th>
<th style="width:200px;" align=center>NOMOR SURAT KEPUTUSAN</th>
<th style="width:100px;">TANGGAL</th>
<th style="width:250px;" align=center>PENANDATANGAN SURAT KEPUTUSAN</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach($kreatifitas AS $key=>$val)
{
?>
<tr id='row_kreatifitas_<?=$val->id_kreatifitas;?>'>
<td id='nomor_kreatifitas_<?=$val->id_kreatifitas;?>'><?=$no;?></td>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<td id='aksi_kreatifitas_<?=$val->id_kreatifitas;?>' align=center>
	<?php if($bulan_aktif==$val->bulan){	?>
	<div class="dropdown" id="btMenu<?=$val->id_kreatifitas;?>">
		<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenu<?=$val->id_kreatifitas;?>" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu<?=$val->id_kreatifitas;?>">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('kreatifitas_edit','<?=$val->id_kreatifitas;?>',1,1)"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('kreatifitas_hapus','<?=$val->id_kreatifitas;?>',1,1)"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
		</ul>
	</div>
	<?php }	?>
</td>
<?php }	?>
<td><?=$val->kreatifitas;?></td>
<td><?=$tingkat[$val->tingkat];?></td>
<td><?=$val->no_sk;?></td>
<td>
<?php
date_default_timezone_set('Asia/Jakarta');
echo date("d-m-Y", strtotime($val->tanggal_sk));
?>
</td>
<td><?=$val->penandatangan_sk;?></td>
</tr>
<?php
$no++;
}
?>
<?php
if(($no==1) && ($realisasi->status!="draft" && $realisasi->status!="revisi_penilai")){
?>
<tr>
<td colspan=6 align=center>Tidak Ada Data</td>
</tr>
<?php }	?>
<?php
if($realisasi->status=="draft" || $realisasi->status=="revisi_penilai") {
?>
<tr id='row_kreatifitas_xx'>
<td id='nomor_kreatifitas'><?=$no;?></td>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<td id='aksi_cc' align=center>...</td>
<?php }	?>
<td id='pekerjaan_cc'>
<div class="btn btn-primary btn-xs"  onClick="setForm('kreatifitas_tambah',1,1,1)" data-nomor="<?=($no);?>"><i class="fa fa-plus fa-fw"></i> Tambah kegiatan...</div>
</td>
<td>...</td>
<td id='ak_cc'>...</td>
<td id='volume_cc'>...</td>
<td id='satuan_cc'>...</td>
</tr>
<?php } ?>
</tbody>
</table>
</form>
		</div>
		<!-- table-responsive --->
</div>
<!-- /.grid-data -->
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>