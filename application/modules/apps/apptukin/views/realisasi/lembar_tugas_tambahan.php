<div id="grid-data">
		<div class="table-responsive">
<form id="xx-form" method="post" enctype="multipart/form-data">
<table width="100%" class="table info table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th width=25>No.</th>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<th width=35>AKSI</th>
<?php } ?>
<th width=400>KEGIATAN TUGAS TAMBAHAN</th>
<th align=center>NOMOR SURAT PERINTAH</th>
<th width=150>TANGGAL</th>
<th align=center>PEJABAT PEMBERI PERINTAH</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach($ttambahan AS $key=>$val)
{
?>
<tr id='row_tugas_tambahan_<?=$val->id_tugas_tambahan;?>'>
<td id='nomor_tugas_tambahan_<?=$val->id_tugas_tambahan;?>'><?=$no;?></td>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<td id='aksi_tugas_tambahan_<?=$val->id_tugas_tambahan;?>' align=center>
	<?php if($bulan_aktif==$val->bulan){	?>
	<div class="dropdown" id="btMenu<?=$val->id_tugas_tambahan;?>">
		<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenu<?=$val->id_tugas_tambahan;?>" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu<?=$val->id_tugas_tambahan;?>">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('tugas_tambahan_edit','<?=$val->id_tugas_tambahan;?>',1,1)"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('tugas_tambahan_hapus','<?=$val->id_tugas_tambahan;?>',1,1)"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
		</ul>
	</div>
	<?php	}	 ?>
</td>
<?php } ?>
<td><?=$val->pekerjaan;?></td>
<td><?=$val->no_sp;?></td>
<td>
<?php
date_default_timezone_set('Asia/Jakarta');
echo date("d-m-Y", strtotime($val->tanggal_sp));
?>
</td>
<td><?=$val->penandatangan_sp;?></td>
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
<tr id='row_tugas_tambahan_xx'>
<td id='nomor_xx'><?=$no;?></td>
<?php if($realisasi->status!="aju_penilai" && $realisasi->status!="koreksi_penilai" && $realisasi->status!="acc_penilai"){ ?>
<td id='aksi_xx' align=center>...</td>
<?php }	?>
<td id='pekerjaan_xx'>
<div class="btn btn-primary btn-xs"  onClick="setForm('tugas_tambahan_tambah',1,1,1)" data-nomor="<?=($no);?>"><i class="fa fa-plus fa-fw"></i> Tambah kegiatan...</div>
</td>
<td>...</td>
<td>...</td>
<td>...</td>
</tr>
<?php }	?>
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