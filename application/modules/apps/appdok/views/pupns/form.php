<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_pupns" action="<?=site_url();?>appbkpp/profile/pupns_<?=(isset($isi->id_pupns))?"edit":"input";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Dokumen Registrasi PUPNS</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nomor Registrasi PUNS</label>
				<input name="pupns_nomor" id="pupns_nomor" type=text class="form-control" value="<?=(isset($isi->pupns_nomor))?$isi->pupns_nomor:"";?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal Registrasi</label>
				<input name="pupns_tanggal" id="pupns_tanggal" type=text class="form-control" value="<?=(isset($isi->pupns_tanggal))?date("d-m-Y", strtotime($isi->pupns_tanggal)):"";?>" placeholder="dd-mm-YYY">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3" style="display:none;">
				<label>Pejabat penandatangan</label>
				<input name="pupns_pejabat" id="pupns_pejabat" type=text class="form-control" value="<?=(isset($isi->pupns_pejabat))?$isi->pupns_pejabat:"";?>">
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
