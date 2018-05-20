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
												<div class="col-lg-6"><i class="fa fa-sort-amount-desc fa-fw"></i> <b>FORM PENAMBAHAN SEMUA PEGAWAI</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url("appbina/harian/tambah_semua_aksi");?>" enctype="multipart/form-data" role="form">
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
										<span><div style="display:table;"><?=@$jam[0]->jam_masuk;?> s.d. <?=@$jam[0]->jam_pulang;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Keterangan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=@$jam[0]->keterangan;?></div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <b>Pegawai</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:155px;">Banyaknya pegawai</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$j_pegawai;?> pegawai</div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:155px;">Banyaknya Unit Kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$j_unor;?> SKPD</div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->


<div class="row" id="col-form">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="javascript:void(0);simpan();"><i class="fa fa-save fa-fw"></i> Simpan</button>
			<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</button>
		</div>	
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<input type=hidden name='id_harian' value='<?=$id_harian;?>'>
<input type=hidden name='id_jam' value='<?=@$jam[0]->id_jam;?>'>
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