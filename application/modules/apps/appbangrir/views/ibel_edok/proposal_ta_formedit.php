<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_proposal_ta" action="<?=site_url();?>appbangrir/ibel_edok/proposal_ta_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>RENCANA THESIS / DISERTASI</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-12">
				<label>Judul</label>
				<input name="nomor" id="nomor" type=text class="form-control" value="<?=@$isi->nomor;?>">
			</div>
			<!--//col-lg-12-->
		</div>
		<!--row-->
				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->


	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel -->
      </form>
