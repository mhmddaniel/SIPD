<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_pertek" action="<?=site_url();?>appbkpp/profile/pertek_<?=(isset($isi->id_pertek))?"edit":"input";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Dokumen Nota Pertimbangan Teknis Pegawai</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nomor Nota Pertimbangan Teknis</label>
				<input name="pertek_nomor" id="pertek_nomor" type=text class="form-control" value="<?=(isset($isi->pertek_nomor))?$isi->pertek_nomor:"";?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal Pertek</label>
				<input name="pertek_tanggal" id="pertek_tanggal" type=text class="form-control" value="<?=(isset($isi->pertek_tanggal))?date("d-m-Y", strtotime($isi->pertek_tanggal)):"";?>" placeholder="dd-mm-YYY">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3" style="display:none;">
				<label>Pejabat penandatangan</label>
				<input name="pertek_pejabat" id="pertek_pejabat" type=text class="form-control" value="<?=(isset($isi->pertek_pejabat))?$isi->pertek_pejabat:"";?>">
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
