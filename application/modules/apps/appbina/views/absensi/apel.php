			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:90px;text-align:center; vertical-align:middle;padding:0px;">KEHADIRAN</th>
<th style="width:80px;text-align:center; vertical-align:middle">HARI</th>
<th style="width:80px;text-align:center; vertical-align:middle">TANGGAL</th>
<th style="width:80px;text-align:center; vertical-align:middle">WAKTU</th>
<th style="width:150px;text-align:center; vertical-align:middle">LOKASI</th>
<th style="width:200px;text-align:center; vertical-align:middle">KETERANGAN</th>
</tr>
</thead>
<tbody id=list>
<?php
if(empty($abs)){
?>
<tr><td colspan=7 align=center><b>Tidak Ada Data</b></td></tr>
<?php
} else {
foreach($abs AS $key=>$val){
?>
<tr>
<td><?=($key+1);?>.</td>
<td><?=($val->tanggal_apel>date('Y-m-d'))?"...":$status[$val->status];?></td>
<td><?=$hari[$val->hari_apel];?></td>
<td><?=$val->tanggal;?></td>
<td><?=$val->waktu;?></td>
<td><?=$val->lokasi;?></td>
<td><?=$val->keterangan;?></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
			</div>
			<!-- table-responsive --->

