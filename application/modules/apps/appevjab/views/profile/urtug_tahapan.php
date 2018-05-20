<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="text-align:center; vertical-align:middle">TAHAPAN</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($tahapan AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td><?=$val->tahapan;?></td>
		</tr>
	<?php
	}
	if(empty($tahapan)){
	?>
		<tr>
			<td colspan=3 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>


</div>
