<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Absensi Harian</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-trash fa-fw"></i> <b>FORM HAPUS SEMUA WAJIB HADIR</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url("appbina/harian/hapus_semua_aksi");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <b>HARI KERJA</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_kerja;?>, <?=$val->tanggal_harian;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Jam kerja</div>
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
			<th width=40 align="center">No.</th>
			<th align="center">UNIT KERJA</th>
			<th style="width:150px;text-align:center; vertical-align:middle">WAJIB HADIR</th>
			<th style="width:50px;text-align:center; vertical-align:middle">ESS.2</th>
			<th style="width:50px;text-align:center; vertical-align:middle">ESS.3</th>
			<th style="width:50px;text-align:center; vertical-align:middle">ESS.4</th>
			<th style="width:50px;text-align:center; vertical-align:middle">Non ESS</th>
		</tr>
	</thead>
	<tbody>
<?php
	$wajib_hadir = 0;
	$e2 = 0;
	$e3 = 0;
	$e4 = 0;
	$ne = 0;
	$dl = 0;
	$tk = 0;
foreach($unor AS $key=>$val){
	$wajib_hadir = $wajib_hadir+$val->wajib_hadir;
	$e2 = $e2+$val->e2;
	$e3 = $e3+$val->e3;
	$e4 = $e4+$val->e4;
	$ne = $ne+$val->ne;
?>
		<tr>
			<td><?=($key+1);?></td>
			<td><?=$val->nama_unor;?></td>
			<td><?=$val->wajib_hadir;?></td>
			<td><?=$val->e2;?></td>
			<td><?=$val->e3;?></td>
			<td><?=$val->e4;?></td>
			<td><?=$val->ne;?></td>
		</tr>
<?php
}
?>

		<tr>
			<td colspan=2 align="right"><b>Total: </b></td>
			<td><b><?=$wajib_hadir;?></b></td>
			<td><b><?=$e2;?></b></td>
			<td><b><?=$e3;?></b></td>
			<td><b><?=$e4;?></b></td>
			<td><b><?=$ne;?></b></td>
		</tr>
	</tbody>
</table>
</div>

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
<input type=hidden name='id_harian' value='<?=$id_harian;?>'>
</form>


									</div><!-- /.panel-body -->
								</div><!-- /.panel -->
							</div><!-- /.col-lg-12 -->
						</div><!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/harian');
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