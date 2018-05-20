<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_pak" action="<?=site_url();?>appbkpp/profile/formpak_<?=(isset($isi->id_pak))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Dok. Penetapan Angka Kredit</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Tahun</label>
				<input name="tahun" id="tahun" type=text class="form-control" value="<?=(isset($isi->tahun))?$isi->tahun:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.col-lg-3-->
			<div class="col-lg-3">
				<label>Bulan</label>
				<?php $dis = (isset($hapus))?"disabled":""; ?>
				<?=form_dropdown('bulan',$this->dropdowns->bulan(),(!isset($isi->bulan))?'':$isi->bulan,'class="form-control" '.$dis.'');?>
			</div><!--/.col-lg-3-->
			<div class="col-lg-6">
				<label>Nama Pejabat Penilai</label>
				<input name="penilai_nama_pegawai" id="penilai_nama_pegawai" type=text class="form-control" value="<?=(isset($isi->penilai_nama_pegawai))?$isi->penilai_nama_pegawai:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.col-lg-6-->
		</div><!--/.row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Angka Kredit</label>
				<input name="ak" id="ak" type=text class="form-control" value="<?=(isset($isi->ak))?$isi->ak:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.col-lg-3-->
			<div class="col-lg-3">
				<label>Angka Kredit Kumulatif</label>
				<input name="ak_kumulatif" id="ak_kumulatif" type=text class="form-control" value="<?=(isset($isi->ak_kumulatif))?$isi->ak_kumulatif:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.col-lg-3-->
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-6" style="padding-top:15px;">
					<?=form_hidden('id_pegawai',$id_pegawai);?>
					<input name="id_pak" id="id_pak" type=hidden class="form-control" value="<?=(isset($isi->id_pak))?$isi->id_pak:"";?>">
			        <button type="submit" class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></button>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div><!--//col-lg-6-->
		</div><!--//row-->
	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</form>
