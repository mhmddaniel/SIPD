<div class="row" id="content-wrapper3">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<?=$unor->nama_unor;?>
						<div class="btn-group pull-right">
							<div class="btn btn-warning btn-xs" onclick="tutup4();"><i class="fa fa-close fa-fw"></i></div>
						</div>
			</div>
			<div class="panel-body">
		

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:150px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:150px;text-align:center; vertical-align:middle">KEPANGKATAN</th>
</tr>
</thead>
<tbody id="list_rincian">
<?php
foreach($hsl AS $key=>$val){
?>
<tr>
	<td><?=$key+1;?></td>
	<td><span class='btn btn-default btn-xs' onclick="detil3(<?=$val->id_pegawai;?>,'appbkpp/profile/pns_ini','tidak');"><i class='fa fa-binoculars fa-fw'></i></span> <b><?=$val->nama_pegawai;?></b></td>
	<td><?=$val->nama_golongan;?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_rincian"></div>
<div id="paging_print_rincian" style="display:none;"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="sub_konten3" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
function detil3(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#content-wrapper3").hide();
			$('#sub_konten3').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten3').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
