<div class="row">
	<div class="col-lg-12">
<form role="form" id="form_tkk" action="<?=site_url();?>appbkpp/nonpns/biodata_aksi_hapus">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Biodata <?=strtoupper($status_kepegawaian);?></b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<label>Nama <?=strtoupper($status_kepegawaian);?> (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=@$isi->nama_pegawai;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=@$isi->tempat_lahir;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" value="<?=(isset($isi->tanggal_lahir))?date("d-m-Y", strtotime(@$isi->tanggal_lahir)):"";?>" placeholder="dd-mm-YYYY"  disabled>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Jenis kelamin</label>
				<?=form_dropdown('gender',$this->dropdowns->gender(),(!isset($isi->gender))?'':$isi->gender,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="gender" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" id="gender" disabled');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Agama</label>
				<?=form_dropdown('agama',$this->dropdowns->agama(),(!isset($isi->agama))?'':$isi->agama,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="agama" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" id="agama" disabled');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Status perkawinan</label>
				<?=form_dropdown('status_perkawinan',$this->dropdowns->status_perkawinan(),(!isset($isi->status_perkawinan))?'':$isi->status_perkawinan,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="status_perkawinan" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" id="status_perkawinan" disabled');?>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor HP</label>
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=@$isi->nomor_hp;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=@$isi->nomor_tlp_rumah;?>" disabled>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
					<?=form_hidden('status_kepegawaian',$status_kepegawaian);?>
					<?=form_hidden('id_pegawai',@$isi->id_pegawai);?>
			        <button type="submit" class="btn btn-danger" onclick="hapus();return false;"><i class="fa fa-save fa-fw"></i> Hapus</button>
					<button class="btn btn-default" type="button" onclick="tutup();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div><!--//col-lg-6-->
		</div><!--//row-->


	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</form>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<form id="sb_act" method="post"></form>

<script type="text/javascript">
function hapus(){
			$.ajax({
				type:"POST",
				url:$('#form_tkk').attr('action'),
				data:$('#form_tkk').serialize(),
				beforeSend:function(){	
					$('#form_tkk').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					tutup();
				}, // end success
			dataType:"html"}); // end ajax
}
</script>