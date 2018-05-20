<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
										Form Arsip Dokumen Pegawai
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-default btn-xs" type="button" onclick="tutup();"><i class="fa fa-close fa-fw"></i></button>
									</div>
								</div>
						</div>
			</div>
			<!-- /. panel-heading -->
			<div class="panel-body">





<form role="form" id="form_master" action="<?=site_url();?>appbkpp/pegawai/arsip_aksi">
		<div class="row">
			<div class="col-lg-3">
				<label>Nanma pegawai (tanpa gelar)</label><br /><?=$val->nama_pegawai;?>
				<input name="nama_pegawai" id="nama_pegawai" value='<?=$val->nama_pegawai;?>' type=hidden>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Lama</label><br /><?=$val->nip;?>
				<input name="nip" id="nip" value='<?=$val->nip;?>' type=hidden>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Baru</label><br /><?=$val->nip_baru;?>
				<input name="nip_baru" id="nip_baru" value='<?=$val->nip_baru;?>' type=hidden>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tempat lahir</label><br /><?=$val->tempat_lahir;?>
				<input name="tempat_lahir" id="tempat_lahir" value='<?=$val->tempat_lahir;?>' type=hidden>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label><br /><?=$val->tanggal_lahir;?>
				<input name="tanggal_lahir" id="tanggal_lahir" value='<?=$val->tanggal_lahir;?>' type=hidden>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Kode Arsip</label>
				<input name="kd_arsip" id="kd_arsip" value='<?=isset($isi->kd_arsip)?$isi->kd_arsip:"";?>' type=text class="form-control">
			</div><!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Lemari</label>
				<input name="lemari" id="lemari" value='<?=isset($isi->lemari)?$isi->lemari:"";?>' type=text class="form-control">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Pintu</label>
				<input name="pintu" id="pintu" value='<?=isset($isi->pintu)?$isi->pintu:"";?>' type=text class="form-control">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Rak</label>
				<input name="rak" id="rak" value='<?=isset($isi->rak)?$isi->rak:"";?>' type=text class="form-control">
			</div><!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;" id='col_form'>
			<div class="col-lg-6">
					<input type='hidden' name='id_arsip' id='id_arsip' value="<?=isset($isi->id_arsip)?$isi->id_arsip:"";?>">
					<input type='hidden' name='id_pegawai' id='id_pegawai' value="<?=$id_pegawai;?>">
			        <button type="submit" class="btn btn-primary" onclick="simpan_arsip();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="tutup();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->
</form>











			</div>
			<!-- /. panel-body -->
		</div>
		<!-- /. panel -->



	</div>
</div>
<!-- /.row -->
<script type="text/javascript">
function simpan_arsip(){
			$.ajax({
				type:"POST",
				url:$('#form_master').attr('action'),
				data:$('#form_master').serialize(),
				beforeSend:function(){	
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					tutup();
				}, // end success
			dataType:"html"}); // end ajax
}
</script>
