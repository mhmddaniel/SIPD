<div class="row" style="padding-bottom:5px;" id="content-wrapperRW">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn btn-primary btn-xs" onclick="sfFungsi('xx','tambah');return false;"><i class="fa fa-plus fa-fw"></i></div>
				Fungsi Jabatan
				<div class="btn-group pull-right">
					<div class="btn btn-warning btn-xs" onclick="tutup2();"><i class="fa fa-close fa-fw"></i></div>
				</div>
			</div><!--//panel-heading-->
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div><b><?=$unor->nomenklatur_jabatan;?></b></div>
<div><u>pada</u></div>
<div><?=$unor->nomenklatur_pada;?></div>

<div class="table-responsive" id="list_uraian_fungsi" style="padding: 10px 0px 10px 0px;">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="text-align:center; vertical-align:middle">URAIAN</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($fungsi AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td>
						<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
						<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="sfFungsi('<?=$val->id_fungsi;?>','edit');return false;"><i class="fa fa-pencil fa-fw"></i> Edit data</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="sfFungsi('<?=$val->id_fungsi;?>','hapus');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
						</ul>
						</div>
			</td>
			<td><?=$val->fungsi;?></td>
		</tr>
	<?php
	}
	if(empty($fungsi)){
	?>
		<tr>
			<td colspan=4 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>
</div>

<div id="form_uraian_fungsi" style="display:none;"></div>

			</div><!--//panel-body-->
		</div><!--//panel-->
	</div><!--//col-lg-12-->
</div><!--//row-->



<script type="text/javascript">
function sfFungsi(id_fungsi,aksi){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevip/fungsi/form_"+aksi,
		data:{"id_fungsi": id_fungsi,"id_unor":<?=$id_unor;?>},
		beforeSend:function(){	
			$("#list_uraian_fungsi").hide();
			$('#form_uraian_fungsi').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#form_uraian_fungsi').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batalFungsi(){
	$('#form_uraian_fungsi').html('').hide();
	$("#list_uraian_fungsi").show();
}
</script>
