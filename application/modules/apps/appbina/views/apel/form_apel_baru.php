<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Absensi Apel</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-star fa-fw"></i> <b>FORM TAMBAH JADUAL APEL</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<?php if($balik=="ya"){ ?>
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
														<?php } ?>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">





<form id="content-form" method="post" action="<?=site_url("appbina/apel/jadual_apel_tambah_aksi");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-12">
								<div style="line-height:35px;">
										<div style="float:left; width:85px;">Tanggal</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><input type='text' class='form-control' name='tanggal_apel'></div></span>
								</div>
								<div style="clear:both;line-height:35px;">
										<div style="float:left; width:85px;">Waktu</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><input type='text' class='form-control' name='waktu'></div></span>
								</div>
								<div style="clear:both;line-height:35px;">
										<div style="float:left; width:85px;">Keterangan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><input type='text' class='form-control' name='keterangan'></div></span>
								</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<br/>
<div class="row" id="col-form">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-success" onclick="javascript:void(0);simpan_aksi();"><i class="fa fa-save fa-fw"></i> Simpan</button>
			<?php if($balik=="ya"){ ?>
			<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</button>
			<?php }	?>
		</div>	
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</form>









									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
function simpan_aksi(){
	$('#col-form').hide();
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
                if(arr_result[0]=='sukses'){
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel');
	$('#sb_act').submit();
}
</script>