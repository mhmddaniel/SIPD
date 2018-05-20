<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table style="width:1024px;" class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:25px;">No.</th>
<th style="width:35px;">PILIH</th>
<th style="width:250px;">NAMA DIKLAT / RUMPUN / TAHUN / ANGKATAN</th>
<th style="width:200px;">TEMPAT / PENYELENGGARA</th>
<th style="width:200px;">WAKTU / DURASI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
foreach($diklat AS $key=>$val){
?>
<tr id='row_<?=$val->id_diklat_struk;?>'>
<td id='nomor_<?=$val->id_diklat_struk;?>'><?=$no;?></td>
<td id='aksi_<?=$val->id_diklat_struk;?>' align=center>
	<button class="btn btn-primary btn-xs" type="button" onclick="iniDIKLAT(<?=$val->id_diklat_struk;?>);" data-dismiss="modal" title='Klik untuk memilih skp'><span class="fa fa-check"></span>
</td>
<td><?=$val->nama_diklat;?><br/><?=$val->tahun;?> - <?=$val->angkatan;?></td>
<td><?=$val->tempat_diklat;?><br/><?=$val->penyelenggara;?></td>
<td>
<?=date("d-m-Y", strtotime($val->tmt_diklat));?> s.d. <?=date("d-m-Y", strtotime($val->tst_diklat));?>
<br/><?=$val->jam;?> jam
</td>
</tr>
<?php
$no++;
}
?>
</table>
		</div>
		<!-- table-responsive --->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<script type="text/javascript">
function iniDIKLAT(idd){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/diklat/alih_diklat",
		data:{"idd": idd },
		beforeSend:function(){	
			$('#isi_modal').html('<p class=\"text-center\"><i class=\"fa fa-spinner fa-spin fa-2x\"></i><p>');
		},
        success:function(data){
			location.href = '<?=site_url();?>'+'module/appbkpp/diklat';
		},
        dataType:"html"});
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>