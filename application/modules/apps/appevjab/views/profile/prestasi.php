<div class="row" style="padding-top:15px;">
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;display:none;">AKSI</th>
			<th style="width:200px;text-align:center; vertical-align:middle">SATUAN HASIL</th>
			<th style="width:200px;text-align:center; vertical-align:middle">JUMLAH HASIL<br>(dalam 1 tahun)</th>
			<th style="text-align:center; vertical-align:middle">WAKTU PENYELESAIAN<br>(menit)</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($prestasi AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td style="display:none;">
<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<ul class="dropdown-menu" role="menu">
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formedit',<?=$val->id_prestasi;?>,<?=$key+1;?>);"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formhapus',<?=$val->id_prestasi;?>,<?=$key+1;?>);"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
</ul>
</div>
			</td>
			<td><?=$val->satuan;?></td>
			<td><?=$val->jumlah;?></td>
			<td><?=$val->waktu;?></td>
		</tr>
	<?php
	}
	if(empty($prestasi)){
	?>
		<tr>
			<td colspan=4 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>

</div><!--/.table-responsive-->
</div><!--/.col-lg-12-->
</div><!--/.row-->