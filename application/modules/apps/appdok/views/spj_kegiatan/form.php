<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_spj_kegiatan" action="<?=site_url();?>appbkpp/profile_thl/formspj_kegiatan_<?=(isset($isi->id_spj_kegiatan))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form SPJ Kegiatan</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Tahun Anggaran</label>
				<input name="tahun" id="tahun" type=text class="form-control" value="<?=(isset($isi->tahun))?$isi->tahun:"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="YYYY">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor DPA</label>
				<input name="nomor_dpa" id="nomor_dpa" type=text class="form-control" value="<?=(isset($isi->nomor_dpa))?$isi->nomor_dpa:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-6">
				<label>Judul DPA / Kegiatan</label>
				<input name="judul_dpa" id="judul_dpa" type=text class="form-control" value="<?=(isset($isi->judul_dpa))?$isi->judul_dpa:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->
		<div class="row" style="padding-top:20px;">
			<div class="col-lg-3">
				<label>NIP PPTK</label>
				<input name="nip_pptk" id="nip_pptk" type=text class="form-control" value="<?=(isset($isi->nip_pptk))?$isi->nip_pptk:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-6">
				<label>Nama PPTK</label>
				<input name="nama_pptk" id="nama_pptk" type=text class="form-control" value="<?=(isset($isi->nama_pptk))?$isi->nama_pptk:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
		<div class="row">
			<div class="col-lg-6" style="padding-top:15px;">
					<?=form_hidden('id_pegawai',$id_pegawai);?>
					<input name="id_spj_kegiatan" id="id_spj_kegiatan" type=hidden class="form-control" value="<?=(isset($isi->id_spj_kegiatan))?$isi->id_spj_kegiatan:"";?>">
			        <button type="submit" class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></button>
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
