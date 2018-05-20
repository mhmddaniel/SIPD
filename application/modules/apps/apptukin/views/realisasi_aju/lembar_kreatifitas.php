<div id="grid-data">
		<div class="table-responsive">
<form id="kreatifitas-form" method="post" enctype="multipart/form-data">
<table width="100%" class="table info table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th width=25>No.</th>
<th width=400>KARYA KREATIFITAS</th>
<th align=center>NOMOR SURAT KEPUTUSAN</th>
<th align=center>TANGGAL</th>
<th align=center>PENANDATANGAN SURAT KEPUTUSAN</th>
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
<td><?=$val->kreatifitas;?></td>
<td><?=$val->no_sk;?></td>
<td><?=$val->tanggal_sk;?></td>
<td><?=$val->penandatangan_sk;?></td>
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