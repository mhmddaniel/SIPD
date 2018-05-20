<div id="grid-data">
		<div class="table-responsive">
<form id="tugas_tambahan-form" method="post" enctype="multipart/form-data">
<table width="100%" class="table info table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th width=25>No.</th>
<th width=35>AKSI</th>
<th width=400>KEGIATAN TUGAS TAMBAHAN</th>
<th align=center>NOMOR SURAT PERINTAH</th>
<th align=center>TANGGAL</th>
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
<td>&nbsp;</td>
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
if($no==1){
?>
<tr>
<td colspan=8 align=center>Tidak Ada Data</td>
</tr>
<?php
}
?>
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