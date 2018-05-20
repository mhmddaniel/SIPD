<div class="row" style="padding-bottom:5px;" id="content-wrapperRW">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Riwayat Pemangku jabatan
				<div class="btn-group pull-right">
					<div class="btn btn-warning btn-xs" onclick="tutup2();"><i class="fa fa-close fa-fw"></i></div>
				</div>
			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Identitas Jabatan</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$unor->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Eselon</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$unor->nama_ese;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$unor->nomenklatur_pada;?></div></span>
								</div>
			</div>
		</div>
	</div>
</div>



<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:25px;text-align:center; vertical-align:middle">No.</th>
<th style="width:25px;text-align:center; vertical-align:middle">&nbsp;</th>
<th style="width:200px;text-align:center; vertical-align:middle">NIP<br /><b>NAMA PEGAWAI</b></th>
<th style="width:100px;text-align:center; vertical-align:middle">TMT JABATAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">STATUS</th>
</tr>
</thead>
<tbody id="list">
<?php
foreach($hsl AS $key=>$val){
?>
<tr>
<td><?=$key+1;?></b></td>
<td style="text-align:center;"><div class="btn btn-default btn-xs" onclick="detil(<?=$val->id_pegawai;?>,'appbkpp/profile/pns_ini','tidak');return false;"><i class="fa fa-binoculars fa-fw"></i></div></td>
<td><?=$val->nip_baru;?><b><br><?=$val->nama_pegawai;?></b></td>
<td><?=date("d-m-Y", strtotime($val->tmt_jabatan));?></b></td>
<td><?=$val->status;?></b></td>
</tr>
<?php
}
if(empty($hsl)){
?>
<tr><td colspan=5 style="text-align:center;"><b>TIDAK ADA DATA</b></td></tr>
<?php
}
?>
</tbody>
</table>
</div>
			</div>
		</div>
	</div>
</div>

<div id="sub_kontenRW" style="padding-bottom:30px; display:none;"></div>

<script type="text/javascript">
function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh,"awal":"sk_jabatan"},
		beforeSend:function(){	
			$("#content-wrapperRW").hide();
			$('#sub_kontenRW').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_kontenRW').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("#sub_kontenRW").html("").hide();
	$("#content-wrapperRW").show();
}
</script>
