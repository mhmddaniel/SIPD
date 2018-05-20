<?php 		date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<table border=1>
<tr>
	<td><b>Nomor.</b></td>
	<td><b>ID PEGAWAI</b></td>
	<td><b>NIP</b></td>
	<td><b>ID PENDIDIAKAN</b></td>
</tr>
<?php
foreach($konsol AS $key=>$val){
?>
<tr>
	<td><?=($key+1);?>.</td>
	<td><?=$val->id_pegawai;?></td>
	<td><?=$val->nip_baru;?></td>
	<td><?=$val->id_pendidikan;?></td>
</tr>
<?php
}
?>
</table>
