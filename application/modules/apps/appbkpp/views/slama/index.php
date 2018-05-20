<?php 		date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<table>
<tr>
<td><b>NOMOR</b></td>
<td width=150><b>KODE UNOR</b></td>
<td><b>NAMA UNOR</b></td>
</tr>
<?php
foreach($unor AS $key=>$val){
?>
<tr>
<td><?=($key+1);?></td>
<td><?=$val->kode_unor;?></td>
<td><?=$val->nama_unor;?></td>
</tr>
<?php
}
?>
</table>