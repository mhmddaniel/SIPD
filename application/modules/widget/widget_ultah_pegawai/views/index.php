<div class="row"  style="margin-top:<?=$margin_top;?>px;">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><i class="fa fa-birthday-cake fa-fw"></i> PEGAWAI BERULANG TAHUN HARI INI</div><!--/.panel-heading -->
			<div class="panel-body">

<div>
BKPP Kota Tangerang mengucapkan selamat dan berbahagia, semoga Tuhan Yang Maha Esa memberkahi Bapak/Ibu sekalian.
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:250px;text-align:center; vertical-align:middle">UNIT KERJA</th>
</tr>
</thead>
<tbody id=list>
<?php
foreach($isi AS $key=>$val){
?>
<tr>
	<td><?=($key+1);?></td>
	<td><?=$val->nama_pegawai;?></td>
	<td><?=$val->nomenklatur_pada;?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>

			</div><!--/.panel-body -->
		</div><!--/.panel -->
	</div><!--/.col-lg-12 -->
</div>
