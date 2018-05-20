		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="background-color:#ffffff;">
<thead id=gridhead>
<tr height=20>
<th width=75>No.</th>
<th width=45>ST</th>
<th width=450>TAHAPAN</th>
<th align=center>PELAKSANA</th>
<th width=170>JEJAK WAKTU</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($tahapan_tpp AS $key=>$val){
?>
	<tr>
	<td><?=$i;?>.</td>
	<td>
	<?php
		if($i<$tahapan_tpp_nomor){
	?>
	<button class="btn btn-success btn-xs" type="button"><span class="fa fa-check fa-fw"></span></button>
	<?php
	} elseif($i==$tahapan_tpp_nomor) {
	?>
	<button class="btn btn-warning btn-xs" type="button"><span class="fa fa-caret-right fa-fw"></span></button>
	<?php
	} else {
	?>
	...
	<?php
	}
	?>
	</td>
	<td><?=$val;?></td>
	<td><?=$tahapan_tpp_pelaku[$key];?></td>
	<td align="center"><?=$tpp->$key;?></td>
	</tr>
<?php
$i++;
}
?>
</tbody>
</table>
		</div>
		<!-- table-responsive --->
<script type="text/javascript">
$("#btBatal").hide();
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>