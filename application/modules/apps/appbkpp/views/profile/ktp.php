<div class="row" id="content_ktp">
	<div class="col-lg-9">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-home fa-fw"></i> Data Alamat Pegawai
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('ktp','edit','ktp'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
			</div>
			<div class="panel-body">


				<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>N.I.K.</label>
								<?=form_input('ktp_nomor',(!isset($data->ktp_nomor))?'':$data->ktp_nomor,'class="form-control" disabled=""');?>
							</div>
						</div>
				</div>




				<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama Jalan</label>
								<?=form_input('jalan',(!isset($data->jalan))?'':$data->jalan,'class="form-control" disabled=""');?>
							</div>
							 <div class="form-group">
								<label>RT</label>
								<?=form_input('rt',(!isset($data->rt))?'':$data->rt,'class="form-control" disabled=""');?>
							</div>
							 <div class="form-group">
								<label>RW</label>
								<?=form_input('rw',(!isset($data->rw))?'':$data->rw,'class="form-control" disabled=""');?>
							</div>
							 <div class="form-group">
								<label>Kelurahan / Desa</label>
								<?=form_input('kel_desa',(!isset($data->kel_desa))?'':$data->kel_desa,'class="form-control" disabled=""');?>
							</div>
							<div class="form-group">
								<label>Kecamatan</label>
								<?=form_input('kecamatan',(!isset($data->kecamatan))?'':$data->kecamatan,'class="form-control" disabled=""');?>
							</div>
						</div>
						<!-- /.col-lg-6 (nested) -->
						<div class="col-lg-6">
								<div class="form-group">
									<label>Kab. / Kota</label>
									<?=form_input('kab_kota',(!isset($data->kab_kota))?'':$data->kab_kota,'class="form-control" disabled=""');?>
								</div>
								<div class="form-group">
									<label>Propinsi</label>
									<?=form_input('propinsi',(!isset($data->propinsi))?'':$data->propinsi,'class="form-control" disabled=""');?>
								</div>
								<div class="form-group">
									<label>Kode Pos</label>
									<?=form_input('kode_pos',(!isset($data->kode_pos))?'':$data->kode_pos,'class="form-control" disabled=""');?>
								</div>
								<label>Jarak Tempuh Rumah-Kantor</label>
								<div class="form-group input-group">
									<span class="input-group-addon">km</span>
									<?=form_input('jarak_meter',(!isset($data->jarak_meter))?'':$data->jarak_meter,'class="form-control" disabled=""');?>
								</div>
								<div class="form-group input-group">
									<span class="input-group-addon">menit</span>
									<?=form_input('jarak_menit',(!isset($data->jarak_menit))?'':$data->jarak_menit,'class="form-control" disabled=""');?>
								</div>
						</div>
						<!-- /.col-lg-6 (nested) -->

				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
<?php if(isset($data->id_peg_alamat)){	?>
<div class="col-lg-3">
	<div class="panel panel-info">
		<div class="panel-heading"><i class="fa fa-image fa-fw"></i> KTP</div>
		<div class="panel-body">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<a href="" class="label label-info" onclick="viewUppl('ktp','<?=$data->id_peg_alamat;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<a href="" class="label label-default" onclick="zoom_dok('ktp','<?=$data->id_peg_alamat;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										</p>
									</div>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
		</div>
	</div><!--/panel-->
</div><!--//col-lg-3-->
<?php } ?>
</div>
<!-- /.row -->
<script type="text/javascript">
$('.thumbnail').hover(
	function(){	$(this).find('.caption').slideDown(250); //.fadeIn(250)
	},
	function(){	$(this).find('.caption').slideUp(250); //.fadeOut(205)
	}
); 
</script>