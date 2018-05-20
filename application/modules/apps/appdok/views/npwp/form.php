<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_npwp" action="<?=site_url();?>appbkpp/profile/npwp_<?=(isset($isi->id_npwp))?"edit":"input";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form NPWP</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nomor NPWP</label>
				<input name="npwp_nomor" id="npwp_nomor" type=text class="form-control" value="<?=(isset($isi->npwp_nomor))?$isi->npwp_nomor:"";?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal NPWP</label>
				<input name="npwp_tanggal" id="npwp_tanggal" type=text class="form-control" value="<?=(isset($isi->npwp_tanggal))?date("d-m-Y", strtotime($isi->npwp_tanggal)):"";?>" placeholder="dd-mm-YYYY">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Pejabat penandatangan</label>
				<input name="npwp_pejabat" id="npwp_pejabat" type=text class="form-control" value="<?=(isset($isi->npwp_pejabat))?$isi->npwp_pejabat:"";?>">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
		<div class="row">
			<div class="col-lg-6" style="padding-top:15px;">
					<?=form_hidden('id_pegawai',$id_pegawai);?>
			        <button type="submit" class="btn btn-primary" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->
	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel --> <?=form_hidden('token',$token);?>
      </form>
