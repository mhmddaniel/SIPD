			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:50px;text-align:center; vertical-align:middle">KEHADIRAN</th>
<th style="width:100px;text-align:center; vertical-align:middle">HARI / TANGGAL</th>
<th style="width:80px;text-align:center; vertical-align:middle;padding:0px;">JAM MASUK</th>
<th style="width:80px;text-align:center; vertical-align:middle">JAM PULANG</th>
<th style="width:80px;text-align:center; vertical-align:middle">JAM KERJA</th>
</tr>
</thead>
<tbody id=list>
<?php
if(empty($abs)){
?>
<tr><td colspan=7 align=center><b>Tidak Ada Data</b></td></tr>
<?php
} else {
$sl_masuk = strtotime("00:00:00");
foreach($abs AS $key=>$val){
$sl_masuk = strtotime($sl_masuk)+strtotime($val->selisih_masuk);
?>
<tr>
<td><?=($key+1);?>.</td>
<td><?=$status[$val->status];?></td>
<td><?=$hari[$val->hari_kerja];?>, <?=$val->tanggal_harian;?></td>
<td><?=$val->absen_masuk;?> / <?=($val->selisih_masuk==0)?"-":$val->telat_masuk;?></td>
<td><?=$val->absen_pulang;?> / <?=($val->selisih_pulang==0)?"-":$val->cepat_pulang;?></td>
<td><?=$val->jam_masuk;?> - <?=$val->jam_pulang;?></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
<?php
echo $sumtimer;
?>
			</div>
			<!-- table-responsive --->
