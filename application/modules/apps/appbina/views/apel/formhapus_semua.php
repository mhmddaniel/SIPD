<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Absensi Apel</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-trash fa-fw"></i> <b>FORM HAPUS SEMUA WAJIB APEL</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url("appbina/apel/hapus_semua_aksi");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <b>HARI KERJA</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_kerja;?>, <?=$val->tanggal_apel;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Lokasi apel</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;">Semua...</div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Keterangan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=@$jam[0]->keterangan;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr style="background-color:#CCCCCC">
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:200px;text-align:center; vertical-align:middle">LOKASI APEL</th>
<th style="width:150px;text-align:center; vertical-align:middle">WAJIB APEL</th>
<th style="width:50px;text-align:center; vertical-align:middle">ESS. 2</th>
<th style="width:50px;text-align:center; vertical-align:middle">ESS. 3</th>
<th style="width:50px;text-align:center; vertical-align:middle">ESS. 4</th>
<th style="width:50px;text-align:center; vertical-align:middle">NON ESS.</th>
</tr>
</thead>
<tbody id=list>
	<?php
	$jj = 0;
	$je2 = 0;
	$je3 = 0;
	$je4 = 0;
	$jne = 0;
	foreach($lokasi_apel AS $key=>$val){
	$jj = $jj+$val->wajib;
	$je2 = $je2+$val->e2;
	$je3 = $je3+$val->e3;
	$je4 = $je4+$val->e4;
	$jne = $jne+$val->ne;
	?>
<tr>
<td><?=$key+1;?></td>
<td><?=$val->lokasi;?></td>
<td><b><?=$val->wajib;?></b> pegawai</td>
<td><?=$val->e2;?></td>
<td><?=$val->e3;?></td>
<td><?=$val->e4;?></td>
<td><?=$val->ne;?></td>
</tr>
	<?php
	}
	?>
<tr>
<td align=right colspan=2><b>Jumlah</b></td>
<td><b><?=$jj;?> pegawai</b></td>
<td><b><?=$je2;?></b></td>
<td><b><?=$je3;?></b></td>
<td><b><?=$je4;?></b></td>
<td><b><?=$jne;?></b></td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



<div class="row" id="col-form">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-danger" onclick="javascript:void(0);simpan();"><i class="fa fa-trash fa-fw"></i> Hapus</button>
			<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</button>
		</div>	
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<input type=hidden name='id_apel' value='<?=$id_apel;?>'>
</form>


									</div><!-- /.panel-body -->
								</div><!-- /.panel -->
							</div><!-- /.col-lg-12 -->
						</div><!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel');
	$('#sb_act').submit();
}
/////////////////////////////////////////////////////////////////////////////
function simpan(){
	simpan_aksi();
}
function simpan_aksi(){
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
/////////////////////////////////////////////////////////////////////////////
</script>